<?php

return [
    /*
    |--------------------------------------------------------------------------
    | OpenAI Configuration
    |--------------------------------------------------------------------------
    |
    | Centralized OpenAI configuration file. This allows the application to
    | read the API key, endpoint URL and model from a single config source
    | instead of scattered env() calls. Update values in your `.env` file.
    |
    */

    'api_key' => env('OPENAI_API_KEY', null),
    'url' => env('OPENAI_API_URL', 'https://api.openai.com/v1/chat/completions'),
    'model' => env('OPENAI_MODEL', 'gpt-3.5-turbo'),
];
