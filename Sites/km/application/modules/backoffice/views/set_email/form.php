<div class="content-box-header">
	<h3>
    	ผู้รับผิดชอบการติดต่อ
    </h3>
    <div class="clear"></div>
</div>
<div class="content-box-content"> 
<form action="<?php echo site_url("backoffice/set_email/update"); ?>" method="post">
    		<fieldset>
            	  <p>
                      <label>อีเมลล์ผู้รับผิดชอบการติดต่อ</label>
                      <?php 
                                        $data = array(
                                                'name' => 'email',
                                                'id' => 'email',
                                                'value' =>  (empty($result) ? set_value('email') : set_value('email',$result->SET_email)),
                                                'rows'   => '5',
                                                 'cols'        => '100'
                                            );
                                        echo form_textarea($data);
                                       // echo form_editor($data['id']);
                           ?>
                      <br /><small>ในกรณีที่ต้องการใส่มากกว่าหนึ่งอีเมลล์ให้ใช้เครื่องหมาย "," คั่นในแต่ละอีเมลล์</small>
                  </p>
                  
                 <p>
                      <input class="button" type="submit" value="ยืนยัน" />
                  </p>
                  </fieldset>
          
          <div class="clear"></div>
     </form>
</div>