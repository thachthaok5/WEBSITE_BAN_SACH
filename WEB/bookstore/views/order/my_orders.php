<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div style="margin-bottom: var(--space-6);">
    <div style="font-size: 13px; color: var(--color-ink-muted); margin-bottom: 6px;">
        <a href="index.php" style="color: var(--color-brand-primary);">Trang chủ</a> / 
        <a href="index.php?controller=user&action=profile" style="color: var(--color-brand-primary);">Tài khoản</a> / 
        <span>Đơn hàng của tôi</span>
    </div>
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
        <h1 class="section-title">Lịch Sử Mua Hàng</h1>
        <a class="btn btn-outline btn-sm" href="index.php?controller=user&action=profile">
            ← Về trang hồ sơ
        </a>
    </div>
</div>

<div style="background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); box-shadow: var(--shadow-card); overflow: hidden;">
    <div style="padding: var(--space-4) var(--space-6); background-color: var(--color-bg-subtle); border-bottom: 1px solid var(--color-border-subtle); font-size: 14px; font-weight: 600; color: var(--color-ink-primary);">
        Tổng số: <?= !empty($orders) ? count($orders) : 0 ?> đơn hàng đã ghi nhận
    </div>

    <table class="cart-table" style="margin: 0;">
        <thead>
            <tr>
                <th style="padding-left: var(--space-6);">Mã Đơn</th>
                <th>Người Nhận</th>
                <th style="text-align:right;">Tổng Giá Trị</th>
                <th>Hình Thức</th>
                <th>Trạng Thái</th>
                <th>Ngày Đặt</th>
                <th style="text-align:center; padding-right: var(--space-6);">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $item): ?>
                    <tr>
                        <td style="padding-left: var(--space-6); font-weight: 700; color: var(--color-brand-primary);">
                            #<?= (int)($item['MaDH'] ?? 0) ?>
                        </td>
                        <td>
                            <div style="font-weight: 600;"><?= htmlspecialchars($item['TenNguoiNhan'] ?? '-') ?></div>
                            <div style="font-size: 12px; color: var(--color-ink-muted);"><?= htmlspecialchars($item['SDTNhan'] ?? '') ?></div>
                        </td>
                        <td style="text-align:right; font-weight: 700; color: var(--color-accent-terracotta);">
                            <?= number_format((float)($item['TongTien'] ?? 0), 0, ',', '.') ?> ₫
                        </td>
                        <td style="font-size: 13.5px; color: var(--color-ink-secondary);">
                            <?= htmlspecialchars($item['PaymentText'] ?? '-') ?>
                        </td>
                        <td>
                            <?php
                                $status = $item['TrangThaiText'] ?? '-';
                                $badgeBg = 'var(--color-bg-subtle)';
                                $badgeColor = 'var(--color-ink-secondary)';
                                if ($status === 'Chờ xác nhận') { $badgeBg = 'var(--color-warning-bg)'; $badgeColor = 'var(--color-warning)'; }
                                elseif ($status === 'Đang đóng gói' || $status === 'Đang giao') { $badgeBg = 'var(--color-info-bg)'; $badgeColor = 'var(--color-info)'; }
                                elseif ($status === 'Đã giao') { $badgeBg = 'var(--color-success-bg)'; $badgeColor = 'var(--color-success)'; }
                                elseif ($status === 'Đã hủy') { $badgeBg = 'var(--color-danger-bg)'; $badgeColor = 'var(--color-danger)'; }
                            ?>
                            <span style="display:inline-block; font-size:12px; font-weight:700; padding:3px 10px; border-radius:var(--radius-pill); background-color:<?= $badgeBg ?>; color:<?= $badgeColor ?>;">
                                <?= htmlspecialchars($status) ?>
                            </span>
                        </td>
                        <td style="font-size: 13px; color: var(--color-ink-muted);">
                            <?= htmlspecialchars($item['NgayDat'] ?? '-') ?>
                        </td>
                        <td style="text-align:center; padding-right: var(--space-6);">
                            <a class="btn btn-outline btn-sm" href="index.php?controller=order&action=detail&id=<?= (int)($item['MaDH'] ?? 0) ?>">
                                Chi tiết
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align:center; padding: var(--space-12); color: var(--color-ink-muted);">
                        Quý khách chưa có đơn hàng nào được tạo.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
