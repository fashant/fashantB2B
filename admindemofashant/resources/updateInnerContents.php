<?php session_start(); ?>
<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 03/08/2018
 * Time: 09:20
 */

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds) . $ds;

$utilities_dir = "{$base_dir}utilities.php";

include_once $utilities_dir;

$mysqli = getConnection();

if(isset($_POST['page'])) {
    switch ($_POST['page']){
        case '../admin-all-listing.php':
            getAdminAllListing();
            break;
        case '../listingPanel.php':
            getListingPanel();
            break;
        case '../admin-timings.php':
            getAdminTimings();
            break;
        case '../admin-list-users-add.php':
            getAdminListUsersAdd();
            break;
        case '../admin-all-users.php':
            getAdminAllUsers();
            break;
        case '../admin-reviews.php':
            getAdminReviews();
            break;
        default: break;
    }

//    $page = file_get_contents($_POST['page']);
//    $doc = new DOMDocument();
//    libxml_use_internal_errors(true);
//    $doc->loadHTML($page);
//    libxml_clear_errors();
//    print_r($doc->saveHTML($doc->getElementById("innerContents")));
}

function getAdminAllListing(){
    $brands = getAllBrands($_SESSION['id']);

    echo "
            <div class=\"sb2-2\">
            <!--== breadcrumbs ==-->
            <div class=\"sb2-2-2\">
                <ul>
                    <li><a href=\"index.html\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i> Home</a> </li>
                    <li class=\"active-bre\"><a href=\"#\"> All Listing</a> </li>
                    <li class=\"page-back\"><a href=\"admin.html\"><i class=\"fa fa-backward\" aria-hidden=\"true\"></i> Back</a> </li>
                </ul>
            </div>
            <div class=\"tz-2 tz-2-admin\">
                <div class=\"tz-2-com tz-2-main\">
                    <h4>All Listing</h4> <a class=\"dropdown-button drop-down-meta drop-down-meta-inn\" href=\"#\" data-activates=\"dr-list\"><i class=\"material-icons\">more_vert</i></a>
                    <ul id=\"dr-list\" class=\"dropdown-content\">
                        <li><a href=\"#!\">Add New</a> </li>
                        <li><a href=\"#!\">Edit</a> </li>
                        <li><a href=\"#!\">Update</a> </li>
                        <li class=\"divider\"></li>
                        <li><a href=\"#!\"><i class=\"material-icons\">delete</i>Delete</a> </li>
                        <li><a href=\"#!\"><i class=\"material-icons\">subject</i>View All</a> </li>
                        <li><a href=\"#!\"><i class=\"material-icons\">play_for_work</i>Download</a> </li>
                    </ul>
                    <!-- Dropdown Structure -->
                    <div class=\"split-row\">
                        <div class=\"col-md-12\">
                            <div class=\"box-inn-sp ad-inn-page\">
                                <div class=\"tab-inn ad-tab-inn\">
                                    <div class=\"table-responsive\">
                                    <form class=\"\" id=\"brandListingDeleteForm\" action=\"\" method=\"post\" role=\"form\" enctype=\"multipart/form-data\">
                                        <table id=\"table\" data-toggle=\"table\" data-pagination=\"true\" data-search=\"true\" data-show-columns=\"true\" data-show-pagination-switch=\"true\" data-show-refresh=\"true\" data-key-events=\"true\" data-show-toggle=\"true\" data-resizable=\"true\" data-cookie=\"true\" data-cookie-id-table=\"saveId\" data-show-export=\"true\" data-click-to-select=\"true\" data-toolbar=\"#toolbar\">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>Logo</th>
                                                <th>Brand Name</th>
                                                <th>Store Location</th>
                                                <th>City</th>
                                                <th>Shopping Center</th>
                                                <th>Price Category</th>
                                                <th>View</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody id=\"all-listing\">                                
                                                ";

                            $MAX = 10;

                            $actual_link = $_POST['page_nr'];

                            // MAKES FILTERS OF ALL PARTS IN THE URL SENT
                            $parts = parse_url($actual_link);
                            if(isset($parts['query'])) {
                                parse_str($parts['query'], $filters);
                            }

                            $page = 1;

                            if(isset($filters) && isset($filters['page'])) {
                                $page = $filters['page'];
                            }

                            $num_pages = ceil(sizeof($brands)/$MAX) - 1;

                            if($page == 1){
                                $page_start = 0;
                                $page_max = $MAX;
                            } else {
                                $page_start = $page * $MAX;

                                if($page_start + $MAX > sizeof($brands)){
                                    $page_max = (($page_start + $MAX) - sizeof($brands)) + $page_start;
                                } else {
                                    $page_max = $page_start + $MAX;
                                }
                            }

                            if(sizeof($brands) > 0) {
                                for($i = $page_start; $i < $page_max; $i++){
                                    $price = getPriceCategoryName($brands[$i]->getPriceCategory());
                                    if(!$price){
                                        $price = $brands[$i]->getPriceCategory();
                                    }

                                    $brand_id = $brands[$i]->getId();

                                    $ukey = $brands[$i]->getUkey();

                                    $img = "images/icon/dbr1.jpg";
                                    $img_folder = "../uploads/brands/$ukey/$brand_id/logo.jpg";

                                    if(file_exists($img_folder)){
                                        $img = $img_folder;
                                    }

                                    echo "<tr>";
                                    echo "<td><input style='left:0;opacity:1;position: inherit;' type=\"checkbox\" name='deleteBrandCheckbox' value='$brand_id'></td>";
                                    echo "<td><span class='list-img'><img style='width: 48px;height: 17px;border-radius: 0;' src='$img' alt=''></span> </td>";
                                    echo "<td><a href='#'><span class='list-enq-name'></span><span class='list-enq-city'>" . $brands[$i]->getName() . "</span></a> </td>";
                                    echo "<td>" . $brands[$i]->getStoreLocation() . "</td>";
                                    echo "<td>" . $brands[$i]->getCity() . "</td>";
                                    echo "<td>" . $brands[$i]->getShoppingCenter() . "</td>";
                                    echo "<td>" . $price . "</td>";
                                    echo "<td> <a href='admin-list-view.php?id=" . $brands[$i]->getId() . "'><i class='fa fa-eye'></i></a> </td>";
                                    echo "<td> <a href='admin-list-edit.php?id=" . $brands[$i]->getId() . "'><i class='fa fa-edit'></i></a> </td>";
                                    echo "<td> <a href='#' onclick='deleteBrand($brand_id);'><i class='fa fa-close'></i></a></td>";
                                    echo "</tr>";

                                }
                            }
    echo "

                                            </tbody>
                                        </table>
                                        <div></div>
                                        <div class=\"input-field col s12 v2-mar-top-40\"> <a class=\"waves-effect waves-light btn-large \" href=\"#\" id=\"selectAllBrands\" onclick='selectAllBrands();'>Select all</a> </div>
                                        <div class=\"input-field col s12 v2-mar-top-20\"> <a class=\"waves-effect waves-light btn-large \" href=\"#\" id=\"deleteSelectedBrands\" onclick='deleteSelectedBrands();'>Delete brands</a> </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class=\"admin-pag-na\">
                                <ul class='pagination list-pagenat'>";

                                $MAX = 5;
                                $start = 0;
                                $end = $MAX;

                                // Get start and end of loop
                                if($page > $MAX){
                                    $start = $page - round($MAX / 2, 0, PHP_ROUND_HALF_DOWN) - 1;
                                    $end = $page + round($MAX / 2, 0, PHP_ROUND_HALF_DOWN);
                                    if(round($MAX / 2, 0, PHP_ROUND_HALF_DOWN) + $page > $num_pages){
                                        $end = $num_pages;
                                    }
                                }

                                // Get next and prev button
                                $prev = $end - $MAX;
                                $next = $end + 1;

                                if($next > $num_pages){
                                    $next = $num_pages;
                                }

                                if($end <= $MAX){
                                    $prev = 0;
                                    if($num_pages < $MAX) {
                                        $next = $end;
                                    }
                                }

                                if($end > $num_pages){
                                    $end = $num_pages;
                                }

                                if($prev === 0){
                                    echo "<li class=\"disabled\"><a href=\"#\"><i class=\"material-icons\">chevron_left</i></a> </li>";
                                } else {
                                    echo "<li class=\"waves-effect\"><a onclick=\"updateAdminAllListingTable($prev);\" href='#'><i class=\"material-icons\">chevron_left</i></a> </li>";
                                }

                                for($i = $start; $i < $end; $i++){
                                    $n = $i + 1;
                                    if($n == $page){
                                        echo "<li class='active'><a>$n</a> </li>";
                                    } else {
                                        echo "<li class='waves-effect'><a onclick=\"updateAdminAllListingTable($n);\" href='#'>$n</a> </li>";
                                    }
                                }

                                if($next === 0){
                                    echo "<li class=\"disabled\"><a href=\"#\"><i class=\"material-icons\">chevron_right</i></a> </li>";
                                } else {
                                    echo "<li class=\"waves-effect\"><a onclick=\"updateAdminAllListingTable($next);\"  href=\"#\"><i class=\"material-icons\">chevron_right</i></a> </li>";
                                }
                                
    echo "                     </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
}

