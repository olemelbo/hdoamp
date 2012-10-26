jQuery(document).ready(function($){ 
	var post_statistic_id;
	$(".post_statistic").click(function() { 
	 	post_statistic_id = this.id;
	 	data = {
	 		post_id : post_statistic_id
	 	}
	 	var siteURL = $("#siteurl p").text();
	 	$.ajax ({
				url : siteURL + "/statistics/get_statistics",
				type : 'POST',
				data : data,
				success : function (data) {
					data = $.parseJSON(data);
					if(data.response == "ok") {
						alert(data.msg);
						$("#lightbox, .feedback_panel").fadeOut(300);
					} else {
						alert(data.error);
					}
				}	
			}); 
	});
});
