function check(element) {
   if ($(element).val() == '') {
      $(element).parent().find('.error').show('slow');
   } else {
      $(element).parent().find('.error').hide('slow');
   }
}

function checkAll() {
   var valid = true;
   $("form#customer-form :input:not(:button)").each(function(){
      var input = $(this);
      if (input.val() == '') {
         valid = false;
         return false;
      }
   });
   return valid;
}

function acceptedTerms() {
   if ( $('#terms-accepted').prop('checked') ) {
      return true;
   } else {
      $('#terms-error').show('slow', 'swing');
      return false;
   }
}