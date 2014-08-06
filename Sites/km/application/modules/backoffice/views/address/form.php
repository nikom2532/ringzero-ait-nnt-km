<div class="content-box-header">
	<h3>
    	ระบบจัดการ<?php echo menu_bof($this->uri->segment(3)) ?>
    </h3>
    <div class="clear"></div>
</div>
<div class="content-box-content"> 
	<form action="<?php echo site_url('backoffice/address/update'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="<?php echo $result->ADD_id; ?>" />
    <input type="hidden" name="old_pic" id="old_pic" value="<?php echo $result->ADD_image; ?>" />
	<fieldset>
    			<p>
                      <label>แผนที่</label>
                          <?php $att=array('name'=>'ADD_image'); echo form_upload($att);?>
                          <br /><small>ขนาดไฟล์ไม่เกิน 2 MB, รองรับไฟล์นามสกุล (.jpg, .jpeg, .png, .gif ) ขนาดแนะนำ 370*360px.</small>
                          <?php echo (isset($result) ? '<br /><img src="'.site_url('uploads/address/'.$result->ADD_image).'" width="309" />' : '') ?>
                  </p>
                 
                  <p>
                      <label>ที่อยู่</label>
                          <?php 
                                        $data = array(
                                                'name' => 'ADD_address',
                                                'id' => 'ADD_address',
                                                'value' =>  (empty($result) ? set_value('ADD_address') : set_value('ADD_address',htmldecode($result->ADD_address))),
                                                'rows'   => '5',
                                                 'cols'        => '100'
                                            );
                                        echo form_textarea($data);
                                        //echo form_editor($result['id']);
                           ?> 
                  </p>
                
                  <p>
                      <label>โทรศัพท์</label>
                          <input class="text-input small-input" type="text" id="ADD_tel" name="ADD_tel"
                          value="<?php echo (empty($result) ? set_value('ADD_tel') : $result->ADD_tel ); ?>" />
                  </p>
                 
                  <p>
                      <label>โทรสาร</label>
                          <input class="text-input small-input" type="text" id="ADD_fax" name="ADD_fax"
                          value="<?php echo (empty($result) ? set_value('ADD_fax') : $result->ADD_fax ); ?>" />
                  </p>
                  
                  <p>
                      <label>เว็ปไซต์</label>
                          <input class="text-input small-input" type="text" id="ADD_web" name="ADD_web"
                          value="<?php echo (empty($result) ? set_value('ADD_web') : $result->ADD_web ); ?>" />
                  </p>
                  
                  <p>
                      <label>อีเมลล์</label>
                          <input class="text-input small-input" type="text" id="ADD_email" name="ADD_email"
                          value="<?php echo (empty($result) ? set_value('ADD_email') : $result->ADD_email ); ?>" />
                  </p>
                  
                  
              <p>
                  <input class="button" type="submit" value="ยืนยัน" />
              </p>
              
          </fieldset>
          
          <div class="clear"></div>
          
      </form>
 </div>