function getListingPanel(){
    echo "<div class=\"sb2-2\">
            <!--== breadcrumbs ==-->
            <div class=\"sb2-2-2\">
                <ul>
                    <li><a href=\"index.html\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i> Home</a> </li>
                    <li class=\"active-bre\"><a href=\"#\"> Add Brand</a> </li>
                    <li class=\"page-back\"><a href=\"#\"><i class=\"fa fa-backward\" aria-hidden=\"true\"></i> Back</a> </li>
                </ul>
            </div>
            <div class=\"tz-2 tz-2-admin\">
                <div class=\"tz-2-com tz-2-main\">
                    <h4>Add New Brand</h4> <a class=\"dropdown-button drop-down-meta drop-down-meta-inn\" href=\"#\" data-activates=\"dr-list\"><i class=\"material-icons\">more_vert</i></a>
                    <ul id=\"dr-list\" class=\"dropdown-content\">
                        <li><a href=\"#!\">Add New</a> </li>
                        <li><a href=\"#!\">Edit</a> </li>
                        <li><a href=\"#!\">Update</a> </li>
                        <li class=\"divider\"></li>
                        <li><a href=\"#!\"><i class=\"material-icons\">delete</i>Delete</a> </li>
                        <li><a href=\"#!\"><i class=\"material-icons\">subject</i>View All</a> </li>
                        <li><a href=\"#!\"><i class=\"material-icons\">play_for_work</i>Download</a> </li>
                    </ul>
                    <!-- Dropdown Structure -->
                    <div class=\"split-row\">
                        <div class=\"col-md-12\">
                            <div class=\"box-inn-sp ad-inn-page\">
                                <div class=\"tab-inn ad-tab-inn\">
                                    <div class=\"hom-cre-acc-left hom-cre-acc-right\">
                                        <div class=\"\">
                                            <div id=\"error_container\"></div>
                                            <form class=\"\" id=\"addBrandForm\" action=\"\" method=\"post\" role=\"form\" enctype=\"multipart/form-data\">
                                                <div class=\"row\">
                                                    <h2>Brand information</h2>
                                                    <div class=\"row\">
                                                        <div class=\"input-field col s12\">
                                                            <input id=\"brand_name\" name=\"brand_name\" type=\"text\" class=\"validate\">
                                                            <label for=\"brand_name\">Brand Name</label>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"input-field col s12\">
                                                            <textarea id=\"about_brand\" name=\"about_brand\" class=\"materialize-textarea\"></textarea>
                                                            <label for=\"about_brand\">About Brand</label>
                                                        </div>
                                                    </div>
                                                    <div class='row'>
                                                        <div id='brandCategoryPrimaryContainer' class='input-field col s12'>
                                                        <div class=\"\">
                                                        
                                                        <div class=\"panel-group\">
                                                            <div class=\"panel panel-default\">
                                                                <div class=\"panel-heading\">
                                                                    <h4 class=\"panel-title\">
                                                                        <a data-toggle=\"collapse\" href=\"#collapse2\">Select Category</a>
                                                                    </h4>
                                                                </div>
                                                                <div id = \"collapse2\" class=\"panel-collapse collapse in\" >
                                                                    <div class=\"panel-body\" >";
                                                                        getCategoryCheckboxes(1);

    echo "
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    <div class='row'>
                                                        <div id='brandCategoryPrimaryTaggingContainer' class='input-field col s12'>
                                                        <div class=\"\">
                                                        
                                                        <div class=\"panel-group\">
                                                            <div class=\"panel panel-default\">
                                                                <div class=\"panel-heading\">
                                                                    <h4 class=\"panel-title\">
                                                                        <a data-toggle=\"collapse\" href=\"#collapse3\">Select Primary Tagging</a>
                                                                    </h4 >
                                                                </div >
                                                                <div id = \"collapse3\" class=\"panel-collapse collapse in\" >
                                                                    <div class=\"panel-body\" >";
                                                                        getCategoryCheckboxes(2);

    echo "
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    <div class='row'>
                                                        <div id='brandCategoryContainer' class='input-field col s12'>
                                                        <div class=\"\">
                                                        
                                                        <div class=\"panel-group\">
                                                            <div class=\"panel panel-default\">
                                                                <div class=\"panel-heading\">
                                                                    <h4 class=\"panel-title\">
                                                                        <a data-toggle=\"collapse\" href=\"#collapse1\">Select Secondary Taggings</a>
                                                                    </h4>
                                                                </div>
                                                                <div id=\"collapse1\" class=\"panel-collapse collapse in\">
                                                                    <div class=\"panel-body\">";
                                                                        getCategoryCheckboxes(0);

    echo "
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        </div>
                                                    </div>
                                                    <div class='row' style='margin-top: 5%;'>
                                                        <div class=\"input-field col s12\">
                                                        <h2>Select Opening and Closing Times</h2>
                                                            <table class=\"table table-hover\" style='margin-top: 5%;'>
                                                                <thead>
                                                                <tr>
                                                                    <th>Day</th>
                                                                    <th>Opening Time</th>
                                                                    <th>Closing Time</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id='opening_hours_table'>
                                                                    <tr>
                                                                        <td>Mon</td>
                                                                        <td><select id='open_mon' name='open_mon'>"; getHoursOptions(''); echo "</select></td>
                                                                        <td><select id='close_mon' name='close_mon'>"; getHoursOptions(''); echo "</select></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tues</td>
                                                                        <td><select id='open_tues' name='open_tues'>"; getHoursOptions(''); echo "</select></td>
                                                                        <td><select id='close_tues' name='close_tues'>"; getHoursOptions(''); echo "</select></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Wed</td>
                                                                        <td><select id='open_wed' name='open_wed'>"; getHoursOptions(''); echo "</select></td>
                                                                        <td><select id='close_wed' name='close_wed'>"; getHoursOptions(''); echo "</select></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Thurs</td>
                                                                        <td><select id='open_thurs' name='open_thurs'>"; getHoursOptions(''); echo "</select></td>
                                                                        <td><select id='close_thurs' name='close_thurs'>"; getHoursOptions(''); echo "</select></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Fri</td>
                                                                        <td><select id='open_fri' name='open_fri'>"; getHoursOptions(''); echo "</select></td>
                                                                        <td><select id='close_fri' name='close_fri'>"; getHoursOptions(''); echo "</select></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Sat</td>
                                                                        <td><select id='open_sat' name='open_sat'>"; getHoursOptions(''); echo "</select></td>
                                                                        <td><select id='close_sat' name='close_sat'>"; getHoursOptions(''); echo "</select></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Sun</td>
                                                                        <td><select id='open_sun' name='open_sun'>"; getHoursOptions(''); echo "</select></td>
                                                                        <td><select id='close_sun' name='close_sun'>"; getHoursOptions(''); echo "</select></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class=\"row\" style=\"padding-top: 5%;\">
                                                    <h2>Address information</h2>
                                                    <div class=\"row\">
                                                        <div class=\"input-field col s12\">
                                                            <select id=\"city\" name=\"city\" style='display: block;'>
                                                               ";

                                                    getCitySelected('');
    echo "
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"input-field col s12\">
                                                            <select id=\"shopping_center\" name=\"shopping_center\" style='display: block;'>
                                                              ";

                                                    getShoppingCentersSelected('');
    echo "
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"input-field col s12\">
                                                            <input id=\"store_location\" name=\"store_location\" type=\"text\" class=\"validate\">
                                                            <label for=\"store_location\">Store Location</label>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"input-field col s12\">
                                                            <input id=\"list_phone\" name=\"list_phone\" type=\"text\" class=\"validate\">
                                                            <label for=\"list_phone\">Contact Phone</label>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"input-field col s12\">
                                                            <input id=\"email\" name=\"email\" type=\"email\" class=\"validate\">
                                                            <label for=\"email\">Contact Email</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=\"row\" style=\"padding-top: 5%;\">
                                                    <h2>Logo</h2>

                                                    <div class=\"db-v2-list-form-inn-tit\">
                                                        <h5>Logo <span class=\"v2-db-form-note\">(image size 1350x500):<span></h5>
                                                    </div>

                                                    <div class=\"row tz-file-upload\">
                                                        <div class=\"file-field input-field\">
                                                            <div class=\"tz-up-btn\"> <span>File</span>
                                                                <input type=\"file\" name=\"logo\" id=\"uploadLogo\"> </div>
                                                            <div class=\"file-path-wrapper db-v2-pg-inp\">
                                                                <input class=\"file-path validate\" type=\"text\">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class=\"row\" style=\"padding-top: 5%;\">
                                                    <h2>Gallery</h2>
                                                    <div class=\"db-v2-list-form-inn-tit\">
                                                        <h5>Gallery <span class=\"v2-db-form-note\">(upload max 5 photos note:size 750x500):<span></h5>
                                                    </div>
                                                    <div class=\"row tz-file-upload\">
                                                        <div class=\"file-field input-field\">
                                                            <div class=\"tz-up-btn\"> <span>File</span>
                                                                <input type=\"file\" name='brandImages' id='brandImages' multiple> </div>
                                                            <div class=\"file-path-wrapper db-v2-pg-inp\">
                                                                <input class=\"file-path validate\" id='brandImagesValidate' type=\"text\">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=\"row\" style=\"padding-top: 5%;\">
                                                    <h2>Other information</h2>
                                                    <div class=\"row\">
                                                        <div class=\"input-field col s12\">
                                                            <select id=\"price_category\" name=\"price_category\" style='display: block;'>
                                                                ";

                                                getPriceCategorySelected('');
    echo "
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"input-field col s12\">
                                                            <textarea id=\"policies\" name=\"policies\" class=\"materialize-textarea\"></textarea>
                                                            <label for=\"policies\">Policies</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=\"row\">
                                                    <div class=\"input-field col s12 v2-mar-top-40\"> <a class=\"waves-effect waves-light btn-large full-btn\" href=\"#\" id=\"submitNewBrand\">Submit Listing</a> </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--<div class=\"admin-pag-na\">
                                <ul class=\"pagination list-pagenat\">
                                    <li class=\"disabled\"><a href=\"#!!\"><i class=\"material-icons\">chevron_left</i></a> </li>
                                    <li class=\"active\"><a href=\"#!\">1</a> </li>
                                    <li class=\"waves-effect\"><a href=\"#!\">2</a> </li>
                                    <li class=\"waves-effect\"><a href=\"#!\">3</a> </li>
                                    <li class=\"waves-effect\"><a href=\"#!\">4</a> </li>
                                    <li class=\"waves-effect\"><a href=\"#!\">5</a> </li>
                                    <li class=\"waves-effect\"><a href=\"#!\">6</a> </li>
                                    <li class=\"waves-effect\"><a href=\"#!\">7</a> </li>
                                    <li class=\"waves-effect\"><a href=\"#!\">8</a> </li>
                                    <li class=\"waves-effect\"><a href=\"#!\"><i class=\"material-icons\">chevron_right</i></a> </li>
                                </ul>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>";
}

