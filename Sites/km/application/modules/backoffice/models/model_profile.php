<?php
class Model_profile extends MY_Model
{
	function __construct()
	{
		$this->load->database();
	}
	function get_for_update($id){
		$this->db->where("ACC_id",$id);
		$query = $this->db->get("account");
		return $query->row();	
	}
	
	function update_ac($data,$id){
			$this->db->where('ACC_id',$id);
			$this->db->update('account',$data);
	}
	
	function check_pass_matching($pass,$id){
			$this->db->where('ACC_password',$pass);
			$this->db->where('ACC_id',$id);
			$query = $this->db->get('account');
			return $query->row();	
	}
}
?>