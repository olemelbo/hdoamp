<div id="wrap">
	<div id="header">
		<div class="logo"><h1>HiG Debatt</h1></div>
		<?php
			$session = $this->session->userdata('uid');
			if($session == true) {
				$this->db->select('fnavn,enavn');
				$this->db->from('bruker');
				$this->db->where('studnr', $session);
				$query = $this->db->get();
				
				foreach ($query->result_array() as $row) { $fnavn = $row['fnavn']; }
				foreach ($query->result_array() as $row) { $enavn = $row['enavn']; }
				
				echo "<div id='user_profile'><h3>" . $fnavn . " " . $enavn ."</h3></div>";
				
				echo "<div id='logout'><h3>Logg ut</h3></div>";
			} else {
				echo "<div id='login'><h3>Logg inn</h3></div>";
			}
		?>
		
		<p class="slogan">Husk å være snill og grei, ellers blir det ingen debatt på deg!</p>
	</div><!-- end header-->

	<div id="content">
		<p>Mange fine innlegg</p>
	</div>
	<div id="sidebar">
		<p>Masse artig innhold</p>
	</div>
	
	<div id="login_window" title="Logg inn her" style="display:none;">
		<form method="post" action="#" id="login_credentials">
			<input name="uname" type="text" value="Brukernavn" id="uname" />
		    <input name="pwd" type="password" value="Passord" id="pwd" />
		     <button type="button" id="login_submit" name="Login">Logg inn</button>
		 </form>		       
	</div>
		
	<div id="logout_window" title="Er du sikker på at du vil logge ut?" style="display:none;">
			<button type="button" id="logout_submit" name="logout">Ja</button>
			<button type="button" id="logout_cancel" name="logout">Avbryt</button>	       
	</div>
</div>
