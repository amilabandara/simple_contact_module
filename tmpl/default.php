<?php
/**
 * @author Amila Bandara
 * @copyright Amila Bandara
 * @license GNU General Public License
 */
defined("_JEXEC") or die("Restricted access");
$app = JFactory::getApplication(); $menu = $app->getMenu()->getActive()->id;
?>
<script type="text/javascript">

jQuery(document).ready(function($){
	var myApp;
	myApp = myApp || (function () {
    var pleaseWaitDiv = $('<div class="modal fade" data-backdrop="static" data-keyboard="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">\n\
  <div class="modal-dialog modal-sm">\n\
    <div class="modal-content">\n\
      <div class="modal-body">\n\
        <!---->\n\
        <h2 class="modal-title text-center" id="myModalLabel">Please Wait.....</h2>\n\
		<p class="text-center"><img src="<?php echo JURI::root(); ?>images/ajax-loader.gif"></p>\n\
        <!---->\n\
      </div>\n\
    </div>\n\
  </div>\n\
</div>');
    return {
        showPleaseWait: function() {
            pleaseWaitDiv.modal('show');
        },
        hidePleaseWait: function () {
            pleaseWaitDiv.modal('hide');
        },
    };
})();

	$(document).on('click', '#send-message', function () {
		myApp.showPleaseWait();
		var name = $('#yourName').val();
		var message = $('#message').val();
		var email = $('#email').val();
		var subject = $('#subject').val();
		var country = $('#country').val();
		//alert(formData);
			request = {
					'option' : 'com_ajax',
					'module' : 'aspire_contacts',
					'name'   : name,
					'email'	:email,
					'message':message,
					'subject':subject,
					'country':country,
					'format' : 'json'
				};
		$.ajax({
			type   : 'POST',
			data   : request,
			success: function (response) {
				
				myApp.hidePleaseWait();
				//alert(response[0]);
				if(response['data']==1){
					$('.status').html('<div class="alert alert-success message" role="alert">\n\
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\n\
					<strong>Message Sent Successfully.</strong></div>');
				}
				else{
					$('.status').html('<div class="alert alert-danger message" role="alert">\n\
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\n\
					<strong>Something Went Wrong, Please Refresh Page and Try Again.</strong></div>');
				}
				
				 setTimeout(function(){ jQuery(".message").fadeOut(1000); }, 3000);
			}
		});
		return false;
	});
});
</script>
<h2><?php echo JText::_('Contact Us'); ?></h2>
<div class="row">
	<div class="col-md-12">
		<div class="status">
			
		</div>
	</div>
</div>
<div class="row">
    <div class="col-md-12">
        <form name="aspire_contact_form" id="aspire_contact_form">
            <div class="form-group">
                <label for="yourName">Your Name</label>
                <input type="text" class="form-control" id="yourName" name="name" placeholder="Your Name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
            </div>
            <div class="form-group">
                <label for="yourCountry">Country</label>
                <?php echo $country_dropdown; ?>
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Message Subject">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" placeholder="Your Message" name="message" rows="3"></textarea>
            </div>

            <button type="button" id="send-message" class="btn btn-success"><b>Send</b></button>
        </form>
    </div>
</div>