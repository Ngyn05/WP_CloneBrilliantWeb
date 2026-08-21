import glob
import re

files = glob.glob('templates/*.php') + glob.glob('templates-static/*.php') + ['404.php', 'index.php']

favicon_block = '<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() . \'/site-assets/cdn/shop/files/favicon-32x32.png?v=3\' ); ?>"><link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() . \'/site-assets/cdn/shop/files/favicon-16x16.png?v=3\' ); ?>"><link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() . \'/site-assets/cdn/shop/files/apple-touch-icon.png?v=3\' ); ?>"><link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() . \'/favicon.ico?v=3\' ); ?>">'

for f in files:
    with open(f, 'r', encoding='utf-8') as file:
        content = file.read()
    
    # Check if there is an existing favicon link
    pattern = r'<link rel="icon"[^>]+>(?:<link rel="apple-touch-icon"[^>]+>)?'
    if re.search(pattern, content):
        new_content = re.sub(pattern, favicon_block, content)
        if new_content != content:
            with open(f, 'w', encoding='utf-8') as file:
                file.write(new_content)
            print('Updated favicon in:', f)
    elif '<head' in content:
        # inject after <head> or <head ...>
        new_content = re.sub(r'(<head[^>]*>)', r'\1\n    ' + favicon_block, content, count=1)
        if new_content != content:
            with open(f, 'w', encoding='utf-8') as file:
                file.write(new_content)
            print('Injected favicon in:', f)

print('All templates synchronized with HD Favicon suite!')
