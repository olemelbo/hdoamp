<?php 
class Entire_post_model extends CI_Model {
		
	function loadEntirePost($post_id) {
		$sql = "SELECT * FROM innlegg WHERE id=?";
		$query = $this->db->query($sql, array($post_id));
		return $query;
	}	
}
