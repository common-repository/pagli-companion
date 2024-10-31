<?php
/*
Widget Name: Icon Text Block
Description: A powerful yet simple button widget for your sidebars or Page Builder pages.
Author: paglithemes
Author URI: https://siteorigin.com
*/

class Pagli_Icon_Text_Block extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'pagli-icon-text-block',
			__('Pagli : Icon Text Block', 'pagli-companion'),
			array(
				'description' => __('A customizable button widget.', 'pagli-companion'),
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
					'pagli-icon-text-block',
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
			'icon_color' => $instance['icon_color']
		);
	}

	/** Dynamically Assign Templates **/
	function get_template_name( $instance ) {
	    $template_name = '';

	    $tpl_name = isset($instance['layout']) ? esc_attr($instance['layout']) : 'layout1';
	    
	    return $tpl_name;
	}

	/** Building Form Block **/
	function get_widget_form() {
		return array(
			'title' => array(
				'type' => 'text',
				'label' => __('Title', 'pagli-companion'),
				'default' => __('Feature 1', 'pagli-companion')
			),
			'description' => array(
		        'type' => 'textarea',
		        'label' => __( 'Description', 'pagli-companion' ),
		        'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque id sem in nisl lobortis efficitur ac sed mi. Curabitur vel maximus turpis.', 'pagli-companion'),
		        'rows' => 10
		    ),
		    'icon' => array(
		        'type' => 'icon',
		        'label' => __('Select an icon', 'pagli-companion'),
		    ),
		    'icon_color' => array(
		        'type' => 'color',
		        'label' => __( 'Choose color for icon', 'pagli-companion' ),
		        'default' => '#525252'
		    ),
		    'layout' => array(
		        'type' => 'select',
		        'label' => __( 'Choose a thing from a long list of things', 'widget-form-fields-text-domain' ),
		        'default' => 'layout1',
		        'options' => array(
		            'layout1' => __( 'Layout 1', 'pagli-companion' ),
		            'layout2' => __( 'Layout 2', 'pagli-companion' ),
		            'layout3' => __( 'Layout 3', 'pagli-companion' ),
		        )
		    )
		);
	}
}

siteorigin_widget_register('pagli-icon-text-block', __FILE__, 'Pagli_Icon_Text_Block');
