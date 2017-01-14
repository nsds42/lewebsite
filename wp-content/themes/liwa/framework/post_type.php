<?php
add_action( 'init', 'register_liwa_Portfolio' );
function register_liwa_Portfolio() {
    
    $labels = array( 
        'name' => __( 'Portfolio', 'liwa' ),
        'singular_name' => __( 'Portfolio', 'liwa' ),
        'add_new' => __( 'Add New Portfolio', 'liwa' ),
        'add_new_item' => __( 'Add New Portfolio', 'liwa' ),
        'edit_item' => __( 'Edit Portfolio', 'liwa' ),
        'new_item' => __( 'New Portfolio', 'liwa' ),
        'view_item' => __( 'View Portfolio', 'liwa' ),
        'search_items' => __( 'Search Portfolios', 'liwa' ),
        'not_found' => __( 'No Portfolios found', 'liwa' ),
        'not_found_in_trash' => __( 'No Portfolios found in Trash', 'liwa' ),
        'parent_item_colon' => __( 'Parent Portfolio:', 'liwa' ),
        'menu_name' => __( 'Portfolio', 'liwa' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'List Portfolio',
        'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'post-formats' ),
        'taxonomies' => array( 'Portfolio_category','categories','tags' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => get_stylesheet_directory_uri(). '/images/admin_ico.png', 
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'Portfolio', $args );
}
add_action( 'init', 'create_Categories_hierarchical_taxonomy', 0 );

//create a custom taxonomy name it Skillss for your posts

function create_Categories_hierarchical_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

  $labels = array(
    'name' => __( 'Categories', 'liwa' ),
    'singular_name' => __( 'Categories', 'liwa' ),
    'search_items' =>  __( 'Search Categories','liwa' ),
    'all_items' => __( 'All Categories','liwa' ),
    'parent_item' => __( 'Parent Categories','liwa' ),
    'parent_item_colon' => __( 'Parent Categories:','liwa' ),
    'edit_item' => __( 'Edit Categories','liwa' ), 
    'update_item' => __( 'Update Categories','liwa' ),
    'add_new_item' => __( 'Add New Categories','liwa' ),
    'new_item_name' => __( 'New Categories Name','liwa' ),
    'menu_name' => __( 'Categories','liwa' ),
  );     

// Now register the taxonomy

  register_taxonomy('categories',array('Portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'categories' ),
  ));

}

add_action( 'init', 'create_Tags_hierarchical_taxonomy', 0 );

//create a custom taxonomy name it Skillss for your posts

function create_Tags_hierarchical_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

  $labels = array(
    'name' => __( 'Tags', 'liwa' ),
    'singular_name' => __( 'Tags', 'liwa' ),
    'search_items' =>  __( 'Search Tags','liwa' ),
    'all_items' => __( 'All Tags','liwa' ),
    'parent_item' => __( 'Parent Tags','liwa' ),
    'parent_item_colon' => __( 'Parent Tags:','liwa' ),
    'edit_item' => __( 'Edit Tags','liwa' ), 
    'update_item' => __( 'Update Tags','liwa' ),
    'add_new_item' => __( 'Add New Tags','liwa' ),
    'new_item_name' => __( 'New Tags Name','liwa' ),
    'menu_name' => __( 'Tags','liwa' ),
  );     

// Now register the taxonomy

  register_taxonomy('tags',array('Portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'tags' ),
  ));

}

// Our Team
add_action( 'init', 'register_liwa_Team' );
function register_liwa_Team() {
    
    $labels = array( 
        'name' => __( 'Team', 'liwa' ),
        'singular_name' => __( 'Team', 'liwa' ),
        'add_new' => __( 'Add New Team', 'liwa' ),
        'add_new_item' => __( 'Add New Team', 'liwa' ),
        'edit_item' => __( 'Edit Team', 'liwa' ),
        'new_item' => __( 'New Team', 'liwa' ),
        'view_item' => __( 'View Team', 'liwa' ),
        'search_items' => __( 'Search Portfolios', 'liwa' ),
        'not_found' => __( 'No Portfolios found', 'liwa' ),
        'not_found_in_trash' => __( 'No Teams found in Trash', 'liwa' ),
        'parent_item_colon' => __( 'Parent Team:', 'liwa' ),
        'menu_name' => __( 'Our Team', 'liwa' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'List Team',
        'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'post-formats', 'excerpt' ),
        'taxonomies' => array( 'Team_category','categories1' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => get_stylesheet_directory_uri(). '/images/admin_ico.png', 
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'Team', $args );
}
add_action( 'init', 'Team_Categories_hierarchical_taxonomy', 0 );

//create a custom taxonomy name it Skillss for your posts

function Team_Categories_hierarchical_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

  $labels = array(
    'name' => __( 'Categories', 'liwa' ),
    'singular_name' => __( 'Categories', 'liwa' ),
    'search_items' =>  __( 'Search Categories','liwa' ),
    'all_items' => __( 'All Categories','liwa' ),
    'parent_item' => __( 'Parent Categories','liwa' ),
    'parent_item_colon' => __( 'Parent Categories:','liwa' ),
    'edit_item' => __( 'Edit Categories','liwa' ), 
    'update_item' => __( 'Update Categories','liwa' ),
    'add_new_item' => __( 'Add New Categories','liwa' ),
    'new_item_name' => __( 'New Categories Name','liwa' ),
    'menu_name' => __( 'Categories','liwa' ),
  );     

// Now register the taxonomy

  register_taxonomy('categories1',array('Team'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'categories1' ),
  ));

}

?>