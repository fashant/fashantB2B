<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 06/08/2018
 * Time: 22:04
 */


session_start();
$currentCookieParams = session_get_cookie_params();
$sidvalue = session_id();
setcookie(
    'PHPSESSID',//name
    $sidvalue,//value
    0,//expires at end of session
    $currentCookieParams['path'],//path
    $currentCookieParams['domain'],//domain
    true //secure
);