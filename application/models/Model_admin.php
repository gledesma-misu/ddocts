<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_admin extends CI_Model {

	// -------------   Source Document Page --------------------
	public function sources_doc(){ 
		$this->db->select('*');
	    $this->db->from('document_source');
	    $this->db->order_by("document_source.ds_date_added", "DESC");
	    $result = $this->db->get();
		return $result->result_array();
	}

	public function request_doc(){
		$this->db->select('*');
	    $this->db->from('request_doc_source');
	    $this->db->order_by("request_doc_source.rs_id", "desc");
	    $result = $this->db->get();
		return $result->result_array();
	}

	public function insertSouce($source,$type,$code,$sub){
        $data = array(
			'ds_name' => $source,
			'ds_type' => $type,
			'ds_sub' => $sub,
			'ds_code' => $code
        );

		$this->db->insert('document_source', $data); 
	}

	public function delete_source($id){
       $this->db->delete('document_source', array('ds_id' => $id)); 
	}

    public function updateSouce($source,$type,$code,$sub,$id){
        $data = array(
			'ds_name' => $source,
			'ds_type' => $type,
			'ds_sub' => $sub,
			'ds_code' => $code
        );

		$this->db->where('ds_id', $id);
      	return $this->db->update('document_source', $data);
	}

	public function requestSouce($source,$type,$code,$sub,$id){
        $data = array(
			'ds_name' => $source,
			'ds_type' => $type,
			'ds_sub' => $sub,
			'ds_code' => $code
        );

        $data1 = array(
			'rs_status' => '1'
        );

		$this->db->insert('document_source', $data); 
		$this->db->where('rs_id', $id);
      	return $this->db->update('request_doc_source', $data1);
	}

	// -------------   End Source Document Page --------------------

	// -------------   Action of Document Page -----------------------
	public function action_doc(){
		$this->db->select('*');
	    $this->db->from('document_action');
	    $this->db->order_by("document_action.da_id", "DESC");
	    $result = $this->db->get();
		return $result->result_array();
	}

	public function acType($actionName_doc, $actionCode_doc){
        $data = array(
			'da_name' => $actionName_doc,
			'da_code' => $actionCode_doc
        );

		$this->db->insert('document_action', $data); 
	}

	public function delete_action($id){
		$this->db->delete('document_action', array('da_id' => $id)); 
	}

	public function ActionType($ac_update,$co_update,$id){
        $data = array(
			'da_name' => $ac_update,
			'da_code' => $co_update
        );

		$this->db->where('da_id', $id);
      	return $this->db->update('document_action', $data);
	}
	

	// -------------   Type of Document Page -----------------------
	public function type_doc(){
		$this->db->select('*');
	    $this->db->from('document_type');
	    $this->db->order_by("document_type.dt_date_added", "DESC");
	    $result = $this->db->get();
		return $result->result_array();
	}

	public function type_doc_category(){
		$this->db->select('*');
	    $this->db->from('document_type_category');
	    $result = $this->db->get();
		return $result->result_array();
	}

	public function get_action($dd_action){
	    $this->db->select('*');
	    $this->db->from('document_type_category');
	    $this->db->like('document_type_category.dtc_id', $dd_action);
	    $result = $this->db->get();
	    return $result->row_array();
	}

	public function insertType($type_docs,$type_cates){
        $data = array(
			'dt_name' => $type_docs,
			'dt_category' => $type_cates
        );

		$this->db->insert('document_type', $data); 
	}

	public function updateType($u_name_type,$u_cate,$id){
        $data = array(
			'dt_name' => $u_name_type,
			'dt_category' => $u_cate
        );

		$this->db->where('dt_id', $id);
      	return $this->db->update('document_type', $data);
	}

	public function delete_type($id){
       $this->db->delete('document_type', array('dt_id' => $id)); 

	}

	// -------------  End Type of Document Page --------------------

	public function get_staff_details(){
		$this->db->select('*');
		$this->db->from('staff_details');
		$this->db->order_by("staff_details.staff_id", "desc");
		$result = $this->db->get();
		return $result->result_array();
 	}



	// -------------  Staff Registration Page --------------------
	public function staff_division(){
		$this->db->select('*');
	    $this->db->from('staff_division');
	    $result = $this->db->get();
		return $result->result_array();
	}

	public function get_staff_division($division){
		$this->db->select('*');
	  	$this->db->from('staff_division');
	  	$this->db->where('staff_division.sd_code',$division);
	  	$this->db->order_by("staff_division.sd_id", "desc");
	  	$result = $this->db->get();
		return $result->row_array();
  	}

	public function getstaff_id(){
		$this->db->select('*');
	    $this->db->from('staff_details');
		$this->db->limit(1);
    	$this->db->order_by("staff_id", "DESC");
	    $result = $this->db->get();
		return $result->result_array();
	}

	public function staff_account(){
		$this->db->select('*');
	    $this->db->from('account');
		$this->db->where('remove', '0');
		$this->db->order_by("id", "DESC");
	    $result = $this->db->get();
		return $result->result_array();
	}

	public function insertnewstaff($username,$password,$text_pass,$email,$fname,$lname,$address,$em_no,$gender,$em_position,$dob,$division,$division_code,$staff_id){

		date_default_timezone_set('Asia/Manila');  
		$date_now = date('Y-m-d H:i:s', time());

		$process_doc = 'NEW STAFF ADDED: Name: <b>'.$fname.' '.$lname.'</b> with Staff ID: <b style="color:green"> '.$staff_id.' </b>.';

		$data1 = array(
			'dh_doc_id' => $this->session->userdata('staff_id'),
			'dh_action' => $process_doc,
			'dh_reg_date' => $date_now
		);
	 	$this->db->insert('document_history', $data1);


		$data = array(
			'username' => $username, 
			'password' => $password,
			'text_pass' => $text_pass,
			'email' => $email,
			'fname' => $fname,
			'lname' => $lname,
			'address' => $address,
			'employee_no' => $em_no,
			'gender' => $gender,
			'position' => $em_position,
			'dob' => $dob,
			'division' => $division_code,
			'staff_id_account' => $staff_id,
			'reg_date' => $date_now
        );
		$this->db->insert('account', $data); 

		$data2 = array(
			'fname' => $fname,
			'lname' => $lname,
			'division' => $division,
			'official_email' => $email,
			'position' => $em_position,
			'reg_date' => $date_now
        );

		$this->db->insert('staff_details', $data2); 

	}

	public function account_status($id,$su){

		if($su == 0){
			$this->db->set('su', '1');
		}else{
			$this->db->set('su', '0');
		}

		$this->db->where('id', $id);
		$this->db->update('account');
	}

	public function account_remove($id){

		$this->db->set('remove', '1');
		$this->db->where('staff_id_account', $id);
		$this->db->update('account');
	}

	public function updateAccount($fname,$lname,$em_no,$position,$email,$division,$division_code,$staff_id){
		
		$this->db->set('fname', $fname);
		$this->db->set('lname', $lname);
		$this->db->set('employee_no', $em_no);
		$this->db->set('position', $position);
		$this->db->set('email', $email);
		$this->db->set('division', $division_code);
		$this->db->where('staff_id_account', $staff_id);
		$this->db->update('account');


		$this->db->set('fname', $fname);
		$this->db->set('lname', $lname);
		$this->db->set('position', $position);
		$this->db->set('official_email', $email);
		$this->db->set('division', $division);
		$this->db->where('staff_id', $staff_id);
		$this->db->update('staff_details');
		
	}



}