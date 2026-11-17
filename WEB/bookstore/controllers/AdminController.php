<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Book.php';
require_once __DIR__ . '/../models/Stationery.php';
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/User.php';

class AdminController extends Controller
{
    private function checkAdmin()
    {
        if (!isset($_SESSION['user']) || (int)$_SESSION['user']['role'] !== 2) {
            die('Không có quyền truy cập!');
        }
    }

    private function uploadImage(string $fieldName = 'HinhAnh', string $oldImage = 'default.jpg'): string
    {
        if (
            !isset($_FILES[$fieldName]) ||
            !is_array($_FILES[$fieldName]) ||
            $_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK
        ) {
            return $oldImage;
        }

        $fileTmpPath = $_FILES[$fieldName]['tmp_name'];
        $fileName = $_FILES[$fieldName]['name'];
        $fileSize = (int)$_FILES[$fieldName]['size'];

        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($extension, $allowedExtensions, true)) {
            return $oldImage;
        }

        if ($fileSize > 2 * 1024 * 1024) {
            return $oldImage;
        }

        $uploadDir = __DIR__ . '/../public/uploads/products/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $newFileName = time() . '_' . uniqid() . '.' . $extension;
        $destPath = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            return $newFileName;
        }

        return $oldImage;
    }

   public function dashboard()
{
    $this->checkAdmin();

    $productModel = new Product();
    $orderModel = new Order();
    $userModel = new User();

    $products = $productModel->getAll();
    $orders = $orderModel->getAll();
    $users = $userModel->getAll();

    $totalProducts = is_array($products) ? count($products) : 0;
    $totalOrders = is_array($orders) ? count($orders) : 0;
    $totalUsers = is_array($users) ? count($users) : 0;
    $totalRevenue = $orderModel->getDeliveredRevenue();

    $this->view('admin/dashboard', [
        'title' => 'Dashboard Admin',
        'totalProducts' => $totalProducts,
        'totalOrders' => $totalOrders,
        'totalUsers' => $totalUsers,
        'totalRevenue' => $totalRevenue
    ]);
}

    public function productList()
    {
        $this->checkAdmin();

        $productModel = new Product();
        $products = $productModel->getAll();

        $this->view('admin/product_list', [
            'title' => 'Quản lý sản phẩm',
            'products' => $products
        ]);
    }

    public function addBook()
    {
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenSP = trim($_POST['TenSP'] ?? '');
            $isbn = trim($_POST['ISBN'] ?? '');
            $tacGia = trim($_POST['TacGia'] ?? '');
            $nxb = trim($_POST['NXB'] ?? '');
            $soTrang = (int)($_POST['SoTrang'] ?? 0);
            $giaBan = (int)($_POST['GiaBan'] ?? 0);
            $tonKho = (int)($_POST['TonKho'] ?? 0);
            $kichThuocTL = trim($_POST['KichThuocTL'] ?? '');
            $moTa = trim($_POST['MoTa'] ?? '');

            if ($tenSP === '' || $isbn === '' || $giaBan <= 0 || $tonKho < 0) {
                $this->view('admin/product_add_book', [
                    'title' => 'Thêm sách',
                    'error' => 'Vui lòng nhập đầy đủ và đúng thông tin bắt buộc'
                ]);
                return;
            }

            $bookModel = new Book();
            if ($bookModel->isbnExists($isbn)) {
                $this->view('admin/product_add_book', [
                    'title' => 'Thêm sách',
                    'error' => 'ISBN đã tồn tại'
                ]);
                return;
            }

            $hinhAnh = $this->uploadImage('HinhAnh');

            $productModel = new Product();
            $createdProduct = $productModel->create([
                'TenSP' => $tenSP,
                'LoaiSP' => 1,
                'GiaBan' => $giaBan,
                'TonKho' => $tonKho,
                'HinhAnh' => $hinhAnh,
                'MoTa' => $moTa
            ]);

            if (!$createdProduct) {
                $this->view('admin/product_add_book', [
                    'title' => 'Thêm sách',
                    'error' => 'Không thể tạo sản phẩm'
                ]);
                return;
            }

            $maSP = $productModel->getLastInsertId();

            $createdBook = $bookModel->create($maSP, [
                'ISBN' => $isbn,
                'TacGia' => $tacGia,
                'NXB' => $nxb,
                'SoTrang' => $soTrang,
                'KichThuocTL' => $kichThuocTL
            ]);

            if ($createdBook) {
                $this->view('admin/product_add_book', [
                    'title' => 'Thêm sách',
                    'success' => 'Thêm sách thành công'
                ]);
                return;
            }

            $this->view('admin/product_add_book', [
                'title' => 'Thêm sách',
                'error' => 'Không thể lưu chi tiết sách'
            ]);
            return;
        }

        $this->view('admin/product_add_book', ['title' => 'Thêm sách']);
    }

    public function addStationery()
    {
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenSP = trim($_POST['TenSP'] ?? '');
            $thuongHieu = trim($_POST['ThuongHieu'] ?? '');
            $xuatXu = trim($_POST['XuatXu'] ?? '');
            $mauSac = trim($_POST['MauSac'] ?? '');
            $giaBan = (int)($_POST['GiaBan'] ?? 0);
            $tonKho = (int)($_POST['TonKho'] ?? 0);
            $moTa = trim($_POST['MoTa'] ?? '');

            if ($tenSP === '' || $thuongHieu === '' || $giaBan <= 0 || $tonKho < 0) {
                $this->view('admin/product_add_stationery', [
                    'title' => 'Thêm văn phòng phẩm',
                    'error' => 'Vui lòng nhập đầy đủ và đúng thông tin bắt buộc'
                ]);
                return;
            }

            $hinhAnh = $this->uploadImage('HinhAnh');

            $productModel = new Product();
            $createdProduct = $productModel->create([
                'TenSP' => $tenSP,
                'LoaiSP' => 2,
                'GiaBan' => $giaBan,
                'TonKho' => $tonKho,
                'HinhAnh' => $hinhAnh,
                'MoTa' => $moTa
            ]);

            if (!$createdProduct) {
                $this->view('admin/product_add_stationery', [
                    'title' => 'Thêm văn phòng phẩm',
                    'error' => 'Không thể tạo sản phẩm'
                ]);
                return;
            }

            $maSP = $productModel->getLastInsertId();

            $stationeryModel = new Stationery();
            $createdStationery = $stationeryModel->create($maSP, [
                'ThuongHieu' => $thuongHieu,
                'XuatXu' => $xuatXu,
                'MauSac' => $mauSac
            ]);

            if ($createdStationery) {
                $this->view('admin/product_add_stationery', [
                    'title' => 'Thêm văn phòng phẩm',
                    'success' => 'Thêm văn phòng phẩm thành công'
                ]);
                return;
            }

            $this->view('admin/product_add_stationery', [
                'title' => 'Thêm văn phòng phẩm',
                'error' => 'Không thể lưu chi tiết văn phòng phẩm'
            ]);
            return;
        }

        $this->view('admin/product_add_stationery', ['title' => 'Thêm văn phòng phẩm']);
    }

    public function editProduct()
    {
        $this->checkAdmin();

        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            die('Sản phẩm không hợp lệ');
        }

        $productModel = new Product();
        $product = $productModel->getById($id);

        if (!$product) {
            die('Không tìm thấy sản phẩm');
        }

        $loaiSP = (int)$product['LoaiSP'];

        if ($loaiSP === 1) {
            $bookModel = new Book();
            $productDetail = $bookModel->getById($id);

            $this->view('admin/product_edit_book', [
                'title' => 'Sửa sách',
                'product' => $productDetail
            ]);
            return;
        }

        if ($loaiSP === 2) {
            $stationeryModel = new Stationery();
            $productDetail = $stationeryModel->getById($id);

            $this->view('admin/product_edit_stationery', [
                'title' => 'Sửa văn phòng phẩm',
                'product' => $productDetail
            ]);
            return;
        }

        die('Loại sản phẩm không hợp lệ');
    }

    public function updateProduct()
    {
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('index.php?controller=admin&action=productList');
        }

        $maSP = (int)($_POST['MaSP'] ?? 0);
        $loaiSP = (int)($_POST['LoaiSP'] ?? 0);

        if ($maSP <= 0 || !in_array($loaiSP, [1, 2], true)) {
            die('Dữ liệu không hợp lệ');
        }

        $productModel = new Product();
        $oldProduct = $productModel->getById($maSP);

        if (!$oldProduct) {
            die('Không tìm thấy sản phẩm');
        }

        $hinhAnh = $this->uploadImage('HinhAnh', $oldProduct['HinhAnh'] ?? 'default.jpg');

        if ($loaiSP === 1) {
            $tenSP = trim($_POST['TenSP'] ?? '');
            $isbn = trim($_POST['ISBN'] ?? '');
            $tacGia = trim($_POST['TacGia'] ?? '');
            $nxb = trim($_POST['NXB'] ?? '');
            $soTrang = (int)($_POST['SoTrang'] ?? 0);
            $giaBan = (int)($_POST['GiaBan'] ?? 0);
            $tonKho = (int)($_POST['TonKho'] ?? 0);
            $kichThuocTL = trim($_POST['KichThuocTL'] ?? '');
            $moTa = trim($_POST['MoTa'] ?? '');

            if ($tenSP === '' || $isbn === '' || $giaBan <= 0 || $tonKho < 0) {
                $bookModel = new Book();
                $product = $bookModel->getById($maSP);

                $this->view('admin/product_edit_book', [
                    'title' => 'Sửa sách',
                    'product' => $product,
                    'error' => 'Vui lòng nhập đầy đủ và đúng thông tin'
                ]);
                return;
            }

            $bookModel = new Book();
            if ($bookModel->isbnExists($isbn, $maSP)) {
                $product = $bookModel->getById($maSP);

                $this->view('admin/product_edit_book', [
                    'title' => 'Sửa sách',
                    'product' => $product,
                    'error' => 'ISBN đã tồn tại'
                ]);
                return;
            }

            $updatedProduct = $productModel->update($maSP, [
                'TenSP' => $tenSP,
                'GiaBan' => $giaBan,
                'TonKho' => $tonKho,
                'HinhAnh' => $hinhAnh,
                'MoTa' => $moTa
            ]);

            $updatedBook = $bookModel->update($maSP, [
                'ISBN' => $isbn,
                'TacGia' => $tacGia,
                'NXB' => $nxb,
                'SoTrang' => $soTrang,
                'KichThuocTL' => $kichThuocTL
            ]);

            if ($updatedProduct && $updatedBook) {
                $this->redirect('index.php?controller=admin&action=productList');
                return;
            }

            $product = $bookModel->getById($maSP);
            $this->view('admin/product_edit_book', [
                'title' => 'Sửa sách',
                'product' => $product,
                'error' => 'Cập nhật thất bại'
            ]);
            return;
        }

        if ($loaiSP === 2) {
            $tenSP = trim($_POST['TenSP'] ?? '');
            $thuongHieu = trim($_POST['ThuongHieu'] ?? '');
            $xuatXu = trim($_POST['XuatXu'] ?? '');
            $mauSac = trim($_POST['MauSac'] ?? '');
            $giaBan = (int)($_POST['GiaBan'] ?? 0);
            $tonKho = (int)($_POST['TonKho'] ?? 0);
            $moTa = trim($_POST['MoTa'] ?? '');

            if ($tenSP === '' || $thuongHieu === '' || $giaBan <= 0 || $tonKho < 0) {
                $stationeryModel = new Stationery();
                $product = $stationeryModel->getById($maSP);

                $this->view('admin/product_edit_stationery', [
                    'title' => 'Sửa văn phòng phẩm',
                    'product' => $product,
                    'error' => 'Vui lòng nhập đầy đủ và đúng thông tin'
                ]);
                return;
            }

            $updatedProduct = $productModel->update($maSP, [
                'TenSP' => $tenSP,
                'GiaBan' => $giaBan,
                'TonKho' => $tonKho,
                'HinhAnh' => $hinhAnh,
                'MoTa' => $moTa
            ]);

            $stationeryModel = new Stationery();
            $updatedStationery = $stationeryModel->update($maSP, [
                'ThuongHieu' => $thuongHieu,
                'XuatXu' => $xuatXu,
                'MauSac' => $mauSac
            ]);

            if ($updatedProduct && $updatedStationery) {
                $this->redirect('index.php?controller=admin&action=productList');
                return;
            }

            $product = $stationeryModel->getById($maSP);
            $this->view('admin/product_edit_stationery', [
                'title' => 'Sửa văn phòng phẩm',
                'product' => $product,
                'error' => 'Cập nhật thất bại'
            ]);
            return;
        }

        die('Loại sản phẩm không hợp lệ');
    }

   public function deleteProduct()
{
    $this->checkAdmin();

    $id = (int)($_GET['id'] ?? 0);
    if ($id <= 0) {
        die('Sản phẩm không hợp lệ');
    }

    $productModel = new Product();
    $product = $productModel->getById($id);

    if (!$product) {
        die('Không tìm thấy sản phẩm');
    }

    if ($productModel->hasOrderDetails($id)) {
        die('Không thể xóa sản phẩm vì sản phẩm này đã tồn tại trong đơn hàng.');
    }

    $deleted = $productModel->delete($id);

    if ($deleted) {
        $this->redirect('index.php?controller=admin&action=productList');
        return;
    }

    die('Xóa sản phẩm thất bại');
}

    public function orderList()
    {
        $this->checkAdmin();

        $orderModel = new Order();
        $orders = $orderModel->getAll();

        foreach ($orders as &$order) {
            $status = (int)($order['TrangThai'] ?? -1);
            $order['TrangThai'] = match ($status) {
                0 => 'Chờ xác nhận',
                1 => 'Đang đóng gói',
                2 => 'Đang giao',
                3 => 'Đã giao',
                4 => 'Đã hủy',
                default => 'Không xác định'
            };
        }
        unset($order);

        $this->view('admin/order_list', [
            'title' => 'Quản lý đơn hàng',
            'orders' => $orders
        ]);
    }
    public function orderDetail()
{
    $this->checkAdmin();

    $id = (int)($_GET['id'] ?? 0);
    if ($id <= 0) {
        die('Đơn hàng không hợp lệ');
    }

    $orderModel = new Order();
    $order = $orderModel->getById($id);

    if (!$order) {
        die('Không tìm thấy đơn hàng');
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

    $this->view('admin/order_detail', [
        'title' => 'Chi tiết đơn hàng',
        'order' => $order,
        'orderDetails' => $orderDetails,
        'statusText' => $statusText,
        'paymentText' => $paymentText
    ]);
}

public function updateOrderStatus()
{
    $this->checkAdmin();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $this->redirect('index.php?controller=admin&action=orderList');
    }

    $maDH = (int)($_POST['MaDH'] ?? 0);
    $trangThai = (int)($_POST['TrangThai'] ?? -1);

    if ($maDH <= 0 || !in_array($trangThai, [0, 1, 2, 3, 4], true)) {
        die('Dữ liệu không hợp lệ');
    }

    $orderModel = new Order();
    $updated = $orderModel->updateStatus($maDH, $trangThai);

    if ($updated) {
        $this->redirect('index.php?controller=admin&action=orderDetail&id=' . $maDH);
        return;
    }

    die('Cập nhật trạng thái thất bại');
}
public function userList()
{
    $this->checkAdmin();

    $userModel = new User();
    $users = $userModel->getAll();

    $this->view('admin/user_list', [
        'title' => 'Quản lý tài khoản',
        'users' => $users
    ]);
}
public function deleteUser()
{
    $this->checkAdmin();

    $id = (int)($_GET['id'] ?? 0);
    if ($id <= 0) {
        die('Tài khoản không hợp lệ');
    }

    if ((int)($_SESSION['user']['id'] ?? 0) === $id) {
        die('Không thể xóa chính tài khoản admin đang đăng nhập');
    }

    $userModel = new User();
    $user = $userModel->findById($id);

    if (!$user) {
        die('Không tìm thấy tài khoản');
    }

    if ((int)($user['Quyen'] ?? 1) === 2) {
        die('Không thể xóa tài khoản admin');
    }

    $deleted = $userModel->delete($id);

    if ($deleted) {
        $this->redirect('index.php?controller=admin&action=userList');
        return;
    }

    die('Xóa tài khoản thất bại');
}
}
