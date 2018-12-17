<?php

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
    if(isset($filters) && isset($filters['pc'])){
        $brands = getBrandsByPriceCategory($brands, $filters['pc']);
    }
    if(isset($filters) && isset($filters['q'])){
        if(strcmp($filters['q'], "") !== 0) {
            $brands = getBrandsByQuery($brands, $filters['q']);
        }
    }

    if(isset($filters) && isset($filters['page'])){$page_number = $filters['page'];} else {$page_number = 1;}


    // RETURN NUMBER OF BRANDS AND ALL BRAND ELEMENTS
    echo count($brands) . " ";

    $brands_display = array();

    for ($i = 0; $i < count($brands); $i++) {
        if (($i >= (($page_number * 10) - 10) && $i < ($page_number * 10))) {
            $brands_display[] = $brands[$i];
        }
    }

    if(strcmp($_POST['mobile'], "true") === 0){
        generateMobileListings($brands_display);
    } else {
        generateListings($brands_display);
    }

    //generateListings($brands);
} else {
    echo "failed ";
}

if(isset($_POST['pageNumber'])){
    $url = $_POST['pageNumber'];

    // MAKES FILTERS OF ALL PARTS IN THE URL SENT
    $parts = parse_url($url);
    parse_str($parts['query'], $filters);
    if(isset($filters['page'])){echo $filters['page'];}
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
                        $objects[] = $brand;
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
                        $objects[] = $brand;
                    }
                }
            }
        }
    }

    return $objects;
}

function getBrandsByPriceCategory($brands, $pc){
    $objects = array();

    if(!empty($brands)){
        foreach ($brands as $brand) {
            if(is_array($pc)){
                foreach ($pc as $p){
                    if (strcmp($brand->price_category, $p) === 0) {
                        $objects[] = $brand;
                    }
                }
            }
        }
    }

    return $objects;
}

function getBrandsByQuery($brands, $query){
    $new_brands = array();

    if(!empty($brands)){
        foreach ($brands as $brand){
            if(strpos(strtolower($brand->getName()), strtolower($query)) !== false){
                $new_brands[] = $brand;
            }
            if(strpos(strtolower($brand->shopping_center), strtolower($query)) !== false){
                $new_brands[] = $brand;
            }
            /**
                TODO
             * Get by items and category
             */
        }
    }

    return $new_brands;
}