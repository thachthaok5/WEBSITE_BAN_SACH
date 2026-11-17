# BÁO CÁO KẾT QUẢ KIỂM THỬ TỰ ĐỘNG RESTFUL API
**Hệ thống:** Website Bán Sách & Văn Phòng Phẩm (BookStore)  
**Môn học:** Kiểm thử phần mềm  
**Môi trường thử nghiệm:** Localhost (Apache 2.4, PHP 8.2, MariaDB 10.4)  
**Công cụ kiểm thử:** Python Automated Test Suite (`urllib`, `CookieJar`) & Postman Collection v2.1.0  
**Tỷ lệ Pass:** **100.0%** (30/30 Test Cases Đạt)

---

## 1. TỔNG QUAN HỆ THỐNG API ĐƯỢC KIỂM THỬ

Hệ thống cung cấp kiến trúc RESTful API chuẩn hóa, trả về định dạng `application/json; charset=UTF-8`, bao gồm các nhóm endpoint chức năng:
- **Health Check & Metrics:** Kiểm tra tình trạng kết nối CSDL và tính khả dụng của máy chủ.
- **Authentication API:** Đăng ký, Đăng nhập, Duy trì phiên làm việc qua Token/Session, Lấy thông tin người dùng (`/auth/me`), Đăng xuất.
- **Products & Categories API:** Lấy danh sách sản phẩm phân trang, lọc theo danh mục (Sách/VPP), tìm kiếm theo từ khóa, sắp xếp theo giá, xem chi tiết sản phẩm.
- **Cart API:** Quản lý giỏ hàng trực tuyến (Xem giỏ, Thêm sản phẩm, Cập nhật số lượng, Xóa sản phẩm, Làm trống giỏ).
- **Orders & Checkout API:** Đặt hàng, Lưu thông tin giao hàng, Trừ tồn kho tự động, Xem lịch sử đơn hàng và chi tiết các mặt hàng trong đơn.
- **Admin Management API:** Lấy số liệu thống kê tổng thể (Sản phẩm, Đơn hàng, Doanh thu, Người dùng).

---

## 2. BẢNG CHI TIẾT 30 KỊCH BẢN KIỂM THỬ API (API TEST CASES & RESULTS)

