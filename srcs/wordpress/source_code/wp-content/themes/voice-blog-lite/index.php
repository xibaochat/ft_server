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
 * @package voice_blog_lite
 */

get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
	<?php if(absint(get_theme_mod('voice_blog_lite_banner_slider_enable','1')) == 1) : ?>

		<section id ="banner-slider" class ="container-fluid banner-holder block-2 wow fadeInUp"> 
			<h2 class ="section-title text-center mb-5"> <?php echo esc_html( get_theme_mod('voice_blog_lite_banner_slider_title','Banner Slider')) ?></h2>
			<div class="banner ">
			<?php 
			$args = array( 
            'post_type' => 'post',
            'category_name' => esc_attr(get_theme_mod('voice_blog_lite_banner_slider_categorylist','')),
			'author'	   => esc_attr(get_theme_mod ('voice_blog_lite_banner_slider_authorlist','')),
			'orderby' => array( esc_attr(get_theme_mod('voice_blog_lite_banner_slider_order', 'date')) => 'DSC', 'date' => 'DSC'),
			'order'     => 'DSC',
			'posts_per_page' => absint(get_theme_mod( 'voice_blog_lite_banner_slider_noofpost','4' )),
            );
        	$listings = new WP_Query( $args );
            if ( $listings->have_posts() ) :

            /* Start the Loop */
            while ( $listings->have_posts() ) :
				$listings->the_post();
				if (is_sticky()) { 

				} else { ?>					
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="item ml-1 mr-1">
						<header class="entry-header">
							<?php
							if ( ! has_post_thumbnail() ) {
								?>
								<div>
									<img  src = "<?php echo esc_url( get_template_directory_uri() ); ?>/images/1200x600.jpg " >
								</div>
								<?php 
							} else if ( has_post_thumbnail() ) {
								voice_blog_banner_thumbnail();
							}
							?>
						</header><!-- .entry-header -->
						<div class="caption">
							<div class="tag">
							<?php 
								if (absint(get_theme_mod('voice_blog_lite_banner_slider_post_taxonomy_Category','1')) == 1) : 
									$categories = esc_attr(get_cat_ID (get_theme_mod('voice_blog_lite_banner_slider_categorylist','') ));
									if (! $categories == 0) :
										echo '<a class=" btn" href="' . esc_url( get_category_link( $categories) ) . '">' . esc_html( get_theme_mod('voice_blog_lite_banner_slider_categorylist','') ) . '</a>';
									else:
										$categories = get_the_category();
									if ( ! empty( $categories ) ) {
										echo '<a class=" btn" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
									}
									endif;
								endif;
							?>
							</div>
						<?php if (absint(get_theme_mod('voice_blog_lite_banner_slider_post_taxonomy_Title','1')) == 1) : 
							the_title( '<h2 class=" banner-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						endif; ?>
						</div>
						
					</div>
					</article>
				<?php }
            endwhile;
            wp_reset_postdata();
			else :
			get_template_part( 'template-parts/content', 'none' );
			endif;
			?> </div>
		</section>
	<?php endif; ?>
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
							<?php if (absint(get_theme_mod('voice_blog_lite_blog_post_layout','1'))==3): ?>
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
											'pre_text' => __('Previous', 'voice-blog-lite'),
											'next_text' => __('Next', 'voice-blog-lite'),
										)); 
									?>
								</div>
							</section>
							</div>
							<?php endif;
							if (absint(get_theme_mod('voice_blog_lite_blog_post_layout','1'))==2): ?>
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
											'pre_text' => __('Previous', 'voice-blog-lite'),
											'next_text' => __('Next', 'voice-blog-lite'),
										));
									?>
								</div>
							</div>
							</section>
							<?php endif;
							if (absint(get_theme_mod('voice_blog_lite_blog_post_layout','1'))==1): ?>
							<section class="mt-5">
							<div class="thumb-blog">
							<h2 class ="section-title text-center mb-5"> <?php echo esc_html(get_theme_mod('voice_blog_blog_post_title',__('Blog post','voice-blog-lite'))) ?></h2>

								<div class="row">
									<?php if ( have_posts() ) :
										/* Start the Loop */
										while ( have_posts() ) :
											the_post();
											?>
											<div class="col-md-12">
											<?php
												get_template_part( 'template-parts/content-1column' ); 
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
											'pre_text' => __('Previous', 'voice-blog-lite'),
											'next_text' => __('Next', 'voice-blog-lite'),
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