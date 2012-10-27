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
					if(data.error) {
						alert(data.error);
					} else { 
					
					 $.each(data.feedback, function (key, value) {
           				 alert(value);
        			 });
					}
				}
			}); 
	});
});
