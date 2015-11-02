<?php
/**
* Model for manage Role Data
* @author wiliamdecosta@gmail.com
* @version 07/05/2015 12:10:38
*
*/

class Role extends Abstract_model {
	
	public $table			= "core_role";
	public $pkey			= "role_id";
	public $alias			= "role";

	public $fields 			= array(
								'role_id' 		=> array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Group'),
								'role_name'	    => array('nullable' => false, 'type' => 'str', 'unique' => true, 'display' => 'Nama Group'),
								'role_status'	=> array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Status Group')
							);

	public $selectClause 	= "role.*";
	public $fromClause 		= "core_role AS role";
	public $joinClause 		= array();
	public $refs			= array('core_user_role' => 'role_id', 
	                                'core_role_permission' => 'role_id',
	                                'core_role_menu' => 'role_id');
	
	public $comboDisplay	= array('role_name');

	function __construct() {
		parent::__construct();
	}

	function validate() {
		if($this->actionType == 'CREATE') {
			//do something
		}else {
			//do something
		}
		return true;
	}
}

/* End of file role.php */
/* Location: ./application/models/base/role.php */