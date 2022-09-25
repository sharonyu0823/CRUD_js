<?php
require __DIR__ . '/parts/connect_db.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST, //除錯用
];

// TODO: 檢查欄位資料

if (empty($_POST['mbrSurname']) or empty($_POST['mbrForename']) or empty($_POST['mbrAccount']) or empty($_POST['mbrPassword1']) or empty($_POST['mbrPassword2']) or empty($_POST['mbrCheck'])) {
    $output['error'] = '參數不足';
    $output['postData'] = '';

    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit; //結束程式
}

// 註冊帳號和資料庫比對 不能重複
$sql1 = "SELECT * FROM member WHERE member_email = ?";
$stmt1 = $pdo->prepare($sql1);
$stmt1->execute([$_POST['mbrAccount']]);
$row = $stmt1->fetch();

if (!empty($row)) {
    $output['error'] = '帳號重覆';
    $output['code'] = 401;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit; //結束程式
}

$sql = "INSERT INTO `member`(
    `member_surname`,
    `member_forename`,
    `member_nickname`,
    `member_email`,
    `member_password`,
    `member_agreement`,
    `created_at`,
    `last_login_at`,
    `member_status`
    ) VALUES (
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    NOW(),
    NOW(),
    ?
)";

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        $_POST['mbrSurname'],
        $_POST['mbrForename'],
        $_POST['mbrNickname'],
        $_POST['mbrAccount'],
        password_hash($_POST['mbrPassword1'], PASSWORD_DEFAULT),
        $_POST['mbrCheck'],
        '1',
    ]);
} catch (PDOException $ex) {
    $output['error'] = $ex->getMessage();
}



if ($stmt->rowCount()) {
    $output['success'] = true;
} else {
    if (empty($output['error']))
        $output['error'] = '資料沒有新增';
}



echo json_encode($output, JSON_UNESCAPED_UNICODE);
