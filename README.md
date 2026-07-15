# Lesley Tabi — Software Engineer Portfolio

A personal developer portfolio built with Laravel, styled as a live API response — skills render as a SQL schema table, projects as JSON results, and the hero background plays real footage from one of my own shipped products instead of a stock video.

**Live site:** [lesleydesigns.wuaze.com](https://lesleydesigns.wuaze.com)

---

## Features

- **API-themed hero** — profile rendered as a live JSON response (`GET /developer/lesley-tabi → 200 OK`), with a muted looping video of a real project running behind it
- **Schema-style skills table** — skills grouped by category (Backend, Frontend, Database, Tools), animated in on scroll with category-coded progress bars
- **Project list as API results** — each project card styled like a paginated API response, with live links, stack tags, and detail pages
- **Contact form styled as a POST request** — submits via Laravel mail, with server-side validation and success/error states
- **Resume preview + download** — view inline or download the PDF directly
- **Fully responsive** — video background and animations degrade gracefully on mobile, with `prefers-reduced-motion` support throughout

## Tech Stack

- **Backend:** PHP, Laravel, MySQL
- **Frontend:** Blade templates, vanilla JS (IntersectionObserver for scroll animations), custom CSS (no framework — hand-built design system with CSS variables)
- **Deployment:** Shared hosting (InfinityFree), deployed without SSH/artisan access — see [Deployment Notes](#deployment-notes)

## Project Structure

```
app/Http/Controllers/PortfolioController.php   # index, project detail, contact form handling
app/Models/Project.php                          # portfolio projects
app/Models/Skill.php                             # categorized skills with proficiency
resources/views/portfolio/                       # index, project detail, terms, privacy
public/css/portfolio.css                         # full design system
public/videos/, public/images/                   # hero background + poster
public/files/                                    # downloadable resume
```

## Local Setup

```bash
git clone https://github.com/Lesley-debug/lesley-portfolio.git
cd lesley-portfolio
composer install
cp .env.example .env
php artisan key:generate
```

Set your local database credentials in `.env`, then:

```bash
php artisan migrate --seed
php artisan serve
```

Visit `http://127.0.0.1:8000`.

## Deployment Notes

This project is deployed on **InfinityFree**, a shared host with no SSH or artisan access. That constraint shapes a few things worth knowing if you're deploying somewhere similar:

- `public/` contents are flattened into the web root (`htdocs`); the rest of the Laravel app sits one level above it, with `index.php` adjusted to reference `../vendor`, `../bootstrap`, etc.
- Database seeding on the live server is done manually via phpMyAdmin rather than `php artisan db:seed`
- `.env` is created directly through the host's file manager rather than uploaded, since some zip/upload flows silently strip dotfiles

## Projects Featured

- **Reading Space** — flagship e-library system (in development)
- **NST Herbal Clinic** — e-commerce + clinic management platform
- **Invento Track** — multi-tenant inventory and sales system
- **ABN Building Project** — real estate company site with admin CMS
- **University Student Management System** — 7-person team project (TypeScript)

## Contact

- Email: esanglesley@gmail.com
- GitHub: [github.com/Lesley-debug](https://github.com/Lesley-debug)
- LinkedIn: [linkedin.com/in/lesley-tabi-a0b1a1267](https://www.linkedin.com/in/lesley-tabi-a0b1a1267)

---

Built with ♥ in Laravel.
