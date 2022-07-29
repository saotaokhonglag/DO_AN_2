<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "dbdoan2") or die("Không thể kết nối CSDL");
$conn->set_charset('utf8');
$Seleted = false;
$MaLopHP = '';
$CuoiKi = '';
$MSSV = '';

$username = $_SESSION['TenTaiKhoan'];
$GV = $conn -> query("SELECT * FROM giangvien WHERE MaGV = '$username'");
$row = $GV->fetch_assoc();
$HoTen = $row['TenGV'];

if(isset($_POST['Chon']))
{
    $Seleted = true;
    $MaLopHP = $_POST['LopHP'];
    $HK = $_POST['HocKi'];
    $NH = $_POST['NamHoc'];
    
// Hiển thị danh sách
    $sql = $conn -> query("SELECT ct.MSSV, sv.HoVaTen, sv.Lop, ct.DiemCK, ct.DiemGK, lh.TenLop, yc.TrangThaiYC, yc.MaYC
                            FROM giangvien gv, chitietmh ct, sinhvien sv, phancong pc, lophp lh
                            WHERE gv.MaGV = pc.MaGV AND 
                                lh.MaLopHP = pc.MaLopHP AND
                                ct.MaLopHP = lh.MaLopHP AND
                                ct.MSSV = sv.MSSV AND
                                pc.MaGV = '$username' AND ct.MaLopHP =  '$MaLopHP' AND
                                pc.NamHoc = '$NH' AND pc.HocKi = '$HK'"); 
} 
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điểm giữa kì học phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!--ajax nút tìm kiếm-->

    <!--Nút tìm kiếm-->
    <script>
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
        </script>
</head>
<body id="page-top">
    <div id="wrapper">

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="PageGV.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Giảng viên</div>
        </a>
            <!-- Menu thông tin -->
        <!-- Nhập điểm -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-caret-square-right"></i>
                <span>Nhập điểm</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="DiemGK.php">Giữa kì</a>
                    <a class="collapse-item" href="DiemCK.php">Cuối kì</a>      
                    <a class="collapse-item" href="DiemTB.php">Trung bình</a>              
                </div>            
            </div>
        </li>
        <!-- yêu cầu-->
        <li class="nav-item">
        <a class="nav-link" href="NoiDungYC.php">
        <i class="fas fa-fw fa-list"></i>
        <span>Yêu cầu</span></a>
        </li>
        <!-- Thống kê học lực -->
        <li class="nav-item">
            <a class="nav-link" href="ThongkeHL.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Thống kê học lực</span>                
            </a>
        </li>
        <!-- Dải phân cách -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Thu gọn SideBar -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <form
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input id="myInput" type="text" class="form-control bg-light border-0 small" placeholder="Tìm kiếm..."
                            aria-label="Search" aria-describedby="basic-addon2" style="border: 1px solid;">
                    </div>
                </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Thông tin giao diện người dùng -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Xin chào <?php echo $HoTen;?> </span>
                            <img class="img-profile rounded-circle"
                                src="img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="DoiMK.php">
                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                Đổi mật khẩu
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Đăng xuất
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc muốn đăng xuất ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Hãy chọn "Đăng xuất" nếu như bạn đã sẵn sàng để thoát khỏi trang này.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy bỏ</button>
                    <a class="btn btn-primary" href="index.php">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>

<!-- Bắt đầu phần nội dung -->

 <!-- Combobox điểm -->
<form class="user" method="POST" action ="DiemGK.php">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <?php
                    $CbGV = $conn -> query("SELECT lh.MaLopHP, lh.TenLop
                                            FROM giangvien gv, phancong pc, lophp lh
                                            WHERE gv.MaGV = pc.MaGV AND 
                                                  lh.MaLopHP = pc.MaLopHP AND
                                                  gv.MaGV = '$username'" );
        ?>
          <label style = "font-weight: bold; margin-left: 40px;"> Chọn lớp học phần để xem điểm giữa kì:</label>
                <div class="col-sm-6 mb-3 mb-sm-3" style="margin-bottom: 5px;">
                    <select id="GV" name="LopHP" class="form-select" style="margin-left: 14px; width: 310px;">
                        <?php
                            
                            while($row = $CbGV -> fetch_assoc())
                            {
                                $MaHP = $row['MaLopHP'];
                                $TenLop= $row['TenLop'];
                                echo "<option value='$MaHP'> $TenLop </option>";                                
                            } 
                        ?>
                    </select>
                </div>
                <div class="col-sm-6 mb-4 mb-sm-1" style="margin-bottom: 5px;">
                    <label style = "font-weight: bold; margin-left: 20px;">Học kì</label>
                    <input type = "number" name = "HocKi" min = "1" max = "3" style="width: 60px;">

                    <label style = "font-weight: bold; margin-left: 13px;">Năm học</label>
                    <input type = "text" name = "NamHoc" style = "width: 105px;">

                 </div>

                 <div class="col-sm-6 mb-3 mb-sm-2" style="margin-bottom: 5px; margin-left: 140px;">
                    <input type = "submit" class='btn btn-primary' name ="Chon" value = "Chọn">
                 
                 </div>
        <?php if($Seleted == true):?>
            <div class="container-fluid">
                <!-- DataTales Example -->
                <div class="card-header py-3" style = "text-align: center;" >
                    <h5 class="m-0 font-weight-bold text-primary">Điểm giữa kì lớp học phần <?php echo $MaLopHP; ?> </h5>
                    <h7 class="m-0 font-weight-bold text-primary"> Học kì: <?php echo $HK ;?> </h7> </br>
                    <h7 class="m-0 font-weight-bold text-primary"> Năm học: <?php echo $NH;?> </h7>     
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" style = "text-align: center;" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                    <th>STT</th>
                                    <th>Mã số sinh viên</th>
                                    <th>Họ và tên</th>
                                    <th>Lớp</th>
                                    <th>Điểm giữa kì</th>    
                                    <th> Điểm 4.0 </th> 
                                    <th> </th>
                            </tr>
                            <?php
                                    $STT = 1;
                                //  Bắt đầu vòng lặp
                                while($rows = $sql -> fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $STT++;?> </td>
                                    <td><input type = "hidden" name = "MaSV[]" value = "<?php echo $rows['MSSV'];?>"> <?php echo $rows['MSSV'];?> </td>
                                    <td><?php echo $rows['HoVaTen']; ?></td>
                                    <td><?php echo $rows['Lop'];?></td>
                                    <td>
                                        <input type = "hidden" name = "YC" value = "<?php echo $rows['MaYC'];?>">
                                        <?php if($rows['TrangThaiYC'] == 1):?>
                                        <input type = "number" name = "GiuaKi[]" value = "<?php echo $rows['DiemGK'];?>" min = '0.0' max= '10.0' style = 'width: 55px;'>
                                        <?php else: ?>
                                            <input type = "number" name = "GiuaKi[]" value = "<?php echo $rows['DiemGK'];?>" <?php if($rows['DiemGK'] == null){echo 'readonly';} ?> min = '0.0' max= '10.0' style = 'width: 55px;'>
                                     </td>
                                    <?php endif; ?> 
                                    <td>
                                        <input type = "hidden" name = "CuoiKi[]" value = "<?php echo $rows['DiemCK'];?>">
                                        <?php  
                                            
                                            $DiemGK = $rows['DiemGK'] * 0.4;
                                            echo $DiemGK;
                                        ?>
                                        <input type = "hidden" name = "MaLHP[]" value = "<?php echo $MaLopHP;?>">  
                                    </td>
                                    <td> 
                                        <a class='btn btn-info btn-sm' href=''> <i class='fas fa-edit'> </i> Cập nhật </a>
                                    </td>
                                </tr>
                            <?php endwhile?>           
                        </table>
                    </div>
                </div>
            </div>
            <input type = "submit" class='btn btn-primary' name ="Luu" value = "Lưu" style = " margin-left:45px">
        <?php endif; ?>
        </div>
    </div>
</from>       
    </div>
</div>
<?php
// Nút lưu
   if(isset($_POST['Luu']))
   {       
           $YC = $_POST['YC'];
           $MSSV = $_POST['MaSV'];
           $MaLHP = $_POST['MaLHP'];
           $GiuaKi = $_POST['GiuaKi'];
           $CuoiKi = $_POST['CuoiKi'];
           $length = count($MSSV);
        for($i = 0; $i < $length; $i++)
        {
            $a_MSSV = $MSSV[$i];
            $a_Diem = $GiuaKi[$i];
            $a_DiemTB = $GiuaKi[$i] * 0.4 + $CuoiKi[$i] * 0.6;
            $a_LopHP = $MaLHP[$i];
            $conn ->query("UPDATE chitietmh SET DiemGK='$a_Diem', DIemTB = '$a_DiemTB' WHERE MSSV = '$a_MSSV' AND MaLopHP = '$a_LopHP'");                
        }
         echo"<script> alert('Lưu điểm thành công')</script>";  
         $conn -> query("UPDATE dsyeucau SET TrangThaiYC = 0 WHERE MaYC = '$YC'");
                                    
   }  
   
   if(isset($_POST['GuiYC']))
   {      
        $to_email = "thaingocro123@gmail.com";
        $subject = "Yêu cầu chỉnh sửa điểm cuối kì";
        $body ="Giảng viên đã gửi yêu cầu chỉnh sửa điểm cuối kì. Hãy kiểm tra danh sách yêu cầu để phê duyệt.";
        $headers = "From: thaingocro123@gmail.com";
        if(mail($to_email, $subject, $body, $headers))
        {
            $HP = $_POST['LopHP'];
            $NgayYC = date("Y-m-d");
            // Thêm vào bảng yêu cầu với trạng thái ban đầu là false
            $conn -> query("INSERT INTO dsyeucau(MaLopHP, MaGV, NoiDung, TrangThaiYC, NgayYC) VALUES ('$HP', '$username', 'Chỉnh sửa điểm giữa kì' , '0' , '$NgayYC')");
            echo"<script> alert('Gửi email thành công đến $to_email....')</script>";
        }
        else
          {
            echo"<script> alert('Gửi email thất bại')</script>";
          }
    }    
?>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>
</html>  