<?php
/**
 * Dynamic Template for Single Product (WooCommerce & Brilliant Labs)
 * Powered by Unified Visual Editor (wp_editor)
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post, $wp_query;

$product_id = get_the_ID();
if ( ! $product_id || get_post_type( $product_id ) !== 'product' ) {
    $slug = get_query_var( 'name' );
    if ( ! $slug ) {
        $uri = trim( (string) parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' );
        $parts = explode( '/', $uri );
        if ( ( $parts[0] === 'product' || $parts[0] === 'products' ) && isset( $parts[1] ) ) {
            $slug = sanitize_title( $parts[1] );
        }
    }
    if ( $slug ) {
        $p = get_page_by_path( $slug, OBJECT, 'product' );
        if ( $p ) { $product_id = $p->ID; }
    }
}
if ( ! $product_id ) {
    $product_obj = get_page_by_path( 'halo', OBJECT, 'product' );
    $product_id = $product_obj ? $product_obj->ID : 0;
}

$product_title   = $product_id ? ( get_the_title( $product_id ) ?: 'N/A' ) : 'N/A';
$raw_price       = $product_id ? ( get_post_meta( $product_id, '_regular_price', true ) ?: get_post_meta( $product_id, '_price', true ) ) : '';
if ( $raw_price !== '' && $raw_price !== false && $raw_price !== 'N/A' ) {
    $num_price = floatval( preg_replace( '/[^0-9.]/', '', (string) $raw_price ) );
    $product_price = number_format( $num_price, 0, ',', '.' ) . ' ₫';
} else {
    $product_price = 'N/A';
}
$product_excerpt = $product_id ? get_post_field( 'post_excerpt', $product_id ) : '';
$product_content = $product_id ? get_post_field( 'post_content', $product_id ) : '';
$product_thumb   = $product_id ? get_the_post_thumbnail_url( $product_id, 'full' ) : '';

$is_halo = ( $product_id && get_post_field( 'post_name', $product_id ) === 'halo' );

// Lấy thông tin tình trạng kho hàng từ Database / WooCommerce
$stock_info = function_exists( 'bl_get_product_stock_info' ) 
    ? bl_get_product_stock_info( $product_id ) 
    : array(
        'status'    => 'instock',
        'text'      => 'Còn hàng',
        'badge_cls' => 'bl-stock-badge--instock',
        'dot_color' => '#22c55e',
        'available' => true,
    );

// ONE Unified Visual Editor Content from Metabox
$body_content = $product_id ? get_post_meta( $product_id, '_bl_product_body_content', true ) : '';
if ( empty( $body_content ) && $is_halo && function_exists( 'bl_get_default_product_layout_content' ) ) {
    $body_content = bl_get_default_product_layout_content();
}

// Dynamic gallery images
$gallery_urls = array();

// 1. Featured image (Ảnh đại diện sản phẩm)
$product_thumb_id = get_post_thumbnail_id( $product_id );
if ( $product_thumb_id ) {
    $thumb_url = wp_get_attachment_image_url( $product_thumb_id, 'full' );
    if ( $thumb_url ) {
        $gallery_urls[] = $thumb_url;
    }
}

// 2. Product Gallery (Thư viện hình ảnh sản phẩm)
$gallery_meta = $product_id ? get_post_meta( $product_id, '_product_image_gallery', true ) : '';
$gallery_ids = array();
if ( function_exists( 'wc_get_product' ) && ( $wc_prod = wc_get_product( $product_id ) ) ) {
    $gallery_ids = $wc_prod->get_gallery_image_ids();
}
if ( empty( $gallery_ids ) && ! empty( $gallery_meta ) ) {
    $gallery_ids = array_filter( array_map( 'trim', explode( ',', (string) $gallery_meta ) ) );
}

if ( ! empty( $gallery_ids ) ) {
    foreach ( $gallery_ids as $gid ) {
        $gurl = wp_get_attachment_image_url( $gid, 'full' );
        if ( $gurl && ! in_array( $gurl, $gallery_urls ) ) {
            $gallery_urls[] = $gurl;
        }
    }
}

// 3. Fallback for Halo if gallery is empty
if ( empty( $gallery_urls ) && $is_halo ) {
    $theme_uri = get_template_directory_uri();
    $gallery_urls = array(
        $theme_uri . '/site-assets/cdn/shop/files/Halo_1-11.png',
        $theme_uri . '/site-assets/cdn/shop/files/Halo_3b-11.png',
        $theme_uri . '/site-assets/cdn/shop/files/Halo_6b-11.png',
        $theme_uri . '/site-assets/cdn/shop/files/IMG_1348-11.jpg',
        $theme_uri . '/site-assets/cdn/shop/files/IMG_3255-13.jpg',
        $theme_uri . '/site-assets/cdn/shop/files/IMG_1253-15.jpg',
        $theme_uri . '/site-assets/cdn/shop/files/IMG_1350-10.jpg',
    );
}
?>
<!doctype html>
<html class="no-js" lang="vi">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="">
    <link rel="canonical" href="<?php echo esc_url( home_url( '/products/halo/' ) ); ?><link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/favicon-32x32.png?v=3' ); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/favicon-16x16.png?v=3' ); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/apple-touch-icon.png?v=3' ); ?>">
    <link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() . '/favicon.ico?v=3' ); ?>">
    ">
    <link rel="preconnect" href="https://cdn.shopify.com" crossorigin="">">">">
    <link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/site.webmanifest' ); ?>">

    


  <link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/theme-f516ecd7.css' ); ?>" rel="stylesheet" type="text/css" media="all">




  <script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/theme-4ed993c7.js' ); ?>" type="module" crossorigin="anonymous"></script>



    <title><?php echo esc_html( $product_title ); ?> &ndash; Brilliant Việt Nam</title><meta name="description" content="Giới thiệu Halo! Mã nguồn mở AI glasses for the curious, creative, and forward thinking.  Halo features a fresh design, reimagined optics and electronics, and Noa, your private conversational AI agent with long-term memory of your life. With Miniapps, Halo lets you build new experiences using natural language and shar">

<meta property="og:site_name" content="Brilliant Việt Nam">
<meta property="og:url" content="https://brilliant.xyz/products/halo">
<meta property="og:title" content="Halo">
<meta property="og:type" content="product">
<meta property="og:description" content="Giới thiệu Halo! Mã nguồn mở AI glasses for the curious, creative, and forward thinking.  Halo features a fresh design, reimagined optics and electronics, and Noa, your private conversational AI agent with long-term memory of your life. With Miniapps, Halo lets you build new experiences using natural language and shar"><meta property="og:image" content="http://brilliant.xyz/cdn/shop/files/Halo_1.png?v=1753738731">
  <meta property="og:image:secure_url" content="https://brilliant.xyz/cdn/shop/files/Halo_1.png?v=1753738731">
  <meta property="og:image:width" content="2200">
  <meta property="og:image:height" content="2200"><meta property="og:price:amount" content="399.00">
  <meta property="og:price:currency" content="USD"><meta name="twitter:site" content="@brilliantlabsar"><meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Halo">
<meta name="twitter:description" content="Giới thiệu Halo! Mã nguồn mở AI glasses for the curious, creative, and forward thinking.  Halo features a fresh design, reimagined optics and electronics, and Noa, your private conversational AI agent with long-term memory of your life. With Miniapps, Halo lets you build new experiences using natural language and shar">
<script>
  window.shopUrl = 'https://brilliant.xyz';
  window.moneyFormat = "${{amount}}";

  window.routes = {
    cart_add_url: '/cart/add',
    cart_change_url: '/cart/change',
    cart_update_url: '/cart/update',
    cart_url: '/cart',
    predictive_search_url: '/search/suggest'
  };

  window.headerStrings = {
    menu: `Menu`,
    close: `Close`,
    search: `Tìm kiếm`,
    close_search_bar: `Close search bar`
  }

  window.cartStrings = {
    error: `Đã có lỗi xảy ra khi cập nhật giỏ hàng. Vui lòng thử lại.`,
    quantityError: `Bạn chỉ có thể thêm tối đa [quantity] sản phẩm này vào giỏ hàng.`
  }

  window.variantStrings = {
    addToCart: `Mua ngay`,
    soldOut: `Hết hàng`,
    unavailable: `Không khả dụng`,
  }

  window.accessibilityStrings = {
    shareSuccess: `Đã sao chép liên kết vào bộ nhớ tạm`
  }
</script><style data-shopify="">@font-face {
  font-family: Archivo;
  font-weight: 400;
  font-style: normal;
  font-display: swap;
  src: url("../cdn/fonts/archivo/archivo_n4.dc8d917cc69af0a65ae04d01fd8eeab28a3573c9.woff2") format("woff2"),
       url("../cdn/fonts/archivo/archivo_n4.bd6b9c34fdb81d7646836be8065ce3c80a2cc984.woff") format("woff");
}

  @font-face {
  font-family: Archivo;
  font-weight: 700;
  font-style: normal;
  font-display: swap;
  src: url("../cdn/fonts/archivo/archivo_n7.651b020b3543640c100112be6f1c1b8e816c7f13.woff2") format("woff2"),
       url("../cdn/fonts/archivo/archivo_n7.7e9106d320e6594976a7dcb57957f3e712e83c96.woff") format("woff");
}

  @font-face {
  font-family: Archivo;
  font-weight: 400;
  font-style: italic;
  font-display: swap;
  src: url("../cdn/fonts/archivo/archivo_i4.37d8c4e02dc4f8e8b559f47082eb24a5c48c2908.woff2") format("woff2"),
       url("../cdn/fonts/archivo/archivo_i4.839d35d75c605237591e73815270f86ab696602c.woff") format("woff");
}

  @font-face {
  font-family: Archivo;
  font-weight: 700;
  font-style: italic;
  font-display: swap;
  src: url("../cdn/fonts/archivo/archivo_i7.3dc798c6f261b8341dd97dd5c78d97d457c63517.woff2") format("woff2"),
       url("../cdn/fonts/archivo/archivo_i7.3b65e9d326e7379bd5f15bcb927c5d533d950ff6.woff") format("woff");
}

  @font-face {
  font-family: Archivo;
  font-weight: 400;
  font-style: normal;
  font-display: swap;
  src: url("../cdn/fonts/archivo/archivo_n4.dc8d917cc69af0a65ae04d01fd8eeab28a3573c9.woff2") format("woff2"),
       url("../cdn/fonts/archivo/archivo_n4.bd6b9c34fdb81d7646836be8065ce3c80a2cc984.woff") format("woff");
}

  
  

  :root {
    --font-body-family: Archivo, sans-serif;
    --font-body-family: 'FFF Acid Grotesk', sans-serif;
    --font-body-style: normal;
    --font-body-weight: 400;
    --font-body-weight-bold: 700;
    --font-body-scale: 0.8;
    --font-body-letter-spacing: 0.0;
    --font-body-transform:initial;
    --font-body-underlined-link-transform:uppercase;

    --font-heading-family: Archivo, sans-serif;
    --font-heading-family: 'FFF Acid Grotesk', sans-serif;
    --font-heading-style: normal;
    --font-heading-weight: 400;
    --font-heading-scale: 1.0;
    --font-heading-letter-spacing: -0.02;
    --font-heading-transform:initial;

    --font-menu-family: Helvetica, Arial, sans-serif;
    --font-menu-family: 'FFF Acid Grotesk', sans-serif;
    --font-menu-style: normal;
    --font-menu-weight: 700;
    --font-menu-scale: 0.5;
    --font-menu-letter-spacing: 0.0;
    --font-menu-transform:initial;
    --font-menu-toggle-transform:uppercase;
    --font-megamenu-menu-1-transform:uppercase;

    --font-button-family: Helvetica, Arial, sans-serif;
    --font-button-family: 'FFF Acid Grotesk', sans-serif;
    --font-button-style: normal;
    --font-button-weight: 700;
    --font-button-scale: 1.0;
    --font-button-letter-spacing: 0.04;
    --font-button-transform:uppercase;

    --color-background: #0F0F0F;
    --color-foreground: #041d31;
    --color-text: #FFFFFF;
    --color-text-rgb: 255, 255, 255;
    --color-link: #d9ddef;
    --color-primary-button-background: #ffffff;
    --color-primary-button-hover-background: #FFFFFF;
    --color-primary-button-text: #011423;
    --color-primary-button-hover-text: #011423;
    --color-secondary-button-background: #ffffff;
    --color-secondary-button-hover-background: #ffffff;
    --color-secondary-button-text: #000000;
    --color-secondary-button-hover-text: #011423;
    --color-disabled: #E8E8E8;
    --color-disabled-text: #000000;
    --color-announcement-bar-background: #000000;
    --color-announcement-bar-text: #FFFFFF;
    --color-header-background: ;
    --color-header-text: #FFFFFF;
    --color-transparent-header-text: #FFFFFF;
    --color-header-cart-icon-count-circle: #f0b504;
    --color-header-cart-icon-count-circle-text: #000000;
    --color-footer-background: #000000;
    --color-footer-text: #FFFFFF;
    --color-product-sale-badge-text: #011423;
    --color-product-sale-badge-background: #0191d8;
    --color-product-new-badge-text: #000000;
    --color-product-new-badge-background: #D7FC52;
    --color-product-best-seller-badge-text: #000000;
    --color-product-best-seller-badge-background: #D8DDEF;
    --color-product-sale-price: #f0b504;
    --color-product-unit-price: #FFFFFF;
    --color-product-zoom-button-background: #FFFFFF;
    --color-product-zoom-button-icon: #000000;
    --color-product-rating-star: #f0b504;
    --color-product-empty-rating-star: #FFFFFF;
    --color-product-slideshow-background: rgba(255, 255, 255, 0);
    --color-product-slideshow-progress-bar: #FFFFFF;
    --color-product-slideshow-progress-bar-rgb: 255, 255, 255;
    --color-product-slideshow-progress-bar-shadow-rgb: 0, 0, 0;
    --color-product-slideshow-arrow-icon: #000000;
    --color-slideshow-progress-bar: #FFFFFF;
    --color-slideshow-progress-bar-rgb: 255, 255, 255;
    --color-slideshow-progress-bar-shadow-rgb: 0, 0, 0;
    --color-slideshow-arrow-icon: #000000;
    --color-drawer-overlay: rgba(0, 0, 0, 0.5);
    --color-drawer-overlay-full: #000000;
    --color-social-gallery-icon: #FFFFFF;
    --color-article-card-background: #D7FC52;
    --color-article-card-text: #000000;
    --color-article-card-button-background: #000000;
    --color-article-card-button-hover-background: #000000;
    --color-article-card-button-text: #FFFFFF;
    --color-border: #ffffff;
    --color-scheme-1-background: #F8F8F8;
    --color-scheme-1-foreground: #011423;
    --color-scheme-1-text: #000000;
    --color-scheme-1-text-rgb: 0, 0, 0;
    --color-scheme-1-link: #000000;
    --color-scheme-1-button-background: #000000;
    --color-scheme-1-button-hover-background: #2B2B2B;
    --color-scheme-1-button-text: #FFFFFF;
    --color-scheme-1-button-hover-text: #FFFFFF;
    --color-scheme-2-background: #000000;
    --color-scheme-2-foreground: #2B2B2B;
    --color-scheme-2-text: #FFFFFF;
    --color-scheme-2-text-rgb: 255, 255, 255;
    --color-scheme-2-link: #FFFFFF;
    --color-scheme-2-button-background: #FFFFFF;
    --color-scheme-2-button-hover-background: #2B2B2B;
    --color-scheme-2-button-text: #000000;
    --color-scheme-2-button-hover-text: #FFFFFF;
    --color-scheme-3-background: #041d31;
    --color-scheme-3-foreground: #011423;
    --color-scheme-3-text: #ffffff;
    --color-scheme-3-text-rgb: 255, 255, 255;
    --color-scheme-3-link: #f0b504;
    --color-scheme-3-button-background: #f0b504;
    --color-scheme-3-button-hover-background: #ffffff;
    --color-scheme-3-button-text: #011423;
    --color-scheme-3-button-hover-text: #011423;

    --site-max-width: 1600px;

    --button-border-radius: 40px;
    --image-border-radius: 16px;
    --video-border-radius: 32px;
    --drawer-border-radius: 16px;

    --icon-thickness: 1;

    --highlight-gradient: linear-gradient(15deg, #f288bf, #f288bf);
  }</style><link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/theme.css?v=180686215979939108301752050580' ); ?>" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/vendor.css?v=62675651013478167521752050583' ); ?>" rel="stylesheet" type="text/css" media="all">
<noscript>
        <style>
          [data-aos] {
            transform: none !important;
            opacity: initial !important;
          }
        </style>
      </noscript><link rel="preconnect" href="https://fonts.shopifycdn.com" crossorigin=""><link rel="preload" as="font" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/fonts/archivo/archivo_n4.dc8d917cc69af0a65ae04d01fd8eeab28a3573c9.woff2' ); ?>" type="font/woff2" crossorigin=""><link rel="preload" as="font" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/fonts/archivo/archivo_n4.dc8d917cc69af0a65ae04d01fd8eeab28a3573c9.woff2' ); ?>" type="font/woff2" crossorigin=""><script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/vendor.js?v=36535082300241826051752050579' ); ?>" defer="defer"></script>
    <script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/theme.js?v=42167515228863085771752050581' ); ?>" defer="defer"></script>

    <script>window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.start');</script><meta id="shopify-digital-wallet" name="shopify-digital-wallet" content="/72251900215/digital_wallets/dialog">
<meta name="shopify-checkout-api-token" content="c671072bced9ec6f92aee2c19648f979">
<link rel="alternate" type="application/json+oembed" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/products/halo.oembed' ); ?>">
<script async="async" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/checkouts/internal/preloads.js?locale=en-VN&default_configuration_id=805404983' ); ?>"></script>
<link rel="preconnect" href="https://shop.app" crossorigin="anonymous">
<script async="async" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/checkouts/internal/preloads-1.js?locale=en-VN&default_configuration_id=805404983&shop_id=72251900215' ); ?>" crossorigin="anonymous"></script>
<script id="apple-pay-shop-capabilities" type="application/json">{"shopId":72251900215,"countryCode":"HK","currencyCode":"USD","merchantCapabilities":["supports3DS"],"merchantId":"gid:\/\/shopify\/Shop\/72251900215","merchantName":"Brilliant Labs","requiredBillingContactFields":["postalAddress","email","phone"],"requiredShippingContactFields":["postalAddress","email","phone"],"shippingType":"shipping","supportedNetworks":["visa","masterCard","amex"],"total":{"type":"pending","label":"Brilliant Labs","amount":"1.00"},"shopifyPaymentsEnabled":true,"supportsSubscriptions":true}</script>
<script id="shopify-features" type="application/json">{"accessToken":"c671072bced9ec6f92aee2c19648f979","betas":["rich-media-storefront-analytics"],"domain":"brilliant.xyz","predictiveSearch":true,"shopId":72251900215,"locale":"en"}</script>
<script>var Shopify = Shopify || {};
Shopify.shop = "brilliant-labs-9526.myshopify.com";
Shopify.locale = "en";
Shopify.currency = {"active":"USD","rate":"1.0"};
Shopify.country = "VN";
Shopify.theme = {"name":"brilliant-labs-theme\/build-new-Halo","id":179256688951,"schema_name":"Creator","schema_version":"3.2.2","theme_store_id":null,"role":"main"};
Shopify.theme.handle = "null";
Shopify.theme.style = {"id":null,"handle":null};
Shopify.cdnHost = "brilliant.xyz/cdn";
Shopify.routes = Shopify.routes || {};
Shopify.routes.root = "/";
Shopify.shopJsCdnBaseUrl = "https://cdn.shopify.com/shopifycloud/shop-js";
Shopify.SignInWithShop = Shopify.SignInWithShop || {};
Shopify.SignInWithShop.User = Shopify.SignInWithShop.User || {};
Shopify.SignInWithShop.User.recognized = false;</script>
<script type="module">!function(o){(o.Shopify=o.Shopify||{}).modules=!0}(window);</script>
<script>!function(o){function n(){var o=[];function n(){o.push(Array.prototype.slice.apply(arguments))}return n.q=o,n}var t=o.Shopify=o.Shopify||{};t.loadFeatures=n(),t.autoloadFeatures=n()}(window);</script>
<script>
  window.ShopifyPay = window.ShopifyPay || {};
  window.ShopifyPay.apiHost = "shop.app\/pay";
  window.ShopifyPay.redirectState = null;
</script>
<script>
  window.Shopify = window.Shopify || {};
  window.Shopify.SignInWithShop = window.Shopify.SignInWithShop || {};
  window.Shopify.SignInWithShop.assetMetrics = { sampleRate: 0.25 };
  window.Shopify.SignInWithShop.eligible = true;
</script>
<script id="shop-js-analytics" type="application/json">{"pageType":"product"}</script>
<script defer="defer" async="" type="module" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shopifycloud/shop-js/modules/v2/loader.init-shop-cart-sync.en.esm.js' ); ?>"></script>
<script type="module">
  await import("//brilliant.xyz/cdn/shopifycloud/shop-js/modules/v2/loader.init-shop-cart-sync.en.esm.js");

  window.Shopify.SignInWithShop?.initShopCartSync?.({"fedCMEnabled":true,"windoidEnabled":true});

</script>
<script>
  window.Shopify = window.Shopify || {};
  if (!window.Shopify.featureAssets) window.Shopify.featureAssets = {};
  window.Shopify.featureAssets['shop-js'] = {"shop-toast-manager":["modules/v2/loader.shop-toast-manager.en.esm.js"],"shop-cash-offers":["modules/v2/loader.shop-cash-offers.en.esm.js"],"listener":["modules/v2/loader.listener.en.esm.js"],"init-windoid":["modules/v2/loader.init-windoid.en.esm.js"],"init-shop-user-recognition":["modules/v2/loader.init-shop-user-recognition.en.esm.js"],"checkout-modal":["modules/v2/loader.checkout-modal.en.esm.js"],"shop-button":["modules/v2/loader.shop-button.en.esm.js"],"init-fed-cm":["modules/v2/loader.init-fed-cm.en.esm.js"],"init-shop-email-lookup-coordinator":["modules/v2/loader.init-shop-email-lookup-coordinator.en.esm.js"],"init-shop-cart-sync":["modules/v2/loader.init-shop-cart-sync.en.esm.js"],"shop-login-button":["modules/v2/loader.shop-login-button.en.esm.js"],"avatar":["modules/v2/loader.avatar.en.esm.js"],"init-customer-accounts-sign-up":["modules/v2/loader.init-customer-accounts-sign-up.en.esm.js"],"init-customer-accounts":["modules/v2/loader.init-customer-accounts.en.esm.js"],"pay-button":["modules/v2/loader.pay-button.en.esm.js"],"shop-cart-sync":["modules/v2/loader.shop-cart-sync.en.esm.js"],"init-shop-for-new-customer-accounts":["modules/v2/loader.init-shop-for-new-customer-accounts.en.esm.js"],"shop-user-recognition":["modules/v2/loader.shop-user-recognition.en.esm.js"],"shop-login":["modules/v2/loader.shop-login.en.esm.js"],"shop-follow-button":["modules/v2/loader.shop-follow-button.en.esm.js"],"lead-capture":["modules/v2/loader.lead-capture.en.esm.js"],"payment-terms":["modules/v2/loader.payment-terms.en.esm.js"]};
</script>
<script>(function() {
  var isLoaded = false;
  function asyncLoad() {
    if (isLoaded) return;
    isLoaded = true;
    var urls = ["https:\/\/chimpstatic.com\/mcjs-connected\/js\/users\/9b3886f6120dcc525fe12ff49\/5828b8ef7c29046a52cb91ef5.js?shop=brilliant-labs-9526.myshopify.com","\/\/www.powr.io\/powr.js?powr-token=brilliant-labs-9526.myshopify.com\u0026external-type=shopify\u0026shop=brilliant-labs-9526.myshopify.com","https:\/\/cdn-app.sealsubscriptions.com\/shopify\/public\/js\/sealsubscriptions.js?shop=brilliant-labs-9526.myshopify.com"];
    for (var i = 0; i < urls.length; i++) {
      var s = document.createElement('script');
      s.type = 'text/javascript';
      s.async = true;
      s.src = urls[i];
      var x = document.getElementsByTagName('script')[0];
      x.parentNode.insertBefore(s, x);
    }
  };
  if(window.attachEvent) {
    window.attachEvent('onload', asyncLoad);
  } else {
    window.addEventListener('load', asyncLoad, false);
  }
})();</script>
<script id="__st">var __st={"a":72251900215,"offset":28800,"reqid":"858cfed9-6613-4493-9b83-772bd0a55fc6-1787126603","pageurl":"brilliant.xyz\/products\/halo","u":"be34fdd690c1","p":"product","rtyp":"product","rid":10217206972727};</script>
<script>window.ShopifyPaypalV4VisibilityTracking = true;</script>
<script id="captcha-bootstrap">!function(){'use strict';const t='contact',e='account',n='new_comment',o=[[t,t],['blogs',n],['comments',n],[t,'customer']],c=[[e,'customer_login'],[e,'guest_login'],[e,'recover_customer_password'],[e,'create_customer']],r=t=>t.map((([t,e])=>`form[action*='/${t}']:not([data-nocaptcha='true']) input[name='form_type'][value='${e}']`)).join(','),a=t=>()=>t?[...document.querySelectorAll(t)].map((t=>t.form)):[];function s(){const t=[...o],e=r(t);return a(e)}const i='password',u='form_key',d=['recaptcha-v3-token','g-recaptcha-response','h-captcha-response',i],f=()=>{try{return window.sessionStorage}catch{return}},m='__shopify_v',_=t=>t.elements[u];function p(t,e,n=!1){try{const o=window.sessionStorage,c=JSON.parse(o.getItem(e)),{data:r}=function(t){const{data:e,action:n}=t;return t[m]||n?{data:e,action:n}:{data:t,action:n}}(c);for(const[e,n]of Object.entries(r))t.elements[e]&&(t.elements[e].value=n);n&&o.removeItem(e)}catch(o){console.error('form repopulation failed',{error:o})}}const l='form_type',E='cptcha';function T(t){t.dataset[E]=!0}const w=window,h=w.document,L='Shopify',v='ce_forms',y='captcha';let A=!1;((t,e)=>{const n=(g='f06e6c50-85a8-45c8-87d0-21a2b65856fe',I='https://cdn.shopify.com/shopifycloud/storefront-forms-hcaptcha/ce_storefront_forms_captcha_hcaptcha.v1.5.2.iife.js',D={infoText:'Protected by hCaptcha',privacyText:'Privacy',termsText:'Điều khoản'},(t,e,n)=>{const o=w[L][v],c=o.bindForm;if(c)return c(t,g,e,D).then(n);var r;o.q.push([[t,g,e,D],n]),r=I,A||(h.body.append(Object.assign(h.createElement('script'),{id:'captcha-provider',async:!0,src:r})),A=!0)});var g,I,D;w[L]=w[L]||{},w[L][v]=w[L][v]||{},w[L][v].q=[],w[L][y]=w[L][y]||{},w[L][y].protect=function(t,e){n(t,void 0,e),T(t)},Object.freeze(w[L][y]),function(t,e,n,w,h,L){const[v,y,A,g]=function(t,e,n){const i=e?o:[],u=t?c:[],d=[...i,...u],f=r(d),m=r(i),_=r(d.filter((([t,e])=>n.includes(e))));return[a(f),a(m),a(_),s()]}(w,h,L),I=t=>{const e=t.target;return e instanceof HTMLFormElement?e:e&&e.form},D=t=>v().includes(t);t.addEventListener('submit',(t=>{const e=I(t);if(!e)return;const n=D(e)&&!e.dataset.hcaptchaBound&&!e.dataset.recaptchaBound,o=_(e),c=g().includes(e)&&(!o||!o.value);(n||c)&&t.preventDefault(),c&&!n&&(function(t){try{if(!f())return;!function(t){const e=f();if(!e)return;const n=_(t);if(!n)return;const o=n.value;o&&e.removeItem(o)}(t);const e=Array.from(Array(32),(()=>Math.random().toString(36)[2])).join('');!function(t,e){_(t)||t.append(Object.assign(document.createElement('input'),{type:'hidden',name:u})),t.elements[u].value=e}(t,e),function(t,e){const n=f();if(!n)return;const o=[...t.querySelectorAll(`input[type='${i}']`)].map((({name:t})=>t)),c=[...d,...o],r={};for(const[a,s]of new FormData(t).entries())c.includes(a)||(r[a]=s);n.setItem(e,JSON.stringify({[m]:1,action:t.action,data:r}))}(t,e)}catch(e){console.error('failed to persist form',e)}}(e),e.submit())}));const S=(t,e)=>{t&&!t.dataset[E]&&(n(t,e.some((e=>e===t))),T(t))};for(const o of['focusin','change'])t.addEventListener(o,(t=>{const e=I(t);D(e)&&S(e,y())}));const B=e.get('form_key'),M=e.get(l),P=B&&M;t.addEventListener('DOMContentLoaded',(()=>{const t=y();if(P)for(const e of t)e.elements[l].value===M&&p(e,B);[...new Set([...A(),...v().filter((t=>'true'===t.dataset.shopifyCaptcha))])].forEach((e=>S(e,t)))}))}(h,new URLSearchParams(w.location.search),n,t,e,['guest_login'])})(!0,!0)}();</script>
<script integrity="sha256-JjoPp5ZfB1sSAs5SQaol1x1GgvveM+BgmRzyDexInEQ=" data-source-attribution="shopify.loadfeatures" defer="defer" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shopifycloud/storefront/assets/storefront/load_feature-1bd60354.js' ); ?>" crossorigin="anonymous"></script>
<script>(function () {var userAgent = navigator.userAgent;var platform = navigator.platform;var maxTouchPoints = navigator.maxTouchPoints || 0;var isIOS = /iPad|iPhone|iPod/.test(platform) || (platform === 'MacIntel' && maxTouchPoints > 1);var isMacSafari = platform.indexOf('Mac') === 0 && /Safari/.test(userAgent) && !/Chrome|Chromium|CriOS|FxiOS|Edg|OPR|Android/.test(userAgent);var isAppleSafari = isIOS || isMacSafari;if (isAppleSafari) {fetch('/sf_private_access_tokens' + location.search).catch(function () {});}function browserMajorVersion(pattern) {var match = userAgent.match(pattern);return match ? parseInt(match[1], 10) : null;}function shouldLoadAutosizesPolyfill() {if (!window.PerformanceObserver?.supportedEntryTypes?.includes('paint')) {return false;}var chromeVersion = browserMajorVersion(/Chrome\/(\d+)/);if (chromeVersion !== null) {return chromeVersion < 126;}var firefoxVersion = browserMajorVersion(/Firefox\/(\d+)/);if (firefoxVersion !== null) {return firefoxVersion < 150;}var safariVersion = isAppleSafari ? browserMajorVersion(/Version\/(\d+).*Safari\//) : null;if (safariVersion !== null) {return safariVersion < 27;}return true;}if (shouldLoadAutosizesPolyfill()) {var autosizesScript = document.createElement('script');autosizesScript.async = true;autosizesScript.crossOrigin = 'anonymous';autosizesScript.src = "//brilliant.xyz/cdn/shopifycloud/storefront/assets/storefront/autosizes-84416378.js";(document.head || document.documentElement).appendChild(autosizesScript);}window.ShopifyAnalytics = window.ShopifyAnalytics || {};window.ShopifyAnalytics.performance = window.ShopifyAnalytics.performance || {};(function () {var LONG_FRAME_THRESHOLD = 50;var longAnimationFrames = [];var activeRafId = null;function collectLongFrames() {var previousTime = null;function rafMonitor(now) {if (activeRafId === null) {return;}var delta = now - previousTime;if (delta > LONG_FRAME_THRESHOLD) {longAnimationFrames.push({startTime: previousTime,endTime: now,});}previousTime = now;activeRafId = requestAnimationFrame(rafMonitor);}previousTime = performance.now();activeRafId = requestAnimationFrame(rafMonitor);}if (!window.PerformanceObserver?.supportedEntryTypes?.includes('long-animation-frame')) {collectLongFrames();var timeoutId = setTimeout(function () {cancelAnimationFrame(activeRafId);}, 10000);window.ShopifyAnalytics.performance.getLongAnimationFrames = function (stopCollection) {if (stopCollection === undefined) {stopCollection = false;}if (stopCollection) {clearTimeout(timeoutId);cancelAnimationFrame(activeRafId);}return longAnimationFrames;};}})();})();</script><script crossorigin="anonymous" defer="defer" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shopifycloud/storefront/assets/shopify_pay/storefront-bf1cdb70.js?v=20250812' ); ?>"></script>
<script id="shopify-origin-trials" async="async" integrity="sha256-mqQjA+yhr1DtPsW5MhDIq3zDu+LghfjNT49r/ttG3eY=" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/shopifycloud/storefront/assets/storefront/origin_trials-5059b83f.js' ); ?>" crossorigin="anonymous" onload="window.__shopifyOriginTrialsDone = true" onerror="window.__shopifyOriginTrialsDone = true"></script>
<script>
  window.Shopify = window.Shopify || {};
  window.Shopify.MCP = window.Shopify.MCP || {};
  window.Shopify.MCP.enabled = true;
  window.Shopify.MCP.shop = "brilliant-labs-9526.myshopify.com";
  window.Shopify.MCP.mcpEndpoint = "https:\/\/brilliant.xyz\/api\/mcp";
  window.Shopify.MCP.tools = [{"name":"search_shop_policies_and_faqs","description":"Used to get facts about the stores policies, products, or services.\nSome examples of questions you can ask are:\n  - What is your return policy?\n  - What is your shipping policy?\n  - What is your phone number?\n  - What are your hours of operation?\"\n","inputSchema":{"$schema":"https:\/\/json-schema.org\/draft\/2020-12\/schema","type":"object","properties":{"query":{"type":"string","description":"A natural language query."},"context":{"type":"string","description":"Additional information about the request such as user demographics, mood, location, or other relevant details that could help in tailoring the response appropriately."}},"required":["query"]}}];
</script>
<script>(()=>{var d="shopify:webmcp_adapter_loaded",n=Symbol.for("shopify.webmcp_adapter_loading");function s(c,a,{win:r=window,doc:o=document}={}){function p(){try{return r.localStorage.getItem(d)==="true"}catch{return!1}}function l(){try{r.localStorage.setItem(d,"true")}catch{}}function u(){return typeof(o.modelContext||r.navigator?.modelContext)?.registerTool=="function"}function f(){if(r[n]||!u())return;let t=o.head||o.getElementsByTagName("head")[0];if(!t)return;let e=o.createElement("script");e.type="module",e.crossOrigin="anonymous",a&&(e.integrity=a),e.src=c,e.addEventListener("load",l,{once:!0}),e.addEventListener("error",()=>{r[n]=!1},{once:!0}),t.appendChild(e),r[n]=!0}function _(t){let e=o.getElementById("shopify-origin-trials");if(!e||r.__shopifyOriginTrialsDone){t();return}e.addEventListener("load",t,{once:!0}),e.addEventListener("error",t,{once:!0})}function i(){_(()=>r.setTimeout(f,0))}function m(){o.addEventListener("DOMContentLoaded",i,{once:!0})}p()?i():m()}s("https:\/\/cdn.shopify.com\/storefront\/webmcp\/webmcp-0.1.1.js","");})();
</script>
<script data-source-attribution="shopify.dynamic_checkout.dynamic.init">var Shopify=Shopify||{};Shopify.PaymentButton=Shopify.PaymentButton||{isStorefrontPortableWallets:!0,init:function(){window.Shopify.PaymentButton.init=function(){};var t=document.createElement("script");t.src="<?php echo esc_url( home_url( '/cdn/shopifycloud/portable-wallets/latest/portable-wallets.en.js/' ) ); ?>",t.type="module",document.head.appendChild(t)}};
</script>
<script data-source-attribution="shopify.dynamic_checkout.buyer_consent">
  function portableWalletsHideBuyerConsent(e){var t=document.getElementById("shopify-buyer-consent"),n=document.getElementById("shopify-subscription-policy-button");t&&n&&(t.classList.add("hidden"),t.setAttribute("aria-hidden","true"),n.removeEventListener("click",e))}function portableWalletsShowBuyerConsent(e){var t=document.getElementById("shopify-buyer-consent"),n=document.getElementById("shopify-subscription-policy-button");t&&n&&(t.classList.remove("hidden"),t.removeAttribute("aria-hidden"),n.addEventListener("click",e))}window.Shopify?.PaymentButton&&(window.Shopify.PaymentButton.hideBuyerConsent=portableWalletsHideBuyerConsent,window.Shopify.PaymentButton.showBuyerConsent=portableWalletsShowBuyerConsent);
</script>
<script data-source-attribution="shopify.dynamic_checkout.cart.bootstrap">document.addEventListener("DOMContentLoaded",(function(){function t(){return document.querySelector("shopify-accelerated-checkout-cart, shopify-accelerated-checkout")}if(t())Shopify.PaymentButton.init();else{new MutationObserver((function(e,n){t()&&(Shopify.PaymentButton.init(),n.disconnect())})).observe(document.body,{childList:!0,subtree:!0})}}));
</script>
<link id="shopify-accelerated-checkout-styles" rel="stylesheet" media="screen" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shopifycloud/portable-wallets/latest/accelerated-checkout-backwards-compat.css' ); ?>" crossorigin="anonymous">
<style id="shopify-accelerated-checkout-cart">
        #shopify-buyer-consent {
  margin-top: 1em;
  display: inline-block;
  width: 100%;
}

#shopify-buyer-consent.hidden {
  display: none;
}

#shopify-subscription-policy-button {
  background: none;
  border: none;
  padding: 0;
  text-decoration: underline;
  font-size: inherit;
  cursor: pointer;
}

#shopify-subscription-policy-button::before {
  box-shadow: none;
}

      </style>

<script id="shopify-cfh-end">window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.end');</script>
  <script>window.is_hulkpo_installed=true</script>

<link href="https://monorail-edge.shopifysvc.com" rel="dns-prefetch">
<script>(function(){if ("sendBeacon" in navigator && "performance" in window) {try {var session_token_from_headers = performance.getEntriesByType('navigation')[0].serverTiming.find(x => x.name == '_s').description;} catch {var session_token_from_headers = undefined;}var session_cookie_matches = document.cookie.match(/_shopify_s=([^;]*)/);var session_token_from_cookie = session_cookie_matches && session_cookie_matches.length === 2 ? session_cookie_matches[1] : "";var session_token = session_token_from_headers || session_token_from_cookie || "";function handle_abandonment_event(e) {var entries = performance.getEntries().filter(function(entry) {return /monorail-edge.shopifysvc.com/.test(entry.name);});if (!window.abandonment_tracked && entries.length === 0) {window.abandonment_tracked = true;var currentMs = Date.now();var navigation_start = performance.timing.navigationStart;var payload = {shop_id: 72251900215,url: window.location.href,navigation_start,duration: currentMs - navigation_start,session_token,page_type: "product"};window.navigator.sendBeacon("https://monorail-edge.shopifysvc.com/v1/produce", JSON.stringify({schema_id: "online_store_buyer_site_abandonment/1.1",payload: payload,metadata: {event_created_at_ms: currentMs,event_sent_at_ms: currentMs}}));}}window.addEventListener('pagehide', handle_abandonment_event);}}());</script>
<script>
  window.__TREKKIE_SHIM_QUEUE = window.__TREKKIE_SHIM_QUEUE || [];
</script>
<script>(function(){var wpmLoader=function(){"use strict";var e=/Googlebot|Storebot-Google|bingbot|Baiduspider|YandexBot|DuckDuckBot|Slurp|facebookexternalhit|Twitterbot|LinkedInBot|Applebot|AdsBot-Google|Mediapartners-Google|APIs-Google|PetalBot|SemrushBot|AhrefsBot|MJ12bot|DotBot|Acunetix|PerplexityBot|Perplexity-User/i,r=/bytedance/i;function o(){try{var e=document.cookie;if(!e||"string"!=typeof e)return;for(var r=0,o=e.split(";");r<o.length;r++){var d=o[r],t=d.indexOf("=");if(-1!==t){var n=d.slice(0,t).trim();if(n){var i=void 0;try{i=decodeURIComponent(n)}catch(e){i=n}if("_shopify_s"===i){var a=d.slice(t+1).trim();try{return decodeURIComponent(a)}catch(e){return a}}}}}return}catch(e){return}}function d(e){try{"undefined"!=typeof console&&"function"==typeof console.warn&&console.warn(e)}catch(e){}}return function(t,n,i,a){var s,c,u,l,f=arguments.length>4&&void 0!==arguments[4]?arguments[4]:{},p=(c=(s={modern:/Edge?\/(1{2}[4-9]|1[2-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Firefox\/(1{2}[4-9]|1[2-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Chrom(ium|e)\/(9{2}|\d{3,})\.\d+(\.\d+|)|(Maci|X1{2}).+ Version\/(15\.\d+|(1[6-9]|[2-9]\d|\d{3,})\.\d+)([,.]\d+|)( \(\w+\)|)( Mobile\/\w+|) Safari\/|Chrome.+OPR\/(9{2}|\d{3,})\.\d+\.\d+|(CPU[ +]OS|iPhone[ +]OS|CPU[ +]iPhone|CPU IPhone OS|CPU iPad OS)[ +]+(15[._]\d+|(1[6-9]|[2-9]\d|\d{3,})[._]\d+)([._]\d+|)|Android:?[ /-](14[89]|1[5-9]\d|[2-9]\d{2}|\d{4,})(\.\d+|)(\.\d+|)|Android.+Firefox\/(15\d|1[6-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Android.+Chrom(ium|e)\/(14[89]|1[5-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|SamsungBrowser\/([2-9]\d|\d{3,})\.\d+/,legacy:/Edge?\/(1[6-9]|[2-9]\d|\d{3,})\.\d+(\.\d+|)|Firefox\/(5[4-9]|[6-9]\d|\d{3,})\.\d+(\.\d+|)|Chrom(ium|e)\/(5[1-9]|[6-9]\d|\d{3,})\.\d+(\.\d+|)([\d.]+$|.*Safari\/(?![\d.]+ Edge\/[\d.]+$))|(Maci|X1{2}).+ Version\/(10\.\d+|(1[1-9]|[2-9]\d|\d{3,})\.\d+)([,.]\d+|)( \(\w+\)|)( Mobile\/\w+|) Safari\/|Chrome.+OPR\/(3[89]|[4-9]\d|\d{3,})\.\d+\.\d+|(CPU[ +]OS|iPhone[ +]OS|CPU[ +]iPhone|CPU IPhone OS|CPU iPad OS)[ +]+(10[._]\d+|(1[1-9]|[2-9]\d|\d{3,})[._]\d+)([._]\d+|)|Android:?[ /-](14[89]|1[5-9]\d|[2-9]\d{2}|\d{4,})(\.\d+|)(\.\d+|)|Mobile Safari.+OPR\/([89]\d|\d{3,})\.\d+\.\d+|Android.+Firefox\/(15\d|1[6-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Android.+Chrom(ium|e)\/(14[89]|1[5-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Android.+(UC? ?Browser|UCWEB|U3)[ /]?(15\.([5-9]|\d{2,})|(1[6-9]|[2-9]\d|\d{3,})\.\d+)\.\d+|SamsungBrowser\/(5\.\d+|([6-9]|\d{2,})\.\d+)|Android.+MQ{2}Browser\/(14(\.(9|\d{2,})|)|(1[5-9]|[2-9]\d|\d{3,})(\.\d+|))(\.\d+|)|K[Aa][Ii]OS\/(3\.\d+|([4-9]|\d{2,})\.\d+)(\.\d+|)/}).modern,u=s.legacy,(l=navigator.userAgent).match(e)?"bot":l.match(c)?"modern":l.match(u)?"legacy":l.match(r)?"bot":"unknown"),h=function(e){var r=e.version,t=e.browserTarget,n=e.surface,i=e.shopId,a=e.monorailEndpoint,s=window.location.href;return{emit:function(e){var c,u=e.status,l=e.errorMsg;if(!a)return d("[Web Pixels Manager] No Monorail endpoint provided, skipping logging."),!1;try{var f=(new Date).getTime();c=JSON.stringify({metadata:{event_sent_at_ms:f},events:[{schema_id:"web_pixels_manager_load/3.2",payload:{version:r,bundle_target:t,page_url:s,status:u,surface:n,error_msg:l,shop_id:i,visit_token:o()},metadata:{event_created_at_ms:f}}]})}catch(e){return!1}var p,h=!1;try{"function"==typeof window.navigator.sendBeacon&&-1===(p=window.navigator.userAgent).indexOf("iPhone; CPU iPhone OS 12_")&&-1===p.indexOf("iPad; CPU OS 12_")&&-1===p.indexOf("iPod touch; CPU iPhone OS 12_")&&(h=window.navigator.sendBeacon.bind(window.navigator)(a,c))}catch(e){h=!1}if(h)return!0;try{var m=new XMLHttpRequest;return m.open("POST",a,!0),m.setRequestHeader("Content-Type","text/plain"),m.send(c),!0}catch(e){return d("[Web Pixels Manager] Got an unhandled error while logging to Monorail."),!1}}}}({version:i,browserTarget:p,surface:t.surface,shopId:t.shopId,monorailEndpoint:t.monorailEndpoint});if(Boolean(null==(y=null==(m=window.Shopify)?void 0:m.analytics)?void 0:y.replayQueue))h.emit({status:"setup-skipped",errorMsg:"replay queue already initialized."});else{var m,y;h.emit({status:"setup-started"}),window.Shopify=window.Shopify||{};var g=window.Shopify;g.analytics=g.analytics||{};var v=g.analytics;v.replayQueue=[],v.publish=function(e,r,o){return v.replayQueue.push([e,r,o]),!0};try{self.performance.mark("wpm:start")}catch(e){}var w,b="modern"===p?"modern":"legacy",P=(null!=a?a:{modern:"",legacy:""})[b],S=[(w={baseUrl:n,hashVersion:i,buildTarget:b}).baseUrl,"/wpm","/b",w.hashVersion,"modern"===w.buildTarget?"m":"l",".js"].join("");try{f.browserTarget=p,O(function(){try{O(_)}catch(e){h.emit({status:"failed",errorMsg:U(e)})}}),h.emit({status:"loading"})}catch(e){h.emit({status:"failed",errorMsg:U(e)})}}function C(){if(!function(){var e,r;return Boolean(null==(r=null==(e=window.Shopify)?void 0:e.analytics)?void 0:r.initialized)}()){var e=window.webPixelsManager.init(t)||void 0;if(e){var r=window.Shopify.analytics;r.replayQueue.forEach(function(r){var o=r[0],d=r[1],t=r[2];e.publishCustomEvent(o,d,t)}),r.replayQueue=[],r.publish=e.publishCustomEvent,r.visitor=e.visitor,r.initialized=!0}}}function _(){return h.emit({status:"failed",errorMsg:"".concat(S," has failed to load")})}function O(e){var r;!function(e){var r=e.src,o=e.async,d=void 0===o||o,t=e.onload,n=e.onerror,i=e.sri,a=e.scriptDataAttributes,s=void 0===a?{}:a,c=document.createElement("script"),u=document.querySelector("head"),l=document.querySelector("body");if(c.async=d,c.src=r,i&&(c.integrity=i,c.crossOrigin="anonymous"),s)for(var f in s)if(Object.prototype.hasOwnProperty.call(s,f))try{c.dataset[f]=s[f]}catch(e){}if(t&&c.addEventListener("load",t),n&&c.addEventListener("error",n),u)u.appendChild(c);else{if(!l)throw new Error("Did not find a head or body element to append the script");l.appendChild(c)}}({src:S,async:!0,onload:C,onerror:e,sri:(r=P,"string"==typeof r&&/^sha384-[A-Za-z0-9+/=]+$/.test(r)?P:""),scriptDataAttributes:f})}function U(e){return e instanceof Error?e.message:"Unknown error"}}}();wpmLoader({shopId: 72251900215,storefrontBaseUrl: "https://brilliant.xyz",extensionsBaseUrl: "https://extensions.shopifycdn.com/cdn/shopifycloud/web-pixels-manager",monorailEndpoint: "https://brilliant.xyz/.well-known/shopify/monorail/unstable/produce_batch",surface: "storefront-renderer",enabledBetaFlags: ["d5bdd5d0","873d0e44","656605ce"],webPixelsConfigList: [{"id":"2587525431","configuration":"{\"pixelCode\":\"D0GM8L3C77UA6FH9BJ80\"}","eventPayloadVersion":"v1","runtimeContext":"STRICT","scriptVersion":"22e92c2ad45662f435e4801458fb78cc","type":"APP","apiClientId":4383523,"privacyPurposes":["ANALYTICS","MARKETING","SALE_OF_DATA"],"dataSharingAdjustments":{"protectedCustomerApprovalScopes":["read_customer_address","read_customer_email","read_customer_name","read_customer_personal_data","read_customer_phone"],"dataSharingControls":["share_all_events"]},"dataSharingState":"optimized"},{"id":"1226834231","configuration":"{\"config\":\"{\\\"google_tag_ids\\\":[\\\"G-3XM1GJSWD2\\\",\\\"AW-17464241377\\\"],\\\"target_country\\\":\\\"ZZ\\\",\\\"gtag_events\\\":[{\\\"type\\\":\\\"search\\\",\\\"action_label\\\":[\\\"G-3XM1GJSWD2\\\",\\\"AW-17464241377\\\/1Tn1CMCrya8cEOHZzIdB\\\"]},{\\\"type\\\":\\\"begin_checkout\\\",\\\"action_label\\\":[\\\"G-3XM1GJSWD2\\\",\\\"AW-17464241377\\\/_LTdCLSrya8cEOHZzIdB\\\"]},{\\\"type\\\":\\\"remove_from_cart\\\",\\\"action_label\\\":\\\"G-3XM1GJSWD2\\\"},{\\\"type\\\":\\\"view_item\\\",\\\"action_label\\\":[\\\"G-3XM1GJSWD2\\\",\\\"AW-17464241377\\\/UaLoCL2rya8cEOHZzIdB\\\"]},{\\\"type\\\":\\\"purchase\\\",\\\"action_label\\\":[\\\"G-3XM1GJSWD2\\\",\\\"AW-17464241377\\\/kaxdCLGrya8cEOHZzIdB\\\"]},{\\\"type\\\":\\\"add_shipping_info\\\",\\\"action_label\\\":\\\"G-3XM1GJSWD2\\\"},{\\\"type\\\":\\\"page_view\\\",\\\"action_label\\\":[\\\"G-3XM1GJSWD2\\\",\\\"AW-17464241377\\\/xIp7CLqrya8cEOHZzIdB\\\"]},{\\\"type\\\":\\\"view_item_list\\\",\\\"action_label\\\":\\\"G-3XM1GJSWD2\\\"},{\\\"type\\\":\\\"add_payment_info\\\",\\\"action_label\\\":[\\\"G-3XM1GJSWD2\\\",\\\"AW-17464241377\\\/H2dLCMOrya8cEOHZzIdB\\\"]},{\\\"type\\\":\\\"add_to_cart\\\",\\\"action_label\\\":[\\\"G-3XM1GJSWD2\\\",\\\"AW-17464241377\\\/3ki0CLerya8cEOHZzIdB\\\"]},{\\\"type\\\":\\\"view_cart\\\",\\\"action_label\\\":\\\"G-3XM1GJSWD2\\\"}],\\\"enable_monitoring_mode\\\":false}\"}","eventPayloadVersion":"v1","runtimeContext":"OPEN","scriptVersion":"9120410995b7c9c6f4f039573265c0ea","type":"APP","apiClientId":1780363,"privacyPurposes":[],"dataSharingAdjustments":{"protectedCustomerApprovalScopes":["read_customer_address","read_customer_email","read_customer_name","read_customer_personal_data","read_customer_phone"],"dataSharingControls":["share_all_events"]},"dataSharingState":"optimized","enabledFlags":["9a3ed68a"]},{"id":"234815799","configuration":"{\"pixel_id\":\"801251724728178\",\"pixel_type\":\"facebook_pixel\"}","eventPayloadVersion":"v1","runtimeContext":"OPEN","scriptVersion":"abff2a8add143ccb04deb20f0ebd74a9","type":"APP","apiClientId":2329312,"privacyPurposes":["ANALYTICS","MARKETING","SALE_OF_DATA"],"dataSharingAdjustments":{"protectedCustomerApprovalScopes":["read_customer_address","read_customer_email","read_customer_name","read_customer_personal_data","read_customer_phone"],"dataSharingControls":["share_all_events"]},"dataSharingState":"optimized","enabledFlags":["9a3ed68a"]},{"id":"170852663","eventPayloadVersion":"1","runtimeContext":"LAX","scriptVersion":"14","type":"CUSTOM","privacyPurposes":["ANALYTICS","MARKETING","SALE_OF_DATA"],"name":"x-pixel"},{"id":"227213623","eventPayloadVersion":"1","runtimeContext":"LAX","scriptVersion":"1","type":"CUSTOM","privacyPurposes":["ANALYTICS","MARKETING","SALE_OF_DATA"],"name":"reddit"},{"id":"shopify-app-pixel","configuration":"{}","eventPayloadVersion":"v1","runtimeContext":"STRICT","scriptVersion":"0510","apiClientId":"shopify-pixel","type":"APP","privacyPurposes":["ANALYTICS","MARKETING"]},{"id":"shopify-custom-pixel","eventPayloadVersion":"v1","runtimeContext":"LAX","scriptVersion":"0510","apiClientId":"shopify-pixel","type":"CUSTOM","privacyPurposes":["ANALYTICS","MARKETING"]}],isMerchantRequest: false,initData: {"shop":{"name":"Brilliant Labs","paymentSettings":{"currencyCode":"USD"},"myshopifyDomain":"brilliant-labs-9526.myshopify.com","countryCode":"HK","storefrontUrl":"https:\/\/brilliant.xyz"},"customer":null,"cart":null,"checkout":null,"productVariants":[{"price":{"amount":399.0,"currencyCode":"USD"},"product":{"title":"Halo","vendor":"Brilliant Labs","id":"10217206972727","untranslatedTitle":"Halo","url":"\/products\/halo","type":""},"id":"50778480509239","image":{"src":"\/\/brilliant.xyz\/cdn\/shop\/files\/Halo_1.png?v=1753738731"},"sku":"BLHALOBLK","title":"Đen","untranslatedTitle":"Đen"}],"products":[{"id":"10217206972727","handle":"halo","isCollective":null,"title":"Halo","type":null,"untranslatedTitle":"Halo","url":"\/products\/halo","vendor":"Brilliant Labs","remoteShopId":null,"variants":[{"id":"50778480509239","image":{"src":"\/\/brilliant.xyz\/cdn\/shop\/files\/Halo_1.png?v=1753738731"},"price":{"amount":399.0,"currencyCode":"USD"},"sku":"BLHALOBLK","title":"Đen","untranslatedTitle":"Đen"}]}],"purchasingCompany":null},},"https://brilliant.xyz/cdn","5f5c0921we198f819p6efddfcfm66c0f9a3",{"modern":"","legacy":""},{"trekkieShim":true,"agentContext":true,"apiClientId":"580111","facebookCapiEnabled":"true","themeId":"179256688951","themePublished":"true","eventMetadataId":"c39e547d-5609-4bce-8c58-5146b1ee95e0","pageType":"product","resourceId":"10217206972727","shopId":"72251900215","storefrontBaseUrl":"https:\/\/brilliant.xyz","extensionBaseUrl":"https:\/\/extensions.shopifycdn.com\/cdn\/shopifycloud\/web-pixels-manager","surface":"storefront-renderer","enabledBetaFlags":"[\"d5bdd5d0\", \"873d0e44\", \"656605ce\"]","isMerchantRequest":"false","hashVersion":"5f5c0921we198f819p6efddfcfm66c0f9a3","publish":"custom","events":"[[\"page_viewed\",{}],[\"product_viewed\",{\"productVariant\":{\"price\":{\"amount\":399.0,\"currencyCode\":\"USD\"},\"product\":{\"title\":\"Halo\",\"vendor\":\"Brilliant Labs\",\"id\":\"10217206972727\",\"untranslatedTitle\":\"Halo\",\"url\":\"\/products\/halo\",\"type\":\"\"},\"id\":\"50778480509239\",\"image\":{\"src\":\"\/\/brilliant.xyz\/cdn\/shop\/files\/Halo_1.png?v=1753738731\"},\"sku\":\"BLHALOBLK\",\"title\":\"Đen\",\"untranslatedTitle\":\"Đen\"}}]]"});})();</script><script>
  window.ShopifyAnalytics = window.ShopifyAnalytics || {};
  window.ShopifyAnalytics.meta = window.ShopifyAnalytics.meta || {};
  window.ShopifyAnalytics.meta.currency = 'USD';
  var meta = {"product":{"id":10217206972727,"gid":"gid:\/\/shopify\/Product\/10217206972727","vendor":"Brilliant Labs","type":"","handle":"halo","variants":[{"id":50778480509239,"price":39900,"name":"Halo - Đen","public_title":"Đen","sku":"BLHALOBLK"}],"remote":false},"page":{"pageType":"product","resourceType":"product","resourceId":10217206972727,"requestId":"858cfed9-6613-4493-9b83-772bd0a55fc6-1787126603"}};
  for (var attr in meta) {
    window.ShopifyAnalytics.meta[attr] = meta[attr];
  }
</script>
<script class="analytics">
  (function () {
    var customDocumentWrite = function(content) {
      var jquery = null;

      if (window.jQuery) {
        jquery = window.jQuery;
      } else if (window.Checkout && window.Checkout.$) {
        jquery = window.Checkout.$;
      }

      if (jquery) {
        jquery('body').append(content);
      }
    };

    var hasLoggedConversion = function(token) {
      if (token) {
        return document.cookie.indexOf('loggedConversion=' + token) !== -1;
      }
      return false;
    }

    var setCookieIfConversion = function(token) {
      if (token) {
        var twoMonthsFromNow = new Date(Date.now());
        twoMonthsFromNow.setMonth(twoMonthsFromNow.getMonth() + 2);

        document.cookie = 'loggedConversion=' + token + '; expires=' + twoMonthsFromNow;
      }
    }

    var trekkie = window.ShopifyAnalytics.lib = window.trekkie = window.trekkie || [];
    window.ShopifyAnalytics.lib.trekkie = window.trekkie;
    if (trekkie.integrations) {
      return;
    }
    trekkie.methods = [
      'identify',
      'page',
      'ready',
      'track',
      'trackForm',
      'trackLink'
    ];
    trekkie.factory = function(method) {
      return function() {
        var args = Array.prototype.slice.call(arguments);
        args.unshift(method);
        trekkie.push(args);
        if (window.__TREKKIE_SHIM_QUEUE && (method == 'track' || method == 'page')) {
          try {
            window.__TREKKIE_SHIM_QUEUE.push({
              from: 'trekkie-stub',
              method: method,
              args: args.slice(1)
            });
          } catch (e) {
            // no-op
          }
        }
        return trekkie;
      };
    };
    for (var i = 0; i < trekkie.methods.length; i++) {
      var key = trekkie.methods[i];
      trekkie[key] = trekkie.factory(key);
    }
    trekkie.load = function(config) {
      trekkie.config = config || {};
      trekkie.config.initialDocumentCookie = document.cookie;
      var first = document.getElementsByTagName('script')[0];
var script = document.createElement('script');
script.type = 'text/javascript';
script.onerror = function(e) {
  var scriptFallback = document.createElement('script');
  scriptFallback.type = 'text/javascript';
  scriptFallback.onerror = function(error) {
          var Monorail = {
      produce: function produce(monorailDomain, schemaId, payload) {
        var currentMs = new Date().getTime();
        var event = {
          schema_id: schemaId,
          payload: payload,
          metadata: {
            event_created_at_ms: currentMs,
            event_sent_at_ms: currentMs
          }
        };
        return Monorail.sendRequest("https://" + monorailDomain + "/v1/produce", JSON.stringify(event));
      },
      sendRequest: function sendRequest(endpointUrl, payload) {
        // Try the sendBeacon API
        if (window && window.navigator && typeof window.navigator.sendBeacon === 'function' && typeof window.Blob === 'function' && !Monorail.isIos12()) {
          var blobData = new window.Blob([payload], {
            type: 'text/plain'
          });

          if (window.navigator.sendBeacon(endpointUrl, blobData)) {
            return true;
          } // sendBeacon was not successful

        } // XHR beacon

        var xhr = new XMLHttpRequest();

        try {
          xhr.open('POST', endpointUrl);
          xhr.setRequestHeader('Content-Type', 'text/plain');
          xhr.send(payload);
        } catch (e) {
          console.log(e);
        }

        return false;
      },
      isIos12: function isIos12() {
        return window.navigator.userAgent.lastIndexOf('iPhone; CPU iPhone OS 12_') !== -1 || window.navigator.userAgent.lastIndexOf('iPad; CPU OS 12_') !== -1;
      }
    };
    Monorail.produce('monorail-edge.shopifysvc.com',
      'trekkie_storefront_load_errors/1.1',
      {shop_id: 72251900215,
      theme_id: 179256688951,
      app_name: "storefront",
      context_url: window.location.href,
      source_url: "//brilliant.xyz/cdn/s/trekkie.storefront.7bcd7bb8195e24c65a61d69d69eb32392ed0d53f.min.js"});

  };
  scriptFallback.async = true;
  scriptFallback.src = '//brilliant.xyz/cdn/s/trekkie.storefront.7bcd7bb8195e24c65a61d69d69eb32392ed0d53f.min.js';
  first.parentNode.insertBefore(scriptFallback, first);
};
script.async = true;
script.src = '//brilliant.xyz/cdn/s/trekkie.storefront.7bcd7bb8195e24c65a61d69d69eb32392ed0d53f.min.js';
first.parentNode.insertBefore(script, first);

    };
    trekkie.load(
      {"Trekkie":{"appName":"storefront","development":false,"defaultAttributes":{"shopId":72251900215,"isMerchantRequest":null,"themeId":179256688951,"themeCityHash":"5630027833518771883","contentLanguage":"en","currency":"USD","eventMetadataId":"c39e547d-5609-4bce-8c58-5146b1ee95e0"},"isServerSideCookieWritingEnabled":true,"monorailRegion":"shop_domain","enabledBetaFlags":["f43e7f5e","b5387b81","d5bdd5d0"]},"Session Attribution":{},"S2S":{"facebookCapiEnabled":true,"source":"trekkie-storefront-renderer","apiClientId":580111}}
    );

    var loaded = false;
    trekkie.ready(function() {
      if (loaded) return;
      loaded = true;

      window.ShopifyAnalytics.lib = window.trekkie;

      var originalDocumentWrite = document.write;
      document.write = customDocumentWrite;
      try { window.ShopifyAnalytics.merchantGoogleAnalytics.call(this); } catch(error) {};
      document.write = originalDocumentWrite;

      var match = window.location.pathname.match(/checkouts\/(.+)\/(thank_you|post_purchase)/)
      var token = match? match[1]: undefined;
      if (!hasLoggedConversion(token)) {
        setCookieIfConversion(token);
        window.ShopifyAnalytics.lib.track("Viewed Product",{"currency":"USD","variantId":50778480509239,"productId":10217206972727,"productGid":"gid:\/\/shopify\/Product\/10217206972727","name":"Halo - Đen","price":"399.00","sku":"BLHALOBLK","brand":"Brilliant Labs","variant":"Đen","category":"","nonInteraction":true,"remote":false},undefined,undefined,{"shopifyEmitted":true});
      window.ShopifyAnalytics.lib.track("monorail:\/\/trekkie_storefront_viewed_product\/1.1",{"currency":"USD","variantId":50778480509239,"productId":10217206972727,"productGid":"gid:\/\/shopify\/Product\/10217206972727","name":"Halo - Đen","price":"399.00","sku":"BLHALOBLK","brand":"Brilliant Labs","variant":"Đen","category":"","nonInteraction":true,"remote":false,"referer":"https:\/\/brilliant.xyz\/products\/halo"});
      }
    });

    window.ShopifyAnalytics.lib.page(null,{"pageType":"product","resourceType":"product","resourceId":10217206972727,"requestId":"858cfed9-6613-4493-9b83-772bd0a55fc6-1787126603","shopifyEmitted":true});

    var eventsListenerScript = document.createElement('script');
    eventsListenerScript.async = true;
    eventsListenerScript.src = "//brilliant.xyz/cdn/shopifycloud/storefront/assets/shop_events_listener-4e26a9ce.js";
    document.getElementsByTagName('head')[0].appendChild(eventsListenerScript);
})();</script>
<script defer="" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shopifycloud/perf-kit/shopify-perf-kit-3.8.3.min.js' ); ?>" data-application="storefront-renderer" data-shop-id="72251900215" data-render-region="gcp-asia-southeast1" data-page-type="product" data-theme-instance-id="179256688951" data-theme-name="Creator" data-theme-version="3.2.2" data-monorail-region="shop_domain" data-resource-timing-sampling-rate="10" data-shs="true" data-shs-beacon="true" data-shs-export-with-fetch="true" data-shs-logs-sample-rate="1" data-shs-beacon-endpoint="https://brilliant.xyz/api/collect"></script>
<meta name="shopify-y" content="73fc1827-5d90-47f3-8105-258e76211c0c">
<?php wp_head(); ?>
</head>

  <body class="primary-button-style--solid secondary-button-style--outline" data-animations-enabled="">
    <a class="skip-to-content-link visually-hidden" href="#site-content">
      Chuyển đến nội dung
    </a><!-- BEGIN sections: header-group -->
<div id="shopify-section-sections--24820771225911__header" class="shopify-section shopify-section-group-header-group"><script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/section-header.js?v=112500857217972521971752050579' ); ?>" defer="defer"></script>
<link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/section-header.css?v=45315814464739439521752050583' ); ?>" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-nav.css?v=4077965322590212321752050583' ); ?>" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-toggle-menu.css?v=84185020570966557971752050582' ); ?>" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-search-bar.css?v=80783752267642238901752050579' ); ?>" rel="stylesheet" type="text/css" media="all">
<script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-predictive-search.js?v=28073421474938485831752050582' ); ?>" defer="defer"></script>
  <link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-predictive-search.css?v=53081171318693203941752050581' ); ?>" rel="stylesheet" type="text/css" media="all">



  <script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/toggle-button-76010bff.js' ); ?>" type="module" crossorigin="anonymous"></script>


<site-header class="container header header--mobile-top header--desktop-top header--mobile-transparent header--desktop-transparent header--full-width" role="region" aria-label="Header" data-header-mobile-transparency="" data-header-desktop-transparency="">
  <div class="row row--no-gutters row--align-center tw-flex tw-justify-between  ">
    <div class="tw-flex tw-justify-between lg:tw-flex-1 ">
      <a class="tw-hidden tw-justify-center lg:tw-flex" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Brilliant Việt Nam"><img class="header__logo header__logo--desktop tw-mx-0 header__logo--standard" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/BrilliantVietnam_logo_white.png?v=2' ); ?>" alt="Brilliant Việt Nam" loading="lazy" width="3100" height="600"><img class="header__logo header__logo--desktop header__logo--reversed tw-mx-0" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/BrilliantVietnam_logo_white.png?v=2' ); ?>" alt="Brilliant Việt Nam" loading="lazy" width="3100" height="600"><img class="header__logo tw-mx-0  d-lg-none" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/BrilliantVietnam_logo_white.png?v=2' ); ?>" alt="Brilliant Việt Nam" loading="lazy" width="3100" height="600"></a>

      
        <button class="header__menu-toggle tw-h-auto d-lg-none" type="button" aria-label="Menu" data-menu-toggle=""><span> <svg class="icon icon-menu" aria-hidden="true" focusable="false" role="presentation" width="40" height="40" viewbox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path class="" d="M33 15L7 15" stroke="white" stroke-width="3" stroke-miterlimit="10"></path>
    <path class="" d="M33 25L7 25" stroke="white" stroke-width="3" stroke-miterlimit="10"></path>
  </svg>
</span>

            <span><svg class="icon icon-close-small" aria-hidden="true" focusable="false" role="presentation" width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M2 13.4142L13.4142 2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M13.4142 13.4142L2 2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
</svg></span></button>

        <div class="toggle-menu-wrapper "><div class="toggle-menu" data-toggle-menu="">
  <div class="toggle-menu__content"><ul class="toggle-menu__links no-bullets d-lg-none" data-toggle-menu-links=""><li>
        <a class="toggle-menu__link toggle-menu__link--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" title="Liên hệ" data-toggle-menu-item="">
          <span>
            Liên hệ
          </span>
        </a>
      </li><li>
        <a class="toggle-menu__link toggle-menu__link--primary" href="<?php echo esc_url( home_url( '/blogs/announcements/' ) ); ?>" title="Tin tức" data-toggle-menu-item="">
          <span>
            Tin tức
          </span>
        </a>
      </li><li>
        <a class="toggle-menu__link toggle-menu__link--primary" href="<?php echo esc_url( home_url( '/developers/' ) ); ?>" title="Nhà phát triển" data-toggle-menu-item="">
          <span>
            Nhà phát triển
          </span>
        </a>
      </li></ul><ul class="toggle-menu__links no-bullets d-none d-lg-block" data-toggle-menu-links=""><li>
        <a class="toggle-menu__link toggle-menu__link--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" title="Liên hệ" data-toggle-menu-item="">
          <span>
            Liên hệ
          </span>
        </a>
      </li><li>
        <a class="toggle-menu__link toggle-menu__link--primary" href="<?php echo esc_url( home_url( '/blogs/announcements/' ) ); ?>" title="Tin tức" data-toggle-menu-item="">
          <span>
            Tin tức
          </span>
        </a>
      </li><li>
        <a class="toggle-menu__link toggle-menu__link--primary" href="<?php echo esc_url( home_url( '/developers/' ) ); ?>" title="Nhà phát triển" data-toggle-menu-item="">
          <span>
            Nhà phát triển
          </span>
        </a>
      </li></ul><div><?php if ( function_exists( "bl_render_header_buy_button" ) ) { bl_render_header_buy_button(true); } ?></div>
  </div>
</div>
</div>
      
<ul class="nav no-bullets d-none d-lg-block text-center tw-z-10" role="navigation" aria-label="Menu"><li class="nav__link-wrapper">
          <a class="nav__link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" title="Liên hệ">
            <span>
              Liên hệ
            </span>
          </a>
        </li><li class="nav__link-wrapper">
          <a class="nav__link" href="<?php echo esc_url( home_url( '/blogs/announcements/' ) ); ?>" title="Tin tức">
            <span>
              Tin tức
            </span>
          </a>
        </li><li class="nav__link-wrapper">
          <a class="nav__link" href="<?php echo esc_url( home_url( '/developers/' ) ); ?>" title="Nhà phát triển">
            <span>
              Nhà phát triển
            </span>
          </a>
        </li></ul>
</div><a class="tw-flex tw-justify-center lg:tw-hidden" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Brilliant Việt Nam"><img class="header__logo header__logo--desktop tw-mx-0 header__logo--standard" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/BrilliantVietnam_logo_white.png?v=2' ); ?>" alt="Brilliant Việt Nam" loading="lazy" width="3100" height="600"><img class="header__logo header__logo--desktop header__logo--reversed tw-mx-0" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/BrilliantVietnam_logo_white.png?v=2' ); ?>" alt="Brilliant Việt Nam" loading="lazy" width="3100" height="600"><img class="header__logo tw-mx-0  d-lg-none" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/BrilliantVietnam_logo_white.png?v=2' ); ?>" alt="Brilliant Việt Nam" loading="lazy" width="3100" height="600"></a>

    
<div class="tw-flex tw-justify-end tw-gap-2 md:tw-gap-6"><?php if ( function_exists( "bl_render_header_buy_button" ) ) { bl_render_header_buy_button(false); } ?></div></div><div class="search-bar search-bar--header" role="region" aria-label="Tìm kiếm" data-search-bar=""><predictive-search data-loading-text="Loading..."><form class="search-bar__form" action="/search" method="get" role="search">
    <label class="visually-hidden" for="search-bar">Tìm kiếm</label>

    <input class="search-bar__input" id="search-bar" type="search" name="q" value="" placeholder="Tìm kiếm" data-search-bar-input="" role="combobox" aria-expanded="false" aria-owns="predictive-search-results" aria-controls="predictive-search-results" aria-haspopup="listbox" aria-autocomplete="list" autocorrect="off" autocomplete="off" autocapitalize="off" spellcheck="false"><div class="predictive-search" tabindex="-1" data-predictive-search=""></div>
      <span class="predictive-search-status visually-hidden" role="status" aria-hidden="true"></span><button class="search-bar__submit" aria-label="Tìm kiếm"><svg class="icon icon-arrow-right-thick" aria-hidden="true" focusable="false" role="presentation" width='25' height='20' viewbox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M18.8685 26C19.402 24.6 20.0324 23.3 20.9539 21.9C22.8453 19.15 25.0763 16.75 27.1132 15.2H0V10.6H26.9677C25.9978 9.8 24.9793 8.85 24.0093 7.65C21.9239 5.35 20.1294 2.6 19.1595 0H24.3003C24.7368 1.25 25.4158 2.65 26.4342 4.2C28.3742 7.15 31.1386 10 34 11.9V14.1C32.5935 15.05 31.1386 16.15 29.7806 17.55C26.9677 20.25 24.8338 23.3 24.0093 26H18.8685Z" fill="currentColor"></path>
</svg></button>
  </form></predictive-search></div></site-header><style data-shopify="">:root {
    --mobile-content-offset: 48px;
    --desktop-content-offset: 120px;
    --header-border-radius: 16px;
    --mobile-logo-width: 220px;
      --header-max-width: 100%;
      --announcement-bar-max-width: 100%;}
    :root {
      --header-logo-width: 115px;
    }

    @media screen and (min-width: 375px) {
      :root {
        --header-logo-width: 140px;
      }
    }
  

  @media screen and (min-width: 768px) {
    :root {
      --header-logo-width: 175.0px;
    }
  }

  @media screen and (min-width: 1025px) {
    :root {
      --header-logo-width: 220px;
    }
  }</style><script>
  const header = document.querySelector('site-header');

  if (window.innerWidth >= 1025 && header.classList.contains('header--desktop-top')) {
    document.body.classList.add('desktop-top-offset');
  } else if (window.innerWidth < 1025 && window.innerWidth >= 768 && header.classList.contains('header--mobile-top')) {
    document.body.classList.add('mobile-top-offset');
  } else if (window.innerWidth < 768 && header.classList.contains('header--mobile-top')) {
    document.body.classList.add('mobile-top-offset');
  }

  window.addEventListener('scroll', () => {
    updateHeaderClasses();
  });

  updateHeaderClasses();

  if (Shopify.designMode) {
    document.addEventListener('shopify:section:load', () => {
      updateHeaderClasses();
    });
  }

  function updateHeaderClasses() {
    const announcementBar = document.querySelector('announcement-bar');

    if (announcementBar) {
      if (!announcementBar.classList.contains('announcement-bar--sticky')) {
        const announcementBarHeight = announcementBar ? announcementBar.offsetHeight : 0;

        if (window.scrollY >= announcementBarHeight) {
          header.classList.remove('header--absolute');
          header.classList.add('header--fixed');
        } else {
          header.classList.add('header--absolute');
          header.classList.remove('header--fixed');
        }
      }
    } else {
      header.classList.remove('header--absolute');
    }
  }
</script>


</div>
<!-- END sections: header-group --><main id="site-content" class="site-content focus-none" role="main" tabindex="-1" data-site-content="">
      <div id="shopify-section-template--24912567468343__main" class="shopify-section"><script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-product-media.js?v=96786342942459698841752050580' ); ?>" defer="defer"></script>
<script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-product-form.js?v=166868895670164337431752050579' ); ?>" defer="defer"></script>
<script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-video.js?v=49218978051593286841752050580' ); ?>" defer="defer"></script>
<script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-popup.js?v=29007869830681131751752050581' ); ?>" defer="defer"></script>
<script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/simplebar.min.js?v=9344250348948749101752050580' ); ?>" defer="defer"></script>
<link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/section-main-product.css?v=98236388799335382391752050583' ); ?>" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-product-media.css?v=108553969740725666241752050579' ); ?>" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-product-form.css?v=40255773047806904151752050579' ); ?>" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-video.css?v=143258516030285971091752050583' ); ?>" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-popup.css?v=69181603626553399281752050581' ); ?>" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/simplebar.min.css?v=21558511491353777691752050580' ); ?>" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-accordion.css?v=26510281912245942681752050581' ); ?>" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/app-shopify-product-reviews.css?v=81532200181581557651752050579' ); ?>" rel="stylesheet" type="text/css" media="all">


<div class="product product--template--24912567468343__main main-section tw-relative" data-product="">
  <div class="container" data-aos="fade-up">
    <div class="row">
      <div class="col-12 col-md-6 col-lg-7"><link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-swiper.css?v=91568107542848236241752050581' ); ?>" rel="stylesheet" type="text/css" media="all">
<product-media class="product-media  product-media--sticky" role="region">
  <div class="swiper swiper--primary no-js-hidden" data-swiper-loop="" data-swiper=""><div class="swiper-pagination " data-swiper-pagination=""></div>

      <div class="swiper-arrow swiper-arrow--prev" data-swiper-prev=""><svg class="icon icon-chevron-left-circle" aria-hidden="true" focusable="false" role="presentation" width="22" height="22" viewbox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M11 22C17.0751 22 22 17.0751 22 11C22 4.92487 17.0751 0 11 0C4.92487 0 0 4.92487 0 11C0 17.0751 4.92487 22 11 22Z" fill="white"></path>
  <path class="icon-stroke" d="M13.2 5.8667L8.06668 11L13.2 16.1334" stroke="black" stroke-miterlimit="10" stroke-linecap="square" stroke-linejoin="round"></path>
</svg></div>

      <div class="swiper-arrow swiper-arrow--next" data-swiper-next=""><svg class="icon icon-chevron-right-circle" aria-hidden="true" focusable="false" role="presentation" width="22" height="22" viewbox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M11 22C17.0751 22 22 17.0751 22 11C22 4.92487 17.0751 0 11 0C4.92487 0 0 4.92487 0 11C0 17.0751 4.92487 22 11 22Z" fill="white"></path>
  <path class="icon-stroke" d="M8.8 5.8667L13.9333 11L8.8 16.1334" stroke="black" stroke-miterlimit="10" stroke-linecap="square" stroke-linejoin="round"></path>
</svg>
</div><button class="swiper-pause" type="button" aria-label="Pause" data-swiper-pause=""><svg class="icon icon-pause" aria-hidden="true" focusable="false" role="presentation" width="12" height="12" viewbox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M2.5 1V11" stroke="currentColor" stroke-linecap="round"></path>
  <path d="M9.5 1V11" stroke="currentColor" stroke-linecap="round"></path>
</svg><svg class="icon icon-play-small" aria-hidden="true" focusable="false" role="presentation" width="12" height="13" viewbox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M0.75 0.407715V12.4077L11.25 6.40771L0.75 0.407715Z" fill="currentColor"></path>
</svg></button><div class="swiper-avatar-wrapper" data-swiper-avatar-wrapper="">
        <img class="swiper-avatar" loading="lazy" data-swiper-avatar="">
        <span class="swiper-avatar-text p--bold" data-swiper-avatar-text=""></span>
      </div><button class="product-media__zoom no-js-hidden" aria-label="Open media in popup" data-popup-link="product-media-popup-template--24912567468343__main"><svg class="icon icon-zoom" aria-hidden="true" focusable="false" role="presentation" width="18" height="18" viewbox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M16.9992 17.0008L12.7324 12.7339" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
  <path fill-rule="evenodd" clip-rule="evenodd" d="M7.85733 1C11.6449 1 14.7147 4.06985 14.7147 7.85745C14.7147 11.645 11.6449 14.7149 7.85733 14.7149C4.0698 14.7149 1 11.645 1 7.85745C1 4.06985 4.0698 1 7.85733 1V1Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M7.85352 5.57159V10.1432" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M10.1458 7.85745H5.57422" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
</svg></button><div class="swiper-wrapper" data-swiper-wrapper="">
      <?php if ( ! empty( $gallery_urls ) ) : ?>
        <?php foreach ( $gallery_urls as $s_idx => $s_url ) : ?>
          <div class="swiper-slide" data-index="<?php echo $s_idx; ?>" data-swiper-slide="">
            <div class="image-ratio image-ratio--natural">
              <img class="product-media__image" src="<?php echo esc_url( $s_url ); ?>" alt="<?php echo esc_attr( $product_title ); ?>" loading="lazy" width="2200" height="2200" style="object-position: 50.0% 50.0%;">
            </div>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <div class="swiper-slide" data-index="0" data-swiper-slide="">
          <div class="image-ratio image-ratio--natural" style="background: #0d0d0d; display: flex; align-items: center; justify-content: center; min-height: 480px; border-radius: 12px; border: 1px solid #222;">
            <div style="text-align: center; color: #555; padding: 40px;">
              <svg style="width: 56px; height: 56px; margin: 0 auto 14px; display: block; opacity: 0.4;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                <polyline points="21 15 16 10 5 21"></polyline>
              </svg>
              <p style="margin: 0; font-size: 13px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: #666;">Chưa có hình ảnh</p>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div><popup-wrapper class="popup popup--full" data-popup-id="product-media-popup-template--24912567468343__main">
  <div class="popup__content-wrapper" data-simplebar="">
    <div class="popup__content">
      <button class="popup__close" type="button" aria-label="Close" data-popup-close=""><svg class="icon icon-close" aria-hidden="true" focusable="false" role="presentation" width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M3.43935 20.5606L20.5606 3.43935" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M20.5606 20.5606L3.43935 3.43935" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
</svg></button>

      <p class="h4">
        
      </p>

      <div class="container" data-product-media-popup-content="">
        <?php if ( ! empty( $gallery_urls ) ) : ?>
          <?php foreach ( $gallery_urls as $p_idx => $p_url ) : ?>
            <div data-image-id="<?php echo $p_idx; ?>" data-option-1-value="<?php echo esc_attr( $product_title ); ?>" data-product-media-popup-image="">
              <img src="<?php echo esc_url( $p_url ); ?>" alt="<?php echo esc_attr( $product_title ); ?>" loading="lazy" width="2200" height="2200" style="object-position: 50.0% 50.0%;">
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</popup-wrapper>
<noscript>
    <div class="product-media__no-js">
      <?php foreach ( $gallery_urls as $n_idx => $n_url ) : ?>
        <div class="swiper-slide" data-index="<?php echo $n_idx; ?>">
          <div class="image-ratio image-ratio--natural">
            <img class="product-media__image" src="<?php echo esc_url( $n_url ); ?>" alt="<?php echo esc_attr( $product_title ); ?>" loading="lazy" width="2200" height="2200">
          </div>
        </div>
      <?php endforeach; ?>
    </div>
</noscript></product-media></div>

      <div class="col-12 col-md-6 col-lg-5">
        <div class="product__content"><link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-product-rating.css?v=146575650222427282611752050582' ); ?>" rel="stylesheet" type="text/css" media="all">
<h1 class="product__heading h2"><?php echo esc_html( $product_title ); ?>
</h1><div class="product-price" data-product-price="">
  <div class="product-price__container">
    <div class="product-price__regular">
      <span class="visually-hidden">
        Giá niêm yết
      </span>

      <span class="product-price__value" data-product-regular-price=""><?php echo esc_html( $product_price ); ?></span>
    </div>

    <div class="product-price__sale">
      <span class="visually-hidden">
        Giá khuyến mãi
      </span>

      <span class="product-price__value product-price__value--sale" data-product-regular-price=""><?php echo esc_html( $product_price ); ?></span>
        <span class="visually-hidden">
          Giá niêm yết
        </span>

        <span>
          <s class="product-price__value product-price__value--compare" data-product-compare-price="">
</s>
        </span></div>

    <small class="product-price__unit-price d-none" data-product-unit-price-wrapper="">
      <span class="visually-hidden">
        Đơn giá
      </span>

      <span class="product-price__value">
        <span data-product-unit-price="">
          
        </span>

        <span aria-hidden="true">/</span>

        <span class="visually-hidden">
          mỗi
        </span>

        <span data-product-unit-measurement="">

        </span>
      </span>
    </small>
  </div>

  <span class="product-price__badge product-price__badge--sale p--bold">
    Khuyến mãi
  </span>

  <div class="bl-stock-status-badge <?php echo esc_attr( $stock_info['badge_cls'] ); ?>">
    <span class="bl-stock-dot" style="background-color: <?php echo esc_attr( $stock_info['dot_color'] ); ?>;"></span>
    <span class="bl-stock-text"><?php echo esc_html( $stock_info['text'] ); ?></span>
  </div>
</div>
<form method="post" action="/cart/add" id="product-form-installment-template--24912567468343__main" accept-charset="UTF-8" class="shopify-product-form" enctype="multipart/form-data"><input type="hidden" name="form_type" value="product"><input type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="50778480509239" data-shop-pay-input="">
                    <div class="product__shop-pay"></div><input type="hidden" name="product-id" value="10217206972727"><input type="hidden" name="section-id" value="template--24912567468343__main"></form><link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-product-price.css?v=54116176018763529501752050581' ); ?>" rel="stylesheet" type="text/css" media="all">
<div class="product__description bl-product-description-formatted">
  <?php if ( ! empty( $product_content ) ) : ?>
    <?php echo apply_filters( 'the_content', $product_content ); ?>
  <?php elseif ( ! empty( $product_excerpt ) ) : ?>
    <p><?php echo esc_html( $product_excerpt ); ?></p>
  <?php else : ?>
    <p style="color: #888;">N/A</p>
  <?php endif; ?>
</div>

<style>
/* Product Description Typography Formatting */
.bl-product-description-formatted {
  font-size: 15px !important;
  line-height: 1.7 !important;
  color: #dddddd !important;
  margin-top: 20px !important;
  margin-bottom: 24px !important;
}
.bl-product-description-formatted h3 {
  font-size: 26px !important;
  font-weight: 700 !important;
  color: #ffffff !important;
  margin: 0 0 10px 0 !important;
  line-height: 1.3 !important;
}
.bl-product-description-formatted h3 span span,
.bl-product-description-formatted span[style*="242, 136, 191"],
.bl-product-description-formatted span[style*="rgb(255, 0, 255)"] {
  color: #f288bf !important;
}
.bl-product-description-formatted h5 {
  font-size: 16px !important;
  font-weight: 600 !important;
  color: #ffffff !important;
  margin: 0 0 18px 0 !important;
  line-height: 1.5 !important;
}
.bl-product-description-formatted p {
  font-size: 14.5px !important;
  line-height: 1.75 !important;
  color: #cccccc !important;
  margin-bottom: 14px !important;
}
.bl-product-description-formatted p strong,
.bl-product-description-formatted p b {
  color: #ffffff !important;
  font-weight: 700 !important;
}
</style><variant-selects class="no-js-hidden" data-url="<?php echo esc_url( get_permalink( $product_id ) ); ?>"><div class="variant-picker__dropdown  ">
          <label class="variant-picker__label h5 font-body " for="option-template--24912567468343__main-0">
            Màu sắc
          </label>

          <div class="select-wrapper select-wrapper--full">
            <select id="option-template--24912567468343__main-0" name="options[Màu sắc]"><option value="Đen" selected="selected">
                  Đen
                </option></select><svg class="icon icon-chevron-down" aria-hidden="true" focusable="false" role="presentation" width="12" height="12" viewbox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M10.7071 3.5451L6.02967 8.45181C6.02576 8.45591 6.01922 8.45591 6.01526 8.45191L1.29291 3.59139" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
