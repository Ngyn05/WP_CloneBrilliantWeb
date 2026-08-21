import glob

files = glob.glob('templates/*.php') + glob.glob('templates-static/*.php')

for f in files:
    with open(f, 'r', encoding='utf-8') as file:
        c = file.read()
    
    target = '<div><?php if ( function_exists( "bl_render_header_buy_button" ) ) { bl_render_header_buy_button(true); } ?></div>'
    if target in c:
        c = c.replace(target, '')
        with open(f, 'w', encoding='utf-8') as file:
            file.write(c)
        print('Cleaned mobile drawer buy button in:', f)
