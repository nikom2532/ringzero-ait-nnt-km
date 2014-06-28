	<div class="bg-header">
            <div id="header" class="wrapper">
                <div class="logo">
                    <h1>                        
                        <label class="th">ระบบห้องสมุดข่าวสารและองค์ความรู้สำหรับบริการประชาชน 
                        <span class="bold">สำนักข่าว กรมประชาสัมพันธ์</span></label>
                        <label class="en">Knowledge Management 
                        <span class="bold">National News Bureau of Thailand</span></label>
                    </h1>
                </div>
				<!--
                <div class="box-login">                
                    <form name="login-form" class="login-form">
                        <input type="text" name="username" value="" placeholder="Username" class="txt-field">
                        <input type="password" name="password" value="" placeholder="Password" class="txt-field">

                        <input type="submit" name="submit" value="เข้าสู้ระบบ" class="bt">
                    </form>

                    <div class="box-regis">
                        <a href="#" title="ลงทะเบียน">ลงทะเบียน</a>
                        <i> | </i>
                        <a href="#" title="ลืมรหัสผ่าน">ลืมรหัสผ่าน</a>
                    </div>
                </div>
				-->
            </div>
        </div>
        <div class="bg-nav">
            <div id="main-nav" class="wrapper">
                <ul>
                    <li class="main-km <?php if($menu_main==1){ echo 'active'; } ?>"><a href="<?php echo site_url("site/home"); ?>" title="หน้าหลัก KM">หน้าหลัก KM</a></li>
                    <li class="news-km <?php if($menu_main==2){ echo 'active'; } ?>"><a href="<?php echo site_url("site/news"); ?>" title="ข่าว/ข่าวสาร">ข่าว/ข่าวสาร</a></li>
                    <li class="article-km <?php if($menu_main==3){ echo 'active'; } ?>"><a href="<?php echo site_url("site/article"); ?>" title="บทความ">บทความ</a></li>
                    <li class="qa-km <?php if($menu_main==4){ echo 'active'; } ?>"><a href="<?php echo site_url("site/faq"); ?>" title="คำถามที่พบบ่อย">คำถามที่พบบ่อย</a></li>
                    <li class="contact-km <?php if($menu_main==5){ echo 'active'; } ?> last"><a href="<?php echo site_url("site/contact_us"); ?>"  title="ติดต่อเรา">ติดต่อเรา</a></li>
                </ul>
            </div>
        </div>