<?php require __DIR__ . '/parts/connect_db.php';

$perPage = 5; //一頁有幾筆
$page = isset($_GET['page']) ? intval(isset($_GET['page'])) : 1;
// page參數名稱自己決定 如果有設定就轉換成整數 沒有的話就第一頁

// 總筆數
$t_sql = "SELECT COUNT(1) FROM member"; // 表單資料放到sql裡

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; //資料庫連線 拿到資料 [0]可以拿到數字 而不是陣列

$totalPages = ceil($totalRows / $perPage);

$rows = []; //讓他從頭到尾都是陣列
// 如果有資料
if ($totalRows) {

    if($page < 1) {
        header('Location: ?page=1');
        exit;
    }
    if($page > $totalPages) {
        header('Location: ?page='. $totalPages);
        exit;
    }


    // 設定分頁
    $sql = sprintf("SELECT * FROM member ORDER BY member_sid ASC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);

    $rows = $pdo->query($sql)->fetchAll();
};

echo json_encode([
    '$totalRows' => $totalRows,
    '$totalPages' => $totalPages,
    '$page' => $page,
    '$rows' => $rows,
]);
exit;

?>

<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/nav-bar_SY.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 fw-bolder">登入</h5>

                    <!-- 表單填寫 -->
                    <form name="mbLoginForm" onsubmit="checkForm(); return false;">
                        <div class="mb-3">
                            <label for="mblAccount" class="form-label">帳號</label>
                            <input type="email" class="form-control" name="mblAccount" id="mblAccount">
                        </div>
                        <div class="mb-4">
                            <label for="mblPassword" class="form-label">密碼</label>
                            <input type="password" class="form-control" name="mblPassword" id="mblPassword">
                        </div>
                        <button type="submit" class="btn btn-primary">登入</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include __DIR__ . '/parts/scripts.php'; ?>

<script>
    function checkForm() {
        const fd_l = new FormData(document.mbLoginForm);

        fetch('mb_login_api.php', {
                method: 'POST',
                body: fd_l,
            })
            .then(r => r.json())
            .then(obj_l => {
                console.log(obj_l);
                location.href = 'basepage.php';
            })

    }
</script>

<?php include __DIR__ . '/parts/html-foot.php'; ?>