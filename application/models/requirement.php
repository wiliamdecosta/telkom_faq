<?php
/**
* Model for manage Requirement Data
* @author wiliamdecosta@gmail.com
* @version 07/05/2015 12:14:29
*
*/

class Requirement extends Abstract_model {
	
	public $table			= "track_requirement";
	public $pkey			= "req_id";
	public $alias			= "requirement";

	public $fields 			= array(
								'req_id' 		    => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Requirement'),
								'app_id'            => array('type' => 'int', 'nullable' => true, 'unique' => false, 'display' => 'ID Application'),
                                'req_desc'          => array('type' => 'str', 'nullable' => false, 'unique' => false, 'display' => 'Deskripsi'),
                                'req_by'            => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Diminta Oleh'),
                                'req_date'          => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Requirement'),
                                'req_evidence_desc' => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Deskripsi Evident'),
                                'req_created_date'  => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Pembuatan'),
                                'req_created_by'    => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Dibuat Oleh'),
                                'req_updated_date'  => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Update'),
                                'req_updated_by'    => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Diupdate Oleh')
							);

	public $selectClause 	= "requirement.req_id, requirement.app_id, requirement.req_desc,
	                            requirement.req_by,  to_char(requirement.req_date, 'yyyy-mm-dd') as req_date, 
	                            requirement.req_desc,
	                            to_char(requirement.req_created_date, 'yyyy-mm-dd') as req_created_date, 
	                            requirement.req_created_by,
                                to_char(requirement.req_updated_date, 'yyyy-mm-dd') as req_updated_date,
                                requirement.req_updated_by,
									application.app_name";
	public $fromClause 		= "track_requirement AS requirement
							        LEFT JOIN track_application AS application ON requirement.app_id = application.app_id";
	
	public $refs			= array('track_evidence' => 'req_id',
	                                    'track_req_detail' => 'req_id');
	
	public $comboDisplay	= array();

	function __construct() {
		parent::__construct();
	}

	function validate() {
		$ci =& get_instance();
	    $user_name = $ci->session->userdata('user_name');

		if($this->actionType == 'CREATE') {
			//do something
			
			$this->record['req_created_date'] = date('Y-m-d');
            $this->record['req_created_by'] = $user_name;
            $this->record['req_updated_date'] = date('Y-m-d');
            $this->record['req_updated_by'] = $user_name;
		}else {
			//do something
			$this->record['req_updated_date'] = date('Y-m-d');
            $this->record['req_updated_by'] = $user_name;
		}
		return true;
	}
	
}

/* End of file requirement.php */
/* Location: ./application/models/requirement.php */