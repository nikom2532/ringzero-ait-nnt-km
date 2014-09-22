<div class="content">
                <div class="history">
                    <ul>
                        <li>บทความ</li>
                    </ul>
                </div>

                <div class="box-search-news">
                    <form name="search-news" class="form-search-news" method="post" action="<?php echo site_url('site/article/search'); ?>">
                        <div class="rows">
                            <label class="label-search">ค้นหาบล็อก/บทความ</label>
                            <input type="text" name="searchtxt" value="<?php echo $this->session->userdata("search_article"); ?>" class="txt-field">
                            <input type="submit" name="submit" value="" class="bt bt-search">
                        </div>
                    </form>
                </div><!-- .box-search-news -->

                <div class="left-sidebar">
                    <div id="article-category" class="box-sidebar">
                        <div class="box-sidebar-header">
                            <h2>
                                <img src="<?php echo base_url()."asset/site/"; ?>images/categories.png" alt="img">
                            </h2>
                        </div>
                        <div class="box-sidebar-contents">
                            <ul class="news-link">
                           
                                <?php if(!empty($categorys)){ foreach($categorys as $categorys) : ?>   
                                <li <?php if($categorys->CAT_id==$this->session->userdata("search_catagory")) echo 'class="active"'; ?>><a href="<?php echo site_url('site/article/category/'.$categorys->CAT_id); ?>"><?php echo $categorys->CAT_topic; ?></a></li>
                                <?php endforeach; } ?>
                                
                            </ul>
                        </div><!-- .box-sidebar-contents -->
                    </div><!--  .box-sidebar -->
					
					<div id="article-date-search" class="box-sidebar">
                        <div class="box-sidebar-header">
                            <h2>
                                <img src="<?php echo base_url()."asset/site/"; ?>images/articles-most-traffic.png" alt="img">
                            </h2>
                        </div>
                        <div class="box-sidebar-contents">
                            <form name="form-date-search" class="form-date-search" method="post" action="<?php echo site_url('site/article/toparticle'); ?>">
								<div class="rows">
									<label>เดือน</label>
									<!--
                                    <select name="select-year" class="select-date">
										<option value=""> - เลือกปี - </option>
									</select>
                                    -->
                                    <div class="box-select-opt">
                                    <?php 
									if($this->session->userdata("month_top")!=""){
										$monthselect = $this->session->userdata("month_top");
									}else{
										$monthselect = date("m");
									}
									if($this->session->userdata("year_top")!=""){
										$yearselect = $this->session->userdata("year_top");
									}else{
										$yearselect = date("Y");
									}
									?>
                                    <?php
									$style2 = 'style="width:160px"';
								echo form_dropdown('month_toparticle',$months, $monthselect, $style2);
								?>
                                        <?php /*?><div class="bg-select-option"></div>
                                        <input id="select-year" type="text" name="cat" class="txt-field  select-option" value="">
                                        <span class="icon-arrow"> </span>
                                        <ul id="list-year" class="list-select-option">
                                            <li>- เลือกปี -</li>
                                            <li>- เลือกปี2 -</li>
                                        </ul><?php */?>
                                    </div>
								</div>
								<div class="rows">
									<label>ปี</label>
                                    <!--
									<select name="select-month" class="select-date">
										<option value=""> - เลือกเดือน - </option>
									</select>
                                    -->
                                    <div class="box-select-opt">     
                                    <?php
                                    $style2 = 'style="width:160px"';
								echo form_dropdown('year_toparticle',$years, $yearselect, $style2);            
								?>               
                                        <?php /*?><input id="select-month" type="text" name="cat" class="txt-field  select-option" value="">
                                        <div class="bg-select-option"></div>
                                        <span class="icon-arrow"> </span>
                                        <ul id="list-month" class="list-select-option">
                                            <li>- เลือกเดือน -</li>
                                            <li>- เลือกเดือน2 -</li>
                                        </ul><?php */?>
                                    </div>                                    
								</div>
                                
                                <div class="rows" style="margin-bottom: 0px;text-align: center;">
                                    <input type="submit" name="submit" value="ค้นหา" class="bt">                      
                                </div>
                                
							</form>
                        </div><!-- .box-sidebar-contents -->
                    </div><!--  .box-sidebar -->
					
					<?php /*?><div id="tags" class="box-sidebar">
                        <div class="box-sidebar-header">
                            <h2 class="tags-title">
                                <img src="<?php echo base_url()."asset/site/"; ?>images/tag.png" alt="img">
                            </h2>
                        </div>
                        <div class="box-sidebar-contents">
                            <ul class="tags">
                                <li class="active"><a href="#">พระราชสำนัก,</a></li>
                                <li><a href="#">วาเลนไทน,</a></li>
                                <li><a href="#">ตำรวจ,</a></li>
                                <li><a href="#">เคอร์ฟิว,</a></li>
                                <li><a href="#">ออกจากบ้าน,</a></li>
                                <li><a href="#">อันตราย,</a></li>
                                <li><a href="#">บ้าน,</a></li>
                                <li><a href="#">เยาวชน 18 ปี</a></li>
                            </ul>
                        </div> .box-sidebar-contents 
                    </div><?php */?><!--  .box-sidebar -->
                </div>

                <div class="right-sidebar">
                    <div id="news" class="box-article">
                        <div class="box-article-header">
                            <h2 class="title">
                                <span class="highlight">บทความ</span>
                               
                                <?php if(!empty($cate)){ foreach($cate as $cat) : ?>   
								<?php 
                                if($cat->CAT_id==$this->uri->segment(5)){
                                	echo $cat->CAT_topic; }
									 ?>
                                
                                <?php endforeach; } ?>
                                 <?php if($this->session->userdata("search_catagory_news")==""){ ?>
							  
							  <a href="<?php echo site_url('site/article/rss'); ?>" class="icon"><img src="<?php echo base_url()."asset/site/"; ?>images/rss.png"></a>
                              <?php }else{ ?>
                                <a target="_blank" href="<?php echo site_url('site/article/rss_catalog/'.$this->session->userdata("search_catagory")); ?>" class="icon"><img src="<?php echo base_url()."asset/site/"; ?>images/rss.png"></a>
                                <?php } ?>
                                
                            </h2>
                        </div>
                        <div class="box-article-contents">
                        <?php
								 if(!empty($rows)){
										 foreach($rows as $row) :
										 if($row->ATC_id!=""){
										 
						?>   
                            <div class="article">
                                <div class="details">
                                    <div class="image">
                                        <a href="<?php echo site_url('site/article/detail/'.$row->ATC_id); ?>" title="<?php //echo $row->ATC_title; ?>">
                                        <img src="<?php echo str_replace(";","",$row->ATC_image); ?>" onerror="this.src='<?php echo site_url('asset/site/images/picDefalt.png'); ?>';" width="151" height="95"/>
                                       </a>
                                    </div>
                                    <div class="refference">
                                        <p>
                                            <span>ผู้เขียน : <?php echo $row->ATC_writer; ?> | </span>
                                            <span>ผู้เข้าชม : <?php 
											if($this->uri->segment(4)=="toparticle"){
												echo $row->AM_view;
											}else{
											echo $row->ATC_viewall; }?> | </span>
                                            <span><?php echo th_date($row->ATC_date->format('Y-m-d'));  ?></span>
                                            <span> &nbsp;&nbsp;
                                            <?php for($i=1;$i<=$row->ATC_quality;$i++){ ?>
												<img src="<?php echo base_url()."asset/site/"; ?>images/star-icon-small.png" height="12">
											<?php }?>
                                            </span>
                                             <?php if($row->ATC_tag!=""){ ?>
                                             <br />
<span>
Tag : </span><?php echo str_replace($this->session->userdata("search_tag"),"<span style='color:#4d207b;font-weight: bold'>".$this->session->userdata("search_tag")."</span>",$row->ATC_tag); } ?>
                                        </p>
                                        
                                        <?php if($row->ATC_writer_ref!=""&&$row->ATC_writer_ref!="0"){ ?>
                                        <p>บทความอ้างอิง : <?php echo $row->ATC_writer_ref; ?></p>
                                        <?php } ?>
                                       
                                    
                                      
                                    </div>
                                    <h3 class="article-title">
                                        <a href="<?php echo site_url('site/article/detail/'.$row->ATC_id); ?>" title="<?php echo $row->ATC_title; ?>" class="highlight  bold"><?php echo cut_word($row->ATC_title,200); ?></a>
                                    </h3>
                                    <p><?php //echo $row->ATC_short_desc; ?>
                                    <?php echo htmldecode(cut_word($row->ATC_short_desc,500)); ?>
                                    </p>
                                </div>
                                
                            </div><!-- .article -->  
						<?php 
										 }
								endforeach;
						 }
						 ?>
                            <div class="box-pagination">
                            <?php if(isset($totalrow)){ ?>
                                <p class="total-pages">ทั้งหมด: <span><?php  if(empty($rows)){ echo "0"; }else{echo number_format($totalrow);} ?></span> รายการ </p>
                                <?php echo $pagination; ?>
                           <?php } ?>    
                            </div>
                        </div><!-- .box-article-contents -->
                    </div><!-- #news .box-article -->


                </div> <!-- .right-sidebar -->
            </div>
     <script type="text/javascript">
        $(document).ready(function() {
        	
            var dataYear = [];
            $('#list-year li').each(function() {
                dataYear.push($(this).text());
            });
            $('#select-year').val(dataYear[0]);
            $('#select-year').autocomplete({
                source: dataYear,
                minLength: 0,
                select: function() {
                    $('#select-year').blur();
                }
            }).focus(function() {
                $(this).autocomplete('search', '');
            });

            var dataMonth = [];
            $('#list-month li').each(function() {
                dataMonth.push($(this).text());
            });
            $('#select-month').val(dataMonth[0]);
            $('#select-month').autocomplete({
                source: dataMonth,
                minLength: 0,
                select: function() {
                    $('#select-month').blur();
                }
            }).focus(function() {
                $(this).autocomplete('search', '');
            });

        });
    </script>