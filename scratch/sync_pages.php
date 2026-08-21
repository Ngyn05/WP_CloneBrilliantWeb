<?php
/**
 * Sync page contents into WordPress database wp_posts
 */
define( 'WP_USE_THEMES', false );
require_once( dirname( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) ) . '/wp-load.php' );

$pages = get_posts( array(
    'post_type'   => 'page',
    'numberposts' => -1,
    'post_status' => 'any',
) );

echo "--- Current Pages in Database ---\n";
foreach ( $pages as $p ) {
    echo "ID: {$p->ID} | Slug: {$p->post_name} | Title: {$p->post_title} | Content length: " . strlen( $p->post_content ) . "\n";
}
