<?php
header("Content-Type: application/xml; charset=utf-8");   // ส่งค่าเป็น xml
?>
<?php
echo '<rss xmlns:a10="http://www.w3.org/2005/Atom" version="2.0">';
echo '<channel>';
echo '<title>'.$topicrss.'</title>';
	echo '<link></link>';
	echo '<description src="">'.$topicrss.'</description>';
	echo '<a10:id>'.$topicrss.'</a10:id>';
?>
<?php
		 if(!empty($rows)){
				 foreach($rows as $row) :
?>
	<item>
		<guid isPermaLink="false"></guid>
		<link><?php echo site_url('site/article/detail/'.$row->ATC_id); ?></link>
		<title><?php echo htmlencode($row->ATC_title); ?></title>
		<description><![CDATA[
			<img src="<?php echo site_url('uploads/article/image/'.$row->ATC_image); ?>" height="150" width="250" title="" /><?php echo htmlencode($row->ATC_desc); ?>]]>
		</description>
		<a10:updated><?php echo th_date($row->ATC_date->format('Y-m-d'));  ?></a10:updated>
		<pubDate><?php echo th_date($row->ATC_date->format('Y-m-d'));  ?></pubDate>
		<updated><?php echo th_date($row->ATC_date->format('Y-m-d'));  ?></updated>
	</item>
<?php 
		endforeach;
 }
 ?>
	</channel>
 <?php echo '</rss>'; ?>