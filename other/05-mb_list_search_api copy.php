<?php
require __DIR__ . '/parts/connect_db.php';

// 資料回傳給server server回傳的response (定義output裡面的success)
$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST, //除錯用
];

$perPage = 8;
$page = 1; //be care
$s_page = isset($_GET['s_page']) ? intval($_GET['s_page']) : 1;

$s_sql = "SELECT COUNT(1) FROM `member` WHERE `member_surname` LIKE ?";
$stmt1 = $pdo->prepare($s_sql);
$stmt1->execute(["%{$_POST['keyword']}%"]);
$s_totalRows = $stmt1->fetch(PDO::FETCH_NUM)[0];
$s_totalPages = ceil($s_totalRows / $perPage);

$s_rows = [];


$sql = sprintf("SELECT * FROM member WHERE `member_surname` LIKE ? ORDER BY member_sid ASC LIMIT %s, %s", ($s_page - 1) * $perPage, $perPage);
$stmt = $pdo->prepare($sql);
$stmt->execute(["%{$_POST['keyword']}%"]);
$s_rows = $stmt->fetchAll();


$output = [
    's_totalRows' => $s_totalRows,
    's_totalPages' => $s_totalPages,
    's_page' => $s_page,
    's_rows' => $s_rows,
];

// echo json_encode($output);
// exit;


// echo ("%{$_POST['keyword']}%");

$output['success'] = true;
// 下一頁要去call api
// 設定她只能秀8筆


echo json_encode($output, JSON_UNESCAPED_UNICODE);
