<?php
class Model_address extends MY_Model
{
	function __construct()
	{
		$this->load->database();
	}
	
	
	function get_for_update(){
		$query = $this->db->get("address");
		return $query->row();	
	}
	
	function update_ac($data,$id){
			$this->db->where('ADD_id',$id);
			$this->db->update('address',$data);
	}
}
?>