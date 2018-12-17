<?php session_start(); ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 06/08/2018
 * Time: 23:54
 */



$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds) . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

include_once $utilities_dir;

$mysqli = getConnection();

?>

<?php if (!isset($_SESSION['username'])): ?>
    <script type="text/javascript">
        window.location.href = "http://admin.fashant.com/login.php";
    </script>

<?php else: ?>

    <?php
    $brand_id = false;

    if(isset($_GET['id'])){
        $brand_id = $_GET['id'];
    }

    $brand = getBrand($brand_id);

    $categories = getBrandsCategories($brand_id, 0);
    $primary = getBrandsCategories($brand_id, 1);
    $secondary = getBrandsCategories($brand_id, 2);

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Edit Brand <?php echo $_GET['id']; ?></title>
        <!-- META TAGS -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- FAV ICON(BROWSER TAB ICON) -->
        <link rel="shortcut icon" href="images/fav.ico" type="image/x-icon">
        <!-- GOOGLE FONT -->
        <link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:500,700" rel="stylesheet">
        <!-- FONTAWESOME ICONS -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- ALL CSS FILES -->
        <link href="css/materialize.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
        <link href="css/responsive.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->

        <style>
            /*#opening_hours_table td select option {*/
                /*height: 35px;*/
            /*}*/
        </style>
    </head>

    <body>
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>

    <!--== MAIN CONTRAINER ==-->
    <?php include_once "partials/header.php"; ?>
    <!--== BODY CONTNAINER ==-->
    <div class="container-fluid sb2">
        <div class="row">
            <div class="sb2-1">
                <?php include_once "partials/navigation.php"; ?>
            </div>
            <!--== BODY INNER CONTAINER ==-->
            <div id="innerContents">
                <div class="sb2-2">
                <!--== breadcrumbs ==-->
                <div class="sb2-2-2">
                    <ul>
                        <li><a href="index.html"><i class="fa fa-home" aria-hidden="true"></i> Home</a> </li>
                        <li class="active-bre"><a href="#"> Edit Listing</a> </li>
                        <li class="page-back" onclick="window.history.back();"><a href="#"><i class="fa fa-backward" aria-hidden="true"></i> Back</a> </li>
                    </ul>
                </div>
                <div class="tz-2 tz-2-admin">
                    <div class="tz-2-com tz-2-main">
                        <h4>Edit Listing</h4> <a class="dropdown-button drop-down-meta drop-down-meta-inn" href="#" data-activates="dr-list"><i class="material-icons">more_vert</i></a>
                        <ul id="dr-list" class="dropdown-content">
                            <li><a href="#!">Add New</a> </li>
                            <li><a href="#!">Edit</a> </li>
                            <li><a href="#!">Update</a> </li>
                            <li class="divider"></li>
                            <li><a href="#!"><i class="material-icons">delete</i>Delete</a> </li>
                            <li><a href="#!"><i class="material-icons">subject</i>View All</a> </li>
                            <li><a href="#!"><i class="material-icons">play_for_work</i>Download</a> </li>
                        </ul>
                        <!-- Dropdown Structure -->
                        <div class="split-row">
                            <div class="col-md-12">
                                <div class="box-inn-sp ad-inn-page">
                                    <div class="tab-inn ad-tab-inn">
                                        <div class="hom-cre-acc-left hom-cre-acc-right">
                                            <div class="">
                                                <form class="" id="edit_brand_form" name="edit_brand_form" action="" method="post" role="form" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <h5>Brand name</h5>
                                                            <input id="edit_name" name="edit_name" type="text" class="validate" value="<?php echo $brand->getName(); ?>" onchange="updateBrandInfo(this.id, this.value, <?php echo $brand_id; ?>);">
                                                        </div>
                                                        <div class="input-field col s12">
                                                            <h5>About brand</h5>
                                                            <textarea id="edit_about" name="edit_about" type="text" class="validate" onchange="updateBrandInfo(this.id, this.value, <?php echo $brand_id; ?>);"><?php echo $brand->getAbout(); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class=\"panel-group\">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4 class="panel-title">
                                                                        <a data-toggle="collapse" href="#collapse1">Select Primary Tagging</a>
                                                                    </h4>
                                                                </div>
                                                                <div id ="collapse1" class="panel-collapse collapse in" >
                                                                    <div class="panel-body">
                                                                        <?php getCategoryCheckboxesSelected(1, $categories, $brand_id); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class=\"panel-group\">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4 class="panel-title">
                                                                        <a data-toggle="collapse" href="#collapse2">Select Primary Tagging</a>
                                                                    </h4>
                                                                </div>
                                                                <div id ="collapse2" class="panel-collapse collapse in" >
                                                                    <div class="panel-body">
                                                                        <?php getCategoryCheckboxesSelected(2, $primary, $brand_id); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class=\"panel-group\">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4 class="panel-title">
                                                                        <a data-toggle="collapse" href="#collapse3">Select Primary Tagging</a>
                                                                    </h4>
                                                                </div>
                                                                <div id ="collapse3" class="panel-collapse collapse in" >
                                                                    <div class="panel-body">
                                                                        <?php getCategoryCheckboxesSelected(0, $secondary, $brand_id); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <h5>City</h5>
                                                            <select id="edit_city" name="edit_city" class="validate" onchange="updateBrandInfo(this.id, this.value, <?php echo $brand_id; ?>);">
                                                                <?php
                                                                    getCitySelected($brand->getCity());
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <h5>Shopping Center</h5>
                                                            <select id="edit_center" name="edit_center" class="validate" onchange="updateBrandInfo(this.id, this.value, <?php echo $brand_id; ?>);">
                                                                <?php
                                                                    getShoppingCentersSelected($brand->getShoppingCenter());
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <h5>Location</h5>
                                                            <input id="edit_location" name="edit_location" type="email" class="validate" value="<?php echo $brand->getStoreLocation(); ?>" onchange="updateBrandInfo(this.id, this.value, <?php echo $brand_id; ?>);">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <h5>Address</h5>
                                                            <input id="edit_address" name="edit_address" type="text" class="validate" value="<?php echo $brand->getAddress(); ?>" onchange="updateBrandInfo(this.id, this.value, <?php echo $brand_id; ?>);">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <h5>Phone</h5>
                                                            <input id="edit_phone" name="edit_phone" type="text" class="validate" value="<?php echo $brand->getContactPhone(); ?>" onchange="updateBrandInfo(this.id, this.value, <?php echo $brand_id; ?>);">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <h5>Email</h5>
                                                            <input id="edit_email" name="edit_email" type="text" class="validate" value="<?php echo $brand->getContactEmail(); ?>" onchange="updateBrandInfo(this.id, this.value, <?php echo $brand_id; ?>);">
                                                        </div>
                                                    </div>
