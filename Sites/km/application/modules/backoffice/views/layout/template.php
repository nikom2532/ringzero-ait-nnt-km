<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $template['title']; ?></title>
	<base href="<?php echo base_url(); ?>" />
	<?php echo $template['metadata']; ?>

	<?php echo $template['css']; ?>
    <link rel="stylesheet" href="<?php echo site_url($this->config->item('TOrRy_theme')); ?>" type="text/css" media="screen" />

	<?php echo $template['js']; ?>
    <script src="<?php echo base_url()."asset/flowplayer/" ?>flowplayer-3.2.11.min.js"></script>
</head>
<body><div id="body-wrapper">
	<div id="sidebar">
    		<div id="sidebar-wrapper">
					<?php echo $template['menu']; ?>
            </div>
    </div>
	<div id="main-content">
			<?php echo @$template['shortcut']; ?>	
  		<div class="clear"></div>	
        	<?php echo $template['notices']; ?>
         <div class="clear"></div><br>
         	<?php echo @$template['search']; ?>
            <?php echo @$template['upload']; ?>	
		<div class="content-box">    	
                    <?php echo $template['body']; ?>	
        </div>
			<div id="footer">
			<?php echo $template['footer']; ?>	
		</div>
	</div>
</div>
</body>
</html>