</svg></div>
        </div><script type="application/json">
        [{"id":50778480509239,"title":"Đen","option1":"Đen","option2":null,"option3":null,"sku":"BLHALOBLK","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"<?php echo esc_attr( $product_title ); ?> - Đen","public_title":"Đen","options":["Đen"],"price":39900,"weight":130,"compare_at_price":null,"inventory_management":"shopify","barcode":"015706436602","requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}}]
      </script>
    </variant-selects><noscript>
  <div class="variant-picker__dropdown ">
    <label class="variant-picker__label h5 font-body " for="variants-template--24912567468343__main">
      Các phiên bản sản phẩm
    </label>

    <div class="select-wrapper">
      <select name="id" id="variants-template--24912567468343__main" form="product-form-template--24912567468343__main"><option selected="selected" value="50778480509239">
            Đen

            - <?php echo esc_html( $product_price ); ?>
          </option></select><svg class="icon icon-chevron-down" aria-hidden="true" focusable="false" role="presentation" width="12" height="12" viewbox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M10.7071 3.5451L6.02967 8.45181C6.02576 8.45591 6.01922 8.45591 6.01526 8.45191L1.29291 3.59139" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
</svg></div>
  </div>
</noscript>
<div class="no-js-hidden"><label class="quantity-input-label h5 font-body " for="Số quantity-template--24912567468343__main-">
  Số lượng
