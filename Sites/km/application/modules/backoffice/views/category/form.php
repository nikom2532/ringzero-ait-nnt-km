<div class="content-box-header">
	<h3>
    	ระบบจัดการ<?php echo menu_bof($this->uri->segment(3)) ?>
    </h3>
    <div class="clear"></div>
</div>
<div class="content-box-content"> 
<?php if(empty($result)): ?>
	<form action="<?php echo site_url('backoffice/category/save'); ?>" method="post" enctype="multipart/form-data">
<?php else: ?>
	<form action="<?php echo site_url('backoffice/category/update'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="<?php echo $result->CAT_id; ?>" />
<?php endif; ?>
	<fieldset>    
                  <p>
                      <label>หมวดหมู่บทความ</label>
                          <input class="text-input small-input" type="text" id="topic" name="topic"
                          value="<?php echo (empty($result) ? set_value('topic') : $result->CAT_topic ); ?>" />
                  </p>
                  
                  <p>
                      <label>ลำดับการเเสดงผล</label>
                          <input class="text-input small-input2" type="text" id="order" name="order"  maxlength="3"
                          value="<?php echo (empty($result) ? 999 : $result->CAT_order ); ?>" />
                  </p>
                  
                  <p>
                    <?php
                          $chk = 1;
                          if(!empty($result)){
                                $chk = $result->CAT_activated;
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
 