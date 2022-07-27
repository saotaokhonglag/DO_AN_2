<?php
   $conn = mysqli_connect("localhost", "root", "", "dbdoan2") or die("Không thể kết nối CSDL");
   $conn->set_charset('utf8');
   $update = false;
   $G_MaSV = '';
   $G_TrangThai = '';
    // Hàm check kí tự đặc biệt
    function KiemTra($my_string)
    {
        $KiTu = preg_match('/[@_!#$%^&*()<>?|}{~:]/i', $my_string);
        if($KiTu)
        {
            print ("<script> alert ('Thông tin có chứa kí tự đặc biệt. Vui lòng thử lại') </script>");
            return $my_string;
        }
    } 
 // Thêm từng sinh viên
    if(isset($_POST['Them']))
    {
        $MSSV = $_POST['maso'];
        $HoTen = $_POST['HoTen'];
        $NgaySinh = $_POST['NgaySinh'];
        $Lop = $_POST['Lop'];
        $SDT = $_POST['SDT'];
        $Khoa = $_POST['Khoa'];
        $Nganh = $_POST['Nganh'];
        $GioiTinh = $_POST['GioiTinh'];
        $LopHP = $_POST['LopHP'];

        if(KiemTra($MSSV) || KiemTra($HoTen) || KiemTra($Lop) || KiemTra($SDT) || KiemTra($Khoa) || KiemTra($Nganh))
        {
          echo"<script> location.replace('../AddSV.php')</script>";
        }
        else
        {
            if($MSSV && $HoTen && $NgaySinh && $Lop && $SDT && $Khoa && $Nganh && $GioiTinh)
            {
                // Kiểm tra sinh viên đã có trong danh sách
                $SinhVien = $conn -> query("SELECT * FROM sinhvien sv chitiet mh 
                                            WHERE ct.MSSV = sv.MSSV AND sv.MSSV = '$MSSV' AND ct.MSSV = '$MSSV'");
                if(mysqli_num_rows($SinhVien) > 0)
                {
                    
                    echo"<script> alert('Sinh viên này đã tồn tại trong danh sách')</script>"; 
                    echo"<script> location.replace('../AddSV.php')</script>";
                }
                else
                {
                    // INSERT bảng taikhoan với TenTaiKhoan là mssv và mật khẩu là 111 và vai trò là sinh viên
                    $conn -> query("INSERT INTO `taikhoan`(`TenTaiKhoan`, `MatKhau`, `VaiTro`) VALUES('$MSSV', '1111', 'SinhVien')");
                    // INSERT bảng sinhvien
                    $conn ->query("INSERT INTO `sinhvien`(`MSSV`, `HoVaTen`, `NgaySinh`, `Lop`, `SDT`, `GioiTinh`, `TrangThai`, `Khoa`, `Nganh`) 
                            VALUES('$MSSV', '$HoTen', '$NgaySinh', '$Lop', '$SDT', '$GioiTinh', true , '$Khoa', '$Nganh')");
                    $conn ->query("INSERT INTO `chitietmh`(`MaLopHP`, `MSSV`, `DiemGK`, `DiemCK`, `DIemTB`) 
                                   VALUES ('$LopHP','$MSSV', null , null ,null)");      
                    echo"<script> alert('Đã thêm thành công')</script>";
                    echo"<script> location.replace('../DanhSachSV.php')</script>";
                }
            }
            
            else
            {
                echo"<script> alert('Thông tin của bạn đang bị bỏ trống. Vui lòng kiểm tra lại')</script>"; 
                echo"<script> location.replace('../AddSV.php')</script>";
            }
        }
    }

      // Sự kiện khi ấn nút sửa
      if(isset($_GET['sua']))
      {
          $MaSV = $_GET['sua'];
          $update = true;
          $result = $conn->query("SELECT * FROM sinhvien WHERE MSSV = '$MaSV'") or die($conn->error);

      }
      // HIển thị sửa
      if(isset($_POST['Luu']))
      {
          $G_MSSV = $_POST['MSSV']; 
          $G_TrangThai = $_POST['TrangThai'];
          
          $conn -> query("UPDATE sinhvien SET TrangThai = $G_TrangThai WHERE MSSV = '$G_MSSV'");
          echo"<script> location.replace('../DanhSachSV.php')</script>";
      }
      
?>