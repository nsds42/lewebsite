<?php
/**
 * Register FF Tab Widget
 * @since 0.0.1
 */
 
 
function register_jollyness_tab_widget() {
    register_widget( 'Jollyness_Tab_Widget' );
}
add_action( 'widgets_init', 'register_jollyness_tab_widget' );

function jollyness_set_post_views($postID) {
    $count_key = 'jollyness_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); 


/**
 * Add filter to single post
 * @since 0.0.1
 * updated 1.0
 */
 

function jollyness_post_view($content) {
	if(is_single()){
		$content .= jollyness_set_post_views(get_the_ID());
		// return jollyness_get_post_views(get_the_ID());
	}
	return $content;
} 

add_filter( 'the_content', 'jollyness_post_view' ); 
 

/**
 * FF Tab Widget Class
 * @since 0.0.1
 */


class Jollyness_Tab_Widget extends WP_Widget {
	
	/**
	 * Widget actual process
	 * Reference: http://codex.wordpress.org/Plugins/WordPress_Widgets_Api
	 * @since 0.0.1
	 */
	
	public function __construct() {
		$widget_ops = array('classname' => 'jollyness_tab_widget', 'description' => __('Display popular posts, recent posts, recent commets, and tags in an animated tabs.', 'jollyness'));
		$control_ops = array('width' => 250, 'height' => 350);
		parent::__construct(null, __('Liwa Tab Widget', 'jollyness'), $widget_ops, $control_ops);
	}
	
	
	
	
	/**
	 * Widget output
	 * Reference: http://codex.wordpress.org/Plugins/WordPress_Widgets_Api
	 * @since 0.0.1
	 */ 
	 
	public function widget( $args, $instance ) {
		extract( $args );
		$pop = empty( $instance['pop'] ) ? '' : $instance['pop'];
		$poplimit = empty( $instance['poplimit'] ) ? '' : $instance['poplimit'];
		$recent = empty( $instance['recent'] ) ? '' : $instance['recent'];
		$recentlimit = empty( $instance['recentlimit'] ) ? '' : $instance['recentlimit'];
		$comment = empty( $instance['comment'] ) ? '' : $instance['comment'];
		$commentlimit = empty( $instance['commentlimit'] ) ? '' : $instance['commentlimit'];
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
	?>	

		<ul class="tabs-nav blog">
			<?php
				$jollyness_nav1 = $pop;			
				$jollyness_nav2 = $recent;
				$jollyness_nav3 = $comment;			
			?>
			
			<?php if(!empty($jollyness_nav1)){ ?>			
			<li class="active"><a href="#recent"><?php echo esc_html($jollyness_nav1); ?></a></li>
			<?php } ?>
			<?php if(!empty($jollyness_nav2)){ ?>		
			<li><a href="#new"><?php echo esc_html($jollyness_nav2); ?></a></li>
			<?php } ?>
			<?php if(!empty($jollyness_nav3)){ ?>
			<li><a href="#comments"><?php echo esc_html($jollyness_nav3); ?></a></li>
			<?php } ?>			
		</ul>
		
		<div class="tabs-container">
			
			<?php if(!empty($jollyness_nav1)){ ?>
			<div class="tab-content" id="recent">
				<?php 
				
				// Popular posts
							
				$popular = new WP_Query( array( 
					'posts_per_page' => $poplimit, 
					'meta_key' => 'jollyness_post_views_count', 
					'orderby' => 'meta_value_num', 
					'order' => 'DESC'  
				) );
				
				$html = '<ul class="widget-tabs">';
				while ( $popular->have_posts() ) : $popular->the_post();
					$html .= '<li>';
                        $html .= '<div class="widget-thumb">';
                           $html .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_ID(), array(70,70)).'</a>';
                        $html .= '</div>';						
                        $html .= '<div class="widget-text">';
                           $html .= '<h4><a href="'.get_permalink().'">' . get_the_title() . '</a></h4>';
                           $html .= '<span>'.get_the_time('F, j Y').'</span>';
                        $html .= '</div><div class="clearfix"></div>';
					$html .= '</li>';
				endwhile;		
				$html .= '</ul>';	
				
				echo $html; 
				
				?>
			</div><!-- /.jollyness-pane1 -->	
			<?php } ?>
			
			<?php if(!empty($jollyness_nav2)){ ?>
			<div class="tab-content"id="new">
			
				<?php
				
				/**
				 * Recent posts
				 * ------------
				 */			 

				global $post;

				$args = array(
					'post_type' => 'post', 
					'numberposts' => $recentlimit		
				);

				$get_query_posts = get_posts($args);

				if($get_query_posts) :

					$count=0;
					$html = '<ul class="widget-tabs">';
					foreach($get_query_posts as $post) : 
						setup_postdata($post);
						$count++;					
						
						$html .= '<li>';
							$html .= '<div class="widget-thumb">';
								$html .= '<a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_ID(), array(70,70)).'</a>';
							$html .= '</div>';						
							$html .= '<div class="widget-text">';
								$html .= '<h4><a href="'.get_permalink().'">' . get_the_title() . '</h4></a>';
								$html .= '<span>'.get_the_time('F, j Y').'</span>';
							$html .= '</div><div class="clearfix"></div>';
						$html .= '</li>';
						
					endforeach;	
					$html .= '</ul>';
					
					echo $html;

				endif;

				// End of recent posts
				?>		
			
			</div> <!-- /.jollyness-pane-2 -->
			<?php } ?>
			
			
			<?php if(!empty($jollyness_nav3)){ ?>
			<div class="tab-content" id="comments">
				<?php
				
				// Comments
				//$GLOBALS['comment'] = $comment;
				$comments = get_comments( apply_filters( 'widget_comments_args', array( 
					'number' => $commentlimit, 
					'status' => 'approve', 
					'post_status' => 'publish' 
				) ) );	
				
				$output = '<ul class="widget-tabs">';
				if ( $comments ) {
					// Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
					$post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
					_prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

					foreach ( (array) $comments as $comment) {
						$avatar = get_avatar( $comment, 70 );

						$output .= '<li>';
							$output .= '<div class="widget-thumb">';
							   $output .= '<a href="'.esc_url( get_comment_link($comment->comment_ID) ).'">'.$avatar.'</a>';
							$output .= '</div>';
							$output .= '<div class="widget-text">';
							   $output .= '<h4><a href="'.esc_url( get_comment_link($comment->comment_ID) ).'">' .get_the_title($comment->comment_post_ID). '</a></h4>';
							   $output .= '<span>' .get_comment_author_link($comment->comment_ID).'</span>';
							$output .= '</div><div class="clearfix"></div>';
						$output .= '</li>';
						
					}
				}
				$output .= '</ul>';

				echo $output; 	
				
				?>
			</div><!-- /.jollyness-pane3 -->
			<?php } ?>
			
		</div>
		
	<?php	
		
		echo $after_widget;
		
	}	
	
	/**
	 * Widget form on admin
	 * Reference: http://codex.wordpress.org/Plugins/WordPress_Widgets_Api
	 * @since 0.0.1
	 */ 
	
	public function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array(  
			'pop' => 'Pop', 
			'poplimit' => 10,
			'recent' => 'Recent', 
			'recentlimit' => 10, 
			'comment' => 'Comments', 
			'commentlimit' => 10,  			
		) );
		$pop = strip_tags($instance['pop']);
		$poplimit = strip_tags($instance['poplimit']);
		$recent = strip_tags($instance['recent']);
		$recentlimit = strip_tags($instance['recentlimit']);
		$comment = strip_tags($instance['comment']);
		$commentlimit = strip_tags($instance['commentlimit']);
		$title = isset( $instance['title'] ) ? $instance['title'] : 'TABBED WIDGET';

	?>	
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'jollyness' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<!-- = Popular posts setting -->
	
		<p><span><strong><?php _e('Popular posts:', 'jollyness'); ?></strong></span><br />
		
		<label for="<?php echo $this->get_field_id('pop'); ?>" style="display:inline;"><?php _e('Label:', 'jollyness');?></label><input id="<?php echo $this->get_field_id('pop'); ?>" size="29" name="<?php echo $this->get_field_name('pop'); ?>" type="text" value="<?php echo esc_attr($pop); ?>" /> <br />
		
		<label for="<?php echo $this->get_field_id('poplimit'); ?>" style="display:inline;"><?php _e('Limit number:', 'jollyness');?></label><input id="<?php echo $this->get_field_id('poplimit'); ?>" size="2" name="<?php echo $this->get_field_name('poplimit'); ?>" type="text" value="<?php echo esc_attr($poplimit); ?>" />
		
		</p>
		
		<!-- / Popular posts setting -->
		
		
		<!-- = Recent posts setting -->
		
		<p><span><strong><?php _e('Recent posts:', 'jollyness'); ?></strong></span><br />
		
		<label for="<?php echo $this->get_field_id('recent'); ?>" style="display:inline;"><?php _e('Label: ', 'jollyness');?></label><input id="<?php echo $this->get_field_id('recent'); ?>" size="29" name="<?php echo $this->get_field_name('recent'); ?>" type="text" value="<?php echo esc_attr($recent); ?>" /> <br />
		
		<label for="<?php echo $this->get_field_id('recentlimit'); ?>" style="display:inline;"><?php _e('Limit number: ', 'jollyness');?></label><input id="<?php echo $this->get_field_id('recentlimit'); ?>" size="2" name="<?php echo $this->get_field_name('recentlimit'); ?>" type="text" value="<?php echo esc_attr($recentlimit); ?>" />
		
		</p>
		
		<!-- / Recent posts setting -->
		
		<!-- = Recent comments setting -->
		
		<p><span><strong><?php _e('Recent comments:', 'jollyness'); ?></strong></span><br />
		
		<label for="<?php echo $this->get_field_id('comment'); ?>" style="display:inline;"><?php _e('Label: ', 'jollyness');?></label><input id="<?php echo $this->get_field_id('comment'); ?>" size="29" name="<?php echo $this->get_field_name('comment'); ?>" type="text" value="<?php echo esc_attr($comment); ?>" /> <br />
		
		<label for="<?php echo $this->get_field_id('commentlimit'); ?>" style="display:inline;"><?php _e('Limit number: ', 'jollyness');?></label><input id="<?php echo $this->get_field_id('commentlimit'); ?>" size="2" name="<?php echo $this->get_field_name('commentlimit'); ?>" type="text" value="<?php echo esc_attr($commentlimit); ?>" />
		
		</p>
		
		<!-- / Recent comments setting -->
		
		<p class="description"><?php _e('Leave the "Label" field(s) blank to hide.'); ?></p>
		
	
	<?php
	}

	/**
	 * Processes widget options to be saved
	 * Reference: http://codex.wordpress.org/Plugins/WordPress_Widgets_Api
	 * @since 0.0.1
	 */ 
	 
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['pop'] = strip_tags($new_instance['pop']);
		$instance['poplimit'] = strip_tags($new_instance['poplimit']);
		$instance['recent'] = strip_tags($new_instance['recent']);
		$instance['recentlimit'] = strip_tags($new_instance['recentlimit']);	
		$instance['comment'] = strip_tags($new_instance['comment']);
		$instance['commentlimit'] = strip_tags($new_instance['commentlimit']);
		$instance['title'] = strip_tags( $new_instance['title'] );	
		return $instance;
	}	
}