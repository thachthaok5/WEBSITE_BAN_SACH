<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div style="margin-bottom: var(--space-6);">
    <div style="font-size: 13px; color: var(--color-ink-muted); margin-bottom: 6px;">
        <a href="index.php" style="color: var(--color-brand-primary);">Trang chủ</a> / <span>Hồ sơ cá nhân</span>
    </div>
    <h1 class="section-title">Hồ Sơ Độc Giả</h1>
</div>

<?php if (!empty($user)): ?>
    <div style="max-width: 760px; margin: 0 auto; background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); padding: var(--space-8); box-shadow: var(--shadow-card);">
        <div style="display:flex; align-items:center; gap: var(--space-6); flex-wrap:wrap; padding-bottom: var(--space-6); border-bottom: 1px solid var(--color-border-subtle);">
            <div style="width: 88px; height: 88px; border-radius: var(--radius-pill); background: linear-gradient(135deg, var(--color-brand-primary), #2d705c); color: var(--color-ink-inverted); display: flex; align-items: center; justify-content: center; font-size: 36px; font-weight: 700; box-shadow: var(--shadow-sm);">
                <?= strtoupper(mb_substr($user['HoTen'] ?? 'U', 0, 1, 'UTF-8')) ?>
            </div>

            <div style="flex:1;">
                <div style="display:flex; align-items:center; gap:10px;">
                    <h2 style="font-family: var(--font-display); font-size: 26px; color: var(--color-ink-primary);">
                        <?= htmlspecialchars($user['HoTen'] ?? '') ?>
                    </h2>
                    <span style="font-size:12px; font-weight:700; padding:2px 8px; border-radius:var(--radius-pill); background-color:var(--color-brand-subtle); color:var(--color-brand-primary);">
                        <?= ((int)($user['Quyen'] ?? 1) === 2) ? 'Quản Trị Viên' : 'Thành Viên' ?>
                    </span>
                </div>
                <div style="font-size:14px; color:var(--color-ink-muted); margin-top:4px;">
                    Tên đăng nhập: <strong>@<?= htmlspecialchars($user['TenDangNhap'] ?? '') ?></strong> • Mã độc giả: #<?= (int)($user['MaND'] ?? 0) ?>
                </div>
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap: var(--space-6); margin: var(--space-6) 0;">
            <div style="background-color: var(--color-bg-subtle); padding: var(--space-4); border-radius: var(--radius-md);">
                <div style="font-size:12px; font-weight:600; text-transform:uppercase; color:var(--color-ink-muted); margin-bottom:4px;">Địa chỉ Email</div>
                <div style="font-size:15px; font-weight:600; color:var(--color-ink-primary);"><?= htmlspecialchars($user['Email'] ?? '-') ?></div>
            </div>

            <div style="background-color: var(--color-bg-subtle); padding: var(--space-4); border-radius: var(--radius-md);">
                <div style="font-size:12px; font-weight:600; text-transform:uppercase; color:var(--color-ink-muted); margin-bottom:4px;">Số điện thoại</div>
                <div style="font-size:15px; font-weight:600; color:var(--color-ink-primary);"><?= htmlspecialchars($user['SoDienThoai'] ?? '-') ?></div>
            </div>
        </div>

        <div style="display:flex; gap: var(--space-3); flex-wrap:wrap; margin-top: var(--space-8); padding-top: var(--space-6); border-top: 1px solid var(--color-border-subtle);">
            <a class="btn btn-primary" href="index.php?controller=user&action=edit">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"></path><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"></path></svg>
                <span>Chỉnh sửa thông tin</span>
            </a>
            <a class="btn btn-outline" href="index.php?controller=user&action=changePassword">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <span>Đổi mật khẩu</span>
            </a>
            <a class="btn btn-outline" href="index.php?controller=order&action=myOrders">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                <span>Lịch sử đơn hàng</span>
            </a>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-danger">Không tìm thấy thông tin tài khoản người dùng.</div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
