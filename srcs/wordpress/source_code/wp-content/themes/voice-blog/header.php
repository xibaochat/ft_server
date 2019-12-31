<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package voice_blog
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>  >
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'voice-blog' ); ?></a>
	<header id="masthead" class="site-header ">
		<div id = "main_header">
				<?php if ( has_header_image() ) { ?>
				<div class="container-header">
					<div >
					<?php the_custom_header_markup(); ?>	
					</div>
					<!-- Title -->
					<div class=" logo text-center mx-auto overlays" >
						<?php if(absint(get_theme_mod('voice_blog_social_top_enable','0'))==1) : 
							voice_blog_social_network();
						endif ; ?>

						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
						$voice_blog_description = get_bloginfo( 'description', 'display' );
						if ( $voice_blog_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $voice_blog_description; /* WPCS: xss ok. */ ?></p>
						<?php endif; ?>
					</div>
				</div>
				<?php } elseif ( ! has_header_image() ) { ?>
				<!-- Title -->
				<div class=" text-center mx-auto logo  ">
				<?php if(absint(get_theme_mod('voice_blog_social_top_enable','0'))==1) :
						voice_blog_social_network();
				endif ; ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
					$voice_blog_description = get_bloginfo( 'description', 'display' );
					if ( $voice_blog_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $voice_blog_description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
				</div>
			<?php } ?>
	</div> 	<!-- end Main header -->
	</header><!-- #masthead -->
	<div id="content" class="site-content">
		<div id = "main-bar" class = "sticky-top pt-2 pb-2 sticky-top-main-menu" >
			
			
			<!-- Main menu -->
			<nav id="main_nav" class=" navbar navbar-expand-lg col-lg-12 " role="navigation">
				<?php if ( function_exists(  "the_custom_logo" ) ) { ?> 	
				<div class =" custom-logo ml-4 mr-5 float-left <?php if ( ! has_custom_logo() ) { echo 'pl-5'; } ?> " >	
					<?php the_custom_logo(); ?> 
				</div> 
				<?php } ?>	
			<!-- Brand and toggle get grouped for better mobile display -->
				<button class="navbar-toggler mr-5" type="button" data-toggle="collapse" data-target="#collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
					<span class="fa fa-bars bg-white"></span>
				</button>
					<?php
					wp_nav_menu( array(
						'theme_location'    => 'menu-1',
						'depth'             => 5,
						'container'         => 'div',
						'container_class'   => 'collapse navbar-collapse' ,
						'container_id'      => 'collapse-1',
						'menu_class'        => 'nav navbar-nav mx-auto ',
						'fallback_cb'       => 'voice_blog_WP_Bootstrap_Navwalker::fallback',
						'walker'            => new voice_blog_WP_Bootstrap_Navwalker(),
					) );
					?>
				<div id ="right-nav" class=' mr-5 float-right'>
						<!-- Right nav -->
						<ul class="search-tab ">
							<li><a href="javascript:;" class="toggle" id="sidenav-toggle" ><span class="fa fa-angle-double-left  bg-white" aria-hidden="true"></span></a></li>
						</ul>
				</div>	

			</nav> <!-- End Main menu -->
			<div class ="clearfix"></div>
			
		</div> <!-- main-bar -->
		<!-- side nav -->
		<nav class="sidenav" data-sidenav data-sidenav-toggle="#sidenav-toggle">					
				<?php get_sidebar( 'menubar-4' );?> 
		</nav> <!-- end side nav -->
		