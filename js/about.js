jQuery(document).ready(function($){ 
	$("#about").live("click", function() { 
		$("#lightbox, .about_panel").fadeIn(300);
	});
	
	
	$('html').click(function() {	
	 	$("#lightbox, .about_panel").fadeOut(300);
	});
});