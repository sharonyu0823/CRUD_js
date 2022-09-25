<?php

session_start();  // 啟用 session

unset($_SESSION['member']);



header('Location: 05-basepage-no-admin.php');
