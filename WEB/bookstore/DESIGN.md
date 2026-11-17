# 📖 BOOKSTORE DESIGN SYSTEM (DESIGN.md)
*Standardized under Hallmark, Taste-Skill & Impeccable Design Principles*

---

## 1. Overview
BookStore is an online retail platform specializing in books and stationery. 
This design system abandons generic AI-generated templates ("AI slop": purple gradients, cookie-cutter cards, Inter font defaults, and emoji bloat) in favor of a **Warm Editorial Bookstore** aesthetic—inspired by physical literary boutiques, premium publishing houses, and tactile print craft.

---

## 2. Colors (Semantic Tokens)
All colors are centralized strictly at `:root` tokens. No arbitrary hex codes are permitted in component rules.

```css
:root {
    /* Canvas & Surfaces */
    --color-bg-canvas: #faf8f5;        /* Warm parchment paper background */
    --color-bg-surface: #ffffff;       /* Pure crisp white card/surface */
    --color-bg-subtle: #f4efe9;        /* Soft paper highlight */
    --color-bg-muted: #ece5dc;         /* Secondary container surface */

    /* Typography & Ink */
    --color-ink-primary: #18181b;      /* Deep printer charcoal ink */
    --color-ink-secondary: #52525b;    /* Warm slate secondary text */
    --color-ink-muted: #71717a;        /* Soft muted caption text */
    --color-ink-inverted: #ffffff;     /* White ink for contrast buttons */

    /* Brand & Accents */
    --color-brand-primary: #0f4c3a;    /* Heritage Bookbind Emerald */
    --color-brand-hover: #0a3528;      /* Deep forest hover */
    --color-brand-subtle: #e6f3ee;     /* Pale emerald tint for badges */
    
    --color-accent-terracotta: #c2410c; /* Warm terracotta orange for CTA/Sale */
    --color-accent-hover: #9a3412;
    --color-accent-subtle: #fff1eb;

    /* Borders & Dividers */
    --color-border-subtle: #ebdcd0;
    --color-border-default: #e4d7cb;
    --color-border-focus: #0f4c3a;

    /* Semantic Status */
    --color-success: #15803d;
    --color-success-bg: #f0fdf4;
    --color-warning: #b45309;
    --color-warning-bg: #fffbeb;
    --color-danger: #b91c1c;
    --color-danger-bg: #fef2f2;
    --color-info: #0369a1;
    --color-info-bg: #f0f9ff;
}
```

---

## 3. Typography
- **Display Headings (`--font-display`)**: `"Playfair Display", Georgia, serif` — gives literary dignity, editorial refinement, and rhythmic hierarchy to page headers and book titles.
- **Interface & Body Text (`--font-body`)**: `"Plus Jakarta Sans", "Be Vietnam Pro", system-ui, sans-serif` — delivers crisp readability for Vietnamese diacritics, prices, and interactive controls.
- **Type Scale Ratio**: Major Third (1.25) with tight tracking on headings and comfortable line height (`1.6 - 1.7`) on prose.

---

## 4. Layout & Spacing
- Base 8pt spacing scale (`--space-1: 4px`, `--space-2: 8px`, `--space-3: 12px`, `--space-4: 16px`, `--space-6: 24px`, `--space-8: 32px`, `--space-12: 48px`, `--space-16: 64px`).
- Viewport max-width: `1240px` with responsive padding (`16px` mobile, `24px` tablet, `32px` desktop).
- Image grid tracks: strictly use `minmax(0, 1fr)`.
- Anti-overflow constraint: `overflow-x: clip;` enforced on `html` and `body`.

---

## 5. Elevation & Depth
No harsh solid drop-shadows. Shadows are calibrated to emulate soft ambient light on heavy paper stocks:
- `--shadow-sm`: `0 1px 3px rgba(24, 24, 27, 0.05), 0 1px 2px rgba(24, 24, 27, 0.03)`
- `--shadow-card`: `0 4px 16px -2px rgba(24, 24, 27, 0.06), 0 2px 6px -1px rgba(24, 24, 27, 0.03)`
- `--shadow-hover`: `0 12px 28px -4px rgba(24, 24, 27, 0.10), 0 4px 10px -2px rgba(24, 24, 27, 0.04)`
- `--shadow-dropdown`: `0 16px 36px -4px rgba(24, 24, 27, 0.12), 0 6px 12px -2px rgba(24, 24, 27, 0.06)`

