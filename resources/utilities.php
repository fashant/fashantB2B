<?php
/**
 * Created by PhpStorm.
 * User: isakl
 * Date: 03/08/2018
 * Time: 14:58
 */

header('Access-Control-Allow-Origin: https://m.demofashant.com', false);

ini_set('session.cookie_domain', '.demofashant.com');

session_start();

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

$db_dir = "{$base_dir}resources{$ds}DBConnect.php";
$new_brand_dir = "{$base_dir}classes{$ds}addNewBrand.php";
$new_user_dir = "{$base_dir}classes{$ds}addNewUser.php";
$review_dir = "{$base_dir}classes{$ds}Review.php";
$comment_dir = "{$base_dir}classes{$ds}Comment.php";
$autoload_dir = "{$base_dir}vendor{$ds}autoload.php";

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Load composer's autoloader


include_once $db_dir;
include_once $new_brand_dir;
include_once $new_user_dir;
include_once $review_dir;
include_once $comment_dir;
require $autoload_dir;


$ADMIN = 78342231;

/**
 * @param $required_fields_array, an array containing the list of all required fields
 * @return array, containing all errors
 */
function check_empty_fields($required_fields_array, $msg_arr){
    //initialize an array to store error messages
    $form_errors = array();


    //loop through the required fields array snd popular the form error array
    foreach($required_fields_array as $name_of_field){
        if(!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL){
            $found = false;
            foreach ($msg_arr as $msg => $msg_value){
                if(strcmp($msg, $name_of_field) === 0) {
                    $form_errors[] = $msg_value . " is a required field";
                    $found = true;
                    continue;
                }
            }

            if(!$found){
                $form_errors[] = $name_of_field . " is a required field";
            }
        }
    }

    return $form_errors;
}

/**
 * @param $data, store a key/value pair array where key is the name of the form control
 * in this case 'email' and value is the input entered by the profile
 * @return array, containing email error
 */
function check_email($data){
    //initialize an array to store error messages
    $form_errors = array();
    $key = 'email';
    //check if the key email exist in data array
    if(array_key_exists($key, $data)){

        //check if the email field has a value
        if($_POST[$key] != null){

            //Remove all illegal characters from email
            $key = filter_var($key, FILTER_SANITIZE_EMAIL);

            //check if input is a valid email address
            if(filter_var($_POST[$key], FILTER_VALIDATE_EMAIL) === false){
                $form_errors[] = $key . " is not a valid email address";
            }
        }
    }

    return $form_errors;
}

function flashMessage($message, $passOrFail = "Fail"){
    if($passOrFail === "Pass"){
        $data = "<div class='alert alert-success'>{$message}</p>";
    } else {
        $data = "<div class='alert alert-danger'>{$message}</p>";
    }

    return $data;
}

/**
 * @param $user_id
 */
function rememberMe($user_id){
    $encryptedCookieData = base64_encode("aKEaojerfknlerQWeqw0qo123124wqe12{$user_id}");
    // Cookie set to expire in about 30 days
    setcookie("rememberUserCookie", $encryptedCookieData, time()+60*60*24*100, "/");
}

function signout(){
    unset($_SESSION['username']);
    unset($_SESSION['id']);

    if(isset($_COOKIE['rememberUserCookie'])){
        unset($_COOKIE['rememberUserCookie']);
        setcookie('rememberUserCookie', null, -1, '/');
    }
    session_destroy();
    session_regenerate_id(true);

    header("Location: https://demofashant.com/login.php");
}

function sendMail($type, $receiver, $url, $name, $email, $message){
    $mail = new PHPMailer();
    $mail->IsSMTP();
    //$mail->SMTPDebug = 1;
    $mail->CharSet="UTF-8";
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'mail.littlechikoosdaycare.com';
    $mail->Port = 465;
    $mail->Username = 'no-reply@littlechikoosdaycare.com';
    $mail->Password = '^ym?.U-yZ+a+';
    $mail->SMTPAuth = true;


    $mail->From = 'contact@demofashant.com';
    $mail->FromName = 'demofashant.com';
    $mail->AddAddress($receiver);
    //$mail->AddReplyTo('phoenixd110@gmail.com', 'Information');

    $mail->IsHTML(true);
    $mail = generateMails($mail, $type, $url, $name, $email, $message);

    if(!is_bool($mail)) {
        if (!$mail->Send()) {
//            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
//            echo "Message sent!";
        }
    }
}

function generateMails($mail, $type, $url, $name, $email, $message){
    $default_body = "If you cannot se this email, please use a HTML compatible viewer!";

    switch ($type){
        case 'welcome':
            $mail->Subject    = "Welcome";
            $mail->AltBody    = $default_body;
            $header           = "You're almost there!";
            $body             = "<p>Confirm your email now to discover a New and Smarter way to shop for fashion in malls. Search and discover information on the best Fashion Brands in Dubai. With information on over 1000 stores, 500 brands and 7 shopping malls, you’re surely not be dissapointed.</p>";
            $footer           = "You recieve this e-mail so that you can verify your e-mail in our system, so that we can reach out to you with news and offers.";

            $mail->Body       = emailTemplateDefault($header, $body, $footer, $url);
            return $mail;
            break;
        case 'newsletter':
            $mail->Subject    = "Subscribed to newsletter";
            $mail->AltBody    = $default_body;
            $header           = "Thanks for subscribing to our newsletter!";
            $body             = "<p>I hope you find what you are looking for, welcome aboard!</p>";
            $footer           = "You recieve this e-mail because you have subscribed to our newsletter, so that we can reach out to you with news and offers.";

            $mail->Body       = emailTemplateDefault($header, $body, $footer, $url);
            return $mail;
            break;
        default:
            return false;
            break;
    }
}

