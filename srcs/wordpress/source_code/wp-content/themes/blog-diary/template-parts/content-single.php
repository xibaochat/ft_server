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
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'clear' ); ?>>
        <?php if ( ! $options['single_post_hide_date'] ) : 
        	blog_diary_posted_on();
        endif; ?>
  
		<div class="entry-content">
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'blog-diary' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blog-diary' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	
	<div class="entry-meta">
		<?php 
			if ( ! $options['single_post_hide_author'] ) : 
	        	echo blog_diary_author(); 
	        endif; 
			blog_diary_single_categories();
			blog_diary_entry_footer(); 
		?>
	</div>
</article><!-- #post-## -->