function getAdminTimings(){
    echo " <div class=\"sb2-2\">
                <!--== breadcrumbs ==-->

            </div>";
}

function getAdminListUsersAdd(){
    echo "                <div class=\"sb2-2\">
                <!--== breadcrumbs ==-->
                <div class=\"sb2-2-2\">
                    <ul>
                        <li><a href=\"index.html\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i> Home</a> </li>
                        <li class=\"active-bre\"><a href=\"#\"> Add User</a> </li>
                        <li class=\"page-back\"><a href=\"#\"><i class=\"fa fa-backward\" aria-hidden=\"true\"></i> Back</a> </li>
                    </ul>
                </div>
                <div class=\"tz-2 tz-2-admin\">
                    <div class=\"tz-2-com tz-2-main\">
                        <h4>Add New User</h4> <a class=\"dropdown-button drop-down-meta drop-down-meta-inn\" href=\"#\" data-activates=\"dr-list\"><i class=\"material-icons\">more_vert</i></a>
                        <ul id=\"dr-list\" class=\"dropdown-content\">
                            <li><a href=\"#!\">Add New</a> </li>
                            <li><a href=\"#!\">Edit</a> </li>
                            <li><a href=\"#!\">Update</a> </li>
                            <li class=\"divider\"></li>
                            <li><a href=\"#!\"><i class=\"material-icons\">delete</i>Delete</a> </li>
                            <li><a href=\"#!\"><i class=\"material-icons\">subject</i>View All</a> </li>
                            <li><a href=\"#!\"><i class=\"material-icons\">play_for_work</i>Download</a> </li>
                        </ul>
                        <!-- Dropdown Structure -->
                        <div class=\"split-row\">
                            <div class=\"col-md-12\">
                                <div class=\"box-inn-sp ad-inn-page\">
                                    <div class=\"tab-inn ad-tab-inn\">
                                        <div class=\"hom-cre-acc-left hom-cre-acc-right\">
                                            <div class=\"\">
                                                <div id=\"error_container\"></div>
                                                <form class=\"\" id=\"addUserForm\" action=\"\" method=\"post\" role=\"form\" enctype=\"multipart/form-data\">
                                                    <div class=\"row\">
                                                        <div class=\"input-field col s6\">
                                                            <input id=\"user_first_name\" name=\"user_first_name\" type=\"text\" class=\"validate\">
                                                            <label for=\"user_first_name\">First Name</label>
                                                        </div>
                                                        <div class=\"input-field col s6\">
                                                            <input id=\"user_last_name\" name=\"user_last_name\" type=\"text\" class=\"validate\">
                                                            <label for=\"user_last_name\">Last Name</label>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"input-field col s6\">
                                                            <input id=\"user_username\" name=\"user_username\" type=\"text\" class=\"validate\">
                                                            <label for=\"user_username\">Username</label>
                                                        </div>
                                                        <div class=\"input-field col s6\">
                                                            <input id=\"user_password\" name=\"user_password\" type=\"text\" class=\"validate\">
                                                            <label for=\"user_password\">Password</label>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"input-field col s12\">
                                                            <input id=\"user_list_phone\" name=\"user_list_phone\" type=\"text\" class=\"validate\">
                                                            <label for=\"user_list_phone\">Phone</label>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"input-field col s12\">
                                                            <input id=\"user_email\" name=\"user_email\" type=\"email\" class=\"validate\">
                                                            <label for=\"user_email\">Email</label>
                                                        </div>
                                                    </div>
                                                  
                                                    <div class=\"row\">
                                                        <div class=\"input-field col s12\">
                                                            <select id=\"user_type\" name=\"user_type\">
                                                                <option value=\"\" disabled selected>User Type</option>
                                                                <option value=\"Free\">Free</option>
                                                                <option value=\"Premium\">Premium</option>
                                                                <option value=\"Premium Plus\">Premium Plus</option>
                                                                <option value=\"Ultra Premium Plus\">Ultra Premium Plus</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"input-field col s12\">
                                                            <select id=\"user_city\" name=\"user_city\">
                                                                <option value=\"\" disabled selected>Choose your city</option>
                                                                <option value=\"Kyoto\">Kyoto</option>
                                                                <option value=\"Charleston\">Charleston</option>
                                                                <option value=\"Florence\">Florence</option>
                                                                <option value=\"Rome\">Rome</option>
                                                                <option value=\"Mexico City\">Mexico City</option>
                                                                <option value=\"Barcelona\">Barcelona</option>
                                                                <option value=\"San Francisco\">San Francisco</option>
                                                                <option value=\"Chicago\">Chicago</option>
                                                                <option value=\"Paris\">Paris</option>
                                                                <option value=\"Tokyo\">Tokyo</option>
                                                                <option value=\"Beijing\">Beijing</option>
                                                                <option value=\"Jerusalem\">Jerusalem</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"input-field col s12\">
                                                            <textarea id=\"user_description\" name=\"user_description\" class=\"materialize-textarea\"></textarea>
                                                            <label for=\"user_description\">User Descriptions</label>
                                                        </div>
                                                    </div>
                                                    <div class=\"row\">
                                                        <div class=\"input-field col s12\"> <a class=\"waves-effect waves-light btn-large full-btn\" href=\"#\" id=\"addUser\">Submit User</a> </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<!--                                <div class=\"admin-pag-na\">-->
<!--                                    <ul class=\"pagination list-pagenat\">-->
<!--                                        <li class=\"disabled\"><a href=\"#!!\"><i class=\"material-icons\">chevron_left</i></a> </li>-->
<!--                                        <li class=\"active\"><a href=\"#!\">1</a> </li>-->
<!--                                        <li class=\"waves-effect\"><a href=\"#!\">2</a> </li>-->
<!--                                        <li class=\"waves-effect\"><a href=\"#!\">3</a> </li>-->
<!--                                        <li class=\"waves-effect\"><a href=\"#!\">4</a> </li>-->
<!--                                        <li class=\"waves-effect\"><a href=\"#!\">5</a> </li>-->
<!--                                        <li class=\"waves-effect\"><a href=\"#!\">6</a> </li>-->
<!--                                        <li class=\"waves-effect\"><a href=\"#!\">7</a> </li>-->
<!--                                        <li class=\"waves-effect\"><a href=\"#!\">8</a> </li>-->
<!--                                        <li class=\"waves-effect\"><a href=\"#!\"><i class=\"material-icons\">chevron_right</i></a> </li>-->
<!--                                    </ul>-->
<!--                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
";

}

