# Schmoll Creative — WordPress Theme

## Package Contents

```
schmoll-creative/          ← Parent theme (install this first)
schmoll-creative-child/    ← Child theme (activate this one)
```

---

## Installation

### 1. Upload Both Themes
1. In WordPress admin go to **Appearance > Themes > Add New > Upload Theme**
2. Upload `schmoll-creative.zip` → Install
3. Upload `schmoll-creative-child.zip` → Install
4. **Activate `Schmoll Creative Child`** (NOT the parent directly)

### 2. Set a Static Front Page
1. Go to **Settings > Reading**
2. Set "Your homepage displays" to **A static page**
3. Create a blank page called "Home" and select it as the Homepage
4. WordPress will now use `front-page.php` to render the homepage

### 3. Configure Theme Options
Go to **Appearance > Theme Options** and fill in:
- Hero eyebrow text, headline words, sub-headline
- Stats (20+ Years, 150+ Brands, etc.)
- Marquee ticker text
- Contact email
- LinkedIn / Instagram / Behance URLs

---

## Slider Revolution Setup

### Install the Plugin
1. Purchase at https://www.sliderrevolution.com
2. In WP Admin: **Plugins > Add New > Upload Plugin** → upload the SR zip → Activate

### Create the Hero Slider
1. Go to **Slider Revolution > New Slider**
2. Set slider type to **Fullwidth**
3. Set minimum height to `100vh`
4. **Set the Alias to `schmoll-hero`** (critical)
5. Add your hero image(s) or video as slide layers
6. Recommended: disable navigation arrows/bullets for a clean look
7. Publish the slider

### Confirm in Child Theme Settings
1. Go to **Appearance > SR Settings**
2. Confirm the alias field reads `schmoll-hero`
3. Refresh the homepage — the hero image will be replaced by your slider

> **If SR is not active**, the theme automatically falls back to a static  
> hero image. No broken layouts.

---

## Portfolio Projects

### Adding Projects via WP Admin
1. Go to **Portfolio > Add New**
2. Set a **Featured Image** (used as the grid thumbnail)
3. Fill in the sidebar meta fields:
   - **Client** — client/brand name
   - **Year** — project year
   - **Role / Category** — e.g. "Brand Identity · Digital"
   - **Project URL** — external link (overrides WP permalink on grid click)
   - **Feature on homepage** — check to include in the homepage grid
4. Publish

Projects automatically appear in the homepage grid ordered by menu order then date.  
Up to 12 projects are shown. The "View All Work" button links to the portfolio archive (`/work/`).

---

## Testimonials

1. Go to **Testimonials > Add New**
2. Paste the quote text in the editor
3. Set a **Featured Image** (square avatar photo, 88×88px min)
4. Fill in sidebar fields: Name, Title/Role, Company
5. Publish

Up to 6 testimonials are shown on the homepage.

---

## Child Theme Customisation

Edit `schmoll-creative-child/style.css` to override styles:

```css
/* Change brand blue */
:root { --blue: #0072ce; }

/* Adjust hero headline size */
@media (min-width: 1024px) {
  .hero-headline { font-size: 8rem; }
}
```

Override templates by copying the relevant file from the parent into the child  
at the same path and editing the copy. WordPress automatically prefers child  
theme files over parent theme files.

Override services or brand logos by adding filters to `functions.php` in the child theme:

```php
add_filter( 'schmoll_services', function( $services ) {
    $services[] = [ 'n' => '07', 'title' => 'Motion Design', 'desc' => 'Animation and video.' ];
    return $services;
} );
```

---

## Theme File Map

```
schmoll-creative/
├── style.css                      Theme declaration
├── functions.php                  Setup, CPTs, meta boxes, Theme Options
├── front-page.php                 Homepage template
├── index.php                      Blog/archive fallback
├── header.php                     Nav + splatter layer
├── footer.php                     Footer + social links
├── single-portfolio.php           Individual project page
├── assets/
│   ├── css/main.css               Full design system stylesheet
│   └── js/main.js                 Nav, scroll reveal, smooth scroll
└── template-parts/
    ├── hero.php                   Hero section (SR or static image)
    ├── marquee.php                Animated ticker
    ├── services.php               Service cards
    ├── work.php                   Portfolio grid
    ├── about.php                  Bio + skills
    ├── testimonials.php           Testimonial cards
    ├── brands.php                 Brand logo strip
    └── contact.php                Contact CTA

schmoll-creative-child/
├── style.css                      Child theme declaration + CSS overrides
└── functions.php                  Parent stylesheet loader + SR settings page
```

---

## Notes

- **Flush permalinks** after activation: Settings > Permalinks > Save Changes
- Portfolio archive URL: `/work/`
- The splatter texture and grain overlay are pure CSS — no images required
- All copy (hero text, stats, marquee, contact email, social URLs) is editable via Appearance > Theme Options without touching code
