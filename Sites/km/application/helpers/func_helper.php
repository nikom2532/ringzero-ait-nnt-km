<?php
function encode_url($url){
  $base_64 = base64_encode($url);
  $url_param = rtrim($base_64, '=');
  $url_param = str_replace(array('+', '/'), array(',', '-'), $url_param);
  return $url_param;}
  function decode_url($url){
   $base_64 = $url.str_repeat('=', strlen($url) % 4);
   $base_64 = str_replace(array(',', '-'), array('+', '/'), $base_64);
   $data = base64_decode($base_64);       
   return $data;
}
	function authen($set){
		$result = "";
		$set = trim($set);
		if(strpos($set,",")){
				$ars = explode(",",$set);
				foreach($ars as $arr){
					if($arr == "ผู้ดูแลระบบ"){ $result .= 'ALL,Account,Category,Article,Approve_article,Suggest_article,Toparticle,FAQ,Set_email,Contact_us,Address,';  }
					else if($arr == "สมาชิก"){ $result .= 'Article,FAQ,Sendemail';  }
					else{ $result .= 'Article,Suggest_article,Toparticle,FAQ,Sendemail';  }
				}
		}else{
					if($set == "ผู้ดูแลระบบ"){ $result .= 'ALL,Account,Category,Article,Approve_article,Suggest_article,Toparticle,FAQ,Set_email,Contact_us,Address';  }
					else if($set == "ALL"){ $result .= 'ALL';  }
					else if($set == "สมาชิก"){ $result .= 'Article,FAQ,Sendemail';  }
					else{ $result .= 'Article,Suggest_article,Toparticle,FAQ,Sendemail';  }
		}
		return $result;
	}
	
	function status_announce($set){
				if($set == "0รอการตรวจสอบ"){ $result = '<p style="color:#FC0;font-weight:bold;font-size:12px">รอการตรวจสอบ</p>';  }
				else if($set == "2ไม่ผ่านการตรวจสอบ"){ $result = '<p style="color:#F00;font-weight:bold;font-size:12px">ไม่ผ่านการตรวจสอบ</p>';  }
				else if($set == "1อนุญาตให้เผยแพร่"){ $result = '<p style="color:#060;font-weight:bold;font-size:12px">อนุญาตให้เผยแพร่</p>';  }
				return $result;
	}

	function menu_bof($menu){
				if($menu == "profile"){ $result = "ข้อมูลส่วนตัว";  }
				else if($menu == "account"){ $result = "จัดการผู้ใช้งานระบบ";  }
				else if($menu == "category"){ $result = "จัดการหมวดหมู่บทความ";  }
				else if($menu == "article_center"){ $result = "จัดการคัดลอกบทความ";  }
				else if($menu == "article"){ $result = "บทความ";  }
				else if($menu == "approve_article"){ $result = "อนุมัติบทความ";  }
				else if($menu == "suggest_article"){ $result = "บทความแนะนำ";  }
				else if($menu == "toparticle"){ $result = "บทความติดอันดับ";  }
				else if($menu == "faq"){ $result = "คำถามที่พบบ่อย";  }
				else if($menu == "set_email"){ $result = "ผู้รับผิดชอบการติดต่อ";  }
				else if($menu == "contact_us"){ $result = "ผู้ติดต่อ"; }
				else if($menu == "address"){ $result = "ที่อยู่ติดต่อ"; }
				else if($menu == "sendcontact"){ $result = "ติดต่อผู้ดูแลระบบ"; }
				return $result;
	}
	
	function th_date($date){
				$year = (substr($date,0,4))+543;
				$month = substr($date,5,2);
				$day = substr($date,8,2);
				$times = substr($date,10,9);
				$result = "";
				
				if($day == "01"){ $result .= "1";  }
				else if($day == "02"){ $result .= "2";  }
				else if($day == "03"){ $result .= "3";  }
				else if($day == "04"){ $result .= "4";  }
				else if($day == "05"){ $result .= "5";  }
				else if($day == "06"){ $result .= "6";  }
				else if($day == "07"){ $result .= "7";  }
				else if($day == "08"){ $result .= "8";  }
				else if($day == "09"){ $result .= "9";  }
				else{ $result .= $day;  }
				
				if($month == "01"){ $result .= " มกราคม ";  }
				else if($month == "02"){ $result .= " กุมภาพันธ์ ";  }
				else if($month == "03"){ $result .= " มีนาคม ";  }
				else if($month == "04"){ $result .= " เมษายน ";  }
				else if($month == "05"){ $result .= " พฤษภาคม ";  }
				else if($month == "06"){ $result .= " มิถุนายน ";  }
				else if($month == "07"){ $result .= " กรกฎาคม ";  }
				else if($month == "08"){ $result .= " สิงหาคม ";  }
				else if($month == "09"){ $result .= " กันยายน ";  }
				else if($month == "10"){ $result .= " ตุลาคม ";  }
				else if($month == "11"){ $result .= " พฤศจิกายน ";  }
				else if($month == "12"){ $result .= " ธันวาคม ";  }
				
				$result .= $year.$times;
				
				return $result;
	}
	
	function en_date($date){
				$year = substr($date,0,4);
				$month = substr($date,5,2);
				$day = substr($date,8,2);
				$times = substr($date,10,9);
				$result = "";
				
				if($day == "01"){ $result .= "1";  }
				else if($day == "02"){ $result .= "2";  }
				else if($day == "03"){ $result .= "3";  }
				else if($day == "04"){ $result .= "4";  }
				else if($day == "05"){ $result .= "5";  }
				else if($day == "06"){ $result .= "6";  }
				else if($day == "07"){ $result .= "7";  }
				else if($day == "08"){ $result .= "8";  }
				else if($day == "09"){ $result .= "9";  }
				else{ $result .= $day;  }
				
				if($month == "01"){ $result .= " January ";  }//Jan
				else if($month == "02"){ $result .= " February ";  }//Feb
				else if($month == "03"){ $result .= " March ";  }//Mar
				else if($month == "04"){ $result .= " April ";  }//Apr
				else if($month == "05"){ $result .= " May ";  }//May
				else if($month == "06"){ $result .= " June ";  }//Jun
				else if($month == "07"){ $result .= " July ";  }//Jul
				else if($month == "08"){ $result .= " August ";  }//Aug
				else if($month == "09"){ $result .= " September ";  }//Sep
				else if($month == "10"){ $result .= " October ";  }//Oct
				else if($month == "11"){ $result .= " November ";  }//Nov
				else if($month == "12"){ $result .= " December ";  }//Dec
				
				$result .= $year.$times;
				
				return $result;
	}
	
	function ms_date($date){
				$year = substr($date,7,4);
				$month = substr($date,0,3);
				$day = substr($date,4,2);
				$times = substr($date,12,7);
				
				return $day." ".$month." ".$year." ".$times;
	}
	
	if( ! function_exists('form_editor')){
		function form_editor($id)
		{
			echo	"<script type='text/javascript'>
					CKEDITOR.replace('$id',{	
							toolbar : [
                                                          ['Styles','Format','Font','FontSize'],'/',
														  		['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],'/',
														['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
														['Image','Table','-','Link','Iframe','Flash','Smiley','TextColor','BGColor','Source']
							],
							skin : 'kama',
							extraPlugins : 'uicolor',
							uiColor: '#cccccc',
							filebrowserBrowseUrl : '".base_url()."asset/ckfinder/ckfinder.html',
							filebrowserImageBrowseUrl : '".base_url()."asset/ckfinder/ckfinder.html?Type=Images',
							filebrowserFlashBrowseUrl : '".base_url()."asset/ckfinder/ckfinder.html?Type=Flash',
							filebrowserUploadUrl : '".base_url()."asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
							filebrowserImageUploadUrl : '".base_url()."asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
							filebrowserFlashUploadUrl : '".base_url()."asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash' ,
							height:'350',
							width:'1000'
					});
				</script>";
		}
	}
	
	if( ! function_exists('htmlencode')){
		function htmlencode($str) 
		{
			return htmlspecialchars(stripcslashes(trim($str)), ENT_QUOTES, 'UTF-8');
		}
	}

	if( ! function_exists('htmldecode')){
		function htmldecode($str) 
		{
			return html_entity_decode($str);
		}
	}
	function cut_word($str,$numtxt){
		$counttxt = strlen($str);
		$txt = substr($str,0,$numtxt);
		$arr = explode(" ",$txt);
		$count = count($arr);
		if($counttxt>$numtxt){
			$arr[$count-1] = " ...";
		}
		$result = implode(" ",$arr);
		return $result;
	}
?>