| STT | Mã Test Case | Tên Kịch Bản Kiểm Thử | Method | Endpoint / Query | Dữ Liệu Đầu Vào (Payload) | Mã HTTP Mong Đợi | Mã HTTP Thực Tế | Thời Gian (ms) | Kết Quả |
| :---: | :---: | :--- | :---: | :--- | :--- | :---: | :---: | :---: | :---: |
| 1 | `TC_API_01` | Kiểm tra trạng thái hoạt động API (Health Check) | `GET` | `?endpoint=health` | Không | `200 OK` | `200` | 40.30 | **PASS** |
| 2 | `TC_API_02` | Lấy danh sách sản phẩm phân trang (limit=5) | `GET` | `?endpoint=products&page=1&limit=5` | Không | `200 OK` | `200` | 30.92 | **PASS** |
| 3 | `TC_API_03` | Lọc sản phẩm theo danh mục Sách quốc văn | `GET` | `?endpoint=products&loai=1` | Không | `200 OK` | `200` | 21.83 | **PASS** |
| 4 | `TC_API_04` | Lọc sản phẩm theo danh mục Văn phòng phẩm | `GET` | `?endpoint=products&loai=2` | Không | `200 OK` | `200` | 14.18 | **PASS** |
| 5 | `TC_API_05` | Tìm kiếm sản phẩm theo từ khóa hợp lệ | `GET` | `?endpoint=products&keyword=sách` | Không | `200 OK` | `200` | 12.46 | **PASS** |
| 6 | `TC_API_06` | Sắp xếp sản phẩm theo giá tăng dần | `GET` | `?endpoint=products&sort=price_asc` | Không | `200 OK` | `200` | 8.20 | **PASS** |
| 7 | `TC_API_07` | Xem chi tiết sản phẩm hợp lệ có trong CSDL | `GET` | `?endpoint=products/detail&id=55` | Không | `200 OK` | `200` | 28.33 | **PASS** |
| 8 | `TC_API_08` | Xem chi tiết sản phẩm không tồn tại (Negative) | `GET` | `?endpoint=products/detail&id=99999` | Không | `404 Not Found` | `404` | 31.26 | **PASS** |
| 9 | `TC_API_09` | Lấy danh mục sản phẩm hệ thống | `GET` | `?endpoint=categories` | Không | `200 OK` | `200` | 8.12 | **PASS** |
| 10 | `TC_API_10` | Đăng ký thất bại do thiếu thông tin (Body rỗng) | `POST` | `?endpoint=auth/register` | `{}` | `400 Bad Request` | `400` | 26.24 | **PASS** |
| 11 | `TC_API_11` | Đăng ký thất bại do mật khẩu ngắn (< 6 ký tự) | `POST` | `?endpoint=auth/register` | `{"password": "123", ...}` | `400 Bad Request` | `400` | 31.37 | **PASS** |
| 12 | `TC_API_12` | Đăng ký thất bại do sai định dạng Email | `POST` | `?endpoint=auth/register` | `{"email": "sai_dinh_dang"}` | `400 Bad Request` | `400` | 29.41 | **PASS** |
| 13 | `TC_API_13` | Đăng ký tài khoản thành công với thông tin hợp lệ | `POST` | `?endpoint=auth/register` | `{"username": "tester...", ...}` | `201 Created` | `201` | 123.54 | **PASS** |
| 14 | `TC_API_14` | Đăng ký thất bại do trùng tên đăng nhập đã có | `POST` | `?endpoint=auth/register` | `{"username": "trung_lap", ...}` | `409 Conflict` | `409` | 48.14 | **PASS** |
| 15 | `TC_API_15` | Đăng nhập thất bại do sai mật khẩu | `POST` | `?endpoint=auth/login` | `{"password": "SaiMatKhau"}` | `401 Unauthorized` | `401` | 146.80 | **PASS** |
| 16 | `TC_API_16` | Đăng nhập thành công với tài khoản hợp lệ | `POST` | `?endpoint=auth/login` | `{"username": "admin", ...}` | `200 OK` | `200` | 122.55 | **PASS** |
| 17 | `TC_API_17` | Lấy thông tin tài khoản đang đăng nhập | `GET` | `?endpoint=auth/me` | Session Cookie | `200 OK` | `200` | 48.77 | **PASS** |
| 18 | `TC_API_18` | Lấy giỏ hàng ban đầu (Kiểm tra giỏ rỗng) | `GET` | `?endpoint=cart` | Session Cookie | `200 OK` | `200` | 6.72 | **PASS** |
| 19 | `TC_API_19` | Thêm vào giỏ thất bại do số lượng bằng 0 (BVA) | `POST` | `?endpoint=cart/add` | `{"id": 55, "qty": 0}` | `400 Bad Request` | `400` | 22.52 | **PASS** |
| 20 | `TC_API_20` | Thêm vào giỏ thất bại do ID không tồn tại | `POST` | `?endpoint=cart/add` | `{"id": 99999, "qty": 1}` | `404 Not Found` | `404` | 48.70 | **PASS** |
| 21 | `TC_API_21` | Thêm sản phẩm hợp lệ vào giỏ hàng | `POST` | `?endpoint=cart/add` | `{"id": 55, "qty": 2}` | `200 OK` | `200` | 47.59 | **PASS** |
| 22 | `TC_API_22` | Cập nhật số lượng sản phẩm trong giỏ lên 4 | `POST` | `?endpoint=cart/update` | `{"id": 55, "qty": 4}` | `200 OK` | `200` | 8.96 | **PASS** |
| 23 | `TC_API_23` | Đặt hàng thất bại do thiếu thông tin nhận hàng | `POST` | `?endpoint=order/checkout` | `{"receiver_name": "A"}` | `400 Bad Request` | `400` | 9.98 | **PASS** |
| 24 | `TC_API_24` | Đặt hàng thành công với thông tin đầy đủ | `POST` | `?endpoint=order/checkout` | `{"receiver_name": "...", ...}` | `201 Created` | `201` | 12.52 | **PASS** |
| 25 | `TC_API_25` | Đặt hàng thất bại do giỏ hàng đã làm trống | `POST` | `?endpoint=order/checkout` | `{"receiver_name": "..."}` | `400 Bad Request` | `400` | 8.30 | **PASS** |
| 26 | `TC_API_26` | Lấy danh sách lịch sử đơn hàng | `GET` | `?endpoint=orders` | Session Cookie | `200 OK` | `200` | 18.25 | **PASS** |
| 27 | `TC_API_27` | Xem chi tiết đơn hàng vừa tạo | `GET` | `?endpoint=orders/detail&id=X` | Session Cookie | `200 OK` | `200` | 31.22 | **PASS** |
| 28 | `TC_API_28` | Lấy thống kê số liệu tổng thể (Admin Dashboard) | `GET` | `?endpoint=admin/stats` | Không | `200 OK` | `200` | 37.92 | **PASS** |
| 29 | `TC_API_29` | Đăng xuất tài khoản người dùng | `POST` | `?endpoint=auth/logout` | Session Cookie | `200 OK` | `200` | 7.69 | **PASS** |
| 30 | `TC_API_30` | Xác thực sau đăng xuất (Bảo mật Session) | `GET` | `?endpoint=auth/me` | Cookie đã hủy | `401 Unauthorized` | `401` | 17.33 | **PASS** |

---

## 3. THỐNG KÊ TỔNG KẾT VÀ TỶ LỆ PASS/FAIL

- **Tổng số kịch bản kiểm thử (Total Test Cases):** 30
- **Số ca kiểm thử Đạt (Passed):** 30
- **Số ca kiểm thử Thất bại (Failed):** 0
- **Tỷ lệ kiểm thử thành công (Pass Rate):** **100.0%**
- **Tổng thời gian chạy toàn bộ kịch bản:** ~1.05 giây (trung bình 35ms / request)

---

## 4. HƯỚNG DẪN THỰC THI KIỂM THỬ API

### Cách 1: Chạy tự động bằng Python Test Runner
Trong thư mục dự án, mở Terminal và chạy lệnh:
```bash
python test_api.py
```
Toàn bộ 30 Test Cases sẽ được thực thi tuần tự, kiểm tra tính đúng đắn của dữ liệu và in ra kết quả chi tiết từng ca kiểm thử.

### Cách 2: Sử dụng Postman để kiểm thử giao diện & Test Runner
1. Mở phần mềm **Postman**.
2. Nhấn nút **Import** ở góc trên bên trái.
3. Chọn file `BookStore_API_Test.postman_collection.json` nằm trong thư mục mã nguồn.
4. Chọn Collection **BookStore API - Kiểm Thử Tự Động** vừa import.
5. Nhấn nút **Run Collection** (hoặc Runner) -> chọn **Run BookStore API** để chạy tự động toàn bộ bài test có sẵn và xem biểu đồ Pass/Fail trực quan.
