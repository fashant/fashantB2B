<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 27/09/2018
 * Time: 18:07
 */

session_start();

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;

if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
    $updated = false;

    if(isset($_POST['firstname'])){
        $data = strip_tags($_POST['firstname']);
        if(strcmp($data, "") !== 0) {
            if(updateUsersFirstname($user_id, $data)){
                $updated = true;
            }
        }
    }

    if(isset($_POST['lastname'])){
        $data = strip_tags($_POST['lastname']);
        if(strcmp($data, "") !== 0) {
            if(updateUsersLastname($user_id, $data)){
                $updated = true;
            }
        }
    }

    if(isset($_POST['password'])){
        $data = strip_tags($_POST['password']);
        if(strlen($data) >= 6) {
            if(updateUsersPassword($user_id, password_hash($data, PASSWORD_DEFAULT))){
                $updated = true;
            }
        }
    }

    if(!$updated){
        echo "failed ";
    } else {
        echo "success ";
    }
} else {
    echo "failed ";
}