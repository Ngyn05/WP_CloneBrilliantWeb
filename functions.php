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

// Chuẩn hóa tên website hiển thị trên thanh tiêu đề trình duyệt (Browser Tab Title)
add_filter( 'document_title_parts', function( $title ) {
    $title['site'] = 'Brilliant Việt Nam';
    return $title;
} );
add_filter( 'pre_option_blogname', function() {
    return 'Brilliant Việt Nam';
} );
add_filter( 'bloginfo', function( $output, $show = '' ) {
    if ( $show === 'name' ) {
        return 'Brilliant Việt Nam';
    }
    return $output;
}, 10, 2 );

// Include Inc Modules
require_once get_template_directory() . '/inc/metaboxes.php';
require_once get_template_directory() . '/inc/woocommerce-product.php';
require_once get_template_directory() . '/inc/database-seeder.php';
require_once get_template_directory() . '/inc/product-seeder.php';
require_once get_template_directory() . '/inc/page-seeder.php';
require_once get_template_directory() . '/inc/seo-sitemap-robots.php';
require_once get_template_directory() . '/inc/seo-schema.php';

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

    // 1. Check static template routes (contact, developers, privacy, terms)
    $static = get_query_var( 'brilliant_static' );
    $view   = get_query_var( 'brilliant_view' );
    $static_routes = brilliant_xyz_static_routes();

    $matched_slug = null;
    $matched_tpl  = null;

    if ( $static ) {
        foreach ( $static_routes as $slug => $tpl ) {
            if ( $static === $tpl ) {
                $matched_slug = $slug;
                $matched_tpl  = $tpl;
                break;
            }
        }
    }

    if ( ! $matched_slug && isset( $static_routes[ $req_path ] ) ) {
        $matched_slug = $req_path;
        $matched_tpl  = $static_routes[ $req_path ];
    }

    if ( $matched_slug && $matched_tpl ) {
        $candidate = get_template_directory() . '/templates-static/' . basename( $matched_tpl );
        if ( file_exists( $candidate ) ) {
            global $wp_query, $post;
            $page_obj = get_page_by_path( $matched_slug, OBJECT, 'page' );
            if ( $page_obj ) {
                if ( isset( $wp_query ) ) {
                    $wp_query->queried_object    = $page_obj;
                    $wp_query->queried_object_id = $page_obj->ID;
                    $wp_query->is_page           = true;
                    $wp_query->is_singular       = true;
                    $wp_query->is_home           = false;
                    $wp_query->is_archive        = false;
                }
                $GLOBALS['post'] = $page_obj;
                setup_postdata( $page_obj );
            }
            status_header( 200 );
            return $candidate;
        }
    }

    // 2. Check Product pages (/product/{slug}/, /products/{slug}/, or WooCommerce single product)
    if ( preg_match( '#^products?/([^/]+)/?$#i', $req_path, $matches ) ) {
        $slug = sanitize_title( $matches[1] );
        $product = get_page_by_path( $slug, OBJECT, 'product' );
        
        if ( ! $product || $product->post_status !== 'publish' ) {
            global $wp_query;
            if ( isset( $wp_query ) ) {
                $wp_query->set_404();
            }
            status_header( 404 );
            nocache_headers();
            return get_template_directory() . '/404.php';
        }

        $GLOBALS['post'] = $product;
        setup_postdata( $product );
        status_header( 200 );
        return get_template_directory() . '/templates/single-product.php';
    }

    // 3. Check Single Blog Post
    if ( preg_match( '#^blogs/(?:announcements/)?([^/]+)/?$#i', $req_path, $matches ) ) {
        $slug = sanitize_title( $matches[1] );
        if ( ! in_array( $slug, array( 'announcements', 'tagged', 'page' ), true ) ) {
            $post_obj = get_page_by_path( $slug, OBJECT, 'post' );
            if ( ! $post_obj || $post_obj->post_status !== 'publish' ) {
                global $wp_query;
                if ( isset( $wp_query ) ) {
                    $wp_query->set_404();
                }
                status_header( 404 );
                nocache_headers();
                return get_template_directory() . '/404.php';
            }
            $GLOBALS['post'] = $post_obj;
            setup_postdata( $post_obj );
            status_header( 200 );
            return get_template_directory() . '/templates/single-blog.php';
        }
    }

    // 4. Check Blog & Announcements Archive views (/blogs/, /blogs/announcements/, tagged, page, categories)
    if ( 
        ( ! empty( $view ) && $view === 'archive' ) || 
        preg_match( '#^blogs(/announcements)?/?$#i', $req_path ) ||
        preg_match( '#^blogs/announcements/(tagged|page)/#i', $req_path ) ||
        preg_match( '#^blogs/tagged/#i', $req_path ) ||
        is_category() || 
        ( is_archive() && ! is_post_type_archive( 'product' ) )
    ) {
        $archive_candidate = get_template_directory() . '/templates/archive-blog.php';
        if ( file_exists( $archive_candidate ) ) {
            status_header( 200 );
            return $archive_candidate;
        }
    }

    // 5. Front Page / Home Page
    if ( empty( $req_path ) || ( is_front_page() && empty( $req_path ) ) ) {
        $front_candidate = get_template_directory() . '/front-page.php';
        if ( file_exists( $front_candidate ) ) {
            status_header( 200 );
            return $front_candidate;
        }
    }

    // 6. Default 404 check
    if ( is_404() ) {
        return get_template_directory() . '/404.php';
    }

    return $template;
}
add_filter( 'template_include', 'brilliant_xyz_template_include', 99 );

