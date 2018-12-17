<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 23/08/2018
 * Time: 21:55
 */

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;

$mall = $_POST['autocomplete'];

$mysqli = getConnection();
global $ADMIN;
$brands = getAllBrands($ADMIN);
if(!empty($brands)) {
    foreach ($brands as $brand){
        if(strcmp($brand->getShoppingCenter(), $mall) === 0) {
            $data[] = $brand->getName();
        }
        if(strcmp($mall, "All Malls") === 0){
            $data[] = $brand->getName();
        }
    }
}

$primary_categories = getAllCategories(1);
$items = getAllCategories(0);

if(!empty($primary_categories)){
    foreach ($primary_categories as $cat){
        $data[] = $cat['category'];
    }
}

if(!empty($items)){
    foreach ($items as $cat){
        $data[] = $cat['category'];
    }
}

//$data[] = "Dubai Festival Mall";
//$data[] = "Burjuman";
//$data[] = "Deira City Center";



echo json_encode($data);

//header('Content-Type: application/json');


//echo '["", "Chicago Bulls", "Miami Heat", "Orlando Magic", "Atlanta Hawks", "Philadelphia Sixers", "New York Knicks", "Indiana Pacers", "Charlotte Bobcats", "Milwaukee Bucks", "Detroit Pistons", "New Jersey Nets", "Toronto Raptors", "Washington Wizards", "Cleveland Cavaliers"]';
//
//echo '[{value:"Boston Celtics",label:"/list.php?f=&brands[]=Boston Celtics"}]';

//echo '[{ value: "Nike", label: "list.php?f=&brands[]=Nike" }, { value: "Adidas", label: "list.php?f=&brands[]=Adidas"}]';

//$data = array();
//$data['value'] = "Nike";
//$data['label'] = "list.php?f=&brands[]=Adidas";

//
//$data[] = array(
//    'value' => "Nike",
//    'label' => "list.php?f=&brands[]=Adidas"
//);
//
//echo json_encode($data);

// list.php?f=&brands[]=Boston%20Celtics


//echo "{'Nike':'list.php?f=Nike'}";

//echo '["<pre><div><a href=\"list.php?f=&brands[]=Nike\">Nike</a></div></pre>", "<pre><div><a href=\"list.php?f=&brands[]=Adidas\">Adidas</a></div></pre>"]';
//echo "['Nike']";


//echo '["<div><a href=\"\">Boston Celtics", "Chicago Bulls", "Miami Heat", "Orlando Magic", "Atlanta Hawks", "Philadelphia Sixers", "New York Knicks", "Indiana Pacers", "Charlotte Bobcats", "Milwaukee Bucks", "Detroit Pistons", "New Jersey Nets", "Toronto Raptors", "Washington Wizards", "Cleveland Cavaliers"]';

//echo json_encode([["Nike", "list.php?f=&brands[]=Nike"],["Adidas", "list.php?f=&brands[]=Adidas"]]);

