<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Karyawan_model extends CI_Model
{    
    static $table = 'emply';
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('database');
    }

    public function getJson()
    {
        $page   = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows   = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $offset = ($page-1)*$rows;      
        $sort   = isset($_POST['sort']) ? strval($_POST['sort']) : 'emply_nik';
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
        
        $this->db->join('bank', 'emply.emply_bank = bank.bank_id', 'left');
        $this->db->where($cond, NULL, FALSE);
        $this->db->from(self::$table);
        $total  = $this->db->count_all_results();
        
        $this->db->select('emply.*, bank.*');
        $this->db->join('bank', 'emply.emply_bank = bank.bank_id', 'left');
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
	$result["total"] = $total;
	$result['rows'] = $data;
        
        return json_encode($result);          
    }
    
    public function create()
    {
        return $this->db->insert(self::$table,array(
            'emply_nik'=>$this->input->post('emply_nik',true),    
            'emply_ac'=>$this->input->post('emply_ac',true),
            'emply_name'=>$this->input->post('emply_name',true),
            'emply_sex'=>$this->input->post('emply_sex',true),
            'emply_bop'=>$this->input->post('emply_bop',true),
            'emply_bod'=>$this->input->post('emply_bod',true),
            'emply_relig'=>$this->input->post('emply_relig',true),
            'emply_marital'=>$this->input->post('emply_marital',true),
            'emply_ktp'=>$this->input->post('emply_ktp',true),
            'emply_add'=>$this->input->post('emply_add',true),
            'emply_city'=>$this->input->post('emply_city',true),
            'emply_zip'=>$this->input->post('emply_zip',true),
            'emply_phone'=>$this->input->post('emply_phone',true),
            'emply_cell'=>$this->input->post('emply_cell',true),
            'emply_start'=>$this->input->post('emply_start',true),
            'emply_status'=>$this->input->post('emply_status',true),
            'emply_bank'=>$this->input->post('emply_bank',true),
            'emply_rek'=>$this->input->post('emply_rek',true),
            'emply_active'=>$this->input->post('emply_active',true),
            'emply_end'=>$this->input->post('emply_end',true)
        ));
    }
    
    public function update($emply_nik)
    {
        $this->db->where('emply_nik', $emply_nik);
        return $this->db->update(self::$table,array(
            'emply_nik'=>$this->input->post('emply_nik',true),    
            'emply_ac'=>$this->input->post('emply_ac',true),
            'emply_name'=>$this->input->post('emply_name',true),
            'emply_sex'=>$this->input->post('emply_sex',true),
            'emply_bop'=>$this->input->post('emply_bop',true),
            'emply_bod'=>$this->input->post('emply_bod',true),
            'emply_relig'=>$this->input->post('emply_relig',true),
            'emply_marital'=>$this->input->post('emply_marital',true),
            'emply_ktp'=>$this->input->post('emply_ktp',true),
            'emply_add'=>$this->input->post('emply_add',true),
            'emply_city'=>$this->input->post('emply_city',true),
            'emply_zip'=>$this->input->post('emply_zip',true),
            'emply_phone'=>$this->input->post('emply_phone',true),
            'emply_cell'=>$this->input->post('emply_cell',true),
            'emply_start'=>$this->input->post('emply_start',true),
            'emply_status'=>$this->input->post('emply_status',true),
            'emply_bank'=>$this->input->post('emply_bank',true),
            'emply_rek'=>$this->input->post('emply_rek',true),
            'emply_active'=>$this->input->post('emply_active',true),
            'emply_end'=>$this->input->post('emply_end',true)
        ));
    }
   
    public function delete($emply_nik)
    {
        return $this->db->delete(self::$table, array('emply_nik' => $emply_nik)); 
    }
    
    public function enumField($table, $field)
    {
        $enums = field_enums($table, $field);
        return json_encode($enums);
    }
    
    public function getBank()
    {
        $query  = $this->db->get('bank');
                   
        $data = array();
        foreach ( $query->result() as $row )
        {
            array_push($data, $row); 
        }       
        return json_encode($data);
    }
    
}