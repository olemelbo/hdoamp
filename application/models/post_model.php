<?php
class Post_model extends CI_Model {
	private $user_id;
	private $post_id;
	function setNewPost($title, $hash_tags, $in_text) {		
		
		if ((empty ($title) || empty ($in_text))) {
			$response['response'] = "error";
			$response['error'] = "Du må skrive inn tittel og tekst";
			die();
		}
	
		$post_data = array(
			'tittel' => $title, 
			'in_text' => $in_text,
			'user_id' => $this->getUserId(),
			'date' => date("Y-m-d H:i:s") 
		);
		
		$this->db->insert('innlegg', $post_data);
		$errtxt = $this->db->_error_message();
		
		if (!empty ($errtxt) ) {
			$response['response'] = "error";
			$response['error'] = "Det skjedde noe feil prøv på nytt";
		} else {
			$response['response'] = "ok";
			$response['msg'] = "Innlegget ble lagret";
		}
		
		if($hash_tags){
			$sql = "SELECT id FROM innlegg WHERE user_id =? ORDER BY ID DESC LIMIT 1";
			$query = $this->db->query($sql, array($this->getUserId()));
			foreach ($query->result_array() as $row) { $this->post_id = $row['id']; }
			
			$hash_array = explode(" ", $hash_tags);
			foreach($hash_array as $hash) {
				$sql = "INSERT INTO `hashtag` (`hash_id` , `innlegg_id` , `hashtag`) VALUES (NULL , ?, ?);";
				$this->db->query($sql, array($this->post_id, $hash));
			}
		}
		
		echo json_encode($response);
	}
	
	function getUserId() {
		$session = $this->session->userdata('uid');
		$this->db->select('id');
		$this->db->from('bruker');
		$this->db->where('studnr', $session);
		$query = $this->db->get();
		foreach ($query->result_array() as $row) 
		{ $user_id = $row['id']; }
		return $user_id;
	}
	
	function getAllPosts() {
		$sql = "SELECT i.id, i.tittel, i.in_text, i.user_id, i.date, h.hash_id, h.hashtag
		FROM INNLEGG i
		LEFT JOIN HASHTAG h
		ON i.id=h.innlegg_id
		ORDER BY i.id DESC";
		$query = $this->db->query($sql, array());
		return $query;
	}
	
	function countComments($post_id) {
		$this->db->select('COUNT(id) as num')
        ->from('kommentar')
        ->where('innlegg_id', $post_id);
		return $this->db->get()->row()->num;
	}
	
}

?>