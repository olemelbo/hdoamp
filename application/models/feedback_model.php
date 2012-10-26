<?php
class Feedback_model extends CI_Model {
	private $post_id;
	function validateFeedback($post_id, $agree, $disagree, $relevant, $informative, $well_written,$unserious) {
		$this->post_id = $post_id;
		$this->user_id = $this->getUserId();
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
					$sql = "INSERT INTO innlegg_feedback (innlegg_id, user_id, feedback) VALUES (?,?,?)";
					$this->db->query($sql, array($this->post_id, $this->user_id, $key));
			}
			
			$this->saveUserPoints($feedback);
			
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
	
	function saveUserPoints($feedback){
		$numberOfPoints = 0;
		foreach($feedback as $key => $value) {
			$points = 0;
			if($key == 'agree') {
				$points += 1;
			} 
			
			if($key =='disagree') {
				$points += 1;
			}
			
			if($key =='relevant') {
				$points += 1;	
			}
			
			if($key == 'informative') {
				$points += 1;
			}
			
			if($key == 'well_written') {
				$points += 1;
			}
			
			if($key == 'unserious') {
				$points -= 2;
			}
			
			$numberOfPoints += $points;
		}
		//Get the user that has written the 
		$post_user_id = $this->getPostUserId();
		$sql = "SELECT antall_poeng FROM poengtabell WHERE user_id = ?";
		$result = $this->db->query($sql, $post_user_id); 
		if($result->num_rows() > 0) {
			$user_current_score = 0;
			foreach ($result->result_array() as $row) {
				 $user_current_score = $row['antall_poeng']; 
			}
			$this->updateUserPoints($numberOfPoints, $user_current_score, $post_user_id); 
		} else {
			 $this->insertUserPoints($numberOfPoints, $post_user_id);
		}
		
	}
	
	function getPostUserId() {
		$sql ="SELECT user_id FROM innlegg WHERE id = ?";
		$query = $this->db->query($sql,$this->post_id);
		foreach ($query->result_array() as $row) {
			$getPostUserId = $row['user_id'];
		}
		return $getPostUserId;
	}
	
	function updateUserPoints($numberOfPoints, $user_current_score, $post_user_id) {
		$user_current_score += $numberOfPoints;
		$sql ="UPDATE poengtabell SET antall_poeng =? WHERE user_id =?";
		$this->db->query($sql, array($user_current_score, $post_user_id));
	}
	
	function insertUserPoints($numberOfPoints, $post_user_id) {
		$sql = "INSERT INTO poengtabell (user_id, antall_poeng) VALUES (?,?)";
		$this->db->query($sql, array($post_user_id, $numberOfPoints)); 
	}
}
	