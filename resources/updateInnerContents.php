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
                                        <table class=\"table table-hover\">
                                            <thead>
                                            <tr>
                                                <th>Logo</th>
                                                <th>Brand Name</th>
                                                <th>Store Location</th>
                                                <th>City</th>
                                                <th>Shopping Center</th>
                                                <th>Price Category</th>
                                                <th>View</th>
                                                <th>Edit</th>
                                            </tr>
                                            </thead>
                                            <tbody id=\"all-listing\">

                                                ";
    generateAllListingTable($_SESSION['id']);

    echo "

                                            </tbody>
                                        </table>
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
                                                                <div id = \"collapse2\" class=\"panel-collapse collapse\" >
                                                                    <div class=\"panel-body\" >";
                                                                        getCategoryCheckboxes(1);

    echo "
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
                                                                <div id = \"collapse3\" class=\"panel-collapse collapse\" >
                                                                    <div class=\"panel-body\" >";
                                                                        getCategoryCheckboxes(2);

    echo "
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
                                                                <div id=\"collapse1\" class=\"panel-collapse collapse\">
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
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Mon</td>
                                                                        <td><input id=\"open_mon\" name=\"open_mon\" type=\"text\" class=\"validate\"></td>
                                                                        <td><input id=\"close_mon\" name=\"close_mon\" type=\"text\" class=\"validate\"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tues</td>
                                                                        <td><input id=\"open_tues\" name=\"open_tues\" type=\"text\" class=\"validate\"></td>
                                                                        <td><input id=\"close_tues\" name=\"close_tues\" type=\"text\" class=\"validate\"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Wed</td>
                                                                        <td><input id=\"open_wed\" name=\"open_wed\" type=\"text\" class=\"validate\"></td>
                                                                        <td><input id=\"close_wed\" name=\"close_wed\" type=\"text\" class=\"validate\"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Thurs</td>
                                                                        <td><input id=\"open_thurs\" name=\"open_thurs\" type=\"text\" class=\"validate\"></td>
                                                                        <td><input id=\"close_thurs\" name=\"close_thurs\" type=\"text\" class=\"validate\"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Fri</td>
                                                                        <td><input id=\"open_fri\" name=\"open_fri\" type=\"text\" class=\"validate\"></td>
                                                                        <td><input id=\"close_fri\" name=\"close_fri\" type=\"text\" class=\"validate\"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Sat</td>
                                                                        <td><input id=\"open_sat\" name=\"open_sat\" type=\"text\" class=\"validate\"></td>
                                                                        <td><input id=\"close_sat\" name=\"close_sat\" type=\"text\" class=\"validate\"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Sun</td>
                                                                        <td><input id=\"open_sun\" name=\"open_sun\" type=\"text\" class=\"validate\"></td>
                                                                        <td><input id=\"close_sun\" name=\"close_sun\" type=\"text\" class=\"validate\"></td>
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
                                                            <input id=\"list_addr\" name=\"address\" type=\"text\" class=\"validate\">
                                                            <label for=\"list_addr\">Address</label>
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
                                                            <input id=\"user_list_addr\" name=\"user_list_addr\" type=\"text\" class=\"validate\">
                                                            <label for=\"user_list_addr\">Address</label>
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
                                                    <th>Address</th>
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