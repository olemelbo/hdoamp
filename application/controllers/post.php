<?php
class Post extends CI_Controller {

function index() {
	$data['main_content'] = "new_post";
	$this->load->view('includes/template', $data);
	}

function validate_post() {
	$this->load->model('post_model');
	$result = $this->post_model->setNewPost();
	
	echo $result;
}	
	
}
?>