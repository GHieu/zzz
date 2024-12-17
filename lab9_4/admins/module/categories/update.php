<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_id = $_POST["category_id"];
    $name = $_POST["name"];


    $arr = [
        "category_id" => $category_id,
        "name" => $name,
    ];

    $categories->Update($arr);
    ?>
    <script>
        window.location.href = "?mod=categories";
    </script>
    <?php
} else {
    $category_id = isset($_GET["id"]) ? $_GET["id"] : 0; // Lấy product_id từ URL
    $categories = $categories->getById($category_id); // Lấy thông tin sản phẩm từ DB
    if (!$categories) {
        ?>
        <p style="color: red;">Sản phẩm không tồn tại</p>
        <?php
        exit;
    }
    ?>

    <div class="container my-5">
        <div class="text-center mb-4">
            <h1 class="text-primary display-4">Cập Nhật Danh Mục</h1>
            <p class="text-muted">Chỉnh sửa thông tin danh mục dưới đây.</p>
        </div>
        <form action="?mod=categories&ac=update" method="POST" enctype="multipart/form-data"
            class="shadow-lg p-5 rounded bg-light">

            <div class="mb-3">
                <label for="category_id" class="form-label">Mã Danh Mục:</label>
                <input type="text" id="category_id" class="form-control" value="<?php echo $categories['category_id']; ?>"
                    disabled>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Tên Danh Mục:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo $categories['name']; ?>"
                    required>
            </div>

            <button type="submit" name="submit" class="btn btn-warning w-100 py-2">
                <i class="bi bi-pencil-fill"></i> Cập Nhật Danh Mục
            </button>
        </form>
    </div>
    <?php
}
?>