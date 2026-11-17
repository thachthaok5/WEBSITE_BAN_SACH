<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-wrapper">
    <div class="auth-header">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--color-brand-primary)" stroke-width="2" style="margin: 0 auto var(--space-2);">
            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"></path>
            <path d="M6 6h10"></path>
            <path d="M6 10h10"></path>
        </svg>
        <h1 class="auth-title">Đăng Nhập</h1>
        <p style="font-size: 14px; color: var(--color-ink-muted);">
            Chào mừng bạn quay lại với thế giới sách BookStore
        </p>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=auth&action=login">
        <div class="form-group">
            <label class="form-label">Tên đăng nhập hoặc Email</label>
            <input class="form-control" type="text" name="username" placeholder="Nhập tên đăng nhập..." required autocomplete="username">
        </div>

        <div class="form-group">
            <div style="display:flex; justify-content:space-between; align-items:baseline; margin-bottom:var(--space-2);">
                <label class="form-label" style="margin-bottom:0;">Mật khẩu</label>
                <a href="#" style="font-size:12.5px; color:var(--color-brand-primary);">Quên mật khẩu?</a>
            </div>
            <input class="form-control" type="password" name="password" placeholder="Nhập mật khẩu..." required autocomplete="current-password">
        </div>

        <button class="btn btn-primary btn-lg" type="submit" style="width: 100%; margin-top: var(--space-4);">
            Đăng Nhập Ngay
        </button>
    </form>

    <div style="text-align: center; margin-top: var(--space-6); padding-top: var(--space-4); border-top: 1px solid var(--color-border-subtle); font-size: 14px; color: var(--color-ink-secondary);">
        Chưa có tài khoản độc giả? 
        <a href="index.php?controller=auth&action=register" style="font-weight: 600; color: var(--color-brand-primary); text-decoration: underline;">
            Đăng ký ngay
        </a>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
