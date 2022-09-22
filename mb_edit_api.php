<?php require __DIR__ . '/parts/connect_db.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST, //除錯用
];



// if (empty($_POST['mbeSurname']) or empty($_POST['mbeForename'])) {
//     $output['error'] = '參數不足';
//     $output['postData'] = '';

//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit; //結束程式
// }



// TODO: 檢查欄位資料

$sql = "UPDATE `member` SET
`member_surname`=?,
`member_forename`=?,
`member_nickname`=?,
`member_status`=?
WHERE member_sid = ?";

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        $_POST['mbeSurname'],
        $_POST['mbeForename'],
        $_POST['mbeNickname'],
        $_POST['enable_disable'],
        $_POST['sid'],
    ]);
} catch (PDOException $ex) {
    $output['error'] = $ex->getMessage();
}


if ($stmt->rowCount()) {
    $output['success'] = true;
} else {
    if (empty($output['error']))
        $output['error'] = '資料沒有修改';
}



echo json_encode($output, JSON_UNESCAPED_UNICODE);
