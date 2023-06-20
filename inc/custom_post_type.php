<?php  		
// Register Custom Post Type Contact Form
function create_contactform_cpt() {

	$labels = array(
		'name' => _x( 'Contact Forms', 'Post Type General Name', 'contact-form' ),
		'singular_name' => _x( 'Contact Form', 'Post Type Singular Name', 'contact-form' ),
		'menu_name' => _x( 'Contact Forms', 'Admin Menu text', 'contact-form' ),
		'name_admin_bar' => _x( 'Contact Form', 'Add New on Toolbar', 'contact-form' ),
		'archives' => __( 'Contact Form Archives', 'contact-form' ),
		'attributes' => __( 'Contact Form Attributes', 'contact-form' ),
		'parent_item_colon' => __( 'Parent Contact Form:', 'contact-form' ),
		'all_items' => __( 'All Contact Forms', 'contact-form' ),
		'add_new_item' => __( 'Add New Contact Form', 'contact-form' ),
		'add_new' => __( 'Add New', 'contact-form' ),
		'new_item' => __( 'New Contact Form', 'contact-form' ),
		'edit_item' => __( 'Edit Contact Form', 'contact-form' ),
		'update_item' => __( 'Update Contact Form', 'contact-form' ),
		'view_item' => __( 'View Contact Form', 'contact-form' ),
		'view_items' => __( 'View Contact Forms', 'contact-form' ),
		'search_items' => __( 'Search Contact Form', 'contact-form' ),
		'not_found' => __( 'Not found', 'contact-form' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'contact-form' ),
		'featured_image' => __( 'Featured Image', 'contact-form' ),
		'set_featured_image' => __( 'Set featured image', 'contact-form' ),
		'remove_featured_image' => __( 'Remove featured image', 'contact-form' ),
		'use_featured_image' => __( 'Use as featured image', 'contact-form' ),
		'insert_into_item' => __( 'Insert into Contact Form', 'contact-form' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Contact Form', 'contact-form' ),
		'items_list' => __( 'Contact Forms list', 'contact-form' ),
		'items_list_navigation' => __( 'Contact Forms list navigation', 'contact-form' ),
		'filter_items_list' => __( 'Filter Contact Forms list', 'contact-form' ),
	);
	$args = array(
		'label' => __( 'Contact Form', 'contact-form' ),
		'description' => __( '', 'contact-form' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-admin-users',
		'supports' => array('title', 'author', 'custom-fields'),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'contactform', $args );

}
add_action( 'init', 'create_contactform_cpt', 0 );