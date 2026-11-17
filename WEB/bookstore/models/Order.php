<?php

require_once __DIR__ . '/../core/Model.php';

class Order extends Model
{
    public function createOrder(array $data, array $cart, ?int $userId = null)
    {
        try {
            $this->db->beginTransaction();

            $tongTien = 0;
            foreach ($cart as $item) {
                $tongTien += ((int)$item['price'] * (int)$item['qty']);
            }

            $sql = "INSERT INTO donhang
                    (MaND, TenNguoiNhan, SDTNhan, DiaChi, PhuongThucTT, GhiChu, TongTien, TrangThai, NgayDat)
                    VALUES (?, ?, ?, ?, ?, ?, ?, 0, NOW())";

            $stmt = $this->db->prepare($sql);
          $stmt->execute([
    $userId,
    $data['TenNguoiNhan'] ?? '',
    $data['SDTNhan'] ?? '',
    $data['DiaChi'] ?? '',
    (int)($data['PhuongThucTT'] ?? 0),
    $data['GhiChu'] ?? '',
    $tongTien
]);

            $maDH = (int)$this->db->lastInsertId();

            foreach ($cart as $productId => $item) {
                $sqlDetail = "INSERT INTO chitiet_donhang (MaDH, MaSP, SoLuong, DonGia)
                              VALUES (?, ?, ?, ?)";
                $stmtDetail = $this->db->prepare($sqlDetail);
                $stmtDetail->execute([
                    $maDH,
                    $productId,
                    (int)$item['qty'],
                    (int)$item['price']
                ]);

                $sqlStock = "UPDATE sanpham
                             SET TonKho = TonKho - ?
                             WHERE MaSP = ? AND TonKho >= ?";
                $stmtStock = $this->db->prepare($sqlStock);
                $stmtStock->execute([
                    (int)$item['qty'],
                    $productId,
                    (int)$item['qty']
                ]);

                if ($stmtStock->rowCount() === 0) {
                    throw new Exception('Sản phẩm không đủ tồn kho.');
                }
            }

            $this->db->commit();
            return $maDH;
       } catch (Throwable $e) {
    if ($this->db->inTransaction()) {
        $this->db->rollBack();
    }

    die('Lỗi tạo đơn hàng: ' . $e->getMessage());
}
    }

    public function getAll()
    {
        $sql = "SELECT * FROM donhang ORDER BY MaDH DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById(int $id)
    {
        $sql = "SELECT dh.*, nd.TenDangNhap, nd.HoTen, nd.Email
                FROM donhang dh
                LEFT JOIN nguoidung nd ON dh.MaND = nd.MaND
                WHERE dh.MaDH = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getDetails(int $maDH)
    {
        $sql = "SELECT ctdh.*, sp.TenSP, sp.HinhAnh
                FROM chitiet_donhang ctdh
                INNER JOIN sanpham sp ON ctdh.MaSP = sp.MaSP
                WHERE ctdh.MaDH = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$maDH]);
        return $stmt->fetchAll();
    }

    public function getByUser(int $maND)
    {
        $sql = "SELECT * FROM donhang WHERE MaND = ? ORDER BY MaDH DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$maND]);
        return $stmt->fetchAll();
    }

    public function updateStatus(int $maDH, int $trangThai): bool
    {
        $sql = "UPDATE donhang SET TrangThai = ? WHERE MaDH = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$trangThai, $maDH]);
    }

    public function getDeliveredRevenue(): int
    {
        $sql = "SELECT COALESCE(SUM(TongTien), 0) FROM donhang WHERE TrangThai = 3";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function delete(int $maDH): bool
    {
        try {
            $this->db->beginTransaction();

            $details = $this->getDetails($maDH);
            foreach ($details as $item) {
                $sqlRestore = "UPDATE sanpham SET TonKho = TonKho + ? WHERE MaSP = ?";
                $stmtRestore = $this->db->prepare($sqlRestore);
                $stmtRestore->execute([
                    (int)$item['SoLuong'],
                    (int)$item['MaSP']
                ]);
            }

            $sqlDetail = "DELETE FROM chitiet_donhang WHERE MaDH = ?";
            $stmtDetail = $this->db->prepare($sqlDetail);
            $stmtDetail->execute([$maDH]);

            $sqlOrder = "DELETE FROM donhang WHERE MaDH = ?";
            $stmtOrder = $this->db->prepare($sqlOrder);
            $stmtOrder->execute([$maDH]);

            $this->db->commit();
            return true;
       } catch (Throwable $e) {
    if ($this->db->inTransaction()) {
        $this->db->rollBack();
    }

    die('Lỗi tạo đơn hàng: ' . $e->getMessage());
}
    }
}