<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package pagli
 */

get_header(); ?>

	<div class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();
			$prev_post = get_previous_post();
			$next_post = get_next_post();

			?>
			<div class="portfolio-post-nav clearfix">
				<div class="prev-portfolio portfolio-nav">
					<?php if (!empty( $prev_post )): ?>
					  <a href="<?php echo esc_url($prev_post->guid); ?>"><i class="fa fa-long-arrow-left"></i> <?php echo esc_html($prev_post->post_title); ?></a>
					<?php endif ?>
				</div>
				<div class="all-portfolio portfolio-nav">
					<a href="#"><i class="fa fa-th-large"></i></a>
				</div>
				<div class="next-portfolio portfolio-nav">
					<?php if (!empty( $next_post )): ?>
					  <a href="<?php echo esc_url($next_post->guid); ?>"><?php echo esc_html($next_post->post_title); ?> <i class="fa fa-long-arrow-right"></i></a>
					<?php endif ?>
				</div>
			</div>

			<div class="portfolio-content">
				<?php the_content(); ?>
			</div>

			<?php if(has_post_thumbnail()) : ?>
				<?php
					$port_img = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'full' );
				?>
				<figure class="portfolio-main-image">
					<img src="<?php echo esc_url($port_img[0]); ?>" alt="<?php the_title_attribute(); ?>">
				</figure>
			<?php endif; ?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
