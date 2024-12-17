<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $name = $_POST["name"];
    $category_id = $_POST["category_id"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $quantity2 = $_POST["quantity2"];

    // Xử lý file hình ảnh nếu có thay đổi
    $image_url = $_POST["current_image"]; // Lấy hình ảnh cũ
    if (isset($_FILES["image_url"]) && $_FILES["image_url"]["error"] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($_FILES["image_url"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ["jpg", "jpeg", "png", "gif"];

        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $target_file)) {
                $image_url = $target_file; // Cập nhật hình ảnh mới nếu upload thành công
            }
        }
    }

    $arr = [
        "product_id" => $product_id,
        "name" => $name,
        "category_id" => $category_id,
        "description" => $description,
        "price" => $price,
        "image_url" => $image_url,
        "quantity2" => $quantity2
    ];

    $products->Update($arr);
    ?>
<script>
window.location.href = "?mod=products";
</script>
<?php
} else {
    $product_id = isset($_GET["id"]) ? $_GET["id"] : 0; // Lấy product_id từ URL
    $product = $products->getById($product_id); // Lấy thông tin sản phẩm từ DB
    if (!$product) {
        ?>
<p style="color: red;">Sản phẩm không tồn tại</p>
<?php
        exit;
    }

    // Lấy danh sách các danh mục
    $categories = $products->getAllCategories();
    ?>

<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="text-primary display-4">Cập Nhật Sản Phẩm</h1>
        <p class="text-muted">Chỉnh sửa thông tin sản phẩm dưới đây.</p>
    </div>
    <form action="?mod=products&ac=update" method="POST" enctype="multipart/form-data"
        class="shadow-lg p-5 rounded bg-light">
        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
        <input type="hidden" name="current_image" value="<?php echo $product['image_url']; ?>">

        <div class="mb-3">
            <label for="product_id" class="form-label">Mã Sản Phẩm:</label>
            <input type="text" id="product_id" class="form-control" value="<?php echo $product['product_id']; ?>"
                disabled>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Tên Sản Phẩm:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo $product['name']; ?>"
                required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Danh Mục Sản Phẩm:</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="" disabled>-- Chọn một danh mục --</option>
                <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['category_id']; ?>"
                    <?php echo $category['category_id'] == $product['category_id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category['name']); ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả:</label>
            <textarea id="description" name="description" class="form-control"
                rows="4"><?php echo $product['description']; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Giá:</label>
            <input type="number" step="0.01" id="price" name="price" class="form-control"
                value="<?php echo $product['price']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="image_url" class="form-label">Hình Ảnh Sản Phẩm:</label>
            <div class="mb-2">
                <img id="preview-image" src="<?php echo $product['image_url']; ?>" alt="Hình ảnh" class="img-thumbnail"
                    style="max-width: 150px;">
            </div>
            <input type="file" id="image_url" name="image_url" class="form-control">
        </div>

        <div class="mb-3">
            <label for="quantity2" class="form-label">Số Lượng:</label>
            <input type="number" id="quantity2" name="quantity2" class="form-control"
                value="<?php echo $product['quantity2']; ?>" required>
        </div>

        <button type="submit" name="submit" class="btn btn-warning w-100 py-2">
            <i class="bi bi-pencil-fill"></i> Cập Nhật Sản Phẩm
        </button>
    </form>
</div>


<?php
}
?>