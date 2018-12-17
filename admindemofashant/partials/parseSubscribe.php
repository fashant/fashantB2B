<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 22/08/2018
 * Time: 21:23
 */


session_start();

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;


//array to hold errors
$form_errors = array();

//validate
$required_fields = array('email');

$form_errors = array_merge($form_errors, check_empty_fields($required_fields, array()));

//email validation / merge the return data into form_error array
$form_errors = array_merge($form_errors, check_email($_POST));

if(empty($form_errors) && !emailExists($_POST['email'])){
    $email = $_POST['email'];

    $mysqli = getConnection();

    $sql = "INSERT INTO newsletter_subscribers (email, active) VALUES ('$email', 1);";

    if($mysqli->query($sql)){
        echo "success ";
        sendMail("welcome", $email, null,  null, null, null);
    } else {
        echo "failed ";
    }
} else {
    echo "failed ";
}
