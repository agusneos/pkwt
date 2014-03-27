<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Menu_model','record');
    }
    
    public function index()
    {        
        $user_id = $this->session->userdata('user_id');
        echo $this->record->ambil_menu($user_id);               
    }

}