<!--                                                    <div class="row">-->
<!--                                                        <div class="db-v2-list-form-inn-tit">-->
<!--                                                            <h5>Logo <span class="v2-db-form-note">(image size 1350x500):<span></h5>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                    <div class="row tz-file-upload">-->
<!--                                                        <div class="file-field input-field">-->
<!--                                                            <div class="tz-up-btn"> <span>File</span>-->
<!--                                                                <input type="file"> </div>-->
<!--                                                            <div class="file-path-wrapper db-v2-pg-inp">-->
<!--                                                                <input class="file-path validate" type="text">-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                    <div class="row">-->
<!--                                                        <div class="db-v2-list-form-inn-tit">-->
<!--                                                            <h5>Photo Gallery <span class="v2-db-form-note">(upload max 5 photos note:size 750x500):<span></h5>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                    <div class="row tz-file-upload">-->
<!--                                                        <div class="file-field input-field">-->
<!--                                                            <div class="tz-up-btn"> <span>File</span>-->
<!--                                                                <input type="file" multiple> </div>-->
<!--                                                            <div class="file-path-wrapper db-v2-pg-inp">-->
<!--                                                                <input class="file-path validate" type="text">-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <h5>Price category</h5>
                                                            <select id="edit_price" name="edit_price" onchange="updateBrandInfo(this.id, this.value, <?php echo $brand_id; ?>);">
                                                                <?php
                                                                    getPriceCategorySelected($brand->getPriceCategory());
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <h5>Policy</h5>
                                                            <textarea id="edit_policies" name="edit_policies" type="text" class="validate" onchange="updateBrandInfo(this.id, this.value, <?php echo $brand_id; ?>);"><?php echo $brand->getPolicies(); ?></textarea>
                                                        </div>
                                                    </div>
