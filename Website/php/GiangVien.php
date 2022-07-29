<?php
    header('Content-Type: text/html; charset=utf-8');
    $conn = mysqli_connect("localhost", "root", "", "dbdoan2") or die("Không thể kết nối CSDL");
    $conn->set_charset('utf8');
    
        $MaGV ='';
        $HoTenGV ='';
        $update = false;
        // Hàm check kí tự đặc biệt
            function KiemTra($my_string)
            {
                $KiTu = preg_match('/[@_!#$%^&*()<>?|}{~:]/i', $my_string);
                if($KiTu){
                print ("<script> alert ('Thông tin có chứa kí tự đặc biệt. Vui lòng thử lại') </script>");
                return $my_string;
                        }
            }
//Xử lý nút thêm
        if(isset($_POST['them']))
        {
            $Ma = $_POST['maso'];
            $Ten = $_POST['ten'];
            if(KiemTra($Ma) || KiemTra($Ten))
            {
              echo"<script> location.replace('../DanhSachGV.php')</script>";
            }
            else
            {
                if($Ma && $Ten)
                {
                    // INSERT bảng taikhoan với TenTaiKhoan là MaGV và mật khẩu là 111 và vai trò là giảng viên
                    $conn -> query("INSERT INTO `taikhoan`(`TenTaiKhoan`, `MatKhau`, `VaiTro`) VALUES('$Ma', '1111', 'GiangVien')");
                    // INSERT bảng giangvien
                    $conn -> query("INSERT INTO `giangvien` (`MaGV`,`TenGV`) VALUES ('$Ma','$Ten')");     
                    echo"<script> alert('Đã thêm thành công')</script>";
                    echo"<script> location.replace('../DanhSachGV.php')</script>";
                }
              
                else
                {
                  echo"<script> alert('Thông tin không được bỏ trống. Vui lòng thử lại')</script>";
                    echo"<script> location.replace('../DanhSachGV.php')</script>";
                }
            }
        }

        // Sự kiện khi ấn nút sửa
        if(isset($_GET['Sua']))
        {
            $GV_ID = $_GET['Sua'];
            $update = true;
            $result = $conn->query("SELECT * FROM giangvien WHERE MaGV = '$GV_ID'") or die($conn->error);

            if(mysqli_num_rows($result) > 0)
            {
                $row = $result->fetch_array();
        
                $MaGV = $row['MaGV'];
                $HoTenGV = $row['TenGV'];   
            }
        }

 // Xử lí nút sửa
  if(isset($_POST['sua']))
  {
    $ED_MaGV = $_POST['maso'];
    $ED_HoTen = $_POST['ten'];

    // Khi thông tin không bị bỏ trống
       if($ED_HoTen && $ED_MaGV)
       {   
        if(KiemTra($ED_MaGV) || KiemTra($ED_HoTen))
        {
          echo"<script> location.replace('../DanhSachGV.php')</script>";
        }
        else 
        {
               $conn -> query("UPDATE giangvien SET TenGV = '$ED_HoTen'
                               WHERE MaGV = '$ED_MaGV'");
                echo "<script> alert ('Đã cập nhật thông tin') </script>";
                echo"<script> location.replace('../DanhSachGV.php')</script>";     
       }  
      }
       else
       {
          echo "<script> alert ('Thất bại. Vui lòng kiểm tra lại thông tin') </script>";
          echo"<script> location.replace('../DanhSachGV.php')</script>";
       }   
  }

//Xử lý nút xóa
  if(isset($_GET['Xoa'])){
      $Ma = $_GET['Xoa'];
      $conn ->query("DELETE FROM `giangvien` WHERE MaGV = '$Ma'");
      $conn ->query("DELETE FROM `taikhoan` WHERE TenTaiKhoan = '$Ma' AND VaiTro = 'GiangVien'");   
      echo "<script> alert ('Đã xóa thành công') </script>";
      echo"<script> location.replace('../DanhSachGV.php')</script>";
}
?>