<?php
	
	if ( is_post_type( "course" )) {
		load_template(get_template_directory().'/single-course.php');
	}
	
	elseif ( is_post_type( "portfolio" )) {
		load_template(get_template_directory().'/single-portfolio.php');
	}
	
	elseif ( is_post_type( "teacher" )) {
		load_template(get_template_directory().'/single-teacher.php');
	}
	
	elseif ( is_post_type( "event" )) {
		load_template(get_template_directory().'/single-event.php');
	}

	else {
		load_template(get_template_directory().'/single-default.php');
	}

?>