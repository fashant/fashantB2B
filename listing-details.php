<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 22/08/2018
 * Time: 22:07
 */

session_start();

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds) . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;

if(isset($_SESSION['id'])){
    $user = getUser($_SESSION['id']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dubai Fashion Brands | Fashant.com</title>
    <!-- META TAGS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:title"         content="Best Fashion Brands/Shops in Dubai’s Shopping Malls" />
    <meta property="og:description"   content="Brand Details: Categories such as Men, Women, Kids, Clothing, Sports, Accessories, Bags, Footwear, Sunglasses, Formal, Undergarments, Swimwear, Lingerie, Jewellery, Arabic, Desi, Maternity, Plus Size etc." />
    <!-- FAV ICON(BROWSER TAB ICON) -->
    <link rel="shortcut icon" href="images/fav.ico" type="image/x-icon">
	
	<!-- Hotjar Tracking Code for www.fashant.com -->
	<script>
	(function(h,o,t,j,a,r){
	h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
	h._hjSettings={hjid:1056026,hjsv:6};
	a=o.getElementsByTagName('head')[0];
	r=o.createElement('script');r.async=1;
	r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
	a.appendChild(r);
	})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
	</script>

	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		
		gtag('config', 'UA-119411572-1');
	</script>
	
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->


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
    </script>
    <style>
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
        .fix-search {
            position: fixed;
            top: 0px;
        }
        .list.bottomMenu {
            z-index:99999;
        }
        .fixbottom {
            position: fixed;
            top: 70px;
            z-index:99999;
        }
        .relapos {
            position: relative;
        }
        .fixsearch {
            position: fixed;
            top: 150px;
            width: 20%;
        }
        .list .fixscroll {
            z-index:99999;
        }

        #sidebar .sidebar__inner{
            padding: 10px;
            position: relative;
            transform: translate(0, 0);
            transform: translate3d(0, 0, 0);
            will-change: position, transform;
        }
        #sidebar{
            will-change: min-height;
        }
