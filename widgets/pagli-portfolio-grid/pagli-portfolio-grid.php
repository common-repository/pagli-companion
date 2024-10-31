<?php
/*
Widget Name: Portfolio Grid
Description: A powerful yet simple button widget for your sidebars or Page Builder pages.
Author: paglithemes
Author URI: https://siteorigin.com
*/

class Pagli_Portfolio_Grid extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'pagli-portfolio-grid',
			__('Pagli : Portfolio Grid', 'pagli-companion'),
			array(
				'description' => __('A widget to display testimonial slider', 'pagli-companion'),
				'panels_groups' => array('pagli_widget_group'),
			),
			array(

			),
			false,
			plugin_dir_path(__FILE__)
		);

		$this->get_portfolio_categories();

	}

	/**
	 * Initialize the Counter widget
	 */
	function initialize(){
		
		/** Registering necessary style files **/
		$this->register_frontend_styles(
			array(
				array(
					'jquery-fancybox',
					PGLI_COMPANION_CSS_DIR . 'jquery.fancybox.css',
					array(),
					PGLI_COMPANION_VERSION
				),
				array(
					'pagli-pfolio-grid',
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
					'jquery-fancybox',
					PGLI_COMPANION_JS_DIR . 'jquery.fancybox.js',
					array( 'jquery' ),
					'3.1.20'
				),
				array(
					'isotope',
					PGLI_COMPANION_JS_DIR . 'isotope.pkgd.js',
					array( 'jquery' ),
					'3.0.4'
				),
				array(
					'pagli-portfolio-grid',
					plugin_dir_url(__FILE__) . 'js/pfolio-grid.js',
					array( 'isotope', 'imagesloaded', 'jquery-fancybox', 'jquery' ),
					PGLI_COMPANION_VERSION,
					true
				)
			)
		);
	}

	/** Building Form Block **/
	function get_widget_form() {
		$port_categories = self::get_portfolio_categories();
		return array(
		    'portfolio_categories' => array(
		        'type' => 'select',
		        'label' => __( 'Choose Categories to display', 'pagli-companion' ),
		        'multiple' => true,
		        'default' => -1,
		        'options' => $port_categories
		    ),
		    'orderby' => array(
		        'type' => 'select',
		        'label' => __( 'Order By', 'pagli-companion' ),
		        'default' => 'none',
		        'options' => array(
		            'none' => __( 'None', 'pagli-companion' ),
		            'ID' => __( 'ID', 'pagli-companion' ),
		            'title' => __( 'Title', 'pagli-companion' ),
		            'date' => __( 'Date', 'pagli-companion' ),
		            'rand' => __( 'Random', 'pagli-companion' ),
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
		    'all_text' => array(
		        'type' => 'text',
		        'label' => __('All Text', 'pagli-companion'),
		        'default' => 'All'
		    ),
		    'readmore_icon' => array(
		        'type' => 'icon',
		        'label' => __('Select Icon for Readmore', 'pagli-companion'),
		    ),
		    'popup_icon' => array(
		        'type' => 'icon',
		        'label' => __('Select Icon for Popup', 'pagli-companion'),
		    )
		);
	}

	/** Portfolio Categories **/
	function get_portfolio_categories() {
		$terms = get_terms( array(
			'post_type' => 'portfolio',
		    'taxonomy' => 'portfolio-category',
		    'hide_empty' => false,
		) );

		$port_categories = array();

		foreach($terms as $term) {
			$port_categories[$term->term_id] = $term->name;
		}

		return $port_categories;
	}
}

siteorigin_widget_register('pagli-portfolio-grid', __FILE__, 'Pagli_Portfolio_Grid');
