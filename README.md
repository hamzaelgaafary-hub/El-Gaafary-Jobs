# El-Gaafary Jobs

<div align="center">

**Multi-Role Job Board Platform built with Laravel 12 + Filament v4**

![Laravel](https://img.shields.io/badge/Laravel-v12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-v4-FDAE4B?style=for-the-badge)
![Livewire](https://img.shields.io/badge/Livewire-v3-FB70A9?style=for-the-badge&logo=livewire&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-v4-38BDF8?style=for-the-badge&logo=tailwindcss&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

</div>

---

## Overview

**El-Gaafary Jobs** is a comprehensive job management and recruitment web platform. It operates on a robust **Multi-Panel** architecture powered by **Filament v4**, featuring independent dashboards for: Global Administrators (**Admin**), Hiring Managers (**Employer**), and Job Seekers (**Job Seeker**), with full multilingual support (Arabic & English).

**Functional Scope:**

- **Employers:** Post and manage job listings efficiently.
- **Job Seekers:** Search, apply for vacancies, and track application status.
- **Admins:** Full oversight of platform operations and user management.
- **UI/UX:** Interactive interface with real-time language switching.

---

## Features

### Authentication & Authorization

- Independent login systems for each panel (Admin / Employer / Job Seeker).
- Custom `LogoutResponse` to redirect users directly to the homepage instead of the login screen.
- Logout logic registered via `AppServiceProvider` utilizing the Filament `$action` API.

### Internationalization (i18n)

- Dual-language support (Arabic/English) using `mcamara/laravel-localization`.
- In-panel language switcher integrated via `bezhansalleh/filament-language-switch`.
- Custom Middleware to manage locale settings without conflicts across multiple panels.

### Analytical Dashboards

- Time-series trend charts powered by `flowframe/laravel-trend`.
- Integrated statistics within Filament Dashboard Widgets.
- Multilingual data management via **Astrotomic** integration using `doriiaan/filament-astrotomic`.

### Profile Management

- Direct profile editing within the panels via `joaopaulolndev/filament-edit-profile`.
- Integrated permissions within the native Filament authorization system.

### Automated Testing

- Robust Feature and Unit tests using **Pest v3**.
- Comprehensive Factories and Seeders for all core models.
- Optimized test execution via `php artisan test --compact`.

---

## Tech Stack

| Layer               | Tool / Package                        | Version | Purpose                             |
| ------------------- | ------------------------------------- | ------- | ----------------------------------- |
| **Backend**         | Laravel Framework                     | v12     | Core Application Architecture       |
| **Admin Panel**     | Filament                              | v4      | Multi-panel Management System       |
| **Reactivity**      | Livewire                              | v3      | Seamless AJAX-driven Interactions   |
| **Frontend**        | TailwindCSS                           | v4      | Modern Utility-first Styling        |
| **Runtime**         | PHP                                   | 8.4     | Primary Programming Language        |
| **Testing**         | Pest                                  | v3      | Modern Testing Framework            |
| **i18n**            | mcamara/laravel-localization          | \*      | Route & Locale Management           |
| **Localization UI** | bezhansalleh/filament-language-switch | v4.2    | In-panel Language Toggle            |
| **Trends**          | flowframe/laravel-trend               | v0.4    | Temporal Data Visualization         |
| **Dev Tools**       | Laravel Pint, Pail, Sail              | v1      | Linting, Logging, and Dockerization |
| **Dev Tools**       | Laravel Debugbar, IDE Helper          | \*      | Debugging & Development DX          |
| **Build**           | Vite                                  | Latest  | Frontend Asset Bundling             |

**Why Filament v4?**
Filament provides a production-ready multi-panel system with built-in authentication, authorization, and resource management. This eliminates the need to build CRUD interfaces from scratch, while its native Livewire support ensures a reactive experience without writing custom JavaScript.

---

## Technical Challenges & Solutions

### 1. Locale Conflicts Across Multiple Panels

**Challenge:** Using `mcamara/laravel-localization` across multiple Filament panels caused the locale selected in one panel to unexpectedly affect others, leading to middleware stack conflicts.

**Solution:** Implemented custom Middleware instead of relying solely on `canAccessPanel()`. This allowed for granular control over locale application for each panel independently, ensuring zero interference.

### 2. Customizing Logout Redirects

**Challenge:** By default, Filament redirects users to the login page upon logout, whereas this project required a redirect to the public homepage.

**Implementation:**

1.  Created a custom `LogoutResponse` within `Auth/Pages` inside the panel directory.
2.  Overrode the `$action` via Filament's official documentation guidelines.
3.  Registered the response in `AppServiceProvider` within the `register()` method:

<!-- end list -->

```php
// AppServiceProvider.php
public function register(): void
{
    $this->app->bind(
        \Filament\Http\Responses\Auth\Contracts\LogoutResponse::class,
        \App\Filament\Responses\LogoutResponse::class
    );
}

```

### 3. Cache Management Pipeline

**Challenge:** Changes in configurations, routes, or service providers often failed to reflect immediately due to aggressive caching.

**The Workflow Solution:**

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan optimize:clear
composer dump-autoload

```

### 4. Integrating Astrotomic with Filament

**Challenge:** The `Astrotomic/laravel-translatable` library requires specific configuration to work seamlessly with Filament forms and resources.

**Solution:** Leveraged the `doriiaan/filament-astrotomic` package, providing Filament-native components for translatable fields, ensuring full compatibility across all Admin resources.

---

## Project Structure

```
El-Gaafary-Jobs/

├── app/
│   ├── Filament/           # Panels, Resources, Widgets
│   ├── Models/             # Eloquent Models (PSR-4 Compliant)
│   ├── Http/               # Controllers & Custom Middleware
│   └── Providers/          # Service Providers
├── database/
│   ├── migrations/         # Database Schema
│   ├── factories/          # Model Factories
│   └── seeders/            # Database Seeders
├── resources/
│   └── views/              # Blade + Livewire Components
├── lang/                   # Translation Files (ar, en)
├── routes/
│   ├── web.php             # Web Routes
│   └── console.php         # CLI Commands
└── tests/                  # Pest Feature & Unit Tests

```

---

## Installation & Setup

```bash
# 1. Install Dependencies
composer install
npm install

# 2. Setup Environment
cp .env.example .env
php artisan key:generate

# 3. Initialize Database
php artisan migrate --seed

# 4. Launch Development Environment (Server + Queue + Vite)
composer run dev
```

---

## Roadmap & Future Enhancements

- **Real-time Notifications:** Implementing Laravel Broadcasting/Pusher for application status updates.
- **Advanced Search Engine:** Job filtering by specialty, location, and salary range.
- **PDF Reporting:** Automated resume and application summaries for employers.
- **RESTful API:** Extending support for mobile application integration.
- **E2E Testing:** Implementation of Laravel Dusk for browser-level testing.

---

## License

This is an open-source project licensed under the [MIT License](https://opensource.org/licenses/MIT).

---

<div align="center">
Built with using <strong>Laravel 12 <strong\> + <strong> Filament v4 <strong\>
<div\>
