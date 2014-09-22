<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Coding by : alongkorn@codeworks.co.th */
class News extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('site/model_news');
		$this->load->model('site/model_home');
		$foot = $this->model_home->get_contact();
		$this->template->set_layout('site/layout/template')
			->css('asset/site/css/lightbox.css')
			 ->css('asset/backoffice/css/ui-lightness/jquery-ui-1.8.24.custom.css')
			// ->js('asset/backoffice/js/jquery-ui-1.8.24.custom.min.js')
			->js('asset/site/js/jquery.min.js')
			->js('asset/site/js/lightbox.min.js');
			$this->template->set_layout('site/layout/template')	
			->set_view('footer','site/include/footer',array('foot'=>$foot))
			->set_view('some_script','site/include/some_script')
			->set_view('header','site/include/header', array('menu_main'=>2)); 
	}
	
	public function index(){
		$this->session->unset_userdata("search_news");
		$this->session->unset_userdata("search_catagory_news");
		$this->session->unset_userdata("start_approve_news");
		$this->session->unset_userdata("end_approve_news");
		$config["base_url"] = base_url()."site/news/index";
		// $config['total_rows'] =  $this->model_news->get_ac();
		$config['total_rows'] =  3000;
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
		 
		 $data['rows'] = $this->model_news->get_ac(NULL,$config['per_page'],$this->uri->segment(5));
		$numview="";
		 if(!empty($data['rows'])){
			 foreach($data['rows'] as $row) :
			 $rowpic = $this->model_news->get_cover($row->N_id);
			 $num = $this->model_news->get_viewsid($row->N_id);
			 if(!empty($rowpic)){
			 	$value[$row->N_id] = $rowpic[0]->NG_ThumbnailUrl;
			 }else{
				 $value[$row->N_id] = site_url('asset/site/images/picDefalt.png'); 
			 }
			 if(!empty($num)){
				 $numview[$row->N_id] = $num[0]->MyCount;
			 }else{
				 $numview[$row->N_id] = 0;
			 }
			
			 endforeach;
		 }
		$data['numview'] = $numview;
		$data['newspic']= $value;
		
		$data['pagination'] =  $this->pagination->create_links();
		$data['totalrow'] = $config['total_rows'];
		 $data['categorys']  = $this->model_news->get_category();
		  $data['cate']  = $this->model_news->get_category();
		$this->template->build('site/news/news',$data);
	}
	
	
	public function rss(){
		
		$data['rows'] = $this->model_news->get_rssac();
		$data['topicrss'] = "ข่าวประชาสัมพันธ์";
		 $this->load->view('site/rss/news',$data);
	}
	public function rsshot(){
		
		$data['rows'] = $this->model_news->get_rssachot();
		$data['topicrss'] = "ข่าวประชาสัมพันธ์";
		 $this->load->view('site/rss/news',$data);
	}
	public function rss_catalog($param1=NULL){
		
		$data['rows'] = $this->model_news->get_rssac($param1);
		
		
		$categorys  = $this->model_news->get_categoryid($param1);
		$data['topicrss'] = "ข่าวประชาสัมพันธ์ : ".$categorys[0]->C_topic;
		 $this->load->view('site/rss/news',$data);
	}
	
	public function detail($param1=NULL){
		$data = array(
					'NV_ref' =>  $param1,
					'NV_date' =>  $this->config->item('now')
			);
			
		$this->model_news->add_ac($data);
		$data['viewnum'] = $this->model_news->get_viewsid($param1);
		//print_r($data['viewnum']);
		$rows =  $this->model_news->get_id($param1);
		$data['resent'] = $this->model_news->get_resent($param1,$rows[0]->N_category_ref);
		$value="";
		$numview="";
		 if(!empty($data['resent'])){
			 foreach($data['resent'] as $row) :
			 $rowpic = $this->model_news->get_cover($row->N_id);
			 $num = $this->model_news->get_viewsid($row->N_id);
			 if(!empty($rowpic)){
			 	$value[$row->N_id] = $rowpic[0]->NG_ThumbnailUrl;
			 }else{
				 $value[$row->N_id] = site_url('asset/site/images/picDefalt.png'); 
			 }
			 if(!empty($num)){
				 $numview[$row->N_id] = $num[0]->MyCount;
			 }else{
				 $numview[$row->N_id] = 0;
			 }
			
			 endforeach;
		 }
		$data['numview'] = $numview;
		$data['newsrepic']= $value;
		
		$data['gal'] = $this->model_news->get_gal($param1);
		$data['vdo'] = $this->model_news->get_vdo($param1);
		$data['categorys']  = $this->model_news->get_category();
		$data['rows'] =  $this->model_news->get_id($param1);
		if(!empty($data['rows'])){
			 foreach($data['rows'] as $rownews) :
			 $rowpicnew = $this->model_news->get_cover($rownews->N_id);
			 if(!empty($rowpicnew)){
			 	$value[$rownews->N_id] = $rowpicnew[0]->NG_ThumbnailUrl;
			 }else{
				 $value[$rownews->N_id] = site_url('asset/site/images/picDefalt.png');
			 }
			
			 endforeach;
		 }

		$data['newspic']= $value;
		$this->template->build('site/news/news-detail',$data);
	}
	public function category($param1=NULL){
		$this->session->unset_userdata("search_news");
		if($param1 != ""){
				$txt = $param1;
				$this->session->set_userdata("search_catagory_news",$txt);
		}else{
			$txt  = $this->session->userdata("search_catagory_news");
		}
		
		$config["base_url"] = base_url()."site/news/category/".$txt;
		 $config['total_rows'] =  $this->model_news->get_ac($txt);
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
		 
		 $data['rows'] = $this->model_news->get_ac($txt,$config['per_page'],$this->uri->segment(6));
		 $value="";
		
		$numview="";
		 if(!empty($data['rows'])){
			 foreach($data['rows'] as $row) :
			 $rowpic = $this->model_news->get_cover($row->N_id);
			 $num = $this->model_news->get_viewsid($row->N_id);
			  if(!empty($rowpic)){
			 	$value[$row->N_id] = $rowpic[0]->NG_ThumbnailUrl;
			 }else{
				 $value[$row->N_id] = site_url('asset/site/images/picDefalt.png'); 
			 }
			 if(!empty($num)){
				 $numview[$row->N_id] = $num[0]->MyCount;
			 }else{
				 $numview[$row->N_id] = 0;
			 }
			
			 endforeach;
		 }
		$data['numview'] = $numview;
		$data['newspic']= $value;
		 
		 $data['categorys']  = $this->model_news->get_category();
		  $data['cate']  = $this->model_news->get_category();
		$data['pagination'] =  $this->pagination->create_links();
		$data['totalrow'] = $config['total_rows'];
		$this->template->build('site/news/news',$data);
	}
	public function tagfilter($param1=NULL){
		if($param1 != ""){
				$txt = urldecode($param1);
				$this->session->set_userdata("search_tag",$txt);
		}else{
			$txt  = $this->session->userdata("search_tag");
		}
		
		$config["base_url"] = base_url()."site/news/tagfilter/".$txt;
		 $config['total_rows'] =  $this->model_news->get_tag($txt,$this->session->userdata("search_catagory_news"));
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
		 
		 $data['rows'] = $this->model_news->get_tag($txt,$this->session->userdata("search_catagory_news"),$config['per_page'],$this->uri->segment(6));
		 
		$value="";
		$numview="";
		 if(!empty($data['rows'])){
			 foreach($data['rows'] as $row) :
			 $rowpic = $this->model_news->get_cover($row->N_id);
			 $num = $this->model_news->get_viewsid($row->N_id);
			 if(!empty($rowpic)){
			 	$value[$row->N_id] = $rowpic[0]->NG_ThumbnailUrl;
			 }else{
				 $value[$row->N_id] = site_url('asset/site/images/picDefalt.png'); 
			 }
			 if(!empty($num)){
				 $numview[$row->N_id] = $num[0]->MyCount;
			 }else{
				 $numview[$row->N_id] = 0;
			 }
			
			 endforeach;
		 }
		$data['numview'] = $numview;
		$data['newspic']= $value;
		 
		 $data['categorys']  = $this->model_news->get_category();
		  $data['cate']  = $this->model_news->get_category();
		$data['pagination'] =  $this->pagination->create_links();
		$data['totalrow'] = $config['total_rows'];
		$this->template->build('site/news/news',$data);
	}
	public function search(){
		$this->session->unset_userdata("search_catagory_news");
		$this->session->unset_userdata("start_approve_news");
		$this->session->unset_userdata("end_approve_news");
		if(isset($_POST['searchtxt']) && $_POST['searchtxt'] == ""){
				redirect('site/news/index','location');	
		}
				if(isset($_POST['searchtxt']) && $_POST['searchtxt'] != ""){
						$txt = $this->input->post("searchtxt");
						$this->session->set_userdata("search_news",$txt);
				 }else{
						$txt  = $this->session->userdata("search_news");					 	
				 }
 
		 $config["base_url"] = base_url()."site/news/search";
		 $config['total_rows'] =  $this->model_news->search_ac($txt,$this->session->userdata("search_catagory_news"));
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
		 
		 $data['rows'] = $this->model_news->search_ac($txt,$this->session->userdata("search_catagory_news"),$config['per_page'],$this->uri->segment(5));
		 
		 $value="";
		$numview="";
		 if(!empty($data['rows'])){
			 foreach($data['rows'] as $row) :
			 $rowpic = $this->model_news->get_cover($row->N_id);
			 $num = $this->model_news->get_viewsid($row->N_id);
			 if(!empty($rowpic)){
			 	$value[$row->N_id] = $rowpic[0]->NG_ThumbnailUrl;
			 }else{
				 $value[$row->N_id] = site_url('asset/site/images/picDefalt.png'); 
			 }
			 if(!empty($num)){
				 $numview[$row->N_id] = $num[0]->MyCount;
			 }else{
				 $numview[$row->N_id] = 0;
			 }
			
			 endforeach;
		 }
		$data['numview'] = $numview;
		$data['newspic']= $value;
		 
		 $data['categorys']  = $this->model_news->get_category();
		  $data['cate']  = $this->model_news->get_category();
		 $data['pagination'] =  $this->pagination->create_links();
		 $data['totalrow'] = $config['total_rows'];
		 $this->template->build('site/news/news',$data);
	}
	
	public function search_advance(){
		if(isset($_POST['datestart']) && $_POST['datestart'] == ""&&isset($_POST['datestop']) && $_POST['datestop'] == ""){
				redirect('site/news/index','location');	
		}
				 if(isset($_POST['searchtxt']) && $_POST['searchtxt'] != ""){
						$txt  = $this->session->userdata("search_news");					 	
				 }else{
					 	$txt  = $this->session->userdata("search_news");		
				 }
				 
				 
				 if(isset($_POST['datestart']) && $_POST['datestart'] != ""){
						$txtdatestart = $this->input->post("datestart");
						$this->session->set_userdata("start_approve_news",$txtdatestart);
				 }else{
						$txtdatestart  = $this->session->userdata("start_approve_news");					 	
				 }
				 
				 if(isset($_POST['datestop']) && $_POST['datestop'] != ""){
						$txtdatestop = $this->input->post("datestop");
						$this->session->set_userdata("end_approve_news",$txtdatestop);
				 }else{
						$txtdatestop = $this->session->userdata("end_approve_news");					 	
				 }
				 
				  if(isset($_POST['search_cat']) && $_POST['search_cat'] != ""){
						$txtcat = $this->input->post("search_cat");
						$this->session->set_userdata("search_catagory_news",$txtcat);
				 }else{
						$txtcat = $this->session->userdata("search_catagory_news");					 	
				 }
				
				 //echo $txtdatestart."........".$txtdatestop;
				// exit;
		 $config["base_url"] = base_url()."site/news/search";
		 $config['total_rows'] =  $this->model_news->search_advance($txt,$txtdatestart,$txtdatestop,$txtcat);
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
		 
		 $data['rows'] = $this->model_news->search_advance($txt,$txtdatestart,$txtdatestop,$txtcat,$config['per_page'],$this->uri->segment(5));
		 
		$value="";
		$numview="";
		 if(!empty($data['rows'])){
			 foreach($data['rows'] as $row) :
			 $rowpic = $this->model_news->get_cover($row->N_id);
			 $num = $this->model_news->get_viewsid($row->N_id);
			 if(!empty($rowpic)){
			 	$value[$row->N_id] = $rowpic[0]->NG_ThumbnailUrl;
			 }else{
				 $value[$row->N_id] = site_url('asset/site/images/picDefalt.png'); 
			 }
			 if(!empty($num)){
				 $numview[$row->N_id] = $num[0]->MyCount;
			 }else{
				 $numview[$row->N_id] = 0;
			 }
			
			 endforeach;
		 }
		$data['numview'] = $numview;
		$data['newspic']= $value;
		 
		 $data['categorys']  = $this->model_news->get_category();
		  $data['cate']  = $this->model_news->get_category();
		 $data['pagination'] =  $this->pagination->create_links();
		 $data['totalrow'] = $config['total_rows'];
		 $this->template->build('site/news/news',$data);
	}
}

?>