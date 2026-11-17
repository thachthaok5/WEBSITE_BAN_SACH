<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div style="margin-bottom: var(--space-6);">
    <div style="font-size: 13px; color: var(--color-ink-muted); margin-bottom: 6px;">
        <a href="index.php" style="color: var(--color-brand-primary);">Trang chủ</a> / <span>Giỏ hàng</span>
    </div>
    <h1 class="section-title">Giỏ Hàng Mua Sắm</h1>
</div>

<?php if (!empty($cart)): ?>
    <?php $total = 0; ?>

    <div class="cart-layout">
        <!-- Cart Items Table Card -->
        <div class="cart-table-card">
            <form method="POST" action="index.php?controller=cart&action=update">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Tác phẩm / Sản phẩm</th>
                            <th style="text-align:right;">Đơn giá</th>
                            <th style="text-align:center;">Số lượng</th>
                            <th style="text-align:right;">Thành tiền</th>
                            <th style="text-align:center;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $id => $item): ?>
                            <?php
                                $name = $item['name'] ?? '';
                                $price = (float)($item['price'] ?? 0);
                                $qty = (int)($item['qty'] ?? 1);
                                $subtotal = $price * $qty;
                                $total += $subtotal;
                                $img = $item['image'] ?? '';
                            ?>
                            <tr>
                                <td>
                                    <div class="cart-product-cell">
                                        <?php if (!empty($img)): ?>
                                            <img class="cart-product-thumb" src="public/uploads/products/<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($name) ?>">
                                        <?php else: ?>
                                            <div class="cart-product-thumb" style="background:var(--color-bg-subtle); display:flex; align-items:center; justify-content:center; color:var(--color-ink-muted); font-size:11px;">
                                                📖
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <div style="font-weight:600; font-size:14.5px; color:var(--color-ink-primary);">
                                                <a href="index.php?controller=product&action=detail&id=<?= (int)$id ?>">
                                                    <?= htmlspecialchars($name) ?>
                                                </a>
                                            </div>
                                            <div style="font-size:12px; color:var(--color-ink-muted); margin-top:3px;">
                                                Mã SP: #<?= (int)$id ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align:right; font-weight:600; color:var(--color-ink-secondary);">
                                    <?= number_format($price, 0, ',', '.') ?> ₫
                                </td>
                                <td style="text-align:center;">
                                    <input
                                        class="form-control"
                                        type="number"
                                        name="qty[<?= (int)$id ?>]"
                                        value="<?= $qty ?>"
                                        min="1"
                                        style="width: 72px; text-align: center; margin: 0 auto; padding: 6px 8px;"
                                    >
                                </td>
                                <td style="text-align:right; font-weight:700; color:var(--color-accent-terracotta);">
                                    <?= number_format($subtotal, 0, ',', '.') ?> ₫
                                </td>
                                <td style="text-align:center;">
                                    <a 
                                        href="javascript:void(0)"
                                        onclick="confirmDelete('index.php?controller=cart&action=delete&id=<?= (int)$id ?>')"
                                        title="Xóa khỏi giỏ"
                                        style="color:var(--color-danger); display:inline-flex; align-items:center; justify-content:center; padding:6px; border-radius:var(--radius-sm);"
                                    >
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M3 6h18"></path>
                                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap; margin-top:var(--space-6); padding-top:var(--space-4); border-top:1px solid var(--color-border-subtle);">
                    <a class="btn btn-outline" href="index.php?controller=product&action=list">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"></path></svg>
                        <span>Tiếp tục chọn sách</span>
                    </a>
                    <button class="btn btn-primary" type="submit">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"></path>
                        </svg>
                        <span>Cập nhật số lượng</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Order Summary Card -->
        <div class="cart-summary-card">
            <h3 style="font-family: var(--font-display); font-size: 20px; color: var(--color-ink-primary); margin-bottom: var(--space-4);">
                Tóm Tắt Đơn Hàng
            </h3>

            <div class="summary-row">
                <span>Tạm tính giỏ hàng:</span>
                <strong><?= number_format($total, 0, ',', '.') ?> ₫</strong>
            </div>

            <div class="summary-row">
                <span>Phí vận chuyển:</span>
                <span style="color:var(--color-success); font-weight:600;">
                    <?= ($total >= 250000) ? 'Miễn phí' : '25.000 ₫' ?>
                </span>
            </div>

            <?php if ($total < 250000): ?>
                <div style="font-size: 12px; color: var(--color-accent-terracotta); background-color: var(--color-accent-subtle); padding: 8px 12px; border-radius: var(--radius-sm); margin: var(--space-2) 0 var(--space-4);">
                    💡 Mua thêm <strong><?= number_format(250000 - $total, 0, ',', '.') ?> ₫</strong> để được <strong>Freeship</strong>!
                </div>
            <?php else: ?>
                <div style="font-size: 12px; color: var(--color-success); background-color: var(--color-success-bg); padding: 8px 12px; border-radius: var(--radius-sm); margin: var(--space-2) 0 var(--space-4);">
                    🎉 Đơn hàng của bạn đủ điều kiện miễn phí vận chuyển!
                </div>
            <?php endif; ?>

            <div class="summary-total">
                <div style="display:flex; justify-content:space-between; align-items:baseline;">
                    <span>Tổng thanh toán:</span>
                    <span class="total-amount">
                        <?= number_format(($total >= 250000) ? $total : ($total + 25000), 0, ',', '.') ?> ₫
                    </span>
                </div>
                <div style="font-size:11px; font-weight:normal; color:var(--color-ink-muted); margin-top:4px;">(Đã bao gồm thuế VAT nếu có)</div>
            </div>

            <a class="btn btn-accent btn-lg" href="index.php?controller=order&action=checkout" style="width: 100%; margin-top: var(--space-6);">
                Tiến Hành Đặt Hàng
            </a>

            <div class="cart-trust-reassurance">
                <div style="display:flex; align-items:center; gap:8px; margin-bottom:8px; font-weight:700; font-size:13px; color:var(--color-brand-primary);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"></path></svg>
                    <span>Cam Kết Dịch Vụ Tại BookStore</span>
                </div>
                <div style="font-size:12px; color:var(--color-ink-secondary); line-height:1.6;">
                    ✓ Đóng gói chống va đập, bảo vệ gáy sách nguyên vẹn<br>
                    ✓ 100% Sách mới chính hãng từ các NXB uy tín<br>
                    ✓ Đổi trả miễn phí trong 7 ngày nếu lỗi in ấn
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div style="background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); padding: var(--space-16) var(--space-4); text-align: center; box-shadow: var(--shadow-sm);">
        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--color-border-strong)" stroke-width="1.5" style="margin: 0 auto var(--space-4);">
            <circle cx="8" cy="21" r="1"></circle>
            <circle cx="19" cy="21" r="1"></circle>
            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
        </svg>
        <h2 style="font-family: var(--font-display); font-size: 24px; color: var(--color-ink-primary); margin-bottom: 8px;">
            Giỏ hàng của bạn đang trống
        </h2>
        <p style="color: var(--color-ink-muted); font-size: 14.5px; margin-bottom: var(--space-6); max-width: 420px; margin-left: auto; margin-right: auto;">
            Có rất nhiều tựa sách hay và văn phòng phẩm chất lượng đang chờ đón bạn khám phá.
        </p>
        <a class="btn btn-primary" href="index.php?controller=product&action=list">
            Khám phá tủ sách ngay
        </a>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
