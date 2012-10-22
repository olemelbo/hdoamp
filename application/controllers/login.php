<?php
class Login extends CI_Controller {
	function index() {
		$data["main_content"] = "login_form";
		$this->load->view("includes/template", $data);
	}
	
	function validate_credentials() { 
		$this->load->model('ladap_model');
		$this->ldap_model->validate($this->input->post('user_id'),$this->input->post('pwd'));
		$result = $this->ldap_model->validate();
		print_r($result);
		$uid = substr ($result, 11, strpos ($result, '"', 12)-11);
	}
}