<?php
/**
 * Archive options
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */

// Add archive section
$wp_customize->add_section( 'blog_diary_archive_section', array(
	'title'             => esc_html__( 'Blog/Archive','blog-diary' ),
	'description'       => esc_html__( 'Archive section options.', 'blog-diary' ),
	'panel'             => 'blog_diary_theme_options_panel',
) );

// Your latest posts title setting and control.
$wp_customize->add_setting( 'blog_diary_theme_options[your_latest_posts_title]', array(
	'default'           => $options['your_latest_posts_title'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'blog_diary_theme_options[your_latest_posts_title]', array(
	'label'             => esc_html__( 'Your Latest Posts Title', 'blog-diary' ),
	'description'       => esc_html__( 'This option only works if Static Front Page is set to "Your latest posts."', 'blog-diary' ),
	'section'           => 'blog_diary_archive_section',
	'type'				=> 'text',
	'active_callback'   => 'blog_diary_is_latest_posts'
) );

// Archive date meta setting and control.
$wp_customize->add_setting( 'blog_diary_theme_options[hide_date]', array(
	'default'           => $options['hide_date'],
	'sanitize_callback' => 'blog_diary_sanitize_switch_control',
) );

$wp_customize->add_control( new Blog_Diary_Switch_Control( $wp_customize, 'blog_diary_theme_options[hide_date]', array(
	'label'             => esc_html__( 'Hide Date', 'blog-diary' ),
	'section'           => 'blog_diary_archive_section',
	'on_off_label' 		=> blog_diary_hide_options(),
) ) );

// Archive author category setting and control.
$wp_customize->add_setting( 'blog_diary_theme_options[hide_category]', array(
	'default'           => $options['hide_category'],
	'sanitize_callback' => 'blog_diary_sanitize_switch_control',
) );

$wp_customize->add_control( new Blog_Diary_Switch_Control( $wp_customize, 'blog_diary_theme_options[hide_category]', array(
	'label'             => esc_html__( 'Hide Category', 'blog-diary' ),
	'section'           => 'blog_diary_archive_section',
	'on_off_label' 		=> blog_diary_hide_options(),
) ) );

// Archive author meta setting and control.
$wp_customize->add_setting( 'blog_diary_theme_options[hide_author]', array(
	'default'           => $options['hide_author'],
	'sanitize_callback' => 'blog_diary_sanitize_switch_control',
) );

$wp_customize->add_control( new Blog_Diary_Switch_Control( $wp_customize, 'blog_diary_theme_options[hide_author]', array(
	'label'             => esc_html__( 'Hide Author', 'blog-diary' ),
	'section'           => 'blog_diary_archive_section',
	'on_off_label' 		=> blog_diary_hide_options(),
) ) );
