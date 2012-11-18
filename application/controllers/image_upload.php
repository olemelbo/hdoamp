<?php class Image_upload extends CI_Controller {
	function upload_image() 
	{
		$config['upload_path'] = base_url("/profile_pictures");
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']    = '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
 
		// You can give video formats if you want to upload any video file.
 
		$this->load->library('upload', $config);
 
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
 
			// uploading failed. $error will holds the errors.
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
 
			// uploading successfull, now do your further actions
		}
	}
}
