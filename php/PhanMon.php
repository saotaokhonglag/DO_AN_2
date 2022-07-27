<?php
    header('Content-Type: text/html; charset=utf-8');
    $conn = mysqli_connect("localhost", "root", "", "dbdoan2") or die("Không thể kết nối CSDL");
    $conn->set_charset('utf8');
    
    $MaPC = '';
    $MaHP = '';
    $MaGv = '';
    $HK = '';
    $NH = '';

    
    $update = false;
     // Hàm check kí tự đặc biệt
     function KiemTra($my_string)
     {
         $KiTu = preg_match('/[@_!#$%^&*()<>?|}{~:a-zA-Z]/i', $my_string);
         if($KiTu){
         print ("<script> alert ('Thông tin có chứa kí tự đặc biệt hoặc không hợp lệ. Vui lòng thử lại') </script>");
         return $my_string;
                 }
     }

    if(isset($_POST['Them']))
    {
        $GiangVien = $_POST['GiangVien'];
        $MonHoc = $_POST['MonHoc'];
        $HocKi = $_POST['HocKi'];
        $NamHoc = $_POST['NamHoc'];
        if(KiemTra($NamHoc))
        {
            echo"<script> location.replace('../PhanCongGV.php')</script>";
        }
        else
        {
            if($GiangVien && $MonHoc && $HocKi && $NamHoc)
            {
                $conn -> query("INSERT INTO phancong(MaGV, MaLopHP, HocKi, NamHoc) 
                                VALUES ('$GiangVien','$MonHoc','$HocKi','$NamHoc')");
                echo"<script> alert('Đã Phân môn thành công')</script>";
                echo"<script> location.replace('../PhanMonHoc.php')</script>";
            }
            else
            {
                echo"<script> alert('Thông tin không được bỏ trống. Vui lòng thử lại')</script>";
                echo"<script> location.replace('../PhanCongGV.php')</script>";
            }
        }
    }
// Sự kiện nút sửa
    if(isset($_GET['edit']))
    {
        $MaHP = $_GET['edit'];
        $update = true;
        $result = $conn->query("SELECT * FROM phancong WHERE MaLopHP = '$MaHP'") or die($conn->error);

        if(mysqli_num_rows($result) > 0)
        {
            $row = $result->fetch_array();
            $MaPC = $row['MaPC'];
            $MaGv = $row['MaGV'];
            $HK = $row['HocKi'];
            $NH = $row['NamHoc'];
        }
    }
// Xử lý nút sửa
    if(isset($_POST['Sua']))
    {
        $ED_PC = $_POST['MaPC'];
        $ED_GV = $_POST['GiangVien'];
        $ED_MH = $_POST['MonHoc'];
        $ED_HK = $_POST['HocKi'];
        $ED_NH = $_POST['NamHoc'];

        $conn -> query("UPDATE `phancong` SET `MaGV`='$ED_GV', `MaLopHP` = '$ED_MH', `HocKi`='$ED_HK',`NamHoc`='$ED_NH' WHERE MaPC = '$ED_PC' ");
        echo"<script> alert('Cập nhật thành công')</script>";
        echo"<script> location.replace('../PhanMonHoc.php')</script>";

    }
?>