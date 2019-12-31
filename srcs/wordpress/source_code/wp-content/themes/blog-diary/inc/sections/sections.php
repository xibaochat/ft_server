<?php
/**
 * Home Page sections
 *
 * This is the template that includes all the other files for home page sections
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */

// banner section
require get_template_directory() . '/inc/sections/slider.php';

//latest posts
require get_template_directory() . '/inc/sections/latest-posts.php';

//must read posts
require get_template_directory() . '/inc/sections/must-read-posts.php';

// blog section
require get_template_directory() . '/inc/sections/blog.php';