function emailTemplateDefault($header, $body, $footer, $verify){
    $mail = "<div id=\":208\" class=\"a3s aXjCH m15f4ed5f68f9cb4a\"><u></u>
          <div class=\"m_8024715479396616009full-padding\" style=\"margin:0;padding:0\">
        
            <table class=\"m_8024715479396616009wrapper\" style=\"border-collapse:collapse;table-layout:fixed;min-width:320px;width:100%;background-color:#f0f0f0\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\"><tbody><tr><td>
              <div role=\"banner\">
                <div class=\"m_8024715479396616009preheader\" style=\"Margin:0 auto;max-width:560px;min-width:280px;width:280px;width:calc(28000% - 167440px)\">
                  <div style=\"border-collapse:collapse;display:table;width:100%\">
                  
                    <div class=\"m_8024715479396616009snippet\" style=\"display:table-cell;Float:left;fonts-size:12px;line-height:19px;max-width:280px;min-width:140px;width:140px;width:calc(14000% - 78120px);padding:10px 0 5px 0;color:#bdbdbd;fonts-family:Ubuntu,sans-serif\">
                      
                    </div>
                  
                    <div class=\"m_8024715479396616009webversion\" style=\"display:table-cell;Float:left;fonts-size:12px;line-height:19px;max-width:280px;min-width:139px;width:139px;width:calc(14100% - 78680px);padding:10px 0 5px 0;text-align:right;color:#bdbdbd;fonts-family:Ubuntu,sans-serif\">
                      
                    </div>
                  
                  </div>
                </div>
                <div class=\"m_8024715479396616009header\" style=\"Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px)\" id=\"m_8024715479396616009emb-email-header-container\">
                
                  <div class=\"m_8024715479396616009logo m_8024715479396616009emb-logo-margin-box\" style=\"fonts-size:26px;line-height:32px;Margin-top:6px;Margin-bottom:20px;color:#c3ced9;fonts-family:Roboto,Tahoma,sans-serif;Margin-left:20px;Margin-right:20px\" align=\"center\">
                    <div class=\"m_8024715479396616009logo-center\" align=\"center\" id=\"m_8024715479396616009emb-email-header\"><a href='https://demofashant.com/'><img style=\"display:block;height:auto;width:100%;border:0;max-width:216px\" src=\"https://demofashant.com/images/logo11.png\" alt=\"\" width=\"216\" class=\"CToWUd\"></a></div>
                  </div>
                
                </div>
              </div>
              <div role=\"section\">
              <div class=\"m_8024715479396616009layout m_8024715479396616009one-col m_8024715479396616009fixed-width\" style=\"Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px);word-wrap:break-word;word-break:break-word\">
                <div class=\"m_8024715479396616009layout__inner\" style=\"border-collapse:collapse;display:table;width:100%;background-color:#ffffff\">
                
                  <div class=\"m_8024715479396616009column\" style=\"text-align:left;color:#787778;fonts-size:16px;line-height:24px;fonts-family:Ubuntu,sans-serif;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px)\">
                
                    <div style=\"Margin-left:20px;Margin-right:20px;Margin-top:24px\">
              <div style=\"line-height:20px;fonts-size:1px\">&nbsp;</div>
            </div>
                
                    <div style=\"Margin-left:20px;Margin-right:20px\">
              <div>
                <h1 style=\"Margin-top:0;Margin-bottom:0;fonts-style:normal;fonts-weight:normal;color:#565656;fonts-size:30px;line-height:38px;text-align:center\"><strong>{$header}</strong></h1><p style=\"Margin-top:20px;Margin-bottom:0\">&nbsp;<br>
                    {$body}
              </div>
            </div>
                
            <div style=\"Margin-left:20px;Margin-right:20px\">
              <div style=\"line-height:10px;fonts-size:1px\">&nbsp;</div>
            </div>";

    if($verify !== null){
        $mail .= "
            <div style=\"Margin-left:20px;Margin-right:20px\">
              <div class=\"m_8024715479396616009btn m_8024715479396616009btn--flat m_8024715479396616009btn--large\" style=\"Margin-bottom:20px;text-align:center\">
                <u></u><a style=\"border-radius:4px;display:inline-block;fonts-size:14px;fonts-weight:bold;line-height:24px;padding:12px 24px;text-align:center;text-decoration:none!important;color:#ffffff!important;background-color:#80bf2e;fonts-family:Ubuntu,sans-serif\" href='{$verify}' target=\"_blank\" data-saferedirecturl=\"https://www.google.com/url?hl=en-GB&amp;q=https://www.easyauto.cmail20.com/t/j-i-ojhljyk-l-r/&amp;source=gmail&amp;ust=1508942577562000&amp;usg=AFQjCNFDpiHLWgPIWsEeKFurJg2GLP5wjQ\">CONFIRM EMAIL</a><u></u>
              </div>
            </div>";
    }

    $mail .= "
            <div style=\"Margin-left:20px;Margin-right:20px\">
              <div style=\"line-height:10px;fonts-size:1px\">&nbsp;</div>
            </div>
                
            <div style=\"Margin-left:20px;Margin-right:20px;Margin-bottom:24px\">
              <div style=\"line-height:5px;fonts-size:1px\">&nbsp;</div>
            </div>
                
                  </div>
                
                </div>
              </div>
          
              <div style=\"line-height:10px;fonts-size:10px\">&nbsp;</div>
          
              
              <div role=\"contentinfo\">
                <div class=\"m_8024715479396616009layout m_8024715479396616009email-footer\" style=\"Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px);word-wrap:break-word;word-break:break-word\">
                  <div class=\"m_8024715479396616009layout__inner\" style=\"border-collapse:collapse;display:table;width:100%\">
                  
                    <div class=\"m_8024715479396616009column m_8024715479396616009wide\" style=\"text-align:left;fonts-size:12px;line-height:19px;color:#bdbdbd;fonts-family:Ubuntu,sans-serif;Float:left;max-width:400px;min-width:320px;width:320px;width:calc(8000% - 47600px)\">
                      <div style=\"Margin-left:20px;Margin-right:20px;Margin-top:10px;Margin-bottom:10px\">
                        <table class=\"m_8024715479396616009email-footer__links m_8024715479396616009emb-web-links\" style=\"border-collapse:collapse;table-layout:fixed\" role=\"presentation\"><tbody><tr role=\"navigation\">
                        
                        </tr></tbody></table>
                        <div style=\"fonts-size:12px;line-height:19px;Margin-top:20px\">
                          <div>demofashant.com<br>
                        &nbsp;</div>
                        </div>
                        <div style=\"fonts-size:12px;line-height:19px;Margin-top:18px\">
                          <div>{$footer}</div>
                        </div>
                        
                      </div>
                    </div>
                  
                    <div class=\"m_8024715479396616009column m_8024715479396616009narrow\" style=\"text-align:left;fonts-size:12px;line-height:19px;color:#bdbdbd;fonts-family:Ubuntu,sans-serif;Float:left;max-width:320px;min-width:200px;width:320px;width:calc(72200px - 12000%)\">
                      <div style=\"Margin-left:20px;Margin-right:20px;Margin-top:10px;Margin-bottom:10px\">
                        
                      </div>
                    </div>
                  
                  </div>
                </div>
              </div>
              <div style=\"line-height:40px;fonts-size:40px\">&nbsp;</div>
            </div></td></tr></tbody></table>
          <img style=\"overflow:hidden;display:block!important;height:1px!important;width:1px!important;border:0!important;margin:0!important;padding:0!important\" src=\"https://ci4.googleusercontent.com/proxy/EnYJbJ11VpEeJVaqRX0FJ-88idIWXXbXKxSKrCLujeQ0ssAbzhjN2mquuvQ8XQrd6YttlmGSqN1ohL4aOg2vMran7ZJ7CYK2=s0-d-e1-ft#https://www.easyauto.cmail20.com/t/j-o-ojhljyk-l/o.gif\" width=\"1\" height=\"1\" border=\"0\" alt=\"\" class=\"CToWUd\"><div class=\"yj6qo\"></div><div class=\"adL\">
        </div></div><div class=\"adL\">
        </div></div>";

    return $mail;
}

function addToMailchimpList($email, $fname, $lname){
    $apiKey = 'db50a8469620d602c83f2f15d3ed1a85-us18';
    $listID = '4fd2aab584';

    $auth = base64_encode( 'user:'.$apiKey );
    $data = array(
        'apikey'        => $apiKey,
        'email_address' => $email,
        'status'        => 'subscribed',
        'merge_fields'  => array(
            'FNAME' => $fname,
            'LNAME' => $lname
        )
    );
    $json_data = json_encode($data);
    $ch = curl_init();
    $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
    curl_setopt($ch, CURLOPT_URL, 'https://'.$dataCenter.'.api.mailchimp.com/3.0/lists/'.$listID.'/members/');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.$auth));
    curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    $result = curl_exec($ch);


    die();

}

