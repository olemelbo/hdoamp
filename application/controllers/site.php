<?php
class Site extends CI_Controller {
	function index() {
		$this->load->view("home");
	}

}