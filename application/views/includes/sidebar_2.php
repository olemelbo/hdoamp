<div id="sidewrap">  
        <div id="sidebar3">
                <div id="back_wrapper">
		
		        <div id="back_to_start">
			        <p><a href="<?php echo site_url(); ?>">Tilbake til forsiden</a></p>
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