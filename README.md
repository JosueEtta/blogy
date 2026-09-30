# Blogy

Blogy is a simple blog application built with **Laravel 13**. It allows users to create an account, sign in, and manage blog posts from a single web interface.

The project is intended as a straightforward Laravel application for learning and demonstrating core web-development concepts such as authentication, Eloquent relationships, database migrations, validation, CRUD operations, Blade views, and Vite-based frontend assets.

## Features

- User registration and authentication
- Secure sign-in and sign-out
- Create blog posts
- View all posts
- Edit existing posts
- Delete posts
- Associate each post with its author
- Server-side validation for account and post forms
- Session-based authentication
- Toast-style success and error feedback
- Responsive UI built with Tailwind CSS and DaisyUI
- Database migrations and seeders for quickly setting up sample data

## How the application works

After opening the application:

1. Guests are sent to the **Sign In** page.
2. New users can create an account from the **Sign Up** page.
3. After signing in, users are taken to the home page.
4. Authenticated users can create a post by providing a title and content.
5. Existing posts are displayed with their author and creation date.
6. Posts can be edited or deleted from the home page.
7. Logging out ends the current authenticated session and returns the user to the Sign In page.

### Data model

The application currently has two main application models:

- **User** — stores account information such as name, email, and password.
- **Post** — stores a post's title and content and belongs to a user through `user_id`.

The relationship is:

```
User
 └── hasMany Posts

Post
 └── belongsTo User
```

Deleting a user also deletes their posts through the database foreign-key cascade.

## Tech stack

- **PHP:** 8.3+
- **Framework:** Laravel 13
- **Database:** SQLite by default
- **Frontend:** Blade
- **CSS:** Tailwind CSS 4
- **UI components:** DaisyUI
- **Asset bundler:** Vite
- **Package managers:** Composer and npm

## Requirements

Before installing Blogy, make sure you have:

- PHP 8.3 or newer
- Composer
- Node.js and npm
- A database supported by your Laravel configuration

The repository is configured to use **SQLite by default**, so you do not need MySQL for the standard local setup.

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/JosueEtta/blogy.git
cd blogy
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Create the environment file

Copy the example environment file:

**macOS/Linux/Git Bash:**

```bash
cp .env.example .env
```

**Windows PowerShell:**

```powershell
Copy-Item .env.example .env
```

### 4. Generate the application key

```bash
php artisan key:generate
```

### 5. Create the SQLite database

The default `.env.example` uses SQLite. Create the database file before running the migrations:

```bash
php -r "touch('database/database.sqlite');"
```

If the file already exists, this command is harmless.

### 6. Run the database migrations

```bash
php artisan migrate
```

### 7. Install frontend dependencies

```bash
npm install
```

### 8. Build the frontend assets

For a production-style build:

```bash
npm run build
```

For local development with Vite's file watcher, use:

```bash
npm run dev
```

Keep the Vite development process running while developing so frontend changes are rebuilt automatically.

### 9. Start the Laravel development server

In another terminal:

```bash
php artisan serve
```

The application will normally be available at:

```
http://localhost:8000
```

## Quick setup

The project already defines a Composer setup script that installs dependencies, creates the environment file when necessary, generates the application key, runs migrations, installs npm dependencies, and builds the frontend.

After creating the SQLite database file, you can use:

```bash
composer run setup
```

Then start the application with:

```bash
php artisan serve
```

For frontend development, run `npm run dev` in a separate terminal.

## Optional: seed sample data

The database seeder creates **5 users**, with **3 posts for each user**.

To populate the database with sample data:

```bash
php artisan db:seed
```

To reset the database and recreate it with the sample data:

```bash
php artisan migrate:fresh --seed
```

> **Note:** `migrate:fresh --seed` deletes all existing database tables and their data. Use it only when you are comfortable resetting the local database.

## Development commands

### Start Laravel

```bash
php artisan serve
```

### Start Vite

```bash
npm run dev
```

### Build frontend assets

```bash
npm run build
```

### Run migrations

```bash
php artisan migrate
```

### Seed the database

```bash
php artisan db:seed
```

### Run tests

```php
php artisan test
```

### Clear Laravel caches

If you encounter unexpected configuration or view behaviour:

```bash
php artisan optimize:clear
```

## Project structure

The most important directories are:

```
blogy/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   └── Models/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   └── views/
├── routes/
│   └── web.php
├── tests/
├── .env.example
├── composer.json
├── package.json
└── vite.config.js
```

### Important application files

- `routes/web.php` — defines the application's web routes.
- `app/Http/Controllers/AuthController.php` — handles registration, sign-in, and logout.
- `app/Http/Controllers/PostController.php` — handles post creation, listing, editing, updating, and deletion.
- `app/Models/User.php` — represents application users and their posts.
- `app/Models/Post.php` — represents blog posts and their author relationship.
- `resources/views/home.blade.php` — main authenticated blog interface.
- `resources/views/auth/signup.blade.php` — registration page.
- `resources/views/auth/signin.blade.php` — sign-in page.
- `database/migrations/` — contains the database schema.
- `database/seeders/DatabaseSeeder.php` — creates sample users and posts.

## Database configuration

By default, Blogy uses SQLite:

```env
DB_CONNECTION=sqlite
```

If you prefer another Laravel-supported database, update the `DB_*` variables in your `.env` file and make sure the database exists before running:

```bash
php artisan migrate
```

Do not commit your `.env` file because it may contain local configuration and credentials.

## Authentication

Blogy uses Laravel's built-in authentication facilities.

### Sign up

Users provide:

- Name
- Email
- Password
- Password confirmation

The email must be unique, and passwords must contain at least 8 characters.

### Sign in

Users authenticate with their email and password. Laravel regenerates the session after a successful login.

### Sign out

Signing out invalidates the session and regenerates the CSRF token before returning the user to the sign-in page.

## Contributing

Contributions and improvements are welcome.

A typical workflow is:

```bash
git checkout -b feature/my-change
```

Make your changes, test them, and then create a pull request describing what was changed.

## License

This project is open-sourced under the MIT License.

---

Built with Laravel, Blade, Tailwind CSS, and DaisyUI.
