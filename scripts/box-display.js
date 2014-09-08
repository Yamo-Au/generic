function generateQuote() {

   var valid = checkAll();
   if (valid) {
      var name = $('#internet :selected').val();
      var rx = /\$\d+$/;
      var cost = rx.exec( $('#internet :selected').text() );
      $('#internet-name').html( name );
      $('#internet-cost').html( cost + ' per month' );
      
      var name = $('#phone :selected').val();
      var rx = /\$\d+$/;
      var cost = rx.exec( $('#phone :selected').text() );
      $('#phone-name').html( name );
      $('#phone-cost').html( cost + ' per month' );
      
      $('#user-name').html( $('#name').val() );
      $('#user-email').html( $('#email').val() );
      $('#user-street1').html( $('#street1').val() );
      $('#user-street2').html( $('#street2').val() );
      $('#user-suburb').html( $('#suburb').val() );
      $('#user-state').html( $('#state').val() );
      $('#user-postcode').html( $('#postcode').val() );
      
      $('#internet').css('background-color', '#eee');
      $('#phone').css('background-color', '#eee');
      $('#customer-details').fadeOut('slow', function() {
         $('#quote').fadeIn('slow', 'swing');
      });
      
      $('#form-error').hide('slow', 'swing');
   }
   else $('#form-error').show('slow', 'swing');
   
}

function showTerms() {

   $('#terms-button').css('transition', 'background-color .5s').css('background-color', '#eee').css('cursor', 'default').css('text-shadow', 'none').css('box-shadow', 'none').prop('disabled', 'true');
   $('#terms').show('slow', 'swing');
   
}