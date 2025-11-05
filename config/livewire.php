<?php

return [
    'asset_url' => null,

    'middleware' => [
        'web' => [
            \Livewire\Middleware\AssetManager::class,
            \Livewire\Middleware\HandleAction::class,
            \Livewire\Middleware\PreventRequestsDuringRedirects::class,
            \Livewire\Middleware\ShareErrorsFromSession::class,
        ],
    ],

    'version' => '1.0.0',

    'class_namespace' => 'App\\Http\\Livewire',

    'component_aliases' => [],

    'temporary_file_uploads' => [
        'disk' => 'local',
        'directory' => 'livewire-tmp',
    ],

    'file_uploads' => [
        'disk' => 'public',
        'directory' => 'livewire-files',
    ],

    'debug' => env('LIVEWIRE_DEBUG', false),
];