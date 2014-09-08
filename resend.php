<?php

require_once('includes/header.php');
require_once('includes/functions.php');

if ( !isset( $_SESSION['sequential'] ) ) header('Location: index.php');

if (isset($_POST['resend'])) {
   emailCustomer();
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
         <h2>You email was sent again.</h2>
         <p>The new email was sent to <?php echo $_SESSION['email'] ?>.</p>
         <p><img src="images/info.png" />Still haven't recieved your email? Send us an email at <a href="mailto:sales@yamo.com.au">sales@yamo.com.au</a> and we'll be happy to organise your new service.</p>
      </div>
   </div>
   <?php include_once('includes/foot.php'); ?>
</body>
</html>