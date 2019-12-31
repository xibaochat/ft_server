<?php
/**
 * new blog Theme Customizer
 *
 * @package voice_blog
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function voice_blog_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'voice_blog_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'voice_blog_customize_partial_blogdescription',
		) );
	}
	//Upgrade to Pro
	// Register custom section types.
	$wp_customize->register_section_type( 'Voice_Blog_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Voice_Blog_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Go Pro', 'voice-blog' ),
				'pro_text' => esc_html__( 'Buy Pro Voice Blog', 'voice-blog' ),
				'pro_url'  => esc_url('https://www.postmagthemes.com/downloads/pro-voice-blog-wordpress-theme/'),
				'priority' => 1,
			)
		)
	);
	$wp_customize->add_section(
		new Voice_Blog_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell2',
			array(
				'title'    => esc_html__( 'View', 'voice-blog' ),
				'pro_text' => esc_html__( 'All documents', 'voice-blog' ),
				'pro_url'  => esc_url('https://www.postmagthemes.com/docs/documentation-of-voice-blog-and-pro/'),
				'priority' => 1,
				'panel'          => 'voice_blog_document_panel',
				
			)
		)
	);
	$wp_customize->add_section(
		new Voice_Blog_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell3',
			array(
				'title'    => esc_html__( 'Video', 'voice-blog' ),
				'pro_text' => esc_html__( 'Setup site as page', 'voice-blog' ),
				'pro_url'  => esc_url('https://www.postmagthemes.com/docs/documentation-of-voice-blog-and-pro/quick-setup-guide-for-setting-your-homepage-as-normal-page/'),
				'priority' => 2,
				'panel'          => 'voice_blog_document_panel',
			)
		)
	);
	$wp_customize->add_section(
		new Voice_Blog_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell4',
			array(
				'title'    => esc_html__( 'Video', 'voice-blog' ),
				'pro_text' => esc_html__( 'Setup site as blog page', 'voice-blog' ),
				'pro_url'  => esc_url('https://www.postmagthemes.com/docs/documentation-of-voice-blog-and-pro/quick-setup-guide-for-setting-your-homepage-as-blog-page/'),
				'priority' => 3,
				'panel'          => 'voice_blog_document_panel',			)
		)
	);
	$wp_customize->add_section(
		new Voice_Blog_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell5',
			array(
				'title'    => esc_html__( 'Video', 'voice-blog' ),
				'pro_text' => esc_html__( 'Just quick setup', 'voice-blog' ),
				'pro_url'  => esc_url('https://www.postmagthemes.com/docs/documentation-of-voice-blog-and-pro/quick-setup-guide-for-voice-blog-free-version/'),
				'priority' => 4,
				'panel'          => 'voice_blog_document_panel',
			)
		)
	);
	$wp_customize->add_section(
		new Voice_Blog_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell6',
			array(
				'title'    => esc_html__( 'Video', 'voice-blog' ),
				'pro_text' => esc_html__( 'How to buy pro theme', 'voice-blog' ),
				'pro_url'  => esc_url('https://www.postmagthemes.com/docs/documentation-of-best-news-and-pro/how-to-buy-premium-theme-from-postmagthemes-com/'),
				'priority' => 5,
				'panel'          => 'voice_blog_document_panel',
			)
		)
	);
}
add_action( 'customize_register', 'voice_blog_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function voice_blog_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function voice_blog_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function voice_blog_customize_preview_js() {
	wp_enqueue_script( 'voice-blog-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'voice_blog_customize_preview_js' );

/**
 * Enqueue required scripts/styles for customizer panel
 *
 * @since 1.0.0
 */
