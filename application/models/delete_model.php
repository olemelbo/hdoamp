<?php class Delete_model extends CI_Model {
	function delete_user_comment($comment_id) {
		$sql = "DELETE FROM kommentar WHERE id = ?";
		$this->db->query($sql, array($comment_id));
	}
	
	function delete_user_post($post_id) {
		$sql = "DELETE FROM innlegg WHERE id = ?";
		$this->db->query($sql, array($post_id));
	}
}
