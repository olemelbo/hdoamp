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
			$user_query = $this->user_model->getUserPosts();
			
			foreach ($user_query->result_array() as $upost) {
				$data['user_posts'][$upost["id"]] = $upost['id'];
				$data['user_posts'][$upost["id"]] = $upost["tittel"];
			}	
			
			//Posts
			$this->load->model('post_model');
			$query = $this->post_model->getAllPosts();
			foreach ($query->result_array() as $post) {
				$data["posts"][$post['id']]['id'] = $post['id']; 
				$data["posts"][$post['id']]['tittel'] = $post['tittel']; 
				$data["posts"][$post['id']]['in_text'] = $post['in_text'];
				$data["posts"][$post['id']]['user_id'] = $post['user_id'];
				$data["posts"][$post['id']]['date'] = $post['date'];
				if(!empty($post['hashtag'])) {
					$data["posts"][$post['id']]['hashtags'][] = $post['hashtag'];
				}
			}
			//Content
			
			$data["main_content"] = "restricted/home_restricted";
			$this->load->view("includes/template", $data);
		} else {
			$data["main_content"] = "home";
			$this->load->model('post_model');
			$query = $this->post_model->getAllPosts();
			foreach ($query->result_array() as $post) {
				$data["posts"][$post['id']]['id'] = $post['id']; 
				$data["posts"][$post['id']]['tittel'] = $post['tittel']; 
				$data["posts"][$post['id']]['in_text'] = $post['in_text'];
				$data["posts"][$post['id']]['user_id'] = $post['user_id'];
				$data["posts"][$post['id']]['date'] = $post['date'];
				if(!empty($post['hashtag'])) {
					$data["posts"][$post['id']]['hashtags'][] = $post['hashtag'];
				}
			}
			
			$this->load->view("includes/template", $data);
		}
	}

}