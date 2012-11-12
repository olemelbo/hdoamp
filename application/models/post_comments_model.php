<?php 
class Post_comments_model extends CI_Model {
		
	function getPostComments($post_id) {
		$sql = "SELECT * FROM kommentar WHERE innlegg_id = ? ORDER BY id ASC";
		$comments_query = $this->db->query($sql, array($post_id));
		return $comments_query;	
	}	
	
	function setNewComment($uid, $comment_text, $innlegg_id) {
		$sql = "INSERT INTO kommentar ";
		$response['response'] = "ok";
		$response['msg'] = "Ny kommentar ble lagt til";
		echo json_encode($response);	
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
