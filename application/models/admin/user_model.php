<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class User_model extends CI_Model
{    
    static $table = 'user';
    
    public function __construct() {
        parent::__construct();
    }

    public function getJson()
    {
        $page   = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows   = isset($_POST['rows']) ? intval($_POST['rows']) : 50;
        $offset = ($page-1)*$rows;      
        $sort   = isset($_POST['sort']) ? strval($_POST['sort']) : 'user_id';
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
        
        $this->db->where($cond, NULL, FALSE);
        $this->db->from(self::$table);
        $total  = $this->db->count_all_results();
        
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
        $this->load->helper('security');
        $password = do_hash($this->input->post('user_password',true),'md5');
        
        return $this->db->insert(self::$table,array(
            'user_nama'=>$this->input->post('user_nama',true),
            'user_username'=>$this->input->post('user_username',true),
            'user_password'=>$password,
            'user_level'=>$this->input->post('user_level',true)
        ));
    }
    
    public function update($user_id)
    {        
        $this->db->where('user_id', $user_id);
        return $this->db->update(self::$table,array(
            'user_nama'=>$this->input->post('user_nama',true),
            'user_username'=>$this->input->post('user_username',true),
            'user_level'=>$this->input->post('user_level',true)
        ));
    }
    
    public function reset($user_id)
    {
        $this->load->helper('security');
        $password = do_hash($this->input->post('user_password',true),'md5');
        
        $this->db->where('user_id', $user_id);
        return $this->db->update(self::$table,array(
            'user_password'=>$password,            
        ));
    }
   
    public function delete($user_id)
    {
        return $this->db->delete(self::$table, array('user_id' => $user_id)); 
    }
    
}