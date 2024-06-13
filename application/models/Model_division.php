<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_division extends CI_Model {


    public function get_division_all($staff_division){
	    $this->db->select('*');
        $this->db->from('document_source');
        $this->db->where('document_source.ds_id', $staff_division);
        $this->db->order_by("document_source.ds_id", "desc");
        $result = $this->db->get();
		return $result->row_array();
  	}

    // pending page

    public function count_doc_pending($Exist){ 
        $this->db->select('document_source.ds_id, document_source.ds_code');
        $this->db->where('dd_recieved_doc', '1');
        $this->db->where('dd_status !=', '4');
        $this->db->like('dd_view_doc', $Exist);
        return $this->db->count_all_results('document_details');
    }

    public function get_doc_pending($limit, $start, $Exist) {

        $this->db->select('*'); 
        $this->db->where('dd_status !=', '4');
        $this->db->where('document_details.dd_recieved_doc', '1');
        $this->db->where('document_details.dd_view_doc', $Exist);
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
		$this->db->order_by("document_details.dd_id", "desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get('document_details');
        return $query->result_array();
    }

    public function mysources($mysource){
	    $this->db->select('document_source.ds_id, document_source.ds_code');
	    $this->db->from('document_source');
	    $this->db->where('document_source.ds_id', $mysource);
	    $this->db->order_by("document_source.ds_id", "desc");
	    $result = $this->db->get();
	    return $result->row_array();
	}

    public function search_pending_doc($search,$Exist){

		$this->db->select('*');
        $this->db->where('dd_status !=', '4');
		$this->db->like('dd_view_doc', $Exist);
		$this->db->where('dd_recieved_doc', '1');
		$this->db->like('dd_doc_id_code', $search);
		$this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $query = $this->db->get('document_details');
        return $query->result_array();
	}

    public function get_my_division($Exist){
	    $this->db->select('*');
	    $this->db->from('document_details');
        $this->db->where('dd_status !=', '4');
	    $this->db->like('document_details.dd_view_doc', $Exist);
	    $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
	    $this->db->order_by("document_details.dd_id", "desc");
	    $result = $this->db->get();
	    return $result->result_array(); 
	}

    public function get_bundle($dd_docbundle_ge){
	    $this->db->select('*');
	    $this->db->from('document_type');
	    $this->db->like('document_type.dt_id', $dd_docbundle_ge);
	    $this->db->order_by("document_type.dt_id", "desc");
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

    public function print_pdf($Exist,$source_doc,$date_from,$date_to){

		$this->db->select('*');
        if($source_doc == '0'){
           
        }else{
            $this->db->where('dd_source', $source_doc);
        }
        $this->db->where('dd_status !=', '4');
		$this->db->where('dd_recieved_doc', '1');
        $this->db->like('dd_view_doc', $Exist);
        $this->db->where('dd_date_routed >=', $date_from);
		$this->db->where('dd_date_routed <=', $date_to);
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $query = $this->db->get('document_details');
        return $query->result_array();
	}

    public function count_pdf($Exist,$source_doc,$date_from,$date_to){ 
        $this->db->select('*');
        $this->db->where('dd_status !=', '4');
		$this->db->where('dd_recieved_doc', '1');
        $this->db->where('dd_source', $source_doc);
        $this->db->like('dd_view_doc', $Exist);
        $this->db->where('dd_date_routed >=', $date_from);
		$this->db->where('dd_date_routed <=', $date_to);
        return $this->db->count_all_results('document_details');
    }

    public function print_excel($Exist,$source_doc,$date_from,$date_to){

		$this->db->select('*');
        if($source_doc == '0'){
           
        }else{
            $this->db->where('dd_source', $source_doc);
        }
        $this->db->where('dd_status !=', '4');
		$this->db->where('dd_recieved_doc', '1');
        $this->db->like('dd_view_doc', $Exist);
        $this->db->where('dd_date_routed >=', $date_from);
		$this->db->where('dd_date_routed <=', $date_to);
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $query = $this->db->get('document_details');
        return $query->result_array();
	}

    //===============================================================================================

     // Completed page

    public function count_doc_completed($Exist){ 
        $this->db->select('document_source.ds_id, document_source.ds_code');
        $this->db->where('dd_recieved_doc', '1');
        $this->db->where('dd_status', '4');
        $this->db->like('dd_view_doc', $Exist);
        return $this->db->count_all_results('document_details');
    }

    public function get_doc_completed($limit, $start, $Exist) {

        $this->db->select('*'); 
        $this->db->where('dd_status', '4');
        $this->db->where('document_details.dd_recieved_doc', '1');
        $this->db->like('document_details.dd_view_doc', $Exist);
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
		$this->db->order_by("document_details.dd_id", "desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get('document_details');
        return $query->result_array();
    }

    public function get_my_completed($Exist){
	    $this->db->select('*');
	    $this->db->from('document_details');
        $this->db->where('dd_status', '4');
	    $this->db->like('document_details.dd_view_doc', $Exist);
	    $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
	    $this->db->order_by("document_details.dd_id", "desc");
	    $result = $this->db->get();
	    return $result->result_array(); 
	}

    public function search_completed($search,$Exist){

		$this->db->select('*');
        $this->db->where('dd_status', '4');
		$this->db->like('dd_view_doc', $Exist);
		$this->db->where('dd_recieved_doc', '1');
		$this->db->like('dd_doc_id_code', $search);
        $this->db->or_where('dd_title',$search);
		$this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $query = $this->db->get('document_details');
        return $query->result_array();
	}

    public function com_print_pdf($Exist,$source_doc,$date_from,$date_to){

		$this->db->select('*');
        if($source_doc == '0'){
           
        }else{
            $this->db->where('dd_source', $source_doc);
        }
        $this->db->where('dd_status =', '4');
		$this->db->where('dd_recieved_doc', '1');
        $this->db->like('dd_view_doc', $Exist);
        $this->db->where('dd_date_routed >=', $date_from);
		$this->db->where('dd_date_routed <=', $date_to);
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $query = $this->db->get('document_details');
        return $query->result_array();
	}

    public function com_print_excel($Exist,$source_doc,$date_from,$date_to){

		$this->db->select('*');
        if($source_doc == '0'){
           
        }else{
            $this->db->where('dd_source', $source_doc);
        }
        $this->db->where('dd_status', '4');
		$this->db->where('dd_recieved_doc', '1');
        $this->db->like('dd_view_doc', $Exist);
        $this->db->where('dd_date_routed >=', $date_from);
		$this->db->where('dd_date_routed <=', $date_to);
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $query = $this->db->get('document_details');
        return $query->result_array();
	}

     //===============================================================================================

     // Completed page

     public function count_doc_files($Exist){ 
        $this->db->select('document_source.ds_id, document_source.ds_code');
        $this->db->where('dd_recieved_doc', '1');
        $this->db->like('dd_view_doc', $Exist);
        return $this->db->count_all_results('document_details');
    }

    public function get_doc_files($limit, $start, $Exist) {

        $this->db->select('*'); 
        $this->db->where('document_details.dd_recieved_doc', '1');
        $this->db->like('document_details.dd_view_doc', $Exist);
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
		$this->db->order_by("document_details.dd_id", "desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get('document_details');
        return $query->result_array();
    }

    public function get_my_files($Exist){
	    $this->db->select('*');
	    $this->db->from('document_details');
	    $this->db->like('document_details.dd_view_doc', $Exist);
	    $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
	    $this->db->order_by("document_details.dd_id", "desc");
	    $result = $this->db->get();
	    return $result->result_array(); 
	}

    public function search_files_doc($search,$Exist){

		$this->db->select('*');
		$this->db->like('dd_view_doc', $Exist);
		$this->db->where('dd_recieved_doc', '1');
		$this->db->like('dd_doc_id_code', $search);
        $this->db->or_where('dd_title',$search);
		$this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $query = $this->db->get('document_details');
        return $query->result_array();
	}

    public function get_staff_details(){
		$this->db->select('*');
	  	$this->db->from('staff_details');
	  	$this->db->order_by("staff_details.staff_id", "desc");
	  	$result = $this->db->get();
		return $result->result_array();
  	}


}