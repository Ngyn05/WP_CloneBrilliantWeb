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
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

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

    // 2. Clean, human-readable article contents for WordPress WYSIWYG editor
    $posts_data = array(
        array(
            'slug'        => 'road-to-halo-part-6',
            'title'       => 'Hành trình đến Halo | Phần 6',
            'date'        => '2025-10-11 10:00:00',
            'category'    => 'brilliant-labs-team',
            'author_name' => 'Sam Khorshid',
            'excerpt'     => 'Điều này sẽ thay đổi mọi thứ. 📺💾📼📸📟📀🎮🖥️💻📱⌚️… 😎 Đây là những ngày đầu tiên của bước chuyển biến lớn trong điện toán: từ trải nghiệm thiết bị phản ứng bị động sang chủ động...',
            'image'       => 'site-assets/cdn/shop/articles/breakdown_2c66ec25-5764-4999-99e3-c0b9ad7b8714-6.gif',
            'content'     => '<p style="text-align: center; font-size: 1.3em;"><strong>Điều này sẽ thay đổi mọi thứ.</strong></p>
<p style="text-align: center; font-size: 1.5em;">📺💾📼📸📟📀🎮🖥️💻📱⌚️… 😎</p>

<p>Đây là những ngày đầu tiên của bước chuyển biến lớn trong điện toán: từ trải nghiệm thiết bị phản ứng bị động vốn không tự nhiên đối với con người — sang trải nghiệm chủ động, tương tác phối hợp đáp ứng theo cách chúng ta nhìn và nghe thế giới xung quanh. <strong>Nó sẽ thay đổi mọi thứ.</strong></p>

<p>🤘🏼 Nhưng mọi thứ sẽ chỉ là lối mòn cũ trừ khi DNA của cuộc cách mạng điện toán thông minh này là mã nguồn mở — <strong>phần cứng, firmware và phần mềm.</strong></p>

<p>😳 Hiện thực đã cho thấy những rủi ro của giải pháp thay thế: năm tập đoàn lớn đang vận hành cả thế giới hiện đại. Đó có phải là tương lai mà chúng ta mong muốn?</p>

<p style="text-align: center;"><a href="https://www.youtube.com/watch?v=dKL9atC5-7w" target="_blank"><img src="' . esc_url( $theme_uri . '/site-assets/shopify-email/n4dlm2g3ja922fullcxgxrmjnefl.jpg?width=1200' ) . '" alt="Halo video" style="border-radius: 8px; max-width: 100%; height: auto;"></a></p>

<p>👾 Cho đến gần đây, mã nguồn mở vẫn bị coi là phong trào bên lề — dù nằm ở trung tâm của các công nghệ nền tảng mà chúng ta sử dụng hàng ngày, nhưng chưa được đánh giá đúng mức tầm ảnh hưởng.</p>

<p>🥳 Nhưng mọi thứ đã thay đổi. Sự đón nhận mã nguồn mở của Generative AI đã châm ngòi cho làn sóng đổi mới phi tập trung chưa từng thấy trước đây.</p>

<p style="text-align: center;"><em>Demo giao diện Halo UI 👇</em></p>

<p style="text-align: center;"><a href="https://www.youtube.com/watch?v=vB-DhO46psw" target="_blank"><img src="' . esc_url( $theme_uri . '/site-assets/shopify-email/ctpp9yslx1a9cleus5rq43zvltf6.jpg?width=1200' ) . '" alt="Halo UI video" style="max-width: 100%; height: auto;"></a></p>

<p>🤖 Khi các mô hình AI ngày càng tiến gần hơn đến biên mạng (Edge) — hiện hữu, mang tính cá nhân và luôn đồng hành — thì trách nhiệm thuộc về phần cứng trong việc đón nhận sự cởi mở để con người luôn nắm quyền kiểm soát kỷ nguyên mới này. Tác nhân tối thượng luôn là con người.</p>

<p>🫵🏼🦾 Sự cởi mở này không chỉ quan trọng để giải phóng tính sáng tạo mà còn để đảm bảo tính giải trình và minh bạch của các hệ thống thông minh phức tạp này — từ silicon đến phần mềm.</p>

<p>✌🏼🚀 <strong>Chúng ta đang sống trong một thời khắc bước ngoặt, trước thềm một sự chuyển đổi mang tầm vóc thế giới, và cần sự chung tay của tất cả chúng ta để hướng tới hạnh phúc chung của cộng đồng.</strong></p>

<p style="text-align: center;"><a href="' . esc_url( home_url( '/' ) ) . '" target="_blank"><img src="' . esc_url( $theme_uri . '/site-assets/shopify-email/r7nzqrgjq5tlbzy6nslynkmuuxys.jpg?width=1200' ) . '" alt="Brilliant Labs" style="max-width: 100%; height: auto;"></a></p>',
        ),

        array(
            'slug'        => 'road-to-halo-part-5',
            'title'       => 'Hành trình đến Halo | Phần 5',
            'date'        => '2025-10-11 09:00:00',
            'category'    => 'brilliant-labs-team',
            'author_name' => 'Sam Khorshid',
            'excerpt'     => '🧠 Bộ nhớ thực sự quan trọng “Tôi không nhớ tên anh ấy là gì.” “Chúng ta đã nói về chuyện gì nhỉ?” “Lần cuối tôi gặp anh ấy là ở đâu?” “Tôi là ai?”...',
            'image'       => 'site-assets/cdn/shop/articles/Falo_Shines_479cc62e-a8b5-4946-a612-0766aa223828-5.gif',
            'content'     => '<p style="text-align: center; font-size: 1.3em;"><strong>🧠 Bộ nhớ thực sự quan trọng</strong></p>

<p><strong>“Tôi không nhớ tên anh ấy là gì.”</strong></p>
<p><strong>“Chúng ta đã nói về chuyện gì nhỉ?”</strong></p>
<p><strong>“Lần cuối tôi gặp anh ấy là ở đâu?”</strong></p>
<p><strong>“Tôi có khả năng làm được những gì?”</strong></p>
<p><strong>“Tôi tin vào điều gì?”</strong></p>
<p><strong>“Tôi là ai?”</strong></p>

<p>🧠 <strong>Bộ nhớ quan trọng — rất nhiều.</strong></p>

<p>Nó củng cố bản sắc đang không ngừng phát triển của chúng ta, nó thiết yếu cho năng suất làm việc, và nó giữ cho chúng ta cảm giác gắn kết với mọi người.👩❤️👨</p>

<p>Nó gắn kết những hồi ức chủ quan của cuộc đời với cảm nhận chung về thời gian: Những điều chúng ta trải nghiệm, nhớ lại và chia sẻ cùng nhau. Trí nhớ là một phần tinh túy của con người.</p>

<p>😅 <strong>Nhưng trí nhớ của tôi đôi khi tệ lắm!</strong> Tôi thường quên các chi tiết trong cuộc trò chuyện, thứ tự các sự kiện, hoặc thật ngại ngùng, quên mất tên của ai đó. Không chỉ có những khoảng trống, mà trí nhớ đôi khi còn tự tưởng tượng ra nữa!</p>

<p><strong>Và tôi biết mình không phải là người duy nhất.😎</strong></p>

<p style="text-align: center;"><a href="https://www.youtube.com/watch?v=dKL9atC5-7w" target="_blank"><img src="' . esc_url( $theme_uri . '/site-assets/shopify-email/vkz6o8k6xli31ernmbqawyvy9p8h.jpg?width=1200' ) . '" alt="Halo video" style="border-radius: 8px; max-width: 100%; height: auto;"></a></p>

<p>Vì vậy, chúng tôi đã tạo ra <strong>Noa</strong>: một tác nhân AI riêng tư sở hữu bộ nhớ.</p>

<p><strong>Noa</strong> hiện diện trong <strong>Halo</strong>, chiếc kính AI mã nguồn mở mới của chúng tôi, đồng nghĩa với việc nó có thể NHÌN và NGHE suốt cả ngày, giống như bạn.</p>

<p>🕸️ Bên dưới hệ thống, dữ liệu bộ nhớ của <strong>Noa</strong> hỗ trợ đa ngôn ngữ linh hoạt và được xây dựng theo cách mà mô hình suy luận hoặc tác nhân AI có thể liên kết các mối quan hệ giữa các dữ liệu để khám phá ra những hiểu biết sâu sắc, bất ngờ.</p>

<p>Điều này hoàn toàn mới mẻ cho tất cả chúng ta và bắt đầu mở ra cơ hội cho các nhà trị liệu, huấn luyện viên cuộc sống, chuyên gia dinh dưỡng, giáo viên và nhiều người khác tham gia vào việc hỗ trợ, định hướng và chữa lành theo những cách thức mới.🔒</p>

<p style="text-align: center;"><em>Xem video demo bộ nhớ bên dưới 👇</em></p>

<p style="text-align: center;"><a href="https://youtu.be/AeMtn_-vPqU" target="_blank"><img src="' . esc_url( $theme_uri . '/site-assets/shopify-email/4yfqszwt7bhdwefsgj89uap1dta4.jpg?width=1200' ) . '" alt="Memory demo video" style="max-width: 100%; height: auto;"></a></p>

<p>Và quan trọng nhất, chúng tôi đã tiến thêm một bước xa hơn: Những ký ức của <strong>Noa</strong> được mã hóa bằng máy và lưu trữ riêng tư trên các máy chủ bảo mật với:</p>

<p style="font-size: 1.1em; color: #fff;"><strong>**Tuyệt đối không lưu giữ dữ liệu đa phương tiện thô**</strong></p>

<p>Vì vậy bạn có thể hoàn toàn yên tâm sử dụng <strong>Noa</strong> để gợi nhớ trong nhiều năm tới.❤️</p>

<p>Đúng với tinh thần của <strong>Brilliant Labs</strong>, chúng tôi tạo ra điều này vì chúng tôi tin rằng nó xứng đáng được tồn tại.</p>

<p>Đây là sự khởi đầu của một hành trình <strong>— dành cho tất cả chúng ta.</strong></p>',
        ),

        array(
            'slug'        => 'road-to-halo-part-4',
            'title'       => 'Hành trình đến Halo | Phần 4',
            'date'        => '2025-10-11 08:00:00',
            'category'    => 'brilliant-labs-team',
            'author_name' => 'Sam Khorshid',
            'excerpt'     => 'Hành trình đến Halo | Phần 4 💪🏼 Halo phá bỏ sự đánh đổi sai lầm giữa quyền riêng tư và mã nguồn mở. Kỷ nguyên điện toán tiếp theo phải tôn trọng bạn...',
            'image'       => 'site-assets/cdn/shop/articles/IMG_2978_1-7.webp',
            'content'     => '<p style="text-align: center; font-size: 1.3em;"><strong>Hành trình đến Halo | Phần 4</strong></p>
<p style="text-align: center; font-size: 1.1em;"><strong>💪🏼 Halo phá bỏ sự đánh đổi sai lầm giữa quyền riêng tư và mã nguồn mở.</strong></p>

<p style="text-align: center;"><a href="' . esc_url( home_url( '/products/halo/' ) ) . '" target="_blank"><img src="' . esc_url( $theme_uri . '/site-assets/shopify-email/h75503ckilfydnxl60iw1aoc929z.gif?width=1200' ) . '" alt="Halo" style="max-width: 100%; height: auto;"></a></p>

<p>🤗 Chúng tôi tin rằng kỷ nguyên tiếp theo của điện toán cá nhân phải là mã nguồn mở đồng thời tuyệt đối tôn trọng quyền riêng tư của bạn. Nó phải thúc đẩy sự sáng tạo to lớn trong khi xây dựng niềm tin vững chắc.</p>

<p>🤘🏼 Điều này đặt ra tiêu chuẩn đổi mới cực kỳ cao.</p>

<p style="text-align: center;"><a href="https://www.youtube.com/watch?v=dKL9atC5-7w" target="_blank"><img src="' . esc_url( $theme_uri . '/site-assets/shopify-email/ff5s5i9xhatawhrx1x6l3qvsv6pw.gif?width=1200' ) . '" alt="Halo video" style="max-width: 100%; height: auto;"></a></p>

<p>Nó đòi hỏi sự từ bỏ kiểm soát độc quyền và mở rộng hợp tác cùng cộng đồng — từ chối việc coi dữ liệu người dùng như món hàng để thu thập và buôn bán.</p>

<p>Nó đòi hỏi sự nhất quán sâu sắc xuyên suốt văn hóa đội ngũ, mô hình kinh doanh, thiết kế hệ thống và thương hiệu.</p>

<p>👀 Mã hóa đầu cuối và sự đồng ý của người dùng giờ đây là tiêu chuẩn bắt buộc. Halo đi xa hơn thế và không ghi âm hay lưu trữ bất kỳ dữ liệu đa phương tiện thô nào mà nó thu thập —</p>

<p style="font-size: 1.1em; color: #fff;"><strong>**Chúng tôi thách thức mọi nhà sản xuất kính thông minh khác cùng làm điều tương tự.**</strong></p>

<p style="text-align: center;"><a href="https://youtu.be/sLGvx0Vpr0U" target="_blank"><img src="' . esc_url( $theme_uri . '/site-assets/shopify-email/kuj8r53kkamiye2xh50rqj71fanq.jpg?width=1200' ) . '" alt="YouTube video" style="max-width: 100%; height: auto;"></a></p>

<p>Đây chính là lý do chúng tôi xây dựng Halo cùng Noa — tác nhân AI riêng tư của bạn.</p>

<p>Brilliant Labs tồn tại để giúp mở ra kỷ nguyên tiếp theo của điện toán cá nhân — với quyền riêng tư và sự cởi mở là trọng tâm.</p>',
        ),

        array(
            'slug'        => 'road-to-halo-part-3-of-4',
            'title'       => 'Hành trình đến Halo | Phần 3',
            'date'        => '2025-08-26 14:00:00',
            'category'    => 'brilliant-labs-team',
            'author_name' => 'Sam Khorshid',
            'excerpt'     => '🎨 Quá trình nghiên cứu phần cứng Halo đòi hỏi sự định hướng rõ ràng, chắt lọc tinh tế, mục tiêu mạch lạc và thiết kế tỉ mỉ ở mọi tầng công nghệ...',
            'image'       => 'site-assets/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e.webp',
            'content'     => '<h3>🎨 Quá trình nghiên cứu phần cứng <strong>Halo</strong> đòi hỏi sự định hướng rõ ràng, chắt lọc tinh tế, mục tiêu mạch lạc và thiết kế tỉ mỉ ở mọi tầng công nghệ.</h3>

<p><img src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/Falo_Shines.gif?v=1756151572' ) . '" alt=""></p>

<h4>🙄 Bạn có thể nhận thấy hầu hết mọi chiếc kính thông minh khác ra mắt trên thị trường đều đi theo một lối mòn dễ đoán.</h4>

<h4><strong>Nhưng chúng tôi suy nghĩ khác biệt: </strong>những thiết bị này không phải để quay video mạng xã hội hay xem YouTube. Thay vào đó, chúng tồn tại để thực hiện suy luận AI cả ngày nhằm cá nhân hóa sâu sắc và nâng cao trí nhớ, trong khi vẫn trông như một chiếc kính đeo mắt thanh lịch.</h4>

<h3><img src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/Timeline_1_04ee2694-5933-4fef-b6b7-cfb4c7536ba0.gif?v=1756079310' ) . '" alt=""></h3>

<h3>🎯 <strong>Vì vậy, với sự định hướng rõ ràng đó, chúng tôi bắt tay vào thiết kế hệ thống phần cứng của Halo.</strong></h3>

<h4>Trong khi vẫn duy trì <strong>màn hình hiển thị đầy đủ màu sắc</strong> và <strong>camera</strong>, chúng tôi bổ sung thêm một <strong>micrô</strong> và <strong>hai loa dẫn truyền qua xương</strong> — tất cả được kết nối với <strong>bộ xử lý AI</strong> siêu tiết kiệm điện.</h4>

<h4>Bằng cách loại bỏ hệ thống quang học cồng kềnh đắt đỏ, bộ xử lý tiêu hao quá nhiều điện năng, WiFi và cảm biến hình ảnh nặng nề, chúng tôi đã hoàn thành một thiết kế phần cứng tối ưu cho việc <strong>đeo cả ngày, ghi nhận ngữ cảnh và tương tác tác nhân đa phương thức.</strong></h4>

<p><a href="https://www.youtube.com/watch?v=z-Z2WrB5jhA&list=PLfbaC5GRVJJg_b3o0gwZkGLVv_db7kbfW" target="_blank"><img src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/boxingF.png?v=1756152836' ) . '" alt=""></a></p>

<h4>⛩️ Những quyết định kiến trúc này cho phép chúng tôi nâng cao trải nghiệm người dùng và mở rộng giá trị cho các nhà phát triển, đồng thời hạ giá thành sản phẩm và tăng gấp nhiều lần thời lượng pin — tất cả nằm trọn trong thiết kế công nghiệp tinh xảo đầy tính tất yếu của <strong>Halo</strong>.</h4>

<h4>🧑🏼🎨 Chúng tôi tin rằng những thiết bị này cần phải đẹp mắt, nhẹ nhàng và tự nhiên, đồng thời mở ra khả năng sáng tạo và trí tuệ vô hạn.</h4>

<h3>😇 <strong>Halo</strong> là một cột mốc quan trọng đối với chúng tôi khi tiếp tục nhân đôi cam kết với phong trào mã nguồn mở, mở ra kỷ nguyên tiếp theo của điện toán thông minh.</h3>',
        ),

        array(
            'slug'        => 'road-to-halo-part-2-of-4',
            'title'       => 'Hành trình đến Halo | Phần 2',
            'date'        => '2025-08-20 14:00:00',
            'category'    => 'brilliant-labs-team',
            'author_name' => 'Sam Khorshid',
            'excerpt'     => 'Noa dành cho Halo đã có một bước tiến vượt bậc! 🥳🛠 Chúng tôi có tầm nhìn rõ ràng về trải nghiệm phần mềm lý tưởng cùng đàm thoại đa phương thức...',
            'image'       => 'site-assets/cdn/shop/articles/IMG_7016.jpg',
            'content'     => '<h3 style="text-align: center;"><strong>Noa</strong> dành cho <strong>Halo</strong> đã có một bước tiến vượt bậc! 🥳🛠</h3>

<h4 style="text-align: center;">Chúng tôi có một tầm nhìn rất rõ ràng về trải nghiệm phần mềm lý tưởng. Song hành cùng những tiến bộ trong công nghệ giọng nói AI, chúng tôi bắt đầu xây dựng giao diện đàm thoại đa phương thức với độ trễ siêu thấp, mang lại cảm giác đối thoại tự nhiên như người với người.</h4>

<p style="text-align: center;"><img src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/Noa_b7a5850a-1ab2-4d95-99dd-9c6ce6330354_1024x1024.png?v=1753743650' ) . '" width="286" height="103" style="max-width: 100%; height: auto;"></p>

<h4 style="text-align: center;"><strong>Một người bạn đáng tin cậy luôn tôn trọng quyền riêng tư của bạn</strong> — với khả năng xử lý suy luận trực tiếp trên thiết bị sắp ra mắt</h4>

<h5 style="text-align: center;">🧠👀 Nhưng còn một điều nữa luôn trăn trở trong tâm trí chúng tôi: <strong>**BỘ NHỚ**</strong> — một trụ cột của trải nghiệm con người và là yêu cầu ngày càng quan trọng đối với các công nghệ thông minh.</h5>

<p style="text-align: center;"><strong>(Nhấp vào hình bên dưới để xem video demo 👇)</strong></p>

<p style="text-align: center;"><a href="https://youtu.be/dKL9atC5-7w" target="_blank"><img src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/IMG_3252_fde61162-01dd-4052-9c82-2f6d1bb05aa6_600x600.jpg?v=1753934700' ) . '" style="max-width: 480px; height: auto;"></a></p>

<p>Khác với các giải pháp bộ nhớ hiện nay chủ yếu xoay quanh văn bản viết, chúng tôi cảm thấy mình có thể đóng góp cho không gian này bằng cách thiết kế bộ nhớ của <strong>Noa</strong> học hỏi từ những đường nét sống động của cuộc sống hàng ngày — những gì bạn nhìn thấy, nghe thấy và nói — đồng thời phân biệt tín hiệu hữu ích từ vô vàn tạp âm.</p>

<p>🤯 Viễn cảnh về một tác nhân AI <strong>riêng tư, đáng tin cậy</strong> có khả năng suy luận qua nhiều năm tháng cuộc đời bạn mở ra những tiềm năng không thể tưởng tượng trước đây.</p>

<p style="text-align: center;"><strong>(Nhấp vào hình bên dưới để xem video demo 2 👇)</strong></p>

<p style="text-align: center;"><a href="https://youtu.be/QVe9kLore_I" target="_blank"><img src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/garden_1024x1024.png?v=1755545742' ) . '" style="max-width: 480px; height: auto;"></a></p>

<p>Giao diện người dùng UI/UX trên <strong>Halo</strong> và trong ứng dụng di động được thiết kế với phong cách hoài niệm cổ điển (retro vibes), gắn liền với thời kỳ khởi đầu của máy tính cá nhân, máy chơi game arcade và internet sơ khai.</p>

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
            'content'     => '<h2><strong>Quá trình phát triển Halo là một hành trình đầy thử thách. ⚒️</strong></h2>

<h4>Chúng tôi đã rút ra nhiều bài học quý giá từ việc phát triển và sản xuất <strong>Frame</strong> và biết rằng mình cần đưa tất cả những kinh nghiệm đó vào <strong>Halo</strong>.</h4>

<h2>Nhưng trước tiên, chúng tôi nhìn lại chính mình:</h2>

<h4>Sau quá trình suy ngẫm sâu sắc về văn hóa và cách thức làm việc, những thay đổi đau đớn nhưng cần thiết đã được thực hiện đối với đội ngũ và chuỗi cung ứng nhằm hoàn thiện phương thức vận hành.</h4>

<p><img src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/IMG_6763_bc5e4d49-2b61-4ad9-99f5-addfeedb6c24.webp?v=1753934992' ) . '" alt="" style="max-width: 100%; height: auto;"></p>

<h2><strong>Halo chính là thành quả của sự tái định hình sâu sắc này.</strong></h2>

<h4>Giống như <strong>Monocle</strong> trước đó, <strong>Frame</strong> cho phép chúng tôi đào sâu gốc rễ trong cộng đồng mã nguồn mở — những người có ý tưởng táo bạo sẽ dẫn đầu cuộc cách mạng điện toán thông minh. Niềm vui lớn nhất là được trao đổi với các nhà phát triển trên khắp thế giới đang xây dựng những ứng dụng đầy ý nghĩa và thách thức trên nền tảng của chúng tôi.</h4>

<h2><strong>Đây chính là lý do và động lực của chúng tôi 🙌🏼</strong></h2>

<h3>NHƯNG một câu hỏi lớn tồn tại từ lâu vẫn còn đó: ngoài việc hiển thị các tiện ích chức năng thừa hưởng từ kỷ nguyên di động, lý do sâu xa cho sự tồn tại của danh mục thiết bị mới này trong cuộc sống chúng ta là gì?</h3>

<h1><strong>Với Halo, chúng tôi bắt đầu chia sẻ những suy nghĩ của mình về câu hỏi then chốt đó…</strong></h1>

<p><img src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/IMG_6586.webp?v=1753472675' ) . '" alt="" style="max-width: 100%; height: auto;"></p>',
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

<p><img src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/frameshot1_40065cb5-6714-4082-93a6-9d0c64393cd5_480x480.webp?v=1732101224' ) . '" alt="" style="max-width: 100%; height: auto;"></p>

<p>Hiển thị các ghim định vị / điều hướng AR đại diện cho các địa điểm yêu thích (POI) ngay trong tầm nhìn. Ứng dụng sử dụng cảm biến từ kế và gia tốc kế tích hợp của Frame truyền trực tiếp đến điện thoại để tính toán và cập nhật hướng nhìn đến từng điểm POI.<br><br>Hiện tại bản demo sử dụng tọa độ mẫu kinh độ/vĩ độ cho vị trí người dùng và hai điểm POI mẫu. (Việc kết nối GPS điện thoại thực tế và dịch vụ bản đồ để tìm kiếm tọa độ hoặc vị trí trực tiếp của bạn bè được để mở như một bài tập thực hành).</p>

<h3><a href="https://github.com/CitizenOneX/frame_locator_pin" target="_blank"><strong>Mã nguồn</strong></a> | <a href="https://discord.com/channels/963222352534048818/1105456402216009758/threads/1305481513457946624" target="_blank">Dự án</a></h3>

<hr style="margin: 32px 0; border: 0; border-top: 1px solid #333;">

<h2><strong>Generative AI trên Frame</strong></h2>

<p><img src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/frameshot3_480x480.webp?v=1732101676' ) . '" alt="" style="max-width: 100%; height: auto;"></p>

<p>Gửi câu lệnh (prompt) đến mô hình tạo ảnh miễn phí Pollinations.ai trên nền web để tạo ảnh và hiển thị trực tiếp lên kính Frame! Chạm vào ảnh trong ứng dụng để lưu hoặc chia sẻ tác phẩm của bạn!</p>

<h3><a href="https://github.com/CitizenOneX/frame_pollinations" target="_blank"><strong>Mã nguồn</strong></a> | <a href="https://discord.com/channels/963222352534048818/1105456402216009758/threads/1306806920425902122" target="_blank">Dự án</a></h3>

<hr style="margin: 32px 0; border: 0; border-top: 1px solid #333;">

<h3><strong>Trình xem Sprite trên Frame (Frame Sprite Viewer)</strong></h3>

<p><img src="' . esc_url( $theme_uri . '/site-assets/s/files/1/0722/5190/0215/files/image_480x480.png?v=1732102804' ) . '" alt="" style="max-width: 100%; height: auto;"></p>

<p>Trình hiển thị ảnh Sprite cho kính Frame. Hỗ trợ định dạng PNG và JPG. Tự động lượng tử hóa màu sắc xuống 16-bit và căn chỉnh kích thước ảnh phù hợp với bộ nhớ để hiển thị sắc nét trên Frame.</p>

<h3><a href="https://github.com/CitizenOneX/frame_progressive_sprite_viewer/releases" target="_blank"><strong>Mã nguồn</strong></a> | <a href="https://discord.com/channels/963222352534048818/1105456402216009758/threads/1285622884768809020" target="_blank">Dự án</a></h3>',
        ),

        array(
            'slug'        => 'hackathon-august-3rd-2024',
            'title'       => 'Hackathon: Ngày 3 tháng 8 năm 2024',
            'date'        => '2024-10-10 12:00:00',
            'category'    => 'brilliant-labs-team',
            'author_name' => 'Brilliant Labs',
            'excerpt'     => 'Chúng tôi rất vinh dự được đồng tổ chức sự kiện Hackathon cùng Niantic, nhà sáng tạo của tựa game Pokémon Go nổi tiếng!',
            'image'       => 'site-assets/cdn/shop/articles/Frame_hackathon_v001-15.jpg',
            'content'     => '<p>Chúng tôi rất vinh dự được đồng tổ chức sự kiện Hackathon cùng Niantic, nhà sáng tạo của tựa game Pokémon Go nổi tiếng!</p>

<p>Hơn 50 nhà phát triển tài năng từ khắp nơi trên toàn quốc — và cả quốc tế — đã tham gia cùng chúng tôi để xây dựng các ứng dụng độc đáo tại giao điểm giữa AI và thực tế tăng cường (AR) trên kính Frame.</p>

<p>Hãy cùng xem lại các video nổi bật từ sự kiện bên dưới!</p>

<p><a href="https://www.youtube.com/playlist?list=PLfbaC5GRVJJhwY0RtwPr9oa6gCkPJfi5Q" target="_blank" title="Hackathon - Ngày 3 tháng 8 năm 2024" rel="noopener noreferrer"><strong>👉 Xem danh sách phát video Hackathon - Ngày 3 tháng 8 năm 2024!</strong></a></p>',
        ),
    );

    // Required for media attachment insertion
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );

    // Check if we need to clean and update existing posts
    $force_update = ! get_option( 'bl_database_cleaned_v2' );

    foreach ( $posts_data as $p ) {
        $existing_post = get_page_by_path( $p['slug'], OBJECT, 'post' );

        if ( $existing_post ) {
            if ( $force_update ) {
                wp_update_post( array(
                    'ID'           => $existing_post->ID,
                    'post_title'   => $p['title'],
                    'post_content' => $p['content'],
                    'post_excerpt' => $p['excerpt'],
                ) );

                if ( isset( $cat_ids[ $p['category'] ] ) ) {
                    wp_set_post_categories( $existing_post->ID, array( $cat_ids[ $p['category'] ] ) );
                }

                if ( ! empty( $p['author_name'] ) ) {
                    update_post_meta( $existing_post->ID, '_bl_author_name', $p['author_name'] );
                }

                // Check featured image
                if ( ! has_post_thumbnail( $existing_post->ID ) ) {
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
                            $attach_id = wp_insert_attachment( $attachment, $upload_file['file'], $existing_post->ID );
                            $attach_data = wp_generate_attachment_metadata( $attach_id, $upload_file['file'] );
                            wp_update_attachment_metadata( $attach_id, $attach_data );
                            set_post_thumbnail( $existing_post->ID, $attach_id );
                        }
                    }
                }
            }
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

    update_option( 'bl_database_cleaned_v2', 1 );
    update_option( 'bl_database_seeded_v1', 1 );
}
add_action( 'init', 'bl_seed_database_posts', 20 );
