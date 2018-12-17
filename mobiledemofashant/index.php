<?php
//If the HTTPS is not found to be "on"
if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    //Tell the browser to redirect to the HTTPS URL.
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
    //Prevent the rest of the script from executing.
    exit;
}
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;
$util_dir = "{$base_dir}fashanttech{$ds}resources{$ds}utilities.php";
include_once $util_dir;$user = false;
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
    <title>Fashant</title>    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">    <!-- Custom styles for this template -->
    <link href="css/responsive.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>    <!-- AUTOCOMPLETE -->
    <script type="text/javascript">        $(document).ready(function () {
            var data = getAutocompleteData();
            $("#select-search").autocomplete({
                source: data,
                select: function (event, ui) {//                    alert(1);                    $(this).val(ui.item.label);                    window.location.href = "https://demofashant.com/list.php?f=&q=" . ui.item.label;                }            });            $(".ui-autocomplete").css("z-index", 1000);            $( "#Location" ).change(function() {                $('#select-search').autocomplete("option", { source: getAutocompleteData() });            });        });        /* this allows us to pass in HTML tags to autocomplete. Without this they get escaped */        $[ "ui" ][ "autocomplete" ].prototype["_renderItem"] = function( ul, item) {            return $( "<li></li>" )                .data( "item.autocomplete", item )                .append( $( "<a href='https://demofashant.com/list.php?f=&q='" + item.label + "></a>" ).html( item.label ) )                .appendTo( ul );        };    </script>
    <style>        .ui-autocomplete {
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

        &
        .ui-state-hover,

        &
        .ui-state-active {
            color: #ffffff;
            text-decoration: none;
            background-color: #0088cc;
            border-radius: 0px;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            background-image: none;
        }

        }
        }    </style>
</head>
<body><!-- Navigation --><?php include_once "partials/navigation.php"; ?><!-- Page Content -->
<section class="header">
    <div class="container">
        <div class="header-content"><img src="img/mlogo.png"/>
            <div class="heading"><label>Find the best</label>
                <h1>Fashion brands</h1>
                <p>in Dubai’s Shopping Malls</p></div>
            <div class="form">
                <form id="homeSearchForm" class="tourz-search-form"
                      onsubmit="window.location.href = 'https://m.demofashant.com/list.php?f=&q=' + document.getElementById('select-search').value; return false;">
                    <div class="input-field"><select class="location-dropdown" id="Location">
                            <option>All Malls</option>
                            <option>Dubai Mall</option>
                            <option>Mall of the Emirates</option>
                            <option>Deira City Center</option>
                            <option>Dubai Festival City</option>
                            <option>Burjuman</option>
                            <option>Wafi Mall</option>
                            <option>Mercato</option>
                        </select></div>
                    <div class="input-field"><input type="text" id="select-search"
                                                    Placeholder="Search Fashion Brands, Stores"></div>
                    <div class="input-field"><input type="submit" value="search"></div>
                </form>
            </div>
        </div>
    </div>
</section>
<section class="box-select">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <div class="carousel-captions">
                    <div class="icon-img"><img src="img/men-icon.png"/></div>
                    <div class="select-text"><h3>MEN</h3>
                        <p>Search all brands that sell men's clothing, footwear, accessories and other categories</p>
                    </div>
                </div>
                <div class="button-link"><a href="list.php?categories[]=Men">EXPLORE NOW</a></div>
            </div>
            <div class="carousel-item">
                <div class="carousel-captions">
                    <div class="icon-img"><img src="img/women.png"/></div>
                    <div class="select-text"><h3>WOMEN</h3>
                        <p>Search all brands that sell men's clothing, footwear, accessories and other categories</p>
                    </div>
                </div>
                <div class="button-link"><a href="list.php?categories[]=Women">EXPLORE NOW</a></div>
            </div>
            <div class="carousel-item">
                <div class="carousel-captions">
                    <div class="icon-img"><img src="img/kid.png"/></div>
                    <div class="select-text"><h3>KIDS</h3>
                        <p>Search all brands that sell men's clothing, footwear, accessories and other categories</p>
                    </div>
                </div>
                <div class="button-link"><a href="list.php?categories[]=Kids">EXPLORE NOW</a></div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"> <span
                    class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span>
        </a> <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next"> <span
                    class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
    </div>
</section>
<section class="fashion-categories">
    <div class="container">
        <div class="fashion-content"><label>search brands by</label> <span>Fashion Categories</span></div>
        <div class="categories-list">
            <ul>
                <li><a href="list.php?f=&items[]=Clothing"><img src="img/clothing.png" alt=""> Clothing</a></li>
                <li><a href="list.php?f=&items[]=Sports"><img src="img/sports.png" alt="">Sports</a></li>
                <li><a href="list.php?f=&items[]=Accessories"><img src="img/accessories.png" alt=""> Accessories</a>
                </li>
                <li><a href="list.php?f=&items[]=Arabic"><img src="img/arabic.png" alt=""> Arabic</a></li>
                <li><a href="list.php?f=&items[]=Footwear"><img src="img/footwear.png" alt=""> Footwear</a></li>
                <li><a href="list.php?f=&items[]=Formal"><img src="img/formal.png" alt=""> Formal</a></li>
                <li><a href="list.php?f=&items[]=Jewellery"><img src="img/jewellery.png" alt=""> Jewellery</a></li>
                <li><a href="list.php?f=&items[]=Lingerie"><img src="img/lingerie.png" alt=""> Lingerie</a></li>
                <li><a href="list.php?f=&items[]=Maternity"><img src="img/maternity.png" alt="">Maternity</a></li>
                <li><a href="list.php?f=&items[]=Plus Size"><img src="img/plussize.png" alt=""> Plus Size</a></li>
                <li><a href="list.php?f=&items[]=Desi"><img src="img/desi.png" alt=""> Desi</a></li>
                <li><a href="list.php?f=&items[]=Swimwear"><img src="img/swimwear.png" alt=""> Swimwear</a></li>
                <li><a href="list.php?f=&items[]=Sunglasses"><img src="img/sunglasses.png" alt=""> Sunglasses</a></li>
                <li><a href="list.php?f=&items[]=Undergarments"><img src="img/undergarments.png" alt="">
                        Undergarments</a></li>
            </ul>
        </div>
    </div>
</section>
<section class="location-slider">
    <div class="container-fluid no-padding">
        <div class="fashion-content"><label>search by</label> <span>Shopping Location</span></div>
        <div class="location-place">
            <div id="carouselExampleIndicatorss" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <div class="carousel-captions">
                            <div class="city-img"><img src="img/dubaimall.png"/></div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-captions">
                            <div class="city-img"><img src="img/Burjuman.png"/></div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-captions">
                            <div class="city-img"><img src="img/deira-city-centre.png"/></div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicatorss" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span
                            class="sr-only">Previous</span> </a> <a class="carousel-control-next"
                                                                    href="#carouselExampleIndicatorss" role="button"
                                                                    data-slide="next"> <span
                            class="carousel-control-next-icon" aria-hidden="true"></span> <span
                            class="sr-only">Next</span> </a></div>
        </div>
    </div>
</section>
<section class="banner-1">
    <div class="container-fluid no-padding">
        <div class="banner-content"><h3>IT'S FREE</h3>
            <p>to claim your<br>fashion store</p>
            <h2>LISTING</h2>            <a href="#" class="fashant-btn">CONTACT US</a></div>
    </div>
</section>
<section class="brands-slider">
    <div class="container-fluid no-padding">
        <div class="fashion-content"><label>dubai’s top</label> <span>Fashion Brands</span></div>
        <div class="brands-list">
            <div id="carouselExampleIndicatorsd" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <div class="heading-title"><label>MEN’S POPULAR</label></div>
                        <div class="ul-brand">
                            <div class="humen-image"><img src="img/only_best_image_men-1.png"/></div>
                            <ul>
                                <li><a href="list.php?f=&categories[]=Men&brands[]=Tommy Hilfiger">Tommy Hilfiger</a>
                                </li>
                                <li><a href="list.php?f=&categories[]=Men&brands[]=MAX Fashion">MAX Fashion</a></li>
                                <li><a href="list.php?f=&categories[]=Men&brands[]=Giordano">Giordano</a></li>
                            </ul>
                            <ul>
                                <li><a href="list.php?f=&categories[]=Men&brands[]=Zara">Zara</a></li>
                                <li><a href="list.php?f=&categories[]=Men&brands[]=H&M">H&M</a></li>
                                <li><a href="list.php?f=&categories[]=Men&brands[]=Aldo">Aldo</a></li>
                                <li><a href="list.php?f=&categories[]=Men&brands[]=Nike">Nike</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="carousel-item women-div">
                        <div class="heading-title"><label>WOMEN’S POPULAR</label></div>
                        <div class="ul-brand">
                            <div class="humen-image"><img src="img/only_best_women-1.png"/></div>
                            <ul>
                                <li><a href="list.php?f=&categories[]=Women&brands[]=Splash">Splash</a></li>
                                <li><a href="list.php?f=&categories[]=Women&brands[]=Charles & Keith">Charles &<br>Keith</a>
                                </li>
                                <li><a href="list.php?f=&categories[]=Women&brands[]=Kiabi">Kiabi</a></li>
                            </ul>
                            <ul>
                                <li><a href="list.php?f=&categories[]=Women&brands[]=Forever 21">Forever 21</a></li>
                                <li><a href="list.php?f=&categories[]=Women&brands[]=H&M">H&M</a></li>
                                <li><a href="list.php?f=&categories[]=Women&brands[]=H&M">Zara</a></li>
                                <li><a href="list.php?f=&categories[]=Women&brands[]=Victoria's Secret">Victoria's<br>Secret</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicatorsd" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span
                            class="sr-only">Previous</span> </a> <a class="carousel-control-next"
                                                                    href="#carouselExampleIndicatorsd" role="button"
                                                                    data-slide="next"> <span
                            class="carousel-control-next-icon" aria-hidden="true"></span> <span
                            class="sr-only">Next</span> </a></div>
        </div>
    </div>
</section>
<div class="modal fade dir-pop-com" id="signin" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header dir-pop-head">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body dir-pop-body">
                <section class="tz-register">
                    <div class="log-in-pop">
                        <div class="log-in-pop-left"><h1>Hello... <span></span></h1>
                            <p>Don't have an account? Let's create one!. It takes less then a minute.</p><h4>Login with
                                social media</h4>
                            <ul>
                                <li><a href="#"><i class="mdi mdi-facebook"></i> Facebook</a></li>
                                <li><a href="#"><i class="mdi mdi-google"></i> Google+</a></li>
                                <li><a href="#"><i class="mdi mdi-twitter"></i> Twitter</a></li>
                            </ul>
                        </div>
                        <div class="log-in-pop-right"><a href="#" class="pop-close" data-dismiss="modal"><img
                                        src="images/cancel.png" alt=""/> </a>                            <h4>Login</h4>
                            <p>Don't have an account? Let's create one!. It takes less then a minute.</p>
                            <div id="error_container"></div>
                            <form class="s12" id="login-form" action="" method="post" role="form">
                                <div>
                                    <div class="input-field s12"><input type="text" id="username" name="username"
                                                                        data-ng-model="name1" class="validate"
                                                                        tabindex="1"> <label>User name</label></div>
                                </div>
                                <div>
                                    <div class="input-field s12"><input type="password" id="password" name="password"
                                                                        class="validate" tabindex="2">
                                        <label>Password</label></div>
                                </div>
                                <div>
                                    <div class="input-field s4"><input type="submit" id="mLoginBtn" name="loginBtn"
                                                                       value="Login"
                                                                       class="waves-effect waves-light log-in-btn"
                                                                       tabindex="3"></div>
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
                        <div class="log-in-pop-left"><h1>Hello... <span></span></h1>
                            <p>Don't have an account? Let's create one!. It takes less then a minute.</p><h4>Sign up
                                with social media</h4>
                            <ul>
                                <li><a href="#"><i class="mdi mdi-facebook"></i> Facebook</a></li>
                                <li><a href="#"><i class="mdi mdi-google"></i> Google+</a></li>
                                <li><a href="#"><i class="mdi mdi-twitter"></i> Twitter</a></li>
                            </ul>
                        </div>
                        <div class="log-in-pop-right"><a href="#" class="pop-close" data-dismiss="modal"><img
                                        src="images/cancel.png" alt=""/> </a>                            <h4>Sign
                                up</h4>
                            <p>Don't have an account? Let's create one!. It takes less then a minute.</p>
                            <div id="error_container"></div>
                            <!--                                <form class="s12 validate" id="register-form" action="https://fashant.us18.list-manage.com/subscribe/post?u=975020543941eb0c4d39da173&amp;id=704c45e655" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" role="form" target="_blank" novalidate>-->
                            <form class="s12 validate" id="register-form" action="" method="post" role="form">
                                <div>
                                    <div class="input-field s12">
                                        <!--<input type="text" id="firstname" name="firstname" data-ng-model="name1" class="validate" tabindex="1">-->
                                        <input type="text" value="" name="FNAME" class="" id="mce-FNAME"> <label>First
                                            name</label></div>
                                </div>
                                <div>
                                    <div class="input-field s12">
                                        <!--<input type="text" id="lastname" name="lastname" data-ng-model="name2" class="validate" tabindex="1">-->
                                        <input type="text" value="" name="LNAME" class="" id="mce-LNAME"> <label>Last
                                            Name</label></div>
                                </div>
                                <div>
                                    <div class="input-field s12">
                                        <!--<input type="text" id="email" name="email" data-ng-model="email" class="validate" tabindex="1">-->
                                        <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                                        <label>Email</label></div>
                                </div>
                                <div>
                                    <div class="input-field s12"><input type="password" id="register_password"
                                                                        name="password" class="validate" tabindex="2">
                                        <!--											<input type="text" value="" name="MMERGE3" class="" id="mce-MMERGE3">-->
                                        <label>Password</label></div>
                                </div>
                                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text"
                                                                                                          name="b_975020543941eb0c4d39da173_704c45e655"
                                                                                                          tabindex="-1"
                                                                                                          value="">
                                </div>
                                <div>
                                    <div class="input-field s4"><input type="submit" id="mSignupBtn" name="signupBtn"
                                                                       value="Sign Up"
                                                                       class="waves-effect waves-light log-in-btn"
                                                                       tabindex="3"> <input type="submit"
                                                                                            id="forgetpass"
                                                                                            name="forgetpass"
                                                                                            value="Forget Password"
                                                                                            class="waves-effect waves-light log-in-btn"
                                                                                            tabindex="3">
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
</div><?php include_once "partials/footer.php"; ?><!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://demofashant.com/js/formSubmit.js?2400"></script>
<script src="js/formSubmit.js"></script>
</body>
</html>