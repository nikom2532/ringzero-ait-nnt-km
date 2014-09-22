<?php
class Model_news extends MY_Model
{
	function __construct()
	{
		$this->load->database();
	}
	function add_ac($data){
		$this->db->insert('news_view', $data); 
	}
	function get_category(){			
		$db2 = $this->load->database('articledb', TRUE);	
		$db2->where("C_status","Y");
		$query = $db2->get("KM_category_news");
		return $query->result(); 
		//return $this->db->last_query();
	}
	function get_viewsid($id){
		//$query = $this->db->query("SELECT COUNT(NV_ref) FROM dbo.news_view WHERE dbo.news_view.NV_ref  = '".$id."' ");
		$this->db->select("COUNT(NV_ref) AS MyCount");
		$this->db->from("news_view");
		$this->db->where("NV_ref", $id);
		$query = $this->db->get();
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
	function get_id($id){
		$db2 = $this->load->database('articledb', TRUE);		
		$db2->where("N_id",$id);
		
		$query = $db2->get("KM_news");
		return $query->result(); 	
	}
	function get_cover($id){
		$db2 = $this->load->database('articledb', TRUE);		
		$db2->where("NG_news_ref",$id);
		$db2->limit(1);
		$query = $db2->get("KM_news_gallery");
		return $query->result(); 	
	}
	function get_resent($id=NULL,$cat=NULL){
		$db2 = $this->load->database('articledb', TRUE);			
		$db2->where("N_id<> '".$id."'");
		if($cat!=NULL)
		$db2->where("N_category_ref",$cat);
		
		$db2->limit(3);
		$query = $db2->get("KM_news");
		return $query->result(); 
	}
	function get_gal($id=NULL){
		$db2 = $this->load->database('articledb', TRUE);			
		$db2->where("NG_news_ref",$id);
		$query = $db2->get("KM_news_gallery");
		return $query->result(); 
	}
	function get_vdo($id=NULL){
		$db2 = $this->load->database('articledb', TRUE);			
		$db2->where("NV_news_ref",$id);
		$query = $db2->get("KM_news_vdo");
		return $query->result(); 
	}
	function get_ac($type=NULL,$offset = NULL,$limit = NULL){	
	$db2 = $this->load->database('articledb', TRUE);		
		if(! is_null($offset) && ! is_null($limit)) {
			
			if($type!=NULL&&$type!="top"){
				$db2->where("N_category_ref",$type);
			}
			if($type!=NULL&&$type=="top"){
				$db2->order_by("N_Views","desc");
			}
			$db2->order_by("N_date","desc");
			$db2->limit($offset,$limit);
			$query = $db2->get("KM_news");
			return $query->result(); 
		} else {
			if($type!=NULL&&$type!="top"){
				$db2->where("N_category_ref",$type);
			}
			$db2->order_by("N_date","desc");
			$query = $db2->get("KM_news");
			
			return $query->num_rows();
		}
	}
	function get_rssac($type=NULL){	
		$db2 = $this->load->database('articledb', TRUE);		
		if($type!=NULL){
			$db2->where("N_category_ref",$type);
		}
		$db2->order_by("N_date","desc");
		$query = $db2->get("KM_news");
		return $query->result(); 
	}
	function get_rssachot($type=NULL){	
		$db2 = $this->load->database('articledb', TRUE);		
		if($type!=NULL){
			$db2->where("N_category_ref",$type);
		}
		$db2->order_by("N_date","desc");
		$db2->limit(3);
		$query = $db2->get("KM_news");
		return $query->result(); 
	}
	function get_tag($tag=NULL,$type=NULL,$offset = NULL,$limit = NULL){	
	$db2 = $this->load->database('articledb', TRUE);
			if(! is_null($offset) && ! is_null($limit)) {
				
				if($type!=NULL||$type!=""){
					$db2->where("N_category_ref",$type);
				}
				if($tag != NULL && $tag != ""){
					$db2->where("( N_tag like '%".$tag."%')");
				}
				$db2->order_by("N_date","desc");
				$db2->limit($offset,$limit);
				$query = $db2->get("KM_category_news");
				//echo $db2->last_query();
				return $query->result(); 
				//return $db2->last_query();
			} else {
				if($type!=NULL||$type!=""){
					$db2->where("N_category_ref",$type);
				}
				if($tag != NULL && $tag != ""){
					//$db2->where("( N_tag like '%".$tag."%')");
				}
				
				$db2->order_by("N_date","desc");
				$query = $db2->get("KM_news");
				return $query->num_rows();
			}
	}
	function search_ac($txt,$category = NULL,$offset = NULL,$limit = NULL){		
	$db2 = $this->load->database('articledb', TRUE);	
			if(! is_null($offset) && ! is_null($limit)) {
				
				if($category != NULL && $category != ""){ $db2->where("N_category_ref",$category); }
				$db2->where("( N_title like '%".$txt."%' OR N_short_desc like '%".$txt."%' OR N_desc like '%".$txt."%' )");
				$db2->order_by("N_date","desc");
				$db2->limit($offset,$limit);
				$query = $db2->get("KM_news");
				//echo $db2->last_query();
				return $query->result(); 
				//return $db2->last_query();
			} else {
				
				if($category != NULL && $category != ""){ $db2->where("N_category_ref",$category); }
				$db2->where("( N_title like '%".$txt."%' OR N_short_desc like '%".$txt."%' OR N_desc like '%".$txt."%')");
				$db2->order_by("N_date","desc");
				$query = $db2->get("KM_news");
				return $query->num_rows();
			}
	}
	function search_advance($txt=NULL,$start=NULL,$stop=NULL,$category = NULL,$offset = NULL,$limit = NULL){		
	$db2 = $this->load->database('articledb', TRUE);	
	
			if($start != NULL && $start != ""){ $db2->where("N_date >= {ts '".$start." 00:00:00.000'}"); }	
			if($stop != NULL && $stop != ""){ $db2->where("N_date <= {ts '".$stop." 23:59:59.000'}"); }
			if(! is_null($offset) && ! is_null($limit)) {
				
				if($category != NULL && $category != "null"){ $db2->where("N_category_ref",$category); }
				$db2->where("( N_title like '%".$txt."%' OR N_short_desc like '%".$txt."%' OR N_desc like '%".$txt."%' )");
				$db2->order_by("N_date","desc");
				$db2->limit($offset,$limit);
				$query = $db2->get("KM_news");
				//echo $db2->last_query();
				return $query->result(); 
				//return $db2->last_query();
			} else {
				
				if($category != NULL && $category != "null"){ $db2->where("N_category_ref",$category); }
				$db2->where("( N_title like '%".$txt."%' OR N_short_desc like '%".$txt."%' OR N_desc like '%".$txt."%')");
				$db2->order_by("N_date","desc");
				$query = $db2->get("KM_news");
				return $query->num_rows();
			}
	}
	

	

}
?>