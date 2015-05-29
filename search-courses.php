<?php
	// Display Header
	get_header();

	// Get Theme Options
	global $data;

	// Get Post ID
	global $wp_query;
	$post_id = $wp_query->post->ID;

	// Get Header Image
	$header_image = page_header(get_post_meta($post_id, 'qns_page_header_image_url', true));

	// Get Content ID/Class
	$content_id_class = content_id_class(get_post_meta($post_id, 'qns_page_sidebar', true));

?>

<!-- BEGIN .page-header -->
<div class="page-header clearfix" <?php echo $header_image;	?>>

	<div class="page-header-inner clearfix">
		<div class="page-title">
			<h2><?php _e('Search Results','qns'); ?></h2>
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

			<?php if(have_posts()) : ?>

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

				<?php while(have_posts()) :
					the_post(); ?>

					<?php // Get course name
					$course_name = get_post_meta($post->ID, $prefix.'course_name', true);
					if ( $course_name == '' ) { $course_name = __('N/A','qns'); }

					// Get course ID
					$course_id = get_post_meta($post->ID, $prefix.'course_id', true);
					if ( $course_id == '' ) { $course_id = 'N/A'; }

					// Get program type
					$program_type = get_post_meta($post->ID, $prefix.'program_type', true);
					if ( $program_type == '' ) { $program_type = 'N/A'; }

					// Get course length
					$course_length = get_post_meta($post->ID, $prefix.'course_length', true);
					if ( $course_length == '' ) { $course_length = 'N/A'; } ?>

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
		<?php wp_reset_postdata(); ?>

		<!-- END .inner-content-wrapper -->
		</div>

	<!-- END .main-content -->
	</div>

	<?php get_sidebar(); ?>

<!-- END .content-wrapper -->
</div>

<?php get_footer(); ?>