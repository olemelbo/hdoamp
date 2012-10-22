jQuery(document).ready(function($){
	$("#login").click(function() {
		$('#login_window').dialog({ resizable: false });
	});
	
	var siteURL = $("#siteurl p").text();
	alert(siteURL);
	$("#login_submit").click(function() {
		var data = { 
			uname : $("input#uname").val(),
			pwd : $("input#pwd").val()
		};
		
		$.ajax ({
				url : siteURL + "/login/validate_credentials",
				type : 'POST',
				data : data,
				success : function (data) {
					data = $.parseJSON(data);
					if(data.response == "ok") {
						alert(data.msg);
					} else {
						alert(data.error);
					}
				}
				
		});
	});
}); //Document ready slutt