<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package voice_blog
 */

get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<section id ="layout-sidebar-6" class ="container-fluid"> 
		<?php dynamic_sidebar( 'sidebar-6' ); ?>
		</section>
		<?php
		if(absint(get_theme_mod('voice_blog_sidebar_enable_page','1')) == 1) : 
		$modes1 = 9;
		elseif (absint(get_theme_mod('voice_blog_sidebar_enable_page','1')) == 0) :
		$modes1 = 12;
		endif ;
		?>
		<section class="middle-content homepage ">
			<div id ="scroll-here" class="container-fluid ">
			<div class ="row" >
				
				<div class="col-lg-<?php echo esc_attr($modes1) ?> ">
				<?php dynamic_sidebar( 'sidebar-7' ); ?>
					<?php
							while ( have_posts() ) :
								the_post();

								get_template_part( 'template-parts/content', 'page' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							endwhile; // End of the loop.
							?>
				</div> <!-- End col -->
				<!-- End Blog post -->
					<?php if(absint(get_theme_mod('voice_blog_sidebar_enable_page','1')) == 1) : ?>
					<div class="col-lg-3">
							<?php get_sidebar()?>
					</div>
					<?php endif; ?>
			</div> <!-- row -->	
			<?php dynamic_sidebar( 'sidebar-8' ); ?>
			</div> <!-- container-fluid -->
		</section>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();