function getAdminAllUsers(){
    echo "            <div class=\"sb2-2\">
                <!--== breadcrumbs ==-->
                <div class=\"sb2-2-2\">
                    <ul>
                        <li><a href=\"index.html\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i> Home</a> </li>
                        <li class=\"active-bre\"><a href=\"#\"> All Users</a> </li>
                        <li class=\"page-back\"><a href=\"admin.html\"><i class=\"fa fa-backward\" aria-hidden=\"true\"></i> Back</a> </li>
                    </ul>
                </div>
                <div class=\"tz-2 tz-2-admin\">
                    <div class=\"tz-2-com tz-2-main\">
                        <h4>All Users</h4> <a class=\"dropdown-button drop-down-meta drop-down-meta-inn\" href=\"#\" data-activates=\"dr-list\"><i class=\"material-icons\">more_vert</i></a>
                        <ul id=\"dr-list\" class=\"dropdown-content\">
                            <li><a href=\"#!\">Add New</a> </li>
                            <li><a href=\"#!\">Edit</a> </li>
                            <li><a href=\"#!\">Update</a> </li>
                            <li class=\"divider\"></li>
                            <li><a href=\"#!\"><i class=\"material-icons\">delete</i>Delete</a> </li>
                            <li><a href=\"#!\"><i class=\"material-icons\">subject</i>View All</a> </li>
                            <li><a href=\"#!\"><i class=\"material-icons\">play_for_work</i>Download</a> </li>
                        </ul>
                        <!-- Dropdown Structure -->
                        <div class=\"split-row\">
                            <div class=\"col-md-12\">
                                <div class=\"box-inn-sp ad-inn-page\">
                                    <div class=\"tab-inn ad-tab-inn\">
                                        <div class=\"table-responsive\">
                                            <table class=\"table table-hover\">
                                                <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Username</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>User Type</th>
                                                    <th>City</th>
                                                    <th>Description</th>
                                                    <th>Active</th>
                                                </tr>
                                                </thead>
                                                <tbody>";

                                                    generateAllUsersTable($_SESSION['id']);

                    echo "
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
<!--                                <div class=\"admin-pag-na\">-->
<!--                                    <ul class=\"pagination list-pagenat\">-->
<!--                                        <li class=\"disabled\"><a href=\"#!!\"><i class=\"material-icons\">chevron_left</i></a> </li>-->
<!--                                        <li class=\"active\"><a href=\"#!\">1</a> </li>-->
<!--                                        <li class=\"waves-effect\"><a href=\"#!\">2</a> </li>-->
<!--                                        <li class=\"waves-effect\"><a href=\"#!\">3</a> </li>-->
<!--                                        <li class=\"waves-effect\"><a href=\"#!\">4</a> </li>-->
<!--                                        <li class=\"waves-effect\"><a href=\"#!\">5</a> </li>-->
<!--                                        <li class=\"waves-effect\"><a href=\"#!\">6</a> </li>-->
<!--                                        <li class=\"waves-effect\"><a href=\"#!\">7</a> </li>-->
<!--                                        <li class=\"waves-effect\"><a href=\"#!\">8</a> </li>-->
<!--                                        <li class=\"waves-effect\"><a href=\"#!\"><i class=\"material-icons\">chevron_right</i></a> </li>-->
<!--                                    </ul>-->
<!--                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
";
}

