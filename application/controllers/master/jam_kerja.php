<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jam_kerja extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('master/jam_kerja_model','record');
    }
    
    public function index()
    {
        $auth       = new Auth();
         // mencegah user yang belum login untuk mengakses halaman ini
        $auth->restrict();
        
        if (isset($_GET['grid'])) 
            echo $this->record->getJson();        
         else 
            $this->load->view('master/jam_kerja');        
    } 
    
    public function create()
    {
        if(!isset($_POST))	
            show_404();        
        
        if($this->record->create())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal memasukkan data'));
    }     
    
    public function update($workday_id=null)
    {
        if(!isset($_POST))	
            show_404();

        if($this->record->update($workday_id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal mengubah data'));
    }
        
    public function delete()
    {
        if(!isset($_POST))	
            show_404();

        $workday_id = intval(addslashes($_POST['workday_id']));
        $workday_path = addslashes($_POST['workday_path']);
        if($this->record->delete($workday_id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal menghapus data'));
    }
    
    public function upload($workday_id=null)
    {
        if(!isset($_POST))	
            show_404();

        if($this->record->upload($workday_id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal mengubah data'));
    }
               
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */