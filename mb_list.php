<?php require __DIR__ . '/parts/connect_db.php';

$perPage = 5; //一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
// page參數名稱自己決定 如果有設定就轉換成整數 沒有的話就第一頁

// 總筆數
$t_sql = "SELECT COUNT(1) FROM member"; // 表單資料放到sql裡

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; //資料庫連線 拿到資料 [0]可以拿到數字 而不是陣列

$totalPages = ceil($totalRows / $perPage);

$rows = []; //讓他從頭到尾都是陣列
// 如果有資料
if ($totalRows) {

    if ($page < 1) {
        header('Location: ?page=1');
        exit;
    }
    if ($page > $totalPages) {
        header('Location: ?page=' . $totalPages);
        exit;
    }


    // 設定分頁
    $sql = sprintf("SELECT * FROM member ORDER BY member_sid ASC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);

    $rows = $pdo->query($sql)->fetchAll();
};

$output = [
    '$totalRows' => $totalRows,
    '$totalPages' => $totalPages,
    '$page' => $page,
    '$rows' => $rows,
];

// echo json_encode($output);
// exit;

?>

<?php include __DIR__ . '/parts/html-head.php'; ?>
<style>
    .trash {
        color: red;
    }

    .page-link {
        color: #354179;
    }
</style>
<?php include __DIR__ . '/parts/nav-bar_SY.php'; ?>

<div class="container">

    <div class="rol">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            <i class="fa-solid fa-circle-chevron-left"></i>
                        </a>
                    </li>

                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor ?>

                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">
                            <i class="fa-solid fa-circle-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>



    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">
                            <i class="fa-solid fa-trash-can"></i>
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">姓氏</th>
                        <th scope="col">名字</th>
                        <th scope="col">暱稱</th>
                        <th scope="col">註冊信箱</th>
                        <th scope="col">註冊日期</th>
                        <th scope="col">最後登入日期</th>
                        <th scope="col">狀態</th>
                        <th scope="col">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td>
                                <a href="javascript: delete_it(<?= $r['member_sid'] ?>)">
                                    <i class="fa-solid fa-trash-can trash"></i>
                                </a>
                            </td>
                            <td><?= $r['member_sid'] ?></td>
                            <td><?= $r['member_surname'] ?></td>
                            <td><?= $r['member_forename'] ?></td>
                            <td><?= $r['member_nickname'] ?></td>
                            <td><?= $r['member_email'] ?></td>
                            <td><?= $r['created_at'] ?></td>
                            <td><?= $r['last_login_at'] ?></td>
                            <td><?= $r['member_status'] == 1 ? '啟用' : '停用' ?></td>
                            <?php /*<input class="form-check-input" type="radio" name="enabled_<?= $r['member_sid'] ?>" id="flexRadioDefault1" <?= $r['member_status'] == 1 ? 'checked' : '' ?>>
                                <label class="form-check-label" for="enabled_<?= $r['member_sid'] ?>">
                                    啟用
                                </label>
                                <input class="form-check-input" type="radio" name="enabled_<?= $r['member_sid'] ?>" id="flexRadioDefault2" <?= $r['member_status'] == 0 ? 'checked' : '' ?>>
                                <label class="form-check-label" for="enabled_<?= $r['member_sid'] ?>">
                                    停用
                                </label>
                                */ ?>
                            <!-- radio同一組name只能選一個 -->

                            <? //= $r['member_status'] 
                            ?>
                            <? //= $r['member_status'] == 1 ? 'checked' : '' 
                            ?>
                            <td>
                                <a href="0914 edit-form.php?sid=<?= $r['member_sid'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/scripts.php'; ?>

<?php include __DIR__ . '/parts/html-foot.php'; ?>