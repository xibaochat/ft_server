<?php
/**
 * Theme Palace widgets inclusion
 *
 * This is the template that includes all custom widgets of Blog Diary 
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */

/*
 * Add Recent Posts widget
 */
require get_template_directory() . '/inc/widgets/recent-posts-widget.php';

/**
 * Register widgets
 */
function blog_diary_register_widgets() {

	register_widget( 'Blog_Diary_Recent_Post' );
	
}
add_action( 'widgets_init', 'blog_diary_register_widgets' );
