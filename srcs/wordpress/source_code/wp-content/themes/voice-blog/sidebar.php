<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package voice_blog
 */

?>
<aside id="sidebar-1" class="widget-area">
	<div class="sidebar">

	<?php if( absint(get_theme_mod('voice_blog_sidebar_about_enable','0')) ==1) : ?>
	<section class="about-me block wow fadeInUp">
		<div class="side-title mb-5">
			<h4><span><?php echo esc_html(get_theme_mod('voice_blog_sidebar_about_title',__('About Me','voice-blog')) ); ?></span></h4>
		</div>
		<div class="img-holder">
			<img src="<?php echo esc_url(get_theme_mod( 'voice_blog_sidebar_about_image') ) ?> " alt="">
		</div> 
		<p><?php echo esc_html(get_theme_mod('voice_blog_sidebar_about_textarea',__('Mauris eget pharetra lectus','voice-blog') )) ?></p>
	</section>
	<?php endif ;
	if(absint(get_theme_mod('voice_blog_social_sidebar_enable','0'))==1) :?>
		<section class="get-connected block wow fadeInUp">
			<div class="side-title mb-5">
				<h4><span><?php echo esc_html(get_theme_mod('voice_blog_social_sidebar_title',__('Stay Connected','voice-blog'))) ?></h4>
			</div>
			<ul class="social-icon">
				<?php if(absint(get_theme_mod('voice_blog_facebook_url_enable','1'))==1) : ?>
				<li class=" bg-white" ><a  href="<?php echo esc_url(get_theme_mod( 'voice_blog_social_url_'.'Facebook'))?>"target="_blank"><span class="fa fa-facebook bg-white" aria-hidden="true"></span></a> </li>
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
		</section>
	<?php endif ; 

	if (absint(get_theme_mod('voice_blog_sidebar_post_enable','0'))== 1) : ?>
	<section class="latest-post block">
		<div class="side-title mb-5 onlyme">
			<h4><span><?php echo esc_html(get_theme_mod('voice_blog_sidebar_post_title',__('Latest Posts','voice-blog')) ); ?></span></h4>
		</div>
		<?php $args = array( 
		'post_type' => 'post',
		'category_name' => esc_attr(get_theme_mod('voice_blog_sidebar_post_categorylist','')),
		'author'	   => esc_attr(get_theme_mod ('voice_blog_sidebar_post_authorlist','')),
		'orderby' => array( esc_attr(get_theme_mod('voice_blog_sidebar_post_order', 'date')) => 'DSC', 'date' => 'DSC'),
		'order'     => 'DSC',
		'posts_per_page' => absint(get_theme_mod( 'voice_blog_sidebar_post_noofpost','4' )),
		);
		$listings = new WP_Query( $args );
		if ( $listings->have_posts() ) :
			/* Start the Loop */
			while ( $listings->have_posts() ) :
					$listings->the_post(); 
			?>
			<div class="media wow fadeInUp">
			<?php if (absint(get_theme_mod('voice_blog_sidebar_post_post_taxonomy_Image','1')) == 1) :
			voice_blog_sidebar_latestpost_thumbnail();
			endif; ?>
				<div class="media-body">
					<?php if (absint(get_theme_mod('voice_blog_sidebar_post_post_taxonomy_Date','1')) == 1) : ?>
						<div class="bl-date">
							<?php voice_blog_posted_on() ?>
						</div>
					<?php endif ;
					the_title( '<h5 class="mt-0"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>
				</div>
			</div>
			<?php endwhile;
			wp_reset_postdata(); 
		endif; ?>
	</section>
	<?php endif; 
	
	if (absint(get_theme_mod('voice_blog_sidebar_quote_enable','0')) ==1) : ?>
	<blockquote class="block wow fadeInUp">
		<div class="side-title mb-5">
		<h4><span><?php echo esc_html(get_theme_mod('voice_blog_sidebar_quote_title',__('Quotes Of The Day','voice-blog')) ); ?></span></h4>
		</div>
		<p>
		<span class="fa fa-quote-left" aria-hidden="true"></span>
		<?php echo esc_html(get_theme_mod('voice_blog_sidebar_quote_textarea',__('this is my quote','voice-blog')) ) ?>;
		<span class="fa fa-quote-right" aria-hidden="true"></span>
		</p>
	</blockquote>
	<?php endif ; 
	dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</aside><!-- #secondary -->