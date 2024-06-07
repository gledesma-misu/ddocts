<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {
 
	public function __construct(){
        parent::__construct(); 
        if (!$this->session->userdata('isLogin')) { 
            redirect('Login'); 
        }
      
        $this->load->model('Model_admin', 'admin'); 
    }

    // -------------  Document Source Page  ----------------
 
    public function index(){ 
    	$data['sources_docs'] = $this->admin->sources_doc();
    	$data['request_docs'] = $this->admin->request_doc();
        $data['staffs'] = $this->admin->get_staff_details(); 

        $this->load->view('admin/Administrator/view_source', $data);
    }

    public function delete_doc($id){
    	$this->admin->delete_source($id);
        // Set message 
        $this->session->set_flashdata('source_deleted', 'Soruce Document deleted Successful!');

        redirect('admin/administrator');
    }

    public function create_doc(){
    	$source = $this->input->post('source'); 
        $sub = $this->input->post('source_sub');
    	$type = $this->input->post('source_type'); 
    	$code = $this->input->post('source_code'); 

    	 $this->admin->insertSouce($source,$type,$code,$sub);
        // Set message 
        $this->session->set_flashdata('source_created', 'Source Document Created Successful!');

        redirect('admin/administrator');
    }

    public function update_doc($id){
    	$source = $this->input->post('u_soruce'); 
    	$type = $this->input->post('type'); 
    	$code = $this->input->post('code'); 
        $sub = $this->input->post('sub'); 

    	 $this->admin->updateSouce($source,$type,$code,$sub,$id);
        // Set message 
        $this->session->set_flashdata('source_updated', 'Soruce Document Updated Successful!');

        redirect('admin/administrator');
    }

    public function request_doc($id){
    	$source = $this->input->post('r_source'); 
    	$type = $this->input->post('r_type'); 
    	$code = $this->input->post('r_code'); 
        $sub = $this->input->post('r_sub'); 

    	 $this->admin->requestSouce($source,$type,$code,$sub,$id);
        // Set message 
        $this->session->set_flashdata('source_Request', 'Request Soruce Document Created Successful!');

        redirect('admin/administrator');
    }

    // ------------- End Document Source Page  ----------------

    // ------------- Type Document Page  ----------------

    public function typeDoc(){
        $data['type_docs'] = $this->admin->type_doc();
        $data['type_doc_categories'] = $this->admin->type_doc_category();

        $this->load->view('admin/Administrator/view_type_doc', $data);
    }

    public function type_create(){
        $type_docs = $this->input->post('type_doc'); 
        $type_cates = $this->input->post('type_cate'); 

         $this->admin->insertType($type_docs,$type_cates);
        // Set message 
        $this->session->set_flashdata('type_created', 'Document Type Created Successful!');

        redirect('admin/administrator/typeDoc');
    }

    public function update_type($id){
        $u_name_type = $this->input->post('u_name_type'); 
        $u_cate = $this->input->post('u_cate');

        $this->admin->updateType($u_name_type,$u_cate,$id);
        // Set message 
        $this->session->set_flashdata('type_updated', 'Document Type Updated Successful!');

        redirect('admin/administrator/typeDoc');
    }

    public function delete_type($id){
        $this->admin->delete_type($id);
        // Set message 
        $this->session->set_flashdata('type_deleted', 'Document Type deleted Successful!');

        redirect('admin/administrator/typeDoc');
    }
    
    // ------------- Action Document Page  ----------------

    public function actionDoc(){
        $data['action_docs'] = $this->admin->action_doc();

        $this->load->view('admin/Administrator/view_action_doc', $data);
    }

    public function action_create(){
        $actionName_doc = $this->input->post('actionName_doc'); 
        $actionCode_doc = $this->input->post('actionCode_doc'); 

         $this->admin->acType($actionName_doc, $actionCode_doc);
        // Set message 
        $this->session->set_flashdata('action_created', 'Action Document Created Successful!');

        redirect('admin/administrator/actionDoc');
    }

    public function action_remove($id){

        $this->admin->delete_action($id);
        // Set message 
        $this->session->set_flashdata('action_created', 'Action Document deleted Successful!');

        redirect('admin/administrator/actionDoc');
    }

    public function update_action($id){
        $ac_update = $this->input->post('ac_update'); 
        $co_update = $this->input->post('co_update');

        $this->admin->ActionType($ac_update,$co_update,$id);
        // Set message 
        $this->session->set_flashdata('action_created', 'Action Document Updated Successful!');

        redirect('admin/administrator/actionDoc');
    }

    // -------------  Document view_staff Page  ----------------

    public function register_new(){
        $data['staff_divisions'] = $this->admin->staff_division();
        $get_id_staffs =  $this->admin->getstaff_id();

        foreach($get_id_staffs as $get_id_staff){
            $data['count'] = $get_id_staff['staff_id'] + '1';
        }
        $this->load->view('admin/Administrator/view_register', $data);
    }

    public function reg_staff(){
        $username = $this->input->post('username'); 
        $password = md5($this->input->post('password'));
        $text_pass = $this->input->post('password');
        $email = $this->input->post('email'); 
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname'); 
        $address = $this->input->post('address');
        $em_no = $this->input->post('em_no'); 
        $gender = $this->input->post('gender');
        $em_position = $this->input->post('em_position'); 
        $dob = $this->input->post('dob');
        $get_division = $this->admin->get_staff_division($this->input->post('division'));
        $staff_id = $this->input->post('staff_id');


        $division = $get_division['sd_code'];
        $division_code = $get_division['sd_code_name'];
        $this->admin->insertnewstaff($username,$password,$text_pass,$email,$fname,$lname,$address,$em_no,$gender,$em_position,$dob,$division,$division_code,$staff_id);
        // Set message 
        $this->session->set_flashdata('success', 'New staff has been Added!');

        redirect('admin/administrator/register_new');
    }

    // -------------  Document register_new Page  ----------------
    public function view_staff(){
        $data['staff_divisions'] = $this->admin->staff_account();
        $data['staff_divs'] = $this->admin->staff_division();

        $this->load->view('admin/Administrator/view_staff', $data);
    }

    public function staff_status($id,$su){

        $this->admin->account_status($id,$su);
        // Set message 
        $this->session->set_flashdata('s_updated', 'Account Status has been Updated!');

        redirect('admin/administrator/view_staff');
    }

    public function staff_remove($id){

        $this->admin->account_remove($id);
        // Set message 
        $this->session->set_flashdata('s_remove', 'Account has been Remove!');

        redirect('admin/administrator/view_staff');
    }

    public function update_staff_account(){
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname'); 
        $em_no = $this->input->post('em_no'); 
        $position = $this->input->post('position');
        $email = $this->input->post('email');
        $get_division = $this->admin->get_staff_division($this->input->post('division'));
        $staff_id = $this->input->post('get_id');

        $division = $get_division['sd_code'];
        $division_code = $get_division['sd_code_name'];
        $this->admin->updateAccount($fname,$lname,$em_no,$position,$email,$division,$division_code,$staff_id);
        // Set message 
        $this->session->set_flashdata('success', 'Account has been updated!');

        redirect('admin/administrator/view_staff');
    }

    // ------------- End  ----------------

}