<?php if ($this->session->flashdata('error')): ?>
<div class="notification error png_bg">
	<a href="#" class="close">
    		<img src="<?php echo site_url('asset/backoffice/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" />
    </a>
    <div>
        <?php echo $this->session->flashdata('error'); ?>
    </div>
</div>
<?php endif; ?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php if (validation_errors()): ?>
        <?php echo validation_errors('<div class="notification error png_bg"><a href="#" class="close"><img src="'.
		site_url('asset/backoffice/images/icons/cross_grey_small.png').'" title="Close this notification" alt="close" /></a><div>','</div></div>'); ?>
<?php endif; ?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php if ($this->session->flashdata('notice')): ?>
<div class="notification attention png_bg">
	<a href="#" class="close">
    		<img src="<?php echo site_url('asset/backoffice/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" />
    </a>
    <div>
        <?php echo $this->session->flashdata('notice'); ?>
    </div>
</div>
<?php endif; ?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php if (@$messages != ""): 
			echo @$messages;
endif; ?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php if ($this->session->flashdata('success')): ?>
<div class="notification success png_bg">
	<a href="#" class="close">
    		<img src="<?php echo site_url('asset/backoffice/images/icons/cross_grey_small.png'); ?>" title="Close this notification" alt="close" />
    </a>
    <div>
        <?php echo $this->session->flashdata('success'); ?>
    </div>
</div>
<?php endif; ?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php if ($this->session->flashdata('information')): ?>
<div class="notification information png_bg">
	<a href="#" class="close">
    			<img src="<?php echo base_url();?>asset/admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" />
    </a>
    <div>
        <?php echo $this->session->flashdata('success'); ?>
    </div>
</div>
<?php endif; ?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->