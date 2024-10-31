<?php
	/**
	* @var $title
	* @var $icon
	* @var $icon_color
	* @var $price
	* @var $per
	* @var $btn_text
	* @var $btn_url
	* @var $color_scheme
	* @var $icon_color
	* @var $features
	*/
	extract($instance);
	$icon_styles[] = empty($instance['icon_size']) ? 'font-size: 60px' : 'font-size: '.intval($instance['icon_size']).'px';
	$icon_styles[] = empty($instance['icon_color']) ? 'color: #565656' : 'color: '.esc_attr($instance['icon_color']);
?>
<div class="pagli-pricing-table">
	<h3 class="pricing-title"><?php echo esc_html__($title); ?></h3>
	<?php echo siteorigin_widget_get_icon( $icon, $icon_styles  ); ?>
	<div class="price-per">
		<span class="price"><?php echo esc_html($price); ?></span>
		<span class="per"><?php echo esc_html($per); ?></span>
	</div>
	<ul class="features">
		<?php foreach($features as $feature) : ?>
			<li><?php echo $feature['feature_text']; ?></li>
		<?php endforeach; ?>
	</ul>
	<a class="price-btn" href="<?php echo esc_url($btn_url); ?>"><?php echo esc_html($btn_text); ?></a>
</div>