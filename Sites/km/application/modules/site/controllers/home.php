<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Coding by : alongkorn@codeworks.co.th */
class Home extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('site/model_news');
		$this->load->model('site/model_article');
		$this->load->model('site/model_home');
		
		$foot = $this->model_home->get_contact();
		/*$this->template->set_layout('site/layout/template')
			->css('asset/site/popup/colorbox.css')
			->js('asset/site/popup/jquery.colorbox-min.js');*/
			$this->template->set_layout('site/layout/template')	
			->set_view('footer','site/include/footer',array('foot'=>$foot))
			->set_view('header','site/include/header', array('menu_main'=>1)); 
	}
	
	public function index(){
		$data['rowsarticle'] = $this->model_article->get_ac(NULL,3,0);
		$data['rowsnews'] = $this->model_news->get_ac("top",3,0);
		$numview="";
		if(!empty($data['rowsnews'])){
			 foreach($data['rowsnews'] as $row) :
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
		// $array = array($value);
		 //print_r($value);
		 $data['numview']=$numview;
		$data['newspic']= $value;
		$data['rowsview'] = $this->model_home->get_month();
		$data['rowsrecom'] = $this->model_article->get_ac("suggest",5,0);
		//print_r($data);
		$this->template->build('site/home/index',$data);
	}
	
	public function rsstopview(){
		$data['rows'] = $this->model_home->get_month();
		$data['topicrss'] = "บทความที่มีผู้ชมมากที่สุด";
		$this->load->view('site/rss/article',$data);
	}
	public function rssrecomment(){
		$data['rows'] = $this->model_article->get_ac("suggest",5,0);
		$data['topicrss'] = "บทความแนะนำ";
		$this->load->view('site/rss/article',$data);
	}
	public function rsslastarticle(){
		$data['rows'] = $this->model_article->get_ac(NULL,3,0);
		$data['topicrss'] = "บทความล่าสุด";
		$this->load->view('site/rss/article',$data);
	}
	public function rsshotnews(){
		$data['rows'] = $this->model_news->get_ac("top",3,0);
		
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
		// $array = array($value);
		//print_r($data['rowsnews']);
		$data['newspic']= $value;
		$data['topicrss'] = "ข่าวเด่น";
		$this->load->view('site/rss/news',$data);
	}
	
}
?>