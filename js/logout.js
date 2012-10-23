jQuery(document).ready(function($){ 
	$("#logout").click(function() { 
		$('#logout_window').dialog({ resizable: false });
	});
	
	$("#logout_cancel").click(function() { 
		$('#logout_window').dialog('close');
	});
	
	var siteURL = $("#siteurl p").text();
	var data = {};
	
	$("#logout_submit").click(function(){
		$.ajax ({
				url : siteURL + "/logout/log_user_out",
				type : 'POST',
				data : data,
				success : function (data) {
					
				}
				
		});
	});
	
	
});//Document ready slutt