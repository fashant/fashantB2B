<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 06/08/2018
 * Time: 22:04
 */

//session_set_cookie_params(0, '/', '.fashant.com');

//ini_set('session.cookie_domain', '.fashant.com');
//session_name("PHPSESSID");
//session_set_cookie_params(0, '/', '.fashant.com');

//$some_name = session_name("sess");
//session_set_cookie_params(0, '/', '.fashant.com');
//session_start();

ini_set('session.cookie_domain', '.demofashant.com');
session_start();

//$currentCookieParams = session_get_cookie_params();
//$sidvalue = session_id();
//setcookie(
//    'PHPSESSID',//name
//    $sidvalue,//value
//    0,//expires at end of session
//    $currentCookieParams['path'],//path
//    $currentCookieParams['domain'],//domain
//    true //secure
//);
