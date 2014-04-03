<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_daftar_pkwt extends CI_Model
{    
    
    public function __construct() {
        parent::__construct();
        
    }
      
    function daftar_pkwt()
    {
        return $this->db->query('SELECT d2.dept_name AS departemen
                                      , d1.dept_name AS bagian
                                      , e.emply_name AS nama
                                      , e.emply_start AS start
                                      , i.pkwt_end AS End_Contract_I
                                      , p.pkwt_end AS End_Contract_P
                                      , q.pkwt_end AS End_Contract_II                            
                                 FROM ( SELECT t.pkwt_dept
                                             , t.pkwt_nik
                                        FROM pkwt t
                                        GROUP 
                                        BY t.pkwt_dept
                                         , t.pkwt_nik
                                      ) g
                                 
                                 
                                 LEFT
                                 JOIN emply e
                                   ON e.emply_nik = g.pkwt_nik
                                   
                                 LEFT
                                 JOIN dept d1
                                   ON d1.dept_id = g.pkwt_dept
                                   
                                 LEFT
                                 JOIN dept d2
                                   ON d2.dept_id = d1.dept_parent
                                   
                                 LEFT
                                 JOIN pkwt i
                                   ON i.pkwt_dept = g.pkwt_dept
                                  AND i.pkwt_nik  = g.pkwt_nik
                                  AND i.pkwt_kk   = "I"

                                 LEFT
                                 JOIN pkwt p
                                   ON p.pkwt_dept = g.pkwt_dept
                                  AND p.pkwt_nik  = g.pkwt_nik
                                  AND p.pkwt_kk   = "P"

                                 LEFT
                                 JOIN pkwt q
                                   ON q.pkwt_dept = g.pkwt_dept
                                  AND q.pkwt_nik  = g.pkwt_nik
                                  AND q.pkwt_kk   = "II"
                                  
                                 ORDER
                                 BY d2.dept_name
                                  , d1.dept_name 
                                  , e.emply_name ASC');
    }
    
}