<!--                                                    <div class="row">-->
<!--                                                        <div class="input-field col s12 v2-mar-top-40"> <a class="waves-effect waves-light btn-large full-btn" href="#" id="update_brand_changes">Update Changes</a> </div>-->
<!--                                                    </div>-->
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
                                                            <td><select onchange="updateOpeningHours('open_mon', this.value, <?php echo $brand->getOpeningHours(); ?>);" id='open_mon' name='open_mon'><?php getHoursOptions($brand->getOpenMon()); ?> </select></td>
                                                            <td><select onchange="updateOpeningHours('close_mon', this.value, <?php echo $brand->getOpeningHours(); ?>);" id='close_mon' name='close_mon'><?php getHoursOptions($brand->getCloseMon()); ?></select></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tues</td>
                                                            <td><select onchange="updateOpeningHours('open_tues', this.value, <?php echo $brand->getOpeningHours(); ?>);" id='open_tues' name='open_tues'><?php getHoursOptions($brand->getOpenTues()); ?></select></td>
                                                            <td><select onchange="updateOpeningHours('close_tues', this.value, <?php echo $brand->getOpeningHours(); ?>);" id='close_tues' name='close_tues'><?php getHoursOptions($brand->getCloseTues()); ?></select></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Wed</td>
                                                            <td><select onchange="updateOpeningHours('open_wed', this.value, <?php echo $brand->getOpeningHours(); ?>);" id='open_wed' name='open_wed'><?php getHoursOptions($brand->getOpenWed()); ?></select></td>
                                                            <td><select onchange="updateOpeningHours('close_wed', this.value, <?php echo $brand->getOpeningHours(); ?>);" id='close_wed' name='close_wed'><?php getHoursOptions($brand->getCloseWed()); ?></select></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Thurs</td>
                                                            <td><select onchange="updateOpeningHours('open_thurs', this.value, <?php echo $brand->getOpeningHours(); ?>);" id='open_thurs' name='open_thurs'><?php getHoursOptions($brand->getOpenThurs()); ?></select></td>
                                                            <td><select onchange="updateOpeningHours('close_thurs', this.value, <?php echo $brand->getOpeningHours(); ?>);" id='close_thurs' name='close_thurs'><?php getHoursOptions($brand->getCloseThurs()); ?></select></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Fri</td>
                                                            <td><select onchange="updateOpeningHours('open_fri', this.value, <?php echo $brand->getOpeningHours(); ?>);" id='open_fri' name='open_fri'><?php getHoursOptions($brand->getOpenFri()); ?></select></td>
                                                            <td><select onchange="updateOpeningHours('close_fri', this.value, <?php echo $brand->getOpeningHours(); ?>);" id='close_fri' name='close_fri'><?php getHoursOptions($brand->getCloseFri()); ?></select></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Sat</td>
                                                            <td><select onchange="updateOpeningHours('open_sat', this.value, <?php echo $brand->getOpeningHours(); ?>);" id='open_sat' name='open_sat'><?php getHoursOptions($brand->getOpenSat()); ?></select></td>
                                                            <td><select onchange="updateOpeningHours('close_sat', this.value, <?php echo $brand->getOpeningHours(); ?>);" id='close_sat' name='close_sat'><?php getHoursOptions($brand->getCloseSat()); ?></select></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Sun</td>
                                                            <td><select onchange="updateOpeningHours('open_sun', this.value, <?php echo $brand->getOpeningHours(); ?>);" id='open_sun' name='open_sun'><?php getHoursOptions($brand->getOpenSun()); ?></select></td>
                                                            <td><select onchange="updateOpeningHours('close_sun', this.value, <?php echo $brand->getOpeningHours(); ?>);" id='close_sun' name='close_sun'><?php getHoursOptions($brand->getCloseSun()); ?></select></td>
                                                        </tr>
                                                        </tbody>
                                                        </table>
                                                    </div>
                                            </div>
                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<!--                                <div class="admin-pag-na">-->
