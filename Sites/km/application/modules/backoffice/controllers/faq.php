<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Coding by : Thanutchai Kaewmong */
class Faq extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('backoffice/model_faq');
		
		$this->template->set_layout('backoffice/layout/template')
			->title('Administrator Backoffice')
			->js('asset/backoffice/js/jquery-1.7.1.min.js')
			->js('asset/backoffice/js/simpla.jquery.configuration.js')
			->js('asset/backoffice/js/common.js')
			->js('asset/backoffice/js/jquery-ui-1.8.18.custom.min.js')
			->js('asset/ckeditor/ckeditor.js')
			->css('asset/backoffice/css/reset.css')
			->css('asset/backoffice/css/style.css')
			->css('asset/backoffice/css/invalid.css')
			->css('asset/backoffice/css/jquery-ui-1.8.18.custom.css')
			->meta('shortcut icon','asset/backoffice/images/icons/favicon(1).ico','rel')
			->meta('keywords','i do catering')
			->set_view('footer','backoffice/include/footer')
			->set_view('menu','backoffice/include/menu', array('menu_main'=>8,'sub'=>1));
			
			if($this->session->userdata('session_login') == ""){
					$this->session->set_flashdata('error','กรุณากรอกข้อมูลผู้ใช้ใหม่');
					redirect('backoffice/login','location');
			}
			if(!in_array("FAQ",explode(",",$this->session->userdata('session_menu'))) && $this->session->userdata('session_menu') != "ALL"){
				    $this->session->set_flashdata('error','ไม่อนุญาตให้เข้าใช้งาน');
					redirect('backoffice/profile','location');
		    }
	}
	
	public function index(){
		if($this->session->userdata("search_faq") != ""){
						$this->session->unset_userdata("search_faq");
		}
		
		 $config["base_url"] = base_url()."backoffice/faq/index";
		 $config['total_rows'] =  $this->model_faq->get_ac();
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
		 
		 $data['rows'] = $this->model_faq->get_ac($config['per_page'],$this->uri->segment(5));
		 
		 $data['pagination'] =  $this->pagination->create_links();

		if(in_array("ALL",explode(",",$this->session->userdata('session_menu')))){
					 $this->template
					 ->set_view('notices','backoffice/include/notices')
					 ->set_view('shortcut','backoffice/include/shortcut')
					 ->set_view('search','backoffice/include/search')
					 ->build('backoffice/faq/index',$data);
		}else{
					$this->template
					 ->set_view('notices','backoffice/include/notices')
					 ->set_view('shortcut','backoffice/include/shortcutpro')
					 ->build('backoffice/faq/index2',$data);
		}
	}
	
	public function search(){
		if(isset($_POST['search']) && $_POST['search'] == ""){
				redirect('backoffice/faq/index','location');	
		}
				 if($this->input->post("search") != ""){
						$txt = $this->input->post("search");
						$this->session->set_userdata("search_faq",$txt);
				 }else{
						$txt  = $this->session->userdata("search_faq");					 	
				 }
		 $config["base_url"] = base_url()."backoffice/faq/search";
		 $config['total_rows'] =  $this->model_faq->search_ac($txt);
		 $config['per_page'] = '40'; 
		 $config['num_links'] = '5'; 
		 $config['uri_segment'] = 5;
		 $config['full_tag_open'] = '<div class="paginate">';
		 $config['full_tag_close'] = '</div>';
		 $config['first_link'] = '« First';
		 $config['last_link'] = 'Last »';
	 	 $config['next_link'] = '&gt;';
		 $config['prev_link'] = '&lt;';
		 
		 $this->pagination->initialize($config); 
		 
		 $data['rows'] = $this->model_faq->search_ac($txt,$config['per_page'],$this->uri->segment(5));
		 
		 $data['pagination'] =  $this->pagination->create_links();
		 $this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcut')
		 ->set_view('search','backoffice/include/search')
		 ->build('backoffice/faq/index',$data);
	}
	
	public function create($msg = NULL){	
		$data['messages'] = $msg;
		$this->template
		->set_view('shortcut','backoffice/include/shortcut')
		->set_view('notices','backoffice/include/notices',$data)
		->build('backoffice/faq/form',$data);
	}
	
	public function save(){	
		$this->form_validation->set_rules('q', 'คำถาม', "trim|required");	
		$this->form_validation->set_rules('a', 'คำตอบ', "trim|required");
		$this->form_validation->set_rules('order', 'ลำดับข้อมูล', "trim|required|is_natural_no_zero");
		
		if($this->form_validation->run($this) == TRUE){
			$data = array(
					'FAQ_question' =>  $this->input->post('q'),
					'FAQ_answer' =>  $this->input->post('a'),
					'FAQ_order' =>  $this->input->post('order'),
					'FAQ_activated' =>  $this->input->post('active'),
					'FAQ_add' => $this->config->item('now'),
					'FAQ_update' => $this->config->item('now'),
					'FAQ_userupdate' => $this->session->userdata('session_login')					
			);
			
			$this->model_faq->add_ac($data);
			$this->session->set_flashdata('success','เพิ่มข้อมูลสำเร็จ');
			redirect('backoffice/faq/index','location');
		}else{
			$this->create();
		}
	}
	
	public function edit($param1){	
		$data["result"] = $this->model_faq->get_for_update($param1);
		$this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcut')
		 ->build('backoffice/faq/form',$data);
	}
	
	public function update(){
		$this->form_validation->set_rules('q', 'คำถาม', "trim|required");	
		$this->form_validation->set_rules('a', 'คำตอบ', "trim|required");
		$this->form_validation->set_rules('order', 'ลำดับข้อมูล', "trim|required|is_natural_no_zero");
		
		if($this->form_validation->run($this) == TRUE){
			$data = array(
					'FAQ_question' =>  $this->input->post('q'),
					'FAQ_answer' =>  $this->input->post('a'),
					'FAQ_order' =>  $this->input->post('order'),
					'FAQ_activated' =>  $this->input->post('active'),
					'FAQ_update' => $this->config->item('now'),
					'FAQ_userupdate' => $this->session->userdata('session_login')					
			);
			
			$this->model_faq->update_ac($data,$this->input->post('id'));
			$this->session->set_flashdata('success','แก้ไขสำเร็จ');
			redirect('backoffice/faq/index','location');
		}else{
			$this->edit($this->input->post('id'));
		}
	}
	
	public function activated($param1=NULL,$param2=NULL){
		if($param1 == NULL && $param2 == NULL){
			$this->index();			
		}else{
			$active = ($param2 == 0 ? 1 : 0 );
			$data = array(
					'FAQ_activated' => $active,
					'FAQ_update' => $this->config->item('now'),
					'FAQ_userupdate' => $this->session->userdata('session_login')
			);			
			$msg = $this->model_faq->update_ac($data,$param1);
			$result = $this->model_faq->get_for_update($param1);
			if($active == 1){
					$this->session->set_flashdata('success','การ เปิด/ปิด สถานะการใช้งานสำเร็จ');
			}else{
					$this->session->set_flashdata('success','การ เปิด/ปิด สถานะการใช้งานสำเร็จ');
			}
			redirect('backoffice/faq/index','location');
		}
		
	}
	
	public function delete($param1=NULL){
		$del_data = ($param1==NULL ? $this->input->post('chkbox') : $param1 );
		$result = $this->model_faq->get_for_update($param1);
		$this->model_faq->delete_ac($del_data);		
		if($param1 == NULL){
			$this->session->set_flashdata('success','การลบข้อมูลสำเร็จ');
		} else {
			$this->session->set_flashdata('success','การลบข้อมูลสำเร็จ');
		}
		redirect('backoffice/faq/index','location');
	} 
	
	public function order(){
		$this->form_validation->set_rules('order[]', 'Order', "trim|required|is_natural");
		
		if($this->form_validation->run($this) == TRUE){
					$arr = $this->input->post('keyed');
					foreach($this->input->post('order') as $key => $value){
						$data = array(
								"FAQ_order" => $value
						);
						$this->model_faq->update_ac($data,$arr[$key]);
					}	
					$this->session->set_flashdata('success','เรียงลำดับข้อมูลสำเร็จ');
					redirect('backoffice/faq/index','location');
		}else{
				$this->index();
		}
	}
}
?>