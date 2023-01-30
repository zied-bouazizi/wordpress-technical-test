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

// Meta Box Class: CustomFieldsMetaBox
class CustomFieldsMetaBox
{

    private $screen = array(
        'job',

    );

    private $meta_fields = array(
        array(
            'label' => 'Address',
            'id' => 'address',
            'type' => 'text',
        ),

        array(
            'label' => 'Working Hour Per Week',
            'id' => 'working_hour_per_week',
            'type' => 'number',
        ),

        array(
            'label' => 'Recruiting Company',
            'id' => 'recruiting_company',
            'type' => 'text',
        ),

        array(
            'label' => 'Company Email',
            'id' => 'company_email',
            'type' => 'email',
        ),

        array(
            'label' => 'Offer Expiration Date',
            'id' => 'offer_expiration_date',
            'type' => 'date',
        )

    );

    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('save_post', array($this, 'save_fields'));
    }

    public function add_meta_boxes()
    {
        foreach ($this->screen as $single_screen) {
            add_meta_box(
                'Custom Fields',
                __('Custom Fields', ''),
                array($this, 'meta_box_callback'),
                $single_screen,
                'normal',
                'default'
            );
        }
    }

    public function meta_box_callback($post)
    {
        wp_nonce_field('CustomFields_data', 'CustomFields_nonce');
        $this->field_generator($post);
    }
    public function field_generator($post)
    {
        $output = '';
        foreach ($this->meta_fields as $meta_field) {
            $label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
            $meta_value = get_post_meta($post->ID, $meta_field['id'], true);
            if (empty($meta_value)) {
                if (isset($meta_field['default'])) {
                    $meta_value = $meta_field['default'];
                }
            }
            switch ($meta_field['type']) {
                default:
                    $input = sprintf(
                        '<input %s id="%s" name="%s" type="%s" value="%s">',
                        $meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
                        $meta_field['id'],
                        $meta_field['id'],
                        $meta_field['type'],
                        $meta_value
                    );
            }
            $output .= $this->format_rows($label, $input);
        }
        echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
    }

    public function format_rows($label, $input)
    {
        return '<tr><th>' . $label . '</th><td>' . $input . '</td></tr>';
    }

    public function save_fields($post_id)
    {
        if (!isset($_POST['CustomFields_nonce']))
            return $post_id;
        $nonce = $_POST['CustomFields_nonce'];
        if (!wp_verify_nonce($nonce, 'CustomFields_data'))
            return $post_id;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post_id;
        foreach ($this->meta_fields as $meta_field) {
            if (isset($_POST[$meta_field['id']])) {
                switch ($meta_field['type']) {
                    case 'email':
                        $_POST[$meta_field['id']] = sanitize_email($_POST[$meta_field['id']]);
                        break;
                    case 'text':
                        $_POST[$meta_field['id']] = sanitize_text_field($_POST[$meta_field['id']]);
                        break;
                }
                update_post_meta($post_id, $meta_field['id'], $_POST[$meta_field['id']]);
            } else if ($meta_field['type'] === 'checkbox') {
                update_post_meta($post_id, $meta_field['id'], '0');
            }
        }
    }
}

if (class_exists('CustomFieldsMetabox')) {
    new CustomFieldsMetabox;
};

// Dynamic navigation menus

function dynamic_navigation()
{
    register_nav_menu('MainMenu', 'Main Menu');
    register_nav_menu('SecondaryMenu', 'Secondary Menu');
}

add_action('after_setup_theme', 'dynamic_navigation');
