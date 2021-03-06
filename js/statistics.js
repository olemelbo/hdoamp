jQuery(document).ready(function($){ 
	var post_statistic_id;
	$(".post_statistic_button").live("click", function() {
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
						$(".statistics_panel").fadeIn(300);
						var agree = 0;
						var relevant = 0;
						var informative = 0;
						var well_written = 0;
						var disagree = 0;
						var unserious = 0;
						$.each(data.feedback, function (key, value) {
           					if(value == "agree") {
           						agree += 1;
           					} else if(value =="relevant") {
           						relevant +=1;
           					} else if(value =="informative") {
           						informative +=1;
           					} else if(value =="well_written") {
           						well_written +=1;
           					} else if(value =="disagree") {
           						disagree +=1;
           					} else {
           						unserious +=1;
           					}
        			 	});
						
						chart = new Highcharts.Chart({
            				chart: {
                				renderTo: 'statistics_high_chart_target',
                				type: 'column'
            				},
           					title: {
                				text: 'Statistikk for innlegget'
            				},
            				xAxis: {
                				categories: [
                    			'Enig',
                    			'Relevant',
                    			'Informativ',
                    			'Godt skrevet',
                    			'Uenig',
                    			'Useriøs'
                   				]
            				},
            				yAxis: {
               	 				min: 0,
                				title: {
                    				text: 'Antall tilbakemeldinger'
                				}
            				},
            				legend: {
                				layout: 'vertical',
                				backgroundColor: '#FFFFFF',
                				align: 'left',
                				verticalAlign: 'top',
                				x: 100,
                				y: 70,
                				floating: true,
               	 				shadow: true
            				},
            				tooltip: {
                				formatter: function() {
                    			return ''+
                        		this.x +': '+ this.y;
                				}
           					},
           					plotOptions: {
               					column: {
                    				pointPadding: 0.2,
                    				borderWidth: 0
                				}
            				},
                			series: [{
								showInLegend: false,
                				name: 'Dette innlegget',
                				data: [{y: agree, color: '#b82f11'},
						       {y: relevant, color: '#ba3f23'},
						       {y: informative, color: '#bd472c'},
						       {y: well_written, color: '#c6573d'},
						       {y: disagree, color: '#d06349'},
						       {y: unserious, color: '#e07b63'}]
    
            				}]
            			});
					}
				}
			}); 
	});
	
	$(".comment_statistic_button").live("click", function() {
	 	comment_statistic_id = this.id;
	 	data = {
	 		post_id : comment_statistic_id
	 	}
	 	var siteURL = $("#siteurl p").text();
	 	$.ajax ({
				url : siteURL + "/statistics/get_comment_statistics",
				type : 'POST',
				data : data,
				success : function (data) {
					data = $.parseJSON(data);
					if(data.error) {
						alert(data.error);
					} else { 
						$(".statistics_panel").fadeIn(300);
						var agree = 0;
						var relevant = 0;
						var informative = 0;
						var well_written = 0;
						var disagree = 0;
						var unserious = 0;
						$.each(data.feedback, function (key, value) {
           					if(value == "agree") {
           						agree += 1;
           					} else if(value =="relevant") {
           						relevant +=1;
           					} else if(value =="informative") {
           						informative +=1;
           					} else if(value =="well_written") {
           						well_written +=1;
           					} else if(value =="disagree") {
           						disagree +=1;
           					} else {
           						unserious +=1;
           					}
        			 	});
						
						chart = new Highcharts.Chart({
            				chart: {
                				renderTo: 'statistics_high_chart_target',
                				type: 'column'
            				},
           					title: {
                				text: 'Statistikk for innlegget'
            				},
            				xAxis: {
                				categories: [
                    			'Enig',
                    			'Relevant',
                    			'Informativ',
                    			'Godt skrevet',
                    			'Uenig',
                    			'Useriøs'
                   				]
            				},
            				yAxis: {
               	 				min: 0,
                				title: {
                    				text: 'Antall tilbakemeldinger'
                				}
            				},
            				legend: {
                				layout: 'vertical',
                				backgroundColor: '#FFFFFF',
                				align: 'left',
                				verticalAlign: 'top',
                				x: 100,
                				y: 70,
                				floating: true,
               	 				shadow: true
            				},
            				tooltip: {
                				formatter: function() {
                    			return ''+
                        		this.x +': '+ this.y;
                				}
           					},
           					plotOptions: {
               					column: {
                    				pointPadding: 0.2,
                    				borderWidth: 0
                				}
            				},
                			series: [{
								showInLegend: false,
                				name: 'Dette innlegget',
                				data: [{y: agree, color: '#b82f11'},
						       {y: relevant, color: '#ba3f23'},
						       {y: informative, color: '#bd472c'},
						       {y: well_written, color: '#c6573d'},
						       {y: disagree, color: '#d06349'},
						       {y: unserious, color: '#e07b63'}]
    
            				}]
            			});
					}
				}
				
			}); 
			
	});
	
	$(".close_statistics_btn").click(function() { 
	 	$(".statistics_panel").fadeOut(300);
	});
	
	$('html').click(function() {	
	 	$(".statistics_panel").fadeOut(300);
	});
});
