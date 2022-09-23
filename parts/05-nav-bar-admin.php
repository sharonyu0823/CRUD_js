<?php
if (!isset($_SESSION)) {
    session_start();
}

?>
<style>
    nav.navbar .nav-item .nav-link.active {
        background-color: coral;
        color: white;
        font-weight: bold;
        border-radius: 10px;
    }
</style>
<div class="container mb-3">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">管理選單</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'base' ? 'active' : '' ?>" href="basepage-admin.php">首頁</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link <?= $pageName == 'mb_list' ? 'active' : '' ?>" href="05-mb_list.php">一般會員</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">商家會員</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">商品</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">活動</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">論壇</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <?php if (empty($_SESSION['admin'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login-form-admin.php">登入</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link"><?= $_SESSION['admin']['account'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout-admin.php">登出</a>
                        </li>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
    </nav>
</div>