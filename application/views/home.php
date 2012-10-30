<div id="wrap">
	<div id="header">
		<div id="logo"><h1><a href="<?php echo site_url(); ?>">HiG<span style="font-weight: normal;"> Debatt</span></a></h1>
		</div><!-- #logo -->
	<div id='login'><h3><a href='#'>Logg inn</a></h3></div>
	</div><!-- end header-->	
	
		<div id="slogan">
			<p>Husk å være snill og grei, ellers blir det ingen debatt på deg!</p>
		</div><!-- #slogan -->
	</div>

	<div id="content_post">
		<div id="content_post">
		<?php foreach($posts as $post) : ?>
		<div class="post">
			<div id="post_<?php echo $post['id']; ?>">
				<?php if(empty($user_image)) : ?>
					<img src="<?php echo base_url()?>/images/profile.jpg" alt="profile_picure" />	
				<?php else : ?>
				
				<?php endif; ?>
				<h3><?php  echo $post['tittel'] ?></h3>
				<?php if(!empty($post['hashtags'])) : ?>
					<p class="hashtags"><?php foreach($post['hashtags'] as $p) { echo "#".$p . " "; } ?> </p>
				<?php endif; ?>
			</div><!--end divpost-->
		</div><!--end classpost-->
		<div class="clear_both"></div>
		<?php endforeach; ?>
	</div><!--End content post -->
		
	</div><!--End content post -->
	<div id="sidebar">
		<h3>Månedens debattant</h3>
		<p>1. Pernille Hellesvik</p>
		<p>2. Ole Christian Melbostad</p>
	</div>
	
	<div id="login_window" title="Logg inn her" style="display:none;">
		<form method="post" action="#" id="login_credentials">
			<input name="uname" type="text" value="Brukernavn" id="uname" />
		    <input name="pwd" type="password" value="" id="pwd" />
		    <button type="button" id="login_submit" name="Login">Logg inn</button>
		 </form>		       
	</div>
		
	</div>
</div>
