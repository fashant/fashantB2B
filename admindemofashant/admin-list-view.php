<?php session_start(); ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 06/08/2018
 * Time: 23:53
 */


$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds) . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;

$mysqli = getConnection();

?>

<?php if (!isset($_SESSION['username'])): ?>
    <script type="text/javascript">
        window.location.href = "http://admin.fashant.com/login.php";
    </script>

<?php else: ?>

    <?php
        $brand_id = false;

        if(isset($_GET['id'])){
            $brand_id = $_GET['id'];
        }

        $brand = getBrand($brand_id);
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Brand <?php echo $_GET['id'] ?></title>
        <!-- META TAGS -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- FAV ICON(BROWSER TAB ICON) -->
        <link rel="shortcut icon" href="images/fav.ico" type="image/x-icon">
        <!-- GOOGLE FONT -->
        <link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:500,700" rel="stylesheet">
        <!-- FONTAWESOME ICONS -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- ALL CSS FILES -->
        <link href="css/materialize.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
        <link href="css/responsive.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!--== MAIN CONTRAINER ==-->
    <?php include_once "partials/header.php"; ?>
    <!--== BODY CONTNAINER ==-->
    <div class="container-fluid sb2">
        <div class="row">
            <div class="sb2-1">
                <?php include_once "partials/navigation.php"; ?>
            </div>
            <!--== BODY INNER CONTAINER ==-->
            <div id="innerContents">
                <div class="sb2-2">
                <!--== breadcrumbs ==-->
                <div class="sb2-2-2">
                    <ul>
                        <li><a href="index.html"><i class="fa fa-home" aria-hidden="true"></i> Home</a> </li>
                        <li class="active-bre"><a href="#"> View Listing</a> </li>
                        <li class="page-back" onclick="window.history.back();"><a href="#"><i class="fa fa-backward" aria-hidden="true"></i> Back</a> </li>
                    </ul>
                </div>
                <div class="tz-2 tz-2-admin">
                    <div class="tz-2-com tz-2-main">
                        <h4>View Listing</h4> <a class="dropdown-button drop-down-meta drop-down-meta-inn" href="#" data-activates="dr-list"><i class="material-icons">more_vert</i></a>
                        <ul id="dr-list" class="dropdown-content">
                            <li><a href="#!">Add New</a> </li>
                            <li><a href="#!">Edit</a> </li>
                            <li><a href="#!">Update</a> </li>
                            <li class="divider"></li>
                            <li><a href="#!"><i class="material-icons">delete</i>Delete</a> </li>
                            <li><a href="#!"><i class="material-icons">subject</i>View All</a> </li>
                            <li><a href="#!"><i class="material-icons">play_for_work</i>Download</a> </li>
                        </ul>
                        <!-- Dropdown Structure -->
                        <div class="split-row">
                            <div class="col-md-12">
                                <div class="box-inn-sp ad-inn-page">
                                    <div class="tab-inn ad-tab-inn">
                                        <?php
                                            if($brand && $brand_id){
                                                $logo = 'images/icon/dbr1.jpg';

                                                if(isset($logo) && strcmp($logo, "") !== 0){
                                                    $logo = $brand->getLogo();
                                                }

                                                $id = $brand->getId();
                                                $name = $brand->getName();
                                                $about = $brand->getAbout();
                                                $center = $brand->getShoppingCenter();
                                                $location = $brand->getStoreLocation();
//                                                $address = $brand->getAddress();
                                                $phone = $brand->getContactPhone();
                                                $email = $brand->getContactEmail();
                                                $gallery = $brand->getGallery();
                                                $price_category = getPriceCategoryName($brand->getPriceCategory());
                                                if(!$price_category){
                                                    $price_category = $brand->getPriceCategory();
                                                }
                                                $policies = $brand->getPolicies();

                                                $categories = getBrandsCategories($id, 0);
                                                $primary = getBrandsCategories($id, 1);
                                                $secondary = getBrandsCategories($id, 2);

                                                $open_mon = $brand->getOpenMon();
                                                $open_tues = $brand->getOpenTues();
                                                $open_wed = $brand->getOpenWed();
                                                $open_thurs = $brand->getOpenThurs();
                                                $open_fri = $brand->getOpenFri();
                                                $open_sat = $brand->getOpenSat();
                                                $open_sun = $brand->getOpenSun();
                                                $close_mon = $brand->getCloseMon();
                                                $close_tues = $brand->getCloseTues();
                                                $close_wed = $brand->getCloseWed();
                                                $close_thurs = $brand->getCloseThurs();
                                                $close_fri = $brand->getCloseFri();
                                                $close_sat = $brand->getCloseSat();
                                                $close_sun = $brand->getCloseSun();

                                                echo "<table class=\"responsive-table bordered\">
                                            <tbody>
                                            <tr>
                                                <td>Logo</td>
                                                <td>:</td>
                                                <td><a href='$logo'><img width='150' src='$logo' alt=''></a> </td>
                                            </tr>
                                            <tr>
                                                <td>Id</td>
                                                <td>:</td>
                                                <td>$id</td>
                                            </tr>
                                            <tr>
                                                <td>Brand Name</td>
                                                <td>:</td>
                                                <td>$name</td>
                                            </tr>
                                            <tr>
                                                <td>About Brand</td>
                                                <td>:</td>
                                                <td>$about</td>
                                            </tr>
                                            <tr>
                                                <td>Shopping Center</td>
                                                <td>:</td>
                                                <td>$center</td>
                                            </tr>
                                            <tr>
                                                <td>Store Location</td>
                                                <td>:</td>
                                                <td>$location</td>
                                            </tr>
                                           
                                            <tr>
                                                <td>Contact Phone</td>
                                                <td>:</td>
                                                <td>$phone</td>
                                            </tr>
                                            <tr>
                                                <td>Contact Email</td>
                                                <td>:</td>
                                                <td>$email</td>
                                            </tr>
                                            <tr>
                                                <td>Gallery</td>
                                                <td>:</td>";

                                                if(isset($gallery)) {
                                                    $gallery = explode(',', $gallery);
                                                    if(!empty($gallery)){
                                                        echo "<td>";
                                                        foreach ($gallery as $img){
                                                            if (strpos($img, 'brands') !== false) {
                                                                echo "<a href='$img' style='padding: 2%;'><img width='50' src='$img'></a>";
                                                            }
                                                        }
                                                        echo "</td>";
                                                    }
                                                }

                                       echo "
                                            </tr>
                                            <tr>
                                                <td>Price Category</td>
                                                <td>:</td>
                                                <td>$price_category</td>
                                            </tr>
                                            <tr>
                                                <td>Policies</td>
                                                <td>:</td>
                                                <td>$policies</td>
                                            </tr>
                                            <tr>
                                                <td>Categories</td>
                                                <td>:</td>";

                                            if(!empty($categories)){
                                                echo "<td>";
                                                $cat = $categories[0];
                                                for($i = 1; $i < sizeof($categories); $i++){
                                                    $cat .= ", " . $categories[$i];
                                                }
                                                echo $cat;
                                                echo "</td>";
                                            } else {
                                                echo "<td></td>";
                                            }

                                        echo "</tr>
                                            <tr>
                                                <td>Primary tagging</td>
                                                <td>:</td>
                                                <td>$primary[0]</td>
                                            </tr>
                                            <tr>
                                                <td>Secondary taggins</td>
                                                <td>:</td>";

                                            if(!empty($secondary)){
                                                echo "<td>";
                                                $sec = $secondary[0];
                                                for($i = 1; $i < sizeof($secondary); $i++){
                                                    $sec .= ", " . $secondary[$i];
                                                }
                                                echo $sec;
                                                echo "</td>";
                                            } else {
                                                echo "<td></td>";
                                            }

                                        echo "</tr>
                                            <tr>
                                                <td>Open Monday</td>
                                                <td>:</td>
                                                <td>$open_mon</td>
                                            </tr>
                                            <tr>
                                                <td>Closing Monday</td>
                                                <td>:</td>
                                                <td>$close_mon</td>
                                            </tr>
                                            <tr>
                                                <td>Open Tuesday</td>
                                                <td>:</td>
                                                <td>$open_tues</td>
                                            </tr>
                                            <tr>
                                                <td>Closing Tuesday</td>
                                                <td>:</td>
                                                <td>$close_tues</td>
                                            </tr>
                                            <tr>
                                                <td>Open Wednesday</td>
                                                <td>:</td>
                                                <td>$open_wed</td>
                                            </tr>
                                            <tr>
                                                <td>Closing Wednesday</td>
                                                <td>:</td>
                                                <td>$close_wed</td>
                                            </tr>
                                            <tr>
                                                <td>Open Thursday</td>
                                                <td>:</td>
                                                <td>$open_thurs</td>
                                            </tr>
                                            <tr>
                                                <td>Closing Thursday</td>
                                                <td>:</td>
                                                <td>$close_thurs</td>
                                            </tr>
                                            <tr>
                                                <td>Open Friday</td>
                                                <td>:</td>
                                                <td>$open_fri</td>
                                            </tr>
                                            <tr>
                                                <td>Closing Friday</td>
                                                <td>:</td>
                                                <td>$close_fri</td>
                                            </tr>
                                            <tr>
                                                <td>Open Saturday</td>
                                                <td>:</td>
                                                <td>$open_sat</td>
                                            </tr>
                                            <tr>
                                                <td>Closing Saturday</td>
                                                <td>:</td>
                                                <td>$close_sat</td>
                                            </tr>
                                            <tr>
                                                <td>Open Sunday</td>
                                                <td>:</td>
                                                <td>$open_sun</td>
                                            </tr>
                                            <tr>
                                                <td>Closing Sunday</td>
                                                <td>:</td>
                                                <td>$close_sun</td>
                                            </tr>
                                            </tbody>
                                        </table>";
                                            } else {
                                                echo "There is no brand with this ID";
                                            }
                                        ?>

                                    </div>
                                </div>
