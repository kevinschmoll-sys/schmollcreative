# KSC STATIC BUILD — HANDOFF
## Updated: April 20, 2026 — Code review fixes applied
## Status: ALL 19 CASE STUDY PAGES COMPLETE. Live at schmollcreative.com/punksite/. CSS v3.0. All code review issues resolved.

---

## QUICK START

```bash
# Local dev
cd ~/Desktop/schmollcreative/static-build/Schmol\ Creative/
python3 server.py
# → http://localhost:8000

# Deploy (incremental FTP — only changed files)
push-site
# OR manually:
bash deploy.sh
```

---

## PROJECT OVERVIEW

Static HTML portfolio site for Kevin Schmoll — Art Director / Creative Director.
Migrated off WordPress/Avada to hand-coded HTML/CSS/JS.
Punk/brutalist aesthetic. No frameworks, no build step, no dependencies.

**Live URL:** https://schmollcreative.com/punksite/
**Host:** GoDaddy shared hosting → `public_html/punksite`
**FTP creds:** macOS Keychain → `ksc-deploy-ftp` / `kevinschmoll79`

---

## FILE TREE

```
~/Desktop/schmollcreative/static-build/Schmol Creative/
├── index.html                    ← Main page (hero, grid, about, process, contact)
├── assets/
│   ├── css/
│   │   ├── style.css             ← All homepage styles (v1.1, 401 lines)
│   │   └── case-study.css        ← All case study page styles (133 lines)
│   └── js/
│       └── main.js               ← Cursor, clock, marquee, scroll reveal, forms (131 lines)
├── work/                         ← 19 case study pages (ALL COMPLETE)
│   ├── green-ox/index.html
│   ├── robin-clip/index.html
│   ├── certified-evil-genius/index.html
│   ├── viscid/index.html
│   ├── your-crawlspace/index.html
│   ├── sticky-fingers/index.html
│   ├── great-wolf-lodge/index.html
│   ├── midnight-moon/index.html
│   ├── roxbury/index.html
│   ├── sweetgrass/index.html
│   ├── top-shelf-catering/index.html
│   ├── netflix/index.html
│   ├── jackson-county/index.html
│   ├── us78/index.html
│   ├── gvc/index.html
│   ├── ortholite/index.html
│   ├── twilio/index.html
│   ├── atra/index.html
│   └── star-taco/index.html
├── images/                       ← Portfolio images (real folders, NOT symlinks)
│   ├── 00_site-ui/               ← Hero bg, UI assets
│   ├── 01_green-ox/ → 11_star-taco/  ← Per-project image folders
│   ├── 12_other-portfolio/       ← Covers for smaller projects
│   ├── 13_brands-logos/          ← Logo marquee assets (white on transparent)
│   └── 14_testimonials/          ← Avatar photos
├── SR-Hero-Export/
│   ├── HerozombNEW.png           ← PIL-trimmed zombie (used in hero)
│   ├── Herozomb.png              ← Original zombie
│   └── thatsme.png               ← Annotation graphic
├── contact.php                   ← Server-side form handler
├── deploy.sh                     ← Incremental FTP deploy script
├── server.py                     ← Local dev server (NOT python -m http.server)
├── .htaccess                     ← Apache config for punksite
├── HANDOFF.md                    ← This file
├── CONTENT.md                    ← Copy/content reference
└── README.md                     ← Project readme
```

---

## DEPLOY

**Incremental FTP** — only uploads changed files (MD5 checksum cache at `.deploy-cache`).

```bash
# Shell alias (already configured):
push-site

# Or run directly:
cd ~/Desktop/schmollcreative/static-build/Schmol\ Creative/
bash deploy.sh
```

**Manual single-file deploy:**
```bash
PASS=$(security find-generic-password -s 'ksc-deploy-ftp' -a 'kevinschmoll79' -w)
BASE="ftp://schmollcreative.com/public_html/punksite"
LOCAL="/Users/kevinschmoll/Desktop/schmollcreative/static-build/Schmol Creative"
curl --silent --show-error -T "$LOCAL/assets/css/style.css" "$BASE/assets/css/style.css" --user "kevinschmoll79:$PASS"
```

**Important:** After deploying, hard-refresh the browser (Cmd+Shift+R). The FTP host caches aggressively.

---

## DESIGN SYSTEM

