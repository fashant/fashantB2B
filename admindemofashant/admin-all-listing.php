<?php session_start(); ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 03/08/2018
 * Time: 11:03
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
    <title>All Brands</title>
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

<body onload="updateInnerContents('innerContents', 'admin-all-listing.php');">
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>

<script src="js/jquery.min.js"></script>

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
<script src="js/formSubmit.js"></script>

</body>

</html>
<?php endif; ?>