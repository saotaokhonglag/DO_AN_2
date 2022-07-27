<?php
header('Content-Type: text/html; charset=utf-8');

$conn = mysqli_connect("localhost", "root", "", "dbdoan2") or die("Không thể kết nối CSDL");
$conn->set_charset('utf8');
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
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
<?php require_once 'php/SinhVien.php' ?>
    <div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Admin.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Admin</div>
        </a>
           <!-- Menu thông tin -->
           <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Thông tin</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Giảng viên:</h6>
                     <a class="collapse-item" href="DanhSachGV.php">Thông tin giảng viên</a>
                     <a class="collapse-item" href="TaiKhoanGV.php">Tài khoản giảng viên</a>                 
                    <h6 class="collapse-header">Sinh viên:</h6>
                     <a class="collapse-item" href="DanhSachSV.php">Thông tin sinh viên</a>
                     <a class="collapse-item" href="TaiKhoanSV.php">Tài khoản sinh viên</a> 
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Danh sách:</h6>
                    <a class="collapse-item" href="DanhSachLH.php" >Danh sách lớp học</a>
                </div>            
            </div>
        </li>

        <!-- Phân môn học -->
        <li class="nav-item">
            <a class="nav-link" href="PhanMonHoc.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Phân môn học</span></a>
        </li>
        <!-- Danh sách yêu cầu-->
        <li class="nav-item">
        <a class="nav-link" href="DanhSachYC.php">
        <i class="fas fa-fw fa-list"></i>
        <span>Danh sách yêu cầu</span></a>
        </li>
        <!-- Thống kê học lực -->
        <li class="nav-item">
            <a class="nav-link" href="ThongKe.php">
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
                            aria-label="Search" aria-describedby="basic-addon2">
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
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Xin chào Admin</span>
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
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách sinh viên</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
    <!-- Khi chưa ấn nút sửa -->
                <?php if($update == false): ?>
                    <table class="table table-bordered" style = "text-align: center;" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                                <th>STT</th>
                                <th>MSSV</th>
                                <th>Họ và tên</th>
                                <th>Ngày sinh</th>
                                <th>Lớp</th>
                                <th>Giới tính</th>
                                <th>Ngành</th>
                                <th>Trạng thái</th>
                                <th> </th>
                            </tr>
                        <?php        
                            $sql = "SELECT * FROM sinhvien";
                            $result = $conn -> query ($sql) ;
                            $conn->close();
                            //  Bắt đầu vòng lặp
                            $STT = 1;
                            while($row = $result ->fetch_assoc()): ?> 
                            <tbody id = "myTable" style = "text-align: center;">
                            <tr>
                                <td><?php echo $STT++;?> </td>
                                <td><?php echo $row['MSSV'];?> </td>
                                <td><?php echo $row['HoVaTen'];?> </td>
                                <td>
                                <?php 
                                    $NgayLapPN = $row['NgaySinh'];
                                //  Thay đổi format ngày lập 
                                    $newDate = date("d/m/Y", strtotime($NgayLapPN));
                                    echo $newDate;
                                ?> 
                            </td>
                                <td><?php echo $row['Lop'];?> </td>
                                <td>
                                    <?php 
                                    $GT = $row['GioiTinh'];
                                    if($GT == true)
                                    {
                                        echo 'Nữ';
                                    }
                                    else
                                    {
                                        echo 'Nam';
                                    }
                                    ?> 
                                </td>
                                <td><?php echo $row['Nganh'];?> </td>
                                <td>
                                    <?php 
                                    $TrangThai = $row['TrangThai'];
                                    if($TrangThai == 1)
                                    {
                                        echo 'Đang học';
                                    }
                                    else
                                    {
                                        echo "<span style='color:red;text-align:center;'> Đã nghỉ </span>";
                                    }
                                    ?> 
                                </td>
                                <td> <a class='btn btn-info btn-sm' href='DanhSachSV.php?sua=<?php echo $row['MSSV']; ?>'> <i class='fas fa-pencil-alt'> </i> Sửa </a> </td>
                            </tr>
                            </tbody>
                        <?php endwhile; ?>                   
                </table>
    <!-- Khi đã ấn nút sửa -->
                    <?php else: ?>
                       <form method="POST" action ="php/SinhVien.php">
                            <table  class="table table-bordered" style = "text-align: center;" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                    <th>STT</th>
                                    <th>MSSV</th>
                                    <th>Họ và tên</th>
                                    <th>Ngày sinh</th>
                                    <th>Lớp</th>
                                    <th>Giới tính</th>
                                    <th>Ngành</th>
                                    <th>Trạng thái</th>
                                </tr>
                            <?php        
                                $sql = "SELECT * FROM sinhvien WHERE MSSV = '$MaSV'";
                                $result = $conn -> query ($sql) ;
                                $conn->close();
                                //  Bắt đầu vòng lặp
                                $STT = 1;
                                while($row = $result ->fetch_assoc()): ?> 
                                <tbody id = "myTable" style = "text-align: center;">
                                <tr>
                                    <td><?php echo $STT++;?> </td>
                                    <td> <input type = "hidden" name = "MSSV" value = "<?php echo $MaSV; ?>"> <?php echo $MaSV?> </td>
                                    <td><?php echo $row['HoVaTen'];?> </td>
                                    <td>
                                    <?php 
                                        $NgayLapPN = $row['NgaySinh'];
                                    //  Thay đổi format ngày lập 
                                        $newDate = date("d/m/Y", strtotime($NgayLapPN));
                                        echo $newDate;
                                    ?> 
                                </td>
                                    <td><?php echo $row['Lop'];?> </td>
                                    <td>
                                        <?php 
                                        $GT = $row['GioiTinh'];
                                        if($GT == true)
                                        {
                                            echo 'Nữ';
                                        }
                                        else
                                        {
                                            echo 'Nam';
                                        }
                                        ?> 
                                    </td>
                                    <td><?php echo $row['Nganh'];?> </td>
                    <!-- Thông tin cần chỉnh sửa -->
                                    <td>
                                        <select name= "TrangThai" class="form-select">
                                            <option value= "1"> Đang học </option> 
                                            <option value= "0"> Đã nghỉ </option>                       
                                        </select>
                                    </td>
                                </tr>
                                </tbody>
                            <?php endwhile; ?>                                 
                        </table>
                        <input type = "submit" name = "Luu" class='btn btn-info btn-sm' value = "Lưu" >
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div style = "text-align: center;">
          <a href="AddSV.php"><input type="button" value="Thêm sinh viên"  style="height: auto; width: auto;" class = "btn btn-primary"/></a>
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