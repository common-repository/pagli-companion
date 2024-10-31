<?php
	/**
	* @var $member_name
	* @var $member_image
	* @var $member_designation
	* @var $member_socials (array)
	* @var $member_description
	*/
	extract($instance);
?>
<?php if(!empty($member_image)) : ?>
	<?php
		$mem_img = wp_get_attachment_image_src( $member_image, 'full' );
		$img_src = $mem_img[0];
	?>
	<div class="pagli-team-member">
		<figure class="member-img">
			<img src="<?php echo esc_url($img_src); ?>" />
		</figure>
		<div class="member-details">
			<ul class="member-social-icons clearfix">
				<?php if(!empty($member_socials['facebook'])) : ?>
					<li>
						<a href="<?php echo esc_url($member_socials['facebook']); ?>"><i class="fa fa-facebook"></i></a>
					</li>
				<?php endif; ?>
				<?php if(!empty($member_socials['twitter'])) : ?>
					<li>
						<a href="<?php echo esc_url($member_socials['twitter']); ?>"><i class="fa fa-twitter"></i></a>
					</li>
				<?php endif; ?>
				<?php if(!empty($member_socials['gplus'])) : ?>
					<li>
						<a href="<?php echo esc_url($member_socials['gplus']); ?>"><i class="fa fa-google-plus"></i></a>
					</li>
				<?php endif; ?>
				<?php if(!empty($member_socials['linkedin'])) : ?>
					<li>
						<a href="<?php echo esc_url($member_socials['linkedin']); ?>"><i class="fa fa-linkedin"></i></a>
					</li>
				<?php endif; ?>
			</ul>
			<?php if(!empty($member_name)) : ?>
				<span class='member-name clearfix'><?php echo $member_name; ?></span>
			<?php endif; ?>
			<?php if(!empty($member_designation)) : ?>
				<span class='member-designation clearfix'><?php echo $member_designation; ?></span>
			<?php endif; ?>
		</div>
		<?php if(!empty($member_description)) : ?>
			<div class="member-info">
			<?php echo esc_html($member_description); ?>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>