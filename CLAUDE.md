# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

**Schmoll Creative** is a custom WordPress theme for Kevin Schmoll's portfolio site (Art Director / Creative Strategist). Located at `Desktop/schmoll-creative-theme/`.

## No Build Step

This is a pure PHP/CSS/JS WordPress theme — there is no npm, webpack, Makefile, or build tooling. Edit files directly; changes take effect on the next page load.

## Theme Architecture

Uses a **parent/child theme pattern**:

- `schmoll-creative/` — parent theme: all core logic, templates, CPTs, and styles
- `schmoll-creative-child/` — child theme: safe overrides (CSS, PHP filters, SR settings)

**Always activate the child theme** in WordPress, never the parent directly.

### Homepage Flow

`front-page.php` → loads template-parts in order:
`hero` → `marquee` → `services` → `work` → `about` → `testimonials` → `brands` → `contact`

### Key Files

| File | Purpose |
|------|---------|
| `schmoll-creative/functions.php` | Theme setup, CPT registration (Portfolio, Testimonials), meta boxes, Theme Options admin page, asset enqueuing |
| `schmoll-creative/assets/css/main.css` | Complete design system (CSS custom properties, grid, animations) |
| `schmoll-creative/assets/js/main.js` | Nav toggle, scroll reveal (IntersectionObserver), smooth scroll |
| `schmoll-creative/single-portfolio.php` | Individual project page with client/role/year meta bar |
| `schmoll-creative-child/functions.php` | Enqueues parent stylesheet, registers SR Settings admin page |

### CSS Custom Properties (design tokens)

```css
--ink: #0b0c0d          /* background */
--paper: #e8e2d6        /* body text */
--blue: #008dc2         /* primary brand color */
```

Override in child `style.css` via `:root { --blue: #newvalue; }`.

### Extensibility via Filters

The child theme (or plugins) can override data using these filters:

```php
add_filter( 'schmoll_services', fn($s) => [...] );   // service cards
add_filter( 'schmoll_skills', fn($s) => [...] );     // skills tags in About
add_filter( 'schmoll_brand_logos', fn($b) => [...] );// brand logo strip
```

Sections fall back to hardcoded placeholder data when no CPT items or filter overrides exist.

### Slider Revolution (Optional)

- The hero section detects whether the SR plugin is active; falls back to a static image if not
- SR slider alias must be set to `schmoll-hero`
- SR alias is configurable at **Appearance > SR Settings** (registered in child `functions.php`)

### Custom Post Types

- **Portfolio** — public, slug `/work/`, supports featured image + meta (Client, Year, Role, Project URL, Feature on homepage)
- **Testimonials** — admin-only, supports featured image + meta (Name, Title, Company)

### Template Overrides

Copy any parent template file into the child theme at the **same relative path**. WordPress automatically prefers the child theme version.

## WordPress Setup Notes

- Flush permalinks after any CPT changes: **Settings > Permalinks > Save Changes**
- All copy (hero text, stats, marquee, contact email, social URLs) is editable without code changes at **Appearance > Theme Options**
- Portfolio archive URL: `/work/`
