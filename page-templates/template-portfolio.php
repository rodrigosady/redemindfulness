<?php
	
	/* 
	Template Name: Portfolio
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

			<?php if( $data['portfolio_items_pp'] ) { 
				$portfolio_perpage = $data['portfolio_items_pp'];
			}
			
			else {
				$portfolio_perpage = '10';
			}
			
			if( $data['portfolio_columns'] ) {
				
				if( $data['portfolio_columns'] == 'Two' ) {
					$portfolio_columns = '2';
				} elseif( $data['portfolio_columns'] == 'Three' ) {
					$portfolio_columns = '3';
				} elseif( $data['portfolio_columns'] == 'Four' ) {
					$portfolio_columns = '4';
				} else {
					$portfolio_columns = '3';
				}
				
			}
			
			else {
				$portfolio_columns = '3';
			}
			
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;		
			$args = array(
				'post_type' => 'portfolio',
				'posts_per_page' => $portfolio_perpage,
				'paged' => $paged
			);

			$wp_query = new WP_Query($args);

			if($wp_query->have_posts()) : ?>
				
				<ul class="portfolio-<?php echo $portfolio_columns; ?> clearfix">
				
					<?php while($wp_query->have_posts()) : 
						$wp_query->the_post(); ?>

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
					
						<?php get_template_part( 'loop', 'style3' ); ?>

					<?php endwhile;?>
						
				</ul>
					
				<?php else : ?>
					<p><?php _e('No portfolios have been added yet!','qns'); ?></p>
				<?php endif; ?>
				
			<?php load_template( get_template_directory() . '/includes/pagination.php' ); ?>

		<!-- END .inner-content-wrapper -->
		</div>
		
	<!-- END .main-content -->
	</div>

<!-- END .content-wrapper -->
</div>

<?php get_footer(); ?>