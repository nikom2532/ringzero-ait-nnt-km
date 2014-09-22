<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Coding by : alongkorn@codeworks.co.th */
class Faq extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('site/model_home');
	
		
		$foot = $this->model_home->get_contact();
		$this->template->set_layout('site/layout/template')
			->js('asset/site/js/jquery.min.js');
			$this->template->set_layout('site/layout/template')	
			->set_view('footer','site/include/footer',array('foot'=>$foot))
			->set_view('some_script','site/include/some_script')
			->set_view('header','site/include/header', array('menu_main'=>4)); 
	}
	
	//Access dbase 1 with $this->db and dbase 2 with $this->db_forum (or whatever you called it).
	public function index(){
		
		$data["rows"] = $this->model_home->get_faq();
		//$rows = $this->model_home->get_faqmulti();
		//print_r($rows);
		$this->template->build('site/faq/faq',$data);
	}
	
}
?>