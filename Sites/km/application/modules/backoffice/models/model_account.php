<?php
class Model_account extends MY_Model
{
	function __construct()
	{
		$this->load->database();
	}
	function get_category(){		
				$db2 = $this->load->database('articledb', TRUE);			
				$db2->where("SC07_Status","Y");
				$db2->order_by("SC07_DepartmentName","asc");
				$query = $db2->get("SC07_Department");
				return $query->result(); 
				//return $this->db->last_query();
	}
	function get_ac($offset = NULL,$limit = NULL){			
			if(! is_null($offset) && ! is_null($limit)) {
				$this->db->where("( ACC_menu NOT LIKE 'ALL' )");
				$this->db->limit($offset,$limit);
				$query = $this->db->get("account");
				return $query->result(); 
				//return $this->db->last_query();
			} else {
				$this->db->where("( ACC_menu NOT LIKE 'ALL' )");
				$query = $this->db->get("account");
				return $query->num_rows();
			}
	}
	
	function search_ac($txt,$offset = NULL,$limit = NULL){			
			if(! is_null($offset) && ! is_null($limit)) {
				$this->db->where("( ACC_name like '%".$txt."%' OR ACC_username like '%".$txt."%' )");
				$this->db->where("( ACC_menu NOT LIKE 'ALL' )");
				$this->db->limit($offset,$limit);
				$query = $this->db->get("account");
				return $query->result(); 
				//return $this->db->last_query();
			} else {
				$this->db->where("( ACC_name like '%".$txt."%' OR ACC_username like '%".$txt."%' )");
				$this->db->where("( ACC_menu NOT LIKE 'ALL' )");
				$query = $this->db->get("account");
				return $query->num_rows();
			}
	}
	
	function check_user_matching($user){
		$this->db->where("ACC_username",$user);
		$query = $this->db->get("account");
		return $query->result();
	}
	
	function add_ac($data){
		$this->db->insert('account', $data); 
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
	
	function delete_ac($val){
			$this->db->where_in('ACC_id',$val);
			return $this->db->delete('account');
			return TRUE;
	}
	
	function check_pass_matching($pass,$id){
			$this->db->where('ACC_password',$pass);
			$this->db->where('ACC_id',$id);
			$query = $this->db->get('account');
			return $query->row();	
	}
}
?>