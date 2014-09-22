<?php
class Model_article extends MY_Model
{
	function __construct()
	{
		$this->load->database();
	}
	function get_topmonth($year,$month){
		$query = $this->db->query("SELECT 
						dbo.article.ATC_id,
						dbo.article.ATC_category_ref,
						dbo.article.ATC_writer_key,
						dbo.article.ATC_image,
						dbo.article.ATC_date,
						dbo.article.ATC_title,
						dbo.article.ATC_short_desc,
						dbo.article.ATC_desc,
						dbo.article.ATC_tag,
						dbo.article.ATC_writer,
						dbo.article.ATC_video,
						dbo.article.ATC_file,
						dbo.article.ATC_status,
						dbo.article.ATC_delete,
						dbo.article_monthly.AM_month,
						dbo.article_monthly.AM_year,
						dbo.article_monthly.AM_view,
						dbo.article.ATC_approve_by,
						dbo.article.ATC_quality,
						dbo.article.ATC_add,
						dbo.article.ATC_writer_ref,
						dbo.article.ATC_viewall
						
						FROM
						dbo.article_monthly
						LEFT JOIN dbo.article ON dbo.article.ATC_id = dbo.article_monthly.AM_atc_ref
						WHERE
						dbo.article.ATC_activated = '1' AND 
						dbo.article.ATC_status = '1อนุญาตให้เผยแพร่' AND 
						dbo.article_monthly.AM_month = '".$month."' AND
						dbo.article_monthly.AM_year = '".$year."'
						ORDER BY
						dbo.article_monthly.AM_view DESC");	
						//dbo.article_monthly.AM_view DESC");	
			return $query->result(); 
	}
	function get_chkmonth($year,$month,$id){
		$this->db->where("AM_atc_ref",$id);
		$this->db->where("AM_year",$year);
		$this->db->where("AM_month",$month);
		$query = $this->db->get("article_monthly");
		return $query->result();
	}
	function add_ac($data){
		$this->db->insert('article_monthly', $data); 
	}

	function update_ac($data,$id){
			$this->db->where("ATC_id",$id);
			$this->db->update('article',$data);
	}
	function get_category(){			
				$this->db->select("CAT_id,CAT_topic");
				//$this->db->where("CAT_activated",1);
				$this->db->order_by("CAT_topic","asc");
				$query = $this->db->get("category");
				return $query->result(); 
				//return $this->db->last_query();
	}
	function get_categoryid($type=NULL){			
		$this->db->select("CAT_id,CAT_topic");
		$this->db->where("CAT_id",$type);
		$this->db->where("CAT_activated",1);
		$this->db->order_by("CAT_topic","asc");
		$query = $this->db->get("category");
		return $query->result(); 
		//return $this->db->last_query();
	}
	function get_rssac($type=NULL){	
		if($type!=NULL){
			$this->db->where("ATC_category_ref",$type);
		}
		$this->db->where("ATC_activated",1);
				$this->db->where("ATC_status","1อนุญาตให้เผยแพร่");
				$this->db->where("ATC_delete",0);
		$this->db->order_by("ATC_date","desc");
		$query = $this->db->get("article");
		return $query->result(); 
	}
	function get_rssachot($type=NULL){	
		if($type!=NULL){
			$this->db->where("ATC_category_ref",$type);
		}
		$this->db->where("ATC_activated",1);
				$this->db->where("ATC_status","1อนุญาตให้เผยแพร่");
				$this->db->where("ATC_delete",0);
		$this->db->order_by("ATC_date","desc");
		$this->db->limit(3);
		$query = $this->db->get("article");
		return $query->result(); 
	}
	function get_id($id){			
			$this->db->where("ATC_id",$id);
			$this->db->where("ATC_activated",1);
			$this->db->where("ATC_status","1อนุญาตให้เผยแพร่");
			$query = $this->db->get("article");
			return $query->result(); 
				
	}
	function get_review($id){			
			$this->db->where("ATC_id",$id);
			$query = $this->db->get("article");
			return $query->result(); 
				
	}
	function get_reviewid($id){			
			$this->db->where("ATC_id",$id);
			//$this->db->where("ATC_activated",1);
			//$this->db->where("ATC_status","1อนุญาตให้เผยแพร่");
			$query = $this->db->get("article");
			return $query->result(); 
				
	}
	function get_resent($id=NULL,$cat=NULL){			
			$this->db->where("ATC_id<>".$id);
			if($cat!=NULL)
			$this->db->where("ATC_category_ref",$cat);
			$this->db->where("ATC_delete",NULL);
			$this->db->where("ATC_activated",1);
			$this->db->where("ATC_status","1อนุญาตให้เผยแพร่");
			$this->db->limit(3);
			$query = $this->db->get("article");
			return $query->result(); 
				
	}
	function get_ac($type=NULL,$offset = NULL,$limit = NULL){	
	$squery = "SELECT * FROM dbo.category INNER JOIN dbo.article ON dbo.category.CAT_id = dbo.article.ATC_category_ref WHERE dbo.category.CAT_activated = 1"; 
	$where = "";
	$order = "";			
			if(! is_null($offset) && ! is_null($limit)) {
				$where .= " AND ATC_activated = '1'"; 
				$where .= " AND ATC_status = '1อนุญาตให้เผยแพร่'"; 
				$where .= " AND ATC_delete = '0'"; 
				if($type!=NULL&&$type!="suggest"){
					$where .= " AND ATC_category_ref = '".$type."'"; 
				}
				if($type=="suggest"){
					$where .= " AND ATC_suggest = '1'"; 
				}
				if($limit==""){ $limit=0;	}
				$order = " ORDER BY ATC_date desc";
				
				$query = $this->db->query("WITH outer_tbl AS (SELECT ROW_NUMBER() OVER (".$order.") AS ZEND_DB_ROWNUM, * FROM (".$squery.$where.") AS inner_tbl) SELECT * FROM outer_tbl WHERE ZEND_DB_ROWNUM BETWEEN ".$limit." AND ".$offset."");
				return $query->result(); 
				
			} else {
				if($type!=NULL){
					$where .= " AND ATC_category_ref = '".$type."'"; 
				}
				$where .= " AND ATC_activated = '1'"; 
				$where .= " AND ATC_status = '1อนุญาตให้เผยแพร่'"; 
				$where .= " AND ATC_delete = '0'"; 
				$order = " ORDER BY ATC_date desc";
				$query = $this->db->query($squery.$where);
				return $query->num_rows();
			}
	}
	function get_tag($tag=NULL,$type=NULL,$offset = NULL,$limit = NULL){	
	$squery = "SELECT * FROM dbo.category INNER JOIN dbo.article ON dbo.category.CAT_id = dbo.article.ATC_category_ref WHERE dbo.category.CAT_activated = 1"; 
	$where = "";
	$order = "";			
			if(! is_null($offset) && ! is_null($limit)) {
				$where .= " AND ATC_activated = '1'"; 
				$where .= " AND ATC_status = '1อนุญาตให้เผยแพร่'"; 
				$where .= " AND ATC_delete = '0'"; 
				if($type!=NULL||$type!=""){
					$where .= " AND ATC_category_ref = '".$type."'"; 
				}
				if($tag != NULL && $tag != ""){
					//$this->db->where("( ATC_tag like '%".$tag."%')");
					$where .= " AND ( ATC_tag like '%".$tag."%')"; 
				}
				if($limit==""){ $limit=0;	}
				$order = " ORDER BY ATC_date desc";
				
				$query = $this->db->query("WITH outer_tbl AS (SELECT ROW_NUMBER() OVER (".$order.") AS ZEND_DB_ROWNUM, * FROM (".$squery.$where.") AS inner_tbl) SELECT * FROM outer_tbl WHERE ZEND_DB_ROWNUM BETWEEN ".$limit." AND ".$offset."");
				
				return $query->result(); 
				//return $this->db->last_query();
			} else {
				if($type!=NULL||$type!=""){
					$where .= " AND ATC_category_ref = '".$type."'"; 
				}
				if($tag != NULL && $tag != ""){
					$where .= " AND ( ATC_tag like '%".$tag."%')"; 
				}
				$where .= " AND ATC_activated = '1'"; 
				$where .= " AND ATC_status = '1อนุญาตให้เผยแพร่'"; 
				$where .= " AND ATC_delete = '0'"; 
				$query = $this->db->query($squery.$where);
				return $query->num_rows();
			}
	}
	function search_ac($txt,$category = NULL,$offset = NULL,$limit = NULL){		
	$squery = "SELECT * FROM dbo.category INNER JOIN dbo.article ON dbo.category.CAT_id = dbo.article.ATC_category_ref WHERE dbo.category.CAT_activated = 1"; 
	$where = "";
	$order = "";		
			if(! is_null($offset) && ! is_null($limit)) {
				$where .= " AND ATC_activated = '1'"; 
				$where .= " AND ATC_status = '1อนุญาตให้เผยแพร่'"; 
				$where .= " AND ATC_delete = '0'"; 
				
				if($category != NULL && $category != ""){ $where .= " AND ATC_category_ref = '".$category."'"; }
				$where .= " AND ( ATC_title like '%".$txt."%' OR ATC_short_desc like '%".$txt."%' OR ATC_desc like '%".$txt."%' OR ATC_tag like '%".$txt."%' )"; 
				
				if($limit==""){ $limit=0;	}
				$order = " ORDER BY ATC_date desc";
				
				$query = $this->db->query("WITH outer_tbl AS (SELECT ROW_NUMBER() OVER (".$order.") AS ZEND_DB_ROWNUM, * FROM (".$squery.$where.") AS inner_tbl) SELECT * FROM outer_tbl WHERE ZEND_DB_ROWNUM BETWEEN ".$limit." AND ".$offset."");
				return $query->result(); 
				//return $this->db->last_query();
			} else {
				$where .= " AND ATC_activated = '1'"; 
				$where .= " AND ATC_status = '1อนุญาตให้เผยแพร่'"; 
				$where .= " AND ATC_delete = '0'"; 
				if($category != NULL && $category != ""){ $where .= " AND ATC_category_ref = '".$category."'"; }
				$where .= " AND ( ATC_title like '%".$txt."%' OR ATC_short_desc like '%".$txt."%' OR ATC_desc like '%".$txt."%' OR ATC_tag like '%".$txt."%' )"; 
				$query = $this->db->query($squery.$where);
				return $query->num_rows();
			}
	}
	

}
?>