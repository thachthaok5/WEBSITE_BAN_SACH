<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-wrapper" style="max-width: 520px;">
    <div class="auth-header">
        <h1 class="auth-title">Cập Nhật Thông Tin</h1>
        <p style="font-size: 14px; color: var(--color-ink-muted);">
            Thay đổi họ tên, email hoặc số điện thoại liên lạc
        </p>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=user&action=edit">
        <div class="form-group">
            <label class="form-label">Họ và tên *</label>
            <input
                class="form-control"
                type="text"
                name="fullname"
                value="<?= htmlspecialchars($user['HoTen'] ?? '') ?>"
                required
            >
        </div>

        <div class="form-group">
            <label class="form-label">Email liên hệ *</label>
            <input
                class="form-control"
                type="email"
                name="email"
                value="<?= htmlspecialchars($user['Email'] ?? '') ?>"
                required
            >
        </div>

        <div class="form-group">
            <label class="form-label">Số điện thoại *</label>
            <input
                class="form-control"
                type="text"
                name="phone"
                value="<?= htmlspecialchars($user['SoDienThoai'] ?? '') ?>"
                required
            >
        </div>

        <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; margin-top: var(--space-6);">
            <a class="btn btn-outline" href="index.php?controller=user&action=profile">
                Hủy bỏ
            </a>
            <button class="btn btn-primary" type="submit">
                Lưu Thay Đổi
            </button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
