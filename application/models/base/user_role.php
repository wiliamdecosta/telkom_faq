<?php
/**
* Model for manage User_role Data
* @author wiliamdecosta@gmail.com
* @version 07/05/2015 12:08:30
*
*/

class User_role extends Abstract_model {
	
	public $table			= "core_user_role";
	public $pkey			= "";
	public $alias			= "user_role";

	public $fields 			= array(
								'user_id' 		    => array('type' => 'int', 'nullable' => false, 'unique' => false, 'display' => 'ID User'),
								'role_id' 	        => array('type' => 'int', 'nullable' => false, 'unique' => false, 'display' => 'ID Group'),
								'main_role' 	    => array('type' => 'int', 'nullable' => true, 'unique' => false, 'display' => 'Group Utama')
							);

	public $selectClause 	= "user_role.user_id || '.' || user_role.role_id AS user_role_id,
                                   user_role.*,
								   core_user.user_name, core_user.user_email, 
								   core_user.user_realname, core_user.user_status,
								   core_role.role_name, core_role.role_status";
	public $fromClause 		= "core_user_role AS user_role
							    LEFT JOIN core_user ON user_role.user_id = core_user.user_id
							    LEFT JOIN core_role ON user_role.role_id = core_role.role_id";
							    
	public $joinClause 		= array();
	public $refs			= array();
	
	public $comboDisplay	= array('user_role.user_id', 'user_role.role_id');
	
	public $role_id         = '';

	function __construct() {
		parent::__construct();
	}
    
    function validate() {
		if($this->actionType == 'CREATE') {
			//do something
			 $this->record['main_role'] = 0;
		}else {
			//do something
			$keys = explode('.', $this->item['user_role_id']);
            
            if (empty($keys[0]) || empty($keys[1])) throw new Exception('Invalid User Role ID');
            
            $this->record['user_id'] = $keys[0];
            $this->record['old_role_id'] = $keys[1];
		}
		
		$userRole = $this->get($this->record['user_id'], $this->record['role_id']);
        if (!empty($userRole['user_id'])) throw new Exception('User sudah terdaftar pada grup tersebut (ID: '.$this->record['role_id'].')');


		return true;
	}
	
	public function &get($user_id, $role_id, $raiseExceptionOnEmpty = false){
        $whereClause = "WHERE user_role.user_id = ?  AND user_role.role_id = ?";
        
        $sql = "SELECT ".$this->selectClause." FROM ".$this->fromClause." ".$whereClause;
        $query = $this->db->query($sql, array($user_id, $role_id));
        $item = $query->row_array();
        
        if (!is_array($item)){
            throw new Exception($this->db->_error_message());
        }
        
        if ($raiseExceptionOnEmpty === true){
            if (empty($item['user_id'])){
                throw new Exception("ID (".$role_id.'.'.$permission_id.") tidak ada dalam database. Anda atau user lain mungkin sudah menghapus data tersebut");
            }
        }

        return $item;
    }
    
    
    public function update() {
		
		try {
			$this->validate();
			
			$sql = "UPDATE core_user_role SET role_id = ? WHERE user_id = ? AND role_id = ?";
			$query = $this->db->query($sql, array($this->record['role_id'], $this->record['user_id'], $this->record['old_role_id']));
			
			$this->afterWrite();
		}catch(Exception $e) {
			throw $e;
		}

		return true;
	}
	
    public function remove($user_id, $role_id){
        
        $item = $this->get($user_id, $role_id, true);        
        if ($item['main_role'] == 1) throw new Exception('Grup tidak bisa dihapus karena merupakan Grup Utama');
        
        $sql = "DELETE FROM core_user_role WHERE user_id = ".$user_id."  AND role_id = ".$role_id;
        $query = $this->db->query($sql);
                
        return true;
    }
}

/* End of file user_role.php */
/* Location: ./application/models/base/user_role.php */