---

## 6. Shapes & Radius
- Modest, refined corners (not overly rounded bubble shapes):
  - `--radius-sm`: `6px` (badges, tags)
  - `--radius-md`: `10px` (inputs, buttons, cards)
  - `--radius-lg`: `16px` (hero banners, modals)
  - `--radius-pill`: `9999px` (search bar, filter pills)

---

## 7. Components
- **Buttons**:
  - `btn-primary`: Terracotta `#c2410c` or Emerald `#0f4c3a`, solid text, subtle hover lift (`translateY(-1px)`).
  - `btn-outline`: Delicate border `#e4d7cb`, background transparent, hover with warm subtle tint.
- **Product Card**:
  - Aspect ratio: `3/4` (standard book proportion).
  - Object-fit: `cover` with subtle inner hairline border to prevent washed-out covers.
  - Quick action buttons revealed smoothly without jarring layout shifts.
- **Navigation & Dropdowns**:
  - Clean SVG iconography replacing emojis.
  - Dropdowns with instant focus-visible and soft slide-fade.

---

## 9. Literary Epigraph & Brand Craft Section (Khối Danh Ngôn & Dấu Ấn Chế Bản)
*Standardized styling for editorial literary banners and brand commitments.*

### 9.1. The Grand Epigraph (Lời Đề Tặng Danh Ngôn)
- **Role**: Embody the romantic, tactile soul of an authentic literary salon. Replaces generic marketing cards with poetic typographic resonance.
- **Backdrop**: Warm parchment surface (`--color-bg-canvas: #faf8f5`) bordered by fine double hairlines (`1px solid var(--color-border-subtle)` with inner inset `3px`).
- **Quote Typography**:
  - `font-family: var(--font-display)` (Lora / Serif Italic).
  - Size: `24px` (Desktop) / `19px` (Mobile), `line-height: 1.75`.
  - Color: Deep heritage emerald ink (`--color-brand-primary: #0f4c3a`).
  - Curly punctuation marks: `“` and `”` rendered with optical breathing room.
- **Attribution / Subtitle**:
  - `font-family: var(--font-body)`.
  - Uppercase tracked: `font-size: 11.5px`, `letter-spacing: 0.18em`, `font-weight: 600`.
  - Color: Warm muted earth (`#8c827a`), flanked by ornamental horizontal hairline dashes (`— DANH NGÔN BẠN ĐỌC BOOKSTORE —`).

### 9.2. Bookplate Assurance Pillars (Thẻ Cam Kết Dấu Ấn Sách)
- **Role**: Present quality commitments (3-layer anti-crease book packing, 100% publisher provenance, 7-day pristine returns, tailored literary concierge) not as dry corporate bullet points, but as refined **Ex-Libris Bookplates**.
- **Frame**: Soft ivory card stock with delicate inset border (`box-shadow: 0 4px 20px -2px rgba(15, 76, 58, 0.05)`).
- **Index Numerals (`01`, `02`, `03`, `04`)**:
  - Displayed in large artistic serif italic (`font-size: 32px`, `font-family: var(--font-display)`).
  - Rendered with an elegant subtle watermark tint (`opacity: 0.4; color: var(--color-brand-primary)`).
- **Interactive Micro-motion**:
  - Subtle `translateY(-3px)` lift on hover with border transition to `--color-brand-primary`.
  - No `transition: all`. Exactly `transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease`.

---

## 10. Do's and Don'ts (Hallmark & Taste Floor)
* ✅ **DO**: Use curated SVG vector icons for clarity and professionalism.
* ✅ **DO**: Format all Vietnamese currency prices cleanly (e.g. `125.000 ₫`).
* ✅ **DO**: Ensure all inputs and buttons have `:focus-visible` accessibility rings.
* ❌ **DON'T**: Never use `transition: all`. Specify exact transitioned properties.
* ❌ **DON'T**: Never use casual emojis (📚, 🛍️, 🛒) in core navigational or transactional UI.
* ❌ **DON'T**: Never break existing form names, action URLs, or controller parameters.
