<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 22/09/2018
 * Time: 14:22
 */

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;

if(isset($_POST['id'])){
    $id = $_POST['id'];
    if(brandExist($id)){
        if(deleteBrand($id)){
            echo "success ";
        } else {
            echo "false ";
        }
    } else {
        echo "false ";
    }
} else {
    echo "false ";
}

