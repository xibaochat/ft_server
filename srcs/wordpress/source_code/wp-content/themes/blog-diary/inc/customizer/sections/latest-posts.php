<?php
/**
 * Latest Posts Section options
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */

// Add Latest Posts section
$wp_customize->add_section( 'blog_diary_latest_posts_section', array(
	'title'             => esc_html__( 'Latest Posts','blog-diary' ),
	'description'       => esc_html__( 'Latest Posts Section options.', 'blog-diary' ),
	'panel'             => 'blog_diary_front_page_panel',
) );

// Latest Posts content enable control and setting
$wp_customize->add_setting( 'blog_diary_theme_options[latest_posts_section_enable]', array(
	'default'			=> 	$options['latest_posts_section_enable'],
	'sanitize_callback' => 'blog_diary_sanitize_switch_control',
) );

$wp_customize->add_control( new Blog_Diary_Switch_Control( $wp_customize, 'blog_diary_theme_options[latest_posts_section_enable]', array(
	'label'             => esc_html__( 'Latest Posts Section Enable', 'blog-diary' ),
	'section'           => 'blog_diary_latest_posts_section',
	'on_off_label' 		=> blog_diary_switch_options(),
) ) );

// latest_posts title setting and control
$wp_customize->add_setting( 'blog_diary_theme_options[latest_posts_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['latest_posts_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'blog_diary_theme_options[latest_posts_title]', array(
	'label'           	=> esc_html__( 'Title', 'blog-diary' ),
	'section'        	=> 'blog_diary_latest_posts_section',
	'active_callback' 	=> 'blog_diary_is_latest_posts_section_enable',
	'type'				=> 'text',
) );

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'blog_diary_theme_options[latest_posts_title]', array(
		'selector'            => '#latest-post .section-header h2.section-title',
		'settings'            => 'blog_diary_theme_options[latest_posts_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'blog_diary_latest_posts_title_partial',
    ) );
}

for ( $i = 1; $i <= 4; $i++ ) :
	// author collection pages drop down chooser control and setting
	$wp_customize->add_setting( 'blog_diary_theme_options[latest_posts_content_post_' . $i . ']', array(
		'sanitize_callback' => 'blog_diary_sanitize_page',
	) );

	$wp_customize->add_control( new Blog_Diary_Dropdown_Chooser( $wp_customize, 'blog_diary_theme_options[latest_posts_content_post_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Post %d', 'blog-diary' ), $i ),
		'section'           => 'blog_diary_latest_posts_section',
		'choices'			=> blog_diary_post_choices(),
		'active_callback'	=> 'blog_diary_is_latest_posts_section_enable',
	) ) );
endfor;
