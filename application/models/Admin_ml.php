<?php 
class Admin_ml extends CI_Model
{
	function __construct()
	{ 

	 	parent::__construct();
	 	$this->load->library('encrypt');
	 	$this->load->database('');
	}
	public function index()
	{			
		
	}
	function save_ayath($ins){ 
		$snum=$ins['surah_no'];
		$anum=$ins['ayath_no'];
		$this->db->select('*');
		$this->db->where('surah_no', $snum);
		$this->db->where('ayath_no', $anum);
		$this->db->from('tbl_ayath');
		$query=$this->db->get();
		if($query->num_rows() > 0)
		{
			$this->db->where('surah_no', $snum);
			$this->db->where('ayath_no', $anum);
			$this->db->update('tbl_ayath',$ins);
		}
		else
		{
			$this->db->insert('tbl_ayath',$ins);
		}
    }
	
}