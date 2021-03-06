<?php

namespace rara;

$token = file_get_contents('../token.txt');
define('BOT_TOKEN', $token);
define('API_URL', 'https://api.telegram.org/bot' . BOT_TOKEN . '/');
class Option
{
    public function encodeMessage($message, $index = 0)
    {
        return (json_decode(json_encode(($message)[$index]), true));
    }
    public function genfile($file)
    {
        $content = mime_content_type($file);
        return curl_file_create($file, $content);
    }
    public function Request($method, $parameters)
    {

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

    public function setWebhook(bool $withport = false)
    {
        if ($withport) {
            echo $this->Request("setWebhook", ['url' => $_SERVER['HTTP_HOST'] . '/' . 'index.php']);
        } else {
            echo $this->Request("setWebhook", ['url' => $_SERVER['SERVER_NAME'] . '/' . 'index.php']);
        }
    }
}
