<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_dts extends CI_Model {

	public function get_all_source(){
		$this->db->select('*');
        $this->db->from('document_source');
        $this->db->order_by("document_source.ds_id", "desc");
        $result = $this->db->get(); 
		return $result->result_array();
	}
 
	public function get_type_document(){
		$this->db->select('*');
        $this->db->from('document_type');
        $this->db->order_by("document_type.dt_id", "desc");
        $result = $this->db->get();
		return $result->result_array();
	}

	public function get_action_taken(){
		$this->db->select('*');
        $this->db->from('document_action'); 
        $this->db->order_by("document_action.da_id", "desc");
        $result = $this->db->get();
		return $result->result_array();
	}

	public function get_internal_source(){
		$this->db->select('*');
        $this->db->from('document_source');
        $this->db->order_by("document_source.ds_id", "desc");
        $result = $this->db->get();
		return $result->result_array();
	}

	public function get_in_ex_source1($source_doc){
		$this->db->select('*');
        $this->db->from('document_source');
        $this->db->where('document_source.ds_id', $source_doc);
        $this->db->order_by("document_source.ds_id", "desc");
        $result = $this->db->get();
		return $result->row_array();
	}

	public function get_staff_details(){
		$this->db->select('*');
	  	$this->db->from('staff_details');
	  	$this->db->order_by("staff_details.staff_id", "desc");
	  	$result = $this->db->get();
		return $result->result_array();
  	}

	public function routed_details($myid){
	    $this->db->select('staff_details.staff_id, staff_details.fname, staff_details.lname, staff_details.official_email');
	    $this->db->from('staff_details');
	    $this->db->like('staff_details.staff_id', $myid);
	    $this->db->order_by("staff_details.staff_id", "desc");
	    $result = $this->db->get();
	    return $result->row_array();
	}

	// New Document Page  ==================================================================================

	public function insertDocDetails($doc_no,$source_doc,$sub_title,$files_array_new,$moredocs,$type_doc,$action_taken,$daterec,$div_unit,$staff_details,$editor1,$type_docs,$file_get,$staff_id,$dd_disregard_doc,$source_staffs_name,$records_id){

		date_default_timezone_set('Asia/Manila');  
		$date_now = date('Y-m-d H:i:s', time());
		$date_nows = date('Y-m-d', time());

		$process_doc = 'DOCUMENT-SEND: DocNo <b>'.$doc_no.'</b> with status: <b style="color:red"> FOR RECEIVING </b>.';

		$data1 = array(
			'dh_doc_id' => $this->session->userdata('staff_id'),
			'dh_action' => $process_doc,
			'dh_reg_date' => $date_now
		);
	 	$this->db->insert('document_history', $data1);

		$data = array(
			'dd_doc_id_code' => $doc_no, 
			'dd_title' => $sub_title,
			'dd_doct_type' => $type_doc,
			'dd_ifBundle' => $moredocs,
			'dd_bundleDocs' => $type_docs,
			'dd_source' => $source_doc,
			'dd_action_taken' => $action_taken,
			'dd_routed_to' => $staff_details,
			'dd_staff_name' => $source_staffs_name,
			'dd_view_doc' => $div_unit,
			'dd_date_recieved' => $daterec,
			'dd_filename' => $files_array_new,
			'dd_status' => '0',
			'dd_encoded_doc' => $staff_id,
			'dd_filetype' => $file_get,
			'dd_note' => $editor1,
			'dd_disregard_doc' => $dd_disregard_doc,
			'dd_records' => $records_id,
			'dd_date_routed' => $date_nows
        );

		$this->db->insert('document_details', $data); 
	}

	public function doc_request($not_listed){

		$name_request = $this->session->userdata('staff_id');;
        $data1 = array(
			'rs_name' => $not_listed,
			'rs_request' => $name_request,
			'rs_status' => '0'
        );

		$this->db->insert('request_doc_source', $data1);
	}

	public function document_outgoing($staff_id){

		$this->db->select('*');
        $this->db->from('document_details');
        $this->db->where('document_details.dd_encoded_doc', $staff_id);
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');

        $this->db->order_by("document_details.dd_encoded_doc", "desc");
        $result = $this->db->get();
		return $result->result_array();
	}

	public function get_division($staff_division){
	    $this->db->select('*');
	    $this->db->from('staff_division');
	    $this->db->where('staff_division.sd_code', $staff_division);
	    $this->db->join('document_source', 'document_source.ds_id = staff_division.sd_id','inner');
	    $this->db->order_by("staff_division.sd_id", "desc");
	    $result = $this->db->get();
	    return $result->row_array();
  	}

	public function get_action($dd_action){
		$this->db->select('document_action.da_id, document_action.da_name');
		$this->db->from('document_action');
		$this->db->where('document_action.da_id', $dd_action);
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

	public function mysources($mysource){
	    $this->db->select('document_source.ds_id, document_source.ds_code');
	    $this->db->from('document_source');
	    $this->db->like('document_source.ds_id', $mysource);
	    $this->db->order_by("document_source.ds_id", "desc");
	    $result = $this->db->get();
	    return $result->row_array();
	}

	public function get_s_division($s_division){
		$this->db->select('*');
	    $this->db->from('staff_division');
	    $this->db->like('staff_division.sd_code', $s_division);
	    $this->db->order_by("staff_division.sd_id", "desc");
	    $result = $this->db->get();
	    return $result->row_array();
	}

	// View Document Page ==================================================================================
	public function view_get_details($dd_id){
	    $this->db->select('*');
	    $this->db->from('document_details');
	    $this->db->like('document_details.dd_id', $dd_id);
	    $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
	    $result = $this->db->get();
	    return $result->row_array();
	}

	public function get_file_attachment($dd_id){

		$this->db->select("*");
		$this->db->where('dd_id',$dd_id);
		$this->db->from("document_details");
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row_array();
			return true;
		}else{
			return false;
		}
	}

	public function update_file($files_array,$dd_id){
		$this->db->set('dd_filename', $files_array);
		$this->db->where('dd_id', $dd_id);
		$this->db->update('document_details');
	}

	public function update_files_array($files_array,$dd_id){
		$this->db->set('dd_filename', $files_array);
		$this->db->where('dd_id', $dd_id);
		$this->db->update('document_details');
	}

	public function complate_file($dd_id){
		$this->db->set('dd_status','4');
		$this->db->where('dd_id', $dd_id);
		$this->db->update('document_details');
	}

	public function get_data_type_doc_other($dd_id){
		$this->db->select('*');
        $this->db->from('document_details');
        $this->db->where('dd_id', $dd_id);
        $result = $this->db->get();
		return $result->row_array();
	}

	public function get_document_reply($dd_id){
		$this->db->select('*');
		$this->db->where('dts_comment_repy.document_id', $dd_id); // CONDITION
		$this->db->join('document_details', 'document_details.dd_id = dts_comment_repy.document_id','left');
		$result = $this->db->get('dts_comment_repy');
		return $result->result_array();
	}

	public function reply_notes($dd_id,$staff,$notes,$oed_other,$date_now,$doc_title,$doc_no,$files_new,$my_division,$doc_current_status,$doc_current_action,$id_to_staff){
		$data = array(
			   'document_id' => $dd_id, 
			   'staff_name' => $staff,
			   'reply' => $notes,
			   'doc_affiliated' => $oed_other,
			   'doc_current_status' => $doc_current_status,
			   'doc_current_action' => $doc_current_action,
			   'doc_current_file' => $files_new,
			   'comment_date' => $date_now
            );
		$this->db->insert('dts_comment_repy', $data); 

		switch ($doc_current_status){
			case 1:
				$status_doc = "<span class='text-theme-6'> Pending </span>";
			break;
			case 2:
				$status_doc = "<span class='text-theme-12'> On Process </span>";
			break;
			case 3:
				$status_doc = "<span class='text-theme-10'> Re-process </span>";
			break;
			case 4:
				$status_doc = "<span class='text-theme-9'> Completed </span> ";
			break;
			default: 
				$status_doc = "ERROR";
			break; 
		}

		$process_doc = 'REPLY-MESSAGE: DocNo <b>'.$doc_no.'</b> with status: <b>'.$status_doc.'</b>.';

		$data1 = array(
			'dh_doc_id' => $staff,
			'dh_action' => $process_doc,
			'dh_reg_date' => $date_now
		);
	 	$this->db->insert('document_history', $data1); 

		$this->db->set('dd_status', $doc_current_status);
		$this->db->set('dd_action_taken', $doc_current_action);
		$this->db->set('dd_date_encoded', $date_now);
		$this->db->where('dd_id', $dd_id);
		$this->db->update('document_details');

		 switch ($doc_current_status){
                    case 2:
                     $message = 'ON-PROCESS: Document <b>'.$doc_title.'</b> with DocNo: <b>'.$doc_no.'</b> received.';
                      $action_type = 'MODIFY';
                    break;
                    case 3:
                      $message = 'RE-PROCESS: Document <b>'.$doc_title.'</b> with DocNo: <b>'.$doc_no.'</b> received.';
                       $action_type = 'MODIFY';
                    break;
                    case 4:
                      $message = 'OUTGOING: Document <b>'.$doc_title.'</b> with DocNo: <b>'.$doc_no.'</b> received.';
                      $action_type = 'CREATE';
                    break;
                    case 1:
                      $message = 'PENDING: <b>'.$staff.'</b> reply in the document <b>'.$doc_title.'</b> with DocNo: <b>'.$doc_no.'</b>.';
                      $action_type = 'MODIFY';
                    break;
                    default:
                      $label ="ERROR";
                    break;  
                  }
                   switch ($my_division){
                    case 'OED':
                     $status = '0';
                    break;
                    default:
                      $status = '1';
                    break;  
        }

		$trans_id = $dd_id;
		$fname = $this->session->userdata('staff_fname');
		$lname = $this->session->userdata('staff_lname');
		$name = $fname.' '.$lname;
		date_default_timezone_set('Asia/Manila');
		$date_now = date('Y-m-d H:i:s', time());
		$data3 = array(
			   'transaction_id' => $trans_id,
			   'function_method' => "MODULE_DTS", 
			   'action_type' => $action_type,
			   'action_message' => $message,
			   'added_by' => $name,
			   'read_notif' => '0',
			   'read_div_notif' => '0',
			   'read_oed_notif' => '1',
			   'reg_date' => $date_now,
			   'if_oed' => $status,
			   'account_id' => $id_to_staff
            );
		$this->db->insert('notification', $data3);
	}

	public function process_action($dd_id,$staff,$notes,$doc_current_status,$doc_current_action,$oed_other,$date_now,$doc_title,$doc_no,$id_to_staff,$my_division,$dispatch_doc){
		
		$data = array(
			'document_id' => $dd_id, 
			'staff_name' => $staff,
			'reply' => $notes,
			'doc_affiliated' => $oed_other,
			'doc_current_status' => $doc_current_status,
			'doc_current_action' => $doc_current_action, 
			'doc_current_file' => '|No Uploaded Files!|', 
			'comment_date' => $date_now
		 );
	 	$this->db->insert('dts_comment_repy', $data); 

		 switch ($doc_current_status){
			case 1:
				$status_doc = "<span class='text-theme-6'> Pending </span>";
			break;
			case 2:
				$status_doc = "<span class='text-theme-12'> On Process </span>";
			break;
			case 3:
				$status_doc = "<span class='text-theme-10'> Re-process </span>";
			break;
			case 4:
				$status_doc = "<span class='text-theme-9'> Completed </span> ";
			break;
			default: 
				$status_doc = "ERROR";
			break; 
		}

		$process_doc = 'PROCESS-DOC: DocNo <b>'.$doc_no.'</b> with status: <b>'.$status_doc.'</b>.';

		$data1 = array(
			'dh_doc_id' => $staff,
			'dh_action' => $process_doc,
			'dh_reg_date' => $date_now
		);
	 	$this->db->insert('document_history', $data1); 

		$this->db->set('dd_status', $doc_current_status);
		$this->db->set('dd_action_taken', $doc_current_action);
		$this->db->set('dd_dispatch_doc', $dispatch_doc);
		$this->db->set('dd_date_encoded', $date_now);
		$this->db->where('dd_id', $dd_id);
		$this->db->update('document_details');

		switch ($doc_current_status){
			case 2:
			 $message = 'ON-PROCESS: Document <b>'.$doc_title.'</b> with DocNo: <b>'.$doc_no.'</b> received.';
			  $action_type = 'MODIFY';
			break;
			case 3:
			  $message = 'RE-PROCESS: Document <b>'.$doc_title.'</b> with DocNo: <b>'.$doc_no.'</b> received.';
			   $action_type = 'MODIFY';
			break;
			case 4:
			  $message = 'OUTGOING: Document <b>'.$doc_title.'</b> with DocNo: <b>'.$doc_no.'</b> received.';
			  $action_type = 'CREATE';
			break;
			case 1:
			  $message = 'PENDING: <b>'.$staff.'</b> reply in the document <b>'.$doc_title.'</b> with DocNo: <b>'.$doc_no.'</b>.';
			  $action_type = 'MODIFY';
			break;
			default:
			  $label ="ERROR";
			break;  
		}

		switch ($my_division){
			case 'OED':
				$status = '0';
			break;
			default:
			 	$status = '1';
			break;  
		}

		$trans_id = $dd_id;
		$fname = $this->session->userdata('staff_fname');
		$lname = $this->session->userdata('staff_lname');
		$name = $fname.' '.$lname;
		date_default_timezone_set('Asia/Manila');
		$date_now = date('Y-m-d H:i:s', time());
		$data3 = array(
			   'transaction_id' => $trans_id,
			   'function_method' => "MODULE_DTS", 
			   'action_type' => $action_type,
			   'action_message' => $message,
			   'added_by' => $name,
			   'read_notif' => '0',
			   'read_div_notif' => '0',
			   'read_oed_notif' => '1',
			   'reg_date' => $date_now,
			   'if_oed' => $status,
			   'account_id' => $id_to_staff
            );
		$this->db->insert('notification', $data3);

	}

	// Incoming Document Page ==================================================================================

	public function get_my_division($staff){
	    $this->db->select('*');
	    $this->db->from('document_details');
	    $this->db->like('document_details.dd_routed_to', $staff);
	    $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
	    $this->db->order_by("document_details.dd_id", "desc");
	    $result = $this->db->get();
	    return $result->result_array(); 
	}

	public function get_doc_pagination($limit, $start, $staff) {

        $this->db->select('*'); 
        $this->db->where('document_details.dd_recieved_doc', '1');
        $this->db->like('document_details.dd_routed_to', $staff);
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
		$this->db->order_by("document_details.dd_id", "desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get('document_details');
        return $query->result_array();
    }

    public function count_doc_pagination($staff){ 
        $this->db->select('*'); 
        $this->db->where('document_details.dd_recieved_doc', '1');
		$this->db->where('dd_status !=', '4');
        $this->db->like('document_details.dd_routed_to', $staff);
        return $this->db->count_all_results('document_details');
    }

	public function search_incoming_doc($search,$staff){

		$this->db->select('*');
		$this->db->like('dd_routed_to', $staff);
		$this->db->where('dd_recieved_doc', '1');
		$this->db->where('dd_status !=', '4');
		$this->db->like('dd_doc_id_code',$search);
        $this->db->or_where('dd_title',$search);
		$this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $query = $this->db->get('document_details');
        return $query->result_array();
	}

	public function count_doc_incoming($staff){ 
		$this->db->select('*'); 
        $this->db->where('document_details.dd_recieved_doc', '1');
		$this->db->where('dd_status !=', '4');
        $this->db->like('document_details.dd_routed_to', $staff);
        return $this->db->count_all_results('document_details');
    }

	// Outging Document Page ==================================================================================

	public function count_doc_outgoing($staff){ 
		$this->db->select('*'); 
        $this->db->where('document_details.dd_recieved_doc', '1');
		$this->db->where('dd_status', '4');
        $this->db->like('document_details.dd_routed_to', $staff);
        return $this->db->count_all_results('document_details');
    }

	public function get_doc_outgoing($limit, $start, $staff) {

        $this->db->select('*'); 
        $this->db->where('document_details.dd_recieved_doc', '1');
        $this->db->like('document_details.dd_routed_to', $staff);
		$this->db->where('dd_status', '4');
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
		$this->db->order_by("document_details.dd_id", "desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get('document_details');
        return $query->result_array();
    }

	public function search_outgoing_doc($search,$staff){

		$this->db->select('*');
		$this->db->like('dd_routed_to', $staff);
		$this->db->where('dd_recieved_doc', '1');
		$this->db->where('dd_status', '4');
		$this->db->like('dd_doc_id_code', $search);
		$this->db->or_where('dd_title',$search);
		$this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $query = $this->db->get('document_details');
        return $query->result_array();
	}

    public function get_docList($doc_id){
		$this->db->select('*');
        $this->db->from('document_details');
        $this->db->where('document_details.dd_id', $doc_id);
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $this->db->order_by("document_details.dd_id", "desc");
        $result = $this->db->get();
		return $result->row_array();
	}

	public function count_recieve($staff_recieve){
        $recieve = '0';
        $disregard = '0';
        $this->db->like('document_details.dd_routed_to', $staff_recieve);
        $this->db->where('document_details.dd_recieved_doc', $recieve);
        $this->db->where('document_details.dd_disregard_doc', $disregard);
        $this->db->from('document_details');
        return $this->db->count_all_results();
    }

    // Document search page 

    public function get_searchdoc($searchdoc,$staff){
    	$this->db->select('document_details.dd_id, document_details.dd_doc_id_code, document_details.dd_title, document_details.dd_recieved_doc');
        $this->db->from('document_details');
		$this->db->like('document_details.dd_routed_to', $staff);
		$this->db->where('document_details.dd_recieved_doc', '1');
		$this->db->like('document_details.dd_doc_id_code', $searchdoc);
		$result = $this->db->get();
		if($result->num_rows()==1) {
               return $result->row();               
        } else if($result->num_rows() > 1) {
           return $result->result();        
        }else{
        	return false;
        }
	}

	public function display_docs($docs_id){
		$this->db->select('*');
        $this->db->from('document_details');
        $this->db->where('document_details.dd_id', $docs_id);
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $this->db->order_by("document_details.dd_id", "desc");
        $result = $this->db->get();
		return $result->row_array();
	}


}
