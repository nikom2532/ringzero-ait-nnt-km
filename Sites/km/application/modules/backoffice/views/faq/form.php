<div class="content-box-header">
	<h3>
    	ระบบจัดการ<?php echo menu_bof($this->uri->segment(3)) ?>
    </h3>
    <div class="clear"></div>
</div>
<div class="content-box-content"> 
<?php if(empty($result)): ?>
	<form action="<?php echo site_url('backoffice/faq/save'); ?>" method="post" enctype="multipart/form-data">
<?php else: ?>
	<form action="<?php echo site_url('backoffice/faq/update'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="<?php echo $result->FAQ_id; ?>" />
<?php endif; ?>
	<fieldset>    
                  <p>
                      <label>คำถาม</label>
                          <input class="text-input small-input" type="text" id="q" name="q"
                          value="<?php echo (empty($result) ? set_value('q') : $result->FAQ_question); ?>" />
                  </p>
                  
                  <p>
                      <label>คำตอบ</label>
                          <input class="text-input small-input" type="text" id="a" name="a"
                          value="<?php echo (empty($result) ? set_value('a') : $result->FAQ_answer ); ?>" />
                  </p>
                  
                  <p>
                      <label>ลำดับการเเสดงผล</label>
                          <input class="text-input small-input2" type="text" id="order" name="order"  maxlength="3"
                          value="<?php echo (empty($result) ? 999 : $result->FAQ_order ); ?>" />
                  </p>
                  
                  <p>
                    <?php
                          $chk = 1;
                          if(!empty($result)){
                                $chk = $result->FAQ_activated;
                          }
                    ?>
                    <label style="margin-top:10px">สถานะการใช้งาน</label>
                    <input type="radio" name="active"  value="1" <?php echo ( $chk == 1  ? 'checked="checked"' : ''); ?> /> เปิด
                    <input type="radio" name="active" style="margin-left:20px" value="0" 	<?php echo ( $chk == 0 ? 'checked="checked"' : ''); ?>/> ปิด
                </p>
              
              <p>
                  <input class="button" type="submit" value="ยืนยัน" />
              </p>
              
          </fieldset>
          
          <div class="clear"></div>
          
      </form>
 </div>
 