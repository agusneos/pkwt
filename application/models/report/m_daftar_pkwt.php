<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_daftar_pkwt extends CI_Model
{    
    static $table = 'pkwt';
    
    public function __construct() {
        parent::__construct();
        //$this->load->helper('database');
    }
    
    function daftar_pkwt()
    {
        $this->db->select('emply.*, workday.*, salary.*, post.*, 
                           p.pkwt_id AS pkwt_id, p.pkwt_kk AS pkwt_kk, p.pkwt_sign AS pkwt_sign, p.pkwt_start AS pkwt_start, p.pkwt_end AS pkwt_end,
                           p1.pkwt_id AS id_1, p1.pkwt_sign AS sign_1, p1.pkwt_start AS start_1, p1.pkwt_end AS end_1, 
                           p2.pkwt_id AS id_2, p2.pkwt_sign AS sign_2, p2.pkwt_start AS start_2, p2.pkwt_end AS end_2,
                           p.pkwt_status AS pkwt_status, p.pkwt_process AS pkwt_process, p.pkwt_spc_salary AS pkwt_spc_salary,
                           dept.dept_name AS dept_name,dept2.dept_name AS departemen');
        $this->db->join('emply','emply_nik=p.pkwt_nik','left')
                 ->join('dept','p.pkwt_dept=dept_id','left')
                 ->join('workday','dept_workday=workday_id','left')
                 ->join('salary','p.pkwt_salary=salary_id','left')
                 ->join('post','p.pkwt_post=post_id','left')
                 ->join('pkwt p1','p.pkwt_before=p1.pkwt_id','left')
                 ->join('pkwt p2','p1.pkwt_before=p2.pkwt_id','left')
                 ->join('dept dept2','dept.dept_parent=dept2.dept_id','left');
        //$this->db->where('p.pkwt_id',$pkwt_id);
        return $this->db->get('pkwt p');
        /*
        $query = $this->db->get('pkwt p');
        $data = array();
        foreach ( $query->result() as $row )
        {
            array_push($data, $row); 
        }
 
        $result = array();
//	$result["total"] = $total;
	$result['rows'] = $data;
        
        return json_encode($result); 
         * 
         */
    }
    
    function test()
    {
        $this->db->select('emply.emply_name, 
                        d1.dept_name AS bagian,
                        d2.dept_name AS departemen,
                        emply.emply_start,
                        p1.pkwt_end AS pembaharuan,
                        p2.pkwt_end AS perpanjangan,
                        p3.pkwt_end AS awal');
        $this->db->join('emply','emply_nik=p1.pkwt_nik','left')
                ->join('dept d1','p1.pkwt_dept=d1.dept_id','left')
                ->join('pkwt p2','p1.pkwt_before=p2.pkwt_id','left')
                ->join('pkwt p3','p2.pkwt_before=p3.pkwt_id','left')
                ->join('dept d2','d1.dept_parent=d2.dept_id','left'); 
        //$this->db->group_by('emply_name');
        return $this->db->get('pkwt p1');

    }
}