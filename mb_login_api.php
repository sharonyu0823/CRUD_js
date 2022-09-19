<?php
session_start();

header('Content-Type: application/json');

$users = [
    'sharon@gg.com' => [
        'pw' => '1234',
        'nickname' => '鹹魚',
    ],
    // 帳號當成key
];

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
];

// 登入帳號密碼的驗證

if(empty($_POST['mblAccount']) or empty($_POST['mblPassword'])) {
    $output['error'] = '參數不足';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit; //結束程式
}

// 登入帳號的驗證 去users查看有沒有這組帳號 如果不存在 就回傳錯誤
if(empty($users[$_POST['mblAccount']])) {
    $output['error'] = '帳號或密碼錯誤';
    $output['code'] = 401;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit; //結束程式
}

// 到這邊代表帳號是對的
$user_SY = $users[$_POST['mblAccount']];

// 登入密碼的驗證
if($user_SY['pw'] === $_POST['mblPassword']){
    $output['success'] = true;
    $_SESSION['user1'] = [
        'account' => $_POST['mblAccount'],
        'nickname' => $user_SY['nickname'],
    ];
    
} else {
    $output['error'] = '帳號或密碼錯誤';
    $output['code'] = 401;
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);