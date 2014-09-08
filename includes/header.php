<?php

session_start();

require ('includes/PHPMailer/PHPMailerAutoload.php');

$ORDERS_FILE = 'data/orders';
$STARTING_ORDER_NUMBER = 1000;

$SALES_EMAIL = 'sales@yamo.com.au';
$SALES_NAME = 'Yamo Sales';
$ORDER_EMAIL_CC = 'sales@yamo.com.au';
$ORDER_EMAIL_SUBJECT = 'Order Summary and Instructions';

$ATTACHMENTS_DIR = 'forms/';

$EMAIL_ATTACHMENTS = array(
   $ATTACHMENTS_DIR . 'yamo-dd.pdf' => 'YAMO Direct Debit Form.pdf',
   $ATTACHMENTS_DIR . 'agreement.pdf' => 'YAMO Customer Agreement.pdf',
   $ATTACHMENTS_DIR . 'waiver.pdf' => 'Yamo Customer Service Guarantee Waiver.pdf'
);

$INTERNET_HEADING = 'ADSL2+';
$PHONE_HEADING = 'Phone';
$PERSONAL_DETAILS_HEADING = 'Personal Details';

$DISCOUNT_FACTOR = 0.1;

$INTERNET_INSTALLATION_FEE = 100.00;
$INTERENET_MIN_CONTRACT_TERM = 12;

$INTERNET_PLANS = array(
   '12/1' => 100,
   '25/5' => 110,
   '25/10' => 120,
   '50/10' => 130,
   '100/40' => 140
);

$PHONE_PLANS = array(
   'Unlimited' => 45
);

?>