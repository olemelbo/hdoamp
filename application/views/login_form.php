<div id="login_form">
	<h1>Login, Fool!</h1>
	<?php 
		echo form_open('login/validate_credentials');
		//Name then value
		echo form_input('uname', 'Username');
		echo form_password('pwd', 'Password');
		echo form_submit('submit','Login');
	?>
</div>