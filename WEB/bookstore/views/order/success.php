<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div style="max-width: 640px; margin: var(--space-10) auto; background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); padding: var(--space-12) var(--space-8); text-align: center; box-shadow: var(--shadow-card);">
    <div style="width: 72px; height: 72px; margin: 0 auto var(--space-6); border-radius: var(--radius-pill); background-color: var(--color-success-bg); color: var(--color-success); display: flex; align-items: center; justify-content: center;">
        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
    </div>

    <h1 style="font-family: var(--font-display); font-size: 32px; color: var(--color-ink-primary); margin-bottom: var(--space-3);">
        Đặt Hàng Thành Công!
    </h1>

    <p style="font-size: 15px; color: var(--color-ink-secondary); line-height: 1.7; max-width: 480px; margin: 0 auto var(--space-8);">
        Cảm ơn bạn đã lựa chọn BookStore. Đơn hàng của bạn đã được tiếp nhận và nhân viên sẽ nhanh chóng đóng gói, chuyển phát đến bạn.
    </p>

    <div style="display:flex; justify-content:center; gap: var(--space-3); flex-wrap:wrap;">
        <a class="btn btn-primary" href="index.php?controller=order&action=myOrders">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
            <span>Theo dõi đơn hàng</span>
        </a>
        <a class="btn btn-outline" href="index.php?controller=product&action=list">
            Tiếp tục khám phá sách
        </a>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
