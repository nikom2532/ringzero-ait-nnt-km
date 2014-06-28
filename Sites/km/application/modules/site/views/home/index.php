<div class="content">
<?php  if(!empty($rowsview)){ ?>
                <div id="popular-article" class="box-article">
                    <div class="box-article-header">
                        <h2>
                            <img src="<?php echo base_url()."asset/site/"; ?>images/articles-most-traffic.png" alt="img">
                            <a href="#" title="rss" class="icon">
                                <img src="<?php echo base_url()."asset/site/"; ?>images/rss.png" alt="img">
                            </a>
                        </h2>
                    </div>
                    <div class="box-article-contents  cols-1-1">
 						<?php
								 
										 foreach($rowsview as $rowsview) :
						?>  
                        <div class="article">
                            <div class="details">
                                <div class="image">
                                    <a href="<?php echo site_url('site/article/detail/'.$rowsview->ATC_id); ?>" title="<?php echo $rowsview->ATC_title; ?>"><img src="<?php echo site_url('uploads/article/image/'.$rowsview->ATC_image); ?>" width="150"/></a>
                                </div>
                                <div class="refference">
                                    <p>
                                            <span>ผู้เขียน : <?php echo $rowsview->ATC_writer;  ?> | </span>
                                            <span>ผู้เข้าชม : <?php echo $rowsview->ATC_viewall; ?> | </span>
                                            <span><?php echo th_date($rowsview->ATC_date->format('Y-m-d'));  ?></span>
                                             <br />
tag : <?php echo str_replace($this->session->userdata("search_tag"),"*".$this->session->userdata("search_tag")."*",$rowsview->ATC_tag);  ?>
                                        </p>
                                        
                                        <?php if($rowsview->ATC_writer_ref!=""&&$rowsview->ATC_writer_ref!="0"){ ?>
                                        <p>บทความอ้างอิง : <?php echo $rowsview->ATC_writer_ref; ?></p>
                                        <?php } ?>
                                    
                                </div>
                                 <h3 class="article-title">
                                        <a href="<?php echo site_url('site/article/detail/'.$rowsview->ATC_id); ?>" title="<?php echo $rowsview->ATC_title; ?>" class="highlight  bold"><?php echo $rowsview->ATC_title; ?>...</a>
                                    </h3>
                                    <p>  <?php echo htmldecode(iconv_substr(nl2br($rowsview->ATC_short_desc),0,400, "UTF-8")); ?></p>
                            </div>
                        </div>
                        <?php 
								endforeach;
						
						 ?><!-- .article -->  
                    </div><!-- .box-article-contents -->
                </div><!-- #popular-article .box-article -->
<?php  } ?>
<?php  if(!empty($rowsrecom)){ ?>
                <div id="recommend-article" class="box-article">
                    <div class="box-article-header">
                        <h2>
                            <img src="<?php echo base_url()."asset/site/"; ?>images/articles-recommend.png" alt="img"> 
                            <a href="#" title="rss" class="icon"><img src="<?php echo base_url()."asset/site/"; ?>images/rss.png" alt="img"></a>
                        </h2>
                    </div>
                    <div class="box-article-contents  cols-1-1">
                        <!-- .article -->  

                        <!-- .article -->  
						<?php
								
										 foreach($rowsrecom as $rowsrecom) :
						?>  
                        <div class="article">
                            <div class="details">
                                <div class="image">
                                    <a href="<?php echo site_url('site/article/detail/'.$rowsrecom->ATC_id); ?>" title="<?php echo $rowsrecom->ATC_title; ?>"><img src="<?php echo site_url('uploads/article/image/'.$rowsrecom->ATC_image); ?>" width="150"/></a>
                                </div>
                                <div class="refference">
                                    <p>
                                            <span>ผู้เขียน : <?php echo $rowsrecom->ATC_writer;  ?> | </span>
                                            <span>ผู้เข้าชม : <?php echo $rowsrecom->ATC_viewall; ?> | </span>
                                            <span><?php echo th_date($rowsrecom->ATC_date->format('Y-m-d'));  ?></span>
                                             <br />
tag : <?php echo str_replace($this->session->userdata("search_tag"),"*".$this->session->userdata("search_tag")."*",$rowsrecom->ATC_tag);  ?>
                                        </p>
                                        
                                      <?php if($rowsrecom->ATC_writer_ref!=""&&$rowsrecom->ATC_writer_ref!="0"){ ?>
                                        <p>บทความอ้างอิง : <?php echo $rowsrecom->ATC_writer_ref; ?></p>
                                        <?php } ?>
                                    
                                </div>
                                 <h3 class="article-title">
                                        <a href="<?php echo site_url('site/article/detail/'.$rowsrecom->ATC_id); ?>" title="<?php echo $rowsrecom->ATC_title; ?>" class="highlight  bold"><?php echo $rowsrecom->ATC_title; ?></a>
                                    </h3>
                                    <p>  <?php echo htmldecode(iconv_substr(nl2br($rowsrecom->ATC_short_desc),0,400, "UTF-8")); ?>...</p>
                            </div>
                        </div><!-- .article --> 
                        <?php 
								endforeach;
						
						 ?> 
                    </div><!-- .box-article-contents -->
                </div><!-- #recommend-article .box-article -->
<?php  } ?>
                <div id="latest-article" class="box-article">
                    <div class="box-article-header">
                        <h2>                            
                            <img src="<?php echo base_url()."asset/site/"; ?>images/articles-lastest.png" alt="img">
                            <a target="_blank" href="<?php echo site_url('site/article/rsshot'); ?>" title="rss" class="icon"><img src="<?php echo base_url()."asset/site/"; ?>images/rss.png" alt="rss"></a>
                        </h2>
                    </div>
                    <div class="box-article-contents  cols-2-1">
                    <?php
								 if(!empty($rowsarticle)){
										 foreach($rowsarticle as $rowsarticle) :
						?>  
                        <div class="article">
                            <div class="details">
                                <div class="image">
                                    <a href="<?php echo site_url('site/article/detail/'.$rowsarticle->ATC_id); ?>" title="<?php echo $rowsarticle->ATC_title; ?>"><img src="<?php echo site_url('uploads/article/image/'.$rowsarticle->ATC_image); ?>" width="150"/></a>
                                </div>
                                <div class="refference">
                                    <p>
                                            <span>ผู้เขียน : <?php echo $rowsarticle->ATC_userupdate;  ?> | </span>
                                            <span>ผู้เข้าชม : <?php echo $rowsarticle->ATC_viewall; ?> | </span>
                                            <span><?php echo th_date($rowsarticle->ATC_date->format('Y-m-d'));  ?></span>
                                             <br />
tag : <?php echo str_replace($this->session->userdata("search_tag"),"*".$this->session->userdata("search_tag")."*",$rowsarticle->ATC_tag);  ?>
                                        </p>
                                        
                                        
                                        <?php if($rowsarticle->ATC_writer_ref!=""&&$rowsarticle->ATC_writer_ref!="0"){ ?>
                                        <p>บทความอ้างอิง : <?php echo $rowsarticle->ATC_writer; ?></p>
                                        <?php } ?>
                                    
                                </div>
                                 <h3 class="article-title">
                                        <a href="<?php echo site_url('site/article/detail/'.$rowsarticle->ATC_id); ?>" title="<?php echo $rowsarticle->ATC_title; ?>" class="highlight  bold"><?php echo $rowsarticle->ATC_title; ?></a>
                                    </h3>
                                    <p>  <?php echo htmldecode(iconv_substr(nl2br($rowsarticle->ATC_short_desc),0,400, "UTF-8")); ?>...</p>
                            </div>
                        </div><!-- .article -->
						<?php 
								endforeach;
						 }
						 ?>
                        <a href="<?php echo site_url('site/article'); ?>" title="อ่านต่อทั้งหมด" class="readmore">อ่านต่อทั้งหมด</a>
                    </div><!-- .box-article-contents -->
                </div><!-- #latest-article .box-article -->

                <div id="popular-news" class="box-article">
                    <div class="box-article-header">
                        <h2>
                            <img src="<?php echo base_url()."asset/site/"; ?>images/news-hilight.png" alt="img">
                            <a target="_blank" href="<?php echo site_url('site/news/rsshot'); ?>" title="rss" class="icon"><img src="<?php echo base_url()."asset/site/"; ?>images/rss.png" alt="rss"></a>
                        </h2>                        
                    </div>
                    <div class="box-article-contents  cols-2-1">
                        <?php
								 if(!empty($rowsnews)){
										 foreach($rowsnews as $rowsnews) :
						?>
                        <div class="article">
                            <div class="details">
                                <div class="image">
                                     <img src="<?php echo site_url('uploads/article/image/'); ?>" onerror="this.src='<?php echo site_url('asset/site/images/picDefalt.png'); ?>';" width="150">
                                     
                                </div>
                                <div class="refference">
                                    <p>
                                            <span>ผู้เขียน : <?php echo $rowsnews->N_writer;  ?> | </span>
                                            <span>ผู้เข้าชม : <?php echo $rowsnews->N_Views; ?> | </span>
                                            <span><?php echo th_date($rowsnews->N_date->format('Y-m-d'));  ?></span>
                                            
                                        </p>
                                    
                                </div>
                                <h3 class="article-title">
                                        <a href="<?php echo site_url('site/news/detail/'.$rowsnews->N_id); ?>" title="<?php echo $rowsnews->N_title; ?>" class="highlight  bold"><?php echo $rowsnews->N_title; ?></a>
                                    </h3>
                                    <p><?php echo htmldecode(iconv_substr(nl2br($rowsnews->N_desc),0,400, "UTF-8")); ?>...
                                    <?php //echo $row->N_desc; ?>
                                    </p>
                            </div>
                        </div><!-- .article -->  
						<?php 
								endforeach;
						 }
						 ?>
                        <a href="<?php echo site_url('site/news'); ?>" title="อ่านต่อทั้งหมด" class="readmore">อ่านต่อทั้งหมด</a>
                    </div><!-- .box-article-contents -->
                </div><!-- #popular-news .box-article -->

            </div>