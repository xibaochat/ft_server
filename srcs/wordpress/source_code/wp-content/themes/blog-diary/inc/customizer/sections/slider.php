<?php
/**
 * Slider Section options
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */

// Add Slider section
$wp_customize->add_section( 'blog_diary_slider_section', array(
	'title'             => esc_html__( 'Slider','blog-diary' ),
	'description'       => esc_html__( 'Slider Section options.', 'blog-diary' ),
	'panel'             => 'blog_diary_front_page_panel',
) );

// Slider content enable control and setting
$wp_customize->add_setting( 'blog_diary_theme_options[slider_section_enable]', array(
	'default'			=> 	$options['slider_section_enable'],
	'sanitize_callback' => 'blog_diary_sanitize_switch_control',
) );

// Slider content enable control and setting
$wp_customize->add_setting( 'blog_diary_theme_options[slider_autoplay_enable]', array(
	'default'			=> 	$options['slider_autoplay_enable'],
	'sanitize_callback' => 'blog_diary_sanitize_switch_control',
) );

$wp_customize->add_control( new Blog_Diary_Switch_Control( $wp_customize, 'blog_diary_theme_options[slider_autoplay_enable]', array(
	'label'             => esc_html__( 'Slider Autoplay Enable', 'blog-diary' ),
	'section'           => 'blog_diary_slider_section',
	'active_callback'   => 'blog_diary_is_slider_section_enable',
	'on_off_label' 		=> blog_diary_switch_options(),
) ) );

$wp_customize->add_control( new Blog_Diary_Switch_Control( $wp_customize, 'blog_diary_theme_options[slider_section_enable]', array(
	'label'             => esc_html__( 'Slider Section Enable', 'blog-diary' ),
	'section'           => 'blog_diary_slider_section',
	'on_off_label' 		=> blog_diary_switch_options(),
) ) );

for ( $i = 1; $i <= 3; $i++ ) :

	// slider pages drop down chooser control and setting
	$wp_customize->add_setting( 'blog_diary_theme_options[slider_content_post_'. $i .']', array(
		'sanitize_callback' => 'blog_diary_sanitize_page',
	) );

	$wp_customize->add_control( new Blog_Diary_Dropdown_Chooser( $wp_customize, 'blog_diary_theme_options[slider_content_post_'. $i .']', array(
		'label'             => esc_html__( 'Select Post', 'blog-diary' ),
		'section'           => 'blog_diary_slider_section',
		'choices'			=> blog_diary_post_choices(),
		'active_callback'	=> 'blog_diary_is_slider_section_enable',
	) ) );

endfor;
