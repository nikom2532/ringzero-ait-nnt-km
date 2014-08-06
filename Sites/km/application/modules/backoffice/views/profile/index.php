<div class="content-box-header">
	<h3>
    	ข้อมูลส่วนตัว
    </h3>
    <div class="clear"></div>
</div>
<div class="content-box-content"> 
<table width="100%">
      <tbody>
             <tr>
                     <td height="30">ชื่อ - นามสกุล : <?php echo $row->ACC_name ?></td>
             </tr>
             <tr>
                     <td height="30">ชื่อผู้ใช้งาน : <?php echo $row->ACC_username ?></td>
             </tr>
              <tr>
                     <td height="30">สังกัด : <?php echo $row->ACC_dep1 ?></td>
             </tr>
              <tr>
                     <td height="30">หน่วยงาน : <?php echo $row->ACC_dep2 ?></td>
             </tr>
              <tr>
                     <td height="30">ตำแหน่ง : <?php echo $row->ACC_position ?></td>
             </tr>
              <tr>
                     <td height="30">อีเมลล์ : <?php echo $row->ACC_email ?></td>
             </tr>
             <tr>
                     <td height="30">สิทธิ์การเข้าถึงข้อมูล : <u><b style="font-size:16px"><?php echo $row->ACC_menu ?></b></u></td>
             </tr>
             <tr>
                     <td height="30">เปลี่ยนรหัสผ่าน : <a href="<?php echo site_url('backoffice/profile/change_password/'.$row->ACC_id) ?>">
                     เปลี่ยนรหัสผ่าน</a></td>
             </tr>
             <tr>
                     <td height="30">สถานะการใช้งาน  : 
                         <?php 
                                 echo ( $row->ACC_activated == '1' ?  
								 '<img src="'.site_url('asset/backoffice/images/icons/accepted_24.png').'"   />' :  
                                 '<img src="'.site_url('asset/backoffice/images/icons/cancel_24.png').'"  />'); 
                         ?> 
                     </td>
             </tr>
             <tr>
                     <td height="30">แก้ไขข้อมูลล่าสุด : <?php echo th_date($row->ACC_update->format('Y-m-d H:i:s'));  ?></td>
             </tr>
             <tr>
                     <td height="30">แก้ไขข้อมูลโดย : <?php echo $row->ACC_userupdate ?></td>
             </tr>
     </tbody>
</table>
</div>