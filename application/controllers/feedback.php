<?php
class Feedback extends CI_Controller {
	function index() {
		
	}
	
	function validate_feedback() {
		$this->load->model('feedback_model');
		$this->feedback_model->validateFeedback($_POST['post_id'], $_POST['agree'], $_POST['disagree'], $_POST['relevant'], $_POST['informative'], $_POST['well_written'], $_POST['unserious']);
	}
	
	function validate_comment_feedback() 
	{
		$this->load->model('feedback_comment_model');
		$this->feedback_comment_model->validateCommentFeedback($_POST['comment_id'], $_POST['agree'], $_POST['disagree'], $_POST['relevant'], $_POST['informative'], $_POST['well_written'], $_POST['unserious']);
	}
}