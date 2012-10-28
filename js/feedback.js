jQuery(document).ready(function($){ 
	var post_id;
	$(".post_feedback").click(function() { 
	 	$(".feedback_panel").fadeIn(300);
	 	post_id = this.id;
	});
	
	var siteURL = $("#siteurl p").text();
	$(".save_feedback_btn").click(function() {
		var agree = $('input[name=agree]').is(':checked'); 
		if(agree) {	agree = 1; } else { agree = 0; }
		
		var disagree = $('input[name=disagree]').is(':checked'); 
		if(disagree) { disagree = 1; } else { disagree = 0; }
		
		var relevant = $('input[name=relevant]').is(':checked'); 
		if(relevant) { relevant = 1; } else { relevant = 0; }
		
		var informative = $('input[name=informative]').is(':checked');
		if(informative) { informative = 1; } else { informative = 0; }
		
		var well_written = $('input[name=well_written]').is(':checked');
		if(well_written) { well_written = 1; } else { well_written = 0; }
		
		var unserious = $('input[name=unserious]').is(':checked');
		if(unserious) { unserious = 1; } else { unserious = 0; }
		
		var data = { 
			post_id : post_id,
			agree : agree,
			disagree : disagree,
			relevant : relevant,
			informative : informative,
			well_written : well_written,
			unserious : unserious 
		}
		
		//Sjekker logic
		if(agree == 0 && disagree == 0 && relevant == 0 && informative == 0 && well_written == 0 && unserious == 0) {
			alert("Du må velge en eller fler alternativer for å kunne gi feedback")
		} else if(agree == 1 && disagree == 1) {
			alert("Du må enten velge enig eller uenig");
		} else if(relevant == 1 && unserious) {
			alert("Du må enten velge relevant eller useriøst");
		} else if(agree == 1 && unserious == 1) {
			alert("Du kan ikke være enig og samtidig synes innlegget er useriøst");
		} else if(informative == 1 && unserious == 1){
			alert("Innlegget kan ikke være informativt, men samtidig useriøst");
		} else if(well_written == 1 && unserious == 1) {
			alert("Innlegget kan ikke være godt skrevet, men samtidig useriøst");
		} else {
			$.ajax ({
				url : siteURL + "/feedback/validate_feedback",
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
		}
		
	});
	
	$(".close_feedback_btn").click(function() { 
	 	$(".feedback_panel").fadeOut(300);
	});
	
});