<?php
// Lấy trang hiện tại từ tham số URL hoặc đặt mặc định là 1
$currentPage = getIndex("page", 1);
$key = getIndex("key", "");

$sizePage = 5; // Kích thước trang

// Khởi tạo đối tượng Product và lấy danh sách sản phẩm theo trang
$productModel = new Product();
if ($key != "") {
    // Nếu có từ khóa tìm kiếm
    $listproducts = $productModel->search($currentPage, $sizePage, $key);
    $totalPages = $productModel->getCountSearchPage($key, $sizePage); // Đếm tổng trang khi tìm kiếm
} else {
    // Hiển thị tất cả sản phẩm khi không có từ khóa
    $listproducts = $productModel->getPage($currentPage, $sizePage);
    $totalPages = $productModel->getCountPage($sizePage);
}




// Lấy thông tin trang hiện tại và kích thước mỗi trang
$currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$sizePage = 5;

// Lấy category ID từ tham số GET
$categoryId = getIndex('category', '');

// Kiểm tra và lấy danh sách sản phẩm theo danh mục nếu có category ID
if ($categoryId) {
    $listproducts = $productModel->getProductsByCategory($categoryId, $currentPage, $sizePage);
    $totalPages = $productModel->getCountPageByCategory($categoryId, $sizePage);
}
?>
<main>

    <section class="swiper-container js-swiper-slider swiper-number-pagination slideshow" data-settings='{
    "autoplay": {
      "delay": 5000
    },
    "slidesPerView": 1,
    "effect": "fade",
    "loop": true
  }'>
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="overflow-hidden position-relative h-100 w-100"
                    style="margin-top:100px;text-align:center;background-color:#000">
                    <div class="slideshow-character bottom-0">
                        <img loading="lazy" src="image/slider01z.jpeg"
                            class="slideshow-character__img animate animate_fade animate_btt animate_delay-9" />
                        <div class="character_markup type2">
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="overflow-hidden position-relative h-100 w-100"
                    style="margin-top:100px ;text-align:center;;background-color:#000">
                    <div class="slideshow-character bottom-0">
                        <img loading="lazy" src="image/slider02z.jpeg"
                            class="slideshow-character__img animate animate_fade animate_rtl animate_delay-10" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container mw-1620 border-radius-10" style="background-color:#000">
        <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

        <section class="products-grid container">
            <h2 class="section-title text-center mb-3 pb-xl-2 mb-xl-4" style="color:#fff">Tất cả sản phẩm</h2>
            <div class="row">
                <?php foreach ($listproducts as $product): ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="product-card">
                        <a href="details.php?id=<?= $product['product_id']; ?>">
                            <img loading="lazy" src="./admins/<?= htmlspecialchars($product['image_url']); ?>"
                                alt="<?= htmlspecialchars($product['name']); ?>" class="img-fluid" />
                        </a>
                        <div class="text-center mt-2">
                            <h5 style="color:#fff"><?= htmlspecialchars($product['name']); ?></h5>
                            <p style="color:#fff">
                                <?= number_format($product['price'], 0, ',', '.'); ?>đ
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Phân Trang -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center" style="color:#fff">
                    <?php if ($currentPage > 1): ?>
                    <li class="page-item">
                        <a style="color:#000;background-color:#fff;padding:10px"
                            href="?page=<?= $currentPage - 1; ?>">Trước</a>
                    </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($i == $currentPage) ? 'active' : ''; ?>">
                        <a style="color:#000;background-color:#fff;padding:10px" href="?page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages): ?>
                    <li class="page-item">
                        <a style="color:#000;background-color:#fff;padding:10px"
                            href="?page=<?= $currentPage + 1; ?> ">Sau</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </section>
    </div>
</main>