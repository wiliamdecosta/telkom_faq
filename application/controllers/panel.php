<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends CI_Controller {

	function index() {
		check_login();
		$this->load->view('acepanel/index');
	}

	function load_content($id) {
	    try {
	        check_login(true);
	        $file = explode(".", $id);
	        if(count($file) > 1) {
	            $this->load->view('acepanel/'.$file[0].'/'.$file[1]);
	        }else {
	            $this->load->view('acepanel/'.$id);
	        }
	        	        
	    }catch(Exception $e) {
	        echo "
    	        <script>
    	            showBootDialog(false,
    	                            BootstrapDialog.TYPE_DEFAULT,
                                    'Perhatian',
                                    '".$e->getMessage()."' );
    	        </script>
	        ";
	        exit;
	    }
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/panel.php */