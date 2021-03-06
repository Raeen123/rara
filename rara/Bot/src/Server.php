<?php
require_once "rara/option.php";

use rara\Option;

$rara = new Option();
//Set your Webhook
//this function has $withport
//if is it true send url of site with port
$rara->setWebhook();
