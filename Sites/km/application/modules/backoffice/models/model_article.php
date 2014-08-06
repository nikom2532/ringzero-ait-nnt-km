<?php
class Model_article extends MY_Model
{
	function __construct()
	{
		$this->load->database();
	}
	
	function get_category(){			
				$this->db->select("CAT_id,CAT_topic");
				$this->db->where("CAT_activated",1);
				$this->db->order_by("CAT_topic","asc");
				$query = $this->db->get("category");
				return $query->result(); 
				//return $this->db->last_query();
	}
	function get_id($id){
		$db2 = $this->load->database('articledb', TRUE);		
		$db2->where("N_id",$id);
		
		$query = $db2->get("KM_news");
		return $query->row();		
	}
	function get_ac($offset = NULL,$limit = NULL){			
			if(! is_null($offset) && ! is_null($limit)) {
				if(!in_array("ALL",explode(",",$this->session->userdata('session_menu')))){
					 $this->db->where("ATC_writer_key",$this->session->userdata("session_accid"));
				}
				$this->db->order_by("ATC_update","desc");
				$this->db->order_by("ATC_date","desc");
				$this->db->limit($offset,$limit);
				$query = $this->db->get("article");
				return $query->result(); 
				//return $this->db->last_query();
			} else {
				if(!in_array("ALL",explode(",",$this->session->userdata('session_menu')))){
					 $this->db->where("ATC_writer_key",$this->session->userdata("session_accid"));
				}
				$this->db->order_by("ATC_update","desc");
				$this->db->order_by("ATC_date","desc");
				$query = $this->db->get("article");
				return $query->num_rows();
			}
	}
	
	function search_ac($txt,$category = NULL,$status = NULL,$start = NULL,$end = NULL,$offset = NULL,$limit = NULL){			
			if(! is_null($offset) && ! is_null($limit)) {
				if($category != NULL && $category != ""){ $this->db->where("ATC_category_ref",$category); }
				
				if($status != NULL && $status != ""){ $this->db->where("ATC_status",$status); }
				
				if($start != NULL && $start != ""){ $this->db->where("ATC_date >= {ts '".$start." 00:00:00.000'}"); }
				
				if($end != NULL && $end != ""){ $this->db->where("ATC_date <= {ts '".$end." 23:59:59.000'}"); }
				
				$this->db->where("( ATC_title like '%".$txt."%' OR ATC_short_desc like '%".$txt."%' OR ATC_desc like '%".$txt."%' OR ATC_tag like '%".$txt."%' )");
				if(!in_array("ALL",explode(",",$this->session->userdata('session_menu')))){
					 $this->db->where("ATC_writer_key",$this->session->userdata("session_accid"));
				}
				$this->db->order_by("ATC_update","desc");
				$this->db->order_by("ATC_date","desc");
				$this->db->limit($offset,$limit);
				$query = $this->db->get("article");
				return $query->result(); 
				//return $this->db->last_query();
			} else {
				if($category != NULL && $category != ""){ $this->db->where("ATC_category_ref",$category); }
				
				if($status != NULL && $status != ""){ $this->db->where("ATC_status",$status); }
				
				if($start != NULL && $start != ""){ $this->db->where("ATC_date >= {ts '".$start." 00:00:00.000'}"); }
				
				if($end != NULL && $end != ""){ $this->db->where("ATC_date <= {ts '".$end." 23:59:59.000'}"); }
				
				$this->db->where("( ATC_title like '%".$txt."%' OR ATC_short_desc like '%".$txt."%' OR ATC_desc like '%".$txt."%' OR ATC_tag like '%".$txt."%' )");
				if(!in_array("ALL",explode(",",$this->session->userdata('session_menu')))){
					 $this->db->where("ATC_writer_key",$this->session->userdata("session_accid"));
				}
				$this->db->order_by("ATC_update","desc");
				$this->db->order_by("ATC_date","desc");
				$query = $this->db->get("article");
				return $query->num_rows();
			}
	}
	
	function add_ac($data){
		$this->db->insert('article', $data); 
	}
	
	function get_for_update2($id){
		if(!in_array("ALL",explode(",",$this->session->userdata('session_menu')))){
					 $this->db->where("ATC_writer_key",$this->session->userdata("session_accid"));
		}
		$this->db->where("ATC_id",$id);
		$query = $this->db->get("article");
		return $this->db->last_query();
		//return $query->num_rows();	
	}
	
	function get_for_update($id){
		if(!in_array("ALL",explode(",",$this->session->userdata('session_menu')))){
					 $this->db->where("ATC_writer_key",$this->session->userdata("session_accid"));
		}
		$this->db->where("ATC_id",$id);
		$query = $this->db->get("article");
		return $query->row();	
	}
	
	function update_ac($data,$id){
			$this->db->where('ATC_id',$id);
			$this->db->update('article',$data);
	}
	
	function delete_ac($val){
			$this->db->where_in('ATC_id',$val);
			return $this->db->delete('article');
			return TRUE;
	}
}
?>