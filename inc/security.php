<?php
/**
 * Lightweight security hardening for the Brilliant theme.
 *
 * Server-level controls and timely updates are still required in production.
 *
 * @package Brilliant_XYZ
 */

defined( 'ABSPATH' ) || exit;

// Remove passive WordPress version disclosure.
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );

// Disable XML-RPC when the site does not use Jetpack or remote publishing.
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'xmlrpc_methods', '__return_empty_array' );
add_filter( 'wp_headers', function ( $headers ) {
    unset( $headers['X-Pingback'] );
    return $headers;
} );

// Prevent unauthenticated REST requests from enumerating WordPress usernames.
add_filter( 'rest_pre_dispatch', function ( $result, $server, $request ) {
    unset( $server );

    if ( preg_match( '#^/wp/v2/users(?:/|$)#', $request->get_route() ) && ! current_user_can( 'list_users' ) ) {
        return new WP_Error(
            'rest_forbidden',
            'Bạn không có quyền xem danh sách người dùng.',
            array( 'status' => rest_authorization_required_code() )
        );
    }

    return $result;
}, 10, 3 );

// Add browser security headers without imposing a CSP that could break checkout assets.
add_filter( 'wp_headers', function ( $headers ) {
    $headers['X-Content-Type-Options'] = 'nosniff';
    $headers['X-Frame-Options']        = 'SAMEORIGIN';
    $headers['Referrer-Policy']        = 'strict-origin-when-cross-origin';
    $headers['Permissions-Policy']     = 'camera=(), microphone=(), geolocation=()';

    if ( is_ssl() ) {
        $headers['Strict-Transport-Security'] = 'max-age=31536000; includeSubDomains';
    }

    return $headers;
} );

/**
 * Validate public form requests and apply a small per-IP rate limit.
 *
 * @param string $action Stable form action identifier.
 * @param int    $limit  Maximum accepted requests in the period.
 * @param int    $period Rate-limit period in seconds.
 */
function bl_security_guard_public_form( $action, $limit = 5, $period = 600 ) {
    if ( ! check_ajax_referer( 'bl_public_forms', 'security', false ) ) {
        wp_send_json_error( array( 'message' => 'Phiên gửi biểu mẫu không hợp lệ. Vui lòng tải lại trang.' ), 403 );
    }

    $ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown';
    $key = 'bl_rate_' . md5( $action . '|' . $ip );
    $hit = (int) get_transient( $key );

    if ( $hit >= $limit ) {
        wp_send_json_error( array( 'message' => 'Bạn đã gửi quá nhiều yêu cầu. Vui lòng thử lại sau.' ), 429 );
    }

    set_transient( $key, $hit + 1, $period );
}
