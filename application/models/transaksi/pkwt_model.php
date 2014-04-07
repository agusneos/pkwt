<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Pkwt_model extends CI_Model
{    
    static $table = 'pkwt';
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('database');
    }

    public function getJson()
    {
        $page   = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows   = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $offset = ($page-1)*$rows;      
        $sort   = isset($_POST['sort']) ? strval($_POST['sort']) : 'pkwt_id';
        $order  = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        
        $filterRules = isset($_POST['filterRules']) ? ($_POST['filterRules']) : '';
	$cond = '1=1';
	if (!empty($filterRules)){
            $filterRules = json_decode($filterRules);
            //print_r ($filterRules);
            foreach($filterRules as $rule){
                $rule = get_object_vars($rule);
                $field = $rule['field'];
                $op = $rule['op'];
                $value = $rule['value'];
                if (!empty($value)){
                    if ($op == 'contains'){
                        $cond .= " and ($field like '%$value%')";
                    } else if ($op == 'beginwith'){
                        $cond .= " and ($field like '$value%')";
                    } else if ($op == 'endwith'){
                        $cond .= " and ($field like '%$value')";
                    } else if ($op == 'equal'){
                        $cond .= " and $field = $value";
                    } else if ($op == 'notequal'){
                        $cond .= " and $field != $value";
                    } else if ($op == 'less'){
                        $cond .= " and $field < $value";
                    } else if ($op == 'lessorequal'){
                        $cond .= " and $field <= $value";
                    } else if ($op == 'greater'){
                        $cond .= " and $field > $value";
                    } else if ($op == 'greaterorequal'){
                        $cond .= " and $field >= $value";
                    } 
                }
            }
	}
        
        $this->db->join('emply', 'pkwt.pkwt_nik = emply.emply_nik', 'left')
                 ->join('dept', 'pkwt.pkwt_dept = dept.dept_id', 'left')
                 ->join('post', 'pkwt.pkwt_post = post.post_id', 'left');
        $this->db->where($cond, NULL, FALSE);
        $this->db->from(self::$table);
        $total  = $this->db->count_all_results();
       
        $this->db->select('pkwt.*, emply.emply_name, dept.dept_name, post.post_name');
        $this->db->join('emply', 'pkwt.pkwt_nik = emply.emply_nik', 'left')
                 ->join('dept', 'pkwt.pkwt_dept = dept.dept_id', 'left')
                 ->join('post', 'pkwt.pkwt_post = post.post_id', 'left');
        $this->db->where($cond, NULL, FALSE);
        $this->db->order_by($sort, $order);
        $this->db->limit($rows, $offset);
        $query  = $this->db->get(self::$table);
       
        $data = array();
        foreach ( $query->result() as $row )
        {
            array_push($data, $row); 
        }
 
        $result = array();
	$result['total'] = $total;
	$result['rows'] = $data;
        
        return json_encode($result);          
    }
    
    public function getPkwtBeforeData($pkwt_id)
    {   
        $this->db->select('pkwt.*, emply.emply_name, dept.dept_name, post.post_name');
        $this->db->join('emply', 'pkwt.pkwt_nik = emply.emply_nik', 'left')
                 ->join('dept', 'pkwt.pkwt_dept = dept.dept_id', 'left')
                 ->join('post', 'pkwt.pkwt_post = post.post_id', 'left');
        $this->db->where('pkwt_id', $pkwt_id);
        $query  = $this->db->get(self::$table);
                   
        $data = array();
        foreach ( $query->result() as $row )
        {
            array_push($data, $row); 
        }       
        return json_encode($data);
    }
    
    public function create()
    {
        $pecah      = explode('-', $this->input->post('pkwt_start',true));
        $th         = $pecah[0];
        $bl         = $pecah[1];
        $tg         = $pecah[2]; 
                
        $jangka = $this->input->post('pkwt_period',true);
        $akhir = date( 'Y-m-d', mktime(0, 0, 0, $bl + $jangka, $tg - 1, $th));
        
        return $this->db->insert(self::$table,array(
            'pkwt_id'=>$this->input->post('pkwt_id',true),
            'pkwt_kk'=>$this->input->post('pkwt_kk',true),
            'pkwt_nik'=>$this->input->post('pkwt_nik',true),
            'pkwt_dept'=>$this->input->post('pkwt_dept',true),
            'pkwt_post'=>$this->input->post('pkwt_post',true),
            'pkwt_status'=>$this->input->post('pkwt_status',true),
            'pkwt_start'=>$this->input->post('pkwt_start',true),
            'pkwt_period'=>$this->input->post('pkwt_period',true),
            'pkwt_end'=>$akhir,
            'pkwt_salary'=>$this->input->post('pkwt_salary',true),
            'pkwt_spc_salary'=>$this->input->post('pkwt_spc_salary',true),
            'pkwt_sign'=>$this->input->post('pkwt_sign',true),
            'pkwt_before'=>$this->input->post('pkwt_before',true),
            'pkwt_process'=>$this->input->post('pkwt_process',true),
            'pkwt_manual'=>$this->input->post('pkwt_manual',true)
        ));
    }
    
    public function update($pkwt_id)
    {
        $pecah      = explode('-', $this->input->post('pkwt_start',true));
        $th         = $pecah[0];
        $bl         = $pecah[1];
        $tg         = $pecah[2]; 
                
        $jangka = $this->input->post('pkwt_period',true);
        $akhir = date( 'Y-m-d', mktime(0, 0, 0, $bl + $jangka, $tg - 1, $th));
        
        $this->db->where('pkwt_id', $pkwt_id);
        return $this->db->update(self::$table,array(
            'pkwt_kk'=>$this->input->post('pkwt_kk',true),
            'pkwt_nik'=>$this->input->post('pkwt_nik',true),
            'pkwt_dept'=>$this->input->post('pkwt_dept',true),
            'pkwt_post'=>$this->input->post('pkwt_post',true),
            'pkwt_status'=>$this->input->post('pkwt_status',true),
            'pkwt_start'=>$this->input->post('pkwt_start',true),
            'pkwt_period'=>$this->input->post('pkwt_period',true),
            'pkwt_end'=>$akhir,
            'pkwt_salary'=>$this->input->post('pkwt_salary',true),
            'pkwt_spc_salary'=>$this->input->post('pkwt_spc_salary',true),
            'pkwt_sign'=>$this->input->post('pkwt_sign',true),
            'pkwt_before'=>$this->input->post('pkwt_before',true),
            'pkwt_process'=>$this->input->post('pkwt_process',true),
            'pkwt_manual'=>$this->input->post('pkwt_manual',true)
        ));
    }
    
    public function updatePkwtBefore()
    {
        $proc = 'Y';
        $pkwt_before = $this->input->post('pkwt_before',true);
        $this->db->where('pkwt_id', $pkwt_before);
        return $this->db->update(self::$table,array(
            'pkwt_process'=>$proc
        ));
    }

    public function delete($pkwt_id)
    {
        return $this->db->delete(self::$table, array('pkwt_id' => $pkwt_id)); 
    }
    
    public function enumField($table, $field)
    {
        $enums = field_enums($table, $field);
        return json_encode($enums);
    }
    
    public function getEmply()
    {
        $this->db->select('emply_nik, emply_name');
        $this->db->order_by('emply_name', 'asc');
        $query  = $this->db->get('emply');
                   
        $data = array();
        foreach ( $query->result() as $row )
        {
            array_push($data, $row); 
        }       
        return json_encode($data);
    }
    
    public function getDept()
    {
        $this->db->select('d1.dept_id AS dept_id, d1.dept_name AS dept_name, d2.dept_name AS dept_parent');
        $this->db->join('dept d2', 'd1.dept_parent = d2.dept_id', 'left');
        $this->db->where('d1.dept_parent != 0');
        $this->db->order_by('dept_parent', 'asc');
        $this->db->order_by('dept_name', 'asc');
        $query  = $this->db->get('dept d1');
                   
        $data = array();
        foreach ( $query->result() as $row )
        {
            array_push($data, $row); 
        }       
        return json_encode($data);
    }
    
    public function getPost()
    {    
        $this->db->order_by('post_name', 'asc');
        $query  = $this->db->get('post');
                   
        $data = array();
        foreach ( $query->result() as $row )
        {
            array_push($data, $row); 
        }       
        return json_encode($data);
    }

    public function getSalary()
    {    
        $query  = $this->db->get('salary');
                   
        $data = array();
        foreach ( $query->result() as $row )
        {
            array_push($data, $row); 
        }       
        return json_encode($data);
    }
    
    public function getPkwtBefore()
    {   
        $this->db->select('p.pkwt_id AS pkwt_id, e.emply_name AS emply_name');
        $this->db->join('emply e', 'p.pkwt_nik = e.emply_nik', 'left');
        //$this->db->where('p.pkwt_before = 0')
        $this->db->where('p.pkwt_process = "N"')
                ->where('p.pkwt_kk != "II"');
        
        $query  = $this->db->get('pkwt p');
                   
        $data = array();
        foreach ( $query->result() as $row )
        {
            array_push($data, $row); 
        }       
        return json_encode($data);
    }
    
    public function get_pkwt_by_id($pkwt_id)
    {
        $this->db->select('emply.*, workday.*, salary.*, post.*, 
                           p.pkwt_id AS pkwt_id, p.pkwt_kk AS pkwt_kk, p.pkwt_sign AS pkwt_sign, p.pkwt_start AS pkwt_start, p.pkwt_end AS pkwt_end,
                           p1.pkwt_id AS id_1, p1.pkwt_sign AS sign_1, p1.pkwt_start AS start_1, p1.pkwt_end AS end_1, p1.pkwt_manual AS manual_1,
                           p2.pkwt_id AS id_2, p2.pkwt_sign AS sign_2, p2.pkwt_start AS start_2, p2.pkwt_end AS end_2, p2.pkwt_manual AS manual_2,
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
        $this->db->where('p.pkwt_id',$pkwt_id);
        return $this->db->get('pkwt p');
    }
    
    
}