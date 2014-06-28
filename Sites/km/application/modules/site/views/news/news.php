<div class="content">
                <div class="history">
                    <ul>
                        <li>ข่าว/ข่าวสาร</li>
                    </ul>
                </div>

                <div class="box-search-news">
                    <form name="search-news" method="post" class="form-search-news" action="<?php echo site_url('site/news/search'); ?>">
                        <div class="rows">
                            <label class="label-search">ค้นหาข่าว/ข่าวสาร</label>
                            <input type="text" name="searchtxt" value="<?php echo $this->session->userdata("search_news"); ?>" class="txt-field">
                            <input type="submit" name="submit" value="" class="bt bt-search">
                            <a href="#" title="ค้นหาแบบละเอียด" class="links-advance-search"><img src="<?php echo base_url()."asset/site/"; ?>images/link-adv-search.png" alt="img"></a>
                        </div>
                    </form>

                    <form name="advance-search" class="form-advance-search" method="post" action="<?php echo site_url('site/news/search_advance'); ?>">
                        <div class="rows">
                            <label>วันที่</label>
                            <input type="text" name="datestart" id="date-start" value="<?php echo $this->session->userdata("start_approve_news"); ?>" class="txt-field">
                        </div>
                        <div class="rows">
                            <label>ถึง</label>
                            <input type="text" name="datestop" id="datestop" value="<?php echo $this->session->userdata("end_approve_news"); ?>" class="txt-field">
                        </div>
                        <div class="rows">
                            <label>หมวดหมู่ข่าว</label>
                            <select  name="search_cat">
                            	<option value="null">กรุณาเลือกหมวดหมู่</option>
                                <?php if(!empty($categorys)){ foreach($categorys as $cat) : ?>
                                 <option value="<?php echo $cat->C_id; ?>" <?php if($cat->C_id==$this->session->userdata("search_catagory_news")) echo 'selected'; ?>><?php echo $cat->C_topic; ?></option>
                                <?php endforeach; } ?>
                                </select>
                            
                        </div>

                        <input type="submit" name="submit" value="" class="bt bt-adv-search">
                    </form>
                </div><!-- .box-search-news -->

                <div class="left-sidebar">
                    <div id="news-category" class="box-sidebar">
                        <div class="box-sidebar-header">
                            <h2>
                            
                                <img src="<?php echo base_url()."asset/site/"; ?>images/news-categories.png" alt="img">
                            
                            </h2>
                        </div>
                        <div class="box-sidebar-contents">
                            <ul class="news-link">
                           
                                <?php if(!empty($categorys)){ foreach($categorys as $categorys) : ?>   
                                <li <?php if($categorys->C_id==$this->session->userdata("search_catagory_news")) echo 'class="active"'; ?>><a href="<?php echo site_url('site/news/category/'.$categorys->C_id); ?>"><?php echo $categorys->C_topic; ?></a></li>
                                <?php endforeach; } ?>
                                
                            </ul>
                       
                        </div><!-- .box-article-contents -->
                    </div><!--  .box-article -->
                </div>

                <div class="right-sidebar">
                    <div id="news" class="box-article">
                        <div class="box-article-header">
                            <h2>
                                <img src="<?php echo base_url()."asset/site/"; ?>images/news-public.png" alt="img">
                              <?php if($this->session->userdata("search_catagory_news")==""){ ?>
							  
							  <a href="<?php echo site_url('site/news/rss'); ?>" class="icon"><img src="<?php echo base_url()."asset/site/"; ?>images/rss.png"></a>
                              <?php }else{ ?>
                                <a target="_blank" href="<?php echo site_url('site/news/rss_catalog/'.$this->session->userdata("search_catagory_news")); ?>" class="icon"><img src="<?php echo base_url()."asset/site/"; ?>images/rss.png"></a>
                                <?php } ?>
                            </h2>
                        </div>
                        <div class="box-article-contents">
                        <?php
								 if(!empty($rows)){
										 foreach($rows as $row) :
						?>   
                            <div class="article">
                                <div class="details">
                                    <div class="image">
                                        <a href="<?php echo site_url('site/news/detail/'.$row->N_id); ?>" title="<?php echo $row->N_title; ?>">
                                        <img src="<?php echo site_url('uploads/article/image/'); ?>" onerror="this.src='<?php echo site_url('asset/site/images/picDefalt.png'); ?>';" width="150">
                                        </a>
                                    </div>
                                    <div class="refference">
                                        <p>
                                            <span>ผู้เขียน : <?php echo $row->N_writer;  ?> | </span>
                                            <span>ผู้เข้าชม : <?php echo $row->N_Views; ?> | </span>
                                            <span><?php echo th_date($row->N_date->format('Y-m-d'));  ?></span>
                                            
                                        </p>
                                    </div>
                                    <h3 class="article-title">
                                        <a href="<?php echo site_url('site/news/detail/'.$row->N_id); ?>" title="<?php echo $row->N_title; ?>" class="highlight  bold"><?php echo $row->N_title; ?></a>
                                    </h3>
                                    <p><?php echo htmldecode(iconv_substr(nl2br($row->N_desc),0,400, "UTF-8")); ?>...
                                    <?php //echo $row->N_desc; ?>
                                    </p>
                                </div>
                                
                            </div><!-- .article -->  
						<?php 
								endforeach;
						 }
						 ?>
                            <div class="box-pagination">
                                <p class="total-pages">ทั้งหมด: <span><?php echo $totalrow; ?></span> รายการ </p>
                                <?php echo $pagination; ?>
                               
                            </div>
                        </div><!-- .box-article-contents -->
                    </div><!-- #news .box-article -->


                </div> <!-- .right-sidebar -->
            </div>
 <script type="text/javascript">
        $(document).ready(function() {	
			$( "#date-start" ).datepicker({ dateFormat: "yy-mm-dd" });
			$( "#datestop" ).datepicker({ dateFormat: "yy-mm-dd" });		
			
			$('.form-advance-search').hide();
			
			$('.links-advance-search').click(function(e) {
                e.preventDefault();
				$('.form-advance-search').slideToggle('slow');
			});


            var dataAdvanceSearch = [];
            $('#list-adv-search li').each(function() {
                dataAdvanceSearch.push($(this).text());
            });
            $('#select-adv-search').val(dataAdvanceSearch[0]);
            $('#select-adv-search').autocomplete({
                source: dataAdvanceSearch,
                minLength: 0,
                select: function() {
                    $('#select-adv-search').blur();
                }
            }).focus(function() {
                $(this).autocomplete('search', '');
            });

        });
    </script>