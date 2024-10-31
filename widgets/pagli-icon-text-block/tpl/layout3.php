<?php
	/**
	* @var $title
	* @var $icon
	* @var $description
	* @var $layout
	*/
	extract($instance);
?>
<div class="pagli-icon-text-block clearfix <?php esc_attr_e($layout); ?>">
	<div class="icon-wrapper">
	<?php echo siteorigin_widget_get_icon( $icon ); ?>
	</div>
	<div class="content-wrapper">
		<?php if(!empty($title)) : ?>
	    	<h3 class="title"><?php echo esc_html($title); ?></h3>
		<?php endif; ?>

	    <?php if(!empty($description)) : ?>
	    	<div class="description"><?php echo esc_html($description); ?></div>
	    <?php endif; ?>
    </div>
</div>