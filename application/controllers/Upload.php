<?php
class Upload extends CI_Controller
{
    function __construct()
    { 
        parent::__construct();
        $this->load->model('upload_model');
    }
 
    function index()
    {
        if($this->session->has_userdata('user_id'))
        {
            $surah=$this->input->get('surah');
            // $data['arr']=$this->ayath_list($surah);
            // $data['surah']=$this->surah_name($surah);
            $data['sid']=$surah;
            $this->load->view('admin/upload_view', $data);
        }
        else
        {
            redirect('Admin','refresh');
        }
    }
 
 
    function do_upload()
    {
        $config['upload_path']="./assets";
        $config['allowed_types']='gif|jpg|png';
        $config['encrypt_name'] = FALSE;
         
        $this->load->library('upload',$config);
        if($this->upload->do_upload("file"))
        {
            $data = $this->upload->data();  
                     $config['image_library'] = 'gd2';  
                     $config['source_image'] = './assets/'.$data["file_name"];  
                     $config['create_thumb'] = FALSE;  
                     $config['maintain_ratio'] = TRUE;  
                     $config['quality'] = '100%';  
                     // $config['width'] = 200;  
                     // $config['height'] = 200;  
                     $config['new_image'] = './upload/'.$data["file_name"];  
                     $this->load->library('image_lib', $config);  
                     $this->image_lib->resize();  
            $data = array('upload_data' => $this->upload->data());
 
            $title= $this->input->post('title');
            $image= $data['upload_data']['file_name']; 
             
            $result= $this->upload_model->save_upload($title,$image);
            echo json_decode($result);
        }
 
     }
     
}