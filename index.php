<?php
use Tungmmo\Apishare\Facebook\Http;

require 'vendor/autoload.php';


require 'vendor/autoload.php';

$tungmmo = new Http();

// cài đặt
$tungmmo->setToken("DIEN_TOKEN_FACEBOOK_CUA_BAN");
$tungmmo->setCookie("DIEN_COOKIE_FACEBOOK_CUA_BAN");
// check live or die
$tungmmo->check();


$getUID = Http::getUID("DIEN_URL_FACEBOOK_CAN_GET_UID");

