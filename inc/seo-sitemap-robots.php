<?php
/**
 * SEO Module: Yoast SEO Compatible Dynamic XML Sitemap & Robots.txt Generator
 * Brilliant Labs Vietnam Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Vô hiệu hóa sitemap mặc định đơn sơ của WP để kích hoạt chuẩn Yoast SEO Sitemap
add_filter( 'wp_sitemaps_enabled', '__return_false' );

/**
 * 1. Register Rewrite Rules for Sitemaps
 */
function bl_seo_add_sitemap_rewrites() {
    add_rewrite_rule( '^sitemap\.xml/?$', 'index.php?bl_sitemap=index', 'top' );
    add_rewrite_rule( '^sitemap_index\.xml/?$', 'index.php?bl_sitemap=index', 'top' );
    add_rewrite_rule( '^post-sitemap\.xml/?$', 'index.php?bl_sitemap=post', 'top' );
    add_rewrite_rule( '^page-sitemap\.xml/?$', 'index.php?bl_sitemap=page', 'top' );
    add_rewrite_rule( '^product-sitemap\.xml/?$', 'index.php?bl_sitemap=product', 'top' );
    add_rewrite_rule( '^category-sitemap\.xml/?$', 'index.php?bl_sitemap=category', 'top' );
    add_rewrite_rule( '^main-sitemap\.xsl/?$', 'index.php?bl_sitemap=xsl', 'top' );
}
add_action( 'init', 'bl_seo_add_sitemap_rewrites', 15 );

/**
 * 2. Register Query Vars
 */
function bl_seo_register_query_vars( $vars ) {
    $vars[] = 'bl_sitemap';
    return $vars;
}
add_filter( 'query_vars', 'bl_seo_register_query_vars' );

/**
 * 3. Direct Request Interceptor for Sitemaps & Robots.txt (100% immediate & reliable)
 */
function bl_seo_direct_init_interceptor() {
    if ( is_admin() ) {
        return;
    }
    $uri  = $_SERVER['REQUEST_URI'] ?? '';
    $path = trim( parse_url( $uri, PHP_URL_PATH ), '/' );

    if ( $path === 'favicon.ico' || $path === 'apple-touch-icon.png' || $path === 'apple-touch-icon-precomposed.png' ) {
        $favicon_path = ( $path === 'favicon.ico' ) ? get_template_directory() . '/favicon.ico' : get_template_directory() . '/site-assets/cdn/shop/files/apple-touch-icon.png';
        if ( file_exists( $favicon_path ) ) {
            $mime = ( $path === 'favicon.ico' ) ? 'image/x-icon' : 'image/png';
            header( 'Content-Type: ' . $mime );
            header( 'Content-Length: ' . filesize( $favicon_path ) );
            header( 'Cache-Control: public, max-age=2592000, must-revalidate' );
            readfile( $favicon_path );
            exit;
        }
    }

    if ( $path === 'robots.txt' ) {
        header( 'Content-Type: text/plain; charset=utf-8' );
        echo bl_seo_custom_robots_txt( '', true );
        exit;
    }

    if ( $path === 'sitemap.xml' ) {
        wp_safe_redirect( home_url( '/sitemap_index.xml' ), 301 );
        exit;
    }

    $map = array(
        'sitemap_index.xml'    => 'index',
        'post-sitemap.xml'     => 'post',
        'page-sitemap.xml'     => 'page',
        'product-sitemap.xml'  => 'product',
        'category-sitemap.xml' => 'category',
        'main-sitemap.xsl'     => 'xsl',
    );

    if ( isset( $map[ $path ] ) ) {
        bl_seo_render_sitemap_by_type( $map[ $path ] );
    }
}
add_action( 'init', 'bl_seo_direct_init_interceptor', 1 );

/**
 * 4. Handle Sitemap Output
 */
