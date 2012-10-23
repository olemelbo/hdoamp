<?php
class Post_model extends CI_Model {
	private $user_id;
	function setNewPost($_POST) {		
		$title = $_POST['title'];
		$in_text = $_POST['in_text'];
		$post_data = array(
			'tittel' => $title, 
			'in_text' => $in_text,
			'feedback_id' => 1,
			'user_id' => $this->getUserId(),
			'date' => Date("Y-m-d H:i:s")
		);
		
		if ((empty ($title) || empty ($in_text))) {
			$response['response'] = "error";
			$response['error'] = "Du må skrive inn tittel og tekst";
			die();
		}
		
		$this->db->insert('innlegg', $post_data);
		$errtxt = $this->db->_error_message();
		
		if (!empty ($errtxt) ) {
			$response['response'] = "error";
			$response['error'] = "Det skjedde noe feil prøv på nytt";
		} else {
			$response['response'] = "ok";
			$response['msg'] = "Innlegget ble lagret";
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
}

?>