jQuery(document).ready(function($){
	$("#save_comment_btn").live("click", function() {
	 	if($("textarea#comment_text").val() == "") {
	 		alert("En kommentar kan ikke være tom!");
	 	} else {
	 		var siteURL = $("#siteurl p").text();
	 		var data = { 
				comment_text : $("textarea#comment_text").val(),
				innlegg_id : $("#post_id").text()
			};
			
			$.ajax ({
				url : siteURL + "/comment/validate_comment",
				type : 'POST',
				data : data,
				success : function (data) {
					data = $.parseJSON(data);
					if(data.response == "ok") {
						
					} else {
						alert(data.error);
					}
				}
				
		}); 
	 	}
	});	
});