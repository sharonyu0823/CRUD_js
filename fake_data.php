<?php

require __DIR__ . '/parts/connect_db.php';

$lasts = ["何", "傅", "劉", "吳", "呂", "周", "唐", "孫", "宋", "張", "彭", "徐", "於", "曹", "曾", "朱", "李", "林", "梁", "楊", "沈", "王", "程", "羅", "胡", "董", "蕭", "袁", "許", "謝", "趙", "郭", "鄧", "鄭", "陳", "韓", "馬", "馮", "高", "黃"];
$firsts = ["冠廷", "冠宇", "宗翰", "家豪", "彥廷", "承翰", "柏翰", "宇軒", "家瑋", "冠霖", "雅婷", "雅筑", "怡君", "佳穎", "怡萱", "宜庭", "郁婷", "怡婷", "詩涵", "鈺婷"];
$nickname = ["", "哈哈", "吃吃", "著著", "亭", "終於", "柏科", "宇宇", "亭亭", "冠冠", "雅雅", "茿筑", "君君", "佳佳", "怡怡", "豬豬", "小小"];


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

for ($i = 0; $i < 30; $i++) {
    shuffle($lasts);
    shuffle($firsts);
    shuffle($nickname);
    $member_surname = $lasts[0];
    $member_forename = $firsts[0];
    $member_nickname = $nickname[0];
    $member_email = 'mail' . rand(10000, 99999) . '@test.com';
    $member_password = rand(10000, 99999);
    $member_agreement = 1;
    $member_status = rand(0, 1);

    $stmt->execute([
        $member_surname,
        $member_forename,
        $member_nickname,
        $member_email,
        $member_password,
        $member_agreement,
        $member_status,
    ]);
}


echo $stmt->rowCount(); //新增了幾筆
