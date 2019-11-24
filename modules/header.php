<?php
    require 'core/DataProvider.php';
?>
<div class="py-1 bg-primary">
    <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
            <div class="col-lg-12 d-block">
                <div class="row d-flex">
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                        <span class="text">+ 1235 2355 98</span>
                    </div>
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                        <span class="text">PizzaHot@email.com</span>
                    </div>
                    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                        <span class="text">3-5 Ngày làm việc có giao hàng &amp; trả hàng miễn phí</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php">PIZZA HÓt</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Danh mục
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="index.php" class="nav-link">Trang chủ</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mua sắm</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="shop.php">Mua sắm</a>            
                        <a class="dropdown-item" href="product-single.php">Sản phẩm đơn</a>
                        <a class="dropdown-item" href="cart.php">Giỏ hàng</a>
                        <a class="dropdown-item" href="checkout.php">Thanh toán</a>
                    </div>
                </li>
                <li class="nav-item"><a href="about.php" class="nav-link">Thông tin</a></li>
                <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Liên hệ</a></li>
                <li class="nav-item cta cta-colored"><a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>
                <li class="nav-item"><a href="admin/congcu/login.html" class="nav-link">Đăng nhập</a></li>
                <li class="nav-item"><a href="admin/congcu/register.html" class="nav-link">Đăng kí</a></li>

            </ul>
        </div>
    </div>
</nav>