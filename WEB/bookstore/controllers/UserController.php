<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';

class UserController extends Controller
{
    private function requireLogin()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'] ?? 'index.php';
            $this->redirect('index.php?controller=auth&action=login');
        }
    }

    public function profile()
    {
        $this->requireLogin();

        $userModel = new User();
        $user = $userModel->findById((int)$_SESSION['user']['id']);

        $this->view('user/profile', [
            'title' => 'Thông tin cá nhân',
            'user' => $user
        ]);
    }

    public function edit()
    {
        $this->requireLogin();

        $userModel = new User();
        $userId = (int)$_SESSION['user']['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname = trim($_POST['fullname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');

            if ($fullname === '' || $email === '' || $phone === '') {
                $user = $userModel->findById($userId);
                $this->view('user/edit', [
                    'title' => 'Cập nhật thông tin',
                    'user' => $user,
                    'error' => 'Vui lòng nhập đầy đủ thông tin'
                ]);
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $user = $userModel->findById($userId);
                $this->view('user/edit', [
                    'title' => 'Cập nhật thông tin',
                    'user' => $user,
                    'error' => 'Email không hợp lệ'
                ]);
                return;
            }

            if (!preg_match('/^0[0-9]{9}$/', $phone)) {
                $user = $userModel->findById($userId);
                $this->view('user/edit', [
                    'title' => 'Cập nhật thông tin',
                    'user' => $user,
                    'error' => 'Số điện thoại phải gồm 10 số và bắt đầu bằng 0'
                ]);
                return;
            }

            $existingEmail = $userModel->findByEmail($email);
            if ($existingEmail && (int)$existingEmail['MaND'] !== $userId) {
                $user = $userModel->findById($userId);
                $this->view('user/edit', [
                    'title' => 'Cập nhật thông tin',
                    'user' => $user,
                    'error' => 'Email đã được sử dụng'
                ]);
                return;
            }

            $updated = $userModel->updateProfile($userId, [
                'fullname' => $fullname,
                'email' => $email,
                'phone' => $phone
            ]);

            if ($updated) {
                $_SESSION['user']['fullname'] = $fullname;
                $this->redirect('index.php?controller=user&action=profile');
                return;
            }

            $user = $userModel->findById($userId);
            $this->view('user/edit', [
                'title' => 'Cập nhật thông tin',
                'user' => $user,
                'error' => 'Cập nhật thất bại'
            ]);
            return;
        }

        $user = $userModel->findById($userId);

        $this->view('user/edit', [
            'title' => 'Cập nhật thông tin',
            'user' => $user
        ]);
    }

    public function changePassword()
    {
        $this->requireLogin();

        $userModel = new User();
        $userId = (int)$_SESSION['user']['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $oldPassword = trim($_POST['old_password'] ?? '');
            $newPassword = trim($_POST['new_password'] ?? '');
            $confirmPassword = trim($_POST['confirm_password'] ?? '');

            if ($oldPassword === '' || $newPassword === '' || $confirmPassword === '') {
                $this->view('user/change_password', [
                    'title' => 'Đổi mật khẩu',
                    'error' => 'Vui lòng nhập đầy đủ thông tin'
                ]);
                return;
            }

            if (strlen($newPassword) < 6) {
                $this->view('user/change_password', [
                    'title' => 'Đổi mật khẩu',
                    'error' => 'Mật khẩu mới phải có ít nhất 6 ký tự'
                ]);
                return;
            }

            if ($newPassword !== $confirmPassword) {
                $this->view('user/change_password', [
                    'title' => 'Đổi mật khẩu',
                    'error' => 'Mật khẩu xác nhận không khớp'
                ]);
                return;
            }

            $user = $userModel->findById($userId);

            if (!$user || !password_verify($oldPassword, $user['MatKhau'])) {
                $this->view('user/change_password', [
                    'title' => 'Đổi mật khẩu',
                    'error' => 'Mật khẩu cũ không đúng'
                ]);
                return;
            }

            $updated = $userModel->updatePassword($userId, $newPassword);

            if ($updated) {
                $this->view('user/change_password', [
                    'title' => 'Đổi mật khẩu',
                    'success' => 'Đổi mật khẩu thành công'
                ]);
                return;
            }

            $this->view('user/change_password', [
                'title' => 'Đổi mật khẩu',
                'error' => 'Không thể đổi mật khẩu'
            ]);
            return;
        }

        $this->view('user/change_password', [
            'title' => 'Đổi mật khẩu'
        ]);
    }
}