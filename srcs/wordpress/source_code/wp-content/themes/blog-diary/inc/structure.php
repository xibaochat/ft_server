<?php
/**
 * Theme Palace basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */

$options = blog_diary_get_theme_options();  

if ( ! function_exists( 'blog_diary_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since Blog Diary  1.0.0
	 */
	function blog_diary_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;
add_action( 'blog_diary_doctype', 'blog_diary_doctype', 10 );

if ( ! function_exists( 'blog_diary_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Blog Diary  1.0.0
	 *
	 */
	function blog_diary_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif;
	}
endif;
add_action( 'blog_diary_before_wp_head', 'blog_diary_head', 10 );

if ( ! function_exists( 'blog_diary_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since Blog Diary  1.0.0
	 *
	 */
	function blog_diary_page_start() {
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'blog-diary' ); ?></a>

		<?php
	}
endif;
add_action( 'blog_diary_page_start_action', 'blog_diary_page_start', 10 );

if ( ! function_exists( 'blog_diary_page_end' ) ) :
	/**
	 * Page end html codes
	 *
	 * @since Blog Diary  1.0.0
	 *
	 */
	function blog_diary_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'blog_diary_page_end_action', 'blog_diary_page_end', 10 );

if ( ! function_exists( 'blog_diary_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since Blog Diary  1.0.0
	 *
	 */
	function blog_diary_site_branding() {
		$options  = blog_diary_get_theme_options();
		$header_txt_logo_extra = $options['header_txt_logo_extra'];
		$header_image = get_header_image();		
		?>
		 <div class="menu-overlay"></div>
        <div id="header-banner-image" style="background-image: url('<?php echo esc_url( $header_image ); ?>');">
            <div class="overlay"></div>
            <div class="wrapper">
                <div class="site-branding">
					<?php if ( in_array( $header_txt_logo_extra, array( 'show-all', 'logo-title', 'logo-tagline' ) )  ) { ?>
						<div class="site-logo">
							<?php the_custom_logo(); ?>
						</div>
					<?php } 
					if ( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title', 'show-all', 'tagline-only', 'logo-tagline' ) ) ) : ?>
						<div id="site-identity">
							<?php
							if( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title' ) )  ) {
								if ( blog_diary_is_latest_posts() ) : ?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php else : ?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
								<?php
								endif;
							} 
							if ( in_array( $header_txt_logo_extra, array( 'show-all', 'tagline-only', 'logo-tagline' ) ) ) {
								$description = get_bloginfo( 'description', 'display' );
								if ( $description || is_customize_preview() ) : ?>
									<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
								<?php
								endif; 
							}?>
						</div>
					<?php endif; ?>
				</div><!-- .site-branding -->
            </div><!-- .wrapper -->
        </div><!-- .header-banner-image-->
		
		<?php
	}
endif;
add_action( 'blog_diary_header_action', 'blog_diary_site_branding', 10 );

if ( ! function_exists( 'blog_diary_header_start' ) ) :
	/**
	 * Header start html codes
	 *
	 * @since Blog Diary  1.0.0
	 *
	 */
	function blog_diary_header_start() { ?>
		<header id="masthead" class="site-header" role="banner">
		<?php
	}
endif;
add_action( 'blog_diary_header_action', 'blog_diary_header_start', 30 );

if ( ! function_exists( 'blog_diary_site_navigation' ) ) :
	/**
	 * Site navigation codes
	 *
	 * @since Blog Diary  1.0.0
	 *
	 */
	function blog_diary_site_navigation() { 
		$options = blog_diary_get_theme_options();
		?>
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
			<?php
			echo blog_diary_get_svg( array( 'icon' => 'menu', 'class' => 'icon-menu' ) );
			echo blog_diary_get_svg( array( 'icon' => 'close', 'class' => 'icon-menu' ) );
			?>			
		</button>
		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="Primary Menu">
			<?php  
        		$defaults = array(
        			'theme_location' => 'primary',
        			'container' => 'div',
        			'menu_class' => 'menu nav-menu',
        			'menu_id' => 'primary-menu',
        			'echo' => true,
        			'fallback_cb' => 'blog_diary_menu_fallback_cb',
        		);
        	
        		wp_nav_menu( $defaults );
        	?>
		</nav><!-- #site-navigation -->
		<?php
	}
endif;
add_action( 'blog_diary_header_action', 'blog_diary_site_navigation', 30 );

if ( ! function_exists( 'blog_diary_header_end' ) ) :
	/**
	 * Header end html codes
	 *
	 * @since Blog Diary  1.0.0
	 *
	 */
	function blog_diary_header_end() { ?>
		</header><!-- #masthead -->
		<?php
	}
endif;
add_action( 'blog_diary_header_action', 'blog_diary_header_end', 40 );

if ( ! function_exists( 'blog_diary_content_start' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Blog Diary  1.0.0
	 *
	 */
	function blog_diary_content_start() {
		?>
		<div id="content" class="site-content">
		<?php
	}
endif;
add_action( 'blog_diary_content_start_action', 'blog_diary_content_start', 10 );

if ( ! function_exists( 'blog_diary_header_image' ) ) :
	/**
	 * Header Image codes
	 *
	 * @since Blog Diary  1.0.0
	 *
	 */
	function blog_diary_header_image() {
		if ( blog_diary_is_frontpage() )
			return;
		$header_image = get_header_image();
		if ( is_singular() ) :
			$header_image = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : $header_image;
		endif;
		?>

		<div id="page-site-header" class="relative wrapper" style="background-image: url('<?php echo esc_url( $header_image ); ?>');">
            <div class="overlay"></div>
                <header class="page-header">
                    <h2 class="page-title"><?php echo blog_diary_custom_header_banner_title(); ?></h2>
                </header>

                <?php blog_diary_add_breadcrumb(); ?>
        </div><!-- #page-site-header -->

	<?php
	}
endif;
add_action( 'blog_diary_header_image_action', 'blog_diary_header_image', 10 );

if ( ! function_exists( 'blog_diary_add_breadcrumb' ) ) :
	/**
	 * Add breadcrumb.
	 *
	 * @since Blog Diary  1.0.0
	 */
	function blog_diary_add_breadcrumb() {
		$options = blog_diary_get_theme_options();

		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}
		
		// Bail if Home Page.
		if ( blog_diary_is_frontpage() ) {
			return;
		}

		echo '<div id="breadcrumb-list" >';
				/**
				 * blog_diary_simple_breadcrumb hook
				 *
				 * @hooked blog_diary_simple_breadcrumb -  10
				 *
				 */
				do_action( 'blog_diary_simple_breadcrumb' );
		echo '</div><!-- #breadcrumb-list -->';
	}
endif;

if ( ! function_exists( 'blog_diary_content_end' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Blog Diary  1.0.0
	 *
	 */
	function blog_diary_content_end() {
		?>
        </div><!-- #content -->
		<?php
	}
endif;
add_action( 'blog_diary_content_end_action', 'blog_diary_content_end', 10 );

if ( ! function_exists( 'blog_diary_footer_start' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Blog Diary  1.0.0
	 *
	 */
	function blog_diary_footer_start() {
		?>
		<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
	}
endif;
add_action( 'blog_diary_footer', 'blog_diary_footer_start', 10 );

if ( ! function_exists( 'blog_diary_footer_site_info' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Blog Diary  1.0.0
	 *
	 */
	function blog_diary_footer_site_info() {
		$theme_data = wp_get_theme();
        $options = blog_diary_get_theme_options();
        $search = array( '[the-year]', '[site-link]' );
	
       	$replace = array( date( 'Y' ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );

        $options['copyright_text'] = str_replace( $search, $replace, $options['copyright_text'] );
        $copyright_text = $options['copyright_text']; 
        $poweredby_text = esc_html( $theme_data->get( 'Name') ) . '&nbsp;' . esc_html__( 'by', 'blog-diary' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_html( ucwords( $theme_data->get( 'Author' ) ) ) .'</a>';
        ?>
		<div class="site-info col-2">
                <div class="wrapper">
                    <span class="copyright-text">
	                   	<?php echo blog_diary_santize_allow_tag( $copyright_text ); ?>
	               		<?php 
	               			echo blog_diary_santize_allow_tag( $poweredby_text );
	                		if ( function_exists( 'the_privacy_policy_link' ) ) {
								the_privacy_policy_link( ' | ' );
							}
	                	?>
                	</span>
                </div><!-- .wrapper -->    
            </div><!-- .site-info -->

		<?php
	}
endif;
add_action( 'blog_diary_footer', 'blog_diary_footer_site_info', 40 );

if ( ! function_exists( 'blog_diary_footer_scroll_to_top' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Blog Diary  1.0.0
	 *
	 */
	function blog_diary_footer_scroll_to_top() {
		$options  = blog_diary_get_theme_options();
		if ( true === $options['scroll_top_visible'] ) : ?>
			<div class="backtotop"><?php echo blog_diary_get_svg( array( 'icon' => 'up' ) ); ?></div>
		<?php endif;
	}
endif;
add_action( 'blog_diary_footer', 'blog_diary_footer_scroll_to_top', 40 );

if ( ! function_exists( 'blog_diary_footer_end' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Blog Diary  1.0.0
	 *
	 */
	function blog_diary_footer_end() {
		?>
		</footer>
		<div class="popup-overlay"></div>
		<?php
	}
endif;
add_action( 'blog_diary_footer', 'blog_diary_footer_end', 100 );
