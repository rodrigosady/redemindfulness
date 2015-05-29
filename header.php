<?php 

// Fetch options stored in $data
global $data;
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html <?php language_attributes(); ?> class="ie6"> <![endif]-->
<!--[if IE 7]>    <html <?php language_attributes(); ?> class="ie7"> <![endif]-->
<!--[if IE 8]>    <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<!-- BEGIN head -->
<head>

	<!-- Meta Tags -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	
	<?php 
		// Dislay Google Analytics Code
		if( $data['google_analytics'] ) { 
			echo $data['google_analytics'];
		}
		
		// Dislay Favicon
		if( $data['custom_favicon'] ) { 			
			echo '<link rel="shortcut icon" href="' . $data['custom_favicon'] . '" type="image/x-icon" />';
		}
	?>
	
	<!-- Title -->
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<!-- RSS Feeds & Pingbacks -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php // Load Custom CSS 
		echo custom_css(); 
	?>
	
	<?php wp_head(); ?>
	
<!-- END head -->
</head>

<!-- BEGIN body -->
<body id="top" <?php body_class('loading'); ?>>

	<!-- BEGIN #header-wrapper -->
	<div id="header-wrapper">
		
		<!-- BEGIN #header-border -->
		<div id="header-border">
		
			<!-- BEGIN #header-top -->
			<div id="header-top" class="clearfix">

				<?php wp_nav_menu( array(
					'theme_location' => 'secondary',
					'container' =>false,
					'items_wrap' => '<ul class="top-left-nav clearfix">%3$s</ul>',
					'fallback_cb' => false,
					'echo' => true,
					'before' => '',
					'after' => '<span>/</span>',
					'link_before' => '',
					'link_after' => '',
					'depth' => 0 )
				); ?>
				
				<?php if( $data['phone_number'] or $data['email_address'] ) { ?>
				<ul class="top-right-nav clearfix">
					
					<?php if( $data['phone_number'] ) { ?>
					<li class="phone-icon"><?php echo $data['phone_number']; ?></li>
					<?php } ?>
					
					<?php if( $data['email_address'] ) { ?>
					<li class="email-icon"><?php echo $data['email_address']; ?></li>
					<?php } ?>
				
				</ul>
				<?php } ?>
			
			<!-- END #header-top -->
			</div>
			
			<!-- BEGIN #header-content-wrapper -->
			<div id="header-content-wrapper" class="clearfix">

				<?php if( $data['logo_image'] ) : ?>
					<div id="logo" class="site-title-image">
						<h1>
							<a href="<?php echo home_url(); ?>"><img src="<?php echo $data['logo_image']; ?>" alt="" /></a>
						</h1>
					</div>
				
				<?php elseif( $data['logo_text_dark'] ) : ?>	
					<div id="logo">
						<h1>
							<a href="<?php echo home_url(); ?>"><?php echo $data['logo_text_dark']; ?><span><?php echo $data['logo_text_light']; ?></span></a>
						</h1>
					</div>
				
				<?php else : ?>	
					<div id="logo">
						<h1>
							<a href="<?php echo home_url(); ?>"><?php _e('Park','qns'); ?><span><?php _e('College','qns'); ?></span></a>
						</h1>
					</div>
				<?php endif ?>

				<?php echo display_social(); ?>
			
			<!-- END #header-content-wrapper -->
			</div>
		
			<!-- BEGIN #main-menu-wrapper -->
			<div id="main-menu-wrapper" class="clearfix">
				
				<?php wp_nav_menu( array(
					'theme_location' => 'primary',
					'container' =>false,
					'items_wrap' => '<ul id="main-menu">%3$s</ul>',
					'fallback_cb' => 'wp_page_menu_qns',
					'echo' => true,
					'before' => '',
					'after' => '',
					'link_before' => '',
					'link_after' => '',
					'depth' => 0 )
				); ?>
				
				<?php if( $data['main_menu_search'] ) { ?>
				
				<div class="menu-search-button"></div>
				<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="menu-search-form">
					<input class="menu-search-field" type="text" onblur="if(this.value=='')this.value='To search, type and hit enter';" onfocus="if(this.value=='To search, type and hit enter')this.value='';" value="To search, type and hit enter" name="s" />
				</form>
				
				<?php } ?>
		
			<!-- END #main-menu-wrapper -->
			</div>
		
		<!-- END #header-border -->
		</div>
	
	<!-- END #header-wrapper -->
	</div>