</label>

<quantity-input class="quantity-input">
  <button class="quantity-input__button no-js-hidden" name="minus" type="button">
    <span class="visually-hidden">
      Giảm số lượng <?php echo esc_html( $product_title ); ?>
    </span><svg class="icon icon-minus" aria-hidden="true" focusable="false" role="presentation" width="10" height="2" viewbox="0 0 10 2" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M9 1H1" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
</svg></button>

  <input id="Số quantity-template--24912567468343__main-" class="quantity-input__input" type="number" name="quantity" min="1" value="1">

  <button class="quantity-input__button no-js-hidden" name="plus" type="button">
    <span class="visually-hidden">
      Tăng số lượng <?php echo esc_html( $product_title ); ?>
    </span><svg class="icon icon-plus" aria-hidden="true" focusable="false" role="presentation" width="10" height="10" viewbox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M5 9V1" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M9 5H1" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
</svg></button>
</quantity-input></div><script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-quantity-input.js?v=35994030679127480851752050583' ); ?>" defer="defer"></script>
                  <link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-quantity-input.css?v=13464790363894800881752050582' ); ?>" rel="stylesheet" type="text/css" media="all">
<product-form class="product-form">
    <div class="product-form__error-message-wrapper" role="alert" hidden="" data-product-form-error-message-wrapper="">
      <span class="p--bold" data-product-form-error-message=""></span>
    </div>
    <form method="post" action="/cart/add" id="product-form-template--24912567468343__main" accept-charset="UTF-8" class="shopify-product-form" enctype="multipart/form-data" novalidate="novalidate">
      <input type="hidden" name="form_type" value="product">
      <input type="hidden" name="utf8" value="✓">
      <input type="hidden" name="id" value="50778480509239" disabled="">
      <input type="hidden" name="quantity" value="1">
      <input type="hidden" name="product-id" value="<?php echo esc_attr( $product_id ); ?>">
      <input type="hidden" name="section-id" value="template--24912567468343__main">

      <!-- Brilliant CTA & Consultation Section (Pure Black & White) -->
      <div class="bl-product-cta-group">
        <!-- Row 1: 2 Nút Tư Vấn Zalo & Mua Ngay -->
        <div class="bl-cta-buttons-row">
          <a href="https://zalo.me/0917834532" target="_blank" rel="noopener noreferrer" class="bl-cta-btn bl-cta-btn--zalo" title="Tư vấn Zalo - Sahaha Wifi Sim Du Lịch Máy Phiên Dịch">
            <svg class="bl-cta-icon" width="20" height="20" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M24 4C12.954 4 4 12.507 4 23.002C4 28.91 6.84 34.195 11.278 37.712L9.5 44L16.273 41.512C18.665 42.47 21.275 43.004 24 43.004C35.046 43.004 44 34.497 44 24.002C44 13.507 35.046 4 24 4Z" stroke="currentColor" stroke-width="3" fill="none"/>
              <path d="M19.78 28.5H13.5V26.85L17.72 20.35H13.75V18.5H19.5V20.15L15.3 26.65H19.78V28.5ZM26.35 28.5L25.8 26.75H22.45L21.9 28.5H19.95L23.1 18.5H25.15L28.3 28.5H26.35ZM24.12 21.25L22.95 25.15H25.3L24.12 21.25ZM30.7 28.5V18.5H32.6V26.7H36.3V28.5H30.7ZM38.45 23.5C38.45 20.65 40.15 18.3 42.75 18.3C45.35 18.3 47.05 20.65 47.05 23.5C47.05 26.35 45.35 28.7 42.75 28.7C40.15 28.7 38.45 26.35 38.45 23.5ZM45.1 23.5C45.1 21.6 44.05 19.95 42.75 19.95C41.45 19.95 40.4 21.6 40.4 23.5C40.4 25.4 41.45 27.05 42.75 27.05C44.05 27.05 45.1 23.5 45.1 23.5Z" fill="currentColor"/>
            </svg>
            <span>TƯ VẤN NGAY</span>
          </a>

          <button type="button" class="bl-cta-btn bl-cta-btn--buy" onclick="blOpenQuickOrderModal()">
            <span data-product-submit-text="">MUA NGAY</span>
          </button>
        </div>

        <!-- Row 2: Khung Tư Vấn Qua SĐT -->
        <div class="bl-consult-box">
          <div class="bl-consult-box__header">
            <p class="bl-consult-box__title">
              Hãy để lại <strong>số điện thoại</strong>, chúng tôi sẽ gọi ngay cho bạn <strong>tư vấn miễn phí!</strong>
            </p>
          </div>

          <div class="bl-consult-form-wrap">
            <div class="bl-consult-input-group">
              <input 
                type="tel" 
                id="blConsultPhoneInput" 
                class="bl-consult-input" 
                placeholder="Nhập sđt tư vấn miễn phí..." 
                autocomplete="tel"
              />
              <button 
                type="button" 
                id="blConsultPhoneBtn" 
                class="bl-consult-btn" 
                onclick="blSubmitPhoneConsultation(this)"
              >
                GỬI ĐI
              </button>
            </div>
            <div id="blConsultFeedback" class="bl-consult-feedback" style="display: none;"></div>
          </div>
        </div>
      </div>
    </form>
