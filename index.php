<?php
//If the HTTPS is not found to be "on"
if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    //Tell the browser to redirect to the HTTPS URL.
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
    //Prevent the rest of the script from executing.
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dubai’s Fashion Guide for Mall Shopping</title>
    <!-- META TAGS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:url"           content="https://www.demofashant.com/" />
    <meta property="og:type"          content="Fashant" />
    <meta property="og:title"         content="Find the best Fashion brands in Dubai's Shopping Malls" />
    <meta property="og:description"   content="Discover Fashion brands, shops & stores for Men, Ladies and Kids clothing in Dubai’s Shopping Malls. Filter by Sales/Promotions and Rating/Reviews." />
    <meta property="og:image"         content="https://demofashant.com/images/banner5.jpg" />
	
	<!-- Hotjar Tracking Code for www.demofashant.com -->
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


    <!-- FAV ICON(BROWSER TAB ICON) -->
    <link rel="shortcut icon" href="images/fav.ico" type="image/x-icon">
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,800" rel="stylesheet">
    <!-- FONTAWESOME ICONS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- ALL CSS FILES -->
    <link href="css/materialize.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/theme-icons.min.css">
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <!-- AUTOCOMPLETE -->
    <script type="text/javascript">
        $(document).ready(function(){
            var data = getAutocompleteData();

            $("#select-search").autocomplete({
                source:data,
                select: function (event, ui){
//                    alert(1);
                    $(this).val(ui.item.label);
                    window.location.href = "https://demofashant.com/list.php?f=&q=" . ui.item.label;
                }
            });
            $(".ui-autocomplete").css("z-index", 1000);

            $( "#Location" ).change(function() {
                $('#select-search').autocomplete("option", { source: getAutocompleteData() });
               
            });
        });

        /* this allows us to pass in HTML tags to autocomplete. Without this they get escaped */
        $[ "ui" ][ "autocomplete" ].prototype["_renderItem"] = function( ul, item) {
            return $( "<li></li>" )
                .data( "item.autocomplete", item )
                .append( $( "<a href='https://demofashant.com/list.php?f=&q='" + item.label + "></a>" ).html( item.label ) )
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
    </style>

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
<?php include_once "partials/listHeader-nav.php"; ?>
<!--TOP SEARCH SECTION-->

<!--BANNER AND SERACH BOX-->
<section id="background" class="dir1-home-head">

    <div class="container dir-ho-t-sp">
        <div class="row">
            <div class="dir-hr1">
                <div class="dir-ho-t-tit">
                    <h1>Discover the Best Fashion Brands in Dubai's Shopping Malls.</h1>
                    <p>Information on 1000+ Fashion Stores, 600+ Fashion Brands, 7 Shopping Malls and counting.</p>
                </div>
                <form id="homeSearchForm" class="tourz-search-form" onsubmit="window.location.href = 'https://demofashant.com/list.php?f=&q=' + document.getElementById('select-search').value; return false;">
                    <div class="input-field">
                        <!--<input type="text" id="select-city" class="autocomplete" disabled value="Dubai">
                        <label for="select-city">Location</label>-->
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
                        <input type="text" id="select-search" class="autocomplete">
                        <label for="select-search" class="search-hotel-type">Search Fashion Brands, Stores....</label>
                    </div>
                    <div class="input-field">
                        <input type="submit" value="search" class="waves-effect waves-light tourz-sear-btn"> </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--TOP SEARCH SECTION-->

<!--HOME PROJECTS-->
<section class="proj mar-bot-red-m30">
    <div class="container">
        <div class="row">
            <!--HOME PROJECTS: 1-->
            <div class="col-md-4 col-sm-6">
                <a href="https://demofashant.com/list.php?categories[]=Men">
                    <div class="hom-pro"> <img src="images/icon/men.png" alt="" />
                        <h4>Men</h4>
                        <p>Search all brands that sell men's clothing, footwear, accessories and other categories</p>
                    </div>
                </a>
            </div>
            <!--HOME PROJECTS: 1-->
            <div class="col-md-4 col-sm-6">
                <a href="https://demofashant.com/list.php?categories[]=Women">
                    <div class="hom-pro"> <img src="images/icon/women.png" alt="" />
                        <h4>Women</h4>
                        <p>Search all brands that sell women's clothing, footwear, accessories and other categories</p>
                    </div>
                </a>
            </div>
            <!--HOME PROJECTS: 1-->
            <div class="col-md-4 col-sm-6">
                <a href="https://demofashant.com/list.php?categories[]=Kids">
                    <div class="hom-pro"> <img src="images/icon/kid.png" alt="" />
                        <h4>Kids</h4>
                        <p>Search all brands that sell kids’ clothing, footwear, accessories and other categories</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!--FIND YOUR SERVICE-->
<section class="com-padd com-padd-redu-bot1 pad-bot-red-40">
    <div class="container">
        <div class="row">
            <div class="com-title">
                <h2>Search Brands by <span>Fashion Categories</span></h2>
            </div>
            <div class="cat-v2-hom-list">
                <ul>
                    <li>
                        <a href="https://demofashant.com/list.php?f=&items[]=Clothing"><img src="images/icon/clothing.png" alt=""> Clothing</a>
                    </li>
                    <li>
                        <a href="https://demofashant.com/list.php?f=&items[]=Sports"><img src="images/icon/sports.png" alt="">Sports</a>
                    </li>
                    <li>
                        <a href="https://demofashant.com/list.php?f=&items[]=Accessories"><img src="images/icon/accessories.png" alt=""> Accessories</a>
                    </li>
                    <li>
                        <a href="https://demofashant.com/list.php?f=&items[]=Bags"><img src="images/icon/bags.png" alt=""> Bags</a>
                    </li>
                    <li>
                        <a href="https://demofashant.com/list.php?f=&items[]=Footwear"><img src="images/icon/footwear.png" alt=""> Footwear</a>
                    </li>
                    <li>
                        <a href="https://demofashant.com/list.php?f=&items[]=Sunglasses"><img src="images/icon/sunglasses.png" alt=""> Sunglasses</a>
                    </li>
                    <li>
                        <a href="https://demofashant.com/list.php?f=&items[]=Formal"><img src="images/icon/formal.png" alt=""> Formal</a>
                    </li>
                    <li>
                        <a href="https://demofashant.com/list.php?f=&items[]=Undergarments"><img  src="images/icon/undergarments.png" alt=""> Undergarments</a>
                    </li>
                    <li>
                        <a href="https://demofashant.com/list.php?f=&items[]=Swimwear"><img  src="images/icon/swimwear.png" alt=""> Swimwear</a>
                    </li>
                    <li>
                        <a href="https://demofashant.com/list.php?f=&items[]=Lingerie"><img  src="images/icon/lingerie.png" alt=""> Lingerie</a>
                    </li>
                    <li>
                        <a href="https://demofashant.com/list.php?f=&items[]=Jewellery"><img src="images/icon/jewellery.png" alt=""> Jewellery</a>
                    </li>
                    <li>
                        <a href="https://demofashant.com/list.php?f=&items[]=Arabic"><img src="images/icon/arabic.png" alt=""> Arabic</a>
                    </li>
                    <li>
                        <a href="https://demofashant.com/list.php?f=&items[]=Desi"><img src="images/icon/desi.png" alt=""> Desi</a>
                    </li>
                    <li>
                        <a href="https://demofashant.com/list.php?f=&items[]=Maternity"><img src="images/icon/maternity.png" alt="">Maternity</a>
                    </li>
                    <li>
                        <a href="https://demofashant.com/list.php?f=&items[]=Plus Size"><img src="images/icon/plussize.png" alt="" width="64" height="64"> Plus Size</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</section>
<!--EXPLORE CITY LISTING-->
<div class="main_middle_part_image">
    <div class="container">
        <div class="row">
            <div class="com-title">
                <h2>Search by <span>Shopping Location</span></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xs-12 col-lg-6 col-sm-6">
                <div class="image_middle_part firsttt">
                    <a href="https://demofashant.com/list.php?sc[]=Dubai%20Mall">
                        <img src="images/dubaimall.png" alt="">
                        <div class="malldetail">
                            <div class="mallcont">Dubai Festival City</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-xs-12 col-lg-6 col-sm-6">
                <div class="image_middle_part">
                    <a href="https://demofashant.com/list.php?sc[]=Dubai%20Mall">
                        <img src="images/Burjuman.jpg" alt="">
                        <div class="malldetail">
                            <div class="mallcont">Burjuman</div>
                        </div>
                    </a>
                </div>
				<div class="image_middle_part">
                    <a href="https://demofashant.com/list.php?sc[]=Dubai%20Mall">
                        <img src="images/deira-city-centre.jpg" alt="">
                        <div class="malldetail">
                            <div class="mallcont">Deira City Centre</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
<!--ADD BUSINESS-->
<section class="com-padd home-dis">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2><span>It's Free</span> to Claim your Fashion Store Listing! <a href="price.html">Contact Us</a></h2> </div>
        </div>
    </div>
</section>
<!--BEST THINGS-->
<?php include_once "partials/includeBrandListing.php"; ?>
<!--CREATE FREE ACCOUNT-->


<?php include_once "partials/Footer.php"; ?>

<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/materialize.min.js" type="text/javascript"></script>
<script src="js/custom.js"></script>
<script src="js/formSubmit.js?2400"></script>

</body>

</html>