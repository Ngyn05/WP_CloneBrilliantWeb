<?php
/**
 * Product Database Seeder for Halo Smart Glasses & Full Comprehensive Metaboxes
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function bl_seed_halo_product() {
    if ( get_option( 'bl_halo_product_initial_seeded_done' ) ) {
        return;
    }

    $theme_dir = get_template_directory();

    // 1. Create Product Category: Kính thông minh AI (smart-glasses)
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
                'description' => 'Dòng sản phẩm kính thông minh AI thế hệ mới từ Brilliant Labs.',
            )
        );
        if ( ! is_wp_error( $created ) ) {
            $cat_id = $created['term_id'];
        }
    }

    $product_title   = 'Halo – Kính thông minh AI';
    $product_excerpt = 'Kính thông minh AI thế hệ mới nhất với màn hình hiển thị màu sắc, hệ thống loa truyền xương kép và trợ lý AI riêng tư Noa sở hữu bộ nhớ dài hạn.';
    $product_content = '<h3 style="text-align: left;" dir="ltr"><span>Giới thiệu <span style="color: rgb(255, 0, 255);"><span style="color: rgb(242, 136, 191);"><strong>Halo</strong>! </span></span></span></h3>
<h5 dir="ltr" style="text-align: left;"><span>Kính AI mã nguồn mở dành cho những người tò mò, sáng tạo và có tầm nhìn tương lai.</span></h5>
<p><strong>Halo</strong> sở hữu thiết kế hoàn toàn mới, hệ thống quang học và linh kiện điện tử được tái định hình, cùng <strong>Noa</strong> — tác nhân AI đàm thoại riêng tư sở hữu bộ nhớ dài hạn về cuộc sống của bạn.</p>
<p>Với Miniapps, <strong>Halo</strong> cho phép bạn xây dựng các trải nghiệm mới bằng ngôn ngữ tự nhiên và chia sẻ chúng với mọi người trên App Store của chúng tôi.</p>
<p>&nbsp;</p>
<p>Tất cả các tính năng thông minh này đều được tích hợp sẵn khi mở hộp với hạn mức sử dụng hàng ngày miễn phí.</p>
<p class="p1">&nbsp;</p>
<p class="p1"><b>Những chiếc kính Halo đầu tiên đang hoàn thiện dây chuyền sản xuất và sẽ sớm được giao đến tay người dùng. 🚀</b></p>';

    $product_meta = array(
        '_regular_price'         => '299',
        '_price'                 => '299',
        '_sku'                   => 'HALO-AI-01',
        '_stock_status'          => 'instock',
        '_manage_stock'          => 'no',
        '_visibility'            => 'visible',
        // Group 1: Specs
        '_halo_weight'           => '40g',
        '_halo_ipd'              => '58 - 72mm',
        '_halo_diopter'          => '+2 đến -6 diopters',
        '_halo_display_type'     => 'Màn hình màu (Color Display)',
        '_halo_audio'            => 'Loa dẫn truyền qua xương kép (Dual bone conduction speakers)',
        '_halo_mic'              => 'Micro kép phát hiện hoạt động âm thanh (Dual mics + VAD)',
        '_halo_processor'        => 'Bộ xử lý AI siêu tiết kiệm điện năng',
        '_halo_3d_model_url'     => get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/glasses_v3-6a3aeba0.glb',
        '_halo_shipping_status'  => 'Halo sẽ bắt đầu được giao hàng trong thời gian tới 🚀',
        // Group 2: Banner & Partner Prescription
        '_halo_lens_card_text'   => 'Bạn cần lắp tròng kính cận theo đơn thuốc cho Halo? Nhấn vào liên kết bên dưới để đặt mua trực tiếp tại website đối tác SmartBuyGlasses của chúng tôi.',
        '_halo_lens_partner_url' => 'https://www.smartbuyglasses.com/designer-eyeglasses/Brilliant-Labs/Cut-Lens-for-Brilliant-Labs-Frame-2.html',
        '_halo_banner_img_url'   => get_template_directory_uri() . '/site-assets/cdn/shop/files/FrameLite_Back_v005.248.png',
        // Group 3: Optics & Dimensions
        '_halo_optic_text'       => 'Hệ thống quang học hiển thị của Halo có thể điều chỉnh linh hoạt từ +2 đến -6 diop, đáp ứng đa dạng các nhu cầu điều chỉnh tật khúc xạ thị lực của mắt.',
        '_halo_optic_img_url'    => get_template_directory_uri() . '/site-assets/cdn/shop/files/image_1.webp',
        '_halo_dimension_title'  => 'Kích thước Halo',
        '_halo_dimension_img_url'=> get_template_directory_uri() . '/site-assets/cdn/shop/files/HaloMeasure_9192bea1-1f7e-4921-9e68-7e15c3952c69.png',
        // Group 4: FAQs
        '_halo_faq_out_of_box'   => 'Halo rất hữu ích cho bất kỳ ai muốn tăng cường trí nhớ và đối thoại thông minh cùng AI về những gì bạn nhìn và nghe thấy, bao gồm cả tính năng dịch thuật tức thì giữa nhiều ngôn ngữ. Đối với các nhà phát triển, Halo là một nền tảng phần cứng và phần mềm mã nguồn mở để bạn tự do sáng tạo, phát triển nguyên mẫu thử nghiệm và mở rộng giới hạn của công nghệ.',
        '_halo_faq_developer'    => 'Sử dụng Brilliant SDK để xây dựng ứng dụng và đối với iOS và Android, chúng tôi có sẵn Flutter SDK. Toàn bộ tài liệu kỹ thuật của chúng tôi đều có sẵn trên trang web tại mục Nhà phát triển.',
        '_halo_faq_tax'          => 'Thuế và các loại phí không được thu tại thời điểm thanh toán. Chúng tôi khuyến nghị bạn nên tham khảo trước quy định của cơ quan hải quan địa phương để biết mức phí dự kiến. Mỗi quốc gia có mức thuế nhập khẩu hoặc thuế GTGT (VAT) khác nhau.',
        '_halo_faq_lenses'       => 'Hoàn toàn có thể! Khi bạn đặt mua Halo, chúng tôi sẽ cung cấp liên kết đến trang web đối tác SmartBuyGlasses để bạn đặt mua tròng kính. Hệ thống quang học hiển thị của Halo có thể điều chỉnh linh hoạt từ +2 đến -6 Diop để hỗ trợ độ khúc xạ thị lực của mắt.',
        '_halo_faq_returns'      => 'Nếu chiếc Halo của bạn bị hỏng, lỗi kỹ thuật hoặc lỗi sản xuất rõ ràng, chúng tôi rất sẵn lòng đổi mới cho bạn một sản phẩm khác. Đối với trường hợp đổi trả ngoài các lý do trên, chúng tôi sẽ hoàn tiền đầy đủ trừ đi phí lưu kho $49 và bạn sẽ chịu chi phí vận chuyển thiết bị trả lại cho chúng tôi. Bạn chỉ cần liên hệ với đội ngũ hỗ trợ của chúng tôi qua email contact@brilliantvietnam.com để bắt đầu quy trình đổi trả.',
    );

    $existing_product = get_page_by_path( 'halo', OBJECT, 'product' );
    $product_id = $existing_product ? $existing_product->ID : 0;

    if ( ! $product_id ) {
        $product_arr = array(
            'post_title'   => $product_title,
            'post_name'    => 'halo',
            'post_content' => $product_content,
            'post_excerpt' => $product_excerpt,
            'post_status'  => 'publish',
            'post_type'    => 'product',
            'post_author'  => 1,
        );
        $product_id = wp_insert_post( $product_arr );
    }

    if ( $product_id && ! is_wp_error( $product_id ) ) {
        // Save Categories
        if ( $cat_id > 0 ) {
            wp_set_object_terms( $product_id, array( $cat_id ), 'product_cat' );
        }

        // Save Meta
        foreach ( $product_meta as $key => $val ) {
            update_post_meta( $product_id, $key, $val );
        }

        // Setup Media Attachments: Featured Image & Full HD Gallery
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );

        // 1. Featured Image: Halo_1-11.png (2160x2160 HD)
        $featured_rel = 'site-assets/cdn/shop/files/Halo_1-11.png';
        $featured_path = $theme_dir . '/' . $featured_rel;
        if ( file_exists( $featured_path ) && ! has_post_thumbnail( $product_id ) ) {
            $filename = basename( $featured_path );
            $upload_file = wp_upload_bits( $filename, null, file_get_contents( $featured_path ) );
            if ( ! $upload_file['error'] ) {
                $wp_filetype = wp_check_filetype( $filename, null );
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title'     => 'Halo Main Featured HD Image',
                    'post_content'   => '',
                    'post_status'    => 'inherit',
                );
                $attach_id = wp_insert_attachment( $attachment, $upload_file['file'], $product_id );
                $attach_data = wp_generate_attachment_metadata( $attach_id, $upload_file['file'] );
                wp_update_attachment_metadata( $attach_id, $attach_data );
                set_post_thumbnail( $product_id, $attach_id );
            }
        }

        // 2. Product Gallery Full HD Images (2160x2160)
        if ( ! get_option( 'bl_product_comprehensive_seeded_v4' ) ) {
            $gallery_files = array(
                'site-assets/cdn/shop/files/Halo_1-11.png',
                'site-assets/cdn/shop/files/Halo_3b-11.png',
                'site-assets/cdn/shop/files/Halo_6b-11.png',
                'site-assets/cdn/shop/files/IMG_1348-11.jpg',
                'site-assets/cdn/shop/files/IMG_3255-11.jpg',
                'site-assets/cdn/shop/files/IMG_1253-11.jpg',
                'site-assets/cdn/shop/files/IMG_1350-10.jpg',
            );

            $gallery_ids = array();
            foreach ( $gallery_files as $grel ) {
                $gpath = $theme_dir . '/' . $grel;
                if ( file_exists( $gpath ) ) {
                    $gfilename = basename( $gpath );
                    $gupload = wp_upload_bits( $gfilename, null, file_get_contents( $gpath ) );
                    if ( ! $gupload['error'] ) {
                        $gfiletype = wp_check_filetype( $gfilename, null );
                        $gattachment = array(
                            'post_mime_type' => $gfiletype['type'],
                            'post_title'     => sanitize_file_name( $gfilename ),
                            'post_content'   => '',
                            'post_status'    => 'inherit',
                        );
                        $gattach_id = wp_insert_attachment( $gattachment, $gupload['file'], $product_id );
                        $gattach_data = wp_generate_attachment_metadata( $gattach_id, $gupload['file'] );
                        wp_update_attachment_metadata( $gattach_id, $gattach_data );
                        $gallery_ids[] = $gattach_id;
                    }
                }
            }

            if ( ! empty( $gallery_ids ) ) {
                update_post_meta( $product_id, '_product_image_gallery', implode( ',', $gallery_ids ) );
            }

            update_option( 'bl_halo_product_initial_seeded_done', 1 );
            update_option( 'bl_product_comprehensive_seeded_v4', 1 );
        }
    }
}
add_action( 'init', 'bl_seed_halo_product', 25 );
