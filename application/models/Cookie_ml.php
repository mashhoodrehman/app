<?php 
class Cookie_ml extends CI_Model
{
	function __construct()
	{ 

	 	parent::__construct();
	 	$this->load->library('encrypt');
	 	$this->load->database('');
	}
	public function index()
	{	
		
		$this->db->select_max('id');
		$this->db->from('guest');
		$query=$this->db->get();
		if ($query->num_rows() < 1) 
		{
        return 'zero';
    	}
		return $query->row()->id;


	}
	function createcookie()
	{
		if(!$this->input->cookie('cookie_IGT'))
		{
			$this->db->select_max('id');
			$this->db->from('guest');
			$query=$this->db->get();
			if ($query->num_rows() > 0)
			{
			   $row = $query->row_array(); 
			   $maxid= $row['id'];
			}
			$maxid	= $maxid + 1;
			//$maxid   = rand();
			$string   = '123code'.$maxid;
			$encrypted = $this->encrypt->encode($string);
			$cookie = array(
	           'name'   => 'ckie_qapp',
	           'value'  => $encrypted,
	           'expire' => 86400,
	           'prefix' => ''
	        );
			$this->input->set_cookie($cookie); 
			$data = array(
	        'username' => $string);
			$results= $this->db->insert('guest', $data);
		}

	}
	function varifycookie()
	{
		if($this->input->cookie('cookie_IGT'))
		{
			$res_array['message'] = 'cookie available';
			$res_array['status'] = 'success';
		  	return $res_array;
			
		}
		else
		{
			$res_array['message'] = 'Your Session Cookie is expired, Please';
			$res_array['status'] = 'error';
		  	return $res_array;
		}
		
		
	}
	function decrypted()
	{

	}
	function sendMessage($status,$message,$action=0) // 1 is return
	{
		$array =array('status'=>$status,'message'=>$message);
		
		if($action ==1)
			return json_encode($array);
		else
			die(json_encode($array));
		
	}
	function ipadd($data)
	{
		$time = time();
		$this->db->insert('ip_user',$data);
	}
}
