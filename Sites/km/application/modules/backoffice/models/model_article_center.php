<?php
class Model_article_center extends MY_Model
{
	function __construct()
	{
		$this->load->database();
	}
	
	function get_category(){			
		$db2 = $this->load->database('articledb', TRUE);	
		$db2->where("C_status","Y");
		$query = $db2->get("KM_category_news");
		return $query->result(); 
		//return $this->db->last_query();
	}
	function get_categoryid($type=NULL){			
		$db2 = $this->load->database('articledb', TRUE);	
		$db2->where("C_id",$type);
		$db2->where("C_status","Y");
		$query = $db2->get("KM_category_news");
		return $query->result(); 
		//return $this->db->last_query();
	}
	function get_ac($type=NULL,$offset = NULL,$limit = NULL){	
	$db2 = $this->load->database('articledb', TRUE);		
		if(! is_null($offset) && ! is_null($limit)) {
			
			if($type!=NULL){
				$db2->where("N_category_ref",$type);
			}
			$db2->order_by("N_date","desc");
			$db2->limit($offset,$limit);
			//$db2->group_by('N_id');
			$query = $db2->get("KM_news");
			//echo $db2->last_query();
			return $query->result(); 
			//return $db2->last_query();
		} else {
			if($type!=NULL){
				$db2->where("N_category_ref",$type);
			}
			//$db2->group_by('N_id');
			$db2->order_by("N_date","desc");
			$query = $db2->get("KM_news");
			return $query->num_rows();
		}
	}
	
	function search_ac($txt=NULL,$start=NULL,$stop=NULL,$category = NULL,$offset = NULL,$limit = NULL){		
	$db2 = $this->load->database('articledb', TRUE);	
	
			if($start != NULL && $start != ""){ $db2->where("N_date >= {ts '".$start." 00:00:00.000'}"); }	
			if($stop != NULL && $stop != ""){ $db2->where("N_date <= {ts '".$stop." 23:59:59.000'}"); }
			if(! is_null($offset) && ! is_null($limit)) {
				
				if($category != NULL && $category != "null"){ $db2->where("N_category_ref",$category); }
				$db2->where("( N_title like '%".$txt."%' OR N_short_desc like '%".$txt."%' OR N_desc like '%".$txt."%' OR N_writer like '%".$txt."%' )");
				$db2->order_by("N_date","desc");
				$db2->limit($offset,$limit);
				$query = $db2->get("KM_news");
				//echo $db2->last_query();
				return $query->result(); 
				//return $db2->last_query();
			} else {
				
				if($category != NULL && $category != "null"){ $db2->where("N_category_ref",$category); }
				$db2->where("( N_title like '%".$txt."%' OR N_short_desc like '%".$txt."%' OR N_desc like '%".$txt."%' OR N_writer like '%".$txt."%' )");
				$db2->order_by("N_date","desc");
				$query = $db2->get("KM_news");
				return $query->num_rows();
			}
	}
}
?>