<?php
function mytheme_setup() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('menus');
  add_theme_support('editor-styles');
  add_theme_support('wp-block-styles');
  add_theme_support('responsive-embeds');
  
  // Register navigation menu
  register_nav_menus(array(
    'primary' => 'Primary Menu',
  ));
}
add_action('after_setup_theme', 'mytheme_setup');

function mytheme_enqueue_styles() {
  wp_enqueue_style('mytheme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_styles');

// Remove admin bar margin
function remove_admin_bar_margin() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_bar_margin');

// Enqueue custom JavaScript
function mytheme_enqueue_scripts() {
    wp_enqueue_script('mytheme-scripts', get_template_directory_uri() . '/js/theme.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');

// Footer Columns Customizer
function mytheme_footer_customizer($wp_customize) {
    // Add Footer Columns section
    $wp_customize->add_section('footer_columns', array(
        'title'    => 'Footer Columns',
        'priority' => 120,
    ));

    // 3 Customizable Columns
    for ($i = 1; $i <= 3; $i++) {
        // Headings
        $wp_customize->add_setting("footer_col_{$i}_heading", array(
            'default' => $i == 1 ? 'ABOUT US' : ($i == 2 ? 'SERVICES' : 'WAYS YOU CAN HELP'),
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("footer_col_{$i}_heading", array(
            'label'    => "Column {$i} Heading",
            'section'  => 'footer_columns',
            'type'     => 'text',
        ));

        // 5 Links (max) per Column (remove limit?)
        for ($j = 1; $j <= 5; $j++) {
            $wp_customize->add_setting("footer_col_{$i}_link_{$j}_text", array(
                'default' => '',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control("footer_col_{$i}_link_{$j}_text", array(
                'label'    => "Column {$i} - Link {$j} Text",
                'section'  => 'footer_columns',
                'type'     => 'text',
            ));

            $wp_customize->add_setting("footer_col_{$i}_link_{$j}_url", array(
                'default' => '#',
                'transport' => 'refresh',
                'sanitize_callback' => 'esc_url_raw',
            ));
            $wp_customize->add_control("footer_col_{$i}_link_{$j}_url", array(
                'label'    => "Column {$i} - Link {$j} URL",
                'section'  => 'footer_columns',
                'type'     => 'url',
            ));
        }
    }

    // Contact column 
    $wp_customize->add_setting('footer_contact_business_name', array(
        'default' => 'Okanagan Central Community Church & Ministries',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_contact_business_name', array(
        'label'    => 'Business Name',
        'section'  => 'footer_columns',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('footer_contact_city', array(
        'default' => 'Kelowna',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_contact_city', array(
        'label'    => 'City',
        'section'  => 'footer_columns',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('footer_contact_address', array(
        'default' => "1470 Sutherland Ave\nKelowna, BC\nV1Y 5Y5",
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('footer_contact_address', array(
        'label'    => 'Address (use line breaks for multiple lines)',
        'section'  => 'footer_columns',
        'type'     => 'textarea',
    ));

    $wp_customize->add_setting('footer_contact_phone', array(
        'default' => '(250) 860-2329',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_contact_phone', array(
        'label'    => 'Phone Number',
        'section'  => 'footer_columns',
        'type'     => 'text',
    ));
}
add_action('customize_register', 'mytheme_footer_customizer');

// Social Links Customizer
function mytheme_social_customizer($wp_customize) {
    // Add Social Links section
    $wp_customize->add_section('social_links', array(
        'title'    => 'Social Links',
        'priority' => 121,
    ));

    // Social media platforms
    $social_platforms = array(
        'facebook' => 'Facebook',
        'instagram' => 'Instagram', 
        'twitter' => 'X (Twitter)',
        'youtube' => 'YouTube'
    );
    
    foreach ($social_platforms as $platform => $label) {
        $wp_customize->add_setting("social_{$platform}_url", array(
            'default' => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control("social_{$platform}_url", array(
            'label'    => $label . ' URL',
            'section'  => 'social_links',
            'type'     => 'url',
            'description' => 'Leave blank to hide this social icon',
        ));
    }
}
add_action('customize_register', 'mytheme_social_customizer');

// Helper function to get social platforms data
function get_social_platforms() {
    return array(
        'facebook' => array(
            'label' => 'Facebook',
            'path' => 'M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z'
        ),
        'instagram' => array(
            'label' => 'Instagram',
            'path' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z'
        ),
        'twitter' => array(
            'label' => 'X (Twitter)',
            'path' => 'M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z'
        ),
        'youtube' => array(
            'label' => 'YouTube',
            'path' => 'M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z'
        )
    );
}