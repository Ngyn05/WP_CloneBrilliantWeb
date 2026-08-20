<?php
/**
 * Custom Metaboxes for Brilliant Labs Posts
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Custom Meta Box for Posts
 */
function brilliant_register_post_metaboxes() {
    add_meta_box(
        'bl_post_details',
        __( 'Thông tin mở rộng bài viết (Brilliant Labs)', 'brilliant' ),
        'bl_render_post_metaboxes',
        'post',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'brilliant_register_post_metaboxes' );

/**
 * Render Meta Box HTML
 */
function bl_render_post_metaboxes( $post ) {
    wp_nonce_field( 'bl_save_post_meta', 'bl_post_meta_nonce' );

    $author_name = get_post_meta( $post->ID, '_bl_author_name', true );
    $hero_subtitle = get_post_meta( $post->ID, '_bl_hero_subtitle', true );
    $video_url = get_post_meta( $post->ID, '_bl_video_url', true );
    ?>
    <div style="padding: 10px 0;">
        <p>
            <label for="bl_author_name"><strong><?php _e( 'Tên tác giả bài viết:', 'brilliant' ); ?></strong></label><br>
            <input type="text" id="bl_author_name" name="bl_author_name" value="<?php echo esc_attr( $author_name ); ?>" style="width: 100%; max-width: 500px;" placeholder="Ví dụ: Sam Khorshid, CitizenOne..." />
            <br><small><?php _e( 'Hiển thị trên giao diện và trong cấu trúc dữ liệu SEO Schema Article.', 'brilliant' ); ?></small>
        </p>

        <p>
            <label for="bl_hero_subtitle"><strong><?php _e( 'Tiêu đề phụ / Ghi chú Hero (Tùy chọn):', 'brilliant' ); ?></strong></label><br>
            <input type="text" id="bl_hero_subtitle" name="bl_hero_subtitle" value="<?php echo esc_attr( $hero_subtitle ); ?>" style="width: 100%; max-width: 500px;" />
        </p>

        <p>
            <label for="bl_video_url"><strong><?php _e( 'Link Video đính kèm (Tùy chọn):', 'brilliant' ); ?></strong></label><br>
            <input type="url" id="bl_video_url" name="bl_video_url" value="<?php echo esc_url( $video_url ); ?>" style="width: 100%; max-width: 500px;" placeholder="https://www.youtube.com/watch?v=..." />
        </p>
    </div>
    <?php
}

/**
 * Save Meta Box Data
 */
function bl_save_post_metaboxes( $post_id ) {
    if ( ! isset( $_POST['bl_post_meta_nonce'] ) || ! wp_verify_nonce( $_POST['bl_post_meta_nonce'], 'bl_save_post_meta' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['bl_author_name'] ) ) {
        update_post_meta( $post_id, '_bl_author_name', sanitize_text_field( $_POST['bl_author_name'] ) );
    }

    if ( isset( $_POST['bl_hero_subtitle'] ) ) {
        update_post_meta( $post_id, '_bl_hero_subtitle', sanitize_text_field( $_POST['bl_hero_subtitle'] ) );
    }

    if ( isset( $_POST['bl_video_url'] ) ) {
        update_post_meta( $post_id, '_bl_video_url', esc_url_raw( $_POST['bl_video_url'] ) );
    }
}
add_action( 'save_post', 'bl_save_post_metaboxes' );
