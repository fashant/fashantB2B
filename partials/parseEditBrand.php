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
            echo "failed ";
            break;
    }


}