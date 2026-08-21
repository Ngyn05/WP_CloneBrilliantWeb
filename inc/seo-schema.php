<?php
/**
 * SEO Schema Module: Dynamic JSON-LD Structured Data & Dynamic Canonical Generator
 * Compliant with Google Search Central & SOP Guidelines
 * Brilliant Labs Vietnam Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 0. Global Favicon Generator
 * Xuất đầy đủ các thẻ Favicon chuẩn kích cỡ cho mọi trang, mọi thiết bị và trình duyệt
 */
function bl_output_global_favicons() {
    $theme_uri = get_template_directory_uri();
    echo '<link rel="icon" type="image/x-icon" href="' . esc_url( $theme_uri . '/favicon.ico?v=4' ) . '" />' . "\n";
    echo '<link rel="shortcut icon" type="image/x-icon" href="' . esc_url( $theme_uri . '/favicon.ico?v=4' ) . '" />' . "\n";
    echo '<link rel="icon" type="image/png" sizes="32x32" href="' . esc_url( $theme_uri . '/site-assets/cdn/shop/files/favicon-32x32.png?v=4' ) . '" />' . "\n";
    echo '<link rel="icon" type="image/png" sizes="16x16" href="' . esc_url( $theme_uri . '/site-assets/cdn/shop/files/favicon-16x16.png?v=4' ) . '" />' . "\n";
    echo '<link rel="apple-touch-icon" sizes="180x180" href="' . esc_url( $theme_uri . '/site-assets/cdn/shop/files/apple-touch-icon.png?v=4' ) . '" />' . "\n";
}
add_action( 'wp_head', 'bl_output_global_favicons', 1 );
add_action( 'admin_head', 'bl_output_global_favicons', 1 );
add_action( 'login_head', 'bl_output_global_favicons', 1 );

/**
 * 1. Canonical URL Generator Fallback
 * Tự động tạo thẻ <link rel="canonical"> chuẩn xác cho từng trang/bài viết/URL
 * Tự động nhường quyền cho Yoast SEO hoặc plugin SEO khác nếu được kích hoạt
 */
function bl_output_dynamic_rel_canonical() {
    if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) ) {
        return;
    }

    $canonical_url = '';

    if ( is_front_page() || is_home() ) {
        $canonical_url = home_url( '/' );
    } elseif ( is_singular() ) {
        $canonical_url = get_permalink();
    } elseif ( is_category() || is_tag() || is_tax() ) {
        $canonical_url = get_term_link( get_queried_object() );
    } elseif ( is_post_type_archive() ) {
        $canonical_url = get_post_type_archive_link( get_query_var( 'post_type' ) );
    } elseif ( is_archive() ) {
        if ( is_author() ) {
            $canonical_url = get_author_posts_url( get_query_var( 'author' ) );
        } elseif ( is_year() ) {
            $canonical_url = get_year_link( get_query_var( 'year' ) );
        } elseif ( is_month() ) {
            $canonical_url = get_month_link( get_query_var( 'year' ), get_query_var( 'monthnum' ) );
        } elseif ( is_day() ) {
            $canonical_url = get_day_link( get_query_var( 'year' ), get_query_var( 'monthnum' ), get_query_var( 'day' ) );
        }
    }

    if ( empty( $canonical_url ) || is_wp_error( $canonical_url ) ) {
        $req_uri = $_SERVER['REQUEST_URI'] ?? '/';
        $canonical_url = home_url( strtok( $req_uri, '?' ) );
    }

    if ( ! empty( $canonical_url ) && ! is_wp_error( $canonical_url ) ) {
        echo '<link rel="canonical" href="' . esc_url( $canonical_url ) . '" />' . "\n";
    }
}
add_action( 'wp_head', 'bl_output_dynamic_rel_canonical', 1 );

