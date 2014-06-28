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
			< ?php echo form_checkbox(array('name'=>'chkboxall','id'=>'chkboxall','value'=>'all')); ?></th>-->
            <th scope="col" class="rounded" style="text-align:center">ลำดับ</th>
            <th scope="col" class="rounded" width="300">คำถาม</th>
            <th scope="col" class="rounded" width="300">คำตอบ</th>
            <th scope="col" class="rounded" style="text-align:center">สถานะการใช้งาน</th>
            <th scope="col" class="rounded" style="text-align:center" width="100">แก้ไขข้อมูลล่าสุด</th>
            <th scope="col" class="rounded" style="text-align:center">แก้ไขข้อมูลโดย</th>
            <th scope="col" class="rounded-q4" style="text-align:center">เครื่องมือ</th>
        </tr>
      </thead>
  	<?php
			 if(!empty($rows)){
					 foreach($rows as $row) :
	?>      
    							<tbody>
                                    <tr>
                                        <!--<td>< ?php echo form_checkbox(array('name'=>'chkbox[]','id'=>'chkbox[]','value'=>$row->FAQ_id)) ?></td>-->
                                        <td style="text-align:center">
                                        			<input name="order[]" value="<?php echo $row->FAQ_order; ?>" class="text" size="3" maxlength="3" />
                                        			<input name="keyed[]" type="hidden" value="<?php echo $row->FAQ_id; ?>"/>
                                        </td>
                                        <td><?php echo $row->FAQ_question; ?></td>
                                        <td><?php echo $row->FAQ_answer; ?></td>
                                        <td style="text-align:center">
                                        <?php 
                                            $pic = ( $row->FAQ_activated == '1' ?  '<img src="'.site_url('asset/backoffice/images/icons/accepted_24.png').'" />' :  
                                            '<img src="'.site_url('asset/backoffice/images/icons/cancel_24.png').'" />'); 
                                            echo anchor("backoffice/faq/activated/".$row->FAQ_id."/".$row->FAQ_activated,$pic,array('onclick' => 'return active_data()')); 
                                        ?></td>
                                        <td style="text-align:center"><?php echo th_date($row->FAQ_update->format('Y-m-d H:i:s'));  ?></td>
                                        <td style="text-align:center"><?php echo $row->FAQ_userupdate; ?></td>
                                        <td style="text-align:center">
                                        <?php echo anchor("backoffice/faq/edit/".$row->FAQ_id,
										"<img src='".site_url('asset/backoffice/images/icons/edit.png')."'/>")."&nbsp;".
										anchor("backoffice/faq/delete/".$row->FAQ_id,"<img src='".site_url('asset/backoffice/images/icons/delete.png')."'/>",array('onclick' => 'return delete_data()')); ?></td>
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
                        <!--<span id="button_small" class="button delete" style="cursor:pointer;">Delete</span>-->
                        <span id="button_small" class=" button order" style="cursor:pointer;">เรียงลำดับข้อมูล</span>
                </div>
                <?php echo @$pagination;  ?>
                </td>
         </tr>
         </tfoot>
     </tbody>
</table>
</div>
<?php echo form_close();  ?>
<script type="text/javascript">
			$(function(){
					$('#chkboxall').change(function(){
								if($('#chkboxall') .attr( 'checked' )){
												$('input[type=checkbox]').attr('checked','checked');
								}else{
												$('input[type=checkbox]').removeAttr('checked')
								}
					});
					$('span.delete').click(function(){
							if (confirm("คุณต้องการลบข้อมูลหรือไม่ ?")) {
								$('#grid').attr('action','<?php echo site_url('backoffice/faq/delete'); ?>');
								$('#grid').submit();
							}
					});
					$('span.order').click(function(){
							if (confirm("คุณต้องการเรียงลำดับข้อมูลหรือไม่ ?")) {
								$('#grid').attr('action','<?php echo site_url('backoffice/faq/order'); ?>');
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