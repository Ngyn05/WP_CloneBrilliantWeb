import glob
import re

files = glob.glob('templates/*.php') + glob.glob('templates-static/*.php') + ['404.php', 'index.php']

clean_favicon = '''<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/favicon-32x32.png?v=3' ); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/favicon-16x16.png?v=3' ); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/apple-touch-icon.png?v=3' ); ?>">
    <link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() . '/favicon.ico?v=3' ); ?>">'''

for f in files:
    with open(f, 'r', encoding='utf-8') as file:
        c = file.read()
    
    # Remove all existing icon and apple-touch-icon tags in header
    c = re.sub(r'<link rel="(?:icon|apple-touch-icon|shortcut icon)"[^>]+>\s*', '', c)
    c = c.replace('">">', '">')
    
    # Insert clean favicon suite right after <link rel="canonical" ...> or <link rel="preconnect" ...> or <head>
    if '<link rel="canonical"' in c:
        c = re.sub(r'(<link rel="canonical"[^>]+>\s*)', r'\1' + clean_favicon + '\n    ', c, count=1)
    elif '<head' in c:
        c = re.sub(r'(<head[^>]*>\s*)', r'\1' + clean_favicon + '\n    ', c, count=1)
    
    with open(f, 'w', encoding='utf-8') as file:
        file.write(c)

print('Cleaned and standardized all favicon markup across all files!')
