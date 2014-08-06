<h2><?php echo menu_bof($this->uri->segment(3)) ?></h2>
			<p id="page-intro">ระบบจัดการ<?php echo menu_bof($this->uri->segment(3)) ?></p>
			<ul class="shortcut-buttons-set">
                        <li><a class="shortcut-button" href="<?php echo site_url('backoffice/'.$this->uri->segment(3).'/create'); ?>"><span>
                            <img src="<?php echo site_url('asset/backoffice/images/icons/document_new.png'); ?>" alt="icon" /><br />
                            เพิ่มข้อมูล
                        </span></a></li>
				<li><a class="shortcut-button" href="<?php echo site_url('backoffice/'.$this->uri->segment(3).'/index'); ?>"><span>
					<img src="<?php echo site_url('asset/backoffice/images/icons/type_list.png'); ?>" alt="icon" /><br />
					รายการข้อมูล
				</span></a></li>
                
            </ul>