<?php /* require __DIR__ . '/parts/connect_db.php';

// 頁數
pageName = 'mb_list';

$perPage = 8; //一頁有幾筆
page = isset($_GET['page']) ? intval($_GET['page']) : 1;
// page參數名稱自己決定 如果有設定就轉換成整數 沒有的話就第一頁

// 總筆數
$t_sql = "SELECT COUNT(1) FROM member"; // 表單資料放到sql裡

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; //資料庫連線 拿到資料 [0]可以拿到數字 而不是陣列

totalPages = ceil($totalRows / $perPage);

$rows = []; //讓他從頭到尾都是陣列
// 如果有資料
if ($totalRows) {

    if (page < 1) {
        header('Location: ?page=1');
        exit;
    }
    if (page > totalPages) {
        header('Location: ?page=' . totalPages);
        exit;
    }

    // 設定分頁
    $sql = sprintf("SELECT * FROM member ORDER BY member_sid ASC LIMIT %s, %s", (page - 1) * $perPage, $perPage);

    $rows = $pdo->query($sql)->fetchAll();
};

showPage = 6;
cut = floor(showPage / 2);
left = 1;
totalPages = totalPages;

$output = [
    '$totalRows' => $totalRows,
    'totalPages' => totalPages,
    'page' => page,
    '$rows' => $rows,
];

// echo json_encode($output);
// exit;

*/ ?>

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
                    <?php /* <li class="page-item <?= page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" onclick="changePage(1)">
                            <i class="fa-solid fa-angles-left"></i>
                        </a>
                    </li>
                    <li class="page-item <?= page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" onclick="changePage(<?= page - 1 ?>)">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>
                    </li>

                    <?php
                    if (totalPages > showPage) { //若總頁數大於 每次要顯示幾筆分頁 才要執行以下片段
                        if (page <= cut) {
                            left = page - 1;
                        } else {
                            left = cut;
                        } //若所在頁面小於分割數
                        if (page > totalPages - cut) {
                            totalPages = (page == totalPages ? 0 : 1);
                            left += left - totalPages;
                        } else {
                            totalPages = cut + (cut - left);
                        } //若所在頁面小於 總分頁數-分割數
                        left = page - left; //以目前頁次為中心點 往左要顯示多少頁面

                        totalPages = page + totalPages; //以目前頁次為中心點 往右要顯示多少頁面
                    }


                    for ($i = left; $i <= totalPages; $i++) :

                    ?>
                        <li class="page-item <?= $i == page ? 'active' : '' ?>">
                            <a class="page-link" onclick="changePage(<?= $i ?>)"><?= $i ?></a>
                        </li>

                    <?php

                    endfor;

                    ?>

                    <li class="page-item <?= page == totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" onclick="changePage(<?= page + 1 ?>)">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="page-item <?= page == totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" onclick="changePage(<?= totalPages ?>)">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </li> */ ?>

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
                    <?php /*<?php foreach ($rows as $r) : ?>
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
                    <?php endforeach; ?> */ ?>
                </tbody>

            </table>

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

