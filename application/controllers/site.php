<?php
class Site extends CI_Controller {
	function index() {
		$session = $this->session->userdata('uid'); //Settes til $true istedet for $this hvis innlogging ikke funker
		if($session) {
			//User Info
			$this->load->model('user_model');
			$this->user_model->instantiateUserInfo($session);
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
			
			//Points
			$this->load->model('user_ranking_model');
			$ranking_query = $this->user_ranking_model->getRanking();
			
			foreach($ranking_query->result_array() as $points) {
				$data['ranking'][$points['id']]['fname'] = $points['fnavn'];
				$data['ranking'][$points['id']]['ename'] = $points['enavn'];
				$data['ranking'][$points['id']]['points'] = $points['antall_poeng'];
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
				$data["posts"][$post['id']]['numberOfComments'] = $this->post_model->countComments($post['id']);
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
				$data["posts"][$post['id']]['numberOfComments'] = $this->post_model->countComments($post['id']);
				if(!empty($post['hashtag'])) {
					$data["posts"][$post['id']]['hashtags'][] = $post['hashtag'];
				}
			}
			
			//Points
			$this->load->model('user_ranking_model');
			$ranking_query = $this->user_ranking_model->getRanking();
			
			foreach($ranking_query->result_array() as $points) {
				$data['ranking'][$points['id']]['fname'] = $points['fnavn'];
				$data['ranking'][$points['id']]['ename'] = $points['enavn'];
				$data['ranking'][$points['id']]['points'] = $points['antall_poeng'];
			}
			
			$this->load->view("includes/template", $data);
		}
		
	}

}