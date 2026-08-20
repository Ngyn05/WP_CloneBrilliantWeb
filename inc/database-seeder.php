<?php
/**
 * Database Seeder for Brilliant Labs Posts & Categories
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Initialize Default Categories & Seed Posts
 */
function bl_seed_database_posts() {
    // Check if seeding has already occurred
    if ( get_option( 'bl_database_seeded_v1' ) ) {
        return;
    }

    // 1. Create Default Categories
    $categories = array(
        'brilliant-labs-team' => array(
            'name'        => 'Đội ngũ Brilliant Labs',
            'description' => 'Các thông báo và cập nhật chính thức từ đội ngũ sáng lập Brilliant Labs.',
        ),
        'community' => array(
            'name'        => 'Cộng đồng',
            'description' => 'Các dự án sáng tạo và đóng góp từ cộng đồng nhà phát triển.',
        ),
        'industry-updates' => array(
            'name'        => 'Cập nhật ngành',
            'description' => 'Tin tức và góc nhìn về xu hướng công nghệ AI và điện toán không gian.',
        ),
    );

    $cat_ids = array();
    foreach ( $categories as $slug => $cat_data ) {
        $existing = get_term_by( 'slug', $slug, 'category' );
        if ( $existing ) {
            $cat_ids[ $slug ] = $existing->term_id;
        } else {
            $created = wp_insert_term(
                $cat_data['name'],
                'category',
                array(
                    'slug'        => $slug,
                    'description' => $cat_data['description'],
                )
            );
            if ( ! is_wp_error( $created ) ) {
                $cat_ids[ $slug ] = $created['term_id'];
            }
        }
    }

    // 2. Define 8 standard articles with Vietnamese translated content
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    $posts_data = array(
        array(
            'slug'        => 'road-to-halo-part-6',
            'title'       => 'Hành trình đến Halo | Phần 6',
            'date'        => '2025-10-11 10:00:00',
            'category'    => 'brilliant-labs-team',
            'author_name' => 'Sam Khorshid',
            'excerpt'     => 'Điều này sẽ thay đổi mọi thứ. 📺💾📼📸📟📀🎮🖥️💻📱⌚️… 😎 Đây là những ngày đầu tiên của bước chuyển biến lớn trong điện toán: từ trải nghiệm thiết bị phản ứng bị động sang chủ động...',
            'image'       => 'site-assets/cdn/shop/articles/breakdown_2c66ec25-5764-4999-99e3-c0b9ad7b8714-6.gif',
            'content'     => '<style>
  .bl-post table, .bl-post tr, .bl-post td { border:0 !important; outline:0 !important; border-collapse:collapse !important; border-spacing:0 !important; padding:0 !important; margin:0 !important; }
  .bl-post .email-container { width:600px; margin:0 auto !important; }
  .bl-post p, .bl-post strong, .bl-post span { font:inherit; }
  .bl-post p { margin:12px 0 !important; line-height:1.5em !important; text-align:center !important; }
  .bl-post .image { display:block !important; margin:16px auto !important; max-width:100% !important; height:auto !important; border:0 !important; }
  .bl-post .image--round { border-radius:8px !important; }
  .bl-post .section { margin:24px auto !important; text-align:center !important; }
  @media (max-width:640px){ .bl-post .email-container{width:100%!important;} }
</style>
<div class="bl-post">
<table role="presentation" class="email-container" width="600" align="center"><tbody><tr><td>
<table role="presentation" class="email-container section" width="600" align="center"><tbody><tr><td align="center">
<h3><span>Điều này sẽ thay đổi mọi thứ.</span></h3>
<h3><span>📺💾📼📸📟📀🎮🖥️💻📱⌚️… 😎</span></h3>
</td></tr></tbody></table></td></tr></tbody></table>

<table role="presentation" class="email-container" width="600" align="center"><tbody><tr><td>
<table role="presentation" class="email-container section" width="600" align="center"><tbody><tr><td align="center">
<h5><span>Đây là những ngày đầu tiên của bước chuyển biến lớn trong điện toán: từ trải nghiệm thiết bị phản ứng bị động vốn không tự nhiên đối với con người — sang trải nghiệm chủ động, tương tác phối hợp đáp ứng theo cách chúng ta nhìn và nghe thế giới xung quanh. </span><strong><span>Nó sẽ thay đổi mọi thứ.</span></strong></h5>
<h5><span>🤘🏼 Nhưng mọi thứ sẽ chỉ là lối mòn cũ trừ khi DNA của cuộc cách mạng điện toán thông minh này là mã nguồn mở — </span><strong><span>phần cứng, firmware và phần mềm.</span></strong></h5>
<h5><span>😳 Hiện thực đã cho thấy những rủi ro của giải pháp thay thế: năm tập đoàn lớn đang vận hành cả thế giới hiện đại. Đó có phải là tương lai mà chúng ta mong muốn?</span></h5>
</td></tr></tbody></table></td></tr></tbody></table>

<table role="presentation" class="email-container" width="600" align="center" style="height: 560px;"><tbody><tr style="height: 560px;"><td style="height: 560px;">
<table role="presentation" class="email-container section" width="600" align="center"><tbody><tr><td align="center">
<a rel="noopener" href="https://www.youtube.com/watch?v=dKL9atC5-7w" target="_blank"><img alt="Halo video" height="480" width="480" class="image image--round" src="' . esc_url( $theme_uri . '/site-assets/shopify-email/n4dlm2g3ja922fullcxgxrmjnefl.jpg?width=1200' ) . '"></a>
</td></tr></tbody></table></td></tr></tbody></table>

<table role="presentation" class="email-container" width="600" align="center"><tbody><tr><td>
<table role="presentation" class="email-container section" width="600" align="center"><tbody><tr><td align="center">
<h5>👾 Cho đến gần đây, mã nguồn mở vẫn bị coi là phong trào bên lề — dù nằm ở trung tâm của các công nghệ nền tảng mà chúng ta sử dụng hàng ngày, nhưng chưa được đánh giá đúng mức tầm ảnh hưởng.</h5>
<h5>🥳 Nhưng mọi thứ đã thay đổi. Sự đón nhận mã nguồn mở của Generative AI đã châm ngòi cho làn sóng đổi mới phi tập trung chưa từng thấy trước đây.</h5>
</td></tr></tbody></table></td></tr></tbody></table>

<table role="presentation" class="email-container" width="600" align="center"><tbody><tr><td>
<table role="presentation" class="email-container section" width="600" align="center"><tbody><tr><td align="center">
<p><em>Demo giao diện Halo UI 👇</em></p>
</td></tr></tbody></table></td></tr></tbody></table>

<table role="presentation" class="email-container" width="600" align="center"><tbody><tr><td>
<table role="presentation" class="email-container section" width="600" align="center"><tbody><tr><td align="center">
<a rel="noopener" href="https://www.youtube.com/watch?v=vB-DhO46psw" target="_blank"><img alt="Halo UI video" height="270" width="480" class="image" src="' . esc_url( $theme_uri . '/site-assets/shopify-email/ctpp9yslx1a9cleus5rq43zvltf6.jpg?width=1200' ) . '"></a>
</td></tr></tbody></table></td></tr></tbody></table>

<table role="presentation" class="email-container" width="600" align="center"><tbody><tr><td>
<table role="presentation" class="email-container section" width="600" align="center"><tbody><tr><td align="center">
<h5>🤖 Khi các mô hình AI ngày càng tiến gần hơn đến biên mạng (Edge) — hiện hữu, mang tính cá nhân và luôn đồng hành — thì trách nhiệm thuộc về phần cứng trong việc đón nhận sự cởi mở để con người luôn nắm quyền kiểm soát kỷ nguyên mới này. Tác nhân tối thượng luôn là con người.</h5>
<h5>🫵🏼🦾 Sự cởi mở này không chỉ quan trọng để giải phóng tính sáng tạo mà còn để đảm bảo tính giải trình và minh bạch của các hệ thống thông minh phức tạp này — từ silicon đến phần mềm.</h5>
<h4>✌🏼🚀 Chúng ta đang sống trong một thời khắc bước ngoặt, trước thềm một sự chuyển đổi mang tầm vóc thế giới, và cần sự chung tay của tất cả chúng ta để hướng tới hạnh phúc chung của cộng đồng.</h4>
</td></tr></tbody></table></td></tr></tbody></table>

<table role="presentation" class="email-container" width="600" align="center"><tbody><tr><td>
<table role="presentation" class="email-container section" width="600" align="center"><tbody><tr><td align="center">
<a rel="noopener" href="' . esc_url( home_url( '/' ) ) . '" target="_blank"><img alt="Brilliant Labs" height="345" width="480" class="image" src="' . esc_url( $theme_uri . '/site-assets/shopify-email/r7nzqrgjq5tlbzy6nslynkmuuxys.jpg?width=1200' ) . '"></a>
</td></tr></tbody></table></td></tr></tbody></table>
</div>',
        ),

        array(
            'slug'        => 'road-to-halo-part-5',
            'title'       => 'Hành trình đến Halo | Phần 5',
            'date'        => '2025-10-11 09:00:00',
            'category'    => 'brilliant-labs-team',
            'author_name' => 'Sam Khorshid',
            'excerpt'     => '🧠 Bộ nhớ thực sự quan trọng “Tôi không nhớ tên anh ấy là gì.” “Chúng ta đã nói về chuyện gì nhỉ?” “Lần cuối tôi gặp anh ấy là ở đâu?” “Tôi là ai?”...',
            'image'       => 'site-assets/cdn/shop/articles/Falo_Shines_479cc62e-a8b5-4946-a612-0766aa223828-5.gif',
            'content'     => '<style>
  .bl-post table, .bl-post tr, .bl-post td { border:0 !important; outline:0 !important; border-collapse:collapse !important; border-spacing:0 !important; padding:0 !important; margin:0 !important; }
  .bl-post .email-container { width:600px; margin:0 auto !important; }
  .bl-post p, .bl-post strong, .bl-post span { font: inherit; }
  .bl-post p { margin:12px 0 !important; line-height:1.5em !important; text-align:center !important; }
  .bl-post .image { display:block !important; margin:16px auto !important; max-width:100% !important; height:auto !important; border:0 !important; }
  .bl-post .image--round { border-radius:8px !important; }
  .bl-post .section { margin:24px auto !important; text-align:center !important; }
  .bl-post .tight p { margin:8px 0 !important; }
  @media (max-width: 640px) { .bl-post .email-container { width:100% !important; } }
</style>
<div class="bl-post">
<table align="center" width="600" class="email-container" role="presentation"><tbody><tr><td>
<table align="center" width="600" class="email-container section" role="presentation"><tbody><tr><td align="center">
<h3><strong><span>🧠 Bộ nhớ thực sự quan trọng</span></strong></h3>
</td></tr></tbody></table></td></tr></tbody></table>

<table align="center" width="600" class="email-container" role="presentation"><tbody><tr><td>
<table align="center" width="600" class="email-container section" role="presentation"><tbody><tr><td align="center" class="tight">
<h5><strong><span>“Tôi không nhớ tên anh ấy là gì.”</span></strong></h5>
<h5><strong><span>“Chúng ta đã nói về chuyện gì nhỉ?”</span></strong></h5>
<h5><strong><span>“Lần cuối tôi gặp anh ấy là ở đâu?”</span></strong></h5>
<h5><strong><span>“Tôi có khả năng làm được những gì?”</span></strong></h5>
<h5><strong><span>“Tôi tin vào điều gì?”</span></strong></h5>
<h5><strong><span>“Tôi là ai?”</span></strong></h5>
<h5><strong><span>🧠 Bộ nhớ quan trọng — rất nhiều.</span></strong></h5>
<h6><span>Nó củng cố bản sắc đang không ngừng phát triển của chúng ta, nó thiết yếu cho năng suất làm việc, và nó giữ cho chúng ta cảm giác gắn kết với mọi người.👩❤️👨</span></h6>
<h6><span>Nó gắn kết những hồi ức chủ quan của cuộc đời với cảm nhận chung về thời gian: Những điều chúng ta trải nghiệm, nhớ lại và chia sẻ cùng nhau. Trí nhớ là một phần tinh túy của con người.</span></h6>
<h6><span>😅</span><strong><span> Nhưng trí nhớ của tôi đôi khi tệ lắm!</span></strong><span> Tôi thường quên các chi tiết trong cuộc trò chuyện, thứ tự các sự kiện, hoặc thật ngại ngùng, quên mất tên của ai đó. Không chỉ có những khoảng trống, mà trí nhớ đôi khi còn tự tưởng tượng ra nữa!</span></h6>
<h5><strong><span>Và tôi biết mình không phải là người duy nhất.😎</span></strong></h5>
</td></tr></tbody></table></td></tr></tbody></table>

<table align="center" width="600" class="email-container" role="presentation"><tbody><tr><td>
<table align="center" width="600" class="email-container section" role="presentation"><tbody><tr><td align="center">
<a href="https://www.youtube.com/watch?v=dKL9atC5-7w" rel="noopener" target="_blank"><img src="' . esc_url( $theme_uri . '/site-assets/shopify-email/vkz6o8k6xli31ernmbqawyvy9p8h.jpg?width=1200' ) . '" class="image image--round" width="480" height="480" alt="Halo video"></a>
</td></tr></tbody></table></td></tr></tbody></table>

<table align="center" width="600" class="email-container" role="presentation"><tbody><tr><td>
<table align="center" width="600" class="email-container section" role="presentation"><tbody><tr><td align="center">
<h5><span>Vì vậy, chúng tôi đã tạo ra </span><strong><span>Noa:</span></strong><span> một tác nhân AI riêng tư sở hữu bộ nhớ.</span></h5>
<h6><strong><span>Noa</span></strong><span> hiện diện trong </span><strong><span>Halo</span></strong><span>, chiếc kính AI mã nguồn mở mới của chúng tôi, đồng nghĩa với việc nó có thể NHÌN và NGHE suốt cả ngày, giống như bạn.</span></h6>
<h6><span>🕸️ Bên dưới hệ thống, dữ liệu bộ nhớ của </span><strong><span>Noa</span></strong><span> hỗ trợ đa ngôn ngữ linh hoạt và được xây dựng theo cách mà mô hình suy luận hoặc tác nhân AI có thể liên kết các mối quan hệ giữa các dữ liệu để khám phá ra những hiểu biết sâu sắc, bất ngờ.</span></h6>
<h6><span>Điều này hoàn toàn mới mẻ cho tất cả chúng ta và bắt đầu mở ra cơ hội cho các nhà trị liệu, huấn luyện viên cuộc sống, chuyên gia dinh dưỡng, giáo viên và nhiều người khác tham gia vào việc hỗ trợ, định hướng và chữa lành theo những cách thức mới.🔒</span></h6>
<h5><em>Xem video demo bộ nhớ bên dưới 👇</em></h5>
</td></tr></tbody></table></td></tr></tbody></table>

<table align="center" width="600" class="email-container" role="presentation"><tbody><tr><td>
<table align="center" width="600" class="email-container section" role="presentation"><tbody><tr><td align="center">
<a href="https://youtu.be/AeMtn_-vPqU" rel="noopener" target="_blank"><img src="' . esc_url( $theme_uri . '/site-assets/shopify-email/4yfqszwt7bhdwefsgj89uap1dta4.jpg?width=1200' ) . '" class="image" width="480" height="270" alt="Memory demo video"></a>
</td></tr></tbody></table></td></tr></tbody></table>

<table align="center" width="600" class="email-container" role="presentation"><tbody><tr><td>
<table align="center" width="600" class="email-container section" role="presentation"><tbody><tr><td align="center">
<h6><span>Và quan trọng nhất, chúng tôi đã tiến thêm một bước xa hơn: Những ký ức của </span><strong><span>Noa</span></strong><span> được mã hóa bằng máy và lưu trữ riêng tư trên các máy chủ bảo mật với:</span></h6>
<h5><strong><span>**Tuyệt đối không lưu giữ dữ liệu đa phương tiện thô**</span></strong></h5>
<h6><span>Vì vậy bạn có thể hoàn toàn yên tâm sử dụng </span><strong><span>Noa</span></strong><span> để gợi nhớ trong nhiều năm tới.❤️</span></h6>
<h6><span>Đúng với tinh thần của </span><strong>Brilliant Labs</strong><span>, chúng tôi tạo ra điều này vì chúng tôi tin rằng nó xứng đáng được tồn tại.</span></h6>
<h5><span>Đây là sự khởi đầu của một hành trình </span><strong><span>— dành cho tất cả chúng ta.</span></strong></h5>
</td></tr></tbody></table></td></tr></tbody></table>
</div>',
        ),

        array(
            'slug'        => 'road-to-halo-part-4',
            'title'       => 'Hành trình đến Halo | Phần 4',
            'date'        => '2025-10-11 08:00:00',
            'category'    => 'brilliant-labs-team',
            'author_name' => 'Sam Khorshid',
            'excerpt'     => 'Hành trình đến Halo | Phần 4 💪🏼 Halo phá bỏ sự đánh đổi sai lầm giữa quyền riêng tư và mã nguồn mở. Kỷ nguyên điện toán tiếp theo phải tôn trọng bạn...',
            'image'       => 'site-assets/cdn/shop/articles/IMG_2978_1-7.webp',
            'content'     => '<style>
  .bl-post table, .bl-post tr, .bl-post td { border:0 !important; outline:0 !important; border-collapse:collapse !important; border-spacing:0 !important; padding:0 !important; margin:0 !important; }
  .bl-post h3, .bl-post h4, .bl-post h5, .bl-post p { margin:12px 0 !important; padding:0 !important; text-align:center !important; line-height:1.5em !important; }
  .bl-post img { border:0 !important; display:block !important; margin:16px auto !important; max-width:100% !important; height:auto !important; }
  .bl-post .section { text-align:center !important; margin:24px auto !important; }
</style>
<div class="bl-post">
  <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" role="presentation" style="margin:0 auto; border:0;">
    <tbody><tr><td>
      <div class="section">
        <h3><strong>Hành trình đến Halo | Phần 4</strong></h3>
        <h4><strong>💪🏼 Halo phá bỏ sự đánh đổi sai lầm giữa quyền riêng tư và mã nguồn mở.</strong></h4>
      </div>
      <div class="section">
        <a href="' . esc_url( home_url( '/products/halo/' ) ) . '" target="_blank"><img src="' . esc_url( $theme_uri . '/site-assets/shopify-email/h75503ckilfydnxl60iw1aoc929z.gif?width=1200' ) . '" width="644" height="435" alt="Halo"></a>
      </div>
      <div class="section">
        <h5><strong>🤗 Chúng tôi tin rằng kỷ nguyên tiếp theo của điện toán cá nhân phải là mã nguồn mở đồng thời tuyệt đối tôn trọng quyền riêng tư của bạn. Nó phải thúc đẩy sự sáng tạo to lớn trong khi xây dựng niềm tin vững chắc.</strong></h5>
        <h5><strong>🤘🏼 Điều này đặt ra tiêu chuẩn đổi mới cực kỳ cao.</strong></h5>
      </div>
      <div class="section">
        <a href="https://www.youtube.com/watch?v=dKL9atC5-7w" target="_blank"><img src="' . esc_url( $theme_uri . '/site-assets/shopify-email/ff5s5i9xhatawhrx1x6l3qvsv6pw.gif?width=1200' ) . '" width="480" height="480" alt="Halo video"></a>
      </div>
      <div class="section">
        <h5><strong>Nó đòi hỏi sự từ bỏ kiểm soát độc quyền và mở rộng hợp tác cùng cộng đồng — từ chối việc coi dữ liệu người dùng như món hàng để thu thập và buôn bán.</strong></h5>
        <h5><strong>Nó đòi hỏi sự nhất quán sâu sắc xuyên suốt văn hóa đội ngũ, mô hình kinh doanh, thiết kế hệ thống và thương hiệu.</strong></h5>
        <h5><strong>👀 Mã hóa đầu cuối và sự đồng ý của người dùng giờ đây là tiêu chuẩn bắt buộc. Halo đi xa hơn thế và không ghi âm hay lưu trữ bất kỳ dữ liệu đa phương tiện thô nào mà nó thu thập —</strong></h5>
        <h5><strong>**Chúng tôi thách thức mọi nhà sản xuất kính thông minh khác cùng làm điều tương tự.**</strong></h5>
      </div>
      <div class="section">
        <a href="https://youtu.be/sLGvx0Vpr0U" target="_blank"><img src="' . esc_url( $theme_uri . '/site-assets/shopify-email/kuj8r53kkamiye2xh50rqj71fanq.jpg?width=1200' ) . '" width="480" height="270" alt="YouTube video"></a>
      </div>
      <div class="section">
        <h5><strong>Đây chính là lý do chúng tôi xây dựng Halo cùng Noa — tác nhân AI riêng tư của bạn.</strong></h5>
        <h5><strong>Brilliant Labs tồn tại để giúp mở ra kỷ nguyên tiếp theo của điện toán cá nhân — với quyền riêng tư và sự cởi mở là trọng tâm.</strong></h5>
      </div>
    </td></tr></tbody>
  </table>
</div>',
        ),

        array(
            'slug'        => 'road-to-halo-part-3-of-4',
            'title'       => 'Hành trình đến Halo | Phần 3',
            'date'        => '2025-08-26 14:00:00',
            'category'    => 'brilliant-labs-team',
            'author_name' => 'Sam Khorshid',
            'excerpt'     => '🎨 Quá trình nghiên cứu phần cứng Halo đòi hỏi sự định hướng rõ ràng, chắt lọc tinh tế, mục tiêu mạch lạc và thiết kế tỉ mỉ ở mọi tầng công nghệ...',
            'image'       => 'site-assets/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e.webp',
            'content'     => '<h3>🎨 Quá trình nghiên cứu phần cứng <strong><span>Halo</span></strong> đòi hỏi sự định hướng rõ ràng, chắt lọc tinh tế, mục tiêu mạch lạc và thiết kế tỉ mỉ ở mọi tầng công nghệ.</h3>
<p><img src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/Falo_Shines.gif?v=1756151572' ) . '" alt=""></p>
<h4>🙄 Bạn có thể nhận thấy hầu hết mọi chiếc kính thông minh khác ra mắt trên thị trường đều đi theo một lối mòn dễ đoán.</h4>
<h4><strong>Nhưng chúng tôi suy nghĩ khác biệt: </strong>những thiết bị này không phải để quay video mạng xã hội hay xem YouTube. Thay vào đó, chúng tồn tại để thực hiện suy luận AI cả ngày nhằm cá nhân hóa sâu sắc và nâng cao trí nhớ, trong khi vẫn trông như một chiếc kính đeo mắt thanh lịch.</h4>
<h3><img src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/Timeline_1_04ee2694-5933-4fef-b6b7-cfb4c7536ba0.gif?v=1756079310' ) . '" alt=""></h3>
<h3>🎯<strong>Vì vậy, với sự định hướng rõ ràng đó, chúng tôi bắt tay vào thiết kế hệ thống phần cứng của </strong><strong><span>Halo</span></strong><strong>.</strong></h3>
<h4>Trong khi vẫn duy trì <strong>màn hình hiển thị đầy đủ màu sắc</strong> và <strong>camera</strong>, chúng tôi bổ sung thêm một <strong>micrô</strong> và <strong>hai loa dẫn truyền qua xương</strong> — tất cả được kết nối với <strong>bộ xử lý AI</strong> siêu tiết kiệm điện.</h4>
<h4>Bằng cách loại bỏ hệ thống quang học cồng kềnh đắt đỏ, bộ xử lý tiêu hao quá nhiều điện năng, WiFi và cảm biến hình ảnh nặng nề, chúng tôi đã hoàn thành một thiết kế phần cứng tối ưu cho việc <strong>đeo cả ngày, ghi nhận ngữ cảnh và tương tác tác nhân đa phương thức.</strong></h4>
<p><a href="https://www.youtube.com/watch?v=z-Z2WrB5jhA&list=PLfbaC5GRVJJg_b3o0gwZkGLVv_db7kbfW"><img src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/boxingF.png?v=1756152836' ) . '" alt=""></a></p>
<h4><strong>⛩️</strong> Những quyết định kiến trúc này cho phép chúng tôi nâng cao trải nghiệm người dùng và mở rộng giá trị cho các nhà phát triển, đồng thời hạ giá thành sản phẩm và tăng gấp nhiều lần thời lượng pin — tất cả nằm trọn trong thiết kế công nghiệp tinh xảo đầy tính tất yếu của <strong><span>Halo</span></strong>.</h4>
<h4>🧑🏼🎨 Chúng tôi tin rằng những thiết bị này cần phải đẹp mắt, nhẹ nhàng và tự nhiên, đồng thời mở ra khả năng sáng tạo và trí tuệ vô hạn.</h4>
<h3>😇 <strong><span>Halo</span></strong> là một cột mốc quan trọng đối với chúng tôi khi tiếp tục nhân đôi cam kết với phong trào mã nguồn mở, mở ra kỷ nguyên tiếp theo của điện toán thông minh.</h3>',
        ),

        array(
            'slug'        => 'road-to-halo-part-2-of-4',
            'title'       => 'Hành trình đến Halo | Phần 2',
            'date'        => '2025-08-20 14:00:00',
            'category'    => 'brilliant-labs-team',
            'author_name' => 'Sam Khorshid',
            'excerpt'     => 'Noa dành cho Halo đã có một bước tiến vượt bậc! 🥳🛠 Chúng tôi có tầm nhìn rõ ràng về trải nghiệm phần mềm lý tưởng cùng đàm thoại đa phương thức...',
            'image'       => 'site-assets/cdn/shop/articles/IMG_7016.jpg',
            'content'     => '<h3 style="text-align: center;"><strong><span>Noa</span></strong> dành cho <strong><span>Halo</span></strong> đã có một bước tiến vượt bậc! 🥳🛠</h3>
<h4 style="text-align: center;">Chúng tôi có một tầm nhìn rất rõ ràng về trải nghiệm phần mềm lý tưởng. Song hành cùng những tiến bộ trong công nghệ giọng nói AI, chúng tôi bắt đầu xây dựng giao diện đàm thoại đa phương thức với độ trễ siêu thấp, mang lại cảm giác đối thoại tự nhiên như người với người.</h4>
<div style="text-align: center;"><img style="margin-right: 20px; margin-bottom: 16px; margin-left: 20px; float: none;" src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/Noa_b7a5850a-1ab2-4d95-99dd-9c6ce6330354_1024x1024.png?v=1753743650' ) . '" width="286" height="103"></div>
<h4 style="text-align: center;"><strong><span>Một người bạn đáng tin cậy luôn tôn trọng quyền riêng tư của bạn</span></strong><span> — </span><span>với khả năng xử lý suy luận trực tiếp trên thiết bị sắp ra mắt</span></h4>
<h5>🧠👀 Nhưng còn một điều nữa luôn trăn trở trong tâm trí chúng tôi: <strong>**BỘ NHỚ**</strong> — một trụ cột của trải nghiệm con người và là yêu cầu ngày càng quan trọng đối với các công nghệ thông minh.</h5>
<h5><strong>(Nhấp vào hình bên dưới để xem video demo 👇)</strong></h5>
<div style="text-align: center;"><a href="https://youtu.be/dKL9atC5-7w" title="Memory Demo edit fun"><img src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/IMG_3252_fde61162-01dd-4052-9c82-2f6d1bb05aa6_600x600.jpg?v=1753934700' ) . '" style="margin-bottom: 16px; float: none;"></a></div>
<h5>Khác với các giải pháp bộ nhớ hiện nay chủ yếu xoay quanh văn bản viết, chúng tôi cảm thấy mình có thể đóng góp cho không gian này bằng cách thiết kế bộ nhớ của <strong><span>Noa</span></strong> học hỏi từ những đường nét sống động của cuộc sống hàng ngày — những gì bạn nhìn thấy, nghe thấy và nói — đồng thời phân biệt tín hiệu hữu ích từ vô vàn tạp âm.</h5>
<h5>🤯 Viễn cảnh về một tác nhân AI <strong>riêng tư, đáng tin cậy</strong> có khả năng suy luận qua nhiều năm tháng cuộc đời bạn mở ra những tiềm năng không thể tưởng tượng trước đây.</h5>
<h5><strong>(Nhấp vào hình bên dưới để xem video demo 2 👇)</strong></h5>
<div style="text-align: center;"><a href="https://youtu.be/QVe9kLore_I" title="Demo Noa in the Garden"><img src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/garden_1024x1024.png?v=1755545742' ) . '" style="margin-bottom: 16px; float: none;"></a></div>
<h5>Giao diện người dùng UI/UX trên <strong><span>Halo</span></strong> và trong ứng dụng di động được thiết kế với phong cách hoài niệm cổ điển (retro vibes), gắn liền với thời kỳ khởi đầu của máy tính cá nhân, máy chơi game arcade và internet sơ khai.</h5>
<h3 style="text-align: center;"><strong>Hãy cùng đón chờ nhé 😎</strong></h3>',
        ),

        array(
            'slug'        => 'road-to-halo-part-1-of-4',
            'title'       => 'Hành trình đến Halo | Phần 1',
            'date'        => '2025-08-13 14:00:00',
            'category'    => 'brilliant-labs-team',
            'author_name' => 'Sam Khorshid',
            'excerpt'     => 'Sự đón nhận dành cho Halo thật vô cùng to lớn ❤️ Và bây giờ, hãy cùng khám phá câu chuyện phía sau hành trình phát triển...',
            'image'       => 'site-assets/cdn/shop/articles/IMG_1838_e8390610-7d22-4ae7-9456-8d14b7cb4aae-4.webp',
            'content'     => '<h2><strong>Quá trình phát triển<span> </span></strong><strong><span>Halo</span></strong><strong><span> </span>là một hành trình đầy thử thách. ⚒️</strong></h2>
<h4>Chúng tôi đã rút ra nhiều bài học quý giá từ việc phát triển và sản xuất<span> </span><strong>Frame</strong><span> </span>và biết rằng mình cần đưa tất cả những kinh nghiệm đó vào<span> </span><strong><span>Halo</span></strong>.</h4>
<h2>Nhưng trước tiên, chúng tôi nhìn lại chính mình:</h2>
<h4>Sau quá trình suy ngẫm sâu sắc về văn hóa và cách thức làm việc, những thay đổi đau đớn nhưng cần thiết đã được thực hiện đối với đội ngũ và chuỗi cung ứng nhằm hoàn thiện phương thức vận hành.</h4>
<h2><strong><img alt="" src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/IMG_6763_bc5e4d49-2b61-4ad9-99f5-addfeedb6c24.webp?v=1753934992' ) . '"> <span>Halo </span>chính là thành quả của sự tái định hình sâu sắc này.</strong></h2>
<h4>Giống như<span> </span><strong>Monocle</strong><span> </span>trước đó,<span> </span><strong>Frame</strong><span> </span>cho phép chúng tôi đào sâu gốc rễ trong cộng đồng mã nguồn mở — những người có ý tưởng táo bạo sẽ dẫn đầu cuộc cách mạng điện toán thông minh. Niềm vui lớn nhất là được trao đổi với các nhà phát triển trên khắp thế giới đang xây dựng những ứng dụng đầy ý nghĩa và thách thức trên nền tảng của chúng tôi.</h4>
<h2><strong>Đây chính là lý do và động lực của chúng tôi 🙌🏼</strong></h2>
<h3>NHƯNG một câu hỏi lớn tồn tại từ lâu vẫn còn đó: ngoài việc hiển thị các tiện ích chức năng thừa hưởng từ kỷ nguyên di động, lý do sâu xa cho sự tồn tại của danh mục thiết bị mới này trong cuộc sống chúng ta là gì?</h3>
<h1><strong>Với<span> </span></strong><strong><span>Halo</span></strong><strong>, chúng tôi bắt đầu chia sẻ những suy nghĩ của mình về câu hỏi then chốt đó…</strong></h1>
<p><img alt="" src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/IMG_6586.webp?v=1753472675' ) . '"></p>',
        ),

        array(
            'slug'        => 'citizenones-frame-projects',
            'title'       => 'Các dự án Frame của CitizenOne 🕹️',
            'date'        => '2024-11-21 19:17:43',
            'category'    => 'community',
            'author_name' => 'CitizenOne',
            'excerpt'     => 'Demo ghim vị trí AR trực tiếp: Hiển thị các ghim điều hướng và địa điểm yêu thích (POI) ngay trong tầm nhìn cùng cảm biến của Frame...',
            'image'       => 'site-assets/cdn/shop/articles/frameshot1-5.webp',
            'content'     => '<h2>Demo ghim vị trí trực tiếp AR (AR Live Location Pin Demo)</h2>
<p><img src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/frameshot1_40065cb5-6714-4082-93a6-9d0c64393cd5_480x480.webp?v=1732101224' ) . '" alt=""></p>
<p>Hiển thị các ghim định vị / điều hướng AR đại diện cho các địa điểm yêu thích (POI) ngay trong tầm nhìn. Ứng dụng sử dụng cảm biến từ kế và gia tốc kế tích hợp của Frame truyền trực tiếp đến điện thoại để tính toán và cập nhật hướng nhìn đến từng điểm POI.<br><br>Hiện tại bản demo sử dụng tọa độ mẫu kinh độ/vĩ độ cho vị trí người dùng và hai điểm POI mẫu. (Việc kết nối GPS điện thoại thực tế và dịch vụ bản đồ để tìm kiếm tọa độ hoặc vị trí trực tiếp của bạn bè được để mở như một bài tập thực hành).</p>
<h3><a href="https://github.com/CitizenOneX/frame_locator_pin" target="_blank"><strong>Mã nguồn</strong></a> <a href="https://discord.com/channels/963222352534048818/1105456402216009758/threads/1305481513457946624">Dự án</a></h3>

<h2><strong>Generative AI trên Frame</strong></h2>
<p><img alt="" src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/frameshot3_480x480.webp?v=1732101676' ) . '"></p>
<p><span>Gửi câu lệnh (prompt) đến mô hình tạo ảnh miễn phí Pollinations.ai trên nền web để tạo ảnh và hiển thị trực tiếp lên kính Frame! Chạm vào ảnh trong ứng dụng để lưu hoặc chia sẻ tác phẩm của bạn!</span></p>
<h3><a href="https://github.com/CitizenOneX/frame_pollinations"><strong>Mã nguồn</strong></a> <a href="https://discord.com/channels/963222352534048818/1105456402216009758/threads/1306806920425902122">Dự án</a></h3>

<h3><strong>Trình xem Sprite trên Frame (Frame Sprite Viewer)</strong></h3>
<p><img alt="" src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/image_480x480.png?v=1732102804' ) . '"></p>
<p>Trình hiển thị ảnh Sprite cho kính Frame. Hỗ trợ định dạng PNG và JPG. Tự động lượng tử hóa màu sắc xuống 16-bit và căn chỉnh kích thước ảnh phù hợp với bộ nhớ để hiển thị sắc nét trên Frame.</p>
<h3><strong><a href="https://github.com/CitizenOneX/frame_progressive_sprite_viewer/releases">Mã nguồn</a> <a href="https://discord.com/channels/963222352534048818/1105456402216009758/threads/1285622884768809020">Dự án</a></strong></h3>',
        ),

        array(
            'slug'        => 'hackathon-august-3rd-2024',
            'title'       => 'Hackathon: Ngày 3 tháng 8 năm 2024',
            'date'        => '2024-10-10 12:00:00',
            'category'    => 'brilliant-labs-team',
            'author_name' => 'Brilliant Labs',
            'excerpt'     => 'Chúng tôi rất vinh dự được đồng tổ chức sự kiện Hackathon cùng Niantic, nhà sáng tạo của tựa game Pokémon Go nổi tiếng!',
            'image'       => 'site-assets/cdn/shop/articles/Frame_hackathon_v001-15.jpg',
            'content'     => '<p class="p1">Chúng tôi rất vinh dự được đồng tổ chức sự kiện Hackathon cùng Niantic, nhà sáng tạo của tựa game Pokémon Go nổi tiếng!</p>
<p class="p1">Hơn 50 nhà phát triển tài năng từ khắp nơi trên toàn quốc — và cả quốc tế — đã tham gia cùng chúng tôi để xây dựng các ứng dụng độc đáo tại giao điểm giữa AI và thực tế tăng cường (AR) trên kính Frame.</p>
<p class="p1">Hãy cùng xem lại các video nổi bật từ sự kiện bên dưới!</p>
<p class="p1"><a href="https://www.youtube.com/playlist?list=PLfbaC5GRVJJhwY0RtwPr9oa6gCkPJfi5Q" target="_blank" title="Hackathon - Ngày 3 tháng 8 năm 2024" rel="noopener noreferrer">Danh sách phát video Hackathon - Ngày 3 tháng 8 năm 2024!</a></p>',
        ),
    );

    // Required for media attachment insertion
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );

    foreach ( $posts_data as $p ) {
        // Check if post already exists
        $existing_post = get_page_by_path( $p['slug'], OBJECT, 'post' );
        if ( $existing_post ) {
            continue;
        }

        $post_arr = array(
            'post_title'   => $p['title'],
            'post_name'    => $p['slug'],
            'post_content' => $p['content'],
            'post_excerpt' => $p['excerpt'],
            'post_status'  => 'publish',
            'post_type'    => 'post',
            'post_date'    => $p['date'],
            'post_author'  => 1,
        );

        $inserted_id = wp_insert_post( $post_arr );

        if ( ! is_wp_error( $inserted_id ) && $inserted_id > 0 ) {
            // Assign Category
            if ( isset( $cat_ids[ $p['category'] ] ) ) {
                wp_set_post_categories( $inserted_id, array( $cat_ids[ $p['category'] ] ) );
            }

            // Assign Custom Meta
            if ( ! empty( $p['author_name'] ) ) {
                update_post_meta( $inserted_id, '_bl_author_name', $p['author_name'] );
            }

            // Set Featured Image
            $local_image_path = $theme_dir . '/' . $p['image'];
            if ( file_exists( $local_image_path ) ) {
                $filename = basename( $local_image_path );
                $upload_file = wp_upload_bits( $filename, null, file_get_contents( $local_image_path ) );

                if ( ! $upload_file['error'] ) {
                    $wp_filetype = wp_check_filetype( $filename, null );
                    $attachment = array(
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title'     => sanitize_file_name( $filename ),
                        'post_content'   => '',
                        'post_status'    => 'inherit',
                    );

                    $attach_id = wp_insert_attachment( $attachment, $upload_file['file'], $inserted_id );
                    $attach_data = wp_generate_attachment_metadata( $attach_id, $upload_file['file'] );
                    wp_update_attachment_metadata( $attach_id, $attach_data );
                    set_post_thumbnail( $inserted_id, $attach_id );
                }
            }
        }
    }

    update_option( 'bl_database_seeded_v1', 1 );
}
add_action( 'init', 'bl_seed_database_posts', 20 );
