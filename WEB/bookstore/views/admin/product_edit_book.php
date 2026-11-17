<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="form-box" style="max-width:760px;">
    <h2>Sửa sản phẩm sách</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=admin&action=updateProduct" enctype="multipart/form-data">
        <input type="hidden" name="MaSP" value="<?= (int)($product['MaSP'] ?? 0) ?>">
        <input type="hidden" name="LoaiSP" value="1">

        <div class="form-group">
            <label>Tên sách</label>
            <input class="form-control" type="text" name="TenSP" value="<?= htmlspecialchars($product['TenSP'] ?? '') ?>" required>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
                <label>ISBN</label>
                <input class="form-control" type="text" name="ISBN" value="<?= htmlspecialchars($product['ISBN'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label>Tác giả</label>
                <input class="form-control" type="text" name="TacGia" value="<?= htmlspecialchars($product['TacGia'] ?? '') ?>">
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
                <label>Nhà xuất bản</label>
                <input class="form-control" type="text" name="NXB" value="<?= htmlspecialchars($product['NXB'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Số trang</label>
                <input class="form-control" type="number" name="SoTrang" min="1" value="<?= (int)($product['SoTrang'] ?? 0) ?>">
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
                <label>Giá bán</label>
                <input class="form-control" type="number" name="GiaBan" min="1" value="<?= (int)($product['GiaBan'] ?? 0) ?>" required>
            </div>

            <div class="form-group">
                <label>Tồn kho</label>
                <input class="form-control" type="number" name="TonKho" min="0" value="<?= (int)($product['TonKho'] ?? 0) ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label>Kích thước / Trọng lượng</label>
            <input class="form-control" type="text" name="KichThuocTL" value="<?= htmlspecialchars($product['KichThuocTL'] ?? '') ?>">
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