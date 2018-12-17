<?php
$db_host = "localhost";
$db = "demofash_demofashant";
$db_username = "demofash_usr";
$db_password = "XxfnnOU{)j.M";
function getConnection()
{
    global $db_host, $db, $db_username, $db_password;
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db, 3306);
    if (mysqli_connect_errno()) {
        exit("Error connecting to db");
    }
    $conn->set_charset("utf8");
    return $conn;
}