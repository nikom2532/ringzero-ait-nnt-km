<div class="content-box-header">
	<h3>
    	Create a <?php echo $this->uri->segment(3) ?>
  </h3>
    <div class="clear"></div>
</div>
<div class="content-box-content"> 
<?php if(empty($result)): ?>
	<form action="<?php echo site_url('backoffice/news/save'); ?>" method="post" enctype="multipart/form-data">
<?php else: ?>
	<form action="<?php echo site_url('backoffice/news/update'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="<?php echo $result->NEWS_id; ?>" />
    <input type="hidden" name="old_pic" id="old_pic" value="<?php echo $result->NEWS_image; ?>" />
    <img src="<?php echo site_url('uploads/news/'.$result->NEWS_image); ?>" />
<?php endif; ?>
	<fieldset>
    			<p>
                      <label>News Image</label>
                          <?php $att=array('name'=>'NEWS_image'); echo form_upload($att);?>
                          <br /><small>Max Size 6MB, File Support:(.jpg, .jpeg, .png, .gif, 164*84px).</small>
                  </p>
    
                  <p>
                      <label>Name</label>
                          <input class="text-input small-input" type="text" id="topic" name="topic"
                          value="<?php echo (empty($result) ? set_value('topic') : $result->NEWS_topic ); ?>" />
                  </p>
                  
                  <p>
                      <label>Description</label>
                          <?php 
                                        $data = array(
                                                'name' => 'desc',
                                                'id' => 'desc',
                                                'value' =>  (empty($result) ? set_value('desc') : set_value('desc',htmldecode($result->NEWS_desc))),
                                                'rows'   => '5',
                                                 'cols'        => '100'
                                            );
                                        echo form_textarea($data);
                                        echo form_editor($data['id']);
                           ?> 
                  </p>      
                  
                  <p>
                    <?php
                          $chk = 1;
                          if(!empty($result)){
                                $chk = $result->NEWS_activated;
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
 