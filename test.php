<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) ) . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

//echo $utilities_dir;
include_once $utilities_dir;


sendMail('welcome', "isakloevold@gmail.com", 'http://fashant.com', '', '', '');

//addToMailchimpList("isaklovold@gmail.com", "isak", "lovold");


?>
