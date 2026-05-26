<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Filesystem
    |--------------------------------------------------------------------------
    */

    'filesystem' => [
        'disk' => env('PREZET_FILESYSTEM_DISK', 'prezet'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Slug Settings
    |--------------------------------------------------------------------------
    */

    'slug' => [
        'source' => 'filepath',
        'keyed' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | CommonMark Configuration
    |--------------------------------------------------------------------------
    */

    'commonmark' => [

        'extensions' => [
            League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension::class,
            League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension::class,
            League\CommonMark\Extension\ExternalLink\ExternalLinkExtension::class,
            League\CommonMark\Extension\FrontMatter\FrontMatterExtension::class,
            Prezet\Prezet\Extensions\MarkdownBladeExtension::class,
            Prezet\Prezet\Extensions\MarkdownImageExtension::class,
        ],

        'config' => [

            'heading_permalink' => [
                'html_class' => 'prezet-heading',
                'id_prefix' => 'content',
                'apply_id_to_heading' => false,
                'insert' => 'before',
                'min_heading_level' => 2,
                'max_heading_level' => 3,
            ],

            'external_link' => [
                'internal_hosts' => env('APP_URL', 'localhost'),
                'open_in_new_window' => true,
                'nofollow' => 'external',
                'noopener' => 'external',
                'noreferrer' => 'external',
            ],

        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Database Connection
    |--------------------------------------------------------------------------
    */

    'database' => [
        'connection' => 'prezet',
    ],

    /*
    |--------------------------------------------------------------------------
    | Image Settings
    |--------------------------------------------------------------------------
    */

    'image' => [
        'widths' => [480, 640, 768, 960, 1536],
        'sizes' => '92vw',
        'zoomable' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Authors
    |--------------------------------------------------------------------------
    */

    'authors' => [

        'admin' => [
            '@type' => 'Person',
            'name' => 'Admin',
            'url' => env('APP_URL'),
            'image' => 'https://ui-avatars.com/api/?name=Admin',
            'bio' => 'Laravel 12 Prezet Blog Administrator.',
        ],

        'prezet' => [
            '@type' => 'Person',
            'name' => 'Prezet Admin',
            'url' => env('APP_URL'),
            'image' => 'https://ui-avatars.com/api/?name=Prezet',
            'bio' => 'Official Prezet blog author.',
        ],

    ],

];