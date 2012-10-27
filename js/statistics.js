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
						$("#lightbox, .statistics_panel").fadeIn(300);
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
           						disagree +=1;
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
                				text: 'Statestikk for innlegget'
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
                        		this.x +': '+ this.y +'antall';
                				}
           					},
           					plotOptions: {
               					column: {
                    				pointPadding: 0.2,
                    				borderWidth: 0
                				}
            				},
                			series: [{
                				name: 'Dette innlegget',
                				data: [agree,relevant, informative,well_written,disagree,unserious]
    
            				}]
            			});
					}
				}
			}); 
	});
	
	$(".close_statistics_btn").click(function() { 
	 	$("#lightbox, .statistics_panel").fadeOut(300);
	});
});
