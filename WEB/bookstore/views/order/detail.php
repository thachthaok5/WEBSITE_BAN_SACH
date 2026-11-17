<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div style="margin-bottom: var(--space-6);">
    <div style="font-size: 13px; color: var(--color-ink-muted); margin-bottom: 6px;">
        <a href="index.php" style="color: var(--color-brand-primary);">Trang chủ</a> / 
        <a href="index.php?controller=order&action=myOrders" style="color: var(--color-brand-primary);">Đơn hàng của tôi</a> / 
        <span>Chi tiết đơn #<?= (int)($order['MaDH'] ?? 0) ?></span>
    </div>
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
        <h1 class="section-title">Chi Tiết Đơn Hàng #<?= (int)($order['MaDH'] ?? 0) ?></h1>
        <a class="btn btn-outline btn-sm" href="index.php?controller=order&action=myOrders">
            ← Quay lại danh sách đơn
        </a>
    </div>
</div>

<div class="cart-layout">
    <div style="display:flex; flex-direction:column; gap: var(--space-8);">
        <!-- Order Info Card -->
        <div style="background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); padding: var(--space-6); box-shadow: var(--shadow-card);">
            <h3 style="font-family: var(--font-display); font-size: 18px; margin-bottom: var(--space-4); color: var(--color-ink-primary);">
                Thông Tin Giao Hàng &amp; Nhận Hàng
            </h3>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap: var(--space-4); font-size: 14.5px;">
                <div><strong>Người nhận:</strong> <?= htmlspecialchars($order['TenNguoiNhan'] ?? '-') ?></div>
                <div><strong>Điện thoại:</strong> <?= htmlspecialchars($order['SDTNhan'] ?? '-') ?></div>
                <div style="grid-column: 1 / -1;">
                    <strong>Địa chỉ:</strong> <?= htmlspecialchars($order['DiaChi'] ?? '-') ?>
                </div>
                <div><strong>Phương thức:</strong> <?= htmlspecialchars($paymentText ?? '-') ?></div>
                <div>
                    <strong>Trạng thái:</strong> 
                    <span style="font-weight:700; color:var(--color-accent-terracotta);">
                        <?= htmlspecialchars($statusText ?? '-') ?>
                    </span>
                </div>
                <div style="grid-column: 1 / -1; color: var(--color-ink-muted);">
                    <strong>Ghi chú:</strong> <?= htmlspecialchars($order['GhiChu'] ?? 'Không có ghi chú') ?>
                </div>
            </div>
        </div>

        <!-- Order Items Card -->
        <div style="background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); padding: var(--space-6); box-shadow: var(--shadow-sm);">
            <h3 style="font-family: var(--font-display); font-size: 18px; margin-bottom: var(--space-4); color: var(--color-ink-primary);">
                Mặt Hàng Trong Đơn
            </h3>

            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th style="text-align:right;">Đơn giá</th>
                        <th style="text-align:center;">Số lượng</th>
                        <th style="text-align:right;">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orderDetails)): ?>
                        <?php foreach ($orderDetails as $item): ?>
                            <tr>
                                <td>
                                    <div class="cart-product-cell">
                                        <?php if (!empty($item['HinhAnh'])): ?>
                                            <img class="cart-product-thumb" src="public/uploads/products/<?= htmlspecialchars($item['HinhAnh']) ?>" alt="<?= htmlspecialchars($item['TenSP']) ?>">
                                        <?php else: ?>
                                            <div class="cart-product-thumb" style="background:var(--color-bg-subtle); display:flex; align-items:center; justify-content:center; color:var(--color-ink-muted);">📖</div>
                                        <?php endif; ?>
                                        <div>
                                            <div style="font-weight:600; color:var(--color-ink-primary);"><?= htmlspecialchars($item['TenSP'] ?? '-') ?></div>
                                            <div style="font-size:12px; color:var(--color-ink-muted);">Mã SP: #<?= (int)($item['MaSP'] ?? 0) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align:right; color:var(--color-ink-secondary);">
                                    <?= number_format((float)($item['DonGia'] ?? 0), 0, ',', '.') ?> ₫
                                </td>
                                <td style="text-align:center; font-weight:600;">
                                    <?= (int)($item['SoLuong'] ?? 0) ?>
                                </td>
                                <td style="text-align:right; font-weight:700; color:var(--color-accent-terracotta);">
                                    <?= number_format(((float)($item['DonGia'] ?? 0) * (int)($item['SoLuong'] ?? 0)), 0, ',', '.') ?> ₫
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Summary Box -->
    <div class="cart-summary-card">
        <h3 style="font-family: var(--font-display); font-size: 20px; color: var(--color-ink-primary); margin-bottom: var(--space-4);">
            Tổng Kết Đơn Hàng
        </h3>

        <div class="summary-row">
            <span>Mã đơn:</span>
            <strong>#<?= (int)($order['MaDH'] ?? 0) ?></strong>
        </div>

        <div class="summary-row">
            <span>Ngày khởi tạo:</span>
            <span><?= htmlspecialchars($order['NgayDat'] ?? '-') ?></span>
        </div>

        <div class="summary-row">
            <span>Trạng thái:</span>
            <strong style="color:var(--color-brand-primary);"><?= htmlspecialchars($statusText ?? '-') ?></strong>
        </div>

        <div class="summary-total">
            <div style="display:flex; justify-content:space-between; align-items:baseline;">
                <span>Tổng số tiền:</span>
                <span class="total-amount">
                    <?= number_format((float)($order['TongTien'] ?? 0), 0, ',', '.') ?> ₫
                </span>
            </div>
        </div>

        <a class="btn btn-outline" href="index.php?controller=product&action=list" style="width:100%; margin-top:var(--space-6);">
            Tiếp tục mua sách
        </a>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
