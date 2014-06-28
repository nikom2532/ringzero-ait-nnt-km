<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Coding by : Thanutchai Kaewmong */
class Category extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('backoffice/model_category');
		
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
			->set_view('menu','backoffice/include/menu', array('menu_main'=>3,'sub'=>1));
			
			if($this->session->userdata('session_login') == ""){
					$this->session->set_flashdata('error','กรุณากรอกข้อมูลผู้ใช้ใหม่');
					redirect('backoffice/login','location');
			}
			if(!in_array("Category",explode(",",$this->session->userdata('session_menu'))) && $this->session->userdata('session_menu') != "ALL"){
				    $this->session->set_flashdata('error','ไม่อนุญาตให้เข้าใช้งาน');
					redirect('backoffice/profile','location');
		    }
	}
	
	public function index(){
		if($this->session->userdata("search_category") != ""){
						$this->session->unset_userdata("search_category");
		}
		
		 $config["base_url"] = base_url()."backoffice/category/index";
		 $config['total_rows'] =  $this->model_category->get_ac();
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
		 
		 $data['rows'] = $this->model_category->get_ac($config['per_page'],$this->uri->segment(5));
		 
		 $data['pagination'] =  $this->pagination->create_links();

		 $this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcut')
		 ->set_view('search','backoffice/include/search')
		 ->build('backoffice/category/index',$data);
	}
	
	public function search(){
		if(isset($_POST['search']) && $_POST['search'] == ""){
				redirect('backoffice/category/index','location');	
		}
				 if($this->input->post("search") != ""){
						$txt = $this->input->post("search");
						$this->session->set_userdata("search_category",$txt);
				 }else{
						$txt  = $this->session->userdata("search_category");					 	
				 }
		 $config["base_url"] = base_url()."backoffice/category/search";
		 $config['total_rows'] =  $this->model_category->search_ac($txt);
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
		 
		 $data['rows'] = $this->model_category->search_ac($txt,$config['per_page'],$this->uri->segment(5));
		 
		 $data['pagination'] =  $this->pagination->create_links();
		 $this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcut')
		 ->set_view('search','backoffice/include/search')
		 ->build('backoffice/category/index',$data);
	}
	
	public function create($msg = NULL){	
		$data['messages'] = $msg;
		$this->template
		->set_view('shortcut','backoffice/include/shortcut')
		->set_view('notices','backoffice/include/notices',$data)
		->build('backoffice/category/form',$data);
	}
	
	public function save(){	
		$this->form_validation->set_rules('topic', 'หมวดหมู่บทความ', "trim|required");	
		$this->form_validation->set_rules('order', 'ลำดับข้อมูล', "trim|required|is_natural_no_zero");
		
		if($this->form_validation->run($this) == TRUE){
			$data = array(
					'CAT_topic' =>  $this->input->post('topic'),
					'CAT_activated' =>  $this->input->post('active'),
					'CAT_add' => $this->config->item('now'),
					'CAT_update' => $this->config->item('now'),
					'CAT_userupdate' => $this->session->userdata('session_login')	,
					'CAT_order' =>  $this->input->post('order'),						
			);
			
			$this->model_category->add_ac($data);
			$this->session->set_flashdata('success','เพิ่มข้อมูลสำเร็จ');
			redirect('backoffice/category/index','location');
		}else{
			$this->create();
		}
	}
	
	public function edit($param1){	
		$data["result"] = $this->model_category->get_for_update($param1);
		$this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcut')
		 ->build('backoffice/category/form',$data);
	}
	
	public function update(){
		$this->form_validation->set_rules('topic', 'หมวดหมู่บทความ', "trim|required");	
		$this->form_validation->set_rules('order', 'ลำดับข้อมูล', "trim|required|is_natural_no_zero");
		
		if($this->form_validation->run($this) == TRUE){
			$data = array(
					'CAT_topic' =>  $this->input->post('topic'),
					'CAT_activated' =>  $this->input->post('active'),
					'CAT_update' => $this->config->item('now'),
					'CAT_userupdate' => $this->session->userdata('session_login')	,
					'CAT_order' =>  $this->input->post('order'),				
			);
			
			$this->model_category->update_ac($data,$this->input->post('id'));
			$this->session->set_flashdata('success','แก้ไขสำเร็จ');
			redirect('backoffice/category/index','location');
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
					'CAT_activated' => $active,
					'CAT_update' => $this->config->item('now'),
					'CAT_userupdate' => $this->session->userdata('session_login')
			);			
			$msg = $this->model_category->update_ac($data,$param1);
			$result = $this->model_category->get_for_update($param1);
			if($active == 1){
					$this->session->set_flashdata('success','การ เปิด/ปิด สถานะการใช้งานสำเร็จ');
			}else{
					$this->session->set_flashdata('success','การ เปิด/ปิด สถานะการใช้งานสำเร็จ');
			}
			redirect('backoffice/category/index','location');
		}
		
	}
	
	public function delete($param1=NULL){
		$del_data = ($param1==NULL ? $this->input->post('chkbox') : $param1 );
		$result = $this->model_category->get_for_update($param1);
		$this->model_category->delete_ac($del_data);		
		if($param1 == NULL){
			$this->session->set_flashdata('success','การลบข้อมูลสำเร็จ');
		} else {
			$this->session->set_flashdata('success','การลบข้อมูลสำเร็จ');
		}
		redirect('backoffice/category/index','location');
	} 
	
	public function order(){
		$this->form_validation->set_rules('order[]', 'Order', "trim|required|is_natural");
		
		if($this->form_validation->run($this) == TRUE){
					$arr = $this->input->post('keyed');
					foreach($this->input->post('order') as $key => $value){
						$data = array(
								"CAT_order" => $value
						);
						$this->model_category->update_ac($data,$arr[$key]);
					}	
					$this->session->set_flashdata('success','เรียงลำดับข้อมูลสำเร็จ');
					redirect('backoffice/category/index','location');
		}else{
				$this->index();
		}
	}
}
?>