jQuery(document).ready(function($) { 
	$("#user_profile").click(function() { 
	 	$("#lightbox, #user_panel").fadeIn(300);
	});
	
	$("#save_userprofile_btn").click(function() {
		
	});
	
	$("#close_userprofile_btn").click(function() {
		$("#lightbox, #user_panel").fadeOut(300);
	});
});