<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
 
	public function __construct(){
        parent::__construct();
        if (!$this->session->userdata('isLogin')) {  
            redirect('Login'); 
        }
       
        $this->config->config["pageTitle"] = 'CWC-DDocTS - Dashboard'; //page title 
        $this->load->model('Model_dashboard', 'dashboard'); 
        
    }

	public function index(){ 
        $staf_get = $this->session->userdata('staff_id');
        
        $data['staff_details'] = $this->dashboard->get_my_division($staf_get);

        $data['get_id_staffs'] = $this->dashboard->get_my_division($staf_get);

        $data['get_my_historys'] = $this->dashboard->get_my_history($staf_get);

        $data['limit_docs'] = $this->dashboard->limit_doc($staf_get);
        
        $data['staffs'] = $this->dashboard->get_staff_details(); 
        
        $this->load->view('admin/dashboard_page', $data);
    }

    public function recieve_doc(){

        $get_doc = $this->input->post('get_id');
        $name_doc = $this->input->post('get_name');
        $this->dashboard->recieve_docs($get_doc,$name_doc);

        // Set message
        $this->session->set_flashdata('sucs_doc', $get_doc);
        redirect('admin/Dashboard');
    }

    public function disregard_doc(){
        $get_doc = $this->input->post('get_id');
        $name_doc = $this->input->post('get_name');
        $editor1 = $this->input->post('editor1');
        $this->dashboard->disregard_docs($get_doc,$name_doc,$editor1);

        // Set message
        $this->session->set_flashdata('disregard_suc', 'This document remove to your Routed Documents');
        redirect('admin/Dashboard');
    }

    public function remove_disregard(){

        $get_doc = $this->input->post('get_id');
        $name_doc = $this->input->post('get_name');
        $this->dashboard->remove_disregards($get_doc,$name_doc);

        // Set message
        $this->session->set_flashdata('remove_dis', 'This document has remove on the disregard list!');
        redirect('admin/Dashboard');
    }
    
	public function records(){
		$this->load->view('admin/dashboard_records_page');
	}

	public function logout(){
        $this->session->sess_destroy();
        redirect('Login');
    }

    // notification 
    public function getNotif(){

        $staff = $this->session->userdata('staff_id');
        date_default_timezone_set('Asia/Manila');
		$date_now = date('Y-m-d H:i:s', time());

        if($this->input->post("view") != ''){
           $sql = 'UPDATE notification SET read_notif = 1, read_date = '.$date_now.' like account_id = '.$staff.' and read_notif = 0';
           $this->db->query($sql);
        }

        $notif = $this->dashboard->list_notif($staff);
        $output = '';
        if($notif->num_rows() > 0){
             foreach($notif->result_array() as $row){
               if($row["function_method"] == 'MODULE_DTS'){
                  $url1 = base_url().'admin/Documents/viewDoc/';
                }else{
                 $url1='#';
               }

               
               $post = $row['reg_date'];
               //Let's set the current time
               date_default_timezone_set('Asia/Manila');
               $date_now = date('Y-m-d H:i:s', time());
               $toTime = strtotime($date_now);

               //And the time the notification was set
               $fromTime = strtotime($post);

               //Now calc the difference between the two
               $timeDiff = floor(abs($toTime - $fromTime) / 60);

               //Now we need find out whether or not the time difference needs to be in
               //minutes, hours, or days
               if ($timeDiff < 2) {
                   $timeDiff = "Just now";
               } elseif ($timeDiff > 2 && $timeDiff < 60) {
                   $timeDiff = floor(abs($timeDiff)) . " minutes ago";
               } elseif ($timeDiff > 60 && $timeDiff < 120) {
                   $timeDiff = floor(abs($timeDiff / 60)) . " hour ago";
               } elseif ($timeDiff < 1440) {
                   $timeDiff = floor(abs($timeDiff / 60)) . " hours ago";
               } elseif ($timeDiff > 1440 && $timeDiff < 2880) {
                   $timeDiff = floor(abs($timeDiff / 1440)) . " day ago";
               } elseif ($timeDiff > 2880) {
                   $timeDiff = floor(abs($timeDiff / 1440)) . " days ago";
               }

               $timeand_date_pickers = $timeDiff;

               $image = base_url().'assets/template/images/doc_icon.png';

               
               $output .= '<div class="cursor-pointer relative flex items-center mt-5">
                    <a href="'.$url1.$row["transaction_id"].'">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="'.$image.'">
                        <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    </a>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="'.$url1.$row["transaction_id"].'" class="font-medium truncate mr-5">'.$row["added_by"].'</a> 
                            <div class="text-xs text-gray-500 ml-auto whitespace-nowrap">'.$timeand_date_pickers.'</div>
                        </div>
                        <div class="w-full truncate text-gray-600 mt-0.5">'.$row["action_message"].'</div>
                    </div>
                </div>';
             }          

        }else{
          $image = base_url().'assets/template/images/doc_icon.png';
          $output = '<div class="cursor-pointer relative flex items-center mt-5">
                <div class="w-12 h-12 flex-none image-fit mr-1">
                    <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="'.$image.'">
                    <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                </div>
                <div class="ml-2 overflow-hidden">
                    <div class="w-full truncate text-gray-600 mt-0.5"> No Notification Found!</div>
                </div>
            </div>';
        }

        //$output = $data_notif1;
        $data = array(
         'notification'   => $output
        );

        header('Content-type: application/json'); 
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        echo json_encode($data); 
   }

    public function view_all_history(){
        $staff = $this->session->userdata('staff_id');
        $data['all_historys'] = $this->dashboard->m_all_historys($staff);
        $data['staffs'] = $this->dashboard->get_staff_details(); 

        $this->load->view('admin/view_all_history', $data);
    }

    public function view_all_notif(){
        $staff = $this->session->userdata('staff_id');
        $data['all_notifs'] = $this->dashboard->m_all_notifs($staff);

        $this->load->view('admin/view_all_notification', $data);
    }

    public function view_profile(){
        $this->load->view('admin/view_profile');
    }

   



}


