<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h1 class="page-title">Chi tiết đơn hàng #<?= (int)($order['MaDH'] ?? 0) ?></h1>

<div style="display:grid; grid-template-columns:1fr 340px; gap:20px;">
    <div style="display:flex; flex-direction:column; gap:20px;">
        <div class="card">
            <h3 style="margin-top:0;">Thông tin đơn hàng</h3>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; line-height:1.8;">
                <div><strong>Mã đơn:</strong> #<?= (int)($order['MaDH'] ?? 0) ?></div>
                <div><strong>Ngày đặt:</strong> <?= htmlspecialchars($order['NgayDat'] ?? '-') ?></div>

                <div><strong>Người nhận:</strong> <?= htmlspecialchars($order['TenNguoiNhan'] ?? '-') ?></div>
                <div><strong>SĐT nhận:</strong> <?= htmlspecialchars($order['SDTNhan'] ?? '-') ?></div>

                <div style="grid-column:1 / -1;">
                    <strong>Địa chỉ:</strong> <?= htmlspecialchars($order['DiaChi'] ?? '-') ?>
                </div>

                <div><strong>Thanh toán:</strong> <?= htmlspecialchars($paymentText ?? '-') ?></div>
                <div><strong>Trạng thái:</strong> <span style="font-weight:bold; color:#ee4d2d;"><?= htmlspecialchars($statusText ?? '-') ?></span></div>

                <div style="grid-column:1 / -1;">
                    <strong>Ghi chú:</strong> <?= htmlspecialchars($order['GhiChu'] ?? 'Không có') ?>
                </div>
            </div>
        </div>

        <div class="card">
            <h3 style="margin-top:0;">Thông tin khách hàng</h3>

            <div style="line-height:1.9;">
                <div><strong>Tên tài khoản:</strong> <?= htmlspecialchars($order['TenDangNhap'] ?? 'Khách vãng lai') ?></div>
                <div><strong>Họ tên:</strong> <?= htmlspecialchars($order['HoTen'] ?? '-') ?></div>
                <div><strong>Email:</strong> <?= htmlspecialchars($order['Email'] ?? '-') ?></div>
            </div>
        </div>

        <div class="card" style="padding:0; overflow:hidden;">
            <div style="padding:16px 20px; border-bottom:1px solid #e2e8f0; font-weight:bold;">
                Danh sách sản phẩm
            </div>

            <div class="table-wrap">
                <table style="box-shadow:none;">
                    <tr>
                        <th style="text-align:left;">Sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>

                    <?php if (!empty($orderDetails)): ?>
                        <?php foreach ($orderDetails as $item): ?>
                            <tr>
                                <td style="text-align:left;">
                                    <div style="display:flex; align-items:center; gap:12px;">
                                        <div class="product-image" style="width:70px; min-width:70px; height:70px; border-radius:10px;">
                                            <?php if (!empty($item['HinhAnh'])): ?>
                                                <img src="public/uploads/products/<?= htmlspecialchars($item['HinhAnh']) ?>" alt="<?= htmlspecialchars($item['TenSP']) ?>">
                                            <?php else: ?>
                                                Ảnh
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <div style="font-weight:bold;"><?= htmlspecialchars($item['TenSP'] ?? '-') ?></div>
                                            <div style="font-size:13px; color:#64748b;">Mã SP: <?= (int)($item['MaSP'] ?? 0) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td><?= number_format((int)($item['DonGia'] ?? 0), 0, ',', '.') ?>đ</td>
                                <td><?= (int)($item['SoLuong'] ?? 0) ?></td>
                                <td style="color:#ee4d2d; font-weight:bold;">
                                    <?= number_format(((int)($item['DonGia'] ?? 0) * (int)($item['SoLuong'] ?? 0)), 0, ',', '.') ?>đ
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Không có chi tiết đơn hàng.</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>

    <div style="display:flex; flex-direction:column; gap:20px;">
        <div class="card">
            <h3 style="margin-top:0;">Cập nhật trạng thái</h3>

            <form method="POST" action="index.php?controller=admin&action=updateOrderStatus">
                <input type="hidden" name="MaDH" value="<?= (int)($order['MaDH'] ?? 0) ?>">

                <div class="form-group">
                    <label>Trạng thái đơn hàng</label>
                    <select class="form-control" name="TrangThai" required>
                        <option value="0" <?= ((int)($order['TrangThai'] ?? -1) === 0) ? 'selected' : '' ?>>Chờ xác nhận</option>
                        <option value="1" <?= ((int)($order['TrangThai'] ?? -1) === 1) ? 'selected' : '' ?>>Đang đóng gói</option>
                        <option value="2" <?= ((int)($order['TrangThai'] ?? -1) === 2) ? 'selected' : '' ?>>Đang giao</option>
                        <option value="3" <?= ((int)($order['TrangThai'] ?? -1) === 3) ? 'selected' : '' ?>>Đã giao</option>
                        <option value="4" <?= ((int)($order['TrangThai'] ?? -1) === 4) ? 'selected' : '' ?>>Đã hủy</option>
                    </select>
                </div>

                <button class="btn btn-primary" type="submit" style="width:100%;">Lưu trạng thái</button>
            </form>
        </div>

        <div class="card">
            <h3 style="margin-top:0;">Thanh toán</h3>

            <div style="display:flex; justify-content:space-between; align-items:center;">
                <span>Tổng tiền</span>
                <strong style="font-size:24px; color:#ee4d2d;">
                    <?= number_format((int)($order['TongTien'] ?? 0), 0, ',', '.') ?>đ
                </strong>
            </div>
        </div>

        <div class="card">
            <a class="btn btn-secondary" href="index.php?controller=admin&action=orderList" style="width:100%;">
                ← Quay lại danh sách đơn hàng
            </a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>