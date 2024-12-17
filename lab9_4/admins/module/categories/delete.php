<?php
// Lấy ID sản phẩm từ URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    // Nếu không có ID, chuyển về trang danh sách
    header('Location: list.php');
    exit();
}

// Lấy thông tin sản phẩm từ database (giả sử bạn có phương thức để lấy sản phẩm theo ID)
$category = $categories->getById($id);



// Kiểm tra nếu form đã được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nếu có POST thì gọi hàm xóa sản phẩm
    $categories->delete($id);
    // Quay về trang danh sách
    echo "<script>window.location.href = '?mod=categories';</script>";
}
?>

<!-- Hiển thị thông tin sản phẩm cần xóa -->
<div class="container mt-4">
    <h3>Bạn có muốn xoá danh mục này?</h3>
    <div class="product-details">
        <p><strong>Tên danh mục:</strong> <?= $category['name'] ?></p>
    </div>

    <!-- Form xác nhận xóa -->
    <form method=" POST" action="">
        <button type="submit" class="btn btn-danger"><?php $categories->delete($id) ?>Xoá</button>
        <a href="index.php?mod=categories" class="btn btn-secondary">Cancel</a>
    </form>
</div>