<div class="content-box-header">
	<h3>
    	ระบบจัดการ<?php echo menu_bof($this->uri->segment(3)) ?>
    </h3>
    <div class="clear"></div>
</div>
<div class="content-box-content"> 
	<fieldset>
    	<table width="100%" cellpadding="1" cellspacing="1" style="border:1px solid #666">
        	<tr>
            	<td width="25%"><?php echo '<b>สถานะการเผยแพร่</b>'; ?></td>
                <td width="75%"><?php echo status_announce($result->ATC_status) ?></td>
            </tr>
            <tr>
            	<td width="25%"><?php echo '<b>ผู้เข้าชมบทความ</b>'; ?></td>
                <td width="75%"><?php echo $result->ATC_viewall; ?></td>
            </tr>
            <tr>
            	<td width="25%"><?php echo '<b>หมวดหมู่บทความ</b>'; ?></td>
                <td width="75%"><?php echo $categorys[$result->ATC_category_ref]; ?></td>
            </tr>
            <tr>
            	<td width="25%"><?php echo '<b>คุณภาพ</b>'; ?></td>
                <td width="75%"><?php echo $result->ATC_quality; ?></td>
            </tr>
            <tr>
            	<td width="25%"><?php echo '<b>รูปภาพ</b>'; ?></td>
                <td width="75%"><img src="<?php echo str_replace(";","",$result->ATC_image); ?>" onerror="this.src='<?php echo site_url('asset/site/images/picDefalt.png'); ?>';" width="150"/></td>
            </tr>
            <tr>
            	<td width="25%"><?php echo '<b>วิดีโอ</b>'; ?></td>
                <td width="75%">
					<?php echo ($result->ATC_video != "" ? '<br />
					<a href="'.base_url().'uploads/article/video/'.$result->ATC_video.'" style="display:block;width:425px;height:300px;" id="playerflow"></a>' : '') ?>
                </td>
            </tr>
            <tr>
            	<td width="25%"><?php echo '<b>ไฟล์</b>'; ?></td>
                <td width="75%">
                	 <?php echo ($result->ATC_file != "" ? 
					 '<a href="'.base_url().'uploads/article/file/'.$result->ATC_file.'" ><img src="'.base_url()."asset/backoffice/images/icons/text.png".'" />ไฟล์แนบ</a>' : '') ?>
                </td>
            </tr>
            <tr>
            	<td width="25%"><?php echo '<b>วันที่</b>'; ?></td>
                <td width="75%"><?php echo th_date($result->ATC_date->format('Y-m-d')); ?></td>
            </tr>
            <tr>
            	<td width="25%"><?php echo '<b>หัวข้อบทความ</b>'; ?></td>
                <td width="75%"><?php echo $result->ATC_title; ?></td>
            </tr>
            <tr>
            	<td width="25%"><?php echo '<b>เกริ่นนำบทความ</b>'; ?></td>
                <td width="75%"><?php echo htmldecode($result->ATC_short_desc); ?></td>
            </tr>
            <tr>
            	<td width="25%"><?php echo '<b>บทความ</b>'; ?></td>
                <td width="75%"><?php echo htmldecode($result->ATC_desc); ?></td>
            </tr>
            <tr>
            	<td width="25%"><?php echo '<b>Tags</b>'; ?></td>
                <td width="75%"><?php echo htmldecode($result->ATC_tag); ?></td>
            </tr>
            <tr>
            	<td width="25%"><?php echo '<b>สถานะการใช้งาน</b>'; ?></td>
                <td width="75%"><?php echo ( $result->ATC_activated == 1  ? 'เปิด' : 'ปิด'); ?></td>
            </tr>
        </table>                  
          </fieldset>
          <div class="clear"></div>
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