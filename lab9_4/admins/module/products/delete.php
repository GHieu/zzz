<?php
// Lấy ID sản phẩm từ URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    // Nếu không có ID, chuyển về trang danh sách
    header('Location: list.php');
    exit();
}

// Lấy thông tin sản phẩm từ database (giả sử bạn có phương thức để lấy sản phẩm theo ID)
$product = $products->getById($id);

if (!$product) {
    // Nếu không tìm thấy sản phẩm, chuyển về trang danh sách
    header('Location: list.php');
    exit();
}

// Kiểm tra nếu form đã được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nếu có POST thì gọi hàm xóa sản phẩm
    $products->Remove($id);
    // Quay về trang danh sách
    echo "<script>window.location.href = '?mod=products';</script>";
}
?>

<!-- Hiển thị thông tin sản phẩm cần xóa -->
<div class="container mt-4">
    <h3>Bạn có muốn xoá sản phẩm này?</h3>
    <div class="product-details">
        <p><strong>Tên sản phẩm:</strong> <?= htmlspecialchars($product['name']); ?></p>
        <p><strong><img style="width:10%" src="<?= htmlspecialchars($product['image_url']); ?>"></p>
        <p><strong>Mô tả:</strong> <?= htmlspecialchars($product['description']); ?></p>
        <p><strong>Giá:</strong> <?= number_format($product['price'], 2); ?>VNĐ</p>
        <p><strong>Số lượng:</strong> <?= $product['quantity2']; ?></p>
    </div>

    <!-- Form xác nhận xóa -->
    <form method=" POST" action="">
        <button type="submit" class="btn btn-danger"><?php $products->Remove($id) ?>Xoá</button>
        <a href="index.php?mod=products" class="btn btn-secondary">Cancel</a>
    </form>
</div>