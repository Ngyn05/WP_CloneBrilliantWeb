<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

function brilliant_xyz_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
}
add_action( 'after_setup_theme', 'brilliant_xyz_setup' );

/**
 * Static source routes mapped to their converted templates.
 * This keeps URLs such as /pages/contact/ and /blogs/announcements/... usable.
 */
function brilliant_xyz_static_routes() {
    return array(
        'blogs/announcements/citizenones-frame-projects' => 'blogs-announcements-citizenones-frame-projects--l01f6e0-ufe0f-html.php',
        'blogs/announcements/hackathon-august-3rd-2024' => 'blogs-announcements-hackathon-august-3rd-2024-html.php',
        'blogs/announcements/road-to-halo-part-1-of-4' => 'blogs-announcements-road-to-halo-part-1-of-4-html.php',
        'blogs/announcements/road-to-halo-part-2-of-4' => 'blogs-announcements-road-to-halo-part-2-of-4-html.php',
        'blogs/announcements/road-to-halo-part-3-of-4' => 'blogs-announcements-road-to-halo-part-3-of-4-html.php',
        'blogs/announcements/road-to-halo-part-4' => 'blogs-announcements-road-to-halo-part-4-html.php',
        'blogs/announcements/road-to-halo-part-5' => 'blogs-announcements-road-to-halo-part-5-html.php',
        'blogs/announcements/road-to-halo-part-6' => 'blogs-announcements-road-to-halo-part-6-html.php',
        'blogs/announcements/tagged/brilliant-labs-team' => 'blogs-announcements-tagged-brilliant-labs-team-html.php',
        'blogs/announcements/tagged/community' => 'blogs-announcements-tagged-community-html.php',
        'blogs/announcements/tagged/industry-updates' => 'blogs-announcements-tagged-industry-updates-html.php',
        'blogs/announcements-1' => 'blogs-announcements-1-html.php',
        'blogs/announcements-2' => 'blogs-announcements-2-html.php',
        'blogs/announcements' => 'blogs-announcements-html.php',
        'contact' => 'pages-contact-html.php',
        'developers' => 'pages-developers-html.php',
        'privacy-policy' => 'pages-privacy-policy-html.php',
        'terms-conditions' => 'pages-terms-conditions-html.php',
        'products/halo' => 'products-halo-html.php',
    );
}

function brilliant_xyz_add_rewrite_rules() {
    foreach ( brilliant_xyz_static_routes() as $route => $template ) {
        add_rewrite_rule( '^' . preg_quote( $route, '/' ) . '/?$', 'index.php?brilliant_static=' . rawurlencode( $template ), 'top' );
    }
}
add_action( 'init', 'brilliant_xyz_add_rewrite_rules' );

function brilliant_xyz_query_vars( $vars ) {
    $vars[] = 'brilliant_static';
    return $vars;
}
add_filter( 'query_vars', 'brilliant_xyz_query_vars' );

function brilliant_xyz_template_include( $template ) {
    $static = get_query_var( 'brilliant_static' );
    if ( $static ) {
        $allowed = array_values( brilliant_xyz_static_routes() );
        if ( in_array( $static, $allowed, true ) ) {
            $candidate = get_template_directory() . '/templates-static/' . basename( $static );
            if ( file_exists( $candidate ) ) {
                status_header( 200 );
                return $candidate;
            }
        }
    }
    return $template;
}
add_filter( 'template_include', 'brilliant_xyz_template_include', 99 );

function brilliant_xyz_flush_rewrites() {
    brilliant_xyz_add_rewrite_rules();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'brilliant_xyz_flush_rewrites' );

// Prevent WordPress from adding emoji assets to this static clone.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
