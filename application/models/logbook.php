<?php
/**
* Model for manage Logbook Data
* @author wiliamdecosta@gmail.com
* @version 29/10/2015 16:40:43
*
*/

class Logbook extends Abstract_model {

    public $table           = "track_logbook";
    public $pkey            = "lbook_id";
    public $alias           = "lb";

    public $fields          = array(
                                'lbook_id'            => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Logbook'),
                                'user_id'             => array('type' => 'int', 'nullable' => true, 'unique' => false, 'display' => 'User ID'),
                                'app_id'             => array('type' => 'int', 'nullable' => true, 'unique' => false, 'display' => 'Application ID'),
                                'lbook_date'          => array('type' => 'date', 'nullable' => false, 'unique' => false, 'display' => 'Tgl Kegiatan'),
                                'lbook_type'          => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Jenis Kegiatan'),
                                'lbook_description'   => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Deskripsi'),

                                'lbook_created_date'    => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Pembuatan'),
                                'lbook_created_by'      => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Dibuat Oleh'),
                                'lbook_updated_date'    => array('type' => 'date', 'nullable' => true, 'unique' => false, 'display' => 'Tgl Update'),
                                'lbook_updated_by'      => array('type' => 'str', 'nullable' => true, 'unique' => false, 'display' => 'Diupdate Oleh')
                            );

    public $selectClause    = "lb.*, to_char(lb.lbook_date, 'yyyy-mm-dd') as lbook_date, to_char(lb.lbook_created_date, 'yyyy-mm-dd') as lbook_created_date,
                                to_char(lb.lbook_updated_date, 'yyyy-mm-dd') as lbook_updated_date,
                                app.app_name";
    public $fromClause      = "track_logbook AS lb
                                LEFT JOIN track_application AS app ON lb.app_id = app.app_id";

    public $refs            = array();

    public $comboDisplay    = array();

    function __construct() {
        parent::__construct();
    }

    function validate() {
        $ci =& get_instance();
        $user_name = $ci->session->userdata('user_name');

        if($this->actionType == 'CREATE') {
            //do something

            $this->record['user_id'] = $ci->session->userdata('user_id');
            $this->record['lbook_created_date'] = date('Y-m-d');
            $this->record['lbook_created_by'] = $user_name;
            $this->record['lbook_updated_date'] = date('Y-m-d');
            $this->record['lbook_updated_by'] = $user_name;
        }else {
            //do something
            $this->record['lbook_updated_date'] = date('Y-m-d');
            $this->record['lbook_updated_by'] = $user_name;
        }
        return true;
    }

}

/* End of file application.php */
/* Location: ./application/models/application.php */