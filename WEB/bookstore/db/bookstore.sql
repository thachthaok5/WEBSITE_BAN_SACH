-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 06, 2026 lúc 03:48 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bookstore`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiet_donhang`
--

CREATE TABLE `chitiet_donhang` (
  `MaDH` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuong` smallint(6) NOT NULL,
  `DonGia` int(11) NOT NULL
) ;

--
-- Đang đổ dữ liệu cho bảng `chitiet_donhang`
--

INSERT INTO `chitiet_donhang` (`MaDH`, `MaSP`, `SoLuong`, `DonGia`) VALUES
(1, 1, 1, 45000),
(1, 3, 10, 5000),
(2, 3, 2, 5000),
(3, 36, 2, 95000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `MaDH` int(11) NOT NULL,
  `MaND` int(11) DEFAULT NULL,
  `TenNguoiNhan` varchar(50) NOT NULL,
  `SDTNhan` varchar(10) NOT NULL,
  `DiaChi` varchar(200) NOT NULL,
  `PhuongThucTT` tinyint(4) NOT NULL,
  `GhiChu` varchar(255) DEFAULT NULL,
  `TongTien` int(11) NOT NULL,
  `TrangThai` tinyint(4) NOT NULL DEFAULT 0,
  `NgayDat` datetime NOT NULL DEFAULT current_timestamp()
) ;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`MaDH`, `MaND`, `TenNguoiNhan`, `SDTNhan`, `DiaChi`, `PhuongThucTT`, `GhiChu`, `TongTien`, `TrangThai`, `NgayDat`) VALUES
(1, NULL, 'Nguyễn Văn A', '0987654321', '123 Lê Lợi, Quận 1, TP.HCM', 1, 'Giao giờ hành chính', 95000, 4, '2026-04-04 17:35:53'),
(2, NULL, 'user', '0123456789', 'Ha Noi', 1, 'Giao Ngay', 10000, 4, '2026-04-05 01:34:23'),
(3, 5, 'user', '0123123123', 'Ha Noi', 1, 'aaa', 190000, 3, '2026-04-05 20:20:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `MaND` int(11) NOT NULL,
  `TenDangNhap` varchar(20) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `HoTen` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `SoDienThoai` varchar(10) NOT NULL,
  `Quyen` tinyint(4) NOT NULL DEFAULT 1,
  `NgayTao` datetime NOT NULL DEFAULT current_timestamp()
) ;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`MaND`, `TenDangNhap`, `MatKhau`, `HoTen`, `Email`, `SoDienThoai`, `Quyen`, `NgayTao`) VALUES
(4, 'admin', '$2y$10$UzgWrYvObjH3g0CyHqJ.V.dDgloAK7hbBO0SdM/FH3Gv9uYExnv/W', 'admin', 'admin@gmail.com', '0987654320', 2, '2026-04-05 00:05:11'),
(5, 'user', '$2y$10$B64ZhFCQo.l5zYYhIQUWFuyIYHn/yA33iGfdZHNe52fRe.UbSK5/e', 'user', 'user@gmail.com', '0123456789', 1, '2026-04-05 19:53:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sach`
--

CREATE TABLE `sach` (
  `MaSP` int(11) NOT NULL,
  `ISBN` varchar(13) NOT NULL,
  `TacGia` varchar(100) DEFAULT NULL,
  `NXB` varchar(100) DEFAULT NULL,
  `SoTrang` smallint(6) DEFAULT NULL,
  `KichThuocTL` varchar(50) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` int(11) NOT NULL,
  `TenSP` varchar(150) NOT NULL,
  `LoaiSP` tinyint(4) NOT NULL,
  `GiaBan` int(11) NOT NULL,
  `TonKho` int(11) NOT NULL DEFAULT 0,
  `HinhAnh` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `MoTa` text DEFAULT NULL,
  `NgayTao` datetime NOT NULL DEFAULT current_timestamp(),
  `NgayCapNhat` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSP`, `LoaiSP`, `GiaBan`, `TonKho`, `HinhAnh`, `MoTa`, `NgayTao`, `NgayCapNhat`) VALUES
(1, 'Dế Mèn Phiêu Lưu Ký', 1, 45000, 100, 'de-men.jpg', 'Tác phẩm nổi tiếng dành cho thiếu nhi.', '2026-04-04 17:35:53', '2026-04-04 17:35:53'),
(3, 'Bút bi Thiên Long TL-027', 2, 5000, 498, '1775386871_69d240f7e2be7.webp', 'Bút viết trơn, mực đều.', '2026-04-04 17:35:53', '2026-04-05 18:01:11'),
(6, '[CHÍNH HÃNG - Do GOLDEN PEN NK] Bút gel Pentel Energel BLN105 ngòi 0.5mm - Mực siêu nhanh khô, nhiều màu lựa chọn', 2, 9000, 999, '1775390880_69d250a05162b.jpg', 'Thông tin sản phẩm\r\nBút gel Pentel Energel BLN105 ngòi 0.5mm Với 12 màu cực xinh xắn kèm theo đó là chất lượng tuyệt đỉnh khẳng định vị thế số 1 của dòng Pentel Energel: mực ra đều, viết trơn, mượt, không bị lem hay nhòe và đặc biệt, mực khô nhanh trong 1/3s sau khi viết, chắc chắn cây bút này xứng đáng có mặt trong bộ sưu tập siêu bút của các bạn đấy.\r\nTHÔNG TIN CHI TIẾT SẢN PHẨM:\r\n- Đầu bi: 0.5mm\r\n- Có tới 12 màu để lựa chọn\r\n- Thiết kế dạng bấm tiện lợi, ngòi bút trơn tru, cầm nhẹ tay, giúp tăng tốc độ ghi chép, phù hợp với các bạn học sinh, sinh viên thường xuyên phải ghi chép bài, giúp tối ưu thời gian trong các bài thi nhờ việc rút ngắn thời gian viết\r\n- Cán cầm bút bi được làm bằng silicon mềm mại, không gây đau, tê tay khi dùng lâu\r\n- Viết trơn, mượt, mực ra đều, không bị tắc mực và đặc biệt khô nhanh trong 1/3s', '2026-04-05 19:08:00', '2026-04-05 19:08:00'),
(7, 'Nhà Giả Kim', 1, 79000, 50, 'nha-gia-kim.jpg', 'Câu chuyện về hành trình theo đuổi vận mệnh.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(8, 'Đắc Nhân Tâm', 1, 86000, 40, 'dac-nhan-tam.jpg', 'Cuốn sách nghệ thuật ứng xử hàng đầu.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(9, 'Tôi Thấy Hoa Vàng Trên Cỏ Xanh', 1, 125000, 30, 'hoa-vang.jpg', 'Truyện dài của Nguyễn Nhật Ánh.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(10, 'Mắt Biếc', 1, 110000, 25, 'mat-biec.jpg', 'Một câu chuyện tình buồn và đẹp.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(11, 'Hoàng Tử Bé', 1, 55000, 100, 'hoang-tu-be.jpg', 'Tác phẩm kinh điển cho mọi lứa tuổi.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(12, 'Suối Nguồn', 1, 245000, 15, 'suoi-nguon.jpg', 'Tiểu thuyết triết học nổi tiếng.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(13, 'Rừng Na Uy', 1, 135000, 20, 'rung-na-uy.jpg', 'Tác phẩm của Haruki Murakami.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(14, 'Bắt Trẻ Đồng Xanh', 1, 85000, 45, 'bat-tre-dong-xanh.jpg', 'Tiểu thuyết về sự nổi loạn của tuổi trẻ.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(15, 'Kiêu Hãnh Và Định Kiến', 1, 95000, 35, 'kieu-hanh.jpg', 'Kinh điển văn học Anh.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(16, 'Sự Im Lặng Của Bầy Cừu', 1, 145000, 12, 'im-lang.jpg', 'Tiểu thuyết trinh thám rùng rợn.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(17, 'Sổ lò xo A5 Dotgrid', 2, 45000, 200, 'so-lo-xo.jpg', 'Giấy định lượng 100gsm chống thấm.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(18, 'Bút Marker Touch 24 màu', 2, 120000, 50, 'marker-24.jpg', 'Màu vẽ chuyên dụng cho kiến trúc.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(19, 'Máy tính Casio FX-580VN X', 2, 650000, 15, 'casio-580.jpg', 'Hỗ trợ giải toán cao cấp.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(20, 'Bút chì bấm Pentel 0.5mm', 2, 35000, 300, 'pentel-05.jpg', 'Thân kim loại bền bỉ.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(21, 'Gọt chì quay tay Deli', 2, 75000, 80, 'got-chi-deli.jpg', 'Thiết kế hình ngôi nhà dễ thương.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(22, 'Bảng từ trắng 60x80cm', 2, 185000, 10, 'bang-tu.jpg', 'Mặt bảng chống lóa, hít nam châm.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(23, 'Cặp tài liệu 12 ngăn', 2, 55000, 120, 'cap-tai-lieu.jpg', 'Lưu trữ hồ sơ ngăn nắp.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(24, 'Keo dán khô UHU', 2, 25000, 500, 'keo-uhu.jpg', 'Dán giấy cực nhanh và chắc.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(25, 'Kéo văn phòng SDI', 2, 18000, 400, 'keo-sdi.jpg', 'Lưỡi thép không gỉ.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(26, 'Hộp bút sắt Avengers', 2, 42000, 90, 'hop-but.jpg', 'In hình siêu anh hùng sắc nét.', '2026-04-05 19:20:08', '2026-04-05 19:20:08'),
(27, 'Dế Mèn Phiêu Lưu Ký', 1, 45000, 100, 'book1.jpg', 'Tác phẩm thiếu nhi nổi tiếng của Tô Hoài', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(28, 'Chuyện Ngày Hạ', 1, 59000, 80, 'book2.jpg', 'Truyện ngắn nhẹ nhàng, sâu lắng', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(29, 'Harry Potter Tập 1', 1, 120000, 50, 'book3.jpg', 'Phù thủy và thế giới phép thuật', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(30, 'Đắc Nhân Tâm', 1, 90000, 60, 'book4.jpg', 'Kỹ năng giao tiếp và thành công', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(31, 'Nhà Giả Kim', 1, 85000, 70, 'book5.jpg', 'Hành trình theo đuổi ước mơ', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(32, 'Tuổi Trẻ Đáng Giá Bao Nhiêu', 1, 78000, 90, 'book6.jpg', 'Sách truyền cảm hứng', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(33, 'Cà Phê Cùng Tony', 1, 88000, 40, 'book7.jpg', 'Chia sẻ kinh nghiệm sống', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(34, 'Sapiens', 1, 150000, 30, 'book8.jpg', 'Lược sử loài người', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(35, 'Atomic Habits', 1, 110000, 55, 'book9.jpg', 'Thay đổi thói quen nhỏ', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(36, 'Think and Grow Rich', 1, 95000, 63, 'book10.jpg', 'Tư duy làm giàu', '2026-04-05 19:35:50', '2026-04-05 20:20:30'),
(37, 'Bút bi Thiên Long TL-027', 2, 5000, 200, 'pen1.jpg', 'Bút viết trơn, mực đều', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(38, 'Bút gel mực nước', 2, 7000, 150, 'pen2.jpg', 'Mực đậm, viết êm', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(39, 'Bút chì 2B', 2, 3000, 300, 'pen3.jpg', 'Dùng học sinh, vẽ', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(40, 'Vở ô ly 200 trang', 2, 18000, 120, 'notebook1.jpg', 'Giấy trắng, mịn', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(41, 'Vở kẻ ngang 100 trang', 2, 12000, 140, 'notebook2.jpg', 'Phù hợp ghi chép', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(42, 'Thước kẻ 20cm', 2, 8000, 180, 'ruler1.jpg', 'Nhựa trong, bền', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(43, 'Gôm tẩy Thiên Long', 2, 4000, 220, 'eraser1.jpg', 'Tẩy sạch, không rách giấy', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(44, 'Bộ compa học sinh', 2, 25000, 60, 'compass1.jpg', 'Vẽ hình chính xác', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(45, 'Bìa hồ sơ A4', 2, 10000, 90, 'file1.jpg', 'Đựng tài liệu', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(46, 'Hộp bút học sinh', 2, 35000, 70, 'pencilcase1.jpg', 'Nhiều ngăn tiện dụng', '2026-04-05 19:35:50', '2026-04-05 19:35:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vanphongpham`
--

CREATE TABLE `vanphongpham` (
  `MaSP` int(11) NOT NULL,
  `ThuongHieu` varchar(100) NOT NULL,
  `XuatXu` varchar(100) DEFAULT NULL,
  `MauSac` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `vanphongpham`
--

INSERT INTO `vanphongpham` (`MaSP`, `ThuongHieu`, `XuatXu`, `MauSac`) VALUES
(3, 'Thiên Long', 'Việt Nam', 'Xanh, Đỏ, Đen'),
(6, 'Pentel', 'Việt', 'Xanh dương - Màu đỏ - Màu đen - Màu tím');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitiet_donhang`
--
ALTER TABLE `chitiet_donhang`
  ADD PRIMARY KEY (`MaDH`,`MaSP`),
  ADD KEY `FK_CTDH_SANPHAM` (`MaSP`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`MaDH`),
  ADD KEY `IX_DONHANG_MaND` (`MaND`),
  ADD KEY `IX_DONHANG_TrangThai` (`TrangThai`),
  ADD KEY `IX_DONHANG_NgayDat` (`NgayDat`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`MaND`),
  ADD UNIQUE KEY `UQ_NGUOIDUNG_TenDangNhap` (`TenDangNhap`),
  ADD UNIQUE KEY `UQ_NGUOIDUNG_Email` (`Email`);

--
-- Chỉ mục cho bảng `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`MaSP`),
  ADD UNIQUE KEY `UQ_SACH_ISBN` (`ISBN`),
  ADD KEY `IX_SACH_TacGia` (`TacGia`),
  ADD KEY `IX_SACH_NXB` (`NXB`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `IX_SANPHAM_TenSP` (`TenSP`),
  ADD KEY `IX_SANPHAM_LoaiSP` (`LoaiSP`);

--
-- Chỉ mục cho bảng `vanphongpham`
--
ALTER TABLE `vanphongpham`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `IX_VPP_ThuongHieu` (`ThuongHieu`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `MaDH` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `MaND` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSP` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitiet_donhang`
--
ALTER TABLE `chitiet_donhang`
  ADD CONSTRAINT `FK_CTDH_DONHANG` FOREIGN KEY (`MaDH`) REFERENCES `donhang` (`MaDH`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CTDH_SANPHAM` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `FK_DONHANG_NGUOIDUNG` FOREIGN KEY (`MaND`) REFERENCES `nguoidung` (`MaND`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `FK_SACH_SANPHAM` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `vanphongpham`
--
ALTER TABLE `vanphongpham`
  ADD CONSTRAINT `FK_VPP_SANPHAM` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
