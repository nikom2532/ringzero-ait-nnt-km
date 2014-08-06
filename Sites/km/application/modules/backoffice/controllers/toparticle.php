<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Coding by : Thanutchai Kaewmong */
class Toparticle extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('backoffice/model_toparticle');
		$this->path_upload= FCPATH. 'uploads/toparticle/';
		
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
			->set_view('menu','backoffice/include/menu', array('menu_main'=>7,'sub'=>1));
			
			if($this->session->userdata('session_login') == ""){
					$this->session->set_flashdata('error','กรุณากรอกข้อมูลผู้ใช้ใหม่');
					redirect('backoffice/login','location');
			}
			if(!in_array("Toparticle",explode(",",$this->session->userdata('session_menu'))) && $this->session->userdata('session_menu') != "ALL"){
				    $this->session->set_flashdata('error','ไม่อนุญาตให้เข้าใช้งาน');
					redirect('backoffice/profile','location');
		    }
	}
	
	public function index(){
		$this->session->unset_userdata("year_toparticle");
		$this->session->unset_userdata("month_toparticle");
		$this->session->set_userdata("year_toparticle",(string)date("Y"));
		$this->session->set_userdata("month_toparticle",(string)date("m"));		
		
		 $data['rows'] = $this->model_toparticle->get_ac();
		 
		 $years = $this->model_toparticle->get_year();
		 $options = array('' => '-- ปี --');
		 foreach($years as $value) {
			$options[$value->AM_year] = $value->AM_year;
		 }
		 $data['years'] = $options;
		 
		 $option2 = array(
		 	'' => '-- เดือน --',
		 	'01' => 'มกราคม',			
			'02' => 'กุมภาพันธ์',
			'03' => 'มีนาคม',
			'04' => 'เมษายน',
			'05' => 'พฤษภาคม',
			'06' => 'มิถุนายน',
			'07' => 'กรกฎาคม',
			'08' => 'สิงหาคม',
			'09' => 'กันยายน',
			'10' => 'ตุลาคม',
			'11' => 'พฤศจิกายน',
			'12' => 'ธันวาคม',
		 );
		 $data['months'] = $option2;
		
		// var_dump($data); exit;
		
		 $this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcutapprove')
		 ->set_view('search','backoffice/include/search_toparticle',$data)
		 ->build('backoffice/toparticle/index',$data);
	}
	
	public function search(){
		if(isset($_POST['year_toparticle']) && $_POST['year_toparticle'] == "" && $_POST['month_toparticle'] == "" ){
				redirect('backoffice/toparticle/index','location');	
		}
				if(isset($_POST['year_toparticle']) && $_POST['year_toparticle'] == ""){
						$year_toparticle = $this->input->post("year_toparticle");
						$this->session->set_userdata("year_toparticle",$year_toparticle);
				}else if($this->input->post("year_toparticlearch") != ""){
						$year_toparticle = $this->input->post("year_toparticle");
						$this->session->set_userdata("year_toparticle",$year_toparticle);
				 }else{
						$year_toparticle  = $this->session->userdata("year_toparticle");					 	
				 }
				 
				if(isset($_POST['month_toparticle']) && $_POST['month_toparticle'] == ""){
						$month_toparticle = $this->input->post("month_toparticle");
						$this->session->set_userdata("month_toparticle",$month_toparticle);
				}else if($this->input->post("month_toparticle") != ""){
						$month_toparticle = $this->input->post("month_toparticle");
						$this->session->set_userdata("month_toparticle",$month_toparticle);
				 }else{
						$month_toparticle  = $this->session->userdata("month_toparticle");					 	
				 }
				 
		 $data['rows'] = $this->model_toparticle->search_ac($year_toparticle,$month_toparticle);
		 
		 $years = $this->model_toparticle->get_year();
		 $options = array('' => '-- ปี --');
		 foreach($years as $value) {
			$options[$value->AM_year] = $value->AM_year;
		 }
		 $data['years'] = $options;
		 
		 $option2 = array(
		 	'' => '-- เดือน --',
		 	'01' => 'มกราคม',			
			'02' => 'กุมภาพันธ์',
			'03' => 'มีนาคม',
			'04' => 'เมษายน',
			'05' => 'พฤษภาคม',
			'06' => 'มิถุนายน',
			'07' => 'กรกฎาคม',
			'08' => 'สิงหาคม',
			'09' => 'กันยายน',
			'10' => 'ตุลาคม',
			'11' => 'พฤศจิกายน',
			'12' => 'ธันวาคม',
		 );
		 $data['months'] = $option2;
		
		 $this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcutapprove')
		 ->set_view('search','backoffice/include/search_toparticle',$data)
		 ->build('backoffice/toparticle/index',$data);
	}
	
	public function edit($param1){	
		$data["result"] = $this->model_toparticle->get_for_update($param1);
	  
		$this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcutapprove')
		 ->build('backoffice/toparticle/read',$data);
	}
	
	public function update(){
		$this->form_validation->set_rules('ATC_comment', 'แนะนำบทความ', "trim|required");
		
		if($this->form_validation->run($this) == TRUE){
			$data = array(
					'ATC_comment' =>  htmlencode($this->input->post('ATC_comment')),
					'ATC_update' => $this->config->item('now'),
					'ATC_userupdate' => $this->session->userdata('session_login')
			);
			
			$this->model_toparticle->update_ac($data,$this->input->post('id'));
			$this->session->set_flashdata('success','แก้ไขสำเร็จ');
			redirect('backoffice/toparticle/index','location');
		}else{
			$this->edit($this->input->post('id'));
		}
	}
	
}
?>