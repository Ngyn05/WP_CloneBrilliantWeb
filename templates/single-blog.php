<?php
/**
 * Dynamic Template for Single Blog Post (Brilliant Labs)
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

the_post();

$theme_uri = get_template_directory_uri();
$post_id   = get_the_ID();
$thumb_url = get_the_post_thumbnail_url( $post_id, 'full' );
if ( ! $thumb_url ) {
    $thumb_url = $theme_uri . '/site-assets/cdn/shop/files/Artboard_1.jpg';
}

$custom_author = get_post_meta( $post_id, '_bl_author_name', true );
if ( empty( $custom_author ) ) {
    $custom_author = get_the_author_meta( 'display_name' );
}
if ( empty( $custom_author ) ) {
    $custom_author = 'Brilliant Labs';
}

$hero_subtitle = get_post_meta( $post_id, '_bl_hero_subtitle', true );
$permalink     = get_permalink();
?>
<!doctype html>
<html class="no-js" lang="vi">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="">
    <link rel="canonical" href="<?php echo esc_url( $permalink ); ?>">
    <link rel="preconnect" href="https://cdn.shopify.com" crossorigin=""><link rel="icon" type="image/png" href="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/files/Artboard_1.jpg?crop=center&height=32&v=1707403926&width=32' ); ?>"><link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/files/Artboard_1-1.jpg?crop=center&height=180&v=1707403926&width=180' ); ?>">
    <link rel="manifest" href="<?php echo esc_url( $theme_uri . '/site-assets/site.webmanifest' ); ?>">

    <link href="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/t/24/assets/theme-f516ecd7.css' ); ?>" rel="stylesheet" type="text/css" media="all">
    <script src="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/t/24/assets/theme-4ed993c7.js' ); ?>" type="module" crossorigin="anonymous"></script>

    <title><?php the_title(); ?> &ndash; Brilliant Labs</title>
    <meta name="description" content="<?php echo esc_attr( wp_strip_all_tags( get_the_excerpt() ) ); ?>">

    <!-- Open Graph -->
    <meta property="og:site_name" content="Brilliant Labs">
    <meta property="og:url" content="<?php echo esc_url( $permalink ); ?>">
    <meta property="og:title" content="<?php the_title_attribute(); ?>">
    <meta property="og:type" content="article">
    <meta property="og:description" content="<?php echo esc_attr( wp_strip_all_tags( get_the_excerpt() ) ); ?>">
    <meta property="og:image" content="<?php echo esc_url( $thumb_url ); ?>">
</head>
<body class="template-article">
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

    <main id="site-content" class="site-content focus-none" role="main">
      
      <!-- Article Hero Section -->
      <div id="shopify-section-article-hero" class="shopify-section">
        <link href="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/t/24/assets/section-hero.css' ); ?>" rel="stylesheet" type="text/css" media="all">
        <script src="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/t/24/assets/component-share-button.js' ); ?>" defer="defer"></script>
        <link href="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/t/24/assets/component-share-button.css' ); ?>" rel="stylesheet" type="text/css" media="all">

        <div class="hero hero--grid hero--mobile-small hero--image-right hero--has-logo hero--share-button">
          <div class="hero__image-overlay"></div>
          <div class="hero__image-blur"></div>

          <div class="d-md-none">
            <img class="hero__background-image" src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" width="928" height="751">
          </div>
          <div class="d-none d-md-block">
            <img class="hero__background-image" src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" width="928" height="751">
          </div>

          <div class="container container--default">
            <div class="row">
              <div class="hero__content-column hero__content-column--grid hero__content-column--mobile-below_image hero__content-column--desktop-middle col-12 col-md-6 d-none d-md-flex" data-aos="fade-up">
                <div class="hero__content-wrapper">
                  <div class="hero__content hero__content--grid text-left text-md-left">
                    <span class="hero__date" itemprop="dateCreated pubdate datePublished">
                      <?php echo get_the_date( 'd/m/Y' ); ?>
                    </span>
                    <h1 class="hero__heading h2">
                      <?php the_title(); ?>
                    </h1>
                    <?php if ( ! empty( $hero_subtitle ) ) : ?>
                      <p class="hero__subtitle" style="font-size: 1.1em; color: #ccc; margin-top: 8px;"><?php echo esc_html( $hero_subtitle ); ?></p>
                    <?php endif; ?>

                    <share-button class="share-button">
                      <details class="share-button__details">
                        <summary class="button" data-share-button="">
                          <svg class="icon icon-share" width="13" height="13" viewBox="0 0 13 13" fill="none"><path d="M3.5 4L6.5 1L9.5 4M6.5 9V2M9 7H11L12 12H1L2 7H4" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/></svg>
                          <span>Chia sẻ</span>
                        </summary>
                        <div class="share-button__content">
                          <input type="text" class="share-button__input d-none" id="url" value="<?php echo esc_url( $permalink ); ?>" readonly="">
                          <button class="share-button__copy no-js-hidden" data-share-button-copy="" onclick="navigator.clipboard.writeText('<?php echo esc_js( $permalink ); ?>'); alert('Đã sao chép liên kết!');">
                            <svg class="icon icon-clipboard" width="13" height="15" viewBox="0 0 13 15" fill="none"><path d="M4 1H12V11M9 4H1V14H9V4Z" stroke="currentColor" stroke-linejoin="round"/></svg>
                            <span>Sao chép liên kết</span>
                          </button>
                        </div>
                      </details>
                    </share-button>
                  </div>
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="hero__image-wrapper d-none d-md-block">
                  <img class="hero__image hero__image--small" src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" width="928" height="751">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="hero-mobile-content d-md-none">
          <div class="container text-left" style="padding-top: 16px;">
            <span class="hero__date"><?php echo get_the_date( 'd/m/Y' ); ?></span>
            <h1 class="hero__heading h2"><?php the_title(); ?></h1>
          </div>
        </div>
      </div>

      <!-- Main Article Body -->
      <div id="shopify-section-main-article" class="shopify-section">
        <link href="<?php echo esc_url( $theme_uri . '/site-assets/cdn/shop/t/24/assets/section-main-article.css' ); ?>" rel="stylesheet" type="text/css" media="all">

        <article class="article main-section" itemscope="" itemtype="http://schema.org/BlogPosting">
          <div class="container container--extra-narrow" data-aos="fade-up">
            <div class="rte" itemprop="articleBody">
              <?php the_content(); ?>
            </div>

            <a class="article__back h2" href="<?php echo esc_url( home_url( '/blogs/announcements/' ) ); ?>">
              <svg class="icon icon-arrow-left-thick" width="25" height="20" viewBox="0 0 25 20" fill="none"><path d="M24.13 9.73C24.13 9.36 24.01 9.06 23.77 8.82C23.54 8.58 23.25 8.46 22.88 8.46L7.3 8.46L3.46 8.62L3.74 9.41L9.01 4.68L11.18 2.45C11.28 2.34 11.37 2.21 11.43 2.05C11.49 1.9 11.52 1.74 11.52 1.57C11.52 1.22 11.4 0.92 11.16 0.7C10.92 0.47 10.63 0.35 10.29 0.35C9.96 0.35 9.65 0.48 9.37 0.74L1.3 8.79C1.01 9.06 0.87 9.37 0.87 9.73C0.87 10.08 1.01 10.39 1.3 10.66L9.37 18.71C9.65 18.97 9.96 19.1 10.29 19.1C10.63 19.1 10.92 18.99 11.16 18.76C11.4 18.53 11.52 18.24 11.52 17.88C11.52 17.72 11.49 17.55 11.43 17.4C11.37 17.24 11.28 17.11 11.18 17.01L9.01 14.77L3.74 10.02L3.46 10.84L7.3 10.99L22.88 10.99C23.25 10.99 23.54 10.87 23.77 10.63C24.01 10.39 24.13 10.09 24.13 9.73Z" fill="currentColor"/></svg>
              <span>Quay lại Thông báo</span>
            </a>
          </div>
        </article>
      </div>

    </main>

    <!-- Schema JSON-LD -->
    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Article",
      "headline": <?php echo json_encode( get_the_title() ); ?>,
      "description": <?php echo json_encode( wp_strip_all_tags( get_the_excerpt() ) ); ?>,
      "image": [ <?php echo json_encode( $thumb_url ); ?> ],
      "datePublished": "<?php echo get_the_date( 'c' ); ?>",
      "dateModified": "<?php echo get_the_modified_date( 'c' ); ?>",
      "author": {
        "@type": "Person",
        "name": <?php echo json_encode( $custom_author ); ?>
      },
      "publisher": {
        "@type": "Organization",
        "name": "Brilliant Labs"
      }
    }
    </script>

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
