<?php
								echo "<div style='width:100%;text-align:left'>";
								echo form_open_multipart('backoffice/'.$this->uri->segment(3).'/save'); 
								echo "Upload : <input type='file' name='up_pic' />&nbsp;<br>";
								echo "Order : &nbsp;&nbsp;&nbsp;<input type='text' name='order' size='3' maxlength='3' />&nbsp;";
								echo "<input type='hidden' name='id' value='".$this->uri->segment(5)."' />&nbsp;";
								echo '<input type="submit" class="button" name="submit" value="Upload" />';
								echo form_close(); 
								echo "</div>".br(1); 
?>