<?php
/**
 * Dynamic Template for Announcements & Blog Listing (Archive)
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );

// Determine active category from query var or current term
$current_cat = get_query_var( 'category_name' );
if ( empty( $current_cat ) && is_category() ) {
    $cat_obj = get_queried_object();
    $current_cat = $cat_obj ? $cat_obj->slug : '';
}

// Arguments for query
$query_args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 7,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

if ( ! empty( $current_cat ) ) {
    $query_args['category_name'] = $current_cat;
}

$blog_query = new WP_Query( $query_args );

$theme_uri = get_template_directory_uri();
?>
<!doctype html>
<html class="no-js" lang="vi">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="">
    <link rel="canonical" href="<?php echo esc_url( home_url( '/blogs/announcements/' ) ); ?>">
    <link rel="preconnect" href="https://cdn.shopify.com" crossorigin=""><link rel="icon" type="image/png" href="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/files/Artboard_1.jpg?crop=center&height=32&v=1707403926&width=32' ); ?>"><link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/files/Artboard_1-1.jpg?crop=center&height=180&v=1707403926&width=180' ); ?>">
    <link rel="manifest" href="<?php echo esc_url( $theme_uri . '/site-assets/site.webmanifest' ); ?>">

  <link href="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/t/24/assets/theme-f516ecd7.css' ); ?>" rel="stylesheet" type="text/css" media="all">
  <script src="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/t/24/assets/theme-4ed993c7.js' ); ?>" type="module" crossorigin="anonymous"></script>

    <title>Thông báo &ndash; Brilliant Labs</title>
    <meta name="description" content="Khám phá các thông báo, cập nhật kỹ thuật và bài viết mới nhất từ Brilliant Labs và cộng đồng mã nguồn mở.">

    <style>
      .blog-tag-buttons { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 24px; }
      .blog-tag-buttons .button { text-decoration: none; }
      .pagination-wrapper { margin-top: 40px; margin-bottom: 20px; }
      .article-card__image { width: 100%; height: 100%; object-fit: cover; }
    </style>
</head>
<body class="template-blog">
    <a class="skip-to-content-link button visually-hidden" href="#site-content">Chuyển đến nội dung</a>

    <!-- Site Header -->
    <header class="site-header header-group">
      <div class="container container--full-width">
        <div class="row row--align-center">
          <div class="col-auto">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo-link" title="Brilliant Labs">
              <svg class="header__logo" width="168" height="24" viewBox="0 0 168 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.66 0C5.22 0 0 5.22 0 11.66C0 18.1 5.22 23.32 11.66 23.32C18.1 23.32 23.32 18.1 23.32 11.66C23.32 5.22 18.1 0 11.66 0ZM11.66 19.32C7.43 19.32 4 15.89 4 11.66C4 7.43 7.43 4 11.66 4C15.89 4 19.32 7.43 19.32 11.66C19.32 15.89 15.89 19.32 11.66 19.32Z" fill="currentColor"/>
              </svg>
            </a>
          </div>
          <nav class="col header__nav text-right">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__nav-link">Trang chủ</a>
            <a href="<?php echo esc_url( home_url( '/products/halo/' ) ); ?>" class="header__nav-link">Halo</a>
            <a href="<?php echo esc_url( home_url( '/blogs/announcements/' ) ); ?>" class="header__nav-link active">Thông báo</a>
            <a href="<?php echo esc_url( home_url( '/developers/' ) ); ?>" class="header__nav-link">Nhà phát triển</a>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="header__nav-link">Liên hệ</a>
          </nav>
        </div>
      </div>
    </header>

    <main id="site-content" class="site-content" role="main">
      <div id="shopify-section-template--main" class="shopify-section">
        <link href="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/t/24/assets/section-main-blog.css' ); ?>" rel="stylesheet" type="text/css" media="all">
        <link href="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/t/24/assets/component-article-card.css' ); ?>" rel="stylesheet" type="text/css" media="all">

        <div class="blog blog--template--main container container--narrow" data-aos="fade-up">
          
          <!-- Category Filter Bar -->
          <div class="row">
            <div class="col-12 blog-tag-buttons">
              <a class="button <?php echo empty( $current_cat ) ? 'button--primary' : 'button--secondary'; ?>" href="<?php echo esc_url( home_url( '/blogs/announcements/' ) ); ?>" title="Mới nhất">
                Mới nhất
              </a>
              <a class="button <?php echo ( $current_cat === 'brilliant-labs-team' ) ? 'button--primary' : 'button--secondary'; ?>" href="<?php echo esc_url( home_url( '/blogs/announcements/tagged/brilliant-labs-team/' ) ); ?>" title="Đội ngũ Brilliant Labs">
                Đội ngũ Brilliant Labs
              </a>
              <a class="button <?php echo ( $current_cat === 'community' ) ? 'button--primary' : 'button--secondary'; ?>" href="<?php echo esc_url( home_url( '/blogs/announcements/tagged/community/' ) ); ?>" title="Cộng đồng">
                Cộng đồng
              </a>
              <a class="button <?php echo ( $current_cat === 'industry-updates' ) ? 'button--primary' : 'button--secondary'; ?>" href="<?php echo esc_url( home_url( '/blogs/announcements/tagged/industry-updates/' ) ); ?>" title="Cập nhật ngành">
                Cập nhật ngành
              </a>
            </div>
          </div>

          <?php if ( $blog_query->have_posts() ) : ?>
            <?php 
            $post_index = 0;
            $grid_open = false;
            ?>
            
            <?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); $post_index++; ?>
              <?php
              $thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
              if ( ! $thumb_url ) {
                  $thumb_url = $theme_uri . '/site-assets/cdn/shop/files/Artboard_1.jpg';
              }
              $post_link = home_url( '/blogs/announcements/' . $post->post_name . '/' );
              ?>

              <?php if ( $post_index === 1 && $paged == 1 ) : ?>
                <!-- Hero Featured Article (First Post) -->
                <div class="row">
                  <div class="col-12">
                    <div class="article-card article-card--grid">
                      <a class="image-link color-text hover-effect--zoom" href="<?php echo esc_url( $post_link ); ?>" title="<?php the_title_attribute(); ?>">
                        <div class="row row--align-center">
                          <div class="col-12 col-md-6">
                            <div class="article-card__image-wrapper image-ratio--square">
                              <img class="article-card__image hover-effect__image" src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" width="1280" height="720">
                            </div>
                          </div>
                          <div class="article-card__content col-12 col-md-6 text-left">
                            <p class="article-card__title h4 d-md-none"><?php the_title(); ?></p>
                            <p class="article-card__title h2 d-none d-md-block"><?php the_title(); ?></p>
                            <p class="article-card__excerpt">
                              <?php echo wp_strip_all_tags( get_the_excerpt() ); ?>
                            </p>
                            <p>
                              <?php echo get_the_date( 'd/m/Y' ); ?>
                              &nbsp;&mdash;&nbsp;<span class="underlined-link">Đọc bài viết</span>
                            </p>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              <?php else : ?>
                <?php if ( ! $grid_open ) : $grid_open = true; ?>
                  <div class="row">
                <?php endif; ?>

                <!-- Standard Article Card (3-column grid) -->
                <div class="col-12 col-md-4">
                  <div class="article-card article-card--standard">
                    <a class="image-link color-text hover-effect--zoom" href="<?php echo esc_url( $post_link ); ?>" title="<?php the_title_attribute(); ?>">
                      <div class="row row--align-center">
                        <div class="col-12">
                          <div class="article-card__image-wrapper image-ratio--square">
                            <img class="article-card__image hover-effect__image" src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" width="720" height="486">
                          </div>
                        </div>
                        <div class="article-card__content col-12 text-left">
                          <p class="article-card__title h4"><?php the_title(); ?></p>
                          <p class="article-card__excerpt">
                            <?php echo wp_strip_all_tags( get_the_excerpt() ); ?>
                          </p>
                          <p>
                            <?php echo get_the_date( 'd/m/Y' ); ?>
                            &nbsp;&mdash;&nbsp;<span class="underlined-link">Đọc bài viết</span>
                          </p>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              <?php endif; ?>
            <?php endwhile; ?>

            <?php if ( $grid_open ) : ?>
              </div><!-- /.row -->
            <?php endif; ?>

            <!-- Dynamic Pagination -->
            <?php if ( $blog_query->max_num_pages > 1 ) : ?>
              <link href="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/t/24/assets/component-pagination.css' ); ?>" rel="stylesheet" type="text/css" media="all">
              <div class="pagination-wrapper">
                <nav class="pagination" role="navigation" aria-label="Pagination">
                  <ul class="pagination__list" role="list">
                    <?php if ( $paged > 1 ) : ?>
                      <li>
                        <a class="pagination__item pagination__item--prev pagination__item--no-hover" href="<?php echo esc_url( add_query_arg( 'paged', $paged - 1 ) ); ?>" aria-label="Trang trước">
                          <svg class="icon icon-arrow-left-small" width="14" height="11" viewBox="0 0 14 11" fill="none"><path d="M0.7 5.16L5.05 9.6M0.7 5.16L5.01 0.6M0.7 5.16L12.7 5.09" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                      </li>
                    <?php endif; ?>

                    <?php for ( $i = 1; $i <= $blog_query->max_num_pages; $i++ ) : ?>
                      <li>
                        <?php if ( $i == $paged ) : ?>
                          <a class="pagination__item pagination__item--current" role="link" aria-current="page"><?php echo $i; ?></a>
                        <?php else : ?>
                          <a class="pagination__item color-foreground" href="<?php echo esc_url( add_query_arg( 'paged', $i ) ); ?>"><?php echo $i; ?></a>
                        <?php endif; ?>
                      </li>
                    <?php endfor; ?>

                    <?php if ( $paged < $blog_query->max_num_pages ) : ?>
                      <li>
                        <a class="pagination__item pagination__item--next pagination__item--no-hover" href="<?php echo esc_url( add_query_arg( 'paged', $paged + 1 ) ); ?>" aria-label="Trang sau">
                          <svg class="icon icon-arrow-right-small" width="14" height="11" viewBox="0 0 14 11" fill="none"><path d="M12.7 5.05L8.36 0.6M12.7 5.05L8.4 9.6M12.7 5.05L0.7 5.11" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                      </li>
                    <?php endif; ?>
                  </ul>
                </nav>
              </div>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>

          <?php else : ?>
            <div class="row">
              <div class="col-12 text-center" style="padding: 60px 0;">
                <h3>Chưa có bài viết nào trong danh mục này.</h3>
                <p><a href="<?php echo esc_url( home_url( '/blogs/announcements/' ) ); ?>" class="button button--primary">Xem tất cả bài viết</a></p>
              </div>
            </div>
          <?php endif; ?>

        </div>
      </div>

      <!-- Video Reviews Section -->
      <div id="shopify-section-featured_videos" class="shopify-section">
        <script src="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/t/24/assets/section-featured-videos.js' ); ?>" defer="defer"></script>
        <script src="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/t/24/assets/component-video.js' ); ?>" defer="defer"></script>
        <link href="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/t/24/assets/section-featured-videos.css' ); ?>" rel="stylesheet" type="text/css" media="all">
        <link href="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/t/24/assets/component-video.css' ); ?>" rel="stylesheet" type="text/css" media="all">
        <link href="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/t/24/assets/component-featured-video-card.css' ); ?>" rel="stylesheet" type="text/css" media="all">
        
        <featured-videos class="featured-videos featured-videos--desktop-carousel color-scheme--default no-js-hidden" data-featured-videos="">
          <div class="container container--narrow" data-aos="fade-up">
            <div class="section-heading section-heading--large section-heading--left">
              <div class="row row--align-center">
                <div class="col-md-6">
                  <h2 class="text-left">Đánh giá &amp; Trải nghiệm</h2>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="" data-index="1" data-featured-video="">
                  <component-video class="video">
                    <button class="video__button" type="button" aria-label="Phát video" data-video-play-button="">
                      <div class="video__image-wrapper">
                        <img class="video__image" src="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/files/Screenshot_2024-10-09_at_19.50.04_521f06c4-b990-4a94-b733-f236bfae26bc.jpg' ); ?>" alt="Video review" loading="lazy" width="1912" height="1021">
                      </div>
                      <span class="video__play"><svg class="icon icon-play" width="120" height="120" viewBox="0 0 120 120" fill="none"><circle cx="60" cy="60" r="60" fill="white"/><path d="M45 40V80L80 60L45 40Z" fill="black"/></svg></span>
                    </button>
                    <div class="video__wrapper responsive-video d-none" data-video-wrapper="">
                      <iframe data-src="https://www.youtube.com/embed/hBbrrNylidY" allow="autoplay; encrypted-media" allowfullscreen="" title="Kính thông minh Frame AI"></iframe>
                    </div>
                    <p class="video__title h4">Kính thông minh Frame AI: Bước tiến tiếp theo trong điện toán cá nhân</p>
                    <strong class="video__meta"><svg class="icon icon-youtube" width="32" height="32" viewBox="0 0 32 32" fill="none"><path d="M26.15 4.25C29.52 4.48 31.22 5.07 31.72 9.37C32.09 12.58 32.09 18.03 31.72 21.22C31.22 25.53 29.52 26.12 26.15 26.35C21.35 26.68 10.65 26.68 5.85 26.35C2.48 26.12 0.78 25.53 0.28 21.22C-0.09 18.02 -0.09 12.57 0.28 9.37C0.78 5.07 2.48 4.48 5.85 4.25C10.65 3.92 21.35 3.92 26.15 4.25ZM12.81 10.81V19.79L21.37 15.3L12.81 10.81Z" fill="#FF0000"/></svg>YouTube &mdash; 3:21</strong>
                  </component-video>
                </div>
              </div>

              <div class="col-12">
                <div class="featured-videos__carousel d-md-flex">
                  <div class="featured-videos__carousel-control featured-videos__carousel-control--prev d-none d-md-block" data-swiper-prev=""><svg class="icon icon-chevron-left" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M15.48 18.67L8.52 12.04L15.42 5.33" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                  <div class="featured-videos__carousel-control featured-videos__carousel-control--next d-none d-md-block" data-swiper-next=""><svg class="icon icon-chevron-right" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M8.52 5.33L15.48 11.96L8.59 18.67" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/></svg></div>

                  <div class="swiper" data-swiper="">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide">
                        <div class="featured-video-card">
                          <button class="featured-video-card__button hover-effect--zoom" type="button" data-index="1" data-featured-video-card-play-button="">
                            <div class="featured-video-card__image-wrapper">
                              <img class="featured-video-card__image hover-effect__image" src="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/files/Screenshot_2024-10-09_at_19.50.04_521f06c4-b990-4a94-b733-f236bfae26bc.jpg' ); ?>" alt="" loading="lazy" width="1912" height="1021">
                            </div>
                            <p class="featured-video-card__title font-heading">Kính thông minh Frame AI: Bước tiến tiếp theo trong điện toán cá nhân</p>
                            <span class="featured-video-card__meta p--bold">Phát video &mdash; 3:21</span>
                          </button>
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="featured-video-card">
                          <button class="featured-video-card__button hover-effect--zoom" type="button" data-index="2" data-featured-video-card-play-button="">
                            <div class="featured-video-card__image-wrapper">
                              <img class="featured-video-card__image hover-effect__image" src="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/files/Screenshot_2024-10-11_at_09.22.44.png' ); ?>" alt="" loading="lazy" width="976" height="419">
                            </div>
                            <p class="featured-video-card__title font-heading">Kính thông minh nhỏ gọn nhất có thể làm được những gì?</p>
                            <span class="featured-video-card__meta p--bold">Phát video &mdash; 3:21</span>
                          </button>
                        </div>
                      </div>
                      <div class="swiper-slide">
                        <div class="featured-video-card">
                          <button class="featured-video-card__button hover-effect--zoom" type="button" data-index="3" data-featured-video-card-play-button="">
                            <div class="featured-video-card__image-wrapper">
                              <img class="featured-video-card__image hover-effect__image" src="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/files/Screenshot_2024-10-09_at_19.56.21.png' ); ?>" alt="" loading="lazy" width="1914" height="1026">
                            </div>
                            <p class="featured-video-card__title font-heading">Kính thông minh AI nhẹ nhất với màn hình MICRO-OLED! Brilliant Labs Frame</p>
                            <span class="featured-video-card__meta p--bold">Phát video &mdash; 3:21</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </featured-videos>
      </div>

    </main>

    <!-- Footer -->
    <footer class="site-footer">
      <div class="container container--narrow text-center" style="padding: 40px 0; color: #888; font-size: 14px;">
        <p>&copy; <?php echo date( 'Y' ); ?> Brilliant Labs. Tất cả các quyền được bảo lưu.</p>
        <p>
          <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" style="color: #aaa; margin: 0 10px;">Chính sách bảo mật</a>
          <a href="<?php echo esc_url( home_url( '/terms-conditions/' ) ); ?>" style="color: #aaa; margin: 0 10px;">Điều khoản dịch vụ</a>
          <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" style="color: #aaa; margin: 0 10px;">Liên hệ</a>
        </p>
      </div>
    </footer>
</body>
</html>
