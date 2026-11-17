<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/Cart.php';

class OrderController extends Controller
{
    private function requireLogin()
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('index.php?controller=auth&action=login');
        }
    }

    public function checkout()
    {
        $this->requireLogin();

        $cartModel = new Cart();
        $cart = $cartModel->getItems();

        if (empty($cart)) {
            echo "Giỏ hàng trống!";
            return;
        }

        $this->view('order/checkout', ['cart' => $cart]);
    }

   public function placeOrder()
{
    $this->requireLogin();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $this->redirect('index.php?controller=order&action=checkout');
        return;
    }

    $cartModel = new Cart();
    $cart = $cartModel->getItems();

    if (empty($cart)) {
        die('Giỏ hàng trống!');
    }

    $tenNguoiNhan = trim($_POST['TenNguoiNhan'] ?? '');
    $sdtNhan = trim($_POST['SDTNhan'] ?? '');
    $diaChi = trim($_POST['DiaChi'] ?? '');
    $phuongThucTT = (int)($_POST['PhuongThucTT'] ?? 0);
    $ghiChu = trim($_POST['GhiChu'] ?? '');

    if ($tenNguoiNhan === '' || $sdtNhan === '' || $diaChi === '') {
        die('Vui lòng nhập đầy đủ thông tin đặt hàng.');
    }

    if (!preg_match('/^0[0-9]{9}$/', $sdtNhan)) {
        die('Số điện thoại nhận phải gồm 10 số và bắt đầu bằng 0.');
    }

    if (!in_array($phuongThucTT, [1, 2, 3], true)) {
        die('Phương thức thanh toán không hợp lệ.');
    }

    $orderModel = new Order();
    $userId = (int)$_SESSION['user']['id'];

    $created = $orderModel->createOrder([
        'TenNguoiNhan' => $tenNguoiNhan,
        'SDTNhan' => $sdtNhan,
        'DiaChi' => $diaChi,
        'PhuongThucTT' => $phuongThucTT,
        'GhiChu' => $ghiChu
    ], $cart, $userId);

    if ($created) {
        $cartModel->clear();
        $this->redirect('index.php?controller=order&action=success');
        return;
    }

    die('Không thể tạo đơn hàng.');
}

    public function success()
    {
        $this->requireLogin();
        $this->view('order/success');
    }

    public function myOrders()
    {
        $this->requireLogin();

        $orderModel = new Order();
        $userId = (int)$_SESSION['user']['id'];
        $orders = $orderModel->getByUser($userId);

        foreach ($orders as &$order) {
            $status = (int)($order['TrangThai'] ?? -1);
            $order['TrangThaiText'] = match ($status) {
                0 => 'Chờ xác nhận',
                1 => 'Đang đóng gói',
                2 => 'Đang giao',
                3 => 'Đã giao',
                4 => 'Đã hủy',
                default => 'Không xác định'
            };

            $payment = (int)($order['PhuongThucTT'] ?? 0);
            $order['PaymentText'] = match ($payment) {
                1 => 'COD',
                2 => 'Chuyển khoản',
                3 => 'Ví điện tử',
                default => 'Không xác định'
            };
        }
        unset($order);

        $this->view('order/my_orders', [
            'title' => 'Đơn hàng của tôi',
            'orders' => $orders
        ]);
    }

    public function detail()
    {
        $this->requireLogin();

        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            die('Đơn hàng không hợp lệ');
        }

        $orderModel = new Order();
        $order = $orderModel->getById($id);

        if (!$order) {
            die('Không tìm thấy đơn hàng');
        }

        $userId = (int)($_SESSION['user']['id'] ?? 0);
        if ((int)($order['MaND'] ?? 0) !== $userId) {
            die('Bạn không có quyền xem đơn hàng này');
        }

        $orderDetails = $orderModel->getDetails($id);

        $statusText = match ((int)($order['TrangThai'] ?? -1)) {
            0 => 'Chờ xác nhận',
            1 => 'Đang đóng gói',
            2 => 'Đang giao',
            3 => 'Đã giao',
            4 => 'Đã hủy',
            default => 'Không xác định'
        };

        $paymentText = match ((int)($order['PhuongThucTT'] ?? 0)) {
            1 => 'COD',
            2 => 'Chuyển khoản',
            3 => 'Ví điện tử',
            default => 'Không xác định'
        };

        $this->view('order/detail', [
            'title' => 'Chi tiết đơn hàng',
            'order' => $order,
            'orderDetails' => $orderDetails,
            'statusText' => $statusText,
            'paymentText' => $paymentText
        ]);
    }
}