// Ensure rewrite rules are flushed for new URLs
function brilliant_xyz_flush_rules_if_needed() {
    if ( ! get_option( 'bl_product_rewrites_flushed_v4' ) ) {
        brilliant_xyz_add_rewrite_rules();
        flush_rewrite_rules();
        update_option( 'bl_product_rewrites_flushed_v4', 1 );
    }
}
add_action( 'init', 'brilliant_xyz_flush_rules_if_needed', 30 );

// Excerpt length filter
function brilliant_custom_excerpt_length( $length ) {
    return 35;
}
add_filter( 'excerpt_length', 'brilliant_custom_excerpt_length', 999 );

// Prevent WordPress from adding default emoji scripts and jquery-migrate noise
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

add_action( 'wp_default_scripts', function( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
        if ( $script->deps ) {
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
} );

/**
 * Filter sender name for outgoing emails
 */
add_filter( 'wp_mail_from_name', function( $original_name ) {
    return 'Brilliant Việt Nam';
} );

/**
 * Handle AJAX for phone consultation leads
 */
function bl_ajax_phone_consultation() {
    $phone        = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';
    $product_name = isset( $_POST['product_name'] ) ? sanitize_text_field( $_POST['product_name'] ) : 'Sản phẩm Brilliant';
    $product_url  = isset( $_POST['product_url'] ) ? esc_url_raw( $_POST['product_url'] ) : '';

    if ( empty( $phone ) ) {
        wp_send_json_error( array( 'message' => 'Vui lòng nhập số điện thoại.' ) );
    }

    // Save lead into options list (keeps last 100 leads)
    $leads = get_option( 'bl_phone_consultation_leads', array() );
    if ( ! is_array( $leads ) ) {
        $leads = array();
    }
    array_unshift( $leads, array(
        'phone'        => $phone,
        'product_name' => $product_name,
        'product_url'  => $product_url,
        'created_at'   => current_time( 'mysql' ),
        'ip'           => isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( $_SERVER['REMOTE_ADDR'] ) : '',
    ) );
    if ( count( $leads ) > 100 ) {
        $leads = array_slice( $leads, 0, 100 );
    }
    update_option( 'bl_phone_consultation_leads', $leads );

    // Send email notification to admin
    $admin_email = get_option( 'admin_email' );
    $subject     = '[Brilliant Việt Nam] Yêu cầu tư vấn sản phẩm mới - SĐT: ' . $phone;

    // Headers
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: Brilliant Việt Nam <' . $admin_email . '>',
    );

    // HTML Email Template (Tiếng Việt)
    $time_formatted = current_time( 'd/m/Y H:i:s' );
    $safe_phone     = esc_html( $phone );
    $safe_prod_name = esc_html( $product_name );
    $safe_prod_url  = esc_url( $product_url );

    $body = '<!DOCTYPE html>
    <html lang="vi">
    <head><meta charset="UTF-8"></head>
    <body style="margin: 0; padding: 20px; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif; background-color: #f4f5f7; color: #1f2937;">
      <div style="max-width: 580px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.06); border: 1px solid #e5e7eb;">
        
        <!-- Header -->
        <div style="background-color: #000000; padding: 24px 28px; text-align: center;">
          <h1 style="margin: 0; color: #ffffff; font-size: 20px; letter-spacing: 2px; font-weight: 700; text-transform: uppercase;">BRILLIANT VIỆT NAM</h1>
          <p style="margin: 6px 0 0; color: #9ca3af; font-size: 13px;">Thông báo yêu cầu gọi lại tư vấn khách hàng</p>
        </div>

        <!-- Body Content -->
        <div style="padding: 28px;">
          <p style="margin: 0 0 16px; font-size: 15px; line-height: 1.5; color: #374151;">
            Xin chào Quản trị viên, website <strong>Brilliant Việt Nam</strong> vừa nhận được thông tin đăng ký tư vấn từ khách hàng:
          </p>

          <!-- Details Card -->
          <table style="width: 100%; border-collapse: separate; border-spacing: 0; background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; margin-bottom: 20px; overflow: hidden;">
            <tr>
              <td style="padding: 12px 16px; width: 140px; font-weight: 600; color: #4b5563; font-size: 14px; border-bottom: 1px solid #e5e7eb;">Số điện thoại:</td>
              <td style="padding: 12px 16px; border-bottom: 1px solid #e5e7eb;">
                <a href="tel:' . $safe_phone . '" style="font-size: 16px; font-weight: 700; color: #2563eb; text-decoration: none;">' . $safe_phone . '</a>
                <span style="font-size: 12px; color: #6b7280; margin-left: 8px;">(Bấm để gọi)</span>
              </td>
            </tr>
            <tr>
              <td style="padding: 12px 16px; font-weight: 600; color: #4b5563; font-size: 14px; border-bottom: 1px solid #e5e7eb;">Sản phẩm:</td>
              <td style="padding: 12px 16px; font-weight: 600; color: #111827; font-size: 14px; border-bottom: 1px solid #e5e7eb;">' . $safe_prod_name . '</td>
            </tr>
            <tr>
              <td style="padding: 12px 16px; font-weight: 600; color: #4b5563; font-size: 14px; border-bottom: 1px solid #e5e7eb;">Trang quan tâm:</td>
              <td style="padding: 12px 16px; font-size: 14px; border-bottom: 1px solid #e5e7eb;">
                <a href="' . $safe_prod_url . '" target="_blank" rel="noopener noreferrer" style="color: #2563eb; text-decoration: underline; word-break: break-all;">' . $safe_prod_url . '</a>
              </td>
            </tr>
            <tr>
              <td style="padding: 12px 16px; font-weight: 600; color: #4b5563; font-size: 14px;">Thời gian gửi:</td>
              <td style="padding: 12px 16px; color: #6b7280; font-size: 14px;">' . $time_formatted . '</td>
            </tr>
          </table>

          <!-- Action Box -->
          <div style="background-color: #ecfdf5; border-left: 4px solid #10b981; border-radius: 4px; padding: 12px 16px;">
            <p style="margin: 0; font-size: 13px; color: #065f46; line-height: 1.4;">
              <strong>Lưu ý:</strong> Hãy liên hệ lại với khách hàng sớm nhất có thể để hỗ trợ tư vấn!
            </p>
          </div>
        </div>

        <!-- Footer -->
        <div style="background-color: #f9fafb; padding: 14px 24px; text-align: center; border-top: 1px solid #e5e7eb;">
          <p style="margin: 0; font-size: 12px; color: #9ca3af;">
            Email tự động từ hệ thống website <strong>Brilliant Việt Nam</strong>
          </p>
        </div>

      </div>
    </body>
    </html>';

    $mail_sent = wp_mail( $admin_email, $subject, $body, $headers );

    wp_send_json_success( array(
        'message'   => 'Cảm ơn bạn! Chuyên viên tư vấn sẽ liên hệ ngay qua số ' . esc_html( $phone ) . '.',
        'mail_sent' => $mail_sent,
    ) );
}
add_action( 'wp_ajax_bl_submit_phone_consultation', 'bl_ajax_phone_consultation' );
add_action( 'wp_ajax_nopriv_bl_submit_phone_consultation', 'bl_ajax_phone_consultation' );

