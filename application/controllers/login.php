<?php
class Login extends CI_Controller {
	function index() {
		
	}
	
	function validate_credentials() { 
		$this->load->model('ldap_model');
		$this->ldap_model->validate($_POST["uname"], $_POST["pwd"]);
	}
}