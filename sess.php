<?php
session_start();

header('Content-Type: application/json');

echo json_encode($_SESSION, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);