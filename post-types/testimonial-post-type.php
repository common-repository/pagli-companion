<?php
	$pstype_labels = array(
		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'pagli-companion' ),
		'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'pagli-companion' ),
		'menu_name'             => __( 'Testimonials', 'pagli-companion' ),
		'name_admin_bar'        => __( 'Post Type', 'pagli-companion' ),
		'archives'              => __( 'Item Archives', 'pagli-companion' ),
		'attributes'            => __( 'Item Attributes', 'pagli-companion' ),
		'parent_item_colon'     => __( 'Parent Testimonial:', 'pagli-companion' ),
		'all_items'             => __( 'All Testimonials', 'pagli-companion' ),
		'add_new_item'          => __( 'Add New Testimonial', 'pagli-companion' ),
		'add_new'               => __( 'Add New', 'pagli-companion' ),
		'new_item'              => __( 'New Testimonial', 'pagli-companion' ),
		'edit_item'             => __( 'Edit Testimonial', 'pagli-companion' ),
		'update_item'           => __( 'Update Testimonial', 'pagli-companion' ),
		'view_item'             => __( 'View Testimonial', 'pagli-companion' ),
		'view_items'            => __( 'View Testimonials', 'pagli-companion' ),
		'search_items'          => __( 'Search Testimonial', 'pagli-companion' ),
		'not_found'             => __( 'Not found', 'pagli-companion' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'pagli-companion' ),
		'featured_image'        => __( 'Featured Image', 'pagli-companion' ),
		'set_featured_image'    => __( 'Set client image', 'pagli-companion' ),
		'remove_featured_image' => __( 'Remove client image', 'pagli-companion' ),
		'use_featured_image'    => __( 'Use as client image', 'pagli-companion' ),
		'insert_into_item'      => __( 'Insert into item', 'pagli-companion' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'pagli-companion' ),
		'items_list'            => __( 'Items list', 'pagli-companion' ),
		'items_list_navigation' => __( 'Items list navigation', 'pagli-companion' ),
		'filter_items_list'     => __( 'Filter items list', 'pagli-companion' ),
	);
	$ptype_args = array(
		'label'                 => __( 'Testimonial', 'pagli-companion' ),
		'description'           => __( 'A Post Type that contains client testimonials', 'pagli-companion' ),
		'labels'                => $pstype_labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-quote',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'testimonial', $ptype_args );