<?php include __DIR__ . '/parts/scripts.php'; ?>
<script>
    checkForm();

    async function checkForm() {
        const fd = new FormData(document.searchForm);
        fd.append('page1', 1); //加一個page預設1 是要讓搜尋完就直接在第一頁
        console.log(fd);

        await fetch('05-mb_list_search_api.php', {
                method: 'POST',
                body: fd,
            })
            .then(r => r.json())
            .then(obj => {
                if (obj.success) {
                    console.log('sucess');

                    let rows = obj.s_rows;

                    // === search bar ====
                    let datas = [];
                    for (let row of rows) {

                        let {
                            member_sid,
                            member_surname,
                            member_forename,
                            member_nickname,
                            member_email,
                            created_at,
                            last_login_at,
                            member_status
                        } = row;

                        // console.log(row.member_status);
                        // console.log(typeof row.member_status);

                        datas.push(
                            `<tr>
                            <td style="cursor: pointer;" onclick="confirm(event, ${member_sid});">
                                <i class="fa-solid fa-trash-can trash"></i>
                            </td>
                            <td>${member_sid}</td>
                            <td>${member_surname}</td>
                            <td>${member_forename}</td>
                            <td>${member_nickname}</td>
                            <td>${member_email}</td>
                            <td>${created_at}</td>
                            <td>${last_login_at}</td>
                            <td>${member_status === 1 + '' ? '啟用' : '停用'}</td>
                            <td>
                                <a href="05-mb_edit.php?sid=${member_sid}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>`);
                    }

                    document.querySelector('#member_search').innerHTML = datas.join("");

                    // === pagination調整 ====
                    let totalPages = obj.s_totalPages;
                    let page = +obj.page2;
                    let showPage = 7; //每次要顯示幾筆分頁 只能設為 單數 1 3 5 7 9 若設為 雙數一樣會加1 ex 設為 2 最終顯示還是3 可變動
                    let left = 1; //預設值
                    let cut = Math.floor(showPage / 2); //以目前所在頁次 為中心 往左右各顯示幾個頁次 以無條件捨去
                    let right = totalPages; //預設值

                    let pages = [];

                    pages.push(`<li class="page-item disabled">
                        <a class="page-link" onclick="changePage(1)">
                            <i class="fa-solid fa-angles-left"></i>
                        </a>
                        </li>
                        <li class="page-item disabled">
                        <a class="page-link" onclick="changePage(${page - 1})">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>
                    </li>`);

                    if (totalPages > showPage) { //若總頁數大於 每次要顯示幾筆分頁 才要執行以下片段
                        // debugger
                        //若所在頁面小於分割數
                        if (page <= cut) {
                            left = page - 1;
                        } else {
                            left = cut;
                        }
                        //若所在頁面大於 總分頁數-分割數
                        if (page > totalPages - cut) {
                            right = (page == totalPages ? 0 : 1);
                            left += left - right;
                        } else {
                            right = cut + (cut - left);
                        }
                        left = page - left; //以目前頁次為中心點 往左要顯示多少頁面

                        right = page + right; //以目前頁次為中心點 往右要顯示多少頁面
                    }

                    // console.log(obj.page2); // 1
                    // console.log(typeof obj.page2); //string
                    // console.log(page + 7); // 17
                    // console.log(obj.s_totalPages);
                    // console.log(totalPages);

                    for (let i = left; i <= right; i++) {

                        pages.push(
                            `
                            <li class="page-item ${+page === i? 'active': ''}">
                        <a class="page-link" onclick="changePage(${i})">${i}</a>
                    </li>`);

                        // console.log('page', typeof(page)); //string
                        // console.log('i', typeof(i)); //intval
                    }


                    pages.push(
                        `
                    <li class="page-item ${totalPages > 1 ? '': 'disabled'}">
                        <a class="page-link" onclick="changePage(${page + 1})">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="page-item ${totalPages > 1 ? '': 'disabled'}">
                        <a class="page-link" onclick="changePage(${totalPages})">
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

    // 為了要讓pagination會動 然後頁面也會同時跟著切換
    async function changePage(page) {
        const fd = new FormData(document.searchForm);
        fd.append('page1', page);

        await fetch('05-mb_list_search_api.php', {
                method: 'POST',
                body: fd,
            })
            .then(r => r.json())
            .then(obj => {
                if (obj.success) {

                    let rows = obj.s_rows;

                    // === search bar ====
                    let datas = [];
                    for (let row of rows) {

                        let {
                            member_sid,
                            member_surname,
                            member_forename,
                            member_nickname,
                            member_email,
                            created_at,
                            last_login_at,
                            member_status
                        } = row;
                        datas.push(
                            `<tr>
                            <td style="cursor: pointer;" onclick="confirm(event, ${member_sid});">
                               <i class="fa-solid fa-trash-can trash"></i>
                            </td>
                            <td>${member_sid}</td>
                            <td>${member_surname}</td>
                            <td>${member_forename}</td>
                            <td>${member_nickname}</td>
                            <td>${member_email}</td>
                            <td>${created_at}</td>
                            <td>${last_login_at}</td>
                            <td>${member_status === 1 + '' ? '啟用' : '停用'}</td>
                            <td>
                                <a href="05-mb_edit.php?sid=${member_sid}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>`);
                    }

                    document.querySelector('#member_search').innerHTML = datas.join("");

                    // === pagination調整 ====
                    // 保留changePage是為了如果一但有任何變化 或是不是經過這個function html可以彈性的判斷是否使用changePage這個function
                    let totalPages = obj.s_totalPages;
                    let page = +obj.page2;
                    let showPage = 6;
                    let left = 1;
                    let cut = Math.floor(showPage / 2);
                    let right = totalPages;

                    let pages = [];

                    pages.push(`<li class="page-item ${page === 1? 'disabled': ''}">
                        <a class="page-link" onclick="changePage(1)">
                            <i class="fa-solid fa-angles-left"></i>
                        </a>
                        </li>
                        <li class="page-item ${page === 1? 'disabled': ''}">
                        <a class="page-link" onclick="changePage(${page - 1})">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>
                    </li>`);

                    if (totalPages > showPage) { //若總頁數大於 每次要顯示幾筆分頁 才要執行以下片段
                        if (page <= cut) {
                            left = page - 1;
                        } else {
                            left = cut;
                        } //若所在頁面小於分割數
                        if (page > totalPages - cut) {
                            right = (page == totalPages ? 0 : 1);
                            left += left - right;
                        } else {
                            right = cut + (cut - left);
                        } //若所在頁面小於 總分頁數-分割數
                        left = page - left; //以目前頁次為中心點 往左要顯示多少頁面

                        right = page + right; //以目前頁次為中心點 往右要顯示多少頁面
                    }

                    for (let i = left; i <= right; i++) {

                        pages.push(
                            `
                            <li class="page-item ${page === i? 'active': ''}">
                        <a class="page-link" onclick="changePage(${i})">${i}</a>
                    </li>`);
                    }

                    pages.push(
                        `
                    <li class="page-item ${page === totalPages ? 'disabled': ''}">
                        <a class="page-link" onclick="changePage(${page + 1})">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="page-item ${page === totalPages ? 'disabled': ''}">
                        <a class="page-link" onclick="changePage(${totalPages})">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </li>
                    `);

                    document.querySelector('#page_search').innerHTML = pages.join("");


                } else {
                    console.log('false');
                }

            })
    }

    function confirm(e, sid) {
        const myModalLC = new bootstrap.Modal(document.getElementById('myModalConfirm'), {
            keyboard: false
        });

        // console.log(e);
        // console.log(e.target);
        // console.log(e.target.parentNode.nextElementSibling.firstChild.nodeValue);
        // const sid = e.target.parentNode.nextElementSibling.firstChild.nodeValue;

        e.preventDefault();

        myModalLC.show();

        document.querySelector('#modal_header_c').innerHTML = '刪除';
        document.querySelector('#modal_body_c').innerHTML = '確定要刪除嗎?';
        document.querySelector('#modal_footer_c1').addEventListener('click', () => {
            deleteUser(sid);
        });

        // deleteUser() 呼叫function 不管綁定的事件是甚麼 會先執行 並且將執行過後的return值傳進去
        // deleteUser 去找到這一個function 然後才去執行找到的function

        // 錯誤寫法
        // let b = deleteUser();
        // document.querySelector('#modal_footer_c1').addEventListener('click', deleteUser());
        // 舉例來說
        // let a = deleteUser();
        // hello(a); a是回傳返回值

    }

    function deleteUser(sid) {
        const fd = new FormData();
        fd.append('sid', sid);

        fetch('05-mb_list_delete_api.php', {
                method: 'POST',
                body: fd,
            })
            .then(r => r.json())
            .then(obj => {
                console.log(obj);
                if (obj.success) {
                    changePage(1); //呼叫function 返回return值
                }
            });
    }

    // reference: 分頁: https://www.webteach.tw/?p=4226
</script>

<?php include __DIR__ . '/parts/html-foot.php'; ?>