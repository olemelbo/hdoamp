jQuery(document).ready(function($) {
	var id;
	var siteURL = $("#siteurl p").text();
	$(".delete_comment_button").live("click", function() {
		id = this.id;
	 	$('#delete_comment_window').dialog({ resizable: false });
	});	 
	
	$(".delete_post_button").live("click", function() {
		id= this.id;
		$('#delete_post_window').dialog({ resizable: false});	
	
	});
	
	
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
	
	$("#delete_post_submit").live("click", function() {
		var data = { 
			id : id
		}
		
		$.ajax ({
				url : siteURL + "/delete/delete_user_post",
				type : 'POST',
				data : data,
				success : function (data) {
					//location.reload();
				}
				
		});
	}); 
	
	$("#delete_comment_cancel").click(function() { 
		$('#delete_comment_window').dialog('close');
	});
	
	$("#delete_post_cancel").click(function() { 
		$('#delete_post_window').dialog('close');
	});
	
	
});