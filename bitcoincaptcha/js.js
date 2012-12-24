jQuery(document).ready(function() {
	jQuery('.bitcoincaptcha-unlock').click(function () {
		
		// Get the hidden element
		var hidden_element = jQuery('#'+this.id).next();
		hidden_element.slideToggle('slow');
		
		// Change the unlock link text
		if(hidden_element.attr('status') === 'invisible') {
			hidden_element.attr('status', 'visible');
			
			// Make the unlocklink a lesslink
			jQuery('#'+this.id).text('Less »');

			// check for payment
			checkForPayment();
		}
		else {
			hidden_element.attr('status', 'invisible');
			
			// Get the unlocklink text, that the user wants to be displayed
			var unlocklink_text = jQuery('#'+this.id).attr('unlocklink-text');
			
			// Make the lesslink a unlock link
			jQuery('#'+this.id).text(unlocklink_text+'  »');
		}
	});
});

function checkForPayment() {
	try {
		if (jQuery('input[name="bitcoincaptcha_challenge"]').val().length > 0) {
			if (jQuery('input#bitcoinCAPTCHAsubmit').length <= 0) {
				jQuery('input[name="bitcoincaptcha_challenge"]').replaceWith('<form method="post" action=""><input type="hidden" name="bitcoincaptcha_challenge" value="' + jQuery('input[name="bitcoincaptcha_challenge"]').val() + '" /><input id="bitcoinCAPTCHAsubmit" type="submit" value="read" /></form>');
			}
		}
		else {
			setTimeout("checkForPayment()", 3000);
		}
	} catch (e) {
		setTimeout("checkForPayment()", 3000);
	}
}