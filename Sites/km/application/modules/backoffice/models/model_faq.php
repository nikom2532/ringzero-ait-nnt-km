<?php
class Model_faq extends MY_Model
{
	function __construct()
	{
		$this->load->database();
	}
	
	function get_ac($offset = NULL,$limit = NULL){			
			if(! is_null($offset) && ! is_null($limit)) {
				$this->db->order_by('FAQ_order','ASC');
				$this->db->limit($offset,$limit);
				$query = $this->db->get("faq");
				return $query->result(); 
				//return $this->db->last_query();
			} else {
				$this->db->order_by('FAQ_order','ASC');
				$query = $this->db->get("faq");
				return $query->num_rows();
			}
	}
	
	function search_ac($txt,$offset = NULL,$limit = NULL){			
			if(! is_null($offset) && ! is_null($limit)) {
				$this->db->where("( FAQ_question like '%".$txt."%' OR FAQ_answer like '%".$txt."%' )");			
				$this->db->order_by('FAQ_order','ASC');	
				$this->db->limit($offset,$limit);
				$query = $this->db->get("faq");
				return $query->result(); 
				//return $this->db->last_query();
			} else {
				$this->db->where("( FAQ_question like '%".$txt."%' OR FAQ_answer like '%".$txt."%' )");		
				$this->db->order_by('FAQ_order','ASC');		
				$query = $this->db->get("faq");
				return $query->num_rows();
			}
	}
	
	function add_ac($data){
		$this->db->insert('faq', $data); 
	}
	
	function get_for_update($id){
		$this->db->where("FAQ_id",$id);
		$query = $this->db->get("faq");
		return $query->row();	
	}
	
	function update_ac($data,$id){
			$this->db->where('FAQ_id',$id);
			$this->db->update('faq',$data);
	}
	
	function delete_ac($val){
			$this->db->where_in('FAQ_id',$val);
			return $this->db->delete('faq');
			return TRUE;
	}
}
?>