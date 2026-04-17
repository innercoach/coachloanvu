"""
crop_images.py – Extract testimonial photos and instructor photo from slides
Slides are 1536×864 px. Each testimonial slide has 3 photos arranged horizontally.
"""
from PIL import Image
import os, sys
sys.stdout.reconfigure(encoding='utf-8')

SRC = r"c:\Users\huytv\Documents\C-Loan Vu\Dich vu 1 - Passion to Profit"
DST = r"c:\Users\huytv\Documents\C-Loan Vu\assets\dv1"
os.makedirs(DST, exist_ok=True)

# ─── Helper ───────────────────────────────────────────────────
def crop_save(src_file, box, out_name):
    """box = (left, top, right, bottom)"""
    img = Image.open(os.path.join(SRC, src_file))
    cropped = img.crop(box)
    out_path = os.path.join(DST, out_name)
    cropped.save(out_path, optimize=True)
    print(f"Saved: {out_name}  ({cropped.size})")

# ─── Instructor photo (slide 2, big teaching photo) ────────────
# Slide 2: photo is centred, roughly x:230-1310, y:130-710
crop_save("2.png", (230, 90, 1310, 720), "instructor.png")

# ─── Hero photo (slide 1: Kiều Loan left circle) ───────────────
# Rough bounds of the circle portrait in slide 1
crop_save("1.png", (20, 20, 620, 860), "hero-coach.png")

# ─── Testimonials ─────────────────────────────────────────────
# Layout per slide: 3 photos side by side
# Approximate photo boxes (left | center | right) based on 1536×864

# Slide 6: Lyly | Thu Hà | Hảo Hảo
for i, (box, name) in enumerate([
    ((215, 130, 490, 450), "t1-lyly.png"),
    ((620, 130, 895, 450), "t1-thuha.png"),
    ((1050, 130, 1300, 450), "t1-haohao.png"),
]):
    crop_save("6.png", box, name)

# Slide 7: Thuý Nga | Chu Phi Nga | Hoàng Lâm
for box, name in [
    ((215, 130, 490, 450), "t2-thuynga.png"),
    ((620, 130, 895, 450), "t2-chuphinnga.png"),
    ((1050, 130, 1300, 450), "t2-hoanglam.png"),
]:
    crop_save("7.png", box, name)

# Slide 8: Liah Vu | Ly Khánh Lê | Diễm Trương
for box, name in [
    ((215, 130, 490, 450), "t3-liahvu.png"),
    ((620, 150, 895, 450), "t3-lykhanhlе.png"),
    ((1050, 130, 1300, 450), "t3-diemtruong.png"),
]:
    crop_save("8.png", box, name)

# Slide 9: Tran Vu Kim Ngan | Duong Hang | Nguyen Quoc Minh
for box, name in [
    ((215, 130, 490, 450), "t4-kimngan.png"),
    ((620, 130, 895, 450), "t4-duonghang.png"),
    ((1050, 130, 1300, 450), "t4-quocminh.png"),
]:
    crop_save("9.png", box, name)

print("\nDone! All images saved to", DST)
