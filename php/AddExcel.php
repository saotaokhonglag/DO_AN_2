<?php
// Thêm Slected để chọn cách thêm sinh viên
   $conn = mysqli_connect("localhost", "root", "", "dbdoan2") or die("Không thể kết nối CSDL");
   $conn->set_charset('utf8'); 

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
        require('../Classes/PHPExcel.php');

        if(isset($_POST['btngui']))
        {
            $file = $_FILES['file']['tmp_name'];
            $objReader = PHPExcel_IOFactory::createReaderForFile($file);
            $objReader->setLoadSheetsOnly('HTTT0118');

            $objExcel = $objReader->load($file);
            $sheetData = $objExcel->getActiveSheet()->toArray('null', true, true, true);
            $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();
            for($row = 2; $row<=$highestRow;$row++){
                $mssv = $sheetData[$row]['A'];
                $ten = $sheetData[$row]['B'];
                $ngaysinh = $sheetData[$row]['C'];
                $lop = $sheetData[$row]['D'];
                $sdt = $sheetData[$row]['E'];
                $gioitinh = $sheetData[$row]['F'];
                $trangthai = $sheetData[$row]['G'];
                $khoa = $sheetData[$row]['H'];
                $nganh = $sheetData[$row]['I'];
                $LopHP = $_POST['LopHP'];

                // Kiểm tra sinh viên có tồn tại trong danh sách chưa
                $SinhVien = $conn -> query("SELECT * FROM sinhvien sv chitiet mh 
                WHERE ct.MSSV = sv.MSSV AND sv.MSSV = '$mssv' AND ct.MSSV = '$mssv'");
                if(mysqli_num_rows($SinhVien) == 0)
                {        
                    // INSERT bảng taikhoan với TenTaiKhoan là mssv và mật khẩu là 111 và vai trò là sinh viên
                    $conn -> query("INSERT INTO `taikhoan`(`TenTaiKhoan`, `MatKhau`, `VaiTro`) 
                    VALUES('$mssv', '1111', 'SinhVien')");
                    $conn ->query("INSERT INTO `sinhvien`(`MSSV`, `HoVaTen`, `NgaySinh`, `Lop`, `SDT`, `GioiTinh`, `TrangThai`, `Khoa`, `Nganh`) 
                    VALUES('$mssv', '$ten', '$ngaysinh', '$lop', '$sdt', $gioitinh, true , '$khoa', '$nganh')");
                    $conn ->query("INSERT INTO `chitietmh`(`MaLopHP`, `MSSV`, `DiemGK`, `DiemCK`, `DIemTB`) 
                    VALUES ('$LopHP','$mssv', null , null ,null)"); 
                }
                else{
                    echo"<script> alert('Có một hoặc nhiều sinh viên đã tồn tại')</script>";
                    echo"<script> locatison.replace('../AddSV.php')</script>";
                }
            }
            echo"<script> alert('Thêm thành công')</script>";
            echo"<script> location.replace('../DanhSachSV.php')</script>";
        }
?>