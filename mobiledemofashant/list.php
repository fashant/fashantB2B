<?php?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Fashant-category</title>    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom styles for this template -->
    <link href="css/responsive.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>    <!-- AUTOCOMPLETE -->
    <script type="text/javascript">
        /*$(document).ready(function () {
            var data = getAutocompleteData();
            $("#select-search").autocomplete({
                source: data,
                select: function (event, ui) {
                    $(this).val(ui.item.label);
                    window.location.href = "https://demofashant.com/list.php?f=&q=" . ui.item.label;
                }
            });
            $(".ui-autocomplete").css("z-index", 1000);
            $( "#Location" ).change(function() {
                $('#select-search').autocomplete("option", { source: getAutocompleteData() });
            });
        });
        /!* this allows us to pass in HTML tags to autocomplete. Without this they get escaped *!/
        $[ "ui" ][ "autocomplete" ].prototype["_renderItem"] = function( ul, item) {
            return $( "<li></li>" )
                .data( "item.autocomplete", item )
                .append( $( "<a href='https://demofashant.com/list.php?f=&q='" + item.label + "></a>" ).html( item.label ) )
                .appendTo( ul );
        };*/
    </script>
    <style>
        #pagination_list ul li {
            display: inline !important;
            padding: 0 !important;
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
        }
        .result-list ul li {
            /*width: auto !important;
            height: auto !important;*/
        }
        .btn-div {
            position: unset;
            padding: 0;
        }</style>