function addToMailchimpNewsletter($email){
    $apiKey = 'db50a8469620d602c83f2f15d3ed1a85-us18';
    $listID = 'dc9c70f81d';

    $auth = base64_encode( 'user:'.$apiKey );
    $data = array(
        'apikey'        => $apiKey,
        'email_address' => $email,
        'status'        => 'subscribed'
    );
    $json_data = json_encode($data);
    $ch = curl_init();
    $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
    curl_setopt($ch, CURLOPT_URL, 'https://'.$dataCenter.'.api.mailchimp.com/3.0/lists/'.$listID.'/members/');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.$auth));
    curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    $result = curl_exec($ch);


    die();

}

function emailExistsInDB($email){
    $mysqli = getConnection();
    $sql = "SELECT * FROM users WHERE email = '{$email}'";

    if(mysqli_num_rows(mysqli_query($mysqli, $sql)) > 0){

        return true;
    }

    return false;
}

function emailExists($email){
    $mysqli = getConnection();
    $sql = "SELECT * FROM newsletter_subscribers WHERE email = '{$email}'";

    if(mysqli_num_rows(mysqli_query($mysqli, $sql)) > 0){

        return true;
    }

    return false;
}

function setNewBrand($obj){
    $brand = new addNewBrand();

    $brand->setName($obj['brand_name']);
    $brand->setPriceCategory($obj['price_category']);
    $brand->setCity($obj['city']);
    $brand->setAddress($obj['address']);
    $brand->setContactPhone($obj['list_phone']);
    $brand->setContactEmail($obj['email']);

    if(isset($obj['about_brand'])){$brand->setAbout($obj['about_brand']); } else {$brand->setAbout("");}
    if(isset($obj['policies'])){$brand->setPolicies($obj['policies']); } else {$brand->setPolicies("");}
    if(isset($obj['shopping_center'])){$brand->setShoppingCenter($obj['shopping_center']); } else {$brand->setPolicies("");}
    if(isset($obj['brand_categories'])){$brand->setCategories($obj['brand_categories']);} else {$brand->setCategories(array());}
    if(isset($obj['brand_categories_primary'])){$brand->setPrimaryCategory($obj['brand_categories_primary']);} else {$brand->setPrimaryCategory("");}
    if(isset($obj['brand_tagging_primary'])){$brand->setTaggings($obj['brand_tagging_primary']);} else {$brand->setTaggings(array());}
    if(isset($obj['open_mon'])){$brand->setOpenMon($obj['open_mon']);} else {$brand->setOpenMon("");}
    if(isset($obj['open_tues'])){$brand->setOpenTues($obj['open_tues']);} else {$brand->setOpenTues("");}
    if(isset($obj['open_wed'])){$brand->setOpenWed($obj['open_wed']);} else {$brand->setOpenWed("");}
    if(isset($obj['open_thurs'])){$brand->setOpenThurs($obj['open_thurs']);} else {$brand->setOpenThurs("");}
    if(isset($obj['open_fri'])){$brand->setOpenFri($obj['open_fri']);} else {$brand->setOpenFri("");}
    if(isset($obj['open_sat'])){$brand->setOpenSat($obj['open_sat']);} else {$brand->setOpenSat("");}
    if(isset($obj['open_sun'])){$brand->setOpenSun($obj['open_sun']);} else {$brand->setOpenSun("");}


    return $brand;
}

function setNewUser($obj){
    $user = new addNewUser();

    $user->setId(mt_rand(10000000, 99999999));
    $user->setFirstName($obj['user_first_name']);
    $user->setLastName($obj['user_last_name']);
    $user->setUsername($obj['user_username']);
    if(isset($obj['user_list_phone'])){$user->setPhone($obj['user_list_phone']);} else {$user->setPhone("");}
    $user->setEmail($obj['user_email']);
    $user->setAddress($obj['user_list_addr']);
    $user->setUserType($obj['user_type']);
    $user->setCity($obj['user_city']);
    if(isset($obj['user_description'])){$user->setDescription($obj['user_description']);} else {$user->setDescription("");}

    return $user;
}

function getUser($id){
    $user = new addNewUser();
    $mysqli = getConnection();
    $sql = "SELECT * FROM users WHERE id = $id";

    $result = mysqli_query($mysqli, $sql);
    if($result){
        while ($row = $result->fetch_array()){
            $user->setId($row['id']);
            $user->setFirstName($row['first_name']);
            $user->setLastName($row['last_name']);
            $user->setPhone($row['phone']);
            $user->setEmail($row['email']);
            $user->setAddress($row['address']);
            $user->setUserType($row['user_type']);
            $user->setCity($row['city']);
            $user->setDescription($row['description']);
            $user->setUsername($row['username']);
            $user->setActive($row['active']);
        }
    }

    return $user;
}

function hasNotReviewed($ukey, $id){
    $mysqli = getConnection();
    $query = mysqli_query($mysqli, "SELECT * FROM reviews WHERE brand_id = $id AND ukey = $ukey");

    if (!$query)
    {
        die('Error: ' . mysqli_error($mysqli));
    }
    if(mysqli_num_rows($query) > 0){
        return false;
    }

    return true;
}

function getUsersReviews($id){
    $mysqli = getConnection();
    $sql = "SELECT * FROM reviews WHERE ukey = $id";
    $result = mysqli_query($mysqli, $sql);

    $reviews = array();

    if($result){
        while ($row = $result->fetch_array()){
            $review = new Review();
            $review->setId($row['id']);
            $review->setName($row['name']);
            $review->setEmail($row['email']);
            $review->setPhone($row['phone']);
            $review->setCity($row['city']);
            $review->setReview($row['review']);
            $review->setRating($row['rating']);
            $review->setDate($row['date']);
            $review->setBrandId($row['brand_id']);
            $review->setUkey($row['ukey']);

            $reviews[] = $review;
        }
    }

    return $reviews;
}

function emailExist($email){
    $mysqli = getConnection();
    $query = mysqli_query($mysqli, "SELECT * FROM users WHERE email='".$email."'");

    if (!$query)
    {
        die('Error: ' . mysqli_error($mysqli));
    }
    if(mysqli_num_rows($query) > 0){
        return true;
    }

    return false;
}

function phoneExist($phone){
    $mysqli = getConnection();
    $query = mysqli_query($mysqli, "SELECT * FROM users WHERE phone='".$phone."'");

    if (!$query)
    {
        die('Error: ' . mysqli_error($mysqli));
    }
    if(mysqli_num_rows($query) > 0){
        return true;
    }

    return false;
}

function brandExist($id){
    $mysqli = getConnection();
    $query = mysqli_query($mysqli, "SELECT * FROM brands WHERE id = $id");

    if (!$query)
    {
        die('Error: ' . mysqli_error($mysqli));
    }
    if(mysqli_num_rows($query) > 0){
        return true;
    }

    return false;
}

//function brandNameExist($name){
//    $mysqli = getConnection();
//    $query = mysqli_query($mysqli, "SELECT * FROM brands WHERE brand = \"$name\"");
//
//    if (!$query)
//    {
//        die('Error: ' . mysqli_error($mysqli));
//    }
//    if(mysqli_num_rows($query) > 0){
//        return true;
//    }
//
//    return false;
//}

function test(){
    echo "false";
}

function usernameExist($username){
    $mysqli = getConnection();
    $query = mysqli_query($mysqli, "SELECT * FROM users WHERE username='".$username."'");

    if (!$query)
    {
        die('Error: ' . mysqli_error($mysqli));
    }
    if(mysqli_num_rows($query) > 0){
        return true;
    }

    return false;
}

