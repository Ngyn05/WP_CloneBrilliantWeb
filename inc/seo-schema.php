<?php
/**
 * SEO Schema Module: Dynamic JSON-LD Structured Data Generator
 * Compliant with Google Search Central & SOP Guidelines (Chapter 7)
 * Brilliant Labs Vietnam Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function bl_output_dynamic_json_ld_schema() {
    // Nếu Yoast SEO đang kích hoạt, để Yoast SEO quản lý toàn bộ Schema tự động
    if ( defined( 'WPSEO_VERSION' ) ) {
        return;
    }

    $home_url   = home_url( '/' );
    $site_name  = 'Brilliant Việt Nam';
    $theme_uri  = get_template_directory_uri();
    $logo_url   = $theme_uri . '/site-assets/cdn/shop/files/BrilliantVietnam_logo_white.png';

    $schema_graph = array();

    // 1. Organization Schema
    $org_schema = array(
        '@type' => 'Organization',
        '@id'   => $home_url . '#organization',
        'name'  => $site_name,
        'url'   => $home_url,
        'logo'  => array(
            '@type'  => 'ImageObject',
            '@id'    => $home_url . '#logo',
            'url'    => $logo_url,
            'caption'=> $site_name,
        ),
        'sameAs' => array(
            'https://facebook.com/brilliantlabs',
            'https://twitter.com/brilliantlabsar',
            'https://github.com/brilliantlabsAR'
        ),
    );
    $schema_graph[] = $org_schema;

    // 2. WebSite Schema
    $website_schema = array(
        '@type'           => 'WebSite',
        '@id'             => $home_url . '#website',
        'url'             => $home_url,
        'name'            => $site_name,
        'alternateName'   => 'Brilliant Labs Vietnam',
        'publisher'       => array(
            '@id' => $home_url . '#organization',
        ),
        'potentialAction' => array(
            '@type'       => 'SearchAction',
            'target'      => $home_url . 'search?q={search_term_string}',
            'query-input' => 'required name=search_term_string',
        ),
    );
    $schema_graph[] = $website_schema;

    // 3. Product Schema for Single Product (Halo)
    if ( is_singular( 'product' ) || is_page( 'halo' ) || strpos( $_SERVER['REQUEST_URI'] ?? '', '/products/halo' ) !== false ) {
        $product_id = get_the_ID() ?: 0;
        $title      = 'Halo – Kính thông minh AI';
        $price      = '8867000';
        $desc       = 'Kính thông minh AI thế hệ mới nhất với màn hình hiển thị màu sắc, loa truyền xương kép và trợ lý Noa.';
        $img_url    = $theme_uri . '/site-assets/cdn/shop/files/Halo_16_9e6dbe16-f264-4d22-bca1-175227d4ade6.png';

        if ( $product_id ) {
            $post = get_post( $product_id );
            if ( $post && $post->post_title ) {
                $title = $post->post_title;
            }
        }

        $product_schema = array(
            '@type'        => 'Product',
            '@id'          => home_url( '/products/halo/' ) . '#product',
            'name'         => $title,
            'image'        => array( $img_url ),
            'description'  => $desc,
            'sku'          => 'BLHALOBLK',
            'mpn'          => 'BL-HALO-01',
            'brand'        => array(
                '@type' => 'Brand',
                'name'  => $site_name,
            ),
            'offers'       => array(
                '@type'         => 'Offer',
                'url'           => home_url( '/products/halo/' ),
                'priceCurrency' => 'VND',
                'price'         => $price,
                'priceValidUntil' => '2027-12-31',
                'itemCondition' => 'https://schema.org/NewCondition',
                'availability'  => 'https://schema.org/InStock',
                'seller'        => array(
                    '@id' => $home_url . '#organization',
                ),
            ),
        );
        $schema_graph[] = $product_schema;

        // BreadcrumbList for Product
        $breadcrumb_schema = array(
            '@type' => 'BreadcrumbList',
            'itemListElement' => array(
                array(
                    '@type'    => 'ListItem',
                    'position' => 1,
                    'name'     => 'Trang chủ',
                    'item'     => $home_url,
                ),
                array(
                    '@type'    => 'ListItem',
                    'position' => 2,
                    'name'     => 'Sản phẩm',
                    'item'     => home_url( '/products/halo/' ),
                ),
                array(
                    '@type'    => 'ListItem',
                    'position' => 3,
                    'name'     => $title,
                ),
            ),
        );
        $schema_graph[] = $breadcrumb_schema;
    }

    // 4. Article / BlogPosting Schema for Single Blog Posts
    if ( is_singular( 'post' ) ) {
        $post_id    = get_the_ID();
        $post       = get_post( $post_id );
        $post_url   = get_permalink( $post_id );
        $thumb_id   = get_post_thumbnail_id( $post_id );
        $thumb_url  = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'full' ) : ( $theme_uri . '/site-assets/cdn/shop/files/Halo_16_9e6dbe16-f264-4d22-bca1-175227d4ade6.png' );
        $author_name= get_post_meta( $post_id, '_bl_custom_author', true ) ?: get_the_author_meta( 'display_name', $post->post_author );

        $article_schema = array(
            '@type'            => 'BlogPosting',
            '@id'              => $post_url . '#article',
            'headline'         => $post->post_title,
            'datePublished'    => get_the_date( 'c', $post_id ),
            'dateModified'     => get_the_modified_date( 'c', $post_id ),
            'mainEntityOfPage' => $post_url,
            'author'           => array(
                '@type' => 'Person',
                'name'  => $author_name,
            ),
            'publisher'        => array(
                '@id' => $home_url . '#organization',
            ),
            'image'            => $thumb_url,
            'description'      => wp_strip_all_tags( get_the_excerpt( $post_id ) ),
        );
        $schema_graph[] = $article_schema;

        // BreadcrumbList for Post
        $breadcrumb_schema = array(
            '@type' => 'BreadcrumbList',
            'itemListElement' => array(
                array(
                    '@type'    => 'ListItem',
                    'position' => 1,
                    'name'     => 'Trang chủ',
                    'item'     => $home_url,
                ),
                array(
                    '@type'    => 'ListItem',
                    'position' => 2,
                    'name'     => 'Tin tức',
                    'item'     => home_url( '/blogs/announcements/' ),
                ),
                array(
                    '@type'    => 'ListItem',
                    'position' => 3,
                    'name'     => $post->post_title,
                ),
            ),
        );
        $schema_graph[] = $breadcrumb_schema;
    }

    if ( ! empty( $schema_graph ) ) {
        $final_schema = array(
            '@context' => 'https://schema.org',
            '@graph'   => $schema_graph,
        );
        echo "\n<!-- Structured Data JSON-LD (SOP Compliant) -->\n";
        echo '<script type="application/ld+json">' . "\n";
        echo wp_json_encode( $final_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . "\n";
        echo "</script>\n<!-- End Structured Data -->\n";
    }
}
add_action( 'wp_head', 'bl_output_dynamic_json_ld_schema', 5 );
