<?php
	/**
	* @var $column
	* @var $orderby
	* @var $order
	* @var $no_of_posts
	* @var $excerpt_length
	* @var $readmore_text
	*/
	extract($instance);
?>
<?php
	$PGLI_COMPANION_query = new WP_Query(array(
		'posts_per_page' => 3,//$no_of_posts,
		'orderby' => $orderby,
		'order' => $order,
	));
?>
<?php if($PGLI_COMPANION_query->have_posts()) : ?>
	<div class="pagli-blog-carousel clearfix" data-col="col-<?php echo esc_attr($column); ?>">
		<?php while($PGLI_COMPANION_query->have_posts()) : $PGLI_COMPANION_query->the_post(); ?>
			<div class="blog-post">
				<div class="post-metas">
					<span class="day">
						<?php echo get_the_date('d'); ?>
						<span class="comment-count"><?php comments_number( 0, 1 ); ?></span>
					</span>
					<span class="month">
						<?php echo get_the_date('M'); ?>
					</span>
				</div>
				<div class="post-content">
					<a href="<?php the_permalink(); ?>"><h3><?php echo get_the_title(); ?></h3></a>
					<?php the_excerpt(); ?>
					<a class="readmore" href="<?php the_permalink(); ?>"><?php echo $readmore_text; ?></a>
					<div class="category-lists">
					<i class="fa fa-folder-o"></i>
					<?php echo get_the_category_list( ', ' ); ?>
					</div>
				</div>
			</div>
		<?php endwhile; wp_reset_postdata(); ?>
	</div>
<?php endif; ?>