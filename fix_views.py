import os
import re

views_dir = r"d:\xampp\htdocs\Apple_store-Laravel\resources\views\pages"

for filename in os.listdir(views_dir):
    if not filename.endswith('.blade.php'):
        continue
    filepath = os.path.join(views_dir, filename)
    with open(filepath, 'r', encoding='utf-8', errors='replace') as f:
        content = f.read()

    original = content

    # Remove any <?php ... ?> block that contains require_once or $pageTitle
    content = re.sub(
        r'<\?php[^?]*?(require_once|pageTitle)[^?]*?\?>',
        '',
        content,
        flags=re.DOTALL
    )

    # Also remove standalone empty <?php ?> tags
    content = re.sub(r'<\?php\s*\?>', '', content)

    if content != original:
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f"Fixed: {filename}")
    else:
        print(f"Skipped (no change): {filename}")
