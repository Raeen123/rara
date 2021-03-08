<?php
function setWebhook(string $url)
{
    $token = file_get_contents('token.txt');
    return file_get_contents("https://api.telegram.org/bot$token/setWebhook?url=$url");
}
//Set your Webhook
//this function has $withport
//if is it true send url of site with port
setWebhook("");
