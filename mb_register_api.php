<?php require __DIR__ . '/parts/connect_db.php';

header('Content-Type: application/json');

// $users = [
//     'sharon@gg.com' => [
//         'pw' => '1234',
//         'nickname' => '鹹魚',
//     ],
//     // 帳號當成key
// ];

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST, //除錯用
];

$postData = [
    'member_status' => 1,
];

// 登入帳號密碼的驗證
// 是不是只能寫required


// if(!empty($_POST['mbrForename']) and !empty($_POST['mbrSurname'])){
//     echo 1;
// }else{
//     echo 2;
// }

// if (!empty($_POST['mbrSurname']) and !empty($_POST['mbrForename']) and !empty($_POST['mbrNickname']) and !empty($_POST['mbrAccount']) and !empty($_POST['mbrPassword']) and !empty($_POST['mbrCheck'])) {
//     $output['error'] = '參數不足';
//     $output['postData'] = '';

//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit; //結束程式
// }


if (empty($_POST['mbrSurname']) or empty($_POST['mbrForename']) or empty($_POST['mbrNickname']) or empty($_POST['mbrAccount']) or empty($_POST['mbrPassword']) or empty($_POST['mbrCheck'])) {
    $output['error'] = '參數不足';
    $output['postData'] = '';

    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit; //結束程式
}

// email不能重複
// 登入帳號的驗證 去users查看有沒有這組帳號 如果不存在 就回傳錯誤

if (empty($_POST['mbrAccount'])) {
    $output['error'] = '帳號或密碼錯誤';
    $output['code'] = 401;
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

$stmt->execute([
    $_POST['mbrSurname'],
    $_POST['mbrForename'],
    $_POST['mbrNickname'],
    $_POST['mbrAccount'],
    $_POST['mbrPassword1'],
    $_POST['mbrCheck'],
    $postData['member_status'],
]);

if($stmt->rowCount()){
    $output['success'] = true;
} else {
    if(empty($output['error']))
        $output['error'] = '資料沒有新增';

}



echo json_encode($output, JSON_UNESCAPED_UNICODE);
