<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'blog_diary_single_post_section', array(
	'title'             => esc_html__( 'Single Post','blog-diary' ),
	'description'       => esc_html__( 'Options to change the single posts globally.', 'blog-diary' ),
	'panel'             => 'blog_diary_theme_options_panel',
) );

// Archive date meta setting and control.
$wp_customize->add_setting( 'blog_diary_theme_options[single_post_hide_date]', array(
	'default'           => $options['single_post_hide_date'],
	'sanitize_callback' => 'blog_diary_sanitize_switch_control',
) );

$wp_customize->add_control( new Blog_Diary_Switch_Control( $wp_customize, 'blog_diary_theme_options[single_post_hide_date]', array(
	'label'             => esc_html__( 'Hide Date', 'blog-diary' ),
	'section'           => 'blog_diary_single_post_section',
	'on_off_label' 		=> blog_diary_hide_options(),
) ) );

// Archive author meta setting and control.
$wp_customize->add_setting( 'blog_diary_theme_options[single_post_hide_author]', array(
	'default'           => $options['single_post_hide_author'],
	'sanitize_callback' => 'blog_diary_sanitize_switch_control',
) );

$wp_customize->add_control( new Blog_Diary_Switch_Control( $wp_customize, 'blog_diary_theme_options[single_post_hide_author]', array(
	'label'             => esc_html__( 'Hide Author', 'blog-diary' ),
	'section'           => 'blog_diary_single_post_section',
	'on_off_label' 		=> blog_diary_hide_options(),
) ) );

// Archive author category setting and control.
$wp_customize->add_setting( 'blog_diary_theme_options[single_post_hide_category]', array(
	'default'           => $options['single_post_hide_category'],
	'sanitize_callback' => 'blog_diary_sanitize_switch_control',
) );

$wp_customize->add_control( new Blog_Diary_Switch_Control( $wp_customize, 'blog_diary_theme_options[single_post_hide_category]', array(
	'label'             => esc_html__( 'Hide Category', 'blog-diary' ),
	'section'           => 'blog_diary_single_post_section',
	'on_off_label' 		=> blog_diary_hide_options(),
) ) );

// Archive tag category setting and control.
$wp_customize->add_setting( 'blog_diary_theme_options[single_post_hide_tags]', array(
	'default'           => $options['single_post_hide_tags'],
	'sanitize_callback' => 'blog_diary_sanitize_switch_control',
) );

$wp_customize->add_control( new Blog_Diary_Switch_Control( $wp_customize, 'blog_diary_theme_options[single_post_hide_tags]', array(
	'label'             => esc_html__( 'Hide Tag', 'blog-diary' ),
	'section'           => 'blog_diary_single_post_section',
	'on_off_label' 		=> blog_diary_hide_options(),
) ) );
