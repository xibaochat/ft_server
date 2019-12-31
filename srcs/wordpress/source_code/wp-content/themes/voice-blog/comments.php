<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package voice_blog
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		 the_comments_navigation(); ?>
		
		<div class="comment-list comments">
			<div class="title-holder text-center other-title">
                <h2><span> <?php esc_html_e('Comments','voice-blog') ?></span></h2>
            </div>
		
			<?php wp_list_comments( 'type=comment&callback=voice_blog_comment'); ?>
		</div><!-- .comment-list -->
		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'voice-blog' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	  comment_form();
	?>
</div><!-- #comments -->
