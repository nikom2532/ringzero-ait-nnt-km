<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- IE Compatibility modes -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><!--   -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knowledge Management National News Bureau of Thailand</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>asset/site/icon/favicon.ico"> 
    <link href="<?php echo base_url(); ?>asset/site/css/reset.css" rel="stylesheet" charset="utf-8">
    <link href="<?php echo base_url(); ?>asset/site/css/style.css" rel="stylesheet" charset="utf-8">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
    <?php echo $template['css']; ?>
    <?php echo $template['js']; ?>
</head>
<body>
    <div class="container">
        <?php echo $template['header']; ?>   
        <div class="shadow-main-nav"></div>
        <div class="wrapper">
			<?php echo $template['body']; ?>
             <!-- .content -->
        </div>
	   <?php echo $template['footer']; ?> 
    </div><!-- Close .container -->
</body>
</html>
<?php echo @$template['some_script']; ?> 
