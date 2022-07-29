<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
$conn = mysqli_connect("localhost", "root", "", "dbdoan2") or die("Không thể kết nối CSDL");
$conn->set_charset('utf8');
$update = false;
$username = $_SESSION['TenTaiKhoan'];
$sql = $conn -> query("SELECT * FROM sinhvien WHERE MSSV = '$username'");
if(mysqli_num_rows($sql)>0)
{
  // Lấy thông tin sinh viên
    $row = $sql->fetch_assoc();
    $HoTen = $row['HoVaTen'];  
    $NgaySinh = $row['NgaySinh'];
    $Lop = $row['Lop'];
    $SDT = $row['SDT'];
    $GioiTinh = $row['GioiTinh'];
    $TrangThai = $row['TrangThai'];
    $Khoa = $row['Khoa'];
    $Nganh = $row['Nganh'];
}
if(isset($_POST['CapNhat']))
{
    $update = true;
}
if(isset($_POST['Sua']))
{
    $HoTen =  $_POST['HoTen'];
    $NgaySinh = $_POST['NgaySinh'];
    $Lop = $_POST['Lop'];
    $SDT = $_POST['SDT'];
    $GioiTinh = $_POST['GioiTinh'];
    $Khoa = $_POST['Khoa'];
    $Nganh = $_POST['Nganh'];
    if(!$HoTen && !$NgaySinh && !$Lop && !$Nganh && !$SDT && !$GioiTinh && !$Khoa)
    {
        echo"<script> alert('Thông tin không được bỏ trống')</script>"; 
    }
    else
    {
        $conn -> query("UPDATE sinhvien 
                        SET HoVaTen ='$HoTen',NgaySinh ='$NgaySinh', Lop ='$Lop',SDT ='$SDT',GioiTinh =$GioiTinh,Khoa ='$Khoa',Nganh='$Nganh' WHERE MSSV = '$username'");
        echo"<script> alert('Cập nhật thành công')</script>";               
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin sinh viên</title>
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
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="PageSV.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Sinh viên</div>
        </a>
            <!-- Menu thông tin -->
        <!-- Nhập điểm -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-caret-square-right"></i>
                <span>Thông tin điểm</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="SV_Diem.php">Kết quả học tập</a>           
                </div>            
            </div>
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
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Xin chào <?php echo $HoTen; ?></span>
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
     <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" style = "text-align: center;">
                <h5 class="m-0 font-weight-bold text-primary">THÔNG TIN SINH VIÊN</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <form method="POST" action ="PageSV.php">
                    <table class="table table-bordered" style = "text-align: center;" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                                <th>Mã số sinh viên</th>
                                <th>Họ và tên</th>
                                <th>Giới tính</th> 
                                <th>Ngày sinh </th>
                                <th>Số điện thoại </th>
                                <th>Lớp</th>
                                <th>Ngành</th>  
                                <th>Trạng thái</th> 
                                <th> </th>     
                        </tr>   
                         <tr>
                            <th> <?php echo $username; ?></th>
                            <th><?php echo $HoTen; ?></th>
                            <th> <?php  
                                    if($GioiTinh == true)
                                    {
                                        echo 'Nữ';
                                    }
                                    else
                                    {
                                        echo 'Nam';
                                    } 
                                ?>
                            </th>
                            <th><?php 
                                        $newDate = date("d/m/Y", strtotime($NgaySinh));
                                        echo $newDate;
                                ?> </th>
                            <th><?php echo $SDT; ?></th>
                            <th><?php echo $Lop; ?></th>
                            <th><?php echo $Nganh; ?></th>
                            <th> 
                                <?php if($TrangThai == true)
                                    {
                                        echo 'Đang học';
                                    } 
                                ?>
                            </th>
                            <th><input type = "submit" name = "CapNhat" class = "btn btn-primary" value = "Cập nhật"></th>             
                         </tr>           
                    </table>
                </form>
                </div>
            </div>
            <?php if($update == true):?>
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary" style = "text-align: center;">CẬP NHẬT THÔNG TIN</h5>
            </div>
            <div class="card-body">
                <form class="user" method="POST" action ="PageSV.php">
                    <div class="form-group row">
                        <div class="col-sm-6" style="margin-bottom: 5px;">  
                            <input type="text" class="form-control form-control-user" value = "<?php echo $HoTen; ?>"
                                placeholder="Họ và Tên" name="HoTen">
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 5px;">  
                            <input type="date" class="form-control form-control-user" value = "<?php echo $NgaySinh; ?>"
                                placeholder="Ngày sinh" name="NgaySinh">
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 5px;">  
                            <input type="text" class="form-control form-control-user" value = "<?php echo $Lop; ?>"
                                placeholder="Lớp" name="Lop">
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 5px;">  
                            <input type="text" class="form-control form-control-user" value = "<?php echo $SDT; ?>"
                                placeholder="Số điện thoại" name="SDT">
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 5px;">  
                            <input type="text" class="form-control form-control-user" value = "<?php echo $Khoa; ?>"
                                placeholder="Khoa" name="Khoa">
                        </div>
                        <div class="col-sm-6" style="margin-bottom: 5px;">  
                            <input type="text" class="form-control form-control-user" value = "<?php echo $Nganh; ?>"
                                placeholder="Ngành" name="Nganh">
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0" style="margin-bottom: 5px; width: 280px;">
                            <select name="GioiTinh" class="form-select" style = "border-radius: 15px;" value = <?php echo $GioiTinh ?>>
                                    <option> ------- Giới tính ------- </option>   
                                    <option value = "0">Nam</option> 
                                    <option value = "1">Nữ</option> 
                            </select>
                        </div>   
                    </div>
                    <div style = "text-align: center;">
                        <input type="submit" value="Cập nhật" name="Sua" class = "btn btn-primary">
                    </div>  
            </form>
           </div>
           <?php endif; ?>
        </div>
    </div>
    <!-- Kết thúc phần nội dung -->
    </div>
    
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


