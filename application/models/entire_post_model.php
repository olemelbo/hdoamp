<?php 
class Entire_post_model extends CI_Model {
		
	function getEntirePost($post_id) {
		$sql = "SELECT * FROM innlegg WHERE id=?";
		$query = $this->db->query($sql, array($post_id));
		return $query;
	}
	
	function getPostAuthor($user_id) {
		$sql = "SELECT * FROM bruker WHERE id = ?";	
		$query_author = $this->db->query($sql, array($user_id));
		if($query_author->num_rows() > 0) {
			foreach ($query_author->result_array() as $author) {
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
			$data['response'] = "ok";
			echo json_encode($data);
		} else {
			$data['response'] = "error";
			$data['error'] = "Noe gikk galt. Prøv igjen.";
			echo json_encode($data);
		}
	}	
}
