<?php
/**
* Model for manage Maintenance Data
* @author wiliamdecosta@gmail.com
* @version 07/05/2015 12:14:29
*
*/

class Maintenance extends Abstract_model {
	
	public $table			= "track_maintenance";
	public $pkey			= "mnt_id";
	public $alias			= "maintenance";

	public $fields 			= array(
								'mnt_id' 		    => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Maintenance'),
								'app_id'            => array('type' => 'int', 'nullable' => true, 'unique' => false, 'display' => 'ID Application'),
                                'mnt_desc'          => array('type' => 'str', 'nullable' => false, 'unique' => false, 'display' => 'Deskripsi'),
                                'mnt_by'            => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Diminta Oleh'),
                                'mnt_date'          => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Maintenance'),
                                'mnt_evidence_desc' => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Deskripsi Evidence'),
                                'mnt_created_date'  => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Pembuatan'),
                                'mnt_created_by'    => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Dibuat Oleh'),
                                'mnt_updated_date'  => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Update'),
                                'mnt_updated_by'    => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Diupdate Oleh')
							);

	public $selectClause 	= "maintenance.mnt_id, maintenance.app_id, maintenance.mnt_desc,
	                            maintenance.mnt_by,  to_char(maintenance.mnt_date, 'yyyy-mm-dd') as mnt_date, 
	                            maintenance.mnt_desc,
	                            maintenance.mnt_evidence_desc,
	                            to_char(maintenance.mnt_created_date, 'yyyy-mm-dd') as mnt_created_date, 
	                            maintenance.mnt_created_by,
                                to_char(maintenance.mnt_updated_date, 'yyyy-mm-dd') as mnt_updated_date,
                                maintenance.mnt_updated_by,
									application.app_name";
	public $fromClause 		= "track_maintenance AS maintenance
							        LEFT JOIN track_application AS application ON maintenance.app_id = application.app_id";
	
	public $refs			= array('track_maintenance_evidence' => 'mnt_id',
	                                    'track_maintenance_detail' => 'mnt_id');
	
	public $comboDisplay	= array();

	function __construct() {
		parent::__construct();
	}

	function validate() {
		$ci =& get_instance();
	    $user_name = $ci->session->userdata('user_name');

		if($this->actionType == 'CREATE') {
			//do something
			
			if(isset($this->record['mnt_date']) and empty($this->record['mnt_date'])) {
			    $this->record['mnt_date'] = null; 
			}
			
			$this->record['mnt_created_date'] = date('Y-m-d');
            $this->record['mnt_created_by'] = $user_name;
            $this->record['mnt_updated_date'] = date('Y-m-d');
            $this->record['mnt_updated_by'] = $user_name;
		}else {
		    
		    if(isset($this->record['mnt_date']) and empty($this->record['mnt_date'])) {
			    $this->record['mnt_date'] = null; 
			}
			
			//do something
			$this->record['mnt_updated_date'] = date('Y-m-d');
            $this->record['mnt_updated_by'] = $user_name;
		}
		return true;
	}
	
}

/* End of file maintenance.php */
/* Location: ./application/models/maintenance.php */