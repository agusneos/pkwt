<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_daftar_jatuh_tempo extends CI_Model
{    
    static $table = 'pkwt';
    
    public function __construct() {
        parent::__construct();
        
    }
    
    function  daftar_jatuh_tempo($year)
    {
        $this->db->select('d2.dept_name AS DEPARTEMEN, year(pkwt_end) AS TAHUN,
            COUNT(CASE WHEN month(pkwt_end) = "1" THEN d2.dept_id END) JAN,
            COUNT(CASE WHEN month(pkwt_end) = "2" THEN d2.dept_id END) FEB,
            COUNT(CASE WHEN month(pkwt_end) = "3" THEN d2.dept_id END) MAR,
            COUNT(CASE WHEN month(pkwt_end) = "4" THEN d2.dept_id END) APR,
            COUNT(CASE WHEN month(pkwt_end) = "5" THEN d2.dept_id END) MEI,
            COUNT(CASE WHEN month(pkwt_end) = "6" THEN d2.dept_id END) JUN,
            COUNT(CASE WHEN month(pkwt_end) = "7" THEN d2.dept_id END) JUL,
            COUNT(CASE WHEN month(pkwt_end) = "8" THEN d2.dept_id END) AGT,
            COUNT(CASE WHEN month(pkwt_end) = "9" THEN d2.dept_id END) SEP,
            COUNT(CASE WHEN month(pkwt_end) = "10" THEN d2.dept_id END) OKT,
            COUNT(CASE WHEN month(pkwt_end) = "11" THEN d2.dept_id END) NOV,
            COUNT(CASE WHEN month(pkwt_end) = "12" THEN d2.dept_id END) DES,
            COUNT(CASE WHEN month(pkwt_end) > "0" THEN d2.dept_id END) TOTAL');
        //$this->db->select_sum()
        $this->db->join('dept d1', 'd1.dept_id = pkwt_dept', 'LEFT')
                 ->join('dept d2', 'd2.dept_id = d1.dept_parent', 'LEFT');
        $this->db->where('pkwt_process', 'N')
                 ->where('year(pkwt_end)', $year);
        $this->db->group_by('d2.dept_name');
        return $this->db->get(self::$table);
    }
    
    function get_year()
    {
        $this->db->select('year(pkwt_end) AS year');
        $this->db->where('pkwt_process', 'N');
        $this->db->group_by('year');
        $query  = $this->db->get(self::$table);
                   
        $data = array();
        foreach ( $query->result() as $row )
        {
            array_push($data, $row); 
        }       
        return json_encode($data);
    }
    
    function daftar_jatuh_tempo_old($year)
    {
        $this->db->select('d2.dept_name AS departemen
                         , month(pkwt_end) AS pkwt_end');
        $this->db->join('dept d1', 'pkwt.pkwt_dept = d1.dept_id', 'left')
                 ->join('dept d2', 'd1.dept_parent = d2.dept_id', 'left');
        $this->db->where('pkwt_process', 'N');
        $this->db->where('year(pkwt_end)', $year);
        return $this->db->get(self::$table);
    }
}

/* End of file m_daftar_jatuh_tempo.php */
/* Location: ./models/report/m_daftar_jatuh_tempo.php */