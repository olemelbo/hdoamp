jQuery(document).ready(function($) { 
	$("#post_picture img").live("click", function(){
	 	var siteURL = $("#siteurl p").text();
	 	var data = {
	 		user_id : this.id
	 	}
	 	
	 	$.ajax ({
				url : siteURL + "/entire_post/getUserData",
				type : 'POST',
				data : data,
				success : function (data) {
					data = $.parseJSON(data);
					
				}
		}); 
	});
});