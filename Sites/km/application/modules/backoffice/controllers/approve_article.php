<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Coding by : Thanutchai Kaewmong */
class Approve_article extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('backoffice/model_approve_article');
		$this->path_upload= FCPATH. 'uploads/approve_article/';
		
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
			->set_view('menu','backoffice/include/menu', array('menu_main'=>5,'sub'=>1));
			
			if($this->session->userdata('session_login') == ""){
					$this->session->set_flashdata('error','กรุณากรอกข้อมูลผู้ใช้ใหม่');
					redirect('backoffice/login','location');
			}
			if(!in_array("Approve_article",explode(",",$this->session->userdata('session_menu'))) && $this->session->userdata('session_menu') != "ALL"){
				    $this->session->set_flashdata('error','ไม่อนุญาตให้เข้าใช้งาน');
					redirect('backoffice/profile','location');
		    }
	}
	
	public function index(){
		$this->session->unset_userdata("search_approve_article");
		$this->session->unset_userdata("category_approve_article");
		$this->session->unset_userdata("status_approve_article");
		$this->session->unset_userdata("start_approve_article");
		$this->session->unset_userdata("end_approve_article");
		
		 $config["base_url"] = base_url()."backoffice/approve_article/index";
		 $config['total_rows'] =  $this->model_approve_article->get_ac();
		 $config['per_page'] = '20'; 
		 $config['num_links'] = '5'; 
		 $config['uri_segment'] = 5;
		 $config['full_tag_open'] = '<div class="pagination">';
		 $config['full_tag_close'] = '</div>';
		 $config['first_link'] = '« First';
		 $config['last_link'] = 'Last »';
	 	 $config['next_link'] = '&gt;';
		 $config['prev_link'] = '&lt;';
		 
		 $this->pagination->initialize($config); 
		 
		 $data['rows'] = $this->model_approve_article->get_ac($config['per_page'],$this->uri->segment(5));
		 
		 $categorys = $this->model_approve_article->get_category();
		 $options = array('' => '-- หมวดหมู่บทความ --');
		 foreach($categorys as $value) {
			$options[$value->CAT_id] = $value->CAT_topic;
		 }
		 $data['categorys'] = $options;
		 
		 $option2 = array(
		 	'' => '-- สถานะการเผยแพร่ --',
		 	'0รอการตรวจสอบ' => 'รอการตรวจสอบ',			
			'2ไม่ผ่านการตรวจสอบ' => 'ไม่ผ่านการตรวจสอบ',
			'1อนุญาตให้เผยแพร่' => 'อนุญาตให้เผยแพร่',
		 );
		 $data['status'] = $option2;
		 
		 $option3 = array(
		 	'0' => 'รอการตรวจสอบ',			
			'2' => 'ไม่ผ่านการตรวจสอบ',
			'1' => 'อนุญาตให้เผยแพร่',
		 );
		 $data['status2'] = $option3;

		 $data['pagination'] =  $this->pagination->create_links();

		 $this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcutapprove')
		 ->set_view('search','backoffice/include/searcharticle',$data)
		 ->build('backoffice/approve_article/index',$data);
	}
	
	public function search(){
		if(isset($_POST['search']) && $_POST['search'] == "" && $_POST['category'] == "" && $_POST['status'] == "" && $_POST['start'] == "" && $_POST['end'] == "" ){
				redirect('backoffice/approve_article/index','location');	
		}
				if(isset($_POST['search']) && $_POST['search'] == ""){
						$txt = $this->input->post("search");
						$this->session->set_userdata("search_approve_article",$txt);
				}else if($this->input->post("search") != ""){
						$txt = $this->input->post("search");
						$this->session->set_userdata("search_approve_article",$txt);
				 }else{
						$txt  = $this->session->userdata("search_approve_article");					 	
				 }
				 
				if(isset($_POST['category']) && $_POST['category'] == ""){
						$category = $this->input->post("category");
						$this->session->set_userdata("category_approve_article",$category);
				}else if($this->input->post("category") != ""){
						$category = $this->input->post("category");
						$this->session->set_userdata("category_approve_article",$category);
				 }else{
						$category  = $this->session->userdata("category_approve_article");					 	
				 }
				 
				if(isset($_POST['status']) && $_POST['status'] == ""){
						$status = $this->input->post("status");
						$this->session->set_userdata("status_approve_article",$status);
				}else if($this->input->post("status") != ""){
						$status = $this->input->post("status");
						$this->session->set_userdata("status_approve_article",$status);
				 }else{
						$status  = $this->session->userdata("status_approve_article");					 	
				 }
				 
				 if(isset($_POST['start']) && $_POST['start'] == ""){
						$start = $this->input->post("start");
						$this->session->set_userdata("start_approve_article",$start);
				}else if($this->input->post("start") != ""){
						$start = $this->input->post("start");
						$this->session->set_userdata("start_approve_article",$start);
				 }else{
						$start  = $this->session->userdata("start_approve_article");					 	
				 }
				 
				 if(isset($_POST['end']) && $_POST['end'] == ""){
						$end = $this->input->post("end");
						$this->session->set_userdata("end_approve_article",$end);
				 }else if($this->input->post("end") != ""){
						$end = $this->input->post("end");
						$this->session->set_userdata("end_approve_article",$end);
				 }else{
						$end  = $this->session->userdata("end_approve_article");					 	
				 }
				 
				 
		 $config["base_url"] = base_url()."backoffice/approve_article/search";
		 $config['total_rows'] =  $this->model_approve_article->search_ac($txt,$category,$status,$start,$end);
		 $config['per_page'] = '20'; 
		 $config['num_links'] = '5'; 
		 $config['uri_segment'] = 5;
		 $config['full_tag_open'] = '<div class="pagination">';
		 $config['full_tag_close'] = '</div>';
		 $config['first_link'] = '« First';
		 $config['last_link'] = 'Last »';
	 	 $config['next_link'] = '&gt;';
		 $config['prev_link'] = '&lt;';
		 
		 $this->pagination->initialize($config); 
		 
		 $data['rows'] = $this->model_approve_article->search_ac($txt,$category,$status,$start,$end,$config['per_page'],$this->uri->segment(5));
		 
		 $categorys = $this->model_approve_article->get_category();
		 $options = array('' => '-- หมวดหมู่บทความ --');
		 foreach($categorys as $value) {
			$options[$value->CAT_id] = $value->CAT_topic;
		 }
		 $data['categorys'] = $options;
		 
		 $option2 = array(
		 	'' => '-- สถานะการเผยแพร่ --',
		 	'0รอการตรวจสอบ' => 'รอการตรวจสอบ',			
			'2ไม่ผ่านการตรวจสอบ' => 'ไม่ผ่านการตรวจสอบ',
			'1อนุญาตให้เผยแพร่' => 'อนุญาตให้เผยแพร่',
		 );
		 $data['status'] = $option2;
		 
		 $option3 = array(
		 	'0' => 'รอการตรวจสอบ',			
			'2' => 'ไม่ผ่านการตรวจสอบ',
			'1' => 'อนุญาตให้เผยแพร่',
		 );
		 $data['status2'] = $option3;
		 
		 $data['pagination'] =  $this->pagination->create_links();
		 $this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcutapprove')
		 ->set_view('search','backoffice/include/searcharticle',$data)
		 ->build('backoffice/approve_article/index',$data);
	}
	
	public function edit($param1){	
		$data["result"] = $this->model_approve_article->get_for_update($param1);
	   // var_dump($data["result"]); exit;
		$categorys = $this->model_approve_article->get_category();
		
		$options = array('' => '--- กรุณาเลือกหมวดหมู่บทความ ---');
		foreach($categorys as $value) {
			$options[$value->CAT_id] = $value->CAT_topic;
		}
	
		$data['categorys'] = $options;
		
		$option2 = array(
		 	'' => '-- สถานะการเผยแพร่ --',
		 	'0รอการตรวจสอบ' => 'รอการตรวจสอบ',			
			'2ไม่ผ่านการตรวจสอบ' => 'ไม่ผ่านการตรวจสอบ',
			'1อนุญาตให้เผยแพร่' => 'อนุญาตให้เผยแพร่',
		 );
		 $data['status'] = $option2;
		
		$this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcutapprove')
		 ->build('backoffice/approve_article/read',$data);
	}
	
	public function update(){
		$this->form_validation->set_rules('ATC_status', 'สถานะการเผยแพร่', "trim|required");
		$this->form_validation->set_rules('ATC_quality', 'คุณภาพ', "trim|required");		
		$this->form_validation->set_rules('ATC_reason', 'หมายเหตุ', "trim|required");		
		
		if($this->form_validation->run($this) == TRUE){
			$data = array(
					'ATC_status' =>  $this->input->post('ATC_status'),
					'ATC_activated' =>  $this->input->post('active'),
					'ATC_update' => $this->config->item('now'),
					'ATC_quality' => $this->input->post('ATC_quality'),
					'ATC_reason' => htmlencode($this->input->post('ATC_reason')),
					'ATC_userupdate' => $this->session->userdata('session_login'),
					'ATC_approve_by' => $this->session->userdata('session_login')
			);
			
			$this->model_approve_article->update_ac($data,$this->input->post('id'));
			$this->session->set_flashdata('success','แก้ไขสำเร็จ');
			redirect('backoffice/approve_article/index','location');
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
					'ATC_activated' => $active,
					'ATC_update' => $this->config->item('now'),
					'ATC_userupdate' => $this->session->userdata('session_login')
			);			
			$msg = $this->model_approve_article->update_ac($data,$param1);
			$result = $this->model_approve_article->get_for_update($param1);
			if($active == 1){
					$this->session->set_flashdata('success','การ เปิด/ปิด สถานะการใช้งานสำเร็จ');
			}else{
					$this->session->set_flashdata('success','การ เปิด/ปิด สถานะการใช้งานสำเร็จ');
			}
			redirect('backoffice/approve_article/index','location');
		}
		
	}
	
	public function change_status($param1=NULL,$param2=NULL,$param3=NULL){
		if($param1 == NULL && $param2 == NULL){
			$this->index();			
		}else{
			if($param2 == 0){
				$active = "0รอการตรวจสอบ";
			}else if($param2 == 2){
				$active = "2ไม่ผ่านการตรวจสอบ";	
			}else{
				$active = "1อนุญาตให้เผยแพร่";	
			}
			$data = array(
					'ATC_status' => $active,
					'ATC_update' => $this->config->item('now'),
					'ATC_approve_by' => $this->session->userdata('session_login') 
			);			
			$msg = $this->model_approve_article->update_ac($data,$param1);
			$result = $this->model_approve_article->get_for_update($param1);
			$this->session->set_flashdata('success','การเปลี่ยนสถานะการเผยแพร่สำเร็จ');
			redirect(str_replace(base_url().$this->uri->segment(1)."/","",str_replace("-","/",$param3)),'location');
		}
		
	}
	
}
?>