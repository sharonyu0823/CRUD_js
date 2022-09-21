<?php require __DIR__ . '/parts/connect_db.php';

$perPage = 1; //一頁有幾筆
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

header('Content-Type: application/json');

echo json_encode($output);
exit;

