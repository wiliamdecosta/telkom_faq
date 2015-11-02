<?php
/**
* Model for manage User Data
* @author wiliamdecosta@gmail.com
* @version 07/05/2015 12:09:29
*
*/

class User extends Abstract_model {
	
	public $table			= "core_user";
	public $pkey			= "user_id";
	public $alias			= "core_user";

	public $fields 			= array(
								'user_id' 		    => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID User'),
								'user_name'	        => array('nullable' => false, 'type' => 'str', 'unique' => true, 'display' => 'Nama User'),
								'user_password'	    => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Password'),
								'user_email'	    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Email'),
								'user_realname'	    => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Nama Lengkap'),
								'user_status'	    => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Status User')
							);

	public $selectClause 	= "core_user.user_id, core_user.user_name, core_user.user_email, 
                                core_user.user_realname, core_user.user_status, core_user_role.role_id, core_role.role_name";
	public $fromClause 		= "core_user as core_user
                                LEFT JOIN core_user_role ON core_user_role.user_id = core_user.user_id AND core_user_role.main_role = 1
                                LEFT JOIN core_role ON core_role.role_id = core_user_role.role_id";
	public $joinClause 		= array();
	public $refs			= array('core_user_role' => 'user_id', 
	                                'core_role_permission' => 'user_id');
	
	public $comboDisplay	= array('user_name');

	function __construct() {
		parent::__construct();
	}

	function validate() {
		if($this->actionType == 'CREATE') {
			$this->record['user_name'] = trim($this->record['user_name']);
            $this->record['user_realname'] = trim($this->record['user_realname']);
            
            if (empty($this->record['user_name'])) throw new Exception('Nama User tidak boleh kosong');
            if (empty($this->record['user_realname'])) throw new Exception('Nama Lengkap tidak boleh kosong');
            
            if (trim($this->record['user_password']) == '') throw new Exception('Password tidak boleh kosong');
            
            if (strlen($this->record['user_password']) < 5) throw new Exception('Panjang Password minimal 5 karakter');
            
            $this->record['user_password'] = md5($this->record['user_password']);
            
            if (empty($this->item['role_id'])){
                throw new Exception('Grup tidak boleh kosong');
            }			
		}else {
			//do something
			if (isset($this->record['user_name'])){
                $this->record['user_name'] = trim($this->record['user_name']);
                if (empty($this->record['user_name'])) throw new Exception('Nama User tidak boleh kosong');
            }
            
            if (isset($this->record['user_realname'])){
                $this->record['user_realname'] = trim($this->record['user_realname']);
                if (empty($this->record['user_realname'])) throw new Exception('Nama Lengkap tidak boleh kosong');
            }

            if (isset($this->record['user_password'])){
                if (trim($this->record['user_password']) == '') throw new Exception('Password tidak boleh kosong');
                if (strlen($this->record['user_password']) < 5) throw new Exception('Panjang Password minimal 5 karakter');
                
                $this->record['user_password'] = md5($this->record['user_password']);
            }
		}
		return true;
	}
	
	public function create() {
			
		try {
			$this->validate();
			
			$this->db->set( $this->record );
			$this->db->insert( $this->table );
			
			$this->record = $this->get($this->db->insert_id());
			
			$this->afterWrite();
		}catch(Exception $e) {
			throw $e;
		}

		return $this->db->insert_id();
	}
	
	
	public function afterWrite(){
	    
        if (isset($this->item['role_id'])){
            $this->setMainRole($this->record['user_id'], $this->item['role_id']);
        }
    }

    public function setMainRole($user_id, $role_id){
        $sql = "UPDATE core_user_role SET main_role = 0 WHERE user_id = ? AND main_role = 1";
        $result = $this->db->query($sql, array($user_id));
        
        $existItem = $this->getUserRole($user_id, $role_id);
        if(count($existItem) > 0) { //update core_user_role
            $this->db->set(array('user_id' => $user_id, 
                                                   'role_id' => $role_id,
                                                   'main_role' => 1));
    		$this->db->where('user_id', $user_id);
    		$this->db->where('role_id', $role_id);
    		$this->db->update( 'core_user_role' );
    		
        }else {  //insert core_user_role
            
            $this->db->set(array('user_id' => $user_id, 
                                                   'role_id' => $role_id,
                                                   'main_role' => 1));
    		$this->db->insert( 'core_user_role' );
        }
        return true;
    }
    
    
    public function addUserRole($user_id, $role_id){
        $item = $this->getUserRole($user_id, $role_id);

        if (!empty($item['user_id'])) return true;

        $sql = "INSERT INTO core_user_role (user_id, role_id, main_role) VALUES (?, ?, ?)";
        $query = $this->db->query($sql, array($user_id, $role_id, 0));
        
        $query->free_result();
        
        return true;
    }

    public function getUserRole($user_id, $role_id){
        $sql = "select user_id, role_id, main_role 
                    from core_user_role
                    where user_id = ? AND role_id = ?";
        
        $query = $this->db->query($sql, array($user_id, $role_id));
        $item = $query->row_array();
        
        $query->free_result();
        
        return $item;
    }
	
	 /* Remove record by id */    
    public function remove($id){
        /*if ($this->isRefferenced($id)){
            throw new Exception('ID user '.$id.' tidak bisa di hapus karena sudah di referensi oleh data lain');
        }*/

        $sql = "DELETE FROM core_user_permission WHERE ".$this->pkey." = ?";
        $query = $this->db->query($sql, array($id));
       	
		
		$sql = "DELETE FROM core_user_role WHERE ".$this->pkey." = ?";
        $query = $this->db->query($sql, array($id));


        $sql = "DELETE FROM ".$this->table." WHERE ".$this->pkey." = ?";
        $query = $this->db->query($sql, array($id));
                
        return true;
    }    
    
}

/* End of file user.php */
/* Location: ./application/models/base/user.php */