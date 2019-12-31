<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="media wow fadeInUp">
    <?php if ( ! has_post_thumbnail() ) {
            if ( get_theme_mod('voice_blog_blog_post_post_taxonomy_'.__('Grey image if feature image is not used','voice-blog'),'1') ==1) { ?>
            
            <div>
                <img  class="card-img-top img-holder" src = "<?php echo esc_url( get_template_directory_uri() ); ?>/images/500x400.jpg " >
            </div>
            <?php } 
            
        } else if ( has_post_thumbnail() ) {
            voice_blog_post_thumbnail();
        }  ?>
        <div class="media-body">
            <header class="entry-header">
                <div class="tag-date-comment">
                    <?php if(absint(get_theme_mod('voice_blog_blog_post_post_taxonomy_Category','1'))==1):
                    voice_blog_cat();
                    endif; ?>
                    <ul class="date-comment">
                        <?php if(absint(get_theme_mod('voice_blog_blog_post_post_taxonomy_Date','1'))==1): ?>
                            <li> <?php voice_blog_posted_on() ?></li>
                        <?php endif; ?>
                        <?php if(absint(get_theme_mod('voice_blog_blog_post_post_taxonomy_Comment','1'))==1): ?>
                            <li><?php voice_blog_post_comment() ?></li>
                        <?php endif; ?>
                        <li><?php  voice_blog_edit_post() ?></li>
                    </ul>
                    <?php if(absint(get_theme_mod('voice_blog_blog_post_post_taxonomy_Tag','1'))==1): ?>
                        <span class ="tag"> <?php voice_blog_post_tag() ?></span>
                    <?php endif; ?>                </div>
                <?php the_title( '<h2 class="card-title blog-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
            </header>
            <?php the_excerpt(); ?>
        </div>
    </div>
    <footer class="entry-footer">
        <?php voice_blog_modal(); ?>        
    </footer>
</article>