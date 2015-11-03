<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class Maintenance_evidence_controller
* @version 07/05/2015 12:18:00
*/
class Maintenance_evidence_controller {

    function read() {
		
		$start = getVarClean('start','int',0);
    	$limit = getVarClean('limit','int',50);

    	$sort = getVarClean('sort', 'str', 'mnt_evd_id');
        $dir = getVarClean('dir', 'str', 'DESC');
        $query = getVarClean('query', 'str', '');
        
        $mnt_evd_id = getVarClean('mnt_evd_id', 'int', 0);
		$mnt_id = getVarClean('mnt_id', 'int', 0);
		$mnt_evd_file = getVarClean('mnt_evd_file', 'str', '');
		$mnt_evd_desc = getVarClean('mnt_evd_desc', 'str', '');
		$mnt_evd_created_date = getVarClean('mnt_evd_created_date', 'date', '');
		$mnt_evd_created_by = getVarClean('mnt_evd_created_by', 'str', '');
		$mnt_evd_updated_date = getVarClean('mnt_evd_updated_date', 'date', '');
		$mnt_evd_updated_by = getVarClean('mnt_evd_updated_by', 'str', '');
		
    	$data = array('items' => array(), 'success' => false, 'message' => '');

    	try {
            
            $ci = & get_instance();
		    $ci->load->model('maintenance_evidence');
		    $table = $ci->maintenance_evidence;
		    
		    //Set default criteria. You can override this if you want
            foreach ($table->fields as $key => $field){
                if (!empty($$key)){ // <-- Perhatikan simbol $$
                    if ($field['type'] == 'str'){
                        $table->setCriteria($table->getAlias().$key.$table->likeOperator." '".$$key."' ");
                    }else{
                        $table->setCriteria($table->getAlias().$key." = ".$$key);
                    }
                }
            }
        
            $query = $table->getDisplayFieldCriteria($query);
            if (!empty($query)) $table->setCriteria($query);
            
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
		$ci->load->model('maintenance_evidence');
		$table = $ci->maintenance_evidence;
				
		$data = array('items' => array(), 'success' => false, 'message' => '');

		global $_FILES;
        
        $jsonItems = getVarClean('items', 'str', '');
        $items =& jsonDecode($jsonItems);
        if (!is_array($items)){
            $data['message'] = 'Invalid items parameter';
            return $data;
        }
        
        $file_name = $_FILES['mnt_evd_file']['name'];
        $file_name = date("Ymd")."_".strtolower(str_replace(" ","_",$file_name));
        $file_location = $table->fileLocation.$file_name;
       
        if (!move_uploaded_file($_FILES['mnt_evd_file']['tmp_name'], $file_location)){
            throw new Exception("Upload file gagal");
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
			    
			    	$items['mnt_evd_file'] = $file_name;
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
		
		echo json_encode($data);
        session_write_close();
        exit;

    }

    function update() {

    	$ci = & get_instance();
		$ci->load->model('maintenance_evidence');
		$table = $ci->maintenance_evidence;

		$data = array('items' => array(), 'success' => false, 'message' => '');

		global $_FILES;
        
        $jsonItems = getVarClean('items', 'str', '');
        $items =& jsonDecode($jsonItems);
        if (!is_array($items)){
            $data['message'] = 'Invalid items parameter';
            return $data;
        }
        
        $file_name = "";
        
        if(!empty($_FILES['mnt_evd_file']['name'])) {
            
            $file_name = $_FILES['mnt_evd_file']['name'];
            $file_name = date("Ymd")."_".strtolower(str_replace(" ","_",$file_name));
            $file_location = $table->fileLocation.$file_name;
           
            if (!move_uploaded_file($_FILES['mnt_evd_file']['tmp_name'], $file_location)){
                throw new Exception("Upload file gagal");
            }
            
            $itemfile = $table->get($items['mnt_evd_id']);
            unlink($table->fileLocation.$itemfile['mnt_evd_file']);
                      
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
        		$data['message'] = 'Data berhasil diupdate';
        	}
        	$data['items'] =$items;
		}else {

			try{
			    $table->db->trans_begin(); //Begin Trans
			        
			        if(!empty($file_name)) {
			            $items['mnt_evd_file'] = $file_name;      
			        }
			        
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
		
		echo json_encode($data);
        session_write_close();
        exit;

    }

    function destroy() {
    	$ci = & get_instance();
		$ci->load->model('maintenance_evidence');
		$table = $ci->maintenance_evidence;

		$data = array('items' => array(), 'success' => false, 'message' => '');

		$jsonItems = getVarClean('items', 'str', '');
        $items = jsonDecode($jsonItems);

		try{
		    $table->db->trans_begin(); //Begin Trans
		    
			$total = 0;
            if (is_array($items)){
                foreach ($items as $key => $value){
                    if (empty($value)) throw new Exception('Empty parameter');
                    
                    $item = $table->get($value);
                    if(file_exists($table->fileLocation.$item['mnt_evd_file']))
                        unlink($table->fileLocation.$item['mnt_evd_file']);
                    
                    $table->remove($value);
                    $data['items'][] = array($table->pkey => $value);
                    $total++;
                }
            }else{
                $items = (int) $items;
                if (empty($items)){
                    throw new Exception('Empty parameter');
                }
                $item = $table->get($items);
                if(file_exists($table->fileLocation.$item['mnt_evd_file']))
                    unlink($table->fileLocation.$item['mnt_evd_file']);
                
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

/* End of file Maintenance_evidence_controller.php */
/* Location: ./maintenance_evidence/libraries/Maintenance_evidence_controller.php */