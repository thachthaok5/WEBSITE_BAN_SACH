-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2026 at 04:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitiet_donhang`
--

CREATE TABLE `chitiet_donhang` (
  `MaDH` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuong` smallint(6) NOT NULL,
  `DonGia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chitiet_donhang`
--

INSERT INTO `chitiet_donhang` (`MaDH`, `MaSP`, `SoLuong`, `DonGia`) VALUES
(1, 1, 1, 45000),
(1, 3, 10, 5000),
(2, 3, 2, 5000),
(3, 36, 2, 95000),
(4, 36, 1, 95000),
(5, 46, 3, 35000),
(6, 40, 5, 18000);

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`MaDH`, `MaND`, `TenNguoiNhan`, `SDTNhan`, `DiaChi`, `PhuongThucTT`, `GhiChu`, `TongTien`, `TrangThai`, `NgayDat`) VALUES
(1, NULL, 'Nguyễn Văn A', '0987654321', '123 Lê Lợi, Quận 1, TP.HCM', 1, 'Giao giờ hành chính', 95000, 4, '2026-04-04 17:35:53'),
(2, NULL, 'user', '0123456789', 'Ha Noi', 1, 'Giao Ngay', 10000, 3, '2026-04-05 01:34:23'),
(3, 5, 'user', '0123123123', 'Ha Noi', 1, 'aaa', 190000, 3, '2026-04-05 20:20:30'),
(4, 6, 'Linh', '0987664511', '123 khanh hoa', 1, '', 95000, 3, '2026-04-06 17:17:12'),
(5, 5, 'Linh', '0987664511', 'ha noi', 2, 'aaa', 105000, 3, '2026-04-06 17:24:22'),
(6, 7, 'cuong', '0123123123', 'Ha Noi', 1, 'Nha', 90000, 3, '2026-04-30 19:30:52');

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`MaND`, `TenDangNhap`, `MatKhau`, `HoTen`, `Email`, `SoDienThoai`, `Quyen`, `NgayTao`) VALUES
(4, 'admin', '$2y$10$UzgWrYvObjH3g0CyHqJ.V.dDgloAK7hbBO0SdM/FH3Gv9uYExnv/W', 'admin', 'admin@gmail.com', '0987654320', 2, '2026-04-05 00:05:11'),
(5, 'user', '$2y$10$B64ZhFCQo.l5zYYhIQUWFuyIYHn/yA33iGfdZHNe52fRe.UbSK5/e', 'user', 'user@gmail.com', '0123456789', 1, '2026-04-05 19:53:45'),
(6, 'user12', '$2y$10$J.BVFumSlo7/5TEPPKwiXeeX8bGkgg.QhG0ssn0BtJJCfRzZhbleS', 'Linh', 'linh@gmail.com', '0987654321', 1, '2026-04-06 17:15:55'),
(7, 'cuong', '$2y$10$YYcDKEMjs2wg.cU7rSl2leIKX31vZnndgH7W5Ng59FnJ9JkF4.ojG', 'cuong', 'cuong@gmail.com', '0123123123', 1, '2026-04-30 19:30:13'),
(8, '123', '$2y$10$i16SZm6UV1Nkl9R41NcHXOgmAw1NvKGTuBL2TXQ3XW5PmYniomhpS', '123', '123@gmail.com', '0987654321', 1, '2026-05-26 11:13:36');

-- --------------------------------------------------------

--
-- Table structure for table `sach`
--

