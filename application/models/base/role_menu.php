<?php
/**
* Model for manage Role_permission Data
* @author wiliamdecosta@gmail.com
* @version 07/05/2015 16:18:15
*
*/

class Role_menu extends Abstract_model {
	
	public $table			= "core_role_menu";
	public $pkey			= "rolemenu_id";
	public $alias			= "role_menu";

	public $fields 		    = array('rolemenu_id'               => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Menu Grup'),
                                    'role_id'                   => array('type' => 'int', 'nullable' => false, 'unique' => false, 'display' => 'ID Grup'),
                                    'menu_id'                   => array('type' => 'int', 'nullable' => false, 'unique' => false, 'display' => 'ID Menu'),
                                    'rolemenu_status'           => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Status'),
                                    'rolemenu_creation_date'    => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Pembuatan'),
                                    'rolemenu_creation_by'      => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Dibuat Oleh'),
                                    'rolemenu_updated_date'     => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Update'),
                                    'rolemenu_updated_by'       => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Diupdate Oleh')
                           );

	public $selectClause 	= "role_menu.rolemenu_id, to_char(role_menu.rolemenu_creation_date, 'yyyy-mm-dd') AS rolemenu_creation_date, 
                                    to_char(role_menu.rolemenu_updated_date, 'yyyy-mm-dd') AS rolemenu_updated_date,
                                    role_menu.role_id, menu.menu_id, role_menu.rolemenu_status,
									role.role_name, role.role_status,
									menu.menu_code, menu.menu_level, menu.menu_description, menu.menu_is_active, menu.menu_listing_no, menu.menu_path";
	public $fromClause 		= "core_menu AS menu
                                    LEFT JOIN core_role_menu AS role_menu 
        							    ON role_menu.menu_id = menu.menu_id %s
        							LEFT JOIN core_role AS role 
        							    ON role_menu.role_id = role.role_id";
	public $joinClause 		= array();
	public $refs			= array();
	
	public $comboDisplay	= array('role_menu.role_id', 'role_menu.menu_id');
	
	public $role_id         = '';

	function __construct() {
		parent::__construct();
	}
    
    public function setRoleId($role_id) {
        if (!empty($role_id)){
            $this->role_id = (int) $role_id;
            $this->fromClause = sprintf($this->fromClause, 'AND role_menu.role_id = '.$this->role_id);
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
	    $userInfo = $this->session->userdata;
	    
		if($this->actionType == 'CREATE') {
			// TODO : Write your validation for CREATE here
            $this->record['rolemenu_creation_date'] = date('Y-m-d');
            $this->record['rolemenu_creation_by'] = $userInfo['user_name'];
            
            $this->record['rolemenu_updated_date'] = date('Y-m-d');
            $this->record['rolemenu_updated_by'] = $userInfo['user_name'];
		}else {
			// TODO : Write your validation for UPDATE here
            $this->record['rolemenu_updated_date'] = date('Y-m-d');
            $this->record['rolemenu_updated_by'] = $userInfo['user_name'];
		}
		return true;
	}
	
	
	public function get($id) {
        $whereClause = "WHERE rolemenu_id = ?";
        
	    $sql = "SELECT a.*, b.menu_code, b.menu_level FROM ".$this->table. " a ";
	    $sql .= " LEFT JOIN core_menu b ON a.menu_id = b.menu_id ";
	    $sql .= $whereClause;
	    
        $query = $this->db->query($sql, array($id));
        $item = $query->row_array();
        
        if (!is_array($item)){
            throw new Exception($this->db->_error_message());
        }
        
        if ($raiseExceptionOnEmpty === true){
            if (empty($item['rolemenu_id'])){
                throw new Exception("ID (".$rolemenu_id.") tidak ada dalam database. Anda atau user lain mungkin sudah menghapus data tersebut");
            }
        }
        
        $this->load->model('base/menu');
		$tMenu = $this->menu;
		
        if($tMenu->isRefferenced($item['menu_id'])) {
            $item['font_style'] = 'bold';
        }else {
            $item['font_style'] = '';
        }
        
        if($item['menu_level'] == 1) {
            $item['font_color'] = '#800000';
        }else {
            $item['font_color'] = '#000000';
        }
                
        return $item;
	}
	
	
}

/* End of file role_menu.php */
/* Location: ./application/models/base/role_menu.php */