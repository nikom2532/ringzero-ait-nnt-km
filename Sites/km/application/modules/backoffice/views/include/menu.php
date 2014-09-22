<?php @session_start(); ?>
<h1 id="sidebar-title">Administrator</h1>
  				<img id="logo" src="<?php echo site_url('asset/backoffice/images/logo.png');?>"  />
  <div id="profile-links">ยินดีต้อนรับ, <?php echo $this->session->userdata('session_login'); ?>
              <a href="<?php echo site_url('backoffice/profile/edit');?>" title="ข้อมูลส่วนตัว">
			  		<?php echo $this->session->userdata('username');?>
              </a>
              <br /><br />
              <a href="#" title="เข้าสู่เว็ปไซต์">เข้าสู่เว็ปไซต์</a> | 
              <a href="<?php echo site_url('backoffice/login/logout');?>" title="ออกจากระบบ">ออกจากระบบ</a>
  </div>        
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
  <ul id="main-nav">    
    
    <li>
             <a href="<?php echo site_url('backoffice/profile') ?>" class="nav-top-item no-submenu 
			 <?php echo ($menu_main == 1 ? 'current' : '' ); ?>">
             			ข้อมูลส่วนตัว
             </a>
    </li> 
    <?php if(in_array("Account",explode(",",$this->session->userdata('session_menu'))) || $this->session->userdata('session_menu') == "ALL") : ?>
  	<li>
             <a href="<?php echo site_url('backoffice/account') ?>" class="nav-top-item no-submenu  
			 <?php echo ($menu_main == 2 ? 'current' : '' ); ?>">
             			ผู้ใช้งานระบบ
             </a>
    </li> 
    <?php endif; ?>
    <?php if(in_array("Category",explode(",",$this->session->userdata('session_menu'))) || $this->session->userdata('session_menu') == "ALL") : ?>
  	<li>
             <a href="<?php echo site_url('backoffice/category') ?>" class="nav-top-item no-submenu  
			 <?php echo ($menu_main == 3 ? 'current' : '' ); ?>">
             			หมวดหมู่บทความ
             </a>
    </li> 
    <?php endif; ?>
    <?php if(in_array("Article",explode(",",$this->session->userdata('session_menu'))) || in_array("Approve_article",explode(",",$this->session->userdata('session_menu'))) || in_array("Suggest_article",explode(",",$this->session->userdata('session_menu'))) || in_array("Toparticle",explode(",",$this->session->userdata('session_menu'))) || $this->session->userdata('session_menu') == "ALL"){ ?>
    <li>
             <a href="#" class="nav-top-item <?php echo ($menu_main == 4 || $menu_main == 5 || $menu_main == 6 || $menu_main == 7  ? 'current' : '' ); ?>">
             บทความ</a>
             <ul>
             	  <?php if(in_array("Article",explode(",",$this->session->userdata('session_menu'))) || $this->session->userdata('session_menu') == "ALL"){ ?>
                  <li><a href="<?php echo site_url('backoffice/article') ?>" class="
				  <?php echo ($menu_main == 4 ? 'current' : '' ); ?>">บทความ</a></li>  <?php } ?>
                  <?php if(in_array("Approve_article",explode(",",$this->session->userdata('session_menu'))) || $this->session->userdata('session_menu') == "ALL"){ ?>
                  <li><a href="<?php echo site_url('backoffice/approve_article') ?>" class="
                  <?php echo ($menu_main == 5 ? 'current' : '' ); ?>">อนุมัติบทความ</a></li><?php } ?>
                  <?php if(in_array("Suggest_article",explode(",",$this->session->userdata('session_menu'))) || $this->session->userdata('session_menu') == "ALL"){ ?>
                  <li><a href="<?php echo site_url('backoffice/suggest_article') ?>" class="
                  <?php echo ($menu_main == 6 ? 'current' : '' ); ?>">บทความแนะนำ</a></li><?php } ?>
                  <?php if(in_array("Toparticle",explode(",",$this->session->userdata('session_menu'))) || $this->session->userdata('session_menu') == "ALL"){ ?>
                  <li><a href="<?php echo site_url('backoffice/toparticle') ?>" class="
                  <?php echo ($menu_main == 7 ? 'current' : '' ); ?>">บทความติดอันดับ</a></li><?php } ?>
                  
          	</ul>
    </li>
   <?php } ?>
    <li>
             <a href="<?php echo site_url('backoffice/faq') ?>" class="nav-top-item no-submenu 
			 <?php echo ($menu_main == 8 ? 'current' : '' ); ?>">
             			คำถามที่พบบ่อย
             </a>
    </li>
     <?php if(in_array('Sendemail', explode(",",$this->session->userdata('session_menu')))) :?>
    <li>
             <a href="<?php echo site_url('backoffice/sendcontact') ?>" class="nav-top-item no-submenu 
			 <?php echo ($menu_main == 10 ? 'current' : '' ); ?>">
             			ติดต่อผู้ดูแลระบบ
             </a>
    </li>
     <?php endif; ?>
   
   
    <?php if(in_array('Set_email', explode(",",$this->session->userdata('session_menu'))) OR in_array('ALL', explode(",",$this->session->userdata('session_menu')))) :?>
    <li>
             <a href="#" class="nav-top-item <?php echo ($menu_main == 9 || $menu_main == 10 || $menu_main == 11  ? 'current' : '' ); ?>">ติดต่อเรา</a>
             <ul>
                  <li><a href="<?php echo site_url('backoffice/set_email') ?>" class="
				  <?php echo ($menu_main == 9 ? 'current' : '' ); ?>">ผู้รับผิดชอบการติดต่อ</a></li>
                  <li><a href="<?php echo site_url('backoffice/contact_us') ?>" class="
                  <?php echo ($menu_main == 10 ? 'current' : '' ); ?>">ผู้ติดต่อ</a></li>
                  <li><a href="<?php echo site_url('backoffice/address') ?>" class="
				  <?php echo ($menu_main == 11 ? 'current' : '' ); ?>">ที่อยู่ติดต่อ</a></li>
          	</ul>
    </li>
   <?php endif; ?>
  
</ul> <!-- End #main-nav -->    
			