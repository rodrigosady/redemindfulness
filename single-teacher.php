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
	<div <?php echo $content_id_class; ?>>
	
		<!-- BEGIN .inner-content-wrapper -->
		<div class="inner-content-wrapper">
			
			<?php if ( post_password_required() ) {
				echo qns_password_form();
			} else { ?>
			
			<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
				<?php // Get teacher position
				$teacher_position = get_post_meta($post->ID, $prefix.'teacher_position', true);
				if ( $teacher_position == '' ) { $teacher_position = __('N/A','qns'); }

				// Get teacher phone
				$teacher_phone = get_post_meta($post->ID, $prefix.'teacher_phone', true);
				if ( $teacher_phone == '' ) { $teacher_phone = __('N/A','qns'); }

				// Get teacher email
				$teacher_email = get_post_meta($post->ID, $prefix.'teacher_email', true);
				if ( $teacher_email == '' ) { $teacher_email = __('N/A','qns'); } ?>
					
					<?php if ($data['teacher_single_style'] == 'Style Two') { ?>
						
						<ul class="teacher-4 teacher-single">
							<li>
								<?php if( has_post_thumbnail() ) { ?>
									<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'image-style4' ); ?>
									<?php echo '<img src="' . $src[0] . '" alt="" />'; ?>
								<?php } ?>
								<h3 class="teacher-title"><?php the_title(); ?><span><?php echo $teacher_position; ?></span></h3>
								<?php print_excerpt(200); ?>
								<ul class="teacher-contact">
									<li><span class="contact-phone"><?php echo $teacher_phone; ?></span></li>
									<li><span class="contact-email"><?php echo $teacher_email; ?></span></li>
								</ul>
							</li>
						</ul>
						
					<?php } else { ?>
						
						<!-- BEGIN .teacher-entry -->
						<div class="teacher-entry clearfix">

							<?php if( has_post_thumbnail() ) { ?>
								<div class="teacher-image">	
									<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'image-style3' ); ?>
									<?php echo '<img src="' . $src[0] . '" alt="" />'; ?>
								</div>
							<?php } ?>

							<div class="teacher-content">	

								<?php the_content(); ?>

								<ul class="teacher-contact">
									<li><span class="contact-phone"><?php echo $teacher_phone; ?></span></li>
									<li><span class="contact-email"><?php echo $teacher_email; ?></span></li>
								</ul>

							</div>

						<!-- END .teacher-entry -->
						</div>
						
					<?php } ?>
					
				<?php endwhile;endif; ?>
				
				<?php } ?>
				
		<!-- END .inner-content-wrapper -->
		</div>
		
	<!-- END .main-content -->
	</div>

	<?php get_sidebar(); ?>

<!-- END .content-wrapper -->
</div>

<?php get_footer(); ?>