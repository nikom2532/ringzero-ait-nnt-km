<?php
								echo "<div style='width:100%;text-align:right'>";
								echo form_open('backoffice/'.$this->uri->segment(3).'/search'); 
								echo "ค้นหา : ".form_input('search', ($this->session->userdata("search_".$this->uri->segment(3)) =="" ? set_value('search') : $this->session->userdata("search_".$this->uri->segment(3)) ))."&nbsp;";
								echo "&nbsp;&nbsp;&nbsp;หมวดหมู่บทความ : ";
								
								$style = 'class="text-input"';
								echo form_dropdown('category',$categorys, 
								($this->session->userdata("category_".$this->uri->segment(3)) !="" 
								? $this->session->userdata("category_".$this->uri->segment(3))
								: ''), $style);
								
								$style3 = 'id="date-start"';
								echo "&nbsp;&nbsp;&nbsp;วันที่ เริ่มต้น : ".form_input('start', ($this->session->userdata("start_".$this->uri->segment(3)) =="" ? set_value('start') : $this->session->userdata("start_".$this->uri->segment(3)) ), $style3)."&nbsp;";
								
								$style4 = 'id="date-end"';
								echo "&nbsp;&nbsp;&nbsp;สิ้นสุด : ".form_input('end', ($this->session->userdata("end_".$this->uri->segment(3)) =="" ? set_value('end') : $this->session->userdata("end_".$this->uri->segment(3)) ), $style4)."&nbsp;";
								
								echo '<input type="submit" class="button" name="submit" value="ค้นหา" />';
								echo form_close(); 
								echo "</div>".br(1); 
?>