| Token | Value |
|---|---|
| Yellow | `#fff600` → `var(--ksc-yellow)` |
| Blue | `#068dc1` → `var(--ksc-blue)` |
| Dark | `#0a0a0a` → `var(--ksc-dark)` |
| Mid | `#0d0d0d` → `var(--ksc-mid)` |
| White | `#ffffff` → `var(--ksc-white)` |

| Role | Font | Weight | Usage |
|---|---|---|---|
| Display | Bebas Neue | 400 | Headings, buttons, section titles |
| Body | Barlow | 300/400/700 | Paragraphs, descriptions |
| Condensed | Barlow Condensed | 400i/900i | Hero roles list |
| Mono | Share Tech Mono | 400 | Labels, status line, meta text |

**Google Fonts import** (in style.css):
```
Bebas+Neue & Barlow+Condensed:ital,wght@0,400;0,900;1,400;1,900 & Barlow:wght@300;400;700 & Share+Tech+Mono
```

---

## HOMEPAGE SECTIONS (index.html — 284 lines)

### 1. Hero (`<section class="ksc-hero">`)
- `height: 100vh`, CSS grid `45fr / 55fr`
- Left col: status line → KEVIN SCHMOLL (glitch) → CREATIVE (yellow) → tags → CTAs
- Right col: zombie PNG (`position: absolute; right: -2vw; bottom: 0; height: 100vh`)
- Background: `recentwork_hero.jpg` at 22% opacity via `::before`
- Blue 3px bar: `<span class="ksc-bar-blue">` absolutely positioned at bottom
- Responsive: ≤1024px → single column, right col hidden, left col centered

### 2. Work Masthead (`<section class="ksc-work-masthead">`)
- Yellow spine + "THE WORK" heading + hover label

### 3. Portfolio Grid (`<section id="ksc-portfolio">`)
- 20 items in 4-column CSS grid (square aspect via `padding-bottom: 100%`)
- Blue hover overlays with category + title reveal animation
- Quiet label (bottom-left) hides on hover
- Links to `work/{slug}/` case study pages
- Note: OrthoLite appears twice (two different project entries)

### 4. About (`<section class="ksc-about">`)
- Yellow background, 3-column grid: spine + mid (bio) + right (awards/skills)
- Ghost "20" watermark, award block (3× Prism), 6 skill bars with hover effect

### 5. Process (`<section class="ksc-process">`)
- White background, ransom-note heading ("HOW IT actually GETS MADE.")
- 4-column grid: Discover, Define, Design, Deliver
- Dark hover state with yellow numbers

### 6. Logo Marquee (`<section class="ksc-marquee-section">`)
- Two rows, 10 logos each (duplicated for seamless loop)
- Forward row: 28s, reverse row: 32s
- Pause on hover, edge gradient fade

### 7. Testimonials (`<section class="ksc-testimonials">`)
- 6 cards, 3-column grid, blue top border → yellow on hover
- Star ratings, avatar photos, real quotes

### 8. Contact CTA (`<section class="ksc-contact">`)
- Yellow background, "GOT A PROJECT?" heading
- LinkedIn composer: textarea → "Send on LinkedIn" button (opens LinkedIn messaging)
- Two CTA buttons: "Start a Project" + "Hire Me"

### 9. Footer Form (`<section class="ksc-footer-form">`)
- "LET'S TALK." heading, 2-column form grid
- Honeypot spam field, PHP handler at `contact.php`
- Success/error feedback via JS

### 10. Footer
- Logo, tagline, social links (LinkedIn, Instagram, X)
- Auto copyright year via JS

---

## CASE STUDY PAGES (work/{slug}/index.html)

All 19 pages share `case-study.css` and follow the same structure:

```html
<!-- NAV: yellow bg, dark text, blue "Next Project →" link -->
<nav class="ksc-cs-nav">
  <a class="ksc-cs-back" href="../../">← ALL PROJECTS</a>
  <span class="ksc-cs-nav-title">PROJECT NAME</span>
  <a class="ksc-cs-nav-next" href="../next-slug/">Next Project →</a>
</nav>

<!-- HERO: either split (image right) or full-width -->
<section class="ksc-cs-hero"> or <section class="ksc-cs-hero-split">

<!-- COVER IMAGE (optional) -->
<div class="ksc-cs-cover">

<!-- OVERVIEW: body text left, meta sidebar right -->
<section class="ksc-cs-overview">

<!-- GALLERY: 2-column grid, some images span full width -->
<section class="ksc-cs-gallery">

<!-- QUOTE (optional): blue bg, italic quote + attribution -->
<section class="ksc-cs-quote">

<!-- NEXT PROJECT: dark bg, yellow border, linked title -->
<section class="ksc-cs-next">
```

