<?php session_start(); ?>
<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 27/09/2018
 * Time: 10:13
 */

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds) . $ds;

$utilities_dir = "{$base_dir}utilities.php";

include_once $utilities_dir;

$mysqli = getConnection();

if(isset($_POST['page'])) {
    switch ($_POST['page']){
        case '../userReviews.php':
            getReviewsPage();
            break;
        case '../userSettings.php':
            getSettingsPage();
            break;
        case '../userFavoriteBrands.php':
            getFavoriteBrandsPage();
            break;
        case '../userInvite.php':
            getUserInvitePage();
            break;
        default: break;
    }

}

function getReviewsPage(){
    $reviews = getUsersReviews($_SESSION['id']);

    if(!empty($reviews)):
    echo "<div class=\"pglist-p3 pglist-bg pglist-p-com\" id=\"ld-rew\">
        <div class=\"pglist-p-com-ti\">
            <h3><span>Your</span> Reviews</h3> </div>
        <div class=\"list-pg-inn-sp\">
            <div class=\"list-pg-write-rev\">
                <div class=\"lp-ur-all-rat\">
                    <h5>Reviews</h5>
                    <ul>";
                        getListingUsersReviews($reviews);
                    echo "</ul>
                </div>
            </div>
        </div>
    </div>";
    else:
        echo "<div class=\"pglist-p3 pglist-bg pglist-p-com\" id=\"ld-rew\">
            <div class=\"pglist-p-com-ti\">
                <h3><span>Your</span> Reviews</h3> </div>
            <div class=\"list-pg-inn-sp\">
                <div class=\"list-pg-write-rev\">
                    <div class=\"lp-ur-all-rat\">
                        <h5>Reviews</h5>
                        <ul>
                            No reviews yet.
                        </ul>
                    </div>
                </div>
            </div>
        </div>";
    endif;
}

function getSettingsPage(){
    $user = getUser($_SESSION['id']);
    $firstname = $user->getFirstName();
    $lastname = $user->getLastName();

    echo "<div class=\"input-group mb-3\" style='padding-bottom: 5%;'>
          <div class=\"input-group-prepend\">
            <span class=\"input-group-text\" id=\"inputGroup-sizing-default\">Change firstname</span>
          </div>
          <input type=\"text\" class=\"form-control\" id='editFirstname' value='$firstname' aria-label=\"Default\" aria-describedby=\"inputGroup-sizing-default\">
          <button id='editFirstnameBtn'>Update</button>
        </div>
        
        <div class=\"input-group mb-3\" style='padding-bottom: 5%;'>
          <div class=\"input-group-prepend\">
            <span class=\"input-group-text\" id=\"inputGroup-sizing-default\">Change lastname</span>
          </div>
          <input type=\"text\" class=\"form-control\" id='editLastname' value='$lastname' aria-label=\"Default\" aria-describedby=\"inputGroup-sizing-default\">
          <button id='editLastnameBtn'>Update</button>
        </div>

        <div class=\"input-group mb-3\">
          <div class=\"input-group-prepend\">
            <span class=\"input-group-text\" id=\"inputGroup-sizing-default\">Change password</span>
          </div>
          <input type=\"password\" class=\"form-control\" id='editPassword' aria-label=\"Default\" aria-describedby=\"inputGroup-sizing-default\">
          <button id='editPasswordBtn'>Update</button>
        </div>";
}

function getFavoriteBrandsPage(){
    $favorites = getFavoriteBrands($_SESSION['id']);

    if(!empty($favorites)):
        echo "<div class=\"pglist-p3 pglist-bg pglist-p-com\" id=\"ld-rew\">
        <div class=\"pglist-p-com-ti\">
            <h3><span>Your</span> Favorites</h3> </div>
        <div class=\"list-pg-inn-sp\">
            <div class=\"list-pg-write-rev\">
                <div class=\"lp-ur-all-rat\">
                    <h5>Favorites</h5>
                    <ul>";
        getFavoriteBrandsListing($favorites);
        echo "</ul>
                </div>
            </div>
        </div>
    </div>";
    else:
        echo "<div class=\"pglist-p3 pglist-bg pglist-p-com\" id=\"ld-rew\">
        <div class=\"pglist-p-com-ti\">
            <h3><span>Your</span> Favorites</h3> </div>
        <div class=\"list-pg-inn-sp\">
            <div class=\"list-pg-write-rev\">
                <div class=\"lp-ur-all-rat\">
                    <h5>Favorites</h5>
                    <ul>
                        No favorites yet.
                    </ul>
                </div>
            </div>
        </div>
    </div>";
    endif;
}

