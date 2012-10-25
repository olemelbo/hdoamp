<?php
class User_model extends CI_Model {
	private $id;
	private $studnr;
	private $fnavn;
	private $enavn;
	private $email;
	private $image_link;
	private $department;
	private $last_used;
	private $score;
		
	function instantiate($studnr) {
		$this->db->from('bruker');
		$this->db->where('studnr', $studnr);
		$query = $this->db->get();
		
		foreach ($query->result_array() as $row) { $this->id = $row['id']; }
		foreach ($query->result_array() as $row) { $this->studnr = $row['studnr']; }
		foreach ($query->result_array() as $row) { $this->fnavn = $row['fnavn']; }
		foreach ($query->result_array() as $row) { $this->enavn = $row['enavn']; }
		foreach ($query->result_array() as $row) { $this->email = $row['email']; }
		foreach ($query->result_array() as $row) { $this->image_link = $row['image_link']; }
		foreach ($query->result_array() as $row) { $this->department = $row['department']; }
		foreach ($query->result_array() as $row) { $this->last_used = $row['sist_innlogget']; }

	}
	
	function getUserId() {
		return $this->id;
	}
	
	function getUserStudnr(){
		return $this->studnr;
	}
	
	function getUserFirstName() {
		return $this->fnavn;
	}
	
	function getUserLastName() {
		return $this->enavn;
	}
	
	function getUserFullName() {
		return $this->fnavn . " " . $this->enavn;
	}
	
	function getUserEmail() {
		return $this->email;
	}
	
	function getUserImage() {
		return $this->image_link;
	}
	
	function getUserDepartment() {
		return $this->department;
	}
	
	function getLastUsed() {
		return $this->last_used;	
	}
	
	function getUserScore() {
		return $this->score;
	}
	
	
	function setUserScore() {
		$this->db->select('antall_poeng');
		$this->db->from('poengtabell');
		$this->db->where('user_id', $this->id);
		$query = $this->db->get();
		foreach ($query->result_array() as $row) { $this->score = $row['antall_poeng ']; }
	}
}