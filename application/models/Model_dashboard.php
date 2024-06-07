<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_dashboard extends CI_Model {

	public function get_id($lname1){

		$query = $this->db->get_where('staff_details', array('lname' => $lname1));
        return $query->result_array(); 
	}

  public function get_my_division($staf_get){
    $this->db->select('*');  
    $this->db->from('document_details');
    $this->db->where("FIND_IN_SET('$staf_get', REPLACE(document_details.dd_routed_to, ' ', '')) !=", 0); //updated code find in column and deleted spaces
    // $this->db->where('document_details.dd_routed_to', $staf_get);
    $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
    $this->db->order_by("document_details.dd_id", "desc");
    $result = $this->db->get();
    return $result->result_array(); 
  }

  public function get_action($myaction){
    $this->db->select('document_action.da_id, document_action.da_name');
    $this->db->from('document_action');
    $this->db->where('document_action.da_id', $myaction);
    $this->db->order_by("document_action.da_id", "desc");
    $result = $this->db->get(); 
    return $result->row_array();
  }

  public function get_bundle($dd_docbundle_ge){
    $this->db->select('*');
    $this->db->from('document_type');
    $this->db->like('document_type.dt_id', $dd_docbundle_ge);
    $this->db->order_by("document_type.dt_id", "desc");
    $result = $this->db->get();
    return $result->row_array();
  }

  public function recieve_docs($get_doc,$name_doc){ 

    $process_doc = 'DOCUMENT-RECIEVED: DocNo <b>'.$name_doc.'</b> with status: <b style="color:red"> PENDING </b>.';
    date_default_timezone_set('Asia/Manila');
		$date_now = date('Y-m-d H:i:s', time());

		$data1 = array(
			'dh_doc_id' => $this->session->userdata('staff_id'),
			'dh_action' => $process_doc,
			'dh_reg_date' => $date_now
		);
	 	$this->db->insert('document_history', $data1); 

      $data = array(
        'dd_recieved_doc' => '1',
        'dd_status' => '1',
        'dd_date_routed' => $date_now,
      );

      $this->db->where('dd_id', $get_doc);
      return $this->db->update('document_details', $data);
  }

  public function disregard_docs($get_doc,$name_doc,$editor1){ 

    $process_doc = 'DOCUMENT-DISREGARD: DocNo <b>'.$name_doc.'</b> with status: <b style="color:red"> FOR RECIEVING </b>.';
    date_default_timezone_set('Asia/Manila');
		$date_now = date('Y-m-d H:i:s', time());

		$data1 = array(
			'dh_doc_id' => $this->session->userdata('staff_id'),
			'dh_action' => $process_doc,
			'dh_reg_date' => $date_now
		);
	 	$this->db->insert('document_history', $data1);

      $data = array(
        'dd_disregard_doc' => '1',
        'dd_disregard_note' => $editor1
      );

      $this->db->where('dd_id', $get_doc);
      return $this->db->update('document_details', $data);
  }

  public function remove_disregards($get_doc,$name_doc){ 

    $process_doc = 'DOCUMENT-REMOVE ON DISREGARD: DocNo <b>'.$name_doc.'</b> with status: <b style="color:red"> FOR RECIEVING </b>.';
    date_default_timezone_set('Asia/Manila');
		$date_now = date('Y-m-d H:i:s', time());

		$data1 = array(
			'dh_doc_id' => $this->session->userdata('staff_id'),
			'dh_action' => $process_doc,
			'dh_reg_date' => $date_now
		);
	 	$this->db->insert('document_history', $data1);

      $data = array(
        'dd_disregard_doc' => '0'
      );
 
      $this->db->where('dd_id', $get_doc);
      return $this->db->update('document_details', $data);
  }

  public function mysources($mysource){
    $this->db->select('document_source.ds_id, document_source.ds_code, document_source.ds_name');
    $this->db->from('document_source');
    $this->db->where('document_source.ds_id', $mysource);
    $this->db->order_by("document_source.ds_id", "desc");
    $result = $this->db->get();
    return $result->row_array();
  }

  public function limit_doc($staf_get){
    $this->db->select('*'); 
    $this->db->from('document_details');
    $this->db->where("FIND_IN_SET('$staf_get', REPLACE(document_details.dd_routed_to, ' ', '')) !=", 0); 
    // $this->db->like('document_details.dd_routed_to', $staf_get);
    $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');  
    $this->db->order_by("document_details.dd_id", "desc");
    $this->db->limit(7);
    $result = $this->db->get();
    return $result->result_array(); 
  }

  public function list_notif($staff){

    $this->db->select('*');
    $this->db->from('notification');
    $this->db->like('account_id', $staff);
    $this->db->where('read_notif', '0'); 
    $this->db->limit(5);
     $this->db->order_by("reg_date", "desc");
    return $this->db->get();
    
  }

  public function get_my_history($staf_get){
    $this->db->select('*'); 
    $this->db->from('document_history');
    $this->db->where('document_history.dh_doc_id', $staf_get);
    $this->db->order_by("document_history.dh_id", "desc");
    $this->db->limit(7);
    $result = $this->db->get();
    return $result->result_array(); 
  }

  public function m_all_historys($staff){
		$this->db->select('*');
    $this->db->from('document_history');
    $this->db->where('document_history.dh_doc_id', $staff);
    $this->db->limit(30);
    $this->db->order_by("document_history.dh_id", "desc");
    $result = $this->db->get();
		return $result->result_array();
	}

  public function m_all_notifs($staff){
		$this->db->select('*');
    $this->db->from('notification');
    $this->db->like('notification.account_id', $staff);
    $this->db->limit(30);
    $this->db->order_by("notification.id", "desc");
    $result = $this->db->get();
		return $result->result_array();
	}

  public function get_staff_details(){
		  $this->db->select('*');
	    $this->db->from('staff_details');
	    $this->db->order_by("staff_details.staff_id", "desc");
	    $result = $this->db->get();
		  return $result->result_array();
	}


}