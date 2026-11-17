<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div style="margin-bottom: var(--space-6);">
    <div style="font-size: 13px; color: var(--color-ink-muted); margin-bottom: 6px;">
        <a href="index.php" style="color: var(--color-brand-primary);">Trang chủ</a> / 
        <a href="index.php?controller=cart&action=index" style="color: var(--color-brand-primary);">Giỏ hàng</a> / 
        <span>Thanh toán</span>
    </div>
    <h1 class="section-title">Xác Nhận &amp; Thanh Toán Đơn Hàng</h1>
</div>

<?php
    $total = 0;
    if (!empty($cart)) {
        foreach ($cart as $item) {
            $price = (float)($item['price'] ?? 0);
            $qty = (int)($item['qty'] ?? 1);
            $total += $price * $qty;
        }
    }
?>

<?php if (!empty($cart)): ?>
    <div class="cart-layout">
        <!-- Delivery Form & Order Review Column -->
        <div style="display:flex; flex-direction:column; gap: var(--space-8);">
            <!-- Address Form Card -->
            <div style="background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); padding: var(--space-8); box-shadow: var(--shadow-card);">
                <div style="display:flex; align-items:center; gap: var(--space-3); margin-bottom: var(--space-6); padding-bottom: var(--space-4); border-bottom: 1px solid var(--color-border-subtle);">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--color-brand-primary)" stroke-width="2">
                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <h2 style="font-family: var(--font-display); font-size: 20px; color: var(--color-ink-primary);">
                        Địa Chỉ Nhận Sách
                    </h2>
                </div>

                <form method="POST" action="index.php?controller=order&action=placeOrder">
                    <div style="display:grid; grid-template-columns: 1fr 1fr; gap: var(--space-4);">
                        <div class="form-group">
                            <label class="form-label">Họ và tên người nhận *</label>
                            <input 
                                class="form-control" 
                                type="text" 
                                name="TenNguoiNhan" 
                                value="<?= htmlspecialchars($_SESSION['user']['fullname'] ?? '') ?>"
                                placeholder="Ví dụ: Nguyễn Văn A" 
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label class="form-label">Số điện thoại liên hệ *</label>
                            <input
                                class="form-control"
                                type="text"
                                name="SDTNhan"
                                pattern="0[0-9]{9}"
                                maxlength="10"
                                value="<?= htmlspecialchars($_SESSION['user']['phone'] ?? '') ?>"
                                placeholder="Ví dụ: 0912345678"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Địa chỉ giao hàng chi tiết *</label>
                        <textarea 
                            class="form-control" 
                            name="DiaChi" 
                            rows="3" 
                            placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố..." 
                            required
                        ><?= htmlspecialchars($_SESSION['user']['address'] ?? '') ?></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phương thức thanh toán *</label>
                        <select class="form-control" name="PhuongThucTT" required>
                            <option value="">-- Chọn hình thức thanh toán --</option>
                            <option value="1" selected>💵 Thanh toán tiền mặt khi nhận hàng (COD)</option>
                            <option value="2">🏦 Chuyển khoản ngân hàng trực tiếp (QR Code)</option>
                            <option value="3">💳 Ví điện tử (VNPay / MoMo)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Ghi chú cho người bán / Shipper</label>
                        <textarea class="form-control" name="GhiChu" rows="2" placeholder="Ví dụ: Giao vào giờ hành chính, gọi trước khi đến..."></textarea>
                    </div>

                    <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; margin-top: var(--space-6); padding-top: var(--space-4); border-top: 1px solid var(--color-border-subtle);">
                        <a class="btn btn-outline" href="index.php?controller=cart&action=index">
                            ← Quay lại giỏ hàng
                        </a>
                        <button class="btn btn-accent btn-lg" type="submit">
                            Xác Nhận Đặt Hàng Ngay
                        </button>
                    </div>
                </form>
            </div>

            <!-- Items Review Card -->
            <div style="background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); padding: var(--space-6); box-shadow: var(--shadow-sm);">
                <h3 style="font-family: var(--font-display); font-size: 18px; margin-bottom: var(--space-4); color: var(--color-ink-primary);">
                    Danh Sách Mặt Hàng Đặt Mua (<?= count($cart) ?> món)
                </h3>

                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Tác phẩm</th>
                            <th style="text-align:right;">Đơn giá</th>
                            <th style="text-align:center;">Số lượng</th>
                            <th style="text-align:right;">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $id => $item): ?>
                            <?php
                                $name = $item['name'] ?? '';
                                $price = (float)($item['price'] ?? 0);
                                $qty = (int)($item['qty'] ?? 1);
                                $subtotal = $price * $qty;
                            ?>
                            <tr>
                                <td>
                                    <div style="font-weight:600; color:var(--color-ink-primary);">
                                        <?= htmlspecialchars($name) ?>
                                    </div>
                                    <div style="font-size:12px; color:var(--color-ink-muted);">Mã: #<?= (int)$id ?></div>
                                </td>
                                <td style="text-align:right; color:var(--color-ink-secondary);">
                                    <?= number_format($price, 0, ',', '.') ?> ₫
                                </td>
                                <td style="text-align:center; font-weight:600;">
                                    x<?= $qty ?>
                                </td>
                                <td style="text-align:right; font-weight:700; color:var(--color-accent-terracotta);">
                                    <?= number_format($subtotal, 0, ',', '.') ?> ₫
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sticky Checkout Summary -->
        <div class="cart-summary-card" style="position:sticky; top: 100px;">
            <h3 style="font-family: var(--font-display); font-size: 20px; color: var(--color-ink-primary); margin-bottom: var(--space-4);">
                Hóa Đơn Tạm Tính
            </h3>

            <div class="summary-row">
                <span>Tiền hàng:</span>
                <strong><?= number_format($total, 0, ',', '.') ?> ₫</strong>
            </div>

            <div class="summary-row">
                <span>Phí giao hàng:</span>
                <span style="color:var(--color-success); font-weight:600;">
                    <?= ($total >= 250000) ? 'Miễn phí' : '25.000 ₫' ?>
                </span>
            </div>

            <div class="summary-row">
                <span>Ưu đãi thành viên:</span>
                <span style="color:var(--color-success); font-weight:600;">-0 ₫</span>
            </div>

            <div class="summary-total">
                <div style="display:flex; justify-content:space-between; align-items:baseline;">
                    <span>Tổng thanh toán:</span>
                    <span class="total-amount">
                        <?= number_format(($total >= 250000) ? $total : ($total + 25000), 0, ',', '.') ?> ₫
                    </span>
                </div>
            </div>

            <div style="margin-top: var(--space-6); padding: var(--space-4); background-color: var(--color-bg-subtle); border-radius: var(--radius-md); font-size: 13px; color: var(--color-ink-muted); line-height: 1.6;">
                🛡️ <strong>Chính sách giao hàng an tâm:</strong> Quý khách được đồng kiểm hàng trước khi thanh toán. Đổi trả miễn phí nếu sách bị lỗi hoặc hư hại khi vận chuyển.
            </div>
        </div>
    </div>
<?php else: ?>
    <div style="background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); padding: var(--space-12); text-align: center;">
        <p style="color:var(--color-ink-muted); font-size:15px; margin-bottom:var(--space-4);">
            Giỏ hàng trống. Vui lòng thêm sản phẩm trước khi thanh toán.
        </p>
        <a class="btn btn-primary" href="index.php?controller=product&action=list">
            Đến danh sách sản phẩm
        </a>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
