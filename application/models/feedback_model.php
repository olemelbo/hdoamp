<?php
class Feedback_model extends CI_Model {
	private $post_id;
	function validateFeedback($post_id, $agree, $disagree, $relevant, $informative, $well_written,$unserious) {
		$this->post_id = $post_id;
		$this->user_id = $this->getUserId();
		$fistFeedback = $this->firstFeedBack();
		$noVotingOnYourself = $this->noVotingOnYourself();
		
		if(!$fistFeedback) {
			$response['response'] = "error";
			$response['error'] = "Du kan bare gi feedback på et innlegg en gang";
			echo json_encode($response);
			return false;
		}
		
		if(!$noVotingOnYourself) {
			$response['response'] = "error";
			$response['error'] = "Du kan ikke gi feedback på egene innlegg";
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
					$sql = "INSERT INTO innlegg_feedback (innlegg_id, user_id, feedback) VALUES (?,?,?)";
					$this->db->query($sql, array($this->post_id, $this->user_id, $key));
			}
 			$response['response'] = "ok";
			$response['error'] = "Alt er ok";
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
	
	function firstFeedBack() {
		$sql = "SELECT id FROM innlegg_feedback WHERE innlegg_id =? AND user_id =?";
		$result = $this->db->query($sql, array($this->post_id, $this->user_id));
		if($result->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}
	
	function noVotingOnYourself() {
		$sql = "SELECT id, user_id FROM innlegg WHERE id = ? AND user_id = ?";
		$result = $this->db->query($sql, array($this->post_id, $this->user_id));
		if($result->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}
}
	