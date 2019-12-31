<?php
/**
 *Recommended way to include parent theme styles.
 *(Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
 */ 
  add_action( 'wp_enqueue_scripts', 'voice_blog_lite_style' );
  function voice_blog_lite_style() {

	$parent_style = 'voice-blog-style';
	wp_enqueue_style( 'kenwheeler-slicktheme', get_template_directory_uri() . '/css/slick-theme.css' );
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style(
        'voice-blog-lite-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'bootstrap', $parent_style ),
        wp_get_theme()->get('Version') );
}
/**
 *Your code goes below
 */

function voice_blog_lite_customize_other( $wp_customize ) {
// //Removed Section from the Parent theme 
$wp_customize->remove_control('voice_blog_blog_post_layout');

$wp_customize->add_setting( 'voice_blog_lite_blog_post_layout', 
array(
	'default'     => 1,
	'sanitize_callback' => 'voice_blog_sanitize_select'
) );

$wp_customize->add_control( 'voice_blog_lite_blog_post_layout', 
	array(
		'label' 	=> __( 'Display type', 'voice-blog-lite' ),
		'section'	=> 'voice_blog_blog_post_section',
		'settings' 	=> 'voice_blog_lite_blog_post_layout',
		'type' 		=> 'select',
		'choices'	=> array(
    	'1'			=> __('1 column type','voice-blog-lite'),
		'2'			=> __('2 column type','voice-blog-lite'),
		'3'			=> __('list type','voice-blog-lite'),
		)
	) 
);

$wp_customize->add_setting( 'voice_blog_lite_blog_related_enable', array(
	'capability'            => 'edit_theme_options',
	'default'               => 1,
	'sanitize_callback'     => 'voice_blog_sanitize_checkbox'
) );
$wp_customize->add_control( 'voice_blog_lite_blog_related_enable', array(
	'label'                 =>  __( 'Enable related post by category', 'voice-blog-lite' ),
	'section'               => 'voice_blog_blog_post_section',
	'type'                  => 'checkbox',
	'settings'              => 'voice_blog_lite_blog_related_enable',
) );

		/// ******* Banner slider section ****** ///////

$wp_customize->add_section( 'voice_blog_lite_banner_slider_section',
array(
	'title'      => __( 'Banner slider section', 'voice-blog-lite' ),
	'priority'   => 20,
	'panel'		=> 'voice_blog_theme_option_panel'
) );

$wp_customize->add_setting( 'voice_blog_lite_banner_slider_enable', array(
	'capability'            => 'edit_theme_options',
	'default'               => 1,
	'sanitize_callback'     => 'voice_blog_sanitize_checkbox'
) );
$wp_customize->add_control( 'voice_blog_lite_banner_slider_enable', array(
	'label'                 =>  __( 'Enable banner slider', 'voice-blog-lite' ),
	'section'               => 'voice_blog_lite_banner_slider_section',
	'type'                  => 'checkbox',
	'settings'              => 'voice_blog_lite_banner_slider_enable',
) );


$wp_customize->add_setting( 'voice_blog_lite_banner_slider_title', array(
	'capability'            => 'edit_theme_options',
	'default'               => __('Banner Slider','voice-blog-lite'),
	'sanitize_callback'     => 'sanitize_text_field'
) );
$wp_customize->add_control( 'voice_blog_lite_banner_slider_title', array(
	'label'                 =>  __( 'Title', 'voice-blog-lite' ),
	'section'               => 'voice_blog_lite_banner_slider_section',
	'type'                  => 'text',
	'settings'              => 'voice_blog_lite_banner_slider_title',
) );

$wp_customize->add_setting( 'voice_blog_lite_banner_slider_order', 
array(
	
	'default'     => 'date',
	'sanitize_callback' => 'voice_blog_sanitize_select'
) );

$wp_customize->add_control( 'voice_blog_lite_banner_slider_order', 
	array(
		'label' 	=> __( 'Order by', 'voice-blog-lite' ),
		'section'	=> 'voice_blog_lite_banner_slider_section',
		'settings' 	=> 'voice_blog_lite_banner_slider_order',
		'type'      => 'select',
		'choices'	=> array (
			'date'	=> __( 'Recent publish date', 'voice-blog-lite' ),
			'comment_count' => __( 'Most commented ', 'voice-blog-lite' ),
			'rand'	=> __( 'Random', 'voice-blog-lite' ),
		)

	) 
);

require_once( trailingslashit( get_template_directory() ) . 'inc/dropdown-category.php' );
$wp_customize->add_setting( 'voice_blog_lite_banner_slider_categorylist', 
array(
	'default'     =>  0,
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new voice_blog_My_Dropdown_Category_Control( $wp_customize, 'voice_blog_lite_banner_slider_categorylist', array(
	
		'label' 	=> __( 'Select post among', 'voice-blog-lite' ),
		'section'	=> 'voice_blog_lite_banner_slider_section',
		
) 	)	
);

require_once( trailingslashit( get_template_directory() ) . 'inc/dropdown-author.php' );
$wp_customize->add_setting( 'voice_blog_lite_banner_slider_authorlist', 
array(
	'default'     =>  0,
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new voice_blog_My_Dropdown_Author_Control( $wp_customize, 'voice_blog_lite_banner_slider_authorlist', array(
	
		'label' 	=> __( 'Select post author', 'voice-blog-lite' ),
		'section'	=> 'voice_blog_lite_banner_slider_section',
		
) 	)	
);

$wp_customize->add_setting( 'voice_blog_lite_banner_slider_noofpost', 
array(
	'default'     => 4,
	'sanitize_callback' => 'absint'
) );

$wp_customize->add_control( 'voice_blog_lite_banner_slider_noofpost', 
	array(
		'label' 	=> __( 'Number of post to show', 'voice-blog-lite' ),
		'section'	=> 'voice_blog_lite_banner_slider_section',
		'settings' 	=> 'voice_blog_lite_banner_slider_noofpost',
		'type' 		=> 'number',
	) 
);

$post_taxonomy_arrays = array(__('Category','voice-blog-lite'));
foreach ($post_taxonomy_arrays as  $post_taxonomy) {
	$wp_customize->add_setting( 'voice_blog_lite_banner_slider_post_taxonomy_'.$post_taxonomy, array(
	'capability'            => 'edit_theme_options',
	'default'               => 1,
	'sanitize_callback' => 'voice_blog_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'voice_blog_lite_banner_slider_post_taxonomy_'.$post_taxonomy, array(
		/* translators: %s: Label */ 
		'label'                 =>  sprintf( __( '%s display', 'voice-blog-lite' ), $post_taxonomy ),
		'section'               => 'voice_blog_lite_banner_slider_section',
		'type'                  => 'checkbox',
		'settings' => 'voice_blog_lite_banner_slider_post_taxonomy_'.$post_taxonomy,

	) );
}

}
add_action( 'customize_register', 'voice_blog_lite_customize_other', 9999 );

if ( ! function_exists( 'voice_blog_lite_blog_1colume_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function voice_blog_lite_blog_1colume_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		} ?>

		<a class="post-thumbnail img-holder" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'voice-blog-lite-blog-1colume-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
					
				) ),
				'class' => 'card-img-top',
			) );
			?>
		</a>
		<?php
	}
endif;

if ( ! function_exists( 'voice_blog_lite_setup' ) ) :
	function voice_blog_lite_setup() {
		add_image_size('voice-blog-lite-blog-1colume-thumbnail', 750, 350, array( 'center','top'));

	}
	add_action( 'after_setup_theme', 'voice_blog_lite_setup' );
endif;

function voice_blog_lite_remove_parent_function() {
	remove_action( 'after_setup_theme', 'voice_blog_custom_header_setup' );
}
add_action( 'wp_loaded', 'voice_blog_lite_remove_parent_function' );

function voice_blog_lite_custom_header_setup() {
	
	add_theme_support( 'custom-header', apply_filters( 'voice_blog_lite_custom_header_args', array(
		'default-image'			=> get_theme_file_uri( '/images/default-header-image.jpg'),
		'width'              => 1200,
		'height'             => 636,
		'flex-height'        => true,
		'wp-head-callback'   => 'voice_blog_header_style',
	) ) );
	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/images/default-header-image.jpg',
			'thumbnail_url' => '%s/images/default-header-image.jpg',
			'description'   => __( 'Default Header Image', 'voice-blog-lite' ),
		),
	) );
}
add_action( 'after_setup_theme', 'voice_blog_lite_custom_header_setup' );