function bl_seo_render_sitemap() {
    $type = get_query_var( 'bl_sitemap' );
    if ( ! empty( $type ) ) {
        bl_seo_render_sitemap_by_type( $type );
    }
}
add_action( 'template_redirect', 'bl_seo_render_sitemap', 1 );

function bl_seo_render_sitemap_by_type( $type ) {
    // Disable caching headers & output buffering
    if ( ob_get_length() ) {
        ob_end_clean();
    }

    if ( $type === 'xsl' ) {
        header( 'Content-Type: text/xsl; charset=utf-8' );
        bl_seo_output_xsl_stylesheet();
        exit;
    }

    header( 'Content-Type: application/xml; charset=utf-8' );
    header( 'X-Robots-Tag: noindex, follow', true );

    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<?xml-stylesheet type="text/xsl" href="' . esc_url( home_url( '/main-sitemap.xsl' ) ) . '"?>' . "\n";

    switch ( $type ) {
        case 'index':
            bl_seo_output_sitemap_index();
            break;
        case 'post':
            bl_seo_output_post_sitemap();
            break;
        case 'page':
            bl_seo_output_page_sitemap();
            break;
        case 'product':
            bl_seo_output_product_sitemap();
            break;
        case 'category':
            bl_seo_output_category_sitemap();
            break;
        default:
            bl_seo_output_sitemap_index();
            break;
    }

    exit;
}

/**
 * Output Yoast SEO Styled Sitemap Index
 */
function bl_seo_output_sitemap_index() {
    $now = gmdate( 'c' );
    ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc><?php echo esc_url( home_url( '/page-sitemap.xml' ) ); ?></loc>
        <lastmod><?php echo esc_html( $now ); ?></lastmod>
    </sitemap>
    <sitemap>
        <loc><?php echo esc_url( home_url( '/product-sitemap.xml' ) ); ?></loc>
        <lastmod><?php echo esc_html( $now ); ?></lastmod>
    </sitemap>
    <sitemap>
        <loc><?php echo esc_url( home_url( '/post-sitemap.xml' ) ); ?></loc>
        <lastmod><?php echo esc_html( $now ); ?></lastmod>
    </sitemap>
    <sitemap>
        <loc><?php echo esc_url( home_url( '/category-sitemap.xml' ) ); ?></loc>
        <lastmod><?php echo esc_html( $now ); ?></lastmod>
    </sitemap>
</sitemapindex>
<?php
}

/**
 * Output Pages Sitemap
 */
function bl_seo_output_page_sitemap() {
    $pages = get_posts( array(
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => 500,
        'orderby'        => 'modified',
        'order'          => 'DESC',
    ) );

    // Also include key static routes
    $static_routes = array(
        home_url( '/' )                  => array( 'priority' => '1.0', 'changefreq' => 'daily' ),
        home_url( '/developers/' )       => array( 'priority' => '0.8', 'changefreq' => 'weekly' ),
        home_url( '/contact/' )          => array( 'priority' => '0.8', 'changefreq' => 'monthly' ),
        home_url( '/privacy-policy/' )   => array( 'priority' => '0.5', 'changefreq' => 'yearly' ),
        home_url( '/terms-conditions/' ) => array( 'priority' => '0.5', 'changefreq' => 'yearly' ),
    );

    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

    $rendered_urls = array();

    // Render registered static routes first
    foreach ( $static_routes as $url => $meta ) {
        $rendered_urls[] = trailingslashit( $url );
        echo '  <url>' . "\n";
        echo '    <loc>' . esc_url( $url ) . '</loc>' . "\n";
        echo '    <lastmod>' . esc_html( gmdate( 'c' ) ) . '</lastmod>' . "\n";
        echo '    <changefreq>' . esc_html( $meta['changefreq'] ) . '</changefreq>' . "\n";
        echo '    <priority>' . esc_html( $meta['priority'] ) . '</priority>' . "\n";
        echo '  </url>' . "\n";
    }

    // Render database pages
    foreach ( $pages as $p ) {
        $permalink = get_permalink( $p->ID );
        if ( in_array( trailingslashit( $permalink ), $rendered_urls, true ) ) {
            continue;
        }
        $rendered_urls[] = trailingslashit( $permalink );
        $lastmod = get_post_modified_time( 'c', true, $p->ID );
        
        echo '  <url>' . "\n";
        echo '    <loc>' . esc_url( $permalink ) . '</loc>' . "\n";
        echo '    <lastmod>' . esc_html( $lastmod ) . '</lastmod>' . "\n";
        echo '    <changefreq>weekly</changefreq>' . "\n";
        echo '    <priority>0.8</priority>' . "\n";

        if ( has_post_thumbnail( $p->ID ) ) {
            $img_url = get_the_post_thumbnail_url( $p->ID, 'full' );
            echo '    <image:image>' . "\n";
            echo '      <image:loc>' . esc_url( $img_url ) . '</image:loc>' . "\n";
            echo '      <image:title>' . esc_html( $p->post_title ) . '</image:title>' . "\n";
            echo '    </image:image>' . "\n";
        }
        echo '  </url>' . "\n";
    }

    echo '</urlset>';
}

