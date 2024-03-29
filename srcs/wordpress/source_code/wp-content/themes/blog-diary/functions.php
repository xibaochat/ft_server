<?php
/**
 * Theme Palace functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */

if ( ! function_exists( 'blog_diary_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function blog_diary_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Theme Palace, use a find and replace
		 * to change 'blog-diary' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'blog-diary' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Enable support for footer widgets.
		add_theme_support( 'footer-widgets', 4 );

		// Load Footer Widget Support.
		require_if_theme_supports( 'footer-widgets', get_template_directory() . '/inc/footer-widgets.php' );
		
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 600, 450, true );

		// Set the default content width.
		$GLOBALS['content_width'] = 525;
		
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' 	=> esc_html__( 'Primary', 'blog-diary' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'blog_diary_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// This setup supports logo, site-title & site-description
		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 120,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );


		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( '/assets/css/editor-style' . blog_diary_min() . '.css', blog_diary_fonts_url() ) );

		// Gutenberg support
		add_theme_support( 'editor-color-palette', array(
	       	array(
				'name' => esc_html__( 'Blue', 'blog-diary' ),
				'slug' => 'blue',
				'color' => '#2c7dfa',
	       	),
	       	array(
	           	'name' => esc_html__( 'Green', 'blog-diary' ),
	           	'slug' => 'green',
	           	'color' => '#07d79c',
	       	),
	       	array(
	           	'name' => esc_html__( 'Orange', 'blog-diary' ),
	           	'slug' => 'orange',
	           	'color' => '#ff8737',
	       	),
	       	array(
	           	'name' => esc_html__( 'Black', 'blog-diary' ),
	           	'slug' => 'black',
	           	'color' => '#2f3633',
	       	),
	       	array(
	           	'name' => esc_html__( 'Grey', 'blog-diary' ),
	           	'slug' => 'grey',
	           	'color' => '#82868b',
	       	),
	   	));

		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-font-sizes', array(
		   	array(
		       	'name' => esc_html__( 'small', 'blog-diary' ),
		       	'shortName' => esc_html__( 'S', 'blog-diary' ),
		       	'size' => 12,
		       	'slug' => 'small'
		   	),
		   	array(
		       	'name' => esc_html__( 'regular', 'blog-diary' ),
		       	'shortName' => esc_html__( 'M', 'blog-diary' ),
		       	'size' => 16,
		       	'slug' => 'regular'
		   	),
		   	array(
		       	'name' => esc_html__( 'larger', 'blog-diary' ),
		       	'shortName' => esc_html__( 'L', 'blog-diary' ),
		       	'size' => 36,
		       	'slug' => 'larger'
		   	),
		   	array(
		       	'name' => esc_html__( 'huge', 'blog-diary' ),
		       	'shortName' => esc_html__( 'XL', 'blog-diary' ),
		       	'size' => 48,
		       	'slug' => 'huge'
		   	)
		));
		add_theme_support('editor-styles');
		add_theme_support( 'wp-block-styles' );
	}
endif;
add_action( 'after_setup_theme', 'blog_diary_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blog_diary_content_width() {

	$content_width = $GLOBALS['content_width'];


	$sidebar_position = blog_diary_layout();
	switch ( $sidebar_position ) {

	  case 'no-sidebar':
	    $content_width = 1170;
	    break;

	  case 'left-sidebar':
	  case 'right-sidebar':
	    $content_width = 819;
	    break;

	  default:
	    break;
	}

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 1170;
	}

	/**
	 * Filter Blog Diary  content width of the theme.
	 *
	 * @since Blog Diary  1.0.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'blog_diary_content_width', $content_width );
}
add_action( 'template_redirect', 'blog_diary_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blog_diary_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'blog-diary' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'blog-diary' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Optional Sidebar', 'blog-diary' ),
		'id'            => 'optional-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'blog-diary' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'blog_diary_widgets_init' );


if ( ! function_exists( 'blog_diary_fonts_url' ) ) :
/**
 * Register Google fonts
 *
 * @return string Google fonts URL for the theme.
 */
function blog_diary_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Oxygen, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Oxygen font: on or off', 'blog-diary' ) ) {
		$fonts[] = 'Oxygen:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Raleway, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'blog-diary' ) ) {
		$fonts[] = 'Raleway:400,600,800';
	}


	$query_args = array(
		'family' => urlencode( implode( '|', $fonts ) ),
		'subset' => urlencode( $subsets ),
	);

	if ( $fonts ) {
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}
endif;

/**
 * Add preconnect for Google Fonts.
 *
 * @since Blog Diary  1.0.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function blog_diary_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'blog-diary-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'blog_diary_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function blog_diary_scripts() {
	$options = blog_diary_get_theme_options();
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'blog-diary-fonts', blog_diary_fonts_url(), array(), null );

	// slick
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick' . blog_diary_min() . '.css' );

	// slick theme
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/css/slick-theme' . blog_diary_min() . '.css' );

	// blocks
	wp_enqueue_style( 'blog-diary-blocks', get_template_directory_uri() . '/assets/css/blocks' . blog_diary_min() . '.css' );

	wp_enqueue_style( 'blog-diary-style', get_stylesheet_uri() );
	
	// Load the html5 shiv.
	wp_enqueue_script( 'blog-diary-html5', get_template_directory_uri() . '/assets/js/html5' . blog_diary_min() . '.js', array(), '3.7.3' );
	wp_script_add_data( 'blog-diary-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'blog-diary-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . blog_diary_min() . '.js', array(), '20160412', true );

	wp_enqueue_script( 'blog-diary-navigation', get_template_directory_uri() . '/assets/js/navigation' . blog_diary_min() . '.js', array(), '20151215', true );

	
	$blog_diary_l10n = array(
		'quote'          => blog_diary_get_svg( array( 'icon' => 'quote-right' ) ),
		'expand'         => esc_html__( 'Expand child menu', 'blog-diary' ),
		'collapse'       => esc_html__( 'Collapse child menu', 'blog-diary' ),
		'icon'           => blog_diary_get_svg( array( 'icon' => 'down', 'fallback' => true ) ),
	);
	
	wp_localize_script( 'blog-diary-navigation', 'blog_diary_l10n', $blog_diary_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/assets/js/slick' . blog_diary_min() . '.js', array( 'jquery' ), '', true );
	
	wp_enqueue_script( 'jquery-sticky-sidebar', get_template_directory_uri() . '/assets/js/jquery.sticky-sidebar' . blog_diary_min() . '.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'blog-diary-custom', get_template_directory_uri() . '/assets/js/custom' . blog_diary_min() . '.js', array( 'jquery' ), '20151215', true );

}
add_action( 'wp_enqueue_scripts', 'blog_diary_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 *
 * @since Blog Diary  1.0.0
 */
function blog_diary_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'blog-diary-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks' . blog_diary_min() . '.css' ) );
	// Add custom fonts.
	wp_enqueue_style( 'blog-diary-fonts', blog_diary_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'blog_diary_block_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load core file
 */
require get_template_directory() . '/inc/core.php';
