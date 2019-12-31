<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'blog_diary_excerpt_section', array(
	'title'             => esc_html__( 'Excerpt','blog-diary' ),
	'description'       => esc_html__( 'Excerpt section options.', 'blog-diary' ),
	'panel'             => 'blog_diary_theme_options_panel',
) );

// long Excerpt length setting and control.
$wp_customize->add_setting( 'blog_diary_theme_options[long_excerpt_length]', array(
	'sanitize_callback' => 'blog_diary_sanitize_number_range',
	'validate_callback' => 'blog_diary_validate_long_excerpt',
	'default'			=> $options['long_excerpt_length'],
) );

$wp_customize->add_control( 'blog_diary_theme_options[long_excerpt_length]', array(
	'label'       		=> esc_html__( 'Blog Page Excerpt Length', 'blog-diary' ),
	'description' 		=> esc_html__( 'Total words to be displayed in archive page/search page.', 'blog-diary' ),
	'section'     		=> 'blog_diary_excerpt_section',
	'type'        		=> 'number',
	'input_attrs' 		=> array(
		'style'       => 'width: 80px;',
		'max'         => 100,
		'min'         => 5,
	),
) );

// read more text setting and control
$wp_customize->add_setting( 'blog_diary_theme_options[read_more_text]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['read_more_text'],
) );

$wp_customize->add_control( 'blog_diary_theme_options[read_more_text]', array(
	'label'           	=> esc_html__( 'Read More Text Label', 'blog-diary' ),
	'section'        	=> 'blog_diary_excerpt_section',
	'type'				=> 'text',
) );
