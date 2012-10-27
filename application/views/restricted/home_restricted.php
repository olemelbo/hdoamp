<div id="wrap">
	<div id="header">
		<div id="logo"><h1><a href="<?php echo site_url(); ?>">HiG<span style="font-weight: normal;"> Debatt</span></a></h1>
		</div><!-- #logo -->
		<div id='logout'><h3><a href='#'>Logg ut</a></h3></div>
		<div id='user_profile'><h3><a href='#'> <?php echo $user_fullname; ?> | </a></h3></div>
	</div><!-- end header-->	
	<div id="pen-wrapper">
		<div id="pen-icon">
		</div>
		<div id="slogan">
			<p>Husk å være snill og grei, ellers blir det ingen debatt på deg!</p>
		</div><!-- #slogan -->
	</div>

	<div id="content_post">
		<?php foreach($posts as $post) : ?>
		<div class="post">
			<div id="post_<?php echo $post['id']; ?>">
				<?php if(empty($user_image)) : ?>
					<div id="post_picture"><a href='post_<?php echo $post['id']; ?>'><img src="<?php echo base_url()?>/images/profile.jpg" alt="profile_picure" /></a></div>	
				<?php else : ?>
				
				<?php endif; ?>
				<h2><a href="post_<?php echo $post['id']; ?>"><?php  echo $post['tittel'] ?></a></h2>
				
				<?php if(!empty($post['hashtags'])) : ?>
					<p class="hashtags"><?php foreach($post['hashtags'] as $p) { echo "<a href='#'>#".$p . " " . "</a>"; } ?> </p>
				<?php endif; ?>
				
				<p class="post_truncated"><?php echo $truncated = substr($post['in_text'], 0, 300) . '...' ?></p>
				<div class="post_bar">
					<button type="button" class="post_reports">Rapporter</button>
					<button type="button" class="post_feedback" id="<?php echo $post['id']; ?>">Feedback</button>
					<button type="button" class="post_statistic" id="<?php echo $post['id']; ?>">Statestikk</button>
					<button type="button" class="post_newcomment">Skriv kommentar</button>
					<button type="button" class="post_morecomments">Se kommentarer</button>
				</div>
			</div><!--end divpost-->
		</div><!--end classpost-->
		<div class="clear_both"></div>
		<?php endforeach; ?>
	</div><!--End content post -->
	<div id="sidebar">
		<p>Masse artig innhold</p>
	</div>
	
	<div id="logout_window" title="Er du sikker på at du vil logge ut?" style="display:none;">
			<button type="button" id="logout_submit" name="logout">Ja</button>
			<button type="button" id="logout_cancel" name="logout">Avbryt</button>	       
	</div>
	
	<div id="lightbox" style="display:none;">
			
	</div><!-- end of lightbox -->
	
	<div id="panel" style="display:none;"> 
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
						<li><a href="post_<?php echo $key ?>"><?php echo $value; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<div id="profile_buttons">
			
			<button id="save_userprofile_btn">Lagre</button>
			<button id="close_userprofile_btn">Lukk</button>
		</div>
		
	</div>
	
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