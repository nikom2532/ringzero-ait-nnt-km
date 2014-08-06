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
           <?php /*?> <th scope="col" class="rounded">รูปภาพ</th><?php */?>
            <th scope="col" class="rounded" width="90%">บทความ</th>
            <!--<th scope="col" class="rounded">Gallery</th>-->
           <?php /*?> <th scope="col" class="rounded" style="text-align:center" width="100">สถานะการเผยแพร่</th>
            <th scope="col" class="rounded" style="text-align:center">สถานะการใช้งาน</th>            
            <th scope="col" class="rounded" style="text-align:center" width="150">แก้ไขล่าสุด</th><?php */?>
            <th scope="col" class="rounded-q4" style="text-align:center">ดูรายละเอียด</th>
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
                                        		<b>หัวข้อ :</b> <?php echo $row->N_title; ?><br/>
                                                <br/><b>ผู้เขียน :</b> <?php echo $row->N_writer;  ?>
                                                <br/><b>วันที่ :</b><?php echo th_date($row->N_date->format('Y-m-d'));  ?>
                                        		<br/><b>เข้าชมทั้งหมด :</b> <?php echo $row->N_Views; ?>&nbsp;ครั้ง<br />
												รายละเอียด <br />
												<?php echo htmldecode(iconv_substr(nl2br($row->N_desc),0,400, "UTF-8")); ?>...
                                                <a href="<?php echo site_url('site/news/detail/'.$row->N_id); ?>" target="_blank">อ่านต่อ</a>
                                        </td>
                                       <?php /*?> <td style="text-align:center"><?php echo status_announce($row->ATC_status); ?></td>
                                        <td style="text-align:center">
                                        <?php 
                                            $pic = ( $row->ATC_activated == '1' ?  '<img src="'.site_url('asset/backoffice/images/icons/accepted_24.png').'" />' :  
                                            '<img src="'.site_url('asset/backoffice/images/icons/cancel_24.png').'" />'); 
                                            echo anchor("backoffice/approve_article/activated/".$row->ATC_id."/".$row->ATC_activated,$pic,array('onclick' => 'return active_data()')); 
                                       ?></td>                                        
                                        <td style="text-align:center">
												<b>วันที่แก้ไขล่าสุด</b><br/><?php echo th_date($row->ATC_update->format('Y-m-d'));  ?><br/>
                                                <br/><b>แก้ไขโดย</b><br/><?php echo $row->ATC_userupdate;  ?><br/>
                                                <?php if($row->ATC_approve_by != ""){ ?>
                                                <br/><b>ผู้อนุมัติ</b><br/><?php echo $row->ATC_approve_by;  ?><br/><?php } ?>
                                        </td>                 <?php */?>                       
                                        <!--<td style="text-align:center">
                                        < ?php 
													$style2 = 'class="text-input" data-x1="'.$row->ATC_id.'" ';
													echo form_dropdown('status',$status2, substr($row->ATC_status,0,1), $style2)
                                		?>
                                		</td>-->
                                        <td align="center" width="10%"><center><a href="<?php echo site_url('backoffice/article/create/ref/'.$row->N_id); ?>">เลือก</a></center></td>
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
<?php echo form_close();  ?>
<script type="text/javascript">
			$(function(){
				
					$( "#date-start" ).datepicker({ dateFormat: "yy-mm-dd" });
					$( "#date-end" ).datepicker({ dateFormat: "yy-mm-dd" });
				
					$('#chkboxall').change(function(){
								if($('#chkboxall') .attr( 'checked' )){
												$('input[type=checkbox]').attr('checked','checked');
								}else{
												$('input[type=checkbox]').removeAttr('checked')
								}
					});
					$('span.delete').click(function(){
							if (confirm("คุณต้องการลบข้อมูลหรือไม่ ?")) {
								$('#grid').attr('action','<?php echo site_url('backoffice/approve_article/delete'); ?>');
								$('#grid').submit();
							}
					});
					$('span.order').click(function(){
							if (confirm("คุณต้องการเรียงลำดับข้อมูลหรือไม่ ?")) {
								$('#grid').attr('action','<?php echo site_url('backoffice/approve_article/order'); ?>');
								$('#grid').submit();
							}
					});
					$('select[name="status"]').change(function(){
							if (confirm("คุณต้องการเปลี่ยนสถานะบทความหรือไม่ ?")) {
								window.location.href = "<?php echo site_url("backoffice/approve_article/change_status") ?>/"+$(this).data("x1")+"/"+$(this).val()+"/<?php echo str_replace("/","-",current_url()) ?>";
							}else{
								window.location.href = "<?php echo site_url("backoffice/approve_article") ?>";
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