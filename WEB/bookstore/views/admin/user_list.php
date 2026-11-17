<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div style="margin-bottom: var(--space-6);">
    <div style="font-size: 13px; color: var(--color-ink-muted); margin-bottom: 6px;">
        <a href="index.php" style="color: var(--color-brand-primary);">Trang chủ</a> / 
        <a href="index.php?controller=admin&action=dashboard" style="color: var(--color-brand-primary);">Quản trị</a> / 
        <span>Quản lý tài khoản</span>
    </div>
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
        <h1 class="section-title">Danh Sách Tài Khoản Người Dùng</h1>
        <a class="btn btn-outline btn-sm" href="index.php?controller=admin&action=dashboard">
            ← Về Dashboard
        </a>
    </div>
</div>

<div style="background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); box-shadow: var(--shadow-card); overflow: hidden;">
    <div style="padding: var(--space-4) var(--space-6); background-color: var(--color-bg-subtle); border-bottom: 1px solid var(--color-border-subtle); font-size: 14px; font-weight: 600; color: var(--color-ink-primary);">
        Tổng số: <?= !empty($users) ? count($users) : 0 ?> tài khoản đã đăng ký
    </div>

    <table class="cart-table" style="margin: 0;">
        <thead>
            <tr>
                <th style="padding-left: var(--space-6);">Mã</th>
                <th>Tên Đăng Nhập</th>
                <th>Họ và Tên</th>
                <th>Email</th>
                <th>Số Điện Thoại</th>
                <th>Vai Trò</th>
                <th style="text-align:center; padding-right: var(--space-6);">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $item): ?>
                    <tr>
                        <td style="padding-left: var(--space-6); font-weight: 700; color: var(--color-ink-muted);">
                            #<?= (int)($item['MaND'] ?? 0) ?>
                        </td>
                        <td style="font-weight: 600; color: var(--color-brand-primary);">
                            @<?= htmlspecialchars($item['TenDangNhap'] ?? '') ?>
                        </td>
                        <td style="font-weight: 600;">
                            <?= htmlspecialchars($item['HoTen'] ?? '') ?>
                        </td>
                        <td style="font-size: 13.5px; color: var(--color-ink-secondary);">
                            <?= htmlspecialchars($item['Email'] ?? '-') ?>
                        </td>
                        <td style="font-size: 13.5px; color: var(--color-ink-secondary);">
                            <?= htmlspecialchars($item['SoDienThoai'] ?? '-') ?>
                        </td>
                        <td>
                            <?php if ((int)($item['Quyen'] ?? 1) === 2): ?>
                                <span style="font-size:12px; font-weight:700; padding:2px 8px; border-radius:var(--radius-pill); background-color:var(--color-danger-bg); color:var(--color-danger);">
                                    Quản Trị Viên
                                </span>
                            <?php else: ?>
                                <span style="font-size:12px; font-weight:700; padding:2px 8px; border-radius:var(--radius-pill); background-color:var(--color-success-bg); color:var(--color-success);">
                                    Khách Hàng
                                </span>
                            <?php endif; ?>
                        </td>
                        <td style="text-align:center; padding-right: var(--space-6);">
                            <?php if ((int)($item['Quyen'] ?? 1) !== 2): ?>
                                <a class="btn btn-danger btn-sm"
                                   href="javascript:void(0)"
                                   onclick="confirmDelete('index.php?controller=admin&action=deleteUser&id=<?= (int)($item['MaND'] ?? 0) ?>', 'Bạn có chắc chắn muốn xóa tài khoản này không?')">
                                    Xóa
                                </a>
                            <?php else: ?>
                                <span style="font-size:12px; color:var(--color-ink-muted);">Cố định</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align:center; padding:var(--space-10); color:var(--color-ink-muted);">
                        Chưa có người dùng nào.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
