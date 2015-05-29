<?php
	
	/* 
	Template Name: Teacher (Style 2)
	*/
	
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

			<?php the_content(); ?>
			
			<?php if( $data['teacher_items_pp'] ) { 
				$teacher_perpage = $data['teacher_items_pp'];
			}
			
			else {
				$teacher_perpage = '10';
			}
			
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;	
			
			$args = array(
				'post_type' => 'teacher',
				'posts_per_page' => $teacher_perpage,
				'paged' => $paged
			);

			$wp_query = new WP_Query($args);

				if($wp_query->have_posts()) : ?>
					
					<ul class="teacher-4">
					
					<?php while($wp_query->have_posts()) : 
						$wp_query->the_post(); ?>

						<?php // Get teacher position
						$teacher_position = get_post_meta($post->ID, $prefix.'teacher_position', true);
						if ( $teacher_position == '' ) { $teacher_position = __('N/A','qns'); }
						
						// Get teacher phone
						$teacher_phone = get_post_meta($post->ID, $prefix.'teacher_phone', true);
						if ( $teacher_phone == '' ) { $teacher_phone = __('N/A','qns'); }
						
						// Get teacher email
						$teacher_email = get_post_meta($post->ID, $prefix.'teacher_email', true);
						if ( $teacher_email == '' ) { $teacher_email = __('N/A','qns'); } ?>

						<li>
							<?php if( has_post_thumbnail() ) { ?>
								<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'image-style4' ); ?>
								<?php echo '<img src="' . $src[0] . '" alt="" />'; ?>
							<?php } ?>
							
							<h3 class="teacher-title">
							
								<?php if ($data['teacher_single_link']) { ?>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<?php } else { ?>
									<?php the_title(); ?>
								<?php } ?>
						
								<span><?php echo $teacher_position; ?></span>
							
							</h3>
								
							<?php print_excerpt(200); ?>
							<ul class="teacher-contact">
								<li><span class="contact-phone"><?php echo $teacher_phone; ?></span></li>
								<li><span class="contact-email"><?php echo $teacher_email; ?></span></li>
							</ul>
						</li>

				<?php endwhile; ?> 
				
				</ul>
				
				<?php else : ?>
					<p><?php _e('No teachers have been added yet!','qns'); ?></p>
				<?php endif; ?>
				
			<?php load_template( get_template_directory() . '/includes/pagination.php' ); ?>

		<!-- END .inner-content-wrapper -->
		</div>
		
	<!-- END .main-content -->
	</div>

<!-- END .content-wrapper -->
</div>

<?php get_footer(); ?>