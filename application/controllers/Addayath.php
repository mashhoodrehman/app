<?php 
class Addayath extends CI_Controller 
{
	function __construct()
	{ 
	 	parent::__construct();
	 	$this->load->helper(array('cookie','form','html','url','array','date','file'));
	 	$this->load->library(array('form_validation','session'));
	 	$this->load->database('');
	 	$this->load->model('Admin_ml');
	 	// $this->load->model(array('Admin_ml'));
	}
	public function index()
	{
		
	}
	function do_upload()
    {

    	$snum= $this->input->post('surah');
    	$anum= $this->input->post('anum');
        $name=$snum.'_'.$anum;
    	if (isset($_FILES['aimage']) && $_FILES['aimage']['name'] != '')
    	{
		    $file1 = $this->image_upload('aimage',$name);
		}

		if (isset($_FILES['avideo']) && $_FILES['avideo']['name'] != '')
		{
		    $file2 = $this->video_upload('avideo',$name);
		} 
		if($file1==false || $file2==false) 
		{
			echo json_encode('Try Again');
			
		} 
        else
        {
			$ins=array(
	            	'surah_no'=>$snum,
	            	'ayath_no'=>$anum,
	            	'ayath_image'=>$file1,
	            	'ayath_video'=>$file2);
	            $this->Admin_ml->save_ayath($ins);
	            echo json_encode('succesfully Added');
        }
    }
    function image_upload($filename,$name)
    {
    	$config['upload_path']="./assets/uploads/images";
        $config['file_name'] = $name;
        $config['allowed_types']='gif|jpg|png';
        $config['max_size'] = '0';
        $config['encrypt_name'] = FALSE;
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if($this->upload->do_upload($filename))
        {
        	
            $data = $this->upload->data();  
            $config['image_library'] = 'gd2';  
            $config['source_image'] = './assets/uploads/images/'.$data["file_name"];  
            $config['create_thumb'] = FALSE;  
            $config['maintain_ratio'] = TRUE;  
            $config['quality'] = 100;  
            // $config['width'] = 200;  
            // $config['height'] = 200;  
            $config['new_image'] = './assets/uploads/images/'.$data["file_name"];  
            $this->load->library('image_lib', $config);  
            $this->image_lib->resize();  
            $data = array('upload_data' => $this->upload->data());
            $filename= $data['upload_data']['file_name'];
            return $filename;
        }
        else
        {
        	return false;
        }
    }
     function video_upload($filename,$name)
    {
    	$config['upload_path']="./assets/uploads/videos";
        $config['file_name'] = $name;
        $config['allowed_types']='mp4|avi|flv|wmv';
        $config['max_size'] = '0';
        $config['encrypt_name'] = FALSE;
        // $config['max_filename'] = '255';
         
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if($this->upload->do_upload($filename))
        {
        	
            $data = $this->upload->data();  
            $config['image_library'] = 'gd2';  
            $config['source_image'] = './assets/uploads/videos/'.$data["file_name"];  
            $config['create_thumb'] = FALSE;  
            $config['maintain_ratio'] = TRUE;  
            $config['quality'] = 100;  
            // $config['width'] = 200;  
            // $config['height'] = 200;  
            $config['new_image'] = './assets/uploads/videos/'.$data["file_name"];  
            $this->load->library('image_lib', $config);  
            $this->image_lib->resize();  
            $data = array('upload_data' => $this->upload->data());
            $filename= $data['upload_data']['file_name'];
            return $filename;
        }
        else
        {
        	return false;
        }
    }
}