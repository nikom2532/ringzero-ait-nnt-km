<?php
								echo "<div style='width:100%;text-align:left'>";
								echo form_open_multipart('backoffice/'.$this->uri->segment(3).'/save');
								echo form_dropdown('contact_list', $con_list)."&nbsp;"; 
								echo form_dropdown('letter', $letter)."&nbsp;"; 
								echo '<input type="submit" class="button" name="submit" value="Send" />';
								echo form_close(); 
								echo "</div>".br(1); 
?>