function updateUsersFirstname($ukey, $data){
    $mysqli = getConnection();
    $sql = "UPDATE users SET first_name = '$data' WHERE id = $ukey";

    if($mysqli->query($sql)){
        return true;
    }

    return false;
}

function updateUsersLastname($ukey, $data){
    $mysqli = getConnection();
    $sql = "UPDATE users SET last_name = '$data' WHERE id = $ukey";

    if($mysqli->query($sql)){
        return true;
    }

    return false;
}

function updateUsersPassword($ukey, $data){
    $mysqli = getConnection();
    $sql = "UPDATE users SET password = '$data' WHERE id = $ukey";

    if($mysqli->query($sql)){
        return true;
    }

    return false;
}

function uploadNewBrand($brand, $session_id){
    $mysqli = getConnection();

    $name = $brand->getName();
    $about = $brand->getAbout();
    $policies = $brand->getPolicies();
    $store_location = $brand->getStoreLocation();
    $address = $brand->getAddress();
    $phone = $brand->getContactPhone();
    $email = $brand->getContactEmail();
    $price = $brand->getPriceCategory();
    $city = $brand->getCity();
    $shopping_center = $brand->getShoppingCenter();
    $categories = $brand->getCategories();
    $primary_category = $brand->getPrimaryCategory();
    $taggings = $brand->getTaggings();
    $open_mon = $brand->getOpenMon();
    $open_tues = $brand->getOpenTues();
    $open_wed = $brand->getOpenWed();
    $open_thurs = $brand->getOpenThurs();
    $open_fri = $brand->getOpenFri();
    $open_sat = $brand->getOpenSat();
    $open_sun = $brand->getOpenSun();
    $close_mon = $brand->getCloseMon();
    $close_tues = $brand->getCloseTues();
    $close_wed = $brand->getCloseWed();
    $close_thurs = $brand->getCloseThurs();
    $close_fri = $brand->getCloseFri();
    $close_sat = $brand->getCloseSat();
    $close_sun = $brand->getCloseSun();

    // Set opening hours
    $sql = "INSERT INTO opening_hours (open_mon, open_tues, open_wed, open_thurs, open_fri, open_sat, open_sun,
                                       close_mon, close_tues, close_wed, close_thurs, close_fri, close_sat, close_sun)
            VALUES ('$open_mon', '$open_tues', '$open_wed', '$open_thurs', '$open_fri', '$open_sat', '$open_sun',
                    '$close_mon', '$close_tues', '$close_wed', '$close_thurs', '$close_fri', '$close_sat', '$close_sun')";

    if($mysqli->query($sql)) {
        // Set brand
        $sql = "INSERT INTO brands (brand, about, policies, store_location, address, contact_phone, contact_email, price_category, city, shopping_center, opening_hours, Ukey)
            VALUES ('$name', '$about', '$policies', '$store_location', '$address', '$phone', '$email', '$price', '$city', '$shopping_center', $mysqli->insert_id, $session_id);";

        if ($mysqli->query($sql)) {
            echo "success " . $mysqli->insert_id;
            // Set categories

            $new_id = $mysqli->insert_id;

            $categories[] = $primary_category;

            if (!empty($categories)) {
                setNewBrandCategories($new_id, $categories, 0);
            }

            if(!empty($taggings)){
                setNewBrandCategories($new_id, $taggings, 1);
            }
        } else {
            echo "failed ";
        }
    } else {
        echo "failed ";
    }
}

function setNewBrandCategories($brand_id, $categories, $pt){{
    if(!empty($categories)){
        $mysqli = getConnection();

        foreach ($categories as $category){
            $category_id = $category;

            $sql = "INSERT INTO brand_in_category (brand_id, category_id, primary_tagging) VALUES ($brand_id, $category_id, $pt);";

            $mysqli->query($sql);
        }
    }
}

}

function setCategories($brand_id, $categories, $pt){
    if(!empty($categories)){
        $mysqli = getConnection();

        foreach ($categories as $category){
            $category_id = $category['id'];

            $sql = "INSERT INTO brand_in_category (brand_id, category_id, primary_tagging) VALUES ($brand_id, $category_id, $pt);";

            $mysqli->query($sql);
        }
    }
}

function uploadNewUser($user, $password){
    $mysqli = getConnection();

    $id = $user->getId();
    $first_name = $user->getFirstName();
    $last_name = $user->getLastName();
    $username = $user->getUsername();
    $phone = $user->getPhone();
    $email = $user->getEmail();
    $address = $user->getAddress();
    $user_type = $user->getUserType();
    $city = $user->getCity();
    $description = $user->getDescription();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $active = 1;

    if(emailExist($email)){     // Check if email already exist
        echo "failed " . flashMessage("Email already exist <br>");
    } else {
        if(usernameExist($username)){         // Check if username already exist
            echo "failed " . flashMessage("Username already exist <br>");
        } else {
            $sql = "INSERT INTO users (id, first_name, last_name, phone, email, address, user_type, city, description, username, password, active)
            VALUES ($id, '$first_name', '$last_name', '$phone', '$email', '$address', '$user_type', '$city', '$description', '$username', '$hashed_password', $active)";

            if ($mysqli->query($sql) === TRUE) {
                echo "success ";
            } else {
                echo "failed ";
            }
        }
    }
}

function getShoppingCentersSelected($selected){
    $centers = array("Dubai Mall", "Mall of Emirates", "Deira City Center", "");

    if(strcmp($selected, "") === 0){
        echo "<option selected disabled value=''>Shopping Center</option>";
    }

    foreach ($centers as $center){
        if(strcmp($selected, $center) === 0 && strcmp($selected, "") !== 0){
            echo "<option selected value='$center'>Shopping Center</option>";
        } else {
            if(strcmp($center, "") !== 0) {
                echo "<option value='$center'>$center</option>";
            }
        }

    }
}

function getPriceCategorySelected($selected){
    $categories = array("Discount", "Budget/Mass Market", "Moderate", "Better/Bridge", "Designer/Coutore", "");

    if(strcmp($selected, "") === 0){
        echo "<option selected disabled value=''>Price Category</option>";
    }

    foreach ($categories as $category){
        if(strcmp($selected, $category) === 0 && strcmp($selected, '') !== 0){
            echo "<option selected value='$category'>$category</option>";
        } else {
            if(strcmp($category, "") !== 0) {
                echo "<option value='$category'>$category</option>";
            }
        }

    }
}

function getCategoryCheckboxes($type){
    if($type == 2){
        $categories = getAllCategories(0);
    } else {
        $categories = getAllCategories($type);
    }

//    echo "<ul>";

    echo "<table class=\"table table-hover\">
                <tbody>";

    $count = 1;

    if(!empty($categories)){
        foreach ($categories as $category){
            $id = $category['id'];
            $name = $category['category'];

            if($type == 0) {
                echo "<tr><td>
                    <input type=\"checkbox\" name='brand_categories[]' value='$id' class=\"filled-in\" id=\"filled-in-box-$count\" />
                    <label for=\"filled-in-box-$count\" style='font-size: 100%;'>$name</label>
                  </td></tr>";
            } elseif ($type == 1) {
                echo "<tr><td>
                    <input type=\"checkbox\" name='brand_categories_primary' value='$id' class=\"filled-in\" id=\"filled-in-box-0$count\"/>
                    <label for=\"filled-in-box-0$count\" style='font-size: 100%;'>$name</label>
                  </td></tr>";
            } else {
                echo "<tr><td>
                    <input type=\"radio\" name='brand_tagging_primary[]' value='$id' class=\"filled-in\" id=\"filled-in-box-00$count\"/>
                    <label for=\"filled-in-box-00$count\" style='font-size: 100%;'>$name</label>
                  </td></tr>";
            }

            $count++;
        }
    }

    echo "</tbody>
            </table>";
//    echo "</ul>";
}

