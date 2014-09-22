<?php
class Model_suggest_article extends MY_Model
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
	
	function get_ac($offset = NULL,$limit = NULL){	
		$squery = "SELECT * FROM dbo.category INNER JOIN dbo.article ON dbo.category.CAT_id = dbo.article.ATC_category_ref WHERE dbo.category.CAT_activated = 1"; 
		$where = "";
		$order = "";			
			if(! is_null($offset) && ! is_null($limit)) {
				$where .= " AND ATC_status = '1อนุญาตให้เผยแพร่'"; 
				$order = " ORDER BY ATC_suggest desc,ATC_date desc";
				if($limit==""){
					$limit=0;	
				}
				$query = $this->db->query("WITH outer_tbl AS (SELECT ROW_NUMBER() OVER (".$order.") AS ZEND_DB_ROWNUM, * FROM (".$squery.$where.") AS inner_tbl) SELECT * FROM outer_tbl WHERE ZEND_DB_ROWNUM BETWEEN ".$limit." AND ".$offset."");
				return $query->result(); 
				//return $this->db->last_query();
			} else {
				$where .= " AND ATC_status = '1อนุญาตให้เผยแพร่'"; 
				$order = " ORDER BY ATC_suggest desc,ATC_date desc";
				$query = $this->db->query($squery.$where);
				return $query->num_rows();
			}
	}
	
	function search_ac($txt,$category = NULL,$start = NULL,$end = NULL,$offset = NULL,$limit = NULL){			
			if(! is_null($offset) && ! is_null($limit)) {
				if($category != NULL && $category != ""){ $where .= " AND ATC_category_ref = '".$category."'";  }
				
				if($start != NULL && $start != ""){ $where .= " AND ATC_date >= {ts '".$end." 00:00:00.000'}"; }
				
				if($end != NULL && $end != ""){ $where .= " AND ATC_date <= {ts '".$end." 23:59:59.000'}";   }
				
				$where .= " AND ( ATC_title like '%".$txt."%' OR ATC_short_desc like '%".$txt."%' OR ATC_desc like '%".$txt."%' OR ATC_tag like '%".$txt."%' )";  
				$where .= " AND ATC_status = '1อนุญาตให้เผยแพร่'"; 
				$order = " ORDER BY ATC_suggest desc,ATC_date desc";
				if($limit==""){
					$limit=0;	
				}
				$query = $this->db->query("WITH outer_tbl AS (SELECT ROW_NUMBER() OVER (".$order.") AS ZEND_DB_ROWNUM, * FROM (".$squery.$where.") AS inner_tbl) SELECT * FROM outer_tbl WHERE ZEND_DB_ROWNUM BETWEEN ".$limit." AND ".$offset."");
				return $query->result(); 
				//return $this->db->last_query();
			} else {
				if($category != NULL && $category != ""){ $where .= " AND ATC_category_ref = '".$category."'";  }
				
				if($start != NULL && $start != ""){ $where .= " AND ATC_date >= {ts '".$end." 00:00:00.000'}"; }
				
				if($end != NULL && $end != ""){ $where .= " AND ATC_date <= {ts '".$end." 23:59:59.000'}";   }
				
				$where .= " AND ( ATC_title like '%".$txt."%' OR ATC_short_desc like '%".$txt."%' OR ATC_desc like '%".$txt."%' OR ATC_tag like '%".$txt."%' )";  
				$where .= " AND ATC_status = '1อนุญาตให้เผยแพร่'"; 
				$order = " ORDER BY ATC_suggest desc,ATC_date desc";
				$query = $this->db->query($squery.$where);
				return $query->num_rows();
			}
	}
	
	function add_ac($data){
		$this->db->insert('article', $data); 
	}
	
	function get_for_update($id){
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