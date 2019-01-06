<?php 
class Admin extends CI_Controller 
{
	function __construct()
	{ 
	 	parent::__construct();
	 	$this->load->helper(array('cookie','form','html','url','array','date','file'));
	 	$this->load->library(array('form_validation','session'));
	 	$this->load->database('');
	 	$this->load->model(array('Admin_ml'));
	}
	public function index()
	{
		if($this->session->has_userdata('user_id'))
		{
			$this->db->select('*');
			// $this->db->from('tbl_surah');
			$query=$this->db->get('tbl_surah');
			$data['arr']=$query->result_array();
			// print_r($data['arr']);
			$this->load->view('admin/Index',$data);
		}
		else
		{
			$this->load->view('admin/Admin');
		}	
	}
	function login()
	{
		$user = $this->input->post('user');
		$password = $this->input->post('password');
		$this->db->select('role');
		$this->db->from('tbl_admin');
		$this->db->where('username',$user);
		$this->db->where('password',$password);
		$query=$this->db->get();
		$arr=$query->num_rows();
		if($arr > 0)
		{	
			$fname=$query->row('role');
			$newdata = array(
	        'user_id'  => $fname,	        
	        'logged_in' => TRUE
				);

			$this->session->set_userdata($newdata);				
			echo json_encode('success');
		}
		else
		{
			echo json_encode('error');
		}
	}
	
	function logout()
	{
		$this->session->unset_userdata('user_id');
		$r= base_url('Admin');
		redirect($r,'refresh');
	}
	function add()
	{
		if($this->session->has_userdata('user_id'))
		{
			$data['slist']=$this->surah_list();
			$this->load->view('admin/Add_surah', $data);
		}
		else
		{
			redirect('Admin','refresh');
		}
	}
	function addsurah()
	{
		if($this->session->has_userdata('user_id'))
		{
			$snum=$this->input->post('snum');
			$sname=$this->input->post('sname');
			$juzuh=$this->input->post('juzuh');
			$data=array('surah_no'=>$snum,
						'surah_name'=>$sname,
						'juzuh'=>$juzuh
				);
			// $message='snum='.$snum.',sname='.$sname.',juzuh='.$juzuh;
			// echo json_encode($message);
			$check=$this->check_surah($snum,$sname);
			if($check==0)
			{
				$this->db->insert('tbl_surah',$data);
				$data['slist']=$this->surah_list();
				$table=$this->load->view('admin/surah_table', $data,true);
				echo json_encode(array('success'=>'true','message'=>'Surah added','table'=>$table));
			}
			else
			{
				echo json_encode(array('success'=>'false','message'=>'Already Exist'));
			}
		}
		else
		{
			echo json_encode(array('success'=>'false','message'=>'Session over..Login first'));
		}
	}
	function check_surah($snum,$sname=null)
	{
		$this->db->select('*');
		$this->db->where('surah_no', $snum);
		$this->db->or_where('surah_name', $sname);
		$this->db->from('tbl_surah');
		$query=$this->db->get();
		// $query=$this->db->get("SELECT * from tbl_surah where surah_no=$snum or surah_name=$sname");
		return $query->num_rows();
	}
	function surah_list()
	{
		$this->db->select('*');
		$this->db->order_by('surah_no','desc');
		$query=$this->db->get('tbl_surah');
		return $query->result();
	}
	function surah_name($surah)
	{
		$this->db->select('surah_name');
		$this->db->where('surah_no', $surah);
		$query=$this->db->get('tbl_surah');
		return $query->row('surah_name');
	}
	function ayath()
	{
		if($this->session->has_userdata('user_id'))
		{
			$surah=$this->input->get('surah');
			$data['arr']=$this->ayath_list($surah);
			$data['surah']=$this->surah_name($surah);
			$data['sid']=$surah;
			$this->load->view('admin/Ayath', $data);
		}
		else
		{
			redirect('Admin','refresh');
		}
	}
	function ayath_list($surah)
	{
		$this->db->select('*');
		$this->db->where('surah_no', $surah);
		$this->db->order_by('ayath_no','desc');
		// $this->db->join('tbl_surah','tbl_ayath.surah_no=tbl_surah.surah_no');
		$query=$this->db->get('tbl_ayath');
		return $query->result();
	}
	function addayath()
	{
		if($this->session->has_userdata('user_id'))
		{
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']     = '100';
			$config['max_width'] = '1024';
			$config['max_height'] = '1024';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$file = $_FILES['aimage']['name'];
			$this->upload->do_upload('aimage');
			// $aimage=$this->input->post('aimage');
			// $avideo=$this->input->post('avideo');
			// $data=array('surah_no'=>$snum,
			// 			'surah_name'=>$sname,
			// 			'juzuh'=>$juzuh
			// 	);
			
			// $check=$this->check_surah($snum,$sname);
			// if($check==0)
			// {
			// 	$this->db->insert('tbl_surah',$data);
			// 	$data['slist']=$this->surah_list();
			// 	$table=$this->load->view('admin/surah_table', $data,true);
			// 	echo json_encode(array('success'=>'true','message'=>'Surah added','table'=>$table));
			// }
			// else
			// {
			// 	echo json_encode(array('success'=>'false','message'=>'Already Exist'));
			// }
			echo json_encode(array('success'=>'true','message'=>'Ayath added'));
		}
		else
		{
			echo json_encode(array('success'=>'false','message'=>'Session over..Login first'));
		}
	}
}