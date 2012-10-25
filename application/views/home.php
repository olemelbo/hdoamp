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
		<?php foreach ($posts->result_array() as $post) : ?>
				<div class="post_<?php echo $post['id']; ?>">
					<h3><?php echo $post['tittel'] ?></h3>
					<p><?php echo $post['in_text'] ?></p>
				</div>
		<?php endforeach; ?>
		
	</div><!--End content post -->
	<div id="sidebar">
		<p>Masse artig innhold</p>
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
