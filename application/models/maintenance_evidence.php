<?php
/**
* Model for manage Maintenance_evidence Data
* @author wiliamdecosta@gmail.com
* @version 29/10/2015 17:17:16
*
*/

class Maintenance_evidence extends Abstract_model {
	
	public $table			= "track_maintenance_evidence";
	public $pkey			= "mnt_evd_id";
	public $alias			= "maintenance_evidence";

	public $fields 			= array(
								'mnt_evd_id' 		    => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Maintenance_evidence'),
								'mnt_id'            => array('type' => 'int', 'nullable' => true, 'unique' => false, 'display' => 'ID Maintenance'),
                                'mnt_evd_file'          => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'File'),
                                'mnt_evd_desc'          => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Deskripsi'),
                                'mnt_evd_created_date'  => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Pembuatan'),
                                'mnt_evd_created_by'    => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Dibuat Oleh'),
                                'mnt_evd_updated_date'  => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Update'),
                                'mnt_evd_updated_by'    => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Diupdate Oleh')
							);

	public $selectClause 	= "maintenance_evidence.*,
	                                 to_char(maintenance_evidence.mnt_evd_created_date, 'yyyy-mm-dd') as mnt_evd_created_date, 
                                to_char(maintenance_evidence.mnt_evd_updated_date, 'yyyy-mm-dd') as mnt_evd_updated_date,
									 maintenance.app_id, maintenance.mnt_desc";
	public $fromClause 		= "track_maintenance_evidence AS maintenance_evidence
							    LEFT JOIN track_maintenance AS maintenance ON maintenance_evidence.mnt_id = maintenance.mnt_id";
	
	public $refs			= array();
	
	public $comboDisplay	= array();
	
	public $fileLocation  = 'application/third_party/upload/maintenance_evidence_attachments/';

	function __construct() {
		parent::__construct();
	}

	function validate() {
		$ci =& get_instance();
	    $user_name = $ci->session->userdata('user_name');

		if($this->actionType == 'CREATE') {
			//do something
			
			$this->record['mnt_evd_created_date'] = date('Y-m-d');
            $this->record['mnt_evd_created_by'] = $user_name;
            $this->record['mnt_evd_updated_date'] = date('Y-m-d');
            $this->record['mnt_evd_updated_by'] = $user_name;
		}else {
			//do something
			$this->record['mnt_evd_updated_date'] = date('Y-m-d');
            $this->record['mnt_evd_updated_by'] = $user_name;
		}
		return true;
	}
	
}

/* End of file maintenance_evidence.php */
/* Location: ./application/models/maintenance_evidence.php */