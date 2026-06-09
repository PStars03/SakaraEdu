# AGENTS.md — SakaraEdu Agent Guide

## Project Overview

SakaraEdu adalah aplikasi web Laravel untuk informasi beasiswa, bootcamp/pelatihan, berita edukasi, dan manajemen uang beasiswa mahasiswa.

Project ini menggunakan:

- Laravel 13.x
- PHP ^8.3
- Livewire
- Blade
- Tailwind CSS v4
- Vite 8
- MySQL untuk lokal
- SQLite `:memory:` untuk test
- Session, cache, dan queue berbasis database
- Routes utama di `routes/web.php`

## Commands

| Command | Fungsi |
|---|---|
| `composer setup` | Bootstrap fresh app: install dependencies, membuat `.env`, generate key, migrate, npm install, build |
| `composer dev` | Menjalankan server Laravel, queue listener, dan Vite dev secara bersamaan |
| `composer test` | Clear config lalu menjalankan test |
| `./vendor/bin/pint` | Merapikan code style Laravel |
| `npm run dev` | Menjalankan Vite development |
| `npm run build` | Build asset frontend |

## Important Stack Rules

1. Use Laravel 13.x.
2. Use Blade and Livewire for frontend interactivity.
3. Use Tailwind CSS v4 with CSS-first config.
4. Use Vite 8.
5. Use `routes/web.php`.
6. Do not create a separate Next.js frontend.
7. Do not make the app API-first unless explicitly requested.
8. Use MySQL locally and SQLite `:memory:` for tests.
9. Use database-backed session, cache, and queue.

## Branding

Use the provided SakaraEdu logo assets:

```text
public/images/sakaraedu-logo-horizontal.png
public/images/sakaraedu-logo-icon.png
```

Use `sakaraedu-logo-horizontal.png` for:

1. Navbar.
2. Login page.
3. Register page.
4. Landing page hero.
5. Footer.

Use `sakaraedu-logo-icon.png` for:

1. Favicon.
2. Sidebar icon.
3. Loading state.
4. Empty state.
5. Dashboard summary icon.

## Color Theme

Use colors inspired by the logo:

```css
@import "tailwindcss";

@theme {
    --color-primary-blue: #005F9E;
    --color-sky-blue: #12A8E8;
    --color-deep-navy: #172B5F;
    --color-fresh-green: #7ACB00;
    --color-dark-green: #057A2E;
    --color-soft-bg: #F8FBFF;
    --color-slate-text: #334155;
}
```

Design tone:

1. Simple.
2. Modern.
3. Clean.
4. Gen Z-friendly.
5. Not too crowded.
6. Use soft shadows, rounded corners, gradient accents, and light animation.

## Animation Rules

Use lightweight animation only:

1. Card hover lift.
2. Fade in page sections.
3. Slide up cards.
4. Smooth button transition.
5. Livewire loading skeleton.
6. Sidebar transition.
7. Dropdown transition.

Avoid heavy animation that harms performance or accessibility.

## Core Product Requirements

SakaraEdu has three roles:

1. `user`
2. `admin`
3. `super_admin`

## Role Permissions

### User

User can:

1. Register and login.
2. View published scholarships.
3. View published bootcamps.
4. View published news.
5. Click registration links.
6. Edit own profile.
7. Use scholarship finance management.
8. View, edit, and delete own finance plans.

User cannot:

1. Access admin dashboard.
2. Create content.
3. Edit content.
4. Delete content.
5. View other users' finance plans.

### Admin

Admin can:

1. Login.
2. Access admin dashboard.
3. Create scholarships.
4. Edit scholarships.
5. Create bootcamps.
6. Edit bootcamps.
7. Create news.
8. Edit news.
9. Edit own profile.

Admin cannot:

1. Delete scholarships.
2. Delete bootcamps.
3. Delete news.
4. Manage admins.
5. Access super admin dashboard.

### Super Admin

Super Admin can:

1. Login.
2. Access super admin dashboard.
3. Create admin.
4. Edit admin.
5. Delete admin.
6. Create, edit, and delete scholarships.
7. Create, edit, and delete bootcamps.
8. Create, edit, and delete news.

## Bootcamp Price Requirement

Bootcamp supports free and paid programs.

Required fields:

```text
is_paid boolean default false
price decimal(15,2) nullable
```

Rules:

