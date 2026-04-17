import re

path = r'c:\Users\huytv\Documents\C-Loan Vu\dich-vu-1.html'
with open(path, 'r', encoding='utf-8') as f:
    content = f.read()

# Remove SVG plus-icon inside faq-q buttons
content = re.sub(r'\s*<svg[^>]+aria-hidden="true"[^>]*>.*?</svg>', '', content, flags=re.DOTALL)

with open(path, 'w', encoding='utf-8') as f:
    f.write(content)

print('Removed SVG icons from FAQ buttons.')
