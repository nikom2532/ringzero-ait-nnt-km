<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Coding by : Thanutchai Kaewmong */
class Set_email extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('backoffice/model_set_email');
		
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
			->set_view('menu','backoffice/include/menu', array('menu_main'=>9,'sub'=>1));
			
			if($this->session->userdata('session_login') == ""){
					$this->session->set_flashdata('error','Session data timeout, Please enter new information.');
					redirect('backoffice/login','location');
			}
			if(!in_array("Set_email",explode(",",$this->session->userdata('session_menu'))) && $this->session->userdata('session_menu') != "ALL"){
				    $this->session->set_flashdata('error','ไม่อนุญาตให้เข้าใช้งาน');
					redirect('backoffice/profile','location');
		    }
	}
	
	public function index(){
			$data["result"] = $this->model_set_email->get_for_update();
			
			if(in_array("ALL",explode(",",$this->session->userdata('session_menu')))){
					 $this->template
					->set_view('shortcut','backoffice/include/shortcutpro')
					->set_view('notices','backoffice/include/notices')
					->build('backoffice/set_email/form',$data);
			}else{
					$this->template
					->set_view('shortcut','backoffice/include/shortcutpro')
					->set_view('notices','backoffice/include/notices')
					->build('backoffice/set_email/form2',$data);
			}
			
			
	}
	
	public function update(){
			$this->form_validation->set_rules('email', 'อีเมลล์ผู้รับผิดชอบการติดต่อ', "trim|required");
			
			if($this->form_validation->run($this) == TRUE){
				$data['SET_email'] = $this->input->post('email');
				$this->model_set_email->update_ac($data,1);
				$this->session->set_flashdata('success','เปลี่ยนรหัสผ่านสำเร็จ');
				redirect('backoffice/set_email/index','location');
			}else{
				$this->index();
			}
	}

}