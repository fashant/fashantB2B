<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 08/08/2018
 * Time: 19:41
 */

session_start();

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;


//initialize an array to store any error message from the form
$form_errors = array();

$error_messages = array('user_first_name'=>'First Name', 'user_last_name'=>'Last Name', 'user_email'=>'Email', 'user_list_addr'=>'Address',
                        'user_type'=>'User Type', 'user_city'=>'City', 'user_username'=>'Username', 'user_password'=>'Password');

//Form validation
$required_fields = array('user_first_name', 'user_last_name', 'user_email', 'user_list_addr', 'user_type', 'user_city', 'user_username', 'user_password');

//call the function to check empty field and merge the return data into form_error array
$form_errors = array_merge($form_errors, check_empty_fields($required_fields, $error_messages));


//email validation / merge the return data into form_error array
$form_errors = array_merge($form_errors, check_email($_POST));

if (empty($form_errors)) {
    $user = setNewUser($_POST);

    uploadNewUser($user, $_POST['user_password']);
} else {
    if (count($form_errors) == 1) {
        $result = flashMessage("It was 1 error in the form<br>");
        echo "failed " . $result . "<br>";
        echo $form_errors[0] . "<br>";
    } else {
        $result = flashMessage("It was " . count($form_errors) . " error in the form <br>");
        echo "failed " . $result . "<br>";
        for ($i = 0; $i < sizeof($form_errors); $i++) {
            echo $form_errors[$i] . "<br>";
        }

    }
}
