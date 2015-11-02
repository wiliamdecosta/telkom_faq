<?php
/**
* Model for manage Application Data
* @author wiliamdecosta@gmail.com
* @version 29/10/2015 16:40:43
*
*/

class Application extends Abstract_model {
	
	public $table			= "track_application";
	public $pkey			= "app_id";
	public $alias			= "application";

	public $fields 			= array(
								'app_id' 		    => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Application'),
								'app_name'          => array('type' => 'str', 'nullable' => false, 'unique' => true, 'display' => 'Nama Aplikasi'),
                                'app_created_date'  => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Pembuatan'),
                                'app_created_by'    => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Dibuat Oleh'),
                                'app_updated_date'  => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Update'),
                                'app_updated_by'    => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Diupdate Oleh')
							);

	public $selectClause 	= "application.*, to_char(application.app_created_date, 'yyyy-mm-dd') as app_created_date, 
                                to_char(application.app_updated_date, 'yyyy-mm-dd') as app_updated_date";
	public $fromClause 		= "track_application AS application";
	
	public $refs			= array('track_requirement' => 'app_id',
	                                'track_faq' => 'app_id');
	
	public $comboDisplay	= array('app_name');

	function __construct() {
		parent::__construct();
	}

	function validate() {
		$ci =& get_instance();
	    $user_name = $ci->session->userdata('user_name');

		if($this->actionType == 'CREATE') {
			//do something
			
			$this->record['app_created_date'] = date('Y-m-d');
            $this->record['app_created_by'] = $user_name;
            $this->record['app_updated_date'] = date('Y-m-d');
            $this->record['app_updated_by'] = $user_name;
		}else {
			//do something
			$this->record['app_updated_date'] = date('Y-m-d');
            $this->record['app_updated_by'] = $user_name;
		}
		return true;
	}
	
}

/* End of file application.php */
/* Location: ./application/models/application.php */