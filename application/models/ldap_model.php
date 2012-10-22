<?php
class Ldap_model extends CI_Model {
	private $username;
	private $password;
	private $result;
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
}