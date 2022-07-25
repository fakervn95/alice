<?php
/*
@package sunsettheme
========================
THEME CUSTOM POST TYPES
========================
*/
/* SLIDER */
add_action('init', 'slider_custom_post_type');
add_filter('manage_slider_posts_columns', 'slider_columns');
add_action('manage_slider_posts_custom_column', 'slider_custom_column', 10, 2);
function slider_custom_post_type()
{
    $labels = array(
        'name' => 'Slider',
        'singular_name' => 'Slider',
        'menu_name' => 'Slider',
        'name_admin_bar' => 'Slider'
    );
    
    $args = array(
        'labels' => $labels, // show labels
        'show_in_nav_menus ' => false, 
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 25,
        'menu_icon' => 'dashicons-images-alt2',
        'public' => true, // required to display permalink under title post
        'query_var' => true,
        'publicly_queryable' => true, // permalink
        'supports' => array(
            'title',
            'thumbnail',
            'editor',
            'excerpt'
        )
    );
    
    register_post_type('slider', $args);
    
}
function slider_columns($columns)
{
    $newColumns          = array();
    $newColums['title']  = 'Title';
    $newColums['avatar'] = 'Avatar';
    return $newColums;
}
function slider_custom_column($column, $post_id)
{
    switch ($column) {
        case 'avatar':
            echo get_the_post_thumbnail();
            break;
    }
}
/* duan */
add_action('init', 'tg_contact_custom_post_type_review');
add_filter('manage_review_posts_columns', 'sunset_set_contact_columns_review');
add_action('manage_review_posts_custom_column', 'sunset_contact_custom_column_review', 10, 2);
function tg_contact_custom_post_type_review()
{
    if(get_locale() == 'vi'){
         $labels = array(
        'name' => 'Đánh giá khách hàng',
        'singular_name' => 'Đánh giá khách hàng',
        'menu_name' => 'Đánh giá khách hàng',
        'name_admin_bar' => 'Đánh giá khách hàng'
    );
     }else{
         $labels = array(
        'name' => 'Reviews',
        'singular_name' => 'Reviews',
        'menu_name' => 'Reviews',
        'name_admin_bar' => 'Reviews'
    );
     }
   
    
    $args = array(
        'labels' => $labels,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'menu_position' => 10,
        'menu_icon' => 'dashicons-building',
        'supports' => array(
            'title',
            'thumbnail',
            'excerpt',
            'editor'
        )
    );

    
    register_post_type('review', $args);
}
function sunset_set_contact_columns_review($columns)
{
      $newColumns          = array();
    $newColums['cb'] = '<input type="checkbox" />';
    $newColums['title']  = 'Title';
    $newColums['author'] = __('Author');
    $newColums['avatar'] = 'Avatar';
    $newColums['id'] = __('ID');
    // $newColums['categories'] = __('Categories');
    // $newColums['tags'] = __('Tags');
    $newColums['date'] = _x('Date', 'column name');
    return $newColums;
}
function sunset_contact_custom_column_review($column, $post_id)
{
    switch ($column) {
        case 'avatar':
            echo get_the_post_thumbnail();
            break;
    }
}



/* dichvu */
add_action('init', 'dichvu_custom_post_type');
add_filter('manage_dichvu_posts_columns', 'dichvu_columns');
add_action('manage_dichvu_posts_custom_column', 'dichvu_custom_column', 10, 2);
function dichvu_custom_post_type()
{
    $labels = array(
        'name' => 'Dịch vụ',
        'singular_name' => 'Dịch vụ',
        'menu_name' => 'Dịch vụ',
        'name_admin_bar' => 'Dịch vụ'
    );
    
    $args = array(
        'labels' => $labels, // show labels
        'show_in_nav_menus ' => false, 
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 25,
        'menu_icon' => 'dashicons-images-alt2',
        'public' => true, // required to display permalink under title post
        'query_var' => true,
        'publicly_queryable' => true, // permalink
        'supports' => array(
            'title',
            'thumbnail',
            'editor',
            'excerpt'
        )
    );
    register_taxonomy('chuyen-muc-dichvu', 'dichvu', array(
        'label' => __('Chuyên mục dịch vụ'),
        'hierarchical' => true
    ));
    register_post_type('dichvu', $args);
    
}
function dichvu_columns($columns)
{
    $newColumns          = array();
    $newColums['cb'] = '<input type="checkbox" />';
    $newColums['title']  = 'Title';
    $newColums['author'] = __('Author');
    $newColums['avatar'] = 'Avatar';
    // $newColums['id'] = __('ID');
    $newColums['categories'] = __('Categories');
    // $newColums['tags'] = __('Tags');
    $newColums['date'] = _x('Date', 'column name');
    return $newColums;
}
function dichvu_custom_column($column, $post_id)
{
    switch ($column) {
        case 'avatar':
            echo get_the_post_thumbnail();
            break;
    }
}
