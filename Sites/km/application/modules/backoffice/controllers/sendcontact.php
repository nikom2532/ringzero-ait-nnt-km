<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Coding by : Thanutchai Kaewmong */
class Sendcontact extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('backoffice/model_sendemail');
		
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
			->set_view('menu','backoffice/include/menu', array('menu_main'=>10,'sub'=>1));
			
			if($this->session->userdata('session_login') == ""){
					$this->session->set_flashdata('error','Session data timeout, Please enter new information.');
					redirect('backoffice/login','location');
			}
			if(!in_array("Sendemail",explode(",",$this->session->userdata('session_menu'))) && $this->session->userdata('session_menu') != "ALL"){
				    $this->session->set_flashdata('error','ไม่อนุญาตให้เข้าใช้งาน');
					redirect('backoffice/profile','location');
		    }
	}
	
	public function index(){
			$data["result"] = $this->model_sendemail->get_contact();
			
			
					$this->template
					->set_view('shortcut','backoffice/include/shortcutpro')
					->set_view('notices','backoffice/include/notices')
					->build('backoffice/sendemail/form',$data);
			
			
			
	}
	
	public function update(){
			$this->form_validation->set_rules('formname', 'ชื่อ', "trim|required");
			$this->form_validation->set_rules('formemail', 'email', "email|required");
			$this->form_validation->set_rules('formtel', 'เบอร์โทร', "trim|required");
			$this->form_validation->set_rules('formtopic', 'ข้อความ', "trim|required");
			
			if($this->form_validation->run($this) == TRUE){
				$data = array(
				'CONT_name' => htmlencode($this->input->post('formname')),
				'CONT_email' => htmlencode($this->input->post('formemail')),
				'CONT_tel' => htmlencode($this->input->post('formtel')),
				'CONT_message' => htmlencode($this->input->post('formtopic')),
				'CONT_add' => date('Y-m-d H:i:s')
			);
				$this->model_sendemail->add_ac($data);
				$this->session->set_flashdata('success','ส่งข้อความติดต่อสำเร็จ');
				redirect('backoffice/sendcontact/index','location');
			}else{
				$this->index();
			}
	}

}