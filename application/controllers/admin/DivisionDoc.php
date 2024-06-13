<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DivisionDoc extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLogin')) {
            redirect('Login');
        }

        $this->load->model('Model_division', 'division');
    }

    public function completed()
    {
        switch ($this->session->userdata('staff_division')) {
            case 2:
                $Exist = "PPRD";
            break;
            case 3:
                $Exist = "LID";
            break;
            case 4:
                $Exist = "MISU";
            break;
            case 5:
                $Exist = "AFD";
            break;
            case 6:
                $Exist = "PAIO";
            break;
            case 7:
                $Exist = "OED";
            break;
            case 7:
                $Exist = "ODED";
            break;
            case 7:
                $Exist = "PMO";
            break;
            case 7:
                $Exist = "MED";
            break;
            default: 
                $Exist = "ERROR";
            break;   
        }

        $config = array();
        $config["base_url"] = base_url() . "admin/DivisionDoc/completed";
        $config["total_rows"] = $this->division->count_doc_completed($Exist);
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config["next_link"] = "<i class='w-4 h-4' data-feather='chevrons-right'></i>";
        $config["next_tag_open"] = "<li>";
        $config["next_tag_close"] = "</li>";
        $config["prev_link"] = "<i class='w-4 h-4' data-feather='chevrons-left'></i>";
        $config["prev_tag_open"] = "<li>";
        $config["prev_tag_close"] = "</li>";
        $config["full_tag_open"] = "<ul class='pagination'>";
        $config["full_tag_close"] = "</ul>";
        $config["cur_tag_open"] = "<li class='paginate_button active'><a href='#' class='active'>";
        $config["cur_tag_close"] = '</a></li>';
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = '</li>';

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['posts'] = $this->division->get_doc_completed($config["per_page"], $page, $Exist);
        $data['get_id_staffs'] = $this->division->get_my_completed($Exist);

        $this->parser->parse('admin/DivisionDoc/view_complete_doc', $data);
    }

    public function search_completed()
    {
        switch ($this->session->userdata('staff_division')) {
            case 2:
                $Exist = "PPRD";
            break;
            case 3:
                $Exist = "LID";
            break;
            case 4:
                $Exist = "MISU";
            break;
            case 5:
                $Exist = "AFD";
            break;
            case 6:
                $Exist = "PAIO";
            break;
            case 7:
                $Exist = "OED";
            break;
            case 7:
                $Exist = "ODED";
            break;
            case 7:
                $Exist = "PMO";
            break;
            case 7:
                $Exist = "MED";
            break;
            default: 
                $Exist = "ERROR";
            break;   
        }
        $search = $this->input->post('search_doc');

        $data['posts'] = $this->division->search_completed($search, $Exist);
        $data['get_id_staffs'] = $this->division->get_my_completed($Exist);
        $this->load->view('admin/DivisionDoc/view_complete_doc', $data);
    }

    public function com_generate_pdf()
    {
        switch ($this->session->userdata('staff_division')) {
            case 2:
                $Exist = "PPRD";
                break;
            case 3:
                $Exist = "LID";
                break;
            case 4:
                $Exist = "MISU";
                break;
            case 5:
                $Exist = "AFD";
                break;
            case 6:
                $Exist = "PAIO";
                break;
            case 7:
                $Exist = "OED";
                break;
            case 8:
                $Exist = "ODED";
                break;
            case 9:
                $Exist = "PMO";
                break;
            case 10:
                $Exist = "MED";
                break;
            default:
                $Exist = "ERROR";
                break;
        }

        switch ($this->input->post('source_doc')) {
            case 0:
                $div = 'All Division/Unit';
                break;
            case 2:
                $div = 'Policy Planning and Research Division';
                break;
            case 3:
                $div = 'Localization and Institutionalization Division';
                break;
            case 4:
                $div = 'Management Information System Unit';
                break;
            case 5:
                $div = 'Administrative and Finance Division';
                break;
            case 6:
                $div = 'Public Affairs and Information Office';
                break;
            case 7:
                $div = 'Office of the Executive Director';
                break;
            case 8:
                $div = 'Office of the Deputy Executive Director';
                break;
            case 9:
                $div = 'Project Management Office';
                break;
            case 10:
                $div = 'Monitoring and Evaluation Division';
                break;
            default:
                $Exist = "ERROR";
                break;
        }

        $source_doc = $this->input->post('source_doc');
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');

        //echo $source_doc.' '.$date_from.' '.$date_to.' '.$Exist;

        $this->load->library('pdf');

        date_default_timezone_set('Asia/Manila');
        $date_now = date('Y-m-d H:i:s', time());

        $now = date("M d, Y", strtotime($date_from));
        $end = date("M d, Y", strtotime($date_to));
        $data['date_now'] = date("M-d-Y h:i A", strtotime($date_now));

        $data['from'] = 'Period covered: <u>' . $now . ' to ' . $end . '</u>';
        $data['division'] = 'List of Completed Inter-Office Documents - <u>' . $div . '</u>';
        $data['posts'] = $this->division->com_print_pdf($Exist, $source_doc, $date_from, $date_to);
        $data['count'] = 'Total of Completed Documents - <u>' . count($data['posts']) . '</u>';


        $html = $this->load->view('admin/print_template/pdf_report', $data, true);
        $filename = 'report_' . time();
        $this->pdf->generate($html, $filename, true, 'Legal', 'landscape');
    }

    public function com_generate_excel()
    {

        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $table_columns = array("Document No.", "Document Type", "Document Title", "Source", "Routed To", "Date Received", "Concerned Staff", "Status", "Notes / Remarks");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }

        switch ($this->session->userdata('staff_division')) {
            case 2:
                $Exist = "PPRD";
                break;
            case 3:
                $Exist = "LID";
                break;
            case 4:
                $Exist = "MISU";
                break;
            case 5:
                $Exist = "AFD";
                break;
            case 6:
                $Exist = "PAIO";
                break;
            case 7:
                $Exist = "OED";
                break;
            case 8:
                $Exist = "ODED";
                break;
            case 9:
                $Exist = "PMO";
                break;
            case 10:
                $Exist = "MED";
                break;
            default:
                $Exist = "ERROR";
                break;
        }

        $source_doc = $this->input->post('source_doc');
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');

        $employee_data = $this->division->com_print_excel($Exist, $source_doc, $date_from, $date_to);

        $excel_row = 2;

        foreach ($employee_data as $row) {

            if ($row['dd_doct_type'] == 0) {
                $type = 'Multiple';
            } else {
                $type = $row['dt_name'];
            }

            $dd_action_taken_id = $row['dd_source'];
            $dd_action_id = explode(", ", $dd_action_taken_id);

            $dd_action_name = '';
            foreach ($dd_action_id as $mysource) {
                $this->load->model('Model_division', 'division');
                $data = $this->division->mysources($mysource);
                $dd_action_name .= $data['ds_code'] . ', ';
                $dd_name =  substr($dd_action_name, 0, -2);
            }

            $date = $row['dd_date_encoded'];
            $datepicker = date("M-d-Y h:i A", strtotime($date));

            switch ($row['dd_status']) {
                case 1:
                    $status = 'Pending';
                    break;
                case 2:
                    $status = 'On Process';
                    break;
                case 3:
                    $status = 'Re Process';
                    break;
                case 4:
                    $status = 'Completed';
                    break;
                default:
                    echo "ERROR";
                    break;
            }

            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['dd_doc_id_code']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $type);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['dd_title']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $dd_name);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['dd_view_doc']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $datepicker);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['dd_staff_name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $status);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row['dd_note']);
            $excel_row++;
        }

        switch ($source_doc) {
            case 0:
                $div = 'All';
                break;
            case 2:
                $div = "PPRD";
                break;
            case 3:
                $div = "LID";
                break;
            case 4:
                $div = "MISU";
                break;
            case 5:
                $div = "AFD";
                break;
            case 6:
                $div = "PAIO";
                break;
            case 7:
                $div = "OED";
                break;
            case 8:
                $div = "ODED";
                break;
            case 9:
                $div = "PMO";
                break;
            case 10:
                $div = "MED";
                break;
            default:
                $div = "ERROR";
                break;
        }

        $data_excel = $div . '_Completed.xls';

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=" . $data_excel);
        $object_writer->save('php://output');
    }


    // ==============================================================================================================================
    public function pending()
    {
        // switch ($this->session->userdata('staff_division')) {
        //     case 2:
        //         $Exist = "PPRD";
        //         break;
        //     case 3:
        //         $Exist = "LID";
        //         break;
        //     case 4:
        //         $Exist = "MISU";
        //         break;
        //     case 5:
        //         $Exist = "AFD";
        //         break;
        //     case 6:
        //         $Exist = "PAIO";
        //         break;
        //     case 7:
        //         $Exist = "OED";
        //         break;
        //     case 8:
        //         $Exist = "ODED";
        //         break;
        //     case 9:
        //         $Exist = "PMO";
        //         break;
        //     case 10:
        //         $Exist = "MED";
        //         break;
        //     default:
        //         $Exist = "ERROR";
        //         break;
        // }

        $Exist = $this->division->get_division_all($this->session->userdata('staff_division'));

        $config = array();
        $config["base_url"] = base_url() . "admin/DivisionDoc/pending";
        $config["total_rows"] = $this->division->count_doc_pending($Exist['ds_code']);
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config["next_link"] = "<i class='w-4 h-4' data-feather='chevrons-right'></i>";
        $config["next_tag_open"] = "<li>";
        $config["next_tag_close"] = "</li>";
        $config["prev_link"] = "<i class='w-4 h-4' data-feather='chevrons-left'></i>";
        $config["prev_tag_open"] = "<li>";
        $config["prev_tag_close"] = "</li>";
        $config["full_tag_open"] = "<ul class='pagination'>";
        $config["full_tag_close"] = "</ul>";
        $config["cur_tag_open"] = "<li class='paginate_button active'><a href='#' class='active'>";
        $config["cur_tag_close"] = '</a></li>';
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = '</li>';

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['posts'] = $this->division->get_doc_pending($config["per_page"], $page, $Exist['ds_code']);
        $data['get_id_staffs'] = $this->division->get_my_division($Exist['ds_code']);

        $this->parser->parse('admin/DivisionDoc/view_pending_doc', $data);
    }

    public function search_pending()
    {
        switch ($this->session->userdata('staff_division')) {
            case 2:
                $Exist = "PPRD";
                break;
            case 3:
                $Exist = "LID";
                break;
            case 4:
                $Exist = "MISU";
                break;
            case 5:
                $Exist = "AFD";
                break;
            case 6:
                $Exist = "PAIO";
                break;
            case 7:
                $Exist = "OED";
                break;
            case 8:
                $Exist = "ODED";
                break;
            case 9:
                $Exist = "PMO";
                break;
            case 10:
                $Exist = "MED";
                break;
            default:
                $Exist = "ERROR";
                break;
        }
        $search = $this->input->post('search_doc');

        $data['posts'] = $this->division->search_pending_doc($search, $Exist);
        $data['get_id_staffs'] = $this->division->get_my_division($Exist);
        $this->load->view('admin/DivisionDoc/view_pending_doc', $data);
    }

    public function generate_pdf()
    {
        switch ($this->session->userdata('staff_division')) {
            case 2:
                $Exist = "PPRD";
                break;
            case 3:
                $Exist = "LID";
                break;
            case 4:
                $Exist = "MISU";
                break;
            case 5:
                $Exist = "AFD";
                break;
            case 6:
                $Exist = "PAIO";
                break;
            case 7:
                $Exist = "OED";
                break;
            case 8:
                $Exist = "ODED";
                break;
            case 9:
                $Exist = "PMO";
                break;
            case 10:
                $Exist = "MED";
                break;
            default:
                $Exist = "ERROR";
                break;
        }

        switch ($this->input->post('source_doc')) {
            case 0:
                $div = 'All Division/Unit';
                break;
            case 2:
                $div = 'Policy Planning and Research Division';
                break;
            case 3:
                $div = 'Localization and Institutionalization Division';
                break;
            case 4:
                $div = 'Management Information System Unit';
                break;
            case 5:
                $div = 'Administrative and Finance Division';
                break;
            case 6:
                $div = 'Public Affairs and Information Office';
                break;
            case 7:
                $div = 'Office of the Executive Director';
                break;
            case 8:
                $div = 'Office of the Deputy Executive Director';
                break;
            case 9:
                $div = 'Project Management Office';
                break;
            case 10:
                $div = 'Monitoring and Evaluation Division';
                break;
            default:
                $div = "ERROR";
                break;
        }

        $source_doc = $this->input->post('source_doc');
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');

        //echo $source_doc.' '.$date_from.' '.$date_to.' '.$Exist;

        $this->load->library('pdf');

        date_default_timezone_set('Asia/Manila');
        $date_now = date('Y-m-d H:i:s', time());

        $now = date("M d, Y", strtotime($date_from));
        $end = date("M d, Y", strtotime($date_to));
        $data['date_now'] = date("M-d-Y h:i A", strtotime($date_now));

        $data['from'] = 'Period covered: <u>' . $now . ' to ' . $end . '</u>';
        $data['division'] = 'List of Inter-Office Documents for Action - <u>' . $div . '</u>';
        $data['posts'] = $this->division->print_pdf($Exist, $source_doc, $date_from, $date_to);
        $data['count'] = 'Total of Action Documents - <u>' . count($data['posts']) . '</u>';


        $html = $this->load->view('admin/print_template/pdf_report', $data, true);
        $filename = 'report_' . time();
        $this->pdf->generate($html, $filename, true, 'Legal', 'landscape');
    }

    public function generate_excel()
    {

        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $table_columns = array("Document No.", "Document Type", "Document Title", "Source", "Routed To", "Date Received", "Concerned Staff", "Status", "Notes / Remarks");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }

        switch ($this->session->userdata('staff_division')) {
            case 2:
                $Exist = "PPRD";
                break;
            case 3:
                $Exist = "LID";
                break;
            case 4:
                $Exist = "MISU";
                break;
            case 5:
                $Exist = "AFD";
                break;
            case 6:
                $Exist = "PAIO";
                break;
            case 7:
                $Exist = "OED";
                break;
            case 8:
                $Exist = "ODED";
                break;
            case 9:
                $Exist = "PMO";
                break;
            case 10:
                $Exist = "MED";
                break;
            default:
                $Exist = "ERROR";
                break;
        }

        $source_doc_excel = $this->input->post("source_doc_excel");
        $date_from = $this->input->post('date_from_excel');
        $date_to = $this->input->post('date_to_excel');

        $employee_data = $this->division->print_excel(trim($Exist), 2, $date_from, $date_to);
        // echo "<script>console.log('Debug Objects: ".$Exist . " " . $source_doc . " " . $date_from. " ". $date_to."' );</script>";

    
        $excel_row = 2;

        foreach ($employee_data as $row) {

            if ($row['dd_doct_type'] == 0) {
                $type = 'Multiple';
            } else {
                $type = $row['dt_name'];
            }

            $dd_action_taken_id = $row['dd_source'];
            $dd_action_id = explode(", ", $dd_action_taken_id);

            $dd_action_name = '';
            foreach ($dd_action_id as $mysource) {
                $this->load->model('Model_division', 'division');
                $data = $this->division->mysources($mysource);
                $dd_action_name .= $data['ds_code'] . ', ';
                $dd_name =  substr($dd_action_name, 0, -2);
            }

            $date = $row['dd_date_encoded'];
            $datepicker = date("M-d-Y h:i A", strtotime($date));

            switch ($row['dd_status']) {
                case 1:
                    $status = 'Pending';
                    break;
                case 2:
                    $status = 'On Process';
                    break;
                case 3:
                    $status = 'Re Process';
                    break;
                case 4:
                    $status = 'Completed';
                    break;
                default:
                    echo "ERROR";
                    break;
            }

            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['dd_doc_id_code']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $type);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['dd_title']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $dd_name);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['dd_view_doc']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $datepicker);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['dd_staff_name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $status);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row['dd_note']);

            $excel_row++;
        }

        switch ($source_doc_excel) {
            case 0:
                $div = 'All';
                break;
            case 2:
                $div = "PPRD";
                break;
            case 3:
                $div = "LID";
                break;
            case 4:
                $div = "MISU";
                break;
            case 5:
                $div = "AFD";
                break;
            case 6:
                $div = "PAIO";
                break;
            case 7:
                $div = "OED";
                break;
            case 8:
                $div = "ODED";
                break;
            case 9:
                $div = "PMO";
                break;
            case 10:
                $div = "MED";
                break;
            default:
                $div = "ERROR";
                break;
        }

        $data_excel = $div . '_Pending.xls';

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=" . $data_excel);
        $object_writer->save('php://output');
    }


    // ==============================================================================================================================

    public function upload_files()
    {
        switch ($this->session->userdata('staff_division')) {
            case 2:
                $Exist = "PPRD";
                break;
            case 3:
                $Exist = "LID";
                break;
            case 4:
                $Exist = "MISU";
                break;
            case 5:
                $Exist = "AFD";
                break;
            case 6:
                $Exist = "PAIO";
                break;
            case 7:
                $Exist = "OED";
                break;
            case 8:
                $Exist = "ODED";
                break;
            case 9:
                $Exist = "PMO";
                break;
            case 10:
                $Exist = "MED";
                break;
            default:
                $Exist = "ERROR";
                break;
        }

        $config = array();
        $config["base_url"] = base_url() . "admin/DivisionDoc/upload_files";
        $config["total_rows"] = $this->division->count_doc_files($Exist);
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config["next_link"] = "<i class='w-4 h-4' data-feather='chevrons-right'></i>";
        $config["next_tag_open"] = "<li>";
        $config["next_tag_close"] = "</li>";
        $config["prev_link"] = "<i class='w-4 h-4' data-feather='chevrons-left'></i>";
        $config["prev_tag_open"] = "<li>";
        $config["prev_tag_close"] = "</li>";
        $config["full_tag_open"] = "<ul class='pagination'>";
        $config["full_tag_close"] = "</ul>";
        $config["cur_tag_open"] = "<li class='paginate_button active'><a href='#' class='active'>";
        $config["cur_tag_close"] = '</a></li>';
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = '</li>';

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['posts'] = $this->division->get_doc_files($config["per_page"], $page, $Exist);
        $data['get_id_staffs'] = $this->division->get_my_files($Exist);
        $data['staffs']  = $this->division->get_staff_details();

        $this->parser->parse('admin/DivisionDoc/view_uploaded_doc', $data);
    }

    public function search_files()
    {
        switch ($this->session->userdata('staff_division')) {
            case 2:
                $Exist = "PPRD";
                break;
            case 3:
                $Exist = "LID";
                break;
            case 4:
                $Exist = "MISU";
                break;
            case 5:
                $Exist = "AFD";
                break;
            case 6:
                $Exist = "PAIO";
                break;
            case 7:
                $Exist = "OED";
                break;
            case 8:
                $Exist = "ODED";
                break;
            case 9:
                $Exist = "PMO";
                break;
            case 10:
                $Exist = "MED";
                break;
            default:
                $Exist = "ERROR";
                break;
        }
        $search = $this->input->post('search_doc');

        $data['posts'] = $this->division->search_files_doc($search, $Exist);
        $data['get_id_staffs'] = $this->division->get_my_files($Exist);
        $data['staffs']  = $this->division->get_staff_details();
        $this->load->view('admin/DivisionDoc/view_uploaded_doc', $data);
    }
}