/**
 * Handle AJAX for Quick Order (Mua Ngay)
 */
function bl_ajax_quick_order() {
    $phone        = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';
    $name         = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
    $email        = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
    $address      = isset( $_POST['address'] ) ? sanitize_textarea_field( $_POST['address'] ) : '';
    $note         = isset( $_POST['note'] ) ? sanitize_textarea_field( $_POST['note'] ) : '';
    $product_id   = isset( $_POST['product_id'] ) ? intval( $_POST['product_id'] ) : 0;
    $product_name = isset( $_POST['product_name'] ) ? sanitize_text_field( $_POST['product_name'] ) : 'Sản phẩm Brilliant';
    $product_url  = isset( $_POST['product_url'] ) ? esc_url_raw( $_POST['product_url'] ) : '';
    $product_price= isset( $_POST['product_price'] ) ? floatval( $_POST['product_price'] ) : 0;
    $quantity     = isset( $_POST['quantity'] ) ? max( 1, intval( $_POST['quantity'] ) ) : 1;
    $payment_method = 'Thanh toán khi nhận hàng (COD)';

    if ( empty( $phone ) ) {
        wp_send_json_error( array( 'message' => 'Vui lòng nhập số điện thoại để chúng tôi liên hệ giao hàng.' ) );
    }

    $total_amount = $product_price * $quantity;
    $total_display = ( $total_amount > 0 ) ? number_format( $total_amount, 0, ',', '.' ) . ' ₫' : 'Liên hệ';
    $unit_price_display = ( $product_price > 0 ) ? number_format( $product_price, 0, ',', '.' ) . ' ₫' : 'Liên hệ';

    $order_id = 'BL-' . date( 'ymd' ) . '-' . rand( 1000, 9999 );

    // Save order into options list (keeps last 200 orders)
    $orders = get_option( 'bl_quick_orders', array() );
    if ( ! is_array( $orders ) ) {
        $orders = array();
    }
    $order_data = array(
        'order_id'       => $order_id,
        'phone'          => $phone,
        'name'           => $name,
        'email'          => $email,
        'address'        => $address,
        'note'           => $note,
        'product_id'     => $product_id,
        'product_name'   => $product_name,
        'product_url'    => $product_url,
        'unit_price'     => $unit_price_display,
        'quantity'       => $quantity,
        'total_amount'   => $total_display,
        'payment_method' => $payment_method,
        'status'         => 'Chờ xử lý',
        'created_at'     => current_time( 'mysql' ),
        'ip'             => isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( $_SERVER['REMOTE_ADDR'] ) : '',
    );
    array_unshift( $orders, $order_data );
    if ( count( $orders ) > 200 ) {
        $orders = array_slice( $orders, 0, 200 );
    }
    update_option( 'bl_quick_orders', $orders );

    // Send email notification to admin
    $admin_email = get_option( 'admin_email' );
    $subject     = '[Brilliant Việt Nam] Đơn hàng mới #' . $order_id . ' - SĐT: ' . $phone;

    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: Brilliant Việt Nam <' . $admin_email . '>',
    );

    $time_formatted = current_time( 'd/m/Y H:i:s' );
    $safe_phone     = esc_html( $phone );
    $safe_name      = esc_html( $name ?: 'Không cung cấp' );
    $safe_email     = esc_html( $email ?: 'Không cung cấp' );
    $safe_address   = esc_html( $address ?: 'Chưa cung cấp (chờ gọi xác nhận)' );
    $safe_note      = esc_html( $note ?: 'Không có' );
    $safe_prod_name = esc_html( $product_name );
    $safe_prod_url  = esc_url( $product_url );

    $body = '<!DOCTYPE html>
    <html lang="vi">
    <head><meta charset="UTF-8"></head>
    <body style="margin: 0; padding: 20px; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif; background-color: #f4f5f7; color: #1f2937;">
      <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.06); border: 1px solid #e5e7eb;">
        
        <!-- Header -->
        <div style="background-color: #000000; padding: 24px 28px; text-align: center;">
          <h1 style="margin: 0; color: #ffffff; font-size: 20px; letter-spacing: 2px; font-weight: 700; text-transform: uppercase;">BRILLIANT VIỆT NAM</h1>
          <p style="margin: 6px 0 0; color: #9ca3af; font-size: 13px;">Thông báo đơn hàng mới từ website</p>
        </div>

        <!-- Body Content -->
        <div style="padding: 28px;">
          <p style="margin: 0 0 16px; font-size: 15px; line-height: 1.5; color: #374151;">
            Xin chào Quản trị viên, bạn vừa nhận được đơn đặt hàng mới <strong>#' . $order_id . '</strong>:
          </p>

          <!-- Order Summary Card -->
          <div style="background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 16px; margin-bottom: 20px;">
            <h3 style="margin: 0 0 12px; font-size: 15px; color: #111827; border-bottom: 1px solid #e5e7eb; padding-bottom: 8px;">Tóm tắt đơn hàng</h3>
            <table style="width: 100%; font-size: 14px; line-height: 1.6;">
              <tr>
                <td style="color: #4b5563; width: 140px;">Sản phẩm:</td>
                <td style="font-weight: 600; color: #111827;"><a href="' . $safe_prod_url . '" target="_blank" style="color: #111827; text-decoration: none;">' . $safe_prod_name . '</a></td>
              </tr>
              <tr>
                <td style="color: #4b5563;">Số lượng:</td>
                <td style="font-weight: 600; color: #111827;">' . $quantity . '</td>
              </tr>
            </table>
          </div>

          <!-- Customer Info Card -->
          <div style="background-color: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 16px; margin-bottom: 20px;">
            <h3 style="margin: 0 0 12px; font-size: 15px; color: #111827; border-bottom: 1px solid #e5e7eb; padding-bottom: 8px;">Thông tin khách hàng</h3>
            <table style="width: 100%; font-size: 14px; line-height: 1.6;">
              <tr>
                <td style="color: #4b5563; width: 140px; font-weight: 600;">Số điện thoại:</td>
                <td><a href="tel:' . $safe_phone . '" style="color: #2563eb; font-weight: 700; font-size: 15px; text-decoration: none;">' . $safe_phone . '</a> (Bấm để gọi)</td>
              </tr>
              <tr>
                <td style="color: #4b5563;">Họ và tên:</td>
                <td style="color: #111827;">' . $safe_name . '</td>
              </tr>
              <tr>
                <td style="color: #4b5563;">Email:</td>
                <td style="color: #374151;">' . $safe_email . '</td>
              </tr>
              <tr>
                <td style="color: #4b5563;">Địa chỉ nhận hàng:</td>
                <td style="color: #111827;">' . $safe_address . '</td>
              </tr>
              <tr>
                <td style="color: #4b5563;">Ghi chú:</td>
                <td style="color: #374151;">' . $safe_note . '</td>
              </tr>
              <tr>
                <td style="color: #4b5563;">Phương thức:</td>
                <td style="color: #111827; font-weight: 600;">Thanh toán khi nhận hàng (COD)</td>
              </tr>
              <tr>
                <td style="color: #4b5563;">Thời gian đặt:</td>
                <td style="color: #6b7280;">' . $time_formatted . '</td>
              </tr>
            </table>
          </div>

          <!-- Note Box -->
          <div style="background-color: #eff6ff; border-left: 4px solid #3b82f6; border-radius: 4px; padding: 12px 16px;">
            <p style="margin: 0; font-size: 13px; color: #1e40af; line-height: 1.4;">
              <strong>Hành động:</strong> Hãy gọi điện cho khách hàng qua số <strong>' . $safe_phone . '</strong> để xác nhận đơn hàng và chuẩn bị đóng gói giao hàng.
            </p>
          </div>
        </div>

        <!-- Footer -->
        <div style="background-color: #f9fafb; padding: 14px 24px; text-align: center; border-top: 1px solid #e5e7eb;">
          <p style="margin: 0; font-size: 12px; color: #9ca3af;">
            Email tự động từ hệ thống website <strong>Brilliant Việt Nam</strong>
          </p>
        </div>

      </div>
    </body>
    </html>';

    $mail_sent = wp_mail( $admin_email, $subject, $body, $headers );

    // If customer provided email, send confirmation to customer
    if ( ! empty( $email ) && is_email( $email ) ) {
        $cust_subject = '[Brilliant Việt Nam] Xác nhận đặt hàng thành công #' . $order_id;
        $cust_body = '<!DOCTYPE html>
        <html lang="vi">
        <head><meta charset="UTF-8"></head>
        <body style="margin: 0; padding: 20px; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif; background-color: #f4f5f7; color: #1f2937;">
          <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.06); border: 1px solid #e5e7eb;">
            <div style="background-color: #000000; padding: 24px 28px; text-align: center;">
              <h1 style="margin: 0; color: #ffffff; font-size: 20px; letter-spacing: 2px; font-weight: 700; text-transform: uppercase;">BRILLIANT VIỆT NAM</h1>
              <p style="margin: 6px 0 0; color: #9ca3af; font-size: 13px;">Xác nhận đơn hàng #' . $order_id . '</p>
            </div>
            <div style="padding: 28px;">
              <p style="font-size: 15px; color: #374151;">Xin chào <strong>' . $safe_name . '</strong>,</p>
              <p style="font-size: 14px; color: #4b5563; line-height: 1.6;">Cảm ơn bạn đã đặt hàng tại <strong>Brilliant Việt Nam</strong>. Đơn hàng của bạn đã được tiếp nhận và nhân viên sẽ liên hệ với bạn trong thời gian sớm nhất qua số điện thoại <strong>' . $safe_phone . '</strong> để xác nhận và gửi hàng.</p>
              
              <div style="background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 16px; margin: 20px 0;">
                <p style="margin: 0 0 8px; font-weight: 600;">Sản phẩm: ' . $safe_prod_name . '</p>
                <p style="margin: 0 0 8px;">Số lượng: ' . $quantity . '</p>
              </div>
              <p style="font-size: 13px; color: #6b7280;">Nếu cần hỗ trợ gấp, vui lòng liên hệ hotline/Zalo: 0917 834 532.</p>
            </div>
            <div style="background-color: #f9fafb; padding: 14px 24px; text-align: center; border-top: 1px solid #e5e7eb;">
              <p style="margin: 0; font-size: 12px; color: #9ca3af;">Brilliant Việt Nam</p>
            </div>
          </div>
        </body>
        </html>';
        @wp_mail( $email, $cust_subject, $cust_body, $headers );
    }

    wp_send_json_success( array(
        'order_id'     => $order_id,
        'phone'        => $phone,
        'total_amount' => $total_display,
        'message'      => 'Đặt hàng thành công!',
    ) );
}
add_action( 'wp_ajax_bl_submit_quick_order', 'bl_ajax_quick_order' );
add_action( 'wp_ajax_nopriv_bl_submit_quick_order', 'bl_ajax_quick_order' );

