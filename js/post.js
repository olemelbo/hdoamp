jQuery(document).ready(function($){ 
	$("#pen-icon").click(function() { 
	 	$("#lightbox, #panel").fadeIn(300);
	});
	
	var siteURL = $("#siteurl p").text();
	$("#save_post_btn").click(function() {
		var data = { 
			title : $("input#post_title").val(),
			hash_tags : $("input#hash_tags").val(),
			in_text : $("textarea#in_text").val()	
		};
		
		alert(data.hash_tags);
		
		if(data['title'] == "") { alert("Du må skrive inn tittel på innlegget"); }
		if(data['in_text'] == "") { alert("Du må skrive inn tekst i innlegget"); }
	
		$.ajax ({
				url : siteURL + "/post/validate_post",
				type : 'POST',
				data : data,
				success : function (data) {
					data = $.parseJSON(data);
					if(data.response == "ok") {
						$("#lightbox, #panel").fadeOut(300);
						$("#content_post").load(siteURL + " #content_post");
					} else {
						alert(data.error);
					}
				}
				
		}); 
	});
	
	$("#close_btn").click(function() {
		$("#lightbox, #panel").fadeOut(300);
	});
});