<?php
class Profile extends CI_Controller {
	function index() {
		
	}
	
	function validate_credentials() { 
		$this->load->model('profile_model');
		$this->ldap_model->validate($_POST["email"]);
	}
}
