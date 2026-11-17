<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div style="margin-bottom: var(--space-6);">
    <div style="font-size: 13px; color: var(--color-ink-muted); margin-bottom: 6px;">
        <a href="index.php" style="color: var(--color-brand-primary);">Trang chủ</a> / 
        <a href="index.php?controller=admin&action=dashboard" style="color: var(--color-brand-primary);">Quản trị</a> / 
        <span>Quản lý đơn hàng</span>
    </div>
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
        <h1 class="section-title">Quản Lý Đơn Đặt Hàng</h1>
        <a class="btn btn-outline btn-sm" href="index.php?controller=admin&action=dashboard">
            ← Về Dashboard
        </a>
    </div>
</div>

<div style="background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); box-shadow: var(--shadow-card); overflow: hidden;">
    <div style="padding: var(--space-4) var(--space-6); background-color: var(--color-bg-subtle); border-bottom: 1px solid var(--color-border-subtle); font-size: 14px; font-weight: 600; color: var(--color-ink-primary);">
        Tổng số: <?= !empty($orders) ? count($orders) : 0 ?> đơn đặt hàng
    </div>

    <table class="cart-table" style="margin: 0;">
        <thead>
            <tr>
                <th style="padding-left: var(--space-6);">Mã Đơn</th>
                <th>Người Nhận</th>
                <th>SĐT</th>
                <th style="text-align:right;">Tổng Tiền</th>
                <th>Phương Thức</th>
                <th>Trạng Thái</th>
                <th>Ngày Đặt</th>
                <th style="text-align:center; padding-right: var(--space-6);">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $item): ?>
                    <tr>
                        <td style="padding-left: var(--space-6); font-weight:700; color:var(--color-brand-primary);">
                            #<?= (int)$item['MaDH'] ?>
                        </td>
                        <td style="font-weight:600;">
                            <?= htmlspecialchars($item['TenNguoiNhan'] ?? '-') ?>
                        </td>
                        <td style="font-size:13px; color:var(--color-ink-secondary);">
                            <?= htmlspecialchars($item['SDTNhan'] ?? '-') ?>
                        </td>
                        <td style="text-align:right; font-weight:700; color:var(--color-accent-terracotta);">
                            <?= number_format((float)($item['TongTien'] ?? 0), 0, ',', '.') ?> ₫
                        </td>
                        <td style="font-size:13px;">
                            <?php
                                $pt = (int)($item['PhuongThucTT'] ?? 0);
                                echo match($pt) {
                                    1 => 'COD (Tiền mặt)',
                                    2 => 'Chuyển khoản',
                                    3 => 'Ví điện tử',
                                    default => '-'
                                };
                            ?>
                        </td>
                        <td>
                            <?php
                                $status = $item['TrangThai'] ?? '-';
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
                        <td style="font-size:13px; color:var(--color-ink-muted);">
                            <?= htmlspecialchars($item['NgayDat'] ?? '-') ?>
                        </td>
                        <td style="text-align:center; padding-right: var(--space-6);">
                            <a class="btn btn-outline btn-sm" href="index.php?controller=admin&action=orderDetail&id=<?= (int)$item['MaDH'] ?>">
                                Chi tiết
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" style="text-align:center; padding:var(--space-10); color:var(--color-ink-muted);">
                        Chưa có đơn hàng nào được ghi nhận.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
