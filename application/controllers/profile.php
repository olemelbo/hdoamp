<?php
class Profile extends CI_Controller {
	function index() {
		
	}
	
	function validate_credentials() { 
		$this->load->model('update_user_profile_model');
		$this->load->model('user_model');
		$this->user_model->instantiateUserInfo($this->session->userdata('uid'));
		$user_id = $this->user_model->getUserId();
		$this->update_user_profile_model->setUserEmail($user_id, $_POST["email"]);
	}
}
