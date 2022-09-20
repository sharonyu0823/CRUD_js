<?php

require __DIR__ . '/parts/connect_db.php';

$postData = [
    'member_surname' => "陳lal's",
    'member_forename' => '美華',
    'member_nickname' => '美美',
    'member_email' => '5469@gmail.com',
    'member_password' => 'dhfjfd',
    'member_agreement' => 1,
    'member_status' => 0,
];

$sql = "INSERT INTO `member`(
    `member_surname`, `member_forename`, `member_nickname`,
    `member_email`, `member_password`, `member_agreement`,
    `created_at`, `last_login_at`, `member_status`) VALUES (
    ?, ?, ?,
    ?, ?, ?,
    NOW(), NOW(), ?
)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $postData['member_surname'],
    $postData['member_forename'],
    $postData['member_nickname'],
    $postData['member_email'],
    $postData['member_password'],
    $postData['member_agreement'],
    $postData['member_status'],
]);

echo $stmt->rowCount(); //新增了幾筆