function getUserInvitePage(){
    echo "                        <div class=\"invite-friends\" style='margin-top: 0;'>
                            <div class=\"lets-connect\">
                                <h2>Let's connect everyone.</h2>
                            </div>
                            <div class=\"invite\">
                                <div class=\"invite-row\">
                                    <div class=\"row\">
                                        <div class=\"col-md-4\">
                                            <div class=\"invite-txt\">
                                                <img width=\"100\" src=\"images/fb.png\">
                                                <span class=\"social-mediatxt\">Facebook</span>
                                            </div>
                                        </div>
                                        <div class=\"col-md-4\">

                                        </div>
                                        <div class=\"col-md-4\">
                                            <div class=\"invite-button\">
                                                 <div class=\"fb-share-button\" 
                                                    data-href=\"https://www.fashant.com/\" 
                                                    data-layout=\"button\">
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"invite-row\">
                                    <div class=\"row\">
                                        <div class=\"col-md-4\">
                                            <div class=\"invite-txt\">
                                                <img width=\"100\" src=\"images/linkedin.png\">
                                                <span class=\"social-mediatxt\">Linkedin</span>
                                            </div>
                                        </div>
                                        <div class=\"col-md-4\">

                                        </div>
                                        <div class=\"col-md-4\">
                                            <div class=\"invite-button\">
                                                <a style='background: white;' href=\"https://www.linkedin.com/shareArticle?mini=true&url=http://www.fashant.com/&title=Find the best Fashion brands in Dubai's Shopping Malls&summary=Fashant.com&source=Fashant\" onclick=\"window.open(this.href, 'mywin',
'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;\" ><img src=\"http://chillyfacts.com/wp-content/uploads/2017/06/LinkedIN.gif\" alt=\"\" width=\"54\" height=\"20\" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"invite-row\">
                                    <div class=\"row\">
                                        <div class=\"col-md-4\">
                                            <div class=\"invite-txt\">
                                                <img width=\"100\" src=\"images/twitter.png\">
                                                <span class=\"social-mediatxt\">Twitter</span>
                                            </div>
                                        </div>
                                        <div class=\"col-md-4\">

                                        </div>
                                        <div class=\"col-md-4\">
                                            <div class=\"invite-button\">
                                                <a class=\"twitter-share-button\"
                                                  href=\"https://twitter.com/intent/tweet?text=Fashant.com\"
                                                  data-size=\"large\">
                                                Tweet</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"invite-row\">
                                    <div class=\"row\">
                                        <div class=\"col-md-4\">
                                            <div class=\"invite-txt\">
                                                <img width=\"100\" src=\"images/gplus.jpg\">
                                                <span class=\"social-mediatxt\">Google Plus</span>
                                            </div>
                                        </div>
                                        <div class=\"col-md-4\">

                                        </div>
                                        <div class=\"col-md-4\">
                                            <div class=\"invite-button\">
                                                <div class=\"g-plus\" data-action=\"share\" data-href='http://fashant.com/'></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";

//    <div class="invite-row">
//                                    <div class="row">
//                                        <div class="col-md-4">
//                                            <div class="invite-txt">
//                                                <img width="100" src="images/instagram.png">
//                                                <span class="social-mediatxt">Instagram</span>
//                                            </div>
//                                        </div>
//                                        <div class="col-md-4">
//
//                                        </div>
//                                        <div class="col-md-4">
//                                            <div class="invite-button">
//                                                <a href="#">Share</a>
//                                            </div>
//                                        </div>
//                                    </div>
//                                </div>
}