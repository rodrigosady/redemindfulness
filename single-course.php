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
		
		<?php // Get course name
		$course_name = get_post_meta($post->ID, $prefix.'course_name', true);
		if ( $course_name == '' ) { $course_name = __('N/A','qns'); }
		
		$course_id = get_post_meta($post->ID, $prefix.'course_id', true);
		$course_description = get_post_meta($post->ID, $prefix.'course_description', true);
		
		
		$tab_one_title = get_post_meta($post->ID, $prefix.'tab_one_title', true);
		$tab_one_content = get_post_meta($post->ID, $prefix.'tab_one_content', true);
		
		$tab_two_title = get_post_meta($post->ID, $prefix.'tab_two_title', true);
		$tab_two_content = get_post_meta($post->ID, $prefix.'tab_two_content', true);
		
		$tab_three_title = get_post_meta($post->ID, $prefix.'tab_three_title', true);
		$tab_three_content = get_post_meta($post->ID, $prefix.'tab_three_content', true);
		
		$tab_four_title = get_post_meta($post->ID, $prefix.'tab_four_title', true);
		$tab_four_content = get_post_meta($post->ID, $prefix.'tab_four_content', true);
		
		$tab_five_title = get_post_meta($post->ID, $prefix.'tab_five_title', true);
		$tab_five_content = get_post_meta($post->ID, $prefix.'tab_five_content', true);
		
		
		 ?>
		
		<div class="page-title">	
			<h2><?php echo $course_name; ?></h2>
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
				
				<?php if ( $course_id != '' ) { ?>
				<div class="title1 clearfix">
				<h4><?php echo __('Course Code','qns') . ': ' . $course_id; ?></h4>
				<div class="title-block"></div>
				</div>
				<?php } ?>
				
				<?php if( has_post_thumbnail() ) { ?>			
					<div class="course-desc-wrapper clearfix">
						<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'image-style11' ); ?>
						<?php echo '<img src="' . $src[0] . '" alt="" class="course-image" />'; ?>
						<p class="course-desc"><?php echo $course_description; ?></p>
					</div>
				<?php } else { ?>
					<p><?php echo $course_description; ?></p>
				<?php } ?>

				<!-- BEGIN #tabs -->
				<div id="tabs">
				
					<ul class="nav clearfix">
						
						<?php if ($tab_one_title != '') { ?>
							<li><a href="#tabs-tab-title-1"><?php echo $tab_one_title; ?></a></li>
						<?php } ?>
						
						<?php if ($tab_two_title != '') { ?>
							<li><a href="#tabs-tab-title-2"><?php echo $tab_two_title; ?></a></li>
						<?php } ?>
						
						<?php if ($tab_three_title != '') { ?>
							<li><a href="#tabs-tab-title-3"><?php echo $tab_three_title; ?></a></li>
						<?php } ?>
						
						<?php if ($tab_four_title != '') { ?>
							<li><a href="#tabs-tab-title-4"><?php echo $tab_four_title; ?></a></li>
						<?php } ?>
						
						<?php if ($tab_five_title != '') { ?>
							<li><a href="#tabs-tab-title-5"><?php echo $tab_five_title; ?></a></li>
						<?php } ?>

					</ul>
					
					<?php if ($tab_one_content != '') { ?>
						<div id="tabs-tab-title-1"><?php echo do_shortcode($tab_one_content); ?></div>
					<?php } ?>
					
					<?php if ($tab_two_content != '') { ?>
						<div id="tabs-tab-title-2"><?php echo do_shortcode($tab_two_content); ?></div>
					<?php } ?>
					
					<?php if ($tab_three_content != '') { ?>
						<div id="tabs-tab-title-3"><?php echo do_shortcode($tab_three_content); ?></div>
					<?php } ?>
					
					<?php if ($tab_four_content != '') { ?>
						<div id="tabs-tab-title-4"><?php echo do_shortcode($tab_four_content); ?></div>
					<?php } ?>
					
					<?php if ($tab_five_content != '') { ?>
						<div id="tabs-tab-title-5"><?php echo do_shortcode($tab_five_content); ?></div>
					<?php } ?>
				
				<!-- END #tabs -->
				</div>

				
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