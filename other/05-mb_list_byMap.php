<?php require __DIR__ . '/parts/connect_db.php';

// 頁數
$pageName = 'mb_list';

$perPage = 8; //一頁有幾筆
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

$showpage = 6;
$cut = floor($showpage / 2);
$left = 1;
$right = $totalPages;

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
<?php include __DIR__ . '/parts/05-nav-bar-admin.php'; ?>

<div class="container">
    <div class="row d-flex justify-content-between align-items-end">
        <div class="col">
            <nav class="d-flex justify-content-between" aria-label="Page navigation example">
                <ul class="pagination" id="page_search">
                    <?php /*<li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page = 1 ?>">
                            <i class="fa-solid fa-angles-left"></i>
                        </a>
                    </li> */ ?>
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page == 1 ?>">
                            <i class="fa-solid fa-angles-left"></i>
                        </a>
                    </li>
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>
                    </li>

                    <?php
                    if ($totalPages > $showpage) { //若總頁數大於 每次要顯示幾筆分頁 才要執行以下片段
                        if ($page <= $cut) {
                            $left = $page - 1;
                        } else {
                            $left = $cut;
                        } //若所在頁面小於分割數
                        if ($page > $totalPages - $cut) {
                            $right = ($page == $totalPages ? 0 : 1);
                            $left += $left - $right;
                        } else {
                            $right = $cut + ($cut - $left);
                        } //若所在頁面小於 總分頁數-分割數
                        $left = $page - $left; //以目前頁次為中心點 往左要顯示多少頁面

                        $right = $page + $right; //以目前頁次為中心點 往右要顯示多少頁面
                    }


                    for ($i = $left; $i <= $right; $i++) :

                    ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>

                    <?php

                    endfor;

                    ?>

                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $totalPages ?>">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </li>

                </ul>
                <form name="searchForm" class="d-inline-flex" role="search" onsubmit="checkForm(); return false;">
                    <input class="form-control py-0 mb-3 me-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                    <button class="btn btn-outline-success mb-3" type="submit">Search</button>
                </form>
            </nav>
        </div>
    </div>

    <div class=" row">
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
                <tbody id="member_search">
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td>
                                <a href="05-mb_delete.php?sid=<?= $r['member_sid'] ?>" onclick="return confirm('確定要刪除編號<?= $r['member_sid'] ?>: <?= $r['member_surname'] ?><?= $r['member_forename'] ?>的資料嗎?')">
                                    <i class="fa-solid fa-trash-can trash"></i>
                                </a>
                            </td>
                            <td><?= $r['member_sid'] ?></td>
                            <td><?= $r['member_surname'] ?></td>
                            <td><?= $r['member_forename'] ?></td>
                            <td><?= htmlentities($r['member_nickname']) ?></td>
                            <td><?= $r['member_email'] ?></td>
                            <td><?= $r['created_at'] ?></td>
                            <td><?= $r['last_login_at'] ?></td>
                            <td><?= $r['member_status'] == 1 ? '啟用' : '停用' ?></td>

                            <!-- radio同一組name只能選一個 -->

                            <td>
                                <a href="05-mb_edit.php?sid=<?= $r['member_sid'] ?>">
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
<script>
    let page = <?= $page; ?>;
    // console.log(page);

    function checkForm() {
        const fd = new FormData(document.searchForm);

        fetch('05-mb_list_search_api.php', {
                method: 'POST',
                body: fd,
            })
            .then(r => r.json())
            .then(obj => {
                if (obj.success) {
                    console.log('sucess');
                    // console.log(obj);
                    // console.log(obj.rows);
                    let rows = obj.rows;
                    let datas = rows.map((value, index, array) => {
                        console.log(value);
                        // console.log(index);
                        // console.log(array);
                        // console.log(array[0]);
                        // console.log(array[0].member_sid);
                        // console.log(array[1]);
                        // console.log(array[2]);

                        let {
                            member_sid,
                            member_surname,
                            member_forename,
                            member_nickname,
                            member_email,
                            created_at,
                            last_login_at,
                            member_status
                        } = value;
                        return (
                            `<tr>
                            <td>
                                <a href="05-mb_delete.php?sid=${member_sid}" onclick="return confirm('確定要刪除編號${member_sid}: ${member_surname}${member_forename}的資料嗎?')">
                                    <i class="fa-solid fa-trash-can trash"></i>
                                </a>
                            </td>
                            <td id="member_sid">${member_sid}</td>
                            <td>${member_surname}</td>
                            <td>${member_forename}</td>
                            <td>${member_nickname}</td>
                            <td>${member_email}</td>
                            <td>${created_at}</td>
                            <td>${last_login_at}</td>
                            <td>${member_status === 1 ? '啟用' : '停用'}</td>
                            <td>
                                <a href="05-mb_edit.php?sid=${member_sid}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>`);
                    });

                    document.querySelector('#member_search').innerHTML = datas.join("");

                    let totalPages = obj.s_totalPages;
                    // console.log(totalPages);
                    // let page =
                    let pages = [];

                    pages.push(`<li class="page-item disabled">
                        <a class="page-link" href="?page=1">
                            <i class="fa-solid fa-angles-left"></i>
                        </a>
                        </li>
                        <li class="page-item disabled">
                        <a class="page-link" href="?page=0">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>
                    </li>`);

                    for (let i = 1; i <= totalPages; i++) {
                        if (i > 7) {
                            break;
                        }
                        console.log(i);
                        console.log(page);
                        pages.push(
                            `
                            <li class="page-item ${1 === i? 'active': ''}">
                        <a class="page-link" href="?page=${i}">${i}</a>
                    </li>`);
                    }

                    pages.push(
                        `
                    <li class="page-item ">
                        <a class="page-link" href="?page=2">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="page-item ">
                        <a class="page-link" href="?page=${totalPages}">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </li>
                    `);

                    document.querySelector('#page_search').innerHTML = pages.join("");

                    // `<li class="page-item active">
                    //     <a class="page-link" href="?page=">1</a>
                    // </li>`;

                } else {
                    console.log('false');
                }

            })
    }
</script>

<?php include __DIR__ . '/parts/html-foot.php'; ?>