import glob
import re

files = glob.glob('templates/*.php') + glob.glob('templates-static/*.php')

for f in files:
    with open(f, 'r', encoding='utf-8') as file:
        c = file.read()

    orig = c

    # 1. Remove captcha-bootstrap script block
    c = re.sub(r'<script id="captcha-bootstrap">.*?</script>', '', c, flags=re.DOTALL)

    # 2. Remove wpmLoader and web pixels manager scripts
    c = re.sub(r'<script>\s*\(function\(\)\{var wpmLoader=.*?</script>', '', c, flags=re.DOTALL)

    # 3. Remove trekkie scripts and ShopifyAnalytics
    c = re.sub(r'<script>\s*window\.__TREKKIE_SHIM_QUEUE\s*=.*?</script>', '', c, flags=re.DOTALL)
    c = re.sub(r'<script>\s*var trekkie\s*=.*?</script>', '', c, flags=re.DOTALL)
    c = re.sub(r'<script>\s*window\.ShopifyAnalytics\s*=.*?</script>', '', c, flags=re.DOTALL)

    # 4. Remove performance / monorail / boomr tracking scripts if any
    c = re.sub(r'<script>\s*\(function\(\)\{\s*function asyncLoad\(\).*?</script>', '', c, flags=re.DOTALL)
    
    if c != orig:
        with open(f, 'w', encoding='utf-8') as file:
            file.write(c)
        print('Cleaned telemetry & tracker spam from:', f)

print('All foreign tracker spam completely removed!')
