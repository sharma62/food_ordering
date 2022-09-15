<?php
session_start();
include('../database.inc.php');
include('../function.inc.php');
include('../constant.inc.php');
$curr_str = $_SERVER['REQUEST_URI'];
$curr_array = explode('/', $curr_str);
$curr_path = $curr_array[count($curr_array) - 1];

// $curr_path = $curr_array[5];


if (!isset($_SESSION['IS_LOGIN'])) {
    redirect('login.php');
}

if ($curr_path == '' || $curr_path == 'index.php') {
    $page_title = 'Dashboard';
} elseif ($curr_path == 'manage_category.php' || $curr_path == 'category.php') {
    $page_title = 'Category';
} elseif ($curr_path == 'manage_dish.php' || $curr_path == 'dish.php') {
    $page_title = 'Dish';
} elseif ($curr_path == 'manage_coupon .php' || $curr_path == 'coupon_code.php') {
    $page_title = 'Coupon';
} elseif ($curr_path == 'manage_delivery.php' || $curr_path == 'Delivery_boy.php') {
    $page_title = 'Delivery';
} elseif ($curr_path == 'user.php' || $curr_path == '') {
    $page_title = 'User';
} else {
    $page_title = 'Dashboard';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $page_title ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .hand_cursor {
            cursor: pointer;
            padding: 10px;
            border-radius: 10px;
        }

        .hand_cursor:hover {
            background-color: gray;

        }

        table tr:hover {
            background-color: lightgray;
            cursor: pointer;
        }

        .form-group label {
            text-transform: capitalize;
        }

        .d-inline-block {
            display: inline-block;
            width: 33%;
        }
 
    </style>
</head>

<body class="sidebar-light">
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between ">
                <ul class="navbar-nav mr-lg-2 d-none d-lg-flex">
                    <li class="nav-item nav-toggler-item">
                        <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
                            <span class="mdi mdi-menu"></span>
                        </button>
                    </li>

                </ul>
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo" href="index.php"><img src="assets/images/logo.png" alt="logo" /></a>
                    <a class="navbar-brand brand-logo-mini" href="index.php"><img src="assets/images/logo.png" alt="logo" /></a>
                </div>
                <ul class="navbar-nav navbar-nav-right">

                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <span class="nav-profile-name"><?php echo  $_SESSION['ADMIN_USER'] ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php">
                                <i class="mdi mdi-logout text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                    <li class="nav-item nav-toggler-item-right d-lg-none">
                        <button class="navbar-toggler align-self-center" type="button" data-toggle="offcanvas">
                            <span class="mdi mdi-menu"></span>
                        </button>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="mdi mdi-view-quilt menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="category.php">
                            <i class="mdi mdi-view-headline menu-icon"></i>
                            <span class="menu-title">Category</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user.php">
                            <i class="mdi mdi-view-quilt menu-icon"></i>
                            <span class="menu-title">User</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Delivery_boy.php">
                            <i class="mdi mdi-view-quilt menu-icon"></i>
                            <span class="menu-title">Delivery boy</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="coupon_code.php">
                            <i class="mdi mdi-view-quilt menu-icon"></i>
                            <span class="menu-title">Coupon Code</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dish.php">
                            <i class="mdi mdi-view-quilt menu-icon"></i>
                            <span class="menu-title">Dish </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="banner.php">
                            <i class="mdi mdi-view-quilt menu-icon"></i>
                            <span class="menu-title">Banner</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">