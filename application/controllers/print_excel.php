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
            $output.= '<td colspan="4"><strong>Detail Maintenance : </strong></td>';
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

        startExcel('maintenance.xls');
        echo $output;
        exit;
    }

    function report_maintenance() {
        check_login();

        $app_id = $this->input->get('application_id');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $status_pengerjaan = $this->input->get('status_pengerjaan');

        $this->load->model('application');
        $App = $this->application;

        $this->load->model('maintenance');
        $Maintenance = $this->maintenance;

        $output = '';
        if(!empty($app_id)) {
            $item_app = $App->get($app_id);
            $output .= '<h3>Nama Aplikasi : '.$item_app['app_name'].'</h3>';
            $Maintenance->setCriteria('maintenance.app_id = '.$app_id);
        }else {
            $output .= '<h3>Nama Aplikasi : Semua Aplikasi</h3>';
        }

        if(!empty($status_pengerjaan)) {
            $output .= "<h3>Status Pengerjaan : ".$this->getStatus($status_pengerjaan);
            $Maintenance->setCriteria("maintenance.mnt_id IN ( select mnt_id from track_maintenance_detail where mnt_det_status = '".$status_pengerjaan."')");
        }else {
            $output .= "<h3>Status Pengerjaan : Semua";
        }

        if(!empty($start_date) && !empty($end_date)) {
            $Maintenance->setCriteria("(maintenance.mnt_date between '".$start_date."' and '".$end_date."')");
        }elseif(!empty($start_date)) {
            $Maintenance->setCriteria("maintenance.mnt_date = '".$start_date."'");
        }elseif(!empty($end_date)) {
            $Maintenance->setCriteria("maintenance.mnt_date = '".$end_date."'");
        }

        $items_maintenance = $Maintenance->getAll(0,-1,'app_name, mnt_date','asc');

        $output .= '<table border="1">';
        $output .= '<tr>
                        <th>No</th>
                        <th>Application</th>
                        <th>Deskripsi</th>
                        <th>Tgl Maintenance</th>
                        <th>Diminta Oleh</th>
                        <th>PM</th>
                        <th>SE</th>
                        <th>SA</th>
                        <th>PRG</th>
                        <th>DOC</th>
                    </tr>';

        $no_urut_m = 1;
        foreach($items_maintenance as $item) {
            $output.= '<tr>
                        <td valign="top">'.$no_urut_m++.'</td>
                        <td valign="top">'.$item['app_name'].'</td>
                        <td valign="top">'.$item['mnt_desc'].'</td>
                        <td valign="top" align="center">&nbsp;'.$item['mnt_date'].'</td>
                        <td valign="top">'.$item['mnt_by'].'</td>
                        <td valign="top">&nbsp;</td>
                        <td valign="top">&nbsp;</td>
                        <td valign="top">&nbsp;</td>
                        <td valign="top">&nbsp;</td>
                        <td valign="top">&nbsp;</td>
                    </tr>';
        }
        startExcel('maintenance_report.xls');
        echo $output;
        exit;
    }


    function getStatus($val) {
        $status = array(
                   '' => 'Semua Status',
                   'B'=> 'Belum Dikerjakan',
                   'P' => 'Pending',
                   'I' => 'In Progress',
                   'C' => 'Closed');

        return $status[$val];
    }
}

/* End of file pages.php */
/* Location: ./application/controllers/home.php */