**Image rules:**
- Always `height: auto` — never fixed heights
- Images come from `../../images/{folder}/` paths
- WP image years vary — always scrape exact URLs from browser before downloading

**Navigation chain:** Each page links to the next. Last page (Star Taco) links back to Green Ox.

---

## JS FEATURES (main.js — 131 lines)

| Feature | How it works |
|---|---|
| Custom cursor | Yellow ring follows mouse, trail particles (yellow/blue dots) |
| Live clock | Updates `#ksc-live-time` every second, HH:MM:SS |
| Status dot blink | `kscBlink` animation, 1.8s ease-in-out |
| Logo marquee | `kscMarqFwd` 28s / `kscMarqRev` 32s, pause on hover |
| Scroll reveal | IntersectionObserver at 10% threshold, `.visible` class |
| Copyright year | Auto-fills `#ksc-year` and `#ksc-footer-legal` |
| LinkedIn composer | `kscSendLinkedIn()` → opens LinkedIn messaging with pre-filled body |
| Content protection | Right-click disabled, drag prevention, copy appends © notice |
| Contact form | `kscSubmitForm()` → POST to `contact.php`, success/error feedback |

**Custom cursor note:** `* { cursor: none !important; }` is in the CSS. On mobile this is invisible (no mouse), which is fine.

---

## ✅ RESOLVED: HERO LAYOUT (Fixed Apr 16, 2026 — CSS Grid)

### The Problem (was)
Flexbox layout on `.ksc-hero-left` couldn't reliably position elements to match the design comp across different viewport heights. `margin-top: auto`, `justify-content: space-between`, vh-based padding — all produced drift between elements that compounded with viewport changes.

### The Fix (APPLIED)
Replaced flexbox with **CSS Grid** using explicit row placement. Each element is locked to a named grid row. The `1fr` flexible row absorbs viewport height changes without shifting any other element.

### Current Hero CSS (grid approach)
```css
.ksc-hero-left {
  padding: 0 48px 0 64px;
  display: grid;
  grid-template-rows:
    12.8vh   /* top padding */
    auto     /* status line */
    8px      /* gap */
    auto     /* KEVIN SCHMOLL */
    0px      /* gap */
    auto     /* CREATIVE */
    1fr      /* flexible gap — absorbs viewport changes */
    auto     /* tags */
    48px     /* gap */
    auto     /* buttons */
    10.6vh;  /* bottom padding */
}
.ksc-hero-left .ksc-status-line      { grid-row: 2; }
.ksc-hero-left .ksc-hero-name        { grid-row: 4; }
.ksc-hero-left .ksc-hero-name-yellow  { grid-row: 6; }
.ksc-hero-left .ksc-tags             { grid-row: 8; }
.ksc-hero-left .ksc-hero-ctas        { grid-row: 10; }
```

### Current Hero HTML (flat, no wrapper divs)
```html
<div class="ksc-hero-left">
  <div class="ksc-status-line">...</div>
  <span class="ksc-hero-name ...">KEVIN SCHMOLL</span>
  <span class="ksc-hero-name-yellow ...">CREATIVE</span>
  <div class="ksc-tags">...</div>
  <div class="ksc-hero-ctas">...</div>
</div>
```

### How to adjust spacing
Change a single number in `grid-template-rows`:
- Top padding → row 1 (12.8vh)
- Status→Name gap → row 3 (8px)
- Name→Creative gap → row 5 (0px)
- Creative→Tags gap → row 7 (1fr — flexible)
- Tags→Buttons gap → row 9 (48px)
- Bottom padding → row 11 (10.6vh)

### Responsive (≤1024px)
Grid switches to flexbox with `justify-content: center` when right column hides.

### Grid template file
`grid-template.html` — visual overlay showing all grid rows at actual viewport. Open in browser to verify layout.

### What was tried before CSS Grid (all failed)
- Flexbox with `justify-content: space-between` + wrapper divs
- Flexbox with `margin-top: auto` on tags
- Flexbox with `justify-content: flex-start` + vh padding
- Various fixed px margins between elements
- All produced drift at different viewport heights due to flexible text sizing (`clamp()`)

