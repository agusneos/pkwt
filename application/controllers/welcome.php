<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -  
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();

    }
    
    public function index()
    {
        if($this->auth->is_logged_in() == false)
        {
           $this->login();
        }
        else
        {
           $this->main();
        }        
    }
         
    public function main()
    {
        // mencegah user yang belum login untuk mengakses halaman ini
        $this->auth->restrict();
        $this->load->view('main');
    }
    
    public function dashboard()
    {
        // mencegah user yang belum login untuk mengakses halaman ini
        $this->auth->restrict();
        $this->load->view('dashboard');
    }
 
    public function login()
    {
        $this->load->view('login');
    }
    
    public function logout()
    {
        if($this->auth->is_logged_in() == true)
        {
            $this->auth->do_logout();
        }
        redirect('welcome');
    }
       
    public function proses_login()
    { 
        $this->output->set_content_type('application/json');
        if (isset($_POST))
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $success = $this->auth->do_login($username,$password);
            if($success)
            {
               // lemparkan ke halaman index user
               echo json_encode(array(
                    'success'=>true, 
                    'auth_id'=>$this->session->userdata('user_id')
                ));
            }
            else
            {
                echo json_encode(array('success'=>false));
                //redirect('welcome/login');
               //$this->template->set('title','Login Form | MyWebApplication.com');
               //$data['login_info'] = "Maaf, username dan password salah!";
               //$this->template->load('template','admin/login_form',$data);    
            }
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */