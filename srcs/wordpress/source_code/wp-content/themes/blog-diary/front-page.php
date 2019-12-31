<?php
/**
 * The template for displaying al pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */

get_header(); ?>

<div id="inner-content-wrapper" class="wrapper relative clear">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
			// Call home if Homepage setting is set to latest posts.
			if ( blog_diary_is_latest_posts() ) {

				get_template_part( 'template-parts/content', 'home' );

			} elseif ( blog_diary_is_frontpage() ) {
			
				$options = blog_diary_get_theme_options();
		    	$sorted = array();
		    	if ( ! empty( $options['sortable'] ) ) {
					$sorted = explode( ',' , $options['sortable'] );
				}

				foreach ( $sorted as $section ) {
					add_action( 'blog_diary_primary_content', 'blog_diary_add_'. $section .'_section' );
				}
				do_action( 'blog_diary_primary_content' );
			}
		?>
			
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php
	if ( blog_diary_is_sidebar_enable() ) {
		get_sidebar();
	} ?>
</div><!-- .page-section -->
<?php
get_footer();
