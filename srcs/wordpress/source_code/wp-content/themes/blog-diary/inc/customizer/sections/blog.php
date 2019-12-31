<?php
/**
 * Blog Section options
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */

// Add Blog section
$wp_customize->add_section( 'blog_diary_blog_section', array(
    'title'             => esc_html__( 'Blog','blog-diary' ),
    'description'       => esc_html__( 'Blog Section options.', 'blog-diary' ),
    'panel'             => 'blog_diary_front_page_panel',
) );

// Blog content enable control and setting
$wp_customize->add_setting( 'blog_diary_theme_options[blog_section_enable]', array(
    'default'           =>  $options['blog_section_enable'],
    'sanitize_callback' => 'blog_diary_sanitize_switch_control',
) );

$wp_customize->add_control( new Blog_Diary_Switch_Control( $wp_customize, 'blog_diary_theme_options[blog_section_enable]', array(
    'label'             => esc_html__( 'Blog Section Enable', 'blog-diary' ),
    'section'           => 'blog_diary_blog_section',
    'on_off_label'      => blog_diary_switch_options(),
) ) );

// blog title setting and control
$wp_customize->add_setting( 'blog_diary_theme_options[blog_title]', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default'           => $options['blog_title'],
    'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'blog_diary_theme_options[blog_title]', array(
    'label'             => esc_html__( 'Title', 'blog-diary' ),
    'section'           => 'blog_diary_blog_section',
    'active_callback'   => 'blog_diary_is_blog_section_enable',
    'type'              => 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'blog_diary_theme_options[blog_title]', array(
        'selector'            => '#blog .archive-blog-wrapper .section-header h2.section-title',
        'settings'            => 'blog_diary_theme_options[blog_title]',
        'container_inclusive' => false,
        'fallback_refresh'    => true,
        'render_callback'     => 'blog_diary_blog_title_partial',
    ) );
}

// Blog content type control and setting
$wp_customize->add_setting( 'blog_diary_theme_options[blog_content_type]', array(
    'default'           => $options['blog_content_type'],
    'sanitize_callback' => 'blog_diary_sanitize_select',
) );

$wp_customize->add_control( 'blog_diary_theme_options[blog_content_type]', array(
    'label'             => esc_html__( 'Content Type', 'blog-diary' ),
    'section'           => 'blog_diary_blog_section',
    'type'              => 'select',
    'active_callback'   => 'blog_diary_is_blog_section_enable',
    'choices'           => array( 
        'category'  => esc_html__( 'Category', 'blog-diary' ),
        'recent'    => esc_html__( 'Recent', 'blog-diary' ),
    ),
) );

// Add dropdown category setting and control.
$wp_customize->add_setting(  'blog_diary_theme_options[blog_content_category]', array(
    'sanitize_callback' => 'blog_diary_sanitize_single_category',
) ) ;

$wp_customize->add_control( new Blog_Diary_Dropdown_Taxonomies_Control( $wp_customize,'blog_diary_theme_options[blog_content_category]', array(
    'label'             => esc_html__( 'Select Category', 'blog-diary' ),
    'description'       => esc_html__( 'Note: Latest selected no of posts will be shown from selected category', 'blog-diary' ),
    'section'           => 'blog_diary_blog_section',
    'type'              => 'dropdown-taxonomies',
    'active_callback'   => 'blog_diary_is_blog_section_content_category_enable'
) ) );

// Add dropdown categories setting and control.
$wp_customize->add_setting( 'blog_diary_theme_options[blog_category_exclude]', array(
    'sanitize_callback' => 'blog_diary_sanitize_category_list',
) ) ;

$wp_customize->add_control( new Blog_Diary_Dropdown_Multiple_Chooser( $wp_customize,'blog_diary_theme_options[blog_category_exclude]', array(
    'label'             => esc_html__( 'Select Excluding Categories', 'blog-diary' ),
    'section'           => 'blog_diary_blog_section',
    'type'              => 'dropdown_multiple_chooser',
    'choices'           =>  blog_diary_category_choices(),
    'active_callback'   => 'blog_diary_is_blog_section_content_recent_enable'
) ) );

// blog btn title setting and control
$wp_customize->add_setting( 'blog_diary_theme_options[blog_btn_title]', array(
    'sanitize_callback' => 'sanitize_text_field',
    'default'           => $options['blog_btn_title'],
) );

$wp_customize->add_control( 'blog_diary_theme_options[blog_btn_title]', array(
    'label'             => esc_html__( 'Button Label', 'blog-diary' ),
    'section'           => 'blog_diary_blog_section',
    'active_callback'   => 'blog_diary_is_blog_section_enable',
    'type'              => 'text',
) );
