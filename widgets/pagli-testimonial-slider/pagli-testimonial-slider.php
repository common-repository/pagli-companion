<?php
/*
Widget Name: Testimonial Slider
Description: A powerful yet simple button widget for your sidebars or Page Builder pages.
Author: paglithemes
Author URI: https://siteorigin.com
*/

class Pagli_Testimonial_Slider extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'pagli-testimonial-slider',
			__('Pagli : Testimonial Slider', 'pagli-companion'),
			array(
				'description' => __('A widget to display testimonial slider', 'pagli-companion'),
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
					'owl-carousel',
					PGLI_COMPANION_CSS_DIR . 'owl.carousel.css',
					array(),
					PGLI_COMPANION_VERSION
				),
				array(
					'pagli-testimonial-slider',
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
					'owl-carousel',
					PGLI_COMPANION_JS_DIR . 'owl.carousel.js',
					array( 'jquery' ),
					'2.2.1'
				),
				array(
					'pagli-testimonial-slider',
					plugin_dir_url(__FILE__) . 'js/testimonial-slider.js',
					array( 'owl-carousel', 'jquery' ),
					PGLI_COMPANION_VERSION,
					true
				)
			)
		);
	}

	/** Building Form Block **/
	function get_widget_form() {
		return array(
			'no_of_testimonials' => array(
        		'type' => 'slider',
		        'label' => __( 'No. of Testimonials', 'pagli-companion' ),
		        'default' => 3,
		        'min' => 3,
		        'max' => 20,
		        'integer' => true
    		),
    		'quote_icon' => array(
		        'type' => 'icon',
		        'label' => __('Quote Icon', 'pagli-companion'),
		    ),
		    'auto_slide' => array(
		        'type' => 'radio',
		        'label' => __( 'Auto Slide', 'pagli-companion' ),
		        'default' => 1,
		        'options' => array(
		            1 => __( 'Yes', 'pagli-companion' ),
		            0 => __( 'No', 'pagli-companion' ),
		        )
		    ),
		    'show_pager' => array(
		        'type' => 'radio',
		        'label' => __( 'Show Pager', 'pagli-companion' ),
		        'default' => 1,
		        'options' => array(
		            1 => __( 'Yes', 'pagli-companion' ),
		            0 => __( 'No', 'pagli-companion' ),
		        )
		    ),
		);
	}
}

siteorigin_widget_register('pagli-testimonial-slider', __FILE__, 'Pagli_Testimonial_Slider');