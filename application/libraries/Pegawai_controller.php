<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class Pegawai_controller
* @version 07/05/2015 12:19:03
*/
class Pegawai_controller {

    function read() {
		
		$start = getVarClean('start','int',0);
    	$limit = getVarClean('limit','int',50);
    	
    	$sort = getVarClean('sort','str','peg_id');
    	$dir  = getVarClean('dir','str','ASC');
    	$query  = getVarClean('query','str','');
        
        $peg_id = getVarClean('peg_id','int',0);
        $agama_id = getVarClean('agama_id','int',0);
        
        $data = array('items' => array(), 'success' => false, 'message' => '');
        try {
            
            $ci = & get_instance();
		    $ci->load->model('pegawai');
            $table = $ci->pegawai;
            
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
    
        	$data = array();
        	$data['items'] = $items;
        	$data['success'] = true;
        	$data['total'] = $totalcount;
        	$data['message'] = '';
        	
        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }
        
    	return $data;
    }

    function create() {

    	$ci = & get_instance();
		$ci->load->model('pegawai'); 
		$table = $ci->pegawai;
		
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
            		$table->setRecord($items[$i]);
            		$insert_id = $table->create();

            		$items[$i] = $table->get($insert_id);
        		}catch(Exception $e){
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
	        	$table->setRecord($items);
    	        $insert_id = $table->create();

    	        $data['success'] = true;
    	        $data['message'] = 'Data berhasil disimpan';

	            $data['items'] = $table->get($insert_id);
	        }catch (Exception $e) {
	            $data['message'] = $e->getMessage();
                $data['items'] = $items;
	        }

		}
		return $data;

    }

    function update() {

    	$ci = & get_instance();
		$ci->load->model('pegawai');
		$table = $ci->pegawai;

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
            		$table->setRecord($items[$i]);
            		$table->update();
            		$items[$i] = $table->get($items[$i][$table->pkey]);
        		}catch(Exception $e){
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
	        	$table->setRecord($items);
    	        $table->update();

    	        $data['success'] = true;
    	        $data['message'] = 'Data berhasil diupdate';

	            $data['items'] = $table->get($items[$table->pkey]);
	        }catch (Exception $e) {
	            $data['message'] = $e->getMessage();
                $data['items'] = $items;
	        }

		}
		return $data;

    }

    function destroy() {
    	$ci = & get_instance();
		$ci->load->model('pegawai');
		$table = $ci->pegawai;

		$data = array('items' => array(), 'success' => false, 'message' => '');

		$jsonItems = getVarClean('items', 'str', '');
        $items = jsonDecode($jsonItems);

		try{
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

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
            $data['items'] = array();
            $data['total'] = 0;
        }

        return $data;

    }
}

/* End of file Pegawai_controller.php */
/* Location: ./application/libraries/Pegawai_controller.php */