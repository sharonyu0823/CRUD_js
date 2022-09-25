<?php
require __DIR__ . '/parts/connect_db.php';

header('Content-Type: application/json');



$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
];

// 登入帳號密碼的驗證

if (empty($_POST['mblAccount']) or empty($_POST['mblPassword'])) {
    $output['error'] = '參數不足';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit; //結束程式
}

// 用信箱找資料
$sql1 = "SELECT * FROM member WHERE member_email = ?";
$stmt1 = $pdo->prepare($sql1);
$stmt1->execute([$_POST['mblAccount']]);
$row = $stmt1->fetch();


// 登入帳號的驗證 去users查看有沒有這組帳號 如果不存在 就回傳錯誤
if (empty($row)) {
    $output['error'] = '帳號或密碼錯誤';
    $output['code'] = 401;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit; //結束程式
}


//登入密碼的驗證
if (!password_verify($_POST['mblPassword'], $row['member_password'])) {
    $output['error'] = '帳號或密碼錯誤';
    $output['code'] = 401;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// 判斷狀態是啟用還是停用

if (($row['member_status']) === '0') {
    $output['error'] = '帳號停用';
    $output['code'] = 801;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
} else {
    $output['success'] = true;
    $_SESSION['member'] = [
        'sid' => $row['member_sid'],
        'account' => $row['member_email'],
        'nickname' => $row['member_nickname'],
        'forename' => $row['member_forename'],
    ];
}


// 每次登入 就更新登入時間

$sql2 = "UPDATE member SET
`last_login_at`=?
WHERE member_email = ?";

date_default_timezone_set('Asia/Taipei');

$stmt2 = $pdo->prepare($sql2);
$stmt2->execute([
    date("Y-m-d H:i:s"),
    $_POST['mblAccount'],
]);


echo json_encode($output, JSON_UNESCAPED_UNICODE);
