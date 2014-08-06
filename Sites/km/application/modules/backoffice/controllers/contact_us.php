<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Coding by : Thanutchai Kaewmong */
class Contact_us extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('backoffice/model_contact_us');
		$this->path_upload= FCPATH. 'uploads/contact_us/';
		
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
			->set_view('menu','backoffice/include/menu', array('menu_main'=>10,'sub'=>1));
			
			if($this->session->userdata('session_login') == ""){
					$this->session->set_flashdata('error','กรุณากรอกข้อมูลผู้ใช้ใหม่');
					redirect('backoffice/login','location');
			}
			if(!in_array("Contact_us",explode(",",$this->session->userdata('session_menu'))) && $this->session->userdata('session_menu') != "ALL"){
				    $this->session->set_flashdata('error','ไม่อนุญาตให้เข้าใช้งาน');
					redirect('backoffice/profile','location');
		    }
	}
	
	public function index(){
		if($this->session->userdata("search_contact_us") != ""){
						$this->session->unset_userdata("search_contact_us");
		}
		
		 $config["base_url"] = base_url()."backoffice/contact_us/index";
		 $config['total_rows'] =  $this->model_contact_us->get_ac();
		 $config['per_page'] = '40'; 
		 $config['num_links'] = '5'; 
		 $config['uri_segment'] = 5;
		 $config['full_tag_open'] = '<div class="pagination">';
		 $config['full_tag_close'] = '</div>';
		 $config['first_link'] = '« First';
		 $config['last_link'] = 'Last »';
	 	 $config['next_link'] = '&gt;';
		 $config['prev_link'] = '&lt;';
		 
		 $this->pagination->initialize($config); 
		 
		 $data['rows'] = $this->model_contact_us->get_ac($config['per_page'],$this->uri->segment(5));
		 
		 $data['pagination'] =  $this->pagination->create_links();
		
		if(in_array("ALL",explode(",",$this->session->userdata('session_menu')))){
					 $this->template
					 ->set_view('notices','backoffice/include/notices')
					 ->set_view('shortcut','backoffice/include/shortcutpro')
					 ->set_view('search','backoffice/include/search')
					 ->build('backoffice/contact_us/index',$data);
			}else{
					$this->template
					 ->set_view('notices','backoffice/include/notices')
					 ->set_view('shortcut','backoffice/include/shortcutpro')
					 ->build('backoffice/contact_us/index2',$data);
			}
	
	}
	
	public function search(){
		if(isset($_POST['search']) && $_POST['search'] == ""){
				redirect('backoffice/contact_us/index','location');	
		}
				 if($this->input->post("search") != ""){
						$txt = $this->input->post("search");
						$this->session->set_userdata("search_contact_us",$txt);
				 }else{
						$txt  = $this->session->userdata("search_contact_us");					 	
				 }
		 $config["base_url"] = base_url()."backoffice/contact_us/search";
		 $config['total_rows'] =  $this->model_contact_us->search_ac($txt);
		 $config['per_page'] = '40'; 
		 $config['num_links'] = '5'; 
		 $config['uri_segment'] = 5;
		 $config['full_tag_open'] = '<div class="pagination">';
		 $config['full_tag_close'] = '</div>';
		 $config['first_link'] = '« First';
		 $config['last_link'] = 'Last »';
	 	 $config['next_link'] = '&gt;';
		 $config['prev_link'] = '&lt;';
		 
		 $this->pagination->initialize($config); 
		 
		 $data['rows'] = $this->model_contact_us->search_ac($txt,$config['per_page'],$this->uri->segment(5));
		 
		 $data['pagination'] =  $this->pagination->create_links();
		 $this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcutpro')
		 ->set_view('search','backoffice/include/search')
		 ->build('backoffice/contact_us/index',$data);
	}
	
	public function delete($param1=NULL){
		$del_data = ($param1==NULL ? $this->input->post('chkbox') : $param1 );
		$result = $this->model_contact_us->get_for_update($param1);
		$this->model_contact_us->delete_ac($del_data);		
		if($param1 == NULL){
			$this->session->set_flashdata('success','ลบข้อมูลสำเร็จ');
		} else {
			$this->session->set_flashdata('success','ลบข้อมูลสำเร็จ');
		}
		redirect('backoffice/contact_us/index','location');
	} 
	
}
?>