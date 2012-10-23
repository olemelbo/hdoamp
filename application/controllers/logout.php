<?php
class Logout extends CI_Controller {
	function index() { }
	
	function log_user_out() {
		$this->session->sess_destroy();
	}
}