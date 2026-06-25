<?php

return [

    'default' => env('FILESYSTEM_DISK', 'local'),

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        'cloudinary' => [
            'driver' => 'cloudinary',
            'cloud' => env('CLOUDINARY_CLOUD_NAME'),
            'key' => env('CLOUDINARY_KEY'),
            'secret' => env('CLOUDINARY_SECRET'),
            'url' => env('CLOUDINARY_URL'),
            'secure' => true,
        ],

    ],

];
