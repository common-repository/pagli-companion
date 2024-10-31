<?php
/*
Widget Name: Pricing Table
Description: A Widget to Display Pricing Plans.
Author: paglithemes
Author URI: https://siteorigin.com
*/

class Pagli_Pricing_Table extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'pagli-pricing-table',
			__('Pagli : Pricing Table', 'pagli-companion'),
			array(
				'description' => __('A Widget to Display Pricing Plans.', 'pagli-companion'),
				'panels_groups' => array('pagli_widget_group'),
			),
			array(

			),
			false,
			plugin_dir_path(__FILE__)
		);

	}

	/**
	 * Initialize the Icon Text Block widget
	 */
	function initialize(){
		
		/** Registering necessary style files **/
		$this->register_frontend_styles(
			array(
				array(
					'pagli-pricing-table',
					plugin_dir_url(__FILE__) . 'css/style.css',
					array(),
					PGLI_COMPANION_VERSION
				)
			)
		);
		
	}

	/** Assigning css variables for dynamic styling **/
	function get_less_variables($instance) {
		if( empty( $instance ) ) return array();
		return array(
			'icon_color' => $instance['icon_color'],
			'color_scheme' => $instance['color_scheme']
		);
	}

	/** Building Form Block **/
	function get_widget_form() {
		return array(
			'title' => array(
				'type' => 'text',
				'label' => __('Title', 'pagli-companion'),
				'default' => __('Basic', 'pagli-companion')
			),
		    'icon' => array(
		        'type' => 'icon',
		        'label' => __('Select an icon', 'pagli-companion'),
		    ),
		    'icon_size' => array(
		        'type' => 'number',
		        'label' => __( 'Choose color for icon', 'pagli-companion' ),
		        'default' => '60'
		    ),
		    'icon_color' => array(
		        'type' => 'color',
		        'label' => __( 'Choose color for icon', 'pagli-companion' ),
		        'default' => '#525252'
		    ),
		    'price' => array(
				'type' => 'text',
				'label' => __('Price', 'pagli-companion'),
				'default' => __('$5.99', 'pagli-companion')
			),
			'per' => array(
				'type' => 'text',
				'label' => __('Per', 'pagli-companion'),
				'default' => __('/mo', 'pagli-companion')
			),
		    'features' => array(
		        'type' => 'repeater',
		        'label' => __( 'Feature Lists.' , 'pagli-companion' ),
		        'item_name'  => __( 'Feature', 'pagli-companion' ),
		        'fields' => array(
		            'feature_text' => array(
		                'type' => 'text',
		                'label' => __( 'Set the feature title.', 'pagli-companion' )
		            ),
		        )
		    ),
		    'btn_text' => array(
				'type' => 'text',
				'label' => __('Button Text', 'pagli-companion'),
				'default' => __('Buy Now', 'pagli-companion')
			),
			'btn_url' => array(
		        'type' => 'link',
		        'label' => __('Button Link', 'pagli-companion'),
		        'default' => ''
		    ),
			'color_scheme' => array(
		        'type' => 'color',
		        'label' => __( 'Choose Color Scheme for Pricing Table', 'pagli-companion' ),
		        'default' => '#525252'
		    ),
		);
	}
}

siteorigin_widget_register('pagli-pricing-table', __FILE__, 'Pagli_Pricing_Table');