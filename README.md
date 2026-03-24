# PHP_Laravel12_Prezet

## Project Description

**PHP_Laravel12_Prezet** is a Laravel 12 application that demonstrates how to build a **Markdown-based Blog & Documentation website** using the [Prezet](https://prezet.com) package.

Simply write `.md` files — Prezet automatically converts them into SEO-friendly, high-performance blog posts. No heavy admin panel, no complex database setup for content — just pure Markdown!

This project is **beginner-friendly** and helps understand how to integrate the Prezet package into a fresh Laravel 12 project.

---

## Features

- 📝 Markdown-First Blogging — Write `.md` files, get a full blog
- 🖼️ Automatic Image Optimization — Auto compress, resize & responsive `srcset`
- 🔍 SEO Optimized — Auto meta tags, JSON-LD, OpenGraph images
- 📋 Dynamic Table of Contents — Auto-generated from headings
- 🎨 OG Image Generation — Auto social preview images from front matter
- 🌑 Dark Mode UI
- 🔒 Validated Front Matter — Type-safe DTOs for front matter fields
- 🗺️ Sitemap — Auto-generated sitemap for all posts
- 💻 Blade Components in Markdown — Use Laravel Blade inside `.md` files

---

## Technologies Used

| Technology | Purpose |
|---|---|
| PHP 8+ | Backend Language |
| Laravel 12 | PHP Framework |
| Prezet Package | Markdown Blog Engine |
| SQLite | Content Index Database |
| CommonMark | Markdown Parser |
| Blade Templates | Frontend Views |
| Tailwind CSS | UI Styling |
| Vite + esbuild | Frontend Asset Bundling |

---

## How It Works

```
Tu .md file lakhe  →  Prezet scan kare  →  SQLite ma index thay  →  Blog post ready! 🎉
```

1. Write a `.md` file inside `content/posts/` with front matter (title, date, etc.)
2. Run `php artisan prezet:index --fresh` to index all posts
3. Visit `/prezet` — your blog is live!
4. Content changes in body are reflected automatically; run index only when front matter changes

---

## Installation Steps

---

### STEP 1: Create Laravel 12 Project

Open terminal / CMD and run:

```bash
composer create-project laravel/laravel PHP_Laravel12_Prezet "12.*"
```

Go inside project:

```bash
cd PHP_Laravel12_Prezet
```

> This installs a fresh Laravel 12 project and moves into the project folder.

---

### STEP 2: Database Setup

Update `.env` with your database details:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:your_generated_key_here
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=php_laravel12_prezet
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
```

Create database in MySQL / phpMyAdmin:

```
Database name: php_laravel12_prezet
```

Then run:

```bash
php artisan migrate
```

> Connects Laravel with MySQL and creates default tables.

---

### STEP 3: Install Prezet Framework

```bash
composer require prezet/prezet
php artisan prezet:install
```

> Installs the Prezet package and sets up the core backend engine for markdown blogging.

---

### STEP 4: Install Frontend Blog Template

```bash
composer require prezet/blog-template --dev
php artisan blog-template:install
```

> Installs the ready-made blog frontend — routes, controllers, views, and CSS all set up automatically.

---

### STEP 5: Install Frontend Dependencies

```bash
npm install
npm run build
```

> Compiles Tailwind CSS and JS assets using Vite + esbuild.

---

### STEP 6: Configure Filesystem

Open: `config/filesystems.php`

Make sure the `prezet` disk is configured:

```php
<?php

return [

    'default' => env('FILESYSTEM_DISK', 'local'),

    'disks' => [

        // Prezet disk — points to project root to access content/ folder
        'prezet' => [
            'driver' => 'local',
            'root'   => base_path(),
            'throw'  => false,
        ],

        'local' => [
            'driver' => 'local',
            'root'   => storage_path('app/private'),
            'serve'  => true,
            'throw'  => false,
            'report' => false,
        ],

        'public' => [
            'driver'     => 'local',
            'root'       => storage_path('app/public'),
            'url'        => rtrim(env('APP_URL', 'http://localhost'), '/').'/storage',
            'visibility' => 'public',
            'throw'      => false,
            'report'     => false,
        ],

        's3' => [
            'driver'                  => 's3',
            'key'                     => env('AWS_ACCESS_KEY_ID'),
            'secret'                  => env('AWS_SECRET_ACCESS_KEY'),
            'region'                  => env('AWS_DEFAULT_REGION'),
            'bucket'                  => env('AWS_BUCKET'),
            'url'                     => env('AWS_URL'),
            'endpoint'                => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw'                   => false,
            'report'                  => false,
        ],

    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
```

> The `prezet` disk tells Prezet where to look for your markdown content files.

---

### STEP 7: Configure Prezet

Open: `config/prezet.php`

```php
<?php

return [

    'filesystem' => [
        'disk' => env('PREZET_FILESYSTEM_DISK', 'prezet'),
    ],

    'slug' => [
        'source' => 'filepath', // 'filepath' or 'title'
        'keyed'  => false,
    ],

    'commonmark' => [
        'extensions' => [
            League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension::class,
            League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension::class,
            League\CommonMark\Extension\ExternalLink\ExternalLinkExtension::class,
            League\CommonMark\Extension\FrontMatter\FrontMatterExtension::class,
            Prezet\Prezet\Extensions\MarkdownBladeExtension::class,
            Prezet\Prezet\Extensions\MarkdownImageExtension::class,
            Phiki\CommonMark\PhikiExtension::class,
        ],
        'config' => [
            'heading_permalink' => [
                'html_class'          => 'prezet-heading',
                'id_prefix'           => 'content',
                'apply_id_to_heading' => false,
                'heading_class'       => '',
                'fragment_prefix'     => 'content',
                'insert'              => 'before',
                'min_heading_level'   => 2,
                'max_heading_level'   => 3,
                'title'               => 'Permalink',
                'symbol'              => '#',
                'aria_hidden'         => false,
            ],
            'external_link' => [
                'internal_hosts'  => env('APP_URL', 'localhost'),
                'open_in_new_window' => true,
                'html_class'      => 'external-link',
                'nofollow'        => 'external',
                'noopener'        => 'external',
                'noreferrer'      => 'external',
            ],
            'phiki' => [
                'theme'        => \Phiki\Theme\Theme::NightOwl,
                'with_wrapper' => false,
                'with_gutter'  => true,
            ],
        ],
    ],

    'image' => [
        'widths' => [480, 640, 768, 960, 1536],
        'sizes'  => '92vw, (max-width: 1024px) 92vw, 768px',
        'zoomable' => true,
    ],

    'sitemap' => [
        'origin' => env('PREZET_SITEMAP_ORIGIN', env('APP_URL')),
    ],

    'authors' => [
        'bob' => [
            '@type' => 'Person',
            'name'  => 'Bob Author',
            'url'   => 'https://prezet.com/authors/bob',
            'image' => '/prezet/img/bob.webp',
            'bio'   => 'Bob is a Laravel developer focusing on frontend tooling and testing practices.',
        ],
        'jane' => [
            '@type' => 'Person',
            'name'  => 'Jane Author',
            'url'   => 'https://prezet.com/authors/jane',
            'image' => '/prezet/img/jane.webp',
            'bio'   => 'Jane is a backend developer specializing in Laravel architecture and database interactions.',
        ],
        'prezet' => [
            '@type' => 'Person',
            'name'  => 'Prezet Admin',
            'url'   => env('APP_URL'),
            'image' => 'https://prezet.com/favicon.svg',
            'bio'   => 'The official administrator of this blog.',
        ],
    ],

    'publisher' => [
        '@type' => 'Organization',
        'name'  => 'My Laravel Blog',
        'url'   => env('APP_URL'),
        'logo'  => 'https://prezet.com/favicon.svg',
        'image' => 'https://prezet.com/ogimage.png',
    ],
];
```

> Full configuration for filesystem, markdown parser, images, sitemap, authors, and publisher.

---

### STEP 8: Register Service Provider

Open: `bootstrap/providers.php`

```php
<?php

use App\Providers\AppServiceProvider;

return [
    AppServiceProvider::class,
    Prezet\Prezet\PrezetServiceProvider::class,
];
```

> Registers the Prezet service provider so all its features are available in the app.

---

### STEP 9: Add Routes

Open: `routes/web.php`

```php
<?php

use Illuminate\Support\Facades\Route;
use Prezet\Prezet\Http\Controllers\IndexController;
use Prezet\Prezet\Http\Controllers\ShowController;
use Prezet\Prezet\Http\Controllers\ImageController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('prezet')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('prezet.index');
    Route::get('img/{path}', [ImageController::class, 'show'])->where('path', '.*')->name('prezet.image');
    Route::get('{slug}', [ShowController::class, 'show'])->where('slug', '.*')->name('prezet.show');
});

require __DIR__.'/prezet.php';
```

> Defines routes for blog index, single post view, and image serving.

---

### STEP 10: Create Blog Post (Markdown Files)

Create folder structure:

```
content/
└── posts/
    ├── my-first-laravel-blog.md
    └── the-future-of-artificial-intelligence.md
```

#### `content/posts/my-first-laravel-blog.md`

```markdown
---
title: "Building a High-Performance Blog with Laravel 12 and Prezet"
date: "2026-03-24"
description: "A deep dive into setting up a lightning-fast, file-based CMS using the power of Laravel 12 and Prezet."
category: "Laravel"
image: "/prezet/img/og-default.png"
author: "prezet"
---

# Hello Developers! 🚀

Welcome to my first official technical blog post! I am excited to share my journey of building 
this modern blogging platform using **Laravel 12** and the **Prezet** package.

### Why I chose Prezet?

Setting up a traditional blog often involves managing complex databases and building heavy admin 
panels. However, Prezet simplifies this by transforming **Markdown** files into high-performance 
web pages.

### What makes this setup special?

* **Markdown-First Workflow:** Writing content is now as simple as editing a text file.
* **Blazing Fast Performance:** File-based content = zero database overhead.
* **Developer-Centric:** Version control your blog posts using Git.
* **SEO Optimized:** Out-of-the-box JSON-LD, OpenGraph tags, and sitemaps.
```

#### `content/posts/the-future-of-artificial-intelligence.md`

```markdown
---
title: "The Future of Artificial Intelligence: Beyond the Buzzwords"
date: "2026-03-24"
description: "A comprehensive guide to understanding Artificial Intelligence, its core technologies, and how it is transforming our world."
category: "Technology"
image: "/prezet/img/og-default.png"
author: "prezet"
---

# The Future of Artificial Intelligence: Beyond the Buzzwords 🤖

Artificial Intelligence (AI) is no longer a concept from science fiction movies. It is here, 
and it is fundamentally changing how we live, work, and communicate.

### What is Artificial Intelligence?

At its core, AI is a branch of computer science that aims to create systems capable of 
performing tasks that normally require human intelligence. This includes things like:
- **Visual perception** (identifying objects)
- **Speech recognition** (translating spoken words)
- **Decision-making** (analyzing data to make choices)
- **Language translation** (bridging communication gaps)

### The Pillars of Modern AI

#### 1. Machine Learning (ML)
Machine Learning is the process where computers learn from data without being explicitly programmed.

#### 2. Deep Learning
A subset of ML based on **Artificial Neural Networks**. Powers self-driving cars and facial recognition.

#### 3. Natural Language Processing (NLP)
Allows machines to understand human language. Powers **ChatGPT**, **Siri**, and **Google Assistant**.

### Conclusion: Looking Ahead

AI is not here to replace humans, but to **augment** our capabilities.

**Are you ready for the AI revolution?**
```

> Each markdown file has **front matter** (between `---`) that defines title, date, description, category, image, and author.

---

### STEP 11: Index the Content

After adding or modifying markdown files, run:

```bash
php artisan prezet:index --fresh
```

> This scans all `.md` files and rebuilds the SQLite index.
> Run this command whenever you: add new posts, rename files, or change front matter.

---

### STEP 12: Run the App

Start dev server:

```bash
php artisan serve
```

Open in browser:

```
http://127.0.0.1:8000          →  Home page
http://127.0.0.1:8000/prezet   →  Blog listing page
```

---

## Front Matter Reference

Every markdown file must start with front matter between `---`:

```markdown
---
title: "Your Post Title"
date: "2026-03-24"
description: "Short description for SEO and listing cards."
category: "Laravel"
image: "/prezet/img/og-default.png"
author: "prezet"
---
```

| Field | Required | Description |
|---|---|---|
| `title` | ✅ | Post title shown in listing and `<title>` tag |
| `date` | ✅ | Publication date (`YYYY-MM-DD`) |
| `description` | ✅ | SEO meta description |
| `category` | ✅ | Used for filtering posts |
| `image` | ✅ | OG image path for social sharing |
| `author` | ✅ | Must match a key in `config/prezet.php` authors |

---

## Expected Output

| URL | What You See |
|---|---|
| `http://127.0.0.1:8000` | Laravel welcome page |
| `http://127.0.0.1:8000/prezet` | Blog listing — all posts |
| `http://127.0.0.1:8000/prezet/posts/my-first-laravel-blog` | Single post view |
| `http://127.0.0.1:8000/prezet/posts/the-future-of-artificial-intelligence` | Single post view |

---
<img width="1893" height="910" alt="Screenshot 2026-03-24 105405" src="https://github.com/user-attachments/assets/77c07cba-949a-4bd5-b052-88718ba16766" />
<img width="1894" height="909" alt="Screenshot 2026-03-24 105509" src="https://github.com/user-attachments/assets/b57879c6-4407-4fa2-90a6-fe774aa82125" />
<img width="1896" height="912" alt="Screenshot 2026-03-24 110856" src="https://github.com/user-attachments/assets/30e3eccd-c2b1-427c-98e5-75ebd4a60111" />


## Project Folder Structure

```
PHP_Laravel12_Prezet/
│
├── app/
│   ├── Http/
│   └── Providers/
│
├── bootstrap/
│   └── providers.php              ← PrezetServiceProvider registered here
│
├── config/
│   ├── prezet.php                 ← Prezet config (authors, images, sitemap)
│   ├── filesystems.php            ← prezet disk configured here
│   └── ...
│
├── content/                       ← All markdown content lives here
│   └── posts/
│       ├── my-first-laravel-blog.md
│       └── the-future-of-artificial-intelligence.md
│
├── prezet/                        ← Prezet internal folder (auto-generated)
│   └── content/                   ← Sample/testing content
│       └── images/                ← Author images (bob.webp, jane.webp)
│
├── public/
│   ├── storage/
│   │   └── prezet/img/            ← Optimized images served here
│   └── index.php
│
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│       ├── prezet/                ← Prezet blade views
│       │   ├── index.blade.php
│       │   ├── show.blade.php
│       │   ├── category.blade.php
│       │   ├── ogimage.blade.php
│       │   └── welcome.blade.php
│       └── components/
│
├── routes/
│   ├── web.php                    ← Main routes + prezet prefix group
│   └── prezet.php                 ← Auto-generated by Prezet installer
│
├── storage/
│   └── prezet/
│       └── prezet.sqlite          ← SQLite index for all posts
│
├── .env
├── artisan
├── composer.json
├── package.json
└── README.md
```

---

## Useful Commands

| Command | Purpose |
|---|---|
| `php artisan prezet:install` | Install Prezet framework |
| `php artisan prezet:index --fresh` | Rebuild SQLite index from scratch |
| `php artisan prezet:index` | Update index (add/remove posts) |
| `php artisan serve` | Start local dev server |
| `npm run build` | Build frontend assets for production |
| `npm run dev` | Watch and compile assets during development |

---
