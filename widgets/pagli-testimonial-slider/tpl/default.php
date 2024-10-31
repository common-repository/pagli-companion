<?php
	/**
	* @var $no_of_testimonials
	* @var $quote_icon
	* @var $auto_slide
	* @var $show_pager
	*/
	extract($instance);
?>

<?php
	$tquery = new WP_Query(array(
		'post_type' => 'testimonial',
		'posts_per_page' => $no_of_testimonials
	));
?>

<?php if($tquery->have_posts()) : ?>
	<div class="pagli-testimonial-slider owl-carousel">
		
		<?php while($tquery->have_posts()) : $tquery->the_post(); ?>

			<div class="testimony">
				<div class="testimony-content clearfix">

					<?php echo siteorigin_widget_get_icon( $quote_icon ); ?>

					<div class="client-testimony">
						<?php the_content(); ?>
					</div>

				</div>
				<div class="author-info clearfix">
					<div class="author-image">
						<?php
							$img_src = ''; // assign default client image
							if(has_post_thumbnail()) {
								$img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'pagli-companion-client-thumb');
								$img_src = $img[0];
							}
						?>
						<img src="<?php echo esc_url($img_src); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>">
					</div>
					<div class="author-name">
						<span class="name"><?php the_title(); ?></span>
						<span class="designation">Snr. Web Developer</span>
					</div>
				</div>
			</div>

		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</div>
<?php endif; ?>