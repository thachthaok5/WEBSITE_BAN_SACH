<?php

require_once __DIR__ . '/../core/Model.php';

class Stationery extends Model
{
    public function getAll()
    {
        $sql = "SELECT sp.*, vpp.ThuongHieu, vpp.XuatXu, vpp.MauSac
                FROM sanpham sp
                INNER JOIN vanphongpham vpp ON sp.MaSP = vpp.MaSP
                WHERE sp.LoaiSP = 2
                ORDER BY sp.MaSP DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById(int $id)
    {
        $sql = "SELECT sp.*, vpp.ThuongHieu, vpp.XuatXu, vpp.MauSac
                FROM sanpham sp
                INNER JOIN vanphongpham vpp ON sp.MaSP = vpp.MaSP
                WHERE sp.MaSP = ? AND sp.LoaiSP = 2";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function search(string $keyword)
    {
        $sql = "SELECT sp.*, vpp.ThuongHieu, vpp.XuatXu, vpp.MauSac
                FROM sanpham sp
                INNER JOIN vanphongpham vpp ON sp.MaSP = vpp.MaSP
                WHERE sp.LoaiSP = 2
                  AND (sp.TenSP LIKE ? OR vpp.ThuongHieu LIKE ? OR vpp.MauSac LIKE ?)
                ORDER BY sp.MaSP DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            '%' . $keyword . '%',
            '%' . $keyword . '%',
            '%' . $keyword . '%'
        ]);
        return $stmt->fetchAll();
    }

    public function create(int $maSP, array $data): bool
    {
        $sql = "INSERT INTO vanphongpham (MaSP, ThuongHieu, XuatXu, MauSac)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $maSP,
            $data['ThuongHieu'],
            $data['XuatXu'] ?? null,
            $data['MauSac'] ?? null
        ]);
    }

    public function update(int $maSP, array $data): bool
    {
        $sql = "UPDATE vanphongpham
                SET ThuongHieu = ?, XuatXu = ?, MauSac = ?
                WHERE MaSP = ?";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $data['ThuongHieu'],
            $data['XuatXu'] ?? null,
            $data['MauSac'] ?? null,
            $maSP
        ]);
    }

    public function delete(int $maSP): bool
    {
        $sql = "DELETE FROM vanphongpham WHERE MaSP = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$maSP]);
    }
}