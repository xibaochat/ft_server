<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="thumb wow fadeInUp">
        <?php if ( ! has_post_thumbnail() ) {
            if ( get_theme_mod('voice_blog_blog_post_post_taxonomy_'.__('Grey image if feature image is not used','voice-blog-lite'),'1') ==1) { ?>
                <div>
                    <img  class="card-img-top img-holder" src = "<?php echo esc_url( get_template_directory_uri() ); ?>/images/750x350.jpg " >
                </div>
            <?php }  
        } else if ( has_post_thumbnail() ) {
            voice_blog_lite_blog_1colume_thumbnail();
        }  ?>
        <div class="thumb-body">
            <header class="entry-header">
                <?php the_title( '<h2 class="card-title blog-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
            </header>
                <?php the_excerpt(); ?>
            <footer class="entry-footer">
                <div class="tag-date-comment ">
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
                        <span class ="tag text-center"> <?php voice_blog_post_tag() ?></span>
                    <?php endif; ?>
                </div>
                
            </footer>
        </div>
    </div>
    <div class ="text-center ">
        <?php voice_blog_modal(); ?> 
    </div> 

    <?php if (absint(get_theme_mod('voice_blog_lite_blog_related_enable','1')) ==1) : ?>

        <div class =" mt-4 mb-4" >
            <?php $orig_post = $post;
            $categories = get_the_category($post->ID);
            if ($categories) {
                $category_ids = array();
                foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
                    $args=array(
                    'category__in' => $category_ids,
                    'orderby' => array( esc_attr(get_theme_mod('voice_blog_related_post_order', 'date')) => 'DSC', 'date' => 'DSC'),
                    'post__not_in' => array($post->ID),
                    'posts_per_page'=> absint(get_theme_mod( 'voice_blog_related_post_noofpost','6' )),
                    'ignore_sticky_posts'=>1
                    );
                $my_query = new wp_query( $args );
                if( $my_query->have_posts() ) { ?> 
                    <div class="related-posts">
                        <div class="title-holder text-center other-title">
                            <h2><span><?php echo esc_html(get_theme_mod('voice_blog_related_post_title',__('Related Posts','voice-blog-lite'))); ?></span></h2>
                        </div>
                        <div class="row">
                            <?php while( $my_query->have_posts() ) {
                                $my_query->the_post();?>
                                <div class="col-md-12">
                                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <div class="card">                    
                                            <?php 
                                            if ( ! has_post_thumbnail() ) {
                                                if ( get_theme_mod('voice_blog_related_post_post_taxonomy_'.__('Grey image if feature image is not used','voice-blog-lite'),'1') ==1) { ?>
                                                
                                                <div>
                                                    <img  class="card-img-top" src = "<?php echo esc_url( get_template_directory_uri() ); ?>/images/500x400.jpg " >
                                                </div>
                                                <?php } 
                                                
                                            } else if ( has_post_thumbnail() ) {
                                                voice_blog_post_thumbnail();
                                            } 
                                            ?>
                                        </div>
                                    </article>
                                </div>
                            <?php }
                            wp_reset_postdata(); ?>
                        </div>
                    </div>
                <?php }
            }
            $post = $orig_post;
            ?></div>
    <?php endif ; ?>
</article>