<div class="content-box-header">
	<h3>
    	ระบบจัดการ<?php echo menu_bof($this->uri->segment(3)) ?>
    </h3>
    <div class="clear"></div>
</div>
<div class="content-box-content"> 
<?php if(empty($result)): ?>
	<form action="<?php echo site_url('backoffice/account/save'); ?>" method="post">
<?php else: ?>
	<form action="<?php echo site_url('backoffice/account/update'); ?>" method="post">
    <input type="hidden" name="id" id="id" value="<?php echo $result->ACC_id; ?>" />
<?php endif; ?>
	<fieldset>
			 <?php if(empty($result)){ ?>
                  <p>
                      <label>ชื่อผู้ใช้งาน ( <font color="#FF0000">***</font> )</label>
                          <input class="text-input small-input" type="text" id="username" name="username"/>
                          <!--<span class="input-notification success png_bg">Successful message</span>-->
                          <br /><small>กรุณากรอกข้อมูลเป็นภาษาอังกฤษหรือตัวเลข 5-15 ตัวอักษร</small>
                  </p>
                  
                  <p>
                      <label>รหัสผ่าน ( <font color="#FF0000">***</font> )</label>
                      <input class="text-input small-input" type="password" name="password" />
                      <br />
                      <small>กรุณากรอกข้อมูลเป็นภาษาอังกฤษหรือตัวเลข 6-15 ตัวอักษร</small>
                  </p>
                  
                  <p>
                      <label>ยืนยันรหัสผ่าน ( <font color="#FF0000">***</font> )</label>
                          <input class="text-input small-input" type="password"  name="confirm-password" />
                  </p>
              <?php }else{ ?>  
                    <p>
                      <label>ชื่อผู้ใช้งาน</label>
                          <h3><?php echo $result->ACC_username; ?></h3>
                   </p>  
              <?php } ?>
              
              <p>
                  <label>ชื่อ - นามสกุล ( <font color="#FF0000">***</font> )</label>
                      <input class="text-input small-input" type="text"  name="name" 
                      value="<?php echo (empty($result) ? set_value('name') : $result->ACC_name ); ?>" />
              </p>
 <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->            
			<p>
                  <label>สังกัด ( <font color="#FF0000">***</font> )</label>
                      <input class="text-input small-input" type="text"  name="ACC_dep1" 
                      value="<?php echo (empty($result) ? set_value('ACC_dep1') : $result->ACC_dep1 ); ?>" />
              </p>
              
              <p>
                  <label>หน่วยงาน ( <font color="#FF0000">***</font> )</label>
                      <input class="text-input small-input" type="text"  name="ACC_dep2" 
                      value="<?php echo (empty($result) ? set_value('ACC_dep2') : $result->ACC_dep2 ); ?>" />
              </p>
              
              <p>
                  <label>ตำแหน่ง ( <font color="#FF0000">***</font> )</label>
                      <input class="text-input small-input" type="text"  name="ACC_position" 
                      value="<?php echo (empty($result) ? set_value('ACC_position') : $result->ACC_position ); ?>" />
              </p>
              
              <p>
                  <label>อีเมลล์ ( <font color="#FF0000">***</font> )</label>
                      <input class="text-input small-input" type="text"  name="ACC_email" 
                      value="<?php echo (empty($result) ? set_value('name') : $result->ACC_email ); ?>" />
              </p>
              
            <p>
                  <label>สิทธิ์การเข้าถึงข้อมูล ( <font color="#FF0000">***</font> )</label>
                  		<span style="width:80%;margin-bottom:35px">
                        <span style="width:100%;float:left;padding:5px"><input type="checkbox" id="chkboxall" value="" /> ทั้งหมด</span>
                        <span style="width:23%;float:left;padding:5px"><input type="checkbox" name="menu_chk[]" value="ผู้ดูแลระบบ" 
                        <?php 
							 if(!empty($result)){
                                echo (in_array("ผู้ดูแลระบบ",explode(",",$result->ACC_menu)) ? ' checked="checked"' : ''); 
							 }
                        ?>
                        />	 ผู้ดูแลระบบ </span>
                        
                        <span style="width:23%;float:left;padding:5px"><input type="checkbox" name="menu_chk[]" value="สมาชิก" 
                        <?php 
							 if(!empty($result)){
                                echo (in_array("สมาชิก",explode(",",$result->ACC_menu)) ? ' checked="checked"' : ''); 
							 }
                        ?>
                        />	 สมาชิก </span>
                        
                        
                        <span style="width:23%;float:left;padding:5px"><input type="checkbox" name="menu_chk[]" value="ผู้เชี่ยวชาญ" 
                        <?php 
							 if(!empty($result)){
                                echo (in_array("ผู้เชี่ยวชาญ",explode(",",$result->ACC_menu)) ? ' checked="checked"' : ''); 
							 }
                        ?>
                        />	 ผู้เชี่ยวชาญ </span>
                        
                  </span>
             </p>
              <div class="clear"></div>
 <!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->             
              <p>
        		<?php
					  $chk = 1;
				      if(!empty($result)){
						    $chk = $result->ACC_activated;
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
 <script type="text/javascript">
			$(function(){				
					$('#chkboxall').change(function(){
								if($('#chkboxall') .attr( 'checked' )){
												$('input[type=checkbox]').attr('checked','checked');
								}else{
												$('input[type=checkbox]').removeAttr('checked')
								}
					});
			});
</script>