<?php session_start(); ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 03/08/2018
 * Time: 10:00
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

<!DOCTYPE html>
<html lang="en">

<head>
    <title>World Best Local Directory Website template</title>
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
</head>

<body>
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>

<script src="js/jquery.min.js"></script>

<!--== MAIN CONTRAINER ==-->
<?php
include_once "partials/header.php";
?>

<!--== BODY CONTNAINER ==-->
<div class="container-fluid sb2">
    <div class="row">
        <div class="sb2-1">
            <?php
                include_once "partials/navigation.php";
            ?>
        </div>
        <!--== BODY INNER CONTAINER ==-->
        <div id="innerContents">
            <div class="sb2-2">
                <!--== breadcrumbs ==-->
                <div class="sb2-2-2">
                    <ul>
                        <li><a href="index.html"><i class="fa fa-home" aria-hidden="true"></i> Home</a> </li>
                        <li class="active-bre"><a href="#"> Add Listing Category</a> </li>
                        <li class="page-back"><a href="#"><i class="fa fa-backward" aria-hidden="true"></i> Back</a> </li>
                    </ul>
                </div>
                <div class="tz-2 tz-2-admin">
                    <div class="tz-2-com tz-2-main">
                        <h4>Add Listing Category</h4> <a class="dropdown-button drop-down-meta drop-down-meta-inn" href="#" data-activates="dr-list"><i class="material-icons">more_vert</i></a>
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
                                <div class="box-inn-sp ad-mar-to-min">
                                    <div class="tab-inn ad-tab-inn">
                                        <div class="tz2-form-pay tz2-form-com">
                                            <form>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input type="text" class="validate">
                                                        <label>Category Name</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <select>
                                                            <option value="" disabled selected>Select Status</option>
                                                            <option value="1">Active</option>
                                                            <option value="2">Non-Active</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row tz-file-upload">
                                                    <div class="file-field input-field">
                                                        <div class="tz-up-btn"> <span>File</span>
                                                            <input type="file"> </div>
                                                        <div class="file-path-wrapper">
                                                            <input class="file-path validate" type="text"> </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <div class="checkbox11">
                                                            <label><input type="checkbox" value="">Women</label>
                                                            <label><input type="checkbox" value="">Kids</label>
                                                            <label><input type="checkbox" value="">Clothing</label>
                                                            <label><input type="checkbox" value="">Sports</label>
                                                            <label><input type="checkbox" value="">Accessories</label>
                                                            <label><input type="checkbox" value="">Bags</label>
                                                            <label><input type="checkbox" value="">Footwear</label>
                                                            <label><input type="checkbox" value="">Sunglasses</label>
                                                            <label><input type="checkbox" value="">Formal</label>
                                                            <label><input type="checkbox" value="">Undergarments</label>
                                                            <label><input type="checkbox" value="">Swimwear</label>
                                                            <label><input type="checkbox" value="">Lingerie</label>
                                                            <label><input type="checkbox" value="">Jewellery</label>
                                                            <label><input type="checkbox" value="">Tailors and Textiles</label>
                                                            <label><input type="checkbox" value="">Arabic</label>
                                                            <label><input type="checkbox" value="">Desi</label>
                                                            <label><input type="checkbox" value="">Maternity</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input type="submit" value="SUBMIT" class="waves-effect waves-light full-btn"> </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
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
<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/materialize.min.js" type="text/javascript"></script>
<script src="js/custom.js"></script>
</body>

</html>
<?php endif; ?>