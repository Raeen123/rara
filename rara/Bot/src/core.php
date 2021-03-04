<?php
$token = file_get_contents('../token.txt'); 
define('BOT_TOKEN',$token);
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');


function Request($method, $parameters) {

    if (!$parameters) {
        $parameters = array();
    }

    $parameters["method"] = $method;

    $handle = curl_init(API_URL);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($handle, CURLOPT_TIMEOUT, 60);
    curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
    curl_setopt($handle, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    $result = curl_exec($handle);
    return $result;
}
