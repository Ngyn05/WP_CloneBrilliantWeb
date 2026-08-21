import glob
import re

files = glob.glob('templates/*.php') + glob.glob('templates-static/*.php')

for f in files:
    with open(f, 'r', encoding='utf-8') as file:
        c = file.read()

    orig = c
    # Remove perf-kit
    c = re.sub(r'<script defer="" src="[^"]*shopify-perf-kit[^"]*"[^>]*></script>', '', c)
    c = re.sub(r'<script[^>]*perf-kit[^>]*></script>', '', c)
    
    # Remove any stray shopify tracking endpoints
    c = re.sub(r'window\.shopUrl\s*=\s*[\'"][^\'"]*[\'"];?', '', c)

    if c != orig:
        with open(f, 'w', encoding='utf-8') as file:
            file.write(c)
        print('Removed perf-kit from:', f)

print('All perf-kit scripts purged!')
