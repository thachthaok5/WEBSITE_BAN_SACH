<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- 1. Dòng chữ quảng cáo chạy lặp lại (Promotional News Ticker) -->
<div class="promo-ticker-wrap">
    <div class="promo-ticker-badge">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
        <span>Ưu đãi hôm nay</span>
    </div>
    <div class="promo-ticker-content">
        <div class="promo-ticker-track">
            <span>🔥 <strong>Hội Sách Mùa Mới:</strong> Giảm giá lên đến 40% cho hơn 500 tựa sách văn học &amp; kinh tế kinh điển!</span>
            <span>🎁 <strong>Quà Tặng Tri Ân:</strong> Tặng bookmark nghệ thuật giới hạn cho mọi đơn hàng trong tuần lễ này!</span>
            <span>🚚 <strong>Miễn Phí Vận Chuyển:</strong> Freeship toàn quốc cho mọi đơn hàng từ 250.000₫!</span>
            <span>✏️ <strong>Văn Phòng Phẩm:</strong> Bút viết, sổ tay ô ly cao cấp đồng giá chỉ từ 15.000₫!</span>
            <span>⚡ <strong>Giao Hàng An Toàn:</strong> Đóng gói màng co 3 lớp chống sốc, hỗ trợ đồng kiểm trước khi nhận!</span>
        </div>
    </div>
</div>