table {
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

    </style>

    <script>
        jQuery( document ).ready(function() {

            jQuery(window).scroll(function(event){
                st=jQuery(this).scrollTop();

                if (st > 150) {
                    jQuery(".list.bottomMenu").css("position","fixed");

                    jQuery(".list.bottomMenu").addClass("fix-search");
                } else {
                    jQuery(".list.bottomMenu").css("position","inherit");
                    jQuery(".list.bottomMenu").removeClass("fix-search");
                }

            });

            jQuery(window).scroll(function(event){
                st=jQuery(this).scrollTop();

                if (st > 150) {
                    jQuery(".headbottom").css("position","fixed");

                    jQuery(".headbottom").addClass("fixbottom");
                } else {
                    jQuery(".headbottom").css("position","inherit");
                    jQuery(".headbottom").removeClass("fixbottom");
                }

            });
        });
    </script>

</head>

<body>
<?php include_once "partials/listHeader-nav.php"; ?>
<!--TOP SEARCH SECTION-->
<?php include_once "partials/nav-search.php"; ?>

<?php if(isset($_GET['id']) && brandExist($_GET['id'])): ?>
    <?php
    $id = $_GET['id'];
    $brand = getBrand($id);
    $reviews = getReviews($id);
    $background = "../images/list-deta/ecomm.png";


    $ds = DIRECTORY_SEPARATOR;
    $base_dir = realpath(dirname(__FILE__)  ) . $ds;

    $img_folder = $base_dir . "admindemofashant/uploads/brands/$brand->ukey/$id/logo.jpg";

    $logo = "images/slider/1.jpg";

    if(file_exists($img_folder)){
        $logo = "https://admin.demofashant.com/uploads/brands/$brand->ukey/$id/logo.jpg";
    }

    $categories = getBrandsCategories($brand->getId(), 0);
    $cat = getCategoryText($categories);

    $pcat = getPriceCategoryName($brand->getPriceCategory());
    if(!$pcat){
        $pcat = $brand->getPriceCategory();
    }

    $secondary = getBrandsCategories($id, 2);
    $taggings = getCategoryText($secondary);
    $opening_hour = getTodaysOpeningHour($brand);

    // RATINGS AND REVIEWS
    if(!empty($reviews)) {
        $rating = 0;
        $num_reviews = sizeof($reviews);

        $one_star = 0;
        $two_star = 0;
        $three_star = 0;
        $four_star = 0;
        $five_star = 0;

        foreach ($reviews as $rev) {
            $r = $rev->getRating();
            $rating += $r;

            switch ($r) {
                case 1:
                    $one_star += 1;
                    break;
                case 2:
                    $two_star += 1;
                    break;
                case 3:
                    $three_star += 1;
                    break;
                case 4:
                    $four_star += 1;
                    break;
                case 5:
                    $five_star += 1;
                    break;
            }
        }

        $one_star = ($one_star / $num_reviews) * 100;
        $two_star = ($two_star / $num_reviews) * 100;
        $three_star = ($three_star / $num_reviews) * 100;
        $four_star = ($four_star / $num_reviews) * 100;
        $five_star = ($five_star / $num_reviews) * 100;


        $rating = round($rating / $num_reviews, 1, PHP_ROUND_HALF_DOWN);
        $star_rating = round($rating, 0, PHP_ROUND_HALF_DOWN);

    }

    ?>
    
    <!--LISTING DETAILS-->
    <section class="pg-list-1" style="padding-top: 50px;">
        <div class="container">
            <div class="row">
                <div class="pg-list-1-left" style="width: 100%;">
                    <div class="col-lg-12">
                        <img src="<?php echo $logo; ?>" style="padding-bottom: 2%;">
                    </div>
                    <div class="col-lg-6" style="float: left;">
                        <a href="#"><h3><?php echo $brand->getName(); ?></h3></a>
                        <div class="list-rat-ch"> <span><?php echo $rating; ?></span>
                            <?php
                            if(isset($star_rating)) {
                                for ($i = 0; $i < $star_rating; $i++) {
                                    echo "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
                                }
                            }
                            ?>
                        </div>
                        <h4><?php echo $brand->getCity(); ?></h4>
                        <h4><?php echo $brand->getShoppingCenter(); ?></h4>
                        <h4><?php echo $brand->getStoreLocation(); ?></h4>
                        <?php
                            if(!empty($categories)){
                                echo "<h4>";
                                foreach ($categories as $c){
                                    echo "<span class='list-cat maincat'>$c</span>";
                                }
                                echo "</h4>";
                            }
                        ?>
                        <br>
                        <div class="list-number pag-p1-phone">
                            <ul>
                                <li><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $brand->getContactPhone(); ?></li>
                                <!--                        <li><i class="fa fa-envelope" aria-hidden="true"></i> --><?php //echo $brand->getContactEmail(); ?><!--</li>-->
                                <!--                        <li><i class="fa fa-user" aria-hidden="true"></i> Johny Depp</li>-->
                            </ul>
                        </div>
                    </div>
                </div>
                <!--<div class="pg-list-1-right">
                    <div class="list-enqu-btn pg-list-1-right-p1">
                        <ul>
                            <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i> Write Review</a> </li>
                            <li><a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i> Send SMS</a> </li>
                            <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i> Call Now</a> </li>
                            <li><a href="#" data-dismiss="modal" data-toggle="modal" data-target="#list-quo"><i class="fa fa-usd" aria-hidden="true"></i> Get Quotes</a> </li>
                        </ul>
                    </div>
                </div>-->
            </div>
        </div>
    </section>
	
	<div class="v3-list-ql">
        <div class="container">
            <div class="row">
                <div class="v3-list-ql-inn">
                    <ul>
                        <li class="active"><a href="#ld-abour"><i class="fa fa-user"></i> About</a>
                        </li>
                        <li><a href="#ld-ser"><i class="fa fa-cog"></i> Offers</a>
                        </li>
                        <li><a href="#ld-gal"><i class="fa fa-photo"></i> Gallery</a>
                        </li>
                        <li><a href="#ld-roo"><i class="fa fa-ticket"></i> Add to Favourite</a>
                        </li>
                        <!--<li><a href="#ld-vie"><i class="fa fa-street-view"></i> 360 View</a>
                        </li>-->
                        <li><a href="#ld-rew"><i class="fa fa-edit"></i> Write Review</a>
                        </li>
                        <li><a href="#ld-rer"><i class="fa fa-star-half-o"></i> User Review</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
	
	
    <section class="list-pg-bg">
        <div class="container">
            <div class="row">
                <div class="com-padd">
                    <div class="list-pg-lt list-page-com-p">
                        <!--LISTING DETAILS: LEFT PART 1-->
                        <div class="pglist-p1 pglist-bg pglist-p-com" id="ld-abour">
                            <div class="pglist-p-com-ti">
                                <h3><span>About</span> <?php echo $brand->getName(); ?></h3> </div>
                            <div class="list-pg-inn-sp">
<!--                                <div class="share-btn">-->
<!--                                    <ul>-->
<!--                                        <li><a href="#"><i class="fa fa-facebook fb1"></i> Share On Facebook</a> </li>-->
<!--                                        <li><a href="#"><i class="fa fa-twitter tw1"></i> Share On Twitter</a> </li>-->
<!--                                        <li><a href="#"><i class="fa fa-google-plus gp1"></i> Share On Google Plus</a> </li>-->
<!--                                    </ul>-->
<!--                                </div>-->
                                <p><?php echo $brand->getAbout(); ?> </p>
                            </div>
                        </div>

                        <!-- POLICIES -->
                        <div class="pglist-p1 pglist-bg pglist-p-com" id="ld-policies">
                            <div class="pglist-p-com-ti">
                                <h3><span>Policies</span></h3> </div>
                            <div class="list-pg-inn-sp">
                                <p><?php echo $brand->getPolicies(); ?> </p>
                            </div>
                        </div>

                        <!--END LISTING DETAILS: LEFT PART 1-->
                        <!--LISTING DETAILS: LEFT PART 2-->
                        <!--<div class="pglist-p2 pglist-bg pglist-p-com" id="ld-ser">
                            <div class="pglist-p-com-ti">
                                <h3><span>Services</span> Offered</h3> </div>
                            <div class="list-pg-inn-sp">
                                <p>Taj Luxury Hotels & Resorts provide 24-hour Business Centre, Clinic, Internet Access Centre, Babysitting, Butler Service in Villas and Seaview Suite, House Doctor on Call, Airport Butler Service, Lobby Lounge </p>
                                <div class="row pg-list-ser">
                                    <ul>
                                        <li class="col-md-4">
                                            <div class="pg-list-ser-p1"><img src="images/services/ser1.jpg" alt="" /> </div>
                                            <div class="pg-list-ser-p2">
                                                <h4>Restaurant and Bar</h4> </div>
                                        </li>
                                        <li class="col-md-4">
                                            <div class="pg-list-ser-p1"><img src="images/services/ser2.jpg" alt="" /> </div>
                                            <div class="pg-list-ser-p2">
                                                <h4>Room Booking</h4> </div>
                                        </li>
                                        <li class="col-md-4">
                                            <div class="pg-list-ser-p1"><img src="images/services/ser3.jpg" alt="" /> </div>
                                            <div class="pg-list-ser-p2">
                                                <h4>Corporate Events</h4> </div>
                                        </li>
                                        <li class="col-md-4">
                                            <div class="pg-list-ser-p1"><img src="images/services/ser4.jpg" alt="" /> </div>
                                            <div class="pg-list-ser-p2">
                                                <h4>Wedding Hall</h4> </div>
                                        </li>
                                        <li class="col-md-4">
                                            <div class="pg-list-ser-p1"><img src="images/services/ser5.jpg" alt="" /> </div>
                                            <div class="pg-list-ser-p2">
                                                <h4>Travel & Transport</h4> </div>
                                        </li>
                                        <li class="col-md-4">
                                            <div class="pg-list-ser-p1"><img src="images/services/ser6.jpg" alt="" /> </div>
                                            <div class="pg-list-ser-p2">
                                                <h4>All Amenities</h4> </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>-->
                        <!--END LISTING DETAILS: LEFT PART 2-->
                        <!--LISTING DETAILS: LEFT PART 3-->
                        <div class="pglist-p3 pglist-bg pglist-p-com" id="ld-gal">
                            <div class="pglist-p-com-ti">
                                <h3><span>Photo</span> Gallery</h3> </div>
                            <div class="list-pg-inn-sp">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#myCarousel" data-slide-to="1"></li>
                                        <li data-target="#myCarousel" data-slide-to="2"></li>
                                        <li data-target="#myCarousel" data-slide-to="3"></li>
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                        <div class="item active"> <img src="images/slider/1.jpg" alt="Los Angeles"> </div>
                                        <div class="item"> <img src="images/slider/2.jpg" alt="Chicago"> </div>
                                        <div class="item"> <img src="images/slider/3.jpg" alt="New York"> </div>
                                        <div class="item"> <img src="images/slider/4.jpg" alt="New York"> </div>
                                    </div>
                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev"> <i class="fa fa-angle-left list-slider-nav" aria-hidden="true"></i> </a>
                                    <a class="right carousel-control" href="#myCarousel" data-slide="next"> <i class="fa fa-angle-right list-slider-nav list-slider-nav-rp" aria-hidden="true"></i> </a>
                                </div>
                            </div>
                        </div>
                        <!--END LISTING DETAILS: LEFT PART 3-->
                        <!--LISTING DETAILS: LEFT PART 4-->

                        <!--END 360 DEGREE MAP: LEFT PART 8-->
                        <!--<div class="pglist-p3 pglist-bg pglist-p-com" id="ld-vie">
                            <div class="pglist-p-com-ti">
                                <h3><span>360 </span> Degree View</h3> </div>
                            <div class="list-pg-inn-sp list-360">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m0!4v1497026654798!6m8!1m7!1sIId_fF3cldIAAAQ7LuSTng!2m2!1d5.553927350344909!2d-0.2005543181775732!3f189.99!4f0!5f0.7820865974627469" allowfullscreen></iframe>
                            </div>
                        </div>-->
                        <!--END 360 DEGREE MAP: LEFT PART 8-->
                        <!--LISTING DETAILS: LEFT PART 6-->
                        <div class="pglist-p3 pglist-bg pglist-p-com" id="ld-rew">
                            <div class="pglist-p-com-ti">
                                <h3><span>Write Your</span> Reviews</h3> </div>
                            <div class="list-pg-inn-sp">
                                <div class="list-pg-write-rev">
                                    <?php if(isset($_SESSION['id'])): ?>
                                        <form class="col" action="" method="post" id="reviewForm">
                                            <p>Help the Fashion Community by droppng you review below. Your review might help someone find their new favorite fashion brand, or help people avoid a bad experience.</p>
                                            <div class="row">
                                                <div class="col s12">
                                                    <h4><b>Enter Rating:</b></h4>
                                                    <fieldset class="rating">
                                                        <input type="radio" id="star5" name="rating" value="5" />
                                                        <label class="full" for="star5" title="Awesome - 5 stars"></label>
                                                        <input type="radio" id="star4half" name="rating" value="4.5" />
                                                        <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                                        <input type="radio" id="star4" name="rating" value="4" />
                                                        <label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                                        <input type="radio" id="star3half" name="rating" value="3.5" />
                                                        <label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                                        <input type="radio" id="star3" name="rating" value="3" />
                                                        <label class="full" for="star3" title="Meh - 3 stars"></label>
                                                        <input type="radio" id="star2half" name="rating" value="2.5" />
                                                        <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                                        <input type="radio" id="star2" name="rating" value="2" />
                                                        <label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                                        <input type="radio" id="star1half" name="rating" value="1.5" />
                                                        <label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                        <input type="radio" id="star1" name="rating" value="1" />
                                                        <label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                                        <input type="radio" id="starhalf" name="rating" value="0.5" />
                                                        <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <div style="display: none;">
                                                <div class="row">
                                                    <div class="input-field col s6">
                                                        <input id="re_name" value="<?php echo $user->getFullName(); ?>" name="name" type="text" class="validate">
                                                        <label for="re_name">Full Name</label>
                                                    </div>
                                                    <div class="input-field col s6">
                                                        <input id="re_mob" name="mobile" value="<?php echo $user->getPhone(); ?>" type="number" class="validate">
                                                        <label for="re_mob">Mobile</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s6">
                                                        <input id="re_mail" name="email" value="<?php echo $user->getEmail(); ?>" type="email" class="validate">
                                                        <label for="re_mail">Email id</label>
                                                    </div>
                                                    <div class="input-field col s6">
                                                        <input id="re_city" name="city" value="<?php echo $user->getCity(); ?>" type="text" class="validate">
                                                        <label for="re_city">City</label>
                                                    </div>
                                                    <div>
                                                        <input id="re_uid" name="uid" value="<?php echo $user->getId(); ?>" type="text" class="validate">
                                                        <label for="re_uid">User id</label>
                                                    </div>
                                                    <input hidden name="brand_id" value="<?php echo $_GET['id']; ?>">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <textarea id="re_msg" name="review" class="materialize-textarea"></textarea>
                                                    <label for="re_msg">Write review</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12"> <a class="waves-effect waves-light btn-large full-btn" href="#!" id="submitReviewBtn">Submit Review</a> </div>
                                            </div>
                                        </form>
                                    <?php else: ?>
                                        <h2 style="padding: 2%;">Please <a href="https://demofashant.com?returnURL=listing-details.php?id=<?php echo $_GET['id']; ?>" style="font-size: 30px;">login</a> to write a review.</h2>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!--END LISTING DETAILS: LEFT PART 6-->
                        <!--LISTING DETAILS: LEFT PART 5-->
                        <div class="pglist-p3 pglist-bg pglist-p-com" id="ld-rer">
                            <?php if(!empty($reviews)): ?>
                                <div class="pglist-p-com-ti">
                                    <h3><span>User</span> Reviews</h3> </div>
                                <div class="list-pg-inn-sp">
                                    <div class="lp-ur-all">
                                        <div class="lp-ur-all-left">
                                            <div class="lp-ur-all-left-1">
                                                <div class="lp-ur-all-left-11">Excellent</div>
                                                <div class="lp-ur-all-left-12">
                                                    <div class="lp-ur-all-left-13" style="width: <?php echo $five_star; ?>%;"></div>
                                                </div>
                                            </div>
                                            <div class="lp-ur-all-left-1">
                                                <div class="lp-ur-all-left-11">Good</div>
                                                <div class="lp-ur-all-left-12">
                                                    <div class="lp-ur-all-left-13 lp-ur-all-left-Good" style="width: <?php echo $four_star; ?>%;"></div>
                                                </div>
                                            </div>
                                            <div class="lp-ur-all-left-1">
                                                <div class="lp-ur-all-left-11">Satisfactory</div>
                                                <div class="lp-ur-all-left-12">
                                                    <div class="lp-ur-all-left-13 lp-ur-all-left-satis" style="width: <?php echo $three_star; ?>%;"></div>
                                                </div>
                                            </div>
                                            <div class="lp-ur-all-left-1">
                                                <div class="lp-ur-all-left-11">Below Average</div>
                                                <div class="lp-ur-all-left-12">
                                                    <div class="lp-ur-all-left-13 lp-ur-all-left-below" style="width: <?php echo $two_star; ?>%;"></div>
                                                </div>
                                            </div>
                                            <div class="lp-ur-all-left-1">
                                                <div class="lp-ur-all-left-11">Below Average</div>
                                                <div class="lp-ur-all-left-12">
                                                    <div class="lp-ur-all-left-13 lp-ur-all-left-poor" style="width: <?php echo $one_star; ?>%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lp-ur-all-right">
                                            <h5>Overall Ratings</h5>
                                            <p><span><?php echo $rating; ?> <i class="fa fa-star" aria-hidden="true"></i></span> based on <?php echo $num_reviews; ?> reviews</p>
                                        </div>
                                    </div>
                                    <div class="lp-ur-all-rat">
                                        <h5>Reviews</h5>

                                        <ul>
                                            <?php getListingReviews($reviews); ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="pglist-p-com-ti">
                                    <h3>There are no reviews of this brand yet...</h3>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!--END LISTING DETAILS: LEFT PART 5-->
                    </div>
                    <!--                <div class="list-pg-rt">-->
                    <!---->
                    <!--                    <div class="dir-alp-con-right-2">-->
                    <!--                        <div class="rightbox1"> <img src="images/zara-store_1456400587.jpg" class="img-responsive"> </div>-->
                    <!--                        <div class="clearfix"></div>-->
                    <!--                        <div class="rightboxhading">-->
                    <!--                            <h4>Zara</h4>-->
                    <!--                            <h5>1st Floor, Next to GAP</h5>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                    <div class="dir-alp-con-right-2">-->
                    <!--                        <div class="rightbox1"> <img src="images/download.jpg" class="img-responsive"> </div>-->
                    <!--                        <div class="clearfix"></div>-->
                    <!--                        <div class="rightboxhading">-->
                    <!--                            <h4>Zara</h4>-->
                    <!--                            <h5>1st Floor, Next to GAP</h5>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                    <div class="dir-alp-con-right-2">-->
                    <!--                        <div class="rightbox1"> <img src="images/image.jpg" class="img-responsive"> </div>-->
                    <!--                        <div class="clearfix"></div>-->
                    <!--                        <div class="rightboxhading">-->
                    <!--                            <h4>Zara</h4>-->
                    <!--                            <h5>1st Floor, Next to GAP</h5>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!---->
                    <!--                </div>-->
					
					<div class="list-pg-rt">
						<table>
							<tr>
								<th>Price Category</th>
								<td><?php echo $pcat; ?></td>
							</tr>
							<tr>
								<th>Items in store</th>
								<td><?php echo $taggings; ?></td>
							</tr>
							<tr>
								<th>Today</th>
								<td><?php echo $opening_hour; ?></td>
							</tr>
						</table>
					</div>
                </div>
            </div>
        </div>
    </section>
<?php else: ?>
    <section class="list-pg-bg" style="padding-top: 10%; padding-bottom: 10%;">
        <div class="container">
            <h2>Sorry, the brand must be deleted.</h2>
        </div>
    </section>
<?php endif;; ?>
<!--MOBILE APP-->
<!--<section class="web-app com-padd">
    <div class="container">
        <div class="row">
            <div class="col-md-6 web-app-img"> <img src="images/mobile.png" alt="" /> </div>
            <div class="col-md-6 web-app-con">
                <h2>Looking for the Best Service Provider? <span>Get the App!</span></h2>
                <ul>
                    <li><i class="fa fa-check" aria-hidden="true"></i> Find nearby listings</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i> Easy service enquiry</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i> Listing reviews and ratings</li>
                    <li><i class="fa fa-check" aria-hidden="true"></i> Manage your listing, enquiry and reviews</li>
                </ul> <span>We'll send you a link, open it on your phone to download the app</span>
                <form>
                    <ul>
                        <li>
                            <input type="text" placeholder="+01" /> </li>
                        <li>
                            <input type="number" placeholder="Enter mobile number" /> </li>
                        <li>
                            <input type="submit" value="Get App Link" /> </li>
                    </ul>
                </form>
                <a href="#"><img src="images/android.png" alt="" /> </a>
                <a href="#"><img src="images/apple.png" alt="" /> </a>
            </div>
        </div>
    </div>
</section>-->
<!--FOOTER SECTION-->
<?php include_once "partials/Footer.php"; ?>
<!--QUOTS POPUP-->
<section>
    <!-- GET QUOTES POPUP -->
    <div class="modal fade dir-pop-com" id="list-quo" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header dir-pop-head">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Get a Quotes</h4>
                    <!--<i class="fa fa-pencil dir-pop-head-icon" aria-hidden="true"></i>-->
                </div>
                <div class="modal-body dir-pop-body">
                    <form method="post" class="form-horizontal">
                        <!--LISTING INFORMATION-->
                        <div class="form-group has-feedback ak-field">
                            <label class="col-md-4 control-label">Full Name *</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="fname" placeholder="" required> </div>
                        </div>
                        <!--LISTING INFORMATION-->
                        <div class="form-group has-feedback ak-field">
                            <label class="col-md-4 control-label">Mobile</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="mobile" placeholder=""> </div>
                        </div>
                        <!--LISTING INFORMATION-->
                        <div class="form-group has-feedback ak-field">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="email" placeholder=""> </div>
                        </div>
                        <!--LISTING INFORMATION-->
                        <div class="form-group has-feedback ak-field">
                            <label class="col-md-4 control-label">Message</label>
                            <div class="col-md-8 get-quo">
                                <textarea class="form-control"></textarea>
                            </div>
                        </div>
                        <!--LISTING INFORMATION-->
                        <div class="form-group has-feedback ak-field">
                            <div class="col-md-6 col-md-offset-4">
                                <input type="submit" value="SUBMIT" class="pop-btn"> </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- GET QUOTES Popup END -->
</section>
<!--SCRIPT FILES-->
<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/materialize.min.js" type="text/javascript"></script>
<script src="js/custom.js"></script>
<script src="js/formSubmit.js"></script>

<script>
    // Redirect to review section if review button was pressed on another page
    if(window.location.href.indexOf("review=true") > -1) {
        window.location.hash = "ld-rew";
    }
</script>

</body>

</html>