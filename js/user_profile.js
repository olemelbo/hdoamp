jQuery(document).ready(function($) { 
	$("#user_profile").click(function() { 
	 	$("#lightbox, #user_panel").fadeIn(300);
	});
	
	var siteURL = $("#siteurl p").text();
	$("#save_userprofile_btn").click(function() {
		var data = { 
			email : $("input#user_email").val(),
		};
		
		$.ajax ({
				url : siteURL + "/profile/validate_credentials",
				type : 'POST',
				data : data,
				success : function (data) {
					data = $.parseJSON(data);
					if(data.response == "ok") {
						alert(data.message);
						$("#lightbox, #user_panel").fadeOut(300);
					} else {
						alert(data.error);
					}
				}
		}); 
	});
	
	$("#close_userprofile_btn").click(function() {
		$("#lightbox, #user_panel").fadeOut(300);
	});
});