<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_records extends CI_Model {
    public function dispatch_doc(){

		$this->db->select('*');
        $this->db->from('document_details');
        $this->db->where('document_details.dd_dispatch_doc', '1'); 
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $this->db->order_by("document_details.dd_id", "desc");
        $result = $this->db->get();
		return $result->result_array();
	}

    public function mysources($mysource){
	    $this->db->select('document_source.ds_id, document_source.ds_code, document_source.ds_name');
	    $this->db->from('document_source');
	    $this->db->like('document_source.ds_id', $mysource);
	    $this->db->order_by("document_source.ds_id", "desc");
	    $result = $this->db->get();
	    return $result->row_array();
	}

    // Archive page
    
    public function count_doc_pagination(){ 
        $this->db->select('*'); 
        $this->db->where('document_details.dd_status','4');
        return $this->db->count_all_results('document_details');
    }

    public function pagination($limit,$start) {

        $this->db->select('*'); 
        $this->db->from('document_details');
        $this->db->where('document_details.dd_status','4');
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $this->db->order_by("document_details.dd_id", "desc");
        $this->db->limit($limit,$start);
        $result = $this->db->get();
	    return $result->result_array();
    }

    public function search($i_search){

    	$this->db->select('*');
        $this->db->from('document_details');
		$this->db->like('document_details.dd_doc_id_code', $i_search);
        $this->db->where('document_details.dd_status', '4');
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $this->db->order_by("document_details.dd_id", "desc");
		$result = $this->db->get();
	    return $result->result_array();
	}
    // forArchive page
    
    public function in_doc_pagination(){ 
        $this->db->select('*'); 
        $this->db->where('document_details.dd_status !=','4');
        return $this->db->count_all_results('document_details');
    }

    public function inpagination($limit,$start) {

        $this->db->select('*'); 
        $this->db->from('document_details');
        $this->db->where('document_details.dd_status !=','4');
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $this->db->order_by("document_details.dd_id", "desc");
        $this->db->limit($limit,$start);
        $result = $this->db->get();
	    return $result->result_array();
    }

    public function search_forarchive($i_search){

    	$this->db->select('*');
        $this->db->from('document_details');
		$this->db->like('document_details.dd_doc_id_code', $i_search);
        $this->db->where('document_details.dd_status !=', '4');
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $this->db->order_by("document_details.dd_id", "desc");
		$result = $this->db->get();
	    return $result->result_array();
	}
    // Incoming External ================================================================================================
    public function ex_doc_pagination(){ 
        $this->db->select('*'); 
        $this->db->where('dd_records', '1');
        return $this->db->count_all_results('document_details');
    }

    public function expagination($limit,$start) {

        $this->db->select('*'); 
        $this->db->from('document_details');
        $this->db->where('dd_records', '1');
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $this->db->order_by("document_details.dd_id", "desc");
        $this->db->limit($limit,$start);
        $result = $this->db->get();
	    return $result->result_array();
    }

    public function search_inex($i_search){

    	$this->db->select('*');
        $this->db->from('document_details');
		$this->db->like('document_details.dd_doc_id_code', $i_search);
        $this->db->where('dd_records', '1');
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $this->db->order_by("document_details.dd_id", "desc");
		$result = $this->db->get();
	    return $result->result_array();
	}

    public function incomingex_pdfs($date_from,$date_to){

		$this->db->select('*');
		$this->db->where('dd_records', '1');
        $this->db->where('dd_date_routed >=', $date_from);
		$this->db->where('dd_date_routed <=', $date_to);
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $this->db->order_by("document_details.dd_id", "desc");
        $query = $this->db->get('document_details');
        return $query->result_array();
	}


    // PDF ================================================================================================

    public function dispatch_pdfs($date_from,$date_to){

		$this->db->select('*');
		$this->db->where('dd_recieved_doc', '1');
        $this->db->where('dd_dispatch_doc', '1');
        $this->db->where('dd_date_routed >=', $date_from);
		$this->db->where('dd_date_routed <=', $date_to);
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $this->db->order_by("document_details.dd_id", "desc");
        $query = $this->db->get('document_details');
        return $query->result_array();
	}

    public function pending_pdfs($source_doc,$date_from,$date_to){

		$this->db->select('*');
        if($source_doc == '0'){
           
        }else{
            $this->db->where('dd_source', $source_doc);
        }
        $this->db->where('dd_status !=', '4');
		$this->db->where('dd_recieved_doc', '1');
        $this->db->where('dd_date_routed >=', $date_from);
		$this->db->where('dd_date_routed <=', $date_to);
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $this->db->order_by("document_details.dd_id", "desc");
        $query = $this->db->get('document_details');
        return $query->result_array();
	}

    public function completed_pdfs($source_doc,$date_from,$date_to){

		$this->db->select('*');
        if($source_doc == '0'){
           
        }else{
            $this->db->where('dd_source', $source_doc);
        }
        $this->db->where('dd_status', '4');
		$this->db->where('dd_recieved_doc', '1');
        $this->db->where('dd_date_routed >=', $date_from);
		$this->db->where('dd_date_routed <=', $date_to);
        $this->db->join('document_type', 'document_type.dt_id = document_details.dd_doct_type','left');
        $this->db->order_by("document_details.dd_id", "desc");
        $query = $this->db->get('document_details');
        return $query->result_array();
	}


}