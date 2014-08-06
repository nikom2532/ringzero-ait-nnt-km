<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Coding by : alongkorn@codeworks.co.th */
class Contact_us extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('site/model_home');
		
		$this->template->set_layout('site/layout/template')
			->js('asset/site/js/jquery-1.8.2.min.js');
			$this->template->set_layout('site/layout/template')	
			->set_view('footer','site/include/footer')
			->set_view('header','site/include/header', array('menu_main'=>5)); 
	}
	
	public function index(){
		$data["rows"] = $this->model_home->get_contact();
		$this->template->build('site/contact_us/contact',$data);
	}
	public function inquiry(){
		//echo $_SERVER['HTTP_REFERER'];
		//echo site_url('site/contact_us');
		//echo $this->input->post('formemail');
		//print_r($_POST);
		//exit;
		if(($this->input->post('formemail')!=""||$this->input->post('formemail')!="0"||isset($_POST))&&($this->input->post('formname')!=""&&$this->input->post('formtopic')!="")&&(isset($_SERVER['HTTP_REFERER'])&&$_SERVER['HTTP_REFERER']==site_url('site/contact_us'))){
			$data = array(
				'CONT_name' => htmlencode($this->input->post('formname')),
				'CONT_email' => htmlencode($this->input->post('formemail')),
				'CONT_tel' => htmlencode($this->input->post('formtel')),
				'CONT_message' => htmlencode($this->input->post('formtopic')),
				'CONT_add' => date('Y-m-d H:i:s')
			);
			//echo $this->input->post('formmessage');
			$insertid = $this->model_home->contact_add($data);
			 
			 //send for admin
			//$email_admin = $this->model_home->contact_getmail();
			//$topic_admin = " (ติดต่อ) ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับประชาชน";

			/*$detail_admin= '
							<table width="700" border="0" x:str cellpadding="0" cellspacing="0">
								<tr><td colspan="2" height="85" ></td></tr>
								
								<tr>
									<td style="background:#EEE">ชื่อ - สกุล : </td><td>'.htmlencode($this->input->post('formname')).'</td>
								</tr>
								<tr>
									<td style="background:#EEE">โทรศัพท์ : </td><td>'.htmlencode($this->input->post('formtel')).'</td>
								</tr>
								<tr>
									<td style="background:#EEE">อีเมล์ : </td><td>'.htmlencode($this->input->post('formemail')).'</td>
								</tr>
								<tr>
									<td style="background:#EEE">ข้อความ : </td><td>'.htmlencode($this->input->post('formtopic')).'</td>
								</tr>
							</table>
						';*/
			//$this->sending($email_admin->SM_mail,$topic_admin."<noreply>",$detail_admin);

			//send for user
			/*$email_user =htmlencode($this->input->post('formemail'));
			
				$detail_txt = "ขอบคุณสำหรับคำแนะนำและคำถามครับ";
				$detail= '
							<table width="700" border="0" x:str cellpadding="0" cellspacing="0">
								<tr><td colspan="2" height="85" ><img src="'.site_url("asset/backoffice/images/logos.png").'"/></td></tr>
								<tr>
									<td>'.$detail_txt.'</td>
								</tr>
							</table>
						';
		*/
			//$this->sending($email_user,$topic_admin,$detail);
			////////////////////////////////////////////  end send mail /////////////////////////////////////////////////////////////
			
		}else{
			redirect('site/contact_us', 'location',301);
		}
			
	}
	
	public function sending($group,$subject,$desc){
					//$this->load->helper('email');
	
					$config = array(
							'useragent' => 'กรมประชาสัมพันธ์',
							'protocol' => 'smtp',
							'smtp_host' => 'mail.codeworks.co.th',
							'smtp_user' => 'alongkorn@codeworks.co.th',
							'smtp_pass' => 'code1234',
							'mailtype' => 'html',
							'charset' => 'utf-8',
							'smtp_timeout' => 30,
							'crlf' => "\r\n",
							'newline' => "\r\n"
						);
					
					$this->email->initialize($config);			
								
					$this->email->from('noreply@aitinnovation.co.th','กรมประชาสัมพันธ์');
					$this->email->to($group);
					$this->email->subject($subject);
					$this->email->message($desc);
					//echo htmldecode($desc);exit;
					$this->email->send();
					return TRUE;
	}
	
}
?>