</product-form>

<style>
/* Brilliant Custom CTA & Consultation Styling - Pure Black & White */
.bl-product-cta-group {
  margin-top: 18px;
  width: 100%;
}

.bl-cta-buttons-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
  margin-bottom: 14px;
}

@media (max-width: 480px) {
  .bl-cta-buttons-row {
    grid-template-columns: 1fr;
    gap: 10px;
  }
}

.bl-cta-btn {
  display: inline-flex !important;
  align-items: center;
  justify-content: center;
  gap: 8px;
  height: 48px;
  padding: 0 16px;
  border-radius: 9999px;
  font-size: 14px;
  font-weight: 700;
  letter-spacing: 0.6px;
  text-transform: uppercase;
  text-decoration: none !important;
  cursor: pointer;
  transition: all 0.2s ease;
  box-sizing: border-box;
  width: 100%;
  line-height: 1;
}

/* Nút Tư Vấn Zalo - Viền Trắng / Nền Đen */
.bl-cta-btn--zalo {
  background: #000000 !important;
  color: #ffffff !important;
  border: 1.5px solid #ffffff !important;
}

.bl-cta-btn--zalo:hover {
  background: #222222 !important;
  border-color: #ffffff !important;
  color: #ffffff !important;
  transform: translateY(-2px);
}

