import glob
import re

files = glob.glob('templates/*.php') + glob.glob('templates-static/*.php')

for f in files:
    with open(f, 'r', encoding='utf-8') as file:
        c = file.read()

    orig = c
    
    # Match any <script> tag that contains trekkie, ShopifyAnalytics, shop_events_listener, or Monorail
    def clean_script_tag(match):
        script_content = match.group(0)
        if any(keyword in script_content for keyword in ['trekkie', 'ShopifyAnalytics', 'shop_events_listener', 'monorail', 'Monorail', 'perf-kit', 'wpmLoader']):
            return ''
        return script_content

    c = re.sub(r'<script[^>]*>.*?</script>', clean_script_tag, c, flags=re.DOTALL | re.IGNORECASE)

    # Clean meta tags related to shopify analytics
    c = re.sub(r'<meta name="shopify-[^>]+>', '', c)

    if c != orig:
        with open(f, 'w', encoding='utf-8') as file:
            file.write(c)
        print('Completely purged tracking script block from:', f)

print('Done cleaning all Shopify tracking scripts!')
