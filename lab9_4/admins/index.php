<?php
include "../config/config.php";
include ROOT . "/include/function.php";
session_start();
spl_autoload_register("loadClass");
$db = new Db();
$mod = Utils::getIndex("mod");
if ($mod == "login") {
    $u = Utils::postIndex("username");
    $p = md5(Utils::postIndex("password"));
    $sql = "select username, email,name from admin where username=:u and password= :p ";
    $arr = array(":u" => $u, ":p" => $p);
    $data = $db->exeQuery($sql, $arr);
    if ($db->getRowCount() > 0) {
        $_SESSION["admin_login"] = 1;
        $_SESSION["admin_data"] = $data[0];
    }
}
if ($mod == "logout") {
    unset($_SESSION["admin_login"]);
    unset($_SESSION["admin_data"]);
}
if (!isset($_SESSION["admin_login"])) {
    include "login.html";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | General Form Elements</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="resources/css/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="resources/css/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="resources/css/main.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a href="index.php?mod=logout">
                        Đăng xuất
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../../index3.html" class="brand-link">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfGwTlXkFv5Tqk7xDQRQl5VEnf_2Tt-mZl6Q&s"
                    alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">DASHBOARD</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 mb-3 d-flex">
                    <div class="image">
                        <img src="https://nguoinoitieng.tv/images/nnt/100/0/beoj.jpg" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        Hello, <a href="#"
                            title="Edit your profile">[<?php echo $_SESSION["admin_data"]["name"]; ?>]</a><br />
                        <br />
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Quản lý sản phẩm
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php
                                $g = Utils::getIndex("group", "products");
                                $classProduct = $classCat = "";
                                if ($g == "categories")
                                    $classCat = " current";
                                if ($g == "products")
                                    $classProduct = " current";
                                ?>

                                <li class="nav-item">
                                    <a href="index.php?mod=categories" class="nav-link  <?php echo $classCat; ?>">
                                        <!--products&group=categories -->
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Loại danh mục giày</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?mod=products" class="nav-link <?php echo $classProduct; ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Giày</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">



            <!-- Main content -->
            <div class="content-box-content">

                <?php include "mod.php"; ?>
                <!-- <button class="btn-desgin w-100">
                    <a class="text-dark bg-primary" href="?mod=products&ac=add">Thêm</a>
                </button> -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="resources/css/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="resources/css/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="resources/css/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="resources/css/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="resources/css/dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>