<?php
class Model_home extends MY_Model
{
	function __construct()
	{
		$this->load->database();		
		
	}
	
	function get_faq(){	
		$this->db->where('FAQ_activated',1);		
		$this->db->order_by('FAQ_order','ASC');
		$query = $this->db->get("faq");
		return $query->result(); 
	}
	function get_month(){
		$query = $this->db->query("SELECT TOP 5
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
						dbo.article.ATC_delete = NULL AND
						dbo.article_monthly.AM_month = '".date('m')."' AND
						dbo.article.ATC_status = '1อนุญาตให้เผยแพร่' AND
						dbo.article_monthly.AM_year = '".date('Y')."'
						ORDER BY
						dbo.article_monthly.AM_view DESC");	
			return $query->result(); 
	}
	function get_contact(){	
		$query = $this->db->get("address");
		return $query->result(); 
	}
	function contact_add($data){	
		$this->db->insert('contact_us', $data); 
		return $this->db->insert_id();
	}
	
	function contact_getmail(){
		$query = $this->db->get("set_mail");
		return $query->row();	
	}
	
}
?>