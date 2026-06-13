import re

with open('d:/Project/temuruang/download version/index.html', 'r', encoding='utf-8') as f:
    content = f.read()

# Replace assets/ with {{ asset('assets_landingpage/
content = re.sub(r'(href|src)="assets/([^"]+)"', r'\1="{{ asset(\'assets_landingpage/\2\') }}"', content)

# There is a data-bg-src attribute used by slick or similar for backgrounds
content = re.sub(r'(data-bg-src)="assets/([^"]+)"', r'\1="{{ asset(\'assets_landingpage/\2\') }}"', content)

with open('d:/Project/temuruang/resources/views/welcome.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)
