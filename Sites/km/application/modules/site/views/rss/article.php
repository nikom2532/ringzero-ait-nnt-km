<?php
header("Content-Type: application/xml; charset=utf-8");   // ส่งค่าเป็น xml
?>
<?php
echo '<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0"><title>'.$topicrss.'</title>';
?>
<?php
		 if(!empty($rows)){
				 foreach($rows as $row) :
?>   
<article>
	<title><?php echo $row->ATC_title; ?></title>
    <cover><?php echo site_url('uploads/article/image/'.$row->ATC_image); ?></cover>
    <writer><?php echo $row->ATC_writer;  ?></writer>
	<date><?php echo th_date($row->ATC_date->format('Y-m-d'));  ?></date>
	<link><?php echo site_url('site/article/detail/'.$row->ATC_id); ?></link>
</article>
<?php 
		endforeach;
 }
 ?>
 <?php echo '</rss>'; ?>