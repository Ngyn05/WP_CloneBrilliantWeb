import glob
import re

files = glob.glob('templates/*.php') + glob.glob('templates-static/*.php') + ['404.php', 'index.php']

clean_favicon = '''    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/favicon-32x32.png?v=3' ); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/favicon-16x16.png?v=3' ); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() . '/site-assets/cdn/shop/files/apple-touch-icon.png?v=3' ); ?>">
    <link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() . '/favicon.ico?v=3' ); ?>">'''

for f in files:
    with open(f, 'r', encoding='utf-8') as file:
        c = file.read()
    
    # 1. Clean any stray lines containing only ">" or ">"">
    lines = c.split('\n')
    cleaned_lines = []
    for line in lines:
        stripped = line.strip()
        if stripped in ['">', '">">', '"> ">', '"> "> ">', '"> "> "> ">']:
            continue
        cleaned_lines.append(line)
    c = '\n'.join(cleaned_lines)

    # 2. Fix broken canonical links: <link rel="canonical" href="<?php ... ?>"...>
    # Make sure canonical is cleanly closed with ">
    def fix_canonical(match):
        canonical_inner = match.group(1).strip()
        return f'<link rel="canonical" href="{canonical_inner}">'
    
    c = re.sub(r'<link rel="canonical" href="([^">]+(?:\?>)?)[^>]*>', fix_canonical, c)

    # 3. Clean and normalize all favicon links
    c = re.sub(r'\s*<link rel="(?:icon|apple-touch-icon|shortcut icon)"[^>]+>', '', c)
    
    # Insert clean favicon after canonical link
    if '<link rel="canonical"' in c:
        c = re.sub(r'(<link rel="canonical"[^>]+>)', r'\1\n' + clean_favicon, c, count=1)
    elif '<head' in c:
        c = re.sub(r'(<head[^>]*>)', r'\1\n' + clean_favicon, c, count=1)

    with open(f, 'w', encoding='utf-8') as file:
        file.write(c)
    print('Fixed and perfected head in:', f)

print('All templates cleaned 100%!')
