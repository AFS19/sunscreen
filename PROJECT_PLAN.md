# Project Plan: Modern 3D SaaS Landing Page + Admin Panel

## Overview

A modern Laravel 13 SaaS/product landing page with a Three.js-powered 3D hero section, managed by a Filament v5 admin panel. Uses `spatie/laravel-settings` for site-wide configuration.

---

## Tech Stack

| Layer | Choice                                       |
|---|----------------------------------------------|
| Backend | Laravel 13 + Filament v5 (existing) |
| Settings | `spatie/laravel-settings` v3.8.0             |
| Frontend CSS | Tailwind v4 (existing)                       |
| 3D / Animation | Three.js + CSS animations                    |
| Auth | Built-in (Breeze/Fortify)                    |
| Font | Instrument Sans (via Bunny Fonts, existing)  |

---

## Database Migrations

### Content Tables

| Table | Columns |
|---|---|
| `features` | id, title, description, icon, sort_order, is_active, timestamps |
| `products` | id, name, slug, description, price, image, is_active, is_featured, timestamps |
| `testimonials` | id, author_name, company, quote, avatar, is_featured, timestamps |
| `pricing_plans` | id, name, price, billing_cycle, features (JSON), cta_label, cta_url, is_featured, timestamps |
| `settings` (spatie) | managed by spatie/laravel-settings package |

---

## Admin Panel (Filament v5)

### Resources

| Resource | Path | Purpose |
|---|---|---|
| `FeatureResource` | `app/Filament/Resources/FeatureResource.php` | Manage product features |
| `ProductResource` | `app/Filament/Resources/ProductResource.php` | Manage products/services |
| `TestimonialResource` | `app/Filament/Resources/TestimonialResource.php` | Manage testimonials |
| `PricingPlanResource` | `app/Filament/Resources/PricingPlanResource.php` | Manage pricing tiers |

### Settings Page

| Page | Path | Purpose |
|---|---|---|
| `SiteSettings` | `app/Filament/Pages/SiteSettings.php` | Editable via `spatie/laravel-settings` |

### Settings Class

```
app/Settings/GeneralSettings.php
  └── group(): 'general'
  └── Properties: site_name, tagline, hero_headline, hero_subtext, hero_cta_text, hero_cta_url, social_links (JSON)
```

### Admin Navigation

```
Content
  ├── FeatureResource
  ├── ProductResource
  ├── TestimonialResource
  └── PricingPlanResource

Settings
  └── SiteSettings
```

### Admin Theme

- Keep amber primary color (existing)
- Custom Filament theme matching frontend dark palette

---

## Frontend (Landing Page)

### Structure

| Section | Purpose |
|---|---|
| **Hero** | Full-viewport 3D canvas (Three.js) + headline + CTA overlay |
| **Features** | Card grid from `features` table |
| **Products/Services** | Product cards from `products` table |
| **Testimonials** | Quote cards from `testimonials` table |
| **Pricing** | Pricing tiers from `pricing_plans` table |
| **CTA** | Final call-to-action |
| **Footer** | Nav links + social links from settings |

### 3D Hero Details

- **Torus knot** with wireframe material + slow auto-rotation
- **Floating particles** in background for depth
- Mouse-parallax camera movement (subtle)
- Smooth color shifts via Three.js shaders
- Performance: `0.75` pixel ratio, pause when tab hidden
- Reduced geometry on mobile

### Design Details

- **Dark theme** default + light mode toggle
- **Colors:** Deep navy `#0a0a1a`, amber `#f59e0b`, cyan `#06b6d4`, violet `#8b5cf6`
- **Motion:** Intersection Observer for entrance animations
- **Font:** Instrument Sans (existing)

### File Structure

```
resources/
  js/
    app.js
    three/
      HeroScene.js         ← Three.js scene setup
      particles.js         ← Particle system
      scene.js             ← Main scene config
  views/
    layouts/
      site.blade.php        ← Main layout (nav + footer)
    site/
      partials/
        hero.blade.php
        features.blade.php
        products.blade.php
        testimonials.blade.php
        pricing.blade.php
        cta.blade.php
        footer.blade.php
    welcome.blade.php        ← Landing page entry
  css/
    components/
      site.css              ← Component-level styles
```

### Routes

| Route | View | Purpose |
|---|---|---|
| `GET /` | `welcome.blade.php` | Landing page |

---

## Implementation Phases

### Phase 1 — Backend Foundation
1. Install `spatie/laravel-settings`
2. Create migrations (features, products, testimonials, pricing_plans)
3. Create settings migration via `php artisan make:settings-migration CreateGeneralSettings`
4. Create Eloquent models with factories
5. Create Filament resources (all 4 + settings page)

### Phase 2 — Frontend Core
6. Install `three` + `@types/three` via npm
7. Build Blade layout (`site.blade.php`) + sticky nav
8. Build Three.js `HeroScene.js` with torus knot + particles
9. Build Hero section partial (3D canvas + headline + CTA)
10. Build Features, Products, Testimonials, Pricing sections (wired to DB)
11. Build CTA + Footer sections

### Phase 3 — Polish
12. Scroll-triggered entrance animations (Intersection Observer)
13. Dark/Light mode toggle
14. Mobile nav menu
15. Admin panel theme polish
16. Performance optimization (3D quality on mobile, tab blur pause)
17. Run tests + verify build

---

## Artisan Commands

```bash
composer require spatie/laravel-settings

php artisan make:migration create_features_table
php artisan make:migration create_products_table
php artisan make:migration create_testimonials_table
php artisan make:migration create_pricing_plans_table
php artisan make:settings-migration CreateGeneralSettings

php artisan make:filament-resource FeatureResource --generate
php artisan make:filament-resource ProductResource --generate
php artisan make:filament-resource TestimonialResource --generate
php artisan make:filament-resource PricingPlanResource --generate
php artisan make:filament-settings-page GeneralSettings
```
