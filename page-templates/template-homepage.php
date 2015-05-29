<?php
	
	/* 
	Template Name: Homepage
	*/

	//Display Header
	get_header();
	
	//Get Theme Options
	global $data;



/* ------------------------------------------------
	Display Slideshow
------------------------------------------------ */

if ($data['homepage_slider']) { ?>

	<div class="slider clearfix">
		<ul class="slides slide-loader">
			<?php $slides = $data['homepage_slider']; ?>	
			<?php foreach ($slides as $slide) { ?>
				<li style="background:url(<?php echo $slide['url']; ?>) no-repeat bottom center">
					<?php if ( $slide['link'] ) { echo '<a href="' . $slide['link'] . '" target="_blank" class="slide-link">'; } ?>
					<?php if ( $slide['description'] ) { echo '<div class="flex-caption-wrapper"><div class="flex-caption">' . $slide['description'] . '</div></div>'; } else { echo '&nbsp;'; } ?>
					<?php if ( $slide['link'] ) { echo '</a>'; } ?>
				</li>	
			<?php } ?>
		</ul>
	</div>

<?php } else { ?>
	
	<div class="slider clearfix">
		<ul class="slides slide-loader">
			<li style="background: #e4e4e4;">
				<div class="no-slides"><?php _e('No slides added yet? Go to "Appearance > Theme Options > Home Settings" and click "Add New Slide" in the "Homepage Slideshow" section.','qns'); ?></div>
			</li>
		</ul>
	</div>
	
<?php }



/* ------------------------------------------------
	Display Slideshow Blocks
------------------------------------------------ */

if ( $data['display_homepage_blocks'] ) {

	$blocks = $data['homepage_coloured_blocks'];
	
	if ( $data['homepage_coloured_blocks_number'] == 'Three') {
		$blocks_number = 'header-block-3';
	} 
	
	elseif ( $data['homepage_coloured_blocks_number'] == 'Four') {
		$blocks_number = 'header-block-4';
	} 
	
	elseif ( $data['homepage_coloured_blocks_number'] == 'Five') {
		$blocks_number = 'header-block-5';
	} 
	
	else {
		$blocks_number = 'header-block-5';
	} ?>
	
	<div class="header-block-wrapper clearfix">
		<div class="header-block-inner">
			<?php foreach ($blocks as $block) {
				if($block['colour'] ) { $background_colour = 'style="background: ' . $block['colour'] . '"';} 
				else {$background_colour = '';}
				echo '<a href="' . $block['link'] . '" class="' . $blocks_number . ' header-block-style-1 clearfix" ' . $background_colour . '>';
					echo '<img src="' . $block['url'] . '" alt="" />';
					echo '<h2>' . $block['title'] . '</h2>';
				echo '</a>';
			} ?>
		</div>
	</div>

<?php }



/* ------------------------------------------------
	Display Content
--------------------------------------------- */ ?>

<!-- BEGIN .content-wrapper -->
<div class="content-wrapper clearfix">
	
	<!-- BEGIN .content-wrapper-inner -->
	<div class="content-wrapper-inner clearfix">
	
		<!-- BEGIN .sidebar-left -->
		<div class="sidebar-left page-content">
		
			<?php if (is_active_sidebar('homepage-left-sidebar')) {
				dynamic_sidebar('homepage-left-sidebar');
			} else {
				echo '<div class="content-block"><p>Go to "Appearance > Widgets" and add some widgets in the "Homepage Left" widget area.</p></div>';
			} ?>
	
		<!-- END .sidebar-left -->
		</div>
	
		<!-- BEGIN .center-content -->
		<div class="center-content page-content">
		
			<?php if (is_active_sidebar('homepage-center-block')) {
				dynamic_sidebar('homepage-center-block');
			} else {
				echo '<div class="content-block"><p>Go to "Appearance > Widgets" and add some widgets in the "Homepage Center" widget area.</p></div>';
			} ?>
		
		<!-- END .center-content -->
		</div>
	
		<!-- BEGIN .sidebar-right -->
		<div class="sidebar-right page-content">
		
			<?php if (is_active_sidebar('homepage-right-sidebar')) {
				dynamic_sidebar('homepage-right-sidebar');
			} else {
				echo '<div class="content-block"><p>Go to "Appearance > Widgets" and add some widgets in the "Homepage Right" widget area.</p></div>';
			} ?>
	
		<!-- END .sidebar-right -->
		</div>
	
	<!-- END .content-wrapper-inner -->
	</div>
	
<!-- END .content-wrapper -->
</div>

<?php get_footer(); ?>