1. If `is_paid = false`, display `Free`.
2. If `is_paid = true`, display the price in Rupiah format.
3. If `is_paid = true`, `price` is required and must be greater than or equal to 1000.
4. If `is_paid = false`, `price` must be null or 0.
5. Show price/free badge on bootcamp cards and bootcamp detail page.
6. Public bootcamp list must support filter: all, free, paid.

## Required Livewire Components

Create these Livewire components:

```bash
php artisan make:livewire PublicScholarshipList
php artisan make:livewire PublicBootcampList
php artisan make:livewire PublicNewsList
php artisan make:livewire FinancePlanCalculator
php artisan make:livewire AdminScholarshipTable
php artisan make:livewire AdminBootcampTable
php artisan make:livewire AdminNewsTable
php artisan make:livewire AdminManagementTable
php artisan make:livewire ProfileForm
```

## Livewire Usage Rules

Use Livewire for:

1. Public scholarship search.
2. Public bootcamp search and price filter.
3. Public news search.
4. Admin dashboard tables.
5. Super Admin admin-management table.
6. Profile edit form.
7. Scholarship finance calculator.
8. Loading states.
9. Pagination.

Do not use Livewire for everything blindly. Static detail pages can remain normal Blade pages.

## Database Tables

Create these tables:

1. `users`
2. `scholarships`
3. `bootcamps`
4. `news`
5. `scholarship_finance_plans`

Optional after MVP:

1. `activity_logs`
2. `bookmarks`
3. `click_logs`

## Required Models

1. `User`
2. `Scholarship`
3. `Bootcamp`
4. `News`
5. `ScholarshipFinancePlan`

## Required Controllers

1. `HomeController`
2. `DashboardController`
3. `ProfileController`
4. `ScholarshipController`
5. `AdminScholarshipController`
6. `BootcampController`
7. `AdminBootcampController`
8. `NewsController`
9. `AdminNewsController`
10. `AdminManagementController`
11. `ScholarshipFinancePlanController`

## Required Middleware

Create middleware:

```text
RoleMiddleware
```

Middleware must accept role parameters.

Example:

```php
Route::middleware(['auth', 'role:admin,super_admin'])->group(function () {
    // admin and super admin routes
});

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    // super admin only routes
});
```

## Public Routes

```text
GET /
GET /beasiswa
GET /beasiswa/{slug}
GET /bootcamp
GET /bootcamp/{slug}
GET /berita
GET /berita/{slug}
GET /login
POST /login
GET /register
POST /register
POST /logout
```

## User Routes

```text
GET /dashboard
GET /profile
GET /profile/edit
PUT /profile
GET /uang-beasiswa
GET /uang-beasiswa/create
POST /uang-beasiswa/calculate
POST /uang-beasiswa
GET /uang-beasiswa/{id}
GET /uang-beasiswa/{id}/edit
PUT /uang-beasiswa/{id}
DELETE /uang-beasiswa/{id}
```

## Admin Routes

```text
GET /admin/dashboard

GET /admin/beasiswa
GET /admin/beasiswa/create
POST /admin/beasiswa
GET /admin/beasiswa/{id}/edit
PUT /admin/beasiswa/{id}

GET /admin/bootcamp
GET /admin/bootcamp/create
POST /admin/bootcamp
GET /admin/bootcamp/{id}/edit
PUT /admin/bootcamp/{id}

GET /admin/berita
GET /admin/berita/create
POST /admin/berita
GET /admin/berita/{id}/edit
PUT /admin/berita/{id}
```

## Super Admin Routes

```text
GET /super-admin/dashboard

GET /super-admin/admins
GET /super-admin/admins/create
POST /super-admin/admins
GET /super-admin/admins/{id}/edit
PUT /super-admin/admins/{id}
DELETE /super-admin/admins/{id}

DELETE /super-admin/beasiswa/{id}
DELETE /super-admin/bootcamp/{id}
DELETE /super-admin/berita/{id}
```

## Finance Plan Logic

Default semester:

```text
total_months = 6
total_days = 180
```

### Scenario 1: No rent, no transport

```text
food = 60%
saving = 25%
other = 15%
```

### Scenario 2: Transport, no rent

```text
food = 55%
transport = 15%
saving = 20%
other = 10%
```

### Scenario 3: Rent, no transport

```text
rent = 35%
food = 45%
saving = 10%
other = 10%
```

### Scenario 4: Rent and transport

```text
rent = 35%
food = 40%
transport = 10%
saving = 10%
other = 5%
```

## Validation Rules

### Scholarship