function generateListCategory($type, $selected){
    $categories = getAllCategories($type);

    $count = 1;
    if(!empty($categories)){
        foreach ($categories as $category){
            $id = $category['id'];
            $name = $category['category'];

            if($type == 0){
                if(in_array($name, $selected)){
                    echo "<li>
                        <input type=\"checkbox\" checked id=\"scf$count\" onclick=\"filterListings('items[]', '$name');\" />
                        <label for=\"scf$count\">$name</label>
                    </li>";
                } else {
                    echo "<li>
                        <input type=\"checkbox\" id=\"scf$count\" onclick=\"filterListings('items[]', '$name');\" />
                        <label for=\"scf$count\">$name</label>
                    </li>";
                }
            } else {
                if(in_array($name, $selected)){
                    echo "<li>
                        <input type=\"checkbox\" checked id=\"scf0$count\" onclick=\"filterListings('categories[]', '$name');\" />
                        <label for=\"scf0$count\">$name</label>
                    </li>";
                } else {
                    echo "<li>
                        <input type=\"checkbox\" id=\"scf0$count\" onclick=\"filterListings('categories[]', '$name');\" />
                        <label for=\"scf0$count\">$name</label>
                    </li>";
                }
            }

            $count++;
        }
    }

}

function getCitySelected($selected){
    $cities = array("Dubai", "");

    if(strcmp($selected, "") === 0){
        echo "<option selected disabled value=''>City</option>";
    }

    foreach ($cities as $city){
        if(strcmp($selected, $city) === 0 && strcmp($selected, '') !== 0){
            echo "<option selected value='$city'>$city</option>";
        } else {
            if(strcmp($city, "") !== 0) {
                echo "<option value='$city'>$city</option>";
            }
        }

    }
}

function getAllCategories($type){
    $categories = array();

    $mysqli = getConnection();
    $sql = "SELECT * FROM brand_categories WHERE primary_category = $type";

    $result = mysqli_query($mysqli, $sql);

    while ($row = $result->fetch_array()){
        $category['id'] = $row['id'];
        $category['category'] = $row['category'];

        $categories[] = $category;
    }

    return $categories;
}

function getAllBrands($id){
    global $ADMIN;

    $brands = array();

    $mysqli = getConnection();

    if($id === $ADMIN){
        $sql = "SELECT * FROM brands";
    } else {
        $sql = "SELECT * FROM brands WHERE Ukey = $id";
    }

    $result = mysqli_query($mysqli, $sql);

    // Fetch all rows
    while ($row = $result->fetch_array()){
        $brand = new addNewBrand();

        $brand->setId($row['id']);
        $brand->setName($row['brand']);
        $brand->setAbout($row['about']);
        $brand->setLogo($row['logo']);
        $brand->setPolicies($row['policies']);
        $brand->setGallery($row['gallery']);
        $brand->setStoreLocation($row['store_location']);
        $brand->setAddress($row['address']);
        $brand->setContactPhone($row['contact_phone']);
        $brand->setContactEmail($row['contact_email']);
        $brand->setPriceCategory($row['price_category']);
        $brand->setCity($row['city']);
        $brand->setShoppingCenter($row['shopping_center']);
        $brand->setUkey($row['Ukey']);

        $brand->setCategories(getBrandInCategories($row['id']));

        $open_id = $row['opening_hours'];
        $open_sql = "SELECT * FROM opening_hours WHERE id = $open_id";
        $open_result = mysqli_query($mysqli, $open_sql);
        if($open_result){
            while ($new_row = $open_result->fetch_array()){
                $brand->setOpenMon($new_row['open_mon']);
                $brand->setOpenTues($new_row['open_tues']);
                $brand->setOpenWed($new_row['open_wed']);
                $brand->setOpenThurs($new_row['open_thurs']);
                $brand->setOpenFri($new_row['open_fri']);
                $brand->setOpenSat($new_row['open_sat']);
                $brand->setOpenSun($new_row['open_sun']);
                $brand->setCloseMon($new_row['close_mon']);
                $brand->setCloseTues($new_row['close_tues']);
                $brand->setCloseWed($new_row['close_wed']);
                $brand->setCloseThurs($new_row['close_thurs']);
                $brand->setCloseFri($new_row['close_fri']);
                $brand->setCloseSat($new_row['close_sat']);
                $brand->setCloseSun($new_row['close_sun']);
            }
        }

        $brands[] = $brand;
    }

    return $brands;
}

function getBrandInCategories($id){
    $mysqli = getConnection();
    $sql = "SELECT * FROM brand_in_category WHERE brand_id = $id";
    $result = mysqli_query($mysqli, $sql);

    $categories = array();

    if($result){
        while ($row = $result->fetch_array()){
            $categories[] = $row['category_id'];
        }
    }

    return $categories;
}

function getBrand($id){
    $mysqli = getConnection();
    $sql = "SELECT * FROM brands WHERE id = $id";

    $result = mysqli_query($mysqli, $sql);

    $brand = new addNewBrand();

    if($result) {
        // Fetch row
        while ($row = $result->fetch_array()) {
            $brand->setId($row['id']);
            $brand->setName($row['brand']);
            $brand->setAbout($row['about']);
            $brand->setLogo($row['logo']);
            $brand->setPolicies($row['policies']);
            $brand->setGallery($row['gallery']);
            $brand->setStoreLocation($row['store_location']);
            $brand->setAddress($row['address']);
            $brand->setContactPhone($row['contact_phone']);
            $brand->setContactEmail($row['contact_email']);
            $brand->setPriceCategory($row['price_category']);
            $brand->setCity($row['city']);
            $brand->setShoppingCenter($row['shopping_center']);
            $brand->setUkey($row['Ukey']);

            $open_id = $row['opening_hours'];
            $open_sql = "SELECT * FROM opening_hours WHERE id = $open_id";
            $open_result = mysqli_query($mysqli, $open_sql);
            if($open_result){
                while ($new_row = $open_result->fetch_array()){
                    $brand->setOpenMon($new_row['open_mon']);
                    $brand->setOpenTues($new_row['open_tues']);
                    $brand->setOpenWed($new_row['open_wed']);
                    $brand->setOpenThurs($new_row['open_thurs']);
                    $brand->setOpenFri($new_row['open_fri']);
                    $brand->setOpenSat($new_row['open_sat']);
                    $brand->setOpenSun($new_row['open_sun']);
                    $brand->setCloseMon($new_row['close_mon']);
                    $brand->setCloseTues($new_row['close_tues']);
                    $brand->setCloseWed($new_row['close_wed']);
                    $brand->setCloseThurs($new_row['close_thurs']);
                    $brand->setCloseFri($new_row['close_fri']);
                    $brand->setCloseSat($new_row['close_sat']);
                    $brand->setCloseSun($new_row['close_sun']);
                }
            }

        }
    } else {
        return false;
    }

    return $brand;
}