<!--                                <div class="admin-pag-na">-->
<!--                                    <ul class="pagination list-pagenat">-->
<!--                                        <li class="disabled"><a href="#!!"><i class="material-icons">chevron_left</i></a> </li>-->
<!--                                        <li class="active"><a href="#!">1</a> </li>-->
<!--                                        <li class="waves-effect"><a href="#!">2</a> </li>-->
<!--                                        <li class="waves-effect"><a href="#!">3</a> </li>-->
<!--                                        <li class="waves-effect"><a href="#!">4</a> </li>-->
<!--                                        <li class="waves-effect"><a href="#!">5</a> </li>-->
<!--                                        <li class="waves-effect"><a href="#!">6</a> </li>-->
<!--                                        <li class="waves-effect"><a href="#!">7</a> </li>-->
<!--                                        <li class="waves-effect"><a href="#!">8</a> </li>-->
<!--                                        <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a> </li>-->
<!--                                    </ul>-->
<!--                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!--== BOTTOM FLOAT ICON ==-->
    <section>
        <div class="fixed-action-btn vertical">
            <a class="btn-floating btn-large red pulse"> <i class="large material-icons">mode_edit</i> </a>
            <ul>
                <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a> </li>
                <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a> </li>
                <li><a class="btn-floating green"><i class="material-icons">publish</i></a> </li>
                <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a> </li>
            </ul>
        </div>
    </section>
    <!--SCRIPT FILES-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <script src="js/materialize.min.js" type="text/javascript"></script>
    <script src="js/custom.js"></script>
    </body>

    </html>

<?php endif; ?>