1. `title` required.
2. `organizer` required.
3. `start_date` required date.
4. `end_date` required date after or equal start date.
5. `location` required.
6. `description` required.
7. `registration_link` required URL.
8. `poster` nullable image JPG/PNG/WEBP max 2MB.
9. `status` must be `draft` or `published`.

### Bootcamp

1. `title` required.
2. `organizer` required.
3. `start_date` required date.
4. `end_date` required date after or equal start date.
5. `location` required.
6. `description` required.
7. `registration_link` required URL.
8. `poster` nullable image JPG/PNG/WEBP max 2MB.
9. `status` must be `draft` or `published`.
10. `is_paid` required boolean.
11. `price` required numeric minimum 1000 if `is_paid = true`.
12. `price` nullable or zero if `is_paid = false`.

### News

1. `title` required.
2. `category` required.
3. `content` required.
4. `thumbnail` nullable image JPG/PNG/WEBP max 2MB.
5. `status` must be `draft` or `published`.

### Finance Plan

1. `scholarship_amount` required numeric minimum 100000.
2. `uses_transport` required boolean.
3. `uses_rent` required boolean.
4. Percentages must total 100.
5. User can only access their own finance plans.

## Blade View Structure

```text
resources/views/
├── layouts/
│   ├── app.blade.php
│   ├── dashboard.blade.php
│   └── guest.blade.php
├── components/
├── livewire/
├── home.blade.php
├── auth/
│   ├── login.blade.php
│   └── register.blade.php
├── scholarships/
│   ├── index.blade.php
│   └── show.blade.php
├── bootcamps/
│   ├── index.blade.php
│   └── show.blade.php
├── news/
│   ├── index.blade.php
│   └── show.blade.php
├── dashboard/
│   ├── user.blade.php
│   ├── admin.blade.php
│   └── super-admin.blade.php
├── admin/
│   ├── scholarships/
│   ├── bootcamps/
│   └── news/
├── super-admin/
│   └── admins/
├── profile/
└── finance-plans/
```

## Tailwind v4 Notes

Tailwind v4 uses CSS-first configuration.

Use:

```css
@import "tailwindcss";

@theme {
    --color-primary-blue: #005F9E;
    --color-sky-blue: #12A8E8;
    --color-deep-navy: #172B5F;
    --color-fresh-green: #7ACB00;
    --color-dark-green: #057A2E;
    --color-soft-bg: #F8FBFF;
    --color-slate-text: #334155;
}
```

Do not create `tailwind.config.js` unless required.

## Testing Rules

1. Use SQLite `:memory:` in tests.
2. Put unit tests in `tests/Unit`.
3. Put feature tests in `tests/Feature`.
4. Test Livewire components where behavior matters.
5. Run all tests with:

```bash
composer test
```

6. Run a single test with:

```bash
php artisan test --filter=TestName
```

## Required Tests

Feature tests:

1. User can register.
2. New registered user has role `user`.
3. Admin cannot delete scholarship.
4. Super Admin can delete scholarship.
5. Admin cannot delete bootcamp.
6. Super Admin can delete bootcamp.
7. Free bootcamp displays `Free`.
8. Paid bootcamp displays Rupiah price.
9. User can filter free/paid bootcamps.
10. User cannot access admin dashboard.
11. Admin cannot access super admin dashboard.
12. User can create finance plan.
13. User cannot access another user's finance plan.

Unit tests:

1. Finance calculator without transport and rent.
2. Finance calculator with transport only.
3. Finance calculator with rent only.
4. Finance calculator with transport and rent.

## Code Quality

Before finalizing work, run:

```bash
./vendor/bin/pint
composer test
npm run build
```

## Seed Users

Create default seed users:

```text
Super Admin
email: superadmin@sakaraedu.com
password: password123
role: super_admin

Admin
email: admin@sakaraedu.com
password: password123
role: admin

User
email: user@sakaraedu.com
password: password123
role: user
```

## MVP Checklist

The MVP is complete when:

1. Register and login work.
2. Role-based redirect works.
3. Role middleware works.
4. Public pages show only published content.
5. Admin can create and edit beasiswa, bootcamp, and berita.
6. Admin cannot delete content.
7. Super Admin can manage admins.
8. Super Admin can delete content.
9. User can edit profile.
10. User can create and manage finance plans.
11. User cannot access another user's finance plans.
12. Bootcamp supports free and paid price display.
13. Livewire search/filter works.
14. Logo is installed and visible.
15. Frontend uses logo-based colors.
16. Lightweight animation is implemented.
17. Image upload works.
18. Pagination works.
19. `composer test` passes.
20. `npm run build` passes.
