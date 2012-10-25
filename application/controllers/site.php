<?php
class Site extends CI_Controller {
	function index() {
		if($session = $this->session->userdata('uid')) {
			//User Info
			$this->load->model('user_model');
			$this->user_model->instantiate($session);
			$data['user_id'] = $this->user_model->getUserId();
			$data['user_studnr'] = $this->user_model->getUserStudnr();
			$data['user_fname'] = $this->user_model->getUserFirstName();
			$data['user_ename'] = $this->user_model->getUserLastName();
			$data['user_fullname'] = $this->user_model->getUserFullName();
			$data['user_email'] = $this->user_model->getUserEmail();
			$data['user_image'] = $this->user_model->getUserImage();
			$data['user_department'] = $this->user_model->getUserDepartment();
			$data['user_last_logged_in'] = $this->user_model->getLastUsed();
			$data['user_score'] = $this->user_model->getUserScore();
			//Posts
			$this->load->model('post_model');
			$data["posts"] = $this->post_model->getAllPosts();
			//Content
			$data["main_content"] = "restricted/home_restricted";
			$this->load->view("includes/template", $data);
		} else {
			$data["main_content"] = "home";
			$this->load->model('post_model');
			$data["posts"] = $this->post_model->getAllPosts();
			$this->load->view("includes/template", $data);	
		}
	}

}