function getAdminReviews(){
    $brands = getAllBrands($_SESSION['id']);

    echo "
            <div class=\"sb2-2\">
            <!--== breadcrumbs ==-->
            <div class=\"sb2-2-2\">
                <ul>
                    <li><a href=\"index.html\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i> Home</a> </li>
                    <li class=\"active-bre\"><a href=\"#\"> All Reviews</a> </li>
                    <li class=\"page-back\"><a href=\"admin.html\"><i class=\"fa fa-backward\" aria-hidden=\"true\"></i> Back</a> </li>
                </ul>
            </div>
            <div class=\"tz-2 tz-2-admin\">
                <div class=\"tz-2-com tz-2-main\">
                    <h4>All Reviews</h4> <a class=\"dropdown-button drop-down-meta drop-down-meta-inn\" href=\"#\" data-activates=\"dr-list\"><i class=\"material-icons\">more_vert</i></a>
                    <ul id=\"dr-list\" class=\"dropdown-content\">
                        <li><a href=\"#!\">Add New</a> </li>
                        <li><a href=\"#!\">Edit</a> </li>
                        <li><a href=\"#!\">Update</a> </li>
                        <li class=\"divider\"></li>
                        <li><a href=\"#!\"><i class=\"material-icons\">delete</i>Delete</a> </li>
                        <li><a href=\"#!\"><i class=\"material-icons\">subject</i>View All</a> </li>
                        <li><a href=\"#!\"><i class=\"material-icons\">play_for_work</i>Download</a> </li>
                    </ul>
                    <!-- Dropdown Structure -->
                    <div class=\"split-row\">
                        <div class=\"col-md-12\">
                            <div class=\"box-inn-sp ad-inn-page\">
                                <div class=\"tab-inn ad-tab-inn\">
                                    <div class=\"table-responsive\">
                                    <form class=\"\" id=\"brandListingDeleteForm\" action=\"\" method=\"post\" role=\"form\" enctype=\"multipart/form-data\">
                                        <table id=\"table\" data-toggle=\"table\" data-pagination=\"true\" data-search=\"true\" data-show-columns=\"true\" data-show-pagination-switch=\"true\" data-show-refresh=\"true\" data-key-events=\"true\" data-show-toggle=\"true\" data-resizable=\"true\" data-cookie=\"true\" data-cookie-id-table=\"saveId\" data-show-export=\"true\" data-click-to-select=\"true\" data-toolbar=\"#toolbar\">
                                            <thead>
                                            <tr>
                                                <th>Brand Name</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>City</th>
                                                <th>Review</th>
                                                <th>Rating</th>
                                                <th>Date</th>
                                            </tr>
                                            </thead>
                                            <tbody id=\"all-listing\">                                
                                                ";

    $MAX = 10;

    $actual_link = $_POST['page_nr'];

    // MAKES FILTERS OF ALL PARTS IN THE URL SENT
    $parts = parse_url($actual_link);
    if(isset($parts['query'])) {
        parse_str($parts['query'], $filters);
    }

    $page = 1;

    if(isset($filters) && isset($filters['page'])) {
        $page = $filters['page'];
    }

    if($page == 1){
        $page_start = 0;
        $page_max = $MAX;
    } else {
        $page_start = $page * $MAX;

        if($page_start + $MAX > sizeof($brands)){
            $page_max = (($page_start + $MAX) - sizeof($brands)) + $page_start;
        } else {
            $page_max = $page_start + $MAX;
        }
    }

    $total_reviews = array();

    if(sizeof($brands) > 0) {
        for($i = $page_start; $i < $page_max; $i++) {
            $reviews = getReviews($brands[$i]->getId());

            if(!empty($reviews)) {
                foreach ($reviews as $review) {
                    $total_reviews[] = $review;

                    echo "<tr>";
                    echo "<td>" . $brands[$i]->getName() . "</td>";
                    echo "<td>" . $review->getName() . "</td>";
                    echo "<td>" . $review->getEmail() . "</td>";
                    echo "<td>" . $review->getPhone() . "</td>";
                    echo "<td>" . $review->getCity() . "</td>";
                    echo "<td>" . $review->getReview() . "</td>";
                    echo "<td>" . $review->getRating() . "</td>";
                    echo "<td>" . $review->getDate() . "</td>";
                    echo "</tr>";
                }
            }
        }
    }
    echo "

                                            </tbody>
                                        </table>
                                        <div></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class=\"admin-pag-na\">
                                <ul class='pagination list-pagenat'>";

    $MAX = 5;
    $start = 0;
    $end = $MAX;

    $num_pages = ceil(sizeof($total_reviews)/$MAX) - 1;

    // Get start and end of loop
    if($page > $MAX){
        $start = $page - round($MAX / 2, 0, PHP_ROUND_HALF_DOWN) - 1;
        $end = $page + round($MAX / 2, 0, PHP_ROUND_HALF_DOWN);
        if(round($MAX / 2, 0, PHP_ROUND_HALF_DOWN) + $page > $num_pages){
            $end = $num_pages;
        }
    }

    // Get next and prev button
    $prev = $end - $MAX;
    $next = $end + 1;

    if($next > $num_pages){
        $next = $num_pages;
    }

    if($end <= $MAX){
        $prev = 0;
        if($num_pages < $MAX) {
            $next = $end;
        }
    }

    if($end > $num_pages){
        $end = $num_pages;
    }


    if(sizeof($total_reviews) > ($MAX * 10)) {
        if ($prev === 0) {
            echo "<li class=\"disabled\"><a href=\"#\"><i class=\"material-icons\">chevron_left</i></a> </li>";
        } else {
            echo "<li class=\"waves-effect\"><a onclick=\"updateAdminReviewsTable($prev);\" href='#'><i class=\"material-icons\">chevron_left</i></a> </li>";
        }
    }

    for($i = $start; $i < $end; $i++){
        $n = $i + 1;
        if($n == $page){
            echo "<li class='active'><a>$n</a> </li>";
        } else {
            echo "<li class='waves-effect'><a onclick=\"updateAdminReviewsTable($n);\" href='#'>$n</a> </li>";
        }
    }

    if(sizeof($total_reviews) > ($MAX * 10)) {
        if ($next === 0) {
            echo "<li class=\"disabled\"><a href=\"#\"><i class=\"material-icons\">chevron_right</i></a> </li>";
        } else {
            echo "<li class=\"waves-effect\"><a onclick=\"updateAdminReviewsTable($next);\"  href=\"#\"><i class=\"material-icons\">chevron_right</i></a> </li>";
        }
    }

    echo "                     </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
}