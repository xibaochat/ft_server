<?php
/**
* Partial functions
*
* @package Theme Palace
* @subpackage Blog Diary 
* @since Blog Diary  1.0.0
*/

if ( ! function_exists( 'blog_diary_latest_posts_title_partial' ) ) :
    // latest_posts title
    function blog_diary_latest_posts_title_partial() {
        $options = blog_diary_get_theme_options();
        return esc_html( $options['latest_posts_title'] );
    }
endif;

if ( ! function_exists( 'blog_diary_must_read_posts_title_partial' ) ) :
    // must_read_posts title
    function blog_diary_must_read_posts_title_partial() {
        $options = blog_diary_get_theme_options();
        return esc_html( $options['must_read_posts_title'] );
    }
endif;

if ( ! function_exists( 'blog_diary_blog_title_partial' ) ) :
    // blog title
    function blog_diary_blog_title_partial() {
        $options = blog_diary_get_theme_options();
        return esc_html( $options['blog_title'] );
    }
endif;

if ( ! function_exists( 'blog_diary_copyright_text_partial' ) ) :
    // blog btn title
    function blog_diary_copyright_text_partial() {
        $options = blog_diary_get_theme_options();
        return esc_html( $options['copyright_text'] );
    }
endif;

