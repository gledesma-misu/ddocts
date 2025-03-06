<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Records extends CI_Controller {

	public function __construct(){
        parent::__construct(); 
        if (!$this->session->userdata('isLogin')) { 
            redirect('Login'); 
        }
        if ($this->session->userdata('account_type') != 2) {
            if($this->uri->segment(2) == 'Records'){
                redirect('admin/dashboard');
            }
        }
        $this->load->model('Model_records', 'records'); 
    }

	public function dispatch(){ 
        $data['doc_list'] = $this->records->dispatch_doc();

        $this->load->view('admin/Records/view_dispatch', $data);
    } 

    // ==================================== archive page

    public function archive(){ 
        $config = array();
        $config["base_url"] = base_url() . "admin/Records/archive/";
        $config["total_rows"] = $this->records->count_doc_pagination();
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
        $page = ($this->uri->segment(4)) ? $this->uri->segment(5) : 0;
        $data['posts'] = $this->records->pagination($config["per_page"],$page);


        $this->parser->parse('admin/Records/view_archive', $data);
    }

    public function doc_search(){  
        $i_search = $this->input->post('arc_search');
        $data['posts'] = $this->records->search($i_search);

        $this->load->view('admin/Records/view_archive', $data);
    }

    // ==================================== forarchive page

    public function forarchive(){ 
        $config = array();
        $config["base_url"] = base_url() . "admin/Records/forarchive/";
        $config["total_rows"] = $this->records->in_doc_pagination();
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
        $data['posts'] = $this->records->inpagination($config["per_page"],$page);


        $this->parser->parse('admin/Records/view_forarchive', $data);
    }

    public function doc_forarchive(){  
        $i_search = $this->input->post('arc_search');
        $data['posts'] = $this->records->search_forarchive($i_search);

        $this->load->view('admin/Records/view_forarchive', $data);
    }

    // ==================================== incoming External

    public function incoming_ex(){ 
        $config = array();
        $config["base_url"] = base_url() . "admin/Records/incoming_ex/";
        $config["total_rows"] = $this->records->ex_doc_pagination();
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
        $data['posts'] = $this->records->expagination($config["per_page"],$page);


        $this->parser->parse('admin/Records/view_incoming', $data);
    } 

    public function inex_search(){  
        $i_search = $this->input->post('arc_search');
        $data['posts'] = $this->records->search_inex($i_search);

        $this->load->view('admin/Records/view_incoming', $data);
    }

    public function incomingex_pdf(){  
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');

        $this->load->library('pdf');

        date_default_timezone_set('Asia/Manila');  
		$date_now = date('Y-m-d H:i:s', time());

        $now = date("M d, Y", strtotime($date_from));
        $end = date("M d, Y", strtotime($date_to));
        $data['date_now'] = date("M-d-Y h:i A", strtotime($date_now));

        $data['from'] = 'Period covered: <u>'.$now.' to '.$end.'</u>';
        $data['division'] = 'List of Incoming Communications and Documents received From External Agencies/Offices';
        $data['posts'] = $this->records->incomingex_pdfs($date_from,$date_to);


        $html = $this->load->view('admin/print_template/pdf_report_record', $data, true);
        $filename = 'report_'.time();
        $this->pdf->generate($html, $filename, true, 'Legal', 'landscape');
    }




    //===================================================================================================================
    public function dispatch_pdf(){  
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');

        $this->load->library('pdf');

        date_default_timezone_set('Asia/Manila');  
		$date_now = date('Y-m-d H:i:s', time());

        $now = date("M d, Y", strtotime($date_from));
        $end = date("M d, Y", strtotime($date_to));
        $data['date_now'] = date("M-d-Y h:i A", strtotime($date_now));

        $data['from'] = 'Period covered: <u>'.$now.' to '.$end.'</u>';
        $data['division'] = 'List of Outgoing Communicaitons and Documents released by CWC';
        $data['posts'] = $this->records->dispatch_pdfs($date_from,$date_to);


        $html = $this->load->view('admin/print_template/pdf_report_record', $data, true);
        $filename = 'report_'.time();
        $this->pdf->generate($html, $filename, true, 'Legal', 'landscape');
    }

    public function pending_pdf(){  
        switch ($this->input->post('source_doc')){
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

        $this->load->library('pdf');

        date_default_timezone_set('Asia/Manila');  
		$date_now = date('Y-m-d H:i:s', time());

        $now = date("M d, Y", strtotime($date_from));
        $end = date("M d, Y", strtotime($date_to));
        $data['date_now'] = date("M-d-Y h:i A", strtotime($date_now));

        $data['from'] = 'Period covered: <u>'.$now.' to '.$end.'</u>';
        $data['division'] = 'List of Inter-Office Documents for Action - <u>'.$div.'</u>';
        $data['posts'] = $this->records->pending_pdfs($source_doc,$date_from,$date_to);


        $html = $this->load->view('admin/print_template/pdf_report_record', $data, true);
        $filename = 'report_'.time();
        $this->pdf->generate($html, $filename, true, 'Legal', 'landscape');
    }

    public function completed_pdf(){  
        switch ($this->input->post('source_doc')){
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

        $this->load->library('pdf');

        date_default_timezone_set('Asia/Manila');  
		$date_now = date('Y-m-d H:i:s', time());

        $now = date("M d, Y", strtotime($date_from));
        $end = date("M d, Y", strtotime($date_to));
        $data['date_now'] = date("M-d-Y h:i A", strtotime($date_now));

        $data['from'] = 'Period covered: <u>'.$now.' to '.$end.'</u>';
        $data['division'] = 'List of Completed Inter-Office Communicaitons - <u>'.$div.'</u>';
        $data['posts'] = $this->records->completed_pdfs($source_doc,$date_from,$date_to);


        $html = $this->load->view('admin/print_template/pdf_report_record', $data, true);
        $filename = 'report_'.time();
        $this->pdf->generate($html, $filename, true, 'Legal', 'landscape');
    }

}