function getReviews($id){
    $reviews = array();

    $mysqli = getConnection();
    $sql = "SELECT * FROM reviews WHERE brand_id = $id";
    $result = mysqli_query($mysqli, $sql);

    if($result){
        while ($row = $result->fetch_array()){
            $review = new Review();
            $review->setId($row['id']);
            $review->setName($row['name']);
            $review->setEmail($row['email']);
            $review->setPhone($row['phone']);
            $review->setCity($row['city']);
            $review->setReview($row['review']);
            $review->setRating($row['rating']);
            $review->setDate($row['date']);
            $review->setBrandId($row['brand_id']);
            $review->setUkey($row['ukey']);
            $review->setComments(getReviewComments($row['id']));

            $reviews[] = $review;
        }
    }

    return $reviews;
}

function getReviewsRating($reviews){

}

function getReviewComments($review_id){
    $comments = array();

    $mysqli = getConnection();
    $sql = "SELECT * FROM comments WHERE review_id = $review_id ORDER BY date DESC";
    $result = mysqli_query($mysqli, $sql);

    if($result){
        while ($row = $result->fetch_array()){
            $comment = new Comment();

            $comment->setReviewId($review_id);
            $comment->setComment($row['comment']);
            $comment->setUkey($row['ukey']);
            $comment->setDate($row['date']);

            $comments[] = $comment;
        }
    }

    return $comments;
}

function getListingReviews($reviews){
    if(!empty($reviews)){
        foreach ($reviews as $review){
            $id = $review->getId();
            $name = $review->getName();
            $rating = $review->getRating();
            $date = $review->getDate();
            $text = $review->getReview();
            $comments = $review->getComments();

            $num_comments = count($comments);
            $comment_text = "No Comments";

            if($num_comments > 0){
                $comment_text = $num_comments . " Comments";
            }

            echo "<li>
                    <div class=\"lr-user-wr-img\"> <img src=\"images/users/2.png\" alt=\"\"> </div>
                    <div class=\"lr-user-wr-con\">
                        <h6>$name <span>$rating <i class=\"fa fa-star\" aria-hidden=\"true\"></i></span></h6> <span class=\"lr-revi-date\">$date</span>
                        <p>$text </p>
                        <ul>
                            <li><a href=\"#!\" onclick='openReviewComments(\"review_comment_$id\");'><span>$comment_text</span> <i class=\"fa fa-commenting-o\" aria-hidden=\"true\"></i></a> </li>
                        </ul>
                        <div id='review_comment_$id' class=\"lr-user-wr-con\" style='display: none;'>";

                    echo "<ul>";
                    if(!isset($_SESSION['id'])){
                        echo "<p style='color:red;'>Please <a href='login.php'>login</a> to leave a comment on this review.</p>";
                    } else {
                        $user = getUser($_SESSION['id']);
                        $uid = $user->getId();
                        if(hasCommented($user->getId(), $id)){
                            echo "<p style='color: red;'>You have commented this review</p>";
                        } else {
                            // Add comment
                            echo "<form id=\"review_comment_form_$id\" action=\"\" onsubmit=\"event.preventDefault();\" method=\"post\" role=\"form\" enctype=\"multipart/form-data\" style='padding-bottom: 2%;'>
                                    <div class='form-group'>
                                        <label for='comment_$$id'>Comment on this review</label>
                                        <textarea id='comment_$id' name='comment' class='materialize-textarea' placeholder='Write your comment here...'></textarea>
                                        <input type='text' name='review_id' value='$id' hidden>
                                        <input type='text' name='uid' value='$uid' hidden>
                                        <div> <a class=\"waves-effect waves-light btn-large full-btn\" onclick='commentOnReview($id);'>Comment</a> </div>
                                    </div>
                                 </form>";
                        }
                    }
                    foreach ($comments as $comment){
                        $com = $comment->getComment();
                        $dt = $comment->getDate();
                        echo "<li style='width: 100%;'>";
                        echo "$com";
                        echo "<br><span class=\"lr-revi-date\">$dt</span>";
                        echo "</li>";
                    }
                    echo "</ul>";

            echo    "</div>
                   </div>
                </li>";
        }
    }
}

function hasCommented($ukey, $id){
    $mysqli = getConnection();
    $sql = "SELECT * FROM comments WHERE review_id = $id AND user_id = $ukey";

    if(mysqli_num_rows(mysqli_query($mysqli, $sql)) > 0){

        return true;
    }

    return false;

}


function getListingUsersReviews($reviews){
    if(!empty($reviews)){
        foreach ($reviews as $review){
            $name = $review->getName();
            $rating = $review->getRating();
            $date = $review->getDate();
            $text = $review->getReview();
            $brand_id = $review->getBrandId();
            $brand = getBrand($brand_id);
            $brand_name = $brand->getName();

            echo "<li>
                    <div class=\"lr-user-wr-img\"> <img src=\"images/users/2.png\" alt=\"\"> </div>
                    <div class=\"lr-user-wr-con\">
                        <h6>$brand_name <span>$rating <i class=\"fa fa-star\" aria-hidden=\"true\"></i></span></h6> <span class=\"lr-revi-date\">$date</span>
                        <p>$text </p>
                    </div>
                </li>";
        }
    }
}

function getFavoriteBrands($id){
    $mysqli = getConnection();
    $sql = "SELECT * FROM favorite_brands WHERE ukey = $id";
    $result = mysqli_query($mysqli, $sql);

    $brands = array();

    if($result){
        while ($row = $result->fetch_array()){
            $brands[] = $row['brand_id'];
        }
    }

    return $brands;
}

function isFavoriteBrand($id, $ukey){
    $mysqli = getConnection();
    $sql = "SELECT * FROM favorite_brands WHERE ukey = $ukey AND brand_id = $id";

    if(mysqli_num_rows(mysqli_query($mysqli, $sql)) > 0){

        return true;
    }

    return false;
}

function getFavoriteBrandsListing($brands){
    if(!empty($brands)){
        foreach ($brands as $brand_id){
            $brand = getBrand($brand_id);
            $name = $brand->getName();

            echo "<li>
                    <div class=\"lr-user-wr-img\"> <img src=\"images/users/2.png\" alt=\"\"> </div>
                    <div class=\"lr-user-wr-con\">
                        <h6>$name</h6>
                        <button onclick='updateFavorite(\"delete\",\"$brand_id\");'>Delete</button>
                    </div>
                </li>";
        }
    }
}

function deleteFavoriteBrand($id, $ukey){
    $mysqli = getConnection();
    $sql = "DELETE FROM favorite_brands WHERE ukey = $ukey AND brand_id = $id";
    if($mysqli->query($sql)){
        return true;
    }

    return false;
}

function addFavoriteBrand($id, $ukey){
    $mysqli = getConnection();
    $sql = "INSERT INTO favorite_brands (ukey, brand_id) VALUES ($ukey, $id)";
    if($mysqli->query($sql)){
        return true;
    }

    return false;
}

function getAllUsers($id){
    $users = array();

    $mysqli = getConnection();
    $sql = "SELECT * FROM users WHERE id != $id";
    $result = mysqli_query($mysqli, $sql);

    // Fetch all rows
    while ($row = $result->fetch_array()){
        $user = new addNewUser();

        $user->setId($row['id']);
        $user->setFirstName($row['first_name']);
        $user->setLastName($row['last_name']);
        $user->setPhone($row['phone']);
        $user->setEmail($row['email']);
        $user->setAddress($row['address']);
        $user->setUserType($row['user_type']);
        $user->setCity($row['city']);
        $user->setDescription($row['description']);
        $user->setUsername($row['username']);
        $user->setActive($row['active']);

        $users[] = $user;
    }

    return $users;
}

