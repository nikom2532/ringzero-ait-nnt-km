<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Coding by : Thanutchai Kaewmong */
class Account extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('backoffice/model_account');
		
		$this->template->set_layout('backoffice/layout/template')
			->title('Administrator Backoffice')
			->js('asset/backoffice/js/jquery-1.7.1.min.js')
			->js('asset/backoffice/js/simpla.jquery.configuration.js')
			->js('asset/backoffice/js/common.js')
			->js('asset/backoffice/js/jquery-ui-1.8.18.custom.min.js')
			->css('asset/backoffice/css/reset.css')
			->css('asset/backoffice/css/style.css')
			->css('asset/backoffice/css/invalid.css')
			->css('asset/backoffice/css/jquery-ui-1.8.18.custom.css')
			->meta('shortcut icon','asset/backoffice/images/icons/favicon(1).ico','rel')
			->meta('keywords','i do catering')
			->set_view('footer','backoffice/include/footer')
			->set_view('menu','backoffice/include/menu', array('menu_main'=>2,'sub'=>1));
			
			if($this->session->userdata('session_login') == ""){
					$this->session->set_flashdata('error','กรุณากรอกข้อมูลผู้ใช้ใหม่');
					redirect('backoffice/login','location');
			}
			if(!in_array("Account",explode(",",$this->session->userdata('session_menu'))) && $this->session->userdata('session_menu') != "ALL"){
				    $this->session->set_flashdata('error','ไม่อนุญาตให้เข้าใช้งาน');
					redirect('backoffice/profile','location');
		    }
	}
	
	public function index(){
		if($this->session->userdata("search_account") != ""){
						$this->session->unset_userdata("search_account");
		}
		
		 $config["base_url"] = base_url()."backoffice/account/index";
		 $config['total_rows'] =  $this->model_account->get_ac();
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
		 
		 $data['rows'] = $this->model_account->get_ac($config['per_page'],$this->uri->segment(5));
		 
		 $data['pagination'] =  $this->pagination->create_links();

		 $this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcut')
		 ->set_view('search','backoffice/include/search')
		 ->build('backoffice/account/index',$data);
	}
	
	public function search(){
		if(isset($_POST['search']) && $_POST['search'] == ""){
				redirect('backoffice/account/index','location');	
		}
				 if($this->input->post("search") != ""){
						$txt = $this->input->post("search");
						$this->session->set_userdata("search_account",$txt);
				 }else{
						$txt  = $this->session->userdata("search_account");					 	
				 }
		 $config["base_url"] = base_url()."backoffice/account/search";
		 $config['total_rows'] =  $this->model_account->search_ac($txt);
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
		 
		 $data['rows'] = $this->model_account->search_ac($txt,$config['per_page'],$this->uri->segment(5));
		 
		 $data['pagination'] =  $this->pagination->create_links();
		 $this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcut')
		 ->set_view('search','backoffice/include/search')
		 ->build('backoffice/account/index',$data);
	}
	
	public function create(){	
		$this->template
		->set_view('shortcut','backoffice/include/shortcut')
		->set_view('notices','backoffice/include/notices')
		->build('backoffice/account/form');
	}
	
	public function save(){	
		$this->form_validation->set_rules('username', 'ชื่อผู้ใช้งาน', "trim|required|callback_check_user|min_length[5]|max_length[15]|alpha_numeric");
		$this->form_validation->set_rules('password', 'รหัสผ่าน', "trim|required|matches[confirm-password]|min_length[6]|max_length[15]|alpha_numeric");
		$this->form_validation->set_rules('confirm-password', 'ยืนยันรหัสผ่าน', "trim|required");
		$this->form_validation->set_rules('name', 'ชื่อ - นามสกุล', "trim|required|min_length[5]|max_length[30]");
		$this->form_validation->set_rules('ACC_dep1', 'สังกัด', "trim|required");
		$this->form_validation->set_rules('ACC_dep2', 'หน่วยงาน', "trim|required");
		$this->form_validation->set_rules('ACC_position', 'ตำแหน่ง', "trim|required");
		$this->form_validation->set_rules('ACC_email', 'อีเมลล์', "trim|required|valid_email");
		$this->form_validation->set_rules('menu_chk[]', 'สิทธิ์การเข้าถึงข้อมูล', "trim|required");
		
		
		if($this->form_validation->run($this) == TRUE){
			$data = array(
					'ACC_name' =>  $this->input->post('name'),
					'ACC_username' =>  $this->input->post('username'),
					'ACC_password' =>  $this->input->post('password'),
					'ACC_menu' =>  implode(',',$this->input->post('menu_chk')),
					'ACC_dep1' =>  $this->input->post('ACC_dep1'),
					'ACC_dep2' =>  $this->input->post('ACC_dep2'),
					'ACC_position' =>  $this->input->post('ACC_position'),
					'ACC_email' =>  $this->input->post('ACC_email'),
					'ACC_activated' =>  $this->input->post('active'),
					'ACC_add' => $this->config->item('now'),
					'ACC_update' => $this->config->item('now'),
					'ACC_userupdate' => $this->session->userdata('session_login')					
			);
			$this->model_account->add_ac($data);
			$this->session->set_flashdata('success','การเพิ่มข้อมูลของ '.$this->input->post('name').' '.$this->uri->segment(3).' สำเร็จ.');
			redirect('backoffice/account/index','location');
		}else{
			$this->create();
		}
	}
	
	public function edit($param1){	
		$data["result"] = $this->model_account->get_for_update($param1);
		$this->template
		 ->set_view('notices','backoffice/include/notices')
		 ->set_view('shortcut','backoffice/include/shortcut')
		 ->build('backoffice/account/form',$data);
	}
	
	public function update(){
		$this->form_validation->set_rules('name', 'ชื่อ - นามสกุล', "trim|required|min_length[5]|max_length[30]");
		$this->form_validation->set_rules('menu_chk[]', 'สิทธิ์การเข้าถึงข้อมูล', "trim|required");	
		$this->form_validation->set_rules('ACC_dep1', 'สังกัด', "trim|required");
		$this->form_validation->set_rules('ACC_dep2', 'หน่วยงาน', "trim|required");
		$this->form_validation->set_rules('ACC_position', 'ตำแหน่ง', "trim|required");
		$this->form_validation->set_rules('ACC_email', 'อีเมลล์', "trim|required|valid_email");
		
		if($this->form_validation->run($this) == TRUE){
			$data = array(
					'ACC_name' =>  $this->input->post('name'),
					'ACC_menu' =>  implode(',',$this->input->post('menu_chk')),
					'ACC_dep1' =>  $this->input->post('ACC_dep1'),
					'ACC_dep2' =>  $this->input->post('ACC_dep2'),
					'ACC_position' =>  $this->input->post('ACC_position'),
					'ACC_email' =>  $this->input->post('ACC_email'),
					'ACC_activated' =>  $this->input->post('active'),
					'ACC_update' => $this->config->item('now'),
					'ACC_userupdate' => $this->session->userdata('session_login')					
			);
			$this->model_account->update_ac($data,$this->input->post('id'));
			$this->session->set_flashdata('success','การแก้ไขของ '.$this->input->post('name').' '.$this->uri->segment(3).' สำเร็จ.');
			redirect('backoffice/account/index','location');
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
					'ACC_activated' => $active,
					'ACC_update' => $this->config->item('now'),
					'ACC_userupdate' => $this->session->userdata('session_login')
			);			
			$msg = $this->model_account->update_ac($data,$param1);
			$result = $this->model_account->get_for_update($param1);
			if($active == 1){
					$this->session->set_flashdata('success','การ เปิด/ปิด สถานะการใช้งานของ '.$result->ACC_name.' สำเร็จ.');
			}else{
					$this->session->set_flashdata('success','การ เปิด/ปิด สถานะการใช้งานของ '.$result->ACC_name.' สำเร็จ.');
			}
			redirect('backoffice/account/index','location');
		}
		
	}
	
	public function delete($param1=NULL){
		$del_data = ($param1==NULL ? $this->input->post('chkbox') : $param1 );
		$result = $this->model_account->get_for_update($param1);
		$this->model_account->delete_ac($del_data);		
		if($param1 == NULL){
			$this->session->set_flashdata('success','Delete account complete');
		} else {
			$this->session->set_flashdata('success','การลบข้อมูลของ '.$result->ACC_name.' สำเร็จ.');
		}
		redirect('backoffice/account/index','location');
	} 
	
	public function check_user($username){
				$this->form_validation->set_message('check_user', 'มีชื่อผู้ใช้งานนี้แล้ว.');
				if(!$this->model_account->check_user_matching($username)){
					return TRUE;
				}else {
					return FALSE;
				}
				
	}
	
	public function change_password($param1){
			$data['key'] = $param1;
			$data["result"] = $this->model_account->get_for_update($param1);
			$this->template
				->set_view('shortcut','backoffice/include/shortcut')
				->set_view('notices','backoffice/include/notices')
				->build('backoffice/account/form_chgpass',$data);
	}
	
	public function save_password(){
			//$this->form_validation->set_rules('old-password', 'รหัสผ่านเก่า', "trim|required|alpha_numeric|callback_check_pass");
		$this->form_validation->set_rules('password', 'รหัสผ่านใหม่', "trim|required|matches[confirm-password]|min_length[6]|max_length[15]|alpha_numeric");
			$this->form_validation->set_rules('confirm-password', 'ยืนยันรหัสผ่านใหม่', "trim|required");
			
			if($this->form_validation->run($this) == TRUE){
				$data['ACC_password'] = $this->input->post('password');
				$this->model_account->update_ac($data,$this->input->post('id'));
				$result = $this->model_account->get_for_update($this->input->post('id'));
				$this->session->set_flashdata('success','เปลี่ยนรหัสผ่านของ '.$result->ACC_name.' สำเร็จ');
				redirect('backoffice/account/index','location');
			}else{
				$this->change_password($this->input->post('id'));
			}
	}
	
	public function check_pass($pass){
				$this->form_validation->set_message('check_pass', 'รหัสผ่านเก่าไม่ถูกต้อง');
				if($this->model_account->check_pass_matching($pass,$this->input->post('id'))){
					return TRUE;
				}else {
					return FALSE;
				}
				
	}
}
?>