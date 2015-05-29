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

			<?php if (have_posts()) : ?>

				<div class="title1 clearfix">
					<h4><?php _e('Pages','qns') ?></h4>
					<div class="title-block"></div>
				</div>

				<!--BEGIN .search-results-list -->
				<ol class="search-results-list">

				<?php 
					// Return Post Items
					$i = 0;
					while (have_posts()) : the_post(); 

						if( get_post_type() !== 'post' and get_post_type() !== 'teacher' and get_post_type() !== 'event' and get_post_type() !== 'course' ) { 
							$i++; ?>

							<li><strong><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></strong><br /> <?php print_excerpt(100); ?></li>

						<?php }

					endwhile;?>

					<?php if( $i == 0 ) { ?><li><?php _e( 'No results were found.', 'qns' ); ?></li><?php } ?>

				<!--END .search-results-list -->
				</ol>

				<hr class="space1">

				<div class="title1 clearfix">
					<h4><?php _e('Blog','qns') ?></h4>
					<div class="title-block"></div>
				</div>

				<!--BEGIN .search-results-list -->
				<ol class="search-results-list">

				<?php 
					// Return Post Items
					$i = 0;
					while (have_posts()) : the_post(); 

						if( get_post_type() == 'post' ) { 
							$i++; ?>

							<li><strong><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></strong><br /> <?php print_excerpt(250); ?></li>

						<?php }

					endwhile;?>

					<?php if( $i == 0 ) { ?><li><?php _e( 'No results were found.', 'qns' ); ?></li><?php } ?>

				<!--END .search-results-list -->
				</ol>

				<hr class="space1">

				<div class="title1 clearfix">
					<h4><?php _e('Events','qns') ?></h4>
					<div class="title-block"></div>
				</div>

				<!--BEGIN .search-results-list -->
				<ol class="search-results-list">

				<?php 
					// Return Event Items
					$i = 0;
					while (have_posts()) : the_post();

						if( get_post_type() == 'event' ) {
							$i++; ?>

		                    <li><strong><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></strong><br /> <?php print_excerpt(250); ?></li>

						<?php }

			 		endwhile;?>

					<?php if( $i == 0 ) { ?><li><?php _e( 'No results were found.', 'qns' ); ?></li><?php } ?>

				<!--END .search-results-list -->
				</ol>

				<hr class="space1">

				<div class="title1 clearfix">
					<h4><?php _e('Teachers','qns') ?></h4>
					<div class="title-block"></div>
				</div>

				<!--BEGIN .search-results-list -->
				<ol class="search-results-list">

				<?php 
					// Return Event Items
					$i = 0;
					while (have_posts()) : the_post();

						if( get_post_type() == 'teacher' ) {
							$i++; ?>

		                    <li><strong><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></strong><br /> <?php print_excerpt(250); ?></li>

						<?php }

			 		endwhile;?>

					<?php if( $i == 0 ) { ?><li><?php _e( 'No results were found.', 'qns' ); ?></li><?php } ?>

				<!--END .search-results-list -->
				</ol>

				<hr class="space1">

				<div class="title1 clearfix">
					<h4><?php _e('Courses','qns') ?></h4>
					<div class="title-block"></div>
				</div>

				<!--BEGIN .search-results-list -->
				<ol class="search-results-list">

				<?php 
					// Return Event Items
					$i = 0;
					while (have_posts()) : the_post();

						if( get_post_type() == 'course' ) {
							$i++; ?>

		                    <li><strong><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></strong><br /> <?php print_excerpt(250); ?></li>

						<?php }

			 		endwhile;?>

					<?php if( $i == 0 ) { ?><li><?php _e( 'No results were found.', 'qns' ); ?></li><?php } ?>

				<!--END .search-results-list -->
				</ol>

				<?php // Include Pagination feature
				load_template( get_template_directory() . '/includes/pagination.php' );
				?>

			<?php else : ?>

				<div class="title1 clearfix">
					<h4><?php _e('Pages','qns') ?></h4>
					<div class="title-block"></div>
				</div>

				<!--BEGIN .search-results-list -->
				<ol class="search-results-list">
					<li><?php _e( 'No results were found.', 'qns' ); ?></li>
				</ol>

				<hr class="space1">

				<div class="title1 clearfix">
					<h4><?php _e('Blog','qns') ?></h4>
					<div class="title-block"></div>
				</div>

				<!--BEGIN .search-results-list -->
				<ol class="search-results-list">
					<li><?php _e( 'No results were found.', 'qns' ); ?></li>
				</ol>

				<hr class="space1">

				<div class="title1 clearfix">
					<h4><?php _e('Events','qns') ?></h4>
					<div class="title-block"></div>
				</div>

				<!--BEGIN .search-results-list -->
				<ol class="search-results-list">
					<li><?php _e( 'No results were found.', 'qns' ); ?></li>
				</ol>

				<hr class="space1">

				<div class="title1 clearfix">
					<h4><?php _e('Teachers','qns') ?></h4>
					<div class="title-block"></div>
				</div>

				<!--BEGIN .search-results-list -->
				<ol class="search-results-list">
					<li><?php _e( 'No results were found.', 'qns' ); ?></li>
				</ol>

				<hr class="space1">

				<div class="title1 clearfix">
					<h4><?php _e('Courses','qns') ?></h4>
					<div class="title-block"></div>
				</div>

				<!--BEGIN .search-results-list -->
				<ol class="search-results-list">
					<li><?php _e( 'No results were found.', 'qns' ); ?></li>
				</ol>

			<?php endif; ?>

		<!-- END .inner-content-wrapper -->
		</div>
		
	<!-- END .main-content -->
	</div>

	<?php get_sidebar(); ?>

<!-- END .content-wrapper -->
</div>

<?php get_footer(); ?>