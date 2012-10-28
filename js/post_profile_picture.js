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
					if(data.response == "ok") {
						$(".post_user_panel").fadeIn(300);
						var fnavn;
						var enavn;
						var image_link;
						var department;
						var email;
						var last_used;
						var points;
						$.each(data, function (key, value) { 
							if(key == "fnavn") {
								fnavn = value;
							} else if(key == "enavn") {
								enavn = value;
							} else if(key =="image_link") {
								image_link = value;
							} else if(key =="department") {
								department = value;
							} else if(key =="email") {
								email = value;
							} else if(key =="sist_innlogget") {
								last_used = value;
							} else if(key =="points") {
								points = value;
							} else {
								
							}
						});
					
						$('#post_user_name').append('<h2>'+ fnavn + ' ' + enavn + '</h2>');
						$('#post_user_department').append('<p>'+ "Avdeling: " + department +'</p>');
						$('#post_user_email').append('<p>'+ "Epost: " + email +'</p>');
						$('#post_user_last_used').append('<p>'+ "Sist innlogget: " + last_used +'</p>');
						$('#post_user_points').append('<p>' + "Antall poeng: " + points + '</p>');
					} else {
						alert(data.response);
					}
				}
		}); 
	});
	
	$(".close_post_user_btn").live("click", function() {
	 	$(".post_user_panel").fadeOut(300);
	});
});