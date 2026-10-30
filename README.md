# LabActivity9_Rabanes

Barangay Bakuna Tracker for Matina Crossing, Davao City. Built with Laravel 12, Blade layouts/components, SQLite, Tailwind CSS 3, PostCSS and Vite.

## Run locally

Use PHP 8.4+, Composer and Node.js 22+ (the locked PHP dependencies were installed on PHP 8.4).

```sh
composer install
cp .env.example .env
php artisan key:generate
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
php artisan migrate:fresh --seed
npm install
npm run build
php artisan serve
```

On Windows PowerShell, use `Copy-Item .env.example .env` instead of `cp`.
Open http://127.0.0.1:8000. For development, run `npm run dev` in a second terminal alongside `php artisan serve`.
The production build creates `public/build/manifest.json`; build assets are generated locally and excluded from Git.

This computer has portable Node at `$env:LOCALAPPDATA\bakuna-tools\node-v22.16.0-win-x64`. If npm is unavailable in PowerShell, run:

```powershell
$env:PATH = "$env:LOCALAPPDATA\bakuna-tools\node-v22.16.0-win-x64;$env:PATH"
npm.cmd run build
```

## Demo login

- Email: `nurse.rabanes@bakuna.test`
- Password: `bakuna2026`
- Health worker: Jason Cedirck
- Dashboard: Bakuna Tracker - Purok Rabanes
- Birthday appointment: November 23, 2026 (Hepatitis B)

These are classroom demo credentials. Demo residents use NBA player names; all vaccination details are fictional. This lab displays seeded records; editing appointments is outside its scope.

## How it works

[DashboardController](app/Http/Controllers/DashboardController.php) loads vaccinations by date and calculates Total, Done, Scheduled and Overdue counts.
[The layout](resources/views/layouts/app.blade.php) shares navigation, footer and Vite assets across login, dashboard and schedule views.
[Stat cards](resources/views/components/stat-card.blade.php) use props; [panels](resources/views/components/panel.blade.php) use a title prop and a slot.
[The table](resources/views/partials/schedule-table.blade.php) uses `@forelse`, `@empty`, `$loop` and `@unless`. Blade escapes resident data.

Both data pages require authentication. Login validates credentials and regenerates the session. Logout uses POST with CSRF protection and invalidates the session.
The alert banner prioritizes overdue records, then the stock notice, then “All clear”. To demonstrate the stock branch, set `BAKUNA_OUT_OF_STOCK=true` and remove overdue statuses in a disposable database. Automated tests cover all branches without changing your local records.

Personalization is in [.env.example](.env.example), copied into your local environment. After changing it, run `php artisan config:clear` and `php artisan db:seed`. The seeder updates its demo rows without duplicating them.
`php artisan migrate:fresh --seed` resets the entire local database.

## Verify

```sh
npm run build
php artisan test
```

Tests use in-memory SQLite and cover protected pages, login failures, login/logout, database counts, vaccine coverage, birthday configuration, alerts, empty schedules and escaped output.

## Submission

Repository: https://github.com/jasoncedrick/LabActivity9_Rabanes (the repository name supplied for this project).
The PDF spells the name with a hyphen, `LabActivity9-Rabanes`; confirm the accepted naming convention before submission.
Push later changes with:

```sh
git push origin main
```

Submit the public repository link on Moodle. Moodle submission must still be completed.
Do not upload `.env`, `vendor/`, `node_modules/` or the SQLite database.

Implementation assistance: Codex helped scaffold, implement and test this project. Review the controllers, Blade directives and asset setup before the lab defense; the commits record actual implementation stages.
