<?php 
if(isset($_POST['email'])){
    $to = "vishal.sobti@orpinssolutions.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $subject = "Form submission";
    $subject2 = "Fashant Form submission";
    $message = "Email: " . $from;
    $message2 = "Thanks we will contact you shortly";

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2);
    echo "Thank you For subscribe.";
    }
    
?>

<?php 
if(isset($_POST['answer_1'])){
    $to = "vishal.sobti@orpinssolutions.com"; // this is your Email address
    $from = $_POST['answer_1']; // this is the sender's Email address
    //$first_name = $_POST['answer_2'];
    //$phone = $_POST['answer_4'];
    //$msg = $_POST['answer_1'];
    $subject = "Form submission from Marketplace";
    $subject2 = "Fashant Form submission";
    $message = " Name: " .$first_name . "\n\n Phone: " . $phone. "\n\n Email: " . $from. "\n\n Message: " . $msg;
    $message2 = "Thanks " . $first_name . " we will contact you shortly";

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2);
    echo "Thank you " . $first_name . ", we will contact you shortly.";
    }
    

?>