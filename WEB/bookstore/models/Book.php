<?php

require_once __DIR__ . '/../core/Model.php';

class Book extends Model
{
    public function getAll()
    {
        $sql = "SELECT sp.*, s.ISBN, s.TacGia, s.NXB, s.SoTrang, s.KichThuocTL
                FROM sanpham sp
                INNER JOIN sach s ON sp.MaSP = s.MaSP
                WHERE sp.LoaiSP = 1
                ORDER BY sp.MaSP DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById(int $id)
    {
        $sql = "SELECT sp.*, s.ISBN, s.TacGia, s.NXB, s.SoTrang, s.KichThuocTL
                FROM sanpham sp
                INNER JOIN sach s ON sp.MaSP = s.MaSP
                WHERE sp.MaSP = ? AND sp.LoaiSP = 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function search(string $keyword)
    {
        $sql = "SELECT sp.*, s.ISBN, s.TacGia, s.NXB, s.SoTrang, s.KichThuocTL
                FROM sanpham sp
                INNER JOIN sach s ON sp.MaSP = s.MaSP
                WHERE sp.LoaiSP = 1
                  AND (sp.TenSP LIKE ? OR s.TacGia LIKE ? OR s.NXB LIKE ?)
                ORDER BY sp.MaSP DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            '%' . $keyword . '%',
            '%' . $keyword . '%',
            '%' . $keyword . '%'
        ]);
        return $stmt->fetchAll();
    }

    public function isbnExists(string $isbn, ?int $excludeMaSP = null): bool
    {
        if ($excludeMaSP) {
            $sql = "SELECT COUNT(*) FROM sach WHERE ISBN = ? AND MaSP <> ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$isbn, $excludeMaSP]);
        } else {
            $sql = "SELECT COUNT(*) FROM sach WHERE ISBN = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$isbn]);
        }

        return (int)$stmt->fetchColumn() > 0;
    }

    public function create(int $maSP, array $data): bool
    {
        $sql = "INSERT INTO sach (MaSP, ISBN, TacGia, NXB, SoTrang, KichThuocTL)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $maSP,
            $data['ISBN'],
            $data['TacGia'] ?? null,
            $data['NXB'] ?? null,
            $data['SoTrang'] ?: null,
            $data['KichThuocTL'] ?? null
        ]);
    }

    public function update(int $maSP, array $data): bool
    {
        $sql = "UPDATE sach
                SET ISBN = ?, TacGia = ?, NXB = ?, SoTrang = ?, KichThuocTL = ?
                WHERE MaSP = ?";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $data['ISBN'],
            $data['TacGia'] ?? null,
            $data['NXB'] ?? null,
            $data['SoTrang'] ?: null,
            $data['KichThuocTL'] ?? null,
            $maSP
        ]);
    }

    public function delete(int $maSP): bool
    {
        $sql = "DELETE FROM sach WHERE MaSP = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$maSP]);
    }
}