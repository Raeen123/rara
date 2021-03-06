<?php
// Bot document : https://github.com/Lukasss93/telegrambot-php
require_once "vendor/autoload.php";
require_once "rara/option.php";

use TelegramBot\TelegramBot;
use rara\Option;
$token = file_get_contents('token.txt');
$bot = new TelegramBot($token);
$rara = new Option($token);
$update = $bot->getWebhookUpdate();
$img = $rara->genfile('raeen.jpg');
$buttons = [
    [
        $bot->buildInlineKeyBoardButton("github rara", $url = "https://github.com/raeen123/rara")
    ],
    [
        $bot->buildInlineKeyBoardButton("github telegrambot-php", $url = "https://github.com/Lukasss93/telegrambot-php")
    ]
];

$bot->sendPhoto([
    'chat_id' => $update->message->chat->id,
    'reply_markup' => $bot->buildInlineKeyBoard($buttons),
    'photo' => $img,
    'caption' => 'Hello Wellcome to rara 😁😁😁'
]);
