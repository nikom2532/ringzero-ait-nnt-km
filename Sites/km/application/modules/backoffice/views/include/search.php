<?php
								echo "<div style='width:100%;text-align:right'>";
								echo form_open('backoffice/'.$this->uri->segment(3).'/search'); 
								echo "ค้นหา : ".form_input('search', ($this->session->userdata("search_".$this->uri->segment(3)) =="" ? set_value('search') : $this->session->userdata("search_".$this->uri->segment(3)) ))."&nbsp;";
								echo '<input type="submit" class="button" name="submit" value="ค้นหา" />';
								echo form_close(); 
								echo "</div>".br(1); 
?>