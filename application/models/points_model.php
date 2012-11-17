<?php class Points_model extends CI_Model {
	function saveUserPoints($feedback, $user_id){
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
		
		$sql = "SELECT antall_poeng FROM poengtabell WHERE user_id = ?";
		$result = $this->db->query($sql, $user_id); 
		if($result->num_rows() > 0) {
			$user_current_score = 0;
			foreach ($result->result_array() as $row) {
				 $user_current_score = $row['antall_poeng']; 
			}
			$this->updateUserPoints($numberOfPoints, $user_current_score, $user_id); 
		} else {
			 $this->insertUserPoints($numberOfPoints, $user_id);
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
	
	function updateUserPoints($numberOfPoints, $user_current_score, $user_id) {
		$user_current_score += $numberOfPoints;
		$sql ="UPDATE poengtabell SET antall_poeng =? WHERE user_id =?";
		$this->db->query($sql, array($user_current_score, $user_id));
	}
	
	function insertUserPoints($numberOfPoints, $post_user_id) {
		$sql = "INSERT INTO poengtabell (user_id, antall_poeng) VALUES (?,?)";
		$this->db->query($sql, array($post_user_id, $numberOfPoints)); 
	}
}
