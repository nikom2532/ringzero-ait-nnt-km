<div class="content-box-header">
	<h3>
    	List of data
    </h3>
    <ul style="float: right;padding: 12px 15px 0 0 !important;">
    	<li style="cursor:pointer;background-image: none">
        	Webboard >> <a href="<?php echo site_url('backoffice/webboard'); ?>"><?php echo $webboard->WB_topic; ?></a>
        </li>
    </ul>
    <div class="clear"></div>
</div>
<div class="content-box-content"> 
<?php echo form_open('',array('id' => 'grid'));  ?>
<table>
	<thead>
        <tr>
        	<th scope="col" class="rounded-company" width="4%">
			<?php echo form_checkbox(array('name'=>'chkboxall','id'=>'chkboxall','value'=>'all')); ?></th>
            <!--<th scope="col" class="rounded" style="text-align:center">Order</th>-->
            <th scope="col" class="rounded" width="250">Topic</th>
            <th scope="col" class="rounded">Comment</th>
            <th scope="col" class="rounded" style="text-align:center">Activated</th>
            <th scope="col" class="rounded" style="text-align:center" width="100">Last Update</th>
            <th scope="col" class="rounded" style="text-align:center">Last Update by</th>
            <th scope="col" class="rounded-q4" style="text-align:center">Tool</th>
        </tr>
      </thead>
  	<?php
			 if(!empty($rows)){
					 foreach($rows as $row) :
	?>      
    							<tbody>
                                    <tr>
                                        <td><?php echo form_checkbox(array('name'=>'chkbox[]','id'=>'chkbox[]','value'=>$row->TOP_id)) ?></td>
                                        <td><?php echo $row->TOP_topic; ?></td>
                                        <td><a href="<?php echo site_url('backoffice/comment/index/'.$row->TOP_id); ?>">Comment</a></td>
                                        <td style="text-align:center">
                                        <?php 
                                            $pic = ( $row->TOP_activated == '1' ?  '<img src="'.site_url('asset/backoffice/images/icons/accepted_24.png').'" />' :  
                                            '<img src="'.site_url('asset/backoffice/images/icons/cancel_24.png').'" />'); 
                                            echo anchor("backoffice/topic/activated/".$row->TOP_id."/".$row->TOP_activated,$pic,array('onclick' => 'return active_data()')); 
                                        ?></td>
                                        <td style="text-align:center"><?php echo  en_date($row->TOP_update); ?></td>
                                        <td style="text-align:center"><?php echo $row->TOP_userupdate; ?></td>
                                        <td style="text-align:center">
                                        <?php echo anchor("backoffice/topic/edit/".$row->TOP_id,
										"<img src='".site_url('asset/backoffice/images/icons/edit.png')."'/>")."&nbsp;".
										anchor("backoffice/topic/delete/".$row->TOP_id,"<img src='".site_url('asset/backoffice/images/icons/delete.png')."'/>",array('onclick' => 'return delete_data()')); ?></td>
                                    </tr>
      <?php 
						endforeach; 
				 }else{
		  				echo "<tr><td colspan='7' style='text-align:center'>Data not found.</td></tr>";
	 			 }
	 ?>
     	<tfoot>
         <tr>
                <td colspan="10" bgcolor="#FFFFFF">
                <div  class="bulk-actions align-left">
                        <span id="button_small" class="button delete" style="cursor:pointer;">Delete</span>
                        <!--<span id="button_small" class=" button order" style="cursor:pointer;">&nbsp;Sort&nbsp;&nbsp;</span>-->
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
							if (confirm("Do you want to delete the data or not ?")) {
								$('#grid').attr('action','<?php echo site_url('backoffice/topic/delete'); ?>');
								$('#grid').submit();
							}
					});
					$('span.order').click(function(){
							if (confirm("Do you want to sort the data or not ?")) {
								$('#grid').attr('action','<?php echo site_url('backoffice/topic/order'); ?>');
								$('#grid').submit();
							}
					});
			});
			function delete_data()
			{
					if(confirm("Do you want to delete the data or not ? ?")){ return true; }else{ 	return false; }
		    }
			function active_data()
			{
					if(confirm("Do you want to enble/disable or not ?")){ return true; }else{ return false; }
		    }
			function Cpass_data()
			{
					if(confirm("Do you want to change the password or not ?")){ return true; }else{ return false; }
			}
</script>