<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_center extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('backoffice/model_article_center');
		
		
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
		$this->session->unset_userdata("search_article_center");
		$this->session->unset_userdata("category_article_center");
		$this->session->unset_userdata("status_article_center");
		$this->session->unset_userdata("start_article_center");
		$this->session->unset_userdata("end_article_center");
		
		 $config["base_url"] = base_url()."backoffice/article_center/index";
		 $config['total_rows'] =  $this->model_article_center->get_ac();
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
		 
		 $data['rows'] = $this->model_article_center->get_ac(NULL,$config['per_page'],$this->uri->segment(5));
		 
		 $data['categorys']  = $this->model_article_center->get_category();
		 
		

		 $data['pagination'] =  $this->pagination->create_links();

		 $this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcutarticlecopy')
		 ->set_view('search','backoffice/include/searcharticle_center',$data)
		 ->build('backoffice/article_center/index',$data);
	}
	
	public function search(){
		if(isset($_POST['search']) && $_POST['search'] == "" && $_POST['category'] == "" && $_POST['start'] == "" && $_POST['end'] == "" ){
				redirect('backoffice/article_center/index','location');	
		}
				if(isset($_POST['search']) && $_POST['search'] == ""){
						$txt = $this->input->post("search");
						$this->session->set_userdata("search_article_center",$txt);
				}else if($this->input->post("search") != ""){
						$txt = $this->input->post("search");
						$this->session->set_userdata("search_article_center",$txt);
				 }else{
						$txt  = $this->session->userdata("search_article_center");					 	
				 }
				 
				if(isset($_POST['category']) && $_POST['category'] == ""){
						$category = $this->input->post("category");
						$this->session->set_userdata("category_article_center",$category);
				}else if($this->input->post("category") != ""){
						$category = $this->input->post("category");
						$this->session->set_userdata("category_article_center",$category);
				 }else{
						$category  = $this->session->userdata("category_article_center");					 	
				 }
				 
				 if(isset($_POST['start']) && $_POST['start'] == ""){
						$start = $this->input->post("start");
						$this->session->set_userdata("start_article_center",$start);
				}else if($this->input->post("start") != ""){
						$start = $this->input->post("start");
						$this->session->set_userdata("start_article_center",$start);
				 }else{
						$start  = $this->session->userdata("start_article_center");					 	
				 }
				 
				 if(isset($_POST['end']) && $_POST['end'] == ""){
						$end = $this->input->post("end");
						$this->session->set_userdata("end_article_center",$end);
				 }else if($this->input->post("end") != ""){
						$end = $this->input->post("end");
						$this->session->set_userdata("end_article_center",$end);
				 }else{
						$end  = $this->session->userdata("end_article_center");					 	
				 }
				 
				 
		 $config["base_url"] = base_url()."backoffice/article_center/search";
		 $config['total_rows'] =  $this->model_article_center->search_ac($txt,$start,$end,$category);
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
		 
		 $data['rows'] = $this->model_article_center->search_ac($txt,$start,$end,$category,$config['per_page'],$this->uri->segment(5));
		 

		 
		 $data['categorys']  = $this->model_article_center->get_category();
		 
		 $data['pagination'] =  $this->pagination->create_links();
		 $this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcutarticle')
		 ->set_view('search','backoffice/include/searcharticle_center',$data)
		 ->build('backoffice/article_center/index',$data);
	}
	
	
	
	
}
?>