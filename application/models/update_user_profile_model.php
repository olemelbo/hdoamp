<?php
class Update_user_profile_model extends CI_Model {
	function setUserEmail($user_id, $email) {
		$email = $this->checkEmail($email);
		if(!$email == FALSE) {
			$sql = "UPDATE bruker SET email =? WHERE id =?";
			$this->db->query($sql, array($email, $user_id));
			$errtxt = $this->db->_error_message();
		
			if (!empty ($errtxt) ) {
				$response['response'] = "error";
				$response['error'] = $errtxt;
			} else {
				$response['response'] = "ok";
				$response['message'] = "Profilen ble velykket oppdatert!";
			}	
			
		echo json_encode($response);
		
		} else {
			$response['response'] = "error";
			$response['error'] = "Du må skrive inn en gyldig epost addresse";
			echo json_encode($response);
			return false;
		}
	}
	
	function checkEmail( $email ){
    	return filter_var( $email, FILTER_VALIDATE_EMAIL );
	}
}