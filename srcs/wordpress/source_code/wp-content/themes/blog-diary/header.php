<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package Theme Palace
	 * @subpackage Blog Diary 
	 * @since Blog Diary  1.0.0
	 */

	/**
	 * blog_diary_doctype hook
	 *
	 * @hooked blog_diary_doctype -  10
	 *
	 */
	do_action( 'blog_diary_doctype' );

?>
<head>
<?php
	/**
	 * blog_diary_before_wp_head hook
	 *
	 * @hooked blog_diary_head -  10
	 *
	 */
	do_action( 'blog_diary_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>
<?php
	/**
	 * blog_diary_page_start_action hook
	 *
	 * @hooked blog_diary_page_start -  10
	 *
	 */
	do_action( 'blog_diary_page_start_action' ); 

	/**
	 * blog_diary_loader_action hook
	 *
	 * @hooked blog_diary_loader -  10
	 *
	 */
	do_action( 'blog_diary_before_header' );

	/**
	 * blog_diary_header_action hook
	 *
	 * @hooked blog_diary_site_branding -  10
	 * @hooked blog_diary_header_start -  20
	 * @hooked blog_diary_site_navigation -  30
	 * @hooked blog_diary_header_end -  50
	 *
	 */
	do_action( 'blog_diary_header_action' );

	/**
	 * blog_diary_content_start_action hook
	 *
	 * @hooked blog_diary_content_start -  10
	 *
	 */
	do_action( 'blog_diary_content_start_action' );

	/**
	 * blog_diary_header_image_action hook
	 *
	 * @hooked blog_diary_header_image -  10
	 *
	 */
	do_action( 'blog_diary_header_image_action' );