<!-- 2. Banner Chạy Lặp Lại Quảng Cáo Rộng Toàn Chiều Ngang (Full-Width Carousel Banner) -->
<section class="banner-carousel" id="mainBannerCarousel" style="margin-bottom: var(--space-8);">
    <div class="carousel-viewport">
        <div class="carousel-track" id="carouselTrack">
            <!-- Slide 1: Emerald Theme (Sách Hay Giảm Giá) -->
            <div class="carousel-slide slide-theme-emerald">
                <div class="carousel-content">
                    <div class="carousel-tag">
                        <span>✨ Đại tiệc tri thức mùa này</span>
                    </div>
                    <h2 class="carousel-title">
                        Mỗi Trang Sách — Một Hành Trình Khai Sáng
                    </h2>
                    <p class="carousel-desc">
                        Tuyển chọn hơn 1.000 tựa sách văn học, kinh tế, tâm lý học và phát triển bản thân xuất sắc nhất. Tận hưởng ưu đãi đặc quyền với mức giảm sâu lên đến 40%.
                    </p>
                    <div style="display:flex; gap:12px; flex-wrap:wrap;">
                        <a class="btn btn-accent btn-lg" href="index.php?controller=product&action=category&loai=1">
                            Khám phá tủ sách ngay
                        </a>
                        <a class="btn btn-outline btn-lg" href="index.php?controller=product&action=list" style="color:#ffffff; border-color:rgba(255,255,255,0.4); background:rgba(255,255,255,0.08);">
                            Xem tất cả sản phẩm
                        </a>
                    </div>
                </div>
                <div class="carousel-visual">
                    <div class="carousel-badge-circle">
                        <span class="pct">-40%</span>
                        <span class="lbl">Hội Sách</span>
                    </div>
                    <div class="carousel-image-card">
                        <img src="public/uploads/products/1775386471_69d23f6718a11.webp" alt="Sách văn học nổi bật" onerror="this.src='https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&w=600&q=80'">
                    </div>
                </div>
            </div>

            <!-- Slide 2: Terracotta Theme (Văn Phòng Phẩm) -->
            <div class="carousel-slide slide-theme-terracotta">
                <div class="carousel-content">
                    <div class="carousel-tag" style="color:#fed7aa;">
                        <span>🎒 Dụng cụ học tập &amp; sáng tạo</span>
                    </div>
                    <h2 class="carousel-title">
                        Văn Phòng Phẩm Tinh Tế — Nâng Niu Từng Ý Tưởng
                    </h2>
                    <p class="carousel-desc">
                        Khám phá bộ sưu tập bút ký cao cấp, sổ tay bìa cứng giấy dày chống thấm, thước kẻ và dụng cụ mỹ thuật chính hãng giúp khơi nguồn cảm hứng học tập mỗi ngày.
                    </p>
                    <div style="display:flex; gap:12px; flex-wrap:wrap;">
                        <a class="btn btn-primary btn-lg" href="index.php?controller=product&action=category&loai=2" style="background:#ffffff; color:#7c2d12;">
                            Mua sắm dụng cụ ngay
                        </a>
                        <a class="btn btn-outline btn-lg" href="index.php?controller=product&action=search&keyword=vở" style="color:#ffffff; border-color:rgba(255,255,255,0.4); background:rgba(255,255,255,0.08);">
                            Xem sổ tay &amp; vở
                        </a>
                    </div>
                </div>
                <div class="carousel-visual">
                    <div class="carousel-badge-circle" style="background:#0f4c3a;">
                        <span class="pct" style="font-size:18px;">TỪ 15K</span>
                        <span class="lbl">Chính Hãng</span>
                    </div>
                    <div class="carousel-image-card">
                        <img src="public/uploads/products/1775386871_69d240f7e2be7.webp" alt="Văn phòng phẩm cao cấp" onerror="this.src='https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?auto=format&fit=crop&w=600&q=80'">
                    </div>
                </div>
            </div>

            <!-- Slide 3: Sapphire Theme (Freeship & Chính Sách) -->
            <div class="carousel-slide slide-theme-sapphire">
                <div class="carousel-content">
                    <div class="carousel-tag" style="color:#bae6fd;">
                        <span>🚚 Trải nghiệm mua sắm an tâm</span>
                    </div>
                    <h2 class="carousel-title">
                        Miễn Phí Giao Hàng Toàn Quốc Cho Đơn Từ 250K
                    </h2>
                    <p class="carousel-desc">
                        Mọi ấn bản đều được bọc màng bảo vệ, đóng thùng carton chống sốc 3 lớp chắc chắn. Độc giả được quyền kiểm tra hàng trước khi thanh toán và đổi trả miễn phí trong 7 ngày.
                    </p>
                    <div style="display:flex; gap:12px; flex-wrap:wrap;">
                        <a class="btn btn-accent btn-lg" href="index.php?controller=product&action=list">
                            Chọn sách nhận Freeship
                        </a>
                    </div>
                </div>
                <div class="carousel-visual">
                    <div class="carousel-badge-circle" style="background:#2563eb;">
                        <span class="pct" style="font-size:16px;">FREESHIP</span>
                        <span class="lbl">Toàn Quốc</span>
                    </div>
                    <div class="carousel-image-card">
                        <img src="public/uploads/products/1775386502_69d23f86940ad.webp" alt="Đóng gói sách cẩn thận" onerror="this.src='https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=600&q=80'">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Arrows -->
    <button type="button" class="carousel-btn carousel-btn-prev" id="carouselPrevBtn" aria-label="Slide trước">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m15 18-6-6 6-6"></path></svg>
    </button>
    <button type="button" class="carousel-btn carousel-btn-next" id="carouselNextBtn" aria-label="Slide kế tiếp">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"></path></svg>
    </button>

    <!-- Navigation Dots -->
    <div class="carousel-dots" id="carouselDots">
        <button type="button" class="carousel-dot active" data-slide="0" aria-label="Slide 1"></button>
        <button type="button" class="carousel-dot" data-slide="1" aria-label="Slide 2"></button>
        <button type="button" class="carousel-dot" data-slide="2" aria-label="Slide 3"></button>
    </div>
</section>

