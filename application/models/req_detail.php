<?php
/**
* Model for manage Req_detail Data
* @author wiliamdecosta@gmail.com
* @version 29/10/2015 17:38:37
*
*/

class Req_detail extends Abstract_model {
	
	public $table			= "track_req_detail";
	public $pkey			= "req_det_id";
	public $alias			= "req_detail";

	public $fields 			= array(
								'req_det_id' 		    => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Req_detail'),
								'req_id'                => array('type' => 'int', 'nullable' => true, 'unique' => false, 'display' => 'ID Requirement'),
                                'req_det_pic'           => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'PIC'),
                                'req_det_desc'           => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'PIC'),
                                'req_det_start_date'    => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Start Date'),
                                'req_det_due_date'      => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Due Date'),
                                'req_det_status'        => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Status Pengerjaan'),
                                'req_det_created_date'  => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Pembuatan'),
                                'req_det_created_by'    => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Dibuat Oleh'),
                                'req_det_updated_date'  => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Update'),
                                'req_det_updated_by'    => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Diupdate Oleh')	
							);

	public $selectClause 	= "req_detail.req_det_id, req_detail.req_id, req_detail.req_det_pic, req_detail.req_det_desc,
	                                to_char(req_detail.req_det_start_date, 'yyyy-mm-dd') as req_det_start_date, 
	                                to_char(req_detail.req_det_due_date, 'yyyy-mm-dd') as req_det_due_date, 
	                                req_detail.req_det_status,
	                                to_char(req_detail.req_det_created_date, 'yyyy-mm-dd') as req_det_created_date, 
	                                req_detail.req_det_created_by,
                                to_char(req_detail.req_det_updated_date, 'yyyy-mm-dd') as req_det_updated_date,
                                    req_detail.req_det_updated_by,
									requirement.app_id, requirement.req_desc";
	public $fromClause 		= "track_req_detail AS req_detail
							        LEFT JOIN track_requirement AS requirement ON req_detail.req_id = requirement.req_id";
	
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
			
			if(isset($this->record['req_det_start_date']) and empty($this->record['req_det_start_date'])) {
			    $this->record['req_det_start_date'] = null; 
			}
			
			if(isset($this->record['req_det_due_date']) and empty($this->record['req_det_due_date'])) {
			    $this->record['req_det_due_date'] = null; 
			}
			
			$this->record['req_det_created_date'] = date('Y-m-d');
            $this->record['req_det_created_by'] = $user_name;
            $this->record['req_det_updated_date'] = date('Y-m-d');
            $this->record['req_det_updated_by'] = $user_name;
		}else {
			//do something
			
			if(isset($this->record['req_det_start_date']) and empty($this->record['req_det_start_date'])) {
			    $this->record['req_det_start_date'] = null; 
			}
			
			if(isset($this->record['req_det_due_date']) and empty($this->record['req_det_due_date'])) {
			    $this->record['req_det_due_date'] = null; 
			}
			
			$this->record['req_det_updated_date'] = date('Y-m-d');
            $this->record['req_det_updated_by'] = $user_name;
		}
		return true;
	}
	
}

/* End of file req_detail.php */
/* Location: ./application/models/req_detail.php */