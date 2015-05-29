<?php
	
	/* 
	Template Name: Events
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

			<?php the_content(); ?>
			
			<?php if( $data['event_items_pp'] ) { 
				$event_perpage = $data['event_items_pp'];
			}
			
			else {
				$event_perpage = '10';
			}
			
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;	
			
			$args = array(
				
				'post_type' => 'event',
				'posts_per_page' => $event_perpage,
				'paged' => $paged,
				'meta_key' => 'qns_event_date',
				'orderby' => 'meta_value',
				'order' => !empty($data['event_order']) ? ($data['event_order'] == 'Oldest First' ? 'ASC' : 'DESC') : 'ASC',
				'meta_query' => array(
					array(
						'key' => 'qns_event_date',
						'value' => !empty($data['event_show_past']) ? 0 : date('Y-m-d'),
						'compare' => !empty($data['event_show_past']) ? '>=' :'>=',
						'type' => 'DATE'
					)
				)
				
			);

			$wp_query = new WP_Query($args);

			if($wp_query->have_posts()) : ?>
				
				<ul class="event-list-full">
				
					<?php while($wp_query->have_posts()) : 
						$wp_query->the_post(); ?>

						<?php // Get event date
						$e_date = get_post_meta($post->ID, $prefix.'event_date', true);
						if ( $e_date !== '' ) { 									
							$event_date_string = $e_date;
							$event_monthM = mysql2date( 'M', $event_date_string );
							$event_day = mysql2date( 'd', $event_date_string );
							$event_month = apply_filters('get_the_date', $event_monthM, 'M');
						}
						
						// If no date set
						else { 
							$event_month = "---";
							$event_day = "00";
						}
						
						// Get event time
						$e_time = get_post_meta($post->ID, $prefix.'event_time', true);
						if ( $e_time !== '' ) { $event_time = $e_time; }
						else { $event_time = __('No time set','qns'); }
						
						// Get event location
						$e_location = get_post_meta($post->ID, $prefix.'event_location', true);
						if ( $e_location !== '' ) { $event_location = $e_location; }
						else { $event_location = __('No location set','qns'); } ?>

						<!-- BEGIN .event-wrapper -->
						<li class="event-wrapper event-full clearfix">
					
							<div class="event-date">
								<div class="event-m"><?php echo $event_month; ?></div>
								<div class="event-d"><?php echo $event_day; ?></div>	
							</div>
				
							<div class="event-info">	
								<div class="event-meta">
									<h4><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?> &raquo;</a></h4>
									<p><strong><?php _e('Time','qns') ?>:</strong> <?php echo $event_time; ?></p>
									<p><strong><?php _e('Location','qns') ?>:</strong> <?php echo $event_location; ?></p>
								</div>
							</div>
				
						<!-- END .event-wrapper -->
						</li>

					<?php endwhile; else : ?>
					<p><?php _e('No events have been added yet!','qns'); ?></p>
				
				</ul>
				
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