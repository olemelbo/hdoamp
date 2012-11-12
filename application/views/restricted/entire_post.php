<div id="wrap">
	<div id="header">
		<div id="logo">
			<h1><a href="<?php echo site_url(); ?>">HiG<span style="font-weight: normal;"> Debatt</span></a></h1>
		</div><!-- #logo -->
		<div id='logout'><h3><a href='#'>Logg ut</a></h3></div>
		<div id='user_profile'><h3><a href='#'> <?php echo $user_fullname; ?> | </a></h3></div>
	</div><!-- end header-->	
	
	<div id="lightbox" style="display:none;">
			
	</div><!-- end of lightbox -->
	
	<div id="slogan">
			<p>Husk å være snill og grei, ellers blir det ingen debatt på deg!</p>
	</div><!-- #slogan -->
	
	<div id="content_post">
		<div id="post">
			<div id="post_id" style="display:none"><?php echo $entire_post['id']; ?></div>
			<div id="post_author">
				<?php if(empty($entire_post['image_link'])) : ?>
						<div id="post_picture"><a href="#"><img src="<?php echo base_url()?>/images/profile.jpg" alt="profile_picure" id="<?php echo $entire_post['user_id']; ?>" /></a></div>	
				<?php else : ?>
					
				<?php endif; ?>
			<div id="post_content">
				<h2><?php echo $entire_post["tittel"]; ?></h2>
				<p><?php echo $entire_post["in_text"]; ?></p>
			</div><!--end post_content-->
		</div><!-- end post_author-->
		<div class="entire_post_bar">
			<input type="image" src="<?php echo base_url(); ?>images/feedback_icon.png" class="post_feedback_button" id="<?php echo $entire_post['id']; ?>" />
			<p>Gi feedback</p>
			<input type="image" src="<?php echo base_url(); ?>images/graph_icon.png" class="post_statistic_button" id="<?php echo $entire_post['id']; ?>" />
			<p>Se statistikk</p>
		</div>
		
		</div><!--post-->
		<?php if(isset($comments)) : ?>
		<?php foreach($comments as $comment) : ?>
		<div class="post_comment">
			<div id="comment_<?php echo $comment['id']; ?>">
				<div id="comment_author">
					<?php if(empty($entire_post['image_link'])) : ?>
						<div id="comment_picture"><a href="#"><img src="<?php echo base_url()?>images/profile.jpg" alt="profile_picure" id="<?php echo $comment['user_id']; ?>" /></a></div>	
					<?php else : ?>
	
					<?php endif; ?>
				</div>
				<h2><?php echo $comment['full_name']; ?></h2>
				<div id="comment_content">
					<p><?php echo $comment['comment_text']; ?></p>
					<p><?php echo $comment['date']; ?></p>
				</div>
				<div class="comment_bar">
					<div class="comment_feedback">
							<input type="image" src="<?php echo base_url(); ?>images/feedback_icon.png" alt="Submit" width="35" height="35" class="comment_feedback_button" />
							<p>Gi feedback</p>
						</div>
						<div class="comment_statistic">
							<input type="image" src="<?php echo base_url(); ?>images/graph_icon.png" alt="Submit" width="35" height="35" class="comment_statistic_button" id="<?php echo $comment['id']; ?>" />
							<p>Se statistikk</p>
						</div>
				</div>
			</div>
		</div>
		<div class="clear_both"></div>
		<?php endforeach; ?>
		<div class="new_comment">
			<h2>Skriv ny kommentar</h2>
			<textarea id="comment_text"></textarea>
			<br /><br />
			<button id="save_comment_btn">Lagre</button>
		</div>
		<?php else : ?>
			<div class="new_comment">
			<h2>Skriv ny kommentar</h2>
			<label for="comment_text_label">Innlegg:</label> <br />
			<textarea id="comment_text"></textarea>
			<br /><br />
			<button id="save_comment_btn">Lagre</button>
		</div>
		<?php endif; ?>
		
		
	</div><!--end content_post-->
	
	<div id="sidebar">
		<p>Masse artig innhold</p>
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
					<?php foreach($user_posts as $key => $value) : ?>
						<li><a href="<?php echo site_url()?>/entire_post/loadEntirePost/<?php echo $key?>""><?php echo $value; ?></a></li>
					<?php endforeach; ?>
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
			<label for="unserious">Useriøst:</label>
			<input type="checkbox" name="unserious" />
		</form>
		<div class="feedback_buttons">
			<button class="save_feedback_btn">Lagre</button>
			<button class="close_feedback_btn">Lukk</button>
		</div>
	</div>
	
	<div class="statistics_panel" style="display:none">
		<div id="statistics_high_chart_target">
			
		</div>
		<div class="feedback_buttons">
			<button class="close_statistics_btn">Lukk</button>
		</div>
	</div>
	</div>
</div>