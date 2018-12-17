<?php
//If the HTTPS is not found to be "on"
if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    //Tell the browser to redirect to the HTTPS URL.
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
    //Prevent the rest of the script from executing.
    exit;
}
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'on');

if (isset($_GET['returnURL'])) {
    $returnURL = $_GET['returnURL'];
} else {
    $returnURL = "";
} ?><?php if (isset($_SESSION['id'])): ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">        window.location.href = "http://admin.demofashant.com/listingPanel.php";    </script><?php endif; ?><!DOCTYPE html>
<html lang="en">
<head><title>Login</title>    <!-- META TAGS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    <!-- FAV ICON(BROWSER TAB ICON) -->
    <link rel="shortcut icon" href="images/fav.ico" type="image/x-icon">    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:500,700" rel="stylesheet">
    <!-- FONTAWESOME ICONS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">    <!-- ALL CSS FILES -->
    <link href="css/materialize.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
    <link href="css/responsive.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>    <![endif]-->
    <style>        html, body {
            height: 100%;
        }

        .tz-register {
            background: url(images/faces.jpg) !important;
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            padding-top: 30px;
        }    </style>
</head>
<body data-ng-app="">
<div id="preloader">
    <div id="status">&nbsp;</div>
</div><!--TOP SEARCH SECTION-->
<section class="bottomMenu dir-il-top-fix">
    <div class="container top-search-main">
        <div class="row">
            <div class="ts-menu">                <!--SECTION: LOGO-->
                <div class="ts-menu-1"><a href="index.html"><img src="images/logo11.png" alt=""> </a></div>
                <!--SECTION: SEARCH BOX-->
                <div class="ts-menu-5"><span><i class="fa fa-bars" aria-hidden="true"></i></span></div>
                <!--MOBILE MENU CONTAINER:IT'S ONLY SHOW ON MOBILE & TABLET VIEW-->
                <div class="mob-right-nav" data-wow-duration="0.5s">
                    <div class="mob-right-nav-close"><i class="fa fa-times" aria-hidden="true"></i></div>
                    <h5>Business</h5>
                    <ul class="mob-menu-icon">
                        <li><a href="#">Add Business</a></li>
                        <li><a href="#">Register</a></li>
                        <li><a href="#">Sign In</a></li>
                    </ul>
                    <h5>All Categories</h5>
                    <ul>
                        <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Help Services</a></li>
                        <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Appliances Repair &
                                Services</a></li>
                        <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Furniture Dealers</a></li>
                        <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Packers and Movers</a></li>
                        <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Pest Control </a></li>
                        <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Solar Product Dealers</a>
                        </li>
                        <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Interior Designers</a></li>
                        <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Carpenters</a></li>
                        <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Plumbing Contractors</a>
                        </li>
                        <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Modular Kitchen</a></li>
                        <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Internet Service Providers</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="tz-register">
    <div class="log-in-pop">
        <div class="log-in-pop-left"><h1>Hello... <span>{{ name1 }}</span></h1>
            <p>Don't have an account? Create your account. It's take less then a minutes</p>
            <!--<h4>Login with social media</h4>            <ul>                <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a>                </li>                <li><a href="#"><i class="fa fa-google"></i> Google+</a>                </li>                <li><a href="#"><i class="fa fa-twitter"></i> Twitter</a>                </li>            </ul>-->
        </div>
        <div class="log-in-pop-right"><a href="#" class="pop-close" data-dismiss="modal"><img src="images/cancel.png"
                                                                                              alt=""/> </a>
            <h4>Login</h4>
            <p>Don't have an account? Create your account. It's takes less then a minutes</p>
            <div id="error_container"></div>
            <form class="s12" id="login-form" action="" method="post" role="form">
                <div>
                    <div class="input-field s12"><input type="text" id="username" name="username" data-ng-model="name1"
                                                        class="validate" tabindex="1"> <label>User name</label></div>
                </div>
                <div>
                    <div class="input-field s12"><input type="password" id="password" name="password" class="validate"
                                                        tabindex="2"> <label>Password</label></div>
                </div>
                <input hidden name="returnURL" value="<?php echo $returnURL; ?>">
                <div>
                    <div class="input-field s4"><input type="submit" id="loginBtn" name="loginBtn" value="Login"
                                                       class="waves-effect waves-light log-in-btn" tabindex="3"></div>
                </div>
                <!--<div>                    <div class="input-field s12"> <a href="forgot-pass.html">Forgot password</a> | <a href="register.html">Create a new account</a> </div>                </div>-->
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</section><!--SCRIPT FILES-->
<script src="js/jquery.min.js"></script>
<script src="js/angular.min.js"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/materialize.min.js" type="text/javascript"></script>
<script src="js/custom.js"></script>
<script src="js/formSubmit.js"></script>
</body>
</html>