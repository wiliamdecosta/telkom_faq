<?php
/**
* Model for manage Agama Data
* @author wiliamdecosta@gmail.com
* @version 07/05/2015 12:14:29
*
*/

class Agama extends Abstract_model {
	
	public $table			= "cip_agama";
	public $pkey			= "agama_id";
	public $alias			= "agama";

	public $fields 			= array(
								'agama_id' 		=> array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Agama'),
								'agama_nama'	=> array('nullable' => false, 'type' => 'str', 'unique' => true, 'display' => 'Nama Agama')	
							);

	public $selectClause 	= "agama.*";
	public $fromClause 		= "cip_agama AS agama";
	
	public $refs			= array('cip_pegawai' => 'agama_id');
	
	public $comboDisplay	= array('agama_nama');

	function __construct() {
		parent::__construct();
	}

	function validate() {
		if($this->actionType == 'CREATE') {
			//do something
		}else {
			//do something
		}
		return true;
	}
	
}

/* End of file agama.php */
/* Location: ./application/models/agama.php */