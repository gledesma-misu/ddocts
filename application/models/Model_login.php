<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_login extends CI_Model {

    public function login($username,$password){

        date_default_timezone_set('Asia/Manila');
        	$date_now = date('Y-m-d H:i:s', time()); 

		$data = array(
        		'last_login' => $date_now
      		);

		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->update('account', $data);
		
		$this->db->select('account.id,account.su,account.remove,account.password,account.email,account.staff_id_account,account.last_login,staff_details.fname,staff_details.mname,staff_details.lname,staff_details.position_title,staff_details.position,staff_details.division');
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

    


}