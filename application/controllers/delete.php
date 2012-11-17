<?php class Delete extends CI_Controller {
	function delete_user_comment() {
		$this->load->model("delete_model");
		$this->delete_model->delete_user_comment($_POST['id']);
	}
}
