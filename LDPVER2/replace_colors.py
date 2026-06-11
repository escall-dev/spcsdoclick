import os

replacements = {
    '#0f4c75': '#1b4a9a',
    '#1b6ca8': '#2a63c9',
    '#0a2f4a': '#12336b',
    '15, 76, 117': '27, 74, 154',
    '#075985': '#1b4a9a',
    '#0369a1': '#1b4a9a',
}

css_dir = r'c:\xampp\htdocs\LDPVER2E\public\css'

for root, dirs, files in os.walk(css_dir):
    for file in files:
        if file.endswith('.css'):
            path = os.path.join(root, file)
            with open(path, 'r', encoding='utf-8', errors='ignore') as f:
                content = f.read()
            
            new_content = content
            for old, new in replacements.items():
                new_content = new_content.replace(old, new)
                new_content = new_content.replace(old.upper(), new)
            
            if new_content != content:
                with open(path, 'w', encoding='utf-8') as f:
                    f.write(new_content)
                print(f"Updated {path}")
