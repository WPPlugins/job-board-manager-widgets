<?php
/*
Plugin Name: Job Board Manager - Widgets
Plugin URI: http://pickplugins.com
Description: Widgets for Job Board Manager.
Version: 1.0.0
Author: pickplugins
Author URI: http://pickplugins.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class JobBoardManagerWidgets{
	public function __construct()
	{
	
		define('job_bm_widget_plugin_url', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
		define('job_bm_widget_plugin_dir', plugin_dir_path( __FILE__ ) );

		// Class
		require_once( plugin_dir_path( __FILE__ ) . 'includes/class-widget-latest-job.php');	
		require_once( plugin_dir_path( __FILE__ ) . 'includes/class-widget-featured-job.php');	
		require_once( plugin_dir_path( __FILE__ ) . 'includes/class-widget-expired-today.php');	
		
		add_action( 'wp_enqueue_scripts', array( $this, 'job_bm_widget_front_scripts' ) );
		add_action( 'widgets_init', array( $this, 'job_bm_job_bm_widget_load_widget' ) );
	}
	
	function job_bm_job_bm_widget_load_widget() {
		register_widget( 'WidgetLatestJob' );
		register_widget( 'WidgetFeaturedJob' );
		register_widget( 'WidgetExpiredToday' );
	}
	
	public function job_bm_widget_front_scripts()
	{
		wp_enqueue_style('job_bm_widget', job_bm_widget_plugin_url.'assets/front/css/job-bm-widgets.css');
	}
		
} new JobBoardManagerWidgets();