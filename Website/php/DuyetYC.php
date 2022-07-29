<?php
header('Content-Type: text/html; charset=utf-8');

$conn = mysqli_connect("localhost", "root", "", "dbdoan2") or die("Không thể kết nối CSDL");
$conn->set_charset('utf8');

if(isset($_POST['Duyet']))
{
    $YC = $_POST['YC'];

    $conn -> query("UPDATE dsyeucau SET TrangThaiYC = 1 WHERE MaYC = '$YC'");
    echo"<script> location.replace('../DanhSachYC.php')</script>";
}
?>