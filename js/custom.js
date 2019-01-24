$(function(){
	'use strict';
	var userError = false,
	    emailError = false,
		mobileError = false,
		passwordError = false,
		messageError = false,
		commentError = false;

	    
	
	
	$('.username').blur(function(){
		if ($(this).val().length <= 4) {
			userError = true;
			//console.log("The field need 3 characters");
			$(this).css('border', '1px solid #b53241');
			$(this).parent().find('.custom-alert').fadeIn(300);
			$(this).parent().find('.asterisk').fadeIn(300);
			
		} else {
			userError = false;
			$(this).css('border', '1px solid #337ab7');
			$(this).parent().find('.custom-alert').fadeOut(300);
			$(this).parent().find('.asterisk').fadeOut(300);
			
		}
		
	});
	$('.email').blur(function(){
		if ($(this).val() === '') {
			emailError = true;
			//console.log("The field need 3 characters");
			$(this).css('border', '1px solid #b53241');
			$(this).parent().find('.custom-alert').fadeIn(300);
			$(this).parent().find('.asterisk').fadeIn(300);
			
		} else {
			emailError = false;
			$(this).css('border', '1px solid #337ab7');
			$(this).parent().find('.custom-alert').fadeOut(300);
			$(this).parent().find('.asterisk').fadeOut(300);
			
		}

	});
	$('.mobile').blur(function(){
		if ($(this).val() === '') {
			mobileError = true;
			$(this).css('border', '1px solid #b53241');
			$(this).parent().find('.custom-alert').fadeIn(300);
			$(this).parent().find('.asterisk').fadeIn(300);
			
		} else {
			mobileError = false;
			$(this).css('border', '1px solid #337ab7');
			$(this).parent().find('.custom-alert').fadeOut(300);
			$(this).parent().find('.asterisk').fadeOut(300);
			
		}
	});
	$('.message').blur(function(){
		if ($(this).val().length <= 9) {
			messageError = true;
			$(this).css('border', '1px solid #b53241');
			$(this).parent().find('.custom-alert').fadeIn(300);
			$(this).parent().find('.asterisk').fadeIn(300);
			
		} else {
			messageError = false;
			$(this).css('border', '1px solid #337ab7');
			$(this).parent().find('.custom-alert').fadeOut(200);
			$(this).parent().find('.asterisk').fadeOut(300);
			
		}
	
		
	});
	$('.password').blur(function(){
		if ($(this).val().length <= 4) {
			userError = true;
			//console.log("The field need 3 characters");
			$(this).css('border', '1px solid #b53241');
			$(this).parent().find('.custom-alert').fadeIn(300);
			$(this).parent().find('.asterisk').fadeIn(300);
			
		} else {
			userError = false;
			$(this).css('border', '1px solid #337ab7');
			$(this).parent().find('.custom-alert').fadeOut(300);
			$(this).parent().find('.asterisk').fadeOut(300);
			
		}
		
	});
	$('.comment').blur(function(){
		if ($(this).val().length <= 20) {
			commentError = true;
			//console.log("The field need 3 characters");
			$(this).css('border', '1px solid #b53241');
			$(this).parent().find('.custom-alert').fadeIn(300);
			
			
		} else {
			commentError = false;
			$(this).css('border', '1px solid #337ab7');
			$(this).parent().find('.custom-alert').fadeOut(300);
			
			
		}
		
	});
	$('#contact-form').submit(function(e){
		if (userError == true || emailError == true || mobileError == true || messageError == true) {
             e.preventDefault();
			 $('.username, .email, .mobile, .message').blur();
		}
	});
	$('#register-form').submit(function(e){
		if (userError == true || emailError == true || passwordError == true) {
             e.preventDefault();
			 $('.username, .email, .password').blur();
		}
	});
	$('#comment-form').submit(function(e){
		if (commentError == true) {
             e.preventDefault();
			 $('.comment').blur();
		}
	});
	
	
});
	
