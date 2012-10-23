<div id="wrap">
	<div id="header">
		<div id="logo"><h1><a href="<?php echo site_url(); ?>">HiG<span style="font-weight: normal;"> Debatt</span></a></h1>
		</div><!-- #logo -->
		<?php
			$session = $this->session->userdata('uid');
			if($session == true) {
				$this->db->select('fnavn,enavn');
				$this->db->from('bruker');
				$this->db->where('studnr', $session);
				$query = $this->db->get();
				
				foreach ($query->result_array() as $row) { $fnavn = $row['fnavn']; }
				foreach ($query->result_array() as $row) { $enavn = $row['enavn']; }
				
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
	

	<div id="content">
		<p>Mange fine innlegg</p>
	</div>
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
</div>