<!-- 3. Quick Category Circles: Nhận diện Sàn Thương Mại Điện Tử Chuyên Nghiệp -->
<div class="quick-categories-bar">
    <a href="#flashSaleSection" class="quick-cat-item">
        <div class="quick-cat-icon" style="background:#fee2e2; color:#dc2626;">⚡</div>
        <span class="quick-cat-title">Flash Sale</span>
    </a>
    <a href="index.php?controller=product&action=category&loai=1" class="quick-cat-item">
        <div class="quick-cat-icon" style="background:#fef3c7; color:#d97706;">📚</div>
        <span class="quick-cat-title">Top 100 Sách</span>
    </a>
    <a href="index.php?controller=product&action=category&loai=2" class="quick-cat-item">
        <div class="quick-cat-icon" style="background:#dbeafe; color:#2563eb;">🎨</div>
        <span class="quick-cat-title">Dụng Cụ Vẽ</span>
    </a>
    <a href="index.php?controller=product&action=search&keyword=vở" class="quick-cat-item">
        <div class="quick-cat-icon" style="background:#dcfce7; color:#16a34a;">📔</div>
        <span class="quick-cat-title">Sổ &amp; Vở Học Sinh</span>
    </a>
    <a href="index.php?controller=product&action=search&keyword=bút" class="quick-cat-item">
        <div class="quick-cat-icon" style="background:#f3e8ff; color:#9333ea;">✒️</div>
        <span class="quick-cat-title">Bút Viết Cao Cấp</span>
    </a>
    <a href="index.php?controller=product&action=category&loai=1" class="quick-cat-item">
        <div class="quick-cat-icon" style="background:#ffedd5; color:#ea580c;">📖</div>
        <span class="quick-cat-title">Manga - Comic</span>
    </a>
    <a href="index.php?controller=product&action=list" class="quick-cat-item">
        <div class="quick-cat-icon" style="background:#e0f2fe; color:#0284c7;">🎁</div>
        <span class="quick-cat-title">Mã Giảm Giá</span>
    </a>
    <a href="index.php?controller=product&action=list" class="quick-cat-item">
        <div class="quick-cat-icon" style="background:#ecfdf5; color:#059669;">🚚</div>
        <span class="quick-cat-title">Freeship 0Đ</span>
    </a>
</div>

