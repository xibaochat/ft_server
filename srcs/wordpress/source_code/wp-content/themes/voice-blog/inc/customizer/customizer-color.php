<?php
/**
 * Voice blog Theme Customizer Color
 *
 * @package voice_blog
 *
 */


/**
 *  Customizer for color display
 */
function voice_blog_customize_color( $wp_customize ) {
	
	$wp_customize->add_setting( 'voice_blog_linkhover_color', array(
		'default'   => '#e89a35',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'voice_blog_linkhover_color', array(
		'label'     => __( 'Link hover color', 'voice-blog' ),
		'section'   => 'colors',
		'settings'  => 'voice_blog_linkhover_color',
		'type'		=> 'color',
		) 
	) );
	

	/////						Background color			//////

	$wp_customize->add_section( 'voice_blog_background_color',
		array(
			'title'      => __( 'Background Color', 'voice-blog' ),
			'priority'   => 50,
		) );

   
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
		'label'     => __( 'Main background color', 'voice-blog' ),
		'section'   => 'voice_blog_background_color',
		'settings'  => 'background_color',
		'type'		=> 'color',
		) 
	) );
	
}
add_action( 'customize_register', 'voice_blog_customize_color' );
