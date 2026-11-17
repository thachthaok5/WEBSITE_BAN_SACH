<?php

require_once __DIR__ . '/../core/Model.php';

class Product extends Model
{
    public function getAll()
    {
        $sql = "SELECT * FROM sanpham ORDER BY MaSP DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById(int $id)
    {
        $sql = "SELECT sp.*, 
                       s.ISBN, s.TacGia, s.NXB, s.SoTrang, s.KichThuocTL,
                       v.ThuongHieu, v.XuatXu, v.MauSac
                FROM sanpham sp
                LEFT JOIN sach s ON sp.MaSP = s.MaSP
                LEFT JOIN vanphongpham v ON sp.MaSP = v.MaSP
                WHERE sp.MaSP = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function searchByName(string $keyword)
    {
        $sql = "SELECT * FROM sanpham
                WHERE TenSP LIKE ? OR MoTa LIKE ?
                ORDER BY MaSP DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            '%' . $keyword . '%',
            '%' . $keyword . '%'
        ]);
        return $stmt->fetchAll();
    }

    public function getByCategory(int $loaiSP)
    {
        $sql = "SELECT * FROM sanpham WHERE LoaiSP = ? ORDER BY MaSP DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$loaiSP]);
        return $stmt->fetchAll();
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO sanpham (TenSP, LoaiSP, GiaBan, TonKho, HinhAnh, MoTa)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $data['TenSP'],
            $data['LoaiSP'],
            $data['GiaBan'],
            $data['TonKho'],
            $data['HinhAnh'],
            $data['MoTa'] ?? null
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE sanpham
                SET TenSP = ?, GiaBan = ?, TonKho = ?, HinhAnh = ?, MoTa = ?
                WHERE MaSP = ?";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $data['TenSP'],
            $data['GiaBan'],
            $data['TonKho'],
            $data['HinhAnh'],
            $data['MoTa'] ?? null,
            $id
        ]);
    }

    public function hasOrderDetails(int $id): bool
    {
        $sql = "SELECT COUNT(*) FROM chitiet_donhang WHERE MaSP = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return (int)$stmt->fetchColumn() > 0;
    }

    public function delete(int $id): bool
    {
        try {
            $sql = "DELETE FROM sanpham WHERE MaSP = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getLastInsertId(): int
    {
        return (int)$this->db->lastInsertId();
    }

    public function reduceStock(int $maSP, int $soLuong): bool
    {
        $sql = "UPDATE sanpham
                SET TonKho = TonKho - ?
                WHERE MaSP = ? AND TonKho >= ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$soLuong, $maSP, $soLuong]);

        return $stmt->rowCount() > 0;
    }

    public function increaseStock(int $maSP, int $soLuong): bool
    {
        $sql = "UPDATE sanpham
                SET TonKho = TonKho + ?
                WHERE MaSP = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$soLuong, $maSP]);
    }
    public function getPaginated(int $limit, int $offset)
{
    $sql = "SELECT * FROM sanpham ORDER BY MaSP DESC LIMIT ? OFFSET ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(1, $limit, PDO::PARAM_INT);
    $stmt->bindValue(2, $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

public function countAll(): int
{
    $sql = "SELECT COUNT(*) FROM sanpham";
    $stmt = $this->db->query($sql);
    return (int)$stmt->fetchColumn();
}
}