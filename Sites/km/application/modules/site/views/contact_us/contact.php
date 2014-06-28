<?php if(!empty($rows)){ foreach($rows as $row) : endforeach; } ?>   
<div class="content">
                <div class="history">
                    <ul>
                        <li>ติดต่อเรา</li>
                    </ul>
                </div>
                <div id="contactus" class="box-article">
                    <div class="box-article-header">
                        <h2>
                            <img src="<?php echo base_url()."asset/site/"; ?>images/contact-us.png" alt="img">               
                        </h2>
                    </div>
                    <div class="box-article-contents">
                        <div class="box-contactus-detail">
                            <img src="<?php echo base_url()."asset/site/"; ?>images/public-relation-department-logo.png" alt="Logo">
                            <p class="contactus-address"><?php echo $row->ADD_address; ?></p>
                            <div class="row-contactus-number">
                                <div class="contactus-tel">
                                    <label class="highlight  bold">โทรศัพท์</label>
                                    <span><?php echo $row->ADD_tel; ?></span>
                                </div>
                                <div class="contactus-fax">
                                    <label class="highlight  bold">โทรสาร</label>
                                    <span><?php echo $row->ADD_fax; ?></span>
                                </div>
                            </div>
                            <div class="row-contactus-site">
                                <div class="contactus-website">
                                    <label class="highlight  bold">Website : </label>
                                    <a href="<?php echo $row->ADD_web; ?>" title="<?php echo $row->ADD_web; ?>" target="_blank" class="contactus-link"><?php echo $row->ADD_web; ?></a>,
                                </div>
                                <div class="contactus-email">
                                    <label class="highlight  bold">Email : </label>
                                    <a href="mailto:<?php echo $row->ADD_email; ?>" title="<?php echo $row->ADD_email; ?>" class="contactus-link"><?php echo $row->ADD_email; ?></a>
                                </div>
                            </div>

                        </div>
                        <div class="box-contactus">
                            <div class="box-contactus-form">
                                <p class="contactus-msg  highlight  bold">ในกรณีที่ท่านพบปัญหาการใช้งาน หรือต้องการให้คำแนะนำ ติชม กรุณากรอก</p>
                                <p class="contactus-msg  highlight  bold">แบบฟอร์มด้านล่างนี้เพื่อติดต่อเจ้าหน้าที่</p>

                               
                                <form id="contactform" action="<?php echo site_url('site/contact_us/inquiry'); ?>" method="post" class="form-contactus">
                                

                                    <div class="rows">
                                        <label>
                                            <span class="bold">ชื่อ</span>
                                             (Name)</label>
                                        <input type="text" name="formname" id="formname" class="txt-field">
                                        <span class="require">*</span>
                                    </div>
                                    <div class="rows">
                                        <label>
                                            <span class="bold">อีเมล์ติดต่อกลับ</span> 
                                            (Reply Email)</label>
                                        <input type="text" name="formemail" id="formemail" class="txt-field">
                                        <span class="require">*</span>
                                    </div>
                                    <div class="rows">
                                        <label>
                                            <span class="bold">เบอร์โทร</span> 
                                            (Phone)</label>
                                        <input type="text" name="formtel" id="formtel" class="txt-field">
                                        
                                    </div>
                                    <div class="rows">
                                        <label>
                                            <span class="bold">ข้อความ</span> 
                                            (Message)</label>
                                        <textarea name="formtopic" id="formtopic" class="textarea"></textarea><span class="require">*</span>
                                    </div>
                                    <div class="rows">
                                        <div class="cols-right">
                                            
                                             <div id="btcontact" style="display:block"><input type="submit" name="submit" value="" class="bt bt-submit"></div>
                							<div id="loadcontact" style="display:none"><img src="<?php echo site_url('asset/site/images/loading.gif'); ?>"></div>

                                            <p class="require-msg">* ข้อมูลที่จำเป็นต้องกรอก</p>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="box-contactus-maps">
                                <div class="box-maps">
                                	<?php echo (isset($row) ? '<br /><img src="'.site_url('uploads/address/'.$row->ADD_image).'" />' : '') ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div><!-- .box-article-contents -->
                </div><!-- #contact .box-article -->
            </div>
 <script type="text/javascript" src="<?php echo site_url('asset/site/js/jquery.validate.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
  $("#contactform").validate({		
  		rules: {
			formname: {
			  required: true
			},
			formemail: {
			  required: true,
			  email: true
			},
			formtopic: {
			  required: true
			}
		},
			messages: {
			formname: {
			  required: "",
			},
			formtopic: {
			  required: "",
			},
			formemail: {
			  required: "",
			}
		  },
		submitHandler: function() { 
			$('#btcontact').hide();
			$('#loadcontact').show();
			//("hello");
			$.post("<?php echo site_url('site/contact_us/inquiry'); ?>", $("#contactform").serialize(),function(data){
					
					$('#loadcontact').hide();		
					$('#btcontact').show();
					$("#formemail").val("");
					$("#formtel").val("");
					$("#formtopic").val("");
					$("#formname").val("");
					$("#formmessage").val("");
					alert(data);	
					<?php if($this->uri->segment(1)=="en"){ ?>
					alert("Thank you for massage.");						
					<?php }else{ ?>
					alert("ขอบคุณสำหรับข้อมูล");	
					<?php } ?>			
					
			});
		}
	});
});
</script>