<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Coding by : Thanutchai Kaewmong */
class Article extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('backoffice/model_article');
		$this->path_upload= FCPATH. 'uploads/article/';
		
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
			->set_view('menu','backoffice/include/menu', array('menu_main'=>4,'sub'=>1));
			
			if($this->session->userdata('session_login') == ""){
					$this->session->set_flashdata('error','กรุณากรอกข้อมูลผู้ใช้ใหม่');
					redirect('backoffice/login','location');
			}
			if(!in_array("Article",explode(",",$this->session->userdata('session_menu'))) && $this->session->userdata('session_menu') != "ALL"){
				    $this->session->set_flashdata('error','ไม่อนุญาตให้เข้าใช้งาน');
					redirect('backoffice/profile','location');
		    }
	}
	
	public function index(){
		$this->session->unset_userdata("search_article");
		$this->session->unset_userdata("category_article");
		$this->session->unset_userdata("status_article");
		$this->session->unset_userdata("start_article");
		$this->session->unset_userdata("end_article");
		
		 $config["base_url"] = base_url()."backoffice/article/index";
		 $config['total_rows'] =  $this->model_article->get_ac();
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
		 
		 $data['rows'] = $this->model_article->get_ac($config['per_page'],$this->uri->segment(5));
		 
		 $categorys = $this->model_article->get_category();
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
		 $data['pagination'] =  $this->pagination->create_links();

		 $this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcutarticle')
		 ->set_view('search','backoffice/include/searcharticle',$data)
		 ->build('backoffice/article/index',$data);
	}
	
	public function search(){
		if(isset($_POST['search']) && $_POST['search'] == "" && $_POST['category'] == "" && $_POST['status'] == "" && $_POST['start'] == "" && $_POST['end'] == "" ){
				redirect('backoffice/article/index','location');	
		}
				if(isset($_POST['search']) && $_POST['search'] == ""){
						$txt = $this->input->post("search");
						$this->session->set_userdata("search_article",$txt);
				}else if($this->input->post("search") != ""){
						$txt = $this->input->post("search");
						$this->session->set_userdata("search_article",$txt);
				 }else{
						$txt  = $this->session->userdata("search_article");					 	
				 }
				 
				if(isset($_POST['category']) && $_POST['category'] == ""){
						$category = $this->input->post("category");
						$this->session->set_userdata("category_article",$category);
				}else if($this->input->post("category") != ""){
						$category = $this->input->post("category");
						$this->session->set_userdata("category_article",$category);
				 }else{
						$category  = $this->session->userdata("category_article");					 	
				 }
				 
				if(isset($_POST['status']) && $_POST['status'] == ""){
						$status = $this->input->post("status");
						$this->session->set_userdata("status_article",$status);
				}else if($this->input->post("status") != ""){
						$status = $this->input->post("status");
						$this->session->set_userdata("status_article",$status);
				 }else{
						$status  = $this->session->userdata("status_article");					 	
				 }
				 
				 if(isset($_POST['start']) && $_POST['start'] == ""){
						$start = $this->input->post("start");
						$this->session->set_userdata("start_article",$start);
				}else if($this->input->post("start") != ""){
						$start = $this->input->post("start");
						$this->session->set_userdata("start_article",$start);
				 }else{
						$start  = $this->session->userdata("start_article");					 	
				 }
				 
				 if(isset($_POST['end']) && $_POST['end'] == ""){
						$end = $this->input->post("end");
						$this->session->set_userdata("end_article",$end);
				 }else if($this->input->post("end") != ""){
						$end = $this->input->post("end");
						$this->session->set_userdata("end_article",$end);
				 }else{
						$end  = $this->session->userdata("end_article");					 	
				 }
				 
				 
		 $config["base_url"] = base_url()."backoffice/article/search";
		 $config['total_rows'] =  $this->model_article->search_ac($txt,$category,$status,$start,$end);
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
		 
		 $data['rows'] = $this->model_article->search_ac($txt,$category,$status,$start,$end,$config['per_page'],$this->uri->segment(5));
		 
		 $categorys = $this->model_article->get_category();
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
		 
		 $data['pagination'] =  $this->pagination->create_links();
		 $this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcutarticle')
		 ->set_view('search','backoffice/include/searcharticle',$data)
		 ->build('backoffice/article/index',$data);
	}
	
	public function create($msg = NULL,$param2=NULL){
		//echo $param2;	
		if($msg!="ref")
			$data['messages'] = $msg;
		if($param2!=""){
				$data["ref"] = $this->model_article->get_id($param2);
		}
		$categorys = $this->model_article->get_category();
		$options = array('' => '--- กรุณาเลือกหมวดหมู่บทความ ---');
		foreach($categorys as $value) {
			$options[$value->CAT_id] = $value->CAT_topic;
		}
	
		$data['categorys'] = $options;
		//print_r($data["ref"]);
		$this->template
		->set_view('shortcut','backoffice/include/shortcutarticle')
		->set_view('notices','backoffice/include/notices',$data)
		->build('backoffice/article/form',$data);
	}
	
	public function save(){	
		$this->form_validation->set_rules('ATC_category_ref', 'หมวดหมู่บทความ', "trim|required");
		$this->form_validation->set_rules('ATC_quality', 'คุณภาพ', "trim|required");		
		$this->form_validation->set_rules('ATC_date', 'วันที่', "trim|required");	
		$this->form_validation->set_rules('ATC_title', 'หัวข้อบทความ', "trim|required");	
		$this->form_validation->set_rules('ATC_short_desc', 'เกริ่นนำบทความ', "trim|required");	
		$this->form_validation->set_rules('ATC_desc', 'บทความ', "trim|required");	
		$this->form_validation->set_rules('ATC_tag', 'Tags', "trim");	
		
		if($this->form_validation->run($this) == TRUE){
			$data = array(
					'ATC_category_ref' =>  $this->input->post('ATC_category_ref'),
					'ATC_writer_key' =>  $this->input->post('ATC_writer_key'),
					'ATC_writer' =>  $this->session->userdata('session_login'),
					'ATC_date' =>  $this->input->post('ATC_date'),
					'ATC_writer_ref' =>  $this->input->post('ATC_writer_ref'),
					'ATC_news_ref' =>  $this->input->post('ATC_news_ref'),
					'ATC_date' =>  $this->input->post('ATC_date'),
					'ATC_title' =>  $this->input->post('ATC_title'),
					'ATC_short_desc' =>  htmlencode($this->input->post('ATC_short_desc',FALSE)),
					'ATC_desc' =>  htmlencode($this->input->post('ATC_desc',FALSE)),
					'ATC_tag' =>  htmlencode($this->input->post('ATC_tag',FALSE)),
					'ATC_status' =>  $this->input->post('ATC_status'),
					'ATC_activated' =>  $this->input->post('active'),
					'ATC_add' => $this->config->item('now'),
					'ATC_update' => $this->config->item('now'),
					'ATC_quality' => $this->input->post('ATC_quality')	,
					'ATC_viewall' => 0,
					'ATC_suggest' => 0,
					'ATC_userupdate' => $this->session->userdata('session_login')
			);
			////////////////////////////////////ATC_image/////////////////////////////////////////////
				$config_ATC_imgdetail2['upload_path'] = $this->path_upload.'/file';
				$config_ATC_imgdetail2['allowed_types'] = 'pdf';
				$config_ATC_imgdetail2['max_size'] = '2000';
				$config_ATC_imgdetail2['encrypt_name'] = TRUE;
				
				$this->upload->initialize($config_ATC_imgdetail2);
				
				if ($this->upload->do_upload('ATC_file')){
						$image_data = $this->upload->data();
						$data['ATC_file'] = $image_data['file_name'];
				}
				////////////////////////////////////ATC_image/////////////////////////////////////////////
				$config_ATC_imgdetail3['upload_path'] = $this->path_upload.'/video';
				$config_ATC_imgdetail3['allowed_types'] = 'mp4|flv';
				$config_ATC_imgdetail3['max_size'] = '32000';
				$config_ATC_imgdetail3['encrypt_name'] = TRUE;
				
				$this->upload->initialize($config_ATC_imgdetail3);
				
				if ($this->upload->do_upload('ATC_video')){
						$image_data = $this->upload->data();
						$data['ATC_video'] = $image_data['file_name'];
				}
			////////////////////////////////////ATC_image/////////////////////////////////////////////
				$config_ATC_imgdetail['upload_path'] = $this->path_upload.'/image';
				$config_ATC_imgdetail['allowed_types'] = 'gif|jpg|png';
				$config_ATC_imgdetail['max_size'] = '2000';
				$config_ATC_imgdetail['encrypt_name'] = TRUE;
				
				$this->upload->initialize($config_ATC_imgdetail);
				
				if ($this->upload->do_upload('ATC_image')){
						$image_data = $this->upload->data();
						
								$config_img = array(
									'source_image' => $image_data['full_path'],
									'width' => 309,
									'height' => 179,
									'quality' => 100
								);
								
						$data['ATC_image'] = $image_data['file_name'];
						$this->model_article->add_ac($data);
						$this->session->set_flashdata('success','เพิ่มข้อมูลสำเร็จ');
						redirect('backoffice/article/index','location');
				}else{
					$msg = $this->upload->display_errors('<div class="notification error png_bg"><a href="#" class="close">
					<img src="'.site_url('asset/backoffice/images/icons/cross_grey_small.png').'" title="Close this notification" alt="close" /></a><div>',
					'</div></div>');
					$this->create($msg,$this->input->post('ATC_news_ref'));
				}
			////////////////////////////////////ATC_image/////////////////////////////////////////////
		}else{
			$this->create();
		}
	}
	
	public function edit($param1){	
		$data["result"] = $this->model_article->get_for_update($param1);
		
		if(@$data["result"]->ATC_id == NULL){
			redirect('backoffice/article/index','location');
		}			
	   // var_dump($data["result"]); exit;
		$categorys = $this->model_article->get_category();
		$options = array('' => '--- กรุณาเลือกหมวดหมู่บทความ ---');
		foreach($categorys as $value) {
			$options[$value->CAT_id] = $value->CAT_topic;
		}
	
		$data['categorys'] = $options;
		
		$this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcutarticle')
		 ->build('backoffice/article/form',$data);
	}
	
	public function update(){
		$this->form_validation->set_rules('ATC_category_ref', 'หมวดหมู่บทความ', "trim|required");
		$this->form_validation->set_rules('ATC_quality', 'คุณภาพ', "trim|required");		
		$this->form_validation->set_rules('ATC_date', 'วันที่', "trim|required");	
		$this->form_validation->set_rules('ATC_title', 'หัวข้อบทความ', "trim|required");	
		$this->form_validation->set_rules('ATC_short_desc', 'เกริ่นนำบทความ', "trim|required");	
		$this->form_validation->set_rules('ATC_desc', 'บทความ', "trim|required");	
		$this->form_validation->set_rules('ATC_tag', 'Tags', "trim");	
		
		if($this->form_validation->run($this) == TRUE){
			$data = array(
					'ATC_category_ref' =>  $this->input->post('ATC_category_ref'),
					'ATC_date' =>  $this->input->post('ATC_date'),
					'ATC_title' =>  $this->input->post('ATC_title'),
					'ATC_short_desc' =>  htmlencode($this->input->post('ATC_short_desc',FALSE)),
					'ATC_desc' =>  htmlencode($this->input->post('ATC_desc',FALSE)),
					'ATC_tag' =>  htmlencode($this->input->post('ATC_tag',FALSE)),
					'ATC_status' =>  $this->input->post('ATC_status'),
					'ATC_activated' =>  $this->input->post('active'),
					'ATC_update' => $this->config->item('now'),
					'ATC_quality' => $this->input->post('ATC_quality'),
					'ATC_userupdate' => $this->session->userdata('session_login')
			);
			
			////////////////////////////////////ATC_image/////////////////////////////////////////////
				$config_ATC_imgdetail['upload_path'] = $this->path_upload.'/image';
				$config_ATC_imgdetail['allowed_types'] = 'gif|jpg|png';
				$config_ATC_imgdetail['max_size'] = '2000';
				$config_ATC_imgdetail['encrypt_name'] = TRUE;
				
				$this->upload->initialize($config_ATC_imgdetail);
				
				if ($this->upload->do_upload('ATC_image')){
						$image_data = $this->upload->data();
						
								$config_img = array(
									'source_image' => $image_data['full_path'],
									'width' => 309,
									'height' => 179,
									'quality' => 100
								);
								
						$data['ATC_image'] = $image_data['file_name'];
						$this->unlink_pic($this->input->post('old_pic'));
				}
				////////////////////////////////////ATC_image/////////////////////////////////////////////
				$config_ATC_imgdetail2['upload_path'] = $this->path_upload.'/file';
				$config_ATC_imgdetail2['allowed_types'] = 'pdf';
				$config_ATC_imgdetail2['max_size'] = '2000';
				$config_ATC_imgdetail2['encrypt_name'] = TRUE;
				
				$this->upload->initialize($config_ATC_imgdetail2);
				
				if ($this->upload->do_upload('ATC_file')){
						$image_data = $this->upload->data();
						$data['ATC_file'] = $image_data['file_name'];
				}
				////////////////////////////////////ATC_image/////////////////////////////////////////////
				$config_ATC_imgdetail3['upload_path'] = $this->path_upload.'/video';
				$config_ATC_imgdetail3['allowed_types'] = 'mp4|flv';
				$config_ATC_imgdetail3['max_size'] = '32000';
				$config_ATC_imgdetail3['encrypt_name'] = TRUE;
				
				$this->upload->initialize($config_ATC_imgdetail3);
				
				if ($this->upload->do_upload('ATC_video')){
						$image_data = $this->upload->data();
						$data['ATC_video'] = $image_data['file_name'];
				}
			
			$this->model_article->update_ac($data,$this->input->post('id'));
			$this->session->set_flashdata('success','แก้ไขสำเร็จ');
			redirect('backoffice/article/index','location');
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
			$msg = $this->model_article->update_ac($data,$param1);
			$result = $this->model_article->get_for_update($param1);
			if($active == 1){
					$this->session->set_flashdata('success','การ เปิด/ปิด สถานะการใช้งานสำเร็จ');
			}else{
					$this->session->set_flashdata('success','การ เปิด/ปิด สถานะการใช้งานสำเร็จ');
			}
			redirect('backoffice/article/index','location');
		}
		
	}
	
	public function delete($param1=NULL){
		if($param1==NULL){
			$this->form_validation->set_rules('chkbox[]', 'Check Box', "trim|required");		
				if($this->form_validation->run($this) == TRUE){
					$del_data = $this->input->post('chkbox');
					 foreach($this->input->post('chkbox') as $id_pic){
							$row = $this->model_article->get_for_update($id_pic);
							$this->unlink_pic($row->ATC_image);
					 }
					 $this->model_article->delete_ac($del_data);
			 		 $this->session->set_flashdata('success','การลบข้อมูลสำเร็จ');
			 		 redirect('backoffice/article/index','location');
				}else{
					$this->session->set_flashdata('success','การลบข้อมูลสำเร็จ');
					redirect('backoffice/article/index','location');
				}
		}else{
			 $del_data = $param1;
			 $row = $this->model_article->get_for_update($del_data);
			 $this->unlink_pic($row->ATC_image);
			 $this->model_topic->delete_ac($del_data);
			 $this->session->set_flashdata('success','การลบข้อมูลสำเร็จ');
			 redirect('backoffice/article/index','location');
		}
	} 
	
	public function unlink_pic($pic){
		unlink($this->path_upload.'image/'.$pic);
	}
	
	
}
?>