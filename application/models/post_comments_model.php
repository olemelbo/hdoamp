<?php 
class Post_comments_model extends CI_Model {
	public $parents = array();
	public $children = array();
	
	function initializePostComments($post_id) {
		$sql = "SELECT * FROM kommentar WHERE innlegg_id = ? ORDER BY id ASC";
		$comments_query = $this->db->query($sql, array($post_id));
		if($comments_query->num_rows() > 0) {
			foreach ($comments_query->result_array() as $comment) {
				if ($comment['parent_id'] == 0) {  
	           		$this->parents[$comment['id']]['comment_id'] = $comment['id']; 
					$this->parents[$comment['id']]['innlegg_id'] = $comment['innlegg_id'];
					$this->parents[$comment['id']]['user_id'] = $this->getCommentAuthor($comment['user_id']);
					$this->parents[$comment['id']]['comment_text'] = $comment['comment_text'];
					$this->parents[$comment['id']]['date'] = $comment['date'];
	           	} else {
	            	$this->children[$comment['parent_id']]['parent_id'] = $comment['parent_id'];
					$this->children[$comment['id']]['comment_id'] = $comment['id']; 
					$this->children[$comment['id']]['innlegg_id'] = $comment['innlegg_id'];
					$this->children[$comment['id']]['user_id'] = $this->getCommentAuthor($comment['user_id']);
					$this->children[$comment['id']]['comment_text'] = $comment['comment_text'];
					$this->children[$comment['id']]['date'] = $comment['date'];
	           	}  
			}
		} else {
			
		}
		
	}	

	function getCommentParents() {
		return $this->parents;
	}
	
	function getCommentChildren() {
		return $this->children;
	}
	
	function getCommentAuthor($user_id) {
		$sql = "SELECT * FROM bruker WHERE id = ?";	
		$query_comment_author = $this->db->query($sql, array($user_id));
		if($query_comment_author->num_rows() > 0) {
			foreach ($query_comment_author->result_array() as $author) {
				$data['id'] = $author['id'];
				$data['fnavn'] = $author["fnavn"];
				$data['enavn'] = $author["enavn"];
				$data['image_link'] = $author["image_link"];
				$data['department'] = $author["department"];
				$data['email'] = $author["email"];
				$data['sist_innlogget'] = $author["sist_innlogget"];
			}
		
			$sql = "SELECT antall_poeng from poengtabell WHERE user_id=?";
			$query_user_points = $this->db->query($sql, array($user_id));
			foreach($query_user_points->result_array() as $points) {
				$data['points'] = $points['antall_poeng'];
			} 
			return $data;
		} else {
			$data['error'] = "Noe gikk galt. Prøv igjen.";
			return $data;
		}
	}	
	
}