/**
 * Output Products Sitemap
 */
function bl_seo_output_product_sitemap() {
    $products = get_posts( array(
        'post_type'      => array( 'product' ),
        'post_status'    => 'publish',
        'posts_per_page' => 500,
        'orderby'        => 'modified',
        'order'          => 'DESC',
    ) );

    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

    $rendered_slugs = array();

    if ( ! empty( $products ) ) {
        foreach ( $products as $prod ) {
            $slug             = $prod->post_name;
            $rendered_slugs[] = $slug;
            $permalink        = home_url( '/products/' . $slug . '/' );
            $lastmod          = get_post_modified_time( 'c', true, $prod->ID );
            $img_url          = get_the_post_thumbnail_url( $prod->ID, 'full' );
            if ( empty( $img_url ) ) {
                $img_url = get_template_directory_uri() . '/site-assets/cdn/shop/files/Halo_1-11.png';
            }

            echo '  <url>' . "\n";
            echo '    <loc>' . esc_url( $permalink ) . '</loc>' . "\n";
            echo '    <lastmod>' . esc_html( $lastmod ) . '</lastmod>' . "\n";
            echo '    <changefreq>daily</changefreq>' . "\n";
            echo '    <priority>1.0</priority>' . "\n";
            echo '    <image:image>' . "\n";
            echo '      <image:loc>' . esc_url( $img_url ) . '</image:loc>' . "\n";
            echo '      <image:title>' . esc_html( $prod->post_title ) . '</image:title>' . "\n";
            echo '    </image:image>' . "\n";
            echo '  </url>' . "\n";
        }
    } else {
        // Fallback Halo
        echo '  <url>' . "\n";
        echo '    <loc>' . esc_url( home_url( '/products/halo/' ) ) . '</loc>' . "\n";
        echo '    <lastmod>' . esc_html( gmdate( 'c' ) ) . '</lastmod>' . "\n";
        echo '    <changefreq>daily</changefreq>' . "\n";
        echo '    <priority>1.0</priority>' . "\n";
        echo '    <image:image>' . "\n";
        echo '      <image:loc>' . esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Halo_1-11.png' ) . '</image:loc>' . "\n";
        echo '      <image:title>Halo – Kính thông minh AI</image:title>' . "\n";
        echo '    </image:image>' . "\n";
        echo '  </url>' . "\n";
    }

    echo '</urlset>';
}

/**
 * Output Blog Posts Sitemap
 */
