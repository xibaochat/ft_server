<?php
/**
 * Postmag widget Most_commented
 * @package Postmagthemes
 * @subpackage voice_blog
 */
if ( ! class_exists( 'voice_blog_multiple_post_banner' ) ) :
	class voice_blog_multiple_post_banner extends WP_Widget{
		function __construct() {
			parent::__construct(
				'custom_multiple_post_banner', // Base ID
				__( 'Built Style 4 - Multiple Post Banner', 'voice-blog' ), // Name
				array( 'description' =>__( 'Displays multiple post banner layout', 'voice-blog' ) )
			);
		}
		private function defaults(){
			$defaults = array( 
				'categoryListings' => '',
				'postauthor' => '',
				'orderby'	 => 'date',
				'noofpost'	=> 7,
			);
			return $defaults;
		}
		public function form( $instance) {
			$instance = wp_parse_args( (array) $instance, $this->defaults() );
			$categoryListings = $instance[ 'categoryListings' ];
			$postauthor = $instance[ 'postauthor' ];
			$orderby = $instance[ 'orderby' ];
			$noofpost = $instance[ 'noofpost' ];
			?>
			<!-- CODE FOR CHOSING AUTHOR -->
			<label><?php esc_html_e( 'Select post among author', 'voice-blog' ); ?></label>
			<br/>
			<?php
                $voice_blog_postauthor = array(
					'show_option_all'         => __('All author ','voice-blog'),
					'hide_if_only_one_author' => null, // string
					'orderby'                 => 'display_name',
					'order'                   => 'ASC',
					'include'                 => null, // string
					'exclude'                 => null, // string
					'multi'                   => false,
					'show'                    => 'display_name',
					'echo'                    => true,
					'selected'                => $postauthor,
					'include_selected'        => false,
					'name'               => esc_html( $this->get_field_name('postauthor') ),
                    'id'                 => absint( $this->get_field_id('postauthor') ),
					'class'                   => null, // string 
					'blog_id'                 => $GLOBALS['blog_id'],
					'who'                     => null, // string,
					'role'                    => null, // string|array,
					'role__in'                => null, // array    
					'role__not_in'            => null, // array 
                );
                wp_dropdown_users($voice_blog_postauthor);
            ?>
			<br />
			<!-- CODE FOR CHOSING CATEGORY -->
			<label><?php esc_html_e( 'Select post among category', 'voice-blog' ); ?></label>
			<?php
                $voice_blog_categoryListings = array(
					'show_option_all'    => __('All category ','voice-blog'),
                    'orderby'            => 'name',
                    'order'              => 'asc',
                    'show_count'         => 1,
                    'hide_empty'         => 1,
                    'echo'               => 1,
                    'selected'           => $categoryListings,
                    'hierarchical'       => 1,
                    'name'               => esc_html( $this->get_field_name('categoryListings') ),
                    'id'                 => absint( $this->get_field_id('categoryListings') ),
                    'class'              => 'widefat',
                    'taxonomy'           => 'category',
					'value_field'	     => 'name',
                );
                wp_dropdown_categories($voice_blog_categoryListings);
            ?>
			<br />
			<!-- CODE FOR NUMBER OF POST TO SHOW -->
			<label><?php esc_html_e( 'Number of posts to display', 'voice-blog' ); ?></label>
			<input id = "<?php echo absint( $this -> get_field_id( 'noofpost' ) );?>" name = "<?php echo esc_attr( $this -> get_field_name( 'noofpost' ) );?>" type = "number" value = "<?php echo absint( $noofpost );?>" size = "2" min="1" max="99" class = "widefat" />
			<br />
			<!-- CODE FOR ORDER BY IN LAYOUT -->
			<label><?php esc_html_e( 'Order by', 'voice-blog' ); ?></label>
			<select class='widefat' id="<?php echo $this->get_field_id('orderby'); ?>"
                name="<?php echo $this->get_field_name('orderby'); ?>" type="text">
				<option value='date'<?php echo ($orderby=='date')?'selected':''; ?>>
				<?php esc_html_e('Recently published date','voice-blog'); ?>
				</option>
				<option value='comment_count'<?php echo ($orderby=='comment_count')?'selected':''; ?>>
				<?php esc_html_e('Most commented','voice-blog'); ?>
				</option> 
				<option value='rand'<?php echo ($orderby=='rand')?'selected':''; ?>>
				<?php esc_html_e('Random','voice-blog'); ?>
				</option> 
			</select>
			<?php
		}
		public function update( $new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['categoryListings'] = ( isset( $new_instance['categoryListings'] ) ) ? sanitize_text_field( $new_instance['categoryListings'] ) : '';
			$instance[ 'postauthor' ] = ( isset( $new_instance['postauthor'] ) ) ? sanitize_text_field( $new_instance[ 'postauthor' ]) : '';
			$instance[ 'orderby' ] = ( isset( $new_instance[ 'orderby' ])) ? sanitize_text_field( $new_instance['orderby'] ) : 'date';;
			$instance[ 'noofpost' ] = absint( $new_instance[ 'noofpost' ]);

			return $instance;
		}
		public function widget( $args, $instance) {
			$instance = wp_parse_args( (array) $instance, $this->defaults());
			$categoryListings = $instance[ 'categoryListings' ];
			$postauthor = $instance[ 'postauthor' ];
			$orderby = $instance[ 'orderby' ];
			$noofpost = $instance[ 'noofpost' ];
			echo $args['before_widget'];
			$this->getRealtyListings( $noofpost,$categoryListings,$postauthor,$orderby );
			echo $args['after_widget'];
		}
		private function getRealtyListings( $noofpost,$categoryListings,$postauthor,$orderby ) {
			?>
			
    		<section class ="multiple-banner">
			<footer class="site-footer row ml-0 mr-0">
			<div class="instagram">
			<div class="row">
			<?php 
			 $args = array( 
				'post_type' => 'post',
				'category_name' => esc_attr( $categoryListings ),
				'author'	   => esc_attr( $postauthor ),
				'orderby' => array( esc_attr( $orderby ) => 'DSC', 'date' => 'DSC'),
				'order'     => 'DSC',
				'posts_per_page' => absint( $noofpost ),
				);
        	$listings = new WP_Query( $args );
            if ( $listings->have_posts() ) :
				/* Start the Loop */
				while ( $listings->have_posts() ) :
					$listings->the_post();	?>
					
			 <div class="col-lg-2 wow fadeInUp">
					<?php
					if ( ! has_post_thumbnail() ) {
					if ( absint(get_theme_mod('voice_blog_footer_slider_post_taxonomy_'.__('Grey image if feature image is not used','voice-blog'),'1')) == 1) { 

					?>
					<div>
						<img  src = "<?php echo esc_url( get_template_directory_uri() ); ?>/images/240x200.jpg " >
					</div>
					<?php }
					} else if ( has_post_thumbnail() ) {
					voice_blog_footer_thumbnail();
					}
					?>              
				</div>
				<?php endwhile;
            wp_reset_postdata();
            else :
            get_template_part( 'template-parts/content', 'none' );
            endif;
		?> </div>
		</div>
		</footer>
	</section>
		
			
		<?php }
	} //end class custom_news_Widget USED
endif;
