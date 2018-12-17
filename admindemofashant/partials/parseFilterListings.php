<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 23/08/2018
 * Time: 16:00
 */

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;
$mysqli = getConnection();



if(isset($_POST['value']) && isset($_POST['type']) && isset($_POST['url'])) {
    // GET VARIABLES SENT FROM POST
    $value = $_POST['value'];
    $type = $_POST['type'];
    $url = $_POST['url'];

    // MAKES FILTERS OF ALL PARTS IN THE URL SENT
    $parts = parse_url($url);
    if(isset($parts['query'])) {
        parse_str($parts['query'], $filters);
    }

    global $ADMIN;
    $brands = getAllBrands($ADMIN);

    if(isset($filters) && isset($filters['categories'])){
        $brands = getBrandsByCategory($brands, $filters['categories']);
    }
    if(isset($filters) && isset($filters['items'])){
        $brands = getBrandsByItems($brands, $filters['items']);
    }
    if(isset($filters) && isset($filters['brands'])){
        $brands = getBrandsByBrands($brands, $filters['brands']);
    }
    if(isset($filters) && isset($filters['sc'])){
        $brands = getBrandsByShoppingLocation($brands, $filters['sc']);
    }


    if(!empty($brands)){
        echo "success ";
    } else {
        echo "failed ";
    }

    generateListings($brands);
} else {
    echo "failed ";
}

function getBrandsByCategory($brands, $category){
    $objects = array();
    global $mysqli;


    if(!empty($brands)){
        foreach ($brands as $brand){
            if(!empty($brand->categories)){
                foreach ($brand->categories as $cat){
                    $sql = "SELECT * FROM brand_categories WHERE id = $cat";
                    $result = mysqli_query($mysqli, $sql);
                    if($result){
                        while ($row = $result->fetch_array()){
                            if(is_array($category)) {
                                foreach ($category as $c){
                                    if (strcmp($row['category'], $c) === 0) {
                                        $objects[] = $brand;
                                    }
                                }
                            }
                        }
                    }
                }
            }

        }
    }

    return $objects;
}

function getBrandsByItems($brands, $items){
    $objects = array();
    global $mysqli;

    if(!empty($brands)){
        foreach ($brands as $brand){
            if(!empty($brand->categories)){
                foreach ($brand->categories as $cat){
                    $sql = "SELECT * FROM brand_categories WHERE id = $cat";
                    $result = mysqli_query($mysqli, $sql);
                    if($result){
                        while ($row = $result->fetch_array()){
                            if(is_array($items)){
                                foreach ($items as $item){

                                    if(strcmp($row['category'], $item) === 0){
                                        $objects[] = $brand;
                                    }
                                }
                            }
                        }
                    }
                }
            }

        }
    }

    return $objects;
}

function getBrandsByBrands($brands, $obj){
    $objects = array();

    if(!empty($brands)){
        foreach ($brands as $brand){
            if(is_array($obj)){
                foreach ($obj as $o){
                    if(strcmp($brand->name, $o) === 0){
                        $objects[] = $o;
                    }
                }
            }
        }
    }

    return $objects;
}

function getBrandsByShoppingLocation($brands, $sc){
    $objects = array();

    if(!empty($brands)){
        foreach ($brands as $brand) {
            if(is_array($sc)) {
                foreach ($sc as $s) {
                    if (strcmp($brand->shopping_center, $s) === 0) {
                        $objects[] = $sc;
                    }
                }
            }
        }
    }

    return $objects;
}

