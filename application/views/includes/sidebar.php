<script>
    $(function() {

    var $sidebar   = $("#sidebar"), 
        $window    = $(window),
        offset     = $sidebar.offset(),
        topPadding = 15;

    $window.scroll(function() {
        if ($window.scrollTop() > offset.top) {
            $sidebar.stop().animate({
                marginTop: $window.scrollTop() - offset.top + topPadding
            });
        } else {
            $sidebar.stop().animate({
                marginTop: 0
            });
        }
    });
    
    });
</script>

<div id="sidewrap">  
        <div id="sidebar3">
                <div id="pen-wrapper">
		
		        <div id="pen-line">
			        <p>Skriv et innlegg</p>
		        </div>
		
		        <div id="pen-icon">
		        </div>
	        </div><!-- #pen-wrapper -->
        </div>


    <div id="sidebar">
		    <div id="sidebar_head">
			    <h2 class="mnd">M&aring;nedens</h2>
			    <h2 class="deb">debattant</h2>
		    </div>
		    <div id="sidebar_content">
			    <?php if(isset($ranking)) : ?>
			    <ol>
				    <?php foreach($ranking as $rank) : ?>
					    <li><?php echo $rank['fname'] . " " . $rank['ename'] . " (" . $rank['points'] . ")";?></li>
				    <?php endforeach; ?>
			    </ol>
			    <?php else : ?>
				    <p>Ingen brukere har fått poeng</p>
			    <?php endif; ?>
		    </div>
	    </div><!-- end sidebar -->

	    <div id="sidebar2">
		    <div id="sidebar_head2">
			    <p>#her #kommer #hashtags</p>
	    </div>
    </div><!-- end sidebar -->
    
</div>
