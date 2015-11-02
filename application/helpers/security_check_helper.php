<?php

function check_login($ws = '') {
	$ci =& get_instance();
	$isLoggedIn = $ci->session->userdata('logged_in');
	
	if(empty($isLoggedIn)) {
		
		if(!empty($ws)) { //request from Web Service (ws.php)
			throw new Exception('Maaf, Session login Anda telah habis atau Anda belum login. <br/> Silahkan <a href="'.BASE_URL.'base/index">Login</a> terlebih dahulu agar dapat mengakses halaman ini.');
		}else {
			redirect('base/index');
		}
	}
	return true;
}

function check_permission($module_name, $privileges) {
	
}

function get_user_roles($user_id) {
    $ci =& get_instance();
    
    $sql = "SELECT a.role_id, b.role_name "
            ."FROM core_user_role as a, core_role as b "
            ."WHERE a.role_id = b.role_id AND a.user_id = ?";
    
    $query = $ci->db->query($sql, array($user_id));
    $roles = array();
    foreach ($query->result() as $row) {
        $roles[] = array('role_id' => $row->role_id, 'role_name' => $row->role_name);
    }
    $query->free_result();
    
    return $roles;
    
}
?>