<?php
/**
* Model for manage Faq Data
* @author wiliamdecosta@gmail.com
* @version 29/10/2015 17:21:14
*
*/

class Faq extends Abstract_model {
	
	public $table			= "track_faq";
	public $pkey			= "faq_id";
	public $alias			= "faq";

	public $fields 			= array(
								'faq_id' 		           => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Faq'),
								'app_id'                   => array('type' => 'int', 'nullable' => true, 'unique' => false, 'display' => 'ID Application'),
                                'faq_case_name'            => array('type' => 'str', 'nullable' => false, 'unique' => false, 'display' => 'Nama Kasus'),
                                'faq_case_by'              => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Case By'),
                                'faq_case_date'            => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Kasus'),
                                'faq_solution'             => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Solusi'),
                                'faq_solution_by'          => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Pembuat Solusi'),
                                'faq_solution_finish_date' => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Selesai'),
                                'faq_description'          => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Keterangan'),
                                'faq_created_date'         => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Pembuatan'),
                                'faq_created_by'           => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Dibuat Oleh'),
                                'faq_updated_date'         => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Update'),
                                'faq_updated_by'           => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Diupdate Oleh')
							);

	public $selectClause 	= "faq.faq_id, faq.app_id, faq.faq_case_name, faq.faq_case_by,
	                                to_char(faq.faq_case_date, 'yyyy-mm-dd') as faq_case_date, 
	                                faq.faq_solution, faq.faq_solution_by,
                                to_char(faq.faq_solution_finish_date, 'yyyy-mm-dd') as faq_solution_finish_date,
                                    faq.faq_description,
                                    to_char(faq.faq_created_date, 'yyyy-mm-dd') as faq_created_date,
                                    faq.faq_created_by,
                                to_char(faq.faq_updated_date, 'yyyy-mm-dd') as faq_updated_date,
                                    faq.faq_updated_by,
									application.app_name";
	public $fromClause 		= "track_faq AS faq
							        LEFT JOIN track_application AS application ON faq.app_id = application.app_id";
	
	public $refs			= array('track_faq_attachment' => 'faq_id');
	
	public $comboDisplay	= array('faq_case_name');

	function __construct() {
		parent::__construct();
	}

	function validate() {
		$ci =& get_instance();
	    $user_name = $ci->session->userdata('user_name');

		if($this->actionType == 'CREATE') {
			//do something
			
			if(isset($this->record['faq_case_date']) and empty($this->record['faq_case_date'])) {
			    $this->record['faq_case_date'] = null; 
			}
			
			if(isset($this->record['faq_solution_finish_date']) and empty($this->record['faq_solution_finish_date'])) {
			    $this->record['faq_solution_finish_date'] = null; 
			}
			
			$this->record['faq_created_date'] = date('Y-m-d');
            $this->record['faq_created_by'] = $user_name;
            $this->record['faq_updated_date'] = date('Y-m-d');
            $this->record['faq_updated_by'] = $user_name;
		}else {
			//do something
			
			if(isset($this->record['faq_case_date']) and empty($this->record['faq_case_date'])) {
			    $this->record['faq_case_date'] = null; 
			}
			
			if(isset($this->record['faq_solution_finish_date']) and empty($this->record['faq_solution_finish_date'])) {
			    $this->record['faq_solution_finish_date'] = null; 
			}
			
			$this->record['faq_updated_date'] = date('Y-m-d');
            $this->record['faq_updated_by'] = $user_name;
		}
		return true;
	}
	
}

/* End of file faq.php */
/* Location: ./application/models/faq.php */