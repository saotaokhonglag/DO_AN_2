<?php
    header('Content-Type: text/html; charset=utf-8');
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbdoan2";

    $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Không thể kết nối CSDL");
    $conn->set_charset('utf8');

     $Malop ='';
     $Tenlop ='';
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
         $Malop = $_POST['malop'];
         $Tenlop = $_POST['tenlop'];
         if(KiemTra($Malop) || KiemTra($Tenlop))
         {
           echo"<script> location.replace('../DanhSachLH.php')</script>";
         }
         else
         {
             if($Malop && $Tenlop)
             {
                 $sql = "INSERT INTO `lophp` (`MaLopHP`,`TenLop`) VALUES ('$Malop','$Tenlop')";
                 $query1 = mysqli_query($conn,$sql);      
                 echo"<script> alert('Đã thêm thành công')</script>";
                 echo"<script> location.replace('../DanhSachLH.php')</script>";
             }
             
             else
             {
                 echo"<script> alert('Thông tin của bạn đang bị bỏ trống. Vui lòng kiểm tra lại')</script>"; 
                 echo"<script> location.replace('../DanhSachLH.php')</script>";
             }
         }
     }
     if(isset($_GET['sua']))
     {
         $ID = $_GET['sua'];
         $update = true;
         $result = $conn->query("SELECT * FROM lophp WHERE MaLopHP = '$ID'") or die($conn->error);

         if(mysqli_num_rows($result) > 0)
         {
             $row = $result->fetch_array();
             $Malop = $row['MaLopHP'];
             $Tenlop = $row['TenLop'];   
         }
     }
     if(isset($_POST['sua']))
  {
    $ED_Malop = $_POST['malop'];
    $ED_Tenlop = $_POST['tenlop'];

    // Khi thông tin không bị bỏ trống
       if($ED_Malop && $ED_Tenlop)
       {   
        if(KiemTra($ED_Malop) || KiemTra($ED_Tenlop))
        {
          echo"<script> location.replace('../LopHP.php')</script>";
        }
        else 
        {
               $conn -> query("UPDATE `lophp` SET `TenLop` = '$ED_Tenlop'
                               WHERE `MaLopHP` = '$ED_Malop'");
                echo "<script> alert ('Đã cập nhật thông tin') </script>";
                echo"<script> location.replace('../DanhSachLH.php')</script>";     
       }  
      }
       else
       {
          echo "<script> alert ('Thất bại. Vui lòng kiểm tra lại thông tin') </script>";
          echo"<script> location.replace('../DanhSachLH.php')</script>";
       }   
  }
?>