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
            <th scope="col" class="rounded" width="190">ผู้ติดต่อ</th>         
            <th scope="col" class="rounded">อ่านข้อความ</th>
            <th scope="col" class="rounded" style="text-align:center" width="100">วันที่ส่งข้อความ</th>
        </tr>
      </thead>
  	<?php
			 if(!empty($rows)){
					 foreach($rows as $row) :
	?>      
    							<tbody>
                                    <tr>
                                        <!--<td>< ?php echo form_checkbox(array('name'=>'chkbox[]','id'=>'chkbox[]','value'=>$row->CONT_id)) ?></td>
                                        <td style="text-align:center">
                                        			<input name="order[]" value="0" class="text" size="3" />
                                        			<input name="keyed[]" type="hidden" value="< ?php echo $row->CONT_id; ?>"/>
                                        </td>-->
                                        <td><?php echo $row->CONT_name.br(1).'('.$row->CONT_email; ?>)</td>                                       
                                        <td>
                                       			 <div style="cursor:pointer" id="dialog_torry" data-x1="<?php echo $row->CONT_name; ?>" data-x2="<?php echo $row->CONT_email; ?>"
                                                  data-x3="<?php echo $row->CONT_tel; ?>"  data-x4="<?php echo $row->CONT_message; ?>" >
                                                 		อ่านข้อความ
                                                 </div>
                                        </td>
                                        <td style="text-align:center"><?php echo th_date($row->CONT_add->format('Y-m-d H:i:s'));  ?></td>
                                    </tr>
      <?php 
						endforeach; 
				 }else{
		  				echo "<tr><td colspan='6' style='text-align:center'>ไม่พบข้อมูล</td></tr>";
	 			 }
	 ?>
     	<tfoot>
         <tr>
                <td colspan="6" bgcolor="#FFFFFF">
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
<div id="dialog" title="Messages"></div>
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
								$('#grid').attr('action','<?php echo site_url('backoffice/contact_us/delete'); ?>');
								$('#grid').submit();
							}
					});
					$('span.order').click(function(){
							if (confirm("คุณต้องการเรียงลำดับข้อมูลหรือไม่ ?")) {
								$('#grid').attr('action','<?php echo site_url('backoffice/contact_us/order'); ?>');
								$('#grid').submit();
							}
					});
					
					$('#dialog').dialog({
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
					
					$("#dialog_torry").click(function(){
					  		$('#dialog').html('<p>ชื่อ : '+$(this).data("x1")+'<br>อีเมล์ติดต่อกลับ : '+$(this).data("x2")+'<br>เบอร์โทร : '+$(this).data("x3")+'<br>'+$(this).data("x4")+'</p>');
							$('#dialog').dialog('open');
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