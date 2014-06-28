<?php @session_start(); ?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Coding by : Thanutchai Kaewmong */
class Login extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('model_login');
			
		$date = new DateTime();
		
		if($this->session->userdata('session_loginfalse_time') != 0 && $this->session->userdata('session_loginfalse_time') != "" && ($this->session->userdata('session_loginfalse_time')+900) <= $date->format('U')){
			$this->session->unset_userdata('session_loginfalse');
			$this->session->unset_userdata('session_loginfalse_time');
		}	
			
		if($this->session->userdata('session_loginfalse') == NULL || $this->session->userdata('session_loginfalse') == "")
		$this->session->set_userdata('session_loginfalse',0);
	}
	
	public function index(){
	
		if($this->session->userdata('session_login')!=""){
				redirect('backoffice/profile','location');
		}
		$this->template->build('backoffice/include/login');
	}
	
	public function unset_(){
		$this->session->unset_userdata('session_loginfalse');
		redirect('backoffice/login','location');
	}
	
	public function access(){	
		if($this->session->userdata('session_loginfalse') > 4 ){
			$this->session->set_flashdata('information','คุณกรอกข้อมูลผิดเกิน 5 ครั้ง, กรุณากรอกข้อมูลใหม่ภายหลัง 15 นาที.');	
			$date = new DateTime();
			$a = $date->format('U');
			$this->session->set_userdata('session_loginfalse_time',$a);
			redirect('backoffice/login','location');
		}
		
		$this->form_validation->set_rules('username', 'Username', "trim|required|alpha_numeric|callback__check_login");
	    $this->form_validation->set_rules('password', 'Password', "trim|alpha_numeric|required");
		
		if($this->form_validation->run($this) == FALSE) 
		{
			$this->index();
		} 
		else 
		{
			$this->session->unset_userdata('session_loginfalse');
			$this->_path = FCPATH . 'uploads/ckeditor/'.md5($this->session->userdata('session_accid')).'/'; //setting image path by user level
			if( ! is_dir($this->_path))
			{
				mkdir($this->_path, 0777, TRUE); //make new directory if not created
				passthru("sudo chmod -Rf 777 " . $this->_path);
			}	
			redirect('backoffice/profile','location');
		}
	}
	
	public function _check_login($username) 	{
		$chk_password = $this->model_login->chk_password($username,$this->input->post('password'));
		if(empty($chk_password)) 
		{
				$this->session->set_userdata('session_loginfalse',$this->session->userdata('session_loginfalse')+1);
				$this->form_validation->set_message('_check_login','Username or Password invalid ('.$this->session->userdata('session_loginfalse').')');				
	    		return FALSE;
		} 
		else 
		{
				$this->session->set_userdata('session_accid',$chk_password->ACC_id);
				$this->session->set_userdata('session_login',$chk_password->ACC_name);
				$this->session->set_userdata('session_menu',authen($chk_password->ACC_menu));
				$_SESSION['DIR_SELF'] = md5($this->session->userdata('session_accid'));
				return TRUE;
		}
	}
	
	public function logout(){
		$this->session->unset_userdata('session_login');
		$this->session->unset_userdata('session_accid');
		$this->session->unset_userdata('session_loginfalse');
		$this->session->unset_userdata('session_menu');
		redirect('backoffice/login','location');
	}
}