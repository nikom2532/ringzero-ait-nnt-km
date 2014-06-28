<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Coding by : alongkorn@codeworks.co.th */
class Article extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('site/model_article');
		$this->load->model('backoffice/model_toparticle');
		$this->template->set_layout('site/layout/template')
			->js('asset/site/js/jquery.min.js');
			$this->template->set_layout('site/layout/template')	
			->set_view('footer','site/include/footer')
			->set_view('some_script','site/include/some_script')
			->set_view('header','site/include/header', array('menu_main'=>3)); 
	}
	public function rss(){
		
		$data['rows'] = $this->model_article->get_rssac();
		$data['topicrss'] = "บทความ";
		 $this->load->view('site/rss/article',$data);
	}
	public function rsshot(){
		
		$data['rows'] = $this->model_article->get_rssachot();
		$data['topicrss'] = "บทความ";
		 $this->load->view('site/rss/article',$data);
	}
	
	public function rss_catalog($param1=NULL){
		
		$data['rows'] = $this->model_article->get_rssac($param1);
		$categorys  = $this->model_article->get_categoryid($param1);
		$data['topicrss'] = "บทความ : ".$categorys[0]->C_topic;
		 $this->load->view('site/rss/article',$data);
	}
	public function index(){
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
		 $this->session->unset_userdata("year_top");
		$this->session->unset_userdata("month_top");
		$this->session->unset_userdata("search_article");
		$this->session->unset_userdata("search_catagory");
		$this->session->unset_userdata("start_approve_article");
		$this->session->unset_userdata("end_approve_article");
		
		$config["base_url"] = base_url()."site/article/index";
		 $config['total_rows'] =  $this->model_article->get_ac();
		 $config['per_page'] = '20'; 
		 $config['num_links'] = '5'; 
		 $config['uri_segment'] = 5;
		 $config['full_tag_open'] = '<ul class="paginations">';
		 $config['full_tag_close'] = '</ul>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		 $config['first_link'] = '« First';
		 $config['last_link'] = 'Last »';
	 	 $config['next_link'] = '&gt;';
		 $config['prev_link'] = '&lt;';
		 
		 $this->pagination->initialize($config); 
		 
		 $data['rows'] = $this->model_article->get_ac(NULL,$config['per_page'],$this->uri->segment(5));
		 
		 $data['categorys']  = $this->model_article->get_category();
		$data['pagination'] =  $this->pagination->create_links();
		$data['totalrow'] = $config['total_rows'];
		$this->template->build('site/article/article',$data);
	}
	public function toparticle(){
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
		
		$this->session->unset_userdata("search_article");
		$this->session->unset_userdata("search_catagory");
		$this->session->unset_userdata("start_approve_article");
		$this->session->unset_userdata("end_approve_article");
		
		if(isset($_POST['year_toparticle']) && $_POST['year_toparticle'] == "" && $_POST['month_toparticle'] == "" ){
				redirect('site/article/index','location');	
		}
				if(isset($_POST['year_toparticle']) && $_POST['year_toparticle'] == ""){
						$year_toparticle = $this->input->post("year_toparticle");
						$this->session->set_userdata("year_top",$year_toparticle);
				}else if($this->input->post("year_toparticle") != ""){
						$year_toparticle = $this->input->post("year_toparticle");
						$this->session->set_userdata("year_top",$year_toparticle);
				 }else{
						$year_toparticle  = $this->session->userdata("year_top");					 	
				 }
				 
				if(isset($_POST['month_toparticle']) && $_POST['month_toparticle'] == ""){
						$month_toparticle = $this->input->post("month_toparticle");
						$this->session->set_userdata("month_top",$month_toparticle);
				}else if($this->input->post("month_toparticle") != ""){
						$month_toparticle = $this->input->post("month_toparticle");
						$this->session->set_userdata("month_top",$month_toparticle);
				 }else{
						$month_toparticle  = $this->session->userdata("month_top");					 	
				 }
				 
		 $data['rows'] = $this->model_article->get_topmonth($year_toparticle,$month_toparticle);
		 
		 $data['categorys']  = $this->model_article->get_category();
		
		$this->template->build('site/article/article',$data);
	}
	public function detail($param1=NULL){
		
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
		$rows =  $this->model_article->get_id($param1);
		$data['resent'] = $this->model_article->get_resent($param1,$rows[0]->ATC_category_ref);
		$data['categorys']  = $this->model_article->get_category();
		$data['rows'] =  $this->model_article->get_id($param1);
		$postyear = date("Y");
		$postmonth = date("m");
		$dataval = $this->model_article->get_id($param1);
		$dataview = ($dataval[0]->ATC_viewall)+1;
		$datamonth =0 ;
		$datamonth = $this->model_article->get_chkmonth($postyear,$postmonth,$param1);
		//echo print_r($datamonth);
		if(empty($datamonth)){
			$data = array(
					'AM_atc_ref' =>  $param1,
					'AM_year' =>  $postyear,
					'AM_month' =>  $postmonth,
					'AM_view' =>  $dataview	
			);
			
			$this->model_article->add_ac($data);
		}
		$data_update = array('ATC_viewall' =>  $dataview);
		$this->model_article->update_ac($data_update,$param1);
		$this->template->build('site/article/article-detail',$data);
	}
	public function category($param1=NULL){
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
		$this->session->unset_userdata("search_article");
		if($param1 != ""){
				$txt = $param1;
				$this->session->set_userdata("search_catagory",$txt);
		}else{
			$txt  = $this->session->userdata("search_catagory");
		}
		$this->session->unset_userdata("year_top");
		$this->session->unset_userdata("month_top");
		$config["base_url"] = base_url()."site/article/category/".$txt;
		 $config['total_rows'] =  $this->model_article->get_ac($txt);
		 $config['per_page'] = '20'; 
		 $config['num_links'] = '5'; 
		 $config['uri_segment'] = 6;
		$config['full_tag_open'] = '<ul class="paginations">';
		 $config['full_tag_close'] = '</ul>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		 $config['first_link'] = '« First';
		 $config['last_link'] = 'Last »';
	 	 $config['next_link'] = '&gt;';
		 $config['prev_link'] = '&lt;';
		 
		 $this->pagination->initialize($config); 
		 
		 $data['rows'] = $this->model_article->get_ac($txt,$config['per_page'],$this->uri->segment(6));
		 $data['categorys']  = $this->model_article->get_category();
		$data['pagination'] =  $this->pagination->create_links();
		$data['totalrow'] = $config['total_rows'];
		$this->template->build('site/article/article',$data);
	}
	public function tagfilter($param1=NULL){
		if($param1 != ""){
				$txt = urldecode($param1);
				$this->session->set_userdata("search_tag",$txt);
		}else{
			$txt  = $this->session->userdata("search_tag");
		}
		 $years = $this->model_toparticle->get_year();
		 $options = array('' => '-- ปี --');
		 foreach($years as $value) {
			$options[$value->AM_year] = $value->AM_year;
		 }
		 $data['years'] = $options;
		 $this->session->unset_userdata("year_top");
		$this->session->unset_userdata("month_top");
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
		$config["base_url"] = base_url()."site/article/tagfilter/".$txt;
		 $config['total_rows'] =  $this->model_article->get_tag($txt,$this->session->userdata("search_catagory"));
		 $config['per_page'] = '20'; 
		 $config['num_links'] = '5'; 
		 $config['uri_segment'] = 6;
		 $config['full_tag_open'] = '<ul class="paginations">';
		 $config['full_tag_close'] = '</ul>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		 $config['first_link'] = '« First';
		 $config['last_link'] = 'Last »';
	 	 $config['next_link'] = '&gt;';
		 $config['prev_link'] = '&lt;';
		 
		 $this->pagination->initialize($config); 
		 
		 $data['rows'] = $this->model_article->get_tag($txt,$this->session->userdata("search_catagory"),$config['per_page'],$this->uri->segment(6));
		 $data['categorys']  = $this->model_article->get_category();
		$data['pagination'] =  $this->pagination->create_links();
		$data['totalrow'] = $config['total_rows'];
		$this->template->build('site/article/article',$data);
	}
	public function search(){
		$this->session->unset_userdata("year_top");
		$this->session->unset_userdata("month_top");
		if(isset($_POST['searchtxt']) && $_POST['searchtxt'] == ""){
				redirect('site/article/index','location');	
		}
				if(isset($_POST['searchtxt']) && $_POST['searchtxt'] != ""){
						$txt = $this->input->post("searchtxt");
						$this->session->set_userdata("search_article",$txt);
				 }else{
						$txt  = $this->session->userdata("search_article");					 	
				 }
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
		 $config["base_url"] = base_url()."site/article/search";
		 $config['total_rows'] =  $this->model_article->search_ac($txt,$this->session->userdata("search_catagory"));
		 $config['per_page'] = '40'; 
		 $config['num_links'] = '5'; 
		 $config['uri_segment'] = 5;
		 $config['full_tag_open'] = '<ul class="paginations">';
		 $config['full_tag_close'] = '</ul>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		 $config['first_link'] = '« First';
		 $config['last_link'] = 'Last »';
	 	 $config['next_link'] = '&gt;';
		 $config['prev_link'] = '&lt;';
		 
		 $this->pagination->initialize($config); 
		 
		 $data['rows'] = $this->model_article->search_ac($txt,$this->session->userdata("search_catagory"),$config['per_page'],$this->uri->segment(5));
		 
		 $data['categorys']  = $this->model_article->get_category();
		 
		 $data['pagination'] =  $this->pagination->create_links();
		 $data['totalrow'] = $config['total_rows'];
		 $this->template->build('site/article/article',$data);
	}
	
}
?>