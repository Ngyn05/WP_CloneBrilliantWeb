<?php
/**
 * Product Database Seeder for Brilliant Labs Vietnam
 * Dedicated to the flagship product: Halo – Kính thông minh AI
 * NOTE: Only seeds once on initialization. Will NEVER overwrite user edits!
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function bl_seed_halo_product_only() {
    // If product already exists in database, NEVER overwrite user's edits
    $existing = get_page_by_path( 'halo', OBJECT, 'product' );
    if ( $existing ) {
        return;
    }

    if ( get_option( 'bl_halo_product_seed_locked_v1' ) ) {
        return;
    }

    $theme_dir = get_template_directory();

    // 1. Create Category: Kính thông minh AI
    $cat_term = get_term_by( 'slug', 'smart-glasses', 'product_cat' );
    $cat_id = 0;
    if ( $cat_term ) {
        $cat_id = $cat_term->term_id;
    } else {
        $created = wp_insert_term(
            'Kính thông minh AI',
            'product_cat',
            array(
                'slug'        => 'smart-glasses',
                'description' => 'Dòng sản phẩm kính thông minh AI chính hãng từ Brilliant Việt Nam.',
            )
        );
        if ( ! is_wp_error( $created ) ) {
            $cat_id = $created['term_id'];
        }
    }

    // 2. Insert Official Halo Product for the first time
    $product_title   = 'Halo – Kính thông minh AI';
    $product_excerpt = 'Kính thông minh AI thế hệ mới nhất với màn hình hiển thị màu sắc, hệ thống loa truyền xương kép và trợ lý AI riêng tư Noa sở hữu bộ nhớ dài hạn.';
    $product_content = '<h3 style="text-align: left;" dir="ltr"><span>Giới thiệu <span style="color: rgb(255, 0, 255);"><span style="color: rgb(242, 136, 191);"><strong>Halo</strong>! </span></span></span></h3>
<h5 dir="ltr" style="text-align: left;"><span>Kính AI mã nguồn mở dành cho những người tò mò, sáng tạo và có tầm nhìn tương lai.</span></h5>
<p><strong>Halo</strong> sở hữu thiết kế hoàn toàn mới, hệ thống quang học và linh kiện điện tử được tái định hình, cùng <strong>Noa</strong> — tác nhân AI đàm thoại riêng tư sở hữu bộ nhớ dài hạn về cuộc sống của bạn.</p>
<p>Với Miniapps, <strong>Halo</strong> cho phép bạn xây dựng các trải nghiệm mới bằng ngôn ngữ tự nhiên và chia sẻ chúng với mọi người trên App Store của chúng tôi.</p>
<p>&nbsp;</p>
<p>Tất cả các tính năng thông minh này đều được tích hợp sẵn khi mở hộp với hạn mức sử dụng hàng ngày miễn phí.</p>';

    $post_args = array(
        'post_title'   => $product_title,
        'post_name'    => 'halo',
        'post_content' => $product_content,
        'post_excerpt' => $product_excerpt,
        'post_status'  => 'publish',
        'post_type'    => 'product',
        'post_author'  => 1,
    );

    $product_id = wp_insert_post( $post_args );

    if ( $product_id && ! is_wp_error( $product_id ) ) {
        if ( $cat_id > 0 ) {
            wp_set_object_terms( $product_id, array( $cat_id ), 'product_cat' );
        }

        update_post_meta( $product_id, '_price', '299' );
        update_post_meta( $product_id, '_regular_price', '299' );
        update_post_meta( $product_id, '_sku', 'HALO-AI-01' );
        update_post_meta( $product_id, '_stock_status', 'instock' );
        update_post_meta( $product_id, '_manage_stock', 'no' );
        update_post_meta( $product_id, '_visibility', 'visible' );

        // Specs
        update_post_meta( $product_id, '_halo_weight', '40g' );
        update_post_meta( $product_id, '_halo_ipd', '58 - 72mm' );
        update_post_meta( $product_id, '_halo_diopter', '+2 đến -6 diopters' );
        update_post_meta( $product_id, '_halo_display_type', 'Màn hình màu (Color Display)' );
        update_post_meta( $product_id, '_halo_audio', 'Loa dẫn truyền qua xương kép' );
        update_post_meta( $product_id, '_halo_mic', 'Micro kép phát hiện hoạt động âm thanh' );
        update_post_meta( $product_id, '_halo_processor', 'Bộ xử lý AI siêu tiết kiệm điện năng' );
        update_post_meta( $product_id, '_halo_shipping_status', 'Halo sẽ bắt đầu được giao hàng trong thời gian tới 🚀' );

        // Attachments
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );

        $img_path = $theme_dir . '/site-assets/cdn/shop/files/Halo_1-11.png';
        if ( file_exists( $img_path ) && ! has_post_thumbnail( $product_id ) ) {
            $filename = basename( $img_path );
            $upload_file = wp_upload_bits( $filename, null, file_get_contents( $img_path ) );
            if ( ! $upload_file['error'] ) {
                $wp_filetype = wp_check_filetype( $filename, null );
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title'     => 'Halo Featured Image',
                    'post_content'   => '',
                    'post_status'    => 'inherit',
                );
                $attach_id = wp_insert_attachment( $attachment, $upload_file['file'], $product_id );
                $attach_data = wp_generate_attachment_metadata( $attach_id, $upload_file['file'] );
                wp_update_attachment_metadata( $attach_id, $attach_data );
                set_post_thumbnail( $product_id, $attach_id );
            }
        }
    }

    update_option( 'bl_halo_product_seed_locked_v1', 1 );
}
add_action( 'init', 'bl_seed_halo_product_only', 25 );
