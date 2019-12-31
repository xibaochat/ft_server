<?php
/**
 * new blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package voice_blog
 */

if ( ! function_exists( 'voice_blog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function voice_blog_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on new blog, use a find and replace
		 * to change 'voice-blog' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'voice-blog');

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size('voice-blog-feature-display-thumbnail', 361, 400, array( 'center','top'));
		add_image_size('voice-blog-blog-display-thumbnail', 500, 400, array( 'center','top'));
		add_image_size('voice-blog-banner-thumbnail', 1200, 600, array( 'center','top'));
		add_image_size('voice-blog-footer-thumbnail', 240, 200, array( 'center','top'));
		add_image_size('voice-blog-sidebar-latestpost-thumbnail', 90, 80, array( 'center','top'));
		
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'voice-blog' ),
		) );
		/**
		 * Configure for max number of Tag display
		 */
		add_filter('term_links-post_tag','voice_blog_limit_to_five_tags');
		function voice_blog_limit_to_five_tags($terms) {
		return array_slice($terms,0,5,true);
		}
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
		add_theme_support( 'custom-background', apply_filters( 'voice_blog_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 50,
			'width'       => 50,
			'flex-width' => true,
		) );

		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		
	}
endif;
add_action( 'after_setup_theme', 'voice_blog_setup' );

/**
 * Change the excerpt more string
 */

function voice_blog_custom_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}
	return 42;
}
add_filter( 'excerpt_length', 'voice_blog_custom_excerpt_length', 999 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function voice_blog_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'voice_blog_content_width', 640 );
}
add_action( 'after_setup_theme', 'voice_blog_content_width', 0 );

