<?php
include __DIR__ . '/parts/connect_db.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST, //除錯用
];

$sid = $_POST['sid'];

$sql = "DELETE FROM `member` WHERE member_sid = {$sid}";
$stmt = $pdo->query($sql);


if ($stmt->rowCount()) {
    $output['success'] = true;
    $output['sid'] = $sid;
}

// 會把前面的output都清掉 所以要小心!!!!
// $output = [
//     'sid' => $sid
// ];

echo json_encode($output, JSON_UNESCAPED_UNICODE);
