<?php
$listcategories = $products->getAllCategories();
$sizePage = 5;
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$listproducts = $products->getPage($page, $sizePage);
$countPage = $products->getCountPage($sizePage);
?>


<div class="input-group w-100 container" style="margin-top:50px">
    <input type="text" name="q" class="form-control" placeholder="Nhập từ khóa tìm kiếm...">
    <span class="input-group-append">
        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
    </span>
</div>
<!-- Danh sách sản phẩm -->
<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="text-primary display-4">Product List</h1>
        <p class="text-muted">Manage your products with ease.</p>
    </div>
    <table class="table table-striped table-hover table-bordered shadow-sm">
        <thead class="table-primary text-center">
            <tr>
                <th scope="col">Product ID</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
                <th scope="col">Quantity</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listproducts as $row) { ?>
                <tr class="align-middle">
                    <td class="text-center"><?= $row['product_id']; ?></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['category_id']); ?></td>
                    <td><?= htmlspecialchars($row['description']); ?></td>
                    <td class="text-end"><?= number_format($row['price'], 2) . " VNĐ"; ?></td>
                    <td class="text-center">
                        <?php if ($row['image_url']) { ?>
                            <img src="<?= htmlspecialchars($row['image_url']); ?>" alt="<?= htmlspecialchars($row['name']); ?>"
                                class="rounded" style="max-width: 100px; height: auto;">
                        <?php } else { ?>
                            <span class="text-muted">No Image</span>
                        <?php } ?>
                    </td>
                    <td class="text-center"><?= $row['quantity2']; ?></td>
                    <td class="text-center" style="width:150px">
                        <div class="btn-group">
                            <!-- Liệt kê sản phẩm -->
                            <a style="margin-right:20px" href="?mod=products&ac=delete&id=<?= $row['product_id']; ?>"
                                class="btn btn-danger btn-sm">
                                <i class="bi bi-trash-fill"></i> Xoá
                            </a>
                            <a class="btn btn-warning btn-sm" href="?mod=products&ac=update&id=<?= $row['product_id']; ?>">
                                <i class="bi bi-pencil-fill"></i> Sửa
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Nút thêm sản phẩm -->
    <div class="d-flex justify-content-end mb-4">
        <a href="?mod=products&ac=add" class="btn btn-primary shadow-lg px-5">
            <i class="bi bi-plus-circle"></i> Add New Product
        </a>
    </div>

    <!-- Phân trang -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $countPage; $i++) { ?>
                <li class="page-item <?= $i == $page ? 'active' : ''; ?>">
                    <a class="page-link" href="?mod=products&page=<?= $i; ?>"><?= $i; ?></a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>