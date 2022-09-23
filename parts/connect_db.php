<?php

$db_host = '192.168.35.163';
$db_name = 'no_waste';
$db_user = 'root';
$db_pass = '0305';

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8";

$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);

if (!isset($_SESSION)) {
    session_start();
} //讓所有的程式碼都去啟動SESSION

$pageName = '';
