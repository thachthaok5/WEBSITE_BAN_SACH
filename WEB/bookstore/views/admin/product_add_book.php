<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="form-box" style="max-width:760px;">
    <h2>Thêm sản phẩm sách</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=admin&action=addBook" enctype="multipart/form-data">
        <div class="form-group">
            <label>Tên sách</label>
            <input class="form-control" type="text" name="TenSP" required>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
                <label>ISBN</label>
                <input class="form-control" type="text" name="ISBN" required>
            </div>

            <div class="form-group">
                <label>Tác giả</label>
                <input class="form-control" type="text" name="TacGia">
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
                <label>Nhà xuất bản</label>
                <input class="form-control" type="text" name="NXB">
            </div>

            <div class="form-group">
                <label>Số trang</label>
                <input class="form-control" type="number" name="SoTrang" min="1">
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
                <label>Giá bán</label>
                <input class="form-control" type="number" name="GiaBan" min="1" required>
            </div>

            <div class="form-group">
                <label>Tồn kho</label>
                <input class="form-control" type="number" name="TonKho" min="0" required>
            </div>
        </div>

        <div class="form-group">
            <label>Kích thước / Trọng lượng</label>
            <input class="form-control" type="text" name="KichThuocTL">
        </div>

        <div class="form-group">
            <label>Mô tả</label>
            <textarea class="form-control" name="MoTa" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label>Hình ảnh</label>
            <input class="form-control" type="file" name="HinhAnh">
        </div>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <button class="btn btn-primary" type="submit">Lưu sách</button>
            <a class="btn btn-secondary" href="index.php?controller=admin&action=productList">Quay lại</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>