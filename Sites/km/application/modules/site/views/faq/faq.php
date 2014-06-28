<div class="content">
                <div class="history">
                    <ul>
                        <li>คำถามที่พบบ่อย</li>
                    </ul>
                </div>
                <div id="contactus" class="box-article">
                    <div class="box-article-header">
                        <h2>
                            <img src="<?php echo base_url()."asset/site/"; ?>images/faq.png" alt="img">
                        </h2>
                    </div>
                    <div class="box-article-contents">
                        <div class="box-qa">
                            <ul>
                            <?php
									 if(!empty($rows)){
											 foreach($rows as $row) :
							?>      
                                <li>
                                    <p class="qa-title  highlight" style="font-size:large">
                                        <?php echo $row->FAQ_question; ?>
                                    </p>  
                                    <a href="#" class="bt-qa"></a>
                                    <p class="qa-message">
                                        <?php echo $row->FAQ_answer; ?>
                                    </p>
                                </li>
                              <?php 
											endforeach; 
									 }else{
											echo "<li><center><p>ไม่พบข้อมูล</p></center></li>";
									 }
						 ?>  
                                
                            </ul>
                        </div>
                    </div><!-- .box-article-contents -->
                </div><!-- #contact .box-article -->
            </div>
               <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.qa-message').hide();
            
            $('.bt-qa').click(function(e) {
            	e.preventDefault();

            	var obj = $(this);
            	obj.toggleClass('qa-hide').fadeIn('slow');
                //obj.parent().find('.qa-message').slideToggle('slow');
                obj.parent().find('.qa-message').fadeToggle('slow');
            });
        });
    </script>