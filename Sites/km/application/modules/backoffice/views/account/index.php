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
            <th scope="col" class="rounded" width="300">ผู้ใช้งาน</th>
            <th scope="col" class="rounded" width="200">สิทธิ์การเข้าถึงข้อมูล</th>
            <th scope="col" class="rounded" style="text-align:center" width="100">เปลี่ยนรหัสผ่าน</th>
            <th scope="col" class="rounded" style="text-align:center">สถานะการใช้งาน</th>
            <th scope="col" class="rounded" style="text-align:center" >แก้ไขข้อมูลล่าสุด</th>
            <th scope="col" class="rounded" style="text-align:center" width="100">แก้ไขข้อมูลโดย</th>
            <th scope="col" class="rounded-q4" style="text-align:center" width="30">เครื่องมือ</th>
        </tr>
      </thead>
  	<?php
			 if(!empty($rows)){
					 foreach($rows as $row) :
	?>      
    							<tbody>
                                    <tr>
                                        <!--<td>< ?php echo form_checkbox(array('name'=>'chkbox[]','id'=>'chkbox[]','value'=>$row->ACC_id)) ?></td>-->
                                        <td>
                                        		<b>ชื่อผู้ใช้งาน : </b><?php echo $row->ACC_username; ?><br/>
                                                <b>ชื่อ - นามสกุล : </b><?php echo $row->ACC_name; ?><br/>
                                                <b>สังกัด : </b><?php echo $row->ACC_dep1; ?><br/>
                                                <b>หน่วยงาน : </b><?php echo $row->ACC_dep2; ?><br/>
                                                <b>ตำแหน่ง : </b><?php echo $row->ACC_position; ?><br/>
                                                <b>อีเมลล์ : </b><?php echo $row->ACC_email; ?><br/>
                                        </td>
                                        <td><?php echo $row->ACC_menu; ?> </td>
                                       <td style="text-align:center">
                                       <a href="<?php echo site_url('backoffice/account/change_password/'.$row->ACC_id); ?>">เปลี่ยนรหัสผ่าน</a></td>
                                        <td style="text-align:center">
                                        <?php 
                                            $pic = ( $row->ACC_activated == '1' ?  '<img src="'.site_url('asset/backoffice/images/icons/accepted_24.png').'" />' :  
                                            '<img src="'.site_url('asset/backoffice/images/icons/cancel_24.png').'" />'); 
                                            echo anchor("backoffice/account/activated/".$row->ACC_id."/".$row->ACC_activated,$pic,array('onclick' => 'return active_data()')); 
                                        ?></td>
                                        <td style="text-align:center"><?php echo th_date($row->ACC_update->format('Y-m-d'));  ?></td>
                                        <td style="text-align:center"><?php echo $row->ACC_userupdate; ?></td>
                                        <td style="text-align:center">
                                        <?php echo anchor("backoffice/account/edit/".$row->ACC_id,
										"<img src='".site_url('asset/backoffice/images/icons/edit.png')."'/>")."&nbsp;".
										anchor("backoffice/account/delete/".$row->ACC_id,"<img src='".site_url('asset/backoffice/images/icons/delete.png')."'/>",array('onclick' => 'return delete_data()')); ?></td>
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
								$('#grid').attr('action','<?php echo site_url('backoffice/account/delete'); ?>');
								$('#grid').submit();
							}
					});
					$('span.order').click(function(){
							if (confirm("คุณต้องการเรียงลำดับข้อมูลหรือไม่ ?")) {
								$('#grid').attr('action','<?php echo site_url('backoffice/account/order'); ?>');
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