<?php
/**
* Model for manage Evidence Data
* @author wiliamdecosta@gmail.com
* @version 29/10/2015 17:17:16
*
*/

class Evidence extends Abstract_model {
	
	public $table			= "track_evidence";
	public $pkey			= "evd_id";
	public $alias			= "evidence";

	public $fields 			= array(
								'evd_id' 		    => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Evidence'),
								'req_id'            => array('type' => 'int', 'nullable' => true, 'unique' => false, 'display' => 'ID Requirement'),
                                'evd_file'          => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'File'),
                                'evd_desc'          => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Deskripsi'),
                                'evd_created_date'  => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Pembuatan'),
                                'evd_created_by'    => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Dibuat Oleh'),
                                'evd_updated_date'  => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Update'),
                                'evd_updated_by'    => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Diupdate Oleh')
							);

	public $selectClause 	= "evidence.*,
	                                 to_char(evidence.evd_created_date, 'yyyy-mm-dd') as evd_created_date, 
                                to_char(evidence.evd_updated_date, 'yyyy-mm-dd') as evd_updated_date,
									 requirement.app_id, requirement.req_desc";
	public $fromClause 		= "track_evidence AS evidence
							    LEFT JOIN track_requirement AS requirement ON evidence.req_id = requirement.req_id";
	
	public $refs			= array();
	
	public $comboDisplay	= array();
	
	public $fileLocation  = 'application/third_party/upload/evidence_attachments/';

	function __construct() {
		parent::__construct();
	}

	function validate() {
		$ci =& get_instance();
	    $user_name = $ci->session->userdata('user_name');

		if($this->actionType == 'CREATE') {
			//do something
			
			$this->record['evd_created_date'] = date('Y-m-d');
            $this->record['evd_created_by'] = $user_name;
            $this->record['evd_updated_date'] = date('Y-m-d');
            $this->record['evd_updated_by'] = $user_name;
		}else {
			//do something
			$this->record['evd_updated_date'] = date('Y-m-d');
            $this->record['evd_updated_by'] = $user_name;
		}
		return true;
	}
	
}

/* End of file evidence.php */
/* Location: ./application/models/evidence.php */