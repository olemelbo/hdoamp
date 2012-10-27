<div id="wrap">
	<div id="header">
		<div id="logo"><h1><a href="<?php echo site_url(); ?>">HiG<span style="font-weight: normal;"> Debatt</span></a></h1>
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
			<div id="post_author">
				<?php echo $entire_post['user_id']; ?>
				<?php if(empty($entire_post['image_link'])) : ?>
						<div id="post_picture"><a href="#"><img src="<?php echo base_url()?>/images/profile.jpg" alt="profile_picure" id="<?php echo $entire_post['user_id']; ?>" /></a></div>	
				<?php else : ?>
					
				<?php endif; ?>
			<div id="post_content">
				<h2><?php echo $entire_post["tittel"]; ?></h2>
				<p><?php echo $entire_post["in_text"]; ?></p>
			</div>
		</div>
		
	</div>
	
	<div id="sidebar">
		<p>Masse artig innhold</p>
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
						<li><a href="<?php echo site_url()?>/entire_post/loadEntirePost/<?php echo $key?>""><?php echo $value; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<div id="profile_buttons">
			
			<button id="save_userprofile_btn">Lagre</button>
			<button id="close_userprofile_btn">Lukk</button>
		</div>
		
	</div>
</div>