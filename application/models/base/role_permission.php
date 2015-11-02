<?php
/**
* Model for manage Role_permission Data
* @author wiliamdecosta@gmail.com
* @version 07/05/2015 12:10:06
*
*/

class Role_permission extends Abstract_model {
	
	public $table			= "core_role_permission";
	public $pkey			= "";
	public $alias			= "role_permission";

	public $fields 			= array(
								'role_id' 		    => array('type' => 'int', 'nullable' => false, 'unique' => false, 'display' => 'ID Group'),
								'permission_id' 	=> array('type' => 'int', 'nullable' => false, 'unique' => false, 'display' => 'ID Permission'),
								'permission_level' 	=> array('type' => 'int', 'nullable' => true, 'unique' => false, 'display' => 'Level Permission')
							);

	public $selectClause 	= "role_permission.role_id || '.' || role_permission.permission_id AS role_permission_id,
                                    role_permission.role_id, permission.permission_id, role_permission.permission_level,
									role.role_name, role.role_status,
									permission.permission_name, permission.permission_desc, permission.permission_module";
	public $fromClause 		= "core_permission AS permission
                                    LEFT JOIN core_role_permission AS role_permission 
							            ON role_permission.permission_id = permission.permission_id %s
							        LEFT JOIN core_role AS role 
							            ON role_permission.role_id = role.role_id";
	public $joinClause 		= array();
	public $refs			= array();
	
	public $comboDisplay	= array('role_permission.role_id', 'permission.permission_id');
	
	public $role_id         = '';

	function __construct() {
		parent::__construct();
	}
    
    public function setRoleId($role_id) {
        if (!empty($role_id)){
            $this->role_id = (int) $role_id;
            $this->fromClause = sprintf($this->fromClause, 'AND role_permission.role_id = '.$this->role_id);
        }else{
            $this->fromClause = sprintf($this->fromClause, '');
        }

    }
    
    public function countAll(){
        $whereClause = $this->getCriteriaSQL();

        $sql = "SELECT COUNT(1) as total FROM ". $this->fromClause ." ".$whereClause;
        $query = $this->db->query($sql);
		$row = $query->row_array();

		$countitems = $row['total'];
		$query->free_result();
		
		return $countitems;
    }
    
	function validate() {
		if($this->actionType == 'CREATE') {
			//do something
		}else {
			//do something
		}
		return true;
	}
	
	
	public function &get($role_id, $permission_id, $raiseExceptionOnEmpty = false){
        $whereClause = "WHERE role_permission.role_id = ?  AND role_permission.permission_id = ?";
        
        $sql = "SELECT ".$this->selectClause." FROM ".$this->fromClause." ".$whereClause;
        $query = $this->db->query($sql, array($role_id, $permission_id));
        $item = $query->row_array();
        
        if (!is_array($item)){
            throw new Exception($this->db->_error_message());
        }
        
        if ($raiseExceptionOnEmpty === true){
            if (empty($item['role_id'])){
                throw new Exception("ID (".$role_id.'.'.$permission_id.") tidak ada dalam database. Anda atau user lain mungkin sudah menghapus data tersebut");
            }
        }

        return $item;
    }
    
    
    public function remove($role_id, $permission_id){
        $sql = "DELETE FROM core_role_permission WHERE role_id = ".$role_id."  AND permission_id = ".$permission_id;

        $query = $this->db->query($sql);
        $query->free_result();
        
        return true;
    }
    
    
    public function create() {
			
		try {
			$this->validate();
			
			$this->db->set( $this->record );
			$this->db->insert( $this->table );
			
			$this->record['role_permission_id'] = $this->record['role_id'].'.'.$this->record['permission_id'];
			
			$this->afterWrite();
		}catch(Exception $e) {
			throw $e;
		}

		return true;
	}
	
	public function getRolePermission($role_id, $permission_id){
        $sql = "select * from core_role_permission where role_id = ? AND permission_id = ?";
        
        $query = $this->db->query($sql, array($role_id, $permission_id));
        $item = $query->row_array();
        
        $query->free_result();
        
        return $item;
    }
    
	public function update() {
		
		try {
			$this->validate();
			if ($this->record['permission_level'] == '' || $this->record['permission_level'] == null){
                $this->remove($this->record['role_id'], $this->record['permission_id']);
                $this->record['role_permission_id'] = '';
            }else {
                
                
                $existItem = $this->getRolePermission($this->record['role_id'], $this->record['permission_id']);
                if(count($existItem) > 0) { //update core_user_role
                    
                    $this->db->set($this->record);
    			    $this->db->where('role_id', $this->record['role_id']);
    			    $this->db->where('permission_id', $this->record['permission_id']);
    			    $this->db->update( $this->table );
    			    
    			    $this->record['role_permission_id'] = $this->record['role_id'].'.'.$this->record['permission_id'];
                    $this->afterWrite();
                    
                }else {
                    $this->db->set( $this->record );
			        $this->db->insert( $this->table );
			
			        $this->record['role_permission_id'] = $this->record['role_id'].'.'.$this->record['permission_id'];
			        $this->afterWrite();
                }
            
            }
			
		}catch(Exception $e) {
			throw $e;
		}

		return true;
	}
	
}

/* End of file role_permission.php */
/* Location: ./application/models/base/role_permission.php */