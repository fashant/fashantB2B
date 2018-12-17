<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 07/08/2018
 * Time: 10:05
 */


$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;

if(isset($_POST['id']) && isset($_POST['value']) && isset($_POST['brand_id'])){
    $id = $_POST['id'];
    $value = $_POST['value'];
    $brand_id = $_POST['brand_id'];

    switch ($id){
        case 'edit_name':
            echo updateBrandInformation('brand', $value, $brand_id);
            break;
        case 'edit_about':
            echo updateBrandInformation('about', $value, $brand_id);
            break;
        case 'edit_city':
            echo updateBrandInformation('city', $value, $brand_id);
            break;
        case 'edit_center':
            echo updateBrandInformation('shopping_center', $value, $brand_id);
            break;
        case 'edit_location':
            echo updateBrandInformation('store_location', $value, $brand_id);
            break;
        case 'edit_address':
            echo updateBrandInformation('address', $value, $brand_id);
            break;
        case 'edit_phone':
            echo updateBrandInformation('contact_phone', $value, $brand_id);
            break;
        case 'edit_email':
            echo updateBrandInformation('contact_email', $value, $brand_id);
            break;
        case 'edit_price':
            echo updateBrandInformation('price_category', $value, $brand_id);
            break;
        case 'edit_policies':
            echo updateBrandInformation('policies', $value, $brand_id);
            break;
        default:
            if(strpos($id, 'primary') !== false){
                $categories[] = $value;
                $sql = "DELETE FROM brand_in_category WHERE brand_id = $brand_id AND category_id = $value AND primary_tagging = 1";
                $mysqli = getConnection();
                if($mysqli->query($sql)) {
                    setNewBrandCategories($brand_id, $categories, 1);
                }
                echo "success ";
            } elseif(strpos($id, 'categories') !== false){
                $categories[] = $value;
                $sql = "SELECT * FROM brand_in_category WHERE brand_id = $brand_id AND category_id = $value AND primary_tagging = 0";
                $mysqli = getConnection();
                if(mysqli_num_rows(mysqli_query($mysqli, $sql)) > 0){
                    $sql = "DELETE FROM brand_in_category WHERE brand_id = $brand_id AND category_id = $value AND primary_tagging = 0";
                    $mysqli->query($sql);
                } else {
                    setNewBrandCategories($brand_id, $categories, 0);
                }
                echo "success ";
            } elseif(strpos($id, 'secondary') !== false){
                $categories[] = $value;
                $sql = "SELECT * FROM brand_in_category WHERE brand_id = $brand_id AND category_id = $value AND primary_tagging = 0";
                $mysqli = getConnection();
                if(mysqli_num_rows(mysqli_query($mysqli, $sql)) > 0){
                    $sql = "DELETE FROM brand_in_category WHERE brand_id = $brand_id AND category_id = $value AND primary_tagging = 0";
                    $mysqli->query($sql);
                } else {
                    setNewBrandCategories($brand_id, $categories, 0);
                }
                echo "success ";
            } else {
                echo "failed ";
            }
            break;
    }

}