</head>
<body class="category" onload="filterListings('all', null);"><!-- Page Content -->
<section class="search-filter">
    <div class="container">
        <div class="filter-content">
            <form id="homeSearchForm" class="tourz-search-form"
                  onsubmit="window.location.href = 'https://m.demofashant.com/list.php?f=&q=' + document.getElementById('select-search').value; return false;">
                <div class="back-btn"><a href="https://m.demofashant.com"><img src="img/back-icon.png"/></a></div>
                <div class="input-field fix"><input type="text" Placeholder="Dubai"></div>
                <div class="input-field search-img"><input type="text" id="select-search"></div>
            </form>
            <div class="filter-type"><img src="img/sort-icon.png"/> <a href="#myModal" class="sort-btn"
                                                                       data-toggle="modal">SORT</a>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header"><h4 class="modal-title">Sort</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                            </div>
                            <div class="modal-body">
                                <ul>
                                    <li>
                                        <div class="checkbox"><input type="checkbox" value="" id="scf01"
                                                                     onclick="filterListings('pc[]', '1');"> <label
                                                    for="scf01"><p>$ - Discount</p></label></div>
                                    </li>
                                    <li>
                                        <div class="checkbox"><input type="checkbox" value="" id="scf02"
                                                                     onclick="filterListings('pc[]', '2');"> <label
                                                    for="scf02"><p>$$ - Budget/Mass Market</p></label></div>
                                    </li>
                                    <li>
                                        <div class="checkbox"><input type="checkbox" value="" id="scf03"
                                                                     onclick="filterListings('pc[]', '3');"> <label
                                                    for="scf03"><p>$$$ - Moderate</p></label></div>
                                    </li>
                                    <li>
                                        <div class="checkbox"><input type="checkbox" value="" id="scf04"
                                                                     onclick="filterListings('pc[]', '4');"> <label
                                                    for="scf04"><p>$$$$ - Better/Bridge</p></label></div>
                                    </li>
                                    <li>
                                        <div class="checkbox"><input type="checkbox" value="" id="scf05"
                                                                     onclick="filterListings('pc[]', '5');"> <label
                                                    for="scf05"><p>$$$$$ - Designer/Coutore</p></label></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filter-type"><img src="img/filter-icon.png"/>
                <button type="button" class="sort-btn" data-toggle="modal" data-target="#myModall">FILTER</button>
                <div class="modal fade filter-popup" id="myModall" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><img src="img/back-icon.png"/>
                                </button>
                                <h2 class="modal-title">FILTER</h2>
                                <!--                                <span>Clear</span>--></div>
                            <div class="modal-body">
                                <div class="bootstrap-accordion">
                                    <div class="panel-group" id="accordion"><!-- Categories -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading"><h4 class="panel-title"><a
                                                            class="accordion-toggle" data-toggle="collapse"
                                                            data-parent="#accordion" href="#collapseOne">Category</a>
                                                </h4></div>
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <ul>
                                                        <li>
                                                            <div class="checkbox"><input type="checkbox" value=""
                                                                                         id="scf1"
                                                                                         onclick="filterListings('items[]', 'Men');">
                                                                <label><p>Men</p></label></div>
                                                        </li>
                                                        <li>
                                                            <div class="checkbox"><input type="checkbox" value=""
                                                                                         id="scf2"
                                                                                         onclick="filterListings('items[]', 'Women');">
                                                                <label><p>Women</p></label></div>
                                                        </li>
                                                        <li>
                                                            <div class="checkbox"><input type="checkbox" value=""
                                                                                         id="scf1"
                                                                                         onclick="filterListings('items[]', 'Kids');">
                                                                <label><p>Kids</p></label></div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>                                        <!-- Items -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading"><h4 class="panel-title"><a
                                                            class="accordion-toggle" data-toggle="collapse"
                                                            data-parent="#accordion" href="#collapseTwo">Items</a></h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <form action="#">
                                                        <ul>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox" value=""
                                                                                             id="scf001"
                                                                                             onclick="filterListings('items[]', 'Clothings');">
                                                                    <label for="scf001"><p>Clothings</p></label></div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox" value=""
                                                                                             id="scf002"
                                                                                             onclick="filterListings('items[]', 'Sports');">
                                                                    <label for="scf002"><p>Sports</p></label></div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox" value=""
                                                                                             id="scf003"
                                                                                             onclick="filterListings('items[]', 'Bags');">
                                                                    <label for="scf003"><p>Bags</p></label></div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox" value=""
                                                                                             id="scf004"
                                                                                             onclick="filterListings('items[]', 'Accessories');">
                                                                    <label for="scf004"><p>Accessories</p></label></div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox" value=""
                                                                                             id="scf005"
                                                                                             onclick="filterListings('items[]', 'Undergarments');">
                                                                    <label for="scf005"><p>Undergarments</p></label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox" value=""
                                                                                             id="scf006"
                                                                                             onclick="filterListings('items[]', 'Footwear');">
                                                                    <label for="scf006"><p>Footwear</p></label></div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox" value=""
                                                                                             id="scf007"
                                                                                             onclick="filterListings('items[]', 'Sunglasses');">
                                                                    <label for="scf007"><p>Sunglasses</p></label></div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox" value=""
                                                                                             id="scf008"
                                                                                             onclick="filterListings('items[]', 'Formal');">
                                                                    <label for="scf008"><p>Formal</p></label></div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox" value=""
                                                                                             id="scf009"
                                                                                             onclick="filterListings('items[]', 'Swimwear');">
                                                                    <label for="scf009"><p>Swimwear</p></label></div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox" value=""
                                                                                             id="scf010"
                                                                                             onclick="filterListings('items[]', 'Lingerie');">
                                                                    <label for="scf010"><p>Lingerie</p></label></div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox" value=""
                                                                                             id="scf011"
                                                                                             onclick="filterListings('items[]', 'Jewellery');">
                                                                    <label for="scf011"><p>Jewellery</p></label></div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox" value=""
                                                                                             id="scf012"
                                                                                             onclick="filterListings('items[]', 'Arabic');">
                                                                    <label for="scf012"><p>Arabic</p></label></div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox" value=""
                                                                                             id="scf013"
                                                                                             onclick="filterListings('items[]', 'Desi');">
                                                                    <label for="scf013"><p>Desi</p></label></div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox" value=""
                                                                                             id="scf014"
                                                                                             onclick="filterListings('items[]', 'Maternity');">
                                                                    <label for="scf014"><p>Maternity</p></label></div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox" value=""
                                                                                             id="scf015"
                                                                                             onclick="filterListings('items[]', 'Plus Size');">
                                                                    <label for="scf015"><p>Plus Size</p></label></div>
                                                            </li>
                                                        </ul>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>                                        <!-- Shopping Centers -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading"><h4 class="panel-title"><a
                                                            class="accordion-toggle" data-toggle="collapse"
                                                            data-parent="#accordion" href="#collapseThree">Shopping
                                                        Centers</a></h4></div>
                                            <div id="collapseThree" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <form action="#">
                                                        <ul>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox"
                                                                                             id="scf0001"
                                                                                             onclick="filterListings('sc[]','Dubai Mall');"/>
                                                                    <label for="scf0001"><p>Dubai Mall</p></label></div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox"
                                                                                             id="scf0002"
                                                                                             onclick="filterListings('sc[]','Mall of the Emirates');"/>
                                                                    <label for="scf0002"><p>Mall of the Emirates</p>
                                                                    </label></div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox"
                                                                                             id="scf0003"
                                                                                             onclick="filterListings('sc[]','Deria City Center');"/>
                                                                    <label for="scf0003"><p>Deria City Center</p>
                                                                    </label></div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox"
                                                                                             id="scf0004"
                                                                                             onclick="filterListings('sc[]','Dubai Festival City');"/>
                                                                    <label for="scf0004"><p>Dubai Festival City</p>
                                                                    </label></div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox"
                                                                                             id="scf0005"
                                                                                             onclick="filterListings('sc[]','Burjuman');"/>
                                                                    <label for="scf0005"><p>Burjuman</p></label></div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox"
                                                                                             id="scf0006"
                                                                                             onclick="filterListings('sc[]','Wafi Mall');"/>
                                                                    <label for="scf0006"><p>Wafi Mall</p></label></div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox"><input type="checkbox"
                                                                                             id="scf0007"
                                                                                             onclick="filterListings('sc[]','Mercato');"/>
                                                                    <label for="scf0007"><p>Mercato</p></label></div>
                                                            </li>
                                                        </ul>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="last-filter-result">
                                <!--                                <a href="#" class="fashant-btn">APPLY</a>-->
                                <!--                                <h3>39 Result</h3>-->                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="result-list">
    <div class="container">
        <div class="result-content"><label>Showing 1000+ results</label></div>
        <div class="result-list" id="listingContainer"></div>
        <div id="pagination_list"></div>
    </div>
</section><?php include_once "partials/footer.php"; ?><!-- Bootstrap core JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="https://demofashant.com/js/formSubmit.js?2600"></script>
</body>
</html>