<?php require __DIR__ . '/parts/connect_db.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST, //除錯用
];

// 登入帳號密碼的驗證
// 是不是只能寫required


if (empty($_POST['mbrSurname']) or empty($_POST['mbrForename']) or empty($_POST['mbrNickname']) or empty($_POST['mbrAccount']) or empty($_POST['mbrPassword1']) or empty($_POST['mbrPassword2']) or empty($_POST['mbrCheck'])) {
    $output['error'] = '參數不足';
    $output['postData'] = '';

    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit; //結束程式
}



// TODO: 檢查欄位資料

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
        $_POST['mbrPassword1'],
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
