<?php
class Model_login extends MY_Model
{
	function __construct()
	{
		$this->load->database();
	}
	
	public function chk_password($user,$pass)
	{
		$this->db->where('ACC_username',$user);
		$this->db->where('ACC_password',$pass);
        $query = $this->db->get('account');
		return $query->row();
		//return $this->db->last_query();
	}
	
	public function testy()
	{
		$this->db->limit(1);
        $query = $this->db->get('test');
		return $query->result();
		//return $this->db->last_query();
	}
}
?>