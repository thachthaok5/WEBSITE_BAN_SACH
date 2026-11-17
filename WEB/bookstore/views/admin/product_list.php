<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div style="margin-bottom: var(--space-6);">
    <div style="font-size: 13px; color: var(--color-ink-muted); margin-bottom: 6px;">
        <a href="index.php" style="color: var(--color-brand-primary);">Trang chủ</a> / 
        <a href="index.php?controller=admin&action=dashboard" style="color: var(--color-brand-primary);">Quản trị</a> / 
        <span>Quản lý sản phẩm</span>
    </div>
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
        <h1 class="section-title">Danh Sách Sản Phẩm</h1>
        <div style="display:flex; gap:10px;">
            <a class="btn btn-outline btn-sm" href="index.php?controller=admin&action=addBook">
                + Thêm sách mới
            </a>
            <a class="btn btn-primary btn-sm" href="index.php?controller=admin&action=addStationery">
                + Thêm văn phòng phẩm
            </a>
            <a class="btn btn-outline btn-sm" href="index.php?controller=admin&action=dashboard">
                Về Dashboard
            </a>
        </div>
    </div>
</div>

<div style="background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); box-shadow: var(--shadow-card); overflow: hidden;">
    <div style="padding: var(--space-4) var(--space-6); background-color: var(--color-bg-subtle); border-bottom: 1px solid var(--color-border-subtle); font-size: 14px; font-weight: 600; color: var(--color-ink-primary);">
        Đang quản lý <?= !empty($products) ? count($products) : 0 ?> sản phẩm trên toàn hệ thống
    </div>

    <table class="cart-table" style="margin: 0;">
        <thead>
            <tr>
                <th style="padding-left: var(--space-6);">Mã</th>
                <th style="text-align:left;">Tên Sản Phẩm</th>
                <th>Phân Loại</th>
                <th style="text-align:right;">Đơn Giá</th>
                <th style="text-align:center;">Tồn Kho</th>
                <th style="text-align:center; padding-right: var(--space-6);">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $item): ?>
                    <tr>
                        <td style="padding-left: var(--space-6); font-weight:700; color:var(--color-ink-muted);">
                            #<?= (int)$item['MaSP'] ?>
                        </td>
                        <td style="text-align:left;">
                            <div style="font-weight:600; font-size:14.5px; color:var(--color-ink-primary);">
                                <a href="index.php?controller=product&action=detail&id=<?= (int)$item['MaSP'] ?>" target="_blank" title="Xem trên web">
                                    <?= htmlspecialchars($item['TenSP']) ?>
                                </a>
                            </div>
                        </td>
                        <td>
                            <span style="font-size:12px; font-weight:700; padding:2px 8px; border-radius:var(--radius-pill); background-color:var(--color-brand-subtle); color:var(--color-brand-primary);">
                                <?= ((int)($item['LoaiSP'] ?? 0) === 1) ? 'Sách' : 'Văn phòng phẩm' ?>
                            </span>
                        </td>
                        <td style="text-align:right; font-weight:700; color:var(--color-accent-terracotta);">
                            <?= number_format((float)($item['GiaBan'] ?? 0), 0, ',', '.') ?> ₫
                        </td>
                        <td style="text-align:center; font-weight:600;">
                            <?= (int)($item['TonKho'] ?? 0) ?>
                        </td>
                        <td style="text-align:center; padding-right: var(--space-6);">
                            <div style="display:flex; justify-content:center; gap:6px;">
                                <a class="btn btn-outline btn-sm" href="index.php?controller=product&action=detail&id=<?= (int)$item['MaSP'] ?>" target="_blank">
                                    Xem
                                </a>
                                <a class="btn btn-primary btn-sm" href="index.php?controller=admin&action=editProduct&id=<?= (int)$item['MaSP'] ?>">
                                    Sửa
                                </a>
                                <a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="confirmDelete('index.php?controller=admin&action=deleteProduct&id=<?= (int)$item['MaSP'] ?>')">
                                    Xóa
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align:center; padding: var(--space-10); color: var(--color-ink-muted);">
                        Chưa có sản phẩm nào.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
