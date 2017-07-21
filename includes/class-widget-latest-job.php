<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	

class WidgetLatestJob extends WP_Widget {

	function __construct() {
		
		parent::__construct(
			'job_bm_widget_latest_job', 
			__('Job Board Manager - Latest Job', 'job_bm_widget'),
			array( 'description' => __( 'Show latest jobs.', 'job_bm_widget' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$count = apply_filters( 'widget_title', $instance['count'] );
		
		echo $args['before_widget'];
		if ( ! empty( $title ) ) echo $args['before_title'] . $title . $args['after_title'];
		
		$wp_query = new WP_Query(
			array (
				'post_type' => 'job',
				'orderby' => 'Date',
				'order' => 'DESC',
				'posts_per_page' => $count,
			) );
		
		echo '<ul class="job_bm_widget_latest_job">';
		
		if ( $wp_query->have_posts() ) :
			while ( $wp_query->have_posts() ) : $wp_query->the_post();	
		
			echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
			
			endwhile;
		endif;
		wp_reset_query();
		
		echo '</ul>';
		
		
		echo $args['after_widget'];
	}
	
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ];
		else $title = __( 'Latest Job', 'job_bm_widget' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
		
		if ( isset( $instance[ 'count' ] ) ) $count = $instance[ 'count' ];
		else $count = __( '5', 'job_bm_widget' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Job count:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>" />
		</p>
		<?php 
		
		
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';
		return $instance;
	}
}