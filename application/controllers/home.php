<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function index() {
		check_login();
		$this->load->view('home/index');
	}
	
	function welcome() {
		$this->load->view('home/welcome');
	}
	
	function menunodes() {
		$this->load->view('home/menunodes');
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/home.php */