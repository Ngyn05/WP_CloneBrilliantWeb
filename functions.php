<?php
/**
 * Brilliant XYZ WordPress Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

// Setup theme features
function brilliant_xyz_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
    
    // Default image sizes
    set_post_thumbnail_size( 720, 486, true );
}
add_action( 'after_setup_theme', 'brilliant_xyz_setup' );

// Enqueue Theme Styles
function brilliant_xyz_scripts() {
    wp_enqueue_style( 'brilliant-main-style', get_stylesheet_uri(), array(), time() );
}
add_action( 'wp_enqueue_scripts', 'brilliant_xyz_scripts' );

// Bật giao diện Trình soạn thảo Cổ điển (Classic Editor) chuẩn WordPress
add_filter( 'use_block_editor_for_post', '__return_false', 10 );
add_filter( 'use_widgets_block_editor', '__return_false' );

// Include Inc Modules
require_once get_template_directory() . '/inc/metaboxes.php';
require_once get_template_directory() . '/inc/database-seeder.php';
require_once get_template_directory() . '/inc/woocommerce-product.php';
require_once get_template_directory() . '/inc/product-seeder.php';

/**
 * Static source routes for special policy and developer pages
 */
function brilliant_xyz_static_routes() {
    return array(
        'contact'          => 'pages-contact-html.php',
        'developers'       => 'pages-developers-html.php',
        'privacy-policy'   => 'pages-privacy-policy-html.php',
        'terms-conditions' => 'pages-terms-conditions-html.php',
    );
}

/**
 * Custom Rewrite Rules for Blogs, Announcements, Categories, Single Posts and Products
 */
function brilliant_xyz_add_rewrite_rules() {
    // 1. Static page routes
    foreach ( brilliant_xyz_static_routes() as $route => $template ) {
        add_rewrite_rule( '^' . preg_quote( $route, '/' ) . '/?$', 'index.php?brilliant_static=' . rawurlencode( $template ), 'top' );
    }

    // 2. Blog category tags: /blogs/announcements/tagged/{tag}/
    add_rewrite_rule(
        '^blogs/announcements/tagged/([^/]+)/?$',
        'index.php?category_name=$matches[1]&brilliant_category=$matches[1]&brilliant_view=archive',
        'top'
    );
    add_rewrite_rule(
        '^blogs/tagged/([^/]+)/?$',
        'index.php?category_name=$matches[1]&brilliant_category=$matches[1]&brilliant_view=archive',
        'top'
    );

    // 3. Blog archive pagination: /blogs/announcements/page/{paged}/
    add_rewrite_rule(
        '^blogs/announcements/page/([0-9]+)/?$',
        'index.php?paged=$matches[1]&brilliant_view=archive',
        'top'
    );

    // 4. Main blog archive listing: /blogs/ and /blogs/announcements/
    add_rewrite_rule(
        '^blogs/announcements/?$',
        'index.php?brilliant_view=archive',
        'top'
    );
    add_rewrite_rule(
        '^blogs/?$',
        'index.php?brilliant_view=archive',
        'top'
    );

    // 5. Single blog post: /blogs/announcements/{post-slug}/
    add_rewrite_rule(
        '^blogs/announcements/([^/]+)/?$',
        'index.php?name=$matches[1]&post_type=post&brilliant_view=single',
        'top'
    );
    add_rewrite_rule(
        '^blogs/([^/]+)/?$',
        'index.php?name=$matches[1]&post_type=post&brilliant_view=single',
        'top'
    );

    // 6. Dynamic product pages: /products/{slug}/ and /product/{slug}/
    add_rewrite_rule(
        '^products/([^/]+)/?$',
        'index.php?name=$matches[1]&post_type=product&brilliant_view=product',
        'top'
    );
    add_rewrite_rule(
        '^product/([^/]+)/?$',
        'index.php?name=$matches[1]&post_type=product&brilliant_view=product',
        'top'
    );
}
add_action( 'init', 'brilliant_xyz_add_rewrite_rules' );

function brilliant_xyz_query_vars( $vars ) {
    $vars[] = 'brilliant_static';
    $vars[] = 'brilliant_view';
    $vars[] = 'brilliant_category';
    return $vars;
}
add_filter( 'query_vars', 'brilliant_xyz_query_vars' );

/**
 * Route requests to the appropriate template
 */
function brilliant_xyz_template_include( $template ) {
    $req_uri  = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
    $req_path = trim( (string) parse_url( $req_uri, PHP_URL_PATH ), '/' );

    // 0. Front Page / Home Page
    if ( is_front_page() || empty( $req_path ) ) {
        $front_candidate = get_template_directory() . '/front-page.php';
        if ( file_exists( $front_candidate ) ) {
            status_header( 200 );
            return $front_candidate;
        }
    }

    // 1. Check static template routes (contact, privacy, terms)
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

    // 2. Check Product pages (/product/{slug}/, /products/{slug}/, or WooCommerce single product)
    $view = get_query_var( 'brilliant_view' );
    if ( 
        $view === 'product' || 
        is_singular( 'product' ) || 
        ( function_exists( 'is_product' ) && is_product() ) ||
        preg_match( '#^products?/#i', $req_path )
    ) {
        $product_candidate = get_template_directory() . '/templates/single-product.php';
        if ( file_exists( $product_candidate ) ) {
            status_header( 200 );
            return $product_candidate;
        }
    }

    // 3. Check Blog & Announcements views (/blogs/...)
    if ( 
        $view === 'archive' || 
        preg_match( '#^blogs#i', $req_path ) ||
        is_category() || 
        ( is_archive() && ! is_post_type_archive( 'product' ) )
    ) {
        $archive_candidate = get_template_directory() . '/templates/archive-blog.php';
        if ( file_exists( $archive_candidate ) ) {
            status_header( 200 );
            return $archive_candidate;
        }
    }

    // 4. Single Blog Post
    if ( $view === 'single' || ( is_single() && get_post_type() === 'post' ) ) {
        $single_candidate = get_template_directory() . '/templates/single-blog.php';
        if ( file_exists( $single_candidate ) ) {
            status_header( 200 );
            return $single_candidate;
        }
    }

    return $template;
}
add_filter( 'template_include', 'brilliant_xyz_template_include', 99 );

// Ensure rewrite rules are flushed for new product URLs
function brilliant_xyz_flush_rules_if_needed() {
    if ( ! get_option( 'bl_product_rewrites_flushed_v2' ) ) {
        brilliant_xyz_add_rewrite_rules();
        flush_rewrite_rules();
        update_option( 'bl_product_rewrites_flushed_v2', 1 );
    }
}
add_action( 'init', 'brilliant_xyz_flush_rules_if_needed', 30 );

// Excerpt length filter
function brilliant_custom_excerpt_length( $length ) {
    return 35;
}
add_filter( 'excerpt_length', 'brilliant_custom_excerpt_length', 999 );

// Prevent WordPress from adding default emoji scripts
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
