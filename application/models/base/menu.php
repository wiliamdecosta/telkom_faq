<?php
/**
* Model for manage Menu Data
* @author wiliamdecosta@gmail.com
* @version 07/05/2015 12:13:42
*
*/

class Menu extends Abstract_model {

	public $table			= "core_menu";
	public $pkey			= "menu_id";
	public $alias			= "menu";

	public $fields 			= array(
    							   'menu_id' => array('pkey' => true, 'type' => 'int', 'nullable' => false, 'unique' => true, 'display' => 'ID Menu'),
                                   'menu_pid' => array('type' => 'int', 'nullable' => true, 'unique' => false, 'display' => 'Menu PID'),
                                   'menu_code' => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Kode Menu'),
                                   'menu_file_name' => array('type' => 'str', 'nullable' => true, 'unique' => false,  'display' => 'Nama File'),
                                   'menu_listing_no' => array('type' => 'float', 'nullable' => true, 'unique' => false, 'display' => 'No Urut'),
                                   'menu_is_active' => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Aktif'),
                                   'menu_description' => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Keterangan'),
                                   'menu_creation_date' => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Buat'),
                                   'menu_creation_by' => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Dibuat Oleh'),
                                   'menu_updated_date' => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Update'),
                                   'menu_updated_by' => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Diupdate Oleh'),
                                   'menu_level' => array('type' => 'int', 'nullable' => true, 'unique' => false, 'display' => 'Level'),
                                   'menu_path' => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Path')
							);

	public $selectClauseGet = "menu.*";
    public $fromClauseGet = "core_menu AS menu";

    public $selectClause = "menu_id, NVL (menu_pid, 0) menu_pid, menu_code, menu_file_name, menu_listing_no, menu_is_active,  menu_description, menu_creation_date,
                                    menu_creation_by, menu_updated_date, menu_updated_by, menu_level, menu_path";

    public $fromClause = "(SELECT b.menu_id, b.menu_pid, b.menu_code, NVL(b.menu_file_name, '-') as menu_file_name, b.menu_listing_no, b.menu_is_active, b.menu_description, b.menu_creation_date,
                                b.menu_creation_by, b.menu_updated_date, b.menu_updated_by, b.menu_level, b.menu_path
                                FROM core_menu AS b
                                START WITH menu_pid IS NULL CONNECT BY PRIOR b.menu_id = b.menu_pid ORDER SIBLINGS BY NVL(b.menu_listing_no, 9999))";


	public $joinClause 		= array();
	public $refs			= array('core_menu' =>'menu_pid');

	public $comboDisplay	= array('menu_code');

	function __construct() {
		parent::__construct();
	}

	function validate(){
        $userInfo = $this->session->userdata;

        if ($this->actionType == 'CREATE'){
            // TODO : Write your validation for CREATE here
            $this->record['menu_creation_date'] = date('Y-m-d');
            $this->record['menu_creation_by'] = $userInfo['user_name'];

            $this->record['menu_updated_date'] = date('Y-m-d');
            $this->record['menu_updated_by'] = $userInfo['user_name'];
            
            /*Menentukan Level Menu*/
            if(!isset($this->record['menu_pid']) || empty($this->record['menu_pid'])) { //pid kosong
                $this->record['menu_level'] = 1;
                $this->record['menu_pid'] = null;
            }else {
                $itemParent = $this->get($this->record['menu_pid'],true);
                $this->record['menu_level'] = $itemParent['menu_level'] + 1;
            }

            /*Menentukan Path Menu*/
            if(!isset($this->record['menu_pid']) || empty($this->record['menu_pid'])) { //pid kosong
                $this->record['menu_pid'] = null;
            }else {
                $sql = "SELECT COUNT(1) as total_child FROM core_menu WHERE menu_pid = ?";
                $query = $this->db->query($sql, array($this->record['menu_pid']));

		        $row = $query->row_array();
                $count_child = $row['total_child'];

                if(empty($count_child)) {
                    $count_child = 0;
                }

                $itemParent = $this->get($this->record['menu_pid'],true);
                $thepath = $itemParent['menu_path'].".".($count_child+1);

                $this->record['menu_path'] = $thepath;
            }


        }else if ($this->actionType == 'UPDATE'){
            // TODO : Write your validation for UPDATE here
            $this->record['menu_updated_date'] = date('Y-m-d');
            $this->record['menu_updated_by'] = $userInfo['user_name'];
        }

        return true;
    }
    
    public function create() {
		$this->db->_protect_identifiers = false;	
		try {
			$this->validate();
			
			$this->db->set( $this->record );
			$this->db->insert( $this->table );
			
			$insert_id = $this->db->insert_id();
            
			if(empty($this->record['menu_pid'])) {
			    $this->db->set( array('menu_path' => $insert_id) );
			    $this->db->where($this->pkey, $insert_id);
			    $this->db->update( $this->table );
			}
			
			$this->afterWrite();
		}catch(Exception $e) {
			throw $e;
		}

		return $insert_id;
	}
     
	public function &get($id, $raiseExceptionOnEmpty = false){
        $whereClause = "WHERE ".$this->getAlias().$this->pkey." = ?";

        $sql = "SELECT ".$this->selectClauseGet." FROM ".$this->fromClauseGet." ".$whereClause;
        $query = $this->db->query($sql, array($id));
        $item = $query->row_array();

        if (!is_array($item)){
            throw new Exception($this->db->_error_message());
        }

        if ($raiseExceptionOnEmpty === true){
            if (empty($item[$this->pkey])){
                throw new Exception("ID (".$this->pkey.") ".$id." tidak ada dalam database. Anda atau user lain mungkin sudah menghapus data tersebut");
            }
        }

        return $item;
    }
    
}

/* End of file menu.php */
/* Location: ./application/models/base/menu.php */