<!--                                    <ul class="pagination list-pagenat">-->
<!--                                        <li class="disabled"><a href="#!!"><i class="material-icons">chevron_left</i></a> </li>-->
<!--                                        <li class="active"><a href="#!">1</a> </li>-->
<!--                                        <li class="waves-effect"><a href="#!">2</a> </li>-->
<!--                                        <li class="waves-effect"><a href="#!">3</a> </li>-->
<!--                                        <li class="waves-effect"><a href="#!">4</a> </li>-->
<!--                                        <li class="waves-effect"><a href="#!">5</a> </li>-->
<!--                                        <li class="waves-effect"><a href="#!">6</a> </li>-->
<!--                                        <li class="waves-effect"><a href="#!">7</a> </li>-->
<!--                                        <li class="waves-effect"><a href="#!">8</a> </li>-->
<!--                                        <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a> </li>-->
<!--                                    </ul>-->
<!--                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!--== BOTTOM FLOAT ICON ==-->
    <section>
        <div class="fixed-action-btn vertical">
            <a class="btn-floating btn-large red pulse"> <i class="large material-icons">mode_edit</i> </a>
            <ul>
                <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a> </li>
                <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a> </li>
                <li><a class="btn-floating green"><i class="material-icons">publish</i></a> </li>
                <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a> </li>
            </ul>
        </div>
    </section>

    <!--SCRIPT FILES-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <script src="js/materialize.min.js" type="text/javascript"></script>
    <script src="js/custom.js"></script>
    <script src="js/formSubmit.js"></script>
    <script type="text/javascript">
        function updateBrandInfo(id, value, brand_id){
            $.ajax({
                type: 'post',
                url: 'partials/parseEditBrand.php',
                data: {id:id, value:value, brand_id:brand_id},
                success: function (msg) {
                    var result = msg.substr(0, msg.indexOf(' '));

                    if(result === "success"){
                        swal({
                            title:"Success!",
                            text:"You successfully changes the information.",
                            icon:"success",
                            timer: 2000
                        }).then(function () {
                            window.location.reload(true);
                        });
                    }
                    if (result === "failed") {
                        swal({
                            title:"Oops!",
                            text:"Something went wrong, it might be wrong information.",
                            icon:"error",
                            timer: 2000
                        }).then(function () {
                            window.location.reload(true);
                        });
                    }
                }
            });
        }

        function updateOpeningHours(type, value, id){
            $.ajax({
                type: 'post',
                url: 'partials/parseUpdateOpeningHours.php',
                data: {type:type, value:value, id:id},
                success: function (msg) {
                    var result = msg.substr(0,msg.indexOf(' ')); // "failed"

                    //alert(msg);

                    if(result === "success"){
                        swal({
                            title:"Success!",
                            text:"You've successfully updated your hours.",
                            icon:"success",
                            timer: 3000
                        }).then(function () {
                            window.location.reload(true);
                        });
                    }
                    if (result === "failed") {
                        swal("Oops!", "Something went wrong", "error");
                    }
                }
            });
        }
    </script>

    </body>

    </html>

<?php endif; ?>
