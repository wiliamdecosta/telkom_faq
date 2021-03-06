<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class Role_menu_controller
* @version 07/05/2015 16:40:30
*/
class Role_menu_controller {

    function read() {

		$start = getVarClean('start','int',0);
    	$limit = getVarClean('limit','int',50);

    	$sort = getVarClean('sort','str',"(split_part(menu.menu_path, '.', 1)::int ,split_part(menu.menu_path, '.', 2)), menu.menu_level");
    	$dir  = getVarClean('dir','str','ASC');
    	$query  = getVarClean('query','str','');

    	$role_id = getVarClean('role_id', 'int', 0);
		$menu_id = getVarClean('menu_id', 'int', 0);

    	$data = array('items' => array(), 'success' => false, 'message' => '');

    	try {

            $ci = & get_instance();
		    $ci->load->model('base/role_menu');
		    $table = $ci->role_menu;
		    $table->setRoleId($role_id);
		    
		    $ci->load->model('base/menu');
		    $tMenu = $ci->menu;
		    		                
            $query = $table->getDisplayFieldCriteria($query);
            if (!empty($query)) $table->setCriteria($query);
            
        	$items = $table->getAll($start, $limit, $sort, $dir);
        	$totalcount = $table->countAll();

        	for($i = 0; $i < count($items); $i++) {
                if($tMenu->isRefferenced($items[$i]['menu_id'])) {
                    $items[$i]['font_style'] = 'bold';    
                }else {
                    $items[$i]['font_style'] = '';
                }
                
                if($items[$i]['menu_level'] == 1) {
                    $items[$i]['font_color'] = '#800000';
                }else {
                    $items[$i]['font_color'] = '#000000';
                }
            }

        	$data['items'] = $items;
        	$data['success'] = true;
        	$data['total'] = $totalcount;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

    	return $data;
    }


    function create() {

    	$ci = & get_instance();
		$ci->load->model('base/role_menu');
		$table = $ci->role_menu;
				
		$data = array('items' => array(), 'success' => false, 'message' => '');

		$jsonItems = getVarClean('items', 'str', '');
        $items = jsonDecode($jsonItems);

        if (!is_array($items)){
            $data['message'] = 'Invalid items parameter';
            return $data;
        }

		$table->actionType = 'CREATE';
		$errors = array();

		if (isset($items[0])){
			$numItems = count($items);
			for($i=0; $i < $numItems; $i++){
        		try{

        		    $table->db->trans_begin(); //Begin Trans

                    	$table->setRecord($items[$i]);
                    	$insert_id = $table->create();

            		$table->db->trans_commit(); //Commit Trans

            		$items[$i] = $table->get($insert_id);
        		}catch(Exception $e){

        		    $table->db->trans_rollback(); //Rollback Trans
        			$errors[] = $e->getMessage();
        		}
        	}

        	$numErrors = count($errors);
        	if ($numErrors > 0){
        		$data['message'] = $numErrors." dari ".$numItems." record gagal disimpan.<br/><br/><b>System Response:</b><br/>- ".implode("<br/>- ", $errors)."";
        	}else{
        		$data['success'] = true;
        		$data['message'] = 'Data berhasil disimpan';
        	}
        	$data['items'] =$items;
		}else {

			try{
			    $table->db->trans_begin(); //Begin Trans

        	        $table->setRecord($items);
            	    $insert_id = $table->create();

                $table->db->trans_commit(); //Commit Trans

    	        $data['success'] = true;
    	        $data['message'] = 'Data berhasil disimpan';

	            $data['items'] = $table->get($insert_id);
	        }catch (Exception $e) {
	            $table->db->trans_rollback(); //Rollback Trans

	            $data['message'] = $e->getMessage();
                $data['items'] = $items;
	        }

		}
		return $data;

    }

    function update() {

    	$ci = & get_instance();
		$ci->load->model('base/role_menu');
		$table = $ci->role_menu;

		$data = array('items' => array(), 'success' => false, 'message' => '');

		$jsonItems = getVarClean('items', 'str', '');
        $items = jsonDecode($jsonItems);

        if (!is_array($items)){
            $data['message'] = 'Invalid items parameter';
            return $data;
        }

        $table->actionType = 'UPDATE';

        if (isset($items[0])){
        	$errors = array();
			$numItems = count($items);
			for($i=0; $i < $numItems; $i++){
        		try{
        		    $table->db->trans_begin(); //Begin Trans

                		$table->setRecord($items[$i]);
                		$table->update();

                    $table->db->trans_commit(); //Commit Trans

            		$items[$i] = $table->get($items[$i][$table->pkey]);
        		}catch(Exception $e){
        		    $table->db->trans_rollback(); //Rollback Trans

        			$errors[] = $e->getMessage();
        		}
        	}

        	$numErrors = count($errors);
        	if ($numErrors > 0){
        		$data['message'] = $numErrors." dari ".$numItems." record gagal disimpan.<br/><br/><b>System Response:</b><br/>- ".implode("<br/>- ", $errors)."";
        	}else{
        		$data['success'] = true;
        		$data['message'] = 'Data berhasil disimpan';
        	}
        	$data['items'] =$items;
		}else {

			try{
			    $table->db->trans_begin(); //Begin Trans

    	        	$table->setRecord($items);
        	        $table->update();

                $table->db->trans_commit(); //Commit Trans

    	        $data['success'] = true;
    	        $data['message'] = 'Data berhasil diupdate';

	            $data['items'] = $table->get($items[$table->pkey]);
	        }catch (Exception $e) {
	            $table->db->trans_rollback(); //Rollback Trans

	            $data['message'] = $e->getMessage();
                $data['items'] = $items;
	        }

		}
		return $data;

    }

    function destroy() {
    	$ci = & get_instance();
		$ci->load->model('base/role_menu');
		$table = $ci->role_menu;

		$data = array('items' => array(), 'success' => false, 'message' => '');

		$jsonItems = getVarClean('items', 'str', '');
        $items = jsonDecode($jsonItems);

		try{
		    $table->db->trans_begin(); //Begin Trans

			$total = 0;
            if (is_array($items)){
                foreach ($items as $key => $value){
                    if (empty($value)) throw new Exception('Empty parameter');

                    $table->remove($value);
                    $data['items'][] = array($table->pkey => $value);
                    $total++;
                }
            }else{
                $items = (int) $items;
                if (empty($items)){
                    throw new Exception('Empty parameter');
                }

                $table->remove($items);
                $data['items'][] = array($table->pkey => $items);
                $data['total'] = 1;
            }

            $data['success'] = true;
            $data['message'] = $total.' Data berhasil dihapus';

            $table->db->trans_commit(); //Commit Trans

        }catch (Exception $e) {
            $table->db->trans_rollback(); //Rollback Trans
            $data['message'] = $e->getMessage();
            $data['items'] = array();
            $data['total'] = 0;
        }

        return $data;

    }
}

/* End of file Role_menu_controller.php */
/* Location: ./application/libraries/base/Role_menu_controller.php */