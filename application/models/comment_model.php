<?php 
class Comment_model extends CI_Model {
	private $path;
	private  $post_id;
	
	function instantiatePostComments($post_id) {
		$this->path = base_url("/comments/post_comments_" . $post_id .".xml");
	}
	
	function getAllComments() {
		$xml = simplexml_load_file($this->path);
		return $xml;
	}
}
