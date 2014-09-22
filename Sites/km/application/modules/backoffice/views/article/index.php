<div class="content-box-header">
	<h3>
    	รายการข้อมูล
    </h3>
    <div class="clear"></div>
</div>
<div class="content-box-content"> 
<?php echo form_open('',array('id' => 'grid'));  ?>
<table>
	<thead>
        <tr>
        	<!--<th scope="col" class="rounded-company" width="4%">
			< ?php echo form_checkbox(array('name'=>'chkboxall','id'=>'chkboxall','value'=>'all')); ?></th>
            <th scope="col" class="rounded" style="text-align:center">Order</th>-->
            <th scope="col" class="rounded">รูปภาพ / วิดีโอ</th>
            <th scope="col" class="rounded" width="350">บทความ</th>
            <th scope="col" class="rounded">ตัวอย่าง</th>
            <th scope="col" class="rounded" style="text-align:center" width="100">สถานะการเผยแพร่</th>
            <th scope="col" class="rounded" style="text-align:center" width="70">คำแนะนำ</th>
            <th scope="col" class="rounded" style="text-align:center" width="70">หมายเหตุ</th>
            <th scope="col" class="rounded" style="text-align:center">สถานะการใช้งาน</th>            
            <th scope="col" class="rounded" style="text-align:center" width="150">แก้ไขล่าสุด</th>
            <th scope="col" class="rounded-q4" style="text-align:center">เครื่องมือ</th>
        </tr>
      </thead>
  	<?php
			 if(!empty($rows)){
					 foreach($rows as $row) :
	?>      
    							<tbody>
                                    <tr>
                                        <!--<td>< ?php echo form_checkbox(array('name'=>'chkbox[]','id'=>'chkbox[]','value'=>$row->ATC_id)) ?></td>
                                        <td style="text-align:center">
                                        			<input name="order[]" value="0" class="text" size="3" />
                                        			<input name="keyed[]" type="hidden" value="< ?php echo $row->ATC_id; ?>"/>
                                        </td>-->
                                        <td>
                                        	<img src="<?php echo str_replace(";","",$row->ATC_image); ?>" onerror="this.src='<?php echo site_url('asset/site/images/picDefalt.png'); ?>';" width="150"/>
                                            <?php echo ($row->ATC_video != "" ? '<br />
						  <a href="'.base_url().'uploads/article/video/'.$row->ATC_video.'" style="display:block;width:150px;height:100px;" id="playerflow"></a>' : '') ?>
                                        </td>
                                        <td>
                                        		<?php if(($this->session->userdata('session_user')=="admin")&&$row->ATC_delete==1){ ?>
												<b>สถานะการลบ :</b> <span style="color:#F00; font-size:medium">ถูกลบแล้ว</span> <br/>
												<?php } ?>
												<b>หัวข้อ :</b> <?php echo $row->ATC_title; ?><br/>
                                                <br/><b>หมวดหมู่ :</b> <?php echo $categorys[$row->ATC_category_ref]; ?>
                                                <br/><b>วันที่ :</b><?php echo th_date($row->ATC_date->format('Y-m-d'));  ?>
                                                <br/><b>คุณภาพ :</b> <?php echo $row->ATC_quality; ?>
                                        		<br/><b>เข้าชมทั้งหมด :</b> <?php echo $row->ATC_viewall; ?>&nbsp;ครั้ง
                                                <?php echo ($row->ATC_file != "" ? '<br /><br /><br /><br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<a href="'.base_url().'uploads/article/file/'.$row->ATC_file.'" target="_blank">
												<img src="'.base_url()."asset/backoffice/images/icons/text.png".'" />ไฟล์แนบ</a>' : '') ?> 
                                                <?php echo ($row->ATC_writer != "" ? '<br /><b>บทความอ้างอิง : </b>'.$row->ATC_writer : '') ?>
                                                <?php echo ($row->ATC_suggest != 0 ? '<br /><br /><b>*** บทความแนะนำ ***</b>' : '') ?>                                                      
                                        </td>
                                       	<td><a target="_blank" href="<?php echo site_url('site/article/review/'.$row->ATC_id); ?>">Review</a></td>
                                        <td style="text-align:center"><?php echo status_announce($row->ATC_status); ?></td>
                                        <td style="text-align:center">
											<?php if($row->ATC_comment != ""){ ?>
                                                        <div style="cursor:pointer;color:#9E61A9" class="dialog_video" data-val="<?php echo nl2br($row->ATC_comment); ?>" >
                                                                คำแนะนำ
                                                         </div>
                                                <?php }else{ echo "-"; } ?>
                                        </td>
                                        <td style="text-align:center">
											<?php if($row->ATC_reason != ""){ ?>
                                                        <div style="cursor:pointer;color:#9E61A9" class="dialog_reason" data-val="<?php echo nl2br($row->ATC_reason); ?>" >
                                                                หมายเหตุ
                                                         </div>
                                                <?php }else{ echo "-"; } ?>
                                        </td>
                                        <td style="text-align:center">
                                        <?php 
                                            $pic = ( $row->ATC_activated == '1' ?  '<img src="'.site_url('asset/backoffice/images/icons/accepted_24.png').'" />' :  
                                            '<img src="'.site_url('asset/backoffice/images/icons/cancel_24.png').'" />'); 
                                            echo anchor("backoffice/article/activated/".$row->ATC_id."/".$row->ATC_activated,$pic,array('onclick' => 'return active_data()')); 
                                       ?></td>                                        
                                        <td style="text-align:center">
												<b>วันที่แก้ไขล่าสุด</b><br/><?php echo th_date($row->ATC_update->format('Y-m-d'));  ?><br/>
                                                <br/><br/><b>แก้ไขโดย</b><br/><?php echo $row->ATC_userupdate;  ?><br/>
                                                 <?php if($row->ATC_approve_by != ""){ ?>
                                                <br/><br/><b>ผู้อนุมัติ</b><br/><?php echo $row->ATC_approve_by;  ?><br/><?php } ?>
                                        </td>                                        
                                        <td style="text-align:center">
                                        <?php 
										echo anchor("backoffice/article/edit/".$row->ATC_id,
										"<img src='".site_url('asset/backoffice/images/icons/edit.png')."'/>")."&nbsp;".
										anchor("backoffice/article/delete/".$row->ATC_id,"<img src='".site_url('asset/backoffice/images/icons/delete.png')."'/>",array('onclick' => 'return delete_data()')); ?></td>
                                    </tr>
      <?php 
						endforeach; 
				 }else{
		  				echo "<tr><td colspan='10' style='text-align:center'>ไม่พบข้อมูล</td></tr>";
	 			 }
	 ?>
     	<tfoot>
         <tr>
                <td colspan="10" bgcolor="#FFFFFF">
                <div  class="bulk-actions align-left">
                        <!--<span id="button_small" class="button delete" style="cursor:pointer;">Delete</span>
                        <span id="button_small" class=" button order" style="cursor:pointer;">Sort</span>-->
                </div>
                <?php echo @$pagination;  ?>
                </td>
         </tr>
         </tfoot>
     </tbody>
</table>
</div>
<div id="dialogk" title="คำแนะนำ"></div>
<div id="dialogr" title="หมายเหตุ"></div>
<?php echo form_close();  ?>
<script type="text/javascript">
			$(function(){
				
					$( "#date-start" ).datepicker({ dateFormat: "yy-mm-dd" });
					$( "#date-end" ).datepicker({ dateFormat: "yy-mm-dd" });
				
					$('#dialogk').dialog({
					autoOpen: false,
					width: 400,
					draggable: true,
					resizable: true,
					/*	buttons: {
							"Ok": function() {
								$(this).dialog("close");
							},
							"Cancel": function() {
								$(this).dialog("close");
							}
						}*/
					});
					
					$('#dialogr').dialog({
					autoOpen: false,
					width: 400,
					draggable: true,
					resizable: true,
					/*	buttons: {
							"Ok": function() {
								$(this).dialog("close");
							},
							"Cancel": function() {
								$(this).dialog("close");
							}
						}*/
					});
					
					$(".dialog_video").click(function(){
					  		$('#dialogk').html('<p>'+$(this).data("val")+'</p>');
							$('#dialogk').dialog('open');
					});
				
					$(".dialog_reason").click(function(){
					  		$('#dialogr').html('<p>'+$(this).data("val")+'</p>');
							$('#dialogr').dialog('open');
					});
				
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
				
					$('#chkboxall').change(function(){
								if($('#chkboxall') .attr( 'checked' )){
												$('input[type=checkbox]').attr('checked','checked');
								}else{
												$('input[type=checkbox]').removeAttr('checked')
								}
					});
					$('span.delete').click(function(){
							if (confirm("คุณต้องการลบข้อมูลหรือไม่ ?")) {
								$('#grid').attr('action','<?php echo site_url('backoffice/article/delete'); ?>');
								$('#grid').submit();
							}
					});
					$('span.order').click(function(){
							if (confirm("คุณต้องการเรียงลำดับข้อมูลหรือไม่ ?")) {
								$('#grid').attr('action','<?php echo site_url('backoffice/article/order'); ?>');
								$('#grid').submit();
							}
					});
			});
			
			function delete_data()
			{
					if(confirm("คุณต้องการลบข้อมูลหรือไม่ ?")){ return true; }else{ 	return false; }
		    }
			function active_data()
			{
					if(confirm("คุณต้องการ เปิด/ปิด สถานะการใช้งานหรือไม่ ?")){ return true; }else{ return false; }
		    }
			function Cpass_data()
			{
					if(confirm("คุณต้องการเปลี่ยนรหัสผ่านหรือไม่ ?")){ return true; }else{ return false; }
			}
			
</script>