/**
 * Handle AJAX for Contact Form Submissions
 */
function bl_ajax_submit_contact_form() {
    $name    = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
    $email   = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
    $subject = isset( $_POST['subject'] ) ? sanitize_text_field( $_POST['subject'] ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( $_POST['message'] ) : '';

    if ( empty( $name ) ) {
        wp_send_json_error( array( 'message' => 'Vui lòng nhập họ và tên của bạn.' ) );
    }

    if ( empty( $email ) || ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => 'Vui lòng nhập địa chỉ email hợp lệ.' ) );
    }

    if ( empty( $message ) ) {
        wp_send_json_error( array( 'message' => 'Vui lòng nhập nội dung tin nhắn.' ) );
    }

    if ( empty( $subject ) ) {
        $subject = 'Liên hệ từ ' . $name;
    }

    // Lưu vào danh sách tin nhắn trong Database (lưu tối đa 200 tin nhắn gần nhất)
    $submissions = get_option( 'bl_contact_submissions', array() );
    if ( ! is_array( $submissions ) ) {
        $submissions = array();
    }

    $entry_id = 'MSG-' . date( 'ymd' ) . '-' . rand( 1000, 9999 );
    $entry_data = array(
        'id'        => $entry_id,
        'name'      => $name,
        'email'     => $email,
        'subject'   => $subject,
        'message'   => $message,
        'date'      => current_time( 'mysql' ),
        'ip'        => sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' ),
        'status'    => 'new',
    );

    array_unshift( $submissions, $entry_data );
    if ( count( $submissions ) > 200 ) {
        $submissions = array_slice( $submissions, 0, 200 );
    }
    update_option( 'bl_contact_submissions', $submissions );

    // Gửi email thông báo tới Quản trị viên và contact@brilliantvietnam.com
    $admin_email = get_option( 'admin_email' );
    $to_emails   = array_filter( array_unique( array( $admin_email, 'contact@brilliantvietnam.com' ) ) );

    $mail_subject = '[Brilliant Việt Nam] Tin nhắn liên hệ mới: ' . $subject;
    $mail_body    = '<html><body style="font-family: Arial, sans-serif; line-height: 1.6; color: #222; background-color: #f4f4f5; padding: 20px;">';
    $mail_body   .= '<div style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">';
    $mail_body   .= '<div style="background: #000000; color: #ffffff; padding: 20px 24px;"><h2 style="margin: 0; font-size: 18px; font-weight: 700;">Tin nhắn liên hệ mới từ Khách hàng</h2></div>';
    $mail_body   .= '<div style="padding: 24px;">';
    $mail_body   .= '<p style="margin: 0 0 10px;"><strong>Họ và tên:</strong> ' . esc_html( $name ) . '</p>';
    $mail_body   .= '<p style="margin: 0 0 10px;"><strong>Địa chỉ Email:</strong> <a href="mailto:' . esc_attr( $email ) . '" style="color: #2563eb;">' . esc_html( $email ) . '</a></p>';
    $mail_body   .= '<p style="margin: 0 0 10px;"><strong>Chủ đề:</strong> ' . esc_html( $subject ) . '</p>';
    $mail_body   .= '<p style="margin: 0 0 16px;"><strong>Thời gian gửi:</strong> ' . current_time( 'd/m/Y H:i:s' ) . '</p>';
    $mail_body   .= '<div style="background: #f8fafc; border-left: 4px solid #000000; border-radius: 4px; padding: 14px 18px; margin-top: 10px;">';
    $mail_body   .= '<p style="margin: 0 0 6px; font-weight: 700; color: #1e293b;">Nội dung tin nhắn:</p>';
    $mail_body   .= '<p style="margin: 0; color: #334155; white-space: pre-line;">' . esc_html( $message ) . '</p>';
    $mail_body   .= '</div>';
    $mail_body   .= '</div>';
    $mail_body   .= '<div style="background: #f1f5f9; padding: 12px 24px; text-align: center; font-size: 12px; color: #64748b;">Hệ thống Brilliant Việt Nam &bull; Mã tin nhắn: ' . $entry_id . '</div>';
    $mail_body   .= '</div></body></html>';

    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'Reply-To: ' . $name . ' <' . $email . '>',
    );

    @wp_mail( $to_emails, $mail_subject, $mail_body, $headers );

    wp_send_json_success( array(
        'id'      => $entry_id,
        'message' => 'Cảm ơn bạn! Tin nhắn của bạn đã được gửi thành công đến Brilliant Việt Nam. Chúng tôi sẽ phản hồi trong thời gian sớm nhất.',
    ) );
}
add_action( 'wp_ajax_bl_submit_contact_form', 'bl_ajax_submit_contact_form' );
add_action( 'wp_ajax_nopriv_bl_submit_contact_form', 'bl_ajax_submit_contact_form' );

