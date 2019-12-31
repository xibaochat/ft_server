<?php
/**
 * Breadcrumb options
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */

$wp_customize->add_section( 'blog_diary_breadcrumb', array(
	'title'             => esc_html__( 'Breadcrumb','blog-diary' ),
	'description'       => esc_html__( 'Breadcrumb section options.', 'blog-diary' ),
	'panel'             => 'blog_diary_theme_options_panel',
) );

// Breadcrumb enable setting and control.
$wp_customize->add_setting( 'blog_diary_theme_options[breadcrumb_enable]', array(
	'sanitize_callback' => 'blog_diary_sanitize_switch_control',
	'default'          	=> $options['breadcrumb_enable'],
) );

$wp_customize->add_control( new Blog_Diary_Switch_Control( $wp_customize, 'blog_diary_theme_options[breadcrumb_enable]', array(
	'label'            	=> esc_html__( 'Enable Breadcrumb', 'blog-diary' ),
	'section'          	=> 'blog_diary_breadcrumb',
	'on_off_label' 		=> blog_diary_switch_options(),
) ) );

// Breadcrumb separator setting and control.
$wp_customize->add_setting( 'blog_diary_theme_options[breadcrumb_separator]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
	'default'          	=> $options['breadcrumb_separator'],
) );

$wp_customize->add_control( 'blog_diary_theme_options[breadcrumb_separator]', array(
	'label'            	=> esc_html__( 'Separator', 'blog-diary' ),
	'active_callback' 	=> 'blog_diary_is_breadcrumb_enable',
	'section'          	=> 'blog_diary_breadcrumb',
) );
