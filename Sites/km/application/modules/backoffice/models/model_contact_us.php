<?php
class Model_contact_us extends MY_Model
{
	function __construct()
	{
		$this->load->database();
	}
	
	function get_ac($offset = NULL,$limit = NULL){			
			if(! is_null($offset) && ! is_null($limit)) {
				$this->db->order_by("CONT_add","desc");
				$this->db->limit($offset,$limit);
				$query = $this->db->get("contact_us");
				return $query->result(); 
				//return $this->db->last_query();
			} else {
				$this->db->order_by("CONT_add","desc");
				$query = $this->db->get("contact_us");
				return $query->num_rows();
			}
	}
	
	function search_ac($txt,$offset = NULL,$limit = NULL){			
			if(! is_null($offset) && ! is_null($limit)) {
				$this->db->where("( CONT_tel like '%".$txt."%' OR CONT_name like '%".$txt."%' OR CONT_message like '%".$txt."%' )");
				$this->db->order_by("CONT_add","desc");
				$this->db->limit($offset,$limit);
				$query = $this->db->get("contact_us");
				return $query->result(); 
				//return $this->db->last_query();
			} else {
				$this->db->where("( CONT_tel like '%".$txt."%' OR CONT_name like '%".$txt."%' OR CONT_message like '%".$txt."%' )");
				$this->db->order_by("CONT_add","desc");
				$query = $this->db->get("contact_us");
				return $query->num_rows();
			}
	}
	
	function add_ac($data){
		$this->db->insert('contact_us', $data); 
	}
	
	function get_for_update($id){
		$this->db->where("CONT_id",$id);
		$query = $this->db->get("contact_us");
		return $query->row();	
	}
	
	function update_ac($data,$id){
			$this->db->where('CONT_id',$id);
			$this->db->update('contact_us',$data);
	}
	
	function delete_ac($val){
			$this->db->where_in('CONT_id',$val);
			return $this->db->delete('contact_us');
			return TRUE;
	}
}
?>