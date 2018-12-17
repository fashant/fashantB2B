<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 22/08/2018
 * Time: 22:55
 */

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds) . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;

global $ADMIN;

$brands = getAllBrands($ADMIN);

if(isset($_GET['categories'])){$category = $_GET['categories'];} else {$category = array();}
if(isset($_GET['items'])){$items = $_GET['items'];} else {$items = array();}
if(isset($_GET['brands'])){$brands = $_GET['brands'];} else {$brands = array();}
if(isset($_GET['sc'])){$sc = $_GET['sc'];} else {$sc = array();}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Best Fashion Brands/Shops in Dubai’s Shopping Malls</title>
    <!-- META TAGS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:title"         content="Best Fashion Brands/Shops in Dubai’s Shopping Malls" />
    <meta property="og:description"   content="Filter brands by categories such as Men, Women, Kids, Clothing, Sports, Accessories, Bags, Footwear, Sunglasses, Formal, Undergarments, Swimwear, Lingerie, Jewellery, Arabic, Desi, Maternity, Plus Size etc." />
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
<body onload="filterListings('all', null);">
<?php include_once "partials/listHeader-nav.php"; ?>
<!--TOP SEARCH SECTION-->
<?php include_once "partials/nav-search.php"; ?>
<section class="dir-alp dir-pa-sp-top">
    <div class="container">
        <div class="row relapos">
            <div class="dir-alp-tit">
                
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12 col-md-9 col-sm-9 col-xs-12 pad headbottom">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pading">
                    <div class="box1">
                        <h4>Dubai Shopping Stores</h4>
                    </div>
                </div>
                <div class="col-lg-6 col-md-3 col-sm-3 col-xs-12 paddingbutton">
                    <div class="list-enqu-btn">
                        <ul>
                            <?php
//                                getPriceCategoryList();
                            ?>

                        </ul>
                    </div>
                </div>

            </div>
            <div class="clearfix"></div>
            <div class="row1">
                <div class="dir-alp-con">
				
                    <div class="col-md-3 dir-alp-con-left listside">
					<div id="sidebar">
                        <div class="sidebar__inner">
						<!--==========Sub Category Filter============-->
                        <div class="dir-alp-l3 dir-alp-l-com">
                            <h4>Category</h4>
                            <div class="dir-alp-l-com1 dir-alp-p3">
                                <div class="box1heading"> </div>
                                <form action="#">
                                    <ul>
                                        <?php generateListCategory(1, $category); ?>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!--==========End Sub Category Filter============-->
                        <!--==========Sub Category Filter============-->
                        <div class="dir-alp-l3 dir-alp-l-com">
                            <h4>Price Categories</h4>
                            <div class="dir-alp-l-com1 dir-alp-p3">
                                <div class="box1heading"> </div>
                                <form action="#">
                                    <ul>
                                        <?php getPriceCategoryList(); ?>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!--==========End Sub Category Filter============-->
                        <!--==========Sub Category Filter============-->
                        <div class="dir-alp-l3 dir-alp-l-com">
                            <h4>Items</h4>
                            <div class="dir-alp-l-com1 dir-alp-p3">
                                <div class="box1heading"> </div>
                                <form action="#">
                                    <ul>
                                        <?php generateListCategory(0, $items); ?>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!--==========End Sub Category Filter============-->
                        <!--==========Sub Category Filter============-->
                        <div class="dir-alp-l3 dir-alp-l-com">
                            <h4>Shopping Centers</h4>
                            <div class="dir-alp-l-com1 dir-alp-p3">
                                <div class="box1heading"> </div>
                                <form action="#">
                                    <ul>
                                        <li>
                                            <input type="checkbox" id="scf0001" onclick="filterListings('sc[]','Dubai Mall');" />
                                            <label for="scf0001">Dubai Mall</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="scf0002" onclick="filterListings('sc[]','Mall of the Emirates');" />
                                            <label for="scf0002">Mall of the Emirates</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="scf0003" onclick="filterListings('sc[]','Deria City Center');" />
                                            <label for="scf0003">Deira City Center</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="scf0004" onclick="filterListings('sc[]','Dubai Festival City');" />
                                            <label for="scf0004">Dubai Festival City</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="scf0005" onclick="filterListings('sc[]','Burjuman');" />
                                            <label for="scf0005">Burjuman</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="scf0006" onclick="filterListings('sc[]','Wafi Mall');" />
                                            <label for="scf0006">Wafi Mall</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="scf0007" onclick="filterListings('sc[]','Mercato');" />
                                            <label for="scf0007">Mercato</label>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!--==========End Sub Category Filter============-->
                        <!--==========End Sub Category Filter============-->
						</div>
                    </div>
					</div>

                    <div id="content" class="col-md-9 dir-alp-con-right">
                        <div class="dir-alp-con-right-1">
                            <div class="row" id="listingContainer">
                                <?php //generateListings($brands); ?>
                            </div>

                            <div id="pagination_list"></div>
                        </div>
                    </div>
                    
					<script type="text/javascript" src="js/sticky-sidebar.js"></script>
	<script type="text/javascript">

		var stickySidebar = new StickySidebar('#sidebar', {
			topSpacing: 20,
			bottomSpacing: 20,
			containerSelector: '.dir-alp-con',
			innerWrapperSelector: '.sidebar__inner'
		});
	</script>
					
					
					
                </div>
            </div>
        </div>
</section>

<!--FOOTER SECTION-->
<?php include_once "partials/Footer.php"; ?>

<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/materialize.min.js" type="text/javascript"></script>
<script src="js/custom.js"></script>
<script src="js/formSubmit.js?1800"></script>
<script type="text/javascript">
    function priceCategory(id, value){
        // var arr = ["$", "$$", "$$$", "$$$$", "$$$$$"];
        if(document.getElementById(id).classList.contains('active')){
            document.getElementById(id).classList.remove('active');
        } else {
            // for (var i = 0; i < arr.length; i++) {
            //     document.getElementById(arr[i]).classList.remove('active');
            // }
            document.getElementById(id).classList.add('active');
        }
        filterListings('pc[]', value);
    }

</script>


</body>
</html>

