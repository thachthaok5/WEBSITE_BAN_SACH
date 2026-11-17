<?php

require_once __DIR__ . '/../core/Model.php';

class User extends Model
{
    public function findByUsername(string $username)
    {
        $sql = "SELECT * FROM nguoidung WHERE TenDangNhap = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function findByEmail(string $email)
    {
        $sql = "SELECT * FROM nguoidung WHERE Email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function findById(int $id)
    {
        $sql = "SELECT * FROM nguoidung WHERE MaND = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO nguoidung (TenDangNhap, MatKhau, HoTen, Email, SoDienThoai, Quyen)
                VALUES (?, ?, ?, ?, ?, 1)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $data['username'],
            password_hash($data['password'], PASSWORD_BCRYPT),
            $data['fullname'],
            $data['email'],
            $data['phone']
        ]);
    }

    public function updateProfile(int $id, array $data): bool
    {
        $sql = "UPDATE nguoidung
                SET HoTen = ?, Email = ?, SoDienThoai = ?
                WHERE MaND = ?";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $data['fullname'],
            $data['email'],
            $data['phone'],
            $id
        ]);
    }

    public function updatePassword(int $id, string $newPassword): bool
    {
        $sql = "UPDATE nguoidung SET MatKhau = ? WHERE MaND = ?";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            password_hash($newPassword, PASSWORD_BCRYPT),
            $id
        ]);
    }

    public function getAll()
    {
        $sql = "SELECT MaND, TenDangNhap, HoTen, Email, SoDienThoai, Quyen
                FROM nguoidung
                ORDER BY MaND DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function delete(int $id): bool
{
    $sql = "DELETE FROM nguoidung WHERE MaND = ?";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$id]);
}
}