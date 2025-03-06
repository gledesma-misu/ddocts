<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Documents extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLogin')) {
            redirect('Login');
        }

        $this->load->model('Model_dts', 'dts');
    }

    public function index()
    {
        log_message('debug', __METHOD__);

        $data = array(
            'staffs' => $this->dts->get_staff_details(),
            'records_incoming' => '0',
            'type_action_takens' => $this->dts->get_action_taken(),
            'type_documents' => $this->dts->get_type_document(),
            'all_sources' => $this->dts->get_all_source(),
            'get_internal_sources' => $this->dts->get_internal_source(),
        );

        // log_message('debug', 'my current data: '.print_r($data, true));

        $s_division = $this->session->userdata('staff_division');
        $data['get_s_division'] = $this->dts->get_s_division($s_division);
        $data['my_division'] = $data['get_s_division']['sd_code_name'];

        $this->load->view('admin/Documents/new_document', $data);
    }

    public function incoming_records()
    {

        $data['staffs'] = $this->dts->get_staff_details();
        $data['records_incoming'] = '1';
        $data['type_action_takens'] = $this->dts->get_action_taken();
        $data['type_documents'] = $this->dts->get_type_document();
        $data['all_sources'] = $this->dts->get_all_source();
        $data['get_internal_sources'] = $this->dts->get_internal_source();
        $this->load->view('admin/Documents/new_document', $data);
    }

    public function updateDoc()
    {

        $doc_id = $this->uri->segment(4);
        $data = array(
            'doc_id' => $doc_id,
            'staffs' => $this->dts->get_staff_details(),
            'records_incoming' => '0',
            'type_action_takens' => $this->dts->get_action_taken(),
            'type_documents' => $this->dts->get_type_document(),
            'all_sources' => $this->dts->get_all_source(),
            'get_internal_sources' => $this->dts->get_internal_source(),
            'get_docs' => $this->dts->get_doc_pending($doc_id),
        );
        $data['getdoc'] = $data['get_docs'][0];

        $data['bundled_type'] = explode(",", $data['getdoc']['dd_bundleDocs']); //Get Document Type

        $data['doc_types'] = explode(",", $data['getdoc']['dd_doct_type']); //Get Document Action
        $data['doc_action'] = explode(",", $data['getdoc']['dd_action_taken']); //Get Document Action

        $data['route_div'] = explode(",", $data['getdoc']['dd_view_doc']); //Get Division/Unit

        $data['route_staff'] = explode(",", $data['getdoc']['dd_routed_to']); //Get Staff/s for routing

        log_message('debug', "Doc type: " . print_r($data['doc_types'], true));

        $this->load->view('admin/Documents/update_document', $data);
    }

    public function editDoc($dd_id)
    {
        $existing_file = $this->dts->get_file_attachment($dd_id);
        // log_message('debug', "My Data: " . print_r($existing_file['dd_filename'], true));
        // FILE UPLOAD START
        $s_division = $this->session->userdata('staff_division');
        $data['get_s_division'] = $this->dts->get_s_division($s_division);
        $my_division = $data['get_s_division']['sd_code_name'];
        $lname = $this->session->userdata('staff_lname');
        $folder_lname = str_replace(" ", "_", trim($lname));

        $moredocs = $this->input->post('moredocs', TRUE) == null ? '0' : '1'; //Check if Multiple Docs
        $type_doc = $this->input->post('type_doc') == 'Select' ? '0' : $this->input->post('type_doc'); // Get Doc Type
        $type_docs = implode(', ', $this->input->post('type_docs[]') == '' ? array('0') : $this->input->post('type_docs[]'));
        $document_type = $this->dts->get_bundle($type_doc); // Get Doc Type
        if ($moredocs == '1') {
            // $document_code = 'Multiple';
            $type_docs_array = explode(', ', $type_docs);
            foreach ($type_docs_array as $typeDocs) {
                $document_type_all = $this->dts->get_bundle($typeDocs); // Get Doc Type
                $document_code[] = $document_type_all['dt_code'];
            }
        } else {
            $document_type = $this->dts->get_bundle($type_doc); // Get Doc Type
            $document_code = $document_type['dt_code'];
        }


        $today = date("Ymd"); // Get Today Date

        $data = array();
        $filesCount = count($_FILES['files']['name']);
        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['file']['name']     = $_FILES['files']['name'][$i];
            $_FILES['file']['type']     = $_FILES['files']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
            $_FILES['file']['error']     = $_FILES['files']['error'][$i];
            $_FILES['file']['size']     = $_FILES['files']['size'][$i];

            $doc_directory = "./assets/upload/" . $my_division . "/" . $folder_lname . "/";

            if (!file_exists("./assets/upload/" . $my_division . "/" . $folder_lname . "/")) {
                mkdir("./assets/upload/" . $my_division . "/" . $folder_lname . "/", 0777, true);
            }

            //upload files
            $config['upload_path'] = $doc_directory;
            $config['allowed_types'] = 'pdf|png|jpg|jpeg|xls|xlsx|doc|docx';
            $config['remove_spaces'] = TRUE;
            $config['max_size'] = '0';

            // Insert new name for image
            $lname = $this->session->userdata('staff_lname');
            $token = substr(number_format(time() * rand(), 0, '', ''), 0, 6); //Random Token
            $temp = explode(".", $_FILES["file"]["name"]);
            // $new_name = $document_code . '-' . $today . '-' . $token .  '.' . end($temp);
            if ($moredocs == '1') {
                if ($filesCount == count($document_code)) {
                    $new_name = $document_code[$i] . '-' . $today . '-' . $token .  '.' . end($temp);
                } elseif ($filesCount != count($document_code)) {
                    $new_name = $document_code[0] . '-' . $today . '-' . $token .  '.' . end($temp);
                }
            } else {
                $new_name = $document_code . '-' . $today . '-' . $token .  '.' . end($temp);
            }

            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if ($this->upload->do_upload('file')) {
                // Uploaded file data
                $fileData = $this->upload->data();
                $uploadData[$i]['file_name'] = $fileData['file_name'];

                $get_filename = $fileData['file_name'];
                $file_ext[$i]['test'] = pathinfo($get_filename, PATHINFO_EXTENSION);
            }
        }

        $file_ex = '';
        if (!empty($file_ext)) {
            foreach ($file_ext as $ext) {
                $file_ex .=  $ext['test'] . '|';
                $file_e =  substr($file_ex, 0, -1);
            }
            $file_get = $file_e . "," . $existing_file['dd_filetype'];
        } else {
            $file_get = $existing_file['dd_filetype'];
        }

        $file_t = '';
        if (!empty($uploadData)) {
            foreach ($uploadData as $f) {
                $file_t .=  '|' . $f['file_name'] . '|';
            }
            $files_array_upd = $file_t . $existing_file['dd_filename'];
        } else {
            // $files_array_new = '|No Uploaded Files!|';
            $files_array_upd = $existing_file['dd_filename'];
        }

        $source_doc = $this->input->post('source_doc');
        $priorityLevel = $this->input->post('priority_level');
        $source_div = $this->dts->get_s_division($source_doc)['sd_code_name'];

        $records_id = $this->input->post('records_status');

        if ($records_id == 0) {
            $source = $this->dts->get_in_ex_source1($source_doc);
            // $source_label = $source['ds_code']; // source code number
            $source_label = $source['ds_code']; // source code number
            $count = $this->db->from("document_details")->count_all_results();
        }

        $doc_year = date('Y');

        $number = sprintf("%04s", $count);
        $year = substr($doc_year, -2);

        $doc_no = $source_label . '-' . $number . '-' . $year;

        $sub_title = $this->input->post('sub_title');

        $datesent = $this->input->post('datepicker');
        $editor1 = $this->input->post('editor1');

        $staffs = $this->dts->get_staff_details();
        $log_user = '';
        foreach ($staffs as $staff) {
            if ($staff['staff_id'] == $this->session->userdata('staff_id')) {
                $log_user = $this->session->userdata('staff_id'); // get the staff id of the logged in user
            }
        }

        //staff_id of person encoded
        $action_taken = implode(', ', $this->input->post('action_taken[]'));
        $div_unit = implode(', ', $this->input->post('div_unit[]'));
        $staff_details =  $log_user . ", " . implode(', ', $this->input->post('staff_details[]')); // add the logged in user to the staff details array


        $staff_datas = explode(", ", $staff_details);
        $source_staff = '';
        $source_email = '';
        foreach ($staff_datas as $myid) {
            $data = $this->dts->routed_details($myid);

            $source_staff .= $data['fname'] . ' ' . $data['lname'] . ', ';
            $source_email .= $data['official_email'] . ', ';
            $source_staffs =  substr($source_staff, 0, -2);
            $source_emails =  substr($source_email, 0, -2);
        }
        $source_staffs_name = $source_staffs;

        //staff_id of person encoded
        $staff_id = $this->session->userdata('staff_id');
        // $this->load->view('admin/Documents/edit_document', $data);
        $staff_id = $this->session->userdata('staff_id');
        $dd_disregard_doc = 0;
        $this->dts->updateDocDetails(
            $dd_id,
            $doc_no,
            $source_doc,
            $sub_title,
            $files_array_upd,
            $moredocs,
            $type_doc,
            $action_taken,
            $datesent,
            $div_unit,
            $staff_details,
            $editor1,
            $type_docs,
            $priorityLevel,
            $file_get,
            $staff_id,
            $dd_disregard_doc,
            $source_staffs_name,
            $records_id
        );

        $this->session->set_flashdata('success', 'Data updated successfully');
        redirect(base_url('admin/Dashboard')); //default Documents
    }


    public function get_file_pending($doc_id)
    {

        $getdocs = $this->dts->get_doc_pending($doc_id);
        $getdoc = $getdocs[0];
        $filename = substr($getdoc['dd_filename'], 1, -1);
        $data['fileNames'] = explode('||', $filename);
        echo json_encode($data['fileNames']);
    }

    public function newdoc()
    {
        // FILE UPLOAD START
        $s_division = $this->session->userdata('staff_division');
        $data['get_s_division'] = $this->dts->get_s_division($s_division);
        $my_division = $data['get_s_division']['sd_code_name'];
        $lname = $this->session->userdata('staff_lname');
        $folder_lname = str_replace(" ", "_", trim($lname));

        $moredocs = $this->input->post('moredocs', TRUE) == null ? '0' : '1'; //Check if Multiple Docs
        $type_docs = implode(', ', $this->input->post('type_docs[]') == '' ? array('0') : $this->input->post('type_docs[]'));
        $type_doc = is_null($this->input->post('type_doc')) ? '0' : $this->input->post('type_doc'); // Get Doc Type

        if ($moredocs == '1') {
            // $document_code = 'Multiple';
            $type_docs_array = explode(', ', $type_docs);
            foreach ($type_docs_array as $typeDocs) {
                $document_type_all = $this->dts->get_bundle($typeDocs); // Get Doc Type
                $document_code[] = $document_type_all['dt_code'];
            }
        } else {
            $document_type = $this->dts->get_bundle($type_doc); // Get Doc Type
            $document_code = $document_type['dt_code'];
        }


        $today = date("Ymd"); // Get Today Date


        $data = array();
        $filesCount = count($_FILES['files']['name']);
        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['file']['name']     = $_FILES['files']['name'][$i];
            $_FILES['file']['type']     = $_FILES['files']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
            $_FILES['file']['error']     = $_FILES['files']['error'][$i];
            $_FILES['file']['size']     = $_FILES['files']['size'][$i];

            $doc_directory = "./assets/upload/" . $my_division . "/" . $folder_lname . "/";

            if (!file_exists("./assets/upload/" . $my_division . "/" . $folder_lname . "/")) {
                mkdir("./assets/upload/" . $my_division . "/" . $folder_lname . "/", 0777, true);
            }

            //upload files
            $config['upload_path'] = $doc_directory;
            $config['allowed_types'] = 'pdf|png|jpg|jpeg|xls|xlsx|doc|docx';
            $config['remove_spaces'] = TRUE;
            $config['max_size'] = '0';

            // Insert new name for file
            $lname = $this->session->userdata('staff_lname');
            $token = substr(number_format(time() * rand(), 0, '', ''), 0, 6); //Random Token
            $temp = explode(".", $_FILES["file"]["name"]);
            if ($moredocs == '1') {
                if ($filesCount == count($document_code)) {
                    $new_name = $document_code[$i] . '-' . $today . '-' . $token .  '.' . end($temp);
                } elseif ($filesCount != count($document_code)) {
                    $new_name = $document_code[0] . '-' . $today . '-' . $token .  '.' . end($temp);
                }
            } else {
                $new_name = $document_code . '-' . $today . '-' . $token .  '.' . end($temp);
            }

            // log_message('debug', "type of document: " . print_r($new_name, true));

            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if ($this->upload->do_upload('file')) {
                // Uploaded file data
                $fileData = $this->upload->data();
                $uploadData[$i]['file_name'] = $fileData['file_name'];

                $get_filename = $fileData['file_name'];
                $file_ext[$i]['test'] = pathinfo($get_filename, PATHINFO_EXTENSION);
            }
        }

        $file_ex = '';
        if (!empty($file_ext)) {
            foreach ($file_ext as $ext) {
                $file_ex .=  $ext['test'] . '|';
                $file_e =  substr($file_ex, 0, -1);
            }
            $file_get = $file_e;
        } else {
            $file_get = '|No Uploaded Files!|';
        }

        $file_t = '';
        if (!empty($uploadData)) {
            foreach ($uploadData as $f) {
                $file_t .=  '|' . $f['file_name'] . '|';
            }
            $files_array_new = $file_t;
        } else {
            // $files_array_new = '|No Uploaded Files!|';
            $files_array_new = '';
        }

        // if ($this->input->post('records_status') == 0) {
        // } else {
        // }

        $source_doc = $this->input->post('source_doc');
        $priorityLevel = $this->input->post('priority_level');
        $source_div = $this->dts->get_s_division($source_doc)['sd_code_name'];

        $records_id = $this->input->post('records_status');

        if ($records_id == 0) {
            $source = $this->dts->get_in_ex_source1($source_doc);
            // $source_label = $source['ds_code']; // source code number
            $source_label = $source['ds_code']; // source code number
            $count = $this->db->from("document_details")->count_all_results();
        } else {
            $source = $this->dts->get_in_ex_source1($source_doc);
            $source_label = 'I-EXTERNAL'; // source code number
            $count = $this->db->from("document_details")->count_all_results();
        }

        $doc_year = date('Y');
        $number = sprintf("%04s", $count);
        $year = substr($doc_year, -2);
        $doc_no = $source_label . '-' . $number . '-' . $year; //Document Routing Number
        $sub_title = $this->input->post('sub_title'); // Document Title
        $datesent = $this->input->post('datepicker'); //Date Created
        $editor1 = $this->input->post('editor1');
        $action_taken = implode(', ', $this->input->post('action_taken[]'));
        $div_unit = implode(', ', $this->input->post('div_unit[]'));
        $staffs = $this->dts->get_staff_details();
        $log_user = '';
        foreach ($staffs as $staff) {
            if ($staff['staff_id'] == $this->session->userdata('staff_id')) {
                $log_user = $this->session->userdata('staff_id'); // get the staff id of the logged in user
            }
        }

        //staff_id of person encoded   
        $staff_details =  $log_user . ", " . implode(', ', $this->input->post('staff_details[]')); // add the logged in user to the staff details array


        $staff_datas = explode(", ", $staff_details);
        $source_staff = '';
        $source_email = '';
        foreach ($staff_datas as $myid) {
            $data = $this->dts->routed_details($myid);

            $source_staff .= $data['fname'] . ' ' . $data['lname'] . ', ';
            $source_email .= $data['official_email'] . ', ';
            $source_staffs =  substr($source_staff, 0, -2);
            $source_emails =  substr($source_email, 0, -2);
        }
        $source_staffs_name = $source_staffs;
        $source_staffs_email = explode(", ", $source_emails);

        if ($source_doc == 1) {
            $dd_disregard_doc = 1;
            $not_listed = $this->input->post('not_liste');

            $this->dts->doc_request($not_listed);
        } else {
            $dd_disregard_doc = 0;
        }
        // new add data , $dd_disregard_doc,$not_listed

        //staff_id of person encoded
        $staff_id = $this->session->userdata('staff_id');

        $this->dts->insertDocDetails($doc_no, $source_doc, $sub_title, $files_array_new, $moredocs, $type_doc, $action_taken, $datesent, $div_unit, $staff_details, $editor1, $type_docs, $priorityLevel, $file_get, $staff_id, $dd_disregard_doc, $source_staffs_name, $records_id);

        // $emails = array();
        // foreach ($source_staffs_email as $test1) {
        //     array_push($emails, $test1);
        // }

        //            $this->load->library('email');
        //            $config = Array(
        //                'mailtype' => 'html',
        //                'protocol' => 'smtp',
        //                'smtp_host' => 'ssl://smtp.googlemail.com',
        //                'smtp_port' => 465,
        //                'smtp_user' => 'cwcwebsite@cwc.gov.ph', // change it to yours
        //                'smtp_pass' =>  'Cwch1ldr3n2022', // change it to yours
        //                'charset' => 'iso-8859-1',
        //                'wordwrap' => TRUE
        //            );

        $subject = "" . $doc_no . " (Document Notification)";
        $test['doc_title'] = $sub_title;
        $test['doc_number'] = $doc_no;
        $test['date'] = $datesent;
        $test['staff_id'] = $staff_id;
        $doc_status1 = '1';
        switch ($doc_status1) {
            case "1":
                $test['doc_status1'] = '<b style="color:#E00621;">PENDING</b>';
                break;
            case "2":
                $test['doc_status1'] = '<b style="color:#04E1D0;">ON PROCESS</b>';
                break;
            case "3":
                $test['doc_status1'] = '<b style="color:#0644C8;">RE-PROCESS</b>';
                break;
            case "4":
                $test['doc_status1'] = '<b style="color:#04AA13;">COMPLETED (OUTGOING)</b>';
                break;
            default:
                $test['doc_status1'] = 'ERROR';
        }

        //            $this->data['data'] = $test;
        //            $message1 = $this->load->view('admin/Email_Template/email_insert_doc', $this->data, TRUE);

        //            $this->email->initialize($config);

        //            $this->load->library('email',$config);
        //            $this->email->set_newline("\r\n");
        //            $this->email->from('cwcwebsite@cwc.gov.ph','DDOCTS-NO-REPLY'); // change it to yours
        // $this->email->reply_to('scflg-kms@cwcgov.com', 'SCFLG-KMS');

        //            $this->email->to($emails);// change it to yours

        //            $this->email->subject($subject);
        //            $this->email->message($message1);
        //            if($this->email->send()){
        //                //Success email Sent
        $this->session->set_flashdata('success', 'Data insert successful');
        redirect(base_url('admin/Dashboard')); //default Documents
        //             }else{
        //Email Failed To Send
        //                echo $this->email->print_debugger();
        //             }  
    }

    // Incoming page =========================================================================================================================================

    public function incoming()
    {
        $staff = $this->session->userdata('staff_id');

        $config = array();
        $config["base_url"] = base_url() . "admin/documents/incoming";
        $config["total_rows"] = $this->dts->count_doc_pagination($staff);
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
        $page = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
        $data['posts'] = $this->dts->get_doc_pagination($config["per_page"], $page, $staff);
        // log_message('debug', 'Limit: ' . print_r($data['posts'], true));
        $data['get_id_staffs'] = $this->dts->get_my_division($staff);
        $data['count'] =  $this->dts->count_doc_incoming($staff);

        $data['staffs'] = $this->dts->get_staff_details();

        $this->parser->parse('admin/Documents/incoming_page', $data);
    }

    public function search_incoming()
    {
        $staff = $this->session->userdata('staff_id');
        $search = $this->input->post('search_doc');

        $data['posts'] = $this->dts->search_incoming_doc($search, $staff);
        $data['count'] =  $this->dts->count_doc_incoming($staff);
        $data['get_id_staffs'] = $this->dts->get_my_division($staff);

        $this->load->view('admin/Documents/incoming_page', $data);
    }


    // Outgoing page ====================================================================================  
    public function outgoing()
    {
        $staff = $this->session->userdata('staff_id');

        $config = array();
        $config["base_url"] = base_url() . "admin/Documents/outgoing";
        $config["total_rows"] = $this->dts->count_doc_outgoing($staff);
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
        $data['posts'] = $this->dts->get_doc_outgoing($config["per_page"], $page, $staff);

        $data['get_id_staffs'] = $this->dts->get_my_division($staff);

        $data['staffs'] = $this->dts->get_staff_details();
        $data['count'] =  $this->dts->count_doc_outgoing($staff);

        $this->parser->parse('admin/Documents/outgoing_page', $data);
    }

    public function search_outgoing()
    {
        $staff = $this->session->userdata('staff_id');
        $search = $this->input->post('search_doc');

        $data['count'] =  $this->dts->count_doc_outgoing($staff);
        $data['posts'] = $this->dts->search_outgoing_doc($search, $staff);
        $data['get_id_staffs'] = $this->dts->get_my_division($staff);

        $this->load->view('admin/Documents/outgoing_page', $data);
    }
    public function filter_docs()
    {
        $filter_type = $this->input->post('filter_doc');
        $staff = $this->session->userdata('staff_id');
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        if ($filter_type == 1) {
            $data['count'] =  $this->dts->count_doc_outgoing($staff);
            $data['posts'] = $this->dts->filter_incoming($staff, $page);
            $data['get_id_staffs'] = $this->dts->get_my_division($staff);
        }
        echo json_encode($data);
        $this->load->view('admin/Documents/outgoing_page', $data);
    }



    // View Document page ====================================================================================

    public function viewDoc($dd_id)
    {
        $data = array(
            'type_documents' => $this->dts->get_type_document(),
            'doc_details' => $this->dts->view_get_details($dd_id),
            'doc_reply' =>  $this->dts->get_document_reply($dd_id),
            'action_messages' =>  $this->dts->get_document_reply($dd_id),
            'type_action_takens' => $this->dts->get_action_taken(),
            'staffs' =>  $this->dts->get_staff_details(),
            'staff_id' =>  $this->session->userdata('staff_id')
        );
        $stap = $this->dts->get_staff_details();
        // $data['staffIds'] = array_column($stap, 'staff_id');
        $staf = $data['doc_details']['dd_routed_to'];
        $data['specificValues'] = explode(', ', $staf);
        // $data['available_staff'] = $this->dts->get_available_staff($dd_id);

        //get division per doc details - updated code (Grant)
        $dd_staff = $data['doc_details']['dd_encoded_doc'];
        $data['div'] = $this->dts->get_staff_division($dd_staff);
        $ddFile = $data['div']['lname']; //get Last Name of the User who creates the route
        $data['dd_lname'] = str_replace(" ", "_", trim($ddFile));
        $dd_div = $data['div']['division'];
        $data['get_s_division'] = $this->dts->get_s_division($dd_div);
        $division = $data['get_s_division']['sd_code_name'];
        $data['dd_division'] = trim($division);
        //get division and last name
        $v_staff = $data['doc_details']['dd_doc_id_code'];
        $data['v_stap'] = $v_staff;
        $v_word = str_word_count($v_staff, 1);
        $get_word = $v_word[0];
        $data['v_words'] = preg_replace('/- *$/ismU', "", trim($get_word));

        $v_img = $data['doc_details']['dd_filename'];
        $file_name = trim($v_img, " |");
        $parts = explode("-", $file_name);
        $data['parts'] = explode("-", $file_name);
        $v_imgs = str_word_count($v_img, 1);
        if ($v_imgs == null) { //Check if all files in the document is remove
            $get_img = '';
        } else {
            $get_img = $v_imgs[0];
        }
        $data['divfold'] = $parts[0];
        $data['get'] = $v_imgs;
        $data['get_imgs'] = preg_replace('/- *$/ismU', " ", trim($get_img));

        $user_logged = $this->session->userdata('staff_id');
        if (!in_array($user_logged, explode(',', $staf))) {
            $data['heading'] = 'Access Denied';
            $data['message'] = 'You are not authorized to view this document.';

            $this->load->view('errors/html/error_general', $data);

            // redirect('admin/dashboard');
        } else {
            $this->load->view('admin/Documents/view_doc', $data);
        }
    }

    public function delete_file_attachment($file_name, $dd_id)
    {
        $data['exist'] = $this->dts->get_file_attachment($dd_id);

        $remove_file = '|' . $file_name . '|';
        $original = $data['exist']['dd_filename'];
        $files_array = str_replace($remove_file, '', $original);

        $this->dts->update_file($files_array, $dd_id);

        $this->session->set_flashdata('deleted', 'File has been deleted successfully...');

        redirect(base_url() . "admin/Documents/viewDoc/" . $dd_id);
    }

    public function delete_file_pending()
    {
        if ($this->input->is_ajax_request()) {
            $file_name = $this->input->post('del_filename');
            $dd_id = $this->input->post('doc_id');


            $exist = $this->dts->get_file_attachment($dd_id);

            $remove_file = '|' . $file_name . '|';
            $original = $exist['dd_filename'];
            $files_array = str_replace($remove_file, '', $original);

            $this->dts->update_file($files_array, $dd_id);

            $data = array('response' => "success",);

            echo json_encode($data['response']);
            // log_message('debug', 'Data File: ' . print_r($this->dts->update_file($files_array, $dd_id), true));
        }
        // redirect(base_url() . "admin/Documents/updateDoc/" . $dd_id);
    }

    public function complate_doc($dd_id)
    {
        $doc_reply = $this->dts->get_document_reply($dd_id);
        $doc_details = $this->dts->view_get_details($dd_id);
        $action = $this->input->post('action');

        $doc_sender = $doc_details['dd_encoded_doc'];
        $staff_id = $this->session->userdata('staff_id');

        if ($action == 'complete') {
            if (empty($doc_reply)) {
                $this->session->set_flashdata('error', 'No Conversation or File Uploaded found');
                redirect(base_url() . "admin/Documents/viewDoc/" . $dd_id);
            } else {
                if ($staff_id != $doc_sender) {
                    $doc_status = '5'; //Pending Complete
                    $this->dts->complate_file($dd_id, $doc_status); //update status to pending complete
                    $this->session->set_flashdata('success', 'This file has been requested to tag as completed!');
                    redirect(base_url() . "admin/Documents/viewDoc/" . $dd_id);
                } elseif ($staff_id == $doc_sender) {
                    $doc_status = '4'; //Completed
                    $this->dts->complate_file($dd_id, $doc_status); //completed
                    $this->session->set_flashdata('success', 'This file has been completed!');
                    redirect(base_url() . "admin/Documents/viewDoc/" . $dd_id);
                    log_message('debug', 'Data File: ' . print_r($staff_id, true) . 'as' . print_r($doc_sender, true));
                }
            }
        }elseif ($action == 'pending') {
            $doc_status = '1'; //mark pending
            $this->dts->complate_file($dd_id, $doc_status); //mark pending
            $this->session->set_flashdata('success', 'This file has mark pending!');
            redirect(base_url() . "admin/Documents/viewDoc/" . $dd_id);
            // log_message('debug', 'Data File: ' . print_r($staff_id, true) . 'as' . print_r($doc_sender, true));
        
        } 
    }

    public function generate_routing($dd_id)
    {
        $data['doc_reply'] = $this->dts->get_document_reply($dd_id);

        $this->load->library('pdf');
        $image = $_SERVER['DOCUMENT_ROOT'] . "/ddocts/assets/cwc/cwc-logo.png";
        $imagedata = base64_encode($image);
        $data['imgpath'] = '<img src="data:image/png;base64, ' . $imagedata . '">';
        date_default_timezone_set('Asia/Manila');
        $date_now = date('Y-m-d H:i:s', time());
        $data['title'] = 'Test';
        $html = $this->load->view('admin/print_template/routing_slip', $data, true);
        $filename = 'Routing Slip';
        $this->pdf->generate($html, $filename, true, 'A4', 'portrait');
    }

    public function viewDoc_process($dd_id)
    {

        $data['get_other_data'] = $this->dts->get_data_type_doc_other($dd_id);
        $doc_title = $data['get_other_data']['dd_title'];
        $doc_no = $data['get_other_data']['dd_doc_id_code'];
        $id_to_staff = $data['get_other_data']['dd_routed_to']; //for email

        $staff = $this->session->userdata('staff_id');
        $oed_other = '2';

        $dispatch_doc = $this->input->post('dispatch', TRUE) == null ? '0' : '1';
        $my_division = $this->input->post('my_div');
        $doc_current_status = $this->input->post('doc_status');
        $doc_current_action =  implode(', ', $this->input->post('doc_action[]'));
        $notes = $this->input->post('editorDocAction');
        date_default_timezone_set('Asia/Manila');
        $date_now = date('Y-m-d H:i:s');

        $datepicker = date("M-d-Y h:i A", strtotime($date_now));
        $date_recieve = $datepicker;

        switch ($doc_current_status) {
            case 2:
                $label = 'On Process';
                break;
            case 3:
                $label = "Re-process";
                break;
            case 4:
                $label = "Completed (Released document)";
                break;
            default:
                $label = "ERROR";
                break;
        }

        $this->dts->process_action($dd_id, $staff, $notes, $doc_current_status, $doc_current_action, $oed_other, $date_now, $doc_title, $doc_no, $id_to_staff, $my_division, $dispatch_doc);

        $staff_datas = explode(", ", $id_to_staff);
        $source_email = '';
        foreach ($staff_datas as $myid) {
            $data = $this->dts->routed_details($myid);

            $source_email .= $data['official_email'] . ', ';
            $source_emails =  substr($source_email, 0, -2);
        }
        $source_staffs_email = explode(", ", $source_emails);

        $emails = array();
        foreach ($source_staffs_email as $test1) {
            array_push($emails, $test1);
        }

        //        $this->load->library('email');
        //            $config = Array(
        //                'mailtype' => 'html',
        //                'protocol' => 'smtp',
        //                'smtp_host' => 'ssl://smtp.googlemail.com',
        //                'smtp_port' => 465,
        //                'smtp_user' => 'cwcwebsite@cwc.gov.ph', // change it to yours
        //                'smtp_pass' =>  'Cwch1ldr3n2022', // change it to yours
        //                'charset' => 'iso-8859-1',
        //                'wordwrap' => TRUE
        //            );

        $subject = "" . $doc_no . " (Document Notification)";
        $test['doc_title'] = $doc_title;
        $test['doc_number'] = $doc_no;
        $test['date'] = $date_recieve;
        $test['staff_id'] = $staff;
        switch ($doc_current_status) {
            case "1":
                $test['doc_status1'] = '<b style="color:#E00621;">PENDING</b>';
                break;
            case "2":
                $test['doc_status1'] = '<b style="color:#04E1D0;">ON PROCESS</b>';
                break;
            case "3":
                $test['doc_status1'] = '<b style="color:#0644C8;">RE-PROCESS</b>';
                break;
            case "4":
                $test['doc_status1'] = '<b style="color:#04AA13;">COMPLETED (OUTGOING)</b>';
                break;
            default:
                $test['doc_status1'] = 'ERROR';
        }

        //            $this->data['data'] = $test;
        //            $message1 = $this->load->view('admin/Email_Template/email_doc_process', $this->data,  TRUE);

        //            $this->email->initialize($config);

        //            $this->load->library('email',$config);
        //            $this->email->set_newline("\r\n");
        //            $this->email->from('cwcwebsite@cwc.gov.ph','DDOCTS-NO-REPLY'); // change it to yours
        // $this->email->reply_to('scflg-kms@cwcgov.com', 'SCFLG-KMS');

        //            $this->email->to($emails);// change it to yours

        //            $this->email->subject($subject);
        //            $this->email->message($message1);
        //            if($this->email->send()){
        //Success email Sent
        $this->session->set_flashdata('process_success', 'Document process successfully!');
        redirect(base_url() . "admin/Documents/viewDoc/" . $dd_id);
        //             }else{
        //Email Failed To Send
        //                echo $this->email->print_debugger();
        //             }


    }

    public function viewDoc_reply_notes($dd_id)
    {
        $data['doc_reply_notes'] = $this->dts->get_data_type_doc_other($dd_id);
        $doc_title = $data['doc_reply_notes']['dd_title'];
        $doc_no = $data['doc_reply_notes']['dd_doc_id_code'];
        $id_to_staff = $data['doc_reply_notes']['dd_routed_to']; //for email
        $doc_current_status = $data['doc_reply_notes']['dd_status'];
        $doc_current_action =  $data['doc_reply_notes']['dd_action_taken'];

        $staff = $this->input->post('get_my_staff');
        $oed_other = $this->input->post('oed_other');
        $notes = $this->input->post('editor1');
        date_default_timezone_set('Asia/Manila');
        $date_now = date('Y-m-d H:i:s');
        $my_division = $this->input->post('my_div');
        $lname = $this->session->userdata('staff_lname');
        $staff = $this->session->userdata('staff_id');

        $add_reply_doc = $this->input->post('reply_type_doc') == 'Select' ? '0' : $this->input->post('reply_type_doc'); // Get Doc Type
        $document_type = $this->dts->get_bundle($add_reply_doc); // Get Doc Type
        $document_code = $document_type['dt_code'];
        $today = date("Ymd"); // Get Today Date
        // FILE UPLOAD
        $data = array();
        $filesCount = count($_FILES['files']['name']);
        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['file']['name']     = $_FILES['files']['name'][$i];
            $_FILES['file']['type']     = $_FILES['files']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
            $_FILES['file']['error']     = $_FILES['files']['error'][$i];
            $_FILES['file']['size']     = $_FILES['files']['size'][$i];

            $doc_directory = "./assets/upload/" . $my_division . "/" . $lname . "/";
            if (!file_exists("./assets/upload/" . $my_division . "/" . $lname . "/")) {
                mkdir("./assets/upload/" . $my_division . "/" . $lname . "/", 0777, true);
            }

            //upload files
            $config['upload_path'] = $doc_directory;
            $config['allowed_types'] = 'pdf|doc|docx|png|jpg|jpeg|ppt|pptx|tiff|xls|xlsx|zip';
            $config['remove_spaces'] = TRUE;
            $config['max_size'] = '0';

            $token = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
            $temp = explode(".", $_FILES["file"]["name"]);
            $new_name = $document_code . '-' . $today . '-' . $token .  '.'  . end($temp);

            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if ($this->upload->do_upload('file')) {
                // Uploaded file data
                $fileData = $this->upload->data();
                $uploadData[$i]['file_name'] = $fileData['file_name'];
            }
        }
        $file_z = '';
        if (!empty($uploadData)) {
            foreach ($uploadData as $f) {
                $file_z .= '|' . $f['file_name'] . '|';
            }
            $files_new = $file_z;
        } else {
            $files_new = $file_z;
        }

        $this->dts->reply_notes($dd_id, $staff, $notes, $oed_other, $date_now, $doc_title, $doc_no, $files_new, $my_division, $doc_current_status, $doc_current_action, $id_to_staff);

        $datepicker = date("M-d-Y h:i A", strtotime($date_now));
        $date_recieve = $datepicker;

        $staff_datas = explode(", ", $id_to_staff);
        $source_email = '';
        foreach ($staff_datas as $myid) {
            $data = $this->dts->routed_details($myid);

            $source_email .= $data['official_email'] . ', ';
            $source_emails =  substr($source_email, 0, -2);
        }
        $source_staffs_email = explode(", ", $source_emails);

        $emails = array();
        foreach ($source_staffs_email as $test1) {
            array_push($emails, $test1);
        }

        //        $this->load->library('email');
        //            $config = Array(
        //                'mailtype' => 'html',
        //                'protocol' => 'smtp',
        //                'smtp_host' => 'ssl://smtp.googlemail.com',
        //                'smtp_port' => 465,
        //                'smtp_user' => 'cwcwebsite@cwc.gov.ph', // change it to yours
        //                'smtp_pass' =>  'Cwch1ldr3n2022', // change it to yours
        //                'charset' => 'iso-8859-1',
        //                'wordwrap' => TRUE
        //            );

        $subject = "" . $doc_no . " (Document Notification)";
        $test['doc_title'] = $doc_title;
        $test['doc_number'] = $doc_no;
        $test['date'] = $date_recieve;
        $test['staff_id'] = $staff;
        $test['reply'] = $this->session->userdata('staff_fname') . ' ' . $this->session->userdata('staff_lname') . ' reply a message on this document.';
        switch ($doc_current_status) {
            case "1":
                $test['doc_status1'] = '<b style="color:#E00621;">PENDING</b>';
                break;
            case "2":
                $test['doc_status1'] = '<b style="color:#04E1D0;">ON PROCESS</b>';
                break;
            case "3":
                $test['doc_status1'] = '<b style="color:#0644C8;">RE-PROCESS</b>';
                break;
            case "4":
                $test['doc_status1'] = '<b style="color:#04AA13;">COMPLETED (OUTGOING)</b>';
                break;
            default:
                $test['doc_status1'] = 'ERROR';
        }

        //            $this->data['data'] = $test;
        //            $message1 = $this->load->view('admin/Email_Template/email_message_doc', $this->data,  TRUE);

        //            $this->email->initialize($config);

        //            $this->load->library('email',$config);
        //            $this->email->set_newline("\r\n");
        //            $this->email->from('cwcwebsite@cwc.gov.ph','DDOCTS-NO-REPLY'); // change it to yours
        // $this->email->reply_to('scflg-kms@cwcgov.com', 'SCFLG-KMS');

        //            $this->email->to($emails);// change it to yours

        //            $this->email->subject($subject);
        //            $this->email->message($message1);
        //            if($this->email->send()){
        //Success email Sent
        $this->session->set_flashdata('message_success', 'Reply Message successful!');
        redirect(base_url() . "admin/Documents/viewDoc/" . $dd_id);
        //             }else{
        //Email Failed To Send
        //                echo $this->email->print_debugger();
        //             }

    }

    public function file_attachment($dd_id, $my_division, $lname)
    {
        $checkifExisiting = $this->dts->get_file_attachment($dd_id);

        $add_doc = $this->input->post('add_doc') == 'Select' ? '0' : $this->input->post('add_doc'); // Get Doc Type
        $document_type = $this->dts->get_bundle($add_doc); // Get Doc Type
        $document_code = $document_type['dt_code'];

        $today = date("Ymd"); // Get Today Date
        // FILE UPLOAD
        $data = array();
        $filesCount = count($_FILES['files']['name']);
        log_message('debug', 'File count: ' . print_r($_FILES['files']['name'], true));
        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['file']['name']     = $_FILES['files']['name'][$i];
            $_FILES['file']['type']     = $_FILES['files']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
            $_FILES['file']['error']     = $_FILES['files']['error'][$i];
            $_FILES['file']['size']     = $_FILES['files']['size'][$i];

            $doc_directory = "./assets/upload/" . urldecode($my_division) . "/" . $lname . "/";
            if (!file_exists("./assets/upload/" . urldecode($my_division) . "/" . $lname . "/")) {
                mkdir("./assets/upload/" . urldecode($my_division) . "/" . $lname . "/", 0777, true);
            }

            //upload files
            $config['upload_path'] = $doc_directory;
            $config['allowed_types'] = 'pdf|doc|docx|png|jpg|jpeg|ppt|pptx|tiff|xls|xlsx|zip';
            $config['remove_spaces'] = TRUE;
            $config['max_size'] = '0';


            $uploaderLname = $this->session->userdata('staff_lname'); // get the logged in user's last name
            $token = substr(number_format(time() * rand(), 0, '', ''), 0, 6); //Random Numbers (Previous File name)
            $temp = explode(".", $_FILES["file"]["name"]);
            $new_name = $document_code . '-' . $today . '-' . $token .  '.'  . end($temp);

            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if ($this->upload->do_upload('file')) {
                // Uploaded file data
                $fileData = $this->upload->data();
                $uploadData[$i]['file_name'] = $fileData['file_name'];
            }
        }
        $file_z = '';
        if (!empty($uploadData)) {
            foreach ($uploadData as $f) {
                $file_z .= '|' . $f['file_name'] . '|';
            }
            $files_array_new = $file_z;
        } else {
            $files_array_new = $file_z;
        }

        if ($checkifExisiting == TRUE) {
            if (!empty($checkifExisiting['dd_filename'])) {
                if ($checkifExisiting['dd_filename'] !== '||') {
                    $files_array = $checkifExisiting['dd_filename']  . $files_array_new;
                } else {
                    $files_array = $files_array_new;
                }
            } else {
                $files_array = $files_array_new;
            }

            $this->dts->update_files_array($files_array, $dd_id);
        }

        $this->session->set_flashdata('success', 'File has been uploaded successfully...');
        redirect(base_url() . "admin/Documents/viewDoc/" . $dd_id);
    }

    // view more Document page ====================================================================================
    public function viewMore()
    {
        $staff = $this->session->userdata('staff_id');
        $data['get_id_staffs'] = $this->dts->get_my_division($staff);

        $fname = $this->session->userdata('staff_fname');
        $lname = $this->session->userdata('staff_lname');
        $staff_recieve = $fname . " " . $lname;

        $data['count'] =  $this->dts->count_recieve($staff_recieve);

        $data['staffs'] = $this->dts->get_staff_details();

        $this->load->view('admin/Documents/view_more', $data);
    }


    public function search_doc()
    {
        $doc_id = $this->input->post('doc_id');
        $sess = $this->session->userdata('staff_id');
        $data['get_divs'] = $this->dts->get_docList($doc_id);

        $ducoment_type = $data['get_divs']['dd_doct_type'];
        $ddid = $data['get_divs']['dd_id'];
        $ddtitle = $data['get_divs']['dd_title'];
        $dd_source_id = $data['get_divs']['dd_source'];
        $dd_view_id = $data['get_divs']['dd_view_doc'];
        $dd_encode = $data['get_divs']['dd_encoded_doc'];
        $taken_id = $data['get_divs']['dd_action_taken'];
        $date = $data['get_divs']['dd_date_encoded'];
        $staff_name = $data['get_divs']['dd_staff_name'];
        $con_note = $data['get_divs']['dd_note'];

        //document type ====================================================================================
        if ($ducoment_type == 0) {
            $dd_docbundle = $data['get_divs']['dd_bundleDocs'];
            $dd_docbundle_get = explode(", ", $dd_docbundle);

            $dd_docbundle_g = '';
            foreach ($dd_docbundle_get as $dd_docbundle_ge) {
                $data = $this->dts->get_bundle($dd_docbundle_ge);
                $dd_docbundle_g .= $data['dt_name'] . ', ';
                $dd_doc =  substr($dd_docbundle_g, 0, -2);
            }
            $dd_document = $dd_doc;
        } else {
            $dd_document = $data['get_divs']['dt_name'];
        }
        //source 
        $dd_source_get = explode(", ", $dd_source_id);
        $source = '';
        foreach ($dd_source_get as $mysource) {
            $data = $this->dts->mysources($mysource);
            $source .= $data['ds_code'] . ', ';
            $source_name =  substr($source, 0, -2);
        }
        $s_name = $source_name;
        //document type
        $dd_action_id = explode(", ", $taken_id);
        $dd_action_name = '';
        foreach ($dd_action_id as $dd_action) {
            $data = $this->dts->get_action($dd_action);
            $dd_action_name .= $data['da_name'] . ', ';
            $action_name =  substr($dd_action_name, 0, -2);
        }
        $a_name = $action_name;
        //Document Recieved Date
        $datepicker = date("M-d-Y h:i A", strtotime($date));
        $date_recieve = $datepicker;


        $data = array(
            'dd_id'   => $ddid,
            'dd_title'   => $ddtitle,
            'dd_doct_type'   => $dd_document,
            'dd_source'   => $s_name,
            'dd_view_doc'   => $dd_view_id,
            'dd_encode_doc'   => $dd_encode,
            'sess'   => $sess,
            'dd_action_taken'   => $a_name,
            'dd_date_routed'   => $date_recieve,
            'dd_staff_name'   => $staff_name,
            'dd_note'   => $con_note
        );

        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data);
    }

    // view search Document page ====================================================================================
    public function search()
    {
        $this->load->view('admin/Documents/view_search');
    }

    public function search_documents()
    {
        $staff = $this->session->userdata('staff_id');
        $searchdoc = $this->input->post('my_searchdoc');
        $user = $this->dts->get_searchdoc($searchdoc, $staff);

        header('Content-Type: application/json;charset=utf-8');
        if ($user != false) {
            $data = json_encode($user, JSON_PRETTY_PRINT);
            $output = $data;
        } else {
            $output = $user;
        }
        echo $output;
    }

    public function display_doc()
    {
        $docs_id = $this->input->post('docs_id');
        $data['search_doc'] = $this->dts->display_docs($docs_id);

        $ducoment_type = $data['search_doc']['dd_doct_type'];
        $ddid = $data['search_doc']['dd_id'];
        $ddtitle = $data['search_doc']['dd_title'];
        $dd_source_id = $data['search_doc']['dd_source'];
        $dd_view_id = $data['search_doc']['dd_view_doc'];
        $taken_id = $data['search_doc']['dd_action_taken'];
        $date = $data['search_doc']['dd_date_encoded'];
        $con_staff = $data['search_doc']['dd_staff_name'];
        $con_note = $data['search_doc']['dd_note'];
        $doc_id = $data['search_doc']['dd_doc_id_code'];
        $doc_recieve = $data['search_doc']['dd_recieved_doc'];

        switch ($data['search_doc']['dd_status']) {
            case 0:
                $status = '<div class="alert alert-danger-soft show flex items-center mb-2" role="alert"> For Recieving </div>';
                break;
            case 1:
                $status = '<div class="alert alert-danger-soft show flex items-center mb-2" role="alert">  Pending </div>';
                break;
            case 2:
                $status = '<div class="alert alert-warning-soft show flex items-center mb-2" role="alert">  On Process </div>';
                break;
            case 3:
                $status = '<div class="alert alert-primary show flex items-center mb-2" role="alert"> Re-process </div>';
                break;
            case 4:
                $status = '<div class="alert alert-success show flex items-center mb-2" role="alert"> Completed (Released doc.)</div>';
                break;
            default:
                $status = "ERROR";
                break;
        }


        //document type
        if ($ducoment_type == 0) {
            $dd_docbundle = $data['search_doc']['dd_bundleDocs'];
            $dd_docbundle_get = explode(", ", $dd_docbundle);

            $dd_docbundle_g = '';
            foreach ($dd_docbundle_get as $dd_docbundle_ge) {
                $data = $this->dts->get_bundle($dd_docbundle_ge);
                $dd_docbundle_g .= $data['dt_name'] . ', ';
                $dd_doc =  substr($dd_docbundle_g, 0, -2);
            }
            $dd_document = $dd_doc;
        } else {
            $dd_document = $data['search_doc']['dt_name'];
        }
        //source
        $dd_source_get = explode(", ", $dd_source_id);
        $source = '';
        foreach ($dd_source_get as $mysource) {
            $data = $this->dts->mysources($mysource);
            $source .= $data['ds_code'] . ', ';
            $source_name =  substr($source, 0, -2);
        }
        $s_name = $source_name;
        //document type
        $dd_action_id = explode(", ", $taken_id);
        $dd_action_name = '';
        foreach ($dd_action_id as $dd_action) {
            $data = $this->dts->get_action($dd_action);
            $dd_action_name .= $data['da_name'] . ', ';
            $action_name =  substr($dd_action_name, 0, -2);
        }
        $a_name = $action_name;
        //Document Recieved Date
        $datepicker = date("M-d-Y h:i A", strtotime($date));
        $date_recieve = $datepicker;

        $data = array(
            'dd_id'   => $ddid,
            'dd_title'   => $ddtitle,
            'dd_doct_type'   => $dd_document,
            'dd_source'   => $s_name,
            'dd_view_doc'   => $dd_view_id,
            'dd_action_taken'   => $a_name,
            'dd_date_routed'   => $date_recieve,
            'dd_routed_to'   => $con_staff,
            'dd_note'   => $con_note,
            'dd_status'   => $status,
            'dd_recieved_doc'   => $doc_recieve,
            'dd_doc_id_code'   => $doc_id
        );

        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data);
    }
}
