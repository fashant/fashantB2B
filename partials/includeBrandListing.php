<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 27/08/2018
 * Time: 21:27
 */

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;

$mysqli = getConnection();

$MEN = 1;
$WOMEN = 2;
$KIDS = 3;

$brand_men = getBrandListing($MEN);
$brand_women = getBrandListing($WOMEN);

function getBrandListing($i)
{
    $brands = array();

    global $mysqli;
    $sql = "SELECT * FROM brand_in_category WHERE category_id = $i";
    $result = mysqli_query($mysqli, $sql);

    if($result){
        while ($row = $result->fetch_array()){
            $id = $row['brand_id'];
            $new_sql = "SELECT * FROM brands WHERE id = $id";
            $new_result = mysqli_query($mysqli, $new_sql);
            if($new_result){
                while ($new_row = $new_result->fetch_array()){
                    $brands[] = $new_row['brand'];
                }
            }
        }
    }

    return $brands;
}



?>


<div class="main_part_only_best">
    <div class="container">
        <h2>Dubai's Top Fashion Brands</h2>
        <span>Poular Brands that people are searching for right now</span>
        <div class="row">
            <div class="col-md-6">
                <div class="main_part_inner_men_women_1">
                    <div class="main_img_par_only_best">
                        <img src="images/only_best_image_men.png" alt="">
                    </div>
                    <ul class="sub-cat">
                        <h2>MEN’S <span>Popular</span></h2>
                        <?php
//                            if(!empty($brand_men)){
//                                foreach ($brand_men as $b){
//                                    echo "<li>
//                                            <div class=\"info\">
//                                                <a class=\"link\" href=\"https://fashant.com/list.php?f=&categories[]=Men&brands[]=$b\">$b</a>
//                                            </div>
//                                        </li>";
//                                }
//                            }
                        ?>
                        <?php
                        $men_brands = array();
                        $men_brands[] = "Zara";
                        $men_brands[] = "H&M";
                        $men_brands[] = "Aldo";
                        $men_brands[] = "Nike";
                        $men_brands[] = "Tommy Hilfiger";
                        $men_brands[] = "MAX Fashion";
                        $men_brands[] = "Giordano";

                        for($i = 0; $i < sizeof($men_brands); $i++){
                            $b = $men_brands[$i];
                            echo "<li><div class='info'>";
                            if(in_array($b, $brand_men)){
                                echo "<a class=\"link\" href=\"https://demofashant.com/list.php?f=&categories[]=Men&brands[]=$b\">$b</a>";
                            } else {
                                echo "<a style='color: red;' class=\"link\" href=\"https://demofashant.com/list.php?f=&categories[]=Men&brands[]=$b\">$b</a>";
                            }
                            echo "</div></li>";
                        }

                        ?>

                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="main_part_inner_men_women_2">
                    <div class="main_img_par_only_best_2">
                        <img src="images/only_best_women.png" alt="">
                    </div>
                    <ul class="sub-cat">
                        <h2>WOMEN’S <span>Popular</span></h2>
                        <?php
//                        if(!empty($brand_women)){
//                            foreach ($brand_women as $b){
//                                echo "<li>
//                                            <div class=\"info\">
//                                                <a class=\"link\" href=\"https://demofashant.com/list.php?f=&categories[]=Women&brands[]=$b\">$b</a>
//                                            </div>
//                                        </li>";
//                            }
//                        }
                        ?>
                        <?php
                        $woman_brands = array();
                        $woman_brands[] = "Forever 21";
                        $woman_brands[] = "H&M";
                        $woman_brands[] = "Zara";
                        $woman_brands[] = "Victoria's Secret";
                        $woman_brands[] = "Splash";
                        $woman_brands[] = "Charles & Keith";
                        $woman_brands[] = "Kiabi";

                        for($i = 0; $i < sizeof($men_brands); $i++){
                            $b = $woman_brands[$i];
                            echo "<li><div class='info'>";
                            if(in_array($b, $brand_women)){
                                echo "<a class=\"link\" href=\"https://demofashant.com/list.php?f=&categories[]=Women&brands[]=$b\">$b</a>";
                            } else {
                                echo "<a style='color: red;' class=\"link\" href=\"https://demofashant.com/list.php?f=&categories[]=Women&brands[]=$b\">$b</a>";
                            }
                            echo "</div></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
