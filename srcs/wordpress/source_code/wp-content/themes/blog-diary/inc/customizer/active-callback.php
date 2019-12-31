<?php
/**
 * Customizer active callbacks
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */

if ( ! function_exists( 'blog_diary_is_breadcrumb_enable' ) ) :
	/**
	 * Check if breadcrumb is enabled.
	 *
	 * @since Blog Diary  1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function blog_diary_is_breadcrumb_enable( $control ) {
		return $control->manager->get_setting( 'blog_diary_theme_options[breadcrumb_enable]' )->value();
	}
endif;

if ( ! function_exists( 'blog_diary_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since Blog Diary  1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function blog_diary_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'blog_diary_theme_options[pagination_enable]' )->value();
	}
endif;

/**
 * Front Page Active Callbacks
 */

/**
 * Check if slider section is enabled.
 *
 * @since Blog Diary  1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function blog_diary_is_slider_section_enable( $control ) {
	return ( $control->manager->get_setting( 'blog_diary_theme_options[slider_section_enable]' )->value() );
}

/**
 * Check if latest_posts section is enabled.
 *
 * @since Blog Diary  1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function blog_diary_is_latest_posts_section_enable( $control ) {
	return ( $control->manager->get_setting( 'blog_diary_theme_options[latest_posts_section_enable]' )->value() );
}

/**
 * Check if must_read_posts section is enabled.
 *
 * @since Blog Diary  1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function blog_diary_is_must_read_posts_section_enable( $control ) {
	return ( $control->manager->get_setting( 'blog_diary_theme_options[must_read_posts_section_enable]' )->value() );
}

/**
 * Check if blog section is enabled.
 *
 * @since Blog Diary  1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function blog_diary_is_blog_section_enable( $control ) {
	return ( $control->manager->get_setting( 'blog_diary_theme_options[blog_section_enable]' )->value() );
}

/**
 * Check if blog section content type is category.
 *
 * @since Blog Diary  1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function blog_diary_is_blog_section_content_category_enable( $control ) {
	$content_type = $control->manager->get_setting( 'blog_diary_theme_options[blog_content_type]' )->value();
	return blog_diary_is_blog_section_enable( $control ) && ( 'category' == $content_type );
}

/**
 * Check if blog section content type is recent.
 *
 * @since Blog Diary  1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function blog_diary_is_blog_section_content_recent_enable( $control ) {
	$content_type = $control->manager->get_setting( 'blog_diary_theme_options[blog_content_type]' )->value();
	return blog_diary_is_blog_section_enable( $control ) && ( 'recent' == $content_type );
}
