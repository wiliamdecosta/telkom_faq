<?php

function jsonDecode($data) {

	if (empty($data)) return array();

    $items = json_decode($data, true);

    if ($items == NULL){
        throw new Exception('JSON items could not be decoded');
    }

    return $items;
}

function startExcel($filename = "laporan.xls") {

   header("Content-type: application/vnd.ms-excel");
   header("Content-Disposition: attachment; filename=$filename");
   header("Expires: 0");
   header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
   header("Pragma: public");

}

?>