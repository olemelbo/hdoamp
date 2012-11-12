<?php class Comment extends CI_Controller {
	function index() {
		
	}
	
	function validate_comment() {
		$session = $this->session->userdata('uid');
		if($session) {
			$this->load->model('post_comments_model');
			$this->post_comments_model->setNewComment($session, $_POST['comment_text'], $_POST['innlegg_id']);
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