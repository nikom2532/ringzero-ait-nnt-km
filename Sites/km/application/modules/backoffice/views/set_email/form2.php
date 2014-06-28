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
                      <?php echo htmldecode($result->SET_email);   ?>
                  </p>
                  </fieldset>
          
          <div class="clear"></div>
     </form>
</div>