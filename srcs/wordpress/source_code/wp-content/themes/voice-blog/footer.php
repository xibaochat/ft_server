<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package voice_blog
 */

?>



	<footer id="colophon" class="site-footer">
    <section>
     
      <div class="info-content">
        <div class="container-fluid wow fadeInUp">
          <div class="row">
            <div class="col-md-4">
              <?php get_sidebar( 'footer-1' );?>
            </div>
            <div class="col-md-4">
            <?php get_sidebar( 'footer-2' );?>
            </div>
            <div class="col-md-4">
            <?php get_sidebar( 'footer-3' );?>
            </div>
          </div>
          <?php if(absint(get_theme_mod('voice_blog_footer_title','1'))==1) : ?>
            <div class="f-about text-center">
              <div class="logo">
                <p class="site-title logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a><p>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="site-info copyright">
        <div class="container">

          <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'voice-blog' ) ); ?>">
            <?php
            /* translators: %s: CMS name, i.e. WordPress. */
            printf( esc_html__( 'Proudly powered by %s', 'voice-blog' ), 'WordPress' );
            ?>
          </a>
          <span class="sep "> | </span>
            <?php
            /* translators: 1: Theme name, 2: Theme author. */
            printf( esc_html__( 'Theme : %2$s : by :  %1$s', 'voice-blog' ), '<a href="https://www.postmagthemes.com" target="_blank" > Postmagthemes </a>' , '<a href="https://www.postmagthemes.com/downloads/voice-blog-free-wordpress-theme/" target="_blank">Voice Blog free WordPress theme </a>' );

            if (absint(get_theme_mod('voice_blog_social_bottom_enable','0'))==1) : 
            voice_blog_social_network();  
            endif ; ?>
        </div>
      </div><!-- .site-info -->
    </section>
  </footer><!-- #colophon -->
  </div><!-- #content -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