<!-- 4. Flash Sale Giờ Vàng (Thương Mại Điện Tử Có Countdown Timer Thật) -->
<section class="flash-sale-section" id="flashSaleSection">
    <div class="flash-sale-header">
        <div class="flash-sale-title-wrap">
            <h3 class="flash-sale-title">
                <span>⚡</span> GIỜ VÀNG GIÁ SỐC — FLASH SALE
            </h3>
            <div class="flash-sale-countdown">
                <span>Kết thúc sau:</span>
                <span class="cd-box" id="cdHours">02</span> : 
                <span class="cd-box" id="cdMins">45</span> : 
                <span class="cd-box" id="cdSecs">30</span>
            </div>
        </div>
        <a class="section-link" href="index.php?controller=product&action=list" style="color:#9a3412;">
            <span>Xem tất cả deal sốc</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"></path></svg>
        </a>
    </div>

    <div class="flash-sale-grid">
        <?php 
        $flashProducts = !empty($products) ? array_slice($products, 0, 4) : [];
        $fsDiscounts = [35, 40, 25, 30];
        $fsSold = [28, 42, 19, 34];
        $fsTotal = [35, 50, 25, 40];
        foreach ($flashProducts as $idx => $fItem): 
            $pct = $fsDiscounts[$idx % 4];
            $sold = $fsSold[$idx % 4];
            $cap = $fsTotal[$idx % 4];
            $barWidth = round(($sold / $cap) * 100);
        ?>
            <article class="flash-sale-card">
                <span class="flash-sale-badge">-<?= $pct ?>%</span>
                <div class="product-image-wrap" style="margin-bottom:var(--space-3);">
                    <a href="index.php?controller=product&action=detail&id=<?= (int)$fItem['MaSP'] ?>">
                        <?php if (!empty($fItem['HinhAnh'])): ?>
                            <img src="public/uploads/products/<?= htmlspecialchars($fItem['HinhAnh']) ?>" alt="<?= htmlspecialchars($fItem['TenSP']) ?>">
                        <?php else: ?>
                            <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&w=400&q=80" alt="Bìa sách">
                        <?php endif; ?>
                    </a>
                </div>

                <div class="product-commercial-meta">
                    <span class="product-stars">★★★★★ 4.9</span>
                    <span class="product-sold">Đã bán <?= $sold ?></span>
                </div>

                <h4 class="product-title" style="font-size:14px; margin-bottom:4px;">
                    <a href="index.php?controller=product&action=detail&id=<?= (int)$fItem['MaSP'] ?>">
                        <?= htmlspecialchars($fItem['TenSP']) ?>
                    </a>
                </h4>

                <div class="product-price-row" style="margin-bottom:var(--space-2);">
                    <div class="price-current" style="color:#dc2626; font-size:16px;">
                        <?= number_format((float)$fItem['GiaBan'] * (1 - $pct/100), 0, ',', '.') ?> ₫
                    </div>
                    <div class="price-old">
                        <?= number_format((float)$fItem['GiaBan'], 0, ',', '.') ?> ₫
                    </div>
                </div>

                <!-- Hot Flame Progress Bar -->
                <div class="flash-sale-progress">
                    <div class="fs-bar-track">
                        <div class="fs-bar-fill" style="width: <?= $barWidth ?>%;"></div>
                        <div class="fs-bar-text">🔥 ĐÃ BÁN <?= $sold ?>/<?= $cap ?></div>
                    </div>
                </div>

                <form action="index.php?controller=cart&action=add" method="POST" style="margin-top:auto;">
                    <input type="hidden" name="id" value="<?= (int)$fItem['MaSP'] ?>">
                    <input type="hidden" name="qty" value="1">
                    <button type="submit" class="btn btn-accent btn-sm" style="width:100%; padding:7px 10px;">
                        Mua ngay
                    </button>
                </form>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<!-- 5. Value Proposition Features: Re-architected Trust Ribbon -->
<div class="trust-ribbon">
    <div class="trust-ribbon-item">
        <div class="trust-ribbon-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect width="16" height="13" x="1" y="6" rx="2"></rect>
                <path d="M17 10h4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-4"></path>
                <circle cx="7" cy="19" r="2"></circle>
                <circle cx="17" cy="19" r="2"></circle>
            </svg>
        </div>
        <div class="trust-ribbon-info">
            <span class="trust-ribbon-title">Giao Hàng Toàn Quốc</span>
            <span class="trust-ribbon-desc">Đóng gói 3 lớp, bảo vệ gáy sách</span>
        </div>
    </div>

    <div class="trust-ribbon-item">
        <div class="trust-ribbon-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"></path>
            </svg>
        </div>
        <div class="trust-ribbon-info">
            <span class="trust-ribbon-title">100% Chính Hãng</span>
            <span class="trust-ribbon-desc">Sách chuẩn từ các NXB uy tín</span>
        </div>
    </div>

    <div class="trust-ribbon-item">
        <div class="trust-ribbon-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"></path>
                <path d="M21 3v5h-5"></path>
                <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"></path>
                <path d="M8 16H3v5"></path>
            </svg>
        </div>
        <div class="trust-ribbon-info">
            <span class="trust-ribbon-title">Đổi Trả Trong 7 Ngày</span>
            <span class="trust-ribbon-desc">Đổi mới miễn phí nếu lỗi in ấn</span>
        </div>
    </div>

    <div class="trust-ribbon-item">
        <div class="trust-ribbon-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
        </div>
        <div class="trust-ribbon-info">
            <span class="trust-ribbon-title">Tư Vấn Chu Đáo</span>
            <span class="trust-ribbon-desc">Gợi ý tác phẩm hợp gu của bạn</span>
        </div>
    </div>
