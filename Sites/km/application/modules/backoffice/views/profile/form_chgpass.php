<div class="content-box-header">
	<h3>
    	เปลี่ยนรหัสผ่าน
    </h3>
    <div class="clear"></div>
</div>
<div class="content-box-content"> 
<form action="<?php echo site_url("backoffice/profile/save_password"); ?>" method="post">
    <input type="hidden" name="id" id="id" value="<?php echo $key; ?>" />
    		<fieldset>
            	  <p>
                      <label>รหัสผ่านเก่า</label>
                      <input class="text-input small-input" type="password" name="old-password" />
                      <br /><small>กรุณากรอกข้อมูลเป็นภาษาอังกฤษหรือตัวเลข 6-15 ตัวอักษร</small>
                  </p>
            
    			  <p>
                      <label>รหัสผ่านใหม่</label>
                      <input class="text-input small-input" type="password" name="password" />
                      <br /><small>กรุณากรอกข้อมูลเป็นภาษาอังกฤษหรือตัวเลข 6-15 ตัวอักษร</small>
                  </p>
                  
                  <p>
                      <label>ยืนยันรหัสผ่านใหม่</label>
                          <input class="text-input small-input" type="password"  name="confirm-password" />
                  </p>
                 <p>
                      <input class="button" type="submit" value="ยืนยัน" />
                  </p>
                  </fieldset>
          
          <div class="clear"></div>
     </form>
</div>