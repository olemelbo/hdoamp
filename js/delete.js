jQuery(document).ready(function($) {
	var id;
	$(".delete_comment_button").live("click", function() {
		id = this.id;
	 	$('#delete_window').dialog({ resizable: false });
	});	 
	
	$(".delete_post_button").live("click", function() {
		
	});
	
	var siteURL = $("#siteurl p").text();
	$("#delete_comment_submit").live("click", function() {
		var data = { 
			id : id
		}
		
		$.ajax ({
				url : siteURL + "/delete/delete_user_comment",
				type : 'POST',
				data : data,
				success : function (data) {
					location.reload();
				}
				
		});
	}); 
	
	$("#delete_cancel").click(function() { 
		$('#delete_window').dialog('close');
	});
	
	
});