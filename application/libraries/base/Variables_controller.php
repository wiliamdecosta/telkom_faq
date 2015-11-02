<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class Menu_controller
* @version 07/05/2015 12:18:34
*/
class Variables_controller {

    function get_var() {

		$var_name = getVarClean('var_name','str','');
    	
    	$data = array('items' => array(), 'success' => false, 'message' => '');

    	try {

            $ci = & get_instance();
		    $ci->load->model('base/variables');
		    $table = $ci->variables;
            
        	$data['items'] = $table->get_var($var_name);
        	$data['success'] = true;
        	$data['total'] = 1;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

    	return $data;
    }
    
    function set_var() {
        $var_name = getVarClean('var_name','str','');
        $var_value = getVarClean('var_value','str','');
        
        $data = array('items' => array(), 'success' => false, 'message' => '');

    	try {

            $ci = & get_instance();
		    $ci->load->model('base/variables');
		    $table = $ci->variables;
            
            $table->set_var($var_name, $var_value);
            
        	$data['success'] = true;
        	$data['total'] = 1;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

    	return $data;
    }
    
    
    function get_theme() {

		$var_name = getVarClean('var_name','str','');
    	
    	$data = array('items' => array(), 'success' => false, 'message' => '');

    	try {

            $ci = & get_instance();
		    $ci->load->model('base/variables');
		    $table = $ci->variables;
            
            $skin = $table->get_theme($ci->session->userdata('user_name'), $var_name);
        	$data['items'] =  empty($skin) ? "no-skin" : $skin;
        	$data['success'] = true;
        	$data['total'] = 1;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

    	return $data;
    }
    
    function set_theme() {
        $var_name = getVarClean('var_name','str','');
        $var_value = getVarClean('var_value','str','');
        
        $data = array('items' => array(), 'success' => false, 'message' => '');

    	try {

            $ci = & get_instance();
		    $ci->load->model('base/variables');
		    $table = $ci->variables;
            
            $table->set_theme($ci->session->userdata('user_name'), $var_name, $var_value);
            
        	$data['success'] = true;
        	$data['total'] = 1;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

    	return $data;
    }

}

/* End of file Menu_controller.php */
/* Location: ./application/libraries/base/Menu_controller.php */