<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Coding by : alongkorn@codeworks.co.th */
class Home extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('site/model_news');
		$this->load->model('site/model_article');
		$this->load->model('site/model_home');
		
		/*$this->template->set_layout('site/layout/template')
			->css('asset/site/popup/colorbox.css')
			->js('asset/site/popup/jquery.colorbox-min.js');*/
			$this->template->set_layout('site/layout/template')	
			->set_view('footer','site/include/footer')
			->set_view('header','site/include/header', array('menu_main'=>1)); 
	}
	
	public function index(){
		$data['rowsarticle'] = $this->model_article->get_ac(NULL,3,0);
		$data['rowsnews'] = $this->model_news->get_ac("top",3,0);
		$data['rowsview'] = $this->model_home->get_month();
		$data['rowsrecom'] = $this->model_article->get_ac("suggest",5,0);
		//print_r($data);
		$this->template->build('site/home/index',$data);
	}
	
}
?>