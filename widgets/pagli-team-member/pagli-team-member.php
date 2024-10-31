<?php
/*
Widget Name: Team Member
Description: A Widget to display a team member.
Author: paglithemes
Author URI: https://siteorigin.com
*/

class Pagli_Team_Member extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'pagli-team-member',
			__('Pagli : Team Member', 'pagli-companion'),
			array(
				'description' => __('A widget to display informations about a team member.', 'pagli-companion'),
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
					'pagli-team-member',
					plugin_dir_url(__FILE__) . 'css/style.css',
					array(),
					PGLI_COMPANION_VERSION
				)
			)
		);
	}

	/** Building Form Block **/
	function get_widget_form() {
		return array(
			'member_name' => array(
		        'type' => 'text',
		        'label' => __('Member Name', 'pagli-companion'),
		        'default' => __('Mr. Gulliver', 'pagli-companion')
		    ),
		    'member_image' => array(
		        'type' => 'media',
		        'label' => __( 'Team Member Image', 'pagli-companion' ),
		        'choose' => __( 'Choose image', 'pagli-companion' ),
		        'update' => __( 'Set image', 'pagli-companion' ),
		        'library' => 'image',
		        'fallback' => true
		    ),
    		'member_designation' => array(
		        'type' => 'text',
		        'label' => __('Member Designation', 'pagli-companion'),
		        'default' => __('CEO', 'pagli-companion')
		    ),
		    'member_socials' => array(
		        'type' => 'section',
		        'label' => __( 'Social Links.' , 'pagli-companion' ),
		        'hide' => true,
		        'fields' => array(
		            'facebook' => array(
		                'type' => 'link',
		                'label' => __( 'Facebook Link', 'pagli-companion' ),
		                'default' => ''
		            ),
		            'twitter' => array(
		                'type' => 'link',
		                'label' => __( 'Twitter Link', 'pagli-companion' ),
		                'default' => ''
		            ),
		            'gplus' => array(
		                'type' => 'link',
		                'label' => __( 'Google Plus URL', 'pagli-companion' ),
		                'default' => ''
		            ),
		            'linkedin' => array(
		                'type' => 'link',
		                'label' => __( 'LinkedIn URL', 'pagli-companion' ),
		                'default' => ''
		            ),
		        )
		    ),
		    'member_description' => array(
		        'type' => 'textarea',
		        'label' => __( 'Team Member Bio', 'pagli-companion' ),
		        'default' => '',
		        'rows' => 10
		    )
		);
	}
}

siteorigin_widget_register('pagli-team-member', __FILE__, 'Pagli_Team_Member');