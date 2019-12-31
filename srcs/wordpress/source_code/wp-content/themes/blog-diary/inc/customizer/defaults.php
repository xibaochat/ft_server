<?php
/**
 * Customizer default options
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 * @return array An array of default values
 */

function blog_diary_get_default_theme_options() {
	$blog_diary_default_options = array(
		// Color Options
		'header_title_color'			=> '#fff',
		'header_tagline_color'			=> '#fff',
		'header_txt_logo_extra'			=> 'show-all',
				
		// breadcrumb
		'breadcrumb_enable'				=> true,
		'breadcrumb_separator'			=> '/',
		
		// layout 
		'site_layout'         			=> 'wide',
		'sidebar_position'         		=> 'right-sidebar',
		'post_sidebar_position' 		=> 'right-sidebar',
		'page_sidebar_position' 		=> 'right-sidebar',

		// excerpt options
		'long_excerpt_length'           => 25,
		'read_more_text'           		=> esc_html__( 'Read More', 'blog-diary' ),

		// pagination options
		'pagination_enable'         	=> true,
		'pagination_type'         		=> 'default',

		// footer options
		'copyright_text'           		=> sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s. ', '1: Year, 2: Site Title with home URL', 'blog-diary' ), '[the-year]', '[site-link]' ) . esc_html__( 'All Rights Reserved | ', 'blog-diary' ),
		'scroll_top_visible'        	=> true,

		// reset options
		'reset_options'      			=> false,
		
		// homepage sections sortable
		'sortable' 						=> 'slider,latest_posts,must_read_posts,blog',

		// blog/archive options
		'your_latest_posts_title' 		=> esc_html__( 'Blogs', 'blog-diary' ),
		'hide_date' 					=> false,
		'hide_category'					=> false,
		'hide_author'					=> false,

		// single post theme options
		'single_post_hide_date' 		=> false,
		'single_post_hide_author'		=> false,
		'single_post_hide_category'		=> false,
		'single_post_hide_tags'			=> false,

		/* Front Page */

		// Slider
		'slider_section_enable'				=> true,
		'slider_autoplay_enable'			=> false,

		//latest Posts
		'latest_posts_section_enable'		=> true,
		'latest_posts_title'				=> esc_html__( 'Latest Posts', 'blog-diary' ),

		//must_read Posts
		'must_read_posts_section_enable'	=> true,
		'must_read_posts_title'				=> esc_html__( 'Must Read Posts', 'blog-diary' ),
		'must_read_posts_btn_title'			=> esc_html__( 'Read More', 'blog-diary' ),

		// blog
		'blog_section_enable'			=> true,
		'blog_content_type'				=> 'recent',
		'blog_title'					=> esc_html__( 'Single Column Posts', 'blog-diary' ),
		'blog_btn_title'				=> esc_html__( 'Show All', 'blog-diary' ),

	);

	$output = apply_filters( 'blog_diary_default_theme_options', $blog_diary_default_options );

	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}