<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
$conn = mysqli_connect("localhost", "root", "", "dbdoan2") or die("Không thể kết nối CSDL");
$conn->set_charset('utf8');

$username = $_SESSION['TenTaiKhoan'];
$sql = $conn -> query("SELECT * FROM taikhoan WHERE TenTaiKhoan = '$username'");
if(mysqli_num_rows($sql)>0)
{
        if(isset($_POST['CapNhat']))
        {
            $MatKhauMoi = $_POST['MatKhau'];
            $XacNhan = $_POST['MatKhauMoi'];
            if($MatKhauMoi && $XacNhan)
            {
                if($XacNhan == $MatKhauMoi)
                {
                    $conn -> query("UPDATE taikhoan SET MatKhau = '$XacNhan' WHERE TenTaiKhoan = '$username'");
                    echo"<script> alert('Đổi mật khẩu thành công')</script>";
                    echo"<script> location.replace('../DoiMK.php')</script>";
                }
                else
                {
                    echo"<script> alert('Mật khẩu xác nhận không trùng khớp')</script>";
                    echo"<script> location.replace('../DoiMK.php')</script>";
                }
            }
            else
            {
                echo"<script> alert('Bạn chưa nhập mật khẩu hoặc mật khẩu xác nhận')</script>";
                echo"<script> location.replace('../DoiMK.php')</script>";
            }
        }
}
?>