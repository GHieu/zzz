<?php
// Gọi model Category
include_once "./classes/Db.class.php";

include_once "./classes/Category.class.php";
$categoryModel = new Category();
$listCategories = $categoryModel->getAllCategories(); // Lấy tất cả danh mục
?>

<header id="header" class="header header-fullwidth header-transparent-bg" style="background-color:#fff">
    <div class="container">
        <div class="header-desk header-desk_type_1">
            <div class="logo">
                <a href="index.php">
                    <img src="assets/images/logo.png" alt="Uomo" class="logo__image d-block" />
                </a>
            </div>

            <nav class="navigation">
                <ul class="navigation__list list-unstyled d-flex">
                    <?php foreach ($listCategories as $category): ?>
                    <li class="navigation__item">
                        <a href="index.php?category=<?= $category['category_id']; ?>" class="navigation__link">
                            <?= htmlspecialchars($category['name']); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <div class="header-tools d-flex align-items-center">
                <!-- Search -->
                <div class="header-tools__item hover-container">
                    <div class="js-hover__open position-relative">
                        <a class="js-search-popup search-field__actor" href="#">
                            <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_search" />
                            </svg>
                            <i class="btn-icon btn-close-lg"></i>
                        </a>
                    </div>

                    <div class="search-popup js-hidden-content">
                        <form action="index.php" method="GET" class="search-field container">
                            <p class="text-uppercase text-secondary fw-medium mb-4">What are you looking for?</p>
                            <div class="position-relative">
                                <input class="search-field__input search-popup__input w-100 fw-medium" type="text"
                                    name="key" placeholder="Search products" />
                                <button class="btn-icon search-popup__submit" type="submit">
                                    <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_search" />
                                    </svg>
                                </button>
                                <button class="btn-icon btn-close-lg search-popup__reset" type="reset"></button>
                            </div>

                            <div class="search-popup__results">


                                <div class="search-result row row-cols-5"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- CART -->
                <a href="#" class="header-tools__item header-tools__cart">
                    <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_cart" />
                    </svg>

                </a>
                <!-- LOGIN -->
                <div class="header-tools__item hover-container">
                    <?php if (isset($_SESSION['user_name'])): ?>
                    <!-- Người dùng đã đăng nhập -->
                    <div class="user-container">
                        <span class="user-name">Xin chào, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                        <a href="logout.php" class="logout-btn">Đăng xuất</a>
                    </div>
                    <?php else: ?>
                    <!-- Người dùng chưa đăng nhập -->
                    <a href="login.php" class="header-tools__item">
                        <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_user" />
                        </svg>
                        <span>Đăng nhập</span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>