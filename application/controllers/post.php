<?php
class Post extends CI_Controller {

function index() {
	$data['main_content'] = "new_post";
	$this->load->view('includes/template', $data);
	}

}
?>