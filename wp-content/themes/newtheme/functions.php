<?php

function custom_new_theme()
{
    // Enqueue styles
    wp_enqueue_style('bootstrapcdn', '//maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
    wp_enqueue_style('styletheme', get_template_directory_uri() . '/css/style.css');
    wp_enqueue_style('font_awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('custom_font', '//fonts.googleapis.com/css?family=Poppins:100,300,500,600');
    wp_enqueue_style('main_style', get_stylesheet_uri());

    // Enqueue scripts
    wp_enqueue_script('jQuerycdn', '//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', false, false, true);
    wp_enqueue_script('bootstrap_js', '//maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', false, '', true);
    wp_enqueue_script('popper_js', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', false, '', true);
    wp_enqueue_script('isotop', '//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js', array('jquery'), false, true);
    wp_enqueue_script('main_js', get_template_directory_uri() . '/js/main.js', false, '', true);
    wp_enqueue_script('jquery');
}

add_action('wp_enqueue_scripts', 'custom_new_theme');

// Custom post type and taxonomy for Job

function create_job_function()
{
    $labels = array(
        'name' => _x('Jobs', 'post type general name', 'your_text_domain'),
        'singular_name' => _x('Job', 'post type Singular name', 'your_text_domain'),
        'add_new' => _x('Add Job', '', 'your_text_domain'),
        'add_new_item' => __('Add New Job', 'your_text_domain'),
        'edit_item' => __('Edit Job', 'your_text_domain'),
        'new_item' => __('New Job', 'your_text_domain'),
        'all_items' => __('All Jobs', 'your_text_domain'),
        'view_item' => __('View Jobs', 'your_text_domain'),
        'search_items' => __('Search Jobs', 'your_text_domain'),
        'not_found' => __('No Jobs found', 'your_text_domain'),
        'not_found_in_trash' => __('No Jobs on trash', 'your_text_domain'),
        'parent_item_colon' => '',
        'menu_name' => __('Jobs', 'your_text_domain')
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'job'),
        'capability_type' => 'page',
        'has_archive' => true,
        'hierarchical' => true,
        'menu_position' => null,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => array('title', 'editor', 'excerpt')
    );
    $labels = array(
        'name' => __('Categories'),
        'singular_name' => __('Category'),
        'search_items' => __('Search'),
        'popular_items' => __('More Used'),
        'all_items' => __('All Categories'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Add new'),
        'update_item' => __('Update'),
        'add_new_item' => __('Add new Category'),
        'new_item_name' => __('New')
    );
    register_taxonomy(
        'job_category',
        array('job'),
        array(
            'hierarchical' => true,
            'labels' => $labels,
            'singular_label' => 'job_category',
            'all_items' => 'Category',
            'query_var' => true,
            'rewrite' => array('slug' => 'job-category')
        )
    );
    register_post_type('job', $args);
    flush_rewrite_rules();
}

add_action('init', 'create_job_function');
