<div id="wrap">
	<div id="header">
		<div id="logo">
			<h1><a href="<?php echo site_url(); ?>">HiG<span style="font-weight: normal;"> Debatt</span></a></h1>
		</div><!-- #logo -->
		<div id='login'><h3><a href='#'>Logg inn</a></h3></div>
		<div id="about"><h3><a href="#">Om HIG Debatt | </a></h3></div>
		<div id="search">
			<form class="form-wrapper">
			        <input type="text" id="search" placeholder="S&oslash;k i HiG Debatt.." required>
			</form>
		</div>
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
			</div><!-- end post_author-->
			
			<div id="post_content">
				<h2><?php echo $entire_post["tittel"]; ?></h2>
				<p><?php echo $entire_post["in_text"]; ?></p>
			</div><!--end post_content-->
		
		<div class="entire_post_bar">
			
			<div class="post_statistic">
				<input type="image" src="<?php echo base_url(); ?>images/graph_icon.png"  width="35" height="35" class="post_statistic_button" id="<?php echo $entire_post['id']; ?>" />
				<p>Se statistikk</p>
			</div>
		</div>
		
		</div><!--post-->
	
		<?php if(isset($comments)) : ?>
		<?php foreach($comments as $comment) : ?>
		<div class="post_comment">
			<?php if(isset($comment['author'])) : ?>
			<div class="delete_comment">
				<input type="image" src="<?php echo base_url(); ?>images/delete_icon.png" alt="Delete comment" class="delete_comment_button" id="<?php echo $comment['id']; ?>" />
				</div>
			<?php endif; ?>
			<div id="comment_<?php echo $comment['id']; ?>">
				<div id="comment_author">
					<?php if(empty($entire_post['image_link'])) : ?>
						<div id="post_picture"><a href="#"><img src="<?php echo base_url()?>images/profile.jpg" alt="profile_picure" id="<?php echo $comment['user_id']; ?>" /></a></div>	
					<?php else : ?>
	
					<?php endif; ?>
				</div>
				<h2><?php echo $comment['full_name']; ?></h2>
				<div id="comment_content">
					<h3><?php echo $comment['date']; ?></h3>
					<p><?php echo $comment['comment_text']; ?></p>
				</div>
				<div class="comment_bar">
					<div class="comment_statistic">
						<input type="image" src="<?php echo base_url(); ?>images/graph_icon.png" alt="Submit" width="35" height="35" class="comment_statistic_button" id="<?php echo $comment['id']; ?>" />
						<p>Se statistikk</p>
					</div><!--end comment_statistic-->
					
				</div><!--end comment_bar-->
			</div>
		</div>
		<div class="clear_both"></div>
			<?php endforeach; ?>
		<?php endif; ?>
		
	</div><!--end content_post-->
	
	<?php include 'application/views/includes/sidebar_2.php'; ?>
	
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
	
	
	
	<div id="login_window" title="Logg inn her" style="display:none;">
        <form method="post" action="#" id="login_credentials">
            <input name="uname" type="text" value="Brukernavn" id="uname" />
            <input name="pwd" type="password" value="" id="pwd" />
            <button type="button" id="login_submit" name="Login">Logg inn</button>
         </form>              
    </div>
    
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
</div>
