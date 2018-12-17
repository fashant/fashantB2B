<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 23/08/2018
 * Time: 14:49
 */

session_start();

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;


//array to hold errors
$form_errors = array();

//validate
$required_fields = array('rating', 'name', 'review');

$form_errors = array_merge($form_errors, check_empty_fields($required_fields, array()));

//email validation / merge the return data into form_error array
$form_errors = array_merge($form_errors, check_email($_POST));

if(empty($form_errors)){
    if(isset($_SESSION['id'])){
        if(isset($_POST['brand_id'])){
            $id = $_POST['brand_id'];
            $rating = $_POST['rating'];
            $name = $_POST['name'];
            $review = $_POST['review'];
            $ukey = $_SESSION['id'];
            if(isset($_POST['city'])){$city = $_POST['city'];} else {$city = "";}
            if(isset($_POST['email'])){$email = $_POST['email'];} else {$email = "";}
            if(isset($_POST['mobile'])){$phone = $_POST['mobile'];} else {$phone = "";}

            if(hasNotReviewed($ukey, $id)) {
                $mysqli = getConnection();
                $sql = "INSERT INTO reviews (name, email, phone, city, review, rating, date, brand_id, ukey) 
                                 VALUES ('$name', '$email', '$phone', '$city', '$review', '$rating', NOW(), $id, $ukey);";

                if ($mysqli->query($sql)) {
                    echo "success ";
                } else {
                    echo "failed 1";
                }
            } else {
                echo "failed 2";
            }
        } else {
            echo "failed 5";
        }
    } else {
        echo "failed 3";
    }
} else {
    echo "failed 4";
}
