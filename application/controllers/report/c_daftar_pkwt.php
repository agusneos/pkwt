<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_daftar_pkwt extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('report/m_daftar_pkwt','record');
    }
    
    function cetak_pkwt()
    {
        $auth = new Auth();

        $auth->restrict();
        //$auth->cek_menu(14);
        
        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
        $id = $this->uri->segment(4);
        $data['pkwt'] = $this->record->daftar_pkwt();
        $this->load->view('report/v_daftar_pkwt.php',$data);
    }
    
    function cet()
    {
       // $auth = new Auth();

       // $auth->restrict();
        //$auth->cek_menu(14);
        
        echo $this->record->test();
    }
    function tak()
    {
       // $auth = new Auth();

       // $auth->restrict();
        //$auth->cek_menu(14);
        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
        $data['pkwt'] = $this->record->test();
        $this->load->view('report/v_daftar_pkwt.php',$data);
    }
}