</div>

<!-- 4. Sách Nổi Bật Tuyển Chọn -->
<section style="margin-bottom: var(--space-16);">
    <div class="section-header">
        <div>
            <h2 class="section-title">Sách Văn Học &amp; Tri Thức Mới</h2>
            <p style="font-size:14px; color:var(--color-ink-muted); margin-top:4px;">Những tựa sách được độc giả quan tâm và đánh giá cao nhất</p>
        </div>
        <a class="section-link" href="index.php?controller=product&action=category&loai=1">
            <span>Xem tất cả sách</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"></path></svg>
        </a>
    </div>

    <div class="grid-products">
        <?php 
        $displayBooks = !empty($books) ? $books : (!empty($products) ? $products : []);
        if (!empty($displayBooks)): 
            foreach (array_slice($displayBooks, 0, 8) as $bIdx => $item): 
                $soldCount = (int)$item['MaSP'] * 37 + 120;
                $starRating = number_format(4.8 + (($bIdx % 3) * 0.1), 1);
        ?>
            <article class="product-card">
                <div class="product-image-wrap">
                    <span class="product-badge-type">Sách</span>
                    <span class="badge-discount-tag">-15%</span>
                    <a href="index.php?controller=product&action=detail&id=<?= (int)$item['MaSP'] ?>">
                        <?php if (!empty($item['HinhAnh'])): ?>
                            <img src="public/uploads/products/<?= htmlspecialchars($item['HinhAnh']) ?>" alt="<?= htmlspecialchars($item['TenSP']) ?>">
                        <?php else: ?>
                            <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&w=400&q=80" alt="Bìa sách">
                        <?php endif; ?>
                    </a>
                </div>

                <div class="product-details">
                    <div class="product-commercial-meta">
                        <span class="product-stars">★★★★★ <?= $starRating ?></span>
                        <span class="product-sold">Đã bán <?= $soldCount ?></span>
                    </div>

                    <h3 class="product-title">
                        <a href="index.php?controller=product&action=detail&id=<?= (int)$item['MaSP'] ?>" title="<?= htmlspecialchars($item['TenSP']) ?>">
                            <?= htmlspecialchars($item['TenSP']) ?>
                        </a>
                    </h3>

                    <div class="product-price-row">
                        <div class="price-current"><?= number_format((float)$item['GiaBan'], 0, ',', '.') ?> ₫</div>
                        <div class="price-old"><?= number_format((float)$item['GiaBan'] * 1.18, 0, ',', '.') ?> ₫</div>
                    </div>

                    <span class="shipping-speed-badge">⚡ Giao siêu tốc 2h</span>

                    <div class="product-card-actions" style="margin-top:var(--space-3);">
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
        <?php 
            endforeach; 
        endif; 
        ?>
    </div>
</section>