The CSS Grid approach solved it because each element is locked to an explicit row — no margins to drift.

---

## RESPONSIVE BREAKPOINTS (style.css)

| Breakpoint | What changes |
|---|---|
| ≤1200px | Tighten name/CREATIVE font sizes |
| ≤1024px | Hero → single column, right col (zombie) hidden, left col centered |
| ≤900px | Portfolio → 2 columns. About → 2 columns (right hides). Testimonials → 2 columns. Contact grid → 1 column |
| ≤768px | Hero padding tightens, buttons shrink. Process → 2 columns. Form → 1 column |
| ≤600px | About → 1 column (spine hides). Testimonials → 1 column |
| ≤480px | Hero padding minimal, portfolio → 1 column, tags/buttons smallest |

---

## KEY LESSONS & PRINCIPLES

| # | Lesson |
|---|---|
| 1 | **Always measure the design comp first.** Use Python/PIL pixel analysis via bash before any CSS decisions. Kevin has been explicit this is non-negotiable. |
| 2 | **Images must always use `height: auto`** — never fixed heights. Avada taught us this the hard way. |
| 3 | **`edit_block` requires exact string match** — always `read_file` the current state before using it. Prior edits in the same session cause silent match failures. |
| 4 | **Deploy is `push-site`** (shell alias for `deploy.sh`). Host = `schmollcreative.com`, path = `public_html/punksite`. |
| 5 | **WP image paths vary by upload year** — always scrape exact URLs from the browser, never guess the path. |
| 6 | **Local dev server must be `server.py`**, NOT `python3 -m http.server` (symlinks + headers don't work). |
| 7 | **CSS file corrupts with too many `edit_block` calls** — rewrite clean when in doubt. |
| 8 | **The static design comp PNG is the source of truth** for all layout decisions. |
| 9 | **Content protection** is in place: right-click disabled, image drag prevention, copy appends © notice. |
| 10 | **FTP host caches aggressively** — always hard-refresh (Cmd+Shift+R) after deploy. |

---

## AVADA BUILD (LEGACY — reference only)

The WordPress/Avada build is archived at `~/Desktop/schmollcreative/avada-build/`.
It contains its own HANDOFF.md and is no longer the active build.
The static build replaced it entirely.

Key files for reference if ever needed:
- `01-global-css.css` — Avada Custom CSS
- `02-build-guide.md` — Avada builder reference
- `03-custom-js.js` — Avada custom JS
- `~/Desktop/SR-Hero-Export/SR7-Hero-Build-Guide.md` — Slider Revolution 7 guide

The Avada build taught us:
- Avada strips `content: ''` pseudo-elements — use JS DOM injection instead
- Avada's overflow is deeply nested — every wrapper layer needs `overflow: visible !important`
- Isotope is not jQuery-initialized in Avada — CSS grid overrides work better
- REST API nonce expires per session — always fetch fresh

---

## FUTURE CONSIDERATIONS

- **Figma import:** Once punksite is live and stable, import `https://schmollcreative.com/punksite/` into Figma via html.to.design at 1440px, 768px, 375px viewports
- **Future stack (if rebuilding):** Tailwind v4 + shadcn/ui + Next.js or Astro
- **Open Props:** Identified as best CSS framework fit for this project if adding a framework layer (CDN drop-in, custom property tokens, no build step)
- **Performance:** No framework, no build step, no JS dependencies — the site is already fast. Consider adding lazy loading for portfolio images if total page weight becomes an issue.

---

## SESSION LOG

| Date | What happened |
|---|---|
| Mar 31 | Avada build: hero 2-col layout, zombie overflow fix, portfolio rendering fix |
| Apr 5 | Avada build: CSS rewrite, ticker positioning, SR7 guide update, CSS framework research |
| Apr 12 | Static build started: migrated off Avada, built index.html + style.css + main.js, first 11 case studies |
| Apr 13 | Ticker positioning, deploy script, all 19 case studies completed |
| Apr 20 | Code review: 8 fixes applied — duplicate OrthoLite removed, loading=lazy on 71 images, OG/social meta tags, removed maximum-scale=1.0, CSS bg paths → root-relative /punksite/, loader math fixed, contact.php → PHPMailer+SMTP, setup-password.sh removed from repo |
