<?php if(!empty($result)){ foreach($result as $row) : endforeach; } ?>   
<div class="content-box-header">
	<h3>
    	ติดต่อ
    </h3>
    <div class="clear"></div>
</div>
<div class="box-contactus-detail">
                            <img src="<?php echo base_url()."asset/site/"; ?>images/public-relation-department-logo.png" alt="Logo">
                            <p class="contactus-address"><?php echo $row->ADD_address; ?></p>
                            <div class="row-contactus-number">
                                <div class="contactus-tel">
                                    <label class="highlight  bold">โทรศัพท์</label>
                                    <span><?php echo $row->ADD_tel; ?></span>
                                </div>
                                <div class="contactus-fax">
                                    <label class="highlight  bold">โทรสาร</label>
                                    <span><?php echo $row->ADD_fax; ?></span>
                                </div>
                            </div>
                            <div class="row-contactus-site">
                                <div class="contactus-website">
                                    <label class="highlight  bold">Website : </label>
                                    <a href="<?php echo $row->ADD_web; ?>" title="<?php echo $row->ADD_web; ?>" target="_blank" class="contactus-link"><?php echo $row->ADD_web; ?></a>
                                </div>
                                <div class="contactus-email">
                                    <label class="highlight  bold">Email : </label>
                                    <a href="mailto:<?php echo $row->ADD_email; ?>" title="<?php echo $row->ADD_email; ?>" class="contactus-link"><?php echo $row->ADD_email; ?></a>
                                </div>
                            </div>

                        </div>
 <div class="box-contactus-maps">
                                <div class="box-maps">
                                	<?php echo (isset($row) ? '<br /><img src="'.site_url('uploads/address/'.$row->ADD_image).'" />' : '') ?>
                                    
                                </div>
                            </div>
<div class="content-box-content"> 
<form action="<?php echo site_url("backoffice/sendcontact/update"); ?>" method="post">
    		<fieldset>
            	  <div class="rows">
                                        <label>
                                            <span class="bold">ชื่อ</span>
                                             (Name)</label>
                                        <input type="text" name="formname" id="formname" class="txt-field">
                                        <span class="require">*</span>
                                    </div>
                                    <div class="rows">
                                        <label>
                                            <span class="bold">อีเมล์ติดต่อกลับ</span> 
                                            (Reply Email)</label>
                                        <input type="text" name="formemail" id="formemail" class="txt-field">
                                        <span class="require">*</span>
                                    </div>
                                    <div class="rows">
                                        <label>
                                            <span class="bold">เบอร์โทร</span> 
                                            (Phone)</label>
                                        <input type="text" name="formtel" id="formtel" class="txt-field">
                                        
                                    </div>
                                    <div class="rows">
                                        <label>
                                            <span class="bold">ข้อความ</span> 
                                            (Message)</label>
                                        <textarea name="formtopic" id="formtopic" class="textarea"></textarea><span class="require">*</span>
                                    </div>
                                    <div class="rows">
                                        <div class="cols-right">
                                            
                                            
                                            <p class="require-msg">* ข้อมูลที่จำเป็นต้องกรอก</p>
                                        </div>
                                    </div>
                 <p>
                      <input class="button" type="submit" value="ยืนยัน" />
                  </p>
                  </fieldset>
          
          <div class="clear"></div>
     </form>
</div>