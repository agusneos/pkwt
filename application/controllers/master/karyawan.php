<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('master/karyawan_model','record');
    }
    
    public function index()
    {
        $auth       = new Auth();
         // mencegah user yang belum login untuk mengakses halaman ini
        $auth->restrict();
        
        if (isset($_GET['grid'])) 
            echo $this->record->getJson();        
         else 
            $this->load->view('master/karyawan');        
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
    
    public function update($emply_nik=null)
    {
        if(!isset($_POST))	
            show_404();

        if($this->record->update($emply_nik))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal mengubah data'));
            
    }
        
    public function delete()
    {
        if(!isset($_POST))	
            show_404();

        $emply_nik = intval(addslashes($_POST['$emply_nik']));
        if($this->record->delete($emply_nik))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal menghapus data'));
    }
    
    public function enumEmplySex()
    {
        echo $this->record->enumField('emply', 'emply_sex');
    }
    
    public function enumEmplyRelig()
    {
        echo $this->record->enumField('emply', 'emply_relig');
    }
    
    public function enumEmplyMarital()
    {
        echo $this->record->enumField('emply', 'emply_marital');
    }
    
    public function enumEmplyStatus()
    {
        echo $this->record->enumField('emply', 'emply_status');
    }
    
    public function enumEmplyActive()
    {
        echo $this->record->enumField('emply', 'emply_active');
    }
    
    public function getBank()
    {
        echo $this->record->getBank();
    }
               
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */