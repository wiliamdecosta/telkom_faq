<?php
/**
* Model for manage Pegawai Data
* @author wiliamdecosta@gmail.com
* @version 07/05/2015 12:12:40
*
*/

class Pegawai extends Abstract_model {
	
	public $table			= "cip_pegawai";
	public $pkey			= "peg_id";
	public $alias			= "pegawai";

	public $fields 			= array(
								'peg_id' 		=> array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Pegawai'),
								'agama_id'		=> array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'ID Agama'),
								'peg_nik'		=> array('nullable' => false, 'type' => 'str', 'unique' => true, 'display' => 'Nik Pegawai'),
								'peg_nama'		=> array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Nama Pegawai'),
								'peg_tgl_lahir'	=> array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Tgl Lahir'),
								'peg_alamat'	=> array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Alamat Pegawai')
							);

	public $selectClause 	= "pegawai.*, agama.agama_nama, to_char(pegawai.peg_tgl_lahir, 'yyyy-mm-dd') as peg_tgl_lahir";
	public $fromClause 		= "cip_pegawai AS pegawai
	                                LEFT JOIN cip_agama as agama ON pegawai.agama_id = agama.agama_id";
	
	public $refs			= array();
	
	public $comboDisplay	= array('peg_nama');

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

/* End of file pegawai.php */
/* Location: ./application/models/pegawai.php */