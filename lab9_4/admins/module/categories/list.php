<?php
$sizePage = 5;
$page = isset($_GET["page"]) ? $_GET["page"] : 1;

// Lấy danh sách danh mục có phân trang và số lượng sản phẩm
$listcategories = $categories->getPage($page, $sizePage);

// Tổng số trang
$countPage = $categories->getCountPage($sizePage);
?>


<div class="input-group w-100 container" style="margin-top:50px">
    <input type="text" name="q" class="form-control" placeholder="Nhập từ khóa tìm kiếm...">
    <span class="input-group-append">
        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
    </span>
</div>

<!-- Danh sách danh mục -->
<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="text-primary display-4">Danh sách danh mục</h1>
    </div>
    <table class="table table-striped table-hover table-bordered shadow-sm">
        <thead class="table-primary text-center">
            <tr>
                <th scope="col">ID danh mục</th>
                <th scope="col">Tên danh mục</th>
                <th scope="col">Số lượng</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($listcategories)) { ?>
                <?php foreach ($listcategories as $row) { ?>
                    <tr class="align-middle">
                        <td class="text-center"><?= $row['category_id']; ?></td>
                        <td><?= htmlspecialchars($row['name']); ?></td>
                        <td class="text-center">Có <?= $row['quantity']; ?> sản phẩm</td>
                        <td class="text-center">
                            <a style="margin-right:20px" href="?mod=categories&ac=delete&id=<?= $row['category_id']; ?>"
                                class="btn btn-danger btn-sm m-1">
                                <i class="bi bi-trash-fill"></i> Xoá
                            </a>

                            <a href="?mod=categories&ac=update&id=<?= $row['category_id']; ?>"
                                class="btn btn-warning btn-sm m-1">
                                <i class="bi bi-pencil-fill"></i> Sửa
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="4" class="text-center text-danger">Chưa có danh mục nào!</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Nút thêm danh mục -->
    <div class="d-flex justify-content-end mb-4">
        <a href="?mod=categories&ac=add" class="btn btn-primary shadow-lg px-5">
            <i class="bi bi-plus-circle"></i> Thêm danh mục mới
        </a>
    </div>

    <!-- Phân trang -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $countPage; $i++) { ?>
                <li class="page-item <?= $i == $page ? 'active' : ''; ?>">
                    <a class="page-link" href="?mod=categories&page=<?= $i; ?>"><?= $i; ?></a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>