/**
 * 2. Output JSON-LD Schema (Organization, LocalBusiness, WebSite, Product, Article)
 */
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

    // 1. Organization & LocalBusiness Schema
    $org_schema = array(
        '@type'               => array( 'Organization', 'LocalBusiness' ),
        '@id'                 => $home_url . '#organization',
        'name'                => $site_name,
        'legalName'           => 'Brilliant Labs Vietnam',
        'url'                 => $home_url,
        'logo'                => array(
            '@type'   => 'ImageObject',
            '@id'     => $home_url . '#logo',
            'url'     => $logo_url,
            'caption' => $site_name,
        ),
        'image'               => $logo_url,
        'description'         => 'Đại diện phân phối chính thức kính thông minh AI Brilliant Halo và hệ sinh thái mã nguồn mở Brilliant Labs tại Việt Nam.',
        'telephone'           => '+84-981-114-028',
        'email'               => 'support@brilliantvietnam.com',
        'priceRange'          => '$$$',
        'currenciesAccepted'  => 'VND',
        'paymentAccepted'     => 'Cash, Credit Card, Bank Transfer',
        'openingHours'        => 'Mo-Sa 08:30-18:00',
        'address'             => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'Tầng 6, Tòa nhà Khâm Thiên, 195 Khâm Thiên, Thổ Quan',
            'addressLocality' => 'Đống Đa',
            'addressRegion'   => 'Hà Nội',
            'postalCode'      => '100000',
            'addressCountry'  => 'VN',
        ),
        'department'          => array(
            array(
                '@type'         => 'LocalBusiness',
                'name'          => 'Brilliant Việt Nam - Chi nhánh Hà Nội',
                'telephone'     => '+84-981-114-028',
                'address'       => array(
                    '@type'           => 'PostalAddress',
                    'streetAddress'   => 'Tầng 6, Tòa nhà Khâm Thiên, 195 Khâm Thiên, Thổ Quan',
                    'addressLocality' => 'Đống Đa',
                    'addressRegion'   => 'Hà Nội',
                    'addressCountry'  => 'VN',
                ),
            ),
            array(
                '@type'         => 'LocalBusiness',
                'name'          => 'Brilliant Việt Nam - Chi nhánh TP. Hồ Chí Minh',
                'telephone'     => '+84-912-237-880',
                'address'       => array(
                    '@type'           => 'PostalAddress',
                    'streetAddress'   => '247/23 Độc Lập, Phường Tân Quý',
                    'addressLocality' => 'Quận Tân Phú',
                    'addressRegion'   => 'TP. Hồ Chí Minh',
                    'addressCountry'  => 'VN',
                ),
            ),
        ),
        'contactPoint'        => array(
            array(
                '@type'             => 'ContactPoint',
                'telephone'         => '+84-981-114-028',
                'contactType'       => 'customer service',
                'areaServed'        => 'VN',
                'availableLanguage' => array( 'Vietnamese', 'English' ),
            ),
            array(
                '@type'             => 'ContactPoint',
                'telephone'         => '+84-912-237-880',
                'contactType'       => 'sales',
                'areaServed'        => 'VN',
                'availableLanguage' => array( 'Vietnamese', 'English' ),
            ),
        ),
        'sameAs'              => array(
            'https://facebook.com/brilliantlabs',
            'https://twitter.com/brilliantlabsar',
            'https://github.com/brilliantlabsAR',
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
                '@type'           => 'Offer',
                'url'             => home_url( '/products/halo/' ),
                'priceCurrency'   => 'VND',
                'price'           => $price,
                'priceValidUntil' => '2027-12-31',
                'itemCondition'   => 'https://schema.org/NewCondition',
                'availability'    => 'https://schema.org/InStock',
                'seller'          => array(
                    '@id' => $home_url . '#organization',
                ),
            ),
        );
        $schema_graph[] = $product_schema;

        // BreadcrumbList for Product
        $breadcrumb_schema = array(
            '@type'           => 'BreadcrumbList',
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
            '@type'           => 'BreadcrumbList',
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
