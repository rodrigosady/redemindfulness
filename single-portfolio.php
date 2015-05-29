<?php
	
	// Display Header
	get_header();
	
	// Get Theme Options
	global $data;
	
	// Get Post ID
	global $wp_query;$post_id = $wp_query->post->ID;
	
	// Get Header Image
	$header_image = page_header(get_post_meta($post_id, 'qns_page_header_image_url', true));
	
	// Get Content ID/Class
	$content_id_class = content_id_class(get_post_meta($post_id, 'qns_page_sidebar', true));
	
	// Reset Query
	wp_reset_query();

?>

<!-- BEGIN .page-header -->
<div class="page-header clearfix" <?php echo $header_image;	?>>
	
	<div class="page-header-inner clearfix">	
		<div class="page-title">	
			<h2><?php the_title(); ?></h2>
			<div class="page-title-block"></div>
		</div>
		<?php dimox_breadcrumbs(); ?>
	</div>
	
<!-- END .page-header -->
</div>

<!-- BEGIN .content-wrapper -->
<div class="content-wrapper page-content-wrapper clearfix">

	<!-- BEGIN .main-content -->
	<div class="main-content-full page-content">
	
		<!-- BEGIN .inner-content-wrapper -->
		<div class="inner-content-wrapper">
			
			<?php if ( post_password_required() ) {
				echo qns_password_form();
			} else { ?>
			
			<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<?php // Get Portfolio Main Title
				$portfolio_main_title = get_post_meta($post->ID, $prefix.'portfolio_main_title', true);
				if ( $portfolio_main_title == '' ) { $portfolio_main_title = 'N/A'; }
					
				// Get Portfolio Main Content
				$portfolio_main_content = get_post_meta($post->ID, $prefix.'portfolio_main_content', true);
				if ( $portfolio_main_content == '' ) { $portfolio_main_content = 'N/A'; }
					
				// Get Portfolio Secondary Title
				$portfolio_secondary_title = get_post_meta($post->ID, $prefix.'portfolio_secondary_title', true);
				if ( $portfolio_secondary_title == '' ) { $portfolio_secondary_title = 'N/A'; }
					
				// Get Portfolio Secondary Content
				$portfolio_secondary_content = get_post_meta($post->ID, $prefix.'portfolio_secondary_content', true);
				if ( $portfolio_secondary_content == '' ) { $portfolio_secondary_content = 'N/A'; } ?>

				<?php if (get_post_meta($post->ID, '_slideshow_images', true) != '') { ?>
					<?php $attachments = get_post_meta($post->ID, '_slideshow_images', true); ?>

					<!-- BEGIN .page-slider -->
					<div class="page-slider portfolio-slider clearfix">
						<ul class="slides slide-page-loader">

						<?php $attachments_array = array_filter( explode( ',', $attachments ) );

							// Display Attachments
							if ( $attachments_array ) {

								foreach ( $attachments_array as $attachment_id ) {	
									
									$link = wp_get_attachment_link($attachment_id, 'image-style7', false); ?>
									<li>
										<?php echo $link; ?>
										<?php if ( get_post_field('post_excerpt', $attachment_id) != '' ) {
											echo '<div class="flex-caption">' . get_post_field('post_excerpt', $attachment_id) . '</div>';
										} ?>
									</li>
								<?php }
								 
							 } ?>

							</ul>
						<!-- END .page-slider -->
						</div>

					<?php } elseif ( has_post_thumbnail() ) { ?>		
						 
							<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'image-style7' ); ?>
							<?php echo '<img src="' . $src[0] . '" alt="" class="portfolio-image-single" />'; ?>
							
					<?php } ?>

					<ul class="portfolio-single-cols">

						<li class="col-1">
							<div class="title1 clearfix">
								<h4><?php echo $portfolio_main_title; ?></h4>
								<div class="title-block"></div>
							</div>
							<?php echo $portfolio_main_content; ?>
						</li>

						<li class="col-2">
							<div class="title1 clearfix">
								<h4><?php echo $portfolio_secondary_title; ?></h4>
								<div class="title-block"></div>
							</div>
							<?php echo $portfolio_secondary_content; ?>
						</li>

					</ul>

				<?php endwhile; endif; ?>
				
				<?php } ?>
				
		<!-- END .inner-content-wrapper -->
		</div>
		
	<!-- END .main-content -->
	</div>

<!-- END .content-wrapper -->
</div>

<?php get_footer(); ?>