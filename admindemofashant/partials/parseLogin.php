<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');
/** * Created by PhpStorm. * User: isakl * Date: 06/08/2018 * Time: 20:40 */
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;
$utilities_dir = "{$base_dir}resources{$ds}utilities.php";
include_once $utilities_dir;
//array to hold errors
$form_errors = array();
//validate
$required_fields = array('username', 'password');
$form_errors = array_merge($form_errors, check_empty_fields($required_fields, array()));
if (empty($form_errors)) {
    //collect form data
    $user = $_POST['username'];
    $password = $_POST['password'];
// REMEMBER FUNCTION
//    //isset($_POST['remember']) ? $remember = $_POST['remember'] : $remember = "";
//    //check if profile exist in the database
    $mysqli = getConnection();
    $sql = "SELECT * FROM users WHERE (username = '$user' OR email = '$user' OR phone = '$user') AND active = 1 AND user_type != 'Normal'";
    $result = mysqli_query($mysqli, $sql);
    if ($result) {
        // Fetch all rows
        while ($row = $result->fetch_array()) {
            $id = $row['id'];
            $hashed_password = $row['password'];
            $username = $row['username'];
            $verify = password_verify($password, $hashed_password);
            if ($verify) {
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;
                $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
                $_SESSION['last_active'] = time();
                $_SESSION['fingerprint'] = $fingerprint;
                // REMEMBER FUNCTION
                if (isset($_POST['remember'])) {
                    rememberMe($id);
                }
               //call function
                echo "success ";
                if (isset($_POST['returnURL'])) {
                    echo $_POST['returnURL'];
                }
                //redirectTo('index');
            } else {
                echo "failed " . flashMessage("Wrong username or password ");
            }
        }
    }
} else {
    if (count($form_errors) == 1) {
        echo "failed ";
        $result = flashMessage("It was 1 error in the form ");
    } else {
        echo "failed ";
        $result = flashMessage("It was " . count($form_errors) . " errors in the form ");
    }
    echo $result;
}