<?php

return [

    'default' => env('DB_CONNECTION', 'mysql'),

    'connections' => [

        // MAIN MYSQL DATABASE
        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'laravel12_prezet_new'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
        ],

        // ✅ PREZET INTERNAL DATABASE (IMPORTANT)
        'prezet' => [
            'driver' => 'sqlite',
            'database' => database_path('prezet.sqlite'), // 🔥 MUST BE STRING
            'prefix' => '',
            'foreign_key_constraints' => true,
        ],

        // DEFAULT SQLITE (optional)
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => database_path('database.sqlite'),
            'prefix' => '',
            'foreign_key_constraints' => true,
        ],

    ],
];