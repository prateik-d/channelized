<?php

use myPHPNotes\LinkedIn;

require_once "LinkedIn.php";

$app_id = "78slcqbpgbo9ko";
$app_secret = "CGIoZkqtlyJjY6cA";
$callback = "http://localhost:8080/channelised/scraping/linkedin/Sign/callback.php";
$scopes = "r_emailaddress r_basicprofile r_liteprofile";
$ssl = false; //TRUE FOR PRODUCTION ENV.

$linkedin = new LinkedIn($app_id, $app_secret, $callback, $scopes, $ssl);