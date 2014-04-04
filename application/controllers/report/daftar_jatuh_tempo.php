<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftar_jatuh_tempo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('report/m_daftar_jatuh_tempo','record');
    }
    
    function index()
    {
        $auth = new Auth();

        $auth->restrict();
        //$auth->cek_menu(14);
        
        
        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
        //$id = $this->uri->segment(4);
        $data['rows'] = $this->record->daftar_jatuh_tempo($id);
        $this->load->view('report/habis_kontrak/v_daftar_jatuh_tempo.php',$data);
    }
}

/* End of file daftar_jatuh_tempo.php */
/* Location: ./controllers/report/daftar_jatuh_tempo.php */