<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base extends CI_Controller {
	
	function index() {
	    
	    /* jika sudah login */
	    if($this->session->userdata('logged_in')) {
	        //go to default page
			redirect($this->config->item('default_page'));
	    }
	    
		$data = array();
		$data['login_url'] = BASE_URL."base/login";
		$this->load->view('base/login', $data);
	}
	
	function login() {
		if($this->session->userdata('logged_in')) {
		    //go to default page
			redirect($this->config->item('default_page'));
		}
				
		$username = $this->input->post('uname');
		$password  = $this->input->post('password');
        
        $data = array();
		if(empty($username) or empty($password)) {
		    $data['errormsg'] = 'Username atau Password Harus Diisi';
			$this->load->view('base/login', $data);	
			return;
		}
		
		$password = md5($password);
		
		$DB_prefix = $this->config->item('DB_prefix');
		$query = "SELECT * FROM ".$DB_prefix."_user WHERE user_name = ".$this->db->escape($username)." AND user_password = ".$this->db->escape($password);
		
		$query = $this->db->query($query);
		$row = $query->row_array();
		
		if(empty($row['user_id'])) {
			$data['errormsg'] = 'Username atau Password Anda Salah';
			$this->load->view('base/login', $data);	
			return;
		}elseif($row['user_status'] == "i"){
		    $data['errormsg'] = "Maaf, User '".$username."' Sudah Tidak Aktif. Mohon menghubungi administrator.";
			$this->load->view('base/login', $data);	
			return;		    
		}else {
			$userdata = array('user_id'	    => $row['user_id'],
						  'user_name' 	    => $row['user_name'],
						  'user_realname'   => $row['user_realname'],
						  'user_email' 	    => $row['user_email'],
						  'logged_in'	    => true,
						  'roles'           => get_user_roles($row['user_id'])
						  );
						  
			$this->session->set_userdata($userdata);

			//go to default page
			redirect($this->config->item('default_page'));
		}
		
	}
	
	function logout() {
		
		$userdata = array('user_id'		=> '',
						  'user_name' 	=> '',
						  'user_email' 	=> '',
						  'logged_in' 	=> ''
						  );

		$this->session->unset_userdata($userdata);
		$this->session->sess_destroy();
		redirect('base/index');
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/base.php */