/**
 * Admin Menu for Contact Submissions
 */
function bl_register_contact_admin_menu() {
    add_menu_page(
        'Tin nhắn Liên hệ',
        'Tin nhắn Liên hệ',
        'manage_options',
        'bl-contact-messages',
        'bl_render_contact_admin_page',
        'dashicons-email-alt2',
        26
    );
}
add_action( 'admin_menu', 'bl_register_contact_admin_menu' );

function bl_render_contact_admin_page() {
    $messages = get_option( 'bl_contact_submissions', array() );
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Danh sách Tin nhắn Liên hệ</h1>
        <hr class="wp-header-end">

        <?php if ( empty( $messages ) ) : ?>
            <div class="notice notice-info" style="margin-top: 20px;"><p>Hiện chưa có tin nhắn liên hệ nào.</p></div>
        <?php else : ?>
            <table class="wp-list-table widefat fixed striped table-view-list" style="margin-top: 20px;">
                <thead>
                    <tr>
                        <th style="width: 120px;">Mã tin</th>
                        <th style="width: 150px;">Thời gian</th>
                        <th style="width: 150px;">Họ tên</th>
                        <th style="width: 200px;">Email</th>
                        <th style="width: 200px;">Chủ đề</th>
                        <th>Nội dung</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $messages as $msg ) : ?>
                        <tr>
                            <td><strong><code><?php echo esc_html( $msg['id'] ?? 'N/A' ); ?></code></strong></td>
                            <td><?php echo esc_html( date( 'd/m/Y H:i', strtotime( $msg['date'] ?? 'now' ) ) ); ?></td>
                            <td><strong><?php echo esc_html( $msg['name'] ?? '' ); ?></strong></td>
                            <td><a href="mailto:<?php echo esc_attr( $msg['email'] ?? '' ); ?>"><?php echo esc_html( $msg['email'] ?? '' ); ?></a></td>
                            <td><?php echo esc_html( $msg['subject'] ?? '' ); ?></td>
                            <td style="white-space: pre-wrap;"><?php echo esc_html( $msg['message'] ?? '' ); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <?php
}

