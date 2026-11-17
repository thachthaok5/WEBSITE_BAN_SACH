<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';

class AuthController extends Controller
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if ($username === '' || $password === '') {
                $this->view('auth/login', ['error' => 'Vui lòng nhập đầy đủ tài khoản và mật khẩu']);
                return;
            }

            $userModel = new User();
            $user = $userModel->findByUsername($username);

            if ($user && password_verify($password, $user['MatKhau'])) {
                $_SESSION['user'] = [
                    'id' => $user['MaND'],
                    'username' => $user['TenDangNhap'],
                    'fullname' => $user['HoTen'],
                    'role' => $user['Quyen']
                ];

                if ((int)$user['Quyen'] === 2) {
                    $this->redirect('index.php?controller=admin&action=dashboard');
                } else {
                    $redirect = $_SESSION['redirect_after_login'] ?? 'index.php';
                    unset($_SESSION['redirect_after_login']);
                    $this->redirect($redirect);
                }
            } else {
                $this->view('auth/login', ['error' => 'Sai tài khoản hoặc mật khẩu']);
                return;
            }
        }

        $this->view('auth/login');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $confirmPassword = trim($_POST['confirm_password'] ?? '');
            $fullname = trim($_POST['fullname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');

            if (
                $username === '' ||
                $password === '' ||
                $confirmPassword === '' ||
                $fullname === '' ||
                $email === '' ||
                $phone === ''
            ) {
                $this->view('auth/register', ['error' => 'Vui lòng nhập đầy đủ thông tin']);
                return;
            }

            if ($password !== $confirmPassword) {
                $this->view('auth/register', ['error' => 'Mật khẩu nhập lại không khớp']);
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->view('auth/register', ['error' => 'Email không hợp lệ']);
                return;
            }

            if (!preg_match('/^0[0-9]{9}$/', $phone)) {
                $this->view('auth/register', ['error' => 'Số điện thoại phải gồm 10 số và bắt đầu bằng 0']);
                return;
            }

            $userModel = new User();

            if ($userModel->findByUsername($username)) {
                $this->view('auth/register', ['error' => 'Tên đăng nhập đã tồn tại']);
                return;
            }

            $created = $userModel->create([
                'username' => $username,
                'password' => $password,
                'fullname' => $fullname,
                'email' => $email,
                'phone' => $phone
            ]);

            if ($created) {
                $this->view('auth/register', ['success' => 'Đăng ký thành công! Bạn có thể đăng nhập ngay.']);
                return;
            }

            $this->view('auth/register', ['error' => 'Đăng ký thất bại, vui lòng thử lại']);
            return;
        }

        $this->view('auth/register');
    }

    public function logout()
    {
        unset($_SESSION['user']);
        unset($_SESSION['redirect_after_login']);
        session_destroy();
        $this->redirect('index.php');
    }
}