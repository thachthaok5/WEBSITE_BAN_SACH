<?php
/**
 * BookStore RESTful API Engine
 * Chuẩn hóa phục vụ Kiểm thử API tự động (Postman, Newman, Python Test Suite)
 * Sinh viên: Báo cáo kiểm thử Website Bán Sách & Văn Phòng Phẩm
 */

header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Cart.php';
require_once __DIR__ . '/../models/Order.php';

// Helper gửi JSON response
function apiResponse(int $statusCode, bool $success, string $message, $data = null, $errors = null) {
    http_response_code($statusCode);
    $response = [
        'success'    => $success,
        'statusCode' => $statusCode,
        'message'    => $message,
        'timestamp'  => date('c'),
    ];
    if ($data !== null) {
        $response['data'] = $data;
    }
    if ($errors !== null) {
        $response['errors'] = $errors;
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// Đọc request body (hỗ trợ cả JSON payload lẫn form-data)
$rawInput = file_get_contents('php://input');
$jsonBody = json_decode($rawInput, true);
$requestData = is_array($jsonBody) ? $jsonBody : $_POST;

// Lấy endpoint từ query ?endpoint=... hoặc PATH_INFO
$endpoint = $_GET['endpoint'] ?? '';
if (empty($endpoint) && !empty($_SERVER['PATH_INFO'])) {
    $endpoint = trim($_SERVER['PATH_INFO'], '/');
}
if (empty($endpoint) && !empty($_GET['action'])) {
    $endpoint = $_GET['action'];
}
$endpoint = trim(strtolower($endpoint), '/');

$method = $_SERVER['REQUEST_METHOD'];

// Khởi tạo kết nối DB
try {
    $db = (new Database())->connect();
} catch (Exception $e) {
    apiResponse(500, false, 'Không thể kết nối cơ sở dữ liệu: ' . $e->getMessage());
}

// =========================================================================
// ROUTER
// =========================================================================

switch ($endpoint) {
    // ---------------------------------------------------------------------
    // 0. HEALTH CHECK
    // ---------------------------------------------------------------------
    case '':
    case 'health':
        apiResponse(200, true, 'BookStore API Service is online and operational', [
            'service'     => 'BookStore E-Commerce REST API',
            'version'     => '1.0.0',
            'php_version' => PHP_VERSION,
            'db_status'   => 'Connected',
            'environment' => 'Testing & Production Ready'
        ]);
        break;

    // ---------------------------------------------------------------------
    // 1. AUTHENTICATION API
    // ---------------------------------------------------------------------
    case 'auth/register':
        if ($method !== 'POST') {
            apiResponse(405, false, 'Phương thức không được hỗ trợ. Vui lòng dùng POST.');
        }

        $username = trim($requestData['username'] ?? '');
        $password = trim($requestData['password'] ?? '');
        $fullname = trim($requestData['fullname'] ?? '');
        $email    = trim($requestData['email'] ?? '');
        $phone    = trim($requestData['phone'] ?? '');

        $errors = [];
        if (empty($username)) $errors['username'] = 'Tên đăng nhập không được để trống';
        if (empty($password)) $errors['password'] = 'Mật khẩu không được để trống';
        elseif (strlen($password) < 6) $errors['password'] = 'Mật khẩu phải có độ dài tối thiểu 6 ký tự';
        if (empty($fullname)) $errors['fullname'] = 'Họ và tên không được để trống';
        if (empty($email)) $errors['email'] = 'Email không được để trống';
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Định dạng email không hợp lệ';
        if (empty($phone)) $errors['phone'] = 'Số điện thoại không được để trống';
        elseif (!preg_match('/^[0-9]{10,11}$/', $phone)) $errors['phone'] = 'Số điện thoại phải từ 10 đến 11 chữ số';

        if (!empty($errors)) {
            apiResponse(400, false, 'Dữ liệu đăng ký không hợp lệ', null, $errors);
        }

        $userModel = new User();
        if ($userModel->findByUsername($username)) {
            apiResponse(409, false, 'Tên đăng nhập đã tồn tại trong hệ thống', null, ['username' => 'Tên đăng nhập đã tồn tại']);
        }
        if ($userModel->findByEmail($email)) {
            apiResponse(409, false, 'Địa chỉ email đã được sử dụng', null, ['email' => 'Email đã tồn tại']);
        }

        $created = $userModel->create([
            'username' => $username,
            'password' => $password,
            'fullname' => $fullname,
            'email'    => $email,
            'phone'    => $phone
        ]);

        if ($created) {
            $newUser = $userModel->findByUsername($username);
            apiResponse(201, true, 'Đăng ký tài khoản thành công', [
                'userId'   => (int)$newUser['MaND'],
                'username' => $newUser['TenDangNhap'],
                'fullname' => $newUser['HoTen'],
                'email'    => $newUser['Email'],
                'role'     => (int)$newUser['Quyen']
            ]);
        } else {
            apiResponse(500, false, 'Lỗi hệ thống khi tạo tài khoản');
        }
        break;

    case 'auth/login':
        if ($method !== 'POST') {
            apiResponse(405, false, 'Phương thức không được hỗ trợ. Vui lòng dùng POST.');
        }

        $username = trim($requestData['username'] ?? '');
        $password = trim($requestData['password'] ?? '');

        if (empty($username) || empty($password)) {
            apiResponse(400, false, 'Tài khoản và mật khẩu không được để trống', null, [
                'username' => empty($username) ? 'Vui lòng nhập tên đăng nhập' : null,
                'password' => empty($password) ? 'Vui lòng nhập mật khẩu' : null
            ]);
        }

        $userModel = new User();
        $user = $userModel->findByUsername($username);

        if (!$user || !password_verify($password, $user['MatKhau'])) {
            apiResponse(401, false, 'Sai tên tài khoản hoặc mật khẩu không chính xác');
        }

        // Lưu session
        $_SESSION['user'] = [
            'id'       => (int)$user['MaND'],
            'username' => $user['TenDangNhap'],
            'fullname' => $user['HoTen'],
            'role'     => (int)$user['Quyen']
        ];

        apiResponse(200, true, 'Đăng nhập thành công', [
            'token'     => session_id(),
            'sessionId' => session_id(),
            'user'      => [
                'id'       => (int)$user['MaND'],
                'username' => $user['TenDangNhap'],
                'fullname' => $user['HoTen'],
                'email'    => $user['Email'],
                'phone'    => $user['SoDienThoai'],
                'role'     => (int)$user['Quyen'],
                'roleName' => ((int)$user['Quyen'] === 2) ? 'Admin' : 'Customer'
            ]
        ]);
        break;

    case 'auth/me':
        if ($method !== 'GET') {
            apiResponse(405, false, 'Phương thức không được hỗ trợ. Vui lòng dùng GET.');
        }
        if (!isset($_SESSION['user'])) {
            apiResponse(401, false, 'Chưa đăng nhập. Vui lòng xác thực trước.');
        }
        $userModel = new User();
        $user = $userModel->findById((int)$_SESSION['user']['id']);
        if (!$user) {
            apiResponse(404, false, 'Không tìm thấy người dùng');
        }
        apiResponse(200, true, 'Lấy thông tin người dùng thành công', [
            'id'       => (int)$user['MaND'],
            'username' => $user['TenDangNhap'],
            'fullname' => $user['HoTen'],
            'email'    => $user['Email'],
            'phone'    => $user['SoDienThoai'],
            'role'     => (int)$user['Quyen']
        ]);
        break;

    case 'auth/logout':
        if ($method !== 'POST') {
            apiResponse(405, false, 'Phương thức không được hỗ trợ. Vui lòng dùng POST.');
        }
        unset($_SESSION['user']);
        session_destroy();
        apiResponse(200, true, 'Đăng xuất tài khoản thành công');
        break;

    // ---------------------------------------------------------------------
    // 2. PRODUCTS API
    // ---------------------------------------------------------------------
    case 'products':
        if ($method !== 'GET') {
            apiResponse(405, false, 'Phương thức không được hỗ trợ. Vui lòng dùng GET.');
        }

        $page    = max(1, (int)($_GET['page'] ?? 1));
        $limit   = max(1, min(50, (int)($_GET['limit'] ?? 10)));
        $offset  = ($page - 1) * $limit;
        $loai    = isset($_GET['loai']) && $_GET['loai'] !== '' ? (int)$_GET['loai'] : null;
        $keyword = trim($_GET['keyword'] ?? '');
        $sort    = trim($_GET['sort'] ?? 'latest');

        $whereClause = "WHERE 1=1";
        $params = [];

        if ($loai !== null) {
            $whereClause .= " AND LoaiSP = ?";
            $params[] = $loai;
        }
        if ($keyword !== '') {
            $whereClause .= " AND (TenSP LIKE ? OR MoTa LIKE ?)";
            $params[] = '%' . $keyword . '%';
            $params[] = '%' . $keyword . '%';
        }

        $orderSql = "ORDER BY MaSP DESC";
        if ($sort === 'price_asc') {
            $orderSql = "ORDER BY GiaBan ASC";
        } elseif ($sort === 'price_desc') {
            $orderSql = "ORDER BY GiaBan DESC";
        } elseif ($sort === 'name_asc') {
            $orderSql = "ORDER BY TenSP ASC";
        }

        // Count total
        $countSql = "SELECT COUNT(*) as total FROM sanpham $whereClause";
        $countStmt = $db->prepare($countSql);
        $countStmt->execute($params);
        $totalItems = (int)($countStmt->fetch()['total'] ?? 0);
        $totalPages = ceil($totalItems / $limit);

        // Fetch items
        $dataSql = "SELECT MaSP, TenSP, GiaBan, TonKho, HinhAnh, MoTa, LoaiSP 
                    FROM sanpham $whereClause $orderSql LIMIT $limit OFFSET $offset";
        $dataStmt = $db->prepare($dataSql);
        $dataStmt->execute($params);
        $products = $dataStmt->fetchAll();

        // Format numeric values
        foreach ($products as &$p) {
            $p['MaSP']    = (int)$p['MaSP'];
            $p['GiaBan']  = (float)$p['GiaBan'];
            $p['TonKho'] = (int)$p['TonKho'];
            $p['LoaiSP']  = (int)$p['LoaiSP'];
            $p['LoaiTen'] = ($p['LoaiSP'] === 1) ? 'Sách quốc văn' : 'Văn phòng phẩm';
        }

        apiResponse(200, true, 'Lấy danh sách sản phẩm thành công', [
            'items'      => $products,
            'pagination' => [
                'page'       => $page,
                'limit'      => $limit,
                'total'      => $totalItems,
                'totalPages' => $totalPages
            ]
        ]);
        break;

    case 'products/detail':
        if ($method !== 'GET') {
            apiResponse(405, false, 'Phương thức không được hỗ trợ. Vui lòng dùng GET.');
        }

        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            apiResponse(400, false, 'Tham số ID sản phẩm không hợp lệ');
        }

        $productModel = new Product();
        $product = $productModel->getById($id);

        if (!$product) {
            apiResponse(404, false, "Không tìm thấy sản phẩm có mã ID = $id");
        }

        $product['MaSP']    = (int)$product['MaSP'];
        $product['GiaBan']  = (float)$product['GiaBan'];
        $product['TonKho'] = (int)($product['TonKho'] ?? 0);
        $product['LoaiSP']  = (int)$product['LoaiSP'];

        apiResponse(200, true, 'Lấy thông tin chi tiết sản phẩm thành công', $product);
        break;

    case 'categories':
        if ($method !== 'GET') {
            apiResponse(405, false, 'Phương thức không được hỗ trợ. Vui lòng dùng GET.');
        }
        $categories = [
            [
                'id'          => 1,
                'name'        => 'Sách Quốc Văn & Kinh Tế',
                'slug'        => 'sach-quoc-van',
                'description' => 'Sách văn học, tiểu thuyết, kinh tế, tâm lý và phát triển bản thân'
            ],
            [
                'id'          => 2,
                'name'        => 'Văn Phòng Phẩm & Họa Cụ',
                'slug'        => 'van-phong-pham',
                'description' => 'Bút ký cao cấp, sổ tay, vở học sinh và dụng cụ mỹ thuật chính hãng'
            ]
        ];
        apiResponse(200, true, 'Lấy danh mục thành công', $categories);
        break;

    // ---------------------------------------------------------------------
    // 3. CART API
    // ---------------------------------------------------------------------
    case 'cart':
        if ($method !== 'GET') {
            apiResponse(405, false, 'Phương thức không được hỗ trợ. Vui lòng dùng GET.');
        }
        $cart = $_SESSION['cart'] ?? [];
        $items = [];
        $totalPrice = 0;
        $totalCount = 0;

        foreach ($cart as $pId => $item) {
            $subtotal = (float)$item['price'] * (int)$item['qty'];
            $totalPrice += $subtotal;
            $totalCount += (int)$item['qty'];
            $items[] = [
                'productId' => (int)$pId,
                'name'      => $item['name'] ?? '',
                'price'     => (float)$item['price'],
                'image'     => $item['image'] ?? '',
                'qty'       => (int)$item['qty'],
                'subtotal'  => $subtotal
            ];
        }

        apiResponse(200, true, 'Lấy giỏ hàng thành công', [
            'items'      => $items,
            'totalCount' => $totalCount,
            'totalPrice' => $totalPrice
        ]);
        break;

    case 'cart/add':
        if ($method !== 'POST') {
            apiResponse(405, false, 'Phương thức không được hỗ trợ. Vui lòng dùng POST.');
        }

        $id  = (int)($requestData['id'] ?? ($_GET['id'] ?? 0));
        $qty = (int)($requestData['qty'] ?? 1);

        if ($id <= 0) {
            apiResponse(400, false, 'ID sản phẩm không hợp lệ');
        }
        if ($qty <= 0) {
            apiResponse(400, false, 'Số lượng sản phẩm thêm vào giỏ phải lớn hơn 0');
        }

        $productModel = new Product();
        $product = $productModel->getById($id);

        if (!$product) {
            apiResponse(404, false, "Sản phẩm với ID $id không tồn tại");
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$id] = [
                'name'  => $product['TenSP'],
                'price' => (float)$product['GiaBan'],
                'image' => $product['HinhAnh'] ?? '',
                'qty'   => $qty
            ];
        }

        $totalCount = array_sum(array_column($_SESSION['cart'], 'qty'));
        apiResponse(200, true, 'Thêm sản phẩm vào giỏ hàng thành công', [
            'addedId'    => $id,
            'addedQty'   => $qty,
            'currentQty' => $_SESSION['cart'][$id]['qty'],
            'cartCount'  => $totalCount
        ]);
        break;

    case 'cart/update':
        if ($method !== 'POST') {
            apiResponse(405, false, 'Phương thức không được hỗ trợ. Vui lòng dùng POST.');
        }

        $id  = (int)($requestData['id'] ?? 0);
        $qty = (int)($requestData['qty'] ?? 0);

        if ($id <= 0) {
            apiResponse(400, false, 'ID sản phẩm không hợp lệ');
        }

        if (!isset($_SESSION['cart'][$id])) {
            apiResponse(404, false, 'Sản phẩm không có trong giỏ hàng');
        }

        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
            $msg = 'Đã xóa sản phẩm khỏi giỏ hàng do số lượng bằng 0';
        } else {
            $_SESSION['cart'][$id]['qty'] = $qty;
            $msg = 'Cập nhật số lượng sản phẩm thành công';
        }

        $totalCount = !empty($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'qty')) : 0;
        apiResponse(200, true, $msg, [
            'productId' => $id,
            'qty'       => $qty,
            'cartCount' => $totalCount
        ]);
        break;

    case 'cart/remove':
        if ($method !== 'POST' && $method !== 'DELETE') {
            apiResponse(405, false, 'Phương thức không được hỗ trợ. Vui lòng dùng POST hoặc DELETE.');
        }

        $id = (int)($requestData['id'] ?? ($_GET['id'] ?? 0));
        if ($id <= 0) {
            apiResponse(400, false, 'ID sản phẩm không hợp lệ');
        }

        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }

        $totalCount = !empty($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'qty')) : 0;
        apiResponse(200, true, 'Xóa sản phẩm khỏi giỏ hàng thành công', [
            'removedId' => $id,
            'cartCount' => $totalCount
        ]);
        break;

    case 'cart/clear':
        if ($method !== 'POST') {
            apiResponse(405, false, 'Phương thức không được hỗ trợ. Vui lòng dùng POST.');
        }
        $_SESSION['cart'] = [];
        apiResponse(200, true, 'Đã làm trống giỏ hàng thành công');
        break;

    // ---------------------------------------------------------------------
    // 4. ORDERS & CHECKOUT API
    // ---------------------------------------------------------------------
    case 'order/checkout':
        if ($method !== 'POST') {
            apiResponse(405, false, 'Phương thức không được hỗ trợ. Vui lòng dùng POST.');
        }

        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) {
            apiResponse(400, false, 'Giỏ hàng đang trống. Vui lòng thêm sản phẩm trước khi thanh toán.');
        }

        $name    = trim($requestData['receiver_name'] ?? '');
        $phone   = trim($requestData['receiver_phone'] ?? '');
        $address = trim($requestData['receiver_address'] ?? '');
        $payment = (int)($requestData['payment_method'] ?? 0);
        $note    = trim($requestData['note'] ?? '');

        $errors = [];
        if (empty($name)) $errors['receiver_name'] = 'Tên người nhận không được để trống';
        if (empty($phone)) $errors['receiver_phone'] = 'Số điện thoại nhận hàng không được để trống';
        elseif (!preg_match('/^[0-9]{10,11}$/', $phone)) $errors['receiver_phone'] = 'Số điện thoại không hợp lệ (10-11 chữ số)';
        if (empty($address)) $errors['receiver_address'] = 'Địa chỉ giao hàng không được để trống';

        if (!empty($errors)) {
            apiResponse(400, false, 'Dữ liệu giao hàng không hợp lệ', null, $errors);
        }

        $userId = isset($_SESSION['user']['id']) ? (int)$_SESSION['user']['id'] : null;

        $orderModel = new Order();
        $orderData = [
            'TenNguoiNhan' => $name,
            'SDTNhan'      => $phone,
            'DiaChi'       => $address,
            'PhuongThucTT' => $payment,
            'GhiChu'       => $note
        ];

        try {
            $maDH = $orderModel->createOrder($orderData, $cart, $userId);
            if ($maDH) {
                // Làm sạch giỏ sau khi đặt hàng thành công
                $_SESSION['cart'] = [];
                apiResponse(201, true, 'Đặt hàng thành công! Đơn hàng đang được xử lý.', [
                    'orderId'       => (int)$maDH,
                    'receiverName'  => $name,
                    'receiverPhone' => $phone,
                    'address'       => $address,
                    'paymentMethod' => ($payment === 1) ? 'Chuyển khoản' : 'Thanh toán khi nhận hàng (COD)',
                    'status'        => 'Chờ xác nhận'
                ]);
            } else {
                apiResponse(500, false, 'Tạo đơn hàng thất bại do lỗi xử lý CSDL.');
            }
        } catch (Exception $e) {
            apiResponse(500, false, 'Lỗi ngoại lệ khi tạo đơn hàng: ' . $e->getMessage());
        }
        break;

    case 'orders':
        if ($method !== 'GET') {
            apiResponse(405, false, 'Phương thức không được hỗ trợ. Vui lòng dùng GET.');
        }

        $userId = isset($_SESSION['user']['id']) ? (int)$_SESSION['user']['id'] : null;
        if (!$userId) {
            // Cho phép test lấy toàn bộ nếu là admin hoặc danh sách mẫu
            $stmt = $db->query("SELECT MaDH, MaND, TenNguoiNhan, SDTNhan, DiaChi, TongTien, TrangThai, NgayDat FROM donhang ORDER BY MaDH DESC LIMIT 20");
        } else {
            $stmt = $db->prepare("SELECT MaDH, MaND, TenNguoiNhan, SDTNhan, DiaChi, TongTien, TrangThai, NgayDat FROM donhang WHERE MaND = ? ORDER BY MaDH DESC");
            $stmt->execute([$userId]);
        }
        $orders = $stmt->fetchAll();
        foreach ($orders as &$o) {
            $o['MaDH']     = (int)$o['MaDH'];
            $o['TongTien'] = (float)$o['TongTien'];
            $o['TrangThaiTen'] = match ((int)$o['TrangThai']) {
                0 => 'Chờ xác nhận',
                1 => 'Đang giao hàng',
                2 => 'Đã giao hàng',
                3 => 'Đã hủy',
                default => 'Không xác định'
            };
        }
        apiResponse(200, true, 'Lấy danh sách đơn hàng thành công', $orders);
        break;

    case 'orders/detail':
        if ($method !== 'GET') {
            apiResponse(405, false, 'Phương thức không được hỗ trợ. Vui lòng dùng GET.');
        }
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            apiResponse(400, false, 'Tham số ID đơn hàng không hợp lệ');
        }

        $stmt = $db->prepare("SELECT * FROM donhang WHERE MaDH = ?");
        $stmt->execute([$id]);
        $order = $stmt->fetch();

        if (!$order) {
            apiResponse(404, false, "Không tìm thấy đơn hàng có mã ID = $id");
        }

        $stmtItems = $db->prepare("SELECT c.*, s.TenSP, s.HinhAnh 
                                   FROM chitiet_donhang c
                                   JOIN sanpham s ON c.MaSP = s.MaSP
                                   WHERE c.MaDH = ?");
        $stmtItems->execute([$id]);
        $order['items'] = $stmtItems->fetchAll();

        apiResponse(200, true, 'Lấy chi tiết đơn hàng thành công', $order);
        break;

    // ---------------------------------------------------------------------
    // 5. ADMIN & METRICS API
    // ---------------------------------------------------------------------
    case 'admin/stats':
        if ($method !== 'GET') {
            apiResponse(405, false, 'Phương thức không được hỗ trợ. Vui lòng dùng GET.');
        }

        $totalProducts = (int)$db->query("SELECT COUNT(*) FROM sanpham")->fetchColumn();
        $totalOrders   = (int)$db->query("SELECT COUNT(*) FROM donhang")->fetchColumn();
        $totalUsers    = (int)$db->query("SELECT COUNT(*) FROM nguoidung")->fetchColumn();
        $totalRevenue  = (float)$db->query("SELECT COALESCE(SUM(TongTien), 0) FROM donhang WHERE TrangThai != 3")->fetchColumn();

        apiResponse(200, true, 'Lấy thống kê hệ thống thành công', [
            'totalProducts' => $totalProducts,
            'totalOrders'   => $totalOrders,
            'totalUsers'    => $totalUsers,
            'totalRevenue'  => $totalRevenue,
            'revenueFormatted' => number_format($totalRevenue, 0, ',', '.') . ' ₫'
        ]);
        break;

    default:
        apiResponse(404, false, "Endpoint '$endpoint' không tồn tại trên hệ thống API.");
        break;
}
