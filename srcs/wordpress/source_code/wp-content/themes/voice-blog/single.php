<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package voice_blog
 */

get_header();
?>

<div id="primary" class="content-area " onLoad="window.scroll(0, 500)">
	<main id="main" class="site-main mt-5">
		<?php
			if(absint(get_theme_mod('voice_blog_sidebar_enable','1')) == 1) : 
			$modes1 = 12 - absint(get_theme_mod('voice_blog_sidebar_width','4'));
			elseif (absint(get_theme_mod('voice_blog_sidebar_enable','1')) == 0) :
			$modes1 = 12;
			endif ;
			?>
	<section class="middle-content inner-content">
		<div class="container-fluid">
			<div id ="scroll-here" class="row">
				<?php if(absint(get_theme_mod('voice_blog_sidebar_position','2')) == 1) : ?>
					<?php if(absint(get_theme_mod('voice_blog_sidebar_enable','1')) == 1) : ?>
					<div class="col-lg-<?php echo esc_attr(get_theme_mod('voice_blog_sidebar_width','4')) ?>">
							<?php get_sidebar()?>
					</div>
					<?php endif; ?>
				<?php endif; ?>
					<div class="col-lg-<?php echo esc_attr($modes1) ?>">
						<?php
						while ( have_posts() ) :
							the_post();
						?>
						<div class="detail-block">
							<section>
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

									<div class="thumb text-center">
										<header class="entry-header">
										<?php 
										
											the_post_thumbnail();
										
										the_title( '<h1 class="entry-title card-title mt-5">', '</h1>' ); ?>

										</header>
										<div class="thumb-body text-justify">
											
											<footer>
												<div class="coment-share mb-4">
													<div class="tag-date-comment">
														<?php voice_blog_cat(); ?>
														<ul class="date-comment">
														<li> <?php voice_blog_posted_on() ?></li>
														<li><?php voice_blog_post_comment() ?></li>
														<li><?php  voice_blog_edit_post() ?></li>
														</ul>
														<span class ="tag"> <?php voice_blog_post_tag() ?></span>
													</div>
													
												</div>
											</footer>
											<?php 
											
											the_content();
																		
											?>
										</div>
									</div>
								</article>
							</section>
							<div class =" mt-5 mb-5">
								<?php
								// Previous/next post navigation.
								the_post_navigation( array(
									'next_text' =>  __( 'Next post', 'voice-blog' ),
									'prev_text' =>  __( 'Previous post', 'voice-blog' )
								) );
								?>
							</div>
							<?php if (absint(get_theme_mod('voice_blog_single_page_post_taxonomy_'.__('Author section','voice-blog'),'1'))==1) :
							get_template_part( 'template-parts/template-core/author-section' ); 
							endif ;
							if (absint(get_theme_mod('voice_blog_related_post_enable','1')) ==1) :
								get_template_part( 'template-parts/template-core/related-post' ); 
							endif ; ?>
							<?php if ( comments_open() || get_comments_number() ) :
									comments_template();
							endif; ?>
							
						</div>
						<?php endwhile; ?> 

				</div>
				<?php if(absint(get_theme_mod('voice_blog_sidebar_position','2')) == 2) : ?>
					<?php if(absint(get_theme_mod('voice_blog_sidebar_enable','1')) == 1) : ?>
					<div class="col-lg-<?php echo esc_attr(get_theme_mod('voice_blog_sidebar_width','4')) ?>">
							<?php get_sidebar()?>
					</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>	
	</section>	
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
