<?php
/**
* Model for manage Permission Data
* @author wiliamdecosta@gmail.com
* @version 07/05/2015 12:11:38
*
*/

class Permission extends Abstract_model {
	
	public $table			= "core_permission";
	public $pkey			= "permission_id";
	public $alias			= "permission";

	public $fields 			= array(
								'permission_id' 		=> array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Permission'),
								'permission_name'	    => array('nullable' => false, 'type' => 'str', 'unique' => true, 'display' => 'Nama Modul'),
								'permission_desc'	    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Keterangan Modul'),
								'permission_module'	    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Modul Aplikasi')	
							);

	public $selectClause 	= "permission.*";
	public $fromClause 		= "core_permission AS permission";
	public $joinClause 		= array();
	public $refs			= array('core_user_permission' => 'permission_id',
                                    'core_role_permission' => 'permission_id');
	
	public $comboDisplay	= array('permission_name');

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

/* End of file permission.php */
/* Location: ./application/models/base/permission.php */