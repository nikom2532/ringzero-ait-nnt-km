<div class="content-box-header">
	<h3>
    	ระบบจัดการ<?php echo menu_bof($this->uri->segment(3)) ?>
    </h3>
    <div class="clear"></div>
</div>
<div class="content-box-content"> 
	<form action="<?php echo site_url('backoffice/approve_article/update'); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="<?php echo $result->ATC_id; ?>" />
	<fieldset>
    	<table width="1000" cellpadding="1" cellspacing="1" style="border:1px solid #666">
        	<tr>
            	<td width="250"><?php echo '<b>สถานะการเผยแพร่ ( <font color="#FF0000">***</font> )</b>'; ?></td>
                <td width="750">
					<?php 
						$style2 = 'class="text-input"';
						echo form_dropdown('ATC_status',$status, $result->ATC_status, $style2)
                    ?>
                </td>
            </tr>
            <tr>
            	<td width="250"><?php echo '<b>หมายเหตุ ( <font color="#FF0000">***</font> )</b>'; ?></td>
                <td width="750">
					<?php 
									  $data = array(
											  'name' => 'ATC_reason',
											  'id' => 'ATC_reason',
											  'value' =>  (empty($result) ? set_value('ATC_reason') : set_value('ATC_reason',htmldecode($result->ATC_reason))),
											  'rows'   => '5',
											   'cols'        => '0'
										  );
									  echo form_textarea($data);
									  //echo form_editor($result['id']);
						 ?> 
                </td>
            </tr>
            <tr>
            	<td width="250"><?php echo '<b>ผู้เข้าชมบทความ</b>'; ?></td>
                <td width="750"><?php echo $result->ATC_viewall; ?></td>
            </tr>
            <tr>
            	<td width="250"><?php echo '<b>หมวดหมู่บทความ</b>'; ?></td>
                <td width="750"><?php echo $categorys[$result->ATC_category_ref]; ?></td>
            </tr>
            <tr>
            	<td width="250"><?php echo '<b>คุณภาพ ( <font color="#FF0000">***</font> )</b>'; ?></td>
                <td width="750">
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
                </td>
            </tr>
            <tr>
            	<td width="250"><?php echo '<b>รูปภาพ</b>'; ?></td>
                <td width="750"><?php echo '<img src="'.site_url('uploads/article/image/'.$result->ATC_image).'" width="309" />'; ?></td>
            </tr>
            <tr>
            	<td width="250"><?php echo '<b>วิดีโอ</b>'; ?></td>
                <td width="750">
					<?php echo ($result->ATC_video != "" ? '<br />
					<a href="'.base_url().'uploads/article/video/'.$result->ATC_video.'" style="display:block;width:425px;height:300px;" id="playerflow"></a>' : '') ?>
                </td>
            </tr>
            <tr>
            	<td width="250"><?php echo '<b>ไฟล์</b>'; ?></td>
                <td width="750">
                	 <?php echo ($result->ATC_file != "" ? 
					 '<a href="'.base_url().'uploads/article/file/'.$result->ATC_file.'" ><img src="'.base_url()."asset/backoffice/images/icons/text.png".'" />ไฟล์แนบ</a>' : '') ?>
                </td>
            </tr>
            <tr>
            	<td width="250"><?php echo '<b>วันที่</b>'; ?></td>
                <td width="750"><?php echo th_date($result->ATC_date->format('Y-m-d')); ?></td>
            </tr>
            <tr>
            	<td width="250"><?php echo '<b>หัวข้อบทความ</b>'; ?></td>
                <td width="750"><?php echo $result->ATC_title; ?></td>
            </tr>
            <tr>
            	<td width="250"><?php echo '<b>เกริ่นนำบทความ</b>'; ?></td>
                <td width="750"><?php echo htmldecode($result->ATC_short_desc); ?></td>
            </tr>
            <tr>
            	<td width="250"><?php echo '<b>บทความ</b>'; ?></td>
                <td width="750"><?php echo htmldecode($result->ATC_desc); ?></td>
            </tr>
            <tr>
            	<td width="250"><?php echo '<b>Tags</b>'; ?></td>
                <td width="750"><?php echo htmldecode($result->ATC_tag); ?></td>
            </tr>
            <tr>
            	<td width="250"><?php echo '<b>สถานะการใช้งาน</b>'; ?></td>
                <td width="750">
					<?php
                          $chk = 1;
                          if(!empty($result)){
                                $chk = $result->ATC_activated;
                          }
                    ?>
                    <input type="radio" name="active"  value="1" <?php echo ( $chk == 1  ? 'checked="checked"' : ''); ?> />เปิด
                    <input type="radio" name="active" style="margin-left:20px" value="0" 	<?php echo ( $chk == 0 ? 'checked="checked"' : ''); ?>/> ปิด
                </td>
            </tr>
            <tr><td>&nbsp;</td><td><input class="button" type="submit" value="ยืนยัน" /></td></tr>
        </table>                  
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