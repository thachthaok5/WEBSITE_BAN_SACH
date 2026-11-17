<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div style="margin-bottom: var(--space-6);">
    <div style="font-size: 13px; color: var(--color-ink-muted); margin-bottom: 6px;">
        <a href="index.php" style="color: var(--color-brand-primary);">Trang chủ</a> / <span>Sản phẩm</span>
    </div>

    <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 class="section-title" style="margin-bottom: 4px;">
                <?php 
                if (!empty($keyword)) {
                    echo 'Kết quả tìm kiếm cho: "' . htmlspecialchars($keyword) . '"';
                } elseif (isset($currentCategory)) {
                    echo ($currentCategory == 1) ? 'Sách Văn Học & Tri Thức' : (($currentCategory == 2) ? 'Văn Phòng Phẩm & Dụng Cụ' : 'Tất Cả Sản Phẩm');
                } else {
                    echo 'Tất Cả Sản Phẩm Tuyển Chọn';
                }
                ?>
            </h1>
            <p style="font-size: 14px; color: var(--color-ink-muted);">
                Tìm thấy <strong><?= !empty($products) ? count($products) : 0 ?></strong> sản phẩm phù hợp
            </p>
        </div>
    </div>
</div>

<div style="display:grid; grid-template-columns: 260px minmax(0, 1fr); gap: var(--space-8); align-items: flex-start;">
    <!-- Filter Sidebar -->
    <aside style="background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); padding: var(--space-6); box-shadow: var(--shadow-sm);">
        <h3 style="font-family: var(--font-display); font-size: 18px; margin-bottom: var(--space-4); color: var(--color-ink-primary);">
            Danh Mục
        </h3>

        <div style="display:flex; flex-direction:column; gap: var(--space-2); margin-bottom: var(--space-6);">
            <a class="nav-pill <?= (!isset($currentCategory) && empty($keyword)) ? 'active' : '' ?>" href="index.php?controller=product&action=list">
                Tất cả sản phẩm
            </a>
            <a class="nav-pill <?= (isset($currentCategory) && $currentCategory == 1) ? 'active' : '' ?>" href="index.php?controller=product&action=category&loai=1">
                Sách văn học &amp; tri thức
            </a>
            <a class="nav-pill <?= (isset($currentCategory) && $currentCategory == 2) ? 'active' : '' ?>" href="index.php?controller=product&action=category&loai=2">
                Văn phòng phẩm &amp; họa cụ
            </a>
            <a class="nav-pill" href="index.php?controller=product&action=search&keyword=vở">
                Sổ tay &amp; Vở học sinh
            </a>
            <a class="nav-pill" href="index.php?controller=product&action=search&keyword=bút">
                Bút viết các loại
            </a>
        </div>

        <div style="height: 1px; background-color: var(--color-border-subtle); margin-bottom: var(--space-6);"></div>

        <h3 style="font-family: var(--font-display); font-size: 18px; margin-bottom: var(--space-4); color: var(--color-ink-primary);">
            Khoảng Giá
        </h3>
        <div style="display:flex; flex-direction:column; gap: 8px; font-size: 14px; color: var(--color-ink-secondary);">
            <a href="index.php?controller=product&action=search&keyword=50000" style="padding:4px 0; color:var(--color-ink-secondary);">Dưới 50.000₫</a>
            <a href="index.php?controller=product&action=search&keyword=100000" style="padding:4px 0; color:var(--color-ink-secondary);">50.000₫ — 200.000₫</a>
            <a href="index.php?controller=product&action=search&keyword=200000" style="padding:4px 0; color:var(--color-ink-secondary);">Trên 200.000₫</a>
        </div>

        <div style="height: 1px; background-color: var(--color-border-subtle); margin: var(--space-6) 0;"></div>

        <div style="background-color: var(--color-bg-subtle); border-radius: var(--radius-md); padding: var(--space-4);">
            <div style="font-size: 13px; font-weight: 700; color: var(--color-brand-primary); margin-bottom: 4px;">
                DỊCH VỤ BOOKSTORE
            </div>
            <p style="font-size: 12.5px; color: var(--color-ink-muted); line-height: 1.5;">
                Cam kết 100% sách thật, chuẩn bản quyền. Hỗ trợ bọc sách plastic theo yêu cầu.
            </p>
        </div>
    </aside>

    <!-- Products Grid & Pagination -->
    <div>
        <?php if (!empty($products)): ?>
            <div class="grid-products">
                <?php foreach ($products as $item): ?>
                    <article class="product-card">
                        <div class="product-image-wrap">
                            <span class="product-badge-type">
                                <?= ((int)($item['LoaiSP'] ?? 0) === 1) ? 'Sách' : 'Văn phòng phẩm' ?>
                            </span>
                            <a href="index.php?controller=product&action=detail&id=<?= (int)$item['MaSP'] ?>">
                                <?php if (!empty($item['HinhAnh'])): ?>
                                    <img src="public/uploads/products/<?= htmlspecialchars($item['HinhAnh']) ?>" alt="<?= htmlspecialchars($item['TenSP']) ?>">
                                <?php else: ?>
                                    <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&w=400&q=80" alt="Bìa sản phẩm">
                                <?php endif; ?>
                            </a>
                        </div>

                        <div class="product-details">
                            <div class="product-meta-sub">Mã SP: #<?= (int)$item['MaSP'] ?></div>
                            <h3 class="product-title">
                                <a href="index.php?controller=product&action=detail&id=<?= (int)$item['MaSP'] ?>" title="<?= htmlspecialchars($item['TenSP']) ?>">
                                    <?= htmlspecialchars($item['TenSP']) ?>
                                </a>
                            </h3>

                            <div class="product-price-row">
                                <div class="price-current"><?= number_format((float)$item['GiaBan'], 0, ',', '.') ?> ₫</div>
                                <div class="price-old"><?= number_format((float)$item['GiaBan'] * 1.15, 0, ',', '.') ?> ₫</div>
                            </div>

                            <div class="product-card-actions">
                                <form action="index.php?controller=cart&action=add" method="POST">
                                    <input type="hidden" name="id" value="<?= (int)$item['MaSP'] ?>">
                                    <input type="hidden" name="qty" value="1">
                                    <button type="submit" class="btn btn-outline btn-sm">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="8" cy="21" r="1"></circle>
                                            <circle cx="19" cy="21" r="1"></circle>
                                            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
                                        </svg>
                                        <span>Thêm vào giỏ</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <?php if (!empty($totalPages) && $totalPages > 1): ?>
                <div style="display:flex; justify-content:center; gap:8px; margin-top: var(--space-10);">
                    <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                        <a 
                            href="index.php?controller=product&action=list&page=<?= $p ?>" 
                            class="btn <?= ($p === (int)($currentPage ?? 1)) ? 'btn-primary' : 'btn-outline' ?> btn-sm"
                            style="min-width: 36px;"
                        >
                            <?= $p ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>

        <?php else: ?>
            <div style="background-color: var(--color-bg-surface); border: 1px solid var(--color-border-subtle); border-radius: var(--radius-lg); padding: var(--space-12); text-align: center;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--color-ink-muted)" stroke-width="1.5" style="margin: 0 auto var(--space-4);">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </svg>
                <h3 style="font-family: var(--font-display); font-size: 20px; color: var(--color-ink-primary); margin-bottom: 8px;">
                    Không tìm thấy sản phẩm phù hợp
                </h3>
                <p style="color: var(--color-ink-muted); font-size: 14px; margin-bottom: var(--space-6);">
                    Vui lòng thử tìm kiếm với từ khóa khác hoặc quay lại danh mục tất cả sản phẩm.
                </p>
                <a href="index.php?controller=product&action=list" class="btn btn-primary">
                    Xem tất cả sản phẩm
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
