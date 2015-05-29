<?php

global $data; //fetch options stored in $data

	//Left sidebar
	if (is_page_template('page-templates/template-left-sidebar.php') ) {
		echo '<div class="sidebar-left page-content">';
			dynamic_sidebar( 'primary-widget-area' );
		echo '</div>';
	} 
	
	//Right sidebar
	elseif (is_page_template('page-templates/template-right-sidebar.php') ) {
		echo '<div class="sidebar-right page-content">';
			dynamic_sidebar( 'primary-widget-area' );
		echo '</div>';
	} 
	
	//No sidebar
	elseif (is_page_template('template-full-width.php') ) {
		echo '';
	}
	
	elseif ($data['sidebar_position']) {
		
		$position = $data['sidebar_position'];

		//Left sidebar
		if ( $position == 'left' or is_page_template('page-templates/template-left-sidebar.php') ) {
			echo '<div class="sidebar-left page-content">';
				dynamic_sidebar( 'primary-widget-area' );
			echo '</div>';
		} 

		//Right sidebar
		elseif ( $position == 'right' or is_page_template('page-templates/template-right-sidebar.php') ) {
			echo '<div class="sidebar-right page-content">';
				dynamic_sidebar( 'primary-widget-area' );
			echo '</div>';
		} 

		//No sidebar
		elseif ( $position == 'none' or is_page_template('template-full-width.php') ) {
			echo '';
		}
		
	}

	else { 
		echo '<div class="sidebar-right page-content">';
			dynamic_sidebar( 'primary-widget-area' );
		echo '</div>';
	}

?>