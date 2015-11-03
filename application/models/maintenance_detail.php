<?php
/**
* Model for manage Maintenance_detail Data
* @author wiliamdecosta@gmail.com
* @version 29/10/2015 17:38:37
*
*/

class Maintenance_detail extends Abstract_model {
	
	public $table			= "track_maintenance_detail";
	public $pkey			= "mnt_det_id";
	public $alias			= "maintenance_detail";

	public $fields 			= array(
								'mnt_det_id' 		    => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Maintenance_detail'),
								'mnt_id'                => array('type' => 'int', 'nullable' => true, 'unique' => false, 'display' => 'ID Maintenance'),
                                'mnt_det_pic'           => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'PIC'),
                                'mnt_det_desc'           => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Deskripsi'),
                                'mnt_det_start_date'    => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Start Date'),
                                'mnt_det_due_date'      => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Due Date'),
                                'mnt_det_status'        => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Status Pengerjaan'),
                                'mnt_det_created_date'  => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Pembuatan'),
                                'mnt_det_created_by'    => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Dibuat Oleh'),
                                'mnt_det_updated_date'  => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Update'),
                                'mnt_det_updated_by'    => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Diupdate Oleh')	
							);

	public $selectClause 	= "maintenance_detail.mnt_det_id, maintenance_detail.mnt_id, maintenance_detail.mnt_det_pic, maintenance_detail.mnt_det_desc,
	                                to_char(maintenance_detail.mnt_det_start_date, 'yyyy-mm-dd') as mnt_det_start_date, 
	                                to_char(maintenance_detail.mnt_det_due_date, 'yyyy-mm-dd') as mnt_det_due_date, 
	                                maintenance_detail.mnt_det_status,
	                                to_char(maintenance_detail.mnt_det_created_date, 'yyyy-mm-dd') as mnt_det_created_date, 
	                                maintenance_detail.mnt_det_created_by,
                                to_char(maintenance_detail.mnt_det_updated_date, 'yyyy-mm-dd') as mnt_det_updated_date,
                                    maintenance_detail.mnt_det_updated_by,
									maintenance.app_id, maintenance.mnt_desc";
	public $fromClause 		= "track_maintenance_detail AS maintenance_detail
							        LEFT JOIN track_maintenance AS maintenance ON maintenance_detail.mnt_id = maintenance.mnt_id";
	
	public $refs			= array();
	
	public $comboDisplay	= array();

	function __construct() {
		parent::__construct();
	}

	function validate() {
		$ci =& get_instance();
	    $user_name = $ci->session->userdata('user_name');

		if($this->actionType == 'CREATE') {
			//do something
			
			if(isset($this->record['mnt_det_start_date']) and empty($this->record['mnt_det_start_date'])) {
			    $this->record['mnt_det_start_date'] = null; 
			}
			
			if(isset($this->record['mnt_det_due_date']) and empty($this->record['mnt_det_due_date'])) {
			    $this->record['mnt_det_due_date'] = null; 
			}
			
			$this->record['mnt_det_created_date'] = date('Y-m-d');
            $this->record['mnt_det_created_by'] = $user_name;
            $this->record['mnt_det_updated_date'] = date('Y-m-d');
            $this->record['mnt_det_updated_by'] = $user_name;
		}else {
			//do something
			
			if(isset($this->record['mnt_det_start_date']) and empty($this->record['mnt_det_start_date'])) {
			    $this->record['mnt_det_start_date'] = null; 
			}
			
			if(isset($this->record['mnt_det_due_date']) and empty($this->record['mnt_det_due_date'])) {
			    $this->record['mnt_det_due_date'] = null; 
			}
			
			$this->record['mnt_det_updated_date'] = date('Y-m-d');
            $this->record['mnt_det_updated_by'] = $user_name;
		}
		return true;
	}
	
}

/* End of file maintenance_detail.php */
/* Location: ./application/models/maintenance_detail.php */