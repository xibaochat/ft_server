<?php
/**
 * Reset options
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'blog_diary_reset_section', array(
	'title'           	=> esc_html__('Reset all settings','blog-diary'),
	'description'    	=> esc_html__( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'blog-diary' ),
) );

// Add reset enable setting and control.
$wp_customize->add_setting( 'blog_diary_theme_options[reset_options]', array(
	'default'          	=> $options['reset_options'],
	'sanitize_callback' => 'blog_diary_sanitize_checkbox',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'blog_diary_theme_options[reset_options]', array(
	'label'            	=> esc_html__( 'Check to reset all settings', 'blog-diary' ),
	'section'         	=> 'blog_diary_reset_section',
	'type'              => 'checkbox',
) );
