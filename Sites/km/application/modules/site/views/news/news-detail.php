<script src="<?php echo base_url()."asset/flowplayer/" ?>flowplayer-3.2.11.min.js"></script>
<?php if(!empty($rows)){ foreach($rows as $rows) : ?>   

<?php endforeach; } ?>
<?php if(!empty($viewnum)){ foreach($viewnum as $viewnum) : ?>   

<?php endforeach; } ?>

<?php if(!empty($categorys)){ foreach($categorys as $cat) : ?>   
<?php 
if($cat->C_id==$rows->N_category_ref)
$txtcat = $cat->C_topic; ?>
<?php endforeach; } ?>
<div class="content">
                <div class="history">
                    <ul>
                        <li><a href="<?php echo site_url('site/news'); ?>" title="ข่าว/ข่าวสาร">ข่าว/ข่าวสาร</a></li>
                        <li><?php echo $txtcat; ?></li>
                    </ul>

                    <a href="javascript:history.back();" title="ย้อนกลับหน้าที่แล้ว" class="backward">&lt; ย้อนกลับหน้าที่แล้ว</a>
                </div>

                <div class="left-sidebar">
                    <div id="news-category" class="box-sidebar">
                        <div class="box-sidebar-header">
                            <h2>
                                <img src="<?php echo base_url('asset/site/images/'); ?>/news-detail-categories.png" alt="img">
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
                        <div class="box-article-contents">
                            <div class="article">
                                <div class="details">
                                    <div class="image">
                                    <img src="<?php echo $newspic[$rows->N_id]; ?>" onerror="this.src='<?php echo site_url('asset/site/images/picDefalt.png'); ?>';" height="95" width="150">
                                       <?php /*?> <a href="<?php echo site_url('site/article/detail/'.$rows->N_id); ?>" title="<?php echo $rows->N_title; ?>"><img src="<?php echo site_url('uploads/article/image/'.$rows->ATC_image); ?>" width="150"/></a><?php */?>
                                    </div>
                                    <div class="refference">
                                        <p>
                                            <span>ผู้เขียน : <?php echo $rows->N_writer;  ?> | </span>
                                           <span>ผู้เข้าชม : <?php echo $viewnum->MyCount; ?> | </span>
                                            <span><?php echo th_date($rows->N_date->format('Y-m-d'));  ?></span>
                                            
                                        </p>
                                       
                                    </div>
                                    <h3 class="article-title  bold  highlight">
                                   <?php echo $rows->N_title; ?>
                                    </h3>
                                    
                                    <!-- <div class="box-social">Social Media Script</div> -->
                                </div>
                            </div><!-- .article -->  

                            <div class="content-details">
                            
                                <p><?php echo htmldecode($rows->N_short_desc); ?></p>

                                <!-- Comments Footer Massage
                                <div class="footer-details">
                                    <p class="highlight  bold">จรูญ พิตะพันธ์ รายงาน</p>
                                </div>
                                -->
                                 <?php
										if(!empty($vdo)){
										 foreach($vdo as $vdo) :
										 $path = "http://61.19.244.31/centerapp/UploadFiles/Video/";
										$type = ".mp4";
										$video = $vdo->NV_Url; // path เก่า ที่จะนำมาตัดสริงเอาชื่อไฟล์และวันที่;
										if (strlen($video) > 115) //เช็คความยาวชื่อไฟล์วีดีโอก่อนจะตัด
										{
										   $video_name = substr($video,-40,-4);
										   $video_date = substr($video,-51,-41)."/Mobile/";
										}
										else
										{
										   $video_name = substr($video,-24,-4);
										   $video_date = substr($video,-35,-25)."/Mobile/";
										}

									?>  
                                <center><p> <?php echo ($vdo->NV_Url != "" ? '
						  <a href="'.$path.$video_date.$video_name.$type.'" style="display:block;width:640px;height:480px;" id="playerflow"></a>' : '') ?>
                          </p></center>
                           <?php 
								endforeach;
										}
						 			?>
                            </div>
                            
                            <div class="box-gallery">
								<div class="image-row">
									<div class="image-set">
                                     <?php
										if(!empty($gal)){
										 foreach($gal as $gal) :
									?>  
										<a class="example-image-link" href="<?php echo $gal->NG_image; ?>" data-lightbox="example-set" data-title="">
											<img class="example-image" src="<?php echo $gal->NG_ThumbnailUrl; ?>" alt=""/>
										</a>
                                    <?php 
								endforeach;
										}
						 			?>
										
									</div>
								</div>
                            </div>
                             
                        </div><!-- .box-article-contents -->
                    </div><!-- #news .box-article -->

 <?php  if(!empty($resent)){ ?>
                    <div id="related-news" class="box-article">
                        <div class="box-article-header">
                            <h2>
                                <img src="<?php echo base_url('asset/site/'); ?>/images/news-relate.png" alt="img">
                                <a target="_blank" href="<?php echo site_url('site/news/rss_catalog/'.$rows->N_category_ref); ?>" class="icon"><img src="<?php echo base_url('asset/site/'); ?>/images/rss.png"></a>
                            </h2>
                        </div>
                        <div class="box-article-contents">
                         <?php
								
										 foreach($resent as $resent) :
						?>   
                            <div class="article">
                                <div class="details">
                                    <div class="image">
                                        <img src="<?php echo $newsrepic[$resent->N_id]; ?>" onerror="this.src='<?php echo site_url('asset/site/images/picDefalt.png'); ?>';" width="150" height="95">
                                    </div>
                                    <div class="refference">
                                        <span>ผู้เขียน : <?php echo $resent->N_writer;  ?> | </span>
                                            <span>ผู้เข้าชม : <?php echo $numview[$resent->N_id]; ?> | </span>
                                            <span><?php echo th_date($resent->N_date->format('Y-m-d'));  ?></span>
                                    </div>
                                    <h3 class="article-title">
                                        <a href="<?php echo site_url('site/news/detail/'.$resent->N_id); ?>" title="<?php echo $resent->N_title; ?>" class="highlight  bold"><?php echo cut_word($resent->N_title,200); ?></a>
                                    </h3>
                                    <p><?php echo htmldecode(cut_word($resent->N_desc,450)); ?></p>
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