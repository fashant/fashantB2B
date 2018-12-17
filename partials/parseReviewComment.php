<?php

session_start();

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;


//array to hold errors
$form_errors = array();

//validate
$required_fields = array('comment', 'review_id', 'uid');

$form_errors = array_merge($form_errors, check_empty_fields($required_fields, array()));

$error_message = "Something went wrong, please try again.";

if(empty($form_errors)) {
    if(isset($_POST['comment']) && isset($_POST['review_id'])){
        $user = getUser($_POST['uid']);
        $ukey = $user->getId();
        $comment = $_POST['comment'];
        $review_id = $_POST['review_id'];

        if(!hasCommented($ukey, $review_id)){
            $mysqli = getConnection();
            $sql = "INSERT INTO comments (review_id, comment, user_id, date) 
                                  VALUES ($review_id, '$comment', $ukey, NOW())";
            if($mysqli->query($sql)){
                echo "success ";
            } else {
                echo "failed $error_message";
            }
        } else {
            echo "failed You have already left a comment for this review";
        }
    } else {
        echo "failed Please write a comment before submitting";
    }
} else {
    echo "failed $error_message";
}