function voice_blog_comment($comment, $args, $depth) {
        $tag       = 'div';
        $add_below = 'comment';
   ?>
	<div class="media">
			<?php 
			if ( $args['avatar_size'] != 0 ) {
			?><div class="img-holder mr-4">
				<?php echo get_avatar( $comment, 100 ); ?>
			</div>
			<?php } ?>
			<div class="media-body">
				<div class="title-reply">
					<?php /* translators: %s: author */
					printf( __( '<cite class="fn mr-auto">%s</cite>','voice-blog' ), get_comment_author_link() ); ?>
					<span class="reply fa fa-reply" aria-hidden="true"><?php 
					comment_reply_link( 
						array_merge( 
							$args, 
							array( 
								'add_below' => $add_below, 
								'depth'     => $depth, 
								'max_depth' => $args['max_depth'],
							) 
						) 
					); ?>
					</span> 
				</div>

				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
				/* translators: 1: date, 2: time */
				printf( __('%1$s at %2$s','voice-blog'), get_comment_date(),  get_comment_time() ); ?>
				</a><?php 
				edit_comment_link( __( '(Edit)','voice-blog' ), '  ', '' ); ?>
				<br/>
				
				<?php comment_text(); ?>
			</div>
			<?php 
			if ( $comment->comment_approved == '0' ) { ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.','voice-blog' ); ?></em><br/><?php 
			} ?>
			
	</div> 
	<br/>
	<br/>
	<?php
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function voice_blog_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'voice-blog' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Design for in-built widgets.', 'voice-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s categories block">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class ="side-title" > <h4 class="widget-title "> <span>',
		'after_title'   => '</span></h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar one', 'voice-blog' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Design for in-built widgets.', 'voice-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s categories block">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class ="side-title" > <h4 class="widget-title "> <span>',
		'after_title'   => '</span></h4></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar two', 'voice-blog' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Design for in-built widgets.', 'voice-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s categories block">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class ="side-title" > <h4 class="widget-title "> <span>',
		'after_title'   => '</span></h4></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Side navbar', 'voice-blog' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Design for in-built widgets.', 'voice-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s categories block">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class ="side-title" > <h4 class="widget-title "> <span>',
		'after_title'   => '</span></h4></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar three', 'voice-blog' ),
		'id'            => 'sidebar-5',
		'description'   => esc_html__( 'Design for in-built widgets.', 'voice-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s categories block">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class ="side-title" > <h4 class="widget-title "> <span>',
		'after_title'   => '</span></h4></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Frontpage layout 1 area', 'voice-blog' ),
		'id'            => 'sidebar-6',
		'description'   => esc_html__( 'Design for custom built widget.', 'voice-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s categories block">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class ="side-title" > <h4 class="widget-title "> <span>',
		'after_title'   => '</span></h4></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Frontpage layout 2 area', 'voice-blog' ),
		'id'            => 'sidebar-7',
		'description'   => esc_html__( 'Design for custom built widget.', 'voice-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s categories block">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class ="side-title" > <h4 class="widget-title "> <span>',
		'after_title'   => '</span></h4></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Frontpage layout 3 area', 'voice-blog' ),
		'id'            => 'sidebar-8',
		'description'   => esc_html__( 'Design for custom built widget.', 'voice-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s categories block">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class ="side-title" > <h4 class="widget-title "> <span>',
		'after_title'   => '</span></h4></div>',
	) );
}
add_action( 'widgets_init', 'voice_blog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function voice_blog_scripts() {
	wp_enqueue_style( 'kenwheeler-slicktheme', get_template_directory_uri() . '/css/slick-theme.css', array(), '1.9.0', 'all' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '4.1.1', 'all' );
	wp_enqueue_style( 'voice-blog-style', get_stylesheet_uri() );
	wp_enqueue_style( 'kenwheeler-slick', get_template_directory_uri() . '/css/slick.css', array(), '1.9.0', 'all' );
	wp_enqueue_style( 'voice-blog-sidenav', get_template_directory_uri() . '/css/sidenav.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '1.9.0', 'all' );
	wp_enqueue_style( 'wow', get_template_directory_uri() . '/css/animate.css', array(), '1.1.0', 'all' );
	wp_enqueue_style( 'google-webfonts', 'https://fonts.googleapis.com/css?family=Merienda|Poppins|Muli', array(), NULL);
	
	wp_enqueue_script( 'navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'smartmenu-js', get_template_directory_uri() . '/js/jquery.smartmenus.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'smartmenu-bootstrap-js', get_template_directory_uri() . '/js/jquery.smartmenus.bootstrap-4.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'kenwheeler-slick-js', get_template_directory_uri() . '/js/slick.js', array('jquery'), '1.9.0', true );

	wp_enqueue_script( 'wowscript', get_template_directory_uri() . '/js/wow.js', array('jquery'), '1.1.0', false );

	wp_enqueue_script( 'voice-blog-sidenav-js', get_template_directory_uri() . '/js/sidenav.js', array('jquery'), '20181201', true );

	wp_enqueue_script( 'voice-blog-js', get_template_directory_uri() . '/js/voice-blog.js', array('jquery'), '20181201', true );

	wp_enqueue_script( 'scroll-js', get_template_directory_uri() . '/js/jquery.scrollUp.js', array(), '20181201', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( is_single() || is_archive() || ! is_front_page())  {
		wp_enqueue_script( 'voice-blog-scroll-js', get_template_directory_uri() . '/js/voice-blog-scroll.js', array(), '20181201', true );
		
	}
}
add_action( 'wp_enqueue_scripts', 'voice_blog_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';
/**
 * Customizer-color additions.
 */
require get_template_directory() . '/inc/customizer/customizer-color.php';

/**
 * Customizer-color-css additions.
 */
require get_template_directory() . '/inc/css/css-customize.php';

/**
 * Load walker.
 */

require get_template_directory() . '/inc/class-wp-bootsrtrap-navwalker.php';

/**
 *  load sanitize.
 */
require_once( trailingslashit( get_template_directory() ) . 'inc/sanitize.php' );

require_once( trailingslashit( get_template_directory() ) . 'inc/class-voice-blog-multiple-post-banner-widget.php' );

require_once trailingslashit( get_template_directory() ) . '/inc/upgrade-to-pro/control.php' ;

/**
 * This function adds some styles to the WordPress Customizer
 */
function voice_blog_customizer_styles() { ?>
	<style>
		#customize-control-voice_blog_sidebar_enable,
		#customize-control-voice_blog_sidebar_about_enable,
		#customize-control-voice_blog_sidebar_slider_enable,
		#customize-control-voice_blog_sidebar_post_enable,
		#customize-control-voice_blog_sidebar_quote_enable,
		#customize-control-voice_blog_single_page_author_title label,
		#customize-control-voice_blog_related_post_title label,
		#customize-control-banner_posttitle_font_name label,
		#customize-control-blog_posttitle_font_name label,
		#customize-control-sidebar_posttitle_font_name label,
		#customize-control-sidebar_slider_posttitle_font_name label,
		#customize-control-menu_font_name label,
		#customize-control-side_menu_font_name label,
		#customize-control-excerpt_font_name label,
		#customize-control-Single_page_paragraph_font_name label,
		#customize-control-Single_page_blockquote_font_name label,
		#customize-control-singlepage_posttitle_font_name label,
		#customize-control-voice_blog_sidebar_enable_page,
		#customize-control-voice_blog_banner_slider_enable,
		#customize-control-voice_blog_banner_slider_inpage_enable,
		#customize-control-voice_blog_banner_slider_above_blog_enable,
		#customize-control-voice_blog_banner_slider_above_blog_inpage_enable
		{
			border-bottom: 2px solid #000000;
			font-weight: 900;
		}
		
	</style>
	<?php

}
add_action( 'customize_controls_print_styles', 'voice_blog_customizer_styles', 999 );

function voice_blog_add_class_to_excerpt( $excerpt ) {
    return str_replace('<p', '<p class="text-justify"', $excerpt);
}
add_filter( "the_excerpt", "voice_blog_add_class_to_excerpt" );

function voice_blog_widget_setup() {
	register_widget( 'voice_blog_multiple_post_banner' );
}
add_action( 'widgets_init', 'voice_blog_widget_setup' );

function voice_blog_cat() {
	?><ul>
	<?php foreach(get_the_category() as $category)
	{
	echo '<a href="'.esc_url(get_category_link($category->cat_ID)).'"><li class="cat mr-2 mb-4"> '.$category->cat_name.'</li></a>';
	}
	?>
	</ul>
	<?php
}

function voice_blog_modal() {
	if(absint(get_theme_mod('voice_blog_blog_post_post_taxonomy_'.__('Read more','voice-blog'),'1'))==1): ?>
		<?php if(absint(get_theme_mod('voice_blog_popup_enable','1'))==1): ?>
			<a class=" btn <?php if ( esc_attr(get_theme_mod('voice_blog_lite_blog_post_layout','1'))==1 ) {echo 'mt-4'; } else { echo 'float-left' ;} ?>" data-toggle="modal" data-target="#post-content-<?php the_ID(); ?>"><?php echo esc_html(get_theme_mod('voice_blog_read_more_title',__('Read More', 'voice-blog'))); ?></a>
			<!-- Modal -->
			<div class="modal fade" id="post-content-<?php the_ID(); ?>" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
						<a class=" btn" href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('voice_blog_detail_here_title',__('Full view here', 'voice-blog'))); ?></a>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body text-justify">
							<?php the_content();?>
						</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo esc_html(get_theme_mod('voice_blog_close_title',__('Close', 'voice-blog'))); ?></button>
						</div>
					</div>
				</div>
			</div>
		<?php else : ?>
			<a class=" btn float-left" href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('voice_blog_read_more_title',__('Read More', 'voice-blog'))); ?></a>
		<?php endif; 
	endif; 
}

function voice_blog_social_network() {
	?> 
	<ul class="social-icon float-right col-lg-3 text-center ml-auto mb-3">
	<?php if(absint(get_theme_mod('voice_blog_facebook_url_enable','1'))==1) : ?>
		<li class=" bg-white" ><a  href="<?php echo esc_url(get_theme_mod( 'voice_blog_social_url_'.'Facebook'))?>"target="_blank"><span class="fa fa-facebook bg-white" aria-hidden="true" ></span></a> </li>
	<?php endif ; ?>
	<?php if(absint(get_theme_mod('voice_blog_twitter_url_enable','1'))==1) : ?>
		<li class=" bg-white"> <a href="<?php echo esc_url(get_theme_mod( 'voice_blog_social_url_'.'Twitter'))?>"target="_blank"><span class="fa fa-twitter bg-white" aria-hidden="true"></span></a></li>
	<?php endif ; ?>
	<?php if(absint(get_theme_mod('voice_blog_youtube_url_enable','1'))==1) : ?>
		<li class=" bg-white"><a href="<?php echo esc_url(get_theme_mod( 'voice_blog_social_url_'.'Youtube'))?>"target="_blank"><span class="fa fa-youtube bg-white" aria-hidden="true"></span></a></li>
	<?php endif ; ?>
	<?php if(absint(get_theme_mod('voice_blog_pinterest_url_enable','1'))==1) : ?>
		<li class=" bg-white"><a href="<?php echo esc_url(get_theme_mod( 'voice_blog_social_url_'.'Pinterest'))?>"target="_blank"><span class="fa fa-pinterest bg-white" aria-hidden="true"></span></a></li>
	<?php endif ; ?>
	</ul>
	<?php 

}