<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
		if(absint(get_theme_mod('voice_blog_sidebar_enable','1')) == 1) : 
		$modes1 = 9;
		elseif (absint(get_theme_mod('voice_blog_sidebar_enable','1')) == 0) :
		$modes1 = 12;
		endif ;
		?>
		<section class="middle-content blog-post ">
			<div class="container-fluid">
				<div class ="row" >
					<div class="col-lg-<?php echo esc_attr($modes1) ?> ">
					<?php dynamic_sidebar( 'sidebar-7' ); ?>
						<?php if (absint(get_theme_mod('voice_blog_blog_post_enable','1'))==1): ?>
							<?php if (absint(get_theme_mod('voice_blog_blog_post_layout','2'))==3): ?>
							<div class="list-blog ">
							<section class="mt-5">
							<h2 class ="section-title text-center mb-5"> <?php echo esc_html(get_theme_mod('voice_blog_blog_post_title')) ?></h2>
								<div class="row ">
									<?php if ( have_posts() ) :
										/* Start the Loop */
										while ( have_posts() ) :
										the_post();
										?>
										<div class="col-md-12">
										
										<?php	get_template_part( 'template-parts/content-list' ); 
										?>
										</div>
									<?php endwhile;
									else :
									get_template_part( 'template-parts/content', 'none' );
									endif;
									?>
								</div>
								<div class=" text-center">
									<?php 
										the_posts_pagination( array(
											'pre_text' => __('Previous', 'voice-blog'),
											'next_text' => __('Next', 'voice-blog'),
										)); 
									?>
								</div>
							</section>
							</div>
							<?php endif;
							if (absint(get_theme_mod('voice_blog_blog_post_layout','2'))==2): ?>
							<section class="mt-5">
							<div class="grid-blog">
							<h2 class ="section-title text-center mb-5 mt-5"> <?php echo esc_html(get_theme_mod('voice_blog_blog_post_title')) ?></h2>

								<div class="row">
									<?php if ( have_posts() ) :
										/* Start the Loop */
										while ( have_posts() ) :
											the_post();
											?>
											<div class="col-md-6">
												<?php 
												get_template_part( 'template-parts/content' ); 
												
												?>
											</div>
										<?php endwhile;
									else :
									get_template_part( 'template-parts/content', 'none' );
									endif;
									?>
								</div>
								<div class=" text-center">
									<?php 
										the_posts_pagination( array(
											'pre_text' => __('Previous', 'voice-blog'),
											'next_text' => __('Next', 'voice-blog'),
										));
									?>
								</div>
							</div>
							</section>
							<?php endif;?>
						<?php endif;?>
					</div> <!-- End col -->
					<!-- End Blog post -->
						<?php if(absint(get_theme_mod('voice_blog_sidebar_enable','1')) == 1) : ?>
						<div class="col-lg-3">
								<?php get_sidebar()?>
						</div>
						<?php endif; ?>
				</div> <!-- row -->
				
			</div> <!-- container-fluid -->
			<section id ="layout-sidebar-8" class ="container-fluid"> 
				<?php dynamic_sidebar( 'sidebar-8' ); ?>
			</section>
		</section>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();