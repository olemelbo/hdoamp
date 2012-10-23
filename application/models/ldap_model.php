<?php
class Ldap_model extends CI_Model {
	private $username;
	private $password;
	function validate($_POST) {
		$username = $_POST["uname"];
		$password = $_POST["pwd"];
		// If no username/password is set this can never work
		if ((!isset ($username)||(!isset ($password)))) {
			echo "Brukernavn/passord er skrevet ikke skrevet inn";
			die();	 
		}
		
		// Send a POST request with the username and password.
		// See http://wezfurlong.org/blog/2006/nov/http-post-from-php-without-curl/
		// for details about the do_post_reqest
		$result = trim ($this->do_post_request ('http://tvil.hig.no/json_services/checkUserLogin.php',  http_build_query($_POST)));
		
		if (strpos ($result, 'uid":"')>0) {
			// Get the user id from the json string
			$uid = substr ($result, 11, strpos ($result, '"', 12)-11);
			//Add user id to session
			$_SESSION['uid'] = $uid;
			
			$this->saveUser($uid);
			
			$response['response'] = "ok";
			$response['msg'] = "Brukeren ble velykket logget inn";
		} else {
			$response['response'] = "error";
			$response['error'] = "Feil brukernavn eller passord";
		}
		
		echo json_encode($response);
	}
	
	/**
	 * From : http://wezfurlong.org/blog/2006/nov/http-post-from-php-without-curl/
	 */
	function do_post_request($url, $data, $optional_headers = null) {
		$params = array('http' => array('method' => 'POST',
				'content' => $data
		)
		);
		if ($optional_headers!== null) {
			$params['http']['header'] = $optional_headers;
		}
		$ctx = stream_context_create($params);
		$fp = @fopen($url, 'rb', false, $ctx);
		if (!$fp) {
			throw new Exception("Problem with $url, $php_errormsg");
		}
		$response = @stream_get_contents($fp);
		if ($response === false) {
			throw new Exception("Problem reading data from $url, $php_errormsg");
		}
		return $response;
	}
	
	function saveUser($uid) {
		$sql = "SELECT studnr FROM bruker WHERE studnr = ?";
		$result = $this->db->query($sql, $uid); 
		print_r($result);
		$result->num_rows() > 0 ? $this->updateUser($uid) : $this->addUser($uid);
	}
	
	function addUser($uid) {
		$current_time = Date("Y-m-d H:i:s");
		$sql = "INSERT INTO bruker (studnr, sist_innlogget) VALUES (?, ?)";
		$this->db->query($sql, array($uid, $current_time));
	}
	
	function updateUser($uid) {
		$current_time = Date("Y-m-d H:i:s");
		$sql = "UPDATE bruker SET sist_innlogget = ? WHERE studnr= ?";
		$this->db->query($sql, array($current_time, $uid));
	}
}