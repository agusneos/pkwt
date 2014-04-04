<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_habis_kontrak extends CI_Model
{    
    static $table = 'pkwt';
    
    public function __construct() {
        parent::__construct();
        
    }
      
    function habis_kontrak($dept)
    {
        $this->db->select('pkwt.pkwt_end
                         , pkwt.pkwt_kk
                         , d1.dept_name AS Bagian
                         , d2.dept_name AS Departemen
                         , e2.emply_name AS Manager
                         , e1.emply_name
                         , e1.emply_start');
        $this->db->join('emply e1', 'pkwt.pkwt_nik = e1.emply_nik', 'left')
                 ->join('dept d1', 'pkwt.pkwt_dept = d1.dept_id', 'left')
                 ->join('dept d2', 'd1.dept_parent = d2.dept_id', 'left')
                 ->join('emply e2', 'd2.dept_emply = e2.emply_nik', 'left');
        $this->db->where('TIMESTAMPDIFF(month,now(),pkwt_end) < 2')
                 ->where('pkwt_process', 'N')
                 ->where('d2.dept_id', $dept);
        $this->db->order_by('emply_name', 'ASC');
        return $this->db->get(self::$table);
    }
    
    function get_dept()
    {
        $this->db->select('d2.dept_id AS dept_id
                         , d2.dept_name AS dept_name');
        $this->db->join('dept d1', 'pkwt.pkwt_dept = d1.dept_id', 'left')
                 ->join('dept d2', 'd1.dept_parent = d2.dept_id', 'left');
        $this->db->where('TIMESTAMPDIFF(month,now(),pkwt_end) < 2')
                 ->where('pkwt_process', 'N');
        $this->db->group_by('d2.dept_name');
        $this->db->order_by('d2.dept_name', 'ASC');
        $query  = $this->db->get(self::$table);
                   
        $data = array();
        foreach ( $query->result() as $row )
        {
            array_push($data, $row); 
        }       
        return json_encode($data);
    }
    
}

/* End of file m_habis_kontrak.php */
/* Location: ./models/report/m_habis_kontrak.php */