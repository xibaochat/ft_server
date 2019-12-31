<section>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="author">
            <div class="title-holder text-center other-title">
                <h2><span><?php echo esc_html(get_theme_mod('voice_blog_single_page_author_title',__('Author','voice-blog'))); ?></span></h2>
            </div>
            <div class="media">
                <?php if (absint(get_theme_mod('voice_blog_single_page_post_taxonomy_Avatar','1'))==1) : ?>
                <div class="img-holder mr-4">
                <?php echo get_avatar( get_the_author_meta('ID'), 100); ?>
                </div>
                <?php endif ; ?>
                <div class="media-body">
                    <header class="entry-header">
                    <div class="title-share">
                        <div class= "w-100">
                            <?php voice_blog_posted_by(); ?> 
                        </div>
                        <?php if (absint(get_theme_mod('voice_blog_single_page_post_taxonomy_Email','1'))==1) : ?>
                        <div>
                        <?php the_author_meta('user_email');?>
                        </div>
                        <?php endif ; ?>
                    </div>
                    </header>
                    <?php if (absint(get_theme_mod('voice_blog_single_page_post_taxonomy_Description','1'))==1) : ?>
                    <div >
                    <?php echo the_author_meta('description'); ?>
                    </div>
                    <?php endif ; ?>
                </div>
            </div>
        </div>
    </article>
</section>