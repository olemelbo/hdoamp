<?php
class Post extends CI_Controller {

	function index() {
		$data['main_content'] = "new_post";
		$this->load->view('includes/template', $data);
	}

	function validate_post() {
		$this->load->model('post_model');
		$session = $this->session->userdata('uid');
		if(!$session) {
			$response['response'] = "error";
			$response['error'] = "Du må være innlogget for å skrive et innlegg";
			echo json_encode($response);
			die();
			return false;
		}
		$this->post_model->setNewPost($_POST['title'], $_POST['hash_tags'], $_POST['in_text']);
	}		
}
?>