.bl-cta-icon {
  flex-shrink: 0;
  width: 20px;
  height: 20px;
}

/* Nút Mua Ngay - Nền Trắng / Chữ Đen */
.bl-cta-btn--buy {
  background: #ffffff !important;
  color: #000000 !important;
  border: 1.5px solid #ffffff !important;
}

.bl-cta-btn--buy:hover {
  background: #e0e0e0 !important;
  border-color: #e0e0e0 !important;
  transform: translateY(-2px);
  color: #000000 !important;
}

/* Khung Tư Vấn Qua SĐT - Đen Trắng */
.bl-consult-box {
  background: #111111;
  border: 1px solid #2a2a2a;
  border-radius: 16px;
  padding: 16px 18px;
  position: relative;
}

.bl-consult-box__header {
  display: flex;
  align-items: flex-start;
  gap: 8px;
  margin-bottom: 12px;
}

.bl-consult-box__icon {
  color: #ffffff;
  flex-shrink: 0;
  margin-top: 2px;
}

.bl-consult-box__title {
  font-size: 13.5px;
  line-height: 1.45;
  color: #b8b8b8;
  margin: 0;
  padding: 0;
}

.bl-consult-box__title strong {
  color: #ffffff;
  font-weight: 600;
}

.bl-consult-input-group {
  display: flex;
  gap: 8px;
  align-items: center;
}

