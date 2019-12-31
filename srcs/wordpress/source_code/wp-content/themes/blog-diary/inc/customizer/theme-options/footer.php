<?php
/**
 * Footer options
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */

// Footer Section
$wp_customize->add_section( 'blog_diary_section_footer',
	array(
		'title'      		=> esc_html__( 'Footer Options', 'blog-diary' ),
		'priority'   		=> 900,
		'panel'      		=> 'blog_diary_theme_options_panel',
	)
);

// footer text
$wp_customize->add_setting( 'blog_diary_theme_options[copyright_text]',
	array(
		'default'       	=> $options['copyright_text'],
		'sanitize_callback'	=> 'blog_diary_santize_allow_tag',
		'transport'			=> 'postMessage',
	)
);
$wp_customize->add_control( 'blog_diary_theme_options[copyright_text]',
    array(
		'label'      		=> esc_html__( 'Copyright Text', 'blog-diary' ),
		'section'    		=> 'blog_diary_section_footer',
		'type'		 		=> 'textarea',
    )
);

//Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'blog_diary_theme_options[copyright_text]', array(
		'selector'            => '.site-info .wrapper span.copyright-text',
		'settings'            => 'blog_diary_theme_options[copyright_text]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'blog_diary_copyright_text_partial',
    ) );
}

// scroll top visible
$wp_customize->add_setting( 'blog_diary_theme_options[scroll_top_visible]',
	array(
		'default'      		=> $options['scroll_top_visible'],
		'sanitize_callback' => 'blog_diary_sanitize_switch_control',
	)
);
$wp_customize->add_control( new Blog_Diary_Switch_Control( $wp_customize, 'blog_diary_theme_options[scroll_top_visible]',
    array(
		'label'      		=> esc_html__( 'Display Scroll Top Button', 'blog-diary' ),
		'section'    		=> 'blog_diary_section_footer',
		'on_off_label' 		=> blog_diary_switch_options(),
    )
) );