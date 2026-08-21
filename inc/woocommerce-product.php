<?php
/**
 * WooCommerce & Custom Product Features with Pure N/A Fallback and Solid CRUD Saving
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// 1. Declare WooCommerce Theme Support
function bl_woocommerce_theme_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'bl_woocommerce_theme_support' );

// 2. Register Post Type 'product' if WooCommerce plugin is not active
function bl_register_product_cpt_fallback() {
    if ( ! post_type_exists( 'product' ) ) {
        $labels = array(
            'name'               => __( 'Sản phẩm', 'brilliant' ),
            'singular_name'      => __( 'Sản phẩm', 'brilliant' ),
            'add_new'            => __( 'Thêm sản phẩm mới', 'brilliant' ),
            'add_new_item'       => __( 'Thêm sản phẩm mới', 'brilliant' ),
            'edit_item'          => __( 'Chỉnh sửa sản phẩm', 'brilliant' ),
            'new_item'           => __( 'Sản phẩm mới', 'brilliant' ),
            'view_item'          => __( 'Xem sản phẩm', 'brilliant' ),
            'search_items'       => __( 'Tìm kiếm sản phẩm', 'brilliant' ),
            'not_found'          => __( 'Không tìm thấy sản phẩm nào', 'brilliant' ),
            'menu_name'          => __( 'Sản phẩm', 'brilliant' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'products' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 5,
            'menu_icon'          => 'dashicons-cart',
            'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        );

        register_post_type( 'product', $args );

        register_taxonomy(
            'product_cat',
            'product',
            array(
                'label'        => __( 'Danh mục sản phẩm', 'brilliant' ),
                'rewrite'      => array( 'slug' => 'product-category' ),
                'hierarchical' => true,
            )
        );
    }
}
add_action( 'init', 'bl_register_product_cpt_fallback', 5 );

// 3. Inject Front-End Theme Styles into TinyMCE Editor (WYSIWYG Dark Theme Preview)
function bl_tinymce_custom_styles( $mceInit ) {
    $custom_css = "
        body#tinymce {
            background-color: #000000 !important;
            color: #ffffff !important;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif !important;
            padding: 30px !important;
            line-height: 1.6 !important;
        }
        body#tinymce a {
            color: #58a6ff;
        }
        body#tinymce .multiblock-grid, body#tinymce .tw-grid {
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 24px !important;
            margin-bottom: 40px !important;
        }
        body#tinymce .tw-bg-darkBg, body#tinymce [style*='background: #161616'], body#tinymce [style*='background:#161616'] {
            background: #161616 !important;
            border-radius: 16px !important;
            padding: 30px !important;
            color: #ffffff !important;
            position: relative !important;
            overflow: hidden !important;
            border: 1px solid #262626 !important;
        }
        body#tinymce .tw-text-\[30px\] {
            font-size: 24px !important;
            line-height: 1.4 !important;
            color: #ffffff !important;
            margin: 0 !important;
        }
        body#tinymce .tw-bg-white, body#tinymce a[href*='smartbuyglasses'] {
            background: #ffffff !important;
            color: #000000 !important;
            border-radius: 40px !important;
            padding: 12px 24px !important;
            text-decoration: none !important;
            font-weight: 600 !important;
            display: inline-block !important;
            margin-top: 15px !important;
        }
        body#tinymce img {
            max-width: 100% !important;
            height: auto !important;
            border-radius: 8px !important;
        }
        body#tinymce details {
            background: #161616 !important;
            border-radius: 8px !important;
            padding: 16px 20px !important;
            margin-bottom: 12px !important;
            border: 1px solid #282828 !important;
            color: #ffffff !important;
        }
        body#tinymce summary {
            font-size: 17px !important;
            font-weight: 600 !important;
            color: #ffffff !important;
            cursor: pointer !important;
        }
        body#tinymce h2, body#tinymce h3, body#tinymce h4 {
            color: #ffffff !important;
            margin-top: 0 !important;
        }
    ";

    $custom_css = trim( preg_replace( '/\s+/', ' ', $custom_css ) );

    if ( isset( $mceInit['content_style'] ) ) {
        $mceInit['content_style'] .= ' ' . $custom_css;
    } else {
        $mceInit['content_style'] = $custom_css;
    }

    return $mceInit;
}
add_filter( 'tiny_mce_before_init', 'bl_tinymce_custom_styles' );

// 4. Stock Status Helper Function (Syncs directly with WooCommerce or Database Post Meta)
function bl_get_product_stock_info( $product_id ) {
    if ( ! $product_id ) {
        return array(
            'status'    => 'instock',
            'text'      => 'Còn hàng',
            'badge_cls' => 'bl-stock-badge--instock',
            'dot_color' => '#22c55e',
            'available' => true,
        );
    }

    if ( function_exists( 'wc_get_product' ) ) {
        $wc_product = wc_get_product( $product_id );
        if ( $wc_product ) {
            $is_in_stock = $wc_product->is_in_stock();
            $status      = $wc_product->get_stock_status(); // 'instock', 'outofstock', 'onbackorder'
            $qty         = $wc_product->get_stock_quantity();

            if ( $status === 'outofstock' || ! $is_in_stock ) {
                return array(
                    'status'    => 'outofstock',
                    'text'      => 'Hết hàng',
                    'badge_cls' => 'bl-stock-badge--out',
                    'dot_color' => '#ef4444',
                    'available' => false,
                );
            } elseif ( $status === 'onbackorder' ) {
                return array(
                    'status'    => 'onbackorder',
                    'text'      => 'Đặt trước',
                    'badge_cls' => 'bl-stock-badge--backorder',
                    'dot_color' => '#f59e0b',
                    'available' => true,
                );
            } else {
                $text = 'Còn hàng';
                if ( $qty && intval( $qty ) > 0 ) {
                    $text = 'Còn hàng (' . intval( $qty ) . ')';
                }
                return array(
                    'status'    => 'instock',
                    'text'      => $text,
                    'badge_cls' => 'bl-stock-badge--instock',
                    'dot_color' => '#22c55e',
                    'available' => true,
                );
            }
        }
    }

    // Direct database post meta fallback
    $meta_stock = get_post_meta( $product_id, '_stock_status', true );
    $meta_qty   = get_post_meta( $product_id, '_stock', true );

    if ( $meta_stock === 'outofstock' ) {
        return array(
            'status'    => 'outofstock',
            'text'      => 'Hết hàng',
            'badge_cls' => 'bl-stock-badge--out',
            'dot_color' => '#ef4444',
            'available' => false,
        );
    } elseif ( $meta_stock === 'onbackorder' ) {
        return array(
            'status'    => 'onbackorder',
            'text'      => 'Đặt trước',
            'badge_cls' => 'bl-stock-badge--backorder',
            'dot_color' => '#f59e0b',
            'available' => true,
        );
    } else {
        $text = 'Còn hàng';
        if ( ! empty( $meta_qty ) && intval( $meta_qty ) > 0 ) {
            $text = 'Còn hàng (' . intval( $meta_qty ) . ')';
        }
        return array(
            'status'    => 'instock',
            'text'      => $text,
            'badge_cls' => 'bl-stock-badge--instock',
            'dot_color' => '#22c55e',
            'available' => true,
        );
    }
}

// 5. Register Custom Metabox for Product
function bl_register_product_metaboxes( $post_type = '', $post = null ) {
    add_meta_box(
        'bl_product_body_editor',
        __( 'Trình soạn thảo nội dung trực quan chi tiết sản phẩm (Visual Editor)', 'brilliant' ),
        'bl_render_product_visual_metabox',
        'product',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'bl_register_product_metaboxes', 10, 2 );

// Helper function to return default rich content for Halo
function bl_get_default_product_layout_content() {
    $theme_uri = get_template_directory_uri();
    return '<div class="container multiblock" style="padding-top: 40px; padding-bottom: 40px;">
  <div class="multiblock-grid tw-grid md:tw-grid-cols-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
    <div class="tw-bg-darkBg" style="background: #161616; border-radius: 16px; padding: 30px; display: flex; align-items: center; justify-content: center;">
      <img src="' . esc_url( $theme_uri . '/site-assets/cdn/shop/files/FrameLite_Back_v005.248.png' ) . '" alt="" style="width: 100%; height: auto; object-fit: cover;" />
    </div>
    <div class="tw-bg-darkBg" style="background: #161616; border-radius: 16px; padding: 40px; display: flex; flex-direction: column; justify-content: space-between; gap: 20px;">
      <p class="tw-text-[30px]" style="font-size: 24px; line-height: 1.5; color: #ffffff; margin: 0;">Bạn cần lắp tròng kính cận theo đơn thuốc cho <strong>Halo</strong>? Nhấn vào bên dưới để đặt mua trên trang đối tác</p>
      <p><a class="tw-bg-white" href="https://www.smartbuyglasses.com/designer-eyeglasses/Brilliant-Labs/Cut-Lens-for-Brilliant-Labs-Frame-2.html" target="_blank" style="background: #ffffff; color: #000000; padding: 12px 24px; border-radius: 40px; text-decoration: none; font-weight: 600; display: inline-block;">SmartBuyGlasses &rarr;</a></p>
    </div>
  </div>
</div>

<div class="container gallery-container" style="padding-top: 30px; padding-bottom: 40px;">
  <div class="tw-grid md:tw-grid-cols-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
    <div class="tw-bg-darkBg" style="background: #161616; border-radius: 16px; padding: 30px; display: flex; align-items: center; justify-content: center;">
      <img src="' . esc_url( $theme_uri . '/site-assets/cdn/shop/files/image_1.webp' ) . '" alt="" style="max-width: 100%; height: auto; border-radius: 8px;" />
    </div>
    <div class="tw-bg-darkBg" style="background: #161616; border-radius: 16px; padding: 40px; display: flex; align-items: center;">
      <p class="tw-text-[30px]" style="font-size: 24px; line-height: 1.5; color: #ffffff; margin: 0;">Hệ thống quang học hiển thị của Halo có thể điều chỉnh từ <strong>+2 đến -6 diop</strong>, đáp ứng đa dạng các nhu cầu điều chỉnh tật khúc xạ thị lực.</p>
    </div>
  </div>
</div>

<div class="container gallery-container" style="padding-top: 30px; padding-bottom: 40px;">
  <div class="tw-grid md:tw-grid-cols-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
    <div class="tw-bg-darkBg" style="background: #161616; border-radius: 16px; padding: 40px; display: flex; align-items: center;">
      <h3 style="font-size: 28px; color: #ffffff; margin: 0;">Kích thước Halo</h3>
    </div>
    <div class="tw-bg-darkBg" style="background: #161616; border-radius: 16px; padding: 30px; display: flex; align-items: center; justify-content: center;">
      <img src="' . esc_url( $theme_uri . '/site-assets/cdn/shop/files/HaloMeasure_9192bea1-1f7e-4921-9e68-7e15c3952c69.png' ) . '" alt="" style="max-width: 100%; height: auto; border-radius: 8px;" />
    </div>
  </div>
</div>

<div class="accordions color-scheme--default" style="padding-top: 40px; padding-bottom: 60px;">
  <div class="container container--default">
    <h2 style="color: #ffffff; font-size: 26px; margin-bottom: 24px; border-bottom: 1px solid #333; padding-bottom: 12px;">Câu hỏi thường gặp</h2>
    
    <div class="accordion">
      <details style="background: #161616; border-radius: 8px; padding: 16px 20px; margin-bottom: 12px; border: 1px solid #282828;">
        <summary style="font-size: 18px; font-weight: 600; color: #ffffff; cursor: pointer;">Thông số thiết bị</summary>
        <div style="margin-top: 12px; color: #cccccc; line-height: 1.7;"><p>Halo được thiết kế để vừa vặn với hầu hết mọi người. Thiết bị chỉ nặng hơn 40g và với mức sử dụng thông thường ước tính có thể đạt thời lượng pin cả ngày. Tích hợp màn hình màu, cảm biến quang học cho AI, micro kép lọc âm và loa dẫn truyền qua xương kép.<br>Khoảng cách đồng tử (IPD) từ 58-72mm.</p></div>
      </details>
    </div>

    <div class="accordion">
      <details style="background: #161616; border-radius: 8px; padding: 16px 20px; margin-bottom: 12px; border: 1px solid #282828;">
        <summary style="font-size: 18px; font-weight: 600; color: #ffffff; cursor: pointer;">Vận chuyển</summary>
        <div style="margin-top: 12px; color: #cccccc; line-height: 1.7;"><p>Halo sẽ bắt đầu được giao hàng trong thời gian tới 🚀</p></div>
      </details>
    </div>

    <div class="accordion">
      <details style="background: #161616; border-radius: 8px; padding: 16px 20px; margin-bottom: 12px; border: 1px solid #282828;">
        <summary style="font-size: 18px; font-weight: 600; color: #ffffff; cursor: pointer;">Halo có thể làm gì ngay khi xuất xưởng?</summary>
        <div style="margin-top: 12px; color: #cccccc; line-height: 1.7;"><p>Halo rất hữu ích cho bất kỳ ai muốn tăng cường trí nhớ và đối thoại thông minh cùng AI về những gì bạn nhìn và nghe thấy, bao gồm cả tính năng dịch thuật tức thì giữa nhiều ngôn ngữ. Đối với các nhà phát triển, Halo là một nền tảng phần cứng và phần mềm mã nguồn mở.</p></div>
      </details>
    </div>

    <div class="accordion">
      <details style="background: #161616; border-radius: 8px; padding: 16px 20px; margin-bottom: 12px; border: 1px solid #282828;">
        <summary style="font-size: 18px; font-weight: 600; color: #ffffff; cursor: pointer;">Làm thế nào để phát triển cho Halo?</summary>
        <div style="margin-top: 12px; color: #cccccc; line-height: 1.7;"><p>Sử dụng Brilliant SDK để xây dựng ứng dụng và đối với iOS và Android, chúng tôi có sẵn Flutter SDK. Toàn bộ tài liệu kỹ thuật có sẵn tại trang Nhà phát triển.</p></div>
      </details>
    </div>

    <div class="accordion">
      <details style="background: #161616; border-radius: 8px; padding: 16px 20px; margin-bottom: 12px; border: 1px solid #282828;">
        <summary style="font-size: 18px; font-weight: 600; color: #ffffff; cursor: pointer;">Thuế & phí hải quan?</summary>
        <div style="margin-top: 12px; color: #cccccc; line-height: 1.7;"><p>Thuế và các loại phí không được thu tại thời điểm thanh toán. Chúng tôi khuyến nghị bạn nên tham khảo trước quy định của cơ quan hải quan địa phương để biết mức phí dự kiến.</p></div>
      </details>
    </div>

    <div class="accordion">
      <details style="background: #161616; border-radius: 8px; padding: 16px 20px; margin-bottom: 12px; border: 1px solid #282828;">
        <summary style="font-size: 18px; font-weight: 600; color: #ffffff; cursor: pointer;">Có hỗ trợ tròng kính cận hoặc kính râm không?</summary>
        <div style="margin-top: 12px; color: #cccccc; line-height: 1.7;"><p>Hoàn toàn có thể! Khi bạn đặt mua Halo, chúng tôi sẽ cung cấp liên kết đến trang web đối tác SmartBuyGlasses để bạn đặt mua tròng kính. Hệ thống quang học hiển thị của Halo có thể điều chỉnh linh hoạt từ +2 đến -6 Diop.</p></div>
      </details>
    </div>

    <div class="accordion">
      <details style="background: #161616; border-radius: 8px; padding: 16px 20px; margin-bottom: 12px; border: 1px solid #282828;">
        <summary style="font-size: 18px; font-weight: 600; color: #ffffff; cursor: pointer;">Chính sách đổi trả là gì?</summary>
        <div style="margin-top: 12px; color: #cccccc; line-height: 1.7;"><p>Nếu chiếc Halo của bạn bị hỏng, lỗi kỹ thuật hoặc lỗi sản xuất rõ ràng, chúng tôi rất sẵn lòng đổi mới cho bạn một sản phẩm khác. Bạn chỉ cần liên hệ với đội ngũ hỗ trợ của chúng tôi qua email contact@brilliantvietnam.com để bắt đầu quy trình đổi trả.</p></div>
      </details>
    </div>
  </div>
</div>';
}

// 6. Render ONE Unified Visual Editor
function bl_render_product_visual_metabox( $post ) {
    $body_content = get_post_meta( $post->ID, '_bl_product_body_content', true );
    if ( empty( $body_content ) && $post->post_name === 'halo' ) {
        $body_content = bl_get_default_product_layout_content();
    }

    echo '<div style="padding: 10px 0;">';
    wp_editor(
        $body_content,
        'bl_product_body_content',
        array(
            'textarea_name' => '_bl_product_body_content',
            'textarea_rows' => 22,
            'media_buttons' => true,
            'teeny'         => false,
            'quicktags'     => true,
        )
    );
    echo '<p class="description" style="margin-top: 8px; color: #666;">Trình soạn thảo trực quan (Visual Editor) Dark Mode. Đối với sản phẩm mới, nếu để trống thì ngoài giao diện sẽ hiển thị N/A.</p>';
    echo '</div>';
}

// 7. Save Product Meta Data
function bl_save_product_metaboxes( $post_id, $post = null ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
        $post_id = $parent_id;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( get_post_type( $post_id ) !== 'product' ) {
        return;
    }

    if ( isset( $_POST['_bl_product_body_content'] ) ) {
        update_post_meta( $post_id, '_bl_product_body_content', wp_kses_post( wp_unslash( $_POST['_bl_product_body_content'] ) ) );
    }

    clean_post_cache( $post_id );
}
add_action( 'save_post_product', 'bl_save_product_metaboxes', 10, 2 );
add_action( 'save_post', 'bl_save_product_metaboxes', 10, 2 );

// 8. Render Header Buy Button with Compact Hover Submenu
function bl_render_header_buy_button( $is_mobile = false ) {
    $all_products = get_posts( array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );
    ?>
    <div class="bl-nav-buy-wrap">
        <?php if ( $is_mobile ) : ?>
            <a class="tw-z-[10] tw-flex tw-items-center tw-justify-center tw-rounded-[40px] tw-border tw-border-white tw-px-4 tw-py-2 tw-text-xs tw-font-bold tw-uppercase tw-text-white hover:tw-bg-white/[0.7] hover:tw-text-black md:tw-px-11 md:tw-py-4 md:tw-text-sm" href="<?php echo esc_url( home_url( '/products/halo/' ) ); ?>" data-buy-button="ĐẶT HÀNG ngay">
                ĐẶT HÀNG ngay
            </a>
        <?php else : ?>
            <a class="tw-z-[10] tw-items-center tw-justify-center tw-rounded-[40px] tw-border tw-border-pink tw-px-4 tw-py-2 tw-text-xs tw-font-bold tw-uppercase tw-text-white hover:tw-bg-pink hover:tw-text-white hover:tw-opacity-100 md:tw-px-11 md:tw-py-4 md:tw-text-sm tw-flex" href="<?php echo esc_url( home_url( '/products/halo/' ) ); ?>" data-buy-button="ĐẶT HÀNG ngay">
                ĐẶT HÀNG ngay
            </a>
        <?php endif; ?>

        <!-- Compact Submenu on Hover -->
        <div class="bl-sub-dropdown">
            <div class="bl-sub-list">
                <?php if ( ! empty( $all_products ) ) : ?>
                    <?php foreach ( $all_products as $p ) : 
                        $p_price = get_post_meta( $p->ID, '_regular_price', true ) ?: get_post_meta( $p->ID, '_price', true );
                        if ( $p_price !== '' && $p_price !== false && $p_price !== 'N/A' ) {
                            $num_p = floatval( preg_replace( '/[^0-9.]/', '', (string) $p_price ) );
                            $p_price_txt = number_format( $num_p, 0, ',', '.' ) . ' ₫';
                        } else {
                            $p_price_txt = '';
                        }
                        $p_url = get_permalink( $p->ID );
                    ?>
                        <a href="<?php echo esc_url( $p_url ); ?>" class="bl-sub-item">
                            <span class="bl-sub-title"><?php echo esc_html( $p->post_title ); ?></span>
                            <?php if ( $p_price_txt ) : ?>
                                <span class="bl-sub-price"><?php echo esc_html( $p_price_txt ); ?></span>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/product/halo/' ) ); ?>" class="bl-sub-item">
                        <span class="bl-sub-title">Halo</span>
                        <span class="bl-sub-price">8.867.000 ₫</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
}
