﻿<?php
class Post extends CI_Controller {

	function index() {
		$data['main_content'] = "new_post";
		$this->load->view('includes/template', $data);
	}

	function validate_post() {
		$this->load->model('post_model');
		if(!$this->session->userdata('uid') == TRUE) {
			$response['response'] = "error";
			$response['error'] = "Du må være innlogget for å skrive et innlegg";
			echo json_encode($response);
			die();
			return false;
		}
		$this->post_model->setNewPost($_POST['title'], $_POST['in_text']);
	}		
}
?>