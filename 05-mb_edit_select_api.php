<?php require __DIR__ . '/parts/connect_db.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST, //除錯用
];

$sql = "SELECT
`member_sid`,
`member_surname`,
`member_forename`,
`member_nickname`,
`member_email`,
`member_status` 
FROM `member`
WHERE member_sid = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$_POST['sid']]);
$row = $stmt->fetch();

$output = [
    'row' => $row,
    'success' => true,
];

echo json_encode($output, JSON_UNESCAPED_UNICODE);
