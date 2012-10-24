<?php
class Profile_model extends CI_Model {
	function validate($email) {
		$email = checkEmail($email);
		if(!$email == FALSE) {
			
		}
		
	}
	
	function checkEmail( $email ){
    	return filter_var( $email, FILTER_VALIDATE_EMAIL );
	}
	
}
