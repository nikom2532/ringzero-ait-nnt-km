<?php
class Model_sendemail extends MY_Model
{
	function __construct()
	{
		$this->load->database();
	}
	
	function add_ac($data){
		$this->db->insert('contact_us', $data); 
	}
	function get_contact(){	
		$query = $this->db->get("address");
		return $query->result(); 
	}
}
?>