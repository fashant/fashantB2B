<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 21/08/2018
 * Time: 10:33
 */

session_start();

if(isset($_FILES['logo'])) {
    $uploadfile = '../uploads/brands/' . basename($_FILES['logo']['name']);

    $image_name = "logo.jpg";
    $uploaddir = '../uploads/brands/' . $_SESSION['id'] . '/' . $_POST['brandId'];
    $uploadfile = $uploaddir . '/' . $image_name;

    if (!file_exists($uploaddir)) {
        mkdir($uploaddir, 0777, true);
    }

    if (move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile)) {
        echo "success ";
    } else {
        echo "failed ";
    }
}

if(isset($_FILES['brandImages'])){
    $count = count($_FILES['brandImages']['name']);
    for ($i = 0; $i < $count; $i++) {
        //echo 'Name: '.$_FILES['fileToUpload']['name'][$i].'<br/>';
        $uploadfile = '../uploads/brands/' . basename($_FILES['brandImages']['name'][$i]);

        $image_name = $i . ".jpg";
        $uploaddir = '../uploads/brands/' . $_SESSION['id'] . '/' . $_POST['brandId'];
        $uploadfile = $uploaddir . '/' . $image_name;

        if (!file_exists($uploaddir)) {
            mkdir($uploaddir, 0777, true);
        }

        if (move_uploaded_file($_FILES['brandImages']['tmp_name'][$i], $uploadfile)) {
            echo "success ";
        } else {
            echo "failed ";
        }
    }
}