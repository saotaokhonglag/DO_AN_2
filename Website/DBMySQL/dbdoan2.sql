-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 30, 2021 lúc 07:59 PM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dbdoan2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietmh`
--

CREATE TABLE `chitietmh` (
  `MaCT_HP` int(11) NOT NULL,
  `MaLopHP` varchar(10) NOT NULL,
  `MSSV` varchar(10) NOT NULL,
  `DiemGK` float DEFAULT NULL,
  `DiemCK` float DEFAULT NULL,
  `DIemTB` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `chitietmh`
--

INSERT INTO `chitietmh` (`MaCT_HP`, `MaLopHP`, `MSSV`, `DiemGK`, `DiemCK`, `DIemTB`) VALUES
(1, 'ATBMTT', '1800724', NULL, NULL, NULL),
(2, 'ATBMTT', '1800196', NULL, NULL, NULL),
(4, 'ATBMTT', '1800553', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dsyeucau`
--

CREATE TABLE `dsyeucau` (
  `MaYC` int(11) NOT NULL,
  `MaLopHP` varchar(10) NOT NULL,
  `MaGV` varchar(10) NOT NULL,
  `NoiDung` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TrangThaiYC` bit(1) NOT NULL,
  `NgayYC` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `dsyeucau`
--

INSERT INTO `dsyeucau` (`MaYC`, `MaLopHP`, `MaGV`, `NoiDung`, `TrangThaiYC`, `NgayYC`) VALUES
(1, 'ATBMTT', 'GV03', 'Chỉnh sửa điểm cuối kì', b'0', '2021-05-30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giangvien`
--

CREATE TABLE `giangvien` (
  `MaGV` varchar(10) NOT NULL,
  `TenGV` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `giangvien`
--

INSERT INTO `giangvien` (`MaGV`, `TenGV`) VALUES
('GV001', 'Trần Thị Kim Khánh'),
('GV03', 'Nguyễn Văn B');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lophp`
--

CREATE TABLE `lophp` (
  `MaLopHP` varchar(20) NOT NULL,
  `TenLop` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `lophp`
--

INSERT INTO `lophp` (`MaLopHP`, `TenLop`) VALUES
('ATBMTT', 'An toàn bảo mật thông tin'),
('MMT-HTTT0118', 'Mạng máy tính'),
('XML', 'Công nghệ XML 1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phancong`
--

CREATE TABLE `phancong` (
  `MaPC` int(11) NOT NULL,
  `MaGV` varchar(10) NOT NULL,
  `MaLopHP` varchar(20) NOT NULL,
  `HocKi` int(11) NOT NULL,
  `NamHoc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `phancong`
--

INSERT INTO `phancong` (`MaPC`, `MaGV`, `MaLopHP`, `HocKi`, `NamHoc`) VALUES
(5, 'GV03', 'ATBMTT', 1, '2020-2021'),
(10, 'GV001', 'MMT-HTTT0118', 1, '2020-2021');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `MSSV` varchar(10) NOT NULL,
  `HoVaTen` text NOT NULL,
  `NgaySinh` date NOT NULL,
  `Lop` text NOT NULL,
  `SDT` varchar(10) NOT NULL,
  `GioiTinh` bit(1) NOT NULL,
  `TrangThai` bit(1) NOT NULL,
  `Khoa` text NOT NULL,
  `Nganh` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`MSSV`, `HoVaTen`, `NgaySinh`, `Lop`, `SDT`, `GioiTinh`, `TrangThai`, `Khoa`, `Nganh`) VALUES
('1800196', 'Huỳnh Thị Hồng Gấm', '2000-08-07', 'HTTT0118', '0879633253', b'1', b'1', 'Công Nghệ Thông Tin', 'Hệ Thống Thông Tin'),
('1800553', 'Nguyễn Hùng Cường', '2000-10-28', 'HTTT0118', '0328044734', b'0', b'0', 'Công Nghệ Thông Tin', 'Hệ Thống Thông Tin'),
('1800724', 'Nguyễn Dương Thái Ngọc', '2000-10-20', 'HTTT0018', '0855633053', b'0', b'1', 'Công Nghệ Thông Tin', 'Hệ Thống Thông Tin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `TenTaiKhoan` varchar(30) NOT NULL,
  `MatKhau` varchar(30) NOT NULL,
  `VaiTro` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`TenTaiKhoan`, `MatKhau`, `VaiTro`) VALUES
('admin', '123', 'Admin'),
('GV03', '1111', 'GiangVien'),
('GV001', '1111', 'GiangVien'),
('1800724', '1111', 'SinhVien'),
('1800196', '1111', 'SinhVien'),
('1800553', '1111', 'SinhVien');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietmh`
--
ALTER TABLE `chitietmh`
  ADD PRIMARY KEY (`MaCT_HP`),
  ADD KEY `chitietmh_mssv` (`MSSV`),
  ADD KEY `chitietmh_malophp` (`MaLopHP`);

--
-- Chỉ mục cho bảng `dsyeucau`
--
ALTER TABLE `dsyeucau`
  ADD PRIMARY KEY (`MaYC`),
  ADD KEY `dsyeucau_malophp` (`MaLopHP`),
  ADD KEY `dsyeucau_magv` (`MaGV`);

--
-- Chỉ mục cho bảng `giangvien`
--
ALTER TABLE `giangvien`
  ADD PRIMARY KEY (`MaGV`);

--
-- Chỉ mục cho bảng `lophp`
--
ALTER TABLE `lophp`
  ADD PRIMARY KEY (`MaLopHP`);

--
-- Chỉ mục cho bảng `phancong`
--
ALTER TABLE `phancong`
  ADD PRIMARY KEY (`MaPC`),
  ADD KEY `phancong_magv` (`MaGV`),
  ADD KEY `phancong_malophp` (`MaLopHP`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`MSSV`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitietmh`
--
ALTER TABLE `chitietmh`
  MODIFY `MaCT_HP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `dsyeucau`
--
ALTER TABLE `dsyeucau`
  MODIFY `MaYC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `phancong`
--
ALTER TABLE `phancong`
  MODIFY `MaPC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietmh`
--
ALTER TABLE `chitietmh`
  ADD CONSTRAINT `fk_MSSV` FOREIGN KEY (`MSSV`) REFERENCES `sinhvien` (`MSSV`),
  ADD CONSTRAINT `fk_MaLopHP` FOREIGN KEY (`MaLopHP`) REFERENCES `lophp` (`MaLopHP`);

--
-- Các ràng buộc cho bảng `dsyeucau`
--
ALTER TABLE `dsyeucau`
  ADD CONSTRAINT `dsyeucau_magv` FOREIGN KEY (`MaGV`) REFERENCES `phancong` (`MaGV`),
  ADD CONSTRAINT `dsyeucau_malophp` FOREIGN KEY (`MaLopHP`) REFERENCES `phancong` (`MaLopHP`);

--
-- Các ràng buộc cho bảng `phancong`
--
ALTER TABLE `phancong`
  ADD CONSTRAINT `phancong_magv` FOREIGN KEY (`MaGV`) REFERENCES `giangvien` (`MaGV`),
  ADD CONSTRAINT `phancong_malophp` FOREIGN KEY (`MaLopHP`) REFERENCES `lophp` (`MaLopHP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
