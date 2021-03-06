<?php class Entire_post extends CI_Controller {
	function index() {
		
	}
	
	function loadEntirePost() {
		$session = $this->session->userdata('uid');
		if($session) {
			$this->load->model("entire_post_model");
			$entire_query = $this->entire_post_model->getEntirePost($this->uri->segment(3));
			$areYouThePostAuthor = $this->entire_post_model->getPostAuthorId($session);	
			foreach ($entire_query->result_array() as $upost) {
				$data['entire_post']['id'] = $upost['id'];
				$data['entire_post']['tittel'] = $upost["tittel"];
				$data['entire_post']['in_text'] = $upost["in_text"];
				$data['entire_post']['user_id'] = $upost["user_id"];
				if($upost['user_id'] == $areYouThePostAuthor) {
					$data['entire_post']['author'] = true;
				}
				$data['entire_post']['date'] = $upost["date"];
			}
			
			//Points
			$this->load->model('user_ranking_model');
			$ranking_query = $this->user_ranking_model->getRanking();
			
			foreach($ranking_query->result_array() as $points) {
				$data['ranking'][$points['id']]['fname'] = $points['fnavn'];
				$data['ranking'][$points['id']]['ename'] = $points['enavn'];
				$data['ranking'][$points['id']]['points'] = $points['antall_poeng'];
			}
			
			$this->load->model("post_comments_model");
			$comment_query = $this->post_comments_model->getPostComments($this->uri->segment(3));
			$areYouTheCommentAuthor = $this->post_comments_model->getCommentAuthorId($session);
			foreach($comment_query->result_array() as $comment) {
				$data['comments'][$comment['id']]['id'] = $comment['id'];
				$data['comments'][$comment['id']]['innlegg_id'] = $comment['innlegg_id'];
				$data['comments'][$comment['id']]['user_id'] = $comment['user_id'];
				if($comment['user_id'] == $areYouTheCommentAuthor) {
					$data['comments'][$comment['id']]['author'] = true;
				}
				$data['comments'][$comment['id']]['full_name'] = $this->post_comments_model->fullName($comment['user_id']);
				$data['comments'][$comment['id']]['comment_text'] = $comment['comment_text'];
				$data['comments'][$comment['id']]['date'] = $comment['date'];
			}
			
			//User Info
			$this->load->model("user_model");
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
			
			$data["main_content"] = "restricted/entire_post";
			$this->load->view("includes/template", $data); 
		} else  {
			$this->load->model("entire_post_model");
			$entire_query = $this->entire_post_model->getEntirePost($this->uri->segment(3));
			foreach ($entire_query->result_array() as $upost) {
				$data['entire_post']['id'] = $upost['id'];
				$data['entire_post']['tittel'] = $upost["tittel"];
				$data['entire_post']['in_text'] = $upost["in_text"];
				$data['entire_post']['user_id'] = $upost["user_id"];
				$data['entire_post']['date'] = $upost["date"];
			}


			$this->load->model("post_comments_model");
			$comment_query = $this->post_comments_model->getPostComments($this->uri->segment(3));
			$areYouTheCommentAuthor = $this->post_comments_model->getCommentAuthorId($session);
			foreach($comment_query->result_array() as $comment) {
				$data['comments'][$comment['id']]['id'] = $comment['id'];
				$data['comments'][$comment['id']]['innlegg_id'] = $comment['innlegg_id'];
				$data['comments'][$comment['id']]['user_id'] = $comment['user_id'];
				if($comment['user_id'] == $areYouTheCommentAuthor) {
					$data['comments'][$comment['id']]['author'] = true;
				}
				$data['comments'][$comment['id']]['full_name'] = $this->post_comments_model->fullName($comment['user_id']);
				$data['comments'][$comment['id']]['comment_text'] = $comment['comment_text'];
				$data['comments'][$comment['id']]['date'] = $comment['date'];
			}
			
			$data["main_content"] = "entire_post";
			$this->load->view("includes/template", $data); 
		}
	}

	function getUserDataAjax() {
		$this->load->model("entire_post_model");
		$this->entire_post_model->getPostAuthorAjax($_POST['user_id']);
	}
	
	function getUserData($user_id) {
		$this->load->model("post_comments_model");
		$user_data = $this->post_comments_model->getCommentAuthor($user_id);
		return $user_data;
	}
}
