<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php
    $totalProducts = isset($totalProducts) ? (int)$totalProducts : 51;
    $totalOrders = isset($totalOrders) ? (int)$totalOrders : 6;
    $totalUsers = isset($totalUsers) ? (int)$totalUsers : 5;
    $totalRevenue = isset($totalRevenue) ? (int)$totalRevenue : 1580000;
?>

<div style="margin-bottom: var(--space-6);">
    <div style="font-size: 13px; color: var(--color-ink-muted); margin-bottom: 6px;">
        <a href="index.php" style="color: var(--color-brand-primary);">Trang chủ</a> / <span>Quản trị hệ thống</span>
    </div>
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 class="section-title">Trung Tâm Điều Hành BookStore</h1>
            <p style="font-size: 14px; color: var(--color-ink-muted);">Tổng quan thống kê dữ liệu bán hàng và quản lý danh mục</p>
        </div>
        <div style="display:flex; gap:10px;">
            <a class="btn btn-outline btn-sm" href="index.php?controller=admin&action=addBook">
                + Thêm sách mới
            </a>
            <a class="btn btn-primary btn-sm" href="index.php?controller=admin&action=addStationery">
                + Thêm văn phòng phẩm
            </a>
        </div>
    </div>
</div>

<!-- Metric Stat Cards -->
<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap: var(--space-6); margin-bottom: var(--space-8);">
    <div style="background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); padding: var(--space-6); box-shadow: var(--shadow-sm); display:flex; align-items:center; gap: var(--space-4);">
        <div style="width: 52px; height: 52px; border-radius: var(--radius-md); background-color: var(--color-brand-subtle); color: var(--color-brand-primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"></path></svg>
        </div>
        <div>
            <div style="font-size: 13px; font-weight: 600; color: var(--color-ink-muted); text-transform: uppercase;">Tổng Sản Phẩm</div>
            <div style="font-size: 28px; font-weight: 700; color: var(--color-ink-primary); margin-top: 2px;"><?= number_format($totalProducts) ?></div>
        </div>
    </div>

    <div style="background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); padding: var(--space-6); box-shadow: var(--shadow-sm); display:flex; align-items:center; gap: var(--space-4);">
        <div style="width: 52px; height: 52px; border-radius: var(--radius-md); background-color: var(--color-info-bg); color: var(--color-info); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="16" height="13" x="1" y="6" rx="2"></rect><circle cx="7" cy="19" r="2"></circle><circle cx="17" cy="19" r="2"></circle></svg>
        </div>
        <div>
            <div style="font-size: 13px; font-weight: 600; color: var(--color-ink-muted); text-transform: uppercase;">Tổng Đơn Hàng</div>
            <div style="font-size: 28px; font-weight: 700; color: var(--color-ink-primary); margin-top: 2px;"><?= number_format($totalOrders) ?></div>
        </div>
    </div>

    <div style="background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); padding: var(--space-6); box-shadow: var(--shadow-sm); display:flex; align-items:center; gap: var(--space-4);">
        <div style="width: 52px; height: 52px; border-radius: var(--radius-md); background-color: var(--color-success-bg); color: var(--color-success); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
        </div>
        <div>
            <div style="font-size: 13px; font-weight: 600; color: var(--color-ink-muted); text-transform: uppercase;">Tài Khoản Độc Giả</div>
            <div style="font-size: 28px; font-weight: 700; color: var(--color-ink-primary); margin-top: 2px;"><?= number_format($totalUsers) ?></div>
        </div>
    </div>

    <div style="background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); padding: var(--space-6); box-shadow: var(--shadow-sm); display:flex; align-items:center; gap: var(--space-4);">
        <div style="width: 52px; height: 52px; border-radius: var(--radius-md); background-color: var(--color-accent-subtle); color: var(--color-accent-terracotta); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
        </div>
        <div>
            <div style="font-size: 13px; font-weight: 600; color: var(--color-ink-muted); text-transform: uppercase;">Tổng Doanh Thu</div>
            <div style="font-size: 24px; font-weight: 700; color: var(--color-accent-terracotta); margin-top: 2px;">
                <?= number_format($totalRevenue, 0, ',', '.') ?> ₫
            </div>
        </div>
    </div>
</div>

<!-- Admin Quick Access Grid -->
<div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: var(--space-6); margin-bottom: var(--space-12);">
    <a href="index.php?controller=admin&action=productList" style="background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); padding: var(--space-6); box-shadow: var(--shadow-sm); display:flex; align-items:flex-start; gap: var(--space-4);">
        <div style="width:44px; height:44px; border-radius:var(--radius-md); background:var(--color-bg-subtle); display:flex; align-items:center; justify-content:center; color:var(--color-brand-primary);">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="7" height="9" x="3" y="3" rx="1"></rect><rect width="7" height="5" x="14" y="3" rx="1"></rect><rect width="7" height="9" x="14" y="12" rx="1"></rect><rect width="7" height="5" x="3" y="16" rx="1"></rect></svg>
        </div>
        <div>
            <h3 style="font-size: 16px; font-weight: 700; color: var(--color-ink-primary); margin-bottom: 4px;">Quản Lý Sản Phẩm</h3>
            <p style="font-size: 13px; color: var(--color-ink-muted); line-height: 1.5;">Tra cứu danh sách sách &amp; văn phòng phẩm, chỉnh sửa giá và cập nhật tồn kho.</p>
        </div>
    </a>

    <a href="index.php?controller=admin&action=orderList" style="background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); padding: var(--space-6); box-shadow: var(--shadow-sm); display:flex; align-items:flex-start; gap: var(--space-4);">
        <div style="width:44px; height:44px; border-radius:var(--radius-md); background:var(--color-bg-subtle); display:flex; align-items:center; justify-content:center; color:var(--color-info);">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
        </div>
        <div>
            <h3 style="font-size: 16px; font-weight: 700; color: var(--color-ink-primary); margin-bottom: 4px;">Quản Lý Đơn Hàng</h3>
            <p style="font-size: 13px; color: var(--color-ink-muted); line-height: 1.5;">Xem chi tiết các đơn đặt mua, cập nhật trạng thái giao hàng và phương thức thanh toán.</p>
        </div>
    </a>

    <a href="index.php?controller=admin&action=userList" style="background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); padding: var(--space-6); box-shadow: var(--shadow-sm); display:flex; align-items:flex-start; gap: var(--space-4);">
        <div style="width:44px; height:44px; border-radius:var(--radius-md); background:var(--color-bg-subtle); display:flex; align-items:center; justify-content:center; color:var(--color-success);">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
        </div>
        <div>
            <h3 style="font-size: 16px; font-weight: 700; color: var(--color-ink-primary); margin-bottom: 4px;">Quản Lý Người Dùng</h3>
            <p style="font-size: 13px; color: var(--color-ink-muted); line-height: 1.5;">Danh sách tài khoản độc giả và phân quyền quản trị viên.</p>
        </div>
    </a>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
