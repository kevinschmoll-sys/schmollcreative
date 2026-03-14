# Schmoll Creative — WordPress Theme

A custom WordPress portfolio theme for Kevin Schmoll, Art Director & Creative Strategist. Built with a dark, ink-stained aesthetic using vanilla PHP, CSS, and JavaScript — no build tools required.

---

## Requirements

- WordPress 5.0+
- PHP 7.0+
- [Slider Revolution](https://www.sliderrevolution.com) *(optional — theme falls back gracefully without it)*

---

## Installation

1. Go to **Appearance > Themes > Add New > Upload Theme**
2. Upload `schmoll-creative.zip` → Install
3. Upload `schmoll-creative-child.zip` → Install
4. **Activate `Schmoll Creative Child`** (not the parent directly)
5. Go to **Settings > Permalinks** and click **Save Changes** to flush rewrite rules
6. Go to **Settings > Reading**, set homepage to a static page, and assign a blank "Home" page

---

## Configuration

All site copy is managed without touching code at **Appearance > Theme Options**:

- Hero eyebrow, headline, and sub-headline
- Stats (e.g. 20+ Years, 150+ Brands)
- Marquee ticker text
- Contact email
- LinkedIn, Instagram, and Behance URLs

---

## Content

### Portfolio Projects

1. **Portfolio > Add New**
2. Set a featured image (used as the grid thumbnail)
3. Fill in the meta fields: Client, Year, Role/Category, Project URL, Feature on homepage
4. Publish

Up to 12 projects appear in the homepage grid, ordered by menu order then date. The portfolio archive lives at `/work/`.

### Testimonials

1. **Testimonials > Add New**
2. Paste the quote in the editor
3. Set a square featured image (88×88px minimum)
4. Fill in: Name, Title/Role, Company
5. Publish

Up to 6 testimonials are shown on the homepage.

---

## Slider Revolution (Optional Hero)

1. Install and activate the SR plugin via **Plugins > Add New > Upload Plugin**
2. Go to **Slider Revolution > New Slider** — set type to Fullwidth, min height to `100vh`
3. **Set the alias to `schmoll-hero`** (required)
4. Add slide layers and publish
5. Confirm the alias at **Appearance > SR Settings**

If SR is not active, the theme automatically falls back to a static hero image.

---

## Customisation

### CSS Overrides

Edit `schmoll-creative-child/style.css`. The design is token-based:

```css
/* Swap brand color */
:root { --blue: #0072ce; }

/* Resize hero headline */
@media (min-width: 1024px) {
  .hero-headline { font-size: 8rem; }
}
```

Key tokens: `--ink` (background), `--paper` (text), `--blue` (brand).

### PHP Filter Hooks

Override data arrays in `schmoll-creative-child/functions.php`:

```php
add_filter( 'schmoll_services', function( $services ) {
    $services[] = [ 'n' => '07', 'title' => 'Motion Design', 'desc' => 'Animation and video.' ];
    return $services;
} );
```

Available filters: `schmoll_services`, `schmoll_skills`, `schmoll_brand_logos`

### Template Overrides

Copy any file from `schmoll-creative/` into `schmoll-creative-child/` at the same path. WordPress automatically uses the child theme version.

---

## File Structure

```
schmoll-creative/                  Parent theme
├── functions.php                  Setup, CPTs, meta boxes, Theme Options
├── front-page.php                 Homepage (loads all template-parts)
├── single-portfolio.php           Individual project page
├── header.php / footer.php
├── assets/
│   ├── css/main.css               Full design system
│   └── js/main.js                 Nav, scroll reveal, smooth scroll
└── template-parts/
    ├── hero.php                   Hero (SR or static fallback)
    ├── marquee.php                Animated skill ticker
    ├── services.php               Service cards
    ├── work.php                   Portfolio grid
    ├── about.php                  Bio + skills tags
    ├── testimonials.php           Client testimonials
    ├── brands.php                 Brand logo strip
    └── contact.php                Contact CTA

schmoll-creative-child/            Child theme (activate this one)
├── style.css                      CSS overrides
└── functions.php                  Parent loader + SR Settings page
```

---

## License

Copyright (c) 2026 Kevin Schmoll. All Rights Reserved.
