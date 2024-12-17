<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];

    // Tạo mảng dữ liệu và lưu sản phẩm
    $arr = array(
        "name" => $name,
    );
    $categories->add($arr);

    // Redirect
    ?>
    <script>
        window.location.href = "?mod=categories";
    </script>
    <?php
} else {

    ?>
    <div class="container my-5">
        <div class="text-center mb-4">
            <h1 class="text-primary display-4">Thêm Danh Mục</h1>
            <p class="text-muted">Hãy nhập đầy đủ thông tin Danh Mục cần thêm.</p>
        </div>
        <form action="?mod=categories&ac=add" method="POST" enctype="multipart/form-data"
            class="shadow-lg p-5 rounded bg-light">
            <div class="mb-3">
                <label for="name" class="form-label">Tên Danh Mục:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary w-100 py-2">
                <i class="bi bi-plus-circle"></i> Thêm Danh Mục
            </button>
        </form>
    </div>
    <?php
}
?>