<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Admin | Sign In</title>
        <link rel="shortcut icon" href="<?php echo site_url('asset/backoffice/images/icons/favicon(1).ico'); ?>" />
		<link rel="stylesheet" href="<?php echo site_url('asset/backoffice/css/reset.css'); ?>" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo site_url('asset/backoffice/css/gungnum_style.css'); ?>" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo site_url($this->config->item('TOrRy_theme')); ?>" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo site_url('asset/backoffice/css/invalid.css'); ?>" type="text/css" media="screen" />
		<script type="text/javascript" src="<?php echo site_url('asset/backoffice/js/jquery-1.3.2.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('asset/backoffice/js/simpla.jquery.configuration.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('asset/backoffice/js/facebox.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url('asset/backoffice/js/jquery.wysiwyg.js'); ?>"></script>
        <script type="text/javascript" src=" <?php echo site_url('asset/backoffice/js/jquery-latest.js'); ?>"></script>
       
	</head>
	<body id="login_torry">
		<div id="login-wrapper" class="png_bg">
			<div id="login-top">
            	<img src="<?php echo site_url('asset/backoffice/images/logo.png'); ?>" style="text-align:center" />
				<h1>Simpla Admin</h1>
				
			</div>
			<div id="login-content">
				<form action="<?php echo site_url('backoffice/login/access'); ?>" method="post">
                	<?php 
						if($this->session->flashdata('information')): 
                                echo '<div class="notification information png_bg"><div>'.$this->session->flashdata('information').'</div></div>'; 
						else:
								echo '<div class="notification information png_bg"><div>กรุณากรอกข้อมูลให้ถูกต้องภายใน 5 ครั้ง</div></div>';										
						endif;  
					?>						
                    <?php
                         if (validation_errors()): 
                                echo validation_errors('<div class="notification attention png_bg"><div>','</div></div>'); 
						elseif($this->session->flashdata('error')): 
                                echo '<div class="notification attention png_bg"><div>'.$this->session->flashdata('error').'</div></div>'; 								
						endif; 
                     ?>
					<p>
						<label>ชื่อผู้ใช้งาน</label>
						<input class="text-input" type="text" name="username" />
					</p>
					<div class="clear"></div>
					<p>
						<label>รหัสผ่าน</label>
						<input class="text-input" type="password" name="password" />
					</p>
					<div class="clear"></div>
					<!--<p id="remember-password">
						<input type="checkbox" />Remember me
					</p>
					<div class="clear"></div>-->
					<p>
						<input class="button" type="submit" value="เข้าสู่ระบบ" />
					</p>
				</form>
                
			</div>
		</div>
        <div id="foot">
            <small> <!-- Remove this notice or replace it with whatever you want -->
                &#169; Copyright | Powered by <a href="#">k.thanutchai@gmail.com</a> | <a href="#">alongkorn.is@gmail.com</a>
            </small>
        </div>
  </body>
</html>
<script type="text/javascript">
			$(function(){
					$('div.attention').delay(4600).fadeOut(5000);
			});
</script>