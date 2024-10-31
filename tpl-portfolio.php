<?php
/**
 * The template for displaying all pages
 *
 * Template Name: Portfolio
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pagli
 */

get_header(); ?>

	<div class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="portfolio-pg-content clearfix">
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>
			</div>

			<div class="pagli-portfolio-gride full-width clearfix">
				<?php
					$pquery = new WP_Query(array(
						'post_type' => 'portfolio',
						'posts_per_page' => -1,
					));	
				?>

				<div class="portfolio-filter">
					<span class="active" data-filter="*"><?php esc_html_e('All', 'pagli'); ?></span>
					<?php
						$terms = get_terms( array(
						    'taxonomy' => 'portfolio-category',
						    'hide_empty' => false,
						) );

						foreach($terms as $term) :
						?>
							<?php $id = $term->term_id; ?>
							<span data-filter=".cat-<?php echo(absint($id)); ?>"><?php echo esc_html($term->name); ?></span>
						<?php endforeach; ?>
				</div>

				<?php if($pquery->have_posts()) : ?>
					<div class="portfolio-gride clearfix">
					<?php while($pquery->have_posts()) : $pquery->the_post(); ?>
						<?php
							$port_thumb_img = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'pagli-portfolio-thumb' );

							$port_full_img = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'full' );

							$port_img_src = $port_thumb_img[0];

							$port_full_img_src = $port_full_img[0];

							$terms = get_the_terms(get_the_id(), 'portfolio-category');
							$cats = '';
							foreach($terms as $term) {
								$cats .= 'cat-'.$term->term_id.' ';
							}
							
							$cats = rtrim($cats);
						?>
						<div class="portfolio-poste cs-style-6 <?php echo esc_attr($cats); ?>">
							<figure>
								<img src="<?php echo esc_url($port_img_src); ?>" alt="<?php the_title_attribute(); ?>">
								<figcaption>
									<h3><?php the_title(); ?></h3>
									<a class="preview" href="<?php echo esc_url($port_full_img_src); ?>" data-fancybox><i class="fa fa-search"></i></a>
									<a class="readmore" href="<?php the_permalink(); ?>"><i class="fa fa-arrow-right"></i></a>
								</figcaption>
							</figure>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
					</div>
				<?php endif; ?>
			</div>
			<div style="clear: both;"></div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
