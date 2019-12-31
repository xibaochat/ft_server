<?php
/**
 * pagination options
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'blog_diary_pagination', array(
	'title'               	=> esc_html__('Pagination','blog-diary'),
	'description'         	=> esc_html__( 'Pagination section options.', 'blog-diary' ),
	'panel'               	=> 'blog_diary_theme_options_panel',
) );

// Sidebar position setting and control.
$wp_customize->add_setting( 'blog_diary_theme_options[pagination_enable]', array(
	'sanitize_callback' 	=> 'blog_diary_sanitize_switch_control',
	'default'             	=> $options['pagination_enable'],
) );

$wp_customize->add_control( new Blog_Diary_Switch_Control( $wp_customize, 'blog_diary_theme_options[pagination_enable]', array(
	'label'               	=> esc_html__( 'Pagination Enable', 'blog-diary' ),
	'section'             	=> 'blog_diary_pagination',
	'on_off_label' 			=> blog_diary_switch_options(),
) ) );

// Site layout setting and control.
$wp_customize->add_setting( 'blog_diary_theme_options[pagination_type]', array(
	'sanitize_callback'   	=> 'blog_diary_sanitize_select',
	'default'             	=> $options['pagination_type'],
) );

$wp_customize->add_control( 'blog_diary_theme_options[pagination_type]', array(
	'label'               	=> esc_html__( 'Pagination Type', 'blog-diary' ),
	'section'             	=> 'blog_diary_pagination',
	'type'                	=> 'select',
	'choices'			  	=> blog_diary_pagination_options(),
	'active_callback'	  	=> 'blog_diary_is_pagination_enable',
) );
