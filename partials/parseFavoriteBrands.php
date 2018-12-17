<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 27/09/2018
 * Time: 17:29
 */

session_start();

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;


if(isset($_POST['type']) && isset($_POST['id']) && isset($_SESSION['id'])){
    $type = $_POST['type'];
    $id = $_POST['id'];
    $ukey = $_SESSION['id'];

    switch ($type){
        case 'delete':
            if(deleteFavoriteBrand($id, $ukey)){
                echo "success ";
            } else {
                echo "failed ";
            }
            break;
        case 'add':
            if(addFavoriteBrand($id, $ukey)){
                echo "success ";
            } else {
                echo "failed ";
            }
            break;
        default:
            echo "failed ";
            break;
    }
}