<?php

function discountApplies() {
   return ( internetIsRequired() && phoneIsRequired() );
}

function getInternetCost($name) {
   global $INTERNET_PLANS;
   return $INTERNET_PLANS[$name];
}

function getPhoneCost($name) {
   global $PHONE_PLANS;
   return $PHONE_PLANS[$name];
}

function internetIsRequired() {
   return isset( $_SESSION['internet-plan'] );
}

function phoneIsRequired() {
   return isset( $_SESSION['internet-plan'] );
}

function internetPlansToDropdown() {
   global $INTERNET_PLANS;
   echo '<select name="internet" id="internet">';
   foreach($INTERNET_PLANS as $plan => $cost) {
      echo '<option value="' . $plan . '">' . $plan . 'Mbps - $' . $cost . '</option>';
   }
   echo '</select>';
}

function phonePlansToDropdown() {
   global $PHONE_PLANS;
   echo '<select id="phone" name="phone">';
   foreach($PHONE_PLANS as $plan => $cost) {
      echo '<option value="' . $plan . '">' . $plan . ' - $' . $cost . '</option>';
   }
   echo '</select>';
}

function emailCustomer() {

   global $SALES_EMAIL;
   global $SALES_NAME;
   global $ORDER_EMAIL_CC;
   global $ORDER_EMAIL_SUBJECT;
   global $INTERNET_INSTALLATION_FEE;
   global $INTERNET_MIN_CONTRACT_TERM;
   global $DISCOUNT_FACTOR;
   global $EMAIL_ATTACHMENTS;
   
   $body  = '<html><body><p>Hi ' . $_SESSION['name'] . ', </p>';
   $body .= '<p>Thank you for your order. <strong>Please find below a summary of your order and information on what to do next</strong></p>';
   $body .= '<table rules="all" style="border-color:#666;width:100%;" cellpadding="10">';
   $body .= '<tr style="background:#eee;"><td><strong>Name</strong></td>';
   $body .= '<tr><td><strong>Name</strong></td><td>' . $_SESSION['name'] . '</td></tr>';
   $body .= '<tr><td><strong>Email</strong></td><td>' . $_SESSION['email'] . '</td></tr>';
   $body .= '<tr><td><strong>Address</strong></td><td>'.$_SESSION["street1"]. ' ' .$_SESSION["street2"].", ".$_SESSION["suburb"].", ".$_SESSION["state"]." ".$_SESSION["postcode"].'</td></tr>';
   $body .= '<tr><td><strong>Contact number:</strong></td><td>' . $_SESSION['phoneNum'] . '</td></tr>';
   if ( phoneIsRequired() ) {
      $body .= '<tr><td><strong>Phone plan</strong></td><td>' . $_SESSION['phoneName'] . '</td></tr>';
      $body .= '<tr><td><strong>Phone plan monthly cost</strong></td><td>' . $_SESSION['phoneCost'] . '</td></tr>';
   }
   if ( internetIsRequired() ) {
      $body .= "<tr><td><strong>Internet plan</strong></td><td>" .$_SESSION["internetName"]. "</td></tr>";
      $body .= "<tr><td><strong>Internet plan monthly cost</strong></td><td>$" . number_format($_SESSION["internetCost"], 2, '.', '') . "</td></tr>";
      $body .= "<tr><td><strong>Internet activation fee</strong></td><td>$" . number_format($INTERNET_INSTALLATION_FEE, 2, '.', '') . "</td></tr>";
      $body .= '<tr><td><strong>Minimum contact term</strong></td><td>' . $INTERNET_MIN_CONTRACT_TERM . ' months</td></tr>';
   }
   if ($_SESSION['discount']) {
      $body .= "<tr><td><strong>Monthly discount</strong></td><td>" . $DISCOUNT_FACTOR * 10 . "%</td></tr>";
   }
   $body .= "<tr><td><strong>Total upfront cost</strong></td><td>$" . number_format($_SESSION["upfront"], 2, '.', '') . "</td></tr>";
   $body .= "<tr><td><strong>Total monthly cost</strong></td><td>$" . number_format($_SESSION["monthly"], 2, '.', '') . "</td></tr>";
   $body .= '</table>';
   $body .= '<p>Please find attached a direct debit form and a copy of our terms and conditions which you agreed to in the ordering process.</p>'
         .'<p><strong>Please print, complete, sign, scan and email the direct debit form to <a href="mailto:' . $SALES_EMAIL . '">' . $SALES_EMAIL . '.</strong></p>'
         .'<p>Kind regards,<br />YAMO Sales Team</p></body></html>';

   $mail = new PHPMailer();
   $mail->IsHTML(true);
   $mail->ContentType = 'text/html';
   $mail->CharSet     = 'UTF-8';
   $mail->From = $SALES_EMAIL;
   $mail->FromName = $SALES_NAME;
   $mail->AddAddress( $_SESSION['email'] );
   $mail->AddCC( $ORDER_EMAIL_CC );
   $mail->Subject = $ORDER_EMAIL_SUBJECT;
   $mail->Body = $body;

   foreach ($EMAIL_ATTACHMENTS as $filename=>$name) {
      $mail->AddAttachment($filename, $name);
   }
   
   $mail->Send();
   
}

function addOrder() {

   if ( !isset($_SESSION['orderNumber']) ) {
      global $ORDERS_FILE;
      global $STARTING_ORDER_NUMBER;
      
      $orderNumber = $STARTING_ORDER_NUMBER;
      
      if (file_exists($ORDERS_FILE)) {
         $lines = file($ORDERS_FILE);
         foreach($lines as $line) {
            $orderNumber = intval($line);
         }
         $orderNumber++;
      }
      
      file_put_contents( $ORDERS_FILE, $orderNumber."\r\n", FILE_APPEND | LOCK_EX );
      $_SESSION['orderN'] = $orderNumber;
     
   }
   
   emailCustomer();
   
}
   
?>