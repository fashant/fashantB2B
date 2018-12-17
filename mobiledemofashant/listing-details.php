<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;
$util_dir = "{$base_dir}resources{$ds}utilities.php";
include_once $util_dir;
if (isset($_SESSION['id'])) {
    $user = getUser($_SESSION['id']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Fashant-category</title>    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">    <!-- Custom styles for this template -->
    <link href="css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="category-details"><!-- Navigation --><?php include_once "partials/navigation.php"; ?><!-- Page Content -->
<section class="search-filter">
    <div class="container">
        <div class="filter-content">
            <form>
                <div class="input-field search-img"><input type="search"></div>
            </form>
        </div>
    </div>
</section><?php if (isset($_GET['id']) && brandExist($_GET['id'])): ?><?php $id = $_GET['id'];
    $brand = getBrand($id);
    $reviews = getReviews($id);
    $background = "../images/list-deta/ecomm.png";
    $ds = DIRECTORY_SEPARATOR;
    $base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;
    $img_folder = $base_dir . "admindemofashant/uploads/brands/$brand->ukey/$id/logo.jpg";
    $logo = "images/slider/1.jpg";
    if (file_exists($img_folder)) {
        $logo = "https://admin.demofashant.com/uploads/brands/$brand->ukey/$id/logo.jpg";
    }
    $categories = getBrandsCategories($brand->getId(), 0);
    $cat = getCategoryText($categories);
    $pcat = getPriceCategoryName($brand->getPriceCategory());
    if (!$pcat) {
        $pcat = $brand->getPriceCategory();
    }
    $secondary = getBrandsCategories($id, 2);
    $taggings = getCategoryText($secondary);
    $opening_hour = getTodaysOpeningHour($brand);    // RATINGS AND REVIEWS    if(!empty($reviews)) {        $rating = 0;        $num_reviews = sizeof($reviews);        $one_star = 0;        $two_star = 0;        $three_star = 0;        $four_star = 0;        $five_star = 0;        foreach ($reviews as $rev) {            $r = $rev->getRating();            $rating += $r;            switch ($r) {                case 1:                    $one_star += 1;                    break;                case 2:                    $two_star += 1;                    break;                case 3:                    $three_star += 1;                    break;                case 4:                    $four_star += 1;                    break;                case 5:                    $five_star += 1;                    break;            }        }        $one_star = ($one_star / $num_reviews) * 100;        $two_star = ($two_star / $num_reviews) * 100;        $three_star = ($three_star / $num_reviews) * 100;        $four_star = ($four_star / $num_reviews) * 100;        $five_star = ($five_star / $num_reviews) * 100;        $rating = round($rating / $num_reviews, 1, PHP_ROUND_HALF_DOWN);        $star_rating = round($rating, 0, PHP_ROUND_HALF_DOWN);    }    ?>
    <section class="brand-banner">
        <div class="container-fluid no-padding">
            <div class="banner-cate"><img src="img/mobile-cate-details-banner.png"/></div>
        </div>
    </section>
    <section class="Shop-details">
        <div class="container">
            <div class="fashion-content shop-name"><label><?php echo $brand->getShoppingCenter(); ?>
                    <br><?php echo $brand->getStoreLocation(); ?></label></div>
            <div class="star-rate">                <?php for ($i = 0; $i < $star_rating; $i++) {
                    echo "<img src='img/star-yellow.png' />";
                } ?>            </div>
            <div class="tree-btn">
                <button class="button btnPush btnBlueGreen">MEN</button>
                <button class="button btnPush btnBlueGreen">WOMEN</button>
                <button class="button btnPush btnBlueGreen">KIDS</button>
            </div>
            <div class="shop-info-list">
                <ul>
                    <li><label>Price Category:</label>
                        <p><?php echo $pcat; ?></p></li>
                    <li><label>Items in store:</label>
                        <p><?php echo $cat; ?></p></li>
                    <li><label>Today:</label>
                        <p><?php echo $opening_hour; ?></p></li>
                    <li><label>Contact:</label>
                        <p><?php echo $brand->getContactPhone(); ?></p></li>
                </ul>
            </div>
        </div>
    </section>
    <section class="about-brand-single">
        <div class="container">
            <div class="brand-text"><h3>ABOUT <?php echo strtoupper($brand->getName()); ?></h3>
                <p><?php echo $brand->getAbout(); ?></p></div>
            <hr class="fashant-hr"></hr>
            <div class="brand-text"><h3>POLICIES</h3>
                <p><?php echo $brand->getPolicies(); ?></p></div>
        </div>
    </section>
    <section class="location-slider brand-cloths-slider">
        <div class="container-fluid no-padding">
            <div class="location-place">
                <div id="carouselExampleIndicatorss" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <div class="carousel-captions">
                                <div class="city-img"><img src="img/adidas-banner-1.png"/></div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-captions">
                                <div class="city-img"><img src="img/adidas-banner-1.png"/></div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-captions">
                                <div class="city-img"><img src="img/adidas-banner-1.png"/></div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicatorss" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span>
                    </a> <a class="carousel-control-next" href="#carouselExampleIndicatorss" role="button"
                            data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span
                                class="sr-only">Next</span> </a></div>
            </div>
        </div>
    </section>
    <section class="review-section">
    <div class="container">
        <div class="brand-text">                <?php if (isset($_SESSION['id'])): ?>
                <div class="log-in-pop-right">
                    <div class="contentbg"><h4>Write Your Reviews</h4>
                        <p>Help the Fashion Community by droppng you review below. Your review might help someone find
                            their new favorite fashion brand, or help people avoid a bad experience.</p>
                        <div id="error_container"></div>
                    </div>
                    <div class="customform">
                        <form class="s12" id="reviewForm" action="" method="post" role="form">
                            <div class="row">
                                <div class="input-field s12"><b>Enter Rating:</b>
                                    <div class="clearfix"></div>
                                    <fieldset class="rating"><input type="radio" id="star5" name="rating" value="5"/>
                                        <label class="full" for="star5" title="Awesome - 5 stars"></label> <input
                                                type="radio" id="star4half" name="rating" value="4.5"/> <label
                                                class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                        <input type="radio" id="star4" name="rating" value="4"/> <label class="full"
                                                                                                        for="star4"
                                                                                                        title="Pretty good - 4 stars"></label>
                                        <input type="radio" id="star3half" name="rating" value="3.5"/> <label
                                                class="half" for="star3half" title="Meh - 3.5 stars"></label> <input
                                                type="radio" id="star3" name="rating" value="3"/> <label class="full"
                                                                                                         for="star3"
                                                                                                         title="Meh - 3 stars"></label>
                                        <input type="radio" id="star2half" name="rating" value="2.5"/> <label
                                                class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                        <input type="radio" id="star2" name="rating" value="2"/> <label class="full"
                                                                                                        for="star2"
                                                                                                        title="Kinda bad - 2 stars"></label>
                                        <input type="radio" id="star1half" name="rating" value="1.5"/> <label
                                                class="half" for="star1half" title="Meh - 1.5 stars"></label> <input
                                                type="radio" id="star1" name="rating" value="1"/> <label class="full"
                                                                                                         for="star1"
                                                                                                         title="Sucks big time - 1 star"></label>
                                        <input type="radio" id="starhalf" name="rating" value="0.5"/> <label
                                                class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                    </fieldset>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12"><textarea id="re_msg" name="review"
                                                                           placeholder="Write review"
                                                                           class="materialize-textarea"></textarea>
                                </div>
                            </div>
                            <div style="display: none;">
                                <div class="row">
                                    <div class="input-field col s6"><input id="re_name"
                                                                           value="<?php echo $user->getFullName(); ?>"
                                                                           name="name" type="text" class="validate">
                                        <label for="re_name">Full Name</label></div>
                                    <div class="input-field col s6"><input id="re_mob" name="mobile"
                                                                           value="<?php echo $user->getPhone(); ?>"
                                                                           type="number" class="validate"> <label
                                                for="re_mob">Mobile</label></div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6"><input id="re_mail" name="email"
                                                                           value="<?php echo $user->getEmail(); ?>"
                                                                           type="email" class="validate"> <label
                                                for="re_mail">Email id</label></div>
                                    <div class="input-field col s6"><input id="re_city" name="city"
                                                                           value="<?php echo $user->getCity(); ?>"
                                                                           type="text" class="validate"> <label
                                                for="re_city">City</label></div>
                                    <div><input id="re_uid" name="uid" value="<?php echo $user->getId(); ?>" type="text"
                                                class="validate"> <label for="re_uid">User id</label></div>
                                    <input hidden name="brand_id" value="<?php echo $_GET['id']; ?>"></div>
                            </div>
                            <div class="">
                                <div class="input-field s12"><input type="button" style="color: white;"
                                                                    id="submitReviewBtn" name="reviewbtn"
                                                                    value="Submit Review"
                                                                    class="waves-effect waves-light log-in-btn"
                                                                    tabindex="3"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="clearfix"></div>                <?php else: ?>                <label>Please <a
                        href="https://m.demofashant.com?returnURL=listing-details.php?id=<?php echo $_GET['id']; ?>"><span
                            style="color: dodgerblue;">login</span></a><br>to write a
                review.</label>                <?php endif; ?>            </div>
        <hr class="fashant-hr"></hr>
        <div class="brand-text"><h3>USER REVIEWS</h3></div>
        <div class="col-xs-7">
            <div class="fashant-progress-bar">
                <div class="fas-progress-bar"><p>Excellent</p>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                             aria-valuemax="100" style="width:<?php echo $five_star; ?>%"></div>
                    </div>
                </div>
                <div class="fas-progress-bar"><p>Good</p>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                             aria-valuemax="100" style="width:<?php echo $four_star; ?>%"></div>
                    </div>
                </div>
                <div class="fas-progress-bar"><p>Satisfactory</p>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                             aria-valuemax="100" style="width:<?php echo $three_star; ?>%"></div>
                    </div>
                </div>
                <div class="fas-progress-bar"><p>Below Average</p>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                             aria-valuemax="100" style="width:<?php echo $two_star; ?>%"></div>
                    </div>
                </div>
                <div class="fas-progress-bar"><p>Below Average</p>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                             aria-valuemax="100" style="width:<?php echo $one_star; ?>%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-5">
            <div class="rating-star"><span><?php echo $rating; ?></span>
                <p>based on<br><?php echo $num_reviews; ?> reviews</p></div>
        </div>
        <div class="col-xs-12" style="padding-top: 5%;"><h5>Reviews</h5>
            <ul>                    <?php getListingReviews($reviews); ?>                </ul>
        </div>
    </div>    </section><?php else: ?>
<section class="list-pg-bg" style="padding-top: 10%; padding-bottom: 10%;">
    <div class="container"><h2>Sorry, the brand must be deleted.</h2></div>
</section><?php endif;; ?><?php include_once "partials/footer.php"; ?><!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://demofashant.com/js/formSubmit.js?2400"></script>
<script src="https://demofashant.com/js/custom.js?2400"></script>
</body>
</html>