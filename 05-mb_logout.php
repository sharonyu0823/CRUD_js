<?php

session_start();  // 啟用 session

unset($_SESSION['member']);



header('Location: basepage-no-admin.php');
