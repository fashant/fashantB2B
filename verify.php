<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) ) . $ds;

$utilities_dir = "{$base_dir}resources{$ds}utilities.php";

//echo $utilities_dir;
include_once $utilities_dir;

// Add user to mailchimp
//addToMailchimpList($email, $firstname, $lastname);

$error_message = "<h1>404</h1><p><a href=\"https://demofashant.com\">Return to home page</a> </p>";

?>


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
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,800" rel="stylesheet">
    <!-- FONTAWESOME ICONS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- ALL CSS FILES -->
    <link href="css/materialize.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/theme-icons.min.css">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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

<div class="main_middle_part_image">
    <div class="container">
        <div class="row">
            <div class="com-title">
                <?php if(isset($_GET['hash']) && isset($_GET['ukey'])): ?>
                    <?php
                        // Verify user
                        $hash = $_GET['hash'];
                        $ukey = $_GET['ukey'];

                        $mysqli = getConnection();
                        $sql = "SELECT * FROM users WHERE hash = '$hash' AND id = $ukey AND active = 0";

                        if(mysqli_num_rows(mysqli_query($mysqli, $sql)) > 0){
                            $sql = "UPDATE users SET active = 1 WHERE id = $ukey";

                            if($mysqli->query($sql)){
                                // Login user and update mailchimp
                                $_SESSION['id'] = $ukey;

                                $fingerprint = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
                                $_SESSION['last_active'] = time();
                                $_SESSION['fingerprint'] = $fingerprint;

                                $user = getUser($ukey);

                                echo "<h1>Congratulations, your account has been verified</h1>";
                                echo "<p><a href='https://demofashant.com'>Return to home</a></p>";

                                addToMailchimpList($user->getEmail(), $user->getFirstName(), $user->getLastName());


//                                header("Location: https://demofashant.com");
//                                die();
                            } else {
                                echo $error_message;
                            }
                        } else {
                            echo $error_message;
                        }
                    ?>
                <?php else: ?>
                    <?php
                        echo $error_message;
                    ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">

            </div>
        </div>

    </div>
</div>



<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/materialize.min.js" type="text/javascript"></script>
<script src="js/custom.js"></script>
<script src="js/formSubmit.js"></script>

</body>

</html>