<?php

require_once('includes/header.php');
require_once('includes/functions.php');

?>

<!doctype html>
<html>
<head>
   <title>YAMO | New Order</title>
   <?php include_once('includes/links.php'); ?>
</head>
<body>
   <?php include_once('includes/top.php'); ?>
   <div class="below-nav">
      <div class="content">
         <h2>Welcome to YAMO, the specialists in IP Telephony and Cloud Computing.</h2>
         <form action="thankyou.php" method="post" id="customer-form">
         <div id="customer-details" class="basic-grey">
            <h1>Customer Details
               <span>Please fill all the texts in the fields.</span>
            </h1>
            <label>
               <span><img id="nameError" class="error" src="images/error.png" />Name</span>
               <input id="name" onblur="check(this);" type="text" name="name" placeholder="Your Full Name" autofocus/>
            </label>
             
            <label>
               <span><img class="error" src="images/error.png" />Email</span>
               <input id="email" onblur="check(this);" type="email" name="email" placeholder="Valid Email Address" />
            </label>
             
            <label>
               <span><img class="error" src="images/error.png" />Address</span>
               <input id="street1" onblur="check(this);" type="text" name="street1" placeholder="Street Line 1"></input>
               <span>&nbsp;</span>
               <input id="street2" type="text" name="street2" placeholder="Street Line 2"></input>
               <span>&nbsp;</span>
               <input id="suburb" onblur="check(this);" type="text" name="suburb" placeholder="Suburb"></input>
               <select id="state" style="width:35%;" name="state">
                  <option value="none">State</option>
                  <option value="NSW">NSW</option>
                  <option value="ACT">ACT</option>
                  <option value="QLD">QLD</option>
                  <option value="VIC">VIC</option>
                  <option value="SA">SA</option>
                  <option value="NT">NT</option>
                  <option value="TAS">TAS</option>
               </select>
               <span>&nbsp;</span>
               <input style="width:33%;" id="postcode" onblur="check(this);" type="text" name="postcode" placeholder="Postcode"></input>
            </label>
            <label>
               <span><img class="error" src="images/error.png" />Contact Number</span>
               <input id="phone-num" onblur="check(this);" type="text" name="phone-num" placeholder="Daytime telephone number" />
            </label>
            <label>
               <span><?php echo $INTERNET_HEADING; ?></span>
               <?php internetPlansToDropdown(); ?>
            </label>
            <label>
               <span><?php echo $PHONE_HEADING; ?></span>
               <?php phonePlansToDropdown(); ?>
            </label>
            <table>
               <tr style="height:57px;vertical-align:middle;">
                  <td style="text-align:center;" colspan="2"><a href="#quote"><button class="button" onclick="generateQuote();">Generate Quote &#65516;</button></a></td>
               </tr>
            </table>
            <div id="form-error">
               <span>There are errors present in the form. Please check your information and try again.</span>
            </div>
         </div>
         <div id="quote" class="basic-grey">
            <h1>Your Personal Quote
               <span>Please review your quote and personal details and click continue.</span>
            </h1>
            <table>
               <tr><th colspan="2"><h2><?php echo $INTERNET_HEADING ?></h2></th></tr>
               <tr><td>Plan</td><td id="internet-name"></td></tr>
               <tr><td>Cost</td><td id="internet-cost"></td></tr>
               <tr><td>Installation</td><td id="internet-installation-fee">$<?php echo $INTERNET_INSTALLATION_FEE ?></td></tr>
               <script type="text/javascript">
                  var name = $('#adsl :selected').val();
                  var rx = /\$\d+$/;
                  var cost = rx.exec( $('#adsl :selected').text() );
                  $('#internet-name').html( name );
                  $('#internet-cost').html( cost + ' per month' );
               </script>
               <tr><th colspan="2"><h2><?php echo $PHONE_HEADING ?></h2></th></tr>
               <tr><td>Plan</td><td id="phone-name"></td></tr>
               <tr><td>Cost</td><td id="phone-cost"></td></tr>
               <script type="text/javascript">
                  var name = $('#phone :selected').val();
                  var rx = /\$\d+$/;
                  var cost = rx.exec( $('#phone :selected').text() );
                  $('#phone-name').html( name );
                  $('#phone-cost').html( cost + ' per month' );
               </script>
               <tr><th colspan="2"><h2><?php echo $PERSONAL_DETAILS_HEADING ?></h2></th></tr>
               <tr><td>Name</td><td id="user-name"></td></tr>
               <tr><td>Email</td><td id="user-email"></td></tr>
               <tr><td>Address</td><td id="user-street1"></td></tr>
               <tr><td>&nbsp;</td><td id="user-street2"></td></tr>
               <tr><td>&nbsp;</td><td id="user-suburb"></td></tr>
               <tr><td>&nbsp;</td><td id="user-state"></td></tr>
               <tr><td>&nbsp;</td><td id="user-postcode"></td></tr>
               <script type="text/javascript">
                  $('#user-name').html( $('#name').val() );
                  $('#user-email').html( $('#email').val() );
                  $('#user-street1').html( $('#street1').val() );
                  $('#user-street2').html( $('#street2').val() );
                  $('#user-suburb').html( $('#suburb').val() );
                  $('#user-state').html( $('#state').val() );
                  $('#user-postcode').html( $('#postcode').val() );
               </script>
               <tr style="height:57px;vertical-align:bottom;">
                  <td>&nbsp;</td><td><a href="#terms">
                     <button id="terms-button" class="button" onclick="showTerms(); return false;">Continue &#65516;</button>
                  </a></td>
               </tr>
            </table>
            <span class="box-footer">
               Not what you were looking for? <a class="start-again-link" href="index.php">Start again</a>
            </span>
         </div>
         <div id="terms" class="basic-grey">
            <h1>Terms and Conditions
            <span>Please review the terms and conditions and click next.</span></h1>
            <?php include_once('show-terms.php'); ?>
            <table>
               <tr>
                  <td style="text-align:center;" colspan="2"><input id="terms-accepted" name="terms-accepted" type="checkbox" /> I accept the terms and conditions.</td>
               </tr>
               <tr style="height:57px;vertical-align:middle;">
                  <td style="text-align:center;" colspan="2"><button name="accept" class="button" onclick="return acceptedTerms();">Next &#8594;</button></td>
               </tr>
            </table>
            <div id="terms-error">
               <span>You must accept the terms and conditions in order to proceed.</span>
            </div>
         </div>
         </form>
         <div id="loading-parent">
         </div>
      </div>
   </div>
   <?php include_once('includes/foot.php'); ?>
</body>
</html>