<?php
/** * Created by PhpStorm. * User: isakl * Date: 03/08/2018 * Time: 14:58 */
error_reporting(E_ALL);
ini_set('display_errors', 'on');
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;
$db_dir = "{$base_dir}resources{$ds}DBConnect.php";
$new_brand_dir = "{$base_dir}classes{$ds}addNewBrand.php";
$new_user_dir = "{$base_dir}classes{$ds}addNewUser.php";
$review_dir = "{$base_dir}classes{$ds}Review.php";
$autoload_dir = "{$base_dir}vendor{$ds}autoload.php";
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
include_once $db_dir;
include_once $new_brand_dir;
include_once $new_user_dir;
include_once $review_dir;
require $autoload_dir;
$ADMIN = 78342231;
/** * @param $required_fields_array , an array containing the list of all required fields * @return array, containing all errors */
function check_empty_fields($required_fields_array, $msg_arr)
{
    // initialize an array to store error messages
    $form_errors = array();
    //loop through the required fields array snd popular the form error array
    foreach ($required_fields_array as $name_of_field) {
        if (!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL) {
            $found = false;
            foreach ($msg_arr as $msg => $msg_value) {
                if (strcmp($msg, $name_of_field) === 0) {
                    $form_errors[] = $msg_value . " is a required field";
                    $found = true;
                    continue;
                }
            }
            if (!$found) {
                $form_errors[] = $name_of_field . " is a required field";
            }
        }
    }
    return $form_errors;
}

