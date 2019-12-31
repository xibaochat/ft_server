<?php
/**
 * Layout options
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'blog_diary_layout', array(
	'title'               => esc_html__('Layout','blog-diary'),
	'description'         => esc_html__( 'Layout section options.', 'blog-diary' ),
	'panel'               => 'blog_diary_theme_options_panel',
) );

// Site layout setting and control.
$wp_customize->add_setting( 'blog_diary_theme_options[site_layout]', array(
	'sanitize_callback'   => 'blog_diary_sanitize_select',
	'default'             => $options['site_layout'],
) );

$wp_customize->add_control(  new Blog_Diary_Custom_Radio_Image_Control ( $wp_customize, 'blog_diary_theme_options[site_layout]', array(
	'label'               => esc_html__( 'Site Layout', 'blog-diary' ),
	'section'             => 'blog_diary_layout',
	'choices'			  => blog_diary_site_layout(),
) ) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'blog_diary_theme_options[sidebar_position]', array(
	'sanitize_callback'   => 'blog_diary_sanitize_select',
	'default'             => $options['sidebar_position'],
) );

$wp_customize->add_control(  new Blog_Diary_Custom_Radio_Image_Control ( $wp_customize, 'blog_diary_theme_options[sidebar_position]', array(
	'label'               => esc_html__( 'Global Sidebar Position', 'blog-diary' ),
	'section'             => 'blog_diary_layout',
	'choices'			  => blog_diary_global_sidebar_position(),
) ) );

// Post sidebar position setting and control.
$wp_customize->add_setting( 'blog_diary_theme_options[post_sidebar_position]', array(
	'sanitize_callback'   => 'blog_diary_sanitize_select',
	'default'             => $options['post_sidebar_position'],
) );

$wp_customize->add_control(  new Blog_Diary_Custom_Radio_Image_Control ( $wp_customize, 'blog_diary_theme_options[post_sidebar_position]', array(
	'label'               => esc_html__( 'Posts Sidebar Position', 'blog-diary' ),
	'section'             => 'blog_diary_layout',
	'choices'			  => blog_diary_sidebar_position(),
) ) );

// Post sidebar position setting and control.
$wp_customize->add_setting( 'blog_diary_theme_options[page_sidebar_position]', array(
	'sanitize_callback'   => 'blog_diary_sanitize_select',
	'default'             => $options['page_sidebar_position'],
) );

$wp_customize->add_control( new Blog_Diary_Custom_Radio_Image_Control( $wp_customize, 'blog_diary_theme_options[page_sidebar_position]', array(
	'label'               => esc_html__( 'Pages Sidebar Position', 'blog-diary' ),
	'section'             => 'blog_diary_layout',
	'choices'			  => blog_diary_sidebar_position(),
) ) );