<!-- 7. Văn Phòng Phẩm & Dụng Cụ Học Tập -->
<?php if (!empty($stationery)): ?>
<section style="margin-bottom: var(--space-16);">
    <div class="section-header">
        <div>
            <h2 class="section-title">Văn Phòng Phẩm &amp; Dụng Cụ Học Tập</h2>
            <p style="font-size:14px; color:var(--color-ink-muted); margin-top:4px;">Bút viết, sổ tay, thước kẻ và phụ kiện hỗ trợ học tập đắc lực</p>
        </div>
        <a class="section-link" href="index.php?controller=product&action=category&loai=2">
            <span>Xem tất cả văn phòng phẩm</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"></path></svg>
        </a>
    </div>

    <div class="grid-products">
        <?php foreach ($stationery as $sIdx => $item): 
            $sSold = (int)$item['MaSP'] * 45 + 180;
            $sRating = number_format(4.9, 1);
        ?>
            <article class="product-card">
                <div class="product-image-wrap">
                    <span class="product-badge-type" style="color:var(--color-accent-terracotta);">Văn phòng phẩm</span>
                    <span class="badge-discount-tag">-20%</span>
                    <a href="index.php?controller=product&action=detail&id=<?= (int)$item['MaSP'] ?>">
                        <?php if (!empty($item['HinhAnh'])): ?>
                            <img src="public/uploads/products/<?= htmlspecialchars($item['HinhAnh']) ?>" alt="<?= htmlspecialchars($item['TenSP']) ?>">
                        <?php else: ?>
                            <img src="https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?auto=format&fit=crop&w=400&q=80" alt="Văn phòng phẩm">
                        <?php endif; ?>
                    </a>
                </div>

                <div class="product-details">
                    <div class="product-commercial-meta">
                        <span class="product-stars">★★★★★ <?= $sRating ?></span>
                        <span class="product-sold">Đã bán <?= $sSold ?></span>
                    </div>

                    <h3 class="product-title">
                        <a href="index.php?controller=product&action=detail&id=<?= (int)$item['MaSP'] ?>" title="<?= htmlspecialchars($item['TenSP']) ?>">
                            <?= htmlspecialchars($item['TenSP']) ?>
                        </a>
                    </h3>

                    <div class="product-price-row">
                        <div class="price-current"><?= number_format((float)$item['GiaBan'], 0, ',', '.') ?> ₫</div>
                        <div class="price-old"><?= number_format((float)$item['GiaBan'] * 1.25, 0, ',', '.') ?> ₫</div>
                    </div>

                    <span class="shipping-speed-badge">⚡ Giao siêu tốc 2h</span>

                    <div class="product-card-actions" style="margin-top:var(--space-3);">
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
</section>
<?php endif; ?>

<!-- 5. Editorial Literary Experience & Brand Assurances -->
<section class="editorial-literary-section">
    <!-- Epigraph Banner (Nghệ thuật danh ngôn khơi nguồn - Lấy cảm hứng trực tiếp từ trích dẫn bạn đọc) -->
    <div class="literary-epigraph-banner">
        <div class="epigraph-ornament-top">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2L14.39 8.26L21 9.27L16.5 14.14L17.77 21L12 17.77L6.23 21L7.5 14.14L3 9.27L9.61 8.26L12 2Z"/>
            </svg>
        </div>
        <blockquote class="epigraph-quote">
            “Sách mở ra trước mắt tôi những chân trời mới, đưa tôi gặp gỡ những tư tưởng vĩ đại và tìm thấy sự bình yên trong tâm hồn.”
        </blockquote>
        <div class="epigraph-attribution">
            <span class="epigraph-rule"></span>
            <span class="epigraph-author">DANH NGÔN BẠN ĐỌC BOOKSTORE</span>
            <span class="epigraph-rule"></span>
        </div>
    </div>

    <!-- 4 Cam kết dịch vụ (Thiết kế phẳng, thoáng đãng, không lồng card) -->
    <div class="service-features-grid">
        <div class="service-card">
            <div class="service-icon-box">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="16" height="13" x="1" y="6" rx="2"></rect>
                    <path d="M17 10h4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-4"></path>
                    <circle cx="7" cy="19" r="2"></circle>
                    <circle cx="17" cy="19" r="2"></circle>
                </svg>
            </div>
            <div class="service-info">
                <h4 class="service-title">Giao hàng toàn quốc</h4>
                <p class="service-desc">Đóng gói cẩn thận chống va đập, bảo vệ gáy sách nguyên vẹn khi tới tay bạn.</p>
            </div>
        </div>

        <div class="service-card">
            <div class="service-icon-box">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"></path>
                </svg>
            </div>
            <div class="service-info">
                <h4 class="service-title">100% Chính hãng</h4>
                <p class="service-desc">Cam kết sách và văn phòng phẩm chuẩn từ các nhà xuất bản uy tín hàng đầu.</p>
            </div>
        </div>

        <div class="service-card">
            <div class="service-icon-box">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"></path>
                    <path d="M21 3v5h-5"></path>
                    <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"></path>
                    <path d="M8 16H3v5"></path>
                </svg>
            </div>
            <div class="service-info">
                <h4 class="service-title">Đổi trả trong 7 ngày</h4>
                <p class="service-desc">Hỗ trợ đổi mới nhanh chóng và miễn phí nếu có lỗi in ấn, nhòe trang hoặc gãy gập.</p>
            </div>
        </div>

        <div class="service-card">
            <div class="service-icon-box">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
                </svg>
            </div>
            <div class="service-info">
                <h4 class="service-title">Tư vấn chu đáo</h4>
                <p class="service-desc">Đội ngũ yêu sách luôn sẵn sàng trò chuyện, gợi ý tác phẩm phù hợp với bạn.</p>
            </div>
        </div>
    </div>
