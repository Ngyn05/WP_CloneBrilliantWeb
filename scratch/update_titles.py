import glob
import re
import sys

files = glob.glob('templates/*.php') + glob.glob('templates-static/*.php')

for f in files:
    with open(f, 'r', encoding='utf-8') as file:
        c = file.read()

    orig = c
    
    # Replace "Brilliant Labs" with "Brilliant Việt Nam" in title tags
    def replace_title(match):
        title_content = match.group(0)
        title_content = re.sub(r'Brilliant\s+Labs', 'Brilliant Việt Nam', title_content, flags=re.IGNORECASE)
        return title_content

    c = re.sub(r'<title>.*?</title>', replace_title, c, flags=re.DOTALL | re.IGNORECASE)

    # For index-htm.php specifically ensure title is Brilliant Việt Nam
    if 'index-htm.php' in f:
        c = re.sub(r'<title>[\s\n]*Brilliant Việt Nam[\s\n]*</title>', '<title>Brilliant Việt Nam</title>', c)
        c = re.sub(r'<title>[\s\n]*Brilliant Labs[\s\n]*</title>', '<title>Brilliant Việt Nam</title>', c)
        c = re.sub(r'<title>[\s\n]*Brilliant[\s\n]*</title>', '<title>Brilliant Việt Nam</title>', c)

    if c != orig:
        with open(f, 'w', encoding='utf-8') as file:
            file.write(c)
        print('Updated title:', f.encode('ascii', 'ignore').decode('ascii'))

print('All titles updated!')
