<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Departemen_model extends CI_Model
{    
    static $table = 'dept';
    
    public function __construct() {
        parent::__construct();
    }

    public function getJson()
    {
        $page   = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows   = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $offset = ($page-1)*$rows;      
        $sort   = isset($_POST['sort']) ? strval($_POST['sort']) : 'dept_id';
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
        $this->db->join('workday', 'dept.dept_workday = workday.workday_id', 'left')
                    ->join('emply', 'dept.dept_emply = emply.emply_nik', 'left');
        $this->db->where($cond, NULL, FALSE);
        $this->db->from(self::$table);
        $total  = $this->db->count_all_results();

        $this->db->select('dept.*, workday.workday_name, emply.emply_name'); 
        $this->db->join('workday', 'dept.dept_workday = workday.workday_id', 'left')
                    ->join('emply', 'dept.dept_emply = emply.emply_nik', 'left');
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
    
    public function getParent()
    {
        $this->db->select('dept_id, dept_name');
        $this->db->where('dept_parent', 0);
        $this->db->order_by('dept_name', 'asc');
        $query  = $this->db->get(self::$table);
                   
        $data = array();
        foreach ( $query->result() as $row )
        {
            array_push($data, $row); 
        }       
        return json_encode($data);         
    }
    
    public function getHariKerja()
    {
        $this->db->select('workday_id, workday_name');
        $this->db->order_by('workday_name', 'asc');
        $query  = $this->db->get('workday');
                   
        $data = array();
        foreach ( $query->result() as $row )
        {
            array_push($data, $row); 
        }       
        return json_encode($data);
    }

    public function getManager()
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
    
    public function create()
    {
        return $this->db->insert(self::$table,array(
            'dept_parent'=>$this->input->post('dept_parent',true),
            'dept_name'=>$this->input->post('dept_name',true),
            'dept_workday'=>$this->input->post('dept_workday',true),
            'dept_emply'=>$this->input->post('dept_emply')
        ));
    }
    
    public function update($dept_id)
    {
        $this->db->where('dept_id', $dept_id);
        return $this->db->update(self::$table,array(
            'dept_parent'=>$this->input->post('dept_parent',true),
            'dept_name'=>$this->input->post('dept_name',true),
            'dept_workday'=>$this->input->post('dept_workday',true),
            'dept_emply'=>$this->input->post('dept_emply',true)
        ));
    }
   
    public function delete($dept_id)
    {
        return $this->db->delete(self::$table, array('dept_id' => $dept_id)); 
    }
    
}