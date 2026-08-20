# Brilliant XYZ WordPress Theme

Converted from the provided static mirror.

## Install
1. Upload `brilliant-xyz-wordpress-theme.zip` in **Appearance > Themes > Add New > Upload Theme**.
2. Activate **Brilliant XYZ Static Clone**.
3. Go to **Settings > Permalinks** and click **Save Changes** once if nested static URLs return 404.

## Structure
- `front-page.php` – homepage.
- `templates-static/` – 20 converted HTML templates.
- `site-assets/` – original CSS, JS, images, fonts, video and other downloaded files.
- `functions.php` – WordPress routing for the converted static pages.

## Notes
- The visual layer is preserved from the mirror; Shopify checkout/cart/search/account features are not converted into WordPress/WooCommerce business logic.
- External third-party scripts left in the source may still call their original services.
- Internal local CSS/JS/image/font/video references were rewritten to the WordPress theme directory.

## Large ZIP note
The full package includes original video/GIF/media assets and is large. If WordPress upload limits reject it, extract/copy the theme folder directly into `wp-content/themes/` and activate it from Appearance > Themes.
# WP_CloneBrilliantWeb
