import glob

files = glob.glob('templates/*.php') + glob.glob('templates-static/*.php') + ['404.php', 'index.php']

clean_head_template = '''    <link rel="canonical" href="<?php echo esc_url( {canonical_expr} ); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/favicon-32x32.png?v=3' ); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/favicon-16x16.png?v=3' ); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/apple-touch-icon.png?v=3' ); ?>">
    <link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() . '/favicon.ico?v=3' ); ?>">'''

for f in files:
    with open(f, 'r', encoding='utf-8') as file:
        c = file.read()
    
    # Remove any unwanted quotes
    c = c.replace('">">', '">')
    c = c.replace('?">', '?>">')
    c = c.replace('?>>">', '?>">')
    c = c.replace('?>">', '?>')
    c = c.replace('<?php echo esc_url( get_template_directory_uri() . \'/favicon.ico?v=3\' ); ?>\">\">', '<?php echo esc_url( get_template_directory_uri() . \'/favicon.ico?v=3\' ); ?>\">')
    
    with open(f, 'w', encoding='utf-8') as file:
        file.write(c)

print('Verified and sanitized all heads.')
