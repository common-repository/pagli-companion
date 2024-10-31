<?php
/*
Widget Name: Counter
Description: A powerful yet simple button widget for your sidebars or Page Builder pages.
Author: paglithemes
Author URI: https://siteorigin.com
*/

class Pagli_Counter extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'pagli-counter',
			__('Pagli : Counter', 'pagli-companion'),
			array(
				'description' => __('A Widget to display Counter.', 'pagli-companion'),
				'panels_groups' => array('pagli_widget_group'),
			),
			array(

			),
			false,
			plugin_dir_path(__FILE__)
		);

	}

	/**
	 * Initialize the Counter widget
	 */
	function initialize(){
		
		/** Registering necessary style files **/
		$this->register_frontend_styles(
			array(
				array(
					'pagli-counter',
					plugin_dir_url(__FILE__) . 'css/style.css',
					array(),
					PGLI_COMPANION_VERSION
				)
			)
		);

		/** Registering necessary script files **/
		$this->register_frontend_scripts(
			array(
				array(
					'waypoint',
					PGLI_COMPANION_JS_DIR . 'jquery.waypoints.js',
					array( 'jquery' ),
					'4.0.1'
				),
				array(
					'counterup',
					PGLI_COMPANION_JS_DIR . 'jquery.counterup.js',
					array( 'jquery', 'waypoint' ),
					'2.1.0'
				),
				array(
					'pagli-counter',
					plugin_dir_url(__FILE__) . 'js/counter.js',
					array( 'waypoint', 'counterup', 'jquery' ),
					PGLI_COMPANION_VERSION,
					true
				)
			)
		);
	}

	/** Assigning css variables for dynamic styling **/
	function get_less_variables($instance) {
		if( empty( $instance ) ) return array();
		return array(
			'counter_color' => $instance['counter_color']
		);
	}

	/** Building Form Block **/
	function get_widget_form() {
		return array(
			'title' => array(
				'type' => 'text',
				'label' => __('Title', 'pagli-companion'),
				'default' => __('Counter Title', 'pagli-companion')
			),
			'counter' => array(
				'type' => 'number',
				'label' => __('Counter', 'pagli-companion'),
				'default' => 500
			),
			'counter_color' => array(
		        'type' => 'color',
		        'label' => __( 'Choose color for counter', 'pagli-companion' ),
		        'default' => '#CE9165'
		    )
		);
	}
}

siteorigin_widget_register('pagli-counter', __FILE__, 'Pagli_Counter');