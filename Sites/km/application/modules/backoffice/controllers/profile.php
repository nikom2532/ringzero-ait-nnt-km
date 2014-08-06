<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Coding by : Thanutchai Kaewmong */
class Profile extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('backoffice/model_profile');
		
		$this->template->set_layout('backoffice/layout/template')
			->title('Administrator Backoffice')
			->js('asset/backoffice/js/jquery-1.7.1.min.js')
			->js('asset/backoffice/js/simpla.jquery.configuration.js')
			->js('asset/backoffice/js/common.js')
			->js('asset/backoffice/js/jquery-ui-1.8.18.custom.min.js')
			->css('asset/backoffice/css/reset.css')
			->css('asset/backoffice/css/style.css')
			->css('asset/backoffice/css/invalid.css')
			->css('asset/backoffice/css/jquery-ui-1.8.18.custom.css')
			->meta('shortcut icon','asset/backoffice/images/icons/favicon(1).ico','rel')
			->meta('keywords','i do catering')
			->set_view('footer','backoffice/include/footer')
			->set_view('menu','backoffice/include/menu', array('menu_main'=>1,'sub'=>1));
			
			if($this->session->userdata('session_login') == ""){
					$this->session->set_flashdata('error','Session data timeout, Please enter new information.');
					redirect('backoffice/login','location');
			}
	}
	
	public function index(){		
		 $data['row'] =  $this->model_profile->get_for_update($this->session->userdata('session_accid'));
		 $this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcutpro')
		 ->build('backoffice/profile/index',$data);
	}
	
	public function change_password($param1){
			$data['key'] = $param1;
			$data["result"] = $this->model_profile->get_for_update($param1);
			$this->template
				->set_view('shortcut','backoffice/include/shortcutpro')
				->set_view('notices','backoffice/include/notices')
				->build('backoffice/profile/form_chgpass',$data);
	}
	
	public function save_password(){
			$this->form_validation->set_rules('old-password', 'รหัสผ่านเก่า', "trim|required|alpha_numeric|callback_check_pass");
		$this->form_validation->set_rules('password', 'รหัสผ่านใหม่', "trim|required|matches[confirm-password]|min_length[6]|max_length[15]|alpha_numeric");
			$this->form_validation->set_rules('confirm-password', 'ยืนยันรหัสผ่านใหม่', "trim|required");
			
			if($this->form_validation->run($this) == TRUE){
				$data['ACC_password'] = $this->input->post('password');
				$this->model_profile->update_ac($data,$this->session->userdata('session_accid'));
				$this->session->set_flashdata('success','เปลี่ยนรหัสผ่านสำเร็จ');
				redirect('backoffice/profile/index','location');
			}else{
				$this->change_password($this->session->userdata('session_accid'));
			}
	}
	
	public function check_pass($pass){
				$this->form_validation->set_message('check_pass', 'รหัสผ่านเก่าผิด');
				if($this->model_profile->check_pass_matching($pass,$this->session->userdata('session_accid'))){
					return TRUE;
				}else {
					return FALSE;
				}
				
	}
	
	
	public function ses(){
			var_dump($this->session->all_userdata());	
	} 
}