CREATE TABLE `sach` (
  `MaSP` int(11) NOT NULL,
  `ISBN` varchar(13) NOT NULL,
  `TacGia` varchar(100) DEFAULT NULL,
  `NXB` varchar(100) DEFAULT NULL,
  `SoTrang` smallint(6) DEFAULT NULL,
  `KichThuocTL` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sach`
--

INSERT INTO `sach` (`MaSP`, `ISBN`, `TacGia`, `NXB`, `SoTrang`, `KichThuocTL`) VALUES
(47, '0000', 'Edwin Lefèvre', 'NXB Thanh Niên', 1344, '4kg'),
(48, '1111111', 'Toàn Lê', 'NXB KIM ĐỒNG', 1344, '2kg'),
(50, '1111112', 'Howard Marks', 'Đại Học Kinh tế Quốc Dân', 1223, '2kg'),
(51, '1111113', 'Ying Xiao Tie Jun', 'Công Thương', 1223, '2kg'),
(52, '1111119', 'Nhiều Tác Giả', 'NXB Trẻ', 1223, '2kg');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
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
(36, 'Think and Grow Rich', 1, 95000, 62, 'book10.jpg', 'Tư duy làm giàu', '2026-04-05 19:35:50', '2026-04-06 17:17:12'),
(37, 'Bút bi Thiên Long TL-027', 2, 5000, 200, 'pen1.jpg', 'Bút viết trơn, mực đều', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(38, 'Bút gel mực nước', 2, 7000, 150, 'pen2.jpg', 'Mực đậm, viết êm', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(39, 'Bút chì 2B', 2, 3000, 300, 'pen3.jpg', 'Dùng học sinh, vẽ', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(40, 'Vở ô ly 200 trang', 2, 18000, 115, 'notebook1.jpg', 'Giấy trắng, mịn', '2026-04-05 19:35:50', '2026-04-30 19:30:52'),
(41, 'Vở kẻ ngang 100 trang', 2, 12000, 140, 'notebook2.jpg', 'Phù hợp ghi chép', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(42, 'Thước kẻ 20cm', 2, 8000, 180, 'ruler1.jpg', 'Nhựa trong, bền', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(43, 'Gôm tẩy Thiên Long', 2, 4000, 220, 'eraser1.jpg', 'Tẩy sạch, không rách giấy', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(44, 'Bộ compa học sinh', 2, 25000, 60, 'compass1.jpg', 'Vẽ hình chính xác', '2026-04-05 19:35:50', '2026-04-05 19:35:50'),
(46, 'Hộp bút học sinh', 2, 35000, 67, 'pencilcase1.jpg', 'Nhiều ngăn tiện dụng', '2026-04-05 19:35:50', '2026-04-06 17:24:22'),
(47, 'Jesse Livermore - Nhà Đầu Tư Chứng Khoán Vĩ Đại', 1, 153000, 10, '1780364513_6a1e34e1e3cbf.jpg', 'Jesse Livermore - Nhà Đầu Tư Chứng Khoán Vĩ Đại\r\n\r\nJesse Livermore - con gấu vĩ đại nhất phố Wall, là cái tên từng khuynh đảo giới tài chính và là tiếng nói được quan tâm nhất ở thời của ông. Livermore sở hữu sự nghiệp đầu cơ vô cùng thăng trầm và biến động. Đó là những giao dịch với khối lượng và giá trị lớn chưa từng có bấy giờ, những lần quyết định mua bán không dựa trên bất kỳ cơ sở khoa học, những thương vụ thao túng, làm giá rúng động thị trường và cuối cùng là những lần phá sản vực dậy rồi lại trắng tay. Livermore chưa từng làm bất kỳ công việc nào khác và toàn bộ cuộc đời của ông gắn liền với thị trường chứng khoán.\r\n\r\nCuốn sách “Jesse Livermore - Nhà đầu tư chứng khoán vĩ đại” lần đầu tiên được xuất bản vào năm 1923, đến ngày nay vẫn còn nguyên giá trị bất chấp sự thay đổi không ngừng của thị trường, với sự ra đời của nhiều phương pháp giao dịch hiện đại và sự hỗ trợ của công nghệ vào các kỹ thuật phân tích. Cuốn sách là cuộc đời và sự nghiệp của Jesse Livermore được tiểu thuyết hóa bởi Edwin Lefèvre, với những chi tiết và giọng kể chân thật như chính Livermore ghi chép lại. Rất nhiều nhà đầu tư và đầu cơ thuộc các thế hệ khác nhau đều thừa nhận những bài học họ rút ra được từ cuốn sách thậm chí còn nhiều hơn từ kinh nghiệm hoạt động thị trường.\r\n\r\nNhững lời khuyên về giao dịch cũng như phân tích nhạy bén về hành vi giá của cổ phiếu và thị trường trong cuốn sách có giá trị vượt thời gian. Sự ảnh hưởng to lớn xuyên suốt gần 100 năm qua từ cuốn sách của Edwin Lefèvre là không thể hoài nghi.\r\n\r\nCuốn sách kinh điển này vẽ nên bức chân dung hoàn chỉnh nhất của Jesse Livermore, từ cậu bé ghi bảng ở Boston đến nhà đầu cơ vĩ đại nhất phố Wall. Hơn 20 chương sách kể lại hành trình của Livermore để trở thành tiếng nói có ảnh hưởng nhất trên thị trường chứng khoán Mỹ vào thời của ông.\r\n\r\nCâu chuyện cuộc đời và sự nghiệp của Livermore được tái hiện qua hành trình của cậu bé Livingston với khoản vốn đầu tiên kiếm được từ chứng khoán vào năm 13 tuổi khi đang làm công việc chạy việc vặt ở một công ty chứng khoán chui bắt đầu hoạt động giao dịch chuyên nghiệp. Đó là một hành trình không hề dễ dàng, những bỡ ngỡ ban đầu khi bước vào môi trường giao dịch hoàn toàn mới, thành công rồi thất bại, thắng lớn rồi lại phá sản, trắng tay rồi vực dậy, những thăng trầm huy hoàng của một thiên tài đầu cơ, một nhà giao dịch vĩ đại, một nhà tạo lập thị trường từ những buổi đầu rực rỡ của thị trường tài chính Mỹ.', '2026-04-07 18:33:46', '2026-06-02 08:41:53'),
(48, 'Sóng Và Người - Cẩm Nang Đầu Tư Trên Vnindex - Quyển 1 - Thị Trường Là Tấm Gương', 1, 128000, 4, '1780364268_6a1e33ec62871.webp', 'Sóng Và Người - Cẩm Nang Đầu Tư Trên Vnindex - Quyển 1 - Thị Trường Là Tấm Gương Sóng Và Người - Cẩm Nang Đầu Tư Trên Vnindex - Quyển 1 - Thị Trường Là Tấm Gương\r\n\r\nKhi thị trường trở thành tấm gương soi tâm hồn, chứng khoán không còn chỉ là câu chuyện của giá và lợi nhuận, mà là nơi mỗi nhà đầu tư đối diện trực tiếp với những chuyển động tinh tế bên trong mình. Nỗi sợ khi thị trường lao dốc, sự tiếc nuối vì bán sớm hay mua muộn, cảm giác hoang mang khi tự hỏi mình có thật sự phù hợp với cuộc chơi này hay không. Tất cả đều rất quen thuộc, và không của riêng ai.\r\n\r\nCuốn sách Thị trường là tấm gương được viết từ trải nghiệm của một người đã đi đủ lâu để nhận ra rằng điều đáng sợ nhất trong đầu tư không nằm ở biến động của thị trường, mà ở sự bất ổn trong tâm lý con người. Thị trường không tạo ra cảm xúc, nó chỉ phản chiếu đúng thứ đang tồn tại bên trong mỗi người. Khi lòng bình lặng, thị trường trở nên dễ hiểu hơn. Khi tâm trí rối ren, mọi biến động đều trở thành mối đe dọa.\r\n\r\nXuyên suốt các chương sách là hành trình quan sát nhà đầu tư cá nhân Việt Nam đi qua những pha cảm xúc quen thuộc: hoảng loạn, hy vọng, hưng phấn, nghi ngờ rồi dần chạm đến sự tỉnh thức. Đó không chỉ là chu kỳ của thị trường, mà là nhịp điệu tâm lý mà hầu hết chúng ta đều lặp lại, hết lần này đến lần khác, cho đến khi học được cách nhìn rõ hơn chính mình.\r\n\r\nCuốn sách này không hứa hẹn làm giàu nhanh, cũng không dạy cách chiến thắng thị trường. Nó như một tấm bản đồ cảm xúc, giúp bạn đi qua những mùa sóng mà vẫn giữ được sự điềm tĩnh và niềm tin. Bởi sống sót trong đầu tư không chỉ là giữ được tiền, mà là giữ được sự tỉnh táo. Khi bạn làm được điều đó, thị trường không còn là đối thủ, mà trở thành người thầy lặng lẽ trong hành trình trưởng thành của chính bạn.', '2026-04-07 18:34:09', '2026-06-02 08:40:12'),
(49, 'Hộp Bút Nhựa Hangyodon - Guangbo KT84735', 2, 234000, 67, '1780364695_6a1e3597345e9.webp', 'Hộp Bút Nhựa Hangyodon - Guangbo KT84735 được làm từ chất liệu đẹp, dày chắc, dễ dàng vệ sinh, thuận tiện cho việc sử dụng và bảo quản.\r\n\r\n- Kiểu dáng hộp bút chữ nhật gọn nhẹ, đặc biệt hộp có thể đứng vững trên các mặt phẳng.\r\n\r\n- Dây khóa kéo chắc chắn, trơn tru giúp bạn đóng / mở dễ dàng, thuận tiện khi sử dụng.\r\n\r\n- Thiết kế ngăn đựng rộng rãi, đựng được nhiều loại dụng cụ học tập, văn phòng phẩm như: bút viết, thước kẻ, compa...\r\n\r\n- Với chiếc hộp đựng bút này, bạn có thể tùy ý sắp xếp vật dụng cá nhân của mình một cách gọn gàng, ngăn nắp và còn có thể mang theo bên người để sử dụng vào bất kỳ lúc nào.', '2026-06-02 08:44:55', '2026-06-02 08:44:55'),
(50, 'Phân Tích Thị Trường Chứng Khoán (Tái Bản 2023)', 1, 153000, 102, '1780365051_6a1e36fbe6bf4.webp', 'Phân Tích Thị Trường Chứng Khoán\r\n\r\nThị trường đầu tư là sự kết hợp của rất nhiều chu kỳ lớn nhỏ, và chiến thắng sẽ thuộc về người biết xác định tốt nhất vị trí của mình trong các chu kỳ thất thường.\r\n\r\nPhân tích thị trường chứng khoán cung cấp cho độc giả những hiểu biết sâu sắc để không bị chu kỳ thị trường quật ngã. Thấu hiểu sự vận hành của các chu kỳ chính là chìa khóa để tối đa cơ hội, tối thiểu rủi ro khi tham gia vào thị trường.', '2026-06-02 08:50:51', '2026-06-02 08:50:51'),
(51, 'Kiếm Tiền Bằng Video Ngắn', 1, 153000, 102, '1780365106_6a1e37322d6af.webp', 'Kiếm Tiền Bằng Video Ngắn\r\n\r\nTrong thời đại công nghệ thông tin, video ngắn đã dần len lỏi vào cuộc sống hàng ngày của con người và trở thành công cụ nội dung vô cùng quan trọng đang được khai thác triệt để trên Internet. Cùng với sự phát triển của nền kinh tế truyền thông, các nền tảng video ngắn cũng đang tăng tốc để bắt kịp với xu hướng tiếp thị ngày nay. “Kiếm tiền bằng video ngắn” thông tin chi tiết các ưu điểm và phương pháp hoạt động của marketing bằng video ngắn, là giáo trình nhập môn cơ bản giúp xây dựng kênh truyền thông hiệu quả, bắt đầu từ những khái niệm về video marketing, lập kế hoạch và sản xuất nội dung, đến quản lý vận hành và kiếm lợi nhuận. Bên cạnh đó, những hiện tượng “làm mưa làm gió” khắp các trang mạng xã hội như ‘ông hoàng son môi’ Lý Giai Kỳ, ‘tiên nữ đồng quê’ Lý Tử Thất hay đội ngũ sản xuất Trần Tường 6h30 cũng là những đại diện tiêu biểu được đưa vào phân tích chuyên sâu, nhằm chỉ ra các yếu tố làm nên thành công của các thương hiệu IP này.\r\n\r\nCuốn sách này là một hướng dẫn thực chiến dành cho những ai muốn tận dụng sức mạnh của video ngắn để tiếp cận thị trường Trung Quốc. Tác giả đã kết hợp giữa lý thuyết marketing hiện đại và những kinh nghiệm thực tế từ các chiến dịch thành công trên các nền tảng như Douyin – phiên bản Trung Quốc của TikTok.\r\n\r\nSách giúp độc giả nắm bắt được cách xây dựng nội dung “gây sốt” qua những video ngắn, từ việc xác định đối tượng mục tiêu, tạo ra câu chuyện hấp dẫn cho đến tối ưu hoá quá trình sản xuất và phân phối. Những bí quyết như “giây vàng” để thu hút người xem, cách kết hợp giữa âm nhạc, hình ảnh và hiệu ứng chuyển động cũng được trình bày chi tiết, giúp bạn dễ dàng áp dụng vào thực tế.\r\n\r\nĐiểm mạnh của cuốn sách chính là sự dễ hiểu và tính thực tiễn cao – với nhiều ví dụ cụ thể và phân tích dữ liệu, nó không chỉ giúp người mới bắt đầu mà cả những marketer có kinh nghiệm có thể rút ra bài học và áp dụng ngay các chiến lược phù hợp để tạo nên các chiến dịch video hiệu quả. Nếu bạn đang hướng đến việc mở rộng tầm ảnh hưởng và chuyển đổi người xem thành khách hàng trên thị trường video ngắn, “Kiếm tiền bằng video ngắn” chính là cuốn sách không thể bỏ qua.', '2026-06-02 08:51:46', '2026-06-02 08:51:46'),
(52, 'Không Có Sông Quá Dài - Cẩm Nang Dành Cho Những Người Khởi Nghiệp', 1, 116000, 90, '1780365209_6a1e379905b7e.jpg', 'Không Có Sông Quá Dài - Cẩm Nang Dành Cho Những Người Khởi Nghiệp\r\n\r\nSách gồm hai phần, phần 1 là những chia sẻ quý giá về khởi nghiệp của Giáo sư Phan Văn Trường - chuyên gia cao cấp trong lĩnh vực đàm phán quốc tế và từng là cố vấn của Chính phủ Pháp về thương mại Quốc tế, tác giả của những cuốn sách bestseller Một đời thương thuyết, Một đời như kẻ tìm đường, Một đời quản trị, Công dân toàn cầu công dân vũ trụ, Cơn lốc quản trị - ba trụ cột của văn hóa doanh nghiệp…\r\n\r\nPhần 2 là 27 câu chuyện đặc sắc của những người đã khởi nghiệp thành công sau vô số lần thất bại. Đây là những trải nghiệm thật, vì tôn chỉ của sách là nói thật những việc thật trong thế giới thật.\r\n\r\nSách có thể xem là cẩm nang quý giá của những người khởi nghiệp, với những việc phải làm và những điều nên tránh. Thông điệp của sách: Khởi nghiệp là một quá trình gian khó. Nhưng không có dòng sông nào là quá dài, thế nên bạn đừng bỏ cuộc giữa chừng, đừng nản chí khi gặp thất bại. Hãy kiên trì, rồi chúng ta sẽ đạt đến thành công.\r\n\r\n--\r\n\r\n“Tinh thần của sách KHÔNG CÓ SÔNG QUÁ DÀI không khác cuốn Không có đỉnh quá cao. Đó là tạo sự tự tin và sự kiên trì. Nhưng các tác giả ở đây là thế hệ của những người trẻ đã lớn lên và ý thức được mình phải khởi nghiệp, rồi bắt đầu đối mặt với nhiều khó khăn. Bài toán này, ai ai cũng phải đi qua, vì nó sẽ giúp cho các bạn trẻ hiểu được giá trị của mình, sở trường cũng như sở đoản. Các bạn trẻ sẽ phải dùng đến cả trí tuệ lẫn nội lực trong hành trình tạo dựng sự nghiệp. Cuộc sống muốn như thế, và ta cũng nên làm theo ý như thế.\r\n\r\nCứ nhìn nước sông lững lờ nhưng sâu thẳm, nhưng rồi bạn ạ, sông nào cũng sẽ ra biển lớn. Người khởi nghiệp cũng vậy, cứ lững thững mà tiến bước, giống như dòng nước sông, lúc trôi mau, lúc lững lờ, lúc êm lướt, lúc sóng cuộn; rồi sau này ai cũng có nghề có nghiệp, có đúng thế không? Có đi chậm thì mới đi xa, ở đây hành trình tạo dựng sự nghiệp là một chuỗi ngày dài, chẳng thể vội. Hãy bắt chước dòng sông, lợi dụng những chỗ hõm của địa thế để tìm cơ hội.”\r\n\r\n- GS Phan Văn Trường', '2026-06-02 08:53:29', '2026-06-02 08:53:29'),
(53, 'Bộ 4 Nắp Bút Chì Zootopia - iiGEN YZ360037', 2, 27000, 67, '1780365411_6a1e386369857.webp', 'Bộ 4 Nắp Bút Chì Zootopia - iiGEN YZ360037\r\n\r\n- Nắp bút giúp bạn bảo vệ cây bút chì của bạn không bị gãy khi để trong hộp bút hay vô tình bị rơi rớt.\r\n\r\n- Ngoài ra còn là vật trang trí cho cây bút thêm phần cute giúp các bạn hứng thú hơn trong học tâp.\r\n\r\n- Sản phẩm với thiết kế nhỏ gọn và tiện lợi. được làm từ chất liệu an toàn, thân thiện với môi trường, không gây hại đến sức khỏe người dùng.', '2026-06-02 08:56:51', '2026-06-02 08:56:51'),
(54, 'Khay Đựng Tạp Chí 4 Ngăn - Toppoint Z9040 - Màu Xám Bạc', 2, 463000, 67, '1780365478_6a1e38a6ebe23.webp', 'Khay Đựng Tạp Chí 4 Ngăn - Toppoint Z9040\r\n\r\n- Thiết kế 4 ngăn rộng rãi: dễ dàng phân loại hồ sơ, tạp chí, catalogue, tài liệu học tập.\r\n\r\n- Chất liệu kim loại sơn tĩnh điện cao cấp: chống gỉ sét, độ bền cao, chịu lực tốt.\r\n\r\n- Kiểu dáng lưới thoáng: giúp dễ quan sát và lấy tài liệu nhanh chóng.\r\n\r\n- Màu sắc trang nhã: có 2 lựa chọn màu đen và xám bạc, phù hợp với mọi phong cách văn phòng.\r\n\r\n- Thiết kế chắc chắn: khung viền kim loại dày, giữ form ổn định khi sử dụng lâu dài.', '2026-06-02 08:57:58', '2026-06-02 08:57:58'),
(55, 'Bộ 6 Oto 3D Có Nam Châm - Nam Châm Tủ Lạnh - Blueangel', 2, 54000, 34, '1780365547_6a1e38eb1878b.webp', 'Bộ 6 Oto 3D Có Nam Châm - Nam Châm Tủ Lạnh - Blueangel\r\n\r\nCác tính năng:\r\n\r\n1. Bộ dụng cụ tự làm tinh tế: Những nam châm tủ lạnh tranh này cung cấp cho bạn đủ lựa chọn để sử dụng và xoay vòng hàng ngày.\r\n\r\n2. Thiết kế đẹp: Miếng dán tủ lạnh của chúng tôi có hoa văn dễ thương, tăng thêm vẻ đẹp mắt cho bất kỳ không gian bếp hoặc văn phòng nào. Đó là một vật trang trí sẽ bắt mắt và làm bừng sáng môi trường xung quanh bạn.\r\n\r\n3. Món quà lý tưởng: Những nam châm tủ lạnh này là một món quà lý tưởng cho gia đình, bạn bè, bạn học. Chúng thể hiện sự quan tâm và bồi dưỡng các mối quan hệ. Gây ngạc nhiên cho những người thân yêu của bạn với món quà chu đáo và sáng tạo này.\r\n\r\n- Kích thước: ngẫu nhiên tùy mẫu.\r\n\r\n- Nam Châm Tủ Lạnh dùng làm quà tặng người thân bạn bè.\r\n\r\n- Sản phẩm đẹp, độc đáo.\r\n\r\n- Dùng để trang trí tủ lạnh, các bề mặt kim loại phù hợp cho nam châm hít.\r\n\r\n- Lực hít vừa phải, không bị rơi khi đóng/mở tủ.', '2026-06-02 08:59:07', '2026-06-02 08:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `vanphongpham`
--

CREATE TABLE `vanphongpham` (
  `MaSP` int(11) NOT NULL,
  `ThuongHieu` varchar(100) NOT NULL,
  `XuatXu` varchar(100) DEFAULT NULL,
  `MauSac` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vanphongpham`
--

INSERT INTO `vanphongpham` (`MaSP`, `ThuongHieu`, `XuatXu`, `MauSac`) VALUES
(3, 'Thiên Long', 'Việt Nam', 'Xanh, Đỏ, Đen'),
(6, 'Pentel', 'Việt', 'Xanh dương - Màu đỏ - Màu đen - Màu tím'),
(49, 'GuangBo', 'Trung Quốc', 'Tím'),
(53, 'iiGEN', 'Trung Quốc', 'Nhiều màu'),
(54, 'Toppoint', 'Thái Lan', 'Đen'),
(55, 'Blueangel', 'Việt Nam', 'Nhiều màu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitiet_donhang`
--
ALTER TABLE `chitiet_donhang`
  ADD PRIMARY KEY (`MaDH`,`MaSP`),
  ADD KEY `FK_CTDH_SANPHAM` (`MaSP`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`MaDH`),
  ADD KEY `IX_DONHANG_MaND` (`MaND`),
  ADD KEY `IX_DONHANG_TrangThai` (`TrangThai`),
  ADD KEY `IX_DONHANG_NgayDat` (`NgayDat`);

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`MaND`),
  ADD UNIQUE KEY `UQ_NGUOIDUNG_TenDangNhap` (`TenDangNhap`),
  ADD UNIQUE KEY `UQ_NGUOIDUNG_Email` (`Email`);

--
-- Indexes for table `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`MaSP`),
  ADD UNIQUE KEY `UQ_SACH_ISBN` (`ISBN`),
  ADD KEY `IX_SACH_TacGia` (`TacGia`),
  ADD KEY `IX_SACH_NXB` (`NXB`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `IX_SANPHAM_TenSP` (`TenSP`),
  ADD KEY `IX_SANPHAM_LoaiSP` (`LoaiSP`);

--
-- Indexes for table `vanphongpham`
--
ALTER TABLE `vanphongpham`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `IX_VPP_ThuongHieu` (`ThuongHieu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `MaDH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `MaND` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitiet_donhang`
--
ALTER TABLE `chitiet_donhang`
  ADD CONSTRAINT `FK_CTDH_DONHANG` FOREIGN KEY (`MaDH`) REFERENCES `donhang` (`MaDH`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CTDH_SANPHAM` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON UPDATE CASCADE;

--
-- Constraints for table `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `FK_DONHANG_NGUOIDUNG` FOREIGN KEY (`MaND`) REFERENCES `nguoidung` (`MaND`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `FK_SACH_SANPHAM` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vanphongpham`
--
ALTER TABLE `vanphongpham`
  ADD CONSTRAINT `FK_VPP_SANPHAM` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