function bl_seo_output_post_sitemap() {
    $posts = get_posts( array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 1000,
        'orderby'        => 'modified',
        'order'          => 'DESC',
    ) );

    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

    // Main Blog Archive
    echo '  <url>' . "\n";
    echo '    <loc>' . esc_url( home_url( '/blogs/announcements/' ) ) . '</loc>' . "\n";
    echo '    <lastmod>' . esc_html( gmdate( 'c' ) ) . '</lastmod>' . "\n";
    echo '    <changefreq>daily</changefreq>' . "\n";
    echo '    <priority>0.8</priority>' . "\n";
    echo '  </url>' . "\n";

    foreach ( $posts as $p ) {
        $permalink = home_url( '/blogs/announcements/' . $p->post_name . '/' );
        $lastmod   = get_post_modified_time( 'c', true, $p->ID );

        echo '  <url>' . "\n";
        echo '    <loc>' . esc_url( $permalink ) . '</loc>' . "\n";
        echo '    <lastmod>' . esc_html( $lastmod ) . '</lastmod>' . "\n";
        echo '    <changefreq>weekly</changefreq>' . "\n";
        echo '    <priority>0.7</priority>' . "\n";

        if ( has_post_thumbnail( $p->ID ) ) {
            $img_url = get_the_post_thumbnail_url( $p->ID, 'full' );
            echo '    <image:image>' . "\n";
            echo '      <image:loc>' . esc_url( $img_url ) . '</image:loc>' . "\n";
            echo '      <image:title>' . esc_html( $p->post_title ) . '</image:title>' . "\n";
            echo '    </image:image>' . "\n";
        }
        echo '  </url>' . "\n";
    }

    echo '</urlset>';
}

/**
 * Output Category Sitemap
 */
function bl_seo_output_category_sitemap() {
    $categories = get_terms( array(
        'taxonomy'   => 'category',
        'hide_empty' => false,
    ) );

    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
        foreach ( $categories as $cat ) {
            $permalink = home_url( '/blogs/announcements/tagged/' . $cat->slug . '/' );
            echo '  <url>' . "\n";
            echo '    <loc>' . esc_url( $permalink ) . '</loc>' . "\n";
            echo '    <lastmod>' . esc_html( gmdate( 'c' ) ) . '</lastmod>' . "\n";
            echo '    <changefreq>weekly</changefreq>' . "\n";
            echo '    <priority>0.6</priority>' . "\n";
            echo '  </url>' . "\n";
        }
    }

    echo '</urlset>';
}

/**
 * Output Yoast-Style XSL Stylesheet
 */
