import sys

path = r"d:\Project\temuruang\resources\views\templates\wedding\wedding-02.blade.php"
with open(path, 'r', encoding='utf-8') as f:
    lines = f.readlines()

new_lines = lines[:684]
new_lines.extend(lines[1012:1152])
new_lines.append("</body>\n</html>\n")

with open(path, 'w', encoding='utf-8') as f:
    f.writelines(new_lines)
print("Fixed successfully!")
