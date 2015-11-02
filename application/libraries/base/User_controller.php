<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class User_controller
* @version 07/05/2015 12:20:52
*/
class User_controller {

    function read() {

		$start = getVarClean('start','int',0);
    	$limit = getVarClean('limit','int',50);

    	$sort = getVarClean('sort','str','user_id');
    	$dir  = getVarClean('dir','str','DESC');
    	$query  = getVarClean('query','str','');

    	$searchUser = getVarClean('searchUser', 'str', '');
    	    	
    	/* bootgrid request */
        $bootgrid_request = getVarClean('bootgrid_request', 'str', '');
        $current = getVarClean('current', 'int', 1);
        $rowCount = getVarClean('rowCount', 'int', 10);
        $searchPhrase = getVarClean('searchPhrase', 'str', '');
        /* end bootgrid request */
        
    	$data = array('items' => array(), 'success' => false, 'message' => '');

    	try {

            $ci = & get_instance();
		    $ci->load->model('base/user');
		    $table = $ci->user;

            if(!empty($searchUser)) {
                $table->setCriteria("(core_user.user_name ".$table->likeOperator." '%$searchUser%' OR core_user.user_realname ".$table->likeOperator." '%$searchUser%')");
            }
                        
            if(!empty($searchPhrase)) {
                $table->setCriteria("(core_user.user_name ".$table->likeOperator." '%$searchPhrase%' OR core_user.user_realname ".$table->likeOperator." '%$searchPhrase%')");
            }
            
            $query = $table->getDisplayFieldCriteria($query);
            if (!empty($query)) $table->setCriteria($query);
            
            
            if($bootgrid_request == "Y") {
                $start = ($current-1) * $rowCount; 
                $limit = $rowCount;   
                $data['current'] = $current;
                $data['rowCount'] = $rowCount;
            }
                        
        	$items = $table->getAll($start, $limit, $sort, $dir);
        	$totalcount = $table->countAll();

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
		$ci->load->model('base/user');
		$table = $ci->user;
		
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
		$ci->load->model('base/user');
		$table = $ci->user;

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
		$ci->load->model('base/user');
		$table = $ci->user;

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
                $total = 1;
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


    function getInfo() {

    	$ci =& get_instance();
	    $uid = $ci->session->userdata('user_id');

        $data = array('data' => array(), 'success' => false, 'message' => '');

        try{
            if (empty($uid)){
                throw new Exception('Bad Params : Empty UserID');
            }

            $ci = & get_instance();
		    $ci->load->model('base/user');
		    $table = $ci->user;

            $data['data'] = $table->get($uid);
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }
        return $data;

    }

    function updateInfo() {

		$user_password1 = trim(getVarClean('user_password1', 'str', ''));
		$user_password2 = trim(getVarClean('user_password2', 'str', ''));

		$user_email = trim(getVarClean('user_email', 'str', ''));
		$user_realname = trim(getVarClean('user_realname', 'str', ''));

        $data = array('items' => array(), 'total' => 0, 'success' => false, 'message' => '');

    	$ci =& get_instance();
	    $uid = $ci->session->userdata('user_id');

        try{
            if (empty($uid)){
                throw new Exception('Bad Params : Empty UserID');
            }

	        $ci->load->model('base/user');
	        $table = $ci->user;
	        
	        $table->actionType = 'UPDATE';

	        $record = array('user_id' => $uid,
	                        'user_email' => $user_email,
	                        'user_realname' => $user_realname);

            if (!empty($user_password1)){
                if (strcmp($user_password1, $user_password2) != 0) throw new Exception("Password tidak sama. Mohon periksa kembali");

                if (strlen($user_password1) < 5) throw new Exception("Panjang password minimal 5 karakter");

                $record['user_password'] = $user_password1;
	        }

	        $table->setRecord($record );
	        $table->update();
            
            $userdata = array('user_id'	    => $record['user_id'],
						  'user_name' 	    => $ci->session->userdata('user_name'),
						  'user_realname'   => $record['user_realname'],
						  'user_email' 	    => $record['user_email'],
						  'logged_in'	    => true,
						  'roles'           => get_user_roles($record['user_id'])
						  );
						  
			$ci->session->set_userdata($userdata);
			
	        $data['success'] = true;
	        $data['message'] = 'Data Profil Berhasil Di-update';

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }
        return $data;

    }


}

/* End of file User_controller.php */
/* Location: ./application/libraries/base/User_controller.php */