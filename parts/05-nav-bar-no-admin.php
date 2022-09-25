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
            <a class="navbar-brand" href="#">快速選單</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'base' ? 'active' : '' ?>" href="05-basepage-no-admin.php">首頁</a>
                    </li>
                    <li class="nav-item <?= $pageName == 'product' ? 'active' : '' ?>">
                        <a class="nav-link" href="#">商品</a>
                    </li>
                    <li class="nav-item <?= $pageName == 'event' ? 'active' : '' ?>">
                        <a class="nav-link" href="#">活動</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <?php if (empty($_SESSION['member'])) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?= $pageName == 'mb_register' ? 'active' : '' ?>" role="button" data-bs-toggle="dropdown">註冊</a>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                <li><a class="dropdown-item" href="05-mb_register.php">會員</a></li>
                                <li><a class="dropdown-item" href="#">商家</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?= $pageName == 'mb_login' ? 'active' : '' ?>" role="button" data-bs-toggle="dropdown">登入</a>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                <li><a class="dropdown-item" href="05-mb_login.php">會員</a></li>
                                <li><a class="dropdown-item" href="#">商家</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link"><?= empty($_SESSION['member']['nickname']) ? $_SESSION['member']['forename'] : $_SESSION['member']['nickname'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="cursor: pointer;" onclick="Logout();">登出</a>
                            <!-- <a class="nav-link" style="cursor: pointer;" href="05-mb_logout.php" onclick="return confirm('確定要登出嗎?')">登出</a> -->
                        </li>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
    </nav>
</div>

<!-- success modal -->
<div class="modal" id="myModalSuccess" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="modal_header_s">Modal Heading</h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="modal_body_s">
                Modal body..
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="modal_footer_s">關閉</button>
            </div>
        </div>
    </div>
</div>

<!-- confirm modal -->
<div class="modal" id="myModalConfirm" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="modal_header_c">Modal Heading</h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="modal_body_c">
                Modal body..
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="modal_footer_c1">確定</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="modal_footer_c2">取消</button>
            </div>
        </div>
    </div>
</div>

<script>
    function Logout() {
        const myModalLC = new bootstrap.Modal(document.getElementById('myModalConfirm'), {
            keyboard: false
        });

        const myModalLS = new bootstrap.Modal(document.getElementById('myModalSuccess'), {
            keyboard: false
        });

        myModalLC.show();
        document.querySelector('#modal_header_c').innerHTML = '登出';
        document.querySelector('#modal_body_c').innerHTML = '確定要登出嗎?';
        document.querySelector('#modal_footer_c1').addEventListener('click', () => {
            myModalLS.show();
            document.querySelector('#modal_header_s').innerHTML = '登出';
            document.querySelector('#modal_body_s').innerHTML = '登出成功';
            document.querySelector('#modal_footer_s').addEventListener('click', () => {
                location.href = "05-mb_logout.php";
            })
        })
    }
</script>