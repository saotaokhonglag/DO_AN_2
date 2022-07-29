
<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "dbdoan2") or die("Không thể kết nối CSDL");
$update = false;
$TenTaiKhoan='';
$MatKhau= '';
$VaiTro= '';

// Nút sửa
if(isset($_GET['Sua']))
{   
   $update = true;
   $TenTaiKhoan = $_GET['Sua'];
   $result = $conn->query("SELECT * FROM sinhvien WHERE MSSV='$TenTaiKhoan'");
   if(mysqli_num_rows($result)>0){
       
        $row = $result->fetch_array();
        if($row['TrangThai'] == true)
        {
            $conn->query("UPDATE taikhoan SET MatKhau = '1111' WHERE  TenTaiKhoan = '$TenTaiKhoan' AND VaiTro = 'SinhVien'") or die($conn->error);
            echo"<script> alert('Đã cập nhật lại mật khẩu mặc định. (Mật khẩu là 1111)')</script>";
        }
        else
        {
            echo"<script> alert('Không thể cập nhật lại tài khoản này do sinh viên đã ngừng học.')</script>";
        }

   }
}
//  //Xử lý nút xóa
//  if(isset($_GET['Xoa']))
//  {
//      $DN = $_GET['Xoa'];
//      $conn ->query("DELETE FROM `taikhoan` WHERE TenTaiKhoan = '$DN'"); 
//      echo"<script> alert('Xóa thành công')</script>";
//      echo"<script> location.replace('../TaiKhoanSV.php')</script>";
//  }

?>