<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;

if(isset($_POST['type']) && isset($_POST['value']) && isset($_POST['id'])){
    $type = trim(strip_tags(htmlentities($_POST['type'])));
    $value = trim(strip_tags(htmlentities($_POST['value'])));
    $id = trim(strip_tags(htmlentities($_POST['id'])));

    //echo "type:$type & value:$value & id:$id";

    $sql = "UPDATE opening_hours SET $type = '$value' WHERE id = $id";
    $mysqli = getConnection();
    if($mysqli->query($sql)){
        echo "success ";
    } else {
        echo "failed 1";
    }
} else {
    echo "failed 2";
}

?>