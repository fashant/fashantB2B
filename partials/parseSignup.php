<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 07/09/2018
 * Time: 18:33
 */


$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;

//array to hold errors
$form_errors = array();

//validate
$required_fields = array('FNAME', 'LNAME', 'EMAIL', 'password');

$form_errors = array_merge($form_errors, check_empty_fields($required_fields, array()));

if(empty($form_errors)){
    //collect form data
    $hash = md5(rand(0,1000));
    $id = mt_rand(10000000, 99999999);
    $firstname = $_POST['FNAME'];
    $lastname = $_POST['LNAME'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['EMAIL'];

    $valid_user = true;

    if(emailExistsInDB($email)){
        $valid_user = false;
    }

    if(strlen($_POST['password']) < 6){
        $valid_user = false;
    }

    if($valid_user) {
        //check if profile exist in the database
        $mysqli = getConnection();

        $sql = "INSERT INTO users (id, first_name, last_name, phone, email, address, user_type, city, description, username, password, hash, active) 
            VALUES ($id, '$firstname', '$lastname', '', '$email', '', 'Normal', '', '', '', '$password', '$hash', 0)";

        if ($mysqli->query($sql)) {
//            $_SESSION['id'] = $id;
//
//            $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
//            $_SESSION['last_active'] = time();
//            $_SESSION['fingerprint'] = $fingerprint;

            // REMEMBER FUNCTION
//            if (isset($_POST['remember'])) {
//                rememberMe($id);
//            }

            //call function
            echo "success ";

            // Send email
            sendMail('welcome', $email, "https://demofashant.com/verify.php?hash=$hash&ukey=$id", '', '', '');

        } else {
            echo "failed " . "Wrong username or password ";
        }
    } else {
        echo "failed " . "Something went wrong ";
    }
} else {
    if(count($form_errors) == 1){
        echo "failed ";
        $result = "It was 1 error in the form ";
    } else {
        echo "failed ";
        $result = "It was " .count($form_errors). " errors in the form ";
    }

    echo $result;
}