function generateAllListingTable($id){
    $brands = getAllBrands($id);

    if(sizeof($brands) > 0) {

      foreach ($brands as $brand){
          echo "<tr>";
          echo "<td><span class='list-img'><img src='images/icon/dbr1.jpg' alt=''></span> </td>";
          echo "<td><a href='#'><span class='list-enq-name'></span><span class='list-enq-city'>" . $brand->getName() . "</span></a> </td>";
          echo "<td>" . $brand->getStoreLocation() . "</td>";
          echo "<td>" . $brand->getCity() . "</td>";
          echo "<td>" . $brand->getShoppingCenter() . "</td>";
          echo "<td>" . $brand->getPriceCategory() . "</td>";
          echo "<td> <a href='admin-list-view.php?id=" . $brand->getId() . "'><i class='fa fa-eye'></i></a> </td>";
          echo "<td> <a href='admin-list-edit.php?id=" . $brand->getId() . "'><i class='fa fa-edit'></i></a> </td>";
          echo "</tr>";
        }
    }
}

function generateAllUsersTable($id){
    $users = getAllUsers($id);

    if(sizeof($users) > 0) {

        foreach ($users as $user) {

            echo "<tr>";
            echo "<td>" . $user->getId() . "</td>";
            echo "<td>" . $user->getUsername() . "</td>";
            echo "<td>" . $user->getFirstName() . "</td>";
            echo "<td>" . $user->getLastName() . "</td>";
            echo "<td>" . $user->getPhone() . "</td>";
            echo "<td>" . $user->getEmail() . "</td>";
            echo "<td>" . $user->getAddress() . "</td>";
            echo "<td>" . $user->getUserType() . "</td>";
            echo "<td>" . $user->getCity() . "</td>";
            echo "<td>" . $user->getDescription() . "</td>";
            echo "<td>" . $user->getActive() . "</td>";
            echo "</tr>";
        }
    }
}

function updateBrandInformation($col, $value, $id){
    $mysqli = getConnection();
    $sql = "UPDATE brands SET $col = '$value' WHERE id = $id";

    if($mysqli->query($sql)){
        return 'success ';
    }

    return 'failed ';
}

function getCategoryByID($id){
    $mysqli = getConnection();
    $sql = "SELECT * FROM brand_categories WHERE id = $id";
    $result = mysqli_query($mysqli, $sql);

    if($result){
        while ($row = $result->fetch_array()){
            return $row['category'];
        }
    }

    return false;
}

function getBrandsCategories($id, $type){
    $mysqli = getConnection();
    $sql = "";

    switch ($type){
        case 0:
            $sql = "SELECT * FROM brand_in_category WHERE brand_id = $id AND (category_id = 1 OR category_id = 2 OR category_id = 3)";
            break;
        case 1:
            $sql = "SELECT * FROM brand_in_category WHERE brand_id = $id AND primary_tagging = 1";
            break;
        case 2:
            $sql = "SELECT * FROM brand_in_category WHERE brand_id = $id AND primary_tagging = 0 AND category_id <> 1 AND category_id <> 2 AND category_id <> 3";
            break;
        default:
            return array();
            break;
    }

    $categories = array();

    $result = mysqli_query($mysqli, $sql);
    if($result){
        while ($row = $result->fetch_array()){
            $brand_name = getCategoryByID($row['category_id']);
            if($brand_name){
                $categories[] = $brand_name;
            }
        }
    }

    return $categories;
}

function getCategoryText($categories){
    if(!empty($categories)){
        $cat = $categories[0];
        if(sizeof($categories) > 1){
            for ($i = 1; $i < sizeof($categories); $i++){
                $cat .= ', ' . $categories[$i];
            }
        }

        return $cat;
    }

    return "";
}

function getTodaysOpeningHour($brand){
    $day = date("l");

    switch ($day){
        case 'Monday':
            return $brand->getOpenMon() . " - " . $brand->getCloseMon();
            break;
        case 'Tuesday':
            return $brand->getOpenTues() . " - " . $brand->getCloseTues();
            break;
        case 'Wednesday':
            return $brand->getOpenWed() . " - " . $brand->getCloseWed();
            break;
        case 'Thursday':
            return $brand->getOpenThurs() . " - " . $brand->getCloseThurs();
            break;
        case 'Friday':
            return $brand->getOpenFri() . " - " . $brand->getCloseFri();
            break;
        case 'Saturday':
            return $brand->getOpenSat() . " - " . $brand->getCloseSat();
            break;
        case 'Sunday':
            return $brand->getOpenSun() . " - " . $brand->getCloseSun();
            break;
        default:
            return "";
            break;
    }
}

function generateListings($brands){
    if(!empty($brands)){
        foreach ($brands as $brand){
            $id = $brand->getId();
            $ukey = $brand->getUkey();
            $name = $brand->getName();
            $location = $brand->getStoreLocation();
            $sc = $brand->getShoppingCenter();
            $city = $brand->getCity();
            $pcat = getPriceCategoryName($brand->getPriceCategory());
            if(!$pcat){
                $pcat = $brand->getPriceCategory();
            }

            $phone = $brand->getContactPhone();
            $categories = getBrandsCategories($id, 0);
            $secondary = getBrandsCategories($id, 2);

            $cat = getCategoryText($categories);
            $taggings = getCategoryText($secondary);
            $opening_hour = getTodaysOpeningHour($brand);

            $reviews = getReviews($id);
            $rating = null;

            // RATINGS AND REVIEWS
            if(!empty($reviews)) {
                $rating = 0;
                $num_reviews = sizeof($reviews);

                foreach ($reviews as $rev) {
                    $r = $rev->getRating();
                    $rating += $r;
                }

                $rating = round($rating / $num_reviews, 1, PHP_ROUND_HALF_DOWN);
            }
            
            //$address = $brand->getAddress();
            //$primary = getBrandsCategories($id, 1);

            //https://admin.demofashant.com/uploads/brands/63423429/135/0.jpg
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

            $img_folder = $base_dir . "admindemofashant/uploads/brands/$ukey/$id/logo.jpg";
            $img = "images/slider/1.jpg";

            if(file_exists($img_folder)){
                $img = "https://admin.demofashant.com/uploads/brands/$ukey/$id/logo.jpg";
            }

            echo "<div class=\"home-list-pop list-spac\">
                                    <!--LISTINGS IMAGE-->
                                    <div class=\"col-md-3 padingimgbox\"> <img src=\"$img\" alt=\"\" /> </div>
                                    <!--LISTINGS: CONTENT-->
                                    <div class=\"col-md-9 home-list-pop-desc inn-list-pop-desc\"> <a href=\"listing-details.php?id=$id\">
                                            <h3>$name</h3>
                                        </a>
                                        <h5 class=\"location\">";

                                        if(strcmp($sc, "") !== 0){
                                            echo " <span class=\"shopingcenter\">$sc</span>";
                                        }
                                        if(strcmp($city, "") !== 0){
                                            echo ", <span class=\"shopingcenter\">$city</span><br>";
                                        }
                                        if(strcmp($location, "") !== 0){
                                            echo "<span class=\"shopingloca\">$location</span>";
                                        }


                                        if(!empty($categories)){
                                            echo "<h5>";
                                            foreach ($categories as $c){
                                                echo "<span class='list-cat maincat'>$c</span>";
                                            }
                                        }


                                 echo   "<br>Price Category:<span class=\"list-cat\">$pcat</span> </h5>
										<h5 class=\"tagss\">Items in store: <span>$taggings</span></h5><br>
										<h5 class=\"tagss\">Today: <span>$opening_hour</span></h5>
                                        
                                        <div class=\"list-number\">
                                            <!--<h5>Timings : <span>10:00 to 8:00 PM</span></h5>
                                            <h5>Phone : <span>+01 1245 2541, +62 6541 6528</span></h5>-->
                                        </div>";

                                        if($rating === null){
                                            echo "<span class=\"home-list-pop-rat\">N/A</span>";
                                        } else {
                                            echo "<span class=\"home-list-pop-rat\">$rating <i class=\"fa fa-star\" aria-hidden=\"true\"></i></span>";
                                        }

                                 echo  "<div class=\"reviewstext\">
                                            <i title=\"$opening_hour\" class=\"fa fa-clock-o\" aria-hidden=\"true\" onclick=''></i><br>
                                            <i title=\"$phone\" class=\"fa fa-phone-square\" aria-hidden=\"true\"></i><br>

                                        </div>
										<div class=\"list-enqu-btn btns\">
                                        <ul>
                                            <li class=\"writerevi\"><a href=\"https://demofashant.com/listing-details.php?id=$id&review=true\">Write Review</a></li>";

                                        if(isset($_SESSION['id'])){
                                              if(!isFavoriteBrand($id, $_SESSION['id'])){
                                                  echo "<li onclick='updateFavorite(\"add\",\"$id\");'><a href=\"#!\">Add to Favourite</a> </li>";
                                              } else {
                                                  echo "<li onclick='updateFavorite(\"delete\",\"$id\");'><a href=\"#!\">Remove from Favourite</a> </li>";
                                              }
                                          }

                                      echo "
                                            <li><a href=\"#!\" onclick='swal(\"Phone: $phone\");'>Call</a> </li>
                                            <li><a href=\"#!\" ><i class=\"fa fa-share-alt\" aria-hidden=\"true\"></i></a> </li>
                                        </ul>
                                    </div>

                                    </div>
                                    <div class=\"clearfix\"></div>
                                    
                                </div>";
        }
    }

}

