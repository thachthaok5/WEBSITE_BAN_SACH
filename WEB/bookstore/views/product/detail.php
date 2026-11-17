<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php if (!empty($product)): ?>
    <div style="font-size: 13px; color: var(--color-ink-muted); margin-bottom: var(--space-6);">
        <a href="index.php" style="color: var(--color-brand-primary);">Trang chủ</a> / 
        <a href="index.php?controller=product&action=category&loai=<?= (int)$product['LoaiSP'] ?>" style="color: var(--color-brand-primary);">
            <?= ((int)$product['LoaiSP'] === 1) ? 'Sách' : 'Văn phòng phẩm' ?>
        </a> / 
        <span><?= htmlspecialchars($product['TenSP']) ?></span>
    </div>

    <div class="product-detail-layout">
        <!-- Visual Column -->
        <div>
            <div class="product-gallery-main">
                <?php if (!empty($product['HinhAnh'])): ?>
                    <img src="public/uploads/products/<?= htmlspecialchars($product['HinhAnh']) ?>" alt="<?= htmlspecialchars($product['TenSP']) ?>">
                <?php else: ?>
                    <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&w=800&q=80" alt="Bìa tác phẩm">
                <?php endif; ?>
            </div>

            <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-top: var(--space-4);">
                <div style="background-color: var(--color-bg-subtle); border-radius: var(--radius-sm); padding: 10px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--color-brand-primary);">BẢN QUYỀN</div>
                    <div style="font-size: 12px; color: var(--color-ink-muted); margin-top: 2px;">Chính hãng 100%</div>
                </div>
                <div style="background-color: var(--color-bg-subtle); border-radius: var(--radius-sm); padding: 10px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--color-brand-primary);">BỌC SÁCH</div>
                    <div style="font-size: 12px; color: var(--color-ink-muted); margin-top: 2px;">Chống trầy xước</div>
                </div>
                <div style="background-color: var(--color-bg-subtle); border-radius: var(--radius-sm); padding: 10px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--color-brand-primary);">ĐỔI TRẢ</div>
                    <div style="font-size: 12px; color: var(--color-ink-muted); margin-top: 2px;">Trong 7 ngày</div>
                </div>
            </div>
        </div>

        <!-- Information Column -->
        <div class="detail-info">
            <span class="detail-category-badge">
                <?= ((int)$product['LoaiSP'] === 1) ? '📖 Sách Văn Học' : '✏️ Văn Phòng Phẩm' ?>
            </span>

            <h1 class="detail-title"><?= htmlspecialchars($product['TenSP']) ?></h1>

            <div class="detail-price-box">
                <span class="price-big"><?= number_format((float)$product['GiaBan'], 0, ',', '.') ?> ₫</span>
                <span style="font-size: 15px; color: var(--color-ink-muted); text-decoration: line-through;">
                    <?= number_format((float)$product['GiaBan'] * 1.15, 0, ',', '.') ?> ₫
                </span>
                <span style="margin-left: auto; font-size: 13.5px; color: var(--color-ink-secondary);">
                    Kho: <strong style="color:var(--color-ink-primary);"><?= (int)($product['TonKho'] ?? 0) ?></strong> sản phẩm
                </span>
            </div>

            <!-- Product Specs Table -->
            <table class="detail-specs-table">
                <tbody>
                    <?php if ((int)$product['LoaiSP'] === 1): ?>
                        <?php if (!empty($product['TacGia'])): ?>
                            <tr>
                                <th>Tác giả</th>
                                <td><?= htmlspecialchars($product['TacGia']) ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if (!empty($product['NXB'])): ?>
                            <tr>
                                <th>Nhà xuất bản</th>
                                <td><?= htmlspecialchars($product['NXB']) ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if (!empty($product['ISBN'])): ?>
                            <tr>
                                <th>Mã ISBN</th>
                                <td><?= htmlspecialchars($product['ISBN']) ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if (!empty($product['SoTrang'])): ?>
                            <tr>
                                <th>Số trang</th>
                                <td><?= htmlspecialchars($product['SoTrang']) ?> trang</td>
                            </tr>
                        <?php endif; ?>
                        <?php if (!empty($product['KichThuocTL'])): ?>
                            <tr>
                                <th>Kích thước / Trọng lượng</th>
                                <td><?= htmlspecialchars($product['KichThuocTL']) ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if (!empty($product['ThuongHieu'])): ?>
                            <tr>
                                <th>Thương hiệu</th>
                                <td><?= htmlspecialchars($product['ThuongHieu']) ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if (!empty($product['XuatXu'])): ?>
                            <tr>
                                <th>Xuất xứ</th>
                                <td><?= htmlspecialchars($product['XuatXu']) ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if (!empty($product['MauSac'])): ?>
                            <tr>
                                <th>Màu sắc</th>
                                <td><?= htmlspecialchars($product['MauSac']) ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endif; ?>
                    <tr>
                        <th>Tình trạng</th>
                        <td style="color:var(--color-success);">Mới 100% — Nguyên màng co</td>
                    </tr>
                </tbody>
            </table>

            <!-- Add to Cart Form -->
            <form action="index.php?controller=cart&action=add" method="POST">
                <input type="hidden" name="id" value="<?= (int)$product['MaSP'] ?>">

                <div style="display:flex; align-items:center; gap: var(--space-4); margin-bottom: var(--space-6);">
                    <span style="font-size: 14px; font-weight: 600; color: var(--color-ink-primary);">Số lượng:</span>
                    <div class="quantity-control">
                        <button type="button" onclick="decrementQty()">-</button>
                        <input type="number" id="detailQtyInput" name="qty" value="1" min="1" max="<?= max(1, (int)$product['TonKho']) ?>">
                        <button type="button" onclick="incrementQty()">+</button>
                    </div>
                </div>

                <div class="detail-actions-row">
                    <button type="submit" class="btn btn-outline btn-lg" style="flex:1;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="8" cy="21" r="1"></circle>
                            <circle cx="19" cy="21" r="1"></circle>
                            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
                        </svg>
                        <span>Thêm vào giỏ hàng</span>
                    </button>
                    <button type="submit" class="btn btn-accent btn-lg" style="flex:1;">
                        Mua ngay
                    </button>
                </div>
            </form>

            <!-- Product Trust & Assurance Badges (Cam kết chất lượng ngay tại trang mua) -->
            <div class="product-trust-badges">
                <div class="product-trust-item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"></path>
                    </svg>
                    <span><strong>100% Sách thật &amp; Chính hãng:</strong> Nhập từ NXB uy tín, nói không với sách lậu.</span>
                </div>
                <div class="product-trust-item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect width="16" height="13" x="1" y="6" rx="2"></rect>
                        <path d="M17 10h4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-4"></path>
                        <circle cx="7" cy="19" r="2"></circle>
                        <circle cx="17" cy="19" r="2"></circle>
                    </svg>
                    <span><strong>Đóng gói bảo vệ:</strong> Chèn xốp bóng khí 3 lớp, chống móp méo gáy sách khi vận chuyển.</span>
                </div>
                <div class="product-trust-item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"></path>
                        <path d="M21 3v5h-5"></path>
                        <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"></path>
                        <path d="M8 16H3v5"></path>
                    </svg>
                    <span><strong>Đổi trả 7 ngày:</strong> Đổi mới 1:1 miễn phí nếu có lỗi in ấn, rách bìa hoặc gãy gập.</span>
                </div>
            </div>

            <!-- Description -->
            <div style="margin-top: var(--space-8); padding-top: var(--space-6); border-top: 1px solid var(--color-border-subtle);">
                <h3 style="font-family: var(--font-display); font-size: 20px; color: var(--color-ink-primary); margin-bottom: var(--space-3);">
                    Giới Thiệu Nội Dung
                </h3>
                <div style="font-size: 14.5px; line-height: 1.8; color: var(--color-ink-secondary);">
                    <?= nl2br(htmlspecialchars($product['MoTa'] ?? 'Tác phẩm đang được cập nhật thông tin giới thiệu chi tiết.')) ?>
                </div>
            </div>
        </div>
    </div>

    <script>
    function decrementQty() {
        var input = document.getElementById('detailQtyInput');
        var val = parseInt(input.value) || 1;
        if (val > 1) {
            input.value = val - 1;
        }
    }
    function incrementQty() {
        var input = document.getElementById('detailQtyInput');
        var val = parseInt(input.value) || 1;
        var max = parseInt(input.max) || 999;
        if (val < max) {
            input.value = val + 1;
        }
    }
    </script>
<?php else: ?>
    <div class="alert alert-danger">Không tìm thấy thông tin sản phẩm này.</div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
