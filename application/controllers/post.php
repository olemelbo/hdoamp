<?php
class Post extends CI_Controller {

	function index() {
		$data['main_content'] = "new_post";
		$this->load->view('includes/template', $data);
	}

	function validate_post() {
		$this->load->model('post_model');
		$this->post_model->setNewPost($_POST['title'], $_POST['in_text']);
	}		
}
?>