<?php

require_once('includes/header.php');
require_once('includes/functions.php');

if ( isset($_POST['accept']) ) {

   $_SESSION['sequential'] = true;

   $name       = $_POST['name'];
   $email      = $_POST['email'];
   $street1    = $_POST['street1'];
   $street2    = $_POST['street2'];
   $suburb     = $_POST['suburb'];
   $state      = $_POST['state'];
   $postcode   = $_POST['postcode'];
   $phone      = $_POST['phone-num'];

   $internetName = $_POST['internet'];
   $internetCost = getInternetCost($internetName);
   $phoneName    = $_POST['phone'];
   $phoneCost    = getPhoneCost($phoneName);
   $firstName    = explode(' ', trim($name))[0];

   $discountFactor = ( isset($internet) && isset($phone) ? $DISCOUNT_FACTOR : 1 );
   $monthly        = ( $phoneCost + $internetCost ) * $discountFactor;
   $upfront        = ( internetIsRequired() ? $INTERNET_INSTALLATION_FEE : 0 );
   
   $_SESSION['name'] = $name;
   $_SESSION['email'] = $email;
   $_SESSION['street1'] = $street1;
   $_SESSION['street2'] = $street2;
   $_SESSION['suburb'] = $suburb;
   $_SESSION['state'] = $state;
   $_SESSION['postcode'] = $postcode;
   $_SESSION['phoneNum'] = $phone;
   $_SESSION['internetName'] = $internetName;
   $_SESSION['internetCost'] = $internetCost;
   $_SESSION['phoneName'] = $phoneName;
   $_SESSION['phoneCost'] = $phoneCost;
   $_SESSION['monthly'] = $monthly;
   $_SESSION['upfront'] = $upfront;
   
   addOrder();
   
} else {

   unset( $_SESSION['sequential'] );
   header('Location: index.php');
   
}



?>

<!doctype html>
<html>
<head>
   <title>YAMO | Thank you</title>
   <link href="styles/thankyou-style.css" rel="stylesheet" type="text/css" />
   <?php include_once('includes/links.php'); ?>
</head>
<body>
   <?php include_once('includes/top.php'); ?>
   <div class="below-nav">
      <div class="content">
         <h2>Thank you very much, <?php echo $firstName ?>.</h2>
         <p>An email has been sent to <?php echo $email ?> containing information on what to do next.</p>
         <form action="resend.php" method="post">
            <p><img src="images/info.png" />Didn't receive an email? Click the button below.</p>
            <p style="line-height: 65px;"><button class="resend-button" name="resend">Resend Email</button></p>
         </form>
      </div>
   </div>
   <?php include_once('includes/foot.php'); ?>
</body>
</html>