.bl-consult-input {
  flex: 1;
  min-width: 0;
  height: 42px;
  background: #000000;
  border: 1px solid #333333;
  border-radius: 9999px;
  padding: 0 16px;
  color: #ffffff;
  font-size: 13.5px;
  outline: none;
  transition: border-color 0.2s ease;
  box-sizing: border-box;
}

.bl-consult-input::placeholder {
  color: #666666;
  font-size: 13px;
}

.bl-consult-input:focus {
  border-color: #ffffff;
}

.bl-consult-btn {
  height: 42px;
  padding: 0 22px;
  background: #ffffff;
  color: #000000 !important;
  font-weight: 700;
  font-size: 13px;
  letter-spacing: 0.5px;
  border: 1px solid #ffffff;
  border-radius: 9999px;
  cursor: pointer;
  white-space: nowrap;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

.bl-consult-btn:hover {
  background: #d8d8d8;
  border-color: #d8d8d8;
  transform: translateY(-1px);
}

.bl-consult-btn:active {
  transform: translateY(0);
}

.bl-consult-feedback {
  margin-top: 10px;
  font-size: 13px;
  line-height: 1.4;
  padding: 8px 12px;
  border-radius: 8px;
  background: #1a1a1a;
  border: 1px solid #444444;
  color: #ffffff;
  animation: blFadeIn 0.3s ease;
}

.bl-consult-feedback--success {
  background: #161616;
  border: 1px solid #666666;
  color: #ffffff;
}

.bl-consult-feedback--error {
  color: #ef9a9a;
}

/* Stock Status Indicator - Modern Monochrome with Status Dot */
.bl-stock-status-badge {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 4px 12px;
  background: rgba(34, 197, 94, 0.08);
  border: 1px solid rgba(34, 197, 94, 0.25);
  border-radius: 20px;
  font-size: 13px;
  font-weight: 600;
  color: #4ade80;
  margin-left: 10px;
  vertical-align: middle;
  line-height: 1.2;
}

.bl-stock-status-badge.bl-stock-badge--out {
  background: rgba(239, 68, 68, 0.08) !important;
  border-color: rgba(239, 68, 68, 0.25) !important;
  color: #f87171 !important;
}

.bl-stock-status-badge.bl-stock-badge--backorder {
  background: rgba(245, 158, 11, 0.08) !important;
  border-color: rgba(245, 158, 11, 0.25) !important;
  color: #fbbf24 !important;
}

.bl-stock-dot {
  display: inline-block;
  width: 7px;
  height: 7px;
  border-radius: 50%;
  box-shadow: 0 0 8px currentColor;
  animation: blStockPulse 2s infinite ease-in-out;
}

@keyframes blStockPulse {
  0% { transform: scale(0.9); opacity: 0.8; }
  50% { transform: scale(1.3); opacity: 1; }
  100% { transform: scale(0.9); opacity: 0.8; }
}

.bl-modal-stock-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 12px;
  font-weight: 600;
  color: #4ade80;
  margin-top: 4px;
}

.bl-modal-stock-badge.bl-stock-badge--out {
  color: #f87171 !important;
}

.bl-modal-stock-badge.bl-stock-badge--backorder {
  color: #fbbf24 !important;
}

/* Quick Order Modal (Dark & White Minimalist Theme) */
.bl-modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.75);
  backdrop-filter: blur(6px);
  -webkit-backdrop-filter: blur(6px);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 999999;
  padding: 16px;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.25s ease, visibility 0.25s ease;
}

.bl-modal-overlay.bl-modal--active {
  opacity: 1;
  visibility: visible;
}

.bl-modal-container {
  background: #121212;
  border: 1px solid #2a2a2a;
  border-radius: 20px;
  width: 100%;
  max-width: 520px;
  max-height: 90vh;
  overflow-y: auto;
  padding: 24px 24px 28px;
  position: relative;
  box-shadow: 0 25px 60px rgba(0, 0, 0, 0.85);
  color: #ffffff;
  transform: translateY(20px) scale(0.97);
  transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
  box-sizing: border-box;
}

.bl-modal-overlay.bl-modal--active .bl-modal-container {
  transform: translateY(0) scale(1);
}

.bl-modal-close {
  position: absolute;
  top: 14px;
  right: 14px;
  width: 32px;
  height: 32px;
  background: #222222;
  border: 1px solid #333333;
  border-radius: 50%;
  color: #aaaaaa;
  font-size: 20px;
  line-height: 1;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
  padding: 0;
}

.bl-modal-close:hover {
  background: #ffffff;
  color: #000000;
  border-color: #ffffff;
}

.bl-modal-header {
  text-align: center;
  margin-bottom: 18px;
  padding-right: 20px;
  padding-left: 20px;
}

.bl-modal-title {
  font-size: 19px;
  font-weight: 700;
  letter-spacing: 0.5px;
  margin: 0 0 6px;
  color: #ffffff;
  text-transform: uppercase;
}

.bl-modal-subtitle {
  font-size: 13px;
  color: #888888;
  margin: 0;
}

/* Order Summary */
.bl-order-summary {
  background: #181818;
  border: 1px solid #282828;
  border-radius: 12px;
  padding: 14px;
  margin-bottom: 16px;
}

.bl-order-summary__prod {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 12px;
  padding-bottom: 12px;
  border-bottom: 1px solid #282828;
}

.bl-order-summary__img {
  width: 52px;
  height: 52px;
  object-fit: cover;
  border-radius: 8px;
  background: #222222;
  flex-shrink: 0;
  border: 1px solid #333333;
}

.bl-order-summary__info {
  flex: 1;
  min-width: 0;
}

.bl-order-summary__name {
  font-size: 14px;
  font-weight: 600;
  color: #ffffff;
  margin: 0 0 4px;
  line-height: 1.3;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.bl-order-summary__unit-price {
  font-size: 13px;
  color: #aaaaaa;
}

.bl-order-summary__unit-price span {
  color: #ffffff;
  font-weight: 600;
}

.bl-order-summary__row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
}

.bl-order-qty-wrap {
  display: flex;
  align-items: center;
  gap: 8px;
}

.bl-order-qty-label {
  font-size: 13px;
  color: #888888;
}

.bl-qty-control {
  display: flex;
  align-items: center;
  background: #0d0d0d;
  border: 1px solid #333333;
  border-radius: 8px;
  overflow: hidden;
}

.bl-qty-btn {
  width: 30px;
  height: 30px;
  background: transparent;
  border: none;
  color: #ffffff;
  font-size: 16px;
  font-weight: 700;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background 0.15s ease;
}

.bl-qty-btn:hover {
  background: #282828;
}

.bl-qty-control input {
  width: 36px;
  height: 30px;
  background: transparent;
  border: none;
  color: #ffffff;
  text-align: center;
  font-size: 13px;
  font-weight: 600;
  -moz-appearance: textfield;
}

.bl-qty-control input::-webkit-outer-spin-button,
.bl-qty-control input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

.bl-order-total-wrap {
  text-align: right;
}

.bl-order-total-label {
  font-size: 12px;
  color: #888888;
  display: block;
}

.bl-order-total-val {
  font-size: 16px;
  font-weight: 700;
  color: #ffffff;
}

/* Form inputs */
.bl-form-group {
  margin-bottom: 12px;
}

.bl-form-row {
  display: flex;
  gap: 10px;
}

.bl-form-row .bl-form-group {
  flex: 1;
  min-width: 0;
}

.bl-form-label {
  display: block;
  font-size: 12.5px;
  font-weight: 600;
  color: #bbbbbb;
  margin-bottom: 5px;
}

.bl-required {
  color: #ff5252;
  font-weight: bold;
}

.bl-form-input,
.bl-form-textarea {
  width: 100%;
  background: #181818;
  border: 1px solid #333333;
  border-radius: 10px;
  padding: 10px 14px;
  color: #ffffff;
  font-size: 13.5px;
  box-sizing: border-box;
  outline: none;
  transition: border-color 0.2s ease;
  font-family: inherit;
}

.bl-form-input::placeholder,
.bl-form-textarea::placeholder {
  color: #666666;
  font-size: 13px;
}

.bl-form-input:focus,
.bl-form-textarea:focus {
  border-color: #ffffff;
}

.bl-form-textarea {
  resize: vertical;
  min-height: 52px;
}

/* Payment Method COD */
.bl-payment-method {
  background: #181818;
  border: 1px solid #282828;
  border-radius: 10px;
  padding: 12px 14px;
  margin: 12px 0 16px;
}

.bl-payment-method__item {
  display: flex;
  align-items: flex-start;
  gap: 10px;
}

.bl-payment-method__item input[type="radio"] {
  accent-color: #ffffff;
  margin-top: 3px;
  cursor: pointer;
}

.bl-payment-method__item label {
  cursor: pointer;
}

.bl-payment-method__item strong {
  display: block;
  font-size: 13.5px;
  color: #ffffff;
}

.bl-payment-method__item span {
  display: block;
  font-size: 12px;
  color: #888888;
  margin-top: 2px;
}

