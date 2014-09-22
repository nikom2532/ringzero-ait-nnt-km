	<?php if(!empty($foot)){ foreach($foot as $row) : endforeach; } 
	
	?>   
    <div class="bg-nav-footer">
            <div class="nav-footer  wrapper">
                <ul>
                    <li><a href="<?php echo site_url("site/home"); ?>" title="หน้าหลัก KM">หน้าหลัก KM</a>|</li>
                    <li><a href="<?php echo site_url("site/news"); ?>" title="ข่าว/ข่าวสาร">ข่าว/ข่าวสาร</a>|</li>
                    <li><a href="<?php echo site_url("site/article"); ?>" title="บทความ">บทความ</a>|</li>
                    <li><a href="<?php echo site_url("site/faq"); ?>" title="คำถามที่พบบ่อย">คำถามที่พบบ่อย</a>|</li>
                    <li class="last"><a href="<?php echo site_url("site/contact_us"); ?>" title="ติดต่อเรา">ติดต่อเรา</a></li>
                </ul>
            </div>
        </div>
        <div class="bg-footer">            
            <div id="footer" class="wrapper">
                <div class="box-contact">
                    <h4 class="bold">สำนักข่าว กรมประชาสัมพันธ์</h4>
                    <p><?php echo $row->ADD_address; ?></p>
                    <p>
                        <span class="bold">โทรศัพท์</span> <?php echo $row->ADD_tel; ?>,
                        <span class="bold">Fax</span> <?php echo $row->ADD_fax; ?>
                    </p>
                    <p>
                        <span class="bold">WEB MASTER</span> : 
                        <a href="<?php echo $row->ADD_web; ?>" title="<?php echo $row->ADD_web; ?>" target="_blank" class="contactus-link"><?php echo $row->ADD_web; ?></a>
                    </p>
                </div>

                <div class="box-stat">
                    <div class="stat">
                        <span class="message">ผู้เข้าชมตั้งแต่ พ.ค.46
                        &nbsp;<img src="<?php echo base_url()."asset/site/"; ?>images/icon-truehits.png" alt="img">
                        </span>
                        <img src="<?php echo base_url()."asset/site/"; ?>images/icon-truehits-score.jpg" alt="img">
                    </div>
                </div>
            </div> <!-- #footer --> 
        </div>