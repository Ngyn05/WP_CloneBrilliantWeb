<?php
/** Static interface converted from blogs/announcements/road-to-halo-part-3-of-4.html */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
﻿<!doctype html>
<html class="no-js" lang="vi">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="">
    <link rel="canonical" href="<?php echo esc_url( home_url( '/blogs/announcements/road-to-halo-part-3-of-4/' ) ); ?>">
    <link rel="preconnect" href="https://cdn.shopify.com" crossorigin=""><link rel="icon" type="image/png" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Artboard_1.jpg?crop=center&height=32&v=1707403926&width=32' ); ?>"><link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/Artboard_1-1.jpg?crop=center&height=180&v=1707403926&width=180' ); ?>">
    <link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/site.webmanifest' ); ?>">

    


  <link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/theme-f516ecd7.css' ); ?>" rel="stylesheet" type="text/css" media="all">




  <script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/theme-4ed993c7.js' ); ?>" type="module" crossorigin="anonymous"></script>



    <title>
      Hành trình đến Halo | Phần 3
 &ndash; Brilliant Labs</title><meta name="description" content="🎨Our work on Halo’s hardware required intentionality and restraint, clarity of purpose, and intensive design across every level of the stack.  🙄You may have noticed that nearly every other pair of smart glasses coming to market is following a predictable path.  But we are thinking different: these devices are not for s">

<meta property="og:site_name" content="Brilliant Labs">
<meta property="og:url" content="https://brilliant.xyz/blogs/announcements/road-to-halo-part-3-of-4">
<meta property="og:title" content="Hành trình đến Halo | Phần 3">
<meta property="og:type" content="article">
<meta property="og:description" content="🎨Our work on Halo’s hardware required intentionality and restraint, clarity of purpose, and intensive design across every level of the stack.  🙄You may have noticed that nearly every other pair of smart glasses coming to market is following a predictable path.  But we are thinking different: these devices are not for s"><meta property="og:image" content="http://brilliant.xyz/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e.webp?v=1756165881">
  <meta property="og:image:secure_url" content="https://brilliant.xyz/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e.webp?v=1756165881">
  <meta property="og:image:width" content="523">
  <meta property="og:image:height" content="697"><meta name="twitter:site" content="@brilliantlabsar"><meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Hành trình đến Halo | Phần 3">
<meta name="twitter:description" content="🎨Our work on Halo’s hardware required intentionality and restraint, clarity of purpose, and intensive design across every level of the stack.  🙄You may have noticed that nearly every other pair of smart glasses coming to market is following a predictable path.  But we are thinking different: these devices are not for s">
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
    error: `There was an error while updating your cart. Please try again.`,
    quantityError: `You can only add [quantity] of this item to your cart.`
  }

  window.variantStrings = {
    addToCart: `Mua ngay`,
    soldOut: `Sold out`,
    unavailable: `Unavailable`,
  }

  window.accessibilityStrings = {
    shareSuccess: `Link copied to clipboard`
  }