function voice_blog_customize_backend_scripts() {
	wp_enqueue_script( 'voice_blog-customize-controls', get_template_directory_uri() . '/inc/upgrade-to-pro/pro.js', array( 'customize-controls' ) );
	wp_enqueue_style( 'voice_blog-customize-controls', get_template_directory_uri() . '/inc/upgrade-to-pro/pro.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'voice_blog_customize_backend_scripts', 10 );

function voice_blog_customize_other( $wp_customize ) {

					// THEME OPTION panel  //
$wp_customize->add_panel( 'voice_blog_theme_option_panel', array(
	'priority'	=> 21,
	'title'		=> __( 'Theme options', 'voice-blog' )
) );
// Document paler  //
$wp_customize->add_panel( 'voice_blog_document_panel', array(
	'priority'	=> 2,
	'title'		=> __( 'Documents', 'voice-blog' )
) );
						///////   'Blog post section'  ////////////

$wp_customize->add_section( 'voice_blog_blog_post_section',
array(
	'title'      => __( 'Blog post section', 'voice-blog' ),
	'priority'   => 40,
	'panel'		=> 'voice_blog_theme_option_panel'
) );

$wp_customize->add_setting( 'voice_blog_blog_post_enable', 
array(
	
	'default'     => 1,
	'sanitize_callback' => 'voice_blog_sanitize_checkbox'
) );

$wp_customize->add_control( 'voice_blog_blog_post_enable', 
	array(
		'label' 	=> __( 'Display blog post', 'voice-blog' ),
		'section'	=> 'voice_blog_blog_post_section',
		'settings' 	=> 'voice_blog_blog_post_enable',
		'type'      => 'checkbox',
		'description' => __('Below settings are applicable to archive and search page as well', 'voice-blog'),


	) 
);
$wp_customize->add_setting( 'voice_blog_blog_post_title', 
array(
	
	'default'     => __('Blog Post','voice-blog'),
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'voice_blog_blog_post_title', 
	array(
		'label' 	=> __( 'Display blog post title', 'voice-blog' ),
		'section'	=> 'voice_blog_blog_post_section',
		'settings' 	=> 'voice_blog_blog_post_title',
		'type'      => 'text',
	) 
);

$post_taxonomy_arrays = array(__('Category','voice-blog'),__('Date','voice-blog'),__('Comment','voice-blog'),__('Tag','voice-blog'),__('Read more','voice-blog'),__('Grey image if feature image is not used','voice-blog'));
foreach ($post_taxonomy_arrays as  $post_taxonomy) {
	$wp_customize->add_setting( 'voice_blog_blog_post_post_taxonomy_'.$post_taxonomy, array(
	'capability'            => 'edit_theme_options',
	'default'               => 1,
	'sanitize_callback' => 'voice_blog_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'voice_blog_blog_post_post_taxonomy_'.$post_taxonomy, array(
		/* translators: %s: Label */ 
		'label'                 =>  sprintf( __( 'Display %s', 'voice-blog' ), $post_taxonomy ),
		'section'               => 'voice_blog_blog_post_section',
		'type'                  => 'checkbox',
		'settings' => 'voice_blog_blog_post_post_taxonomy_'.$post_taxonomy,

	) );
}


$wp_customize->add_setting( 'voice_blog_blog_post_layout', 
array(
	'default'     => 2,
	'sanitize_callback' => 'voice_blog_sanitize_select'
) );

$wp_customize->add_control( 'voice_blog_blog_post_layout', 
	array(
		'label' 	=> __( 'Display type', 'voice-blog' ),
		'section'	=> 'voice_blog_blog_post_section',
		'settings' 	=> 'voice_blog_blog_post_layout',
		'type' 		=> 'select',
		'choices'	=> array(
		'2'			=> __('2 column type','voice-blog'),
		'3'			=> __('list type','voice-blog'),
		)
	) 
);
								///////   'Footer slider section'  ////////////

$wp_customize->add_section( 'voice_blog_footer_slider_section',
array(
	'title'      => __( 'Footer section', 'voice-blog' ),
	'priority'   => 60,
	'panel'		=> 'voice_blog_theme_option_panel'
) );

$wp_customize->add_setting( 'voice_blog_footer_title', 
array(
	
	'default'     => 1,
	'sanitize_callback' => 'voice_blog_sanitize_checkbox'
) );

$wp_customize->add_control( 'voice_blog_footer_title', 
	array(
		'label' 	=> __( 'Display site title at footer', 'voice-blog' ),
		'section'	=> 'voice_blog_footer_slider_section',
		'settings' 	=> 'voice_blog_footer_title',
		'type'      => 'checkbox',

	) 
);

	// 'Social link' section
$wp_customize->add_section( 'voice_blog_section_social_section',
array(
	'title'      => __( 'Social link section', 'voice-blog' ),
	'priority'   => 70,
	'panel'		=> 'voice_blog_theme_option_panel'
) );
	////	enable social link at variuos places  /////
$wp_customize->add_setting( 'voice_blog_social_top_enable', array(
	'capability'            => 'edit_theme_options',
	'default'               => 0,
	'sanitize_callback'     => 'voice_blog_sanitize_checkbox'
) );
$wp_customize->add_control( 'voice_blog_social_top_enable', array(
	'label'                 =>  __( 'Enable social link at top', 'voice-blog' ),
	'section'               => 'voice_blog_section_social_section',
	'type'                  => 'checkbox',
	'settings'              => 'voice_blog_social_top_enable',
) );

$wp_customize->add_setting( 'voice_blog_social_sidebar_enable', array(
	'capability'            => 'edit_theme_options',
	'default'               => 0,
	'sanitize_callback'     => 'voice_blog_sanitize_checkbox'
) );
$wp_customize->add_control( 'voice_blog_social_sidebar_enable', array(
	'label'                 =>  __( 'Enable social link at sidebar', 'voice-blog' ),
	'section'               => 'voice_blog_section_social_section',
	'type'                  => 'checkbox',
	'settings'              => 'voice_blog_social_sidebar_enable',
) );
$wp_customize->add_setting( 'voice_blog_social_sidebar_title', array(
	'capability'            => 'edit_theme_options',
	'default'               => __('Stay connected','voice-blog'),
	'sanitize_callback'     => 'sanitize_text_field'
) );
$wp_customize->add_control( 'voice_blog_social_sidebar_title', array(
	'label'                 =>  __( 'Title social link at sidebar', 'voice-blog' ),
	'section'               => 'voice_blog_section_social_section',
	'settings'              => 'voice_blog_social_sidebar_title',
	'type'					=> 'text',
) );
$wp_customize->add_setting( 'voice_blog_social_bottom_enable', array(
	'capability'            => 'edit_theme_options',
	'default'               => 0,
	'sanitize_callback'     => 'voice_blog_sanitize_checkbox'
) );
$wp_customize->add_control( 'voice_blog_social_bottom_enable', array(
	'label'                 =>  __( 'Enable social link at bottom', 'voice-blog' ),
	'section'               => 'voice_blog_section_social_section',
	'type'                  => 'checkbox',
	'settings'              => 'voice_blog_social_bottom_enable',
) );


// Socail url
$social_name_arrays = array(__('Facebook','voice-blog'),__('Twitter','voice-blog'),__('Youtube','voice-blog'),__('Pinterest','voice-blog'));
foreach ($social_name_arrays as  $social_name) {
	$wp_customize->add_setting( 'voice_blog_social_url_'.$social_name, array(
	'capability'            => 'edit_theme_options',
	'default'               => '',
	'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control( 'voice_blog_social_url_'.$social_name, array(
		/* translators: %s: Label */ 
		'label'                 =>  sprintf( __( '%s Url', 'voice-blog' ), $social_name ),
		'section'               => 'voice_blog_section_social_section',
		'type'                  => 'url',
		'settings' => 'voice_blog_social_url_'.$social_name,
	) );
}
//Socail Url Enable or disable by checkboxs

$wp_customize->add_setting( 'voice_blog_facebook_url_enable', array(
	'capability'            => 'edit_theme_options',
	'default'               => 1,
	'sanitize_callback'     => 'voice_blog_sanitize_checkbox'
) );

$wp_customize->add_control( 'voice_blog_facebook_url_enable', array(
	'label'                 =>  __( 'Enable Facebook Icon', 'voice-blog' ),
	'section'               => 'voice_blog_section_social_section',
	'type'                  => 'checkbox',
	'settings'              => 'voice_blog_facebook_url_enable',
) );
$wp_customize->add_setting( 'voice_blog_twitter_url_enable', array(
	'capability'            => 'edit_theme_options',
	'default'               => 1,
	'sanitize_callback'     => 'voice_blog_sanitize_checkbox'
) );

$wp_customize->add_control( 'voice_blog_twitter_url_enable', array(
	'label'                 =>  __( 'Enable Twitter icon', 'voice-blog' ),
	'section'               => 'voice_blog_section_social_section',
	'type'                  => 'checkbox',
	'settings'              => 'voice_blog_twitter_url_enable',
) );

$wp_customize->add_setting( 'voice_blog_youtube_url_enable', array(
	'capability'            => 'edit_theme_options',
	'default'               => 1,
	'sanitize_callback'     => 'voice_blog_sanitize_checkbox'
) );

$wp_customize->add_control( 'voice_blog_youtube_url_enable', array(
	'label'                 =>  __( 'Enable YouTube Icon', 'voice-blog' ),
	'section'               => 'voice_blog_section_social_section',
	'type'                  => 'checkbox',
	'settings'              => 'voice_blog_youtube_url_enable',
) );

$wp_customize->add_setting( 'voice_blog_pinterest_url_enable', array(
	'capability'            => 'edit_theme_options',
	'default'               => 1,
	'sanitize_callback'     => 'voice_blog_sanitize_checkbox'
) );

$wp_customize->add_control( 'voice_blog_pinterest_url_enable', array(
	'label'                 =>  __( 'Enable Pinterest Icon', 'voice-blog' ),
	'section'               => 'voice_blog_section_social_section',
	'type'                  => 'checkbox',
	'settings'              => 'voice_blog_pinterest_url_enable',
) );
$wp_customize->add_setting( 'voice_blog_instagram_url_enable', array(
	'capability'            => 'edit_theme_options',
	'default'               => 1,
	'sanitize_callback'     => 'voice_blog_sanitize_checkbox'
) );

	
//////   'Sidebar  section enable'  ////////////

$wp_customize->add_setting( 'voice_blog_sidebar_enable', 
array(
	
	'default'     => 1,
	'sanitize_callback' => 'voice_blog_sanitize_checkbox'
) );

$wp_customize->add_control( 'voice_blog_sidebar_enable', 
	array(
		'label' 	=> __( 'Display sidebar at every post', 'voice-blog' ),
		'section'	=> 'voice_blog_sidebar_section',
		'settings' 	=> 'voice_blog_sidebar_enable',
		'type'      => 'checkbox',

	) 
);
$wp_customize->add_setting( 'voice_blog_sidebar_enable_page', 
array(
	
	'default'     => 1,
	'sanitize_callback' => 'voice_blog_sanitize_checkbox'
) );

$wp_customize->add_control( 'voice_blog_sidebar_enable_page', 
	array(
		'label' 	=> __( 'Display sidebar at every page', 'voice-blog' ),
		'section'	=> 'voice_blog_sidebar_section',
		'settings' 	=> 'voice_blog_sidebar_enable_page',
		'type'      => 'checkbox',

	) 
);
//////   'Sidebar about section'  ////////////

$wp_customize->add_setting( 'voice_blog_sidebar_about_enable', 
array(
	
	'default'     => 0,
	'sanitize_callback' => 'voice_blog_sanitize_checkbox'
) );

$wp_customize->add_control( 'voice_blog_sidebar_about_enable', 
	array(
		'label' 	=> __( 'Display about', 'voice-blog' ),
		'section'	=> 'voice_blog_sidebar_section',
		'settings' 	=> 'voice_blog_sidebar_about_enable',
		'type'      => 'checkbox',

	) 
);
$wp_customize->add_setting( 'voice_blog_sidebar_about_title', 
array(
	
	'default'     => __('About Me','voice-blog'),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'voice_blog_sidebar_about_title', 
	array(
		'label' 	=> __( 'Display about', 'voice-blog' ),
		'section'	=> 'voice_blog_sidebar_section',
		'settings' 	=> 'voice_blog_sidebar_about_title',
		'type'      => 'text',

	) 
);
$wp_customize->add_setting( 'voice_blog_sidebar_about_textarea', 
array(
	
	'default'     => __('Mauris eget pharetra lectus', 'voice-blog'),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'voice_blog_sidebar_about_textarea', 
	array(
		'label' 	=> __( 'Write about', 'voice-blog' ),
		'section'	=> 'voice_blog_sidebar_section',
		'settings' 	=> 'voice_blog_sidebar_about_textarea',
		'type'      => 'text',

	) 
);
$wp_customize->add_setting( 'voice_blog_sidebar_about_image', 
array(
	
	'default'     => '',
	'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'logo',
		array(
			'label'      => __( 'Upload image', 'voice-blog' ),
			'section'    => 'voice_blog_sidebar_section',
			'settings'   => 'voice_blog_sidebar_about_image',
		)
	)
);

			///////   'Sidebar slider section'  ////////////

$wp_customize->add_section( 'voice_blog_sidebar_section',
array(
	'title'      => __( 'Sidebar section', 'voice-blog' ),
	'priority'   => 80,
	'panel'		=> 'voice_blog_theme_option_panel'
) );

///////   'Sidebar post section'  ////////////

$wp_customize->add_setting( 'voice_blog_sidebar_post_enable', 
array(
	
	'default'     => 0,
	'sanitize_callback' => 'voice_blog_sanitize_checkbox'
) );

$wp_customize->add_control( 'voice_blog_sidebar_post_enable', 
	array(
		'label' 	=> __( 'Display sidebar post', 'voice-blog' ),
		'section'	=> 'voice_blog_sidebar_section',
		'settings' 	=> 'voice_blog_sidebar_post_enable',
		'type'      => 'checkbox',

	) 
);
$wp_customize->add_setting( 'voice_blog_sidebar_post_title', 
array(
	
	'default'     => __('Latest Post','voice-blog'),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'voice_blog_sidebar_post_title', 
	array(
		'label' 	=> __( 'Display sidebar post', 'voice-blog' ),
		'section'	=> 'voice_blog_sidebar_section',
		'settings' 	=> 'voice_blog_sidebar_post_title',
		'type'      => 'text',

	) 
);

$wp_customize->add_setting( 'voice_blog_sidebar_post_order', 
array(
	
	'default'     => 'date',
	'sanitize_callback' => 'voice_blog_sanitize_select'
) );

$wp_customize->add_control( 'voice_blog_sidebar_post_order', 
	array(
		'label' 	=> __( 'Order by', 'voice-blog' ),
		'section'	=> 'voice_blog_sidebar_section',
		'settings' 	=> 'voice_blog_sidebar_post_order',
		'type'      => 'select',
		'choices'	=> array (
			'date'	=> __( 'Recent published date', 'voice-blog' ),
			'comment_count' => __( 'Most commented ', 'voice-blog' ),
			'rand'	=> __( 'Random', 'voice-blog' ),

		)

	) 
);

require_once( trailingslashit( get_template_directory() ) . 'inc/dropdown-category.php' );
$wp_customize->add_setting( 'voice_blog_sidebar_post_categorylist', 
array(
	'default'     =>  0,
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new voice_blog_My_Dropdown_Category_Control( $wp_customize, 'voice_blog_sidebar_post_categorylist', array(
	
		'label' 	=> __( 'Select the post among', 'voice-blog' ),
		'section'	=> 'voice_blog_sidebar_section',
		
) 	)	
);
require_once( trailingslashit( get_template_directory() ) . 'inc/dropdown-author.php' );
$wp_customize->add_setting( 'voice_blog_sidebar_post_authorlist', 
array(
	'default'     =>  0,
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new voice_blog_My_Dropdown_Author_Control( $wp_customize, 'voice_blog_sidebar_post_authorlist', array(
	
		'label' 	=> __( 'Select the post author', 'voice-blog' ),
		'section'	=> 'voice_blog_sidebar_section',
		
) 	)	
);

$wp_customize->add_setting( 'voice_blog_sidebar_post_noofpost', 
array(
	'default'     => 4,
	'sanitize_callback' => 'absint'
) );

$wp_customize->add_control( 'voice_blog_sidebar_post_noofpost', 
	array(
		'label' 	=> __( 'Number of post to show', 'voice-blog' ),
		'section'	=> 'voice_blog_sidebar_section',
		'settings' 	=> 'voice_blog_sidebar_post_noofpost',
		'type' 		=> 'number',
	) 
);

$post_taxonomy_arrays = array(__('Date','voice-blog'), __('Image','voice-blog'));
foreach ($post_taxonomy_arrays as  $post_taxonomy) {
	$wp_customize->add_setting( 'voice_blog_sidebar_post_post_taxonomy_'.$post_taxonomy, array(
	'capability'            => 'edit_theme_options',
	'default'               => 1,
	'sanitize_callback' => 'voice_blog_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'voice_blog_sidebar_post_post_taxonomy_'.$post_taxonomy, array(
		/* translators: %s: Label */ 
		'label'                 =>  sprintf( __( 'Display %s', 'voice-blog' ), $post_taxonomy ),
		'section'               => 'voice_blog_sidebar_section',
		'type'                  => 'checkbox',
		'settings' => 'voice_blog_sidebar_post_post_taxonomy_'.$post_taxonomy,

	) );
}

				//////   'Sidebar Quote section'  ////////////
$wp_customize->add_setting( 'voice_blog_sidebar_quote_enable', 
array(
	
	'default'     => 0,
	'sanitize_callback' => 'voice_blog_sanitize_checkbox'
) );

$wp_customize->add_control( 'voice_blog_sidebar_quote_enable', 
	array(
		'label' 	=> __( 'Display quote', 'voice-blog' ),
		'section'	=> 'voice_blog_sidebar_section',
		'settings' 	=> 'voice_blog_sidebar_quote_enable',
		'type'      => 'checkbox',

	) 
);
$wp_customize->add_setting( 'voice_blog_sidebar_quote_title', 
array(
	
	'default'     => __('Quotes Of The Day','voice-blog'),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'voice_blog_sidebar_quote_title', 
	array(
		'label' 	=> __( 'Display quote', 'voice-blog' ),
		'section'	=> 'voice_blog_sidebar_section',
		'settings' 	=> 'voice_blog_sidebar_quote_title',
		'type'      => 'text',

	) 
);
$wp_customize->add_setting( 'voice_blog_sidebar_quote_textarea', 
array(
	
	'default'     => __('this is my quote','voice-blog'),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'voice_blog_sidebar_quote_textarea', 
	array(
		'label' 	=> __( 'Write about', 'voice-blog' ),
		'section'	=> 'voice_blog_sidebar_section',
		'settings' 	=> 'voice_blog_sidebar_quote_textarea',
		'type'      => 'text',

	) 
);
//////   'Single page section'  ////////////

$wp_customize->add_section( 'voice_blog_single_page_section',
array(
	'title'      => __( 'Single page section', 'voice-blog' ),
	'priority'   => 100,
	'panel'		=> 'voice_blog_theme_option_panel'
) );

$wp_customize->add_setting( 'voice_blog_single_page_author_title', 
array(
	
	'default'     => __('Author','voice-blog'),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'voice_blog_single_page_author_title', 
	array(
		'label' 	=> __( 'Author title', 'voice-blog' ),
		'section'	=> 'voice_blog_single_page_section',
		'settings' 	=> 'voice_blog_single_page_author_title',
		'type'      => 'text',

	) 
);
$post_taxonomy_arrays = array(__('Author section','voice-blog'),__('Avatar','voice-blog'), __('Email','voice-blog'),__('Description','voice-blog'));
foreach ($post_taxonomy_arrays as  $post_taxonomy) {
	$wp_customize->add_setting( 'voice_blog_single_page_post_taxonomy_'.$post_taxonomy, array(
	'capability'            => 'edit_theme_options',
	'default'               => 1,
	'sanitize_callback' => 'voice_blog_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'voice_blog_single_page_post_taxonomy_'.$post_taxonomy, array(
		/* translators: %s: Label */ 
		'label'                 =>  sprintf( __( 'Display %s', 'voice-blog' ), $post_taxonomy ),
		'section'               => 'voice_blog_single_page_section',
		'type'                  => 'checkbox',
		'settings' => 'voice_blog_single_page_post_taxonomy_'.$post_taxonomy,

	) );
}

$wp_customize->add_setting( 'voice_blog_related_post_enable', 
array(
	
	'default'     => '1',
	'sanitize_callback' => 'voice_blog_sanitize_checkbox'
) );

$wp_customize->add_control( 'voice_blog_related_post_enable', 
	array(
		'label' 	=> __( 'Display related post', 'voice-blog' ),
		'section'	=> 'voice_blog_single_page_section',
		'settings' 	=> 'voice_blog_related_post_enable',
		'type'      => 'checkbox',

	) 
);
$wp_customize->add_setting( 'voice_blog_related_post_title', 
array(
	
	'default'     => __('Related Posts','voice-blog'),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'voice_blog_related_post_title', 
	array(
		'label' 	=> __( 'Related post title', 'voice-blog' ),
		'section'	=> 'voice_blog_single_page_section',
		'settings' 	=> 'voice_blog_related_post_title',
		'type'      => 'text',

	) 
);
$wp_customize->add_setting( 'voice_blog_related_post_order', 
array(
	
	'default'     => 'date',
	'sanitize_callback' => 'voice_blog_sanitize_select'
) );

$wp_customize->add_control( 'voice_blog_related_post_order', 
	array(
		'label' 	=> __( 'Order by', 'voice-blog' ),
		'section'	=> 'voice_blog_single_page_section',
		'settings' 	=> 'voice_blog_related_post_order',
		'type'      => 'select',
		'choices'	=> array (
			'date'	=> __( 'Recently published date', 'voice-blog' ),
			'comment_count' => __( 'Most commented ', 'voice-blog' ),
			'rand'	=> __( 'Random', 'voice-blog' ),

		)

	) 
);
$wp_customize->add_setting( 'voice_blog_related_post_noofpost', 
array(
	'default'     => 6,
	'sanitize_callback' => 'absint'
) );

$wp_customize->add_control( 'voice_blog_related_post_noofpost', 
	array(
		'label' 	=> __( 'Number of post to show', 'voice-blog' ),
		'section'	=> 'voice_blog_single_page_section',
		'settings' 	=> 'voice_blog_related_post_noofpost',
		'type' 		=> 'number',
	) 
);

///////// 'General setting section'  ////////////

$wp_customize->add_section( 'voice_blog_general_setting_section',
array(
	'title'      => __( 'General setting section', 'voice-blog' ),
	'priority'   => 110,
	'panel'		=> 'voice_blog_theme_option_panel'
) );

$wp_customize->add_setting( 'voice_blog_read_more_title', 
array(
	
	'default'     => __('Read more','voice-blog'),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'voice_blog_read_more_title', 
	array(
		'label' 	=> __( 'Read more text', 'voice-blog' ),
		'section'	=> 'voice_blog_general_setting_section',
		'settings' 	=> 'voice_blog_read_more_title',
		'type'      => 'text',
	));
$wp_customize->add_setting( 'voice_blog_popup_enable', 
array(
	
	'default'     => 1,
	'sanitize_callback' => 'voice_blog_sanitize_checkbox'
) );

$wp_customize->add_control( 'voice_blog_popup_enable', 
	array(
		'label' 	=> __( 'Enable popup window for read more', 'voice-blog' ),
		'section'	=> 'voice_blog_general_setting_section',
		'settings' 	=> 'voice_blog_popup_enable',
		'type'      => 'checkbox',
));

$wp_customize->add_setting( 'voice_blog_close_title', 
array(
	
	'default'     => __('Close','voice-blog'),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'voice_blog_close_title', 
	array(
		'label' 	=> __( 'Close at popup', 'voice-blog' ),
		'section'	=> 'voice_blog_general_setting_section',
		'settings' 	=> 'voice_blog_close_title',
		'type'      => 'text',
	));
$wp_customize->add_setting( 'voice_blog_detail_here_title', 
array(
	
	'default'     => __('Full view here','voice-blog'),
	'sanitize_callback' => 'sanitize_text_field'
) );

$wp_customize->add_control( 'voice_blog_detail_here_title', 
	array(
		'label' 	=> __( 'Full view at popup', 'voice-blog' ),
		'section'	=> 'voice_blog_general_setting_section',
		'settings' 	=> 'voice_blog_detail_here_title',
		'type'      => 'text',
	));
}
add_action( 'customize_register', 'voice_blog_customize_other' );