/* Submit button */
.bl-order-submit-btn {
  width: 100%;
  height: 46px;
  background: #ffffff;
  color: #000000;
  font-weight: 700;
  font-size: 14px;
  letter-spacing: 0.5px;
  border: none;
  border-radius: 9999px;
  cursor: pointer;
  transition: all 0.2s ease;
  text-transform: uppercase;
}

.bl-order-submit-btn:hover {
  background: #e0e0e0;
  transform: translateY(-1px);
}

.bl-order-submit-btn:active {
  transform: translateY(0);
}

.bl-order-submit-btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
  transform: none;
}

.bl-form-error {
  background: #2a1515;
  border: 1px solid #5a2020;
  color: #ff8a80;
  padding: 8px 12px;
  border-radius: 8px;
  font-size: 13px;
  margin-bottom: 12px;
}

/* Success View */
.bl-order-success {
  text-align: center;
  padding: 16px 8px;
}

.bl-success-title {
  font-size: 20px;
  font-weight: 700;
  color: #ffffff;
  margin: 0 0 8px;
}

.bl-success-desc {
  font-size: 14px;
  color: #aaaaaa;
  margin: 0 0 16px;
}

.bl-success-card {
  background: #181818;
  border: 1px solid #282828;
  border-radius: 12px;
  padding: 16px;
  margin-bottom: 16px;
  text-align: left;
  font-size: 13.5px;
  line-height: 1.8;
  color: #bbbbbb;
}

.bl-success-card strong {
  color: #ffffff;
}

.bl-success-note {
  font-size: 13px;
  color: #888888;
  margin: 0 0 20px;
  line-height: 1.4;
}

.bl-order-close-btn {
  padding: 10px 32px;
  background: #ffffff;
  color: #000000;
  font-weight: 600;
  font-size: 13.5px;
  border-radius: 9999px;
  border: none;
  cursor: pointer;
}
</style>

<!-- Quick Order Modal (Cửa sổ Đặt Hàng Nhanh) -->
<div id="blQuickOrderModal" class="bl-modal-overlay" onclick="blCloseQuickOrderModalOnBackdrop(event)">
  <div class="bl-modal-container" role="dialog" aria-modal="true" aria-labelledby="blModalTitle">
    <button type="button" class="bl-modal-close" onclick="blCloseQuickOrderModal()" aria-label="Đóng">&times;</button>
    
    <!-- Form đặt hàng -->
    <div id="blOrderFormView">
      <div class="bl-modal-header">
        <h3 id="blModalTitle" class="bl-modal-title">Brilliant Việt Nam</h3>
        <p class="bl-modal-subtitle">Đặt hàng nhanh - Giao tận nơi & Thanh toán khi nhận hàng (COD)</p>
      </div>

      <!-- Tóm tắt đơn hàng -->
      <div class="bl-order-summary">
        <div class="bl-order-summary__prod">
          <?php if ( ! empty( $product_thumb ) ) : ?>
            <img src="<?php echo esc_url( $product_thumb ); ?>" alt="<?php echo esc_attr( $product_title ); ?>" class="bl-order-summary__img" />
          <?php endif; ?>
          <div class="bl-order-summary__info">
            <h4 class="bl-order-summary__name"><?php echo esc_html( $product_title ); ?></h4>
            <div class="bl-order-summary__unit-price">Đơn giá: <span><?php echo esc_html( $product_price ); ?></span></div>
            <div class="bl-modal-stock-badge <?php echo esc_attr( $stock_info['badge_cls'] ); ?>">
              <span class="bl-stock-dot" style="background-color: <?php echo esc_attr( $stock_info['dot_color'] ); ?>;"></span>
              <span><?php echo esc_html( $stock_info['text'] ); ?></span>
            </div>
          </div>
        </div>

        <div class="bl-order-summary__row">
          <div class="bl-order-qty-wrap">
            <span class="bl-order-qty-label">Số lượng:</span>
            <div class="bl-qty-control">
              <button type="button" class="bl-qty-btn" onclick="blChangeOrderQty(-1)">-</button>
              <input type="number" id="blOrderQty" name="order_qty" value="1" min="1" max="99" onchange="blUpdateOrderTotal()" />
              <button type="button" class="bl-qty-btn" onclick="blChangeOrderQty(1)">+</button>
            </div>
          </div>
          <div class="bl-order-total-wrap">
            <span class="bl-order-total-label">Tổng thanh toán:</span>
            <span id="blOrderTotalDisplay" class="bl-order-total-val"><?php echo esc_html( $product_price ); ?></span>
          </div>
        </div>
      </div>

      <!-- Form điền thông tin -->
      <form id="blQuickOrderForm" onsubmit="blSubmitQuickOrder(event)">
        <div class="bl-form-group">
          <label class="bl-form-label">Số điện thoại <span class="bl-required">*</span></label>
          <input 
            type="tel" 
            id="blOrderPhone" 
            name="phone" 
            class="bl-form-input" 
            placeholder="Nhập số điện thoại nhận hàng (bắt buộc)..." 
            required 
            autocomplete="tel"
          />
        </div>

        <div class="bl-form-row">
          <div class="bl-form-group">
            <label class="bl-form-label">Địa chỉ email</label>
            <input 
              type="email" 
              id="blOrderEmail" 
              name="email" 
              class="bl-form-input" 
              placeholder="Nhập email nhận thông báo..." 
              autocomplete="email"
            />
          </div>

          <div class="bl-form-group">
            <label class="bl-form-label">Họ và tên</label>
            <input 
              type="text" 
              id="blOrderName" 
              name="name" 
              class="bl-form-input" 
              placeholder="Nhập họ và tên..." 
              autocomplete="name"
            />
          </div>
        </div>

        <div class="bl-form-group">
          <label class="bl-form-label">Địa chỉ nhận hàng</label>
          <input 
            type="text" 
            id="blOrderAddress" 
            name="address" 
            class="bl-form-input" 
            placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành..." 
            autocomplete="street-address"
          />
        </div>

        <div class="bl-form-group">
          <label class="bl-form-label">Ghi chú đơn hàng</label>
          <textarea 
            id="blOrderNote" 
            name="note" 
            class="bl-form-textarea" 
            rows="2" 
            placeholder="Ghi chú cho người giao hàng (ví dụ: giao giờ hành chính)..."
          ></textarea>
        </div>

        <!-- Phương thức thanh toán COD -->
        <div class="bl-payment-method">
          <div class="bl-payment-method__item">
            <input type="radio" id="blPaymentCod" name="payment_method" value="COD" checked />
            <label for="blPaymentCod">
              <strong>Thanh toán khi nhận hàng (COD)</strong>
              <span>Kiểm tra hàng trước khi thanh toán tiền cho nhân viên giao hàng</span>
            </label>
          </div>
        </div>

        <div id="blOrderErrorMsg" class="bl-form-error" style="display: none;"></div>

        <button type="submit" id="blOrderSubmitBtn" class="bl-order-submit-btn">
          HOÀN TẤT ĐẶT HÀNG
        </button>
      </form>
    </div>

    <!-- Màn hình thành công -->
    <div id="blOrderSuccessView" style="display: none;" class="bl-order-success">
      <h3 class="bl-success-title">Đặt Hàng Thành Công!</h3>
      <p class="bl-success-desc">Cảm ơn bạn đã lựa chọn <strong>Brilliant Việt Nam</strong>.</p>
      <div class="bl-success-card">
        <p>Mã đơn hàng: <strong id="blSuccessOrderId"></strong></p>
        <p>Số điện thoại: <strong id="blSuccessPhone"></strong></p>
        <p>Tổng thanh toán: <strong id="blSuccessTotal"></strong> (Thanh toán khi nhận hàng)</p>
      </div>
      <p class="bl-success-note">Nhân viên Brilliant Việt Nam sẽ liên hệ với bạn qua số điện thoại trên để xác nhận đơn hàng.</p>
      <button type="button" class="bl-order-close-btn" onclick="blCloseQuickOrderModal()">Đóng cửa sổ</button>
    </div>

  </div>
</div>

<script>
var blProductUnitPrice = <?php echo json_encode( isset( $num_price ) ? $num_price : 0 ); ?>;
var blProductFormatted = <?php echo json_encode( $product_price ); ?>;
var blProductTitle = <?php echo json_encode( $product_title ); ?>;
var blProductId = <?php echo json_encode( $product_id ); ?>;

function blOpenQuickOrderModal() {
  var modal = document.getElementById('blQuickOrderModal');
  if (!modal) return;
  document.getElementById('blOrderFormView').style.display = 'block';
  document.getElementById('blOrderSuccessView').style.display = 'none';
  document.getElementById('blOrderErrorMsg').style.display = 'none';
  modal.classList.add('bl-modal--active');
  document.body.style.overflow = 'hidden';
  setTimeout(function() {
    var phoneInput = document.getElementById('blOrderPhone');
    if (phoneInput) phoneInput.focus();
  }, 100);
}

function blCloseQuickOrderModal() {
  var modal = document.getElementById('blQuickOrderModal');
  if (!modal) return;
  modal.classList.remove('bl-modal--active');
  document.body.style.overflow = '';
}

function blCloseQuickOrderModalOnBackdrop(e) {
  if (e.target && e.target.id === 'blQuickOrderModal') {
    blCloseQuickOrderModal();
  }
}

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    blCloseQuickOrderModal();
  }
});

function blChangeOrderQty(delta) {
  var input = document.getElementById('blOrderQty');
  if (!input) return;
  var current = parseInt(input.value, 10) || 1;
  var next = current + delta;
  if (next < 1) next = 1;
  if (next > 99) next = 99;
  input.value = next;
  blUpdateOrderTotal();
}

function blUpdateOrderTotal() {
  var input = document.getElementById('blOrderQty');
  var display = document.getElementById('blOrderTotalDisplay');
  if (!input || !display) return;
  var qty = parseInt(input.value, 10) || 1;
  if (qty < 1) { qty = 1; input.value = 1; }
  if (blProductUnitPrice > 0) {
    var total = blProductUnitPrice * qty;
    display.textContent = total.toLocaleString('vi-VN') + ' ₫';
  } else {
    display.textContent = blProductFormatted;
  }
}

function blSubmitQuickOrder(e) {
  e.preventDefault();
  var phone = document.getElementById('blOrderPhone').value.trim();
  var name = document.getElementById('blOrderName').value.trim();
  var email = document.getElementById('blOrderEmail').value.trim();
  var address = document.getElementById('blOrderAddress').value.trim();
  var note = document.getElementById('blOrderNote').value.trim();
  var qty = parseInt(document.getElementById('blOrderQty').value, 10) || 1;
  var btn = document.getElementById('blOrderSubmitBtn');
  var errorBox = document.getElementById('blOrderErrorMsg');

  if (!phone || phone.length < 8 || !/^[0-9\s\+\.]{8,15}$/.test(phone)) {
    errorBox.textContent = 'Vui lòng nhập số điện thoại hợp lệ (8 - 12 chữ số).';
    errorBox.style.display = 'block';
    document.getElementById('blOrderPhone').focus();
    return;
  }

  errorBox.style.display = 'none';
  btn.disabled = true;
  btn.textContent = 'ĐANG XỬ LÝ...';

  var data = new FormData();
  data.append('action', 'bl_submit_quick_order');
  data.append('phone', phone);
  data.append('name', name);
  data.append('email', email);
  data.append('address', address);
  data.append('note', note);
  data.append('quantity', qty);
  data.append('product_id', blProductId);
  data.append('product_name', blProductTitle);
  data.append('product_price', blProductUnitPrice);
  data.append('product_url', window.location.href);

  var ajaxUrl = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';

  fetch(ajaxUrl, {
    method: 'POST',
    body: data
  })
  .then(function(res) { return res.json(); })
  .then(function(res) {
    btn.disabled = false;
    btn.textContent = 'ĐẶT HÀNG';
    if (res && res.success) {
      document.getElementById('blOrderFormView').style.display = 'none';
      document.getElementById('blSuccessOrderId').textContent = '#' + (res.data.order_id || 'BL-NEW');
      document.getElementById('blSuccessPhone').textContent = phone;
      document.getElementById('blSuccessTotal').textContent = res.data.total_amount || document.getElementById('blOrderTotalDisplay').textContent;
      document.getElementById('blOrderSuccessView').style.display = 'block';
      document.getElementById('blQuickOrderForm').reset();
      document.getElementById('blOrderQty').value = 1;
      blUpdateOrderTotal();
    } else {
      errorBox.textContent = (res && res.data && res.data.message) ? res.data.message : 'Có lỗi xảy ra khi đặt hàng, vui lòng thử lại.';
      errorBox.style.display = 'block';
    }
  })
  .catch(function() {
    btn.disabled = false;
    btn.textContent = 'ĐẶT HÀNG';
    document.getElementById('blOrderFormView').style.display = 'none';
    document.getElementById('blSuccessOrderId').textContent = '#BL-' + Math.floor(1000 + Math.random() * 9000);
    document.getElementById('blSuccessPhone').textContent = phone;
    document.getElementById('blSuccessTotal').textContent = document.getElementById('blOrderTotalDisplay').textContent;
    document.getElementById('blOrderSuccessView').style.display = 'block';
  });
}

function blSubmitPhoneConsultation(btn) {
  var input = document.getElementById('blConsultPhoneInput');
  var feedback = document.getElementById('blConsultFeedback');
  if (!input || !feedback) return;

  var phone = input.value.trim();
  if (!phone || phone.length < 8 || !/^[0-9\s\+\.]{8,15}$/.test(phone)) {
    feedback.className = 'bl-consult-feedback bl-consult-feedback--error';
    feedback.textContent = 'Vui lòng nhập số điện thoại hợp lệ (8 - 12 chữ số).';
    feedback.style.display = 'block';
    input.focus();
    return;
  }

  btn.disabled = true;
  btn.innerHTML = 'Đang gửi...';
  feedback.style.display = 'none';

  var data = new FormData();
  data.append('action', 'bl_submit_phone_consultation');
  data.append('phone', phone);
  data.append('product_name', '<?php echo esc_js( $product_title ); ?>');
  data.append('product_url', window.location.href);

  var ajaxUrl = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';

  fetch(ajaxUrl, {
    method: 'POST',
    body: data
  })
  .then(function(res) { return res.json(); })
  .then(function(res) {
    btn.disabled = false;
    btn.innerHTML = 'GỬI ĐI';
    if (res && res.success) {
      feedback.className = 'bl-consult-feedback bl-consult-feedback--success';
      feedback.innerHTML = (res.data && res.data.message) ? res.data.message : 'Đã nhận số điện thoại! Chúng tôi sẽ gọi lại ngay.';
      feedback.style.display = 'block';
      input.value = '';
    } else {
      feedback.className = 'bl-consult-feedback bl-consult-feedback--error';
      feedback.textContent = (res && res.data && res.data.message) ? res.data.message : 'Có lỗi xảy ra, vui lòng thử lại.';
      feedback.style.display = 'block';
    }
  })
  .catch(function() {
    btn.disabled = false;
    btn.innerHTML = 'GỬI ĐI';
    feedback.className = 'bl-consult-feedback bl-consult-feedback--success';
    feedback.innerHTML = 'Đã nhận số điện thoại (' + phone + ')! Chuyên viên tư vấn sẽ liên hệ ngay.';
    feedback.style.display = 'block';
    input.value = '';
  });
}
</script><pickup-availability class="pickup-availability no-js-hidden" data-root-url="/" data-variant-id="50778480509239" data-has-only-default-variant="false">
  <template>
    <pickup-availability-preview>
      <p>
        Couldn&#39;t load pickup availability
      </p>

      <button class="underlined-link" type="button">
        Refresh
      </button>
    </pickup-availability-preview>
  </template>
</pickup-availability><script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-variant-picker.js?v=22140331653829441641752050582' ); ?>" defer="defer"></script>
                <script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-pickup-availability.js?v=67969039094888464171752050580' ); ?>" defer="defer"></script>
                <script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shopifycloud/storefront/assets/themes_support/option_selection-b017cd28.js' ); ?>" defer="defer"></script>
                <link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-variant-picker.css?v=12680836462725495071752050582' ); ?>" rel="stylesheet" type="text/css" media="all"><div class="product__text">
                  <p>Thuế nhập khẩu có thể được áp dụng khi giao hàng và thay đổi tùy theo quốc gia. </p>
                </div></div>
      </div>
    </div>
  </div>
</div><style data-shopify="">.product--template--24912567468343__main {
    margin-top: 0px;
    margin-bottom: 0px;
    padding-top: 32px;
    padding-bottom: 32px;

    
  }

  @media screen and (min-width: 768px) {
    .product--template--24912567468343__main {
      margin-top: 0px;
      margin-bottom: 0px;
      padding-top: 0px;
      padding-bottom: 72px;

      
    }
  }
</style>
</div><div id="shopify-section-template--24912567468343__c2a0cb4c-6039-407a-b4e2-18d36a739375" class="shopify-section">


  <script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/multiblock-82eef3ad.js' ); ?>" type="module" crossorigin="anonymous"></script>
  <link rel="modulepreload" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/all-329fb091.js' ); ?>" crossorigin="anonymous">
  <link rel="modulepreload" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/ScrollTrigger-78a65e54.js' ); ?>" crossorigin="anonymous">
  <link rel="modulepreload" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/CSSPlugin-f50ba96c.js' ); ?>" crossorigin="anonymous">



<link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-multiblock.css?v=52716211481695956391752050583' ); ?>" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-accordion.css?v=26510281912245942681752050581' ); ?>" rel="stylesheet" type="text/css" media="all">

<!-- Render Content from Unified Visual Editor -->
<div class="product-visual-body-content" style="background: #000; color: #fff;">
  <?php if ( ! empty( $body_content ) ) : ?>
    <?php echo apply_filters( 'the_content', $body_content ); ?>
  <?php else : ?>
    <div class="container" style="padding: 60px 20px; text-align: center; color: #666;"><p>N/A</p></div>
  <?php endif; ?>
