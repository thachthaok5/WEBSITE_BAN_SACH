<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-wrapper" style="max-width: 480px;">
    <div class="auth-header">
        <h1 class="auth-title">Đổi Mật Khẩu</h1>
        <p style="font-size: 14px; color: var(--color-ink-muted);">
            Bảo vệ an toàn cho tài khoản cá nhân của bạn
        </p>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=user&action=changePassword">
        <div class="form-group">
            <label class="form-label">Mật khẩu hiện tại *</label>
            <input class="form-control" type="password" name="old_password" placeholder="Nhập mật khẩu đang dùng" required>
        </div>

        <div class="form-group">
            <label class="form-label">Mật khẩu mới *</label>
            <input class="form-control" type="password" name="new_password" placeholder="Tối thiểu 6 ký tự" required>
        </div>

        <div class="form-group">
            <label class="form-label">Xác nhận mật khẩu mới *</label>
            <input class="form-control" type="password" name="confirm_password" placeholder="Nhập lại mật khẩu mới" required>
        </div>

        <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; margin-top: var(--space-6);">
            <a class="btn btn-outline" href="index.php?controller=user&action=profile">
                Quay lại
            </a>
            <button class="btn btn-primary" type="submit">
                Cập Nhật Mật Khẩu
            </button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
