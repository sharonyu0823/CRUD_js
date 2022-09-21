<?php
include __DIR__ . '/parts/connect_db.php';
$pageName = 'base';
?>
<?php
include __DIR__ . '/parts/html-head.php'; ?>
<?php
include __DIR__ . '/parts/nav-bar_SY.php'; ?>
<div class="container">
    <div class="row mb-3">
        <h5>\ 惜食戰士GOGO！ /</h5>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">商品</h5>
                    <a href="#" class="btn btn-primary">新增商品</a>
                    <a href="#" class="btn btn-primary">商品列表</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">活動</h5>
                    <a href="#" class="btn btn-primary">新增活動</a>
                    <a href="#" class="btn btn-primary">活動列表</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">論壇</h5>
                    <a href="#" class="btn btn-primary">新增文章</a>
                    <a href="#" class="btn btn-primary">文章列表</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">商家會員</h5>
                    <a href="#" class="btn btn-primary">會員列表</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">一般會員</h5>
                    <a href="#" class="btn btn-primary">會員列表</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">訂單</h5>
                    <a href="#" class="btn btn-primary">訂單列表</a>
                    <a href="#" class="btn btn-primary">訂單明細</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/parts/scripts.php'; ?>
<?php
include __DIR__ . '/parts/html-foot.php'; ?>