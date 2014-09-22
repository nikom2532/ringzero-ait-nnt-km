<div class="content-box-header">
	<h3>
    	รายการข้อมูล
    </h3>
    <div class="clear"></div>
</div>
<div class="content-box-content"> 
<table>
	<thead>
        <tr>
        	<!--<th scope="col" class="rounded-company" width="4%">
			< ?php echo form_checkbox(array('name'=>'chkboxall','id'=>'chkboxall','value'=>'all')); ?></th>
            <th scope="col" class="rounded" style="text-align:center">Order</th>-->
            <th scope="col" class="rounded">ลำดับ</th>
            <th scope="col" class="rounded">รูปภาพ</th>
            <th scope="col" class="rounded" width="350">บทความ</th>
            <!--<th scope="col" class="rounded">Gallery</th>-->
            <th scope="col" class="rounded" style="text-align:center" width="100">สถานะการเผยแพร่</th>
            <th scope="col" class="rounded" style="text-align:center">คำแนะนำ</th>
            <th scope="col" class="rounded" style="text-align:center">สถานะการใช้งาน</th>            
            <th scope="col" class="rounded" style="text-align:center" width="150">แก้ไขล่าสุด</th>
        </tr>
      </thead>
  	<?php
			 if(!empty($rows)){
				 	 $count = 1;
					 foreach($rows as $row) :
	?>      
    							<tbody>
                                    <tr>
                                        <!--<td>< ?php echo form_checkbox(array('name'=>'chkbox[]','id'=>'chkbox[]','value'=>$row->ATC_id)) ?></td>
                                        <td style="text-align:center">
                                        			<input name="order[]" value="0" class="text" size="3" />
                                        			<input name="keyed[]" type="hidden" value="< ?php echo $row->ATC_id; ?>"/>
                                        </td>-->
                                        <td><?php echo $count; ?></td>
                                        <td>
                                        	<img src="<?php echo str_replace(";","",$row->ATC_image); ?>" onerror="this.src='<?php echo site_url('asset/site/images/picDefalt.png'); ?>';" width="150"/>
                                        </td>
                                        <td>
                                        		<b>หัวข้อ :</b> <a href="<?php echo site_url("backoffice/toparticle/edit/".$row->ATC_id) ?>"><?php echo $row->ATC_title; ?></a><br/>
                                                <br/><b>หมวดหมู่ :</b> <?php echo $row->CAT_topic; ?>
                                                <br/><b>วันที่ :</b><?php echo th_date($row->ATC_date->format('Y-m-d'));  ?>
                                                <br/><b>คุณภาพ :</b> <?php echo $row->ATC_quality; ?>
                                        		<br/><b>เข้าชมรายเดือน :</b> <?php echo $row->AM_view; ?>&nbsp;ครั้ง
                                                <?php echo ($row->ATC_writer != "" ? '<br /><b>บทความอ้างอิง : </b>'.$row->ATC_writer : '') ?>    
                                                <?php echo ($row->ATC_suggest != 0 ? '<br /><br /><b>*** บทความแนะนำ ***</b>' : '') ?>  
                                        </td>
                                        <td style="text-align:center"><?php echo status_announce($row->ATC_status); ?></td>
                                         <td style="text-align:center">
											<?php if($row->ATC_comment != ""){ ?>
                                                        <div style="cursor:pointer;color:#9E61A9" class="dialog_video" data-val="<?php echo nl2br($row->ATC_comment); ?>" >
                                                                คำแนะนำ
                                                         </div>
                                                <?php }else{ echo "-"; } ?>
                                        </td>
                                        <td style="text-align:center">
                                        <?php 
                                            $pic = ( $row->ATC_activated == '1' ?  '<img src="'.site_url('asset/backoffice/images/icons/accepted_24.png').'" />' :  
                                            '<img src="'.site_url('asset/backoffice/images/icons/cancel_24.png').'" />'); 
                                            echo $pic; 
                                       ?></td>                                        
                                        <td style="text-align:center">
												<b>วันที่แก้ไขล่าสุด</b><br/><?php echo th_date($row->ATC_update->format('Y-m-d'));  ?><br/>
                                                <br/><b>แก้ไขโดย</b><br/><?php echo $row->ATC_userupdate;  ?><br/>
                                                <?php if($row->ATC_approve_by != ""){ ?>
                                                <br/><b>ผู้อนุมัติ</b><br/><?php echo $row->ATC_approve_by;  ?><br/><?php } ?>
                                        </td>                    
                                    </tr>
      <?php 
	  						 $count++;
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
<?php echo form_close();  ?>
<script type="text/javascript">
			$(function(){
				
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
					
					$(".dialog_video").click(function(){
					  		$('#dialogk').html('<p>'+$(this).data("val")+'</p>');
							$('#dialogk').dialog('open');
					});
			});
			
</script>