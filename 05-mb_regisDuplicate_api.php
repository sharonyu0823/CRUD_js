<?php
require __DIR__ . '/parts/connect_db.php';

// 註冊帳號和資料庫比對 不能重複
$sql1 = "SELECT * FROM member WHERE member_email = ?";
$stmt1 = $pdo->prepare($sql1);
$stmt1->execute([$_POST['mbrAccount']]);
$row = $stmt1->fetch();

if (!empty($row)) {
    $output['error'] = '帳號重覆';
    $output['code'] = 401;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
} else {
    $output['success'] = true;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
}
