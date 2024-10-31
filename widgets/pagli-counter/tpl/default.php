<?php
	/**
	* @var $title
	* @var $counter
	*/
	extract($instance);
?>
<div class="pagli-counter">

    <?php if(!empty($counter)) : ?>
    	<div class="counter"><?php echo absint($counter); ?></div>
    <?php endif; ?>

	<?php if(!empty($title)) : ?>
    	<h3 class="title"><?php echo esc_html($title); ?></h3>
	<?php endif; ?>


</div>