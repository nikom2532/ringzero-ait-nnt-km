<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Coding by : Thanutchai Kaewmong */
class Address extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('backoffice/model_address');
		$this->path_upload= FCPATH. 'uploads/address/';
		
		$this->template->set_layout('backoffice/layout/template')
			->title('Administrator Backoffice')
			->js('asset/backoffice/js/jquery-1.8.2.min.js')
            ->js('asset/backoffice/js/jquery-ui-1.8.24.custom.min.js')
			->js('asset/backoffice/js/simpla.jquery.configuration.js')
			->js('asset/backoffice/js/common.js')
			->js('asset/ckeditor/ckeditor.js')
			->css('asset/backoffice/css/reset.css')
            ->css('asset/backoffice/css/ui-lightness/jquery-ui-1.8.24.custom.css')
			->css('asset/backoffice/css/style.css')
			->css('asset/backoffice/css/invalid.css')
			->meta('shortcut icon','asset/backoffice/images/icons/favicon(1).ico','rel')
			->meta('keywords','i do catering')
			->set_view('footer','backoffice/include/footer')
			->set_view('menu','backoffice/include/menu', array('menu_main'=>11,'sub'=>1));
			
			if($this->session->userdata('session_login') == ""){
					$this->session->set_flashdata('error','กรุณากรอกข้อมูลผู้ใช้ใหม่');
					redirect('backoffice/login','location');
			}
			if(!in_array("Address",explode(",",$this->session->userdata('session_menu'))) && $this->session->userdata('session_menu') != "ALL"){
				    $this->session->set_flashdata('error','ไม่อนุญาตให้เข้าใช้งาน');
					redirect('backoffice/profile','location');
		    }
	}
	
	public function index(){	
		$data["result"] = $this->model_address->get_for_update();
		
		$this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcutpro')
		 ->build('backoffice/address/form',$data);
	}
	
	public function update(){
		$this->form_validation->set_rules('ADD_address', 'ที่อยู่', "trim");
		
		if($this->form_validation->run($this) == TRUE){
			$data = array(
					'ADD_address' =>  htmlencode($this->input->post('ADD_address',FALSE)),
					'ADD_tel' =>  $this->input->post('ADD_tel'),
					'ADD_fax' =>  $this->input->post('ADD_fax'),
					'ADD_web' =>  $this->input->post('ADD_web'),
					'ADD_email' =>  $this->input->post('ADD_email'),
					'ADD_update' => $this->config->item('now'),
					'ADD_userupdate' => $this->session->userdata('session_login')
			);
			
			////////////////////////////////////ADD_image/////////////////////////////////////////////
				$config_ADD_imgdetail['upload_path'] = $this->path_upload;
				$config_ADD_imgdetail['allowed_types'] = 'gif|jpg|png';
				$config_ADD_imgdetail['max_size'] = '2000';
				$config_ADD_imgdetail['encrypt_name'] = TRUE;
				
				$this->upload->initialize($config_ADD_imgdetail);
				
				if ($this->upload->do_upload('ADD_image')){
						$image_data = $this->upload->data();
						
								$config_img = array(
									'source_image' => $image_data['full_path'],
									'width' => 370,
									'height' => 360,
									'quality' => 100
								);
								
						$data['ADD_image'] = $image_data['file_name'];
						$this->unlink_pic($this->input->post('old_pic'));
				}
				
			
				$this->model_address->update_ac($data,$this->input->post('id'));
				$this->session->set_flashdata('success','แก้ไขสำเร็จ');
				redirect('backoffice/address/index','location');
		}else{
			$this->edit($this->input->post('id'));
		}
	}
	
	public function unlink_pic($pic){
		unlink($this->path_upload.$pic);
	}
	
	
}
?>