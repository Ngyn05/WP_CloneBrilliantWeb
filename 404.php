<?php
/**
 * 404 Not Found Template - Brilliant Việt Nam
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

status_header( 404 );
nocache_headers();
?>
<!doctype html>
<html class="no-js" lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?php echo esc_url( get_template_directory_uri() . '/favicon.ico?v=5' ); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url( get_template_directory_uri() . '/favicon.ico?v=5' ); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/favicon-32x32.png?v=5' ); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/favicon-16x16.png?v=5' ); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/apple-touch-icon.png?v=5' ); ?>">
    <title>404 – Không tìm thấy trang – Brilliant Việt Nam</title>
    <link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/theme-f516ecd7.css' ); ?>" rel="stylesheet" type="text/css" media="all">
    <?php wp_head(); ?>
    <style>
        body {
            background-color: #000000;
            color: #ffffff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .bl-404-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 80px 24px;
        }
        .bl-404-code {
            font-size: clamp(80px, 15vw, 160px);
            font-weight: 800;
            letter-spacing: -4px;
            line-height: 1;
            margin: 0 0 16px 0;
            background: linear-gradient(180deg, #ffffff 0%, #555555 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .bl-404-title {
            font-size: clamp(20px, 3vw, 28px);
            font-weight: 600;
            margin: 0 0 16px 0;
            color: #ffffff;
        }
        .bl-404-desc {
            font-size: 15px;
            color: #888888;
            max-width: 460px;
            line-height: 1.6;
            margin: 0 0 32px 0;
        }
        .bl-404-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 14px 32px;
            background: #ffffff;
            color: #000000;
            font-size: 14px;
            font-weight: 600;
            border-radius: 999px;
            text-decoration: none;
            transition: all 0.25s ease;
            box-shadow: 0 4px 20px rgba(255,255,255,0.15);
        }
        .bl-404-btn:hover {
            background: #e0e0e0;
            transform: translateY(-2px);
            box-shadow: 0 6px 24px rgba(255,255,255,0.25);
        }
        .bl-404-header {
            padding: 24px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #1a1a1a;
        }
        .bl-404-logo img {
            height: 30px;
            width: auto;
        }
    </style>
</head>
<body>
    <header class="bl-404-header">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bl-404-logo">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/BrilliantVietnam_logo_white.png?v=2' ); ?>" alt="Brilliant Việt Nam">
        </a>
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" style="color: #aaa; text-decoration: none; font-size: 14px;">Liên hệ hỗ trợ</a>
    </header>

    <main class="bl-404-container">
        <div class="bl-404-code">404</div>
        <h1 class="bl-404-title">Trang này không tồn tại hoặc đã bị xóa</h1>
        <p class="bl-404-desc">Đường dẫn bạn vừa truy cập không tìm thấy trên hệ thống của Brilliant Việt Nam. Vui lòng kiểm tra lại URL hoặc quay về trang chủ.</p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bl-404-btn">Quay lại Trang chủ</a>
    </main>

    <?php get_template_part( 'inc/site-footer' ); ?>
</body>
</html>
