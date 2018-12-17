<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 22/08/2018
 * Time: 16:42
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

<!----header-start---->
<div class="navtop <?php echo basename($_SERVER['PHP_SELF'], ".php"); ?>">
    <div class="container">
        <div class="topnav">
            <div class="col-sm-2">
                <div class="logodiv"> <a href="index.php"><img class="homelgo" src="images/logo111.png"><img class="otherlgo" src="images/logo11.png"></a> </div>
            </div>
            <div class="col-sm-2">
                <!--<div class="left_part">
                    <div class="social_icon">
                        <ul>
                            <li><a href="httpss://twitter.com/fashant_ae"><i class="flipt fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="httpss://www.facebook.com/Fashant"><i class="flipt fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="httpss://www.instagram.com/fashant_ae/"><i class="flipt fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>-->
            </div>
            <div class="col-sm-8">
                <div class="mid_part">
                    <div class="menu-fullm1">

                        <!--<li class="services"><a href="https://demofashant.com/FSBlogs/forums/">Fashion Advice</a></li>-->
                        <?php if($user): ?>
                            <li class="downlod_app has-dropdown">
                                <a href=""><?php echo $user->getFullName(); ?></a>
                                <ul class="sub-menu">
                                    <li><a href="https://demofashant.com/customerprofile.php">Profile</a></li>
                                    <li><a href="https://demofashant.com/customerProfile.php">Invite Friend</a></li>
                                    <li><a href="https://demofashant.com/logout.php">Logout</a></li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="authorization-link sign_in"><a href="#" data-toggle="modal" data-target="#signin"> Sign In </a></li>
                            <li class="sign_up"><a href="#" data-toggle="modal" data-target="#signup">Create an Account</a></li>
                        <?php endif; ?>

                        <!--<li class="add_list"><a href="#" class="v3-menu-sign"><i class="fa fa-plus"></i>Add Listing</a> </li>-->
						<li class="downlod_app has-dropdown">
                            <a href="">Explore</a>
                            <ul class="sub-menu">
                                <li><a href="https://demofashant.com/">Fashant for Business</a></li>
                                <li><a href="https://demofashant.com/FSBlogs/">Fashant Blogs</a></li>
                                <li><a href="https://demofashant.com/fourm.html">Fashant Forum</a></li>
                                <li><a href="https://demofashant.com/about-us.html">About us </a></li>
                                <li><a href="https://demofashant.com/contact-us.html">Contact us </a></li>
                            </ul>
                        </li>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!----header-off------>
<div class="clearfix"></div>



<section>
    <!-- GET QUOTES POPUP -->
    <div class="modal fade dir-pop-com" id="signin" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header dir-pop-head">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body dir-pop-body">
                    <section class="tz-register">
                        <div class="log-in-pop">
                            <div class="log-in-pop-left">
                                <h1>Hello... <span></span></h1>
                                <p>Don't have an account? Let's create one!. It takes less then a minute.</p>
                                <h4>Login with social media</h4>
                                <ul>
                                    <li><a href="#"><i class="mdi mdi-facebook"></i> Facebook</a>
                                    </li>
                                    <li><a href="#"><i class="mdi mdi-google"></i> Google+</a>
                                    </li>
                                    <li><a href="#"><i class="mdi mdi-twitter"></i> Twitter</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="log-in-pop-right">
                                <a href="#" class="pop-close" data-dismiss="modal"><img src="images/cancel.png" alt="" />
                                </a>
                                <h4>Login</h4>
                                <p>Don't have an account? Let's create one!. It takes less then a minute.</p>
                                <div id="error_container"></div>
                                <form class="s12" id="login-form" action="" method="post" role="form">
                                    <div>
                                        <div class="input-field s12">
                                            <input type="text" id="username" name="username" data-ng-model="name1" class="validate" tabindex="1">
                                            <label>User name</label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="input-field s12">
                                            <input type="password" id="password" name="password" class="validate" tabindex="2">
                                            <label>Password</label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="input-field s4">
                                            <input type="submit" id="loginBtn" name="loginBtn" value="Login" class="waves-effect waves-light log-in-btn" tabindex="3"> </div>
                                    </div>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade dir-pop-com" id="signup" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header dir-pop-head">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body dir-pop-body">
                    <section class="tz-register">
                        <div class="log-in-pop">
                            <div class="log-in-pop-left">
                                <h1>Hello... <span></span></h1>
                                <p>Don't have an account? Let's create one!. It takes less then a minute.</p>
                                <h4>Sign up with social media</h4>
                                <ul>
                                    <li><a href="#"><i class="mdi mdi-facebook"></i> Facebook</a>
                                    </li>
                                    <li><a href="#"><i class="mdi mdi-google"></i> Google+</a>
                                    </li>
                                    <li><a href="#"><i class="mdi mdi-twitter"></i> Twitter</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="log-in-pop-right">
                                <a href="#" class="pop-close" data-dismiss="modal"><img src="images/cancel.png" alt="" />
                                </a>
                                <h4>Sign up</h4>
                                <p>Don't have an account? Let's create one!. It takes less then a minute.</p>
                                <div id="error_container"></div>
