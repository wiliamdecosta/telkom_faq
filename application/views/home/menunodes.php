<?php


  $ci =& get_instance();
  $userInfo = $ci->session->userdata;
	    
  if ($userInfo['user_id']=="")
  {
    exit;
  }
    
  $dbconn = $this->db;
  $isdmin=false;
  
  if ($userInfo['user_id']=="1") $isdmin=true;

  $query = "select count(*) ada from core_user_role where role_id=1 and user_id=" . $userInfo['user_id'];
  $query =& $dbconn->query($query);
  $row = $query->row_array();

  if ($row['ada'] > 0) $isdmin=true;

  
  if ($isdmin==true) {
        $query = "select menu_id, nvl (menu_pid, 0) menu_pid, menu_code, menu_file_name "
                 . "from (select menu_id, menu_pid, menu_code, nvl (menu_file_name, '-') as menu_file_name, "
                 . "menu_description, menu_listing_no  "
                 . "from core_menu  "
                 . "where menu_is_active = 'Y'  "
                 . "start with menu_pid is null connect by prior menu_id = menu_pid order siblings by nvl(menu_listing_no, 9999)) ";
  } else {
        $query = "select menu_id, nvl (menu_pid, 0) menu_pid, menu_code, menu_file_name "
                 . "from (select menu_id, menu_pid, menu_code, nvl (menu_file_name, '-') as menu_file_name, " 
                 . "menu_description, menu_listing_no "
			     . "from core_menu " 
			     . "where menu_is_active = 'Y' " 
			     . "and menu_id in ( " 
			     . "select rm.menu_id " 
			     . "from core_role_menu rm, core_user_role ur "
			     . "where nvl(rm.rolemenu_status,'N')='Y' and rm.role_id = ur.role_id "
			     . "and ur.user_id = " . $userInfo['user_id'] ." ) "
			     . "start with menu_pid is null connect by prior menu_id = menu_pid order siblings by nvl(menu_listing_no, 9999)) "; 
  }                 
  
// echo("\/\/[disini" . $query . "]");

  echo "[" . chr(13);
        
        $result = $dbconn->query($query);
		$itemsmenu = $result->result_array();
		
		if(count($itemsmenu) < 1) exit;

        $PLevel= array (-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1);
        $level = 0;
        $bdmnid = 0;
        $nplevel = -1;
        $parid = 0;
    
        foreach ($itemsmenu as $item){
            //list($menu_id, $menu_pid, $menu_code, $menu_file_name) = $itemmenu;
            $menu_id = $item['menu_id'];
            $menu_pid = $item['menu_pid'];
            $menu_code = $item['menu_code'];
            $menu_file_name = $item['menu_file_name'];
            
            if ($menu_id!=$bdmnid) {
              
			  if ($menu_pid==$PLevel[$level]) {
                 echo '"leaf":true},' . chr(13);
			  } else {
			     if ($menu_pid==$nplevel) {
                    echo '"leaf":false,' . chr(13);
                    echo '"expanded":false,' . chr(13);
			        echo '"children":[' . chr(13);
					$level=$level+1;
					$PLevel[$level]=$menu_pid;
			     } else {
			        if ($level>0) {
                      echo '"leaf":true},' . chr(13);
				    }
					while ($PLevel[$level]!=$menu_pid && $level>0) {
						echo "]" . chr(13);
					    echo "}," . chr(13);
						$level=$level-1;
					}

			     }
			  }
              
              $nplevel=$menu_id;
              
              echo "{" . chr(13);
              if ($menu_file_name=="-") {
                 echo '"id":"' . $menu_id . '",' . chr(13);
              } else {
                 echo '"id":"' . $menu_file_name . '",' . chr(13);
              }
              echo '"text":"' . $menu_code . '",' . chr(13);
            }
            
        }
        

       if ($level>0) {
          echo '"leaf":true},' . chr(13);
 	   }
 	   
 	   while ($level>0) {
 		 echo "]" . chr(13);
 		 echo "}," . chr(13);
 		 $level=$level-1;
 	   }
 
  echo "]" . chr(13);

?>