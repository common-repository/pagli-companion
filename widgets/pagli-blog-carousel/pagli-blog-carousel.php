<?php
/*
Widget Name: Blog Carousel
Description: A powerful yet simple button widget for your sidebars or Page Builder pages.
Author: paglithemes
Author URI: https://siteorigin.com
*/

class Pagli_Blog_Carousel extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'pagli-blog-carousel',
			__('Pagli : Blog Grid', 'pagli-companion'),
			array(
				'description' => __('A widget to display blog posts', 'pagli-companion'),
				'panels_groups' => array('pagli_widget_group'),
			),
			array(

			),
			false,
			plugin_dir_path(__FILE__)
		);

	}

	/**
	 * Initialize the Blog Carousel widget
	 */
	function initialize(){
		
		/** Registering necessary style files **/
		$this->register_frontend_styles(
			array(
				array(
					'pagli-blog-carousel',
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
					'pagli-blog-carousel',
					plugin_dir_url(__FILE__) . 'js/blog-carousel.js',
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
			'column' => array(
		        'type' => 'select',
		        'label' => __( 'Select the Column', 'pagli-companion' ),
		        'default' => 2,
		        'options' => array(
		            2 => __( '2 Column', 'pagli-companion' ),
		            3 => __( '3 Column', 'pagli-companion' ),
		        )
		    ),
		    'orderby' => array(
		        'type' => 'select',
		        'label' => __( 'Order By', 'pagli-companion' ),
		        'default' => 'none',
		        'options' => array(
		            'none' => __( 'None', 'pagli-companion' ),
		            'ID' => __( 'ID', 'pagli-companion' ),
		            'author' => __( 'Author', 'pagli-companion' ),
		            'title' => __( 'Title', 'pagli-companion' ),
		            'date' => __( 'Date', 'pagli-companion' ),
		            'rand' => __( 'Random', 'pagli-companion' ),
		            'comment_count' => __( 'Comment Count', 'pagli-companion' ),
		        )
		    ),
		    'order' => array(
		        'type' => 'select',
		        'label' => __( 'Order', 'pagli-companion' ),
		        'default' => 'ASC',
		        'options' => array(
		            'ASC' => __( 'Ascending', 'pagli-companion' ),
		            'DESC' => __( 'Descending', 'pagli-companion' ),
		        )
		    ),
			'no_of_posts' => array(
		        'type' => 'slider',
		        'label' => __( 'Choose No. of Posts to display', 'pagli-companion' ),
		        'default' => 6,
		        'min' => 2,
		        'max' => 20,
		        'integer' => true
		    ),
			'excerpt_length' => array(
		        'type' => 'number',
		        'label' => __( 'Set Excerpt Length', 'pagli-companion' ),
		        'default' => '120'
		    ),
		    'readmore_text' => array(
                'type' => 'text',
                'label' => __('Read More Text', 'pagli-companion'),
                'default' => __('Read More', 'pagli-companion')
            ),
		);
	}
}

siteorigin_widget_register('pagli-blog-carousel', __FILE__, 'Pagli_Blog_Carousel');
