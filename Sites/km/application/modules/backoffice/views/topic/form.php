<div class="content-box-header">
	<h3>
    	Create a new <?php echo $this->uri->segment(3) ?>
    </h3>
    <ul style="float: right;padding: 12px 15px 0 0 !important;">
    	<li style="cursor:pointer;background-image: none">
        	Webboard >> <a href="<?php echo site_url('backoffice/webboard'); ?>"><?php echo $webboard->WB_topic; ?></a>
        </li>
    </ul>
    <div class="clear"></div>
</div>
<div class="content-box-content"> 
<?php if(empty($result)): ?>
	<form action="<?php echo site_url('backoffice/topic/save'); ?>" method="post" enctype="multipart/form-data">
<?php else: ?>
	<form action="<?php echo site_url('backoffice/topic/update'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="<?php echo $result->TOP_id; ?>" />
<?php endif; ?>
	<fieldset>    
                  <p>
                      <label>Topic</label>
                          <input class="text-input small-input" type="text" id="topic" name="topic"
                          value="<?php echo (empty($result) ? set_value('topic') : $result->TOP_topic ); ?>" />
                  </p>
                  
                  <p>
                    <?php
                          $chk = 1;
                          if(!empty($result)){
                                $chk = $result->TOP_activated;
                          }
                    ?>
                    <label style="margin-top:10px">Activated</label>
                    <input type="radio" name="active"  value="1" <?php echo ( $chk == 1  ? 'checked="checked"' : ''); ?> />Enable
                    <input type="radio" name="active" style="margin-left:20px" value="0" 	<?php echo ( $chk == 0 ? 'checked="checked"' : ''); ?>/> Disable
                </p>
              
              <p>
                  <input class="button" type="submit" value="Submit" />
              </p>
              
          </fieldset>
          
          <div class="clear"></div>
          
      </form>
 </div>
 