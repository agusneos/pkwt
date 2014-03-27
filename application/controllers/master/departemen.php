<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Departemen extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('master/departemen_model','record');
    }
    
    public function index()
    {
        $auth       = new Auth();
         // mencegah user yang belum login untuk mengakses halaman ini
        $auth->restrict();
        
        if (isset($_GET['grid'])) 
            echo $this->record->getJson();        
        else 
            $this->load->view('master/departemen');        
    }
    
    public function getParent()
    {        
        echo $this->record->getParent();       
      
    }
    
    public function getHariKerja()
    {        
        echo $this->record->getHariKerja();       
      
    }
    
    public function getManager()
    {        
        echo $this->record->getManager();       
      
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
    
    public function update($dept_id=null)
    {
        if(!isset($_POST))	
            show_404();

        if($this->record->update($dept_id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal mengubah data'));
    }
        
    public function delete()
    {
        if(!isset($_POST))	
            show_404();

        $dept_id = intval(addslashes($_POST['dept_id']));
        if($this->record->delete($dept_id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal menghapus data'));
    }
               
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */