<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="form-box" style="max-width:760px;">
    <h2>Sửa văn phòng phẩm</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=admin&action=updateProduct" enctype="multipart/form-data">
        <input type="hidden" name="MaSP" value="<?= (int)($product['MaSP'] ?? 0) ?>">
        <input type="hidden" name="LoaiSP" value="2">

        <div class="form-group">
            <label>Tên sản phẩm</label>
            <input class="form-control" type="text" name="TenSP" value="<?= htmlspecialchars($product['TenSP'] ?? '') ?>" required>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
                <label>Thương hiệu</label>
                <input class="form-control" type="text" name="ThuongHieu" value="<?= htmlspecialchars($product['ThuongHieu'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label>Xuất xứ</label>
                <input class="form-control" type="text" name="XuatXu" value="<?= htmlspecialchars($product['XuatXu'] ?? '') ?>">
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
                <label>Màu sắc / Biến thể</label>
                <input class="form-control" type="text" name="MauSac" value="<?= htmlspecialchars($product['MauSac'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Giá bán</label>
                <input class="form-control" type="number" name="GiaBan" min="1" value="<?= (int)($product['GiaBan'] ?? 0) ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label>Tồn kho</label>
            <input class="form-control" type="number" name="TonKho" min="0" value="<?= (int)($product['TonKho'] ?? 0) ?>" required>
        </div>

        <div class="form-group">
            <label>Mô tả</label>
            <textarea class="form-control" name="MoTa" rows="4"><?= htmlspecialchars($product['MoTa'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label>Hình ảnh hiện tại</label><br>
            <?php if (!empty($product['HinhAnh'])): ?>
                <img src="public/uploads/products/<?= htmlspecialchars($product['HinhAnh']) ?>" alt="" style="max-width:120px; border-radius:8px;">
            <?php else: ?>
                Không có ảnh
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Đổi hình ảnh</label>
            <input class="form-control" type="file" name="HinhAnh">
        </div>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <button class="btn btn-primary" type="submit">Lưu thay đổi</button>
            <a class="btn btn-secondary" href="index.php?controller=admin&action=productList">Quay lại</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>