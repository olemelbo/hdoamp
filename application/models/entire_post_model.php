<?php 
class Entire_post_model extends CI_Model {
		
	function getEntirePost($post_id) {
		$sql = "SELECT * FROM innlegg WHERE id=?";
		$query = $this->db->query($sql, array($post_id));
		return $query;
	}
	
	function getPostAuthor($user_id) {
		$sql = "SELECT * FROM bruker WHERE id = ?";	
		$query_author = $query = $this->db->query($sql, array($user_id));
		foreach ($query_author->result_array() as $author) {
			$data['post_author']['id'] = $author['id'];
			$data['post_author']['fnavn'] = $author["fnavn"];
			$data['post_author']['enavn'] = $author["enavn"];
			$data['post_author']['image_link'] = $author["image_link"];
			$data['post_author']['department'] = $author["department"];
			$data['post_author']['email'] = $author["email"];
			$data['post_author']['sist_innlogget'] = $author["sist_innlogget"];
		}
		
		echo json_encode($data);
	}	
}
