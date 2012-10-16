<?php
class Post_model extends CI_Model {
	function setNewPost() {
		$result ="";
		$title = $this->input->post('title');
		$in_text = $this->input->post('in_text');
		$post_data = array(
		'tittel' => $title, 
		'in_text' => $in_text,
		'feedback_id' => 1,
		'user_id' => 1,
		'date' => date("F j, Y, g:i a")
		);
		
		if ((empty ($title) || empty ($in_text))) {
			return 'Tittel eller tekstfeltet kan ikke være tomt';
			die();
		}
		
		$this->db->insert('innlegg', $post_data);
		$errtxt = $this->db->_error_message();
		
		if (!empty ($errtxt) ) {
			$result = $errtxt;
		}
		
		else {
			$result = "Alt gikk bra!";
		}
		
		return $result;
	}
}

?>