<?php
/**
* Model for manage Faq_attachment Data
* @author wiliamdecosta@gmail.com
* @version 29/10/2015 17:22:56
*
*/

class Faq_attachment extends Abstract_model {
	
	public $table			= "track_faq_attachment";
	public $pkey			= "faq_attach_id";
	public $alias			= "faq_attachment";

	public $fields 			= array(
								'faq_attach_id' 		    => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID FAQ Attachment'),
								'faq_id'                    => array('type' => 'int', 'nullable' => true, 'unique' => false, 'display' => 'ID FAQ'),
                                'faq_attach_file'           => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Nama File'),
                                'faq_attach_desc'           => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Keterangan'),
                                'faq_attach_created_date'   => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Pembuatan'),
                                'faq_attach_created_by'     => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Dibuat Oleh'),
                                'faq_attach_updated_date'   => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Update'),
                                'faq_attach_updated_by'     => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Diupdate Oleh')	
							);

	public $selectClause 	= "faq_attachment.*,
	                                to_char(faq_attachment.faq_attach_created_date, 'yyyy-mm-dd') as faq_attach_created_date, 
                                to_char(faq_attachment.faq_attach_updated_date, 'yyyy-mm-dd') as faq_attach_updated_date,
									faq.app_id, faq.faq_case_name";
	public $fromClause 		= "track_faq_attachment AS faq_attachment
							        LEFT JOIN track_faq AS faq ON faq_attachment.faq_id = faq.faq_id";
	
	public $refs			= array();
	
	public $comboDisplay	= array();
    
    public $fileLocation  = 'application/third_party/upload/faq_attachments/';
    
	function __construct() {
		parent::__construct();
	}

	function validate() {
		$ci =& get_instance();
	    $user_name = $ci->session->userdata('user_name');

		if($this->actionType == 'CREATE') {
			//do something
			
			$this->record['faq_attach_created_date'] = date('Y-m-d');
            $this->record['faq_attach_created_by'] = $user_name;
            $this->record['faq_attach_updated_date'] = date('Y-m-d');
            $this->record['faq_attach_updated_by'] = $user_name;
		}else {
			//do something
			$this->record['faq_attach_updated_date'] = date('Y-m-d');
            $this->record['faq_attach_updated_by'] = $user_name;
		}
		return true;
	}
	
}

/* End of file faq_attachment.php */
/* Location: ./application/models/faq_attachment.php */