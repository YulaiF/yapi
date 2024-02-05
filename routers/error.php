<?php
header('Content-Type: application/json; charset=utf-8');
$json = new stdClass();
$errorCode = $_REQUEST['code'];
$message = "";
switch ($errorCode) {
    case "403":
        $message = "Запрос запрещен настройками приложения";
        break;
    case "500":
        $message = "Непредвиденная ошибка выполнения";
        break;
}
$json->state = false;
$json->data = [];
$json->error = [
    "message" => $message,
    'code' => $_SERVER
];

echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
die();