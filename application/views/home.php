<div id="wrap">
	<div id="header">
		<div id="logo"><h1><a href="<?php echo site_url(); ?>">HiG<span style="font-weight: normal;"> Debatt</span></a></h1>
		</div><!-- #logo -->
		<?php
			$session = $this->session->userdata('uid');
			if($session == true) {
				$this->db->select('*');
				$this->db->from('bruker');
				$this->db->where('studnr', $session);
				$query = $this->db->get();
				
				foreach ($query->result_array() as $row) { $id = $row['id']; }
				foreach ($query->result_array() as $row) { $studnr = $row['studnr']; }
				foreach ($query->result_array() as $row) { $fnavn = $row['fnavn']; }
				foreach ($query->result_array() as $row) { $enavn = $row['enavn']; }
				foreach ($query->result_array() as $row) { $email = $row['email']; }
				foreach ($query->result_array() as $row) { $image_link = $row['image_link']; }
				foreach ($query->result_array() as $row) { $department = $row['department']; }
				foreach ($query->result_array() as $row) { $last_used = $row['sist_innlogget']; }
				
				
				echo "<div id='logout'><h3><a href='#'>Logg ut</a></h3></div>";
				echo "<div id='user_profile'><h3><a href='#'>" . $fnavn . " " . $enavn . " | " ."</a></h3></div>";
				
			} else {
				echo "<div id='login'><h3><a href='#'>Logg inn</a></h3></div>";
			}
		?>

	</div><!-- end header-->	
	
	<div id="pen-wrapper">
		<div id="pen-icon">
		</div>
		<div id="slogan">
			<p>Husk å være snill og grei, ellers blir det ingen debatt på deg!</p>
		</div><!-- #slogan -->
	</div>

	<div id="content_post">
		<?php 
			$this->db->select("*");
			$this->db->from('innlegg');
			$this->db->order_by("id", "desc");
			$query = $this->db->get();
			
		?>	
		<?php foreach ($query->result_array() as $post) : ?>
				<div class="post_<?php echo $post['id']; ?>">
					<h3><?php echo $post['tittel'] ?></h3>
					<p><?php echo $post['in_text'] ?></p>
				</div>
		<?php endforeach; ?>
	</div><!--End content -->
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
		<label for="in_text_label">Innlegg:</label> <br />
		<textarea id="in_text"></textarea>
		<br />
		<button id="save_post_btn">Lagre</button>
		<button id="close_btn">Lukk</button>
	</div>
	
	<div id="user_panel" style="display:none;">
		<div id="profile_picture">
			<?php if(empty($image_link)) : ?>
				<img src="<?php echo base_url()?>/images/profile.jpg" alt="profile_picrure" />	
			<?php else : ?>
			
			<?php endif; ?>
		</div>
		<div id="user_credentials">
			<h3><?php echo $fnavn . " " . $enavn; ?></h3>
			<p><?php echo $department; ?></p>
			<form method="post" action="#" id="login_credentials">
				<label for="email">Epost: </label> <br />
				<input type="text" id="user_email" name="user_email" value="<?php echo $email; ?>" /> <br /><br />
				<label for="upload_profile_picture">Last opp et nytt profilbilde: </label> <br />
				<input type="file" name="upload_profile_picture" id="upload_profile_picture" />
			</form>
		</div>
		<div id="profile_buttons">
			
			<button id="save_userprofile_btn">Lagre</button>
			<button id="close_userprofile_btn">Lukk</button>
		</div>
	</div>
</div>
