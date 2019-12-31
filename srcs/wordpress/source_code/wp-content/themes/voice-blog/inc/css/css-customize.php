<?php

/**
 * Voice blog CSS Customizer
 *
 * @package voice_blog
 *
 */

function voice_blog_customize_css() {

    ?>
	<style type="text/css">
    a:hover,
    a .cat:hover,
    .site-title a:hover,
    header ul li a:hover,
    .nav li:hover,
    .sidenav-menu a:hover,
    .middle-content .tag-date-comment ul li span a:hover,
    .bl-date:hover,
    .sidebar .categories ul li a:hover,
    .fa:hover,
    p a:link {
        color: <?php echo esc_attr( get_theme_mod( 'voice_blog_linkhover_color','#e89a35' ));?>;
    }
    .video-widths {
	width: 41.4% ;
    }
    @media (max-width: 475px){
	
    audio {
        height: 120px !important;
    }
}
    </style>
<?php }
add_action( 'wp_head', 'voice_blog_customize_css' );