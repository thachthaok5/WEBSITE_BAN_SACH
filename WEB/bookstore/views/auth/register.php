<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-wrapper" style="max-width: 480px;">
    <div class="auth-header">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--color-brand-primary)" stroke-width="2" style="margin: 0 auto var(--space-2);">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <line x1="19" y1="8" x2="19" y2="14"></line>
            <line x1="22" y1="11" x2="16" y2="11"></line>
        </svg>
        <h1 class="auth-title">Đăng Ký Tài Khoản</h1>
        <p style="font-size: 14px; color: var(--color-ink-muted);">
            Trở thành thành viên BookStore để tích điểm và nhận ưu đãi
        </p>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=auth&action=register">
        <div class="form-group">
            <label class="form-label">Tên đăng nhập *</label>
            <input class="form-control" type="text" name="username" placeholder="Ví dụ: nguyenvana" required autocomplete="username">
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap: var(--space-3);">
            <div class="form-group">
                <label class="form-label">Mật khẩu *</label>
                <input class="form-control" type="password" name="password" placeholder="Tối thiểu 6 ký tự" required autocomplete="new-password">
            </div>

            <div class="form-group">
                <label class="form-label">Nhập lại mật khẩu *</label>
                <input class="form-control" type="password" name="confirm_password" placeholder="Khớp mật khẩu" required autocomplete="new-password">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Họ và tên của bạn *</label>
            <input class="form-control" type="text" name="fullname" placeholder="Ví dụ: Nguyễn Văn A" required>
        </div>

        <div style="display:grid; grid-template-columns: 1.2fr 1fr; gap: var(--space-3);">
            <div class="form-group">
                <label class="form-label">Email liên hệ *</label>
                <input class="form-control" type="email" name="email" placeholder="email@domain.com" required>
            </div>

            <div class="form-group">
                <label class="form-label">Số điện thoại *</label>
                <input class="form-control" type="text" name="phone" placeholder="0912345678" required>
            </div>
        </div>

        <button class="btn btn-primary btn-lg" type="submit" style="width: 100%; margin-top: var(--space-4);">
            Tạo Tài Khoản Mới
        </button>
    </form>

    <div style="text-align: center; margin-top: var(--space-6); padding-top: var(--space-4); border-top: 1px solid var(--color-border-subtle); font-size: 14px; color: var(--color-ink-secondary);">
        Đã có tài khoản thành viên? 
        <a href="index.php?controller=auth&action=login" style="font-weight: 600; color: var(--color-brand-primary); text-decoration: underline;">
            Đăng nhập tại đây
        </a>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