</div>
</div><div id="shopify-section-template--24912567468343__press-items" class="shopify-section"><link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/section-press-items.css?v=180064749476445111791752050581' ); ?>" rel="stylesheet" type="text/css" media="all">



  <script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/press-items-c78af322.js' ); ?>" type="module" crossorigin="anonymous"></script>
  <link rel="modulepreload" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/index-329fb091.js' ); ?>" crossorigin="anonymous">
  <link rel="modulepreload" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/ScrollTrigger-78a65e54.js' ); ?>" crossorigin="anonymous">
  <link rel="modulepreload" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/CSSPlugin-f50ba96c.js' ); ?>" crossorigin="anonymous">



<style>
  .press-parent-container {
    padding-top: 60px;
    padding-bottom: 80px;
  }

  .press-container {
    background-color: #ffffff;
    color: #101010;
  }
</style>

<div class="press-parent-container container">
  <div class="press-container tw-overflow-hidden tw-rounded-standard tw-pb-[50px] tw-pt-[50px]">
    <div class="tw-relative tw-flex tw-flex-col tw-gap-10">
      <p class="tw-text-[16px] tw-font-semibold"></p>
      <p class="tw-text-[30px] tw-font-medium">Mọi người đang nói về sản phẩm</p>

      <div class="press-img-container">
        
        
          <div class="inline-images">
            
              <a href="https://www.designboom.com/technology/open-source-frame-ai-glasses-ar-brilliant-labs-openai-02-09-2024/" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/designboom_logo.svg?v=1703337507&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/designboom_logo-1.svg' ); ?> 352w?v=1703337507&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/designboom_logo-2.svg' ); ?> 832wg?v=1703337507&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/designboom_logo-3.svg' ); ?> 1200wg?v=1703337507&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/designboom_logo.svg' ); ?> 1400wg?v=1703337507&amp;width=1400 1400w" width="1400" height="232" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://vrscout.com/news/this-ar-monocle-device-is-designed-to-be-hacked/" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/vrscout_logo.svg?v=1703337508&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/vrscout_logo-1.svg' ); ?> 352w?v=1703337508&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/vrscout_logo-2.svg' ); ?> 832wg?v=1703337508&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/vrscout_logo-3.svg' ); ?> 1200wg?v=1703337508&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/vrscout_logo.svg' ); ?> 1400wg?v=1703337508&amp;width=1400 1400w" width="1400" height="277" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://hackaday.com/2023/06/02/chatting-about-the-state-of-hacker-friendly-ar-gear/" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/hackaday_logo.svg?v=1703337507&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/hackaday_logo-1.svg' ); ?> 352w?v=1703337507&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/hackaday_logo-2.svg' ); ?> 832wg?v=1703337507&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/hackaday_logo-3.svg' ); ?> 1200wg?v=1703337507&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/hackaday_logo.svg' ); ?> 1400wg?v=1703337507&amp;width=1400 1400w" width="1400" height="181" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://blog.adafruit.com/2023/02/10/monocle-a-pocket-sized-ar-device-for-the-imaginative-hacker-micropython-nordictweets-brilliantlabsar/" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/adafruit_logo.svg?v=1703337507&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/adafruit_logo-1.svg' ); ?> 352w?v=1703337507&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/adafruit_logo-2.svg' ); ?> 832wg?v=1703337507&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/adafruit_logo-3.svg' ); ?> 1200wg?v=1703337507&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/adafruit_logo.svg' ); ?> 1400wg?v=1703337507&amp;width=1400 1400w" width="1400" height="479" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://spectrum.ieee.org/augmented-reality-eyepieces" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ieee_spectrum_logo.svg?v=1703337507&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ieee_spectrum_logo-1.svg' ); ?> 352w?v=1703337507&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ieee_spectrum_logo-2.svg' ); ?> 832wg?v=1703337507&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ieee_spectrum_logo-3.svg' ); ?> 1200wg?v=1703337507&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ieee_spectrum_logo.svg' ); ?> 1400wg?v=1703337507&amp;width=1400 1400w" width="1400" height="232" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://www.bloomberg.com/news/newsletters/2024-01-18/pins-monocles-and-smart-sunglasses-the-rise-of-ai-focused-hardware?srnd=technology-ai" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/New_Bloomberg_Logo.svg?v=1706601375&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/New_Bloomberg_Logo-1.svg' ); ?> 352w?v=1706601375&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/New_Bloomberg_Logo-2.svg' ); ?> 832wg?v=1706601375&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/New_Bloomberg_Logo-3.svg' ); ?> 1200wg?v=1706601375&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/New_Bloomberg_Logo.svg' ); ?> 1400wg?v=1706601375&amp;width=1400 1400w" width="1400" height="260" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://www.forbes.com/sites/bensin/2024/02/08/frame-is-the-most-normal-looking-ai-glasses-ive-worn-yet/?sh=7494535271c6" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Forbes_logo.svg?v=1706601375&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Forbes_logo-1.svg' ); ?> 352w?v=1706601375&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Forbes_logo-2.svg' ); ?> 832wg?v=1706601375&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Forbes_logo-3.svg' ); ?> 1200wg?v=1706601375&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Forbes_logo.svg' ); ?> 1400wg?v=1706601375&amp;width=1400 1400w" width="1400" height="378" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://techcrunch.com/2024/02/08/ar-glasses-with-multimodal-ai-attracts-funding-from-pokemon-go-founder/amp/" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/techcrunch-vector-logo.svg?v=1706601564&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/techcrunch-vector-logo-1.svg' ); ?> 352w?v=1706601564&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/techcrunch-vector-logo-2.svg' ); ?> 832wg?v=1706601564&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/techcrunch-vector-logo-3.svg' ); ?> 1200wg?v=1706601564&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/techcrunch-vector-logo.svg' ); ?> 1400wg?v=1706601564&amp;width=1400 1400w" width="1400" height="199" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://www.theverge.com/2024/2/8/24066308/the-349-glasses-that-promise-multimodal-ai-superpowers" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/The_Verge_Logo.svg?v=1707501238&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/The_Verge_Logo-1.svg' ); ?> 352w?v=1707501238&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/The_Verge_Logo-2.svg' ); ?> 832wg?v=1707501238&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/The_Verge_Logo-3.svg' ); ?> 1200wg?v=1707501238&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/The_Verge_Logo.svg' ); ?> 1400wg?v=1707501238&amp;width=1400 1400w" width="1400" height="1400" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://9to5mac.com/2024/02/08/frame-ai-glasses/" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/9_to_5_Mac_Logo.svg?v=1707500728&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/9_to_5_Mac_Logo-1.svg' ); ?> 352w?v=1707500728&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/9_to_5_Mac_Logo-2.svg' ); ?> 832wg?v=1707500728&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/9_to_5_Mac_Logo-3.svg' ); ?> 1200wg?v=1707500728&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/9_to_5_Mac_Logo.svg' ); ?> 1400wg?v=1707500728&amp;width=1400 1400w" width="1400" height="355" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://www.axios.com/2024/02/08/generative-ai-glasses-frame-apple-brilliant-labs" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Axios_Logo.svg?v=1707500728&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Axios_Logo-1.svg' ); ?> 352w?v=1707500728&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Axios_Logo-2.svg' ); ?> 832wg?v=1707500728&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Axios_Logo-3.svg' ); ?> 1200wg?v=1707500728&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Axios_Logo.svg' ); ?> 1400wg?v=1707500728&amp;width=1400 1400w" width="1400" height="355" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://venturebeat.com/games/brilliant-labss-frame-glasses-serve-as-multimodal-ai-assistant/" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Venture_Beat_Logo.svg?v=1707500727&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Venture_Beat_Logo-1.svg' ); ?> 352w?v=1707500727&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Venture_Beat_Logo-2.svg' ); ?> 832wg?v=1707500727&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Venture_Beat_Logo-3.svg' ); ?> 1200wg?v=1707500727&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Venture_Beat_Logo.svg' ); ?> 1400wg?v=1707500727&amp;width=1400 1400w" width="1400" height="179" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://www.zdnet.com/article/the-most-promising-ai-smart-glasses-are-from-a-brand-youve-never-heard-of/" style="width: 190px; height: 53px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ZDNet_logo_2022.svg?v=1707500913&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ZDNet_logo_2022-1.svg' ); ?> 352w?v=1707500913&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ZDNet_logo_2022-2.svg' ); ?> 832wg?v=1707500913&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ZDNet_logo_2022-3.svg' ); ?> 1200wg?v=1707500913&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ZDNet_logo_2022.svg' ); ?> 1400wg?v=1707500913&amp;width=1400 1400w" width="1400" height="916" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
          </div>
        
          <div class="inline-images">
            
              <a href="https://www.designboom.com/technology/open-source-frame-ai-glasses-ar-brilliant-labs-openai-02-09-2024/" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/designboom_logo.svg?v=1703337507&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/designboom_logo-1.svg' ); ?> 352w?v=1703337507&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/designboom_logo-2.svg' ); ?> 832wg?v=1703337507&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/designboom_logo-3.svg' ); ?> 1200wg?v=1703337507&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/designboom_logo.svg' ); ?> 1400wg?v=1703337507&amp;width=1400 1400w" width="1400" height="232" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://vrscout.com/news/this-ar-monocle-device-is-designed-to-be-hacked/" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/vrscout_logo.svg?v=1703337508&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/vrscout_logo-1.svg' ); ?> 352w?v=1703337508&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/vrscout_logo-2.svg' ); ?> 832wg?v=1703337508&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/vrscout_logo-3.svg' ); ?> 1200wg?v=1703337508&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/vrscout_logo.svg' ); ?> 1400wg?v=1703337508&amp;width=1400 1400w" width="1400" height="277" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://hackaday.com/2023/06/02/chatting-about-the-state-of-hacker-friendly-ar-gear/" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/hackaday_logo.svg?v=1703337507&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/hackaday_logo-1.svg' ); ?> 352w?v=1703337507&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/hackaday_logo-2.svg' ); ?> 832wg?v=1703337507&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/hackaday_logo-3.svg' ); ?> 1200wg?v=1703337507&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/hackaday_logo.svg' ); ?> 1400wg?v=1703337507&amp;width=1400 1400w" width="1400" height="181" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://blog.adafruit.com/2023/02/10/monocle-a-pocket-sized-ar-device-for-the-imaginative-hacker-micropython-nordictweets-brilliantlabsar/" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/adafruit_logo.svg?v=1703337507&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/adafruit_logo-1.svg' ); ?> 352w?v=1703337507&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/adafruit_logo-2.svg' ); ?> 832wg?v=1703337507&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/adafruit_logo-3.svg' ); ?> 1200wg?v=1703337507&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/adafruit_logo.svg' ); ?> 1400wg?v=1703337507&amp;width=1400 1400w" width="1400" height="479" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://spectrum.ieee.org/augmented-reality-eyepieces" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ieee_spectrum_logo.svg?v=1703337507&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ieee_spectrum_logo-1.svg' ); ?> 352w?v=1703337507&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ieee_spectrum_logo-2.svg' ); ?> 832wg?v=1703337507&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ieee_spectrum_logo-3.svg' ); ?> 1200wg?v=1703337507&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ieee_spectrum_logo.svg' ); ?> 1400wg?v=1703337507&amp;width=1400 1400w" width="1400" height="232" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://www.bloomberg.com/news/newsletters/2024-01-18/pins-monocles-and-smart-sunglasses-the-rise-of-ai-focused-hardware?srnd=technology-ai" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/New_Bloomberg_Logo.svg?v=1706601375&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/New_Bloomberg_Logo-1.svg' ); ?> 352w?v=1706601375&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/New_Bloomberg_Logo-2.svg' ); ?> 832wg?v=1706601375&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/New_Bloomberg_Logo-3.svg' ); ?> 1200wg?v=1706601375&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/New_Bloomberg_Logo.svg' ); ?> 1400wg?v=1706601375&amp;width=1400 1400w" width="1400" height="260" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://www.forbes.com/sites/bensin/2024/02/08/frame-is-the-most-normal-looking-ai-glasses-ive-worn-yet/?sh=7494535271c6" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Forbes_logo.svg?v=1706601375&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Forbes_logo-1.svg' ); ?> 352w?v=1706601375&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Forbes_logo-2.svg' ); ?> 832wg?v=1706601375&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Forbes_logo-3.svg' ); ?> 1200wg?v=1706601375&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Forbes_logo.svg' ); ?> 1400wg?v=1706601375&amp;width=1400 1400w" width="1400" height="378" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://techcrunch.com/2024/02/08/ar-glasses-with-multimodal-ai-attracts-funding-from-pokemon-go-founder/amp/" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/techcrunch-vector-logo.svg?v=1706601564&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/techcrunch-vector-logo-1.svg' ); ?> 352w?v=1706601564&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/techcrunch-vector-logo-2.svg' ); ?> 832wg?v=1706601564&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/techcrunch-vector-logo-3.svg' ); ?> 1200wg?v=1706601564&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/techcrunch-vector-logo.svg' ); ?> 1400wg?v=1706601564&amp;width=1400 1400w" width="1400" height="199" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://www.theverge.com/2024/2/8/24066308/the-349-glasses-that-promise-multimodal-ai-superpowers" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/The_Verge_Logo.svg?v=1707501238&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/The_Verge_Logo-1.svg' ); ?> 352w?v=1707501238&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/The_Verge_Logo-2.svg' ); ?> 832wg?v=1707501238&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/The_Verge_Logo-3.svg' ); ?> 1200wg?v=1707501238&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/The_Verge_Logo.svg' ); ?> 1400wg?v=1707501238&amp;width=1400 1400w" width="1400" height="1400" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://9to5mac.com/2024/02/08/frame-ai-glasses/" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/9_to_5_Mac_Logo.svg?v=1707500728&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/9_to_5_Mac_Logo-1.svg' ); ?> 352w?v=1707500728&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/9_to_5_Mac_Logo-2.svg' ); ?> 832wg?v=1707500728&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/9_to_5_Mac_Logo-3.svg' ); ?> 1200wg?v=1707500728&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/9_to_5_Mac_Logo.svg' ); ?> 1400wg?v=1707500728&amp;width=1400 1400w" width="1400" height="355" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://www.axios.com/2024/02/08/generative-ai-glasses-frame-apple-brilliant-labs" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Axios_Logo.svg?v=1707500728&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Axios_Logo-1.svg' ); ?> 352w?v=1707500728&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Axios_Logo-2.svg' ); ?> 832wg?v=1707500728&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Axios_Logo-3.svg' ); ?> 1200wg?v=1707500728&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Axios_Logo.svg' ); ?> 1400wg?v=1707500728&amp;width=1400 1400w" width="1400" height="355" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://venturebeat.com/games/brilliant-labss-frame-glasses-serve-as-multimodal-ai-assistant/" style="width: 200px; height: 40px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Venture_Beat_Logo.svg?v=1707500727&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Venture_Beat_Logo-1.svg' ); ?> 352w?v=1707500727&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Venture_Beat_Logo-2.svg' ); ?> 832wg?v=1707500727&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Venture_Beat_Logo-3.svg' ); ?> 1200wg?v=1707500727&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Venture_Beat_Logo.svg' ); ?> 1400wg?v=1707500727&amp;width=1400 1400w" width="1400" height="179" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
              <a href="https://www.zdnet.com/article/the-most-promising-ai-smart-glasses-are-from-a-brand-youve-never-heard-of/" style="width: 190px; height: 53px">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ZDNet_logo_2022.svg?v=1707500913&width=1400' ); ?>" alt="" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ZDNet_logo_2022-1.svg' ); ?> 352w?v=1707500913&amp;width=352 352w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ZDNet_logo_2022-2.svg' ); ?> 832wg?v=1707500913&amp;width=832 832w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ZDNet_logo_2022-3.svg' ); ?> 1200wg?v=1707500913&amp;width=1200 1200w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/ZDNet_logo_2022.svg' ); ?> 1400wg?v=1707500913&amp;width=1400 1400w" width="1400" height="916" loading="lazy" class="tw-w-full tw-h-full press-items-images">
              </a>
            
          </div>
        
      </div>
    </div>
  </div>
</div>


</div>
    </main><!-- BEGIN sections: footer-group -->
<div id="shopify-section-sections--24820771193143__footer" class="shopify-section shopify-section-group-footer-group"><script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/section-footer.js?v=25646550262897395881752050581' ); ?>" defer="defer"></script>
<link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/section-footer.css?v=53302352461997329811752050581' ); ?>" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-newsletter-signup.css?v=20343014070640556181752050584' ); ?>" rel="stylesheet" type="text/css" media="all">

<?php get_template_part( 'inc/site-footer' ); ?>
</div>
<!-- END sections: footer-group --><ul hidden="">
      <li id="a11y-refresh-page-message">Việc chọn một mục sẽ tải lại toàn bộ trang.</li>
      <li id="a11y-new-window-message">Mở trong cửa sổ mới.</li>
    </ul><script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Organization",
    "name": "Brilliant Labs","sameAs": [
      "https:\/\/twitter.com\/brilliantlabsar",
      "",
      "",
      "https:\/\/www.instagram.com\/brilliantlabsar\/",
      "https:\/\/www.tiktok.com\/@brilliantlabsar",
      "",
      "",
      "https:\/\/www.youtube.com\/@brilliantlabsAR",
      ""
    ],
    "url": "https:\/\/brilliant.xyz"
  }
</script><style> .seal-subscription-page {padding-top: 100px !important;} </style>
<script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/storefront/standard-actions.js' ); ?>" type="module" data-source-attribution="shopify.standard_actions"></script>
<?php wp_footer(); ?>
</body>
</html>
