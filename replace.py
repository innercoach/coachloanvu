import os
import re

files = ['index.html', 'dich-vu-1.html', 'dich-vu-2.html', 'dich-vu-3.html', 'lien-he.html']

for f in files:
    path = os.path.join(r'c:\Users\huytv\Documents\C-Loan Vu', f)
    if not os.path.exists(path): continue
    
    with open(path, 'r', encoding='utf-8') as file:
        content = file.read()
    
    # Replace header
    content = re.sub(r'<header class=\"site-header\".*?</header>', '<site-header></site-header>', content, flags=re.DOTALL)
    
    # Replace footer
    content = re.sub(r'<footer class=\"site-footer\".*?</footer>', '<site-footer></site-footer>', content, flags=re.DOTALL)
    
    # Inject script if not present
    if 'js/components.js' not in content:
        content = content.replace('<script src="js/main.js"></script>', '<script src="js/components.js"></script>\n    <script src="js/main.js"></script>')
        
    with open(path, 'w', encoding='utf-8') as file:
        file.write(content)
        
print('Replacements completely successful.')
