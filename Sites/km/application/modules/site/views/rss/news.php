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
<news>
	<title><?php echo $row->N_title; ?></title>
    <writer><?php echo $row->N_writer;  ?></writer>
	<date><?php echo th_date($row->N_date->format('Y-m-d'));  ?></date>
	<link><?php echo site_url('site/news/detail/'.$row->N_id); ?></link>
</news>
<?php 
		endforeach;
 }
 ?>
 <?php echo '</rss>'; ?>