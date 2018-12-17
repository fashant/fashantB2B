<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 03/08/2018
 * Time: 08:39
 */

?>

<!--== USER INFO ==-->
<div class="sb2-12">
    <ul>
        <li><img src="images/users/2.png" alt=""> </li>
        <li>
            <h5><?php echo $_SESSION['username']; ?> <span> Dubai</span></h5> </li>
        <li></li>
    </ul>
</div>
<!--== LEFT MENU ==-->
<div class="sb2-13">
    <ul class="collapsible" data-collapsible="accordion">
        <li><a href="#" class="menu-active"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a> </li>
        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-list-ul" aria-hidden="true"></i> Brand Listing</a>
            <div class="collapsible-body left-sub-menu">
                <ul>
                    <li><a href="#" onclick="updateInnerContents('innerContents', 'admin-all-listing.php')">All listing</a> </li>
                    <li><a href="#" onclick="updateInnerContents('innerContents', 'listingPanel.php')">Add New Brand</a> </li>
<!--                    <li><a href="#" onclick="updateInnerContents('innerContents', 'admin-list-category-add.php')">Add Brand Category</a> </li>-->
<!--                    <li><a href="#" onclick="updateInnerContents('innerContents', 'admin-timings.php')">Timings</a> </li>-->
                    <li><a href="excelUpload.php">Upload Excel</a> </li>
                </ul>
            </div>
        </li>
        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-list-ul" aria-hidden="true"></i> Reviews</a>
            <div class="collapsible-body left-sub-menu">
                <ul>
                    <li><a href="#" onclick="updateInnerContents('innerContents', 'admin-reviews.php')">All Reviews</a> </li>
                </ul>
            </div>
        </li>
        <!--<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-list-ul" aria-hidden="true"></i> Listing</a>
            <div class="collapsible-body left-sub-menu">
                <ul>
                    <li><a href="admin-all-listing.html">All listing</a> </li>
                    <li><a href="admin-list-add.html">Add New listing</a> </li>
                    <li><a href="admin-listing-category.html">All listing Categories</a> </li>
                    <li><a href="admin-list-category-add.html">Add listing Categories</a> </li>
                </ul>
            </div>
        </li>-->
        <?php if($_SESSION['id'] == $ADMIN):  ?>
        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-user" aria-hidden="true"></i> Users</a>
            <div class="collapsible-body left-sub-menu">
                <ul>
                    <li><a href="#" onclick="updateInnerContents('innerContents', 'admin-all-users.php');">All Users</a> </li>
                    <li><a href="#" onclick="updateInnerContents('innerContents', 'admin-list-users-add.php');">Add New user</a> </li>
                </ul>
            </div>
        </li>
        <?php endif; ?>
        <li><a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i> Analytics</a> </li>
        <li><a href="#" class="collapsible-header"><i class="fa fa-buysellads" aria-hidden="true"></i>Ads</a>
            <div class="collapsible-body left-sub-menu">
                <ul>
                    <li><a href="#">All Ads</a> </li>
                    <li><a href="#">Create New Ads</a> </li>
                </ul>
            </div>
        </li>

        <li><a href="#" class="collapsible-header"><i class="fa fa-bell-o" aria-hidden="true"></i>Notifications</a>
            <div class="collapsible-body left-sub-menu">
                <ul>
                    <li><a href="#">All Notifications</a> </li>
                    <li><a href="#">User Notifications</a> </li>
                    <li><a href="#">Push Notifications</a> </li>
                </ul>
            </div>
        </li>

        <li><a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> Setting</a> </li>
        <li><a href="#"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Social Media</a> </li>

    </ul>
</div>

<script src="js/updateInnerContents.js"></script>
