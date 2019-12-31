<?php
/**
 * Banner section
 *
 * This is the template for the content of slider section
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */
if ( ! function_exists( 'blog_diary_add_slider_section' ) ) :
    /**
    * Add slider section
    *
    *@since Blog Diary  1.0.0
    */
    function blog_diary_add_slider_section() {
    	$options = blog_diary_get_theme_options();
        // Check if slider is enabled on frontpage
        $slider_enable = apply_filters( 'blog_diary_section_status', true, 'slider_section_enable' );

        if ( true !== $slider_enable ) {
            return false;
        }
        // Get slider section details
        $section_details = array();
        $section_details = apply_filters( 'blog_diary_filter_slider_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render slider section now.
        blog_diary_render_slider_section( $section_details );
    }
endif;

if ( ! function_exists( 'blog_diary_get_slider_section_details' ) ) :
    /**
    * slider section details.
    *
    * @since Blog Diary  1.0.0
    * @param array $input slider section details.
    */
    function blog_diary_get_slider_section_details( $input ) {
        $options = blog_diary_get_theme_options();
        
        $content = array();
        $post_ids = array();

        for ( $i = 1; $i <= 3; $i++ ) {
            if ( ! empty( $options['slider_content_post_' . $i] ) )
                $post_ids[] = $options['slider_content_post_' . $i];
        }

        $args = array(
            'post_type'         => 'post',
            'post__in'          => ( array ) $post_ids,
            'posts_per_page'    => 3,
            'orderby'           => 'post__in',
            );                    

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['author']    = blog_diary_author();
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-600x450.jpg';

                // Push to the main array.
                array_push( $content, $page_post );
            endwhile;
        endif;
        wp_reset_postdata();

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// slider section content details.
add_filter( 'blog_diary_filter_slider_section_details', 'blog_diary_get_slider_section_details' );


if ( ! function_exists( 'blog_diary_render_slider_section' ) ) :
  /**
   * Start slider section
   *
   * @return string slider content
   * @since Blog Diary  1.0.0
   *
   */
   function blog_diary_render_slider_section( $content_details = array() ) {
        $options = blog_diary_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>
        
            <div id="featured-slider" class="relative modern-slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 500, "dots": false, "arrows":true, "autoplay":<?php echo $options['slider_autoplay_enable'] ? 'true': 'false'; ?>, "draggable": true, "fade": false }'>
            <?php 
                $i=1;
                foreach ( $content_details as $content ) : ?>
                    <article style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');" class="<?php echo ($i==1) ? 'display-block' : 'display-none';?>">
                        <div class="entry-container">
                            <header class="entry-header">
                                <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                            </header>

                            <div class="entry-meta">
                                <?php 
                                    echo wp_kses_post( $content['author'] );
                                    blog_diary_posted_on( $content['id'] ); 
                                ?>

                                <span class="cat-links">
                                    <?php the_category( '', '', $content['id'] ); ?>
                                </span><!-- .cat-links -->

                            </div><!-- .entry-meta -->
                        </div><!-- .entry-container -->
                    </article>
            <?php 
            $i++;
            endforeach; ?>
           </div><!-- #featured-slider -->
    <?php
    }    
endif;