<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_api extends CI_Model {

	//website api model connection

	public function login_web($username, $password){
		
		date_default_timezone_set('Asia/Manila');
        	$date_now = date('Y-m-d H:i:s', time()); 

		$data = array(
        		'last_login' => $date_now
      		);

		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->update('account', $data);
		
		$this->db->select('*');
        $this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->from('account'); 
		$this->db->join('staff_details', 'staff_details.staff_id = account.staff_id_account','inner');
		$query = $this->db->get();
        	if($query->num_rows()==1) {
            		return $query->result();                
        	} else { 
            		return false;
        	}

	} 
	
	public function get_staff_details(){
		$this->db->select('*');
	    	$this->db->from('staff_details');
	    	$this->db->order_by("staff_details.staff_id", "desc");
	    	$result = $this->db->get();
		return $result->result_array();
	}

	public function routed_details($myid){
	    $this->db->select('staff_details.staff_id, staff_details.staff_fname, staff_details.staff_lname, staff_details.staff_official_email');
	    $this->db->from('staff_details');
	    $this->db->like('staff_details.staff_id', $myid);
	    $this->db->order_by("staff_details.staff_id", "desc");
	    $result = $this->db->get();
	    return $result->row_array();
	}

	public function profile_updates($staff,$p_fname,$p_mname,$p_lname,$p_div,$p_email,$p_position,$p_position_title){

		date_default_timezone_set('Asia/Manila');
		$date_now = date('Y-m-d H:i:s', time());

		$this->db->set('fname', $p_fname);
		$this->db->set('mname', $p_mname);
		$this->db->set('lname', $p_lname);
		$this->db->set('division', $p_div);
		$this->db->set('official_email', $p_email);
		$this->db->set('position', $p_position);
		$this->db->set('position_title', $p_position_title);
		$this->db->set('reg_date', $date_now);
		$this->db->where('staff_id', $staff);
		$this->db->update('staff_details');
	}

	public function change_password($staff,$new_pass,$text_pass){

		$this->db->set('text_pass', $text_pass);
		$this->db->set('password', $new_pass);
		$this->db->where('staff_id_account', $staff);
		$this->db->update('account');
	
	}

	//mobile api model connection

	public function account($username,$password){

		$this->db->select('*');
        $this->db->from('account');
        $this->db->where('a_user', $username);
        $this->db->where('a_password', $password);
        $this->db->join('staff_details', 'staff_details.staff_id = account.a_staff_id','inner');
        $result = $this->db->get();
		return $result->row_array();
	}

}