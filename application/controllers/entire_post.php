<?php class Entire_post extends CI_Controller {
	function index() {
		
	}
	
	function loadEntirePost() {
		$session = $this->session->userdata('uid');
		if($session) {
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
			$comments_query = $this->post_comments_model->getPostComments($this->uri->segment(3));
			if($comments_query->num_rows() > 0) {
				foreach ($comments_query->result_array() as $comment) {
					$data['comments'][$comment["id"]]["id"] = $comment['id'];
					$data['comments'][$comment["id"]]["parent_id"] = $comment['parent_id'];
					$data['comments'][$comment["id"]]["user_id"] = $comment['user_id'];
					$data['comments'][$comment["id"]]["comment_text"] = $comment['comment_text'];
					$data['comments'][$comment["id"]]["date"] = $comment['date'];
					$data['comments'][$comment["id"]]["user_data"] = $this->getUserData($comment["user_id"]);
				}
				$data['comment_error']['error'] = "ok";
			} else {
				$data['comment_error']['error'] = "error";
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
