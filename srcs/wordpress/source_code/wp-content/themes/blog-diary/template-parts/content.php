<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */

$options = blog_diary_get_theme_options();
$class = has_post_thumbnail() ? '' : 'no-post-thumbnail';
$readmore = ! empty( $options['read_more_text'] ) ? $options['read_more_text'] : esc_html__( 'Learn More', 'blog-diary' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?> >
    <div class="post-wrapper">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="featured-image" style="background-image: url('<?php the_post_thumbnail_url( 'post-thumbnail' ) ?>');">
                <a href="<?php the_permalink(); ?>" class="post-thumbnail-link"></a>
            </div><!-- .featured-image -->
        <?php endif; ?>

       <div class="entry-container">
            <header class="entry-header">
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        </header>

            <div class="entry-meta">
                <?php  
                echo blog_diary_author();
                blog_diary_posted_on();
                
                echo blog_diary_article_footer_meta(); ?>
            </div><!-- .entry-meta -->

            <div class="entry-content">
                <p><?php the_excerpt(); ?></p>
            </div>
            <a href="<?php the_permalink(); ?>" class="btn" >
                <span class="screen-reader-text"><?php the_title(); ?></span>
                <?php echo esc_html( $readmore ); ?>
            </a>
        </div><!-- .entry-container -->
    </div>
</article>
