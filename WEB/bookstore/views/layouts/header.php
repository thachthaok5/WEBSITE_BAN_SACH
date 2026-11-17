<?php
$cartCount = 0;
if (!empty($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cartItem) {
        $cartCount += (int)($cartItem['qty'] ?? 0);
    }
}
$currentController = $_GET['controller'] ?? 'home';
$currentAction = $_GET['action'] ?? 'index';
$currentLoai = $_GET['loai'] ?? '';
$cssVersion = time();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'BookStore - Hiệu Sách & Văn Phòng Phẩm') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Lora:ital,wght@0,500;0,600;0,700;1,500;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css?v=<?= $cssVersion ?>">
    <style>
        /* Immediate fallback to prevent uncached SVG blowout */
        svg { max-width: 100%; }
        .brand-logo-icon { width: 28px !important; height: 28px !important; max-width: 28px !important; max-height: 28px !important; flex-shrink: 0; }
        .cart-icon { width: 20px !important; height: 20px !important; max-width: 20px !important; max-height: 20px !important; flex-shrink: 0; }
        .search-icon { width: 18px !important; height: 18px !important; max-width: 18px !important; max-height: 18px !important; flex-shrink: 0; }
        .cart-trigger { width: 42px !important; height: 42px !important; display: inline-flex !important; align-items: center !important; justify-content: center !important; position: relative !important; flex-shrink: 0; }
    </style>
</head>
<body>

