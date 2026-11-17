# BÁO CÁO KIỂM THỬ PHẦN MỀM - WEBSITE BÁN SÁCH & VĂN PHÒNG PHẨM (BOOKSTORE)

> **Môn học:** Kiểm thử phần mềm  
> **Khoa:** Công nghệ thông tin – Trường Đại học Nha Trang  
> **Giảng viên hướng dẫn:** ThS. Bùi Thị Hồng Minh  
> **Năm thực hiện:** 2026  

---

## 📌 1. Giới Thiệu Tổng Quan Đề Tài
Đồ án tập trung nghiên cứu, xây dựng và thực thi quy trình kiểm thử phần mềm toàn diện (Black-box Testing, Manual UI Testing và Automated RESTful API Testing) cho hệ thống thương mại điện tử **BookStore** chuyên kinh doanh các sản phẩm sách văn học, sách kinh tế, sách thiếu nhi và văn phòng phẩm chính hãng.

Hệ thống được phát triển trên nền tảng **PHP MVC**, cơ sở dữ liệu quan hệ **MariaDB (MySQL)**, kết hợp cùng giao diện người dùng hiện đại, tinh tế và module **RESTful API** chuẩn hóa phục vụ kiểm thử tự động.

---

## 📂 2. Cấu Trúc Thư Mục Dự Án
```text
├── BÀI BÁO CÁO WORD KIỂM THỬ - WEBSITE BÁN SÁCH & VĂN PHÒNG PHẨM/
│   ├── KIỂM THỬ - WEBSITE BÁN SÁCH & VĂN PHÒNG PHẨM.docx  # Báo cáo Word hoàn chỉnh (Chương 1 - 4 + API)
│   ├── BookStore_API_Test.postman_collection.json         # Postman Collection v2.1.0 tự động hóa
│   └── test_api.py                                        # Script Python chạy kiểm thử API tự động
├── DATA/
│   └── bookstore.sql                                      # File cơ sở dữ liệu mẫu MariaDB
├── WEB/
│   └── bookstore/                                         # Toàn bộ mã nguồn website PHP MVC
│       ├── api/                                           # Module RESTful API Engine (JSON response)
│       ├── config/                                        # Cấu hình kết nối CSDL (Port 3307)
│       ├── controllers/                                   # Bộ điều khiển (Admin, Auth, Cart, Home, Order, Product, User, Api)
│       ├── core/                                          # Framework MVC cốt lõi (Router, Controller, Model)
│       ├── models/                                        # Lớp mô hình xử lý dữ liệu (Product, User, Cart, Order)
│       ├── public/                                        # Tài nguyên tĩnh (CSS, JS, Uploads hình ảnh)
│       ├── views/                                         # Giao diện người dùng theo chuẩn MVC
│       ├── index.php                                      # Điểm khởi động ứng dụng (Entry point)
│       └── DESIGN.md                                      # Đặc tả ngôn ngữ thiết kế giao diện
├── BAO_CAO_KIEM_THU_API.md                                # Báo cáo chi tiết 30 kịch bản kiểm thử API
├── .gitignore                                             # Cấu hình bỏ qua các file rác, file tạm
└── README.md                                              # Hướng dẫn tổng quan dự án
```

---

## ⚙️ 3. Hướng Dẫn Cài Đặt & Chạy Môi Trường Thử Nghiệm

### Yêu cầu hệ thống:
- **XAMPP** (PHP >= 8.0, Apache, MariaDB/MySQL).
- **Python** 3.8+ (để chạy script test tự động).
- **Postman** (phiên bản v10+ để chạy Collection Runner).

### Các bước cài đặt:
1. **Khởi động dịch vụ:** Mở bảng điều khiển **XAMPP Control Panel**, nhấn **Start** cho cả **Apache** và **MySQL**.
2. **Cấu hình CSDL:**
   - Mở `phpMyAdmin` (hoặc công cụ quản lý MySQL: DBeaver, Navicat, HeidiSQL) kết nối cổng `3307` (hoặc `3306` tùy cấu hình XAMPP của bạn).
   - Tạo mới database tên: `bookstore` với bảng mã `utf8mb4_unicode_ci`.
   - Import file: `DATA/bookstore.sql` vào cơ sở dữ liệu `bookstore`.
3. **Triển khai mã nguồn:**
   - Copy thư mục `WEB/bookstore` vào thư mục `htdocs` của XAMPP:
     `C:\xampp\htdocs\bookstore` (hoặc đường dẫn cài đặt XAMPP tương ứng).
   - Kiểm tra cấu hình kết nối trong `config/database.php` (mặc định: host `localhost`, port `3307`, user `root`, password rỗng).
4. **Truy cập ứng dụng:**
   - Mở trình duyệt web và truy cập: `http://localhost/bookstore/index.php`.

---

## 🧪 4. Hướng Dẫn Chạy Kiểm Thử API Tự Động

### Cách 1: Chạy tự động bằng Python Test Suite (Khuyến nghị)
Trong thư mục dự án, mở Terminal / Command Prompt và chạy lệnh:
```bash
python test_api.py
```
Toàn bộ **30 Test Cases** sẽ được thực thi tuần tự trong khoảng ~1 giây và in kết quả chi tiết từng ca kiểm thử kèm tỷ lệ Pass/Fail tổng thể.

### Cách 2: Chạy tự động qua Postman Collection Runner
1. Khởi động phần mềm **Postman**.
2. Nhấn nút **Import** ở góc trên bên trái màn hình.
3. Chọn file `BookStore_API_Test.postman_collection.json`.
4. Nhấp chuột vào Collection **BookStore API - Kiểm Thử Tự Động**.
5. Nhấn **Run Collection** -> Chọn **Run BookStore API** để kiểm thử tự động toàn bộ API và xem biểu đồ kết quả trực quan.

---

## 📊 5. Thống Kê Tổng Hợp Kết Quả Kiểm Thử Toàn Hệ Thống

| STT | Phân hệ (Module) | Loại hình kiểm thử | Tổng số TC | Số lượng Pass | Số lượng Fail | Tỷ lệ Pass |
| :---: | :--- | :---: | :---: | :---: | :---: | :---: |
| 1 | Quản lý tài khoản (Đăng ký, Đăng nhập, Cập nhật) | Kiểm thử thủ công (UI) | 14 | 12 | 2 | 85.7% |
| 2 | Tìm kiếm & Lọc sản phẩm | Kiểm thử thủ công (UI) | 6 | 5 | 1 | 83.3% |
| 3 | Phân loại danh mục | Kiểm thử thủ công (UI) | 6 | 5 | 1 | 83.3% |
| 4 | Quản lý Giỏ hàng | Kiểm thử thủ công (UI) | 3 | 1 | 2 | 33.3% |
| 5 | Thanh toán & Checkout | Kiểm thử thủ công (UI) | 6 | 1 | 5 | 16.7% |
| 6 | Quản lý & Theo dõi Đơn hàng | Kiểm thử thủ công (UI) | 3 | 2 | 1 | 66.7% |
| 7 | Quản lý Admin | Kiểm thử thủ công (UI) | 9 | 3 | 6 | 33.3% |
| 8 | **Kiểm thử tự động RESTful API (Backend)** | **Kiểm thử tự động (API)** | **30** | **30** | **0** | **100.0%** |
| **Tổng** | **Toàn bộ hệ thống (UI + API)** | **Tổng hợp toàn diện** | **77** | **59** | **18** | **76.6%** |

---
*Bản quyền đồ án thuộc về Nhóm sinh viên thực hiện - Khoa CNTT, Trường Đại học Nha Trang (2026).*
