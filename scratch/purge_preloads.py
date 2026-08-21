import glob
import re

files = glob.glob('templates/*.php') + glob.glob('templates-static/*.php')

for f in files:
    with open(f, 'r', encoding='utf-8') as file:
        c = file.read()

    orig = c
    # Remove preloads.js and preloads-1.js script tags
    c = re.sub(r'<script[^>]*preloads[^>]*></script>', '', c)
    c = re.sub(r'<link rel="preconnect" href="https://fonts\.shopifycdn\.com"[^>]*>', '', c)

    if c != orig:
        with open(f, 'w', encoding='utf-8') as file:
            file.write(c)
        print('Removed preloads from:', f)

print('All checkout preloads removed!')
