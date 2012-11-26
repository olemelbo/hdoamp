<div id="wrap">
	<div id="header">
		<div id="logo"><h1><a href="<?php echo site_url(); ?>">HiG<span style="font-weight: normal;"> Debatt</span></a></h1>
		</div><!-- #logo -->
		<div id='login'><h3><a href='#'>Logg inn</a></h3></div>
		<div id="search">
			<form class="form-wrapper">
			        <input type="text" id="search" placeholder="S&oslash;k i HiG Debatt.." required>
			</form>
		</div>
	</div><!-- end header-->	
		
		<div id="slogan">
			<p>Husk &aring; v&aelig;re snill og grei, ellers blir det ingen debatt p&aring; deg!</p>
		</div>
		<div id="nav">
			<h3>SISTE</h3>
			<h3>POPUL&AElig;RE</h3>
			<h3>ARKIV</h3>
		</div>

	<div id="content_post">
		<?php foreach($posts as $post) : ?>
		<div class="post">
			<div id="post_<?php echo $post['id']; ?>">
				<?php if(empty($user_image)) : ?>
					<div id="post_picture"><a href="#"><img src="<?php echo base_url()?>images/profile.jpg" alt="profile_picure" id="<?php echo $post['user_id']; ?>" /></a></div>	
				<?php else : ?>
				
				<?php endif; ?>
				<h2><a href="<?php echo site_url()?>/entire_post/loadEntirePost/<?php echo $post['id']?>"><?php  echo $post['tittel'] ?></a></h2>
				
				<?php if(!empty($post['date'])) : ?>
					<h3><?php echo $post['date']; ?></h3>
				<?php endif; ?>
				
				<?php if(!empty($post['hashtags'])) : ?>
					<p class="hashtags"><?php foreach($post['hashtags'] as $p) { echo "<a href='#'>#".$p . " " . "</a>"; } ?> </p>
				<?php endif; ?>
				
				
				
				<p class="post_truncated"><?php echo $truncated = substr($post['in_text'], 0, 250) . '...' ?></p>
				<div class="post_bar">
					<div class="post_alternatives">
						<div class="post_statistic">
							<input type="image" src="<?php echo base_url(); ?>images/graph_icon.png" alt="Submit" width="35" height="35" class="post_statistic_button" id="<?php echo $post['id']; ?>"></button>
							<p>Se statistikk</p>
						</div>
					</div>
					<div class="numberOfComments">
						<p><a href="<?php echo site_url()?>/entire_post/loadEntirePost/<?php echo $post['id']?>"><img src='<?php echo base_url(); ?>images/speechbubble.png' id="comments_pic" /><?php echo $post['numberOfComments'] ?> kommentarer</a></p>
					</div>
				</div> <!-- end .postbar-->
				
			</div><!--end divpost-->
		</div><!--end classpost-->
		<div class="clear_both"></div>
		<?php endforeach; ?>
	</div><!--end content post -->
	
	<?php include 'application/views/includes/sidebar.php'; ?>
	
	<div id="logout_window" title="Er du sikker på at du vil logge ut?" style="display:none;">
			<button type="button" id="logout_submit" name="logout">Ja</button>
			<button type="button" id="logout_cancel" name="logout">Avbryt</button>	       
	</div>
	
	<div id="lightbox" style="display:none;">
			
	</div><!-- end of lightbox -->
	
	<div id="new_post_panel" style="display:none;"> 
		<h3>Skriv et nytt innlegg</h3>
		<label for="title_label">Tittel: </label> <br />
		<input type="text" id="post_title" name="post_title" value=""  /> <br /><br />
		<label for="hash_tags">Hashtags:</label><br />
		<input type="text" id="hash_tags" name="hash_tags" value="" /> <br /> <br />
		<label for="in_text_label">Innlegg:</label> <br />
		<textarea id="in_text"></textarea>
		<br /><br />
		<button id="save_post_btn">Lagre</button>
		<button id="close_btn">Lukk</button>
	</div>
	
	<div id="user_panel" style="display:none;">
		<div id="profile_picture">
			<?php if(empty($user_image)) : ?>
				<img src="<?php echo base_url()?>/images/profile.jpg" alt="profile_picrure" />	
			<?php else : ?>
			
			<?php endif; ?>
		</div>
		
		
	</div><!-- End user_panel-->
	
	<div class="panel_frame">
		<div class="post_user_panel">
			<div id="post_profile_picture">
				<?php if(empty($user_image)) : ?>
					<img src="<?php echo base_url()?>/images/profile.jpg" alt="profile_picrure" />	
				<?php else : ?>
				
				<?php endif; ?>
			</div>
			<div class="user_credentials">
				
			</div><!--end user_credentials-->
			<div class="post_profile_buttons">
				
			</div>
		</div><!--end post user-->
	</div><!--end panel frame-->
	
	
	<div id="login_window" title="Logg inn her" style="display:none;">
        <form method="post" action="#" id="login_credentials">
            <input name="uname" type="text" value="Brukernavn" id="uname" />
            <input name="pwd" type="password" value="" id="pwd" />
            <button type="button" id="login_submit" name="Login">Logg inn</button>
         </form>              
    </div>
	
	<div class="statistics_panel" style="display:none">
		<div id="statistics_high_chart_target">
			
		</div>
		<div class="feedback_buttons">
			<button class="close_statistics_btn">Lukk</button>
		</div>
	</div>
</div>
