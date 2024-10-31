<?php
	/**
	* @var $portfolio_categories
	* @var $orderby
	* @var $order
	* @var $no_of_posts
	* @var $all_text
	* @var $readmore_icon
	* @var $popup_icon
	*/
	extract($instance);
?>
<?php
	$pquery = new WP_Query(array(
		'post_type' => 'portfolio',
		'tax_query' => array(
			array(
				'taxonomy' => 'portfolio-category',
				'field'    => 'term_id',
				'terms'    => $portfolio_categories
			)
		),
		'posts_per_page' => $no_of_posts,
		'orderby' => $orderby,
		'order' => $order,
	));
?>

<?php if($pquery->have_posts()) : ?>
	<div class="pagli-portfolio-grid clearfix">
		<div class="portfolio-filter">
			<span class="active" data-filter="*"><?php esc_html_e($all_text, 'pagli-companion'); ?></span>
			<?php foreach($portfolio_categories as $id) : ?>
					<?php $term = get_term($id); ?>
					<span data-filter=".cat-<?php echo(absint($id)); ?>"><?php echo $term->name; ?></span>
			<?php endforeach; ?>
		</div>
		<div class="portfolio-grid">
			<?php $count = 1; ?>
			<?php while($pquery->have_posts()) : $pquery->the_post(); ?>
				<?php
					$port_img_src = '';
					$port_full_img_src = '';

					if(has_post_thumbnail()){
						$img_size = 'pagli-companion-pfolio-grid1';
						$grid_class = 'grid1';
						if($count == 3) {
							$img_size = 'pagli-companion-pfolio-grid2';
							$grid_class = 'grid2';
						} elseif($count == 5) {
							$img_size = 'pagli-companion-pfolio-grid3';
							$grid_class = 'grid3';
						}

						$port_img = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), $img_size );
						$port_full_img = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'full' );

						$port_img_src = $port_img[0];
						$port_full_img_src = $port_full_img[0];
					}

					$terms = get_the_terms(get_the_id(), 'portfolio-category');
					$cats = '';
					foreach($terms as $term) {
						$cats .= 'cat-'.$term->term_id.' ';
					}
					
					$cats = rtrim($cats);
				?>
				<div class="portfolio-post cs-style-5 <?php echo $cats.' '.$grid_class; ?>">
					<figure>
						<img src="<?php echo esc_url($port_img_src); ?>" alt="img01">
						<figcaption>
							<h3><?php the_title(); ?></h3>
							<a class="preview" href="<?php echo esc_url($port_full_img_src); ?>" data-fancybox><?php echo siteorigin_widget_get_icon( $popup_icon ); ?></a>
							<a class="readmore" href="<?php the_permalink(); ?>"><?php echo siteorigin_widget_get_icon( $readmore_icon ); ?></a>
						</figcaption>
					</figure>
				</div> <?php $count++; ?>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
<?php endif; ?>