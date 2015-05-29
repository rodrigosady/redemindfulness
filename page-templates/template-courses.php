<?php
	
	/* 
	Template Name: Courses
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
	<div <?php echo $content_id_class; ?>>
	
		<!-- BEGIN .inner-content-wrapper -->
		<div class="inner-content-wrapper">
			
			<!-- BEGIN .course-finder-full -->
			<div class="course-finder-full clearfix">
				
				<div class="course-finder-icon"></div>
				<div class="course-finder-full-form">
					<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="clearfix">
						<select name="keyword-type">
							<option value="course_id"><?php _e('Course ID','qns'); ?></option>
							<option value="course_name"><?php _e('Course Name','qns'); ?></option>
							<option value="program_type"><?php _e('Program','qns'); ?></option>
							<option value="course_length"><?php _e('Length','qns'); ?></option>
						</select>
						<input type="text" onblur="if(this.value=='')this.value='<?php _e('Keywords','qns'); ?>';" onfocus="if(this.value=='<?php _e('Keywords','qns'); ?>')this.value='';" value="<?php _e('Keywords','qns'); ?>" name="s" />						
						<input type="submit" value="Search" />
					</form>
				</div>
			
			<!-- END .course-finder-full -->
			</div>

			<?php the_content(); ?>
			
			<?php
			if( $data['course_items_pp'] ) { 
				$course_perpage = $data['course_items_pp'];
			}
			else {
				$course_perpage = '10';
			}
			
			if( $data['course_order'] ) {
				
				if ( $data['course_order'] == 'Oldest First' ) {
					$course_order = 'ASC';
				} elseif ( $data['course_order'] == 'Newest First' ) {
					$course_order = 'DESC';
				}
				
			}
			else {
				$course_order = 'ASC';
			}
			
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;	
				
			$args = array(
				'post_type' => 'course',
				'posts_per_page' => $course_perpage,
				'paged' => $paged,
				'order' => $course_order
			);

			$wp_query = new WP_Query($args);

			if($wp_query->have_posts()) : ?>
				
			<table style="width:100%;">			
				<thead>
					<tr>
						<th><?php _e('ID','qns'); ?></th>
						<th><?php _e('Course Name','qns'); ?></th>
						<th><?php _e('Program','qns'); ?></th>
						<th><?php _e('Length','qns'); ?></th>
					</tr>
				</thead>
				<tbody>
					
					<?php while($wp_query->have_posts()) : 
						$wp_query->the_post(); ?>

						<?php // Get course name
						$course_name = get_post_meta($post->ID, $prefix.'course_name', true);
						if ( $course_name == '' ) { $course_name = __('N/A','qns'); }
						
						// Get course ID
						$course_id = get_post_meta($post->ID, $prefix.'course_id', true);
						if ( $course_id == '' ) { $course_id = __('N/A','qns'); }
						
						// Get program type
						$program_type = get_post_meta($post->ID, $prefix.'program_type', true);
						if ( $program_type == '' ) { $program_type = __('N/A','qns'); }
						
						// Get course length
						$course_length = get_post_meta($post->ID, $prefix.'course_length', true);
						if ( $course_length == '' ) { $course_length = __('N/A','qns'); } ?>
					
						<tr>
							<td data-title="<?php _e('ID','qns'); ?>"><?php echo $course_id; ?></td>
							<td data-title="<?php _e('Course Name','qns'); ?>"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo $course_name; ?></a></td>
							<td data-title="<?php _e('Program','qns'); ?>"><?php echo $program_type; ?></td>
							<td data-title="<?php _e('Length','qns'); ?>"><?php echo $course_length; ?></td>
						</tr>	

					<?php endwhile;?>
					
				</tbody>
			</table>
					
			<?php else : ?>
				<p><?php _e('No courses have been added yet!','qns'); ?></p>
			<?php endif; ?>
			<?php load_template( get_template_directory() . '/includes/pagination.php' ); ?>

		<!-- END .inner-content-wrapper -->
		</div>
		
	<!-- END .main-content -->
	</div>

	<?php get_sidebar(); ?>

<!-- END .content-wrapper -->
</div>

<?php get_footer(); ?>