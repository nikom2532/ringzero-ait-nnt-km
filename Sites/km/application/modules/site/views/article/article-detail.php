<script src="<?php echo base_url()."asset/flowplayer/" ?>flowplayer-3.2.11.min.js"></script>
<?php if(!empty($rows)){ foreach($rows as $rows) : ?>   

<?php endforeach; } ?>

<?php if(!empty($categorys)){ foreach($categorys as $cat) : ?>   
<?php 
if($cat->CAT_id==$rows->ATC_category_ref)
$txtcat = $cat->CAT_topic; ?>
<?php endforeach; } ?>
<div class="content">
                <div class="history">
                    <ul>
                        <li><a href="<?php echo site_url('site/article'); ?>" title="บทความ">บทความ</a></li>
                        <li><?php echo $txtcat; ?></li>
                    </ul>

                    <a href="javascript:history.back();" title="ย้อนกลับหน้าที่แล้ว" class="backward">&lt; ย้อนกลับหน้าที่แล้ว</a>
                </div>

                <div class="left-sidebar">
                    <div id="news-category" class="box-sidebar">
                        <div class="box-sidebar-header">
                            <h2>
                                <img src="<?php echo base_url()."asset/site/"; ?>images/categories.png" alt="img">
                            </h2>
                        </div>
                        <div class="box-sidebar-contents">
                            <ul class="news-link">
                                <?php if(!empty($categorys)){ foreach($categorys as $categorys) : ?>   
                                <li <?php if($categorys->CAT_id==$rows->ATC_category_ref) echo 'class="active"'; ?>><a href="<?php echo site_url('site/article/category/'.$categorys->CAT_id); ?>"><?php echo $categorys->CAT_topic; ?></a></li>
                                <?php endforeach; } ?>
                            </ul>
                        </div><!-- .box-article-contents -->
                    </div><!--  .box-article -->
                    <div id="tags" class="box-sidebar">
                        <div class="box-sidebar-header">
                            <h2 class="tags-title">
                                <img src="<?php echo base_url()."asset/site/"; ?>images/tag.png" alt="img">
                            </h2>
                        </div>
                        <?php  if($rows->ATC_tag != ""){ ?>
                        <div class="box-sidebar-contents">
                            <ul class="tags">
                            <?php
						  
								$arr = explode(",",$rows->ATC_tag);
								foreach($arr as $ar){ 
									$txtarr = urlencode($ar);
									echo '<li><a href="'.site_url('site/article/tagfilter/'.encode_url($ar)).'">'.$ar.'</a></li>';
								}
						   
						   ?>
          
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="right-sidebar">
                    <div id="news" class="box-article">
                        <div class="box-article-contents">
                            <div class="article">
                                <div class="details">
                                    <div class="image">
                                        <a href="<?php echo site_url('site/article/detail/'.$rows->ATC_id); ?>" title="<?php echo $rows->ATC_title; ?>"><img src="<?php echo site_url('uploads/article/image/'.$rows->ATC_image); ?>" width="150" height="95"/></a>
                                    </div>
                                    <div class="refference">
                                        <p>
                                            <span>ผู้เขียน : <?php echo $rows->ATC_writer;  ?> | </span>
                                            <span>ผู้เข้าชม : <?php echo $rows->ATC_viewall; ?> | </span>
                                            <span><?php echo th_date($rows->ATC_date->format('Y-m-d'));  ?></span>
                                            
                                        </p>
                                         <?php if($rows->ATC_writer_ref!=""&&$rows->ATC_writer_ref!="0"){ ?>
                                        <p>บทความอ้างอิง : <?php echo $rows->ATC_writer_ref; ?></p>
                                        <?php } ?>
                                    </div>
                                    <h3 class="article-title  bold  highlight">
                                   <?php echo $rows->ATC_title; ?>
                                    </h3>
                                    
                                    <!-- <div class="box-social">Social Media Script</div> -->
                                </div>
                            </div><!-- .article -->  

                            <div class="content-details">
                               <center> <?php echo ($rows->ATC_video != "" ? '
						  <a href="'.base_url().'uploads/article/video/'.$rows->ATC_video.'" style="display:block;width:640px;height:480px;" id="playerflow"></a>' : '') ?>
                          </center>
                                <?php echo htmldecode($rows->ATC_desc); ?>

                                <!-- Comments Footer Massage
                                <div class="footer-details">
                                    <p class="highlight  bold">จรูญ พิตะพันธ์ รายงาน</p>
                                </div>
                                -->
                                <?php if($rows->ATC_tag!="") { ?>
                                <p>
                                            <span>Tag : <?php echo $rows->ATC_tag;  ?> </span>
                                           
                                            
                                        </p>
                                <?php } ?>
                            </div>
                            
                            <?php /*?><div class="box-gallery">
								<div class="image-row">
									<div class="image-set">
										<a class="example-image-link" href="<?php echo base_url()."asset/site/"; ?>images/pic-hilight-03.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
											<img class="example-image" src="<?php echo base_url()."asset/site/"; ?>images/pic-hilight-03x150.png" alt=""/>
										</a>
										<a class="example-image-link" href="<?php echo base_url()."asset/site/"; ?>images/pic-hilight-02.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
											<img class="example-image" src="<?php echo base_url()."asset/site/"; ?>images/pic-hilight-02x150.png" alt=""/>
										</a>
										<a class="example-image-link" href="<?php echo base_url()."asset/site/"; ?>images/pic-hilight-01.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
											<img class="example-image" src="<?php echo base_url()."asset/site/"; ?>images/pic-hilight-01x150.png" alt=""/>
										</a>
										<a class="example-image-link  last" href="<?php echo base_url()."asset/site/"; ?>images/pic-hilight-03.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
											<img class="example-image" src="<?php echo base_url()."asset/site/"; ?>images/pic-hilight-03x150.png" alt=""/>
										</a>
										<a class="example-image-link" href="<?php echo base_url()."asset/site/"; ?>images/pic-hilight-02.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
											<img class="example-image" src="<?php echo base_url()."asset/site/"; ?>images/pic-hilight-02x150.png" alt=""/>
										</a>
										<a class="example-image-link" href="<?php echo base_url()."asset/site/"; ?>images/pic-hilight-01.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
											<img class="example-image" src="<?php echo base_url()."asset/site/"; ?>images/pic-hilight-01x150.png" alt=""/>
										</a>
									</div>
								</div>
                            </div><?php */?>
                             
                        </div><!-- .box-article-contents -->
                    </div><!-- #news .box-article -->

 <?php  if(!empty($resent)){ ?>
                    <div id="related-news" class="box-article">
                        <div class="box-article-header">
                            <h2>
                                <img src="<?php echo base_url()."asset/site/"; ?>images/articles-relate.png" alt="img">
                                <a target="_blank" href="<?php echo site_url('site/article/rss_catalog/'.$rows->ATC_category_ref); ?>" class="icon"><img src="<?php echo base_url()."asset/site/"; ?>images/rss.png"></a>
                            </h2>
                        </div>
                       
                        <div class="box-article-contents">
                         <?php
								
										 foreach($resent as $resent) :
						?>   
                            <div class="article">
                                <div class="details">
                                    <div class="image">
                                        <img src="<?php echo site_url('uploads/article/image/'.$resent->ATC_image); ?>" width="150" height="95"/>
                                    </div>
                                    <div class="refference">
                                        <p>
                                           <span>ผู้เขียน : <?php echo $resent->ATC_writer;  ?> | </span>
                                            <span>ผู้เข้าชม : <?php echo $resent->ATC_viewall; ?> | </span>
                                            <span><?php echo th_date($resent->ATC_date->format('Y-m-d'));  ?></span>
                                        </p>
                                         <?php if($resent->ATC_writer_ref!=""&&$resent->ATC_writer_ref!="0"){ ?>
                                        <p>บทความอ้างอิง : <?php echo $resent->ATC_writer_ref; ?></p>
                                        <?php } ?>
                                    </div>
                                    <h3 class="article-title">
                                        <a href="<?php echo site_url('site/article/detail/'.$resent->ATC_id); ?>" title="<?php echo $resent->ATC_title; ?>" class="highlight  bold"><?php echo cut_word($resent->ATC_title,200); ?></a>
                                    </h3>
                                    <p>  <?php echo htmldecode(cut_word($rows->ATC_short_desc,500)); ?></p>
                                </div>
                            </div><!-- .article -->  
						<?php 
								endforeach;
						
						 ?>
                            <!-- .article -->  

                            <!-- .article -->  

                        </div><!-- .box-article-contents -->
                    </div><!-- #related-news .box-article -->
<?php } ?>

                </div> <!-- .right-sidebar -->
            </div>
<script type="text/javascript">
			$(function(){
				
					$('#dialogk').dialog({
					autoOpen: false,
					width: 400,
					draggable: true,
					resizable: true,
					/*	buttons: {
							"Ok": function() {
								$(this).dialog("close");
							},
							"Cancel": function() {
								$(this).dialog("close");
							}
						}*/
					});
					
					$('#dialogr').dialog({
					autoOpen: false,
					width: 400,
					draggable: true,
					resizable: true,
					/*	buttons: {
							"Ok": function() {
								$(this).dialog("close");
							},
							"Cancel": function() {
								$(this).dialog("close");
							}
						}*/
					});
					
					$(".dialog_video").click(function(){
					  		$('#dialogk').html('<p>'+$(this).data("val")+'</p>');
							$('#dialogk').dialog('open');
					});
				
					$(".dialog_reason").click(function(){
					  		$('#dialogr').html('<p>'+$(this).data("val")+'</p>');
							$('#dialogr').dialog('open');
					});
				
					 flowplayer("playerflow", "<?php echo base_url()."asset/flowplayer/" ?>flowplayer-3.2.16.swf", {
						key:'#$1972f2c4512bcba9deb',
						plugins: {
							/*'viral': {
								'url': 'flowplayer.viralvideos-3.2.13.swf',
								'share': {
									'description': 'Extreme surfers riding big waves'
								}
							},*/
							controls: {
								'url': '<?php echo base_url()."asset/flowplayer/" ?>flowplayer.controls-3.2.15.swf',
								backgroundColor: "transparent",
								backgroundGradient: "none",
								sliderColor: '#FFFFFF',
								sliderBorder: '1.5px solid rgba(160,160,160,0.7)',
								volumeSliderColor: '#FFFFFF',
								volumeBorder: '1.5px solid rgba(160,160,160,0.7)',
					 
								timeColor: '#ffffff',
								durationColor: '#535353',
					 
								tooltipColor: 'rgba(255, 255, 255, 0.7)',
								tooltipTextColor: '#000000'
							}
						},
						clip: {
							autoPlay: false,
							autoBuffering: true,
							start:0,
							duration:0,
						}/*,
						logo: {
							opacity:1,
							left:20,
							url:'http://morning-news.bectero.com/image/logo-bectero.png',
							fullscreenOnly:false,
							top:20
						}*/
					});
				
			});
			
</script>