</section>

<!-- Script điều khiển Banner Carousel Tự Động Lặp Lại -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const track = document.getElementById('carouselTrack');
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.carousel-dot');
    const prevBtn = document.getElementById('carouselPrevBtn');
    const nextBtn = document.getElementById('carouselNextBtn');
    const carouselEl = document.getElementById('mainBannerCarousel');

    if (!track || slides.length === 0) return;

    let currentIndex = 0;
    const totalSlides = slides.length;
    let autoplayTimer = null;
    const AUTOPLAY_INTERVAL = 4500; // 4.5 giây lặp lại 1 lần

    function goToSlide(index) {
        if (index < 0) {
            currentIndex = totalSlides - 1;
        } else if (index >= totalSlides) {
            currentIndex = 0;
        } else {
            currentIndex = index;
        }

        track.style.transform = `translateX(-${currentIndex * 100}%)`;

        dots.forEach((dot, idx) => {
            if (idx === currentIndex) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
    }

    function startAutoplay() {
        stopAutoplay();
        autoplayTimer = setInterval(() => {
            goToSlide(currentIndex + 1);
        }, AUTOPLAY_INTERVAL);
    }

    function stopAutoplay() {
        if (autoplayTimer) {
            clearInterval(autoplayTimer);
            autoplayTimer = null;
        }
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            goToSlide(currentIndex + 1);
            startAutoplay();
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            goToSlide(currentIndex - 1);
            startAutoplay();
        });
    }

    dots.forEach(dot => {
        dot.addEventListener('click', function () {
            const slideIdx = parseInt(this.getAttribute('data-slide'));
            goToSlide(slideIdx);
            startAutoplay();
        });
    });

    // Dừng khi rê chuột vào để độc giả dễ đọc, tiếp tục khi rê ra
    if (carouselEl) {
        carouselEl.addEventListener('mouseenter', stopAutoplay);
        carouselEl.addEventListener('mouseleave', startAutoplay);
    }

    // Khởi động chạy tự động
    startAutoplay();

    // 2. Real-Time Countdown Timer cho Flash Sale Giờ Vàng
    function updateFlashSaleTimer() {
        const now = new Date();
        const midnight = new Date();
        midnight.setHours(23, 59, 59, 999);
        const diff = Math.max(0, midnight - now);

        const hours = Math.floor(diff / (1000 * 60 * 60));
        const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const secs = Math.floor((diff % (1000 * 60)) / 1000);

        const hEl = document.getElementById('cdHours');
        const mEl = document.getElementById('cdMins');
        const sEl = document.getElementById('cdSecs');

        if (hEl) hEl.textContent = String(hours).padStart(2, '0');
        if (mEl) mEl.textContent = String(mins).padStart(2, '0');
        if (sEl) sEl.textContent = String(secs).padStart(2, '0');
    }

    updateFlashSaleTimer();
    setInterval(updateFlashSaleTimer, 1000);
});
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
