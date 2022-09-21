<?php
include __DIR__ . '/parts/connect_db.php';
$pageName = 'baseAdmin';
?>
<?php
include __DIR__ . '/parts/html-head.php'; ?>
<?php
include __DIR__ . '/parts/nav-bar-admin.php';
?>
<div class="container">
    <?php if (!empty($_SESSION['admin'])) : ?>
        <div class="row">
            <h5 class="h-100 text-center mb-3">\ 歡迎回家，惜食守衛隊！/</h5>
        </div>
    <?php else : ?>
        <div class="row">
        </div>
    <?php endif ?>
</div>

<?php
include __DIR__ . '/parts/scripts.php'; ?>
<?php
include __DIR__ . '/parts/html-foot.php'; ?>