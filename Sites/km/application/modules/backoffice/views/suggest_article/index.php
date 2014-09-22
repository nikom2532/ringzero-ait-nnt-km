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
            <th scope="col" class="rounded">รูปภาพ</th>
            <th scope="col" class="rounded" width="550">บทความ</th>
            <!--<th scope="col" class="rounded">Gallery</th>-->
            <th scope="col" class="rounded" style="text-align:center">สถานะการเผยแพร่</th>
            <th scope="col" class="rounded-q4" style="text-align:center">บทความแนะนำ</th>
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
                                        </td>
                                        <td>
                                        		<b>หัวข้อ :</b> <a href="<?php echo site_url("backoffice/suggest_article/edit/".$row->ATC_id) ?>"><?php echo $row->ATC_title; ?></a><br/>
                                                <br/><b>หมวดหมู่ :</b> <?php echo $categorys[$row->ATC_category_ref]; ?>
                                                <br/><b>วันที่ :</b><?php echo th_date($row->ATC_date->format('Y-m-d'));  ?>
                                                <br/><b>คุณภาพ :</b> <?php echo $row->ATC_quality; ?>
                                        		<br/><b>เข้าชมทั้งหมด :</b> <?php echo $row->ATC_viewall; ?>&nbsp;ครั้ง
                                                <?php echo ($row->ATC_writer != "" ? '<br /><b>บทความอ้างอิง : </b>'.$row->ATC_writer : '') ?>    
                                        </td>
                                        <td style="text-align:center"><?php echo status_announce($row->ATC_status); ?></td>
                                        <td style="text-align:center">
                                        <?php 
                                            $pic = ( $row->ATC_suggest == '1' ?  '<img src="'.site_url('asset/backoffice/images/icons/accepted_24.png').'" />' :  
                                            '<img src="'.site_url('asset/backoffice/images/icons/cancel_24.png').'" />'); 
                                            echo anchor("backoffice/suggest_article/suggest/".$row->ATC_id."/".$row->ATC_suggest,$pic,array('onclick' => 'return active_data()')); 
                                       ?></td>               
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
				
					//$( "#date-start" ).datepicker({ dateFormat: "yy-mm-dd" });
					//$( "#date-end" ).datepicker({ dateFormat: "yy-mm-dd",minDate:mdate() });
					$( "#date-start" ).datepicker({
					  defaultDate: "+1w",
					  changeMonth: true,
					  numberOfMonths: 2,
					  onClose: function( selectedDate ) {
						$( "#date-end" ).datepicker( "option", "minDate", selectedDate );
					  }
					});
					$( "#date-end" ).datepicker({
					  defaultDate: "+1w",
					  changeMonth: true,
					  numberOfMonths: 2,
					  onClose: function( selectedDate ) {
						$( "#date-start" ).datepicker( "option", "maxDate", selectedDate );
					  }
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
								$('#grid').attr('action','<?php echo site_url('backoffice/suggest_article/delete'); ?>');
								$('#grid').submit();
							}
					});
					$('span.order').click(function(){
							if (confirm("คุณต้องการเรียงลำดับข้อมูลหรือไม่ ?")) {
								$('#grid').attr('action','<?php echo site_url('backoffice/suggest_article/order'); ?>');
								$('#grid').submit();
							}
					});
					$('select[name="status"]').change(function(){
							if (confirm("คุณต้องการเปลี่ยนสถานะบทความหรือไม่ ?")) {
								window.location.href = "<?php echo site_url("backoffice/suggest_article/change_status") ?>/"+$(this).data("x1")+"/"+$(this).val()+"/<?php echo str_replace("/","-",current_url()) ?>";
							}else{
								window.location.href = "<?php echo site_url("backoffice/suggest_article") ?>";
							}
					});
			});
			
			function delete_data()
			{
					if(confirm("คุณต้องการลบข้อมูลหรือไม่ ?")){ return true; }else{ 	return false; }
		    }
			function active_data()
			{
					if(confirm("คุณต้องการแนะนำบทความนี้หรือไม่ ?")){ return true; }else{ return false; }
		    }
			function Cpass_data()
			{
					if(confirm("คุณต้องการเปลี่ยนรหัสผ่านหรือไม่ ?")){ return true; }else{ return false; }
			}
			
</script>