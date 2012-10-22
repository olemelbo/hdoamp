jQuery(document).ready(function($){
	$("#login").click(function() {
		$('#login_window').dialog({ resizable: false });
	});
	
	$("#login_submit").click(function() {
		var data = { 
			user_id : $("input#uname").val(),
			pwd : $("input#uname").val()
		};
				
		$.ajax ({
				url : "<?php echo site_url('login/validate_credentials'); ?>",
				type : 'POST',
				data : data,
				success : function (data) {
				
				}
				
		});
	});
}); //Document ready slutt