<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftar_pkwt extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('report/m_daftar_pkwt','record');
    }
    
    function index()
    {
        $auth = new Auth();

        $auth->restrict();
        //$auth->cek_menu(14);
        
        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
        $data['pkwt'] = $this->record->daftar_pkwt();
        $this->load->view('report/v_daftar_pkwt.php',$data);
    }

}