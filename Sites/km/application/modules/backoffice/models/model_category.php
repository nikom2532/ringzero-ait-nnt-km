<?php
class Model_category extends MY_Model
{
	function __construct()
	{
		$this->load->database();
	}
	
	function get_ac($offset = NULL,$limit = NULL){			
			if(! is_null($offset) && ! is_null($limit)) {
				$this->db->order_by('CAT_order','ASC');
				$this->db->order_by('CAT_order','ASC');
				$this->db->order_by('CAT_topic','ASC');
				$this->db->limit($offset,$limit);
				$query = $this->db->get("category");
				return $query->result(); 
				//return $this->db->last_query();
			} else {
				$this->db->order_by('CAT_order','ASC');
				$this->db->order_by('CAT_topic','ASC');
				$query = $this->db->get("category");
				return $query->num_rows();
			}
	}
	
	function search_ac($txt,$offset = NULL,$limit = NULL){			
			if(! is_null($offset) && ! is_null($limit)) {
				$this->db->where("( CAT_topic like '%".$txt."%' )");
				$this->db->order_by('CAT_order','ASC');
				$this->db->order_by('CAT_topic','ASC');
				$this->db->limit($offset,$limit);
				$query = $this->db->get("category");
				return $query->result(); 
				//return $this->db->last_query();
			} else {
				$this->db->where("( CAT_topic like '%".$txt."%' )");
				$this->db->order_by('CAT_order','ASC');
				$this->db->order_by('CAT_topic','ASC');
				$query = $this->db->get("category");
				return $query->num_rows();
			}
	}
	
	function add_ac($data){
		$this->db->insert('category', $data); 
	}
	
	function get_for_update($id){
		$this->db->where("CAT_id",$id);
		$query = $this->db->get("category");
		return $query->row();	
	}
	
	function update_ac($data,$id){
			$this->db->where('CAT_id',$id);
			$this->db->update('category',$data);
	}
	
	function delete_ac($val){
			$this->db->where_in('CAT_id',$val);
			return $this->db->delete('category');
			return TRUE;
	}
}
?>