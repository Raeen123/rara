<?php
function setWebhook(bool $withport = false)
{
    if ($withport) {
        echo $this->Request("setWebhook", ['url' => $_SERVER['HTTP_HOST'] . '/' . 'index.php']);
    } else {
        echo $this->Request("setWebhook", ['url' => $_SERVER['SERVER_NAME'] . '/' . 'index.php']);
    }
}
//Set your Webhook
//this function has $withport
//if is it true send url of site with port
setWebhook();