</script><style data-shopify="">@font-face {
  font-family: Archivo;
  font-weight: 400;
  font-style: normal;
  font-display: swap;
  src: url("../../cdn/fonts/archivo/archivo_n4.dc8d917cc69af0a65ae04d01fd8eeab28a3573c9.woff2") format("woff2"),
       url("../../cdn/fonts/archivo/archivo_n4.bd6b9c34fdb81d7646836be8065ce3c80a2cc984.woff") format("woff");
}

  @font-face {
  font-family: Archivo;
  font-weight: 700;
  font-style: normal;
  font-display: swap;
  src: url("../../cdn/fonts/archivo/archivo_n7.651b020b3543640c100112be6f1c1b8e816c7f13.woff2") format("woff2"),
       url("../../cdn/fonts/archivo/archivo_n7.7e9106d320e6594976a7dcb57957f3e712e83c96.woff") format("woff");
}

  @font-face {
  font-family: Archivo;
  font-weight: 400;
  font-style: italic;
  font-display: swap;
  src: url("../../cdn/fonts/archivo/archivo_i4.37d8c4e02dc4f8e8b559f47082eb24a5c48c2908.woff2") format("woff2"),
       url("../../cdn/fonts/archivo/archivo_i4.839d35d75c605237591e73815270f86ab696602c.woff") format("woff");
}

  @font-face {
  font-family: Archivo;
  font-weight: 700;
  font-style: italic;
  font-display: swap;
  src: url("../../cdn/fonts/archivo/archivo_i7.3dc798c6f261b8341dd97dd5c78d97d457c63517.woff2") format("woff2"),
       url("../../cdn/fonts/archivo/archivo_i7.3b65e9d326e7379bd5f15bcb927c5d533d950ff6.woff") format("woff");
}

  @font-face {
  font-family: Archivo;
  font-weight: 400;
  font-style: normal;
  font-display: swap;
  src: url("../../cdn/fonts/archivo/archivo_n4.dc8d917cc69af0a65ae04d01fd8eeab28a3573c9.woff2") format("woff2"),
       url("../../cdn/fonts/archivo/archivo_n4.bd6b9c34fdb81d7646836be8065ce3c80a2cc984.woff") format("woff");
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
<link rel="alternate" type="application/atom+xml" title="Feed" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/blogs/announcements.atom' ); ?>">
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
<script id="shop-js-analytics" type="application/json">{"pageType":"article"}</script>
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
<script id="__st">var __st={"a":72251900215,"offset":28800,"reqid":"74cf4690-1e4f-47ff-bd11-898ad02bb2b3-1787127421","pageurl":"brilliant.xyz\/blogs\/announcements\/road-to-halo-part-3-of-4","s":"articles-610229256503","u":"d7ad2516d803","p":"article","rtyp":"article","rid":610229256503};</script>
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
<script>(function(){if ("sendBeacon" in navigator && "performance" in window) {try {var session_token_from_headers = performance.getEntriesByType('navigation')[0].serverTiming.find(x => x.name == '_s').description;} catch {var session_token_from_headers = undefined;}var session_cookie_matches = document.cookie.match(/_shopify_s=([^;]*)/);var session_token_from_cookie = session_cookie_matches && session_cookie_matches.length === 2 ? session_cookie_matches[1] : "";var session_token = session_token_from_headers || session_token_from_cookie || "";function handle_abandonment_event(e) {var entries = performance.getEntries().filter(function(entry) {return /monorail-edge.shopifysvc.com/.test(entry.name);});if (!window.abandonment_tracked && entries.length === 0) {window.abandonment_tracked = true;var currentMs = Date.now();var navigation_start = performance.timing.navigationStart;var payload = {shop_id: 72251900215,url: window.location.href,navigation_start,duration: currentMs - navigation_start,session_token,page_type: "article"};window.navigator.sendBeacon("https://monorail-edge.shopifysvc.com/v1/produce", JSON.stringify({schema_id: "online_store_buyer_site_abandonment/1.1",payload: payload,metadata: {event_created_at_ms: currentMs,event_sent_at_ms: currentMs}}));}}window.addEventListener('pagehide', handle_abandonment_event);}}());</script>
<script>
  window.__TREKKIE_SHIM_QUEUE = window.__TREKKIE_SHIM_QUEUE || [];
</script>
<script>(function(){var wpmLoader=function(){"use strict";var e=/Googlebot|Storebot-Google|bingbot|Baiduspider|YandexBot|DuckDuckBot|Slurp|facebookexternalhit|Twitterbot|LinkedInBot|Applebot|AdsBot-Google|Mediapartners-Google|APIs-Google|PetalBot|SemrushBot|AhrefsBot|MJ12bot|DotBot|Acunetix|PerplexityBot|Perplexity-User/i,r=/bytedance/i;function o(){try{var e=document.cookie;if(!e||"string"!=typeof e)return;for(var r=0,o=e.split(";");r<o.length;r++){var d=o[r],t=d.indexOf("=");if(-1!==t){var n=d.slice(0,t).trim();if(n){var i=void 0;try{i=decodeURIComponent(n)}catch(e){i=n}if("_shopify_s"===i){var a=d.slice(t+1).trim();try{return decodeURIComponent(a)}catch(e){return a}}}}}return}catch(e){return}}function d(e){try{"undefined"!=typeof console&&"function"==typeof console.warn&&console.warn(e)}catch(e){}}return function(t,n,i,a){var s,c,u,l,f=arguments.length>4&&void 0!==arguments[4]?arguments[4]:{},p=(c=(s={modern:/Edge?\/(1{2}[4-9]|1[2-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Firefox\/(1{2}[4-9]|1[2-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Chrom(ium|e)\/(9{2}|\d{3,})\.\d+(\.\d+|)|(Maci|X1{2}).+ Version\/(15\.\d+|(1[6-9]|[2-9]\d|\d{3,})\.\d+)([,.]\d+|)( \(\w+\)|)( Mobile\/\w+|) Safari\/|Chrome.+OPR\/(9{2}|\d{3,})\.\d+\.\d+|(CPU[ +]OS|iPhone[ +]OS|CPU[ +]iPhone|CPU IPhone OS|CPU iPad OS)[ +]+(15[._]\d+|(1[6-9]|[2-9]\d|\d{3,})[._]\d+)([._]\d+|)|Android:?[ /-](14[89]|1[5-9]\d|[2-9]\d{2}|\d{4,})(\.\d+|)(\.\d+|)|Android.+Firefox\/(15\d|1[6-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Android.+Chrom(ium|e)\/(14[89]|1[5-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|SamsungBrowser\/([2-9]\d|\d{3,})\.\d+/,legacy:/Edge?\/(1[6-9]|[2-9]\d|\d{3,})\.\d+(\.\d+|)|Firefox\/(5[4-9]|[6-9]\d|\d{3,})\.\d+(\.\d+|)|Chrom(ium|e)\/(5[1-9]|[6-9]\d|\d{3,})\.\d+(\.\d+|)([\d.]+$|.*Safari\/(?![\d.]+ Edge\/[\d.]+$))|(Maci|X1{2}).+ Version\/(10\.\d+|(1[1-9]|[2-9]\d|\d{3,})\.\d+)([,.]\d+|)( \(\w+\)|)( Mobile\/\w+|) Safari\/|Chrome.+OPR\/(3[89]|[4-9]\d|\d{3,})\.\d+\.\d+|(CPU[ +]OS|iPhone[ +]OS|CPU[ +]iPhone|CPU IPhone OS|CPU iPad OS)[ +]+(10[._]\d+|(1[1-9]|[2-9]\d|\d{3,})[._]\d+)([._]\d+|)|Android:?[ /-](14[89]|1[5-9]\d|[2-9]\d{2}|\d{4,})(\.\d+|)(\.\d+|)|Mobile Safari.+OPR\/([89]\d|\d{3,})\.\d+\.\d+|Android.+Firefox\/(15\d|1[6-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Android.+Chrom(ium|e)\/(14[89]|1[5-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Android.+(UC? ?Browser|UCWEB|U3)[ /]?(15\.([5-9]|\d{2,})|(1[6-9]|[2-9]\d|\d{3,})\.\d+)\.\d+|SamsungBrowser\/(5\.\d+|([6-9]|\d{2,})\.\d+)|Android.+MQ{2}Browser\/(14(\.(9|\d{2,})|)|(1[5-9]|[2-9]\d|\d{3,})(\.\d+|))(\.\d+|)|K[Aa][Ii]OS\/(3\.\d+|([4-9]|\d{2,})\.\d+)(\.\d+|)/}).modern,u=s.legacy,(l=navigator.userAgent).match(e)?"bot":l.match(c)?"modern":l.match(u)?"legacy":l.match(r)?"bot":"unknown"),h=function(e){var r=e.version,t=e.browserTarget,n=e.surface,i=e.shopId,a=e.monorailEndpoint,s=window.location.href;return{emit:function(e){var c,u=e.status,l=e.errorMsg;if(!a)return d("[Web Pixels Manager] No Monorail endpoint provided, skipping logging."),!1;try{var f=(new Date).getTime();c=JSON.stringify({metadata:{event_sent_at_ms:f},events:[{schema_id:"web_pixels_manager_load/3.2",payload:{version:r,bundle_target:t,page_url:s,status:u,surface:n,error_msg:l,shop_id:i,visit_token:o()},metadata:{event_created_at_ms:f}}]})}catch(e){return!1}var p,h=!1;try{"function"==typeof window.navigator.sendBeacon&&-1===(p=window.navigator.userAgent).indexOf("iPhone; CPU iPhone OS 12_")&&-1===p.indexOf("iPad; CPU OS 12_")&&-1===p.indexOf("iPod touch; CPU iPhone OS 12_")&&(h=window.navigator.sendBeacon.bind(window.navigator)(a,c))}catch(e){h=!1}if(h)return!0;try{var m=new XMLHttpRequest;return m.open("POST",a,!0),m.setRequestHeader("Content-Type","text/plain"),m.send(c),!0}catch(e){return d("[Web Pixels Manager] Got an unhandled error while logging to Monorail."),!1}}}}({version:i,browserTarget:p,surface:t.surface,shopId:t.shopId,monorailEndpoint:t.monorailEndpoint});if(Boolean(null==(y=null==(m=window.Shopify)?void 0:m.analytics)?void 0:y.replayQueue))h.emit({status:"setup-skipped",errorMsg:"replay queue already initialized."});else{var m,y;h.emit({status:"setup-started"}),window.Shopify=window.Shopify||{};var g=window.Shopify;g.analytics=g.analytics||{};var v=g.analytics;v.replayQueue=[],v.publish=function(e,r,o){return v.replayQueue.push([e,r,o]),!0};try{self.performance.mark("wpm:start")}catch(e){}var w,b="modern"===p?"modern":"legacy",P=(null!=a?a:{modern:"",legacy:""})[b],S=[(w={baseUrl:n,hashVersion:i,buildTarget:b}).baseUrl,"/wpm","/b",w.hashVersion,"modern"===w.buildTarget?"m":"l",".js"].join("");try{f.browserTarget=p,O(function(){try{O(_)}catch(e){h.emit({status:"failed",errorMsg:U(e)})}}),h.emit({status:"loading"})}catch(e){h.emit({status:"failed",errorMsg:U(e)})}}function C(){if(!function(){var e,r;return Boolean(null==(r=null==(e=window.Shopify)?void 0:e.analytics)?void 0:r.initialized)}()){var e=window.webPixelsManager.init(t)||void 0;if(e){var r=window.Shopify.analytics;r.replayQueue.forEach(function(r){var o=r[0],d=r[1],t=r[2];e.publishCustomEvent(o,d,t)}),r.replayQueue=[],r.publish=e.publishCustomEvent,r.visitor=e.visitor,r.initialized=!0}}}function _(){return h.emit({status:"failed",errorMsg:"".concat(S," has failed to load")})}function O(e){var r;!function(e){var r=e.src,o=e.async,d=void 0===o||o,t=e.onload,n=e.onerror,i=e.sri,a=e.scriptDataAttributes,s=void 0===a?{}:a,c=document.createElement("script"),u=document.querySelector("head"),l=document.querySelector("body");if(c.async=d,c.src=r,i&&(c.integrity=i,c.crossOrigin="anonymous"),s)for(var f in s)if(Object.prototype.hasOwnProperty.call(s,f))try{c.dataset[f]=s[f]}catch(e){}if(t&&c.addEventListener("load",t),n&&c.addEventListener("error",n),u)u.appendChild(c);else{if(!l)throw new Error("Did not find a head or body element to append the script");l.appendChild(c)}}({src:S,async:!0,onload:C,onerror:e,sri:(r=P,"string"==typeof r&&/^sha384-[A-Za-z0-9+/=]+$/.test(r)?P:""),scriptDataAttributes:f})}function U(e){return e instanceof Error?e.message:"Unknown error"}}}();wpmLoader({shopId: 72251900215,storefrontBaseUrl: "https://brilliant.xyz",extensionsBaseUrl: "https://extensions.shopifycdn.com/cdn/shopifycloud/web-pixels-manager",monorailEndpoint: "https://brilliant.xyz/.well-known/shopify/monorail/unstable/produce_batch",surface: "storefront-renderer",enabledBetaFlags: ["d5bdd5d0","873d0e44","656605ce"],webPixelsConfigList: [{"id":"2587525431","configuration":"{\"pixelCode\":\"D0GM8L3C77UA6FH9BJ80\"}","eventPayloadVersion":"v1","runtimeContext":"STRICT","scriptVersion":"22e92c2ad45662f435e4801458fb78cc","type":"APP","apiClientId":4383523,"privacyPurposes":["ANALYTICS","MARKETING","SALE_OF_DATA"],"dataSharingAdjustments":{"protectedCustomerApprovalScopes":["read_customer_address","read_customer_email","read_customer_name","read_customer_personal_data","read_customer_phone"],"dataSharingControls":["share_all_events"]},"dataSharingState":"optimized"},{"id":"1226834231","configuration":"{\"config\":\"{\\\"google_tag_ids\\\":[\\\"G-3XM1GJSWD2\\\",\\\"AW-17464241377\\\"],\\\"target_country\\\":\\\"ZZ\\\",\\\"gtag_events\\\":[{\\\"type\\\":\\\"search\\\",\\\"action_label\\\":[\\\"G-3XM1GJSWD2\\\",\\\"AW-17464241377\\\/1Tn1CMCrya8cEOHZzIdB\\\"]},{\\\"type\\\":\\\"begin_checkout\\\",\\\"action_label\\\":[\\\"G-3XM1GJSWD2\\\",\\\"AW-17464241377\\\/_LTdCLSrya8cEOHZzIdB\\\"]},{\\\"type\\\":\\\"remove_from_cart\\\",\\\"action_label\\\":\\\"G-3XM1GJSWD2\\\"},{\\\"type\\\":\\\"view_item\\\",\\\"action_label\\\":[\\\"G-3XM1GJSWD2\\\",\\\"AW-17464241377\\\/UaLoCL2rya8cEOHZzIdB\\\"]},{\\\"type\\\":\\\"purchase\\\",\\\"action_label\\\":[\\\"G-3XM1GJSWD2\\\",\\\"AW-17464241377\\\/kaxdCLGrya8cEOHZzIdB\\\"]},{\\\"type\\\":\\\"add_shipping_info\\\",\\\"action_label\\\":\\\"G-3XM1GJSWD2\\\"},{\\\"type\\\":\\\"page_view\\\",\\\"action_label\\\":[\\\"G-3XM1GJSWD2\\\",\\\"AW-17464241377\\\/xIp7CLqrya8cEOHZzIdB\\\"]},{\\\"type\\\":\\\"view_item_list\\\",\\\"action_label\\\":\\\"G-3XM1GJSWD2\\\"},{\\\"type\\\":\\\"add_payment_info\\\",\\\"action_label\\\":[\\\"G-3XM1GJSWD2\\\",\\\"AW-17464241377\\\/H2dLCMOrya8cEOHZzIdB\\\"]},{\\\"type\\\":\\\"add_to_cart\\\",\\\"action_label\\\":[\\\"G-3XM1GJSWD2\\\",\\\"AW-17464241377\\\/3ki0CLerya8cEOHZzIdB\\\"]},{\\\"type\\\":\\\"view_cart\\\",\\\"action_label\\\":\\\"G-3XM1GJSWD2\\\"}],\\\"enable_monitoring_mode\\\":false}\"}","eventPayloadVersion":"v1","runtimeContext":"OPEN","scriptVersion":"9120410995b7c9c6f4f039573265c0ea","type":"APP","apiClientId":1780363,"privacyPurposes":[],"dataSharingAdjustments":{"protectedCustomerApprovalScopes":["read_customer_address","read_customer_email","read_customer_name","read_customer_personal_data","read_customer_phone"],"dataSharingControls":["share_all_events"]},"dataSharingState":"optimized","enabledFlags":["9a3ed68a"]},{"id":"234815799","configuration":"{\"pixel_id\":\"801251724728178\",\"pixel_type\":\"facebook_pixel\"}","eventPayloadVersion":"v1","runtimeContext":"OPEN","scriptVersion":"abff2a8add143ccb04deb20f0ebd74a9","type":"APP","apiClientId":2329312,"privacyPurposes":["ANALYTICS","MARKETING","SALE_OF_DATA"],"dataSharingAdjustments":{"protectedCustomerApprovalScopes":["read_customer_address","read_customer_email","read_customer_name","read_customer_personal_data","read_customer_phone"],"dataSharingControls":["share_all_events"]},"dataSharingState":"optimized","enabledFlags":["9a3ed68a"]},{"id":"170852663","eventPayloadVersion":"1","runtimeContext":"LAX","scriptVersion":"14","type":"CUSTOM","privacyPurposes":["ANALYTICS","MARKETING","SALE_OF_DATA"],"name":"x-pixel"},{"id":"227213623","eventPayloadVersion":"1","runtimeContext":"LAX","scriptVersion":"1","type":"CUSTOM","privacyPurposes":["ANALYTICS","MARKETING","SALE_OF_DATA"],"name":"reddit"},{"id":"shopify-app-pixel","configuration":"{}","eventPayloadVersion":"v1","runtimeContext":"STRICT","scriptVersion":"0510","apiClientId":"shopify-pixel","type":"APP","privacyPurposes":["ANALYTICS","MARKETING"]},{"id":"shopify-custom-pixel","eventPayloadVersion":"v1","runtimeContext":"LAX","scriptVersion":"0510","apiClientId":"shopify-pixel","type":"CUSTOM","privacyPurposes":["ANALYTICS","MARKETING"]}],isMerchantRequest: false,initData: {"shop":{"name":"Brilliant Labs","paymentSettings":{"currencyCode":"USD"},"myshopifyDomain":"brilliant-labs-9526.myshopify.com","countryCode":"HK","storefrontUrl":"https:\/\/brilliant.xyz"},"customer":null,"cart":null,"checkout":null,"productVariants":[],"products":[{"id":"10217206972727","handle":"halo","isCollective":null,"title":null,"type":null,"untranslatedTitle":null,"url":null,"vendor":null,"remoteShopId":null,"variants":[{"id":"50778480509239","image":null,"price":null,"sku":null,"title":null,"untranslatedTitle":null}]}],"purchasingCompany":null},},"https://brilliant.xyz/cdn","5f5c0921we198f819p6efddfcfm66c0f9a3",{"modern":"","legacy":""},{"trekkieShim":true,"agentContext":true,"apiClientId":"580111","facebookCapiEnabled":"true","themeId":"179256688951","themePublished":"true","eventMetadataId":"0e19b6f3-7168-406e-b181-3ce67adea95b","pageType":"article","resourceId":"610229256503","shopId":"72251900215","storefrontBaseUrl":"https:\/\/brilliant.xyz","extensionBaseUrl":"https:\/\/extensions.shopifycdn.com\/cdn\/shopifycloud\/web-pixels-manager","surface":"storefront-renderer","enabledBetaFlags":"[\"d5bdd5d0\", \"873d0e44\", \"656605ce\"]","isMerchantRequest":"false","hashVersion":"5f5c0921we198f819p6efddfcfm66c0f9a3","publish":"custom","events":"[[\"page_viewed\",{}]]"});})();</script><script>
  window.ShopifyAnalytics = window.ShopifyAnalytics || {};
  window.ShopifyAnalytics.meta = window.ShopifyAnalytics.meta || {};
  window.ShopifyAnalytics.meta.currency = 'USD';
  var meta = {"page":{"pageType":"article","resourceType":"article","resourceId":610229256503,"requestId":"74cf4690-1e4f-47ff-bd11-898ad02bb2b3-1787127421"}};
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
      {"Trekkie":{"appName":"storefront","development":false,"defaultAttributes":{"shopId":72251900215,"isMerchantRequest":null,"themeId":179256688951,"themeCityHash":"5630027833518771883","contentLanguage":"en","currency":"USD","eventMetadataId":"0e19b6f3-7168-406e-b181-3ce67adea95b"},"isServerSideCookieWritingEnabled":true,"monorailRegion":"shop_domain","enabledBetaFlags":["f43e7f5e","b5387b81","d5bdd5d0"]},"Session Attribution":{},"S2S":{"facebookCapiEnabled":true,"source":"trekkie-storefront-renderer","apiClientId":580111}}
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
        
      }
    });

    window.ShopifyAnalytics.lib.page(null,{"pageType":"article","resourceType":"article","resourceId":610229256503,"requestId":"74cf4690-1e4f-47ff-bd11-898ad02bb2b3-1787127421","shopifyEmitted":true});

    var eventsListenerScript = document.createElement('script');
    eventsListenerScript.async = true;
    eventsListenerScript.src = "//brilliant.xyz/cdn/shopifycloud/storefront/assets/shop_events_listener-4e26a9ce.js";
    document.getElementsByTagName('head')[0].appendChild(eventsListenerScript);
})();</script>
<script defer="" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shopifycloud/perf-kit/shopify-perf-kit-3.8.3.min.js' ); ?>" data-application="storefront-renderer" data-shop-id="72251900215" data-render-region="gcp-asia-southeast1" data-page-type="article" data-theme-instance-id="179256688951" data-theme-name="Creator" data-theme-version="3.2.2" data-monorail-region="shop_domain" data-resource-timing-sampling-rate="10" data-shs="true" data-shs-beacon="true" data-shs-export-with-fetch="true" data-shs-logs-sample-rate="1" data-shs-beacon-endpoint="https://brilliant.xyz/api/collect"></script>
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
      <a class="tw-hidden tw-justify-center lg:tw-flex" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Brilliant Labs"><img class="header__logo header__logo--desktop tw-mx-0 header__logo--standard" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/BrilliantLabs_logo_v0120_fd00ce58-e85e-4c9b-a80e-a9c57955d1b7.png?v=1752767272' ); ?>" alt="Brilliant Labs" loading="lazy" width="3100" height="600"><img class="header__logo header__logo--desktop header__logo--reversed tw-mx-0" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/BrilliantLabs_logo_v0120_fd00ce58-e85e-4c9b-a80e-a9c57955d1b7.png?v=1752767272' ); ?>" alt="Brilliant Labs" loading="lazy" width="3100" height="600"><img class="header__logo tw-mx-0  d-lg-none" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/BrilliantLabs_logo_v0120_fd00ce58-e85e-4c9b-a80e-a9c57955d1b7-1.png?v=1752767272&width=440' ); ?>" alt="Brilliant Labs" loading="lazy" width="3100" height="600"></a>

      
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
      </li></ul><div><a class="tw-z-[10] tw-flex tw-items-center tw-justify-center tw-rounded-[40px] tw-border tw-border-white tw-px-4 tw-py-2 tw-text-xs tw-font-bold tw-uppercase tw-text-white hover:tw-bg-white/[0.7] hover:tw-text-black md:tw-px-11 md:tw-py-4 md:tw-text-sm" href="<?php echo esc_url( home_url( '/products/halo/' ) ); ?>" data-buy-button="ĐẶT HÀNG ngay">
            ĐẶT HÀNG ngay
          </a></div>
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
</div><a class="tw-flex tw-justify-center lg:tw-hidden" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Brilliant Labs"><img class="header__logo header__logo--desktop tw-mx-0 header__logo--standard" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/BrilliantLabs_logo_v0120_fd00ce58-e85e-4c9b-a80e-a9c57955d1b7-1.png?v=1752767272&width=440' ); ?>" alt="Brilliant Labs" loading="lazy" width="3100" height="600"><img class="header__logo header__logo--desktop header__logo--reversed tw-mx-0" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/BrilliantLabs_logo_v0120_fd00ce58-e85e-4c9b-a80e-a9c57955d1b7-1.png?v=1752767272&width=440' ); ?>" alt="Brilliant Labs" loading="lazy" width="3100" height="600"><img class="header__logo tw-mx-0  d-lg-none" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/BrilliantLabs_logo_v0120_fd00ce58-e85e-4c9b-a80e-a9c57955d1b7-1.png?v=1752767272&width=440' ); ?>" alt="Brilliant Labs" loading="lazy" width="3100" height="600"></a>

    
<div class="tw-flex tw-justify-end tw-gap-2 md:tw-gap-6"><a class="tw-z-[10] tw-items-center tw-justify-center tw-rounded-[40px] tw-border tw-border-pink tw-px-4 tw-py-2 tw-text-xs tw-font-bold tw-uppercase tw-text-white hover:tw-bg-pink hover:tw-text-white hover:tw-opacity-100 md:tw-px-11 md:tw-py-4 md:tw-text-sm tw-flex" href="<?php echo esc_url( home_url( '/products/halo/' ) ); ?>" data-buy-button="ĐẶT HÀNG ngay">
              ĐẶT HÀNG ngay
            </a></div></div><div class="search-bar search-bar--header" role="region" aria-label="Tìm kiếm" data-search-bar=""><predictive-search data-loading-text="Loading..."><form class="search-bar__form" action="/search" method="get" role="search">
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
      <div id="shopify-section-template--24820771455287__article-hero" class="shopify-section"><link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/section-hero.css?v=178019169756046932181752050579' ); ?>" rel="stylesheet" type="text/css" media="all">
<script src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-share-button.js?v=180515111507322284621752050580' ); ?>" defer="defer"></script>
  <link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/component-share-button.css?v=182338979076698292461752050579' ); ?>" rel="stylesheet" type="text/css" media="all">
<div class="hero hero--template--24820771455287__article-hero hero--grid hero--mobile-small hero--image-right hero--has-logo   hero--share-button"><mobile-reversed-logo class="hero__logo text-center d-lg-none">
      <a class="hero__logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Brilliant Labs" data-mobile-reversed-logo-link=""></a>
    </mobile-reversed-logo><div class="hero__image-overlay"></div><div class="hero__image-blur" data-hero-image-blur=""></div><div class="d-md-none"><img class="hero__background-image" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e.webp?v=1756165881' ); ?>" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e-1.webp' ); ?> 100w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e-2.webp' ); ?> 180w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e-3.webp' ); ?> 360w" sizes="100vw" alt="Hành trình đến Halo " loading="lazy" width="523" height="697"></div>

  <div class="d-none d-md-block"><img class="hero__background-image" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e.webp?v=1756165881' ); ?>" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e-1.webp' ); ?> 100w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e-2.webp' ); ?> 180w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e-3.webp' ); ?> 360w" sizes="100vw" alt="Hành trình đến Halo " loading="lazy" width="523" height="697"></div>

  <div class="container container--default">
    <div class="row"><div class="hero__content-column hero__content-column--grid hero__content-column--mobile-below_image hero__content-column--desktop-middle col-12 col-md-6 d-none d-md-flex" data-aos="fade-up">
        <div class="hero__content-wrapper">
          <div class="hero__content hero__content--grid text-left text-md-left"><span class="hero__date" itemprop="dateCreated pubdate datePublished">
                  08/26/2025
                </span><h1 class="hero__heading h2">
                  Hành trình đến Halo | Phần 3
                </h1><share-button class="share-button">
  <details class="share-button__details">
    <summary class="button" data-share-button=""><svg class="icon icon-share" aria-hidden="true" focusable="false" role="presentation" width="13" height="13" viewbox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M3.5 4L6.5 1L9.5 4" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M6.5 9V2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M9 7H11L12 12H1L2 7H4" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
</svg><span>
        Share
      </span>
    </summary>

    <div class="share-button__content">
      <input type="text" class="share-button__input d-none" role="status" data-share-button-message="" readonly="">

      <label class="visually-hidden" for="url">
        Link
      </label>

      <input type="text" class="share-button__input d-none" id="url" value="https://brilliant.xyz/blogs/announcements/road-to-halo-part-3-of-4" placeholder="Liên kết" onclick="this.select();" readonly="" data-share-button-url-input="">

      <button class="share-button__close d-none no-js-hidden" data-share-button-close=""><svg class="icon icon-close-small" aria-hidden="true" focusable="false" role="presentation" width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M2 13.4142L13.4142 2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M13.4142 13.4142L2 2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
</svg><span class="visually-hidden">
          Close share
        </span>
      </button>

      <button class="share-button__copy no-js-hidden" data-share-button-copy=""><svg class="icon icon-clipboard" aria-hidden="true" focusable="false" role="presentation" width="13" height="15" viewbox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M4 1H12V11" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M9 4H1V14H9V4Z" stroke="currentColor" stroke-linejoin="round"></path>
</svg><span class="visually-hidden">
          Copy link
        </span>
      </button>
    </div>
  </details>
</share-button>
          </div>
        </div>
      </div><div class="col-12 col-md-6"><div class="hero__image-wrapper d-md-none"><img class="hero__image hero__image--small
" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e.webp?v=1756165881' ); ?>" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e-1.webp' ); ?> 100w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e-2.webp' ); ?> 180w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e-3.webp' ); ?> 360w" sizes="100vw" alt="Hành trình đến Halo " loading="lazy" width="523" height="697"></div>

            <div class="hero__image-wrapper d-none d-md-block"><img class="hero__image hero__image--small
" src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e.webp?v=1756165881' ); ?>" srcset="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e-1.webp' ); ?> 100w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e-2.webp' ); ?> 180w, <?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/articles/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e-3.webp' ); ?> 360w" sizes="(min-width: 1025px) 700px" alt="Hành trình đến Halo " loading="lazy" width="523" height="697"></div>
          </div>
</div>
  </div>
</div><div class="hero-mobile-content d-md-none">
    <div class="container text-left">
      <span class="hero__date" itemprop="dateCreated pubdate datePublished">
                  08/26/2025
                </span><h1 class="hero__heading h2">
                  Hành trình đến Halo | Phần 3
                </h1><share-button class="share-button">
  <details class="share-button__details">
    <summary class="button" data-share-button=""><svg class="icon icon-share" aria-hidden="true" focusable="false" role="presentation" width="13" height="13" viewbox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M3.5 4L6.5 1L9.5 4" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M6.5 9V2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M9 7H11L12 12H1L2 7H4" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
</svg><span>
        Share
      </span>
    </summary>

    <div class="share-button__content">
      <input type="text" class="share-button__input d-none" role="status" data-share-button-message="" readonly="">

      <label class="visually-hidden" for="url">
        Link
      </label>

      <input type="text" class="share-button__input d-none" id="url" value="https://brilliant.xyz/blogs/announcements/road-to-halo-part-3-of-4" placeholder="Liên kết" onclick="this.select();" readonly="" data-share-button-url-input="">

      <button class="share-button__close d-none no-js-hidden" data-share-button-close=""><svg class="icon icon-close-small" aria-hidden="true" focusable="false" role="presentation" width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M2 13.4142L13.4142 2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M13.4142 13.4142L2 2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
</svg><span class="visually-hidden">
          Close share
        </span>
      </button>

      <button class="share-button__copy no-js-hidden" data-share-button-copy=""><svg class="icon icon-clipboard" aria-hidden="true" focusable="false" role="presentation" width="13" height="15" viewbox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M4 1H12V11" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
  <path d="M9 4H1V14H9V4Z" stroke="currentColor" stroke-linejoin="round"></path>
</svg><span class="visually-hidden">
          Copy link
        </span>
      </button>
    </div>
  </details>
</share-button>
    </div>
  </div><style data-shopify="">.hero--template--24820771455287__article-hero {
    margin-top: 0px;
    margin-bottom: 0px;
    padding-top: 32px;
    padding-bottom: 32px;

    
  }

  @media screen and (min-width: 768px) {
    .hero--template--24820771455287__article-hero {
      margin-top: 0px;
      margin-bottom: 0px;
      padding-top: 0px;
      padding-bottom: 32px;

      
    }
  }</style><style data-shopify="">.hero--template--24820771455287__article-hero {
    --padding-bottom: 32px;
  }

  @media screen and (min-width: 1025px) {
    .hero--template--24820771455287__article-hero.hero--full-bleed.hero--adapt .hero__background-image,
    .hero--template--24820771455287__article-hero.hero--tiled.hero--adapt .hero__background-image {
      margin-top: -0px;
    }
  }

  .hero--template--24820771455287__article-hero .hero__image-overlay {
    background-color: #000000;
    opacity: 0.3;
  }

  .hero--template--24820771455287__article-hero .hero__heading,
  .hero--template--24820771455287__article-hero .hero__logo-text {
    color: #ffffff;
  }

  .hero--template--24820771455287__article-hero .hero__content,
  .hero--template--24820771455287__article-hero .hero__text a {
    color: #ffffff;
  }

  .hero--template--24820771455287__article-hero .hero__button,
  .hero--template--24820771455287__article-hero .share-button .button {
    color: #000000;
    background-color: #ffffff;
  }

  .hero--template--24820771455287__article-hero .hero__button:hover,
  .hero--template--24820771455287__article-hero .hero__button:focus,
  .hero--template--24820771455287__article-hero .share-button .button:hover,
  .hero--template--24820771455287__article-hero .share-button .button:focus {
    background-color: #000000;
    color: #ffffff;
  }

  .primary-button-style--outline .hero--template--24820771455287__article-hero .hero__button,
  .primary-button-style--outline .hero--template--24820771455287__article-hero .share-button .button {
    background: none;
    color: #ffffff;
    border-color: #ffffff;
  }

  .primary-button-style--outline .hero--template--24820771455287__article-hero .hero__button:hover,
  .primary-button-style--outline .hero--template--24820771455287__article-hero .hero__button:focus,
  .primary-button-style--outline .hero--template--24820771455287__article-hero .share-button .button:hover,
  .primary-button-style--outline .hero--template--24820771455287__article-hero .share-button .button:focus {
    border-color: #000000;
    background: #000000;
    color: #ffffff;
  }.hero--template--24820771455287__article-hero .hero__logo {
      max-width: var(--mobile-logo-width);
    }

    .mobile-header {
      display: none;
    }</style><script>
  var firstSection = document.querySelector('[data-site-content]').querySelectorAll('.shopify-section')[0];

  if (firstSection && firstSection.querySelector('.hero')) {
    document.querySelector('site-header').classList.add('header--transparent-ready');
  }

  document.addEventListener('DOMContentLoaded', () => {
    chromeBlurFix();
  });

  window.addEventListener('resize', () => {
    chromeBlurFix();
  });

  function chromeBlurFix() {
    const isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
    const heroImageBlurs = document.querySelectorAll('[data-hero-image-blur]');

    if (!isChrome || !heroImageBlurs.length) { return; }

    heroImageBlurs.forEach((heroImageBlur) => {
      heroImageBlur.style['z-index'] = 9;

      setTimeout(() => {
        heroImageBlur.style['z-index'] = 10;
      }, 1);
    });
  }
</script></div><div id="shopify-section-template--24820771455287__main" class="shopify-section"><link href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/t/24/assets/section-main-article.css?v=62561071357533081791752050582' ); ?>" rel="stylesheet" type="text/css" media="all">

<article class="article article--template--24820771455287__main main-section" itemscope="" itemtype="http://schema.org/BlogPosting">
  <div class="container container--extra-narrow" data-aos="fade-up">
    <div class="rte" itemprop="articleBody">
      <h3>🎨 Quá trình nghiên cứu phần cứng <strong><span>Halo</span></strong> đòi hỏi sự định hướng rõ ràng, chắt lọc tinh tế, mục tiêu mạch lạc và thiết kế tỉ mỉ ở mọi tầng công nghệ. </h3>
<p><img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/s/files/1/0722/5190/0215/files/Falo_Shines.gif?v=1756151572' ); ?>" alt=""></p>
<h4>🙄 Bạn có thể nhận thấy hầu hết mọi chiếc kính thông minh khác ra mắt trên thị trường đều đi theo một lối mòn dễ đoán. </h4>
<h4>
<strong>Nhưng chúng tôi suy nghĩ khác biệt: </strong>những thiết bị này không phải để quay video mạng xã hội hay xem YouTube. Thay vào đó, chúng tồn tại để thực hiện suy luận AI cả ngày nhằm cá nhân hóa sâu sắc và nâng cao trí nhớ, trong khi vẫn trông như một chiếc kính đeo mắt thanh lịch.</h4>
<h3><strong><img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/s/files/1/0722/5190/0215/files/Timeline_1_04ee2694-5933-4fef-b6b7-cfb4c7536ba0.gif?v=1756079310' ); ?>" alt=""><meta charset="utf-8"></strong></h3>
<h3>🎯<strong>Vì vậy, với sự định hướng rõ ràng đó, chúng tôi bắt tay vào thiết kế hệ thống phần cứng của </strong><strong><span>Halo</span></strong><strong>. </strong>
</h3>
<h4>Trong khi vẫn duy trì <strong>màn hình hiển thị đầy đủ màu sắc</strong> và <strong>camera</strong>, chúng tôi bổ sung thêm một <strong>micrô</strong> và <strong>hai loa dẫn truyền qua xương</strong> — tất cả được kết nối với <strong>bộ xử lý AI</strong> siêu tiết kiệm điện.</h4>
<h4>Bằng cách loại bỏ hệ thống quang học cồng kềnh đắt đỏ, bộ xử lý tiêu hao quá nhiều điện năng, WiFi và cảm biến hình ảnh nặng nề (vốn chỉ phục vụ mạng xã hội thay vì suy luận AI tập trung), chúng tôi đã hoàn thành một thiết kế phần cứng tối ưu cho việc <strong>đeo cả ngày, ghi nhận ngữ cảnh và tương tác tác nhân đa phương thức. </strong>
</h4>
<h4>(Xem ví dụ video thực tế bên dưới 👇)</h4>
<p><a href="https://www.youtube.com/watch?v=z-Z2WrB5jhA&list=PLfbaC5GRVJJg_b3o0gwZkGLVv_db7kbfW"><img src="<?php echo esc_url( get_template_directory_uri() . '/site-assets/s/files/1/0722/5190/0215/files/boxingF.png?v=1756152836' ); ?>" alt=""></a></p>
<h3><a href="https://www.youtube.com/watch?v=z-Z2WrB5jhA&list=PLfbaC5GRVJJg_b3o0gwZkGLVv_db7kbfW"></a></h3>
<h4>
<strong>⛩️</strong> Những quyết định kiến trúc này cho phép chúng tôi nâng cao trải nghiệm người dùng và mở rộng giá trị cho các nhà phát triển, đồng thời hạ giá thành sản phẩm và tăng gấp nhiều lần thời lượng pin — tất cả nằm trọn trong thiết kế công nghiệp tinh xảo đầy tính tất yếu của <strong><span>Halo</span></strong>. </h4>
<h4>🧑🏼🎨 Chúng tôi tin rằng những thiết bị này cần phải đẹp mắt, nhẹ nhàng và tự nhiên, đồng thời mở ra khả năng sáng tạo và trí tuệ vô hạn. </h4>
<h3>😇 <strong><span>Halo</span></strong> là một cột mốc quan trọng đối với chúng tôi khi tiếp tục nhân đôi cam kết với phong trào mã nguồn mở, mở ra kỷ nguyên tiếp theo của điện toán thông minh.</h3>
<p><br></p>
    </div>

    <a class="article__back h2" href="<?php echo esc_url( home_url( '/blogs/announcements/' ) ); ?>"><svg class="icon icon-arrow-left-thick" aria-hidden="true" focusable="false" role="presentation" width="25" height="20" viewbox="0 0 25 20" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M24.1328 9.72656C24.1328 9.36198 24.013 9.0599 23.7734 8.82031C23.5443 8.58073 23.2474 8.46094 22.8828 8.46094L7.30469 8.46094L3.46094 8.61719L3.74219 9.41406L9.00781 4.67969L11.1797 2.44531C11.2839 2.34115 11.3672 2.21094 11.4297 2.05469C11.4922 1.89844 11.5234 1.73698 11.5234 1.57031C11.5234 1.21615 11.4036 0.92448 11.1641 0.695313C10.9245 0.466146 10.6328 0.351563 10.2891 0.351563C9.95573 0.351563 9.64844 0.481771 9.36719 0.742188L1.30469 8.78906C1.01302 9.0599 0.867187 9.3724 0.867187 9.72656C0.867187 10.0807 1.01302 10.3932 1.30469 10.6641L9.36719 18.7109C9.64844 18.9714 9.95573 19.1016 10.2891 19.1016C10.6328 19.1016 10.9245 18.987 11.1641 18.7578C11.4036 18.5286 11.5234 18.237 11.5234 17.8828C11.5234 17.7161 11.4922 17.5547 11.4297 17.3984C11.3672 17.2422 11.2839 17.112 11.1797 17.0078L9.00781 14.7734L3.74219 10.0234L3.46094 10.8359L7.30469 10.9922L22.8828 10.9922C23.2474 10.9922 23.5443 10.8724 23.7734 10.6328C24.013 10.3932 24.1328 10.0911 24.1328 9.72656Z" fill="currentColor"></path>
</svg><span>
        Quay lại Thông báo
      </span>
    </a>
  </div>
</article><script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Article",
    "articleBody": "🎨Our work on Halo’s hardware required intentionality and restraint, clarity of purpose, and intensive design across every level of the stack. \n\n🙄You may have noticed that nearly every other pair of smart glasses coming to market is following a predictable path. \n\nBut we are thinking different: these devices are not for social media capture or watching YouTube videos. Instead, they should exist to perform all-day AI inference for deep personalization and memory enhancement while still looking like a beautiful pair of glasses.\n\n🎯So with this clarity of intention we set about designing Halo’s hardware system. \n\nWhile keeping a full color display and camera, we introduced an additional microphone and two speakers — all wired into a low-power AI processor.\nBy eschewing bulky or expensive optics, over-powered processors, WiFi, and hefty image sensors geared more for social media capture than focused AI inference, we accomplished a hardware design made for all-day wearability, memory capture, and multimodal agent interactions. \n\n(check out an example below 👇)\n\n\n\n⛩️These architectural decisions allowed us to enrich the customer experience and broaden the value proposition to developers while lowering the price point and multiplying battery life — all within the constraints of Halo’s deceptively inevitable industrial design. \n🧑🏼🎨We believe these devices need to feel beautiful and unobtrusive while enabling tremendous creativity and intelligence. \n😇Halo is a milestone for us as we double down on the open source movement ushering in the next age of intelligent computing.\n",
    "mainEntityOfPage": {
      "@type": "WebPage",
      "@id": "https:\/\/brilliant.xyz"
    },
    "headline": "Hành trình đến Halo | Phần 3","image": [
        "https:\/\/brilliant.xyz\/cdn\/shop\/articles\/IMG_7142_3ca8e4c3-66bc-4262-a193-f9213bc38c2e.webp?v=1756165881\u0026width=523"
      ],"datePublished": "2025-08-26T07:50:56Z",
    "dateCreated": "2025-08-26T04:07:54Z",
    "author": {
      "@type": "Person",
      "name": "Sam Khorshid"
    },
    "publisher": {
      "@type": "Organization","name": "Brilliant Labs"
    }
  }
</script><style data-shopify="">.article--template--24820771455287__main {
    margin-top: 0px;
    margin-bottom: 0px;
    padding-top: 32px;
    padding-bottom: 32px;

    
  }

  @media screen and (min-width: 768px) {
    .article--template--24820771455287__main {
      margin-top: 0px;
      margin-bottom: 0px;
      padding-top: 72px;
      padding-bottom: 72px;

      
    }
  }</style>
</div><div id="shopify-section-template--24820771455287__article-comments" class="shopify-section">
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