function bl_seo_output_xsl_stylesheet() {
?>
<xsl:stylesheet version="2.0" 
    xmlns:html="http://www.w3.org/TR/REC-html40"
    xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
    xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>
    <xsl:template match="/">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <title>XML Sitemap – Brilliant Việt Nam</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <style type="text/css">
                    body {
                        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
                        color: #ffffff;
                        background: #111111;
                        margin: 0;
                        padding: 30px 20px;
                    }
                    #sitemap {
                        max-width: 980px;
                        margin: 0 auto;
                        background: #181818;
                        border: 1px solid #282828;
                        border-radius: 16px;
                        padding: 32px;
                        box-shadow: 0 12px 36px rgba(0,0,0,0.6);
                    }
                    h1 {
                        font-size: 26px;
                        margin: 0 0 10px 0;
                        color: #ffffff;
                    }
                    p.desc {
                        font-size: 14px;
                        color: #888888;
                        margin-bottom: 24px;
                        line-height: 1.6;
                    }
                    p.desc a {
                        color: #ffffff;
                        font-weight: 600;
                        text-decoration: underline;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 20px;
                        font-size: 13.5px;
                    }
                    th {
                        text-align: left;
                        padding: 12px 14px;
                        background: #222222;
                        color: #aaaaaa;
                        font-weight: 600;
                        border-bottom: 1px solid #333333;
                    }
                    td {
                        padding: 12px 14px;
                        border-bottom: 1px solid #262626;
                        color: #dddddd;
                    }
                    tr:hover td {
                        background: #1f1f1f;
                    }
                    a {
                        color: #ffffff;
                        text-decoration: none;
                    }
                    a:hover {
                        text-decoration: underline;
                        color: #60a5fa;
                    }
                    .badge {
                        display: inline-block;
                        padding: 3px 8px;
                        background: #000;
                        border: 1px solid #444;
                        border-radius: 4px;
                        font-size: 11px;
                        color: #fff;
                    }
                </style>
            </head>
            <body>
                <div id="sitemap">
                    <h1>XML Sitemap – Brilliant Việt Nam</h1>
                    <p class="desc">
                        Sơ đồ trang web XML động chuẩn SEO được tạo bởi hệ thống <strong>Brilliant Việt Nam</strong>. 
                        Tương thích 100% với Google Search Console, Bing Webmaster Tools và Yoast SEO.
                    </p>
                    
                    <xsl:if test="count(sitemap:sitemapindex/sitemap:sitemap) &gt; 0">
                        <p class="desc">Tổng số Sitemap con: <strong><xsl:value-of select="count(sitemap:sitemapindex/sitemap:sitemap)"/></strong></p>
                        <table>
                            <thead>
                                <tr>
                                    <th width="75%">Sitemap URL</th>
                                    <th width="25%">Cập nhật lần cuối</th>
                                </tr>
                            </thead>
                            <tbody>
                                <xsl:for-each select="sitemap:sitemapindex/sitemap:sitemap">
                                    <tr>
                                        <td>
                                            <a href="{sitemap:loc}"><xsl:value-of select="sitemap:loc"/></a>
                                        </td>
                                        <td><xsl:value-of select="concat(substring(sitemap:lastmod,0,11),concat(' ', substring(sitemap:lastmod,12,5)))"/></td>
                                    </tr>
                                </xsl:for-each>
                            </tbody>
                        </table>
                    </xsl:if>

                    <xsl:if test="count(sitemap:urlset/sitemap:url) &gt; 0">
                        <p class="desc">Tổng số liên kết URL: <strong><xsl:value-of select="count(sitemap:urlset/sitemap:url)"/></strong></p>
                        <table>
                            <thead>
                                <tr>
                                    <th width="65%">URL Liên kết</th>
                                    <th width="15%">Số ảnh</th>
                                    <th width="20%">Cập nhật lần cuối</th>
                                </tr>
                            </thead>
                            <tbody>
                                <xsl:for-each select="sitemap:urlset/sitemap:url">
                                    <tr>
                                        <td>
                                            <a href="{sitemap:loc}"><xsl:value-of select="sitemap:loc"/></a>
                                        </td>
                                        <td>
                                            <span class="badge"><xsl:value-of select="count(image:image)"/></span>
                                        </td>
                                        <td><xsl:value-of select="concat(substring(sitemap:lastmod,0,11),concat(' ', substring(sitemap:lastmod,12,5)))"/></td>
                                    </tr>
                                </xsl:for-each>
                            </tbody>
                        </table>
                    </xsl:if>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
<?php
}

/**
 * 4. Robots.txt Configuration
 */
function bl_seo_custom_robots_txt( $output, $public ) {
    $sitemap_index = home_url( '/sitemap_index.xml' );

    $robots = "User-agent: *\n";
    $robots .= "Allow: /\n";
    $robots .= "Disallow: /wp-admin/\n";
    $robots .= "Allow: /wp-admin/admin-ajax.php\n";
    $robots .= "Disallow: /cart/\n";
    $robots .= "Disallow: /checkout/\n";
	$robots .= "Disallow: /my-account/\n";
    $robots .= "Disallow: /?s=\n";
	$robots .= "Disallow: /search/\n\n";
	$robots .= "User-agent: OAI-SearchBot\n";
	$robots .= "Allow: /\n";
	$robots .= "Disallow: /cart/\n";
	$robots .= "Disallow: /checkout/\n";
	$robots .= "Disallow: /my-account/\n\n";
    $robots .= "Sitemap: {$sitemap_index}\n";

    return $robots;
}
add_filter( 'robots_txt', 'bl_seo_custom_robots_txt', 99, 2 );
