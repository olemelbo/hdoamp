<?php class Feedback_comment_model extends CI_Model {
	private $comment_id;
	private $user_id;
	private $comment_author_id;
	function validateCommentFeedback($comment_id, $agree, $disagree, $relevant, $informative, $well_written,$unserious) {
		$this->comment_id = $comment_id;
		$this->user_id = $this->getUserId();
		$this->comment_author_id = $this->getCommentAuthorId();
		$fistFeedback = true;
		$fistFeedback = $this->firstFeedBack();
		$noVotingOnYourself = true;
		$noVotingOnYourself = $this->noVotingOnYourself();
		
		if(!$noVotingOnYourself) {
			$response['response'] = "error";
			$response['error'] = "Du kan ikke gi feedback på egene innlegg";
			echo json_encode($response);
			return false;
		}
		
		if(!$fistFeedback) {
			$response['response'] = "error";
			$response['error'] = "Du kan bare gi feedback på et innlegg en gang";
			echo json_encode($response);
			return false;
		}
		
		if($agree == 1 && $disagree == 1) {
			$response['response'] = "error";
			$response['error'] = "Du må enten velge enig eller uenig";
			echo json_encode($response);
			return false;
		} else if($relevant == 1 && $unserious) {
			$response['response'] = "error";
			$response['error'] = "Du må enten velge relevant eller useriøst";
			echo json_encode($response);
			return false;
		} else if($agree == 1 && $unserious == 1) {
			$response['response'] = "error";
			$response['error'] = "Du kan ikke være enig og samtidig synes innlegget er useriøst";
			echo json_encode($response);
			return false;
		} else if($informative == 1 && $unserious == 1){
			$response['response'] = "error";
			$response['error'] = "Innlegget kan ikke være informativt, men samtidig useriøst";
			echo json_encode($response);
			return false;
		} else if($well_written == 1 && $unserious == 1) {
			$response['response'] = "error";
			$response['error'] = "Innlegget kan ikke være godt skrevet, men samtidig useriøst";
			echo json_encode($response);
			return false;
		} else {
			$data['agree'] = $agree;
			$data['disagree'] = $disagree;
			$data['relevant'] = $relevant;
			$data['informative'] = $informative;
			$data['well_written'] = $well_written;
			$data['unserious'] = $unserious;
			
			foreach($data as $key =>$value) {
				if(!$value == 0){
					$feedback[$key] = $value; 
				} 
			}
			
			foreach($feedback as $key => $value) {
					$sql = "INSERT INTO kommentar_feedback (kommentar_id, user_id, feedback) VALUES (?,?,?)";
					$this->db->query($sql, array($this->comment_id, $this->user_id, $key));
			}
			
			$this->load->model('points_model');
			$this->points_model->saveUserPoints($feedback, $this->comment_author_id);
			
 			$response['response'] = "ok";
			$response['msg'] = "Feedback ble lagret";
			echo json_encode($response);
		}
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
	
	function getCommentAuthorId() {
		$sql ="SELECT user_id FROM kommentar WHERE id = ?";
		$query = $this->db->query($sql,$this->comment_id);
		foreach ($query->result_array() as $row) {
			$getPostUserId = $row['user_id'];
		}
		return $getPostUserId;
	}
	
	
	function firstFeedBack() {
		$sql = "SELECT id FROM kommentar_feedback WHERE kommentar_id =? AND user_id =?";
		$result = $this->db->query($sql, array($this->comment_id, $this->user_id));
		if($result->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}
	
	function noVotingOnYourself() {
		$sql = "SELECT id, user_id FROM kommentar WHERE id = ? AND user_id = ?";
		$result = $this->db->query($sql, array($this->comment_id, $this->user_id));
		if($result->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}
}
