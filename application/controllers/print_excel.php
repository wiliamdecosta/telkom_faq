<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Print_excel extends CI_Controller {

    function download_maintenance() {
        check_login();
        $app_id = $this->uri->segment(3);
        $start_date = $this->uri->segment(4);
        $end_date = $this->uri->segment(5);

        $this->load->model('application');
        $App = $this->application;

        $this->load->model('maintenance');
        $Maintenance = $this->maintenance;

        $this->load->model('maintenance_detail');
        $M_detail = $this->maintenance_detail;

        $this->load->model('maintenance_evidence');
        $M_evidence = $this->maintenance_evidence;

        $item_app = $App->get($app_id);
        $output = '';
        $output .= '<h3>Nama Aplikasi : '.$item_app['app_name'].'</h3>';


        $Maintenance->setCriteria('maintenance.app_id = '.$app_id);
        if(!empty($start_date) && !empty($end_date)) {
                $Maintenance->setCriteria("(maintenance.mnt_date between '".$start_date."' and '".$end_date."')");
        }elseif(!empty($start_date)) {
            $Maintenance->setCriteria("maintenance.mnt_date = '".$start_date."'");
        }elseif(!empty($end_date)) {
            $Maintenance->setCriteria("maintenance.mnt_date = '".$end_date."'");
        }

        $items_maintenance = $Maintenance->getAll(0,-1);

        $output .= '<table border="1">';
        $output .= '<tr>
                        <th>No</th>
                        <th width="700">Nama Maintenance</th>
                        <th>Tgl Maintenance</th>
                        <th>Diminta Oleh</th>
                    </tr>';

        $no_urut_m = 1;
        foreach($items_maintenance as $item) {
            $output .= '<tr style="background:#60BCFD;">';
            $output .= '<td>'.$no_urut_m++.'</td>';
            $output .= '<td>'.$item['mnt_desc'].'</td>';
            $output .= '<td>'.date('d-M-Y',strtotime($item['mnt_date'])).'</td>';
            $output .= '<td>'.$item['mnt_by'].'</td>';
            $output.='</tr>';

            $output.= '<tr>';
            $output.= '<td colspan="4"><strong>Detail Maintenance :'.$item['mnt_id'].' </strong></td>';
            $output.= '</tr>';

            $M_detail->criteria = array();
            $M_detail->setCriteria('maintenance_detail.mnt_id = '.$item['mnt_id']);
            $items_detail = $M_detail->getAll(0,-1);

            if(count($items_detail) > 0) {
                $output.= '<tr>';
                $output.='<td colspan="4">';
                $output.='<ul>';
                foreach ($items_detail as $detail) {
                    $output.='<li>- PIC : '.$detail['mnt_det_pic'].' | Deskripsi: '.$detail['mnt_det_desc'].' | Date : '.(empty($detail['mnt_det_start_date']) ? "": date('d-M-Y',strtotime($detail['mnt_det_start_date'])) ).' s.d '.(empty($detail['mnt_det_due_date']) ? "": date('d-M-Y',strtotime($detail['mnt_det_due_date']))).' | Status : '.$this->getStatus($detail['mnt_det_status']).'</li>';
                }
                $output.='</ul>';
                $output.='</td>';
                $output.= '</tr>';
            }

            $output.= '<tr>';
            $output.= '<td colspan="4"><strong>Evidence : </strong></td>';
            $output.= '</tr>';

            $M_evidence->criteria = array();
            $M_evidence->setCriteria('maintenance_evidence.mnt_id = '.$item['mnt_id']);
            $items_evidence = $M_evidence->getAll(0,-1);

            if(count($items_evidence) > 0) {
                $output.= '<tr>';
                $output.='<td colspan="4">';
                $output.='<ul>';
                foreach ($items_evidence as $evidence) {
                    $output.='<li> - <a href="'.UPLOAD_PATH.'maintenance_evidence_attachments/'.$evidence['mnt_evd_file'].'">'.$evidence['mnt_evd_file'].'</a></li>';
                }
                $output.='</ul>';
                $output.='</td>';
                $output.= '</tr>';
            }
        }
        $output .= '</table>';

        echo $output;
        startExcel('maintenance.xls');

        exit;
    }

    function getStatus($val) {
        $status = array('B'=> 'Belum Dikerjakan',
                   'P' => 'Pending',
                   'I' => 'In Progress',
                   'C' => 'Closed');

        return $status[$val];
    }
}

/* End of file pages.php */
/* Location: ./application/controllers/home.php */