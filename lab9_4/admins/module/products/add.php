<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $category_id = $_POST["category_id"]; // Lấy giá trị category_id từ <select>
    $description = $_POST["description"];
    $price = $_POST["price"];
    $quantity2 = $_POST["quantity2"];

    // Xử lý file hình ảnh
    $image_url = "";
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
                $image_url = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    }

    $arr = array(
        "name" => $name,
        "category_id" => $category_id,
        "description" => $description,
        "price" => $price,
        "image_url" => $image_url,
        "quantity2" => $quantity2
    );

    $products->add($arr);

    echo '<script>window.location.href = "?mod=products";</script>';
} else {
    // Lấy danh mục từ cơ sở dữ liệu
    $listcategories = $products->getAllCategories();
    ?>
    <div class="container my-5">
        <div class="text-center mb-4">
            <h1 class="text-primary display-4">Thêm Sản Phẩm</h1>
            <p class="text-muted">Hãy nhập đầy đủ thông tin sản phẩm cần thêm.</p>
        </div>
        <form action="?mod=products&ac=add" method="POST" enctype="multipart/form-data"
            class="shadow-lg p-5 rounded bg-light">
            <div class="mb-3">
                <label for="name" class="form-label">Tên Sản Phẩm:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Danh Mục Sản Phẩm:</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="" disabled selected>-- Chọn một danh mục --</option>
                    <?php foreach ($listcategories as $category) { ?>
                        <option value="<?= $category['category_id']; ?>">
                            <?= htmlspecialchars($category['name']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô Tả:</label>
                <textarea id="description" name="description" class="form-control" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Giá:</label>
                <input type="number" step="0.01" id="price" name="price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="image_url" class="form-label">Hình Ảnh Sản Phẩm:</label>
                <input type="file" id="image_url" name="image_url" class="form-control">
            </div>

            <div class="mb-3">
                <label for="quantity2" class="form-label">Số Lượng:</label>
                <input type="number" id="quantity2" name="quantity2" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary w-100 py-2">
                <i class="bi bi-plus-circle"></i> Thêm Sản Phẩm
            </button>
        </form>
    </div>
    <?php
}
?>