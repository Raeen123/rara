<?php
require_once "core.php";
$content = json_decode(file_get_contents('php://input'), true);
$chat_id = $content["message"]['chat']['id'];
$username = $content["message"]["chat"]["username"];
$first_name = $content["message"]["chat"]["first_name"];
$text = $content['message']['text'];
Request(
    "sendMessage",
    [
        'chat_id' => $chat_id,
        'text' => "Hello"
    ]
);