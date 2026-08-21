<?php
/**
 * Database Page Seeder for Brilliant Labs Vietnam
 * Seeds all standard WordPress Pages into wp_posts database with full rich text.
 * NOTE: Runs once to populate full database, then locks to protect user edits!
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function bl_seed_database_pages() {
    // Lock permanently so user edits in Admin are 100% preserved
    if ( get_option( 'bl_pages_rich_content_synced_v3' ) ) {
        return;
    }

    $pages_to_seed = array(
        array(
            'slug'        => 'home',
            'title'       => 'Trang chủ – Brilliant Việt Nam',
            'template'    => 'index-htm.php',
            'content'     => 'Chào mừng bạn đến với Brilliant Việt Nam – Nền tảng kính thông minh AI và thiết bị công nghệ mở thế hệ mới.',
            'excerpt'     => 'Kính thông minh AI, công nghệ mở và tương lai của điện toán thị giác cá nhân.',
            'is_home'     => true,
        ),
        array(
            'slug'        => 'developers',
            'title'       => 'Nhà phát triển (Developers)',
            'template'    => 'pages-developers-html.php',
            'content'     => '<h3>Nền tảng mở dành cho Nhà phát triển</h3>
<p>Chào mừng bạn đến với trung tâm phát triển của Brilliant Labs. Tại đây bạn có thể tìm thấy toàn bộ mã nguồn mở phần cứng, firmware Bluetooth LE, SDK Python và ứng dụng di động cho kính thông minh Halo và Frame.</p>
<h4>Tài nguyên SDK & Mã nguồn:</h4>
<ul>
<li><strong>Python SDK:</strong> Thư viện kết nối và điều khiển kính qua Bluetooth Low Energy (<a href="https://github.com/brilliantlabsAR/frame-codebase" target="_blank" rel="noopener">GitHub Repository</a>).</li>
<li><strong>Miniapps Framework:</strong> Tạo ứng dụng AI giọng nói và giao diện quang học bằng ngôn ngữ tự nhiên.</li>
<li><strong>Noa AI Integration:</strong> Tích hợp các mô hình ngôn ngữ lớn (LLM) và hệ thống bộ nhớ dài hạn.</li>
</ul>
<p>Tham gia cộng đồng lập trình viên trên Discord để cùng thảo luận và xây dựng tương lai của công nghệ thị giác!</p>',
            'excerpt'     => 'Tài liệu kỹ thuật mở và SDK đa nền tảng cho cộng đồng lập trình viên Brilliant.',
            'is_home'     => false,
        ),
        array(
            'slug'        => 'contact',
            'title'       => 'Liên hệ với chúng tôi',
            'template'    => 'pages-contact-html.php',
            'content'     => '<p>Chúng tôi luôn sẵn sàng lắng nghe ý kiến đóng góp, giải đáp thắc mắc và hỗ trợ đối tác & cộng đồng nhà phát triển.</p>
<p><strong>Hotline tổng đài:</strong> 1900.63.8400<br>
<strong>Email hỗ trợ & Đối tác:</strong> <a href="mailto:contact@brilliantvietnam.com">contact@brilliantvietnam.com</a></p>
<p><strong>Hệ thống văn phòng đại diện:</strong><br>
• Văn phòng Hà Nội: Số 226 Đường Láng, P. Thịnh Quang, Q. Đống Đa, Hà Nội<br>
• Văn phòng TP. Hồ Chí Minh: Số 137 Đường Hòa Hưng, P. Hòa Hưng, TP. Hồ Chí Minh</p>',
            'excerpt'     => 'Thông tin liên hệ, hotline tổng đài 1900.63.8400 và hệ thống văn phòng chi nhánh.',
            'is_home'     => false,
        ),
        array(
            'slug'        => 'privacy-policy',
            'title'       => 'Chính sách bảo mật',
            'template'    => 'pages-privacy-policy-html.php',
            'content'     => '<p class="p1"><b>BRILLIANT LABS - CHÍNH SÁCH BẢO MẬT</b></p>
<p class="p1"><i>Ngày cập nhật lần cuối: Ngày 5 tháng 12 năm 2025</i></p>
<p class="p1">Brilliant Labs Pte. Ltd. (UEN: 202316146G), một công ty được thành lập theo luật pháp Singapore (“<b>Brilliant</b>,” “<b>Công ty</b>,” “<b>chúng tôi</b>”), tôn trọng quyền riêng tư của bạn và cam kết bảo vệ mọi thông tin chúng tôi thu thập từ hoặc về bạn.</p>
<p class="p1">Chính sách Bảo mật này giải thích cách Brilliant thu thập, sử dụng, tiết lộ và bảo vệ thông tin khi bạn sử dụng các thiết bị kính thông minh AI của chúng tôi (bao gồm Halo, Frame, Monocle và các phiên bản tiếp theo), các tác nhân AI tích hợp (bao gồm Noa), ứng dụng di động và các dịch vụ nền tảng đám mây (gọi chung là “<b>Sản phẩm và Dịch vụ</b>”).</p>
<p class="p1">Brilliant tuân thủ các nguyên tắc bảo vệ quyền riêng tư theo luật pháp hiện hành, bao gồm Quy định chung về bảo vệ dữ liệu của Liên minh Châu Âu (EU GDPR), UK GDPR, Đạo luật quyền riêng tư của người tiêu dùng California (CCPA/CPRA) và Đạo luật bảo vệ dữ liệu cá nhân của Singapore (PDPA).</p>

<p class="p1"><b>1. Thông tin quan trọng và chúng tôi là ai</b></p>
<p class="p1">Brilliant Labs Pte. Ltd. là đơn vị kiểm soát dữ liệu (Data Controller) chịu trách nhiệm về thông tin cá nhân được thu thập qua Sản phẩm và Dịch vụ. Mọi câu hỏi hoặc yêu cầu thực thi quyền riêng tư, vui lòng liên hệ qua email: <a href="mailto:contact@brilliantvietnam.com">contact@brilliantvietnam.com</a>.</p>

<p class="p1"><b>2. Dữ liệu chúng tôi thu thập về bạn</b></p>
<ul>
<li><b>Dữ liệu trực tiếp:</b> Họ tên, địa chỉ email, địa chỉ thanh toán/giao hàng, thông tin tài khoản và tin nhắn hỗ trợ.</li>
<li><b>Dữ liệu kỹ thuật & Cảm biến:</b> Địa chỉ IP, hướng nhìn, cảm biến cử chỉ chạm gọng kính, chuyển động 6 trục IMU.</li>
<li><b>Dữ liệu Âm thanh & Hình ảnh:</b> Giọng nói và hình ảnh khi bạn kích hoạt tác nhân AI Noa.</li>
<li><b>Bộ nhớ AI (Narrative Memory):</b> Ngữ cảnh đàm thoại được mã hóa an toàn, người dùng có toàn quyền xem hoặc xóa trong app.</li>
</ul>

<p class="p1"><b>3. Bảo mật và Quyền của người dùng</b></p>
<p class="p1">Dữ liệu cá nhân được mã hóa đầu cuối TLS 1.3. Người dùng có đầy đủ các quyền: Quyền truy cập dữ liệu, Quyền chỉnh sửa, Quyền yêu cầu xóa dữ liệu và Quyền rút lại sự đồng ý bất kỳ lúc nào.</p>

<p class="p1"><b>Thông tin liên hệ:</b><br>
Công ty Brilliant Việt Nam<br>
Văn phòng Hà Nội: Số 226 Đường Láng, P. Thịnh Quang, Q. Đống Đa, Hà Nội<br>
Văn phòng TP. HCM: Số 137 Đường Hòa Hưng, P. Hòa Hưng, TP. Hồ Chí Minh<br>
Hotline: 1900.63.8400 | Email: <a href="mailto:contact@brilliantvietnam.com">contact@brilliantvietnam.com</a></p>',
            'excerpt'     => 'Quy định bảo mật và cam kết bảo vệ dữ liệu người dùng tại Brilliant Việt Nam.',
            'is_home'     => false,
        ),
        array(
            'slug'        => 'terms-conditions',
            'title'       => 'Điều khoản dịch vụ',
            'template'    => 'pages-terms-conditions-html.php',
            'content'     => '<p class="p1"><b>Brilliant Labs - Điều khoản Dịch vụ</b></p>
<p class="p2"><i>Ngày cập nhật lần cuối: Ngày 5 tháng 12 năm 2025</i></p>
<p class="p2"><b>Chấp thuận và Đồng ý với Điều khoản Dịch vụ</b></p>
<p class="p2">Brilliant Labs Pte. Ltd. (UEN: 202316146G), một công ty được thành lập theo luật pháp Singapore (“<b>Brilliant</b>,” “<b>Công ty</b>,” “<b>chúng tôi</b>”), cung cấp các sản phẩm, dịch vụ và nội dung liên quan thông qua các thiết bị kính thông minh AI (bao gồm Halo, Frame, Monocle và các phiên bản tiếp theo), tác nhân AI tích hợp và các dịch vụ nền tảng (bao gồm Noa), ứng dụng di động trên các kho ứng dụng, phụ kiện và công nghệ liên quan.</p>

<p class="p4"><b>1. SỬ DỤNG SẢN PHẨM VÀ DỊCH VỤ</b></p>
<p class="p2">Công ty cấp cho bạn quyền và giấy phép có giới hạn, không độc quyền, có thể thu hồi để sử dụng Sản phẩm và Dịch vụ cho mục đích cá nhân phi thương mại. Bạn phải từ đủ 18 tuổi trở lên để sử dụng dịch vụ.</p>

<p class="p4"><b>2. CÁC HÀNH VI BỊ CẤM</b></p>
<ul>
<li>Sử dụng thiết bị khi đang lái xe hoặc vận hành máy móc hạng nặng đòi hỏi sự chú ý an toàn.</li>
<li>Sử dụng sản phẩm cho mục đích quay lén, giám sát trái phép hoặc vi phạm quyền riêng tư của người khác.</li>
<li>Dịch ngược, đảo ngược kỹ thuật mã nguồn độc quyền của hệ thống.</li>
</ul>

<p class="p4"><b>3. LUẬT ĐIỀU CHỈNH VÀ LIÊN HỆ</b></p>
<p class="p2">Điều khoản này được điều chỉnh theo luật pháp Singapore. Mọi tranh chấp sẽ được giải quyết bằng trọng tài tại Trung tâm Trọng tài Quốc tế Singapore (SIAC).</p>
<p class="p1"><b>Công ty Brilliant Việt Nam</b><br>
Văn phòng Hà Nội: Số 226 Đường Láng, P. Thịnh Quang, Q. Đống Đa, Hà Nội<br>
Văn phòng TP. HCM: Số 137 Đường Hòa Hưng, P. Hòa Hưng, TP. Hồ Chí Minh<br>
Hotline: 1900.63.8400 | Email: <a href="mailto:contact@brilliantvietnam.com">contact@brilliantvietnam.com</a></p>',
            'excerpt'     => 'Điều khoản sử dụng và quy định pháp lý của Brilliant Việt Nam.',
            'is_home'     => false,
        ),
        array(
            'slug'        => 'announcements',
            'title'       => 'Thông báo & Tin tức',
            'template'    => 'blogs-announcements-html.php',
            'content'     => 'Cập nhật tin tức, sự kiện hackathon và các bài viết mới nhất từ Brilliant Việt Nam.',
            'excerpt'     => 'Tin tức và thông báo chính thức từ đội ngũ Brilliant Việt Nam.',
            'is_home'     => false,
            'is_blog'     => true,
        ),
    );

    foreach ( $pages_to_seed as $page_data ) {
        $existing = get_page_by_path( $page_data['slug'], OBJECT, 'page' );
        
        $post_args = array(
            'post_type'      => 'page',
            'post_status'    => 'publish',
            'post_title'     => $page_data['title'],
            'post_name'      => $page_data['slug'],
            'post_content'   => $page_data['content'],
            'post_excerpt'   => $page_data['excerpt'],
            'comment_status' => 'closed',
            'ping_status'    => 'closed',
        );

        if ( $existing ) {
            $page_id = $existing->ID;
            $post_args['ID'] = $page_id;
            wp_update_post( $post_args );
        } else {
            $page_id = wp_insert_post( $post_args );
        }

        if ( $page_id && ! is_wp_error( $page_id ) ) {
            if ( ! empty( $page_data['template'] ) ) {
                update_post_meta( $page_id, '_wp_page_template', $page_data['template'] );
            }

            if ( ! empty( $page_data['is_home'] ) ) {
                update_option( 'show_on_front', 'page' );
                update_option( 'page_on_front', $page_id );
            }

            if ( ! empty( $page_data['is_blog'] ) ) {
                update_option( 'page_for_posts', $page_id );
            }
        }
    }

    update_option( 'bl_pages_rich_content_synced_v3', 1 );
}
add_action( 'init', 'bl_seed_database_pages', 25 );
