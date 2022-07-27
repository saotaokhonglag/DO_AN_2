<!-- Xử lý nút thêm -->
<?php
    header('Content-Type: text/html; charset=utf-8');
    $conn = mysqli_connect("localhost", "root", "", "dbdoan2") or die("Không thể kết nối CSDL");
    $conn->set_charset('utf8');
    
    $tk = '';
    $mk= '';    
    $update = false;
    // Nút sửa
        if(isset($_GET['Sua']))
        {
            $TaiKhoan = $_GET['Sua'];
            $update = true;
            $result = $conn->query("SELECT * FROM taikhoan WHERE TenTaiKhoan = '$TaiKhoan'") or die($conn->error);

            if(mysqli_num_rows($result) > 0)
            {
                $row = $result->fetch_array();
        
                $tk = $row['TenTaiKhoan'];
                $mk = $row['MatKhau'];   
                
            }
        }
// Xử lý nút sửa
        if(isset($_GET['Sua']))
        {
                $TenTaiKhoan = $_GET['Sua'];
                $conn->query("UPDATE taikhoan SET MatKhau = '1111' WHERE  TenTaiKhoan = '$TenTaiKhoan'") or die($conn->error);
                echo"<script> alert('Đã cập nhật lại mật khẩu mặc định. (Mật khẩu là 1111)')</script>";
        }

     //Xử lý nút xóa
        if(isset($_GET['Xoa']))
        {
            $DN = $_GET['Xoa'];
            $conn ->query("DELETE FROM `taikhoan` WHERE TenTaiKhoan = '$DN'"); 
            echo"<script> alert('Xóa thành công')</script>";
            echo"<script> location.replace('../TaiKhoanGV.php')</script>";
        }
?>