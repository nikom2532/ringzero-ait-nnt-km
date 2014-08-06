<?php
								echo "<div style='width:100%;text-align:right'>";
								echo form_open('backoffice/'.$this->uri->segment(3).'/search'); 
								echo "ค้นหา : ".form_input('search', ($this->session->userdata("search_".$this->uri->segment(3)) =="" ? set_value('search') : $this->session->userdata("search_".$this->uri->segment(3)) ))."&nbsp;";
								echo "&nbsp;&nbsp;&nbsp;หมวดหมู่บทความ : ";
								
								$style = 'class="text-input"';
								
								?>
                         <?php //echo $this->session->userdata("category_article_center"); ?>
					<select  name="category">
                            	<option value="null">กรุณาเลือกหมวดหมู่</option>
                                <?php if(!empty($categorys)){ foreach($categorys as $cat) : ?>
                                 <option value="<?php echo $cat->C_id; ?>" <?php if($cat->C_id==$this->session->userdata("category_article_center")) echo 'selected'; ?>><?php echo $cat->C_topic; ?></option>
                                <?php endforeach; } ?>
                                </select>
						<?php		
								$style3 = 'id="date-start"';
								echo "วันที่ เริ่มต้น : ".form_input('start', ($this->session->userdata("start_".$this->uri->segment(3)) =="" ? set_value('start') : $this->session->userdata("start_".$this->uri->segment(3)) ), $style3)."&nbsp;";
								
								$style4 = 'id="date-end"';
								echo "สิ้นสุด : ".form_input('end', ($this->session->userdata("end_".$this->uri->segment(3)) =="" ? set_value('end') : $this->session->userdata("end_".$this->uri->segment(3)) ), $style4)."&nbsp;";
								
								echo '<input type="submit" class="button" name="submit" value="ค้นหา" />';
								echo form_close(); 
								echo "</div>".br(1); 
?>