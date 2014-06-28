<?php
class Model_toparticle extends MY_Model
{
	function __construct()
	{
		$this->load->database();
	}
	
	function get_year(){			
				$query = $this->db->query("SELECT DISTINCT dbo.article_monthly.AM_year as AM_year  FROM dbo.article_monthly");
				return $query->result(); 
				//return $this->db->last_query();
	}
	
	function get_ac(){			
				$sql = "SELECT TOP 5 * 
							FROM
							dbo.article_monthly ,
							dbo.article ,
							dbo.category
							WHERE
							dbo.article_monthly.AM_atc_ref = dbo.article.ATC_id AND
							dbo.article.ATC_status LIKE '%1อนุญาตให้เผยแพร่%' AND
							dbo.article.ATC_activated = 1 AND
							dbo.category.CAT_id = dbo.article.ATC_category_ref
							ORDER BY
							dbo.article_monthly.AM_view DESC

							";
				$query = $this->db->query("$sql");
				return $query->result(); 
				//return $this->db->last_query();
	}
	
	function search_ac($year = NULL,$month = NULL){			

				$sql = "SELECT TOP 5 * 
							FROM
							dbo.article_monthly ,
							dbo.article ,
							dbo.category
							WHERE
							dbo.article_monthly.AM_atc_ref = dbo.article.ATC_id AND
							dbo.article.ATC_status LIKE '%1อนุญาตให้เผยแพร่%' AND
							dbo.article.ATC_activated = 1 AND
							dbo.category.CAT_id = dbo.article.ATC_category_ref 
							".($month != NULL && $month != "" ? " AND dbo.article_monthly.AM_month like '%".$month."%'" : "")."
							".($year != NULL && $year != "" ? " AND dbo.article_monthly.AM_year like '%".$year."%'" : "")."
							ORDER BY
							dbo.article_monthly.AM_view DESC

							";
				$query = $this->db->query("$sql");
				return $query->result(); 
				
	}
	
	function add_ac($data){
		$this->db->insert('article', $data); 
	}
	
	function get_for_update($id){
		$sql = "SELECT * 
							FROM
							dbo.article_monthly ,
							dbo.article ,
							dbo.category
							WHERE
							dbo.article_monthly.AM_atc_ref = dbo.article.ATC_id AND
							dbo.article.ATC_status LIKE '%1อนุญาตให้เผยแพร่%' AND
							dbo.article.ATC_activated = 1 AND
							dbo.category.CAT_id = dbo.article.ATC_category_ref AND 
							dbo.article.ATC_id = ".$id." 
							ORDER BY
							dbo.article_monthly.AM_view DESC

							";
		 $query = $this->db->query("$sql");
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