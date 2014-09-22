<div class="content-box-header">
	<h3>
    	ระบบจัดการ<?php echo menu_bof($this->uri->segment(3)) ?>
    </h3>
    <div class="clear"></div>
</div>
<div class="content-box-content"> 
<?php if(empty($result)): ?>
	<form action="<?php echo site_url('backoffice/article/save'); ?>" method="post" enctype="multipart/form-data">
<?php else: ?>
	<form action="<?php echo site_url('backoffice/article/update'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="<?php echo $result->ATC_id; ?>" />
    <input type="hidden" name="old_pic" id="old_pic" value="<?php echo $result->ATC_image; ?>" />
<?php endif; ?>
    <input type="hidden" name="ATC_writer_key" id="ATC_writer_key" value="<?php echo $this->session->userdata('session_accid') ?>" />
	<fieldset>
    			 <p>
				  <?php echo (!empty($result) ? '<label style="margin-top:10px">สถานะการเผยแพร่</label>'.status_announce($result->ATC_status) : "") ?>
                  <input type="hidden" name="ATC_status" id="ATC_status" value="0รอการตรวจสอบ" />
                  </p>
                  
    			<p><?php echo (!empty($result) ? '<label style="margin-top:10px">ผู้เข้าชมบทความ</label>'.$result->ATC_viewall : "") ?></p>
    
    			<p>
                      <label>หมวดหมู่บทความ ( <font color="#FF0000">***</font> )</label>
                      <?php
					$style = 'class="text-input"';
					echo form_dropdown('ATC_category_ref',$categorys, (isset($result)) ? $result->ATC_category_ref : set_value('ATC_category_ref'), $style);
					?>
                  </p>
                  
                  <p>
                      <label>ระดับคุณภาพของบทความ ( <font color="#FF0000">***</font> )</label>
                      <?php
					 $quality = array(
					     '' => '--- กรุณาเลือกคุณภาพของบทความ ---',
					     '1' => '1',
						 '2' => '2',
						 '3' => '3',
						 '4' => '4',
						 '5' => '5',
					 );
					$style = 'class="text-input"';
					echo form_dropdown('ATC_quality',$quality, (isset($result)) ? $result->ATC_quality : set_value('ATC_quality'), $style);
					?>
                  </p>
                 <?php if(isset($newspic)){ ?>
    			<p>
                <?php //echo $newspic[$ref->N_id]; ?>
                <img src="<?php echo $newspic[$ref->N_id]; ?>" onerror="this.src='<?php echo site_url('asset/site/images/picDefalt.png'); ?>';" width="151" height="95"></p>
    			<input type="hidden" name="refpic" id="refpic" value="<?php echo $newspic[$ref->N_id]; ?>" />
				<?php } ?>
                <p>
                      <label>รูปภาพ ( <font color="#FF0000">***</font> )</label>
                          <?php $att=array('name'=>'ATC_image'); echo form_upload($att);?>
                          <br /><small>ขนาดไฟล์ไม่เกิน 2 MB, รองรับไฟล์นามสกุล (.jpg, .jpeg, .png, .gif ) ขนาดแนะนำ 309*179px.</small>
                          <?php echo (isset($result) ? '<br /><img src="'.str_replace(";","",$result->ATC_image).'" onerror="this.src='.site_url('asset/site/images/picDefalt.png').'" width="150"/>' : '') ?>
                  </p>
                  
                  <p>
                      <label>วิดีโอ</label>
                          <?php $att2=array('name'=>'ATC_video'); echo form_upload($att2);?>
                          <br />
                          <small>ขนาดไฟล์ไม่เกิน 32 MB, รองรับไฟล์นามสกุล (.mp4, .flv )</small>
                          <br />
                          <?php echo (isset($result) ? ($result->ATC_video != "" ? '<br />
						  <a href="'.base_url().'uploads/article/video/'.$result->ATC_video.'" style="display:block;width:425px;height:300px;" id="playerflow"></a>' : '') : ''); ?>
                  </p>
                  
                  <p>
                      <label>ไฟล์</label>
                          <?php $att3=array('name'=>'ATC_file'); echo form_upload($att3);?>
                          <br /><small>ขนาดไฟล์ไม่เกิน 2 MB, รองรับไฟล์นามสกุล (.pdf,doc,docx,xls,xlsx) </small>
                          <?php echo (isset($result) ? ($result->ATC_file != "" ? '<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  <a href="'.base_url().'uploads/article/file/'.$result->ATC_file.'" ><img src="'.base_url()."asset/backoffice/images/icons/text.png".'" />ไฟล์แนบ</a>' : '') : ''); ?>
                  </p>
    			 
                 <p>
                      <label>วันที่ ( <font color="#FF0000">***</font> )</label>
                          <input class="text-input small-input2" type="text" id="ATC_date" name="ATC_date"
                          value="<?php echo (empty($result) ? date("Y-m-d") : $result->ATC_date->format('Y-m-d') ); ?>" />
                  </p>
                 
                  
                  <?php if(!empty($ref)){ ?>
                  		<p>
                      <label>หัวข้อบทความ ( <font color="#FF0000">***</font> )</label>
                          <input class="text-input small-input" type="text" id="ATC_title" name="ATC_title"
                          value="<?php echo (empty($ref) ? set_value('ATC_title') : $ref->N_title ); ?>" />
                          </p>
                          <p>
                      <label>เกริ่นนำบทความ ( <font color="#FF0000">***</font> )</label>
                          <?php 
                                        $data = array(
                                                'name' => 'ATC_short_desc',
                                                'id' => 'ATC_short_desc',
                                                'value' =>  (empty($ref) ? set_value('ATC_short_desc') : set_value('ATC_short_desc',substr($ref->N_desc,19))),
                                                'rows'   => '5',
                                                 'cols'        => '100'
                                            );
                                        echo form_textarea($data);
                                        //echo form_editor($result['id']);
                           ?> 
                  </p>  
                  
                  <p>
                      <label>บทความ ( <font color="#FF0000">***</font> )</label>
                          <?php 
                                        $data = array(
                                                'name' => 'ATC_desc',
                                                'id' => 'ATC_desc',
                                                'value' =>  (empty($ref) ? set_value('ATC_desc') : set_value('ATC_desc',htmldecode($ref->N_short_desc))),
                                                'rows'   => '5',
                                                 'cols'        => '100'
                                            );
                                        echo form_textarea($data);
                                        echo form_editor($data['id']);
                           ?> 
                  </p> 
                  <p>
                      <label>ผู้เขียนข่าว</label>
                          <input class="text-input small-input" type="text" id="ATC_writer_ref" name="ATC_writer_ref"
                          value="<?php echo (empty($ref) ? set_value('ATC_writer_ref') : $ref->N_writer ); ?>" readonly="readonly" />
                          </p>
                          <p>
                      <label>รหัสข่าว </label>
                          <input class="text-input small-input" type="text" id="ATC_news_ref" name="ATC_news_ref"
                          value="<?php echo (empty($ref) ? set_value('ATC_news_ref') : $ref->N_id ); ?>"  readonly="readonly"/>
                          </p>
                   <?php }else{ ?>
                   <p>
                      <label>หัวข้อบทความ ( <font color="#FF0000">***</font> )</label>
                          <input class="text-input small-input" type="text" id="ATC_title" name="ATC_title"
                          value="<?php echo (empty($result) ? set_value('ATC_title') : $result->ATC_title ); ?>" />
                          </p>
                          <p>
                      <label>เกริ่นนำบทความ ( <font color="#FF0000">***</font> )</label>
                          <?php 
                                        $data = array(
                                                'name' => 'ATC_short_desc',
                                                'id' => 'ATC_short_desc',
                                                'value' =>  (empty($result) ? set_value('ATC_short_desc') : set_value('ATC_short_desc',htmldecode($result->ATC_short_desc))),
                                                'rows'   => '5',
                                                 'cols'        => '100'
                                            );
                                        echo form_textarea($data);
                                        //echo form_editor($result['id']);
                           ?> 
                  </p>  
                  
                  <p>
                      <label>บทความ ( <font color="#FF0000">***</font> )</label>
                          <?php 
                                        $data = array(
                                                'name' => 'ATC_desc',
                                                'id' => 'ATC_desc',
                                                'value' =>  (empty($result) ? set_value('ATC_desc') : set_value('ATC_desc',htmldecode($result->ATC_desc))),
                                                'rows'   => '5',
                                                 'cols'        => '100'
                                            );
                                        echo form_textarea($data);
                                        echo form_editor($data['id']);
                           ?> 
                  </p>      
                   <?php } ?>
                  <?php if(!empty($result)){ ?>
                  
                  <p>
                      <label>บทความอ้างอิงจาก</label>
                          <input class="text-input small-input" type="text" id="ATC_writer_ref" name="ATC_writer_ref"
                          value="<?php echo $result->ATC_writer_ref; ?>" readonly="readonly" />
                          </p>
                          <p>
                      <label>รหัสข่าว </label>
                          <input class="text-input small-input" type="text" id="ATC_news_ref" name="ATC_news_ref"
                          value="<?php echo $result->ATC_news_ref; ?>"  readonly="readonly"/>
                          </p>
                  <?php } ?>
                  <p>
                      <label>Tags </label>
                          <?php 
                                        $data = array(
                                                'name' => 'ATC_tag',
                                                'id' => 'ATC_tag',
                                                'value' =>  (empty($result) ? set_value('ATC_tag') : set_value('ATC_tag',htmldecode($result->ATC_tag))),
                                                'rows'   => '5',
                                                 'cols'        => '100'
                                            );
                                        echo form_textarea($data);
                                        //echo form_editor($result['id']);
                           ?> 
                  </p>[ ในกรณีที่ต้องการใส่มากกว่าหนึ่งคำค้นให้ใช้เครื่องหมาย "," คั่นในแต่ละคำ เช่น กีฬา,เรือใบ,ชิงแชมป์โลก  ]
                  
                  <p>
                    <?php
                          $chk = 1;
                          if(!empty($result)){
                                $chk = $result->ATC_activated;
                          }
                    ?>
                    <label style="margin-top:10px">สถานะการใช้งาน</label>
                    <input type="radio" name="active"  value="1" <?php echo ( $chk == 1  ? 'checked="checked"' : ''); ?> />เปิด
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
					$( "#ATC_date" ).datepicker({ dateFormat: "yy-mm-dd" });
			
			
					  flowplayer("playerflow", "<?php echo base_url()."asset/flowplayer/" ?>flowplayer-3.2.16.swf", {
						key:'#$1972f2c4512bcba9deb',
						plugins: {
							/*'viral': {
								'url': 'flowplayer.viralvideos-3.2.13.swf',
								'share': {
									'description': 'Extreme surfers riding big waves'
								}
							},*/
							controls: {
								'url': '<?php echo base_url()."asset/flowplayer/" ?>flowplayer.controls-3.2.15.swf',
								backgroundColor: "transparent",
								backgroundGradient: "none",
								sliderColor: '#FFFFFF',
								sliderBorder: '1.5px solid rgba(160,160,160,0.7)',
								volumeSliderColor: '#FFFFFF',
								volumeBorder: '1.5px solid rgba(160,160,160,0.7)',
					 
								timeColor: '#ffffff',
								durationColor: '#535353',
					 
								tooltipColor: 'rgba(255, 255, 255, 0.7)',
								tooltipTextColor: '#000000'
							}
						},
						clip: {
							autoPlay: false,
							autoBuffering: true,
							start:0,
							duration:0,
						}/*,
						logo: {
							opacity:1,
							left:20,
							url:'http://morning-news.bectero.com/image/logo-bectero.png',
							fullscreenOnly:false,
							top:20
						}*/
					 
					});
			});
    </script>