function generateMobileListings($brands){
    if(!empty($brands)){
        echo "<ul>";
        foreach ($brands as $brand){
            $id = $brand->getId();
            $ukey = $brand->getUkey();
            $name = $brand->getName();
            $location = $brand->getStoreLocation();
            $sc = $brand->getShoppingCenter();
            $city = $brand->getCity();
            $pcat = getPriceCategoryName($brand->getPriceCategory());
            if(!$pcat){
                $pcat = $brand->getPriceCategory();
            }

            $phone = $brand->getContactPhone();
            $categories = getBrandsCategories($id, 0);
            $secondary = getBrandsCategories($id, 2);

            $cat = getCategoryText($categories);
            $taggings = getCategoryText($secondary);
            $opening_hour = getTodaysOpeningHour($brand);

            $reviews = getReviews($id);
            $rating = null;

            // RATINGS AND REVIEWS
            if(!empty($reviews)) {
                $rating = 0;
                $num_reviews = sizeof($reviews);

                foreach ($reviews as $rev) {
                    $r = $rev->getRating();
                    $rating += $r;
                }

                $rating = round($rating / $num_reviews, 1, PHP_ROUND_HALF_DOWN);
            }

            //$address = $brand->getAddress();
            //$primary = getBrandsCategories($id, 1);

            //https://admin.demofashant.com/uploads/brands/63423429/135/0.jpg
            $ds = DIRECTORY_SEPARATOR;
            $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

            $img_folder = $base_dir . "admindemofashant/uploads/brands/$ukey/$id/logo.jpg";
            $img = "images/slider/1.jpg";

            if(file_exists($img_folder)){
                $img = "https://admin.demofashant.com/uploads/brands/$ukey/$id/logo.jpg";
            }

            echo "<li>
                    <a href=\"https://m.demofashant.com/listing-details.php?id=$id\"><img src=\"$img\" alt=\"\"></a>
                    <div class=\"about-brand\">
                        <h2>$name</h2>
                        <p>";
                    if(strcmp($sc, "") !== 0){
                        echo "$sc";
                    }
                    if(strcmp($city, "") !== 0){
                        echo ", $city";
                    }
                    if(strcmp($location, "") !== 0){
                        echo "$location";
                    }
            echo "      </p>
                        <label>$cat</label>
                    </div>
                    <div class=\"btn-div\"><a href=\"https://m.demofashant.com/listing-details.php?id=$id&review=true\" class=\"fashant-btn\">write review</a></div>
                </li>";
        }
        echo "</ul>";
    }
}

function generateListBrands($selected){
    global $ADMIN;
    $brands = getAllBrands($ADMIN);

    $count = 1;
    if(!empty($brands)){
        foreach ($brands as $brand){
            $name = $brand->getName();

            if(in_array($name, $selected)) {
                echo "<li>
                    <input type=\"checkbox\" value='$name' checked id=\"scf00$count\" onclick=\"filterListings('brands[]', '$name');\" />
                    <label for=\"scf00$count\">$name</label>
                  </li>";
            } else {
                echo "<li>
                    <input type=\"checkbox\" value='$name' id=\"scf00$count\" onclick=\"filterListings('brands[]', '$name');\" />
                    <label for=\"scf00$count\">$name</label>
                  </li>";
            }
            $count++;
        }
    }
}


function generateStaticListBrands($selected){
    $brands = array("Zara", "H&M", "Aldo", "Nike", "Tommy Hilfiger", "MAX Fashion", "Giordano", "Forever 21", "Victoria's Secret", "Splash", "Charles & Keith", "Kiabi");

    $count = 1;
    foreach ($brands as $brand){
        $name = $brand;

        if(in_array($name, $selected)) {
            echo "<li>
                <input type=\"checkbox\" value='$name' checked id=\"scf00$count\" onclick=\"filterListings('brands[]', '$name');\" />
                <label for=\"scf00$count\">$name</label>
              </li>";
        } else {
            echo "<li>
                <input type=\"checkbox\" value='$name' id=\"scf00$count\" onclick=\"filterListings('brands[]', '$name');\" />
                <label for=\"scf00$count\">$name</label>
              </li>";
        }
        $count++;
    }

}

function getPriceCategoryList(){
    $mysqli = getConnection();
    $sql = "SELECT * FROM price_category";
    $result = mysqli_query($mysqli, $sql);

    if($result){
        $count = 0;
        while ($row = $result->fetch_array()){
            $id = $row['id'];
            $cat = $row['cat'];

            $pcat = $cat . " - " . $row['name'];

            $count++;

//            echo "<li><a id=\"$cat\" onclick=\"priceCategory(this.id, '$id');\">$pcat</a> </li>";
            echo " <li>
                    <input style='font-size:80%;' type=\"checkbox\" id=\"scf0000$count\" onclick=\"filterListings('pc[]','$id');\" />
                    <label for=\"scf0000$count\">$pcat</label>
                   </li>";
        }
    }
}



function getPriceCategoryName($id){
    $mysqli = getConnection();
    $sql = "SELECT * FROM price_category WHERE id = $id";
    $result = mysqli_query($mysqli, $sql);

    if($result){
        while ($row = $result->fetch_array()){
            return $row['cat'] . ' - ' . $row['name'];
        }
    }

    return false;
}