/** * @param $data , store a key/value pair array where key is the name of the form control * in this case 'email' and value is the input entered by the profile * @return array, containing email error */
function check_email($data)
{
    //initialize an array to store error messages
    $form_errors = array();
    $key = 'email';
    //check if the key email exist in data array
    if (array_key_exists($key, $data)) {
        //check if the email field has a value
        if ($_POST[$key] != null) {
            //Remove all illegal characters from email
            $key = filter_var($key, FILTER_SANITIZE_EMAIL);
            //check if input is a valid email address
            if (filter_var($_POST[$key], FILTER_VALIDATE_EMAIL) === false) {
                $form_errors[] = $key . " is not a valid email address";
            }
        }
    }
    return $form_errors;
}
        function flashMessage($message, $passOrFail = "Fail")
        {
            if ($passOrFail === "Pass") {
                $data = "<div class='alert alert-success'>{$message}</p>";
            } else {
                $data = "<div class='alert alert-danger'>{$message}</p>";
            }
            return $data;
        }
        /** * @param $user_id */
        function rememberMe($user_id)
{
    $encryptedCookieData = base64_encode("aKEaojerfknlerQWeqw0qo123124wqe12{$user_id}");
    //Cookie set to expire in about 30 days
    setcookie("rememberUserCookie", $encryptedCookieData, time() + 60 * 60 * 24 * 100, "/");
}
    function signout()
{
    unset($_SESSION['username']);
    unset($_SESSION['id']);
    if (isset($_COOKIE['rememberUserCookie'])) {
        unset($_COOKIE['rememberUserCookie']);
        setcookie('rememberUserCookie', null, -1, '/');
    }
    session_destroy();
    session_regenerate_id(true);
    header("Location: http://admin.demofashant.com/login.php");
}
function sendMail($type, $receiver, $url, $name, $email, $message)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 1;
    $mail->CharSet = "UTF-8";
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'mail.littlechikoosdaycare.com';
    $mail->Port = 465;
    $mail->Username = 'no-reply@littlechikoosdaycare.com';
    $mail->Password = '^ym?.U-yZ+a+';
    $mail->SMTPAuth = true;
    $mail->From = 'no-reply@littlechikoosdaycare.com';
    $mail->FromName = 'demofashant.com';
    $mail->AddAddress($receiver);
    $mail->AddReplyTo('phoenixd110@gmail.com', 'Information');
    $mail->IsHTML(true);
    $mail = generateMails($mail, $type, $url, $name, $email, $message);
    if (!is_bool($mail)) {
        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    }
}
function generateMails($mail, $type, $url, $name, $email, $message)
{
    $default_body = "If you cannot se this email, please use a HTML compatible viewer!";
    switch ($type) {
        case 'welcome':
            $mail->Subject = "Welcome";
            $mail->AltBody = $default_body;
            $header = "Welcome to Fashant!";
            $body = "<p>I hope you find what you are looking for, welcome aboard!</p>";
            $footer = "You recieve this e-mail so that you can verify your e-mail in our system, so that we can reach out to you with news and offers.";
            $mail->Body = emailTemplateDefault($header, $body, $footer, $url);
            return $mail;
            break;
        default:
            return false;
            break;
    }
}function emailTemplateDefault($header, $body, $footer, $verify)
{
    $mail = "<div id=\":208\" class=\"a3s aXjCH m15f4ed5f68f9cb4a\"><u></u>          <div class=\"m_8024715479396616009full-padding\" style=\"margin:0;padding:0\">                    <table class=\"m_8024715479396616009wrapper\" style=\"border-collapse:collapse;table-layout:fixed;min-width:320px;width:100%;background-color:#f0f0f0\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\"><tbody><tr><td>              <div role=\"banner\">                <div class=\"m_8024715479396616009preheader\" style=\"Margin:0 auto;max-width:560px;min-width:280px;width:280px;width:calc(28000% - 167440px)\">                  <div style=\"border-collapse:collapse;display:table;width:100%\">                                      <div class=\"m_8024715479396616009snippet\" style=\"display:table-cell;Float:left;fonts-size:12px;line-height:19px;max-width:280px;min-width:140px;width:140px;width:calc(14000% - 78120px);padding:10px 0 5px 0;color:#bdbdbd;fonts-family:Ubuntu,sans-serif\">                                          </div>                                      <div class=\"m_8024715479396616009webversion\" style=\"display:table-cell;Float:left;fonts-size:12px;line-height:19px;max-width:280px;min-width:139px;width:139px;width:calc(14100% - 78680px);padding:10px 0 5px 0;text-align:right;color:#bdbdbd;fonts-family:Ubuntu,sans-serif\">                                          </div>                                    </div>                </div>                <div class=\"m_8024715479396616009header\" style=\"Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px)\" id=\"m_8024715479396616009emb-email-header-container\">                                  <div class=\"m_8024715479396616009logo m_8024715479396616009emb-logo-margin-box\" style=\"fonts-size:26px;line-height:32px;Margin-top:6px;Margin-bottom:20px;color:#c3ced9;fonts-family:Roboto,Tahoma,sans-serif;Margin-left:20px;Margin-right:20px\" align=\"center\">                    <div class=\"m_8024715479396616009logo-center\" align=\"center\" id=\"m_8024715479396616009emb-email-header\"><a href='http:littlechikoosdaycare.com/'><img style=\"display:block;height:auto;width:100%;border:0;max-width:216px\" src=\"http:littlechikoosdaycare.com/images/logo11.png\" alt=\"\" width=\"216\" class=\"CToWUd\"></a></div>                  </div>                                </div>              </div>              <div role=\"section\">              <div class=\"m_8024715479396616009layout m_8024715479396616009one-col m_8024715479396616009fixed-width\" style=\"Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px);word-wrap:break-word;word-break:break-word\">                <div class=\"m_8024715479396616009layout__inner\" style=\"border-collapse:collapse;display:table;width:100%;background-color:#ffffff\">                                  <div class=\"m_8024715479396616009column\" style=\"text-align:left;color:#787778;fonts-size:16px;line-height:24px;fonts-family:Ubuntu,sans-serif;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px)\">                                    <div style=\"Margin-left:20px;Margin-right:20px;Margin-top:24px\">              <div style=\"line-height:20px;fonts-size:1px\">&nbsp;</div>            </div>                                    <div style=\"Margin-left:20px;Margin-right:20px\">              <div>                <h1 style=\"Margin-top:0;Margin-bottom:0;fonts-style:normal;fonts-weight:normal;color:#565656;fonts-size:30px;line-height:38px;text-align:center\"><strong>{$header}</strong></h1><p style=\"Margin-top:20px;Margin-bottom:0\">&nbsp;<br>                    {$body}              </div>            </div>                            <div style=\"Margin-left:20px;Margin-right:20px\">              <div style=\"line-height:10px;fonts-size:1px\">&nbsp;</div>            </div>";
    if ($verify !== null) {
        $mail .= "            <div style=\"Margin-left:20px;Margin-right:20px\">              <div class=\"m_8024715479396616009btn m_8024715479396616009btn--flat m_8024715479396616009btn--large\" style=\"Margin-bottom:20px;text-align:center\">                <u></u><a style=\"border-radius:4px;display:inline-block;fonts-size:14px;fonts-weight:bold;line-height:24px;padding:12px 24px;text-align:center;text-decoration:none!important;color:#ffffff!important;background-color:#80bf2e;fonts-family:Ubuntu,sans-serif\" href='{$verify}' target=\"_blank\" data-saferedirecturl=\"https:www.google.com/url?hl=en-GB&amp;q=https:www.easyauto.cmail20.com/t/j-i-ojhljyk-l-r/&amp;source=gmail&amp;ust=1508942577562000&amp;usg=AFQjCNFDpiHLWgPIWsEeKFurJg2GLP5wjQ\">VERIFY USER</a><u></u>              </div>            </div>";
    }
    $mail .= "            <div style=\"Margin-left:20px;Margin-right:20px\">              <div style=\"line-height:10px;fonts-size:1px\">&nbsp;</div>            </div>                            <div style=\"Margin-left:20px;Margin-right:20px;Margin-bottom:24px\">              <div style=\"line-height:5px;fonts-size:1px\">&nbsp;</div>            </div>                                  </div>                                </div>              </div>                        <div style=\"line-height:10px;fonts-size:10px\">&nbsp;</div>                                      <div role=\"contentinfo\">                <div class=\"m_8024715479396616009layout m_8024715479396616009email-footer\" style=\"Margin:0 auto;max-width:600px;min-width:320px;width:320px;width:calc(28000% - 167400px);word-wrap:break-word;word-break:break-word\">                  <div class=\"m_8024715479396616009layout__inner\" style=\"border-collapse:collapse;display:table;width:100%\">                                      <div class=\"m_8024715479396616009column m_8024715479396616009wide\" style=\"text-align:left;fonts-size:12px;line-height:19px;color:#bdbdbd;fonts-family:Ubuntu,sans-serif;Float:left;max-width:400px;min-width:320px;width:320px;width:calc(8000% - 47600px)\">                      <div style=\"Margin-left:20px;Margin-right:20px;Margin-top:10px;Margin-bottom:10px\">                        <table class=\"m_8024715479396616009email-footer__links m_8024715479396616009emb-web-links\" style=\"border-collapse:collapse;table-layout:fixed\" role=\"presentation\"><tbody><tr role=\"navigation\">                                                </tr></tbody></table>                        <div style=\"fonts-size:12px;line-height:19px;Margin-top:20px\">                          <div>demofashant.com<br>                        &nbsp;</div>                        </div>                        <div style=\"fonts-size:12px;line-height:19px;Margin-top:18px\">                          <div>{$footer}</div>                        </div>                                              </div>                    </div>                                      <div class=\"m_8024715479396616009column m_8024715479396616009narrow\" style=\"text-align:left;fonts-size:12px;line-height:19px;color:#bdbdbd;fonts-family:Ubuntu,sans-serif;Float:left;max-width:320px;min-width:200px;width:320px;width:calc(72200px - 12000%)\">                      <div style=\"Margin-left:20px;Margin-right:20px;Margin-top:10px;Margin-bottom:10px\">                                              </div>                    </div>                                    </div>                </div>              </div>              <div style=\"line-height:40px;fonts-size:40px\">&nbsp;</div>            </div></td></tr></tbody></table>          <img style=\"overflow:hidden;display:block!important;height:1px!important;width:1px!important;border:0!important;margin:0!important;padding:0!important\" src=\"https:ci4.googleusercontent.com/proxy/EnYJbJ11VpEeJVaqRX0FJ-88idIWXXbXKxSKrCLujeQ0ssAbzhjN2mquuvQ8XQrd6YttlmGSqN1ohL4aOg2vMran7ZJ7CYK2=s0-d-e1-ft#https:www.easyauto.cmail20.com/t/j-o-ojhljyk-l/o.gif\" width=\"1\" height=\"1\" border=\"0\" alt=\"\" class=\"CToWUd\"><div class=\"yj6qo\"></div><div class=\"adL\">        </div></div><div class=\"adL\">        </div></div>";
    return $mail;
}
function emailExists($email)
{
    $mysqli = getConnection();
    $sql = "SELECT * FROM newsletter_subscribers WHERE email = '{$email}'";
    if (mysqli_num_rows(mysqli_query($mysqli, $sql)) > 0) {
        return true;
    }
    return false;
}
function setNewBrand($obj)
{
    $brand = new addNewBrand();
    $brand->setName($obj['brand_name']);
    $brand->setPriceCategory($obj['price_category']);
    $brand->setCity($obj['city']);
    $brand->setContactPhone($obj['list_phone']);
    $brand->setContactEmail($obj['email']);
    $brand->setStoreLocation($obj['store_location']);
    if (isset($obj['address'])) {
        $brand->setAddress($obj['address']);
    } else {
        $brand->setAddress("");
    }
    if (isset($obj['about_brand'])) {
        $brand->setAbout($obj['about_brand']);
    } else {
        $brand->setAbout("");
    }
    if (isset($obj['policies'])) {
        $brand->setPolicies($obj['policies']);
    } else {
        $brand->setPolicies("");
    }
    if (isset($obj['shopping_center'])) {
        $brand->setShoppingCenter($obj['shopping_center']);
    } else {
        $brand->setPolicies("");
    }
    if (isset($obj['brand_categories'])) {
        $brand->setCategories($obj['brand_categories']);
    } else {
        $brand->setCategories(array());
    }
    if (isset($obj['brand_categories_primary'])) {
        $brand->setPrimaryCategory($obj['brand_categories_primary']);
    } else {
        $brand->setPrimaryCategory("");
    }
    if (isset($obj['brand_tagging_primary'])) {
        $brand->setTaggings($obj['brand_tagging_primary']);
    } else {
        $brand->setTaggings(array());
    }
    if (isset($obj['open_mon'])) {
        $brand->setOpenMon($obj['open_mon']);
    } else {
        $brand->setOpenMon("");
    }
    if (isset($obj['open_tues'])) {
        $brand->setOpenTues($obj['open_tues']);
    } else {
        $brand->setOpenTues("");
    }
    if (isset($obj['open_wed'])) {
        $brand->setOpenWed($obj['open_wed']);
    } else {
        $brand->setOpenWed("");
    }
    if (isset($obj['open_thurs'])) {
        $brand->setOpenThurs($obj['open_thurs']);
    } else {
        $brand->setOpenThurs("");
    }
    if (isset($obj['open_fri'])) {
        $brand->setOpenFri($obj['open_fri']);
    } else {
        $brand->setOpenFri("");
    }
    if (isset($obj['open_sat'])) {
        $brand->setOpenSat($obj['open_sat']);
    } else {
        $brand->setOpenSat("");
    }
    if (isset($obj['open_sun'])) {
        $brand->setOpenSun($obj['open_sun']);
    } else {
        $brand->setOpenSun("");
    }
    if (isset($obj['close_mon'])) {
        $brand->setCloseMon($obj['close_mon']);
    } else {
        $brand->setCloseMon("");
    }
    if (isset($obj['close_tues'])) {
        $brand->setCloseTues($obj['close_tues']);
    } else {
        $brand->setCloseTues("");
    }
    if (isset($obj['close_wed'])) {
        $brand->setCloseWed($obj['close_wed']);
    } else {
        $brand->setCloseWed("");
    }
    if (isset($obj['close_thurs'])) {
        $brand->setCloseThurs($obj['close_thurs']);
    } else {
        $brand->setCloseThurs("");
    }
    if (isset($obj['close_fri'])) {
        $brand->setCloseFri($obj['close_fri']);
    } else {
        $brand->setCloseFri("");
    }
    if (isset($obj['close_sat'])) {
        $brand->setCloseSat($obj['close_sat']);
    } else {
        $brand->setCloseSat("");
    }
    if (isset($obj['close_sun'])) {
        $brand->setCloseSun($obj['close_sun']);
    } else {
        $brand->setCloseSun("");
    }
    return $brand;
}
function setNewUser($obj)
{
    $user = new addNewUser();
    $user->setId(mt_rand(10000000, 99999999));
    $user->setFirstName($obj['user_first_name']);
    $user->setLastName($obj['user_last_name']);
    $user->setUsername($obj['user_username']);
    if (isset($obj['user_list_phone'])) {
        $user->setPhone($obj['user_list_phone']);
    } else {
        $user->setPhone("");
    }
    $user->setEmail($obj['user_email']);
    $user->setAddress($obj['user_list_addr']);
    $user->setUserType($obj['user_type']);
    $user->setCity($obj['user_city']);
    if (isset($obj['user_description'])) {
        $user->setDescription($obj['user_description']);
    } else {
        $user->setDescription("");
    }
    return $user;
}
function getUser($id)
{
    $user = new addNewUser();
    $mysqli = getConnection();
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($mysqli, $sql);
    if ($result) {
        while ($row = $result->fetch_array()) {
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
function hasNotReviewed($ukey, $id)
{
    $mysqli = getConnection();
    $query = mysqli_query($mysqli, "SELECT * FROM reviews WHERE brand_id = $id AND ukey = $ukey");
    if (!$query) {
        die('Error: ' . mysqli_error($mysqli));
    }
    if (mysqli_num_rows($query) > 0) {
        return false;
    }
    return true;
}
function emailExist($email)
{
    $mysqli = getConnection();
    $query = mysqli_query($mysqli, "SELECT * FROM users WHERE email='" . $email . "'");
    if (!$query) {
        die('Error: ' . mysqli_error($mysqli));
    }
    if (mysqli_num_rows($query) > 0) {
        return true;
    }
    return false;
}
function brandExist($id)
{
    $mysqli = getConnection();
    $query = mysqli_query($mysqli, "SELECT * FROM brands WHERE id = $id");
    if (!$query) {
        die('Error: ' . mysqli_error($mysqli));
    }
    if (mysqli_num_rows($query) > 0) {
        return true;
    }
    return false;
}
function brandNameExist($name)
{
    $mysqli = getConnection();
    $query = mysqli_query($mysqli, "SELECT * FROM brands WHERE brand = \"$name\"");
    if (!$query) {
        die('Error: ' . mysqli_error($mysqli));
    }
    if (mysqli_num_rows($query) > 0) {
        return true;
    }
    return false;
}
function usernameExist($username)
{
    $mysqli = getConnection();
    $query = mysqli_query($mysqli, "SELECT * FROM users WHERE username='" . $username . "'");
    if (!$query) {
        die('Error: ' . mysqli_error($mysqli));
    }
    if (mysqli_num_rows($query) > 0) {
        return true;
    }
    return false;
}
function uploadNewBrand($brand, $session_id)
{
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
    //Set opening hours
    $sql = "INSERT INTO opening_hours (open_mon, open_tues, open_wed, open_thurs, open_fri, open_sat, open_sun,                                       close_mon, close_tues, close_wed, close_thurs, close_fri, close_sat, close_sun)            VALUES ('$open_mon', '$open_tues', '$open_wed', '$open_thurs', '$open_fri', '$open_sat', '$open_sun',                    '$close_mon', '$close_tues', '$close_wed', '$close_thurs', '$close_fri', '$close_sat', '$close_sun')";    if ($mysqli->query($sql)) {
    //Set brand
    $sql = "INSERT INTO brands (brand, about, policies, store_location, address, contact_phone, contact_email, price_category, city, shopping_center, opening_hours, Ukey)            VALUES (\"$name\", \"$about\", \"$policies\", '$store_location', '$address', '$phone', '$email', $price, '$city', '$shopping_center', $mysqli->insert_id, $session_id);";        if ($mysqli->query($sql)) {
        echo "success " . $mysqli->insert_id;
        //Set categories
        $new_id = $mysqli->insert_id;
        if (is_array($primary_category)) {
            if (!empty($primary_category)) {
                foreach ($primary_category as $pc) {
                    $categories[] = $pc;
                }
            }
        } else {
            $categories[] = $primary_category;
        }            if (!empty($categories)) {
            setNewBrandCategories($new_id, $categories, 0);
        }            if (!empty($taggings)) {
            setNewBrandCategories($new_id, $taggings, 1);
        }        } else {
        echo "failed ";
    }    } else {
    echo "failed ";
}    return $new_id;}

function updateBrand($brand)
{
    $mysqli = getConnection();
    $id = $brand->getId();
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
    $opening_hours = $brand->getOpeningHours();
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
    //Set opening hours
    $sql = "UPDATE opening_hours SET open_mon = '$open_mon', open_tues = '$open_tues', open_wed = '$open_wed', open_thurs = '$open_thurs',                                      open_fri = '$open_fri', open_sat = '$open_sat', open_sun = '$open_sun',                                     close_mon = '$close_mon', close_tues = '$close_tues', close_wed = '$close_wed', close_thurs = '$close_thurs',                                      close_fri = '$close_fri', close_sat = '$close_sat', close_sun = '$close_sun' WHERE id = $opening_hours";    if ($mysqli->query($sql)) {
    //Set brand
    $sql = "UPDATE brands SET brand = '$name', about = '$about', policies = '$policies', store_location = '$store_location',                                   address = '$address', contact_phone = '$phone', contact_email = '$email', price_category = $price,                                   city = '$city', shopping_center = '$shopping_center' WHERE id = $id;";        if ($mysqli->query($sql)) {
        echo "success ";
        //Set categories
        if (is_array($primary_category)) {
            if (!empty($primary_category)) {
                foreach ($primary_category as $pc) {
                    $categories[] = $pc;
                }
            }
        } else {
            $categories[] = $primary_category;
        }            deleteBrandCategories($id);            if (!empty($categories)) {
            setNewBrandCategories($id, $categories, 0);
        }            if (!empty($taggings)) {
            setNewBrandCategories($id, $taggings, 1);
        }        } else {
        echo "failed ";
    }    } else {
    echo "failed ";
}}
function deleteBrandCategories($id)
{
    $mysqli = getConnection();
    $sql = "DELETE FROM brand_in_category WHERE brand_id = $id";
    if ($mysqli->query($sql)) {
        return true;
    }
    return false;
}
function setNewBrandCategories($brand_id, $categories, $pt)
{
    {
        if (!empty($categories)) {
            $mysqli = getConnection();
            foreach ($categories as $category) {
                $category_id = $category;
                $sql = "INSERT INTO brand_in_category (brand_id, category_id, primary_tagging) VALUES ($brand_id, $category_id, $pt);";
                $mysqli->query($sql);
            }
        }
    }
}function setCategories($brand_id, $categories, $pt)
{
    if (!empty($categories)) {
        $mysqli = getConnection();
        foreach ($categories as $category) {
            $category_id = $category['id'];
            $sql = "INSERT INTO brand_in_category (brand_id, category_id, primary_tagging) VALUES ($brand_id, $category_id, $pt);";
            $mysqli->query($sql);
        }
    }
}
function uploadNewUser($user, $password)
{
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
    if (emailExist($email)) {
        //Check if email already exist
        echo "failed " . flashMessage("Email already exist <br>");    } else {
        if (usernameExist($username)) {
            //Check if username already exist
            echo "failed " . flashMessage("Username already exist <br>");        } else {
            $sql = "INSERT INTO users (id, first_name, last_name, phone, email, address, user_type, city, description, username, password, active)            VALUES ($id, '$first_name', '$last_name', '$phone', '$email', '$address', '$user_type', '$city', '$description', '$username', '$hashed_password', $active)";
            if ($mysqli->query($sql) === TRUE) {
                echo "success ";
            } else {
                echo "failed ";
            }
        }
    }
}function getShoppingCentersSelected($selected)
{
    $centers = array("Dubai Festival City", "Burjuman", "Deira City Center", "");
    if (strcmp($selected, "") === 0) {
        echo "<option selected disabled value=''>Shopping Center</option>";
    }
    foreach ($centers as $center) {
        if (strcmp($selected, $center) === 0 && strcmp($selected, "") !== 0) {
            echo "<option selected value='$center'>Shopping Center</option>";
        } else {
            if (strcmp($center, "") !== 0) {
                echo "<option value='$center'>$center</option>";
            }
        }
    }
}function getPriceCategorySelected($selected)
{
    $mysqli = getConnection();
    $sql = "SELECT * FROM price_category";
    $result = mysqli_query($mysqli, $sql);
    if (strcmp($selected, "") === 0) {
        echo "<option selected disabled value=''>Price Category</option>";
    }
    if ($result) {
        while ($row = $result->fetch_array()) {
            $category = $row['cat'] . ' - ' . $row['name'];
            $id = $row['id'];
            if (strcmp($selected, $id) === 0 && strcmp($selected, '') !== 0) {
                echo "<option selected value='$id'>$category</option>";
            } else {
                if (strcmp($category, "") !== 0) {
                    echo "<option value='$id'>$category</option>";
                }
            }
        }
    }
}function getPriceCategoryName($id)
{
    $mysqli = getConnection();
    $sql = "SELECT * FROM price_category WHERE id = $id";
    $result = mysqli_query($mysqli, $sql);
    if ($result) {
        while ($row = $result->fetch_array()) {
            return $row['cat'] . ' - ' . $row['name'];
        }
    }
    return false;
}function getCategoryCheckboxes($type)
{
    if ($type == 2) {
        $categories = getAllCategories(0);
    } else {
        $categories = getAllCategories($type);
    }
    echo "<ul>";
    echo "<table class=\"table table-hover\">                <tbody>";
    $count = 1;
    if (!empty($categories)) {
        foreach ($categories as $category) {
            $id = $category['id'];
            $name = $category['category'];
            if ($type == 0) {
                echo "<tr class=\"col-lg-3 col-md-3\"><td>                    <input type=\"checkbox\" name='brand_categories[]' value='$id' class=\"filled-in\" id=\"filled-in-box-$count\" />                    <label for=\"filled-in-box-$count\" style='font-size: 100%;'>$name</label>                  </td></tr>";
            } elseif ($type == 1) {
                echo "<tr class=\"col-lg-3 col-md-3\"><td>                    <input type=\"checkbox\" name='brand_categories_primary[]' value='$id' class=\"filled-in\" id=\"filled-in-box-0$count\"/>                    <label for=\"filled-in-box-0$count\" style='font-size: 100%;'>$name</label>                  </td></tr>";
            } else {
                echo "<tr class=\"col-lg-3 col-md-3\"><td>                    <input type=\"radio\" name='brand_tagging_primary[]' value='$id' class=\"filled-in\" id=\"filled-in-box-00$count\"/>                    <label for=\"filled-in-box-00$count\" style='font-size: 100%;'>$name</label>                  </td></tr>";
            }
            $count++;
        }
    }
    echo "</tbody>            </table>";
    echo "</ul>";
}function getCategoryCheckboxesSelected($type, $cat, $brand_id)
{
    if ($type == 2) {
        $categories = getAllCategories(0);
    } else {
        $categories = getAllCategories($type);
    }
    echo "<ul>";
    echo "<table class=\"table table-hover\">                <tbody>";
    $count = 1;
    if (!empty($categories)) {
        foreach ($categories as $category) {
            $id = $category['id'];
            $name = $category['category'];
            $checked = "";
            $input_id = "cat_" . $count;
            if (in_array($name, $cat)) {
                $checked = "checked";
            }
            if ($type == 0) {
                echo "<tr class=\"col-lg-3 col-md-3\"><td>                    <input type=\"checkbox\" $checked name='brand_categories[]' onchange=\"updateBrandInfo(this.className, this.value, $brand_id);\" value='$id' class=\"filled-in secondary\" id=\"filled-in-box-$count\" />                    <label for=\"filled-in-box-$count\" style='font-size: 100%;'>$name</label>                  </td></tr>";
            } elseif ($type == 1) {
                echo "<tr class=\"col-lg-3 col-md-3\"><td>                    <input type=\"checkbox\" $checked name='brand_categories_primary' onchange=\"updateBrandInfo(this.className, this.value, $brand_id);\" value='$id' class=\"filled-in categories\" id=\"filled-in-box-0$count\"/>                    <label for=\"filled-in-box-0$count\" style='font-size: 100%;'>$name</label>                  </td></tr>";
            } else {
                echo "<tr class=\"col-lg-3 col-md-3\"><td>                    <input type=\"radio\" $checked name='brand_tagging_primary[]' onchange=\"updateBrandInfo(this.className, this.value, $brand_id);\" value='$id' class=\"filled-in primary\" id=\"filled-in-box-00$count\"/>                    <label for=\"filled-in-box-00$count\" style='font-size: 100%;'>$name</label>                  </td></tr>";
            }
            $count++;
        }
    }
    echo "</tbody>            </table>";
    echo "</ul>";
}function generateListCategory($type, $selected)
{
    $categories = getAllCategories($type);
    $count = 1;
    if (!empty($categories)) {
        foreach ($categories as $category) {
            $id = $category['id'];
            $name = $category['category'];
            if ($type == 0) {
                if (in_array($name, $selected)) {
                    echo "<li>                        <input type=\"checkbox\" checked id=\"scf$count\" onclick=\"filterListings('items[]', '$name');\" />                        <label for=\"scf$count\">$name</label>                    </li>";
                } else {
                    echo "<li>                        <input type=\"checkbox\" id=\"scf$count\" onclick=\"filterListings('items[]', '$name');\" />                        <label for=\"scf$count\">$name</label>                    </li>";
                }
            } else {
                if (in_array($name, $selected)) {
                    echo "<li>                        <input type=\"checkbox\" checked id=\"scf0$count\" onclick=\"filterListings('categories[]', '$name');\" />                        <label for=\"scf0$count\">$name</label>                    </li>";
                } else {
                    echo "<li>                        <input type=\"checkbox\" id=\"scf0$count\" onclick=\"filterListings('categories[]', '$name');\" />                        <label for=\"scf0$count\">$name</label>                    </li>";
                }
            }
            $count++;
        }
    }
}function getCitySelected($selected)
{
    $cities = array("Dubai", "");
    if (strcmp($selected, "") === 0) {
        echo "<option selected disabled value=''>City</option>";
    }
    foreach ($cities as $city) {
        if (strcmp($selected, $city) === 0 && strcmp($selected, '') !== 0) {
            echo "<option selected value='$city'>$city</option>";
        } else {
            if (strcmp($city, "") !== 0) {
                echo "<option value='$city'>$city</option>";
            }
        }
    }
}function getAllCategories($type)
{
    $categories = array();
    $mysqli = getConnection();
    $sql = "SELECT * FROM brand_categories WHERE primary_category = $type";
    $result = mysqli_query($mysqli, $sql);
    while ($row = $result->fetch_array()) {
        $category['id'] = $row['id'];
        $category['category'] = $row['category'];
        $categories[] = $category;
    }
    return $categories;
}function getAllBrands($id)
{
    global $ADMIN;
    $brands = array();
    $mysqli = getConnection();
    if ($id === $ADMIN) {
        $sql = "SELECT * FROM brands";
    } else {
        $sql = "SELECT * FROM brands WHERE Ukey = $id";
    }
    $result = mysqli_query($mysqli, $sql);
    //Fetch all rows
    while ($row = $result->fetch_array()) {
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
    $brands[] = $brand;
}    return $brands;}function getBrandInCategories($id)
{
    $mysqli = getConnection();
    $sql = "SELECT * FROM brand_in_category WHERE brand_id = $id";
    $result = mysqli_query($mysqli, $sql);
    $categories = array();
    if ($result) {
        while ($row = $result->fetch_array()) {
            $categories[] = $row['category_id'];
        }
    }
    return $categories;
}function getBrand($id)
{
    $mysqli = getConnection();
    $sql = "SELECT * FROM brands WHERE id = $id";
    $result = mysqli_query($mysqli, $sql);
    $brand = new addNewBrand();
    if ($result) {
        //Fetch row
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
            $brand->setOpeningHours($row['opening_hours']);
            $brand->setCategories(getBrandInCategories($row['id']));
            $open_id = $row['opening_hours'];
            $open_sql = "SELECT * FROM opening_hours WHERE id = $open_id";
            $open_result = mysqli_query($mysqli, $open_sql);
            if ($open_result) {
                while ($new_row = $open_result->fetch_array()) {
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
        }    } else {
        return false;
    }
    return $brand;
}function getBrandsCategories($id, $type)
{
    $mysqli = getConnection();
    $sql = "";
    switch ($type) {
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
    if ($result) {
        while ($row = $result->fetch_array()) {
            $brand_name = getCategoryByID($row['category_id']);
            if ($brand_name) {
                $categories[] = $brand_name;
            }
        }
    }
    return $categories;
}function getCategoryByID($id)
{
    $mysqli = getConnection();
    $sql = "SELECT * FROM brand_categories WHERE id = $id";
    $result = mysqli_query($mysqli, $sql);
    if ($result) {
        while ($row = $result->fetch_array()) {
            return $row['category'];
        }
    }
    return false;
}function getReviews($id)
{
    $reviews = array();
    $mysqli = getConnection();
    $sql = "SELECT * FROM reviews WHERE brand_id = $id";
    $result = mysqli_query($mysqli, $sql);
    if ($result) {
        while ($row = $result->fetch_array()) {
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
}function getReviewsRating($reviews)
{
}function getListingReviews($reviews)
{
    if (!empty($reviews)) {
        foreach ($reviews as $review) {
            $name = $review->getName();
            $rating = $review->getRating();
            $date = $review->getDate();
            $text = $review->getReview();
            echo "<li>                    <div class=\"lr-user-wr-img\"> <img src=\"images/users/2.png\" alt=\"\"> </div>                    <div class=\"lr-user-wr-con\">                        <h6>$name <span>$rating <i class=\"fa fa-star\" aria-hidden=\"true\"></i></span></h6> <span class=\"lr-revi-date\">$date</span>                        <p>$text </p>                        <ul>                            <li><a href=\"#!\"><span>Like</span><i class=\"fa fa-thumbs-o-up\" aria-hidden=\"true\"></i></a> </li>                            <li><a href=\"#!\"><span>Dis-Like</span><i class=\"fa fa-thumbs-o-down\" aria-hidden=\"true\"></i></a> </li>                            <li><a href=\"#!\"><span>Report</span> <i class=\"fa fa-flag-o\" aria-hidden=\"true\"></i></a> </li>                            <li><a href=\"#!\"><span>Comments</span> <i class=\"fa fa-commenting-o\" aria-hidden=\"true\"></i></a> </li>                            <li><a href=\"#!\"><span>Share Now</span>  <i class=\"fa fa-facebook\" aria-hidden=\"true\"></i></a> </li>                            <li><a href=\"#!\"><i class=\"fa fa-google-plus\" aria-hidden=\"true\"></i></a> </li>                            <li><a href=\"#!\"><i class=\"fa fa-twitter\" aria-hidden=\"true\"></i></a> </li>                            <li><a href=\"#!\"><i class=\"fa fa-linkedin\" aria-hidden=\"true\"></i></a> </li>                            <li><a href=\"#!\"><i class=\"fa fa-youtube\" aria-hidden=\"true\"></i></a> </li>                        </ul>                    </div>                </li>";
        }
    }
}function getAllUsers($id)
{
    $users = array();
    $mysqli = getConnection();
    $sql = "SELECT * FROM users WHERE id != $id";
    $result = mysqli_query($mysqli, $sql);
    //Fetch all rows
    while ($row = $result->fetch_array()) {
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
}    return $users;}function generateAllListingTable($id, $page)
{
}function generateAllUsersTable($id)
{
    $users = getAllUsers($id);
    if (sizeof($users) > 0) {
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
}function updateBrandInformation($col, $value, $id)
{
    $mysqli = getConnection();
    $sql = "UPDATE brands SET $col = '$value' WHERE id = $id";
    if ($mysqli->query($sql)) {
        return 'success ';
    }
    return 'failed ';
}function generateListings($brands)
{
    if (!empty($brands)) {
        foreach ($brands as $brand) {
            $id = $brand->getId();
            $ukey = $brand->getUkey();
            $name = $brand->getName();
            $location = $brand->getStoreLocation();
            $address = $brand->getAddress();
            $img_folder = "uploads/brands/$ukey/$id/0.jpg";
            $img = "images/slider/1.jpg";
            if (file_exists($img_folder)) {
                $img = $img_folder;
            }
            echo "<div class=\"home-list-pop list-spac\">                                    <!--LISTINGS IMAGE-->                                    <div class=\"col-md-3 padingimgbox\"> <img src=\"$img\" alt=\"\" /> </div>                                    <!--LISTINGS: CONTENT-->                                    <div class=\"col-md-9 home-list-pop-desc inn-list-pop-desc\"> <a href=\"listing-details.php?id=$id\">                                            <h3>$name</h3>                                        </a>                                        <h4>$location</h4>                                        <h5>Address: <span>$address</span></h5>                                        <div class=\"list-number\">                                            <!--<h5>Timings : <span>10:00 to 8:00 PM</span></h5>                                            <h5>Phone : <span>+01 1245 2541, +62 6541 6528</span></h5>-->                                        </div>                                        <span class=\"home-list-pop-rat\">0</span>                                        <div class=\"reviewstext\">                                            <h5><span>0</span> <br>                                                reviews</h5>                                            <i title=\"10:00 TO 8:00 PM\" class=\"fa fa-clock-o\" aria-hidden=\"true\"></i><br>                                            <i title=\"+01 1245 2541, +62 6541 6528\" class=\"fa fa-phone-square\" aria-hidden=\"true\"></i><br>                                        </div>                                    </div>                                    <div class=\"clearfix\"></div>                                    <div class=\"list-enqu-btn\">                                        <ul>                                            <li><a href=\"#!\">Write Review</a> </li>                                            <li><a href=\"#!\">Add to Favourite</a> </li>                                            <li><a href=\"#!\">Call</a> </li>                                            <li><a href=\"#!\" data-dismiss=\"modal\" data-toggle=\"modal\" data-target=\"#list-quo\"><i class=\"fa fa-share-alt\" aria-hidden=\"true\"></i></a> </li>                                        </ul>                                    </div>                                </div>";
        }
    }
}function generateListBrands($selected)
{
    global $ADMIN;
    $brands = getAllBrands($ADMIN);
    $count = 1;
    if (!empty($brands)) {
        foreach ($brands as $brand) {
            $name = $brand->getName();
            if (in_array($name, $selected)) {
                echo "<li>                    <input type=\"checkbox\" value='$name' checked id=\"scf00$count\" onclick=\"filterListings('brands[]', '$name');\" />                    <label for=\"scf00$count\">$name</label>                  </li>";
            } else {
                echo "<li>                    <input type=\"checkbox\" value='$name' id=\"scf00$count\" onclick=\"filterListings('brands[]', '$name');\" />                    <label for=\"scf00$count\">$name</label>                  </li>";
            }
            $count++;
        }
    }
}function getHoursOptions($selected)
{
    if (isset($selected)) {
        echo "<option value='$selected' selected>$selected</option>";
    } else {
        echo "<option value='' disabled selected></option>";
    }
    echo "<option value='Closed'>Closed</option>";
    echo "<option value='06:00 am'>06:00 am</option>";
    echo "<option value='06:30 am'>06:30 am</option>";
    echo "<option value='07:00 am'>07:00 am</option>";
    echo "<option value='07:30 am'>07:30 am</option>";
    echo "<option value='08:00 am'>08:00 am</option>";
    echo "<option value='08:30 am'>08:30 am</option>";
    echo "<option value='09:00 am'>09:00 am</option>";
    echo "<option value='09:30 am'>09:30 am</option>";
    echo "<option value='10:00 am'>10:00 am</option>";
    echo "<option value='10:30 am'>10:30 am</option>";
    echo "<option value='11:00 am'>11:00 am</option>";
    echo "<option value='11:30 am'>11:30 am</option>";
    echo "<option value='12:00 pm'>12:00 pm</option>";
    echo "<option value='12:30 am'>12:30 pm</option>";
    echo "<option value='13:00 am'>13:00 pm</option>";
    echo "<option value='13:30 am'>13:30 pm</option>";
    echo "<option value='14:00 am'>14:00 pm</option>";
    echo "<option value='14:30 am'>14:30 pm</option>";
    echo "<option value='15:00 am'>15:00 pm</option>";
    echo "<option value='15:30 am'>15:30 pm</option>";
    echo "<option value='16:00 am'>16:00 pm</option>";
    echo "<option value='16:30 am'>16:30 pm</option>";
    echo "<option value='17:00 am'>17:00 pm</option>";
    echo "<option value='17:30 am'>17:30 pm</option>";
    echo "<option value='18:00 pm'>18:00 pm</option>";
    echo "<option value='18:30 am'>18:30 pm</option>";
    echo "<option value='19:00 am'>19:00 pm</option>";
    echo "<option value='19:30 am'>19:30 pm</option>";
    echo "<option value='20:00 am'>20:00 pm</option>";
    echo "<option value='20:30 am'>20:30 pm</option>";
    echo "<option value='21:00 am'>21:00 pm</option>";
    echo "<option value='21:30 am'>21:30 pm</option>";
    echo "<option value='22:00 am'>22:00 pm</option>";
    echo "<option value='22:30 am'>22:30 pm</option>";
    echo "<option value='23:00 am'>23:00 pm</option>";
    echo "<option value='23:30 am'>23:30 pm</option>";
    echo "<option value='00:00'>00:00</option>";
}function deleteBrand($id)
{
    $mysqli = getConnection();
    $sql = "DELETE FROM brands WHERE id = $id";
    if ($mysqli->query($sql)) {
        return true;
    }
    return false;
}