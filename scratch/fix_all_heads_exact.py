import glob
import re

files = glob.glob('templates/*.php') + glob.glob('templates-static/*.php') + ['404.php', 'index.php']

for f in files:
    with open(f, 'r', encoding='utf-8') as file:
        c = file.read()

    # Find the canonical line and clean the whole favicon & preconnect block
    # Match from <link rel="canonical" up to <link rel="manifest" or <link href=...theme-f516ecd7.css
    
    # Extract canonical URL expression
    canon_match = re.search(r'<link rel="canonical" href="<\?php echo esc_url\(([^)]+)\);\s*\?>', c)
    if not canon_match:
        canon_match = re.search(r'<link rel="canonical" href="<\?php echo esc_url\(([^)]+)\);', c)
    
    if canon_match:
        canon_expr = canon_match.group(1).strip()
    else:
        canon_expr = "home_url( '/' )"

    perfect_block = f'''    <link rel="canonical" href="<?php echo esc_url({canon_expr}); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/favicon-32x32.png?v=3' ); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/favicon-16x16.png?v=3' ); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/apple-touch-icon.png?v=3' ); ?>">
    <link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() . '/favicon.ico?v=3' ); ?>">
    <link rel="preconnect" href="https://cdn.shopify.com" crossorigin="">
    <link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/site.webmanifest' ); ?>">'''

    # Replace everything between <meta name="theme-color" content=""> and <link href=...theme-f516ecd7.css
    pattern = r'<meta name="theme-color" content="">.*?(?=<link href="<\?php echo esc_url\( get_template_directory_uri\(\) \. \'/site-assets/cdn/shop/t/24/assets/theme-f516ecd7\.css|\n\s*<link href=|<title)'
    
    if re.search(pattern, c, flags=re.DOTALL):
        c = re.sub(pattern, '<meta name="theme-color" content="">\n' + perfect_block + '\n\n  ', c, count=1, flags=re.DOTALL)
    
    with open(f, 'w', encoding='utf-8') as file:
        file.write(c)
    print('Cleaned & perfected:', f)

print('Done!')
