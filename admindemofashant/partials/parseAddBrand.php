<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 03/08/2018
 * Time: 14:52
 */

session_start();

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;


//initialize an array to store any error message from the form
$form_errors = array();

//Form validation
$required_fields = array('brand_name', 'price_category', 'city', 'store_location', 'list_phone', 'email', 'brand_categories_primary', 'brand_tagging_primary');

//call the function to check empty field and merge the return data into form_error array
$form_errors = array_merge($form_errors, check_empty_fields($required_fields, array()));

//email validation / merge the return data into form_error array
$form_errors = array_merge($form_errors, check_email($_POST));

if (empty($form_errors)) {
    $brand = setNewBrand($_POST);

    uploadNewBrand($brand, $_SESSION['id']);

} else {
    if (count($form_errors) == 1) {
        $result = flashMessage("It was 1 error in the form<br>");
        echo "failed " . $result . "<br>";
        echo $form_errors[0] . "<br>";
    } else {
        $result = flashMessage("It was " . count($form_errors) . " error in the form <br>");
        echo "failed " . $result . "<br>";
        for($i = 0; $i < sizeof($form_errors); $i++){
            echo $form_errors[$i] . "<br>";
        }

    }
}

