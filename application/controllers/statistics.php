<?php
class Statistics extends CI_Controller {
	function index() {
				
	}
	
	function get_statistics() {
		$this->load->model('statistics_model');
		$this->statistics_model->getChartById($_POST['post_id']);
	}
}