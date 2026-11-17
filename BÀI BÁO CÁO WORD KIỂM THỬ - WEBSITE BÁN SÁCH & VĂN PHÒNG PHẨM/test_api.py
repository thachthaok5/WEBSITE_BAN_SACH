import urllib.request
import urllib.parse
import http.cookiejar
import json
import time
import sys

BASE_URL = "http://localhost/bookstore/api/index.php"

# Setup Session with Cookie Handler to persist session across requests
cookie_jar = http.cookiejar.CookieJar()
opener = urllib.request.build_opener(urllib.request.HTTPCookieProcessor(cookie_jar))
urllib.request.install_opener(opener)

class APITestRunner:
    def __init__(self, base_url):
        self.base_url = base_url
        self.results = []
        self.test_counter = 1

    def request(self, method, endpoint, params=None, data=None):
        url = f"{self.base_url}?endpoint={endpoint}"
        if params:
            url += "&" + urllib.parse.urlencode(params)
        
        headers = {
            "Accept": "application/json",
            "User-Agent": "BookStore-Automated-Test-Runner/1.0"
        }
        
        encoded_data = None
        if data is not None:
            encoded_data = json.dumps(data).encode('utf-8')
            headers["Content-Type"] = "application/json; charset=utf-8"

        req = urllib.request.Request(url, data=encoded_data, headers=headers, method=method)
        
        start_time = time.time()
        try:
            with opener.open(req) as response:
                duration_ms = round((time.time() - start_time) * 1000, 2)
                status_code = response.getcode()
                body = response.read().decode('utf-8')
                try:
                    json_resp = json.loads(body)
                except Exception:
                    json_resp = {"raw": body}
                return status_code, json_resp, duration_ms
        except urllib.error.HTTPError as e:
            duration_ms = round((time.time() - start_time) * 1000, 2)
            status_code = e.code
            body = e.read().decode('utf-8')
            try:
                json_resp = json.loads(body)
            except Exception:
                json_resp = {"raw": body}
            return status_code, json_resp, duration_ms
        except Exception as e:
            duration_ms = round((time.time() - start_time) * 1000, 2)
            return 0, {"error": str(e)}, duration_ms

    def assert_test(self, test_id, name, method, endpoint, params=None, data=None, expected_status=200, check_fn=None):
        status, resp, duration = self.request(method, endpoint, params, data)
        
        passed = (status == expected_status)
        details = ""
        
        if passed and check_fn:
            try:
                check_passed, msg = check_fn(resp)
                if not check_passed:
                    passed = False
                    details = f"Assertion failed: {msg}"
            except Exception as ex:
                passed = False
                details = f"Check exception: {str(ex)}"
        elif not passed:
            details = f"Expected status {expected_status}, got {status} ({resp.get('message', '')})"

        self.results.append({
            "id": test_id,
            "name": name,
            "method": method,
            "endpoint": endpoint,
            "status": status,
            "expected_status": expected_status,
            "passed": passed,
            "duration": duration,
            "details": details,
            "response": resp
        })

        status_str = "PASS" if passed else "FAIL"
        print(f"[{status_str:4s}] {test_id}: {name} ({method} {endpoint}) -> Status: {status} in {duration}ms")
        if not passed:
            print(f"       -> Details: {details}")

    def run_all(self):
        print("=" * 80)
        print("BẮT ĐẦU CHẠY BỘ KIỂM THỬ API TỰ ĐỘNG - WEBSITE BÁN SÁCH & VĂN PHÒNG PHẨM")
        print(f"Target Base URL: {self.base_url}")
        print("=" * 80)

        # 1. Health
        self.assert_test(
            "TC_API_01", "Kiểm tra trạng thái hoạt động hệ thống API (Health Check)",
            "GET", "health",
            expected_status=200,
            check_fn=lambda r: (r.get("success") is True and r.get("data", {}).get("db_status") == "Connected", "DB is connected")
        )

        # 2. Products & Categories API
        self.assert_test(
            "TC_API_02", "Lấy danh sách sản phẩm mặc định (Phân trang limit=5)",
            "GET", "products", params={"page": 1, "limit": 5},
            expected_status=200,
            check_fn=lambda r: (len(r.get("data", {}).get("items", [])) <= 5 and r.get("data", {}).get("pagination", {}).get("total") > 0, "Items <= 5 and total > 0")
        )

        self.assert_test(
            "TC_API_03", "Lọc sản phẩm theo danh mục Sách quốc văn (loai=1)",
            "GET", "products", params={"loai": 1, "limit": 10},
            expected_status=200,
            check_fn=lambda r: (all(item.get("LoaiSP") == 1 for item in r.get("data", {}).get("items", [])), "Tất cả sản phẩm thuộc Loại 1")
        )

        self.assert_test(
            "TC_API_04", "Lọc sản phẩm theo danh mục Văn phòng phẩm (loai=2)",
            "GET", "products", params={"loai": 2, "limit": 10},
            expected_status=200,
            check_fn=lambda r: (all(item.get("LoaiSP") == 2 for item in r.get("data", {}).get("items", [])), "Tất cả sản phẩm thuộc Loại 2")
        )

        self.assert_test(
            "TC_API_05", "Tìm kiếm sản phẩm theo từ khóa hợp lệ (keyword='sách')",
            "GET", "products", params={"keyword": "sách"},
            expected_status=200,
            check_fn=lambda r: (r.get("success") is True, "Tìm kiếm thành công")
        )

        self.assert_test(
            "TC_API_06", "Sắp xếp sản phẩm theo giá tăng dần (sort='price_asc')",
            "GET", "products", params={"sort": "price_asc", "limit": 5},
            expected_status=200,
            check_fn=lambda r: (
                len(r.get("data", {}).get("items", [])) >= 2 and
                r.get("data", {}).get("items", [])[0]["GiaBan"] <= r.get("data", {}).get("items", [])[1]["GiaBan"],
                "Giá sản phẩm đầu <= giá sản phẩm sau"
            )
        )

        self.assert_test(
            "TC_API_07", "Xem chi tiết sản phẩm hợp lệ có trong CSDL (id=55)",
            "GET", "products/detail", params={"id": 55},
            expected_status=200,
            check_fn=lambda r: (r.get("data", {}).get("MaSP") == 55, "Trả về đúng sản phẩm ID 55")
        )

        self.assert_test(
            "TC_API_08", "Xem chi tiết sản phẩm không tồn tại (id=99999)",
            "GET", "products/detail", params={"id": 99999},
            expected_status=404,
            check_fn=lambda r: (r.get("success") is False, "Trả về lỗi 404 Not Found")
        )

        self.assert_test(
            "TC_API_09", "Lấy danh mục sản phẩm (Categories)",
            "GET", "categories",
            expected_status=200,
            check_fn=lambda r: (len(r.get("data", [])) >= 2, "Có ít nhất 2 danh mục")
        )

        # 3. Authentication API
        self.assert_test(
            "TC_API_10", "Đăng ký thất bại do thiếu thông tin (Body rỗng)",
            "POST", "auth/register", data={},
            expected_status=400,
            check_fn=lambda r: (r.get("success") is False and "errors" in r, "Báo lỗi validation các trường rỗng")
        )

        self.assert_test(
            "TC_API_11", "Đăng ký thất bại do mật khẩu quá ngắn (< 6 ký tự)",
            "POST", "auth/register",
            data={
                "username": f"user_{int(time.time())}",
                "password": "123",
                "fullname": "Nguyen Van A",
                "email": f"test_{int(time.time())}@gmail.com",
                "phone": "0912345678"
            },
            expected_status=400,
            check_fn=lambda r: ("errors" in r and "password" in r["errors"], "Báo lỗi mật khẩu < 6 ký tự")
        )

        self.assert_test(
            "TC_API_12", "Đăng ký thất bại do sai định dạng Email",
            "POST", "auth/register",
            data={
                "username": f"user_{int(time.time())}",
                "password": "password123",
                "fullname": "Nguyen Van A",
                "email": "dinh_dang_email_sai",
                "phone": "0912345678"
            },
            expected_status=400,
            check_fn=lambda r: ("errors" in r and "email" in r["errors"], "Báo lỗi định dạng email")
        )

        unique_user = f"tester_{int(time.time()) % 100000}"
        test_email = f"{unique_user}@bookstore.vn"
        test_pass = "SecurePass123@"

        self.assert_test(
            "TC_API_13", "Đăng ký tài khoản thành công với thông tin hợp lệ",
            "POST", "auth/register",
            data={
                "username": unique_user,
                "password": test_pass,
                "fullname": "Kiểm Thử Viên Tự Động",
                "email": test_email,
                "phone": "0987654321"
            },
            expected_status=201,
            check_fn=lambda r: (r.get("success") is True and r.get("data", {}).get("username") == unique_user, "Tạo user thành công")
        )

        self.assert_test(
            "TC_API_14", "Đăng ký thất bại do trùng tên đăng nhập đã có",
            "POST", "auth/register",
            data={
                "username": unique_user,
                "password": "password123",
                "fullname": "Người Dùng Trùng",
                "email": f"other_{int(time.time())}@gmail.com",
                "phone": "0988888888"
            },
            expected_status=409,
            check_fn=lambda r: (r.get("success") is False, "Trả về 409 Conflict")
        )

        self.assert_test(
            "TC_API_15", "Đăng nhập thất bại do sai mật khẩu",
            "POST", "auth/login",
            data={"username": unique_user, "password": "WrongPassword999"},
            expected_status=401,
            check_fn=lambda r: (r.get("success") is False, "Trả về 401 Unauthorized")
        )

        self.assert_test(
            "TC_API_16", "Đăng nhập thành công với tài khoản vừa tạo",
            "POST", "auth/login",
            data={"username": unique_user, "password": test_pass},
            expected_status=200,
            check_fn=lambda r: (r.get("success") is True and "token" in r.get("data", {}), "Đăng nhập thành công, nhận session token")
        )

        self.assert_test(
            "TC_API_17", "Lấy thông tin tài khoản đang đăng nhập (GET /auth/me)",
            "GET", "auth/me",
            expected_status=200,
            check_fn=lambda r: (r.get("data", {}).get("username") == unique_user, "Khớp đúng thông tin user đăng nhập")
        )

        # 4. Cart Management API
        self.assert_test(
            "TC_API_18", "Lấy giỏ hàng ban đầu (Kiểm tra giỏ hàng rỗng)",
            "GET", "cart",
            expected_status=200,
            check_fn=lambda r: (r.get("success") is True, "Lấy giỏ hàng thành công")
        )

        self.assert_test(
            "TC_API_19", "Thêm vào giỏ thất bại do số lượng âm hoặc 0 (BVA qty=0)",
            "POST", "cart/add",
            data={"id": 55, "qty": 0},
            expected_status=400,
            check_fn=lambda r: (r.get("success") is False, "Chặn số lượng <= 0")
        )

        self.assert_test(
            "TC_API_20", "Thêm vào giỏ thất bại do ID sản phẩm không tồn tại (id=99999)",
            "POST", "cart/add",
            data={"id": 99999, "qty": 1},
            expected_status=404,
            check_fn=lambda r: (r.get("success") is False, "Chặn sản phẩm không tồn tại")
        )

        self.assert_test(
            "TC_API_21", "Thêm sản phẩm hợp lệ vào giỏ hàng (id=55, qty=2)",
            "POST", "cart/add",
            data={"id": 55, "qty": 2},
            expected_status=200,
            check_fn=lambda r: (r.get("data", {}).get("currentQty") >= 2, "Thêm 2 sản phẩm vào giỏ")
        )

        self.assert_test(
            "TC_API_22", "Cập nhật số lượng sản phẩm trong giỏ hàng (id=55, qty=4)",
            "POST", "cart/update",
            data={"id": 55, "qty": 4},
            expected_status=200,
            check_fn=lambda r: (r.get("data", {}).get("qty") == 4, "Cập nhật thành công lên 4")
        )

        # 5. Orders & Checkout API
        self.assert_test(
            "TC_API_23", "Đặt hàng thất bại do thiếu thông tin người nhận (Thiếu SĐT & Địa chỉ)",
            "POST", "order/checkout",
            data={"receiver_name": "Nguyen Van A", "receiver_phone": "", "receiver_address": ""},
            expected_status=400,
            check_fn=lambda r: (r.get("success") is False and "errors" in r, "Báo lỗi thiếu thông tin giao hàng")
        )

        created_order_id = None
        def save_order_id(r):
            nonlocal created_order_id
            created_order_id = r.get("data", {}).get("orderId")
            return (r.get("success") is True and created_order_id is not None, "Tạo đơn hàng thành công")

        self.assert_test(
            "TC_API_24", "Đặt hàng thành công với thông tin giao hàng đầy đủ",
            "POST", "order/checkout",
            data={
                "receiver_name": "Trần Thị Khách Hàng",
                "receiver_phone": "0901234567",
                "receiver_address": "123 Đường Sách Nguyễn Huệ, Quận 1, TP.HCM",
                "payment_method": 0,
                "note": "Giao hàng giờ hành chính giúp tôi"
            },
            expected_status=201,
            check_fn=save_order_id
        )

        self.assert_test(
            "TC_API_25", "Đặt hàng thất bại do giỏ hàng đã trống (Sau khi đã checkout thành công)",
            "POST", "order/checkout",
            data={
                "receiver_name": "Trần Thị Khách Hàng",
                "receiver_phone": "0901234567",
                "receiver_address": "123 Đường Sách",
                "payment_method": 0
            },
            expected_status=400,
            check_fn=lambda r: (r.get("success") is False, "Báo lỗi giỏ hàng trống")
        )

        self.assert_test(
            "TC_API_26", "Lấy danh sách lịch sử đơn hàng của người dùng",
            "GET", "orders",
            expected_status=200,
            check_fn=lambda r: (len(r.get("data", [])) >= 1, "Có ít nhất 1 đơn hàng vừa tạo")
        )

        target_order_param = {"id": created_order_id if created_order_id else 1}
        self.assert_test(
            "TC_API_27", f"Xem thông tin chi tiết đơn hàng (id={target_order_param['id']})",
            "GET", "orders/detail", params=target_order_param,
            expected_status=200,
            check_fn=lambda r: (r.get("success") is True and "items" in r.get("data", {}), "Chi tiết đơn hàng kèm danh sách sản phẩm")
        )

        # 6. Admin Statistics & Logout
        self.assert_test(
            "TC_API_28", "Lấy thống kê hệ thống (Admin Dashboard Metrics)",
            "GET", "admin/stats",
            expected_status=200,
            check_fn=lambda r: (r.get("data", {}).get("totalProducts") > 0 and r.get("data", {}).get("totalOrders") > 0, "Thống kê sản phẩm và đơn hàng > 0")
        )

        self.assert_test(
            "TC_API_29", "Đăng xuất tài khoản người dùng (Logout)",
            "POST", "auth/logout",
            expected_status=200,
            check_fn=lambda r: (r.get("success") is True, "Đăng xuất thành công")
        )

        self.assert_test(
            "TC_API_30", "Xác thực lại sau đăng xuất (GET /auth/me phải báo 401 Unauthorized)",
            "GET", "auth/me",
            expected_status=401,
            check_fn=lambda r: (r.get("success") is False, "Session đã bị hủy thành công")
        )

        # Summary Report
        print("=" * 80)
        total_tests = len(self.results)
        passed_tests = sum(1 for r in self.results if r["passed"])
        failed_tests = total_tests - passed_tests
        pass_rate = round((passed_tests / total_tests) * 100, 2)
        total_duration = round(sum(r["duration"] for r in self.results), 2)

        print("TỔNG KẾT KẾT QUẢ KIỂM THỬ API:")
        print(f" - Tổng số Test Cases: {total_tests}")
        print(f" - Số Test Cases PASS: {passed_tests}")
        print(f" - Số Test Cases FAIL: {failed_tests}")
        print(f" - Tỷ lệ Đạt (Pass Rate): {pass_rate}%")
        print(f" - Tổng thời gian thực thi: {total_duration} ms")
        print("=" * 80)

        return self.results

if __name__ == "__main__":
    runner = APITestRunner(BASE_URL)
    results = runner.run_all()
