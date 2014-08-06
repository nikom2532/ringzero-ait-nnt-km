<?php
								echo "<div style='width:100%;text-align:right'>";
								echo form_open('backoffice/'.$this->uri->segment(3).'/search');
								
								$style2 = 'class="text-input"';
								echo "ปี ".form_dropdown('year_toparticle',$years, $this->session->userdata("year_toparticle"), $style2);
								
								$style2 = 'class="text-input"';
								echo "เดือน ".form_dropdown('month_toparticle',$months, $this->session->userdata("month_toparticle"), $style2);

								echo '<input type="submit" class="button" name="submit" value="ค้นหา" />';
								echo form_close(); 
								echo "</div>".br(1); 
?>