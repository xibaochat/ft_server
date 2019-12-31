<?php
/**
 * Recent Posts Widget
 *
 * @package Theme Palace
 * @subpackage Blog Diary 
 * @since Blog Diary  1.0.0
 */

if ( ! class_exists( 'Blog_Diary_Recent_Post' ) ) :

     
    class Blog_Diary_Recent_Post extends WP_Widget {
        /**
         * Sets up the widgets name etc
         */
        public function __construct() {
            $tp_widget_popular_post = array(
                'classname'   => 'widget_recent_post',
                'description' => esc_html__( 'Retrive Recent posts.', 'blog-diary' ),
            );
            parent::__construct( 'blog_diary_recent_post', esc_html__( 'TP : Recent Posts', 'blog-diary' ), $tp_widget_popular_post );
        }

        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */
        public function widget( $args, $instance ) {
            // outputs the content of the widget
            if ( ! isset( $args['widget_id'] ) ) {
                $args['widget_id'] = $this->id;
            }

            $tp_title    = ( ! empty( $instance['title'] ) ) ? ( $instance['title'] ) : '';
            $tp_title    = apply_filters( 'widget_title', $tp_title, $instance, $this->id_base );
            $tp_number   = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
            $tp_category = isset( $instance['category'] ) ? absint( $instance['category'] ) : '';

            echo $args['before_widget'];
                if ( ! empty( $tp_title ) ) {
                    echo $args['before_title'] . esc_html( $tp_title ) . $args['after_title'];
                }
            $popular_args = array(
                'post_type'         => 'post',
                'posts_per_page'    => absint( $tp_number ),
                'order'             => 'DESC',
                'cat'               => absint( $tp_category ),
                );

            echo '<ul>';
            $wp_query = get_posts( $popular_args );
            foreach ( $wp_query as $post ) :
            ?>
                <li>
                    <a href="<?php the_permalink( $post->ID ); ?>">
                        <?php 
                            if ( has_post_thumbnail( $post->ID ) ) :
                                $image = get_the_post_thumbnail( $post->ID, $size = 'thumbnail', array( 'alt' => esc_attr( get_the_title( $post->ID ) ) ) );
                                echo $image;
                            else :
                                echo '<img src="' . esc_url( get_template_directory_uri() .'/assets/uploads/no-featured-image-600x450.jpg' ) . '" alt="'. the_title_attribute( 'echo=0' ) .'">';
                            endif; 
                        ?>
                    </a>
                    <h3><a href="<?php the_permalink( $post->ID ); ?>"><?php echo esc_html( $post->post_title ); ?></a></h3>
                    <div class="entry-meta">
                    <?php
                        blog_diary_posted_on( $post->ID );
                    ?> 
                    </div><!-- .entry-meta -->
                </li>

            <?php
            endforeach;
            echo '</ul>';
            echo $args['after_widget'];
        }

        /**
         * Outputs the options form on admin
         *
         * @param array $instance The widget options
         */
        public function form( $instance ) {
            $tp_title      = isset( $instance['title'] ) ? ( $instance['title'] ) : esc_html__( 'Recent Posts', 'blog-diary' );
            $tp_number     = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
            $tp_category   = isset( $instance['category'] ) ? absint( $instance['category'] ) : '';
           ?>

           <p>
               <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'blog-diary' ); ?></label>
               <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $tp_title ); ?>" />
           </p>

           <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'blog-diary' ); ?></label>
                <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" max="7" value="<?php echo absint( $tp_number ); ?>" size="3" />
           </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Select the category to show posts:', 'blog-diary' ); ?></label>
                <select id="<?php echo esc_attr( $this->get_field_id('category') ); ?>" name="<?php echo $this->get_field_name('category'); ?>" class="widefat" style="width:100%;">
                    <?php 
                    $categories = blog_diary_category_choices();
                    foreach($categories as $category => $value) { ?>
                    <option value="<?php echo absint( $category ); ?>" <?php selected( $tp_category, $category ); ?>><?php echo esc_html( $value ); ?></option>
                    <?php } ?>      
                </select>
            </p>

           <?php
        }

        /**
        * Processing widget options on save
        *
        * @param array $new_instance The new options
        * @param array $old_instance The previous options
        */
        public function update( $new_instance, $old_instance ) {
            // processes widget options to be saved
            $instance           = $old_instance;
            $instance['title']  = sanitize_text_field( $new_instance['title'] );
            $instance['number'] = (int) $new_instance['number'];
            $instance['category'] = blog_diary_sanitize_single_category( $new_instance['category'] );
           
            return $instance;
        }
    }
endif;
