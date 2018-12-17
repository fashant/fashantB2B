<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 03/08/2018
 * Time: 08:39
 */
?>

<!--== MAIN CONTRAINER ==-->
<div class="container-fluid sb1">
    <div class="row">
        <!--== LOGO ==-->
        <div class="col-md-2 col-sm-3 col-xs-6 sb1-1"> <a href="#" class="btn-close-menu"><i class="fa fa-times" aria-hidden="true"></i></a> <a href="#" class="atab-menu"><i class="fa fa-bars tab-menu" aria-hidden="true"></i></a>
            <a href="#" class="logo"><img src="images/logo-black.png" alt="" /> </a>
        </div>
        <!--== SEARCH ==-->
        <div class="col-md-6 col-sm-6 mob-hide">
            <!--<form class="app-search">
                <input type="text" placeholder="Search..." class="form-control"> <a href="#"><i class="fa fa-search"></i></a> </form>-->
        </div>
        <!--== NOTIFICATION ==-->
        <div class="col-md-2 tab-hide">
            <div class="top-not-cen"> <a class='waves-effect btn-noti' href='#'><i class="fa fa-commenting-o" aria-hidden="true"></i><span>5</span></a> <a class='waves-effect btn-noti' href='#'><i class="fa fa-envelope-o" aria-hidden="true"></i><span>5</span></a> <a class='waves-effect btn-noti' href='#'><i class="fa fa-tag" aria-hidden="true"></i><span>5</span></a> </div>
        </div>
        <!--== MY ACCCOUNT ==-->
        <div class="col-md-2 col-sm-3 col-xs-6">
            <!-- Dropdown Trigger -->
            <a class='waves-effect dropdown-button top-user-pro' href='#' data-activates='top-menu'><img src="images/users/6.png" alt="" />My Account <i class="fa fa-angle-down" aria-hidden="true"></i> </a>
            <!-- Dropdown Structure -->
            <ul id='top-menu' class='dropdown-content top-menu-sty'>
                <li><a href="#" class="waves-effect"><i class="fa fa-cogs"></i>Admin Setting</a> </li>
                <!---<li><a href="admin-analytics.html"><i class="fa fa-bar-chart"></i> Analytics</a> </li>
                <li><a href="admin-ads.html"><i class="fa fa-buysellads" aria-hidden="true"></i>Ads</a> </li>
                <li><a href="admin-payment.html"><i class="fa fa-usd" aria-hidden="true"></i> Payments</a> </li>
                <li><a href="admin-notifications.html"><i class="fa fa-bell-o"></i>Notifications</a> </li>
                <li><a href="#" class="waves-effect"><i class="fa fa-undo" aria-hidden="true"></i> Backup Data</a> </li>
                <li class="divider"></li>--->
                <li><a href="logout.php" class="ho-dr-con-last waves-effect"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</a> </li>
            </ul>
        </div>
    </div>
</div>
