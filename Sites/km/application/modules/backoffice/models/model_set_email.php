<?php
class Model_set_email extends MY_Model
{
	function __construct()
	{
		$this->load->database();
	}
	function get_for_update(){
		$query = $this->db->get("set_email");
		return $query->row();	
	}
	
	function update_ac($data,$id){
			$this->db->where('SET_id',1);
			$this->db->update('set_email',$data);
	}
	
}
?>