<?php
class Statistics_model extends CI_Model {
	function getChartById($post_id) {
		$sql = "SELECT feedback FROM innlegg_feedback WHERE innlegg_id =?";
		$query = $this->db->query($sql, array($post_id));
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$feedback[] = $row['feedback'];
			}
		
			echo json_encode($feedback);
		} else {
			$response['response'] = "error";
			$response['error'] = "Dette innlegget har ikke fått feedback. Det kan dermed ikke vises statistikk.";
			echo json_encode($response);
			return false;
		}
	}
}