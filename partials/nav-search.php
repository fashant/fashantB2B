<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 22/08/2018
 * Time: 22:11
 */

session_start();

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;

$user = false;

if(isset($_SESSION['id'])){
    $user = getUser($_SESSION['id']);
}


?>

<section class="bottomMenu dir-il-top-fix <?php echo basename($_SERVER['PHP_SELF'], ".php"); ?>">
    <div class="container top-search-main">
        <div class="row">
            <div class="ts-menu">
                <!--SECTION: LOGO-->
                <!--<div class="ts-menu-1"> <a href="index.html"><img src="images/logo11.png" alt=""> </a> </div>---->
                <!--SECTION: BROWSE CATEGORY(NOTE:IT'S HIDE ON MOBILE & TABLET VIEW)-->
                <!--<div class="ts-menu-2"><a href="#" class="t-bb">All Pages <i class="fa fa-angle-down" aria-hidden="true"></i></a>--->
                <!--SECTION: BROWSE CATEGORY-->
                <div class="cat-menu cat-menu-1">
                    <div class="dz-menu">
                        <div class="dz-menu-inn">
                            <h4>Frontend Pages</h4>
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li><a href="index-1.html">Home 1</a></li>
                                <li><a href="list.html">All Listing</a></li>
                                <li><a href="listing-details.html">Listing Details </a> </li>
                                <li><a href="price.html">Add Listing</a> </li>
                                <li><a href="list-lead.html">Lead Listing</a></li>
                                <li><a href="list-grid.html">Listing Grid View</a></li>
                            </ul>
                        </div>
                        <div class="dz-menu-inn">
                            <h4>Frontend Pages</h4>
                            <ul>
                                <li><a href="new-business.html"> New Listings </a> </li>
                                <li><a href="nearby-listings.html">Nearby Listings</a> </li>
                                <li><a href="customer-reviews.html"> Customer Reviews</a> </li>
                                <li><a href="trendings.html"> Top Trendings</a> </li>
                                <li><a href="how-it-work.html"> How It Work</a> </li>
                                <li><a href="advertise.html"> Advertise with us</a> </li>
                                <li><a href="price.html"> Price Details</a> </li>
                            </ul>
                        </div>
                        <div class="dz-menu-inn">
                            <h4>Frontend Pages</h4>
                            <ul>
                                <li><a href="about-us.html"> About Us</a> </li>
                                <li><a href="customer-reviews.html"> Customer Reviews</a> </li>
                                <li><a href="contact-us.html"> Contact Us</a> </li>
                                <li><a href="blog.html"> Blog Post</a> </li>
                                <li><a href="blog-content.html"> Blog Details</a> </li>
                                <li><a href="elements.html"> All Elements </a> </li>
                                <li><a href="shop-listing-details.html"> Shop Details </a> </li>
                                <li><a href="property-listing-details.html"> Property Details </a> </li>
                            </ul>
                        </div>
                        <div class="dz-menu-inn">
                            <h4>Dashboard Pages</h4>
                            <ul>
                                <li><a href="dashboard.html"> Dashboard</a> </li>
                                <li><a href="db-invoice.html"> Invoice</a> </li>
                                <li><a href="db-setting.html"> User Setting</a> </li>
                                <li><a href="db-all-listing.html"> All Listings</a> </li>
                                <li><a href="db-listing-add.html"> Add New Listing</a> </li>
                                <li><a href="db-review.html"> Listing Reviews</a> </li>
                                <li><a href="db-payment.html"> Listing Payments </a> </li>
                            </ul>
                        </div>
                        <div class="dz-menu-inn">
                            <h4>Dashboard Pages</h4>
                            <ul>
                                <li><a href="register.html"> User Register</a> </li>
                                <li><a href="login.html"> User Login</a> </li>
                                <li><a href="forgot-pass.html"> Forgot Password</a> </li>
                                <li><a href="db-message.html"> Messages</a> </li>
                                <li><a href="db-my-profile.html"> Dashboard Profile</a> </li>
                                <li><a href="db-post-ads.html"> Post Ads </a> </li>
                                <li><a href="db-invoice-download.html"> Download Invoice </a> </li>
                            </ul>
                        </div>
                        <div class="dz-menu-inn lat-menu">
                            <h4>Admin Panel Pages</h4>
                            <ul>
                                <li><a target="_blank" href="admin.html"> Admin</a> </li>
                                <li><a target="_blank" href="admin-all-listing.html"> All Listing</a> </li>
                                <li><a target="_blank" href="admin-all-users.html"> All Users</a> </li>
                                <li><a target="_blank" href="admin-analytics.html"> Analytics</a> </li>
                                <li><a target="_blank" href="admin-ads.html"> Advertisement</a> </li>
                                <li><a target="_blank" href="admin-setting.html"> Admin Setting </a> </li>
                                <li><a target="_blank" href="admin-payment.html"> Payments </a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="dir-home-nav-bot">
                        <ul>
                            <li>A few reasons you’ll love Online Business Directory <span>Call us on: +01 6214 6548</span> </li>
                            <li><a href="advertise.html" class="waves-effect waves-light btn-large"><i class="fa fa-bullhorn"></i> Advertise with us</a> </li>
                            <li><a href="db-listing-add.html" class="waves-effect waves-light btn-large"><i class="fa fa-bookmark"></i> Add your business</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--SECTION: SEARCH BOX-->
			<div class="ts-menu-2">
				<div class="logodiv"> <a href="index.php"><img class="otherlgo" src="images/logo111.png"></a> </div>
			</div>
            <div class="ts-menu-3">
                <div class="">
                    <form class="tourz-search-form tourz-top-search-form">
                        <div class="input-field">
                            <!--<input type="text" id="top-select-city" class="autocomplete" disabled value="Dubai">
                            <label for="top-select-city">location</label>-->
							<select class="location-dropdown" id="Location">
                                <option>All Malls</option>
                                <option>Dubai Mall</option>
                                <option>Mall of the Emirates</option>
                                <option>Deira City Center</option>
                                <option>Dubai Festival City</option>
                                <option>Burjuman</option>
                                <option>Wafi Mall</option>
                                <option>Mercato</option>
							</select>
                        </div>
                        <div class="input-field">
                            <input type="text" id="top-select-search" class="autocomplete">
                            <label for="top-select-search" class="search-hotel-type">Search Fashion Brands, Stores....</label>
                        </div>
                        <div class="input-field" onclick="window.location.href = 'https://demofashant.com/list.php?f=&q=' + document.getElementById('top-select-search').value;">
                            <input type="button" value="" class="waves-effect waves-light tourz-top-sear-btn">
                        </div>
                    </form>
                </div>
                <?php if(!$user): ?>
				<div class="v3-top-ri">
                    <ul>
                        <li><a href="login.php" class="v3-menu-sign"><i class="fa fa-sign-in"></i> Sign In</a> </li>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
            <!--SECTION: REGISTER,SIGNIN AND ADD YOUR BUSINESS-->
            <div class="ts-menu-4 listmenu">
				<div class="mid_part">
					<div class="menu-fullm1">
                        <?php if($user): ?>
                            <li class="downlod_app has-dropdown">
                                <a href=""><?php echo $user->getFullName(); ?></a>
                                <ul class="sub-menu">
                                    <li><a href="http://demofashant.com/customerprofile.php">Profile</a></li>
                                    <li><a href="http://demofashant.com/customerProfile.php">Invite Friend</a></li>
                                    <li><a href="http://demofashant.com/logout.php">Logout</a></li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="sign_up"><a href="#" data-toggle="modal" data-target="#signup">Create an Account</a></li>
                        <?php endif; ?>
						<li class="downlod_app has-dropdown">
                            <a href="">Explore</a>
                            <ul class="sub-menu">
                                <li><a href="http://demofashant.com/">Fashant for Business</a></li>
                                <li><a href="http://demofashant.com/FSBlogs/">Fashant Blogs</a></li>
                                <li><a href="http://demofashant.com/fourm.html">Fashant Forum</a></li>
                                <li><a href="http://demofashant.com/about-us.html">About us </a></li>
                                <li><a href="http://demofashant.com/contact-us.html">Contact us </a></li>
                            </ul>
                        </li>
                    </div>
                </div>
            </div>
            <!--MOBILE MENU ICON:IT'S ONLY SHOW ON MOBILE & TABLET VIEW-->
            <div class="ts-menu-5"><span><i class="fa fa-bars" aria-hidden="true"></i></span> </div>
            <!--MOBILE MENU CONTAINER:IT'S ONLY SHOW ON MOBILE & TABLET VIEW-->
            <div class="mob-right-nav" data-wow-duration="0.5s">
                <div class="mob-right-nav-close"><i class="fa fa-times" aria-hidden="true"></i> </div>
                <h5>Business</h5>
                <ul class="mob-menu-icon">
                    <li><a href="price.html">Add Business</a> </li>
                    <li><a href="register.html">Register</a> </li>
                    <li><a href="login.html">Sign In</a> </li>
                </ul>
                <h5>All Categories</h5>
                <ul>
                    <li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Help Services</a> </li>
                    <li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Appliances Repair & Services</a> </li>
                    <li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Furniture Dealers</a> </li>
                    <li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Packers and Movers</a> </li>
                    <li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Pest Control </a> </li>
                    <li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Solar Product Dealers</a> </li>
                    <li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Interior Designers</a> </li>
                    <li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Carpenters</a> </li>
                    <li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Plumbing Contractors</a> </li>
                    <li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Modular Kitchen</a> </li>
                    <li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Internet Service Providers</a> </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
</section>
