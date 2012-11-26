<div id="wrap">
	<div id="header">
		<div id="logo"><h1><a href="<?php echo site_url(); ?>">HiG<span style="font-weight: normal;"> Debatt</span></a></h1>
		</div><!-- #logo -->
		<div id='logout'><h3><a href='#'>Logg ut</a></h3></div>
		<div id='user_profile'><h3><a href='#'> <?php echo $user_fullname; ?> | </a></h3></div>
		<div id="about"><h3><a href="#">Om HIG Debatt | </a></h3></div>
		<div id="search">
			<form class="form-wrapper">
			        <input type="text" id="search" placeholder="S&oslash;k i HiG Debatt.." required>
			</form>
		</div>
	</div><!-- end header-->	
	<div id="pen-wrapper">
		
		<div id="slogan">
			<p>Husk &aring; v&aelig;re snill og grei, ellers blir det ingen debatt p&aring; deg!</p>
		</div>
		<div id="nav">
			<h3>SISTE</h3>
			<h3>POPUL&AElig;RE</h3>
			<h3>ARKIV</h3>
		</div>
	</div><!-- #pen-wrapper -->

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
					<p class="date"><?php echo $post['date']; ?></p>
				<?php endif; ?>
				
				<?php if(!empty($post['hashtags'])) : ?>
					<p class="hashtags"><?php foreach($post['hashtags'] as $p) { echo "<a href='#'>#".$p . " " . "</a>"; } ?> </p>
				<?php endif; ?>
				
				
				
				<p class="post_truncated"><?php echo $truncated = substr($post['in_text'], 0, 250) . '...' ?></p>
				<div class="post_bar">
					<div class="post_alternatives">
						<div class="post_feedback">
							<input type="image" src="<?php echo base_url(); ?>images/feedback_icon.png" alt="Submit" width="35" height="35" class="post_feedback_button" id="<?php echo $post['id']; ?>"></button>
							<p>Gi feedback</p>
						</div>
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
		</div><!--end profile_picture-->
		
		<div id="user_credentials">
			<h3><?php echo $user_fullname; ?></h3>
			<p><?php echo $user_department; ?></p>
			<p>Sist innlogget: <?php echo $user_last_logged_in; ?></p>
			<p>Poengsum: <?php if(!empty($user_score)) { echo $user_score; } else { echo "0"; } ?></p>
			<form method="post" action="#" id="login_credentials">
				<label for="email">Epost: </label> 
				<input type="email" id="user_email" name="user_email" value="<?php echo $user_email; ?>" /> 
			</form>
			<div id="user_last_posts">
				<p>Dine siste innlegg:</p>
				<ul>
				<?php if (isset($user_posts)) : ?>
					<?php foreach($user_posts as $key => $value) : ?>
						<li><a href="<?php echo site_url()?>/entire_post/loadEntirePost/<?php echo $key?>"><?php echo $value; ?></a></li>
					<?php endforeach; ?>
				<?php else : ?>
					<p>Du har ikke skrevet noen innlegg.</p>
				<?php endif; ?>	
				</ul>
			</div><!-- end user_last_posts-->
		</div><!--end user_credentials-->
		<div id="profile_buttons">
			<button id="save_userprofile_btn">Lagre</button>
			<button id="close_userprofile_btn">Lukk</button>
		</div><!--end profile_buttons-->
	</div><!--div end user_panel-->	
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
	
	
	
	<div class="feedback_panel" style="display:none;">
		<h1>Gi din feedback til innlegget</h1>
		<form method="post" action="#" id="post_feedback">
			<label for="agree">Enig:</label>
			<input type="checkbox" name="agree" />
			<label for="relevant">Relevant:</label>
			<input type="checkbox" name="relevant" />
			<label for="informative">Informativt:</label>
			<input type="checkbox" name="informative" />
			<label for="well_written">Godt skrevet:</label>
			<input type="checkbox"name="well_written" />
			<label for="disagree">Uenig:</label>
			<input type="checkbox" name="disagree" />
			<label for="unserious">Useri&oslash;st:</label>
			<input type="checkbox" name="unserious" />
		</form>
		<div class="feedback_buttons">
			<button class="save_feedback_btn">Lagre</button>
			<button class="close_feedback_btn">Lukk</button>
		</div>
	</div>
	
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
	
	<div class="about_panel" style="display:none">
		<?php include 'application/views/about.php'; ?>
	</div>

	
	<div class="statistics_panel" style="display:none">
		<div id="statistics_high_chart_target">
			
		</div>
		<div class="feedback_buttons">
			<button class="close_statistics_btn">Lukk</button>
		</div>
	</div>
</div>
