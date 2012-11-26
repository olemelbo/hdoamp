<?php

class User_ranking_model extends CI_Model {

	function getRanking() {
		$sql = "SELECT b.id, b.fnavn, b.enavn, p.antall_poeng
				FROM bruker b
				INNER JOIN poengtabell p ON b.id = p.user_id
				ORDER BY p.antall_poeng DESC
				LIMIT 5 ";
		$query = $this->db->query($sql);
		return $query;
	}

}

?>