<!--                                <form class="s12 validate" id="register-form" action="httpss://fashant.us18.list-manage.com/subscribe/post?u=975020543941eb0c4d39da173&amp;id=704c45e655" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" role="form" target="_blank" novalidate>-->
                                <form class="s12 validate" id="register-form" action="" method="post" role="form">
                                    <div>
                                        <div class="input-field s12">
                                            <!--<input type="text" id="firstname" name="firstname" data-ng-model="name1" class="validate" tabindex="1">-->
											<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
                                            <label>First name</label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="input-field s12">
                                            <!--<input type="text" id="lastname" name="lastname" data-ng-model="name2" class="validate" tabindex="1">-->
											<input type="text" value="" name="LNAME" class="" id="mce-LNAME">
                                            <label>Last Name</label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="input-field s12">
                                            <!--<input type="text" id="email" name="email" data-ng-model="email" class="validate" tabindex="1">-->
											<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                                            <label>Email</label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="input-field s12">
                                            <input type="password" id="register_password" name="password" class="validate" tabindex="2">
<!--											<input type="text" value="" name="MMERGE3" class="" id="mce-MMERGE3">-->
                                            <label>Password</label>
                                        </div>
                                    </div>
									<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_975020543941eb0c4d39da173_704c45e655" tabindex="-1" value=""></div>
                                    <div>
                                        <div class="input-field s4">
                                            <input type="submit" id="signupBtn" name="signupBtn" value="Sign Up" class="waves-effect waves-light log-in-btn" tabindex="3">
                                            <input type="submit" id="forgetpass" name="forgetpass" value="Forget Password" class="waves-effect waves-light log-in-btn" tabindex="3">
<!--                                            <input type="submit" name="subscribe" id="mc-embedded-subscribe" value="Sign Up" class="waves-effect waves-light log-in-btn" tabindex="3">-->
                                        </div>
                                    </div>

                                </form>
								
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade dir-pop-com" id="list-quo" role="dialog">
        <div class="modal-dialog" style="margin-top:20%;">
            <div class="modal-content">
                <div class="modal-header dir-pop-head">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Get a Quotes</h4>
                    <!--<i class="fa fa-pencil dir-pop-head-icon" aria-hidden="true"></i>-->
                </div>
                <div class="modal-body dir-pop-body">
                    <form method="post" class="form-horizontal">
                        <h1>Share this brand with a friend</h1>
                        <br><br>
                        <!--LISTING INFORMATION-->
                        <div class="form-group has-feedback ak-field">
                            <label class="col-md-4 control-label">Full Name *</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="fname" placeholder="" required>
                            </div>
                        </div>
                        <!--LISTING INFORMATION-->
                        <div class="form-group has-feedback ak-field">
                            <label class="col-md-4 control-label">Mobile</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="mobile" placeholder="">
                            </div>
                        </div>
                        <!--LISTING INFORMATION-->
                        <div class="form-group has-feedback ak-field">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="email" placeholder="">
                            </div>
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
                                <input type="submit" value="SUBMIT" class="pop-btn">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- GET QUOTES Popup END -->
</section>