<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 22/08/2018
 * Time: 22:55
 */

session_start();

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds) . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>World Best Local Directory Website template</title>
    <!-- META TAGS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:url"           content="https://www.demofashant.com/" />
    <meta property="og:type"          content="Fashant" />
    <meta property="og:title"         content="Find the best Fashion brands in Dubai's Shopping Malls" />
    <meta property="og:description"   content="Information on 500+ Fashion Stores, 250+ brands, 3 Shopping Malls and counting." />
    <meta property="og:image"         content="https://demofashant.com/images/banner5.jpg" />

    <!-- FAV ICON(BROWSER TAB ICON) -->
    <link rel="shortcut icon" href="images/fav.ico" type="image/x-icon">
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- FONTAWESOME ICONS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- ALL CSS FILES -->
    <link href="css/materialize.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
    <link href="css/responsive.css" rel="stylesheet">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <!-- AUTOCOMPLETE -->
    <script type="text/javascript">
        $(document).ready(function(){
            var data = getAutocompleteData();

            $("#top-select-search").autocomplete({
                source:data,
                select: function (event, ui){
//                    alert(1);
                    $(this).val(ui.item.label);
                    window.location.href = "list.php?f=&q=" . ui.item.label;
                }
            });
            $(".ui-autocomplete").css("z-index", 1000);
        });

        /* this allows us to pass in HTML tags to autocomplete. Without this they get escaped */
        $[ "ui" ][ "autocomplete" ].prototype["_renderItem"] = function( ul, item) {
            return $( "<li></li>" )
                .data( "item.autocomplete", item )
                .append( $( "<a href=list.php?f=&q=" + item.label + "></a>" ).html( item.label ) )
                .appendTo( ul );
        };


        /*@@@@@@@ SOCIAL MEIDA @@@@@@@*/

        /* Facebook */





    </script>
    <style>
        .dir-alp-l-com1 a {
             margin-top: 0;
             background: none;
             color: black;
             font-weight: 600;
             padding: 0;
             border-radius: 0;
             font-size: 15px;
             border: none;
        }

        .dir-alp-l-com1 a:hover {
            margin-top: 0;
            background: none;
            color: black;
            font-weight: 600;
            padding: 0;
            border-radius: 0;
            border: none;
        }

        .ui-autocomplete {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            float: left;
            display: none;
            min-width: 160px;
            _width: 160px;
            padding: 4px 0;
            margin: 2px 0 0 0;
            list-style: none;
            background-color: #ffffff;
            border-color: #ccc;
            border-color: rgba(0, 0, 0, 0.2);
            border-style: solid;
            border-width: 1px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            -webkit-background-clip: padding-box;
            -moz-background-clip: padding;
            background-clip: padding-box;
            *border-right-width: 2px;
            *border-bottom-width: 2px;

        .ui-menu-item > a.ui-corner-all {
            display: block;
            padding: 3px 15px;
            clear: both;
            font-weight: normal;
            line-height: 18px;
            color: #555555;
            white-space: nowrap;

        &.ui-state-hover, &.ui-state-active {
                               color: #ffffff;
                               text-decoration: none;
                               background-color: #0088cc;
                               border-radius: 0px;
                               -webkit-border-radius: 0px;
                               -moz-border-radius: 0px;
                               background-image: none;
                           }
        }
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!--TOP SEARCH SECTION-->
<?php include_once "partials/nav-search.php"; ?>
<?php if(isset($_SESSION['id'])): ?>
<?php
    $user = getUser($_SESSION['id']);
    $reviews = getUsersReviews($_SESSION['id']);
?>
<section class="dir-alp dir-pa-sp-top">
    <div class="container">
        <div class="row">
            <div class="dir-alp-tit">
                <!--<h1>Brands</h1>
                <ol class="breadcrumb">
                    <li><a href="#">Home</a> </li>
                    <li><a href="#">Listing</a> </li>
                    <li class="active">All Brands</li>
                </ol>-->
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12 col-md-9 col-sm-9 col-xs-12 pad">
                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 pading">
                    <div class="box1">
						<img src="images/slider/1.jpg">
                    </div>
                </div>
				<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 pading">
                    <div class="box12">
						<h4 style="color:white;"><?php echo $user->getFullName(); ?></h4>
						<!--<span class="location"><i class="fa fa-map-marker" aria-hidden="true"></i><?php //echo $user->getCity(); ?></span>-->
                    </div>
                </div>
                <div class="col-lg-6 col-md-3 col-sm-3 col-xs-12 paddingbutton">
                    <div class="list-enqu-btn">
                        <ul>
                            <?php 
                                //getPriceCategoryList();
                            ?>
                 
                        </ul>
                    </div>
                </div>

            </div>
            <div class="clearfix"></div>
            <div class="row1">
                <div class="dir-alp-con">
                    <div class="col-md-3 dir-alp-con-left" style="margin-top: 0;">
                        <!--==========Sub Category Filter============-->
                        <div class="dir-alp-l3 dir-alp-l-com">
                            <h4>Category</h4>
                            <div class="dir-alp-l-com1 dir-alp-p3">
                                <div class="box1heading"> </div>
                                <form action="#">
                                    <ul>
                                        <?php //generateListCategory(1, $category); ?>
										<li onclick="updateUserContainer('userContainer', 'userReviews.php');"><a href="#">Reviews</a></li>
                                        <li><a target="_blank" href="FSBlogs" style="">Community Blogs</a></li>
                                        <li onclick="updateUserContainer('userContainer', 'userFavoriteBrands.php');"><a href="#">Favourite Brands</a></li>
                                        <li onclick="updateUserContainer('userContainer', 'userInvite.php');"><a href="#">Invite Friends</a></li>
                                        <li onclick="updateUserContainer('userContainer', 'userSettings.php');"><a href="#">Settings</a></li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!--==========End Sub Category Filter============-->
                        
                    </div>
                    <div class="col-md-9 dir-alp-con-right" style="padding-right: 0;">
                        <div id="userContainer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php else: ?>
<section class="dir-alp dir-pa-sp-top">
        <div class="container">
            <div class="row">
                <div class="dir-alp-tit">
                    <!--<h1>Brands</h1>
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a> </li>
                        <li><a href="#">Listing</a> </li>
                        <li class="active">All Brands</li>
                    </ol>-->
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 col-md-9 col-sm-9 col-xs-12" style="padding: 5% 0 10% 0">
                    <h2>You are not logged in, please login to see the content of this page.</h2>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!--FOOTER SECTION-->
<?php include_once "partials/Footer.php"; ?>

<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/materialize.min.js" type="text/javascript"></script>
<script src="js/custom.js"></script>
<script src="js/formSubmit.js"></script>
<script src="js/updateInnerContents.js"></script>



</body>
</html>

