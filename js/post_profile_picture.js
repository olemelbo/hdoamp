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
						
						$('.post_user_panel').append('<div id="post_user_name"><h2>'+ fnavn + ' ' + enavn + '</h2></div>');
						$('.post_user_panel').append('<div id="post_user_department"><p>'+ "Avdeling: " + department +'</p></div>');
						$('.post_user_panel').append('<div id="post_user_email"><p>'+ "Epost: " + email +'</p></div>');
						$('.post_user_panel').append('<div id="post_user_last_used"><p>'+ "Sist innlogget: " + last_used +'</p></div>');
						$('.post_user_panel').append('<div id="post_user_points"><p>' + "Antall poeng: " + points + '</p></div>');
						$('#post_user_points').after('<button class="close_post_user_btn">Lukk</button>');
					} else {
						alert(data.response);
					}
				}
		}); 
	});
	
	$(".close_post_user_btn").live("click", function() {
	 	$(".post_user_panel").fadeOut(300);
	 	$('#post_user_name').remove();
	 	$('#post_user_department').remove();
	 	$('#post_user_email').remove();
	 	$('#post_user_last_used').remove();
	 	$('#post_user_points').remove();
	 	$('.close_post_user_btn').remove();
	});
	
	$('html').click(function() {	
	 	$(".post_user_panel").fadeOut(300);
	});
});