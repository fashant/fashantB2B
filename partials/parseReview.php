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
$required_fields = array('rating', 'name', 'review', 'uid');

$form_errors = array_merge($form_errors, check_empty_fields($required_fields, array()));

//email validation / merge the return data into form_error array
$form_errors = array_merge($form_errors, check_email($_POST));

$error_message = "Something went wrong, please try again.";

if(empty($form_errors)){
    if(isset($_POST['brand_id'])){
        $id = $_POST['brand_id'];
        $rating = $_POST['rating'];
        $name = $_POST['name'];
        $review = $_POST['review'];
        $ukey = $_POST['uid'];

        if(isset($_POST['city'])){$city = $_POST['city'];} else {$city = "";}
        if(isset($_POST['email'])){$email = $_POST['email'];} else {$email = "";}
        if(isset($_POST['mobile'])){$phone = $_POST['mobile'];} else {$phone = "";}

        $brand = getBrand($id);

        if($id !== $brand->getUkey()) {
            if (hasNotReviewed($ukey, $id)) {
                $mysqli = getConnection();
                $sql = "INSERT INTO reviews (name, email, phone, city, review, rating, date, brand_id, ukey) 
                             VALUES ('$name', '$email', '$phone', '$city', '$review', '$rating', NOW(), $id, $ukey);";

                if ($mysqli->query($sql)) {
                    echo "success ";
                } else {
                    echo "failed $error_message";
                }
            } else {
                echo "failed You have already reviewed this brand.";
            }
        } else {
            echo "failed You cannot review your own brand.";
        }
    } else {
        echo "failed $error_message";
    }
} else {
    echo "failed $error_message";
}
