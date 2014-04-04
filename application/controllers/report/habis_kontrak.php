<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Habis_kontrak extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('report/m_habis_kontrak','record');
    }
    
    function index()
    {
        $auth = new Auth();

        $auth->restrict();
        //$auth->cek_menu(14);
        $this->load->view('report/habis_kontrak/v_dialog.php');
    }

    function get_dept()
    {
        echo $this->record->get_dept();
    }
    
    function cetak()
    {
        $auth = new Auth();

        $auth->restrict();
        //$auth->cek_menu(14);
        
        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
        $id = $this->uri->segment(4);
        $data['rows'] = $this->record->habis_kontrak($id);
        $this->load->view('report/habis_kontrak/v_habis_kontrak.php',$data);
    }
}

/* End of file habis_kontrak.php */
/* Location: ./controllers/report/habis_kontrak.php */