<header class="site-header">
    <!-- Top Announcement & Hotline Utility Bar -->
    <div class="announcement-bar">
        <div class="wrapper announcement-inner">
            <div class="announcement-left">
                <span>📞 Hotline Đặt Hàng &amp; CSKH: <strong>1900 6868</strong> (8:00 - 21:30)</span>
                <span class="announcement-sep">|</span>
                <span>🚚 Miễn phí vận chuyển cho đơn từ <strong>250.000₫</strong> toàn quốc</span>
            </div>
            <div class="announcement-right">
                <a href="index.php?controller=order&action=myOrders" class="announcement-link">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                    <span>Tra cứu đơn hàng</span>
                </a>
                <span class="announcement-sep">|</span>
                <span style="color:#d1fae5; font-weight:600;">✓ 100% Sách &amp; VPP chính hãng</span>
            </div>
        </div>
    </div>

    <!-- Main Header Bar -->
    <div class="header-main">
        <div class="wrapper header-row">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-logo" title="Về trang chủ BookStore">
                <svg class="brand-logo-icon" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:30px; height:30px; flex-shrink:0;">
                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"></path>
                    <path d="M6 6h10"></path>
                    <path d="M6 10h10"></path>
                </svg>
                <div class="brand-text-col">
                    <span class="brand-name">BookStore</span>
                    <span class="tag">Hệ Thống Nhà Sách Trực Tuyến</span>
                </div>
            </a>

            <!-- Search Area: Thoáng đãng, tinh gọn & cân xứng -->
            <div class="search-container">
                <form class="search-form" action="index.php" method="GET">
                    <input type="hidden" name="controller" value="product">
                    <input type="hidden" name="action" value="search">
                    <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:18px; height:18px; flex-shrink:0;">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </svg>
                    <input
                        type="text"
                        name="keyword"
                        placeholder="Tìm kiếm tựa sách, tác giả, văn phòng phẩm..."
                        value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>"
                        autocomplete="off"
                        required
                    >
                    <button type="submit">Tìm kiếm</button>
                </form>
            </div>

            <!-- Header Actions: Bố cục rộng rãi, thoáng mắt -->
            <div class="header-actions">
                <!-- Cart Link with Badge -->
                <a class="cart-trigger" href="index.php?controller=cart&action=index" title="Xem giỏ hàng" style="width:42px; height:42px; display:inline-flex; align-items:center; justify-content:center; position:relative; flex-shrink:0;">
                    <svg class="cart-icon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:22px; height:22px; max-width:22px; max-height:22px; flex-shrink:0;">
                        <circle cx="8" cy="21" r="1"></circle>
                        <circle cx="19" cy="21" r="1"></circle>
                        <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
                    </svg>
                    <?php if ($cartCount > 0): ?>
                        <span class="cart-badge"><?= $cartCount ?></span>
                    <?php endif; ?>
                </a>

                <!-- User Account Dropdown or Auth Links -->
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="user-menu-wrapper">
                        <button type="button" class="user-btn-trigger">
                            <span class="user-avatar-badge">
                                <?= strtoupper(mb_substr($_SESSION['user']['fullname'] ?? 'U', 0, 1, 'UTF-8')) ?>
                            </span>
                            <span class="user-display-name"><?= htmlspecialchars($_SESSION['user']['fullname']) ?></span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="m6 9 6 6 6-6"></path>
                            </svg>
                        </button>

                        <div class="user-dropdown-menu">
                            <a href="index.php?controller=user&action=profile">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span>Hồ sơ cá nhân</span>
                            </a>
                            <a href="index.php?controller=order&action=myOrders">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                </svg>
                                <span>Đơn hàng của tôi</span>
                            </a>
                            <a href="index.php?controller=user&action=edit">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 20h9"></path>
                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                </svg>
                                <span>Cập nhật tài khoản</span>
                            </a>
                            <?php if (($_SESSION['user']['role'] ?? '') === 'admin'): ?>
                                <a href="index.php?controller=admin&action=dashboard" class="user-dropdown-admin-link">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect width="7" height="9" x="3" y="3" rx="1"></rect>
                                        <rect width="7" height="5" x="14" y="3" rx="1"></rect>
                                        <rect width="7" height="9" x="14" y="12" rx="1"></rect>
                                        <rect width="7" height="5" x="3" y="16" rx="1"></rect>
                                    </svg>
                                    <span>Trang quản trị (Admin)</span>
                                </a>
                            <?php endif; ?>
                            <div class="user-dropdown-divider"></div>
                            <a href="index.php?controller=auth&action=logout" class="user-dropdown-logout">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span>Đăng xuất</span>
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="auth-buttons">
                        <a class="btn btn-outline btn-sm" href="index.php?controller=auth&action=login">Đăng nhập</a>
                        <a class="btn btn-primary btn-sm" href="index.php?controller=auth&action=register">Đăng ký</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Category Mega Navigation Bar -->
    <div class="nav-subbar">
        <div class="wrapper nav-subbar-row">
            <!-- Mega Category Trigger -->
            <div class="category-menu-dropdown">
                <a href="index.php?controller=product&action=list" class="category-menu-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <line x1="4" x2="20" y1="6" y2="6"></line>
                        <line x1="4" x2="20" y1="12" y2="12"></line>
                        <line x1="4" x2="20" y1="18" y2="18"></line>
                    </svg>
                    <span>DANH MỤC SẢN PHẨM</span>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"></path></svg>
                </a>
                <div class="category-dropdown-panel">
                    <a href="index.php?controller=product&action=category&loai=1" class="cat-drop-item">
                        <span class="cat-drop-icon">📚</span>
                        <div>
                            <strong>Sách Văn Học &amp; Tiểu Thuyết</strong>
                            <small>Văn học Việt Nam, tác phẩm dịch kinh điển</small>
                        </div>
                    </a>
                    <a href="index.php?controller=product&action=category&loai=1" class="cat-drop-item">
                        <span class="cat-drop-icon">💡</span>
                        <div>
                            <strong>Sách Kinh Tế &amp; Kỹ Năng Sống</strong>
                            <small>Quản trị, tài chính, khởi nghiệp, tâm lý học</small>
                        </div>
                    </a>
                    <a href="index.php?controller=product&action=category&loai=1" class="cat-drop-item">
                        <span class="cat-drop-icon">📖</span>
                        <div>
                            <strong>Manga, Comic &amp; Thiếu Nhi</strong>
                            <small>Truyện tranh Nhật Bản, sách tranh minh họa</small>
                        </div>
                    </a>
                    <a href="index.php?controller=product&action=category&loai=2" class="cat-drop-item">
                        <span class="cat-drop-icon">🎒</span>
                        <div>
                            <strong>Dụng Cụ Học Tập &amp; Bút Viết</strong>
                            <small>Bút gel, bút ký, gôm tẩy, thước kẻ chính hãng</small>
                        </div>
                    </a>
                    <a href="index.php?controller=product&action=category&loai=2" class="cat-drop-item">
                        <span class="cat-drop-icon">📓</span>
                        <div>
                            <strong>Sổ Tay &amp; Giấy Vở Học Sinh</strong>
                            <small>Sổ bìa da, sổ còng, vở kẻ ngang chống thấm</small>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Main Nav Pills -->
            <div class="nav-links">
                <a class="nav-pill <?= ($currentController === 'home') ? 'active' : '' ?>" href="index.php">
                    Trang chủ
                </a>
                <a class="nav-pill <?= ($currentController === 'product' && $currentAction === 'list' && empty($currentLoai)) ? 'active' : '' ?>" href="index.php?controller=product&action=list">
                    Tất cả sản phẩm
                </a>
                <a class="nav-pill <?= ($currentController === 'product' && $currentLoai == '1') ? 'active' : '' ?>" href="index.php?controller=product&action=category&loai=1">
                    Sách quốc văn
                </a>
                <a class="nav-pill <?= ($currentController === 'product' && $currentLoai == '2') ? 'active' : '' ?>" href="index.php?controller=product&action=category&loai=2">
                    Văn phòng phẩm
                </a>
                <a class="nav-pill highlight-pill" href="index.php#flashSaleSection">
                    ⚡ Flash Sale
                </a>
                <a class="nav-pill" href="index.php?controller=product&action=search&keyword=bút">
                    Bút viết cao cấp
                </a>
                <a class="nav-pill" href="index.php?controller=product&action=search&keyword=vở">
                    Vở học sinh
                </a>
            </div>
        </div>
    </div>
</header>

<main class="container">
